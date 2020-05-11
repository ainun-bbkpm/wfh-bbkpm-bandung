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


                <h2 class="mt-4">Data Absensi Senam </h2>
                <div class="pb-4">

                    <a href="http://" id="upload" class="btn btn-success btn-sm ">Upload Absensi Senam</a>
                </div>


                <table id="example" class="table table-bordered " style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tahun</th>
                            <th>01</th>
                            <th>02</th>
                            <th>03</th>
                            <th>04</th>
                            <th>05</th>
                            <th>06</th>
                            <th>07</th>
                            <th>08</th>
                            <th>09</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Tahun</th>
                            <th>01</th>
                            <th>02</th>
                            <th>03</th>
                            <th>04</th>
                            <th>05</th>
                            <th>06</th>
                            <th>07</th>
                            <th>08</th>
                            <th>09</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>

                        </tr>
                    </tfoot>
                </table>

            </div>




        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <footer class="footer bg-light border-right pl-4">
        <h5>BBKPM BANDUNG @ 2019</h5>
    </footer>



    <!-- Modal Start -->
    <?php $this->load->view('_includes/modal.php'); ?>

    <!-- Modal Detail -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.6/dist/sweetalert2.all.min.js" integrity="sha256-Ry2q7Rf2s2TWPC2ddAg7eLmm7Am6S52743VTZRx9ENw=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {
            $("body").on("click", "#upload", function(e) {
                Swal.fire({
                    title: 'pick a file:',
                    type: 'question',
                    html: '<input id="file_absensi" name="file_absensi" required class="form-control" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">',
                    customClass: 'swal2-overflow',
                    onOpen: function() {
                        $('#datepicker').datepicker({
                            dateFormat: 'yy-mm-dd'
                        });
                    }
                }).then(function(result) {
                    if (result.value) {
                        var bulan = $('#datepicker').val()

                        // $("#pesan").ajaxStart(function(){
                        //     $(this).show();
                        // }).ajaxComplete(function(){
                        //     Swal.fire('Berhasil')
                        // });
                        $.ajaxFileUpload({
                            url: "<?php echo site_url('absensisenam/simpan') ?>",
                            secureuri: false,
                            fileElementId: "file_absensi",
                            data: {
                                'date_absensi': bulan,
                            },
                            dataType: "text",
                            success: function(json, status) {
                                var res = JSON.parse(json)

                                if (res.status == 1) {
                                    Swal.fire(
                                        'Upload Berhasil',
                                        '',
                                        'success'
                                    ).then(function(result) {
                                        location.reload();
                                    })


                                } else {
                                    Swal.fire(
                                        'Gagal Upload',
                                        '',
                                        'error'
                                    )
                                }
                            },
                            error: function(err) {
                                console.log(err.responseText);

                                Swal.fire(
                                    'Gagal Upload, Periksa API',
                                    '',
                                    'error'
                                )

                            }

                        });

                        // return false;

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "ajax": "<?php echo site_url('absensi/api_list_senam') ?>",

                "columns": [{
                        "data": "nama_pegawai"
                    },
                    {
                        "data": "tahun"
                    },
                    {
                        "data": "januari"
                    },
                    {
                        "data": "februari"
                    },
                    {
                        "data": "maret"
                    },
                    {
                        "data": "april"
                    },
                    {
                        "data": "mei"
                    },
                    {
                        "data": "juni"
                    },
                    {
                        "data": "juli"
                    },
                    {
                        "data": "agustus"
                    },
                    {
                        "data": "september"
                    },
                    {
                        "data": "oktober"
                    },
                    {
                        "data": "november"
                    },
                    {
                        "data": "desember"
                    },

                ],
                rowId: 'id_absensi_senam'

            });



            $('#example').on('dblclick', 'tr', function() {
                var id = table.row(this).id();

                $('#recipient-name').val(id)


                // $('#detail').modal('toggle')
                // alert( 'Clicked row id '+id );
            });


        });

        function format(d) {
            return 'Full name: ' + d.first_name + ' ' + d.last_name + '<br>' +
                'Salary: ' + d.salary + '<br>' +
                'The child row can contain any data you wish, including links, images, inner tables etc.';
        }
    </script>



</body>

</html>