<?php

namespace App\Http\Controllers;

use App\Models\Issues; // Correct import for the Issue model
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function submit(Request $request)
    {
        // Validate Form Data
        $validated = $request->validate([
            'module' => 'required|string|max:100',
            'issue_type' => 'required|string|max:200',
            'priority' => 'required|string|in:high,medium,low',
            'description' => 'required|string|max:180', 
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // Handle File Upload
        if ($request->hasFile('img')) {
            $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
            $filePath = $request->file('img')->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = null;
        }

        // Save Issue to Database
        $issues = new Issues();
        $issues->module = $validated['module'];
        $issues->issue_type = $validated['issue_type'];
        $issues->priority = $validated['priority'];
        $issues->description = $validated['description'];
        $issues->img = $filePath; // Save file path in the database
        $issues->save();

        // Redirect with Success Message
        return redirect()->back()->with('success', 'Issue submitted successfully!');
    }
}
