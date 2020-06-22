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

    <link rel="stylesheet" href="<?php echo site_url('assets/css/daterangepicker.css') ?>">

    <!-- <link href="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.css" rel="stylesheet" media="screen"> -->



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">
    <!-- Light Box -->

    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/lightbox2/css/lightbox.css') ?>">



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

                <a href="<?php echo  site_url('self_assessment/pegawai') ?>" class="list-group-item list-group-item-action bg-light">Self Assessment <span class="badge badge-primary">New</span></a>



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



                <h3 class="mt-4">Selamat datang di Aplikasi Self Assessment BBKPM BANDUNG <br> <?php echo $this->session->nama_login ?></h3>


                <!-- Tombol Tambah Self Assessment -->
                <button type="button" class="btn btn-primary mt-4 add_self_assessment" onclick="add_self_assessment()">Tambah Self Assessment</button>

                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Tindak Lanjutan</h4>
                    <li></li>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div>


                <?php
                if ($this->session->nip == "320") {
                ?>
                    <label><b>Pilih Tanggal Untuk Mengunduh Laporan Rekap WFH</b></label>
                    <input type="text" class="form-control col-md-3" id="daterange" placeholder="Range Tanggal">

                <?php
                }
                ?>



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
    <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1" id="FormSelfAssessment" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Instrumen Selft Assessment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <small id="emailHelp" class="form-text text-muted">Demi kesehatan bersama.</small> <br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah pernah keluar rumah/ tempat umum (pasar, fasyankes, kerumunan orang, dan lain-lain) ?</label>
                        <br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input q1" type="radio" name="q1" id="inlineRadio1q1" value="1">
                            <label class="form-check-label" for="inlineRadio1q1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q1" type="radio" name="q1" id="inlineRadio2q1" value="0">
                            <label class="form-check-label" for="inlineRadio2q1">Tidak</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah pernah menggunakan transportasi umum ?</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q2" type="radio" name="q2" id="inlineRadio1q2" value="1">
                            <label class="form-check-label" for="inlineRadio1q2">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q2" type="radio" name="q2" id="inlineRadio2q2" value="0">
                            <label class="form-check-label" for="inlineRadio2q2">Tidak</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah pernah melakukan perjalanan keluar kota/internasional ? (wilayah yang terjangkit/ zona merah)</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q3" type="radio" name="q3" id="inlineRadio1q3" value="1">
                            <label class="form-check-label" for="inlineRadio1q3">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q3" type="radio" name="q3" id="inlineRadio2q3" value="0">
                            <label class="form-check-label" for="inlineRadio2q3">Tidak</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah anda mengikuti kegiatan yang melibatkan orang banyak ?</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q4" type="radio" name="q4" id="inlineRadio1q4" value="1">
                            <label class="form-check-label" for="inlineRadio1q4">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q4" type="radio" name="q4" id="inlineRadio2q4" value="0">
                            <label class="form-check-label" for="inlineRadio2q4">Tidak</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah memiliki riwayat kontak erat dengan orang yang dinyatakan ODP, PDP atau konfirm COVID-19 (berjabat tangan, berbicara, berada dalam satu ruangan/ satu rumah) ?</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q5" type="radio" name="q5" id="inlineRadio1q5" value="5">
                            <label class="form-check-label" for="inlineRadio1q5">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q5" type="radio" name="q5" id="inlineRadio2q5" value="0">
                            <label class="form-check-label" for="inlineRadio2q5">Tidak</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apakah pernah mengalami demam/ batuk/ pilek/ sakit tenggorokan/ sesak dalam 14 hari terakhir ?</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q6" type="radio" name="q6" id="inlineRadio1q6" value="5">
                            <label class="form-check-label" for="inlineRadio1q6">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input q6" type="radio" name="q6" id="inlineRadio2q6" value="0">
                            <label class="form-check-label" for="inlineRadio2q6">Tidak</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="q7">Isi Komorbid</label>
                        <small id="emailHelp" class="form-text text-muted">Isi komorbid sesuai yang anda derita. Contoh: <b>Sakit Kepala, Sakit lambung</b> </small>
                        <textarea name="q7" class="form-control" id="q7" cols="30" rows="10"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" onClick="submit()" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


    <script src="<?php echo site_url('assets/vendor/lightbox2/js/lightbox.js') ?>"></script>


    <script src="<?php echo site_url('assets/js/moment.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/daterangepicker.js') ?>"> </script>
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




                notif_password(response.pegawai.password)
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

                        $('.hadir_masuk').show()

                        //if (response.wfh_hari_ini_setuju > 0) {
                        //      $('.hadir_masuk').hide()
                        // } else {
                        //   $('.hadir_masuk').show()
                        // }
                    }
                }



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
                        "data": "foto_absen_hadir",
                        "render": function(data, type, row) {
                            let str = data
                            let str1 = str.split('-')
                            let char1 = str1['3'] + '-' + str1['4'] + '-' + str1['5']
                            let folder = char1.split('.')['0']


                            return '<a class="example-image-link" href="<?php echo site_url('uploads/wfh/') ?>' + folder + '/' + data + '" data-lightbox="example-set">' + data + '</a>'


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
                                    <button onClick="FormSelfAssessment(` + key + `)"  class="btn btn-success btn-sm">Isi Kesehatan</button>
                    
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

        function FormSelfAssessment(id) {
            $('#FormSelfAssessment').modal('toggle');
            var id_kes = id;
            $('#id_wfh').val(id_kes)


        }

        function add_self_assessment() {
            $('#FormSelfAssessment').modal('toggle')
            $('#FormSelfAssessment').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body input').val(recipient)
            })
        }

        function submit() {
            var q1 = $(".q1:checked").val();
            var q2 = $(".q2:checked").val();
            var q3 = $(".q3:checked").val();
            var q4 = $(".q4:checked").val();
            var q5 = $(".q5:checked").val();
            var q6 = $(".q6:checked").val();
            var q7 = $("#q7").val();

            $.ajax({
                url: '<?php echo site_url('Self_assessment/tambah') ?>',
                method: 'POST',
                data: {
                    'q1': q1,
                    'q2': q2,
                    'q3': q3,
                    'q4': q4,
                    'q5': q5,
                    'q6': q6,
                    'q7': q7,
                },
                success: function(res) {
                    // console.log(res);
                    if (res.status == 1) {
                        Swal.fire(
                            'Sukses',
                            res.pesan,
                            'success'
                        ).then(function(result) {
                            location.reload();
                        })
                    } else if (res.status == 2) {
                        Swal.fire(
                            'Gagal',
                            res.pesan,
                            'error'
                        ).then(function(result) {
                            location.reload();
                        })
                    } else {

                    }

                }
            })


        }

        function notif_password(pass) { //Function ini berfungsi jika passwordnya masih default maka kasih link ke lain
            if (pass == '8a9e7c2b32371723439f990d4beabb02') {
                console.log('Masih password default');

                $('#ganti_password').alert('show')
                // $('#Pbiodata').show()
                $('#Pbiodata').hide()
            } else {
                $('#Pbiodata').show()
                $('#ganti_password').alert('close')
                console.log('Bukn password default');
            }

        }



        $(function() {
            let date = new Date();
            $('#daterange').daterangepicker({
                opens: 'right',
                maxDate: date,
                locale: {
                    format: "DD-MM-YYYY"
                }
            }).on('apply.daterangepicker', function(ev, picker) {
                Swal.showLoading();
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo base_url("Approval/rekap") ?>");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.responseType = 'blob';

                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var fileURL = window.URL.createObjectURL(this.response);
                        var a = document.createElement("a");
                        a.setAttribute("target", "_blank");
                        a.href = fileURL;
                        a.show = "Rekap WFH.pdf";

                        document.body.appendChild(a);
                        a.click();
                        Swal.fire('Download Berhasil', '', 'success');
                        a.parentNode.removeChild(a);
                    }
                }

                var request_params = 'begin=' + $('#daterange').val().split(' / ')[0];
                request_params += '&end=' + $('#daterange').val().split(' / ')[1];
                xhr.send(request_params);
            });
        });
    </script>
</body>

</html>