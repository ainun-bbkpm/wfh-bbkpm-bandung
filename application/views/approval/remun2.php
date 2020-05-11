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
        <?php $this->load->view('approval/sidebar.php'); ?>
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
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>Nama Pegawai : <?php echo $pegawai->nama_pegawai ?></h5>
                        <h5>NIP Pegawai : <?php echo $pegawai->nip2 ?></h5>
                        <h5>Jabatan : <?php echo $pegawai->nama_jabatan ?></h5>
                        <h5>Unit Kerja : <?php echo $pegawai->nama_unit_kerja ?></h5>
                        <h5>Grading : <?php echo $pegawai->grading ?></h5>
                        <h5>Jab Value : <?php echo $pegawai->jab_value ?></h5>
                        <?php // echo $atasan->atasan_ke 
                        ?>




                    </div>


                </div>
                <div class="form-group mt-4 ">

                    <input type="text" class="form-control col-md-3" name="birthday" placeholder="Sortir tahun remun" style="cursor: pointer;" />

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- List Usulan Penilaian -->
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

                            <button class="btn btn-primary btn-sm" id="ajukan">Setuju dan ajukan ke atasan</button>
                            <button class="btn btn-info btn-sm" id="return">Return</button>


                            <button class="btn btn-success btn-sm" id="print"> <i class="fa fa-print" aria-hidden="true"></i>
                                Download Excel</button>
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
        //Warna Cell Merah
        function redCell(instance, td, row, col, prop, value, cellPorperties) {
            hot1.renderers.TextRenderer.apply(this, arguments);
            td.style.background = '#ffc0cb';
        };



        $(document).ready(function() {
            $("#hot").hide(); //Sembunyikan HOT
            $("#ajukan").hide(); //Sembunyikan Jaukan
            $("#print").hide(); //Sembunyikan Jaukan
            $("#return").hide(); //Sembunyikan return

            //Sembunyikan HOT



            // Penilaian Kuantitas
            // Kuantitas
            var settings = {

                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=1")  ?>",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response1) {
                $("#hot").show();
                $("#ajukan").show();

                // var id_remun = response
                var dataremun1 = JSON.parse(response1)
                var remun1 = dataremun1.id_remun
                // console.log(remun);


                $("#hot").show();
                $("#ajukan").show();
                $("#print").show();


                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id

                //untuk tombol print
                document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln3);

                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun1 + "&bulan=" + bln3 + "&status=" + <?php echo $atasan->atasan_ke ?> + "",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#" + remun1 + "']").tab('show');
                        // console.log(remun);
                        console.log(res);
                        if (res.status_belum_diajukan == res.status_diajukan) {
                            $('#ajukan').html('Setuju')

                            document.getElementById("ajukan").removeAttribute("disabled")
                            document.getElementById("ajukan").setAttribute("data-remun", remun1);
                            document.getElementById("ajukan").setAttribute("data-bulan_remun", res.bulan);
                            document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");


                            $("#return").show();
                            document.getElementById("return").setAttribute("data-remun", remun1);
                            document.getElementById("return").setAttribute("data-bulan_remun", res.bulan);


                        }

                        if (res.status_belum_diajukan == 0) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Belum diajukan');
                            $("#return").hide();

                        }

                        if (res.total == res.status_setuju) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-success btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah Disetujui')
                            $("#return").hide();

                        }

                        if (res.status_telah_disetujui == res.total) {

                            document.getElementById("ajukan").setAttribute("class", "btn btn-success btn-sm");
                            document.getElementById("ajukan").setAttribute("disabled", true);
                            $('#ajukan').html('Telah Disetujui')
                            $("#return").hide();
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
            var settings1 = {
                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=3")  ?>",
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


                $("#hot").show();
                $("#ajukan").show();
                $("#print").show();


                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id

                //untuk tombol print
                document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln3);

                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun1 + "&bulan=" + bln3 + "&status=" + <?php echo $atasan->atasan_ke ?> + "",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot2.loadData(res.indikator);
                        $("#myTab a[href='#01#" + remun1 + "']").tab('show');




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


            //tombol peniliaian Perilaku
            var settings2 = {
                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=4")  ?>",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings2).done(function(response2) {
                $("#hot").show();
                $("#ajukan").show();

                // var id_remun = response
                var dataremun2 = JSON.parse(response2)
                var remun2 = dataremun2.id_remun
                // console.log(remun);


                $("#hot").show();
                $("#ajukan").show();
                $("#print").show();


                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id

                //untuk tombol print
                document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln3);

                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun2 + "&bulan=" + bln3 + "&status=" + <?php echo $atasan->atasan_ke ?> + "",
                    type: "GET",

                    success: function(res2) {
                        // $('#myTabContent').html(res2)
                        // console.log(res2);
                        hot3.loadData(res2.indikator);
                        $("#myTab a[href='#01#" + remun2 + "']").tab('show');
                        // console.log(remun);





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


            //tombol peniliaian Tugas Tambahan
            var settings3 = {
                "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=5")  ?>",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings3).done(function(response1) {
                $("#hot").show();
                $("#ajukan").show();

                // var id_remun = response
                var dataremun1 = JSON.parse(response1)
                var remun1 = dataremun1.id_remun
                // console.log(remun);


                $("#hot").show();
                $("#ajukan").show();
                $("#print").show();


                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id

                //untuk tombol print
                document.getElementById("print").setAttribute("data-cetak_bulan_remun", bln3);

                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun1 + "&bulan=" + bln3 + "&status=" + <?php echo $atasan->atasan_ke ?> + "",
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot4.loadData(res.indikator);
                        $("#myTab a[href='#01#" + remun1 + "']").tab('show');





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
            $("body").on("click", "#review_print", function(e) {
                var bulan = this.dataset.bulan_remun
                var token = Math.floor((Math.random() * 100) + 1) + $.unique(['adas3423423'])
                // console.log(bulan343);
                var url2 = "<?php echo site_url('remun/cetak_remun_tmp?bulan=') ?>" + bulan + '&id=' + <?php echo $pegawai->nip ?> + '&token=' + token;
                // window.location = url2;
                $.ajax({

                    url: url2,
                    type: "GET",

                    success: function(res) {
                        // alert(res)
                        Swal.fire({
                            title: 'Download IKI?',
                            html: `
                            <iframe src='https://view.officeapps.live.com/op/embed.aspx?src='http://localhost/simremuna3/Tmp73adas3423423.xls' width='100%' height='565px' frameborder='0'> </iframe>

                                `,
                            text: "Print jika data telah sesuai",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<i class="fa fa-download" aria-hidden="true"> Ya ! ',
                            customClass: 'swal-wide',
                        }).then((result) => {
                            // console.log(bulan);

                            if (result.value) {
                                var url = "<?php echo site_url('remun/cetak_remun_tmp?bulan=') ?>" + bulan + '&id=' + <?php echo $pegawai->nip ?>;
                                window.location = url;
                                //     Swal.fire(
                                //         'Print!',
                                //         'Your file has been deleted.',
                                //         'success'
                                //     )
                            }
                        })
                    },

                })







            })

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

            //Tombol Print Return
            $("body").on("click", "#return", function(e) {
                var remun = this.dataset.remun
                var bulan = this.dataset.bulan_remun
                var nip = '<?php echo $pegawai->nip ?>'
                console.log(remun);
                Swal.fire({
                    title: 'Kembalikan IKI?',

                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<i class="fa fa-undo" aria-hidden="true"> Ya ! '
                }).then((result) => {
                    // console.log(bulan);

                    if (result.value) {

                        var url = `<?php echo base_url("api/remun/kembalikanV2?nip=") ?>` + nip + `&bulan=` + bulan + `&status=<?php echo $atasan->atasan_ke - 1 ?>` + `&nip_atasan=<?php echo $atasan->nip_atasan ?>`;

                        // console.log();

                        // window.location = url;
                        $.ajax({

                            url: url,
                            type: "GET",

                            success: function(res) {
                                Swal.fire(
                                    'Return',
                                    'IKI Berhasil dikembalikan',
                                    'success'
                                ).then((result) => {
                                    location.reload()
                                })

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


                        })

                    }






                })
            })


            //Tombol Jaukan
            $("body").on("click", "#ajukan", function(e) {
                var nip = '<?php echo $pegawai->nip ?>'
                var id_remun = this.dataset.remun
                var bulan_remun = this.dataset.bulan_remun

                var swal_html = '<div class="panel" style="background:aliceblue;font-weight:bold"><div class="panel-heading panel-info text-center btn-info"> <b>Import Status</b> </div> <div class="panel-body"><div class="text-center"><b><p style="font-weight:bold">Total number of not inserted  rows : add data</p><p style="font-weight:bold">Row numbers:Add data</p></b></div></div></div>';
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + id_remun + "&bulan=" + bulan_remun + "&status=<?php echo $atasan->atasan_ke ?>",
                    type: "GET",

                    success: function(res) {


                        var html = `
<pre>
Nama Usulan Penilaian : ` + res.nama_penilaian + `
Bulan  : ` + res.bulan + `
<small style="color:red;">
*Setalah klik setuju data tidak bisa dirubah,
*pastikan data sudah benar
</small>
</pre>
                        
                        `;




                        Swal.fire({
                            html: html,
                            showCancelButton: true,
                            confirmButtonText: "Ok, Setujui",
                            cancelButtonText: "Batal",
                            customClass: 'swal-wide',
                            preConfirm: (login) => {
                                return fetch(`<?php echo base_url("api/remun/setujuiv2?nip=") ?>` + nip + `&bulan=` + bulan_remun + `&status=<?php echo $atasan->atasan_ke + 1 ?>` + `&nip_atasan=<?php echo $atasan->nip_atasan ?>`)
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

                                location.reload();

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



            $(".bulan").on("click", function(data) {
                // alert('sdsa')
                var bln = <?php echo $tahun ?> + '-' + this.dataset.bln
                document.getElementById("ajukan").setAttribute("data-bulan_remun", bln);

                // alert(bln)
                var settings1 = {
                    //"url": "http://localhost/remunerasi/api/remun/remunbynip?nip=<?php echo  $pegawai->nip ?>&id_penilaian=1",
                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=1")  ?>",

                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings1).done(function(response1) {


                    // var id_remun = response
                    var dataremun1 = JSON.parse(response1)
                    var remun1 = dataremun1.id_remun
                    // console.log(remun);

                    $.ajax({

                        url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun1 + "&bulan=" + bln + "&status=" + <?php echo $atasan->atasan_ke ?> + "",
                        type: "GET",

                        success: function(res1) {
                            // $('#myTabContent').html(res)
                            // console.log(res);

                            $("#ajukan").show();


                            hot1.loadData(res1.indikator);

                            console.log(res1);


                            if (res1.status_belum_diajukan == res1.status_diajukan) {
                                $('#ajukan').html('Setuju')

                                document.getElementById("ajukan").removeAttribute("disabled")
                                document.getElementById("ajukan").setAttribute("data-remun", remun1);
                                document.getElementById("ajukan").setAttribute("data-bulan_remun", res1.bulan);
                                document.getElementById("ajukan").setAttribute("class", "btn btn-primary btn-sm");

                                $("#return").show();
                                document.getElementById("return").setAttribute("data-remun", remun1);
                                document.getElementById("return").setAttribute("data-bulan_remun", res1.bulan);


                            }

                            if (res1.status_belum_diajukan == 0) {

                                document.getElementById("ajukan").setAttribute("class", "btn btn-danger btn-sm");
                                document.getElementById("ajukan").setAttribute("disabled", true);
                                $('#ajukan').html('Belum diajukan');
                                $("#return").hide();

                            }

                            if (res1.total == res1.status_setuju) {

                                document.getElementById("ajukan").setAttribute("class", "btn btn-success btn-sm");
                                document.getElementById("ajukan").setAttribute("disabled", true);
                                $('#ajukan').html('Telah Disetujui')
                                $("#return").hide();

                            }

                            if (res1.status_telah_disetujui == res1.total) {

                                document.getElementById("ajukan").setAttribute("class", "btn btn-success btn-sm");
                                document.getElementById("ajukan").setAttribute("disabled", true);
                                $('#ajukan').html('Telah Disetujui')
                                $("#return").hide();
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
                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=3")  ?>",
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
                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=4")  ?>",
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
                    "url": "<?php echo site_url("api/remun/remunbynip?nip=$pegawai->nip&id_penilaian=5")  ?>",
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


        });


        var hotElement1 = document.querySelector('#hot');
        var hotElementContainer1 = hotElement1.parentNode;

        var hotElement2 = document.querySelector('#hot2');
        var hotElementContainer2 = hotElement2.parentNode;

        var hotElement3 = document.querySelector('#hot3');
        var hotElementContainer3 = hotElement3.parentNode;

        var hotElement4 = document.querySelector('#hot4');
        var hotElementContainer4 = hotElement4.parentNode;


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
                }
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
                'Status'

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

                                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=<?php echo $atasan->atasan_ke ?>",
                                    type: "GET",

                                    success: function(res) {
                                        // $('#myTabContent').html(res)
                                        // console.log(res);
                                        hot1.loadData(res.indikator);


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
            cells: function(row, col) {
                let cellProperties = {};
                var hot = this.instance;
                // if (col == 3 || col == 4) {
                if (col == 4) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    ) {
                        // cellProperties.renderer = redCell;
                        cellProperties.readOnly = true;

                    } else {

                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;
                    }


                }


                if (col == 3) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"

                    ) {
                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;

                    }
                }

                if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.readOnly = true;



                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == 0) {
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
                }
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
                'Status'

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

                        var id_capaian = hot2.getDataAtRow(changes[0][0])[0]
                        var target = hot2.getDataAtRow(changes[0][0])[3]
                        var bobot = hot2.getDataAtRow(changes[0][0])[5]

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

                                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=<?php echo $atasan->atasan_ke ?>",
                                    type: "GET",

                                    success: function(res) {
                                        // $('#myTabContent').html(res)
                                        // console.log(res);
                                        hot1.loadData(res.indikator);


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
            cells: function(row, col) {
                let cellProperties = {};
                var hot = this.instance;
                // if (col == 3 || col == 4) {
                if (col == 4) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    ) {
                        // cellProperties.renderer = redCell;
                        cellProperties.readOnly = true;

                    } else {

                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;
                    }


                }


                if (col == 3) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"

                    ) {
                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;

                    }
                }

                if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.readOnly = true;



                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
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
                }
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
                'Status'

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

                            var id_capaian = hot3.getDataAtRow(changes[0][0])[0]
                            var target = hot3.getDataAtRow(changes[0][0])[3]
                            var bobot = hot3.getDataAtRow(changes[0][0])[5]



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
                                            hot3.loadData(res.indikator);



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
            cells: function(row, col) {
                let cellProperties = {};
                var hot = this.instance;
                // if (col == 3 || col == 4) {
                if (col == 4) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    ) {
                        // cellProperties.renderer = redCell;
                        cellProperties.readOnly = true;

                    } else {

                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;
                    }


                }


                if (col == 3) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"

                    ) {
                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;

                    }
                }

                if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.readOnly = true;



                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
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
                }
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
                'Status'

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

                                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" + strArray[0] + "-" + strArray[1] + "&status=<?php echo $atasan->atasan_ke ?>",
                                    type: "GET",

                                    success: function(res) {
                                        // $('#myTabContent').html(res)
                                        // console.log(res);
                                        hot1.loadData(res.indikator);


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
            cells: function(row, col) {
                let cellProperties = {};
                var hot = this.instance;
                // if (col == 3 || col == 4) {
                if (col == 4) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kehadiran" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Inisiatif" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "kehandalan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kerjasama" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Kepatuhan" &&
                        hot.getDataAtCell(row, hot.colToProp(1)) != "Sikap Perilaku"

                    ) {
                        // cellProperties.renderer = redCell;
                        cellProperties.readOnly = true;

                    } else {

                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;
                    }


                }


                if (col == 3) {
                    if (
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kehadiran" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Inisiatif" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "kehandalan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kerjasama" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Kepatuhan" ||
                        hot.getDataAtCell(row, hot.colToProp(1)) == "Sikap Perilaku"

                    ) {
                        cellProperties.renderer = greenCell;
                        cellProperties.readOnly = false;

                    }
                }

                if ((col == 4) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.readOnly = true;



                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == <?php echo $atasan->atasan_ke + 1 ?>) {
                    cellProperties.renderer = status;
                    // cellProperties.readOnly = true;
                }

                if ((col == 7) && hot.getDataAtCell(row, hot.colToProp(7)) == 0) {
                    cellProperties.renderer = status;
                }


                return cellProperties;
            }

        };

        var hot1 = new Handsontable(hotElement1, hotSettings);
        var hot2 = new Handsontable(hotElement2, hotSettings2);
        var hot3 = new Handsontable(hotElement3, hotSettings3);
        var hot4 = new Handsontable(hotElement4, hotSettings4);
        //Warna Cell Hijau
        function greenCell(instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            td.style.background = '#CEC';
        };
        //Warna Cell Biru
        function blueCell(instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            td.style.background = '#5c91f2';
        };
        //Warna Cell Merah
        function redCell(instance, td, row, col, prop, value, cellPorperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            td.style.background = '#ffc0cb';
        };

        function status(instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            if (value == <?php echo $atasan->atasan_ke ?>) {
                td.innerHTML = 'Menunggu Persetujuan'
            } else if (value == <?php echo $atasan->atasan_ke + 1 ?>) {
                td.innerHTML = 'Sudah disetujui'

            } else {
                td.innerHTML = 'Belum diajukan'
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
            var ink = '<?php echo site_url("approval/remun?id=" . $pegawai->nip . "&token=" . $pegawai->nip) ?>'
            year = date.getFullYear();
            var link = ink + '&tahun=' + year

            toastr.info('Sortir tahun dipilih ' + year, 'Info')
            location.replace(link)

        });
    </script>


</body>

</html>