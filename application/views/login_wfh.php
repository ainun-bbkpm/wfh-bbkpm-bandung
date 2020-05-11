<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Login</title>
    <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">


    <link rel="stylesheet" href="<?php echo  base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') 
                                    ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/toastr/css/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/signin.css') ?>">

    <style type="text/css">
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="text-center">

    <?php
    echo form_open('wfh/cek_login', ' id="form_login"  class="form-signin"');
    // echo "<form>"
    ?>
    <img class="mb-4" src="<?php echo site_url('assets/images/Logo BBKPM 2_Polos.png')  ?>" alt="" width="250" height="100">
    <div class="form-group ">
        <input type="text" class="form-control" name="username" required maxlength="50" placeholder="NIP atau NIK">

    </div>

    <div class="form-group ">
        <input type="password" name="password" class="form-control" placeholder="Password">

    </div>

    <div class="row">

        <!-- /.col -->
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
    <?php
    echo form_close();
    ?>






    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery-3.4.1.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.bundle.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>">
    </script>

    <!-- Vendor -->
    <script src="<?php echo site_url('assets/vendor/toastr/js/toastr.min.js') ?>">
    </script>

    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>">
    </script>

    <script src="<?php echo site_url('assets/vendor/jquery-validation/jquery.validate.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/jquery-validation/additional-methods.min.js') ?>">
    </script>

    <?php $this->load->view('_includes/js.php'); ?>


    <script type="text/javascript">
        $(document).ready(function() {
            var login_sebagai = $('#login_sebagai').val()
            console.log(login_sebagai);

            // $.validator.setDefaults({
            //     submitHandler: function () {
            //         // alert( "Form successful submitted!" );
            //         var form = new FormData();
            //         form.append("username", $('#username').val());
            //         form.append("password", $('#password').val());
            //         form.append("login_sebagai", $('#login_sebagai').val());

            //         var settings = {
            //         "async": true,
            //         "crossDomain": true,
            //         "url": "http://localhost/simremuna3/auth/api_cek_login",
            //         "method": "POST",
            //         "headers": {
            //             "Content-Type": "application/x-www-form-urlencoded",
            //             "User-Agent": "PostmanRuntime/7.20.1",
            //             "Accept": "*/*",
            //             "Cache-Control": "no-cache",
            //             "Postman-Token": "751b235c-12f8-4437-9396-ddd37990c993,3ceaa8e1-b1be-46c2-841f-ff6fca84ee56",
            //             "Host": "localhost",
            //             "Accept-Encoding": "gzip, deflate",
            //             "Cookie": "ci_session=6a1ccc6f018f1cee1d8f492693cbadef67dd3351",
            //             "Content-Length": "395",
            //             "Connection": "keep-alive",
            //             "cache-control": "no-cache"
            //         },
            //         "processData": false,
            //         "contentType": false,
            //         "mimeType": "multipart/form-data",
            //         "data": form
            //         }

            //         $.ajax(settings).done(function (response) {
            //         console.log(response);
            //         });
            //         swal.fire({
            //                     title: 'Proses'
            //                 });
            //                 swal.showLoading();
            //         // $('#form_login').submit()
            //         // Swal.fire({
            //         //     title: 'pick a date:',
            //         //     type: 'question',
            //         //     html: '<input id="datepicker" name="date_absensi" required class="swal2-input">'+'<input id="file_absensi" name="file_absensi" required class="form-control" type="file">',

            //         // })

            //     }
            // });
            // $('#form_login').validate({
            //     rules: {
            //     username: {
            //         required: true,

            //     },
            //     password: {
            //         required: true,
            //         minlength: 5
            //     },

            //     level: {
            //         required: true
            //     },
            //     },
            //     messages: {
            //         username: {
            //         required: "Please enter a email address",

            //     },
            //     password: {
            //         required: "Please provide a password",
            //         minlength: "Your password must be at least 5 characters long"
            //     },

            //     level: "Please pilih"
            //     },
            //     errorElement: 'span',
            //     errorPlacement: function (error, element) {
            //     error.addClass('invalid-feedback');
            //     element.closest('.form-group').append(error);
            //     },
            //     highlight: function (element, errorClass, validClass) {
            //     $(element).addClass('is-invalid');
            //     },
            //     unhighlight: function (element, errorClass, validClass) {
            //     $(element).removeClass('is-invalid');
            //     }
            // });
        });
    </script>





</body>

</html>