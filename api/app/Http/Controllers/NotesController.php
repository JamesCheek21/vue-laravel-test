<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Http\Requests\NotesStoreRequest;
use App\Http\Requests\NotesUpdateRequest;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Notes::all();
        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotesStoreRequest $request)
    {
        $data = $request->validated();

        $note = Notes::create($data);

        return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Notes::findOrFail($id);
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotesUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        $note = Notes::findOrFail($id);
        $note->update($data);

        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Notes::findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }
}
