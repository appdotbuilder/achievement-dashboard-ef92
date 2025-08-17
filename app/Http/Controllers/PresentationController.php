<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePresentationRequest;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentations = Presentation::with('user:id,name')
            ->when(request('search'), function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when(request('status'), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('presentations/index', [
            'presentations' => $presentations,
            'filters' => [
                'search' => request('search'),
                'status' => request('status'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('presentations/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentationRequest $request)
    {
        $file = $request->file('presentation');
        $filename = $file->getClientOriginalName();
        $path = $file->store('presentations', 'private');

        $presentation = Presentation::create([
            'title' => $request->title ?? pathinfo($filename, PATHINFO_FILENAME),
            'filename' => $filename,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'status' => 'processing',
            'user_id' => auth()->id(),
        ]);

        // Here you would typically dispatch a job to process the PowerPoint file
        // and extract slides, but for now we'll mark it as ready
        $presentation->update(['status' => 'ready']);

        return redirect()->route('presentations.show', $presentation)
            ->with('success', 'Presentation uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presentation $presentation)
    {
        $presentation->load(['slides', 'user:id,name']);

        return Inertia::render('presentations/show', [
            'presentation' => $presentation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentation $presentation)
    {
        return Inertia::render('presentations/edit', [
            'presentation' => $presentation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presentation $presentation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $presentation->update($request->only(['title', 'is_active']));

        return redirect()->route('presentations.show', $presentation)
            ->with('success', 'Presentation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentation $presentation)
    {
        // Delete file from storage
        if (Storage::disk('private')->exists($presentation->file_path)) {
            Storage::disk('private')->delete($presentation->file_path);
        }

        $presentation->delete();

        return redirect()->route('presentations.index')
            ->with('success', 'Presentation deleted successfully.');
    }
}