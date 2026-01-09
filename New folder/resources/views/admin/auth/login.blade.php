<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />

    <title>Đăng nhập quản trị</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-orange-400 to-yellow-300">
        <div class="w-full max-w-sm p-8 bg-white rounded-2xl shadow-2xl">
            <h2 class="text-3xl font-bold text-center text-orange-500 mb-6">Đăng nhập</h2>

            <form action="{{ route('admin.dologin') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" required
                        class="mt-1 block w-full px-4 py-2 text-black border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700">Mật khẩu</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember"
                        class="text-orange-500 focus:ring-orange-400 border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-300">Đăng
                    nhập</button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">Hoặc đăng nhập bằng</div>

            <div class="mt-4 flex justify-center space-x-4">
                <button
                    class="flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm hover:bg-orange-100 transition duration-300">
                    <img src="https://img.icons8.com/color/16/000000/facebook-new.png" class="mr-2" />
                    Facebook
                </button>
                <button
                    class="flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm hover:bg-orange-100 transition duration-300">
                    <img src="https://img.icons8.com/color/16/000000/google-logo.png" class="mr-2" />
                    Google
                </button>
            </div>
        </div>
    </div>

    @include('admin.notifications')
</body>


</html>
