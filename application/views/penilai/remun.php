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

</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('penilai/sidebar.php'); ?>
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
                        <h5>NIP Pegawai : <?php echo $pegawai->nip ?></h5>                   
                        <h5>Jabatan : <?php echo $pegawai->nama_jabatan ?></h5>                   
                        <h5>Unit Kerja : <?php echo $pegawai->nama_unit_kerja ?></h5>                   
                        <h5>Grading : <?php echo $pegawai->grading ?></h5>                   
                        <h5>Jab Value : <?php echo $pegawai->jab_value ?></h5>                   

                   </div>


                </div>
                <div class="form-group mt-4 ">

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
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-remun="<?php echo $remun2->id_remun ?>" id="01" data-toggle="tab" href="#01#<?php echo $remun2->id_remun ?>" role="tab" aria-selected="true">Januari</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="02" data-toggle="tab" href="#02#<?php echo $remun2->id_remun ?>" role="tab" aria-selected="false">Februari</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="03" data-toggle="tab" href="#03#<?php echo $remun2->id_remun ?>" role="tab" aria-selected="false">Maret</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="04" data-toggle="tab" href="#04" role="tab" aria-selected="true">April</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="05" data-toggle="tab" href="#05" role="tab" aria-selected="false">Mei</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="06" data-toggle="tab" href="#06" role="tab" aria-selected="false">Juni</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="07" data-toggle="tab" href="#01" role="tab" aria-selected="true">Juli</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="08" data-toggle="tab" href="#02" role="tab" aria-selected="false">Agustus</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="09" data-toggle="tab" href="#03" role="tab" aria-selected="false">September</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="10" data-toggle="tab" href="#04" role="tab" aria-selected="true">Oktober</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="11" data-toggle="tab" href="#05" role="tab" aria-selected="false">November</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-remun="<?php echo $remun2->id_remun ?>" id="12" data-toggle="tab" href="#06" role="tab" aria-selected="false">Desember</a>
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

                                    <button class="btn btn-primary btn-sm" id="ajukan" >Setuju dan ajukan ke atasan</button>
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
            //Sembunyikan HOT




            $("#v-pills-1-tab").on("click", function(data) {
                $("#hot").show();
                var remun = this.dataset.id_remun
                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln3,
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#"+remun+"']").tab('show');
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


            $("#v-pills-3-tab").on("click", function(data) {
                $("#hot").show();
                var remun = this.dataset.id_remun
                var bln3 = <?php echo $tahun ?> + "-01" //diambil dari id
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln3,
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#"+remun+"']").tab('show');

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


            $("#v-pills-4-tab").on("click", function(data) {
                $("#hot").show();
                var remun = this.dataset.id_remun
                var bln4 = <?php echo $tahun ?> + "-01" //diambil dari id
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln4,
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#"+remun+"']").tab('show');

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
            $("#v-pills-5-tab").on("click", function(data) {
                $("#hot").show();
                var remun = this.dataset.id_remun
                var bln5 = <?php echo $tahun ?> + "-01" //diambil dari id
                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + remun + "&bulan=" + bln5,
                    type: "GET",

                    success: function(res) {
                        // $('#myTabContent').html(res)
                        // console.log(res);
                        hot1.loadData(res.indikator);
                        $("#myTab a[href='#01#"+remun+"']").tab('show');

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



           



            $(".nav-item .nav-link").on("click", function(data) {
                $("#hot").show();

                var bln = <?php echo $tahun ?> + "-" + this.id //diambil dari id

                var id_remun = this.dataset.remun
                var tahun = '<?php echo $tahun ?>'





                $.ajax({

                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + id_remun + "&bulan=" + bln,
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
                    type: 'numeric',
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

                                    url: "<?php echo base_url("api/remun/indikator?id_remun=") ?>" + respon.id_remun + "&bulan=" +strArray[0]+"-"+strArray[1],
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
                // if (col == 3 || col == 4) {
                if (col == 4) {
                    cellProperties.renderer = greenCell;
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