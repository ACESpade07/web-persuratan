<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Persuratan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-blue-900 text-white min-h-screen p-4 fixed flex flex-col items-center">

        <!-- Logo -->
        <img src="{{ asset('images/logo.webp') }}" 
             alt="Logo" 
             class="w-28 mb-4 object-contain">

        <!-- Garis -->
        <hr class="w-full border-blue-700 mb-4">

        <!-- Menu -->
        <ul class="w-full">
            <li class="mb-2">
                <a href="/" class="block p-2 rounded hover:bg-blue-700 text-center">Dashboard</a>
            </li>
            <li class="mb-2">
                <a href="/surat-masuk" class="block p-2 rounded hover:bg-blue-700 text-center">Surat Masuk</a>
            </li>
            <li>
                <a href="/surat-keluar" class="block p-2 rounded hover:bg-blue-700 text-center">Surat Keluar</a>
            </li>
        </ul>

    </div>

    <!-- Content -->
    <div class="flex-1 p-6 ml-64">
        <div class="bg-white shadow rounded-lg p-6">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>