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
            <ul class="list-none p-8 text-lg font-bold">
                <li class="p-2 hover:bg-gray-700"><a href="{{ route('admin.user') }}">Registered Users</a></li>
                <li class="p-2 hover:bg-gray-700"><a href="{{ route('admin.dashboard') }}">Issue Reported</a></li>
            </ul>
        </aside>
        
        <div class="flex-1 p-5 bg-gray-100 overflow-auto">
            <header class="mb-5">
                <h1 class="text-2xl font-semibold">Registered Users</h1>
            </header>

            <div class="container max-w-5xl mx-auto mt-4"> 
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-700 border border-gray-300 border-collapse">
                        <thead class="text-xs uppercase bg-gray-200 border-b border-gray-300">
                            <tr>
                                <th class="px-6 py-3 border border-gray-300">ID</th>
                                <th class="px-6 py-3 border border-gray-300">Name</th>
                                <th class="px-6 py-3 border border-gray-300">Email</th>
                                <th class="px-6 py-3 border border-gray-300 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="bg-white border-b border-gray-300 hover:bg-gray-50">
                                <td class="px-6 py-4 border border-gray-300">{{ $user->id }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $user->name }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4 border border-gray-300 text-center">
                                    <div class="flex justify-center items-center space-x-4">
                                        <a href="{{ route('edit.user', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">Update</a>
                                        <form action="{{ route('delete.user', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Delete</button>
                                        </form>
                                    </div>
                                </td>
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
