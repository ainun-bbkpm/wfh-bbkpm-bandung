<?php

function cek_session()
{
    $CI= & get_instance();

    $session=$CI->session->has_userdata('login');
    if ($session == 0) {
         $CI->session->set_flashdata('error', 'Silahkan login terlebih dahulu');
        redirect('auth/login');
    }
}

