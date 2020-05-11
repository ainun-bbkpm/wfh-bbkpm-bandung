<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading bg-red">
        Remunerasi
    </div>
    <div class="list-group list-group-flush">
        <a href="<?php echo  site_url('dashboard') ?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <?php
        //jika admin
        if (($this->session->level == 1) and ($this->session->nip != 228) and ($this->session->nip != 320) and ($this->session->nip != 121)) {
            //dan jika
        ?>
            <!-- <a href="<?php //echo  site_url('dashboard/admin') 
                            ?>" class="list-group-item list-group-item-action bg-light">Admin</a> -->
            <a href="<?php echo  site_url('dashboard/pegawai') ?>" class="list-group-item list-group-item-action bg-light">Pegawai</a>
            <!-- <a href="<?php // echo  site_url('pegawai/pegawai2') 
                            ?>" class="list-group-item list-group-item-action bg-light">Pegawai 2</a> -->

            <a href="<?php echo  site_url('dashboard/akses') ?>" class="list-group-item list-group-item-action bg-light">Hak Akses</a>
            <a href="<?php echo  site_url('dashboard/datalogin') ?>" class="list-group-item list-group-item-action bg-light">Data Login</a>
            <a href="<?php echo  site_url('dashboard/absensisenam') ?>" class="list-group-item list-group-item-action bg-light">Absensi Senam</a>
            <a href="<?php echo  site_url('dashboard/absensi') ?>" class="list-group-item list-group-item-action bg-light">Absensi</a>
            <a href="<?php echo  site_url('dashboard/surat_kuasa') ?>" class="list-group-item list-group-item-action bg-light">Surat Kuasa</a>

            <a href="<?php echo  site_url('dashboard/penilaian') ?>" class="list-group-item list-group-item-action bg-light">Penilaian</a>
            <a href="<?php echo  site_url('dashboard/unit') ?>" class="list-group-item list-group-item-action bg-light">Unit Kerja</a>

            <!-- Ini Buat PSD / RINA -->
        <?php } elseif (($this->session->level == 1) and ($this->session->nip == 228) and ($this->session->nip != 320) and ($this->session->nip != 121)) { ?>
            <a href="<?php echo  site_url('dashboard/absensisenam') ?>" class="list-group-item list-group-item-action bg-light">Absensi Senam</a>
        <?php } elseif (($this->session->level == 1) and ($this->session->nip != 228) and ($this->session->nip == 320) and ($this->session->nip != 121)) { ?>
            <!-- Ini Buat Kepegawaian / Jihan -->
            <a href="<?php echo  site_url('dashboard/absensi') ?>" class="list-group-item list-group-item-action bg-light">Absensi</a>
        <?php } elseif (($this->session->level == 1) and ($this->session->nip != 228) and ($this->session->nip != 320) and ($this->session->nip == 121)) { ?>
            <!-- ini Buat sekretasi Sk / Nurul -->
            <a href="<?php echo  site_url('dashboard/surat_kuasa') ?>" class="list-group-item list-group-item-action bg-light">Surat Kuasa</a>
        <?php } else {
        } ?>


    </div>
</div>