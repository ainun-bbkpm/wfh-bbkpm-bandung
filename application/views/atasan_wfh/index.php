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


                <h1 class="mt-4">Data Atasan WFH</h1>
                <br>
                <h6> Nama Pegawai : <?php echo $pegawai->nama_pegawai ?></h6>
                <h6> Unit Kerja : <?php echo $pegawai->nama_unit_kerja ?></h6>
                <h6> Jabatan : <?php echo $pegawai->nama_jabatan ?></h6>

                <a href="<?php echo site_url('dashboard/pegawai') ?>" class="btn btn-warning btn-sm">
                    Kembali</a>

                <!-- <a href="#" class="btn btn-primary btn-sm tambah" data-toggle="modal" data-target="#listpegawai">
                    Tamabah Atasan Modal</a> -->
                <a href="<?php echo site_url("dashboard/pegawai/atasan_add_wfh?id=$id&token=$token") ?>" class="btn btn-primary btn-sm">
                    Tambah Atasan WFH</a>


                <div class="table-responsive mt-4">
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>

                                <th>Nama Atasan</th>
                                <th>Unit Kerja</th>
                                <th>Jabatan</th>
                                <th>Hak Akses</th>
                                <th>Atasan ke</th>
                                <th>Pejabat penilai</th>
                                <th>Atasan penilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($atasan_all->result() as $atasan) {
                                # code...

                            ?>
                                <tr>

                                    <td><?php echo $atasan->nama_pegawai ?></td>
                                    <td><?php echo $atasan->nama_unit_kerja ?></td>
                                    <td><?php echo $atasan->nama_jabatan ?></td>
                                    <td><?php echo $atasan->nama_hak_akses ?></td>
                                    <td><?php echo $atasan->atasan_ke ?></td>
                                    <td>


                                        <?php echo $atasan->pejabat_penilai == 1 ? '<i class="fa fa-check-circle"  style="color:green" aria-hidden="true"></i>' : '<i class="fa fa-times-circle" style="color:red" aria-hidden="true"></i>' ?></td>



                                    <td><?php echo $atasan->atasan_langsung == 1 ? '<i class="fa fa-check-circle"  style="color:green" aria-hidden="true"></i>' : '<i class="fa fa-times-circle" style="color:red" aria-hidden="true"></i>' ?></td>


                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <!-- <a href="#" id="<?php //echo $atasan->id_atasan."-".$atasan->nip_atasan 
                                                                    ?>"
                                            class="btn btn-primary btn-sm edit">EditModal</a> -->

                                            <a href="<?php echo site_url("dashboard/pegawai/atasan_edit_wfh?id_atasan=$atasan->id_atasan&id=$id&token=$token") ?>" class="btn btn-primary btn-sm">Edit</a>


                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus" data-id="<?php echo $atasan->id_atasan ?>" data-link="<?php echo site_url('pegawai/atasan_hapus_wfh')  ?>">Hapus</button>


                                        </div>


                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                    <small>
                        Menampilkan halaman dalam <strong>{elapsed_time}</strong> detik.
                    </small>


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
    <div class="modal fade" id="listpegawai" tabindex="-1" role="dialog" aria-labelledby="listpegawaiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php
                echo form_open('pegawai/atasan_simpan', ' id="form_tambah_atasan" ')
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="title_atasan">Tambah Atsan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <input type="text" name="id_atasan" id="id_atasan">
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
                        <div class="col-md-6 mb-3">
                            <label for="atasan_ke">Atasan Ke</label>

                            <input type="text" name="atasan_ke" id="atasan_ke" required class="form-control">
                        </div>



                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpan_atasan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                </div>
                <?php
                echo form_close();
                ?>


            </div>
        </div>
    </div>

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

            $('#example').DataTable({
                "order": [
                    [5, "desc"],


                ]
            });

            $("body").on("click", ".tambah", function(e) {

                $("#title_atasan").text("Tambah Data Atasan");
                $('#simpan_atasan').text("Simpan");

                $('#id_atasan').val('');
                $('#nip_atasan').val('');


                $('#form_tambah_atasan').attr('action', '<?php echo site_url('pegawai/atasan_update') ?>')

                $("#listpegawai").modal('toggle');


            })
            $("body").on("click", ".edit", function(e) {
                var data_atasan = this.id.split('-');
                var id_atasan = data_atasan[0]
                var nip_atasan = data_atasan[1]
                $("#title_atasan").text("Edit Data Atasan");
                $('#simpan_atasan').text("Update");

                $('#id_atasan').val(id_atasan);
                $('#nip_atasan').val(nip_atasan);

                console.log(nip_atasan);



                $('#form_tambah_atasan').attr('action', '<?php echo site_url('pegawai/atasan_update') ?>')

                $("#listpegawai").modal('toggle');


            })

            $('#listpegawai').on('shown.bs.modal', function() {
                $('#mySelect2').select2({
                    dropdownParent: $('#listpegawai')
                });
            })

            // $('#listpegawai').on('shown.bs.modal', function(event) {

            //     $("#title_atasan").text("Tambah Data Atasan");
            //     $('#simpan_atasan').text("Simpan");

            //     $('#id_atasan').val();


            //     $('#form_tambah_atasan').attr('action', '<?php echo site_url('pegawai/atasan_simpan') ?>')

            // })

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