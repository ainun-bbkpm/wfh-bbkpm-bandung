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
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/daterangepicker/css/daterangepicker.css') ?>">
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">

</head>

<body>
    <!-- <div class="se-pre-con"></div> -->
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_includes/sidebar.php'); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Header Start -->
            <?php $this->load->view('_includes/header.php'); ?>
            <!-- Header End -->

            <div class="container-fluid">

                <!-- Notif Start -->
                <?php $this->load->view('_includes/notif.php'); ?>
                <!-- Notif end -->

                <div class="row">
                    <div class="col-md-6">
                        <h1 class="mt-4">Data Remunerasi</h1>

                        <h6 class="mt-4"> Nama Pegawai : <?php echo $pegawai->nama_pegawai ?></h6>
                        <h6> NIP : <?php echo $pegawai->nip2 ?></h6>
                        <h6> Jabatan : <?php echo $pegawai->nama_jabatan ?></h6>
                        <h6> Unit Kerja : <?php echo $pegawai->nama_unit_kerja ?></h6>
                        <h6> Grading : <?php echo $pegawai->grading ?></h6>
                        <h6> Jab Value : <?php echo $pegawai->jab_value ?></h6>

                        <a href="<?php echo site_url('dashboard/pegawai') ?>" class="btn btn-warning btn-sm">
                            Kembali</a>
                        <a href="#" id="tambah_penilaian" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Penilaian
                        </a>
                        <br>
                        <br>

                        <div class="form-group">

                            <input type="text" class="form-control col-md-5" name="birthday" placeholder="Sortir tahun remun" />

                        </div>

                        <?php
                        if ($remun_all->num_rows() == 0) {
                            # code...


                        ?>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadRemun">
                                Upload Excel
                            </button> -->
                            <button type="button" class="btn btn-primary" id="uploadExcel">
                                Upload Excel
                            </button>



                        <?php
                        }
                        ?>




                    </div>


                    <div class="col-md-6">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>

                <!-- List Atasan -->
                <div class="row mt-4">
                    <?php
                    $no_atasan = 1;
                    $CIatasan = &get_instance();

                    $CIatasan->load->model('Atasan_m', 'atasan');

                    $dataatasan = $CIatasan->atasan->getAtasanByAtasan($pegawai->nip);
                    foreach ($dataatasan->result() as $atasan) {

                    ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <?php echo  $atasan->pejabat_penilai == 1 ? 'Pejabat Penilai' : 'Atasan Langsung Pejabat Penilai' ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $atasan->nama_pegawai ?></h5>
                                    <p class="card-text">
                                        Jabatan : <?php echo $atasan->nama_jabatan ?> <br>
                                        Unit Kerja : <?php echo $atasan->nama_unit_kerja ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                    <?php
                        $no_atasan++;
                    }


                    ?>
                </div>






                <div class="accordion mt-4" id="accordionExample">
                    <?php
                    $no = 1;

                    foreach ($remun_all->result() as $remun) {
                        $CI2 = &get_instance();
                        $CI2->load->model('Indikator_m', 'indikator');
                        $datatotal_bobot_indikator = $CI2->indikator->total_bobot_indikator($remun->id_remun)->row();
                    ?>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne1<?php echo  $remun->id_penilaian ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo  $remun->nama_penilaian ?>
                                    </button>

                                </h2>


                                <button type="button" class="btn btn-warning btn-sm">
                                    Maksimal Bobot <span class="badge badge-light"><?php echo  $remun->max_bobot == 0 ? 'tidak ada maksimal' : $remun->max_bobot ?></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm">

                                    Total Bobot <span class="badge badge-light "> <?php echo  $datatotal_bobot_indikator->total_bobot ?> </span>
                                </button>





                                <a href="#" id="<?php echo  $remun->id_remun ?>" class="btn btn-success btn-sm tambah_indikator">
                                    <i class="fa fa-plus"></i> Indikator
                                </a>

                                <a href="http://" class="btn btn-danger btn-sm" onclick="hapus_penilaian('<?php echo $remun->id_remun ?>','<?php echo md5(md5(sha1($remun->id_remun))) ?>');">
                                    <i class="fa fa-times"></i> Hapus Penilaian
                                </a>
                            </div>

                            <div id="collapseOne1<?php echo  $remun->id_penilaian ?>" class="collapse <?php echo $no == 1 ? 'show' : '' ?>" aria-labelledby="headingOne" data-parent="#accordionExample">



                                <?php

                                $CI = &get_instance();

                                $CI->load->model('Indikator_m', 'indikator');

                                $result = $CI->indikator->getAllByIdRemun($remun->id_remun);

                                $no_indikator = 1;
                                $totalbobotindikator = 0;
                                $totalhasil_kinerja = 0;

                                foreach ($result->result() as $detail) {
                                    // $no=0;
                                ?>

                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php echo $no_indikator ?>
                                                <br>
                                                <a href="#" class="btn btn-warning btn-sm edit_indikator" id="<?php echo $detail->id_indikator ?>" title="edit indikator dan definisi">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="#" class="btn btn-danger btn-sm hapus_indikator " onClick="hapus_indikator('<?php echo $detail->id_indikator ?>','<?php echo md5(md5(sha1($detail->id_indikator))) ?>');" title="Hapus indikator dan definisi">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                                <h5>Indikator :</h5>
                                                <p class="text-muted disabled">
                                                    <?php echo $detail->indikator ?>
                                                </p>
                                                <h5>Definisi :</h5>
                                                <p class="text-muted disabled">
                                                    <?php echo $detail->definisi ?>
                                                </p>

                                                <br>
                                                <hr>
                                                <h6>Target : <?php echo $detail->target ?></h6>
                                                <h6>Bobot : <?php echo $detail->bobot ?></h6>

                                                <div class="mt-4">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <?php

                                                        $instance = &get_instance();

                                                        $instance->load->model('Capaian_m', 'capaian');

                                                        $data = $instance->capaian->getAllByIdIndikator($detail->id_indikator);
                                                        $nomor = 1;
                                                        $totalbobot = 0;
                                                        $totalhasil_kinerja = 0;

                                                        // FUngsi Range
                                                        // $d1 = strtotime($detail->range1);
                                                        // $d2 = strtotime($detail->range2);
                                                        // $min_date = min($d1, $d2);
                                                        // $max_date = max($d1, $d2);
                                                        // $i = 1;

                                                        // while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
                                                        //     $min_date1=  Date('Y-m-d',$min_date)."<br>";
                                                        // 	$i++;
                                                        // }
                                                        // echo $i; // 8
                                                        // FUngsi Range end





                                                        foreach ($data->result() as $capaian) {
                                                            // $no=0;
                                                        ?>

                                                            <li class="nav-item">
                                                                <a class="nav-link <?php echo $nomor == "1" ? "active" : "" ?>" id="capaian<?php echo $capaian->id_capaian ?>-tab" data-toggle="tab" href="#capaian<?php echo $capaian->id_capaian ?>" role="tab" aria-controls="capaian<?php echo $capaian->id_capaian ?>" aria-selected="<?php echo $nomor == "1" ? "true" : "false" ?>"><?php echo $capaian->bulan ?>



                                                                    <span class="badge badge-danger" onclick="hapus_capaian('<?php echo $capaian->id_capaian ?>','<?php echo md5(md5(sha1($capaian->id_capaian))) ?>');">x</span>



                                                                </a>



                                                            </li>
                                                        <?php

                                                            $nomor++;
                                                        }
                                                        ?>


                                                        <!-- <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                        role="tab" aria-controls="profile" aria-selected="false">Pebruari</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                                        role="tab" aria-controls="contact" aria-selected="false">Maret</a>
                                                </li> -->



                                                        <!-- Tambah Capaian -->
                                                        <?php
                                                        // Buuton tambah Capaian
                                                        //if (($pegawai->nip == $this->session->nip) OR ($this->session->level_admin ==1) ) {


                                                        ?>
                                                        <!-- <li class="nav-item">
                                                    <a class="btn btn-primary p-2 tambah_capaian " href="#" id="<?php // echo $detail->id_indikator."-".$detail->target."-".$detail->bobot 
                                                                                                                ?>">
                                                    <i class="fa fa-plus"></i>
                                                    Tambah Capaian</a>
                                                </li> -->
                                                        <?php
                                                        //}
                                                        ?>



                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <?php
                                                        $hmm = 1;
                                                        foreach ($data->result() as $capaian2) {
                                                            // $no=0;
                                                        ?>
                                                            <div class="tab-pane fade <?php echo $hmm == 1 ? 'show active' : '' ?>" id="capaian<?php echo $capaian2->id_capaian ?>" role="tabpanel" aria-labelledby="capaian<?php echo $capaian2->id_capaian ?>-tab">



                                                                <div class="form-row">
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="target">Target</label>
                                                                        <input type="number" class="form-control " disabled value="<?php echo $capaian2->target ?>">
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="capaian">Capaian</label>
                                                                        <input type="number" class="form-control" disabled value="<?php echo $capaian2->capaian ?>">

                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="bobot">Bobot</label>
                                                                        <input type="number" class="form-control" disabled value="<?php echo $capaian2->bobot ?>">


                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="bobot">Hasil Kinerja</label>
                                                                        <input type="number" class="form-control" disabled value="<?php echo $capaian2->hasil_kinerja ?>">


                                                                    </div>

                                                                </div>

                                                                <?php if (($capaian2->hasil_kinerja == 0) or (($capaian2->status == 0))) {
                                                                ?>
                                                                    <a href="#" class="btn btn-success btn-sm edit_capaian" id="<?php echo $capaian2->id_capaian ?>" title="Edit Capaian">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                // if ((($capaian2->status == $no_atasan - 1))) {
                                                                ?>
                                                                <a target="_balnk" href="<?php echo site_url("remun/cetak?bulan=$capaian2->bulan&id=$pegawai->nip&token=" . sha1($pegawai->nip)) ?>" class="btn btn-secondary btn-sm">
                                                                    <i class="fa fa-print"></i>

                                                                    Print
                                                                </a>
                                                                <?php
                                                                // }
                                                                ?>





                                                                <!-- Setuju lanjut -->
                                                                <?php
                                                                $status = $capaian2->status;
                                                                $jumlah = $atasan_all->num_rows();
                                                                if ($jumlah == $capaian2->status) {
                                                                    if ($this->session->nip == "16") {
                                                                        echo "<a href='#' class='btn btn-info btn-sm'>Anda Sudah menyetujui</a>";
                                                                    } else {

                                                                        echo " <a href='#'  class=\"btn btn-success btn-sm disabled\" title=\"telah disetujui atasan\"><i class=\"fa fa-check\"></i> Selesai, telah disetujui atasan</a> ";
                                                                    }
                                                                }

                                                                foreach ($atasan_all->result() as $atasan) {

                                                                    // JIka nip atasna sama dengan session maka acc
                                                                    if (($atasan->nip_atasan == $this->session->nip)) {

                                                                        // echo strlen($capaian2->status);
                                                                        // echo "<br>";
                                                                        $capaian2->status;
                                                                        $atasan->atasan_ke - 1;
                                                                        $jml_str_status = strlen($capaian2->status);
                                                                        if ($atasan->atasan_ke - 1 == $capaian2->status) {
                                                                            echo " <a href='" . site_url("remun/ajukan?id_capaian=$capaian2->id_capaian&atasan_ke=$atasan->atasan_ke&status=$capaian2->status&token=" . sha1($capaian2->id_capaian)) . "'  class=\"btn btn-primary btn-sm\"  onclick=\"return confirm('Yakin Setujui ?')\"><i class=\"fa fa-check\"></i>
                                                                    Setuju
                                                                </a>";
                                                                        }
                                                                        if ($atasan->atasan_ke - 1 < $capaian2->status) {
                                                                            if ($this->session->nip == "16") {
                                                                                # code...
                                                                                // echo "<a href='#' class='btn btn-info btn-sm'>Anda Sudah menyetujui</a>";
                                                                            } else {
                                                                                # code...
                                                                                echo "<a href='#' class='btn btn-info btn-sm'>Anda Sudah menyetujui</a>";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>




                                                            </div>


                                                        <?php
                                                            $hmm++;
                                                        }


                                                        ?>


                                                    </div>



                                                </div>


                                            </div>


                                        </div>


                                    </div>
                                <?php
                                    $totalbobotindikator += $detail->bobot;
                                    $no_indikator++;
                                }


                                if ($totalbobotindikator >= 0.35) {
                                    // echo "kelebihan/pas";
                                    $keterangan = "pas";
                                } else {
                                    $keterangan = "kekurangan";
                                }
                                $bobottersedia = $totalbobotindikator;





                                ?>

                                <span class="sr-only "><?php echo $bobottersedia . "-" . $remun->id_penilaian ?></span>






                            </div>
                        </div>
                    <?php
                        // $no++;
                    }
                    ?>


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
    <!-- Modal -->
    <div class="modal fade" id="modal_form_penilaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php
                echo form_open('remun/simpan_remun', ' id="form_penilaian" ')
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_penilaian">Penilaian</label>
                        <input type="hidden" name="nip" id="" value="<?php echo $pegawai->nip ?>">
                        <select name="id_penilaian" id="" class="form-control" required>
                            <?php
                            foreach ($penilaian_all->result() as $penilaian) {

                            ?>
                                <option value="<?php echo $penilaian->id_penilaian ?>">
                                    <?php echo $penilaian->nama_penilaian ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="simpan" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
                <?php
                echo form_close()
                ?>
            </div>
        </div>
    </div>

    <!-- Indikator -->
    <div class="modal fade bd-example-modal-lg" id="modal_form_indikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <?php
                echo form_open('remun/simpan_indikator', ' id="form_indikator" ')
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="title_indikator">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_remun" id="id_remun">
                    <input type="hidden" name="id_indikator" id="id_indikator">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="daterange">Range Bulan </label>
                            <input type="text" name="range" class="form-control" id="daterange" required />

                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="indikator">Indikator yang dinilai</label>

                        <textarea required name="indikator" id="indikator" class="form-control" cols="20" rows="2"></textarea>


                    </div>
                    <div class="form-group">
                        <label for="definisi">Definisi Operasional</label>

                        <textarea required name="definisi" id="definisi" class="form-control" cols="20" rows="2"></textarea>


                    </div>



                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="target">Target</label>
                            <input type="number" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> name="target" class="form-control" id="target" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="capaian">Capaian</label>
                            <input type="number" class="form-control" disabled placeholder="Disi ketika sudah menambahkan indikator" aria-describedby="inputGroupPrepend2" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter a valid Capaian
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="bobot">Bobot</label>
                            <input type="number" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> name="bobot" step="0.0001" class="form-control" id="bobot" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter a valid Bobot.
                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label for="range_target1">Range Target1</label>
                            <input type="number" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> disabled name="range_target1" class="form-control" id="range_target1">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="range_target2">Range Target2</label>
                            <input type="number" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> disabled name="range_target2" class="form-control" id="range_target2">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="cek_range_target" value="1" class="custom-control-input" id="customControlValidation1">
                            <label class="custom-control-label" for="customControlValidation1">Aktifkan Range Target</label>
                            <div class="invalid-feedback">Example invalid feedback text</div>
                            <br>
                            <small>
                                Hanya berlaku untuk pegawai perawat
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="simpan_indikator" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
                <?php
                echo form_close()
                ?>
            </div>
        </div>
    </div>

    <!-- Modal Capaian -->
    <div class="modal fade" id="modal_form_capaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php
                echo form_open('remun/simpan_capaian', ' id="form_capaian" ')
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="title_capaian">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="bulan">Inidkator</label>

                            <textarea id="indikator_capaian" disabled cols="30" class="form-control" rows="10"></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                            <!-- <small>
                                tidak bisa edit, karena di buat pas pertama kali buat indikator
                            </small> -->
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="bulan">Bulan Pencapaian</label>
                            <input type="hidden" name="id_indikator2" id="id_indikator2">
                            <input type="hidden" name="id_capaian" id="id_capaian">
                            <input type="date" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> name="bulan" class="form-control" readonly id="bulan" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                            <!-- <small>
                                tidak bisa edit, karena di buat pas pertama kali buat indikator
                            </small> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="target_capaian">Target</label>
                            <input type="text" name="target_capaian" class="form-control" id="target_capaian" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="capaian">Capaian</label>
                            <input type="text" class="form-control" name="capaian" id="capaian" aria-describedby="inputGroupPrepend2">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter a valid Capaian
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="bobot_capaian">Bobot</label>
                            <input type="number" readonly <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> name="bobot_capaian" step="0.0001" class="form-control" id="bobot_capaian" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter a valid Bobot.
                            </div>

                        </div>

                    </div>
                    <div class="form-row" id="div_range_target">
                        <div class="col-md-4 mb-6">
                            <label for="range_target1">Range Target1</label>
                            <input type="number" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> disabled name="range_target1_capaian" class="form-control" id="range_target1_capaian">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="range_target2">Range Target2</label>
                            <input type="number" <?php echo $this->session->id_hak_akses != 13 ? '' : 'readonly' ?> disabled name="range_target2_capaian" class="form-control" id="range_target2_capaian">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter valid Target
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="simpan_capaian" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
                <?php
                echo form_close()
                ?>
            </div>
        </div>
    </div>

    <!-- Modal Upload Excel -->
    <div class="modal fade" id="uploadRemun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <?php echo form_open_multipart('remun/upload_remun') ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">

                        <input type="file" class="form-control" name="upload_excel" required accept="application/vnd.ms-excel">
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary upload">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>

                <?php echo form_close() ?>

            </div>
        </div>
    </div>

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
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>/



    <!-- daterangepicker -->
    <script src="<?php echo site_url('assets/vendor/daterangepicker/js/moment.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/daterangepicker/js/daterangepicker.js') ?>">
    </script>

    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js">
    </script>


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/ajaxfileupload/ajaxfileupload.js') ?>"></script>

    <?php $this->load->view('_includes/js.php'); ?>




    <script>
        $(document).ready(function() {


            $("body").on("click", "#tambah_penilaian", function(e) {
                $("#title").text("Tambah Data Usulan Penilaian");
                $('#simpan').text("Simpan");

                $('#form_penilaian').attr('action', '<?php echo site_url('remun/simpan_remun') ?>')

                $("#modal_form_penilaian").modal('toggle');


            })





            $("body").on("click", ".tambah_indikator", function(e) {
                var id_remun = this.id;
                $("#title_indikator").text("Tambah Data Indikator");
                $('#simpan_indikator').text("Simpan");

                $('#id_remun').val(id_remun);
                $('#indikator').val('');
                $('#definisi').val('');
                $('#target').val('');
                $('#bobot').val('');
                $('#range_target1').val('');
                $('#range_target2').val('');


                $('#form_indikator').attr('action', '<?php echo site_url('remun/simpan_indikator') ?>')

                $("#modal_form_indikator").modal('toggle');

                //enable range target
                document.getElementById('customControlValidation1').onchange = function() {
                    document.getElementById('range_target1').disabled = !this.checked;
                    document.getElementById('range_target2').disabled = !this.checked;
                };


            })

            $("body").on("click", ".tambah_capaian", function(e) {
                var Dataindikator = this.id.split('-');
                var id_indikator = Dataindikator[0];
                var target_capaian = Dataindikator[1];
                var bobot_capaian = Dataindikator[2];
                $("#title_capaian").text("Tambah Data Capaian");
                $('#simpan_capaian').text("Simpan");

                $('#id_indikator2').val(id_indikator);
                $('#bulan').val('');
                $('#target_capaian').val(target_capaian);
                $('#capaian').val('');
                $('#bobot_capaian').val(bobot_capaian);

                $('#form_capaian').attr('action', '<?php echo site_url('remun/simpan_capaian') ?>')

                $("#modal_form_capaian").modal('toggle');


            })



            $("body").on("click", ".edit_indikator", function(e) {
                var id_indikator = this.id;
                var settingapiindikator = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo site_url('api/indikator?id=') ?>" + id_indikator,
                    "method": "GET",
                }

                $.ajax(settingapiindikator).done(function(response) {
                    console.log(response);
                    var daterange1 = changeFormatDate(response.range1)
                    var daterange2 = changeFormatDate(response.range2)
                    var daterange = daterange1 + ' - ' + daterange2

                    console.log(daterange);
                    $('#modal_form_indikator').on('shown.bs.modal', function() {

                        $('#daterange').val(daterange);
                        // $('#daterange').attr('class','form-control disabled');
                        document.getElementById("daterange").disabled = true;
                    })
                    $('#id_indikator').val(response.id_indikator);
                    $('#indikator').val(response.indikator);
                    $('#definisi').val(response.definisi);
                    $('#target').val(response.target);
                    $('#bobot').val(response.bobot);
                    $('#range_target1').val(response.range_target1);
                    $('#range_target2').val(response.range_target2);


                });

                //enable range target
                document.getElementById('customControlValidation1').onchange = function() {
                    document.getElementById('range_target1').disabled = !this.checked;
                    document.getElementById('range_target2').disabled = !this.checked;
                };



                $("#title_indikator").text("Edit Data Indikator");
                $('#simpan_indikator').text("Update");


                $('#form_indikator').attr('action', '<?php echo site_url('remun/update_indikator') ?>')

                $("#modal_form_indikator").modal('toggle');


            })

            $("body").on("click", ".edit_capaian", function(e) {
                var id_capaian = this.id;

                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "<?php echo site_url('api/capaian?id=') ?>" + id_capaian,
                    "method": "GET",
                }

                $.ajax(settings).done(function(response) {
                    // console.log(response);

                    var settingsindikator = {
                        "url": "<?php echo  site_url('api/indikator?id=') ?>" + response.id_indikator,
                        "method": "GET",
                        "timeout": 0,
                    };

                    $.ajax(settingsindikator).done(function(response) {
                        // console.log(response);
                        $('#indikator_capaian').val(response.indikator)
                        if (response.range_target1 != "0" && response.range_target2 != "0") {
                            // alert('ada range')
                            $("#div_range_target").show();
                            $('#range_target1_capaian').val(response.range_target1)
                            $('#range_target2_capaian').val(response.range_target2)

                        } else {
                            $("#div_range_target").hide();
                        }

                    });


                    $('#bulan').val(response.bulan);
                    $('#target_capaian').val(response.target);
                    $('#capaian').val(response.capaian);
                    $('#bobot_capaian').val(response.bobot);


                });




                $("#title_capaian").text("Edit Data Capaian");
                $('#simpan_capaian').text("Update");

                $('#id_capaian').val(id_capaian);



                $('#form_capaian').attr('action', '<?php echo site_url('remun/update_capaian') ?>')

                $("#modal_form_capaian").modal('toggle');


            })


            $("body").on("click", "#uploadExcel", function(e) {

                Swal.fire({
                    title: 'Upload IKI Excel',

                    html: '<input id="upload_excel" accept="application/vnd.ms-excel" name="upload_excel" required class="form-control" type="file">',
                    showLoaderOnConfirm: true,

                }).then((result) => {
                    if (result.value) {

                        
                        
                        $.ajaxFileUpload({
                            url: "<?php echo site_url('remun/upload_remun2')  ?>",
                            secureuri: false,
                            fileElementId: "upload_excel",
                            data: {
                                'date_absensi': 0,
                            },
                            dataType: "text",
                            success: function(json, status) {

                                // Swal.showLoading()


                                var res = JSON.parse(json)

                                if (res.status == 1) {
                                    Swal.fire(
                                        'Upload Berhasil',
                                        '',
                                        'success'
                                    ).then(function(result) {
                                        location.reload();
                                    })


                                }
                                if (res.status == 0) {
                                    Swal.fire(
                                        'Upload Gagal',
                                        res.pesan,
                                        'error'
                                    ).then(function(result) {

                                        location.reload();
                                    })


                                }
                                if (res.status == 2) {
                                    Swal.fire(
                                        'Upload Gagal',
                                        res.pesan,
                                        'error'
                                    ).then(function(result) {
                                        location.reload();
                                    })


                                }
                            },
                            error: function(err) {
                                console.log(err);

                                Swal.fire(
                                    'Gagal Upload, Periksa API',
                                    '',
                                    'error'
                                )

                            }

                        });
                        swal.fire({
                            title: 'Proses'
                        });
                        swal.showLoading();

                    }
                });


            });





            $('#hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var link = button.data('link') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)

                modal.find('.modal-body #id_hapus').val(id)
                modal.find('#form_hapus').attr('action', link)
            })


        });


        function changeFormatDate(strdate) {
            var Datares = strdate.split('-');
            var tgl = Datares[2]
            var bln = Datares[1]
            var thn = Datares[0]
            return res = bln + '/' + tgl + '/' + thn
        }
    </script>

    <script>
        $(function() {
            $('input[name="range"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        function hapus_capaian(linkhapus, sec) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    window.location = '<?php echo site_url('remun/hapus_capaian?id=') ?>' + linkhapus + '&sec=' + sec
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )


                }
            })

        }

        function hapus_indikator(linkhapus, sec) {

            Swal.fire({
                title: 'Are you sure?',
                text: "Data akan terhapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    window.location = '<?php echo site_url('remun/hapus_indikator?id=') ?>' + linkhapus + '&sec=' + sec

                }
            })

        }

        function hapus_penilaian(linkhapus, sec) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    window.location = '<?php echo site_url('remun/hapus_penilaian?id=') ?>' + linkhapus + '&sec=' + sec

                }
            })

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
            var ink = '<?php echo site_url("dashboard/remun?id=" . $_GET['id'] . "&token=" . $_GET['token']) ?>'
            year = date.getFullYear();
            var link = ink + '&tahun=' + year

            toastr.info('Sortir tahun dipilih ' + year, 'Info')
            location.replace(link)

        });
    </script>



</body>

</html>