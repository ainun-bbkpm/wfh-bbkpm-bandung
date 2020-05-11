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
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/select2/select2.min.css') ?>">



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


                <h1 class="mt-4">Data Atasan</h1>

                <h6 class="mt-4"> Nama Pegawai : <?php echo $pegawai->nama_pegawai ?></h6>

                <a href="javascript:window.history.go(-1);" class="btn btn-warning btn-sm">
                    Kembali</a>

                <a href="#" class="btn btn-primary btn-sm tambah" data-toggle="modal" data-target="#listpegawai">
                    Tambah Atasan</a>


                <div class="card">
                    <?php
                    echo form_open('pegawai/atasan_simpan', ' id="form_tambah_atasan" ')
                    ?>
                    <div class="card-header">
                        <h5 class="card-title" id="title_atasan">Tambah Atasan</h5>

                    </div>
                    <div class="card-body">
                        <div class="form-row">

                            <input type="hidden" name="nip_pegawai" id="nip_pegawai" value="<?php echo $pegawai->nip ?>">
                            <div class="col-md-12 mb-3">
                                <label for="mySelect2">Nama Atasan</label>

                                <select id="mySelect2" class="form-control" name="nip_atasan" required>
                                    <?php
                                    foreach ($pegawai_all->result() as $pegawai) {

                                    ?>
                                        <option value="<?php echo $pegawai->nip ?>"><?php echo $pegawai->nip ?> - <?php echo $pegawai->nama_pegawai ?> -
                                            <?php echo $pegawai->nama_jabatan ?> </option>

                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="id_hak_akses">Hak Akses</label>
                                <select class="form-control" id="id_hak_akses" name="id_hak_akses" required>
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
                            <div class="col-md-2 mb-3">
                                <label for="atasan_ke">Atasan Ke</label>

                                <input type="text" name="atasan_ke" id="atasan_ke" required class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="atasan_ke">Pejabat Penilai</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Pejabat penilai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Atasan langsung pejabat penilai
                                    </label>
                                </div>
                            </div>



                        </div>



                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="simpan_atasan">Simpan</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                    </div>
                    <?php
                    echo form_close();
                    ?>


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

    <!-- Modal -->


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
    <script src="<?php echo site_url('assets/vendor/select2/select2.min.js') ?>">
    </script>


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {

            $('#example').DataTable();




            $('#mySelect2').select2();


            // Validasi hanya anggka saja
            var atasan_ke = document.getElementById('atasan_ke');
            atasan_ke.addEventListener('keyup', function(e) {
                atasan_ke.value = nominal(this.value);
            });
            // Fungsi Validasi hanya anggka saja
            function nominal(angka) {
                var number_string = angka.replace(/[^,\d]/g, '').toString();
                return number_string

            }

            $('#hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var link = button.data('link') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)


                modal.find('.modal-body #id_hapus').val(id)
                modal.find('#form_hapus').attr('action', link)
            })


        });
    </script>



</body>

</html>