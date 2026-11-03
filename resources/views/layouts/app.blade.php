
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pesanan Laundry')</title>
</head>
<body>

    <h1>Sistem Pesanan Laundry</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @yield('content')

    @if (session('error'))
    <p>{{ session('error') }}</p>
    @endif

</body>
</html>
