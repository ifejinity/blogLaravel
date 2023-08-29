@extends('layout.blogLayout')

@section('header')
    <div class="w-full flex flex-col gap-[10px] mb-[15px]">
        <p class="text-[35px] font-bold leading-[1]" id="about_sec">{{ $blogs['title'] }}</p>
        <p class="bg-blue-500 h-[2px] w-[50px]"></p>
        <p class="text-[14px] tracking-[2px] font-light uppercase">{{ $blogs['description'] }}</p>
    </div>
@endsection

@section('content')
    <div class="w-full flex flex-col gap-10">
        <div class="flex justify-center items-center">
            <img src="{{ asset($blogs['image']) }}" alt="" srcset="" class="max-w-md w-full self-start">
        </div>
        <div class="flex justify-center items-center">
            <p class="text-justify indent-10">{{ $blogs['content'] }}</p>
        </div>
    </div>
@endsection

@section('comment')
    <form action="{{ route('upload') }}" method="POST" class="w-full flex flex-col gap-5 border-t-[1px] border-gray-200 pt-2 px-[5%]" enctype="multipart/form-data">
        @csrf
        <h1 >Write a comment</h1>
        <div class="flex flex-col gap-2">
            <textarea name="comment" cols="30" rows="3" class="textarea textarea-bordered resize-none w-full" placeholder="Write your comment here"></textarea>
            @error('comment')
                <p class="text-red-500 text-[14px]">{{ $message }}</p>
            @enderror
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" />
                    @error('image')
                        <p class="text-red-500 text-[14px]">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-info btn-active">Send</button>
            </div>
        </div>
    </form>
    @if(session('comments'))
        <div class="w-full flex justify-center items-center">
            <form action="{{ route('delete', session('comments')['image']) }}" method="GET" class="flex lg:flex-row flex-col gap-5 bg-white rounded-md shadow-lg p-5 mx-[5%] w-full">
                @csrf
                @if(session('comments')['image'])
                    <img src="{{ asset('images/' . session('comments')['image'])}}" alt="Uploaded Image" class="w-full max-w-[500px]">
                @endif
                <p class="w-full">Comment: {{ session('comments')['comment'] }}</p>
                <button type="submit" class="btn btn-error btn-active">Delete</button>
            </form>
            {{-- toast for success --}}
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
            <script>
                Toastify({
                    text: "Comment posted.",
                    className: "info",
                    style: {
                        background: "#22c55e",
                    }
                    }).showToast();
            </script>
        </div>
    @endif
    {{-- for deletion --}}
    @if (session('messageDel'))
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "{{ session('messageDel') }}",
                className: "info",
                style: {
                    background: "#22c55e",
                }
                }).showToast();
        </script>
    @endif
@endsection