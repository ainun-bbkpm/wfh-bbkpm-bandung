<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Remunerasi</title>

    <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">

    <?php
    

// header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
// header("Content-type:   application/x-msexcel; charset=utf-8");
// header("Content-Disposition: attachment; filename=abc.xls"); 
?>

</head>

<body>

    <h3>Detail Remnuerasi</h3>
    Nama Pegawai : <?php echo $pegawai->nama_pegawai ?>
    <br>
    Bulan : <?php echo $this->input->get('bulan'); ?>

    <table class="table table-bordered" border="2">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col" colspan="2">Indikator yang dinilai</th>
                <th scope="col">Definisi Operasional</th>
                <th scope="col">Target</th>
                <th scope="col">Capaian</th>
                <th scope="col">Bobot</th>
                <th scope="col">Nilai Hasil Kinerja</th>

            </tr>
            <tr class="font-italic">
                <th scope="col-table-sm">1</th>
                <th scope="col" colspan="2">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
                <th scope="col">5</th>
                <th scope="col">6</th>
                <th scope="col">(5/4)X6</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            $subtotalhasil_kinerja=0;
            foreach ($remun_all->result() as $remun) {
            $CIPenilaian = & get_instance();
            $CIPenilaian->load->model('penilaian_m','penilaian');
            $penilaian = $CIPenilaian->penilaian->find($remun->id_penilaian)->row();
                switch ($no) {
                        case '1':
                            $alf = "A";
                            break;
                        case '2':
                            $alf = "B";
                            break;
                        case '3':
                            $alf = "C";
                            break;
                        case '4':
                            $alf = "D";
                            break;
                        case '5':
                            $alf = "E";
                            break;
                        case '6':
                            $alf = "F";
                            break;
                        case '7':
                            $alf = "G";
                            break;
                        default:
                            # code...
                            break;
                    }
            ?>
            <tr>
                <td><?php echo $alf ?></td>
                <td colspan="2"> <?php echo $penilaian->nama_penilaian ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <?php
            $CI = & get_instance();
            $CI->load->model('Capaian_m','capaian');
            $bulan = $this->input->get('bulan');
            $bulanStr = substr($bulan,0,7);


            // die();
            $result1 = $CI->capaian->getByIdRemunJoin($bulanStr,$remun->id_remun);
            $jis=1;
            $totalbobot = 0;
            $totalhasil_kinerja = 0;
            
            foreach ($result1->result() as $detail1) {
                $capaian = $CI->capaian->getCapaianByIndikator($detail1->id_indikator,$detail1->bulan)->row();
                // $jis=0;
            ?>



            <tr>
                <td></td>
                <td><?php echo $jis ?></td>
                <td><?php echo $detail1->indikator ?></td>
                <td><?php echo $detail1->definisi ?></td>
                <td><?php echo $capaian->target ?></td>
                <td><?php echo $capaian->capaian ?></td>
                <td><?php echo $capaian->bobot ?></td>
                <td><?php echo $capaian->hasil_kinerja ?></td>
            </tr>
            <?php
            $jis++;

            //penjumlahan bobot
            $totalbobot += $capaian->bobot;
            $totalhasil_kinerja += $capaian->hasil_kinerja;
            }
            ?>
            <tr>
                <th></th>
                <th colspan="2">Jumlah <?php echo $penilaian->nama_penilaian ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?php echo $totalbobot ?></th>
                <th><?php echo $totalhasil_kinerja ?></th>
               

            </tr>













            <?php
            $no++;
            $subtotalhasil_kinerja += $totalhasil_kinerja;
            }
            ?>

            <tr>
                <th colspan="3">Total Nilai Kerja Individu</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?php echo $subtotalhasil_kinerja ?> </th>
                
            </tr>
        </tbody>

    </table>

    <br>
    <br>

    <table border="0"  width="100%">
        <tr>
            <td width="23%">Pegawai yang dinilai</td>
            
            <td width="33%">Atasan langsung pejabat penilai</td>
            <td width="33%">Pejabat Penilai</td>
        
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
        
            <td width="33%" > NIP :  <?php echo $pegawai->nip ?> </td>
            <td width="33%">NIP : </td>
            <td>NIP: </td>
        </tr>
    </table>

</body>

</html>