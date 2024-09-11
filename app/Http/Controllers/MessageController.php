<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use Illuminate\Http\Request;

use function React\Promise\all;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $test = 'test api jalan';
        return response()->json([$test]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari request
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'sender_id' => 'required|string',
            'group_id' => 'nullable|string',
            'receiver_id' => 'nullable|string',
        ]);

        // Jika validasi lulus, simpan pesan
        $message = MessageModel::create($validated);

        // Kembalikan respons JSON
        return response()->json([
            'message' => "Message {$message->id} saved",
            'data' => $message
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
