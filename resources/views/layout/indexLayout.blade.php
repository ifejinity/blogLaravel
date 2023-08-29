<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeffrey Lonzanida</title>
    @include('partials.__cdn')
</head>
<body class="w-full min-h-screen md:px-[10%] px-[5%] bg-cover bg-center bg-[url({{asset('assets/bg.png')}})] flex flex-col items-center font-[outfit] select-none pb-[100px]">
    {{-- blog section --}}
    @yield('blogs')
    @yield('modalAddBlog')
    @yield('creatingBlog')
    @yield('deletingBlog')
    {{-- toastify js --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function () {
            // show modal add blog
            $("#showAddBlogModal").click(function () { 
                $("#modalAddBlog").addClass('flex').removeClass('hidden');
            });
            // hide modal add blog
            $("#hideAddBlogModal").click(function () { 
                $("#modalAddBlog").addClass('hidden').removeClass('flex');
            });
        });
        // create class for blog request
        class blogRequest {
            //posting a blog
            createBlog(formData) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('post') }}",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        console.log(response)
                        // show creating display
                        $('#creating').addClass('flex').removeClass('hidden');
                        setTimeout(() => {
                            // reset display error messages
                            $('#errorImage').html("");
                            $('#errorTitle').html("");
                            $('#errorDescription').html("");
                            $('#errorContent').html("");
                            $('#noBlog').html("");
                            if(response.status == "success") {
                                $("#blogs").append(`
                                <div class="card w-full max-w-[350px] bg-base-100 shadow-xl hover:-translate-y-2 duration-200 relative overflow-clip">
                                    <details class="dropdown mb-32 absolute left-2 top-2">
                                        <summary class="m-1 btn btn-error btn-active"><i class="bi bi-trash text-[20px]"></i></summary>
                                        <div class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                                            <li><button type="button" value="${response.myBlogs.id}" class="delete">Proceed</button></li>
                                        </div>
                                    </details>
                                    <figure>
                                        <img src="{{ asset('/images/${response.myBlogs.image}') }}" alt="" class="w-full h-full max-h-[300px] max-w-[350px] object-cover delete"/>
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title">${response.myBlogs.title}</h2>
                                        <p>${response.myBlogs.description}</p>
                                        <div class="card-actions justify-end">
                                            <a href="/blog/read/${response.myBlogs.id}" class="btn btn-info read">Read</a>
                                        </div>
                                    </div>
                                </div>
                                `);
                                // delete blog
                                let deleteBtn = document.querySelector(".delete");
                                deleteBtn.forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const id = btn.value;
                                        blog.deleteBlog(id);
                                    })
                                });
                                Toastify({
                                    text: "Blog posted!",
                                    className: "info",
                                    style: {
                                        background: "#22c55e",
                                    }
                                }).showToast();
                                // reseting value of inputs
                                $("#modalAddBlog input, #modalAddBlog textarea").val("");
                                // hide modal anf creating display
                                $("#modalAddBlog").addClass('hidden').removeClass('flex');
                            } else {
                                // display error messages
                                $('#errorImage').html(response.errors.image);
                                $('#errorTitle').html(response.errors.title);
                                $('#errorDescription').html(response.errors.description);
                                $('#errorContent').html(response.errors.content);
                                Toastify({
                                    text: "Posting failed!",
                                    className: "info",
                                    style: {
                                        background: "#ef4444",
                                    }
                                }).showToast();
                            }  
                            $('#creating').addClass('hidden').removeClass('flex');
                        }, 1500);
                    }
                });
            }
            // delete blog
            deleteBlog(id) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('deleteBlog') }}",
                    data: { _method:"delete", id:id },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        console.log(response)
                        // show creating display
                        $('#deleting').addClass('flex').removeClass('hidden');
                        setTimeout(() => {
                            if(response.status == "success") {
                                $("#blogs").html("");
                                if(response.myBlogs.length <= 0) {
                                    $("#blogs").append(`
                                        <div>
                                            <p class="text-gray-300 text-900 text-[40px]" id="noBlog">NO BLOGS</p>
                                        </div>
                                    `);
                                }
                                for (let x = 0; x < response.myBlogs.length; x++) {
                                    $("#blogs").append(`
                                        <div class="card w-full max-w-[350px] bg-base-100 shadow-xl hover:-translate-y-2 duration-200 relative overflow-clip">
                                            <details class="dropdown mb-32 absolute left-2 top-2">
                                                <summary class="m-1 btn btn-error btn-active"><i class="bi bi-trash text-[20px]"></i></summary>
                                                <div class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                                                    <li><button type="button" value="${response.myBlogs[x].id}" class="delete">Proceed</button></li>
                                                </div>
                                            </details>
                                            <figure>
                                                <img src="{{ asset('/images/${response.myBlogs[x].image}') }}" alt="" class="w-full h-full max-h-[300px] max-w-[350px] object-cover delete"/>
                                            </figure>
                                            <div class="card-body">
                                                <h2 class="card-title">${response.myBlogs[x].title}</h2>
                                                <p>${response.myBlogs[x].description}</p>
                                                <div class="card-actions justify-end">
                                                    <a href="/blog/read/${response.myBlogs[x].id}" class="btn btn-info read">Read</a>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                }
                                // delete blog
                                let deleteBtn = document.querySelectorAll(".delete");
                                deleteBtn.forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const id = btn.value;
                                        blog.deleteBlog(id);
                                    })
                                });
                                Toastify({
                                    text: "Blog deleted!",
                                    className: "info",
                                    style: {
                                        background: "#22c55e",
                                    }
                                }).showToast();
                            } else {
                                Toastify({
                                    text: "Deleting failed!",
                                    className: "info",
                                    style: {
                                        background: "#ef4444",
                                    }
                                }).showToast();
                            }  
                            $('#deleting').addClass('hidden').removeClass('flex');
                        }, 1500);
                    }
                });
            }
        }
        // instanciate a blogRequest
        const blog = new blogRequest;
        // click event to trigger create blog method
        $("#postBlog").click(function (e) { 
            e.preventDefault();
            let formData = new FormData($("#addBlogForm")[0])
            blog.createBlog(formData);
        });
        // delete blog
        let deleteBtn = document.querySelectorAll(".delete");
        deleteBtn.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = btn.value;
                blog.deleteBlog(id);
            })
        });
    </script>
</body>
</html>