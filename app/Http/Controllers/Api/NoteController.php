<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // Notes List with Pagination
    public function index(Request $request)
    {
        $limit = $request->limit ?? 3;

        $notes = Note::latest()->paginate($limit);

        return response()->json([
            'status' => true,
            'message' => 'Notes fetched successfully',
            'data' => $notes
        ], 200);
    }

    // Create Note
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Note created successfully',
            'data' => $note
        ], 201);
    }

    // Single Note
    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $note
        ], 200);
    }

    // Update Note
    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found'
            ], 404);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Note updated successfully',
            'data' => $note
        ], 200);
    }

    // Delete Note
    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found'
            ], 404);
        }

        $note->delete();

        return response()->json([
            'status' => true,
            'message' => 'Note deleted successfully'
        ], 200);
    }

    // AI Summary
    public function summary($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json([
                'status' => false,
                'message' => 'Note not found'
            ], 404);
        }

        // Simple AI Summary Logic
        $summary = substr(strip_tags($note->content), 0, 120);

        $note->summary = $summary;
        $note->save();

        return response()->json([
            'status' => true,
            'summary' => $summary
        ]);
    }

    // Semantic Search
    public function semanticSearch(Request $request)
    {
        $query = $request->query;

        $notes = Note::where('title', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->get();

        return response()->json([
            'status' => true,
            'results' => $notes
        ]);
    }
}