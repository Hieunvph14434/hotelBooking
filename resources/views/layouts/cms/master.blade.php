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
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // preview image
        function preview() {
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }
        $(function(){

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
            // $('body').on('click', '.xmark-del', function (e) {
            //     e.preventDefault();
                
            // });

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
    </script>
</body>

</html>
