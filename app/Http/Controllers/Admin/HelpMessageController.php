<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpMessage;
use Illuminate\Http\Request;

class HelpMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = HelpMessage::latest();

        // Filtering by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtering by Subject (Category)
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        // Search by Name or Email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();
        
        return view('admin.help-messages.index', compact('messages'));
    }

    public function show(HelpMessage $help_message)
    {
        return view('admin.help-messages.show', compact('help_message'));
    }

    public function updateStatus(Request $request, HelpMessage $help_message)
    {
        $request->validate([
            'status' => 'required|in:pending,replied,closed'
        ]);

        $help_message->update(['status' => $request->status]);

        return back()->with('success', 'Message status updated to ' . ucfirst($request->status));
    }

    public function destroy(HelpMessage $help_message)
    {
        $help_message->delete();
        return redirect()->route('admin.help-messages.index')->with('success', 'Message deleted successfully.');
    }
}
