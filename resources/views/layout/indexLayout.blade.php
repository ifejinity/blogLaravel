<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeffrey Lonzanida</title>
    @include('partials.__cdn')
</head>
<body class="w-full min-h-screen md:px-[10%] px-[5%] bg-cover bg-center bg-[url({{asset('assets/bg.png')}})] flex flex-col items-center font-[outfit] select-none">
    {{-- blog section --}}
    @yield('blogs')
    @yield('modalAddBlog')
    <script>

    </script>
</body>
</html>