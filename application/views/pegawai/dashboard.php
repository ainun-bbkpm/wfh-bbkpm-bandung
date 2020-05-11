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
                        <!-- List Usulan Penilaian -->
                        <div class="row">
                            <div class="col-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <?php
                                    $no = 1;
                                    foreach ($remun_all->result() as $remun) {

                                    ?>
                                        <a class="nav-link penilaian <?php echo $no == 1 ? 'active' : '' ?>" data-id_remun="<?php echo $remun->id_remun ?>" id="v-pills-<?php echo $remun->id_penilaian ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $remun->id_penilaian ?>" role="tab" aria-controls="v-pills-<?php echo $remun->id_penilaian ?>" aria-selected="true"><?php echo $remun->nama_penilaian ?></a>

                                    <?php
                                        # code...
                                        $no++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <?php
                                    $no = 1;
                                    foreach ($remun_all->result() as $remun2) {

                                    ?>
                                        <div class="tab-pane fade show <?php echo $no == 1 ? 'active' : '' ?>" id="v-pills-<?php echo $remun2->id_penilaian ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $remun2->id_penilaian ?>-tab">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item ">
                                                    <a class="nav-link penilaian_bulan active " data-remun="<?php echo $remun2->id_remun ?>" id="01" data-toggle="tab" href="#01#<?php echo $remun2->id_remun ?>" role="tab" aria-selected="true">Januari</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="02" data-toggle="tab" href="#02#<?php echo $remun2->id_remun ?>" role="tab" aria-selected="false">Februari</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="03" data-toggle="tab" href="#03#<?php echo $remun2->id_remun ?>" role="tab" aria-selected="false">Maret</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="04" data-toggle="tab" href="#04" role="tab" aria-selected="true">April</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="05" data-toggle="tab" href="#05" role="tab" aria-selected="false">Mei</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="06" data-toggle="tab" href="#06" role="tab" aria-selected="false">Juni</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="07" data-toggle="tab" href="#01" role="tab" aria-selected="true">Juli</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="08" data-toggle="tab" href="#02" role="tab" aria-selected="false">Agustus</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="09" data-toggle="tab" href="#03" role="tab" aria-selected="false">September</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="10" data-toggle="tab" href="#04" role="tab" aria-selected="true">Oktober</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="11" data-toggle="tab" href="#05" role="tab" aria-selected="false">November</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link penilaian_bulan" data-remun="<?php echo $remun2->id_remun ?>" id="12" data-toggle="tab" href="#06" role="tab" aria-selected="false">Desember</a>
                                                </li>
                                            </ul>




                                        </div>



                                    <?php
                                        # code...
                                        $no++;
                                    }
                                    ?>
                                    <!-- HandsonTable -->

                                    <div class="hot handsontable htRowHeaders htColumnHeaders mt-4" id="hot"></div>

                                    <button class="btn btn-primary btn-sm" id="ajukan">Ajukan ke atasan</button>



                                    <button class="btn btn-success btn-sm" id="print"> <i class="fa fa-print" aria-hidden="true"></i>
                                        Download Excel</button>


                                </div>
                            </div>
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
        //Warna Cell Merah
        function redCell(instance, td, row, col, prop, value, cellPorperties) {
            hot1.renderers.TextRenderer.apply(this, arguments);
            td.style.background = '#ffc0cb';
        };



        $(document).ready(function() {
            $("#hot").hide(); //Sembunyikan HOT
            $("#ajukan").hide(); //Sembunyikan aJaukan

            $("#print").hide(); //Sembunyikan Download Excel


            //Tombol Penilaian Kuantitas
            $("#v-pills-1-tab").on("click", function(data) {
                $("#hot").show();
                $("#ajukan").show();


                var remun = this.dataset.id_remun
                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id
                //untuk tombol print
                // document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln3);
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln3 + "&status=0",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res.indikator[0].nama_approved_by);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#" + remun + "']").tab('show');

                        if (res.total == res.status_belum_diajukan) {

                            $('#ajukan').html('Ajukan ke atasan')

                            document.getElementById("ajukan").removeAttribute("disabled")
                            document.getElementById("ajukan").setAttribute("data-remun", remun);
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

                        if (res.status_diajukan == 0 && res.status_setuju == 0 && res.status_belum_diajukan == 0 && res.status_telah_disetujui == 0) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah diajukan')

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

            });

            //tombol peniliaian Kualitas
            $("#v-pills-3-tab").on("click", function(data) {
                $("#hot").show();
                $("#ajukan").show();
                $("#approved").show();
                var remun = this.dataset.id_remun
                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id

                //untuk tombol print
                // document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln3);
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln3 + "&status=0",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res.indikator[0].nama_approved_by);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#" + remun + "']").tab('show');

                        if (res.total == res.status_belum_diajukan) {

                            $('#ajukan').html('Ajukan ke atasan')

                            document.getElementById("ajukan").removeAttribute("disabled")
                            document.getElementById("ajukan").setAttribute("data-remun", remun);
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

                        if (res.status_telah_disetujui == res.total) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah Disetujui')

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
                            var nama_approved = res.indikator[0].nama_approved_by

                            $('#approved').html('Approved by ' + nama_approved)
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

            });

            //Tombol penilaian Perilaku
            $("#v-pills-4-tab").on("click", function(data) {
                $("#hot").show();
                $("#ajukan").show();

                var remun = this.dataset.id_remun
                var bln4 = <?php echo $tahun ?> + "-01" //diambil dari id
                //untuk tombol print
                // document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln4);
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln4 + "&status=0",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#" + remun + "']").tab('show');
                        if (res.total == res.status_belum_diajukan) {

                            $('#ajukan').html('Ajukan ke atasan')

                            document.getElementById("ajukan").removeAttribute("disabled")
                            document.getElementById("ajukan").setAttribute("data-remun", remun);
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

            //Tombol penilaian Tugas Tambahan
            $("#v-pills-5-tab").on("click", function(data) {
                $("#hot").show();
                $("#ajukan").show();

                var remun = this.dataset.id_remun
                var bln5 = <?php echo $tahun ?> + "-01" //diambil dari id

                //untuk tombol print
                // document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln5);


                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln5 + "&status=0",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        var rass = '23123';
                        hot1.loadData(res.indikator, rass);
                        $("#myTab a[href='#01#" + remun + "']").tab('show');
                        if (res.total == res.status_belum_diajukan) {

                            $('#ajukan').html('Ajukan ke atasan')

                            document.getElementById("ajukan").removeAttribute("disabled")
                            document.getElementById("ajukan").setAttribute("data-remun", remun);
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

                        if (res.status_telah_disetujui == res.total) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-info btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah Disetujui')
                            //untuk tombol print
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

            //Tombol Jaukan
            $("body").on("click", "#ajukan", function(e) {
                var id_remun = this.dataset.remun
                var bulan_remun = this.dataset.bulan_remun
                console.log(id_remun);


                var swal_html = '<div class="panel" style="background:aliceblue;font-weight:bold"><div class="panel-heading panel-info text-center btn-info"> <b>Import Status</b> </div> <div class="panel-body"><div class="text-center"><b><p style="font-weight:bold">Total number of not inserted  rows : add data</p><p style="font-weight:bold">Row numbers:Add data</p></b></div></div></div>';
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + id_remun + "&bulan=" + bulan_remun,
                    type: "GET",

                    success: function(res) {


                        var html = `
<pre>
Nama Usulan Penilaian : ` + res.nama_penilaian + `
Bulan  : ` + res.bulan + `
<small style="color:red;">
*Setalah klik ajukan data tidak bisa dirubah,
*pastikan data sudah benar
</small>
</pre>
                        <div class="table-responsive">
                            <table class="table table-sm" border="1" id="sumtable">
                                    <thead>
                                        <tr>
                                            <th>Indikator</th>
                                            <th>Definisi</th>
                                            <th>Target</th>
                                            <th>Capaian</th>
                                            <th>Bobot</th>
                                            <th>Hasil Kinerja</th>
                                        </tr>
                                    </thead>
                                    <tbody>`

                        var sumVal = 0;
                        $.each(res.indikator, function(i, word) {
                            html += '<tr><td align="left">' + word.indikator +
                                '</td><td align="left">' + word.definisi +
                                '</td><td>' + word.target_perbulan +
                                '</td><td>' + word.capaian +
                                '</td><td>' + word.bobot +
                                '</td><td>' + word.hasil_kinerja2 +
                                '</td></tr>';
                            sumVal += parseFloat(word.hasil_kinerja2);
                        });

                        html += `</tbody>
                            <tfoot>
                                <tr>
                                <td align="left" colspan="5"><b>Total</b></td>
                                
                                <td><b>` + sumVal.toFixed(2) + `</b></td>
                                </tr>
                            </tfoot>
                                    
                                    
                            </table>
                        </div>
                        `;




                        Swal.fire({
                            html: html,
                            showCancelButton: true,
                            confirmButtonText: "Ok, ajukan",
                            cancelButtonText: "Batal",
                            customClass: 'swal-wide',
                            preConfirm: (login) => {
                                return fetch(`<?php echo base_url("api/remun/ajukan?id_remun=") ?>` + id_remun + `&bulan=` + bulan_remun)
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error(response.statusText)
                                        }
                                        return response.json()
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            `Request failed: ${error}`
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {


                            if (result.value) {


                                Swal.fire({
                                    title: `${result.value.pesan}`,

                                })
                                // .then((result) => {

                                $.ajax({

                                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + result.value.id_remun + "&bulan=" + result.value.bulan + "&status=0",
                                    type: "GET",

                                    success: function(res) {
                                        // $('#myTabContent').html(res)
                                        // console.log(res);
                                        hot1.loadData(res.indikator);

                                        if (res.total == res.status_belum_diajukan) {

                                            $('#ajukan').html('Ajukan ke atasan')

                                            document.getElementById("ajukan").removeAttribute("disabled")
                                            document.getElementById("ajukan").setAttribute("data-remun", id_remun);
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


                                // })

                            }


                        });


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



            $(".penilaian_bulan").on("click", function(data) {
                // $(".nav-item .nav-link").on("click", function(data) {
                $("#hot").show();
                $("#ajukan").show();


                var bln = <?php echo $tahun ?> + "-" + this.id //diambil dari id

                var id_remun = this.dataset.remun

                var tahun = '<?php echo $tahun ?>'





                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + id_remun + "&bulan=" + bln + "&status=0",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);


                        //Jika 
                        // if (res.status_diajukan == 0) {

                        if (res.total == res.status_belum_diajukan) {

                            $('#ajukan').html('Ajukan ke atasan')

                            document.getElementById("ajukan").removeAttribute("disabled")
                            document.getElementById("ajukan").setAttribute("data-remun", id_remun);
                            document.getElementById("ajukan").setAttribute("data-bulan_remun", res.bulan);
                            document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");

                            $("#print").hide(); //Sembunyikan Download Excel

                        }

                        if (res.status_setuju == res.total) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah diajukan')


                            //jika semua remun sudah di acc maka bisa dicetak
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
                            //jika semua remun sudah di acc maka bisa dicetak
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
                            //jika semua remun sudah di acc maka bisa dicetak
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

            });


        });



        var hotElement1 = document.querySelector('#hot');
        var hotElementContainer1 = hotElement1.parentNode;


        var hotSettings = {
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
                'Approved By',
                'Returned By',

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

        var hot1 = new Handsontable(hotElement1, hotSettings);



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