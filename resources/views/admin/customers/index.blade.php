@extends('admin.layouts.app')
@section('title', 'Customers')
@section('page-title', 'Customers')

@section('content')
<div class="page-header">
    <div>
        <h1>Customers</h1>
        <div class="breadcrumb">Admin / <span>Customers</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <button id="bulkDeleteBtn" class="btn btn-danger" style="display:none"><i class="fas fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)</button>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Customer</a>
    </div>
</div>

<div class="search-bar">
    <form id="filterForm" style="display:flex;gap:12px;flex:1;flex-wrap:wrap">
        <div class="search-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <select name="status" id="statusFilter" class="form-control" style="width:160px">
            <option value="">All Status</option>
            <option value="active"   {{ request('status')=='active'   ? 'selected':'' }}>Active</option>
            <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-gold"><i class="fas fa-filter"></i> Filter</button>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title"><i class="fas fa-users" style="margin-right:8px;color:var(--gold)"></i>All Customers</div>
    </div>
    <div id="customers-table"></div>
</div>

@push('styles')
<style>
    .tabulator { background-color: transparent !important; border: none !important; color: var(--text) !important; font-size: 0.88rem !important; }
    .tabulator .tabulator-tableHolder { background-color: transparent !important; }
    .tabulator-header { background-color: var(--navy-2) !important; color: var(--text-muted) !important; border-bottom: 1px solid var(--border) !important; font-weight: 600 !important; text-transform: uppercase !important; letter-spacing: 0.5px !important; }
    .tabulator-header .tabulator-col { background-color: transparent !important; border-right: 1px solid var(--border) !important; padding: 12px !important; }
    .tabulator-header .tabulator-col:last-child { border-right: none !important; }
    .tabulator-row { background-color: rgba(0,0,0,0.85) !important; border-bottom: 1px solid var(--border) !important; color: var(--text) !important; min-height: 55px !important; display: flex; align-items: center; }
    .tabulator-row:hover { background-color: rgba(0,0,0,0.95) !important; }
    .tabulator-row.tabulator-row-even { background-color: rgba(0,0,0,0.75) !important; }
    .tabulator-row .tabulator-cell { padding: 14px 16px !important; border-right: 1px solid var(--border) !important; display: flex; align-items: center; background-color: transparent !important; }
    .tabulator-row .tabulator-cell:last-child { border-right: none !important; }
    .tabulator-footer { background-color: var(--navy-2) !important; border-top: 1px solid var(--border) !important; color: var(--text-muted) !important; padding: 10px !important; }
    .tabulator-page { background: rgba(255,255,255,0.05) !important; color: var(--text-muted) !important; border: 1px solid var(--border) !important; border-radius: 6px !important; margin: 0 2px !important; }
    .tabulator-page.active { background: var(--gold) !important; color: var(--navy) !important; border-color: var(--gold) !important; font-weight: 700 !important; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = new Tabulator("#customers-table", {
            data: {!! $customers->items() ? json_encode($customers->items()) : '[]' !!},
            ajaxURL: "{{ route('admin.customers.index') }}?json=1",
            ajaxConfig: {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                }
            },
            ajaxFiltering: true,
            ajaxSorting: true,
            pagination: "remote",
            paginationSize: 15,
            layout: "fitColumns",
            movableColumns: true,
            height: "600px",
            placeholder: "<div class='empty-state'><i class='fas fa-users'></i><p>No customers found</p></div>",
            ajaxError: function(error) {
                console.error("Tabulator AJAX Error:", error);
            },
            columns: [
                {formatter:"rowSelection", titleFormatter:"rowSelection", width:50, hozAlign:"center", headerSort:false, cellClick:function(e, cell){
                    cell.getRow().toggleSelect();
                }},
                {title: "#", field: "id", width: 70, formatter: "rownum", hozAlign: "center", headerSort: false, color: "#8892a4"},
                {title: "Customer", field: "name", formatter: function(cell) {
                    const data = cell.getData();
                    return `<div><div class='fw-600'>${data.name}</div><div class='text-muted' style='font-size:.78rem'>${data.email}</div></div>`;
                }},
                {title: "Phone", field: "phone", formatter: function(cell) { return cell.getValue() || '—'; }, color: "#8892a4"},
                {title: "Plan", field: "plan.name", formatter: function(cell) {
                    const val = cell.getValue();
                    return val ? `<span class='badge badge-info'>${val}</span>` : `<span class='text-muted'>—</span>`;
                }},
                {title: "Status", field: "status", formatter: function(cell) {
                    const val = cell.getValue();
                    const cls = val === 'active' ? 'badge-success' : 'badge-danger';
                    return `<span class='badge ${cls}'><i class='fas fa-circle' style='font-size:.5rem'></i> ${val.charAt(0).toUpperCase() + val.slice(1)}</span>`;
                }},
                {title: "Joined", field: "created_at", formatter: function(cell) {
                    return new Date(cell.getValue()).toLocaleDateString('en-GB', {day: '2-digit', month: 'short', year: 'numeric'});
                }, color: "#8892a4"},
                {title: "Actions", field: "id", headerSort: false, formatter: function(cell) {
                    const id = cell.getValue();
                    const editUrl = `{{ route('admin.customers.edit', ':id') }}`.replace(':id', id);
                    const deleteUrl = `{{ route('admin.customers.destroy', ':id') }}`.replace(':id', id);
                    return `
                        <div style="display:flex;gap:8px">
                            <a href="${editUrl}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form method="POST" action="${deleteUrl}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm confirm-delete" data-confirm="Are you sure you want to delete this customer?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    `;
                }},
            ],
            ajaxResponse: function(url, params, response) {
                // If it's a Laravel paginator object
                if (response && response.data) {
                    return {
                        last_page: response.last_page,
                        data: response.data,
                    };
                }
                return response;
            },
            dataLoaded: function(data) {
                console.log("Data loaded into table:", data.length, "rows");
            }
        });

        // Filter functionality
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const search = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const filters = [];
            if (search) {
                filters.push({field: "search", type: "like", value: search});
            }
            if (status) {
                filters.push({field: "status", type: "=", value: status});
            }
            table.setFilter(filters);
        });

        // Also apply filter when status dropdown changes
        document.getElementById('statusFilter').addEventListener('change', function() {
            document.getElementById('filterForm').dispatchEvent(new Event('submit'));
        });

        // Selection update
        table.on("rowSelectionChanged", function(data, rows) {
            const count = data.length;
            const btn = document.getElementById('bulkDeleteBtn');
            const countSpan = document.getElementById('selectedCount');
            if (count > 0) {
                btn.style.display = 'inline-flex';
                countSpan.textContent = count;
            } else {
                btn.style.display = 'none';
            }
        });

        // Bulk delete
        document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
            const selectedData = table.getSelectedData();
            const ids = selectedData.map(row => row.id);
            
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete ${ids.length} customers. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: 'rgba(255,255,255,0.1)',
                confirmButtonText: 'Yes, delete them!',
                background: '#0d1526',
                color: '#e2e8f0'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('admin.customers.bulk-delete') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: ids })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            table.setData();
                            Toast.fire({ icon: 'success', title: 'Customers deleted successfully' });
                        } else {
                            Toast.fire({ icon: 'error', title: 'Something went wrong!' });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
@endsection
