<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si APPEM - Sistem Pendaftaran Magang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="flex justify-end space-x-4 px-10 py-2 text-gray-400 text-sm">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
    </div>

    <nav class="flex justify-between items-center px-10 py-4 border-b border-gray-100">
        <div class="flex items-center space-x-2">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Logo_Kabupaten_Bekasi.png" alt="Logo" class="h-12">
        </div>
        <div class="hidden md:flex space-x-8 items-center text-sm font-semibold tracking-wide uppercase">
            <a href="#" class="text-cyan-500">Home</a>
            <a href="#" class="text-gray-600 hover:text-cyan-500">Formasi Tersedia</a>
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-cyan-500">Login</a>
            <a href="#" class="text-gray-600 hover:text-cyan-500">User Manual</a>
            <button class="text-cyan-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></button>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-10 py-16 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 space-y-6">
            <h1 class="text-6xl font-bold text-gray-700">Si APPEM</h1>
            <p class="text-2xl text-gray-500 font-light tracking-wide">
                Sistem Aplikasi Pendaftaran & <br> Perijinan Magang
            </p>
            <div class="pt-6">
                <a href="{{ route('register') }}" class="inline-block border-2 border-cyan-400 text-cyan-500 px-10 py-3 rounded-md font-semibold tracking-widest hover:bg-cyan-400 hover:text-white transition uppercase text-sm">
                    Registrasi Akun
                </a>
            </div>
        </div>

        <div class="md:w-1/2 mt-12 md:mt-0">
            <img src="https://ouch-cdn2.icons8.com/V9X9eS6hK07PjP95KAn21yI-G7E6m3M2h6m6q0p9S6Y/rs:fit:450:450/czM6Ly9pY29uczgu/b3VjaC1wcm9kLmFz/c2V0cy9zdmcvNzQ0/L2Q5Njc3Yjg3LTlk/MzgtNDVkOS05ZjEw/LTI4YjQ5MmZkZjY5/NC5zdmc.png" alt="Illustration" class="w-full h-auto">
        </div>
    </main>

</body>
</html>