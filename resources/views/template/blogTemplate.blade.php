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
            <img src="{{ asset('images/'.$blogs['image']) }}" alt="" srcset="" class="max-w-md w-full self-start">
        </div>
        <div class="flex justify-center items-center">
            <p class="text-justify indent-10">{{ $blogs['content'] }}</p>
        </div>
    </div>
@endsection

@section('comment')
    <form class="w-full flex flex-col gap-5 border-t-[1px] border-gray-200 pt-2 sticky top-0 bg-white p-5 shadow-md z-[3]" enctype="multipart/form-data" id="addCommentForm">
        <h1 >Write a comment</h1>
        <div class="flex flex-col gap-2">
            <input type="hidden" name="blogId" value="{{ $blogs['id'] }}">
            <textarea name="text" cols="30" rows="3" class="textarea textarea-bordered resize-none w-full" placeholder="Write your comment here"></textarea>
            <p class="text-[14px] text-red-500" id="errorText"></p>
            <div class="flex justify-between">
                <div class="flex flex-col gap-2">
                    <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" />
                    <p class="text-[14px] text-red-500" id="errorImage"></p>
                </div>
                <button type="submit" class="btn btn-info btn-active" id="createComment">Send</button>
            </div>
        </div>
    </form>
    <div class="w-full px-[5%] flex flex-col gap-5" id="comments">
        @foreach ($comments as $item)
            <div class="w-full p-5 bg-white shadow-md rounded-md flex flex-col gap-3 relative">
                <details class="dropdown dropdown-end mb-32 absolute right-2 top-2">
                    <summary class="m-1 btn btn-error btn-active"><i class="bi bi-trash text-[20px]"></i></summary>
                    <div class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                        <li><button type="button" value="{{ $item['id'] }}" class="delete">Proceed</button></li>
                    </div>
                </details>
                <p class="text-info">@Anonymous</p>
                <p>{{ $item['text'] }}</p>
                <div class="w-full flex justify-center items-center">
                    <img src="{{ asset('images/'.$item['image']) }}" alt="" srcset="" class="w-full max-w-[500px] md:h-[500px] h-[300px] object-cover">
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('creatingComment')
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="creating">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="{{ asset('assets/edit.gif') }}" alt="" srcset="">
            <p class="w-fit self-end">Creating comment <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
@endsection

@section('deletingComment')
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="deleting">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="{{ asset('assets/bin.gif') }}" alt="" srcset="">
            <p class="w-fit self-end">Deleting Comment <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
@endsection