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



                <h3 class="mt-4">Selamat datang di Aplikasi Pemantauan Kinerja WFH BBKPM BANDUNG / <?php echo $this->session->nama_login ?></h3>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Perhatian!</h4>
                    <p> - Setelah Absen masuk pegawai diharapkan mengisi Log Book</p>
                    <p> - Absen tengah untuk jam 11:00 WIB sd 12:00 WIB</p>
                    <hr>
                </div>

                <!-- Tombol hadir masuk -->
                <button type="button" class="btn btn-warning mt-4 hadir_masuk">Klik sini untuk Hadir Masuk</button>

                <!-- Tombol Absen tengah -->
                <button type="button" class="btn btn-secondary mt-4 absen_tengah" onclick="absen_tengah()">Klik sini untuk Hadir Pertengahan</button>
                <!-- Tombol absen pulang -->
                <button type="button" class="btn btn-success mt-4 absen_pulang" onclick="absen_pulang()">Klik sini untuk Absen Pulang</button>




                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-primary" role="alert">
                            <marquee behavior="" direction="">List WFH saya</marquee>
                        </div>
                        <div class="table-responsive-lg">
                            <table id="example" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id WFH</th>

                                        <th>Tgl Abs</th>
                                        <th>Foto hadir</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam pertengahan</th>
                                        <th>Jam Pulang</th>
                                        <th>Status</th>
                                        <th>Aksi</th>

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
    <!-- Modal Tambah Log Book -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="add_kesehatan" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kesehatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_wfh" id="id_wfh">
                    <p>Apakah anda merasakan demam hari ini ?</p>
                    <input type="radio" id="ya" class="demam" name="demam" value="Y">
                    <label for="ya">Ya</label><br>
                    <input type="radio" id="tidak" class="demam" name="demam" value="N">
                    <label for="tidak">Tidak</label><br>


                    <p>Apakah anda sesak nafas hari ini ?</p>
                    <input type="radio" id="ya_sesak" name="sesak" class="sesak" value="Y">
                    <label for="ya_sesak">Ya</label><br>
                    <input type="radio" id="tidak_sesak" name="sesak" class="sesak" value="N">
                    <label for="tidak_sesak">Tidak</label><br>


                    <p>Apakah anda batuk hari ini ?</p>
                    <input type="radio" id="ya_batuk" name="batuk" class="batuk" value="Y">
                    <label for="ya_batuk">Ya</label><br>
                    <input type="radio" id="tidak_batuk" name="batuk" class="batuk" value="N">
                    <label for="tidak_batuk">Tidak</label><br>


                    <p>Apakah anda merasakan nyeri menelan hari ini ?</p>
                    <input type="radio" id="ya_nyeri" name="nyeri" class="nyeri" value="Y">
                    <label for="ya_nyeri">Ya</label><br>
                    <input type="radio" id="tidak_nyeri" name="nyeri" class="nyeri" value="N">
                    <label for="tidak_nyeri">Tidak</label><br>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onClick="tambah_kesehatan()" class="btn btn-primary">Save changes</button>
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

    list_log_bookwfh(id_wfh);

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

                            html: 'Jam Masuk : <input type="text" name="jam_masuk" id="jam_masuk" required class="swal2-input" readonly >' + 'Upload Foto Selfie : <input id="file_selfie" name="file_selfie" required class="form-control" type="file" accept="image/png, image/jpeg">',
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
                                                'Gagal Absen, Periksa file',
                                                res.pesan,
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
                                            'Gagal Absen, 500',
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
                list_wfh(nip);
                //Jika whf hari ini ada yg aktif maka munculkan absen masuk, yg lain disembunyikan
                if (response.wfh_hari_ini_aktif > 0) {
                    // console.log('ada yg aktif'+response.wfh_hari_ini_aktif);
                    $('.hadir_masuk').hide()

                } else {
                    // console.log('tidak ada yg aktif'+response.wfh_hari_ini_aktif);

                    $('.absen_tengah').hide()
                    $('.absen_pulang').hide()

                    if (response.wfh_telah_diajukan > 0) {

                        $('.hadir_masuk').hide()
                    } else {
                        if (response.wfh_hari_ini_setuju > 0) {
                            $('.hadir_masuk').hide()
                        } else {
                            $('.hadir_masuk').show()

                        }
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

        function list_wfh(nip) {


            var table = $('#example').DataTable({
                "ajax": "<?php echo  site_url('wfh/api_list_where_nip?nip=') ?>" + nip,

                "columns": [{
                        "data": "id_wfh"
                    },
                    {
                        "data": "tgl_absen"
                    },
                    {
                        "data": "foto_absen_hadir"
                    },
                    {
                        "data": "jam_absen_hadir"
                    },
                    {
                        "data": "jam_absen_pertengahan"
                    },
                    {
                        "data": "jam_absen_pulang"
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
                    {
                        "data": "id_wfh",
                        "render": function(data, type, row) {
                            var key = (data);
                            return `
                                    <a href="<?php echo site_url('pegawai/wfh/logbook?id=') ?>` + key + ` "  class="btn btn-info btn-sm">Isi Log Book</a>
                                    <button onClick="add_kesehatan(` + key + `)"  class="btn btn-success btn-sm">Isi Kesehatan</button>
                    
                            `
                        }
                    }

                ],
                rowId: 'id_wfh',
                "bDestroy": true,
                "order": [
                    [1, "desc"],


                ]


            });
        }

        function absen_tengah() {
            $.ajax({
                'url': '<?php echo site_url('wfh/getJam') ?>',
                'method': 'GET',
                success: function(res) {
                    var id_pegawai = '<?php echo $nip ?>'
                    var tgl_absen = res.tanggal



                    Swal.fire({
                        title: 'Absen Pertengahan ?',
                        customClass: 'swal2-overflow',
                        showCancelButton: true,

                        cancelButtonColor: '#d33',

                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: "<?php echo site_url('wfh/absen_tengah') ?>",
                                method: 'POST',
                                data: {
                                    'id_pegawai': id_pegawai,
                                    'tgl_absen': tgl_absen,
                                },

                                success: function(json, status) {
                                    // console.log(json);
                                    list_wfh(id_pegawai)
                                    pegawai()
                                    // var res = JSON.parse(json)

                                    // console.log(res);

                                    // if (res.status == 1) {
                                    //     Swal.fire(
                                    //         'Absen Berhasil',
                                    //         '',
                                    //         'success'
                                    //     ).then(function(result) {
                                    //         location.reload();
                                    //     })


                                    // } else {
                                    //     Swal.fire(
                                    //         'Gagal Absen',
                                    //         '',
                                    //         'error'
                                    //     )
                                    // }
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


                        }
                    });

                },


            });

        }

        function absen_pulang() {
            $.ajax({
                'url': '<?php echo site_url('wfh/getJam') ?>',
                'method': 'GET',
                success: function(res) {
                    var id_pegawai = '<?php echo $nip ?>'
                    var tgl_absen = res.tanggal



                    Swal.fire({
                        title: 'Absen Pulang ?',
                        text: 'Apakah anda sudah mengisi Laporan?',
                        customClass: 'swal2-overflow',
                        showCancelButton: true,

                        cancelButtonColor: '#d33',

                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                url: "<?php echo site_url('wfh/absen_pulang') ?>",
                                method: 'POST',
                                data: {
                                    'id_pegawai': id_pegawai,
                                    'tgl_absen': tgl_absen,
                                },

                                success: function(json, status) {

                                    list_wfh(id_pegawai)

                                    pegawai()

                                    console.log(res);

                                    if (json.status == 1) {
                                        Swal.fire(
                                            'Absen Pulang Berhasil',
                                            json.pesan,
                                            'success'
                                        )

                                    } else {
                                        Swal.fire(
                                            'Gagal Absen Pulang',
                                            json.pesan,
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


                        }
                    });

                },


            });

        }

        function add_kesehatan(id) {
            $('#add_kesehatan').modal('toggle');
            var id_kes = id;
            $('#id_wfh').val(id_kes)


        }

        function tambah_kesehatan() {
            var demam = $(".demam:checked").val();
            var sesak = $(".sesak:checked").val();
            var batuk = $(".batuk:checked").val();
            var nyeri = $(".nyeri:checked").val();
            var id_wfh = $("#id_wfh").val();


            console.log(demam);
            console.log(batuk);
            console.log(sesak);
            console.log(nyeri);
            $.ajax({
                url: '<?php echo site_url('wfh/tambah_isi_kesehatan') ?>',
                method: 'POST',
                data: {
                    'demam': demam,
                    'sesak': sesak,
                    'batuk': batuk,
                    'nyeri': nyeri,
                    id_wfh
                },
                success: function(res) {
                    var res = JSON.parse(res)

                    if (res.status == 1) {
                        Swal.fire(
                            'Berhasil',
                            '',
                            'success'
                        )
                        location.reload();
                    } else {
                        Swal.fire(
                            'Gagal',
                            res.pesan,
                            'error'
                        )
                    }

                },
                errors: function(err) {
                    console.log(err);

                }
            })

        }
    </script>
</body>

</html>