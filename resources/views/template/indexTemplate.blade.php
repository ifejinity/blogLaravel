@extends('layout.indexLayout')

@section('blogs')
    <div class="w-full max-w-[1440px] flex justify-center items-center flex-col gap-10 mt-[50px]">
        <a href="{{ route('about') }}" class="btn btn-info top-[24px] right-[24px] self-end">About me</a>
        <div class="w-full flex flex-col gap-[10px] mb-[15px]">
            <p class="text-[35px] font-bold leading-[1]" id="about_sec">BLOGS</p>
            <p class="bg-blue-500 h-[2px] w-[50px]"></p>
            <p class="text-[14px] tracking-[2px] font-light">CHASING DREAMS AND EMBRACING PASSIONS</p>
        </div>
        <div class="flex gap-10 flex-wrap justify-center">
            @foreach ($myBlogs as $blogItem)
                <div class="card w-full max-w-[350px] bg-base-100 shadow-xl hover:-translate-y-2 duration-200">
                    <figure><img src="{{ asset($blogItem['image']) }}" alt="" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $blogItem['title'] }}</h2>
                        <p>{{ $blogItem['description'] }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('blog', $blogItem['id']) }}" class="btn btn-info">Read</a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (count($myBlogs) <= 0) 
                <div>
                    <p class="text-gray-300 text-900 text-[40px]">NO BLOGS</p>
                </div>
            @endif
        </div>
    </div>
    <button id="showAddBlogModal" class="btn btn-info btn-active fixed bottom-[24px] right-[24px]">Add Blog</button>
@endsection

@section('modalAddBlog')
    <div class="w-full min-h-screen bg-black/30 fixed flex justify-center items-center">
        <form method="dialog" class="modal-box max-w-[600px]">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            <h3 class="font-bold text-lg">Post a Blog</h3>
            <div class="flex flex-col gap-2 mt-5">
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Blog Image</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered w-full"  name="image"/>
                </div>
                <input type="text" name="blogTitle" class="input input-bordered w-full" placeholder="Blog Title" name="title">
                <input type="text" name="blogDescription" class="input input-bordered w-full" placeholder="Blog Description" name="description">
                <textarea name="blogContent" id="" cols="30" rows="5" class="textarea textarea-bordered resize-none" placeholder="Blog Content" name="content"></textarea>
                <button type="submit" class="btn btn-info btn-active">Post</button>
            </div>
        </form>
    </div>
@endsection