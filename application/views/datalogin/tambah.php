<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
    <!-- <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') 
                                        ?>"> -->
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


                <h3 class="mt-4">Tambah Data Login</h3>

                <a href="<?php echo site_url('dashboard/datalogin') ?>" class="btn btn-warning btn-sm">
                    Batal</a>


                <div class="card mt-4">
                    <div class="card-header">
                        Tambah
                    </div>
                    <div class="card-body">
                        <?php echo form_open('', ' class="needs-validation" novalidate id="form_data_login" ') ?>
                        <div class="form-row">
                            <div class="col-md-4 mb-6">
                                <label for="nip_pegawai">Nama</label>
                                <!-- <input type="text" class="form-control" id="nama_admin" placeholder="Nama Admin"
                                        name="nama_admin" required> -->


                                <select name="nip_pegawai" id="nip_pegawai" class="form-control select2">
                                    <option value="">- Pilih Pegawai -</option>
                                </select>


                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Silahakan isi Nama
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email_login">Email Login</label>
                                <input type="email" class="form-control" id="email_login" placeholder="Email Admin" name="email" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Silahakan isi Email
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" name="username" aria-describedby="inputGroupPrepend" required>
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
                                <label for="password_admin">Password Login</label>
                                <input type="text" name="password" class="form-control" id="password_admin" placeholder="Password Admin" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Password Login.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="no_hp_admin">No Hp Login</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp_admin" placeholder="No Hp Admin" maxlength="15" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid No Hp Login.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="level_admin">Level Login</label>
                                <select class="form-control" id="level_admin" required name="level">
                                    <option value="1">Admin</option>
                                    <option value="2">Approval</option>
                                    <option value="3">Penilai</option>
                                    <option value="4">Pegawai</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col-md-4 mb-3">
                                <label for="password_admin">Picture</label>
                                <input type="file" name="picture" class="form-control" accept="image/*" required id="picture">



                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Password Login.
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary btn-sm" type="button" id="simpan" data-loading-text="<i class='fa fa-spinner fa-spin '></i>Proses">Simpan</button>
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


    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>


    <script src="<?php echo site_url('assets/vendor/ajaxfileupload/ajaxfileupload.js') ?>"></script>

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(function() {
            $('.select2').select2({
                minimumInputLength: 3,
                allowClear: true,
                placeholder: 'Masukkan nama pegawai',
                ajax: {

                    // headers: {'Access-Control-Allow-Origin':'*'},
                    url: '<?php echo site_url('api/pegawai/api_pegawai') ?>',
                    dataType: 'json',
                    delay: 800,
                    data: function(params) {
                        return {

                            cmd: 'select2',
                            search: params.term
                        }
                    },
                    processResults: function(data, page) {

                        // console.log(data);
                        return {

                            results: data
                        };
                    },
                },
                theme: 'bootstrap4'
            });
        });



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

        $("body").on("click", "#simpan", function(e) {
            var nip_pegawai = $('#nip_pegawai').val()
            var email_login = $('#email_login').val()
            var username = $('#validationCustomUsername').val()
            var password_admin = $('#password_admin').val()
            var no_hp_admin = $('#no_hp_admin').val()
            var level_admin = $('#level_admin').val()
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 3000);

            if (nip_pegawai == '' || email_login == '' || username == '' || password_admin == '' || no_hp_admin == '' || level_admin == '') {
                $('#form_data_login').attr('class', 'was-validated')

            } else {
                swal.fire({
                    text: "Simpan Data ?",
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',

                }).then((result) => {
                    if (result.value == true) {

                        // $('#form_data_login').submit()
                        // location.reload()
                        $.ajaxFileUpload({
                            url: "<?php echo base_url('api/login'); ?>",
                            secureuri: false,
                            fileElementId: "picture",
                            data: {

                                key: 'bbkpm2019',
                                nip_pegawai: nip_pegawai,
                                email: email_login,
                                password: password_admin,
                                no_hp: no_hp_admin,
                                username: username,
                                level: level_admin

                            },
                            dataType: "text",
                            success: function(res) {

                                if (res.status === false) {
                                    swal.fire({
                                        text: 'Id tidak tersedia.',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: 'red',

                                    })
                                } else {

                                    swal.fire({
                                        text: "Berhasil Disimpan",
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#3085d6',

                                    }).then((result) => {
                                        location.reload()
                                    })

                                }

                            },
                            error: function(error) {
                                // console.log(error);

                                swal.fire({
                                    text: 'Terjadi kesalahan.' + error.status + ' ' + error.statusText,
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: 'red',

                                })
                            }
                        });

                    } else {

                    }

                })
            }



        })
    </script>



</body>

</html>