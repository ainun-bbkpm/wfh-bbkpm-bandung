<?php
defined('BASEPATH') or exit('No direct script access allowed');



$route['default_controller'] = 'wfh';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Admin
$route['dashboard/admin'] = 'admin';
$route['dashboard/admin/tambah'] = 'admin/tambah';
$route['dashboard/admin/edit'] = 'admin/edit';

//Pegawai
$route['dashboard/pegawai'] = 'pegawai';
$route['dashboard/pegawai/tambah'] = 'pegawai/tambah';
$route['dashboard/pegawai/edit'] = 'pegawai/edit';
$route['dashboard/pegawai/atasan'] = 'pegawai/atasan';
$route['dashboard/pegawai/atasan_add'] = 'pegawai/atasan_add';
$route['dashboard/pegawai/atasan_edit'] = 'pegawai/atasan_edit';
$route['dahsboard/pegawai/biodata'] = 'dashboard/biodata';


//MODUL WFH

$route['whf/login'] = 'whf/login';




//Pegawai2
$route['dashboard/pegawai2'] = 'pegawai/pegawai2';
$route['dashboard/pegawai2/tambah'] = 'pegawai/tambah';
$route['dashboard/pegawai2/edit'] = 'pegawai/edit';
$route['dashboard/pegawai2/atasan'] = 'pegawai/atasan';
$route['dashboard/pegawai2/atasan_add'] = 'pegawai/atasan_add';
$route['dashboard/pegawai2/atasan_edit'] = 'pegawai/atasan_edit';
$route['pegawai/ajax/staff'] = 'api/ajax/staff';



//Penilaian
$route['dashboard/penilaian'] = 'penilaian';
$route['dashboard/penilaian/tambah'] = 'penilaian/tambah';
$route['dashboard/penilaian/edit'] = 'penilaian/edit';

//Unit Kerja
$route['dashboard/unit'] = 'unit';
$route['dashboard/unit/tambah'] = 'unit/tambah';
$route['dashboard/unit/edit'] = 'unit/edit';

//Jabatan
$route['dashboard/jabatan'] = 'jabatan';
$route['dashboard/jabatan/tambah'] = 'jabatan/tambah';
$route['dashboard/jabatan/edit'] = 'jabatan/edit';

//Hak Akses
$route['dashboard/akses'] = 'akses';
$route['dashboard/akses/tambah'] = 'akses/tambah';
$route['dashboard/akses/edit'] = 'akses/edit';

//REMUN
$route['dashboard/remun'] = 'remun';
$route['dashboard/remun/tambah'] = 'remun/tambah';
$route['dashboard/remun/edit'] = 'remun/edit';


//Absensi
$route['dashboard/absensi'] = 'absensi';
$route['dashboard/remun/tambah'] = 'remun/tambah';
$route['dashboard/remun/edit'] = 'remun/edit';


//Absensi Senam
$route['dashboard/absensisenam'] = 'absensisenam';

//Data Login
// $route['dashboard/datalogi'] = 'api/login';
$route['dashboard/datalogin'] = 'api/login/tampil';
$route['dashboard/datalogin/tambah'] = 'api/login/tambah';
$route['dashboard/datalogin/edit'] = 'api/login/edit';

//Approval
$route['dashboard/approval'] = 'approval';


//Dashboiard Penilai
$route['penilai'] = 'penilai';


//Dashboiard Pegawai
$route['pegawai'] = 'pegawai/dashboard';
$route['pegawai/biodata'] = 'pegawai/biodata';
$route['pegawai/wfh'] = 'wfh/pegawai';
$route['pegawai/wfh/logbook'] = 'wfh/log_book';
