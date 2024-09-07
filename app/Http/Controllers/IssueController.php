<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::all();
        return response()->json($issues);
    }

    public function create(Request $request)
    {
        $issue = Issue::create($request->all());
        \Log::info('Create operation:', $issue->toArray());
        return response()->json($issue, 201);
    }

    public function update(Request $request, $id)
    {
        $issue = Issue::find($id);

        if ($issue) {
            $issue->update($request->all());
            \Log::info('Update operation:', $issue->toArray());
            return response()->json($issue);
        } else {
            return response()->json(['message' => 'Issue not found'], 404);
        }
    }

    public function delete($id)
    {
        $issue = Issue::find($id);

        if ($issue) {
            $issue->delete();
            \Log::info('Delete operation:', ['id' => $id]);
            return response()->json(['message' => 'Deleted successfully']);
        } else {
            return response()->json(['message' => 'Issue not found'], 404);
        }
    }
}
