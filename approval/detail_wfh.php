<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Pemantauan Kinerja WFH</title>


    <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') 
                                        ?>"> -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">


    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/toastr/css/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') ?>">



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">

</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading bg-red">
                <a href="<?php echo  base_url() ?>"> Work From Home</a>
            </div>
            <div class="list-group list-group-flush">
                <?php
                if ($jml_bawahan > 0) {
                    # code...
                ?>

                    <a href="<?php echo  site_url('approval/wfh') ?>" class="list-group-item list-group-item-action bg-light">Approval <span class="badge badge-primary">New</span></a>
                <?PHP
                }
                ?>



            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Header Start -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary btn-sm" id="menu-toggle">
                    <i class="fa fa-angle-double-right"></i>
                </button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $this->session->nama_login; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logout_wfh">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Header End -->


            <div class="container-fluid mt-4">

                <!-- Notif Start -->
                <?php $this->load->view('_includes/notif.php'); ?>
                <!-- Notif end -->




                <h5>Nama Pegawai : <?php echo $pegawai->nama_pegawai ?></h5>
                <h5>NIP Pegawai : <?php echo $pegawai->nip2 ?></h5>
                <h5>Jabatan : <?php echo $pegawai->nama_jabatan ?></h5>
                <h5>Unit Kerja : <?php echo $pegawai->nama_unit_kerja ?></h5>

                <?php //echo $nip_atasan
                ?>




            </div>



            <!-- Tombol add log book-->
            <a href="<?php echo site_url('approval/wfh') ?>" class="btn btn-warning"> <i class="fa fa-angle-double-left"></i> Kembali</a>
            <button type="button" class="btn btn-primary setuju" onclick="setuju('<?php echo $id_wfh ?>')"> <i class="fa fa-plus"></i> Setuju dan Nilai</button>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        List WFH
                    </div>
                    <div class="table-responsive-lg">
                        <table id="example2" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id WFH</th>

                                    <th>Tgl Abs</th>
                                    <th>Foto hadir</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam pertengahan</th>
                                    <th>Jam Pulang</th>
                                    <th>Demam</th>
                                    <th>Sesak</th>
                                    <th>Batuk</th>
                                    <th>Nyeri Menelan</th>
                                    <th>Status</th>


                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>


            <!-- ini log book -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-primary" role="alert">
                        List Log Book WFH
                    </div>
                    <div class="table-responsive-lg">
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 20px">Id</th>

                                    <th style="width: 90%">Uraian</th>
                                    <th>Output</th>


                                </tr>
                            </thead>

                        </table>
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

    <!-- Modal Setuju dan nilai -->

    <div class="modal fade" id="modal_setuju" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <input type="hidden" name="approved_by" value="<?php echo $nip_atasan ?>" id="approved_by">
                    <input type="hidden" name="id_wfh" value="<?php echo $id_wfh ?>" id="id_wfh">
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Perhatian !</h4>
                            <p>Data yang disetuju tidak bisa di ubah lagi</p>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nilai Kinerja (%)</label>
                            <input type="text" required class="form-control" id="nilai_kinerja" name="nilai_kinerja">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Catatan:</label>
                            <textarea class="form-control" required id="catatan" name="catatan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary nilai" onclick=" nilai()">Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal ENd -->
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


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>

    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>


    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {
            var id_wfh = '<?php echo $id_wfh ?>'
            var nip = '<?php echo $nip ?>'


            list_log_bookwfh(id_wfh);
            list_wfh(id_wfh);
        });

        function list_log_bookwfh(id) {


            var table = $('#example').DataTable({
                "ajax": "<?php echo  site_url('wfh/api_list_log_book_where_idwfh?id_wfh=') ?>" + id,

                "columns": [{
                        "data": "id_tr_log_wfh"
                    },
                    {
                        "data": "uraian_kegiatan"
                    },
                    {
                        "data": ['files'],



                        "render": function(data, type, row) {
                            // let str = data
                            // let str1 = str.split('-')
                            // let char1 = str1['3'] + '-' + str1['4'] + '-' + str1['5']
                            // let folder = char1.split('.')['0']
                            // console.log(data);

                            return '<a href="<?php echo site_url('') ?>' + data + '">' + data + '</a>'

                        }

                    },



                ],
                rowId: 'id_tr_log_wfh',
                "bDestroy": true,
                "order": [
                    [1, "desc"],


                ]


            });
        }

        function list_wfh(id_wfh) {


            var table = $('#example2').DataTable({
                "ajax": "<?php echo  site_url('approval/api_getWfh_where_idwfh?wfh=') ?>" + id_wfh,

                "columns": [{
                        "data": "id_wfh",
                        "render": function(data, type, row) {


                            return '<a href="#' + data + '" onclick="detail(' + data + ')">' + data + '</a>'

                        }
                    },
                    {
                        "data": "tgl_absen"
                    },
                    {
                        "data": "foto_absen_hadir",
                        "render": function(data, type, row) {
                            let str = data
                            let str1 = str.split('-')
                            let char1 = str1['3'] + '-' + str1['4'] + '-' + str1['5']
                            let folder = char1.split('.')['0']

                            return '<a href="<?php echo site_url('/uploads/wfh/') ?>' + folder + '/' + data + '">Lihat</a>'

                        }
                    },
                    {
                        "data": "jam_absen_hadir"
                    },
                    {
                        "data": "jam_absen_pertengahan"
                    },
                    {
                        "data": "jam_absen_pulang"
                    }, {
                        "data": "demam"
                    }, {
                        "data": "sesak"
                    }, {
                        "data": "batuk"
                    }, {
                        "data": "nyeri_nelan"
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (data === '0') {
                                return '<span class="badge badge-primary"><i class="fa fa-spinner"></i> Sedang berlangsung</span>'
                            } else {
                                return '<span class="badge badge-danger"><i class="fa fa-check"></i> Selesai</span>'
                            }
                            return data
                        }
                    },


                ],
                rowId: 'id_wfh',
                "bDestroy": true,
                "order": [
                    [1, "desc"],


                ]


            });
        }

        function setuju(nip) {

            $.ajax({
                url: '<?php echo site_url('wfh/api_getWfh_where_idwfh?wfh=') ?>' + nip,
                method: 'GET',
                success: function(res) {
                    // console.log(res);
                    if (res.data.status == 0) { //masih berjalan belum absen pulang, maka belum bisa dinilai
                        Swal.fire(
                            'Upss',
                            'Pegawai belum absen pulang, tidak bisa',
                            'error'
                        )
                    } else {
                        $('#modal_setuju').modal('toggle')

                    }

                },
                errors: function(err) {
                    console.log(err);

                }

            })
        }

        function nilai() {
            var form = new FormData();
            // $('#id_wfh').val()
            form.append("id_wfh", $('#id_wfh').val());
            form.append("nilai_kinerja", $('#nilai_kinerja').val());
            form.append("approved_by", $('#approved_by').val());
            form.append("catatan", $('#catatan').val());

            var settings = {
                "url": "<?php echo site_url('approval/approved_wfh') ?>",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                $('#modal_setuju').modal('hide')
                Swal.fire(
                    'Berhasil',
                    '',
                    'success'
                )
            });
        }

        function detail(id) {
            // alert(id)
            list_log_bookwfh(id)
        }
    </script>



</body>

</html>