<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col font-sans h-screen">
<div class="max-w-5xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-md border border-gray-300">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">Edit User</h2>
    
    <form action="{{ route('update.user', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                   class="w-full p-3 border border-gray-300 rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="w-full p-3 border border-gray-300 rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.user') }}" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>

</body>
</html>