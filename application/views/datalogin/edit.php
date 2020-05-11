<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
    <!-- <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') ?>"> -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">

    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/toastr/css/toastr.min.css') ?>">
       <!-- select2 -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/select2-bootstrap4/css/select2.min.css') ?>">
    <!-- select2-bootstrap4-theme -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/select2-bootstrap4/css/select2-bootstrap4.css') ?>">
  
    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">

</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_includes/sidebar.php'); ?>
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


                <h3 class="mt-4">Edit Data Login</h3>

                <a href="<?php echo site_url('dashboard/datalogin') ?>" class="btn btn-warning btn-sm">
                    Batal</a>


                <div class="card mt-4">
                    <div class="card-header">
                        Edit 
                    </div>
                    <div class="card-body">
                        <?php echo form_open('',' class="needs-validation" novalidate id="form_data_login" ') ?>
                            <div class="form-row">
                                <div class="col-md-4 mb-6">
                                    <label for="nip_pegawai">Nama Login</label>
                                    <!-- <input type="text" class="form-control" id="nama_admin" placeholder="Nama Admin"
                                        name="nama_admin" required> -->
                                        <input type="hidden" id="id_login" name="id_login" value="<?php echo $datalogin->id_login ?>" >

                                        
                                        <select name="nip_pegawai" id="nip_pegawai" class="form-control select2">
                                            <?php
                                            foreach ($pegawai_all as $pegawai) {
                                                # code...
                                            
                                            ?>
                                            <option value="<?php echo $pegawai->nip ?>" <?php echo $pegawai->nip == $datalogin->nip_pegawai ?'selected':'' ?> ><?php echo $pegawai->nama_pegawai ?></option>
                                            <?php }?>
                                        </select>


                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Nama Login
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email_login">Email Login</label>
                                    <input type="email" value="<?php echo $datalogin->email ?>" class="form-control" id="email_login" placeholder="Email Admin"
                                        name="email" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Silahakan isi Email Login
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustomUsername">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        </div>
                                        <input type="text" class="form-control" id="validationCustomUsername"
                                            placeholder="Username" name="username"
                                            aria-describedby="inputGroupPrepend" value="<?php echo $datalogin->username ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Silahakan isi username.
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="password_admin">Password Login</label>
                                    <input type="hidden" id="password_lama_admin" name="password_lama_admin" value="<?php echo $datalogin->password ?>" >
                                    <input type="text" name="password" class="form-control" id="password_admin"
                                        placeholder="Kosongkan jika tidak ada perubahan">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Password Login.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="no_hp_admin">No Hp Login</label>
                                    <input type="text" name="no_hp" value="<?php echo $datalogin->no_hp ?>" class="form-control" id="no_hp_admin"
                                        placeholder="No Hp Admin" maxlength="15" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid No Hp Login.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="level_admin">Level Login</label>
                                    <select class="form-control" id="level_admin" required name="level">
                                        <option value="1" <?php echo $datalogin->level == '1'?'selected':'' ?>>Admin</option>
                                        <option value="2" <?php echo $datalogin->level == '2'?'selected':'' ?>>Approval</option>
                                        <option value="3" <?php echo $datalogin->level == '3'?'selected':'' ?>>Penilai</option>
                                        <option value="4" <?php echo $datalogin->level == '4'?'selected':'' ?>>Pegawai</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid zip.
                                    </div>
                                </div>
                            </div> 
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <img  width="50%" src="<?php echo site_url('uploads/pegawai/').$datalogin->picture  ?>"  alt="">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="password_admin">Picture</label>
                                    <input type="file" accept="image/*" name="picture" class="form-control" id="picture">
                                    <input type="hidden" name="picture_old" id="picture_old" value="<?php echo $datalogin->picture ?>"> 


                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Password Login.
                                    </div>
                                </div>
                               
                            </div>

                            <button class="btn btn-primary btn-sm" type="button" id="update">Update</button>
                        </form>
                        <div class="mt-4">
                            <small class="mt-4">
                                Menampilkan halaman dalam <strong>{elapsed_time}</strong> detik.
                            </small>
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

    <script src="<?php echo site_url('assets/vendor/select2-bootstrap4/js/select2.min.js') ?>">
    </script>

    
    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <script src="<?php echo site_url('assets/vendor/ajaxfileupload/ajaxfileupload.js') ?>"></script>

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
    $(document).ready(function() {
        $.ajax({
            url : '<?php echo base_url("api/login?id_login=$id_login"); ?>',
            type: "GET",
            
            success: function(res) {
                // console.log(res);
                if (res.status === false) {
                    swal.fire({
                        text: 'Id tidak tersedia.',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        confirmButtonColor: 'red',
                        
                    })
                }else{
                    

                }
                
            },
            error: function(error) {
                // console.log(error);
                
                swal.fire({
                    text: 'Terjadi kesalahan.'+error.status+' '+error.statusText,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red',
                    
                })
            }
        });

    })


    //Select2
    $(function(){
        $('.select2').select2({
            
            theme: 'bootstrap4'
        });
    });



     // Validasi hanya anggka saja
    var no_hp_admin = document.getElementById('no_hp_admin');
    no_hp_admin.addEventListener('keyup', function(e) {
        no_hp_admin.value = nominal(this.value);
    });
    // Fungsi Validasi hanya anggka saja
    function nominal(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString();
        return number_string

    }

    $("body").on("click", "#update", function(e) {
        var nip_pegawai = $('#nip_pegawai').val()
        var id_login = $('#id_login').val()
        var email_login = $('#email_login').val()
        var username = $('#validationCustomUsername').val()
        var password_admin = $('#password_admin').val()
        var password_lama_admin = $('#password_lama_admin').val()
        var no_hp_admin = $('#no_hp_admin').val()
        var level_admin = $('#level_admin').val()
        var picture_old = $('#picture_old').val()

        if (nip_pegawai == '' || email_login == '' || username ==''  || no_hp_admin=='' || level_admin=='') {
        // if (nip_pegawai == '') {
            $('#form_data_login').attr('class','was-validated')
            
        } else {
            swal.fire({
                text: "Update Data ?",
                showCancelButton: true,
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                
            }).then((result) => {
                if (result.value==true) {
                    
                    // $('#form_data_login').submit()
                    // location.reload()
                    $.ajax({
                        url : "<?php echo base_url('api/login'); ?>",
                        type: "PUT",
                        data:{
                            
                            key:'bbkpm2019',
                            id_login:id_login,
                            nip_pegawai:nip_pegawai,
                            email:email_login,
                            password:password_admin,
                            password_lama_admin:password_lama_admin,
                            no_hp:no_hp_admin,
                            username:username,
                            level:level_admin

                        },
                        success: function(res) {
                            //upload juga fotonya di
                            $.ajaxFileUpload({
                                url: "<?php echo site_url('api/login/upload_picture') ?>",
                                secureuri: false,
                                fileElementId: "picture",
                                data: {                    
                                    'id_login': id_login,
                                    'picture_old': picture_old,
                                },
                                dataType: "text",
                                

                            });
                            
                            if (res.status === false) {
                                swal.fire({
                                    text: 'Id tidak tersedia.',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: 'red',
                                    
                                })
                            }else{
                                
                                swal.fire({
                                    text: "Berhasil Diupdate",
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#3085d6',
                                    
                                }).then((result) => {
                                    location.reload()
                                })

                            }
                            
                        },
                        error: function(error) {
                            // console.log(error);
                            
                            swal.fire({
                                text: 'Terjadi kesalahan.'+error.status+' '+error.statusText,
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                confirmButtonColor: 'red',
                                
                            })
                        }
                    });

                }else{

                }
                
            })
        }
        


    })
    </script>
   


</body>

</html>