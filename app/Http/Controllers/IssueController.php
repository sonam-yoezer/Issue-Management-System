<?php

namespace App\Http\Controllers;

use App\Models\Issues;
use App\Events\IssueSubmitted;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function submit(Request $request)
    {

      
        // Validate the request data
        $validatedData = $request->validate([
            'module' => 'required|string',
            'issue_type' => 'required|string',
            'description' => 'required|string',
            'img' => 'required|image',
            'priority' => 'required|string',
            'due_date' => 'nullable|date',
            'description' => 'nullable|string|max:180', 
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'priority' => 'nullable|string|in:high,medium,low', 
            'assigned_user_id' => 'nullable|exists:users,id', 
        ]);

        // Handle File Upload
        if ($request->hasFile('img')) {
            $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
            $filePath = $request->file('img')->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = null;
        }

        // Check for duplicate issue
        $existingIssue = Issues::where('module', $validatedData['module'])
            ->where('issue_type', $validatedData['issue_type'])
            ->where('description', $validatedData['description'])
            ->first();

        if ($existingIssue) {
            \Log::warning('Duplicate issue detected', [
                'existing_id' => $existingIssue->id,
                'module' => $validatedData['module'],
                'issue_type' => $validatedData['issue_type'],
                'description' => $validatedData['description']
            ]);
            return redirect()->back()->with('error', 'A similar issue already exists!');
        }

        // Save Issue to Database
        $issues = new Issues();
        $issues->module = $validatedData['module'];
        $issues->issue_type = $validatedData['issue_type'];
        $issues->description = $validatedData['description'];
        $issues->img = $filePath; // Save file path in the database
        $issues->priority = $validatedData['priority'] ?? 'medium'; // Default to 'medium'
        $issues->assigned_user_id = $validatedData['assigned_user_id'] ?? null; // Default to null if not provided
        $issues->save();


        // Log issue submission details
        \Log::info('Issue submitted', [
            'id' => $issues->id,
            'module' => $issues->module,
            'issue_type' => $issues->issue_type,
            'priority' => $issues->priority,
            'assigned_user_id' => $issues->assigned_user_id,
            'timestamp' => now(),
        ]);

        // Broadcast the event only if authenticated
        \Log::info('Broadcasting the IssueSubmitted event for issue ID: ' . $issues->id);
        broadcast(new IssueSubmitted($issues)); // Broadcast the event

        // Redirect with Success Message and include issue details
        return redirect()->back()->with('success', 'Issue submitted successfully!')->with('issue', $issues);
    }








    public function assignUser(Request $request, $id) 
    {
        $validated = $request->validate([
            'assigned_user_id' => 'nullable|exists:users,id', 
        ]);

        $issue = Issues::findOrFail($id); 
        $issue->assigned_user_id = $validated['assigned_user_id']; 
        $issue->save(); 

        return redirect()->back()->with('success', 'User assigned successfully!'); 
    }

    public function update(Request $request, $id) // Method to update an existing issue
    {
        \Log::info('Update request data:', $request->all()); // Log incoming request data for debugging
        $validated = $request->validate([
            'module' => 'nullable|string|max:100',
            'issue_type' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:180', 
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'priority' => 'required|string|in:high,medium,low', // Validate priority
            'assigned_user_id' => 'nullable|exists:users,id', // Validate assigned user
        ]);

        $issue = Issues::findOrFail($id); // Find the issue by ID
        if (isset($validated['module'])) {
            $issue->module = $validated['module'];
        }
        if (isset($validated['issue_type'])) {
            $issue->issue_type = $validated['issue_type'];
        }
        if (isset($validated['description'])) {
            $issue->description = $validated['description'];
        }
        
        // Handle File Upload
        if ($request->hasFile('img')) {
            $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
            $filePath = $request->file('img')->storeAs('uploads', $fileName, 'public');
            $issue->img = $filePath; // Save file path in the database
        }

        if (isset($validatedData['priority'])) {
            $issue->priority = $validatedData['priority']; // Update priority
        }
        if (isset($validatedData['assigned_user_id'])) {
            $issue->assigned_user_id = $validatedData['assigned_user_id']; // Update assigned user
        }
        
        $issue->save(); // Save changes

        return redirect()->back()->with('success', 'Issue updated successfully!'); // Redirect with success message
    }

}
