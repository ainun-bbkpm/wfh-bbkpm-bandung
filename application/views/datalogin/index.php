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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css" />


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


                <h2 class="mt-4">Data Login </h2>

                <a href="<?php echo site_url('dashboard/datalogin/tambah') ?>" class="btn btn-success btn-sm">Tambah Data Login</a>

                <div class="table-responsive mt-4">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:2%">Id</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Last Logout</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Last Logout</th>
                                <th>Aksi</th>


                            </tr>
                        </tfoot>
                    </table>

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
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/vendor/ajaxfileupload/ajaxfileupload.js') ?>"></script>


    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <?php $this->load->view('_includes/js.php'); ?>


    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "ajax": "<?php echo site_url('api/login') ?>",

                "columns": [{
                        "data": "id_login"
                    },
                    {
                        "data": "nip_pegawai"
                    },
                    {
                        "data": "nama_pegawai"
                    },
                    {
                        "data": "username"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "level",
                        "render": function(data, type, row) {
                            switch (data) {
                                case '1':
                                    return '<span class="badge badge-pill badge-primary">Admin</span>'
                                    break;
                                case '2':
                                    return '<span class="badge badge-pill badge-info">Approval</span>'
                                    break;
                                case '3':
                                    return '<span class="badge badge-pill badge-secondary">Penilai</span>'
                                    break;
                                case '4':
                                    return '<span class="badge badge-pill badge-dark">Pegawai</span>'
                                    break;
                                default:
                                    break;
                            }
                            return data
                        }

                    }

                    ,
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (data === '1') {
                                return '<span class="badge badge-success">Aktif</span>'
                            } else {
                                return '<span class="badge badge-danger">Non Aktif</span>'
                            }
                            return data
                        }

                    },
                    {
                        "data": "last_login"
                    },
                    {
                        "data": "last_logout"
                    },
                    {
                        "data": "id_login",
                        "render": function(data, type, row) {

                            return `
                            
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                            </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
                                    <a href="<?php echo site_url('dashboard/datalogin/edit?id=') ?>`+data+` "  class="btn btn-info btn-sm">Edit</a> <button type="button" class="btn btn-danger btn-sm delete" id="`+data+`"">Hapus</button>
                                </div>
                            </div>
                           
                            
                            
                            `

                            // return data
                        }

                    }

                ],
                rowId: 'id_login'

            });



            //Hapus modal Swal2
            $("body").on("click", ".delete", function(e) {
                swal.fire({
                    text: 'Hapus data login ini.?',

                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red',

                }).then((result) => {
                    if (result.value == true) {
                        var id = this.id
                        // console.log(id);
                        $.ajax({
                            url: "<?php echo base_url('api/login'); ?>",
                            type: "DELETE",
                            data: {
                                id: id,
                                key: 'bbkpm2019'
                            },
                            success: function(res) {
                                // console.log(res);
                                if (res.status === false) {
                                    swal.fire({
                                        text: 'Id tidak tersedia.',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: 'red',

                                    })
                                } else {

                                    swal.fire({
                                        text: "Berhasil dihapus",
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
                                    text: 'Terjadi kesalahan.' + error.status + ' ' + error.statusText,
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: 'red',

                                })
                            }
                        });

                    } else {

                    }
                })


            });



        });
    </script>



</body>

</html>