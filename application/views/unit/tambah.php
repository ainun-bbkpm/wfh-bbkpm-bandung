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


                <h3 class="mt-4">Data Unit Kerja</h3>

                <a href="<?php echo site_url('dashboard/unit') ?>" class="btn btn-warning btn-sm">
                    Batal</a>


                <div class="card mt-4">
                    <div class="card-header">
                        Tambah
                    </div>
                    <div class="card-body">
                        <?php echo form_open('unit/simpan',' class="needs-validation" novalidate ') ?>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="nama_unit_kerja">Nama unit</label>
                                    <input type="text" class="form-control" id="nama_unit_kerja" placeholder="Nama unit"
                                        name="nama_unit_kerja" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Nama unit
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hak_akses_unit_kerja">Hak Akses</label>
                                    <select class="form-control" id="hak_akses_unit_kerja"
                                        name="hak_akses_unit_kerja" required>
                                        <?php
                                        foreach ($akses_all->result() as $akses) {
                                        
                                        ?>
                                        <option value="<?php echo $akses->id_hak_akses ?>"><?php echo $akses->nama_hak_akses ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Nama unit
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

    <?php $this->load->view('_includes/js.php'); ?>

    <script>


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