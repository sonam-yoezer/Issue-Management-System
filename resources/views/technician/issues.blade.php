@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-80 bg-gray-800 text-white p-5">
        
        <ul class="list-none p-8 text-lg font-bold space-y-4">
            <li class="p-2 hover:bg-gray-700 rounded">
                <a href="{{ route('technician.dashboard') }}">Dashboard</a>
            </li>
            <li class="p-2 hover:bg-gray-700 rounded">
                <a href="{{ route('technician.issues') }}">Issue Report</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-8">

        <!-- Assigned Issues Section -->
        <section>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assigned Issues</h2>

            @if ($issues->isEmpty())
                <p class="text-gray-600">No issues assigned to you at the moment.</p>
            @else
                <div class="space-y-6">
                    @foreach ($issues as $issue)
                        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
                            
                            <!-- Image at the top -->
                            @if ($issue->img)
                                <div class="w-full flex justify-left mb-4">
                                    <img src="{{ asset('storage/' . $issue->img) }}" 
                                         alt="Issue Image" 
                                         class="w-60 h-60 object-cover rounded-lg border-4">
                                </div>
                            @endif

                            <!-- Issue Details -->
                            <div class="space-y-2">
                                <p><strong>Module:</strong> <span class="text-blue-600">{{ $issue->module }}</span></p>
                                <p><strong>Issue Type:</strong> {{ $issue->issue_type }}</p>
                                <p><strong>Description:</strong> {{ $issue->description }}</p>
                                <p><strong>Priority:</strong> <span class="font-semibold">{{ ucfirst($issue->priority) }}</span></p>
                                <p><strong>Reported On:</strong> <span class="text-sm text-gray-500">{{ $issue->created_at->format('M d, Y') }}</span></p>

                                <!-- Status Dropdown -->
                                <form action="{{ route('update.issue.status', $issue->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                                    <select name="status" id="status" class="mt-1 block w-60 p-2 border border-gray-300 rounded-md" 
                                        onchange="this.form.submit()">
                                        <option value="pending" {{ $issue->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in-progress" {{ $issue->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="solved" {{ $issue->status === 'solved' ? 'selected' : '' }}>Solved</option>
                                    </select>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
