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

    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">


    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/handsontable/handsontable.full.min.css') ?>">


    <!-- <link href="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.css" rel="stylesheet" media="screen"> -->



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">
    <style>
        .swal-wide {
            width: 850px !important;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('pegawai/sidebar.php'); ?>
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


                <h1 class="mt-4">Selamat datang di Sistem Informasi Penilaian Kinerja BBKPM BANDUNG</h1>
                <div class="form-group pb-4 ">

                    <input type="text" class="form-control col-md-3" name="birthday" placeholder="Sortir tahun remun" style="cursor: pointer;" />

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active bulan" id="januari-tab" data-bln="01" data-toggle="tab" href="#januari" role="tab" aria-controls="januari" aria-selected="true">Januari</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="februari-tab" data-bln="02" data-toggle="tab" href="#februari" role="tab" aria-controls="februari" aria-selected="false">Februari</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="maret-tab" data-bln="03" data-toggle="tab" href="#maret" role="tab" aria-controls="maret" aria-selected="false">Maret</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="april-tab" data-bln="04" data-toggle="tab" href="#april" role="tab" aria-controls="april" aria-selected="false">April</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="mai-tab" data-bln="05" data-toggle="tab" href="#mai" role="tab" aria-controls="mai" aria-selected="false">Mei</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="juni-tab" data-bln="06" data-toggle="tab" href="#juni" role="tab" aria-controls="juni" aria-selected="false">Juni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="juli-tab" data-bln="07" data-toggle="tab" href="#juli" role="tab" aria-controls="juli" aria-selected="false">Juli</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="agustus-tab" data-bln="08" data-toggle="tab" href="#agustus" role="tab" aria-controls="agustus" aria-selected="false">Agustus</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="september-tab" data-bln="09" data-toggle="tab" href="#september" role="tab" aria-controls="september" aria-selected="false">September</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="oktober-tab" data-bln="10" data-toggle="tab" href="#oktober" role="tab" aria-controls="oktober" aria-selected="false">Oktober</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="november-tab" data-bln="11" data-toggle="tab" href="#november" role="tab" aria-controls="november" aria-selected="false">November</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bulan" id="desember-tab" data-bln="12" data-toggle="tab" href="#desember" role="tab" aria-controls="desember" aria-selected="false">Desember</a>
                            </li>


                        </ul>
                        <div class="alert alert-danger mt-2" role="alert">
                            Harap disi yang berwarna hijau
                        </div>
                        <div class="row mt-2 container-fluid">

                            <button class="btn btn-primary btn-sm" id="ajukan">Ajukan ke atasan</button>





                            <button class="btn btn-success btn-sm" id="print"> <i class="fa fa-print" aria-hidden="true"></i>
                                Download Excel</button>

                            <!-- Label IKI -->

                            <button class="btn btn-success btn-sm " id="iki">IKI </button>
                        </div>

                        <h5 class="mt-4">Kuantitas</h5>
                        <div class="hot handsontable htRowHeaders htColumnHeaders mt-4" id="hot"></div>
                        <h5 class="mt-4">Kualitas</h5>
                        <div class="hot handsontable htRowHeaders htColumnHeaders mt-4" id="hot2"></div>
                        <h5 class="mt-4">Perilaku</h5>
                        <div class="hot handsontable htRowHeaders htColumnHeaders mt-4" id="hot3"></div>
                        <h5 class="mt-4">Tugas Tambahan</h5>
                        <div class="hot handsontable htRowHeaders htColumnHeaders mt-4" id="hot4"></div>
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


    <!-- bootstrap-datepicker -->
    <script src="<?php echo site_url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>">
    </script>


    <!-- Chart JS -->
    <script src="<?php echo site_url('assets/vendor/chartjs/Chart.min.js') ?>">
    </script>

    <!-- handsontable -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.js"></script> -->
    <script src="<?php echo site_url('assets/vendor/handsontable/handsontable.full.min.js') ?>"></script>

    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>

    <?php $this->load->view('_includes/js.php'); ?>


    <!-- handsontable -->
    <script>
        $(document).ready(function() {
            var bln = <?php echo $tahun ?> + '-01'




            document.getElementById("ajukan").setAttribute("data-bulan_remun", bln);
            // cekjml(bln)
            $("#ajukan").hide(); //Sembunyikan aJaukan

            $("#print").hide(); //Sembunyikan Download Excel










            // alert(bln)
            // Kuantitas
            var settings1 = {
                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=1",

                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings1).done(function(response1) {
                $("#hot").show();
                $("#ajukan").show();

                // var id_remun = response
                var dataremun1 = JSON.parse(response1)
                var remun1 = dataremun1.id_remun
                // console.log(remun);


                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun1 + "&bulan=" + bln + "&status=0",
                    type: "GET",

                    success: function(res1) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res1.indikator);
                        var iki = res1.jumalah_kierja
                        $('#iki').html('IKI = ' + iki)


                        if (res1.total == res1.status_belum_diajukan) {

                            $('#ajukan').html('Ajukan ke atasan')


                            document.getElementById("ajukan").removeAttribute("disabled")

                            document.getElementById("ajukan").setAttribute("data-bulan_remun", res1.bulan);
                            document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");
                            $("#print").hide(); //Sembunyikan Download Excel



                        }
                        if (res1.status_setuju == res1.total) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah diajukan')




                            //untuk tombol print
                            if (res1.validasi_cetak == res1.total_yang_dicetak) {

                                $("#print").show();
                                document.getElementById("print").setAttribute("data-cetak_bulan_remun", res1.bulan);
                            } else {
                                $("#print").hide(); //Sembunyikan Download Excel
                            }



                        }

                        if (res1.status_telah_disetujui == res1.total) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah Disetujui')

                            //untuk tombol print
                            if (res1.validasi_cetak == res1.total_yang_dicetak) {

                                $("#print").show();
                                document.getElementById("print").setAttribute("data-cetak_bulan_remun", res1.bulan);
                            } else {
                                $("#print").hide(); //Sembunyikan Download Excel
                            }


                        }

                        if (res1.status_diajukan == 0 && res1.status_setuju == 0 && res1.status_belum_diajukan == 0 && res1.status_telah_disetujui == 0) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah diajukan')

                            if (res1.validasi_cetak == res1.total_yang_dicetak) {

                                $("#print").show();
                                document.getElementById("print").setAttribute("data-cetak_bulan_remun", res1.bulan);
                            } else {
                                $("#print").hide(); //Sembunyikan Download Excel
                            }




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


            });
            // Kuantitas
            var settings3 = {

                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=3",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings3).done(function(response3) {


                // var id_remun = response
                var dataremun3 = JSON.parse(response3)
                var remun3 = dataremun3.id_remun
                // console.log(remun);

                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun3 + "&bulan=" + bln + "&status=0",
                    type: "GET",

                    success: function(res3) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot2.loadData(res3.indikator);

                        $("#myTab a[href='#01#" + remun3 + "']").tab('show');



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


            });
            var settings4 = {
                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=4",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings4).done(function(response4) {


                // var id_remun = response
                var dataremun4 = JSON.parse(response4)
                var remun4 = dataremun4.id_remun
                // console.log(remun);
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun4 + "&bulan=" + bln + "&status=0",
                    type: "GET",

                    success: function(res4) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot3.loadData(res4.indikator);
                        $("#myTab a[href='#01#" + remun4 + "']").tab('show');



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


            });
            var settings5 = {
                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=5",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings5).done(function(response) {


                // var id_remun = response
                var dataremun = JSON.parse(response)
                var remun = dataremun.id_remun
                // console.log(remun);
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln + "&status=0",

                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot4.loadData(res.indikator);


                        $("#myTab a[href='#01#" + remun + "']").tab('show');



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


            });




            $(".bulan").on("click", function(data) {
                // alert('sdsa')
                var bln = <?php echo $tahun ?> + '-' + this.dataset.bln
                document.getElementById("ajukan").setAttribute("data-bulan_remun", bln);
                cekjml(bln)
                // alert(bln)
                var settings1 = {

                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=1",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings1).done(function(response1) {


                    // var id_remun = response
                    var dataremun1 = JSON.parse(response1)
                    var remun1 = dataremun1.id_remun
                    // console.log(remun);

                    $.ajax({

                        url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun1 + "&bulan=" + bln + "&status=0",
                        type: "GET",

                        success: function(res1) {
                            // $('#myTabContent').html(res)
                            // console.log(res);

                            $("#ajukan").show();


                            hot1.loadData(res1.indikator);
                            var iki = res1.jumalah_kierja
                            $('#iki').html('IKI = ' + iki)
                            if (res1.total == res1.status_belum_diajukan) {

                                $('#ajukan').html('Ajukan ke atasan')

                                document.getElementById("ajukan").removeAttribute("disabled")

                                document.getElementById("ajukan").setAttribute("data-bulan_remun", res1.bulan);
                                document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");
                                $("#print").hide(); //Sembunyikan Download Excel



                            }
                            if (res1.status_setuju == res1.total) {

                                document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                document.getElementById("ajukan").setAttribute("disabled", true);
                                $('#ajukan').html('Telah diajukan')




                                //untuk tombol print
                                if (res1.validasi_cetak == res1.total_yang_dicetak) {

                                    $("#print").show();
                                    document.getElementById("print").setAttribute("data-cetak_bulan_remun", res1.bulan);
                                } else {
                                    $("#print").hide(); //Sembunyikan Download Excel
                                }



                            }

                            if (res1.status_telah_disetujui == res1.total) {

                                document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                                document.getElementById("ajukan").setAttribute("disabled", true);
                                $('#ajukan').html('Telah Disetujui')

                                //untuk tombol print
                                if (res1.validasi_cetak == res1.total_yang_dicetak) {

                                    $("#print").show();
                                    document.getElementById("print").setAttribute("data-cetak_bulan_remun", res1.bulan);
                                } else {
                                    $("#print").hide(); //Sembunyikan Download Excel
                                }


                            }

                            if (res1.status_diajukan == 0 && res1.status_setuju == 0 && res1.status_belum_diajukan == 0 && res1.status_telah_disetujui == 0) {

                                document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                document.getElementById("ajukan").setAttribute("disabled", true);
                                $('#ajukan').html('Telah diajukan')

                                if (res1.validasi_cetak == res1.total_yang_dicetak) {

                                    $("#print").show();
                                    document.getElementById("print").setAttribute("data-cetak_bulan_remun", res1.bulan);
                                } else {
                                    $("#print").hide(); //Sembunyikan Download Excel
                                }




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


                });

                var settings3 = {

                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=3",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings3).done(function(response3) {


                    // var id_remun = response
                    var dataremun3 = JSON.parse(response3)
                    var remun3 = dataremun3.id_remun
                    // console.log(remun);
                    $.ajax({

                        url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun3 + "&bulan=" + bln + "&status=0",
                        type: "GET",

                        success: function(res3) {
                            // $('#myTabContent').html(res)
                            // console.log(res);
                            hot2.loadData(res3.indikator);
                            $("#myTab a[href='#01#" + remun3 + "']").tab('show');



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


                });
                var settings4 = {

                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=4",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings4).done(function(response4) {


                    // var id_remun = response
                    var dataremun4 = JSON.parse(response4)
                    var remun4 = dataremun4.id_remun
                    // console.log(remun);
                    $.ajax({

                        url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun4 + "&bulan=" + bln + "&status=0",
                        type: "GET",

                        success: function(res4) {
                            // $('#myTabContent').html(res)
                            // console.log(res);
                            hot3.loadData(res4.indikator);
                            $("#myTab a[href='#01#" + remun4 + "']").tab('show');



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


                });
                var settings5 = {

                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip") ?>&id_penilaian=5",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings5).done(function(response) {


                    // var id_remun = response
                    var dataremun = JSON.parse(response)
                    var remun = dataremun.id_remun
                    // console.log(remun);
                    $.ajax({

                        url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln + "&status=0",

                        type: "GET",

                        success: function(res) {
                            // $('#myTabContent').html(res)
                            // console.log(res);
                            hot4.loadData(res.indikator);
                            $("#myTab a[href='#01#" + remun + "']").tab('show');



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


                });


            })

            $("#ajukan").on("click", function(data) {
                var bln = this.dataset.bulan_remun

                var ajukan = confirm('Remun pada bulan ini akan Ajukan ?, harap cek kembali')
                var nip = '<?php echo $pegawai->nip ?>'
                if (ajukan) {
                    var settingsajukan = {

                        "url": "<?php echo site_url("api/remun/ajukanv2?nip=$pegawai->nip") ?>&bulan=" + bln,
                        "method": "GET",
                        "timeout": 0,
                    };

                    $.ajax(settingsajukan).done(function(response) {
                        // console.log(response);
                        if (response.status == 'Berhasil') {
                            alert(response.status)
                            location.reload();
                        }
                    });

                } else {
                    alert('Tidak jadi')
                }
            })


            //Tombol Print Remun
            $("body").on("click", "#print", function(e) {
                var bulan = this.dataset.cetak_bulan_remun
                // console.log(bulan343);
                Swal.fire({
                    title: 'Download IKI?',
                    // html: `
                    // <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.learningaboutelectronics.com/Articles/Example.xlsx' width='100%' height='565px' frameborder='0'> </iframe>
                    // `,
                    // text: "Print jika data telah sesuai",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<i class="fa fa-download" aria-hidden="true"> Ya ! '
                }).then((result) => {
                    // console.log(bulan);

                    if (result.value) {
                        var url = "<?php echo site_url('remun/cetak_remun?bulan=') ?>" + bulan + '&id=' + <?php echo $pegawai->nip ?>;
                        window.location = url;
                        //     Swal.fire(
                        //         'Print!',
                        //         'Your file has been deleted.',
                        //         'success'
                        //     )
                    }
                })
            })


            var hotElement1 = document.querySelector('#hot');
            var hotElement2 = document.querySelector('#hot2');
            var hotElement3 = document.querySelector('#hot3');
            var hotElement4 = document.querySelector('#hot4');
            var hotElementContainer1 = hotElement1.parentNode;
            var hotElementContainer2 = hotElement2.parentNode;
            var hotElementContainer3 = hotElement3.parentNode;
            var hotElementContainer4 = hotElement4.parentNode;


            var hotSettings1 = {
                // data: Dataremun,
                columns: [{

                        //ini Indikator
                        data: 'id_capaian',
                        type: 'text',
                        readOnly: true,

                    },
                    {

                        //ini Indikator
                        data: 'indikator',
                        type: 'text',
                        readOnly: true,
                        width: 300
                    },
                    {
                        //Ini Defisini
                        data: 'definisi',
                        type: 'text',
                        readOnly: true,
                        width: 300
                        // renderer: flagRenderer

                    },
                    {
                        //Ini Defisini
                        data: 'range_target12',
                        type: 'text',
                        readOnly: true,
                        width: 100
                        // renderer: flagRenderer

                    },
                    {
                        //ini target
                        data: 'target_perbulan',
                        type: 'text',
                        readOnly: true

                    },
                    {
                        // Ini Capaian
                        data: 'capaian',
                        type: 'numeric',
                        numericFormat: {
                            pattern: '0.00%'
                        }
                    },
                    {
                        // ini Bobot
                        data: 'bobot',
                        type: 'text',
                        readOnly: true,

                    },

                    {
                        data: 'hasil_kinerja2',
                        readOnly: true
                    },
                    {
                        data: 'status',
                        readOnly: true
                    },
                    {
                        data: 'nama_approved_by',
                        readOnly: true
                    },
                    {
                        data: 'nama_return_by',
                        readOnly: true
                    },
                ],
                stretchH: 'all',
                width: 800,
                height: 400,
                autoWrapRow: true,
                maxRows: 22,
                rowHeaders: true,
                id: 'id_capaian',
                colHeaders: [
                    'Id',
                    'Indikator yang dinilai',
                    'Definisi operasional',
                    'Range',
                    'Target',
                    'Capaian',
                    'Bobot',
                    'Hasil nilai kinerja',
                    'Status',
                    'Disetujui oleh',
                    'Dikembalikan oleh',

                ],

                //Menyembunyikan Clolom
                hiddenColumns: {
                    columns: [0],
                    indicators: false
                },
                manualRowResize: true,
                manualColumnResize: true,
                afterChange: function(changes, source) {

                    if (changes) {
                        var c = confirm('simpan ?');
                        if (c) {
                            changes.forEach(function(change) {

                                var id_capaian = hot1.getDataAtRow(changes[0][0])[0]
                                var target = hot1.getDataAtRow(changes[0][0])[4]
                                var bobot = hot1.getDataAtRow(changes[0][0])[6]



                                $.ajax({
                                    url: '<?php echo base_url("api/remun/update_capaian") ?>',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: {
                                        id_capaian: id_capaian,
                                        target: target,
                                        bobot: bobot,
                                        changes: changes
                                    }, // contains changed cells' data
                                    success: function(respon) {
                                        var myStr = respon.bulan;

                                        var strArray = myStr.split("-");

                                        $.ajax({

                                            url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=0",
                                            type: "GET",

                                            success: function(res) {
                                                // $('#myTabContent').html(res)
                                                // console.log(res);
                                                hot1.loadData(res.indikator);
                                                var iki = res.jumalah_kierja
                                                $('#iki').html('IKI = ' + iki)
                                                if (res.total == res.status_belum_diajukan) {

                                                    $('#ajukan').html('Ajukan ke atasan')

                                                    document.getElementById("ajukan").removeAttribute("disabled")
                                                    document.getElementById("ajukan").setAttribute("data-remun", respon.id_remun);
                                                    document.getElementById("ajukan").setAttribute("data-bulan_remun", res.bulan);
                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");
                                                    $("#print").hide(); //Sembunyikan Download Excel

                                                }

                                                if (res.status_setuju == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }

                                                if (res.status_diajukan == 0 && res.status_setuju == 0 && res.status_belum_diajukan == 0 && res.status_telah_disetujui == 0) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }


                                                if (res.status_telah_disetujui == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah Disetujui')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }

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

                                    }
                                })

                            });
                        } else {
                            alert('batal')
                        }
                    }



                },
                cells: function(row, col, prop) {
                    let cellProperties = {};
                    var hot = this.instance;
                    // if (col == 3) {
                    //     if (
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    //     ) {
                    //         cellProperties.renderer = redCell;
                    //         cellProperties.readOnly = true;

                    //     }
                    // }


                    if (col == 5) {
                        // console.log(rass);

                        if (
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"
                            // ||
                            // (stripos(hot.getDataAtCell(row, hot.colToProp(1)), "senam") == false)
                        ) {

                            cellProperties.renderer = redCell;
                            cellProperties.readOnly = true;

                        } else {

                            cellProperties.renderer = greenCell;
                        }

                    }

                    if ((col == 5) && hot.getDataAtCell(row, hot.colToProp(8)) != 0) {
                        cellProperties.readOnly = true;
                        cellProperties.renderer = redCell;


                    }

                    if ((col == 8) && hot.getDataAtCell(row, hot.colToProp(8)) > 0) {
                        cellProperties.renderer = status;

                    }

                    if ((col == 8) && hot.getDataAtCell(row, hot.colToProp(8)) == 0) {
                        cellProperties.renderer = status;
                    }


                    return cellProperties;

                }


            };
            var hotSettings2 = {
                // data: Dataremun,
                columns: [{

                        //ini Indikator
                        data: 'id_capaian',
                        type: 'text',
                        readOnly: true,

                    },
                    {

                        //ini Indikator
                        data: 'indikator',
                        type: 'text',
                        readOnly: true,
                        width: 300
                    },
                    {
                        //Ini Defisini
                        data: 'definisi',
                        type: 'text',
                        readOnly: true,
                        width: 300
                        // renderer: flagRenderer

                    },
                    {
                        //ini target
                        data: 'target_perbulan',
                        type: 'text',
                        readOnly: true

                    },
                    {
                        // Ini Capaian
                        data: 'capaian',
                        type: 'numeric',
                        numericFormat: {
                            pattern: '0.00%'
                        }
                    },
                    {
                        // ini Bobot
                        data: 'bobot',
                        type: 'text',
                        readOnly: true,

                    },

                    {
                        data: 'hasil_kinerja2',
                        readOnly: true
                    },
                    {
                        data: 'status',
                        readOnly: true
                    },
                    {
                        data: 'nama_approved_by',
                        readOnly: true
                    },
                    {
                        data: 'nama_return_by',
                        readOnly: true
                    },
                ],
                stretchH: 'all',
                width: 800,
                height: 400,
                autoWrapRow: true,
                maxRows: 22,
                rowHeaders: true,
                id: 'id_capaian',
                colHeaders: [
                    'Id',
                    'Indikator yang dinilai',
                    'Definisi operasional',
                    'Target',
                    'Capaian',
                    'Bobot',
                    'Hasil nilai kinerja',
                    'Status',
                    'Disetujui oleh',
                    'Dikembalikan oleh',

                ],

                //Menyembunyikan Clolom
                hiddenColumns: {
                    columns: [0],
                    indicators: false
                },
                manualRowResize: true,
                manualColumnResize: true,
                afterChange: function(changes, source) {

                    if (changes) {
                        var c = confirm('simpan');
                        if (c) {
                            changes.forEach(function(change) {

                                var id_capaian = hot2.getDataAtRow(changes[0][0])[0]
                                var target = hot2.getDataAtRow(changes[0][0])[3]
                                var bobot = hot2.getDataAtRow(changes[0][0])[5]

                                // console.log(id_capaian);


                                $.ajax({
                                    url: '<?php echo base_url("api/remun/update_capaian") ?>',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: {
                                        id_capaian: id_capaian,
                                        target: target,
                                        bobot: bobot,
                                        changes: changes
                                    }, // contains changed cells' data
                                    success: function(respon) {
                                        var myStr = respon.bulan;

                                        var strArray = myStr.split("-");

                                        $.ajax({

                                            url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=0",
                                            type: "GET",

                                            success: function(res) {
                                                // $('#myTabContent').html(res)
                                                // console.log(res);
                                                hot2.loadData(res.indikator);
                                                if (res.total == res.status_belum_diajukan) {

                                                    $('#ajukan').html('Ajukan ke atasan')

                                                    document.getElementById("ajukan").removeAttribute("disabled")
                                                    document.getElementById("ajukan").setAttribute("data-remun", respon.id_remun);
                                                    document.getElementById("ajukan").setAttribute("data-bulan_remun", res.bulan);
                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");
                                                    $("#print").hide(); //Sembunyikan Download Excel

                                                }

                                                if (res.status_setuju == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }

                                                if (res.status_diajukan == 0 && res.status_setuju == 0 && res.status_belum_diajukan == 0 && res.status_telah_disetujui == 0) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }


                                                if (res.status_telah_disetujui == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah Disetujui')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }

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

                                    }
                                })

                            });
                        } else {
                            alert('batal')
                        }
                    }



                },
                cells: function(row, col, prop) {
                    let cellProperties = {};
                    var hot = this.instance;
                    // if (col == 3) {
                    //     if (
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    //     ) {
                    //         cellProperties.renderer = redCell;
                    //         cellProperties.readOnly = true;

                    //     }
                    // }


                    if (col == 4) {
                        // console.log(rass);

                        if (
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"
                            // ||
                            // (stripos(hot.getDataAtCell(row, hot.colToProp(1)), "senam") == false)
                        ) {

                            cellProperties.renderer = redCell;
                            cellProperties.readOnly = true;

                        } else {

                            cellProperties.renderer = greenCell;
                        }

                    }

                    if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) != 0) {
                        cellProperties.readOnly = true;
                        cellProperties.renderer = redCell;


                    }

                    if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) > 0) {
                        cellProperties.renderer = status;

                    }

                    if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == 0) {
                        cellProperties.renderer = status;
                    }


                    return cellProperties;

                }


            };
            var hotSettings3 = {
                // data: Dataremun,
                columns: [{

                        //ini Indikator
                        data: 'id_capaian',
                        type: 'text',
                        readOnly: true,

                    },
                    {

                        //ini Indikator
                        data: 'indikator',
                        type: 'text',
                        readOnly: true,
                        width: 300
                    },
                    {
                        //Ini Defisini
                        data: 'definisi',
                        type: 'text',
                        readOnly: true,
                        width: 300
                        // renderer: flagRenderer

                    },
                    {
                        //ini target
                        data: 'target_perbulan',
                        type: 'text',
                        readOnly: true

                    },
                    {
                        // Ini Capaian
                        data: 'capaian',
                        type: 'numeric',
                        numericFormat: {
                            pattern: '0.00%'
                        }
                    },
                    {
                        // ini Bobot
                        data: 'bobot',
                        type: 'text',
                        readOnly: true,

                    },

                    {
                        data: 'hasil_kinerja2',
                        readOnly: true
                    },
                    {
                        data: 'status',
                        readOnly: true
                    },
                    {
                        data: 'nama_approved_by',
                        readOnly: true
                    },
                    {
                        data: 'nama_return_by',
                        readOnly: true
                    },
                ],
                stretchH: 'all',
                width: 800,
                height: 400,
                autoWrapRow: true,
                maxRows: 22,
                rowHeaders: true,
                id: 'id_capaian',
                colHeaders: [
                    'Id',
                    'Indikator yang dinilai',
                    'Definisi operasional',
                    'Target',
                    'Capaian',
                    'Bobot',
                    'Hasil nilai kinerja',
                    'Status',
                    'Disetujui oleh',
                    'Dikembalikan oleh',

                ],

                //Menyembunyikan Clolom
                hiddenColumns: {
                    columns: [0],
                    indicators: false
                },
                manualRowResize: true,
                manualColumnResize: true,
                afterChange: function(changes, source) {

                    if (changes) {
                        var c = confirm('simpan');
                        if (c) {
                            changes.forEach(function(change) {

                                var id_capaian = hot1.getDataAtRow(changes[0][0])[0]
                                var target = hot1.getDataAtRow(changes[0][0])[3]
                                var bobot = hot1.getDataAtRow(changes[0][0])[5]

                                $.ajax({
                                    url: '<?php echo base_url("api/remun/update_capaian") ?>',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: {
                                        id_capaian: id_capaian,
                                        target: target,
                                        bobot: bobot,
                                        changes: changes
                                    }, // contains changed cells' data
                                    success: function(respon) {
                                        var myStr = respon.bulan;

                                        var strArray = myStr.split("-");

                                        $.ajax({

                                            url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=0",
                                            type: "GET",

                                            success: function(res) {
                                                // $('#myTabContent').html(res)
                                                // console.log(res);
                                                hot1.loadData(res.indikator);
                                                var iki = res.jumalah_kierja
                                                   $('#iki').html('IKI = '+iki)
                                                if (res.total == res.status_belum_diajukan) {

                                                    $('#ajukan').html('Ajukan ke atasan')

                                                    document.getElementById("ajukan").removeAttribute("disabled")
                                                    document.getElementById("ajukan").setAttribute("data-remun", respon.id_remun);
                                                    document.getElementById("ajukan").setAttribute("data-bulan_remun", res.bulan);
                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");
                                                    $("#print").hide(); //Sembunyikan Download Excel

                                                }

                                                if (res.status_setuju == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }

                                                if (res.status_diajukan == 0 && res.status_setuju == 0 && res.status_belum_diajukan == 0 && res.status_telah_disetujui == 0) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }


                                                if (res.status_telah_disetujui == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah Disetujui')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }

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

                                    }
                                })

                            });
                        } else {
                            alert('batal')
                        }
                    }



                },
                cells: function(row, col, prop) {
                    let cellProperties = {};
                    var hot = this.instance;
                    // if (col == 3) {
                    //     if (
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    //     ) {
                    //         cellProperties.renderer = redCell;
                    //         cellProperties.readOnly = true;

                    //     }
                    // }


                    if (col == 4) {
                        // console.log(rass);

                        if (
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"
                            // ||
                            // (stripos(hot.getDataAtCell(row, hot.colToProp(1)), "senam") == false)
                        ) {

                            cellProperties.renderer = redCell;
                            cellProperties.readOnly = true;

                        } else {

                            cellProperties.renderer = greenCell;
                        }

                    }

                    if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) != 0) {
                        cellProperties.readOnly = true;
                        cellProperties.renderer = redCell;


                    }

                    if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) > 0) {
                        cellProperties.renderer = status;

                    }

                    if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == 0) {
                        cellProperties.renderer = status;
                    }


                    return cellProperties;

                }


            };
            var hotSettings4 = {
                // data: Dataremun,
                columns: [{

                        //ini Indikator
                        data: 'id_capaian',
                        type: 'text',
                        readOnly: true,

                    },
                    {

                        //ini Indikator
                        data: 'indikator',
                        type: 'text',
                        readOnly: true,
                        width: 300
                    },
                    {
                        //Ini Defisini
                        data: 'definisi',
                        type: 'text',
                        readOnly: true,
                        width: 300
                        // renderer: flagRenderer

                    },
                    {
                        //ini target
                        data: 'target_perbulan',
                        type: 'text',
                        readOnly: true

                    },
                    {
                        // Ini Capaian
                        data: 'capaian',
                        type: 'numeric',
                        numericFormat: {
                            pattern: '0.00%'
                        }
                    },
                    {
                        // ini Bobot
                        data: 'bobot',
                        type: 'text',
                        readOnly: true,

                    },

                    {
                        data: 'hasil_kinerja2',
                        readOnly: true
                    },
                    {
                        data: 'status',
                        readOnly: true
                    },
                    {
                        data: 'nama_approved_by',
                        readOnly: true
                    },
                    {
                        data: 'nama_return_by',
                        readOnly: true
                    },
                ],
                stretchH: 'all',
                width: 800,
                height: 400,
                autoWrapRow: true,
                maxRows: 22,
                rowHeaders: true,
                id: 'id_capaian',
                colHeaders: [
                    'Id',
                    'Indikator yang dinilai',
                    'Definisi operasional',
                    'Target',
                    'Capaian',
                    'Bobot',
                    'Hasil nilai kinerja',
                    'Status',
                    'Disetujui oleh',
                    'Dikembalikan oleh',

                ],

                //Menyembunyikan Clolom
                hiddenColumns: {
                    columns: [0],
                    indicators: false
                },
                manualRowResize: true,
                manualColumnResize: true,
                afterChange: function(changes, source) {

                    if (changes) {
                        var c = confirm('Simpan Tugas Tambahan');
                        if (c) {
                            changes.forEach(function(change) {

                                var id_capaian = hot4.getDataAtRow(changes[0][0])[0]
                                var target = hot4.getDataAtRow(changes[0][0])[3]
                                var bobot = hot4.getDataAtRow(changes[0][0])[5]

                                // console.log(id_capaian);


                                $.ajax({
                                    url: '<?php echo base_url("api/remun/update_capaian") ?>',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: {
                                        id_capaian: id_capaian,
                                        target: target,
                                        bobot: bobot,
                                        changes: changes
                                    }, // contains changed cells' data
                                    success: function(respon) {
                                        var myStr = respon.bulan;

                                        var strArray = myStr.split("-");

                                        $.ajax({

                                            url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=0",
                                            type: "GET",

                                            success: function(res) {
                                                // $('#myTabContent').html(res)
                                                // console.log(res);
                                                hot1.loadData(res.indikator);
                                                if (res.total == res.status_belum_diajukan) {

                                                    $('#ajukan').html('Ajukan ke atasan')

                                                    document.getElementById("ajukan").removeAttribute("disabled")
                                                    document.getElementById("ajukan").setAttribute("data-remun", respon.id_remun);
                                                    document.getElementById("ajukan").setAttribute("data-bulan_remun", res.bulan);
                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");
                                                    $("#print").hide(); //Sembunyikan Download Excel

                                                }

                                                if (res.status_setuju == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }

                                                if (res.status_diajukan == 0 && res.status_setuju == 0 && res.status_belum_diajukan == 0 && res.status_telah_disetujui == 0) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah diajukan')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }



                                                }


                                                if (res.status_telah_disetujui == res.total) {

                                                    document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                                                    document.getElementById("ajukan").setAttribute("disabled", true);
                                                    $('#ajukan').html('Telah Disetujui')

                                                    //untuk tombol print
                                                    if (res.validasi_cetak == res.total_yang_dicetak) {

                                                        $("#print").show();
                                                        document.getElementById("print").setAttribute("data-cetak_bulan_remun", res.bulan);
                                                    } else {
                                                        $("#print").hide(); //Sembunyikan Download Excel
                                                    }

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

                                    }
                                })

                            });
                        } else {
                            alert('batal')
                        }
                    }



                },
                cells: function(row, col, prop) {
                    let cellProperties = {};
                    var hot = this.instance;
                    // if (col == 3) {
                    //     if (
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                    //         hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    //     ) {
                    //         cellProperties.renderer = redCell;
                    //         cellProperties.readOnly = true;

                    //     }
                    // }


                    if (col == 4) {
                        // console.log(rass);

                        if (
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                            hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"
                            // ||
                            // (stripos(hot.getDataAtCell(row, hot.colToProp(1)), "senam") == false)
                        ) {

                            cellProperties.renderer = redCell;
                            cellProperties.readOnly = true;

                        } else {

                            cellProperties.renderer = greenCell;
                        }

                    }

                    if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) != 0) {
                        cellProperties.readOnly = true;
                        cellProperties.renderer = redCell;


                    }

                    if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) > 0) {
                        cellProperties.renderer = status;

                    }

                    if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == 0) {
                        cellProperties.renderer = status;
                    }


                    return cellProperties;

                }


            };

            var hot1 = new Handsontable(hotElement1, hotSettings1);

            var hot2 = new Handsontable(hotElement2, hotSettings2);
            var hot3 = new Handsontable(hotElement3, hotSettings3);
            var hot4 = new Handsontable(hotElement4, hotSettings4);


            //Warna Cell Hijau
            function greenCell(instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                td.style.background = '#CEC';

            };
            //Warna Cell Merah
            function redCell(instance, td, row, col, prop, value, cellPorperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                td.style.background = '#ffc0cb';
            };

            function status(instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                if (value < 1) {
                    td.innerHTML = 'Belum diajukan'
                } else {
                    td.innerHTML = 'Sudah diajukan'

                }

            }

        });




        function cekjml(bln) {
            var apicekjml = {

                "url": "<?php echo site_url("api/remun/remunbynipandbln?nip=$pegawai->nip") ?>&bulan=" + bln,
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(apicekjml).done(function(response) {

                if (response.jumlah == 0) {
                    $("#ajukan").hide(); //Sembunyikan Download Excel
                    $("#telahdiajukan").show(); //Sembunyikan Download Excel
                } else {
                    $("#telahdiajukan").hide(); //Sembunyikan Download Excel
                    $("#ajukan").show(); //Sembunyikan Download Excel

                }

            });
        }
    </script>


    <script>
        $(function() {


            // console.log(ink);

            $('input[name="birthday"]').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
            });
        }).on('changeDate', function(e) {
            var date = $('input[name="birthday"]').datepicker('getDate');
            var ink = '<?php echo site_url("pegawai?id=" . $pegawai->nip . "&token=" . $pegawai->nip) ?>'
            year = date.getFullYear();
            var link = ink + '&tahun=' + year

            toastr.info('Sortir tahun dipilih ' + year, 'Info')
            location.replace(link)

        });
    </script>


</body>

</html>