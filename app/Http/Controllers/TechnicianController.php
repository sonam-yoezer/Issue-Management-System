<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issues;
use Illuminate\Support\Facades\Auth;



class TechnicianController extends Controller
{
    public function showIssue()
    {
        // Fetch the logged-in technician's issues
        $issues = Issues::where('assigned_user_id', Auth::id())->get();

        return view('technician.issues', compact('issues'));
    }
 public function index()
 {
    $solvedIssues = Issues::where('status', 'solved')->count();
    $issuesInProgress = Issues::where('status', 'in-progress')->count();
    $pendingIssues = Issues::where('status', 'pending')->count();
    $totalIssues = Issues::count();

    return view('technician.dashboard', compact('solvedIssues', 'issuesInProgress', 'pendingIssues','totalIssues'));
}
 public function updateStatus(Request $request, $id) {
    $issues = Issues::findOrFail($id);
    $issues->status = $request->status;
    $issues->save();

    return back()->with('success', 'Issue status updated successfully!');
}

private function getSolvedIssuesCount() {
    $sql = "SELECT COUNT(*) AS count FROM issues WHERE status = 'solved'";
    $result = $this->db->query($sql);
    return $result->fetch()['count'];
}

private function getIssuesInProgressCount() {
    $sql = "SELECT COUNT(*) AS count FROM issues WHERE status = 'in_progress'";
    $result = $this->db->query($sql);
    return $result->fetch()['count'];
}

private function getPendingIssuesCount() {
    $sql = "SELECT COUNT(*) AS count FROM issues WHERE status = 'pending'";
    $result = $this->db->query($sql);
    return $result->fetch()['count'];
}

}
