<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssueController extends Controller
{
    private $issues = [
        1 => ['id' => 1, 'title' => 'Issue 1', 'description' => 'Description for Issue 1'],
        2 => ['id' => 2, 'title' => 'Issue 2', 'description' => 'Description for Issue 2']
    ];

    public function create(Request $request)
    {
        \Log::info('Create operation:', $request->all());
        return response()->json(['message' => 'Created successfully'], 201);
    }

    public function read($id)
    {
        if (isset($this->issues[$id])) {
            return response()->json($this->issues[$id]);
        } else {
            return response()->json(['message' => 'Issue not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        \Log::info('Update operation:', ['id' => $id, 'data' => $request->all()]);
        return response()->json(['message' => 'Updated successfully']);
    }

    public function delete($id)
    {
        \Log::info('Delete operation:', ['id' => $id]);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
