
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
       
        <title>Dashboard Remunerasi</title>

        <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="http://w2ui.com/src/w2ui-1.5.rc1.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/vendor/w2-desktop/w2-desktop-dark.css') ?>" id="mainCSS" />  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://w2ui.com/src/w2ui-1.5.rc1.min.js"></script>
        
        <script type="text/javascript" src="http://localhost/ci-w2desktop/assets/w2-desktop/w2-desktop.js"></script>


    </head>

    <body>
        <div id="grid_pegawai" style="width: 100%; height: 350px;"></div>
    </body>


    <script type="text/javascript">
        $(function () { 

        $().w2destroy('grid_pegawai');

        $('#grid_pegawai').w2grid({ 
            name: 'grid_pegawai', 
            
            header: 'List of Pegawai',
            bordered: true,
            url: '<?= site_url('pegawai/pegawai_lists') ?>',
            method: 'GET', 
            show: { 
                toolbar: true,
                footer: true,
                toolbarAdd: true,
                toolbarDelete: true,
                toolbarEdit: true,
                lineNumbers: true
            }, 
            sortData: [{ field: 'recid', direction: 'DESC' }],
            columns: [                
                //{ field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=center' },
                { field: 'nama_pegawai', caption: 'Nama Pegawai',  sortable: true, searchable: 'text',size: '20%' },
                { field: 'nik', caption: 'NIK',  sortable: true, searchable: 'text',size: '20%' },
            
            ],
            onAdd: function (event) {
                popuppegawai(null);
            },
            onEdit: function (event) {
                console.log(event)
                popuppegawai(event.recid);
            },
            onDelete: function (event, e) {
                if (e.status == 'success') {
                    console.log('deleted ');
                }
            }
        });    

        // form
        function popuppegawai(id) {
            $().w2destroy('form_pegawai');
            if(id  == null){
                var header = 'Tambah Data pegawai'
            }else{
                var header = 'Edit Data pegawai'

            }
            $().w2form({
                name: 'form_pegawai', 
                header: header,
                url: '<?= site_url('welcome/pegawai_form') ?>',
                style: 'border: 0',
                recid: id,
                fields: [
            
                    { field: 'Nama Pegawai', type: 'text', required: true }
                    
                ],
                actions: {
                    'Save' : function () {
                        if (this.validate())
                        {
                            this.save({}, function(data) {
                                if (data.status == 'success') {
                                    this.wd.grid_pegawai.reload();
                                    console.log(this.w2popup.close());
                                }
                            });
                        } 
                    },
                    'Reset' : function () { this.clear(); }
                }
            });
        
            $().w2popup('open', { 
                title   : 'Form  in a Popup',
                body    : '<div id="form" style="width: 100%; height: 100%"></div>',
                style   : 'padding: 0',
                width   : 500,
                height  : 300, 
                showMax : true,
                onToggle: function (event) {
                    $(wd.form_pegawai.box).hide();
                    event.onComplete = function () {
                        $(wd.form_pegawai.box).show();
                        wd.form_pegawai.resize();
                    }
                },
                onOpen: function (event) {
                    event.onComplete = function () {
                        // specifying an onOpen handler instead is equivalent to specifying an onBeforeOpen handler, which would make this code execute too early and hence not deliver.
                        $('#wd-popup #form').w2render('form_pegawai');
                    }
                }
            });
        }

        });
    </script>

    </html>