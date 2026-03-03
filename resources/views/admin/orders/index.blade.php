@extends('admin.layouts.app')
@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="page-header">
    <div>
        <h1>Orders</h1>
        <div class="breadcrumb">Admin / <span>Orders</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <button id="bulkDeleteBtn" class="btn btn-danger" style="display:none"><i class="fas fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)</button>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Order</a>
    </div>
</div>

<div class="search-bar">
    <form id="filterForm" style="display:flex;gap:12px;flex:1;flex-wrap:wrap">
        <div class="search-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search by customer name..." value="{{ request('search') }}">
        </div>
        <select name="status" id="statusFilter" class="form-control" style="width:170px">
            <option value="">All Status</option>
            <option value="pending"   {{ request('status')=='pending'   ?'selected':'' }}>Pending</option>
            <option value="active"    {{ request('status')=='active'    ?'selected':'' }}>Active</option>
            <option value="completed" {{ request('status')=='completed' ?'selected':'' }}>Completed</option>
            <option value="cancelled" {{ request('status')=='cancelled' ?'selected':'' }}>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-gold"><i class="fas fa-filter"></i> Filter</button>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title"><i class="fas fa-shopping-bag" style="margin-right:8px;color:var(--gold)"></i>All Orders</div>
    </div>
    <div id="orders-table"></div>
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
        const table = new Tabulator("#orders-table", {
            data: {!! $orders->items() ? json_encode($orders->items()) : '[]' !!},
            ajaxURL: "{{ route('admin.orders.index') }}?json=1",
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
            placeholder: "<div class='empty-state'><i class='fas fa-inbox'></i><p>No orders found</p></div>",
            ajaxError: function(error) {
                console.error("Tabulator AJAX Error:", error);
            },
            columns: [
                {formatter:"rowSelection", titleFormatter:"rowSelection", width:50, hozAlign:"center", headerSort:false, cellClick:function(e, cell){
                    cell.getRow().toggleSelect();
                }},
                {title: "#", field: "id", width: 70, formatter: "rownum", hozAlign: "center", headerSort: false, color: "#8892a4"},
                {title: "Order ID", field: "id", width: 100, formatter: function(cell) { return `<span class="text-muted fw-600">#${cell.getValue()}</span>`; }},
                {title: "Customer", field: "customer.name", formatter: function(cell) {
                    const data = cell.getData();
                    const custName = data.customer ? data.customer.name : '—';
                    const custEmail = data.customer ? data.customer.email : '';
                    return `<div><div class='fw-600'>${custName}</div><div class='text-muted' style='font-size:.78rem'>${custEmail}</div></div>`;
                }},
                {title: "Plan", field: "plan.name", formatter: function(cell) { return cell.getValue() || '—'; }, color: "#8892a4"},
                {title: "Amount", field: "amount", formatter: function(cell) {
                    return `<span class='fw-600 text-gold'>₹${parseFloat(cell.getValue()).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>`;
                }},
                {title: "Status", field: "status", formatter: function(cell) {
                    const val = cell.getValue();
                    let cls = 'badge-muted';
                    switch(val) {
                        case 'active': cls = 'badge-success'; break;
                        case 'pending': cls = 'badge-warning'; break;
                        case 'cancelled': cls = 'badge-danger'; break;
                        case 'completed': cls = 'badge-info'; break;
                    }
                    return `<span class='badge ${cls}'>${val.charAt(0).toUpperCase() + val.slice(1)}</span>`;
                }},
                {title: "Date", field: "created_at", formatter: function(cell) {
                    return new Date(cell.getValue()).toLocaleDateString('en-GB', {day: '2-digit', month: 'short', year: 'numeric'});
                }, color: "#8892a4"},
                {title: "Actions", field: "id", headerSort: false, formatter: function(cell) {
                    const id = cell.getValue();
                    const showUrl = `{{ route('admin.orders.show', ':id') }}`.replace(':id', id);
                    const editUrl = `{{ route('admin.orders.edit', ':id') }}`.replace(':id', id);
                    return `
                        <div style="display:flex;gap:8px">
                            <a href="${showUrl}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="${editUrl}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form method="POST" action="${`{{ route('admin.orders.destroy', ':id') }}`.replace(':id', id)}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm confirm-delete" data-confirm="Are you sure you want to delete this order?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    `;
                }},
            ],
            ajaxResponse: function(url, params, response) {
                if (response && response.data) {
                    return {
                        last_page: response.last_page,
                        data: response.data,
                    };
                }
                return response;
            },
            dataLoaded: function(data) {
                console.log("Orders data loaded:", data.length, "rows");
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
                text: `You are about to delete ${ids.length} orders. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: 'rgba(255,255,255,0.1)',
                confirmButtonText: 'Yes, delete them!',
                background: '#0d1526',
                color: '#e2e8f0'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('admin.orders.bulk-delete') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: ids })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            table.setData();
                            Toast.fire({ icon: 'success', title: 'Orders deleted successfully' });
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
