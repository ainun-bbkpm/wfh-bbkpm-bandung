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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">

    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/toastr/css/toastr.min.css') ?>">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/editor/resources/Buttons-1.6.1/css/buttons.bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/vendor/editor/resources/Editor-2020-01-17-1.9.2/css/editor.bootstrap4.min.css') ?>">





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


                <h1 class="mt-4">Data pegawai</h1>

                <?php
                echo form_open_multipart('pegawai/spreadsheetreader');
                ?>
                
                <div class="form-group">
                    
                    <input class="form-control  col-md-3" type="file" name="test" id="">
                    
                    
                </div>


                <button type="submit" class="btn btn-primary">Upload</button>
               

                <?php
                echo form_close();
                ?>


                <div class="table-responsive mt-4">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
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
    <script src="https://code.jquery.com/jquery-3.3.1.js">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.bundle.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>">
    </script>


    <!-- Vendor -->
    <script src="<?php echo site_url('assets/vendor/toastr/js/toastr.min.js') ?>">
    </script>

    <!-- dataTables -->

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendor/editor/resources/Buttons-1.6.1/js/buttons.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendor/editor/resources/Editor-2020-01-17-1.9.2/js/dataTables.editor.min.js') ?>"></script>
    <script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendor/editor/resources/Editor-2020-01-17-1.9.2/js/editor.bootstrap4.min.js') ?>"></script>


    <script src="<?php echo base_url(); ?>/assets/vendor/datatables/js/custom.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {
            $("body").on("click", "#upload", function(e) {
                (async () => {

                    const {
                        value: file
                    } = await Swal.fire({
                        title: 'Select Excel',
                        input: 'file',
                        inputAttributes: {
                            accept: 'xls',
                            'aria-label': 'Upload your Excel'
                        }
                    })

                    if (file) {
                        const reader = new FileReader()
                        reader.onload = (e) => {
                            $.ajaxFileUpload({
                                url: "<?php echo site_url('pegawai/spreadsheetreader') ?>",
                                secureuri: false,
                                fileElementId: "file_input",
                                dataType: "json",
                                success: function(json, status) {
                                    if (json.status == 1) {
                                        $('td#filename').html(json.filename);
                                        $('td#size').html(json.size);
                                        $('td#type').html(json.type);
                                    } else {
                                        alert('Upload GAGAL!');
                                    }
                                }
                            });
                        }
                        reader.readAsDataURL(file)
                    }

                })()

            });
        });
    </script>



</body>

</html>