<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report an Issue</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Issue Report Form </h2>
        @if(session('success'))
            <div id="success-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-md shadow-lg w-96 text-center">
                    <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
                    <h3 class="text-lg font-semibold text-green-700">Issue submitted successfully!</h3>
                    <button id="close-modal" class="mt-4 px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                        OK
                    </button>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('submit.issue') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="module" class="block text-sm font-medium text-gray-700">Module:</label>
                <select id="module" name="module" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="user-management">User Management</option>
                    <option value="payment-processing">Payment Processing</option>
                    <option value="dashboard">Dashboard</option>
                    <option value="system-performance">System Performance</option>
                    <option value="notifications">Notifications</option>
                    <option value="account-settings">Account Settings</option>
                    <option value="update">Updates & Patches</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="issue_type" class="block text-sm font-medium text-gray-700">Issue Type:</label>
                <select id="issue_type" name="issue_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="bug">Bug</option>
                    <option value="feature">Feature Request</option>
                    <option value="performance">Performance Issue</option>
                    <option value="payment">Payment Failure</option>
                    <option value="syste_crashing">System Crashing</option>
                    <option value="form-submission">Form Submision Error</option>
                    <option value="page-loading">Page Not Loading</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Issue Description:</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
            </div>

            <div class="mb-4">
                <label for="img" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 p-2 rounded-md">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                    Submit Issue
                </button>
            </div>
        </form>
    <script>
        const closeModalButton = document.getElementById('close-modal');
        if (closeModalButton) {
            closeModalButton.addEventListener('click', () => {
                document.getElementById('success-modal').style.display = 'none';
                document.querySelector('form').reset();
            });
        }
    </script>
</body>
</html>
