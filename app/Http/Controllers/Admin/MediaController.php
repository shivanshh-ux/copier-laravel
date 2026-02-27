<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = MediaUpload::latest()->paginate(12);
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:video,pdf',
            'file'        => 'required|file|max:102400', // 100MB max
        ]);

        $file = $request->file('file');
        $path = $file->store('media', 'public');

        MediaUpload::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'type'          => $request->type,
            'file_path'     => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('admin.media.index')->with('success', 'File uploaded successfully.');
    }

    public function destroy(MediaUpload $medium)
    {
        Storage::disk('public')->delete($medium->file_path);
        $medium->delete();
        return redirect()->route('admin.media.index')->with('success', 'File deleted.');
    }
}
