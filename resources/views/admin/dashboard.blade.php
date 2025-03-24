<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col font-sans h-screen">
    
    <!-- Top Navbar -->
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <div class="text-white text-lg font-semibold">Admin Dashboard</div>
        <div class="flex items-center gap-4">
            <input type="text" placeholder="Search..." class="p-2 rounded-lg border border-gray-300 focus:outline-none">
            <img src="{{ asset('storage/admin.jpg') }}" alt="Admin Image" class="w-10 h-10 rounded-full border-2 border-white">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <div class="flex flex-1">
        <aside class="w-64 bg-gray-800 text-white p-5 h-screen">
            <div class="text-center p-2 border-b">
                <p></p>
            </div>
            <ul class="list-none p-8 text-lg font-bold">
                <li class="p-2 hover:bg-gray-700"><a href="{{ route('admin.user') }}">Registered Users</a></li>
                <li class="p-2 hover:bg-gray-700"><a href="{{ route('admin.dashboard') }}">Issue Reported</a></li>
            </ul>
        </aside>
        
        <div class="flex-1 p-5 bg-gray-100 overflow-auto">
            <header class="mb-5">
                <h1 class="text-2xl font-semibold">Issues Reported</h1>
            </header>
            
            <!-- Issues Table -->
            <div class="container mt-4"> 
                <!-- <h2 class="text-gray-800 font-semibold text-lg mb-4">Submitted Issues</h2> -->
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Module</th>
                                <th class="px-6 py-3">Issue Type</th>
                                <th class="px-6 py-3">Description</th>
                                <th class="px-6 py-3">Image</th>
                                <th class="px-6 py-3">Priority</th>
                                <th class="px-6 py-3">Due Date</th>
                                <th class="px-6 py-3">Time Left</th>
                                <th class="px-6 py-3">Assigned User</th>
                            </tr>
                        </thead>
                        <tbody id="issue-table-body">
                            @foreach ($issues as $issue)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $issue->module }}</td>
                                <td class="px-6 py-4">{{ $issue->issue_type }}</td>
                                <td class="px-6 py-4">{{ $issue->description }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ asset('storage/' . $issue->img) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $issue->img) }}" alt="Issue Image" width="100">
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{ $issue->priority }}</td>
                                <td class="px-6 py-4">{{ $issue->due_date }}</td>
                                <td class="px-6 py-4">Time Left</td>
                                <td class="px-6 py-4">Assigned User</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function loadUsers() {
        fetch("{{ route('admin.user') }}")
            .then(response => response.text())
            .then(data => {
                document.getElementById('dashboard-content').innerHTML = data;
            })
            .catch(error => console.error('Error loading users:', error));
    }
</script>