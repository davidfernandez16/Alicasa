<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ALICASA')</title>

</head>
<body>

    @include('partials.barra')

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- JavaScript de Bootstrap por CDN -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+JjwXUFUepPvmjIx+PVaCcfQfK2jG"
      crossorigin="anonymous"
    ></script>
</body>
</html>
