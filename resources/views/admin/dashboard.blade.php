@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container"> 
    <h2 class="text-white bg-clip-padding">Submitted Issues</h2>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Module</th>
                    <th scope="col" class="px-6 py-3">Issue Type</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3">Priority</th>
                    <th scope="col" class="px-6 py-3">Due Date</th>
                    <th scope="col" class="px-6 py-3">Time Left</th>
                    <th scope="col" class="px-6 py-3">Assigned User</th>
                </tr>
            </thead>
            <tbody id="issue-table-body">
                @foreach ($issues as $issue)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4">{{ $issue->module }}</td>
                    <td class="px-6 py-4">{{ $issue->issue_type }}</td>
                    <td class="px-6 py-4">{{ $issue->description }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ asset('storage/' . $issue->img) }}" target="_blank">
                            <img src="{{ asset('storage/' . $issue->img) }}" alt="Issue Image" width="100">
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('update.issue', $issue->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="priority" class="form-select" onchange="this.form.submit()">
                                <option value="high" {{ $issue->priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="medium" {{ $issue->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="low" {{ $issue->priority == 'low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4">{{ $issue->due_date }}</td>
                    <td class="px-6 py-4">
                        @if($issue->due_date)
                            @php
                                $hoursLeft = \Carbon\Carbon::now()->diffInHours($issue->due_date);
                                $days = floor($hoursLeft / 24);
                                $hours = $hoursLeft % 24;
                            @endphp
                            @if($days > 0)
                                {{ $days }} day{{ $days > 1 ? 's' : '' }} {{ $hours }} hour{{ $hours !== 1 ? 's' : '' }} left
                            @else
                                {{ $hours }} hour{{ $hours !== 1 ? 's' : '' }} left
                            @endif
                        @else
                            No due date set
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('assign.user', $issue->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="assigned_user_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $issue->assigned_user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    // Initialize Pusher
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });
    const channel = pusher.subscribe('issues');
    channel.bind('App\\Events\\IssueSubmitted', (data) => {
        console.log('Received data from Pusher:', data); // Log the incoming data with more context
        // Log additional Pusher info
        console.log('Pusher Event:', data.event);
        console.log('Pusher Channel:', data.channel);
        // Update the dashboard with the new issue data
        const newRow = `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
            <td class="px-6 py-4">${data.issue.module}</td>
            <td class="px-6 py-4">${data.issue.issue_type}</td>
            <td class="px-6 py-4">${data.issue.description}</td>
            <td class="px-6 py-4">
                <a href="${data.issue.img}" target="_blank">
                    <img src="${data.issue.img}" alt="Issue Image" width="100">
                </a>
            </td>
            <td class="px-6 py-4">${data.issue.priority}</td>
            <td class="px-6 py-4">${data.issue.due_date}</td>
            <td class="px-6 py-4">Time Left</td>
            <td class="px-6 py-4">Assigned User</td>
        </tr>`;
        document.getElementById('issue-table-body').insertAdjacentHTML('beforeend', newRow);
    });
</script>

