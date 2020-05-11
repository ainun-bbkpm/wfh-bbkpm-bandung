<?php




date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'IND');


function getToken()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/token",
        // CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/prj?tahun=2019&bulan=6",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('satker' => '415381', 'key' => 'YB7khoAQyiUzAKHVeg9MFBAQ2Z4PVDxd'),

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response;
    return $respontoken = json_decode($response);
    //return  $token = $respontoken->token;


}


//Function simpan respon ke database
function save_respon($data)
{
    $db_host = "10.0.0.4";
    $db_user = "root";     //dbase user name
    $db_password = "1231234";      //dbase pass 
    $db_name = "remunerasi";      //dbase name

    $link = mysqli_connect("$db_host", "$db_user", "$db_password");
    mysqli_select_db($link, "$db_name");


    $data = json_encode($data);
    $now = date("Y-m-d H:i:s");
    $qwr = "
	INSERT INTO `remunerasi`.`tes` (`id`, `nama`)
	VALUES
	  (null, '$data $now ');


	";

    $result = mysqli_query($link, $qwr) or die('Error, query failed');
    echo $data;
}

//-----------------------------------------------------------------------//
// PELAYANAN KESEHATAN

function getLayananKesehatan($kelas)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://10.0.0.4/web-service/api/bios/layanan_kesehatan?kelas=$kelas",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $respontoken = json_decode($response);
}


function postLayananKesehatan($kelas, $token)
{
    //cURL BIOS layanan_kesehatan
    $curl = curl_init();

    $data = [
        'kelas' => $kelas[0]->kd_kelas,
        'jml_hari' => $kelas[0]->hari, 'jml_pasien' => $kelas[0]->pasien, 'tgl_transaksi' => date('Y/m/d', strtotime($kelas[0]->tgl_transaksi))
    ];
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/kesehatan/prod",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: multipart/form-data;",
            "Token:  $token",
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
}
// PELAYANAN KESEHATAN END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Tarif

function getLayananlainyaTarif($kelas)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/tarif1?kelas=$kelas",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $respontoken = json_decode($response);
}


function postLayananlainyaTarif($kelas, $token)
{
    //cURL BIOS layanan_kesehatan
    $curl = curl_init();

    $data = [
        'kd_indikator' => $kelas[0]->id_kelas,
        'jumlah' => $kelas[0]->harga, 'tgl_transaksi' => date('Y/m/d')
    ];
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: multipart/form-data;",
            "Token:  $token",
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
}
// Layanan Lainnya Tarif END
//-----------------------------------------------------------------------//

//-----------------------------------------------------------------------//
// Layanan Lainnya Pasien Rawat Jalan

function getLayananlainyaPrj()
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/prj",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $respontoken = json_decode($response);
}


function postLayananlainyaPrj($data1, $token)
{
    //cURL BIOS layanan_kesehatan
    $curl = curl_init();

    $data = [
        'kd_indikator' => '20001', //Ini Kode untuk jumlah pasein rawat jalan
        'jumlah' => $data1->total, 'tgl_transaksi' => date('Y/m/d')
    ];
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: multipart/form-data;",
            "Token:  $token",
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

    save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
}
// Layanan Lainnya Pasien Rawat Jalan END
//-----------------------------------------------------------------------//

//-----------------------------------------------------------------------//
// Layanan Lainnya Pasien Rawat Inap
function getLayananlainyaPri()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/pri",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cookie: ci_session=8fvuvr7bekanhmkpfhmt7fivvlqmu263"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $pri = json_decode($response);

    if ($pri->result) {
        $token = getToken()->token;

        $jumlah = $pri->pasien;
        $data = [
            'kd_indikator' => '20003', //rawat inap kode indikatornya 20003
            'jumlah' => "$jumlah", 'tgl_transaksi' => date('Y/m/d')
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => true,

            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
    } else {
        //Data Kosong
        save_respon(['pesan' => 'Data Kosong Pasien Rawat Inap']);
    }
}

// Layanan Lainnya Inap END
//-----------------------------------------------------------------------//

//-----------------------------------------------------------------------//
// Layanan Lainnya BOR
function getLayananlainyaBor()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/bor",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $bor = json_decode($response);
    if ($bor->result) {
        $bor = $bor->result;
        //Catatan
        // untuk BOR outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS
        $jumlah = str_replace(",", ".", $bor[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20008', //Ini Kode untuk jumlah pasein rawat jalan
            'jumlah' => "$jumlah", 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
    } else {
        save_respon(['pesan' => 'Data Kosong Bor']);
    }
}

// Layanan Lainnya BOR
//-----------------------------------------------------------------------//



//-----------------------------------------------------------------------//
// Layanan Lainnya BOR
function getLayananlainyaBto()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/bto",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $bto = json_decode($response);
    if ($bto->result) {
        $bto = $bto->result;
        //Catatan
        // untuk BTO outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS
        $jumlah = str_replace(",", ".", $bto[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20010', //Ini Kode untuk BTO
            'jumlah' => "$jumlah", 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
    } else {
        save_respon(['pesan' => 'Data Kosong BTO']);
    }
}

// Layanan Lainnya BTO END
//-----------------------------------------------------------------------//

//-----------------------------------------------------------------------//
// Layanan Lainnya Alos
function getLayananlainyaAlos()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/alos",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $alos = json_decode($response);
    if ($alos->result) {
        $alos = $alos->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $alos[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20009', //Ini Kode untuk BTO
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Alos']);
    }
}

// Layanan Lainnya Alos END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Toi
function getLayananlainyaToi()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/toi",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $toi = json_decode($response);
    if ($toi->result) {
        $toi = $toi->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $toi[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20012', //Ini Kode untuk TOI
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong toi']);
    }
}

// Layanan Lainnya toi END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Ndr
function getLayananlainyaNdr()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/ndr",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $ndr = json_decode($response);
    if ($ndr->result) {
        $ndr = $ndr->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $ndr[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20011', //Ini Kode untuk TOI
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Ndr']);
    }
}

// Layanan Lainnya Ndr END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Krk
function getLayananlainyaKrk()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/krk",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $krk = json_decode($response);
    if ($krk->result) {
        $krk = $krk->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $krk[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20026', //Ini Kode untuk KRK
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Krk']);
    }
}

// Layanan Lainnya Krk END
//-----------------------------------------------------------------------//

//-----------------------------------------------------------------------//
// Layanan Lainnya Wtrj
function getLayananlainyaWtrj()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/wtrj",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $wtrj = json_decode($response);
    if ($wtrj->result) {
        $wtrj = $wtrj->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $wtrj[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20045', //Ini Kode untuk Wtrj
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Wtrj']);
    }
}

// Layanan Lainnya Wtrj END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Wtoj
function getLayananlainyaWtoj()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/wtoj",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $wtoj = json_decode($response);
    if ($wtoj->result) {
        $wtoj = $wtoj->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $wtoj[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20032', //Ini Kode untuk Wtoj
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Wtoj']);
    }
}

// Layanan Lainnya Wtoj END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Kip
function getLayananlainyaKip()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/kip",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $kip = json_decode($response);
    if ($kip->result) {
        $kip = $kip->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $kip[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20028', //Ini Kode untuk Kip
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Kip']);
    }
}

// Layanan Lainnya Kip END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Fornas
function getLayananlainyaFornas()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/fornas",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $fornas = json_decode($response);
    if ($fornas->result) {
        $fornas = $fornas->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $fornas[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20022', //Ini Kode untuk Fornas
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Fornas']);
    }
}

// Layanan Lainnya Fornas END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Kpj
function getLayananlainyaKpj()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/kpj",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $kpj = json_decode($response);
    if ($kpj->result) {
        $kpj = $kpj->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $kpj[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20050', //Ini Kode untuk Kpj
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Kpj']);
    }
}

// Layanan Lainnya Kpj END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Pnbp
function getLayananlainyaPnbp()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/pnbp",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $pnbp = json_decode($response);
    if ($pnbp->result) {
        $pnbp = $pnbp->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $pnbp[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20049', //Ini Kode untuk Pnbp
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Pnbp']);
    }
}

// Layanan Lainnya Pnbp END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Prm
function getLayananlainyaPrm()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/prm",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $prm = json_decode($response);
    if ($prm->result) {
        $prm = $prm->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $prm[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20030', //Ini Kode untuk Prm
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Prm']);
    }
}

// Layanan Lainnya Prm END
//-----------------------------------------------------------------------//


//-----------------------------------------------------------------------//
// Layanan Lainnya Wtpr
function getLayananlainyaWtpr()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "bbkpm-bandung.org/web-service/api/bios/wtpr",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $wtpr = json_decode($response);
    if ($wtpr->result) {
        $wtpr = $wtpr->result;
        //Catatan
        // untuk alos outputnya ada koma koma, sedangkan BIOS2 tidak bisa koma koma, maka dibelakang koma dihilangkan supaya bisa masuk BIOS2
        $jumlah = str_replace(",", ".", $wtpr[0]->nilai);

        $token = getToken()->token;
        $data = [
            'kd_indikator' => '20055', //Ini Kode untuk Wtpr
            'jumlah' => $jumlah, 'tgl_transaksi' => date('Y/m/d')
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://training-bios2.kemenkeu.go.id/api/ws/lainnya/prod",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: multipart/form-data;",
                "token: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        save_respon(['pesan' => 'Sip Data tersimpan ' . json_encode($data)]);
        //ECHO $response;

    } else {
        save_respon(['pesan' => 'Data Kosong Wtpr']);
    }
}

// Layanan Lainnya Wtpr END
//-----------------------------------------------------------------------//




if (getToken()->status == "MSG20004") {

    //-----------------------------------------------------------------------//
    // PELAYANAN KESEHATAN
    $kelas1 = getLayananKesehatan(1)->result;
    $kelas2 = getLayananKesehatan(2)->result;
    $kelas3 = getLayananKesehatan(3)->result;

    if ($kelas3) {
        $token = getToken()->token;
        //postLayananKesehatan($kelas3, $token);
    } else {
        //Data Kosong
        save_respon(['pesan' => 'Data Kosong kelas 3, kode 04']);
    }
    if ($kelas2) {
        $token = getToken()->token;
        //postLayananKesehatan($kelas2, $token);
    } else {
        //Data Kosong
        //save_respon(['pesan' => 'Data Kosong kode 03, kelas 2  ']);
    }
    if ($kelas1) {
        $token = getToken()->token;
        //postLayananKesehatan($kelas1, $token);
    } else {
        //Data Kosong
        //save_respon(['pesan' => 'Data Kosong kelas 1, kode 02']);
    }
    // PELAYANAN KESEHATAN END
    //-----------------------------------------------------------------------//



    //-----------------------------------------------------------------------//
    // Layanan Lainnya Tarif
    $tarifkelas1 = getLayananlainyaTarif(1)->result;
    $tarifkelas2 = getLayananlainyaTarif(2)->result;
    $tarifkelas3 = getLayananlainyaTarif(3)->result;

    if ($tarifkelas3) {
        $token = getToken()->token;
        // postLayananlainyaTarif($tarifkelas3, $token);
    } else {
        //Data Kosong
        // save_respon(['pesan' => 'Data tarif 3 Kosong']);
    }
    if ($tarifkelas2) {
        $token = getToken()->token;
        // postLayananlainyaTarif($tarifkelas2, $token);
    } else {
        //Data Kosong
        // save_respon(['pesan' => 'Data  tarif 2 Kosong ']);
    }
    if ($tarifkelas1) {
        $token = getToken()->token;
        // postLayananlainyaTarif($tarifkelas1, $token);
    } else {
        //Data Kosong
        // save_respon(['pesan' => 'Data  tarif 1 Kosong ']);
    }
    // Layanan Lainnya Tarif END
    //-----------------------------------------------------------------------//


    //-----------------------------------------------------------------------//
    // Layanan Lainnya Pasien Rawat Jalan
    $prj = getLayananlainyaPrj();
    if ($prj) {
        $token = getToken()->token;

        //postLayananlainyaPrj($prj, $token);
    } else {
        //Data Kosong
        // save_respon(['pesan' => 'Data tarif 3 Kosong']);
    }

    // Layanan Lainnya Pasien Rawat Jalan END
    //-----------------------------------------------------------------------//



    //-----------------------------------------------------------------------//
    // Layanan Lainnya Pasien Rawat inap
    getLayananlainyaPri();
    //echo $pri;
    // Layanan Lainnya Pasien Rawat inap END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya BOR
    //getLayananlainyaBor();
    // Layanan Lainnya BOR END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya BTO
    //getLayananlainyaBto();
    // Layanan Lainnya BTO END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Alos
    //getLayananlainyaAlos();
    // Layanan Lainnya Alos END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Toi
    //getLayananlainyaToi();
    // Layanan Lainnya Toi END
    //-----------------------------------------------------------------------//


    //-----------------------------------------------------------------------//
    // Layanan Lainnya Ndr
    //getLayananlainyaNdr();
    // Layanan Lainnya Ndr END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Krk
    //getLayananlainyaKrk();
    // Layanan Lainnya Krk END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Wtrj
    //getLayananlainyaWtrj();
    // Layanan Lainnya Wtrj END
    //-----------------------------------------------------------------------//	

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Wtoj
    //getLayananlainyaWtoj();
    // Layanan Lainnya Wtoj END
    //-----------------------------------------------------------------------//	


    //-----------------------------------------------------------------------//
    // Layanan Lainnya Kip
    //getLayananlainyaKip();
    // Layanan Lainnya Kip END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Fornas
    //getLayananlainyaFornas();
    // Layanan Lainnya Fornas END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Kpj
    //getLayananlainyaKpj();
    // Layanan Lainnya Kpj END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Pnbp
    //getLayananlainyaPnbp();
    // Layanan Lainnya Pnbp END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Prm
    //getLayananlainyaPrm();
    // Layanan Lainnya Prm END
    //-----------------------------------------------------------------------//

    //-----------------------------------------------------------------------//
    // Layanan Lainnya Wtpr
    //getLayananlainyaWtpr();
    // Layanan Lainnya Wtpr END
    //-----------------------------------------------------------------------//







} else {
    //Error saat minta token
    save_respon(getToken());
};
