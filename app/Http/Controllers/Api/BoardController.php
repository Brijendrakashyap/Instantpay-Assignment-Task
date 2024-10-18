<?php

// app/Http/Controllers/BoardController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    // Retrieve all boards belonging to the authenticated user
    public function index()
    {
        return response()->json(auth()->user()->boards);
    }

    // Store a new board
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
       
        // Create a new board for the authenticated user, using the provided title and associating it with the current user's ID
        $board = auth()->user()->boards()->create([
            'title' => $request->title,
            'user_id' => auth()->id(),
        ]);

        return response()->json($board, 201);
    }

    // Display a specific board
    public function show(Board $board)
    {
        if ($board->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($board);
    }

    // Update an existing board
    public function update(Request $request, Board $board)
    {
        // Check if the board belongs to the currently authenticated user
        if ($board->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $board->update([
            'title' => $request->title,
        ]);

        return response()->json($board, 200);
    }

    // Delete a board
    public function destroy(Board $board)
    {
        // Check if the board belongs to the currently authenticated user
        if ($board->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $board->delete();
        return response()->json(['message' => 'Board deleted'], 200);
    }
}
