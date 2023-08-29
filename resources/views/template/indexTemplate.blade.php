@extends('layout.indexLayout')

@section('blogs')
    <div class="w-full max-w-[1440px] flex justify-center items-center flex-col gap-10 mt-[50px]">
        <a href="{{ route('about') }}" class="btn btn-info top-[24px] right-[24px] self-end">About me</a>
        <div class="w-full flex flex-col gap-[10px] mb-[15px]">
            <p class="text-[35px] font-bold leading-[1]" id="about_sec">BLOGS</p>
            <p class="bg-blue-500 h-[2px] w-[50px]"></p>
            <p class="text-[14px] tracking-[2px] font-light">CHASING DREAMS AND EMBRACING PASSIONS</p>
        </div>
        <div class="w-full flex gap-10 flex-wrap justify-center" id="blogs">
            @foreach ($myBlogs as $blogItem)
                <div class="card w-full max-w-[350px] bg-base-100 shadow-xl hover:-translate-y-2 duration-200 relative overflow-clip">
                    <details class="dropdown mb-32 absolute left-2 top-2">
                        <summary class="m-1 btn btn-error btn-active"><i class="bi bi-trash text-[20px]"></i></summary>
                        <div class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                            <li><button type="button" value="{{ $blogItem['id'] }}" class="delete">Proceed</button></li>
                        </div>
                    </details>
                    <figure>
                        <img src="{{ asset('/images/' . $blogItem['image']) }}" alt="" class="w-full h-full max-h-[300px] max-w-[350px] object-cover"/>
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $blogItem['title'] }}</h2>
                        <p>{{ $blogItem['description'] }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('read', $blogItem['id']) }}" class="btn btn-info read">Read</a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (count($myBlogs) <= 0) 
                <div>
                    <p class="text-gray-300 text-900 text-[40px]" id="noBlog">NO BLOGS</p>
                </div>
            @endif
        </div>
    </div>
    <button id="showAddBlogModal" class="btn btn-info btn-active fixed bottom-[24px] right-[24px]">Add Blog</button>
@endsection

@section('modalAddBlog')
    <div class="w-full min-h-screen bg-black/30 fixed justify-center items-center hidden" id="modalAddBlog">
        <form id="addBlogForm" class="modal-box max-w-[600px]" enctype="multipart/form-data">
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" id="hideAddBlogModal">✕</button>
            <h3 class="font-bold text-lg">Post a Blog</h3>
            <div class="flex flex-col gap-2 mt-5">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Blog Image</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered w-full" name="image"/>
                </div>
                <p class="text-[14px] text-red-500" id="errorImage"></p>
                <input type="text" class="input input-bordered w-full" placeholder="Blog Title" name="title">
                <p class="text-[14px] text-red-500" id="errorTitle"></p>
                <input type="text" class="input input-bordered w-full" placeholder="Blog Description" name="description">
                <p class="text-[14px] text-red-500" id="errorDescription"></p>
                <textarea cols="30" rows="5" class="textarea textarea-bordered resize-none" placeholder="Blog Content" name="content"></textarea>
                <p class="text-[14px] text-red-500" id="errorContent"></p>
                <button type="submit" class="btn btn-info btn-active" id="postBlog">Post</button>
            </div>
        </form>
    </div>
@endsection

@section('creatingBlog')
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="creating">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="{{ asset('assets/edit.gif') }}" alt="" srcset="">
            <p class="w-fit self-end">Creating Blog <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
@endsection

@section('deletingBlog')
    <div class="w-full fixed min-h-screen bg-black/30 hidden justify-center items-center z-[3] top-0" id="deleting">
        <div class="w-full max-w-[300px] rounded-xl overflow-clip flex justify-center flex-col bg-white p-5">
            <img src="{{ asset('assets/bin.gif') }}" alt="" srcset="">
            <p class="w-fit self-end">Deleting Blog <span class="loading loading-spinner loading-xs"></span></p>
        </div>
    </div>
@endsection