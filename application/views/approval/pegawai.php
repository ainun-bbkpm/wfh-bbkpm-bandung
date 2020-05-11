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
    <!-- <link rel="stylesheet" href="<?php //echo site_url('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') 
                                        ?>"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">

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


                <?php
                // print_r($this->session);
                // echo "<bR>";
                // echo "Unit kerja ".$this->session->id_unit_kerja;
                // echo "<bR>";
                // echo "Jabatan ".$this->session->id_jabatan;
                if (($this->session->level == 2)) {
                ?>

                    <br>
                    <br>
                    <h3>
                        List Pegawai bawahan
                    </h3>
                    <div class="table-responsive mt-4">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Unit Kerja</th>
                                    <th>Jabatan</th>
                                    <th>NIK</th>
                                    <th>Grading</th>
                                    <th>Jab Value</th>
                                    <th>Absensi</th>
                                    <th>Absensi Senam</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($atasan_all->result() as $atasan) {
                                    # code...

                                ?>
                                    <tr>
                                        <td><?php echo $atasan->nip_pegawai ?></td>
                                        <td><?php echo $atasan->nama_pegawai ?></td>
                                        <td><?php echo $atasan->nama_unit_kerja ?></td>
                                        <td><?php echo $atasan->nama_jabatan ?></td>

                                        <td><?php echo $atasan->nik ?></td>
                                        <td><?php echo $atasan->grading ?></td>
                                        <td><?php echo $atasan->jab_value ?></td>

                                        <td>
                                            <table class="table table-sm">
                                                <tr class="table-warning">
                                                    <th>Tgl</th>
                                                    <th>Terlambat</th>
                                                    <th>Pulang Cepat</th>
                                                    <th>Sakit</th>
                                                    <th>Izin</th>
                                                    <th>Alpa</th>
                                                    <th>Cuti</th>
                                                    <th>Jumlah DL/Hari</th>
                                                    <th>Jumlah Keterlambatan</th>
                                                    <th>Jumlah Kerja/Menit</th>
                                                </tr>
                                                <?php
                                                $dataabsensi = $this->db->query("SELECT * FROM ref_absensi WHERE ref_absensi.`no_abs`='$atasan->no_abs'")->result();
                                                foreach ($dataabsensi as $key => $absen) {
                                                    # code...

                                                ?>
                                                    <tr>
                                                        <td class="table-warning"><?php echo $absen->tgl_absensi ?></td>
                                                        <td class="table-success"><?php echo $absen->terlambat ?></td>
                                                        <td class="table-success"><?php echo $absen->pulang_cepat ?></td>
                                                        <td class="table-success"><?php echo $absen->sakit ?></td>
                                                        <td class="table-success"><?php echo $absen->izin ?></td>
                                                        <td class="table-success"><?php echo $absen->alpa ?></td>
                                                        <td class="table-success"><?php echo $absen->cuti ?></td>
                                                        <td class="table-success"><?php echo $absen->dl_hari ?></td>
                                                        <td class="table-success"><?php echo $absen->jumlah_keterlambatan ?></td>
                                                        <td class="table-success"><?php echo $absen->jumlah_kerja_menit ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-sm">
                                                <tr class="table-primary">
                                                    <th>Tahun</th>
                                                    <th>01</th>
                                                    <th>02</th>
                                                    <th>03</th>
                                                    <th>04</th>
                                                    <th>04</th>
                                                    <th>06</th>
                                                    <th>07</th>
                                                    <th>08</th>
                                                    <th>09</th>
                                                    <th>10</th>
                                                    <th>11</th>
                                                    <th>12</th>
                                                </tr>
                                                <?php
                                                $dataabsensi = $this->db->query("SELECT * FROM ref_absensi_senam WHERE nip_pegawai='$atasan->nip_pegawai'")->result();
                                                foreach ($dataabsensi as $key => $absen) {
                                                    # code...

                                                ?>
                                                    <tr>
                                                        <td class="table-primary"><?php echo $absen->tahun ?></td>
                                                        <td class="table-danger"><?php echo $absen->januari ?></td>
                                                        <td class="table-danger"><?php echo $absen->februari ?></td>
                                                        <td class="table-danger"><?php echo $absen->maret ?></td>
                                                        <td class="table-danger"><?php echo $absen->april ?></td>
                                                        <td class="table-danger"><?php echo $absen->mei ?></td>
                                                        <td class="table-danger"><?php echo $absen->juni ?></td>
                                                        <td class="table-danger"><?php echo $absen->juli ?></td>
                                                        <td class="table-danger"><?php echo $absen->agustus ?></td>
                                                        <td class="table-danger"><?php echo $absen->september ?></td>
                                                        <td class="table-danger"><?php echo $absen->oktober ?></td>
                                                        <td class="table-danger"><?php echo $absen->november ?></td>
                                                        <td class="table-danger"><?php echo $absen->desember ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </td>


                                        <td>
                                            <a href="<?php echo site_url("approval/remun?id=$atasan->nip_pegawai&token=" . sha1($atasan->nip_pegawai)) ?>" class="btn btn-primary btn-sm">Detail Remun</a>
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

    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: {
                    details: {
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                return col.hidden ?
                                    '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                                    '<td>' + col.title + ':' + '</td> ' +
                                    '<td>' + col.data + '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');
                            return data ?
                                $('<table/>').append(data) :

                                false;

                        }
                    }
                }
            });

            // $('#example').on('click', 'tr', function() {
            //     var id = $('#myTable').DataTable().row(this);
            //     console.log(id);

            //     // alert('Clicked row id ' + id);
            // });
        });
    </script>



</body>

</html>