<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-fluid">
        <div class="page">
            <div class="aside">
                @include('layouts.cms.aside')
            </div>
            <div class="content w-100">
                <div class="dropdown">
                    <i class="fa-regular fa-user icon-user toggle-dropdown" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                      
                    </ul>
                  </div>
                  
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // preview image
        function preview() {
            let parent = $('#previewImage').closest('div');
            if(parent.hasClass('d-none')) {
                parent.removeClass("d-none");
            }
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }
        $(function(){
            var previewImage = $('body').find('img#previewImage');
            if(previewImage.attr('src') == "" || previewImage.attr('src') == null){
                previewImage.closest('div').addClass('d-none');
            }
            $(document).ready(function () {
                $('.toggle-dropdown').dropdown();
            });

            $('body').on('click', '.toggle-password', function(e){
                let elmChangeType = $(this).prev();
                let isTypePassword = elmChangeType.attr('type') == "password";
                elmChangeType.attr('type', isTypePassword ? "text" : "password");
                $(this).toggleClass('fa-eye', !isTypePassword).toggleClass('fa-eye-slash', isTypePassword)
            });

            // show modal confirm delete
            $('body').on('click', 'button.confirm-delete', function(e){
                let formDel = $('#form-delete');
                let uid = $(this).data('uid');
                let routeName = $(this).data('rname');
                let deleteUrl = routeName.replace(':id', uid);
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deteleData(deleteUrl)
                    }
                });
            });

            // delete image
            $('body').on('click', '.xmark-del', function (e) {
                e.preventDefault();
                let parent = $(this).closest('div.elm-relative');
                let image = $(this).next('img');
                let form = $(this).parents('form');
                let inputFile = form.find('input[type="file"]');
                let regex = /^https:\/\/res\.cloudinary\.com/g;
                
                if(regex.test(image.attr('src'))) {
                    deleteImageCloudinary(image.attr('src'));
                }
                if(inputFile[0].files.length !== 0) {
                    inputFile.val("");
                }
                image.attr('src', "");
                parent.addClass('d-none');
            });

        });

        // delete
        function deteleData(url) {
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    _token: token
                },
                dataType: "json",
                success: function (response) {
                    if(response.statusCode === 200) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        }).then((res) => {
                            if (res.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function (err) { 
                    console.log('error', err);
                }
            });
        }

        // delete image cloudinary
        function deleteImageCloudinary(urlImage) {
            let token = $('meta[name="csrf-token"]').attr('content');
            const regexPattern = /uploads\/(.+)$/;
            let image = urlImage.match(regexPattern);
            $.ajax({
                type: "DELETE",
                url: "{{ route('delete.image.cloudinary') }}",
                data: {
                    _token: token,
                    image: image[0]
                },
                dataType: "json",
                success: function (response) {
                    console.log("success", response);
                },
                error: function (err) {
                    console.log("error", err);
                }
            });
        }
    </script>
</body>

</html>
