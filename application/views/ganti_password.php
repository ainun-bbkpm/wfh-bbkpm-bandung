<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
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
    echo form_open("auth/ganti_password?id=$nip&key=$key", ' id="form_login"  class="form-signin"');
    // echo "<form>"
    ?>

    <img class="mb-4" src="<?php echo site_url('assets/images/Logo BBKPM 2_Polos.png')  ?>" alt="" width="250" height="100">
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Selamat datang <br><i><?php echo $this->session->nama_login; ?></i> !</h4>
        <p>Bantu kami amankan akun Bapak/Ibu, dengan cara konfirmasi ulang akun Bapak/Ibu</p>
        <hr>
        <small class="text-right"><i>IT</i></small>
    </div>
    <?php echo validation_errors('<p class="text-danger">', '</p>'); ?>

    <div class="form-group ">
        <input type="text" class="form-control" name="username" required maxlength="50" placeholder="Username">

    </div>
    <div class="form-group ">
        <input type="text" class="form-control" name="no_hp" required maxlength="13" placeholder="No Hp">

    </div>
    <div class="form-group ">
        <input type="email" class="form-control" name="email" required maxlength="50" placeholder="Email">

    </div>

    <div class="form-group ">
        <input type="password" name="password" required class="form-control" placeholder="Password">

    </div>
    <div class="form-group ">
        <input type="password" name="confirm_password" required class="form-control" placeholder="Confirm Password">

    </div>

    <div class="row">

        <!-- /.col -->
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Perbarui</button>
            <button type="button" class="btn btn-warning btn-block " onclick="history.go(-1)">Batal</button>
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

    </script>





</body>

</html>