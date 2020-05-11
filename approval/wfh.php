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
                Work From Home
            </div>
            <div class="list-group list-group-flush">
                <?php
                if ($jml_bawahan > 0) {
                    # code...
                ?>

                    <a href="<?php echo  site_url('approval/wfh') ?>" class="list-group-item list-group-item-action bg-light">Work From Home <span class="badge badge-primary">New</span></a>
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


                <h3 class="mt-4">Selamat datang di Aplikasi Pemantauan Kinerja WFH BBKPM BANDUNG </h3>


                    <br>
                    <br>
                    <h3>
                        List Pegawai bawahan
                    </h3>
                    <button type="button" class="btn btn-primary setuju" onclick="laporan()"> <i class="fa fa-file-pdf"></i> Laporan</button>
                    <div class="table-responsive mt-4">
                        <table id="example" class="table table-striped table-bordered table-sm" data-multiple-select-row="true" style="width:100%">
                            <thead>
                                <tr>
                                    <th data-field="state" data-checkbox="true"></th>
                                    <th>Nama</th>


                                    <th>Status</th>
                                    <th>Approved By</th>

                                    <th>Tgl Absen</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($detail_wfh->result() as $detail) {
                                    # code...

                                ?>
                                    <tr>
                                        <td><input type="checkbox" id="id_selected" value="<?php echo $detail->id_wfh; ?>"></td>
                                        <td><?php echo $detail->nama_pegawai ?></td>


                                        <td>
                                            <?php
                                            // echo $detail->STATUS.$detail->nama_approved_by;
                                            if ($detail->status >  $detail->atasan_ke) {

                                                echo "<span class=\"badge badge-primary\">Approved</span>";
                                            }
                                            // elseif ($detail->STATUS >  $detail->atasan_ke) {
                                            //     # code...
                                            //     echo "<span class=\"badge badge-primary\">Approval</span>";
                                            // }
                                            else {
                                                echo "<span class=\"badge badge-danger\">waiting</span>";
                                            }


                                            ?>


                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-success"><?php echo $detail->nama_approved_by ?></span>

                                        </td>

                                        <td>
                                            <?php echo $detail->tgl_absen ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($detail->id_wfh != "" and $detail->id_pegawai != "") {
                                            ?>
                                                <a href="<?php echo site_url("approval/wfh_detail?id=$detail->id_wfh&nip=" . ($detail->id_pegawai)) ?>" class="btn btn-primary btn-sm">Detail WFH</a>
                                            <?php
                                            } else {
                                                # code...
                                                echo "Belum Absen";
                                            }

                                            ?>
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
            $('#example').DataTable({
                // "order": [
                //     [5, "desc"],
                //     [2, "desc"],

                // ], //or asc 
                // "columnDefs": [
                //     {
                //         "targets": 5,
                //         "type": "date-eu"
                //     },
                //     {
                //         "targets": 3
                //     }
                // ],

                // columnDefs: [{
                //     targets: [2],
                //     orderData: [2, 4]
                // }, {
                //     targets: [4],
                //     orderData: [4, 0]
                // }]
            });
        });

        function laporan() {
            let id = [];
            $.each($("#id_selected:checked"), function(){
                id.push($(this).val());
            });
            if (id != '') {
                Swal.showLoading();
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo base_url("Approval/laporan_pilihan") ?>");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.responseType = 'blob';

                xhr.onreadystatechange = function() {
                   if (this.readyState == 4 && this.status == 200) {
                        var fileURL = window.URL.createObjectURL(this.response);
                        var a       = document.createElement("a");
                        a.setAttribute("target","_blank");
                        a.href      = fileURL;
                        a.show      = "Laporan Harian WFH.pdf";

                        document.body.appendChild(a);
                        a.click();
                        Swal.fire('Berhasil','','success');
                        a.parentNode.removeChild(a);
                        w2popup.unlockScreen();
                    }
                }

                var request_params = 'id_wfh='+id;
                xhr.send(request_params);
            } else {
                swal.fire('Pilih Salah Satu!','','info');
            }
        }
    </script>



</body>

</html>