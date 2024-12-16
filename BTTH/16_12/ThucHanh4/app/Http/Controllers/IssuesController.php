<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computers;
use App\Models\Issues;

class IssuesController extends Controller
{

    public function index()
    {
        $issues = Issues::with('computer')->get();
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        $computers = Computers::all();
        return view('issues.create', compact('computers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        Issues::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm mới.');
    }

    public function edit($id)
    {
        $issue = Issues::findOrFail($id);
        $computers = Computers::all();

        return view('issues.edit', compact('issue', 'computers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        $issue = Issues::findOrFail($id);
        $issue->update($request->all());

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được cập nhật.');
    }


    public function destroy($id)
    {
        $issue = Issues::findOrFail($id);
        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa.');
    }
}

