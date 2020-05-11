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


                <h3 class="mt-4">Edit Data Pegawai</h3>

                <a href="<?php echo site_url('dashboard/pegawai') ?>" class="btn btn-warning btn-sm">
                    Batal</a>


                <div class="card mt-4">
                    <div class="card-header">
                        Edit
                    </div>
                    <div class="card-body">
                        <?php echo form_open('pegawai/update',' class="needs-validation" novalidate ') ?>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pegawai">Nama Pegawai</label>
                                    <input type="hidden" name="nip" value="<?php echo  $pegawai->nip ?>">
                                    <input type="text" class="form-control" id="nama_pegawai" placeholder="Nama pegawai"
                                        name="nama_pegawai" value="<?php echo  $pegawai->nama_pegawai ?>" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Nama pegawai
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nik">NIK pegawai</label>
                                    <input type="text" class="form-control" id="nik" placeholder="Email pegawai"
                                        name="nik" value="<?php echo  $pegawai->nik ?>" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Email pegawai
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="id_unit_kerja">Unit Kerja</label>
                                <select name="id_unit_kerja" class="form-control" id="id_unit_kerja" required>
                                    <?php
                                    foreach ($unit_all->result() as $unit) {                               
                                    ?>
                                    <option value="<?php echo $unit->id_unit_kerja ?>" <?php echo  $unit->id_unit_kerja ==  $pegawai->id_unit_kerja ?'selected':'' ?>>
                                        <?php echo $unit->nama_unit_kerja ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>


                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Unit Kerja.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="id_jabatan">Jabatan</label>
                                <select name="id_jabatan" class="form-control" id="id_jabatan" required>
                                    <?php         
                                    foreach ($jabatan_all->result() as $jabatan) {                
                                    ?>
                                    <option value="<?php echo $jabatan->id_jabatan ?>" <?php echo  $jabatan->id_jabatan ==  $pegawai->id_jabatan ?'selected':'' ?>>
                                        <?php echo $jabatan->nama_jabatan ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Jabatan.
                                </div>
                            </div>

                            

                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="grading">Grading</label>
                                <input type="text" name="grading" id="grading" class="form-control" value="<?php echo  $pegawai->grading ?>" required>


                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Grading.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jab_value">Jab Value</label>
                               <input type="text" name="jab_value" class="form-control" value="<?php echo  $pegawai->jab_value ?>" id="jab_value" required>

                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Jab Value.
                                </div>
                            </div>

                        </div>

                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
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
    var id = $('#id_unit_kerja').val();

    console.log(id);
    
    $('#id_unit_kerja').change(function() {
        var id = $('#id_unit_kerja').val();
        // Khusus Method POST
            var csrfName =
                '<?php echo $this->security->get_csrf_token_name(); ?>',
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo site_url('api/jabatan/jabatan_unitkerja') ?>",
                "method": "POST",
                "data": {
                    [csrfName]: csrfHash,
                    "id": id
                }
            }
            $.ajax(settings).done(function(response) {
                var obj = response;
                
                    $('#id_jabatan').html(obj)
                if (response.pesan) {
                
                    toastr.error('Data belum tersedia', 'Perhatian');
                }


            });
        
    });


     // Validasi hanya anggka saja
    var nik = document.getElementById('nik');
    nik.addEventListener('keyup', function(e) {
        nik.value = nominal(this.value);
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