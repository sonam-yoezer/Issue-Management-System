@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-80 bg-gray-800 text-white p-5">
        
        <ul class="list-none p-8 text-lg font-bold space-y-4">
            <li class="p-2 hover:bg-gray-700 rounded"><a href="{{route('technician.dashboard')}}">Dashboard</a></li>
            <li class="p-2 hover:bg-gray-700 rounded">
                <a href="{{ route('technician.issues') }}">Issue Report</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
            <div class="bg-green-500 p-6 rounded-lg shadow-md">
                <h2 class="font-semibold text-xl">Solved Issues</h2>
                <p class="text-2xl">{{ $solvedIssues }}</p>
            </div>

            <div class="bg-yellow-500 p-6 rounded-lg shadow-md">
                <h2 class="font-semibold text-xl">Issues In Progress</h2>
                <p class="text-2xl">{{ $issuesInProgress }}</p>
            </div>
            <div class="bg-red-500 p-6 rounded-lg shadow-md">
                <h2 class="font-semibold text-xl">Pending Issues</h2>
                <p class="text-2xl">{{ $pendingIssues }}</p>
            </div>

            <div class="bg-blue-500 p-6 rounded-lg shadow-md">
                <h2 class="font-semibold text-xl">Total Issue Report</h2>
                <p class="text-2xl">{{ $totalIssues }}</p>

            </div>
        </div>
    </div>
</div>
@endsection
