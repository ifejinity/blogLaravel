<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeffrey Lonzanida | {{ $blogs['title'] }}</title>
    @include('partials.__cdn')
</head>
<body class="w-full min-h-screen md:px-[10%] px-[5%] bg-cover bg-center bg-[url({{asset('assets/bg.png')}})] flex flex-col items-center font-[outfit] select-none relative">
    <div class="w-full max-w-[1440px] flex justify-center items-center flex-col gap-10 my-[50px]">
        <a href="{{ route('index') }}" class="btn btn-info top-[24px] right-[24px] self-end">Back</a>
        {{-- header --}}
        @yield('header')
        {{-- content --}}
        @yield('content')
        {{-- comment --}}
        @yield('comment')
    </div>
</body>
</html>