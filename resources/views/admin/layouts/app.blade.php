<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('styles')
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="d-flex min-vh-100">
        @include('admin.layouts.sidebar')

        <div class="flex-grow-1 d-flex flex-column">
            @include('admin.layouts.header')

            <main class="flex-grow-1 p-4">
                @yield('content')
            </main>

            @include('admin.layouts.footer')
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    @include('admin.notifications')

</body>

</html>
