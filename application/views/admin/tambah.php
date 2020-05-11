<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Remunerasi</title>

    <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">


    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') ?>"> -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">

    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/toastr/css/toastr.min.css') ?>">
       <!-- select2 -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/select2-bootstrap4/css/select2.min.css') ?>">
    <!-- select2-bootstrap4-theme -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/select2-bootstrap4/css/select2-bootstrap4.css') ?>">
  
    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">

</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_includes/sidebar.php'); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Header Start -->
            <?php $this->load->view('_includes/header.php'); ?>
            <!-- Header End -->

            <div class="container-fluid mt-4">

                <!-- Notif Start -->
                <?php $this->load->view('_includes/notif.php'); ?>
                <!-- Notif end -->


                <h3 class="mt-4">Tambah Data Admin</h3>

                <a href="<?php echo site_url('dashboard/admin') ?>" class="btn btn-warning btn-sm">
                    Batal</a>


                <div class="card mt-4">
                    <div class="card-header">
                        Tambah
                    </div>
                    <div class="card-body">
                        <?php echo form_open('admin/simpan',' class="needs-validation" novalidate ') ?>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="nip_pegawai">Nama Admin</label>
                                    <!-- <input type="text" class="form-control" id="nama_admin" placeholder="Nama Admin"
                                        name="nama_admin" required> -->

                                    <select name="nip_pegawai" id="mySelect2" required>
                                    <?php
                                    foreach ($pegawai_all->result() as $pegawai) {
                                        
                                    ?>
                                        <option value="<?php echo $pegawai->nip ?>" <?php echo $pegawai->nip_pegawai == TRUE ?'selected disabled':'' ?> ><?php echo $pegawai->nama_pegawai ?></option>
                                    <?php
                                    }
                                    ?>

                                    </select>


                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Nama Admin
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email_admin">Email Admin</label>
                                    <input type="email" class="form-control" id="email_admin" placeholder="Email Admin"
                                        name="email_admin" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Email Admin
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustomUsername">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        </div>
                                        <input type="text" class="form-control" id="validationCustomUsername"
                                            placeholder="Username" name="username_admin"
                                            aria-describedby="inputGroupPrepend" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Silahakan isi username.
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="password_admin">Password Admin</label>
                                    <input type="text" name="password_admin" class="form-control" id="password_admin"
                                        placeholder="Password Admin" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Password Admin.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="no_hp_admin">No Hp Admin</label>
                                    <input type="text" name="no_hp_admin" class="form-control" id="no_hp_admin"
                                        placeholder="No Hp Admin" maxlength="15" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid No Hp Admin.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="level_admin">Level Admin</label>
                                    <select class="form-control" id="level_admin" required name="level_admin">
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Staf</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid zip.
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                        </form>
                        <div class="mt-4">
                            <small class="mt-4">
                                Menampilkan halaman dalam <strong>{elapsed_time}</strong> detik.
                            </small>
                        </div>
                    </div>
                </div>

            </div>




        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <footer class="footer bg-light border-right pl-4">
        <h5>BBKPM BANDUNG @ 2019</h5>
    </footer>



    <!-- Modal Start -->
    <?php $this->load->view('_includes/modal.php'); ?>

    <!-- Modal ENd -->

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

    <script src="<?php echo site_url('assets/vendor/select2-bootstrap4/js/select2.min.js') ?>">
    </script>

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
    $('#mySelect2').select2(
    {
        theme: 'bootstrap4',
    }
    );



     // Validasi hanya anggka saja
    var no_hp_admin = document.getElementById('no_hp_admin');
    no_hp_admin.addEventListener('keyup', function(e) {
        no_hp_admin.value = nominal(this.value);
    });
    // Fungsi Validasi hanya anggka saja
    function nominal(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString();
        return number_string

    }

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>



</body>

</html>