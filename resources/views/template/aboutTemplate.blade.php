@extends('layout.aboutLayout')

@section('header')
    <div class="w-full flex flex-col gap-[10px] mb-[35px]">
        <p class="text-[35px] font-bold leading-[1]" id="about_sec">ABOUT ME</p>
        <p class="bg-blue-500 h-[2px] w-[50px]"></p>
        <p class="text-[14px] tracking-[2px] font-light">AN ASPIRING SOFTWARE DEVELOPER FROM THE PHILIPPINES</p>
    </div>
@endsection

@section('about')
    <div class="flex lg:flex-row flex-col md:gap-10">
        <div class="lg:w-[45%] md:mb-0 mb-[15px] flex justify-center items-center">
            <div class="p-[15px] bg-white shadow-sm rounded-[5px] max-w-sm relative">
                <div class="absolute flex flex-col top-[40px] left-[0px] bg-white p-[8px] gap-2">
                    <a href="https://www.facebook.com/ifejinity" class="px-[6px] bg-blue-500 hover:bg-black" target="_blank"><i class="bi bi-facebook text-[24px] text-white"></i></a>
                    <a href="https://www.linkedin.com/in/jeffrey-lonzanida-700559253/" class="px-[6px] bg-blue-500 hover:bg-black" target="_blank"><i class="bi bi-linkedin text-[24px] text-white"></i></a>
                    <a href="https://github.com/ifejinity" class="px-[6px] bg-blue-500 hover:bg-black" target="_blank"><i class="bi bi-github text-[24px] text-white"></i></a>
                    <a href="" class="px-[6px] bg-blue-500 hover:bg-black" target="_blank"><i class="bi bi-tiktok text-[24px] text-white"></i></a>
                </div>
                <img src="{{ asset('assets/about.jpg') }}" alt="" srcset="">
            </div>
        </div>
        <div class="lg:w-[55%]">
            <p class="text-[30px] font-[600] mb-[10px] leading-[1.1]">I'M Jeffrey Lonzanida</p>
            <p class="mb-[20px] text-[18px] font-[400]">An aspiring <span class="text-blue-500">Software Developer</span> from the <span class="text-blue-500">Philippines</span></p>
            <p class="text-[15px] text-gray-600 mb-[16px]">I completed my Bachelor of Science in Information Technology at the University of Rizal System Binangonan Campus. Throughout my college journey, I maintained a consistent presence on the Dean's List and received a Cum Laude award, demonstrating my dedication to academic excellence. I’m very hard-working person, attentive, optimistic, flexible, computer literate, and I'm enthusiastic to learn new things.</p>
            <div class="flex sm:flex-row flex-col w-full 2xl:gap-2 justify-evenly">
                <div class="lg:w-1/2">
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Birthday</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">08th January 2001</p>
                    </div>
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Age</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">22 Yr</p>
                    </div>
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Residence</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">Philippines</p>
                    </div>
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Address</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">Taytay, Rizal, Philippines</p>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">E-mail</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">mrlonzanida08@gmail.com</p>
                    </div>
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Phone</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">09305303720</p>
                    </div>
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Facebook</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">Jeffrey Lonzanida</p>
                    </div>
                    <div class="grid grid-cols-[1fr, 2fr] leading-[1] text-[14px] py-[6px]">
                        <p class="font-medium">Freelance</p>
                        <p class="border-l-[1px] border-gray-400 pl-[15px] text-gray-600">Available</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection