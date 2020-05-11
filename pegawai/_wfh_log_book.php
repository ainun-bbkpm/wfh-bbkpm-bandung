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

    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">


    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/handsontable/handsontable.full.min.css') ?>">


    <!-- <link href="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.css" rel="stylesheet" media="screen"> -->



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

                    <a href="<?php echo  site_url('approval/wfh') ?>" class="list-group-item list-group-item-action bg-light">Approval<span class="badge badge-primary">New</span></a>
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
                <!-- Header Start -->

                <!-- Header End -->
                <!-- Notif end -->



                <h3 class="mt-4">Selamat datang di Sistem Informasi Kerja /WFH <?php echo $this->session->nama_login ?></h3>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Perhatian!</h4>
                    <p> - Setalah Absen masuk pegawai diharapkan mengisi Log Book</p>
                    <hr>

                </div>

                <!-- Tombol add log book-->
                <a href="<?php echo site_url('pegawai/wfh') ?>" class="btn btn-warning"> <i class="fa fa-angle-double-left"></i> Kembali</a>
                <button type="button" class="btn btn-primary tambah_log_book" onclick="add_log_book()"> <i class="fa fa-plus"></i> Tambah Log Book</button>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-primary" role="alert">
                            <marquee behavior="" direction="">List Log Book WFH saya</marquee>
                        </div>
                        <div class="table-responsive-lg">
                            <table id="example" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">Id</th>

                                        <th style="width: 90%">Uraian</th>
                                        <th>Output</th>

                                        <th style="width: 20px">Aksi</th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <button type="button" onClick="simpan_logbook('<?php echo $_GET['id'] ?>')" class="btn btn-primary">Simpan Log Book</button>
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
    <!-- Modal Tambah Log Book -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="add_log_book" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log Book Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="textarea" name="uraian_kegiatan" style="height: 200px;" id="uraian_kegiatan" class="swal2-input" required>
                    <input type="file" name="output" id="output" required class="swal2-input" accept=".doc,.pdf,.docx,.zip,.rar,.xls,.xlsx,image/*" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onClick="tambah_logbook()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
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


    <!-- bootstrap-datepicker -->
    <script src="<?php echo site_url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>">
    </script>


    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>

    <script src="<?php echo site_url('assets/vendor/ajaxfileupload/ajaxfileupload.js') ?>"></script>

    <?php $this->load->view('_includes/js.php'); ?>


    <!-- handsontable -->

    <script>
        $(document).ready(function() {

            //Triger Tombol upload
            $("body").on("click", ".hadir_masuk", function(e) {
                $.ajax({
                    'url': '<?php echo site_url('wfh/getJam') ?>',
                    'method': 'GET',
                    success: function(res) {
                        var jam_masuk = res.jam
                        var tgl_absen = res.tanggal



                        Swal.fire({
                            title: 'Absen masuk WFH',

                            html: 'Jam Masuk : <input type="text" name="jam_masuk" id="jam_masuk" required class="swal2-input" readonly >' + 'Upload Foto Selfie : <input id="file_selfie" name="file_selfie" required class="form-control" type="file">',
                            customClass: 'swal2-overflow',
                            showCancelButton: true,

                            cancelButtonColor: '#d33',
                            onOpen: function() {
                                $('#jam_masuk').val(jam_masuk)
                            }
                        }).then(function(result) {
                            if (result.value) {

                                $.ajaxFileUpload({
                                    url: "<?php echo site_url('wfh/hadir_masuk') ?>",
                                    secureuri: false,
                                    fileElementId: "file_selfie",
                                    data: {
                                        'jam_masuk': jam_masuk,
                                        'tgl_absen': tgl_absen,
                                    },
                                    dataType: "text",
                                    success: function(json, status) {

                                        var res = JSON.parse(json)

                                        console.log(res);

                                        if (res.status == 1) {
                                            Swal.fire(
                                                'Absen Berhasil',
                                                '',
                                                'success'
                                            ).then(function(result) {
                                                location.reload();
                                            })


                                        } else {
                                            Swal.fire(
                                                'Gagal Absen',
                                                '',
                                                'error'
                                            )
                                        }
                                    },
                                    error: function(err) {
                                        console.log(err.responseText)
                                        // var err = JSON.parse(err.responseText)
                                        // // let pesan = JSON.parse(err.responseText)
                                        // console.log(err);

                                        // var errpesan = JSON.parse(err.pesan)
                                        Swal.fire(
                                            'Gagal Absen',
                                            errpesan,
                                            'error'
                                        )

                                    }

                                });

                                return false;

                            }
                        });

                    },


                });

            })

            pegawai()




        });

        function pegawai() {
            var settings = {
                "url": "<?php echo  site_url("api/pegawai?id=$nip&level=$level") ?>",
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "key": "bbkpm2019"
                },
            };

            $.ajax(settings).done(function(response) {

                // console.log(response.pegawai);
                // console.log(response.Datalogin);
                // console.log(response.Datalogin[0].picture);

                var no_abs = response.pegawai.no_abs
                var nip = response.pegawai.nip
                var id_wfh = '<?php echo $id_wfh ?>'


                list_log_bookwfh(id_wfh);
                //Jika whf hari ini ada yg aktif maka munculkan absen masuk, yg lain disembunyikan
                if (response.wfh_hari_ini_aktif > 0) {
                    // console.log('ada yg aktif'+response.wfh_hari_ini_aktif);
                    // $('.hadir_masuk').hide()

                } else {
                    // console.log('tidak ada yg aktif'+response.wfh_hari_ini_aktif);
                    if (response.wfh_telah_diajukan > 0) {

                        $('.tambah_log_book').hide()
                        $('.hapus_log_book').hide()
                    } else {

                        $('.tambah_log_book').show()
                        $('.hapus_log_book').show()
                    }
                }


            });
            $.ajax(settings).fail(function(response) {
                Swal.fire(
                    'Eror!',
                    'Tejadi Kesalahan di API!',
                    'error'
                )
            });
        }

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
                        "data": "output"
                    },

                    {
                        "data": "id_tr_log_wfh",
                        "render": function(data, type, row) {
                            var key = (data);
                            return `
                                   
                                    <button type="button" class="btn btn-danger btn-sm hapus_log_book" onclick="hapus_log_book(` + key + `)" >Hapus</button>
                    
                            `
                        }
                    }

                ],
                rowId: 'id_tr_log_wfh',
                "bDestroy": true,
                "order": [
                    [1, "desc"],


                ]


            });
        }

        function add_log_book() {
            $('#add_log_book').modal('toggle')
        }

        function hapus_log_book(id_log_book) {
            // alert(id_log_bo$('.hadir_masuk').hide()ok)
            Swal.fire({
                title: 'HAPUS DATA',
                icon: 'question',
                showCancelButton: true,
                cancelButtonColor: '#d33',
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?php echo site_url('wfh/hapus_log_book') ?>',
                        method: 'DELETE',
                        data: {
                            id: id_log_book
                        },
                        success: function(res) {
                            // console.log(res);
                            swal.fire({
                                title: 'Sedang menghapus'
                            });
                            swal.showLoading();
                            if (res.status == 1) {
                                swal.fire({
                                    title: 'Berhasil',
                                    icon: 'success',
                                    text: res.pesan
                                });
                                list_log_bookwfh(res.id_wfh);

                            } else {
                                swal.fire({
                                    title: 'Gagal menghapus'
                                });
                            }

                        },
                        error: function(err) {
                            console.log(err);

                        }
                    })
                    // swal.fire({
                    //     title: 'Sedang menghapus'
                    // });
                    // swal.showLoading();

                }
            });
        }

        function tambah_logbook() {
            Swal.fire(
                'Proses',
            )
            Swal.showLoading()


            $.ajaxFileUpload({
                url: "<?php echo site_url('wfh/tambah_log_book') ?>",
                secureuri: false,
                fileElementId: "output",
                data: {
                    "id_wfh": '<?php echo $_GET['id']; ?>',
                    "uraian_kegiatan": $("#uraian_kegiatan").val(),
                },
                dataType: "text",
                success: function(json, status) {

                    var res = JSON.parse(json)


                    console.log(res);

                    if (res.status == 1) {


                        Swal.fire(
                            'Berhasil',
                            '',
                            'success'
                        ).then(function(result) {
                            location.reload();
                        })


                    } else {
                        Swal.fire(
                            'Gagal ',
                            res.pesan,
                            'error'
                        )
                    }
                },
                error: function(err) {
                    // console.log(err.responseText)
                    var err = (err.responseText)
                    // // let pesan = JSON.parse(err.responseText)
                    // console.log(err);

                    // var errpesan = JSON.parse(err.pesan)
                    Swal.fire(
                        'Gagal Internal Server Error ',
                        err,
                        'error'
                    )

                }

            });
        }

        function simpan_logbook(id) {
            $.ajax({
                url: '<?php echo site_url('wfh/api_list_log_book_where_idwfh?id_wfh=') ?>' + id,
                method: 'GET',

                success: function(res) {
                    Swal.fire({
                        title: 'Simpan?',

                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: '<?php echo site_url('wfh/simpan_log_book') ?>',
                                method: 'POST',
                                data: {
                                    'id_wfh': id
                                },
                                success: function(res) {

                                    console.log(res);
                                    if (res.status == 1) {
                                        Swal.fire(
                                            'Prosess',
                                        )
                                        Swal.showLoading()
                                        Swal.fire(
                                            'Tersimpan!',
                                            '',
                                            'success'
                                        )
                                    } else {
                                        Swal.fire(
                                            'Gagal ',
                                            '',
                                            'error'
                                        )
                                    }


                                }
                            })
                        }
                    })





                }
            })
        }
    </script>
</body>

</html>