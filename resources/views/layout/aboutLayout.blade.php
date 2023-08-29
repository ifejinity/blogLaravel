<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeffrey Lonzanida | About me</title>
    @include('partials.__cdn')
</head>
<body class="w-full min-h-screen md:px-[10%] px-[5%] bg-cover bg-center bg-[url({{asset('assets/bg.png')}})] flex flex-col items-center font-[outfit] select-none">
    <div class="flex flex-col justify-center w-full items-center mt-[50px]" id="about">
        <div class="w-full flex flex-col max-w-[1440px]">
            <a href="{{ route('index') }}" class="btn btn-info w-fit self-end">Back</a>
            {{-- header --}}
            @yield('header')
            {{-- about --}}
            @yield('about')
        </div>
    </div>
</body>
</html>