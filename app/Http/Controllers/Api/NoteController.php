<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $limit = $request->limit ?? 10;

        $notes = Note::latest()->paginate($limit);

        return response()->json([
            'status' => true,
            'message' => 'Notes fetched successfully',
            'data' => $notes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titleNm' => 'required',
            'content' => 'required'
        ]);

        
        $note=Note::create([
            'title'=>$request->titleNm,
            'content'=>$request->content
        ]);

        return response()->json([
            'massage'=>'Note created',
            'data'=>$note
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
