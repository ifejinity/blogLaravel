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
        @yield('creatingComment')
    </div>
    {{-- toastify js --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        class commentRequest {
            createComment(formData) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('comment') }}",
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
                            $('#errorText').html("");
                            if(response.status == "success") {
                                $("#comments").append(`
                                <div class="w-full p-5 bg-white shadow-md rounded-md flex flex-col gap-3">
                                    <p class="text-info">@Anonymous</p>
                                    <p>${response.comments.text}</p>
                                    <div class="w-full flex justify-center items-center">
                                        <img src="{{ asset('/images/${response.comments.image}') }}" alt="" srcset="" class="w-full max-w-[500px] md:h-[500px] h-[300px] object-cover">
                                    </div>
                                </div>
                                `);
                                Toastify({
                                    text: "Comment posted!",
                                    className: "info",
                                    style: {
                                        background: "#22c55e",
                                    }
                                }).showToast();
                                // reseting value of inputs
                                $("#modalAddBlog input, #modalAddBlog textarea").val("");
                                // hide modal anf creating display
                                $("#modalAddBlog").addClass('hidden').removeClass('flex');
                                // scroll at the bottom
                                window.scrollTo(0, document.body.scrollHeight);
                            } else {
                                // display error messages
                                $('#errorImage').html(response.errors.image);
                                $('#errorText').html(response.errors.text);
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
        }
        // instanciate comment request
        const comment = new commentRequest;
        // create comment
        $('#createComment').click(function (e) { 
            e.preventDefault();
            const formData = new FormData($("#addCommentForm")[0])
            comment.createComment(formData);
        });
    </script>
</body>
</html>