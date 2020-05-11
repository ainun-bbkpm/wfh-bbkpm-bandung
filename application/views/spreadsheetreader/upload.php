<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Pegawai Baru</title>


    <link rel="stylesheet" type="text/css" href="http://w2ui.com/src/w2ui-1.4.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://w2ui.com/src/w2ui-1.4.min.js"></script>
</head>

<body>
    <?php
    echo form_open_multipart('pegawai/spreadsheetreader');
    ?>

    <input type="file" name="test" id="">


    <button type="submit">Upload</button>

    <?php
    echo form_close();
    ?>

    <div id="myGrid" style="height: 450px"></div>
</body>
<script>
    $().w2destroy('#myGrid');
    $('#myGrid').w2grid({
        header: 'List of Pegawai',
        bordered: true,
        name: 'myGrid',
        url: '<?= site_url('pegawai/api_list_pegawai2') ?>',
        method: 'GET', 
        show: { 
            toolbar: true,
            footer: true
        },
        multiSearch: false,
        searches: [
            { field: 'recid', caption: 'ID ', type: 'int' },
            { field: 'nama_pegawai', caption: 'Nama Pegawai', type: 'text' },
            { field: 'nik', caption: 'NIK', type: 'int' },
            { field: 'nip', caption: 'NIP', type: 'int' },
            { field: 'sdate', caption: 'Start Date', type: 'date' }
        ],
        columns: [                
            { field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=center' },
            { field: 'nama_pegawai', caption: 'Nama Pegawai', size: '30%', sortable: true },
            { field: 'nik', caption: 'NIK', size: '30%', sortable: true },
            { field: 'nip', caption: 'NIP', size: '40%' },
            { field: 'sdate', caption: 'Start Date', size: '120px' }
        ],
        
        
    });
</script>

</html>