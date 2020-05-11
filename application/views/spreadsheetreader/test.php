<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload SpreadSheet</title>
    <link href="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.css" rel="stylesheet" media="screen">

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
    <div data-jsfiddle="example1" class="ajax-container">
        <div class="controls">
            <button name="load" id="load" class="intext-btn">Load</button>
            <button name="save" id="save" class="intext-btn">Save</button>
            <label><input type="checkbox" name="autosave" id="autosave" checked="checked" autocomplete="off">Autosave</label>
        </div>
        <pre id="example1console" class="console">Click "Load" to load data from server</pre>
        <div id="example1" class="hot"></div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        var
            $$ = function(id) {
                return document.getElementById(id);
            },
            container = $$('example1'),
            exampleConsole = $$('example1console'),
            autosave = $$('autosave'),
            load = $$('load'),
            save = $$('save'),
            autosaveNotification,
            hot;

        hot = new Handsontable(container, {
            startRows: 8,
            colHeaders: ['id', 'Id Indikator', 'Indikator'],
            startCols: 6,
            rowHeaders: true,
            // colHeaders: true,
            afterChange: function(change, source) {
                if (source === 'loadData') {
                    return; //don't save this change
                }
                if (!autosave.checked) {
                    return;
                }
                clearTimeout(autosaveNotification);
                ajax('https://handsontable.com/docs/7.3.0/scripts/json/save.json', 'GET', JSON.stringify({
                    data: change
                }), function(data) {
                    exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
                    autosaveNotification = setTimeout(function() {
                        exampleConsole.innerText = 'Changes will be autosaved';
                    }, 1000);
                });
            }
        });

        Handsontable.dom.addEvent(load, 'click', function() {
            // ajax('http://localhost/simremuna3/api/pegawai?key=bbkpm2019', 'GET', '', function(res) {
            //     var data = JSON.parse(res.response.records);
            //     // var data = res;
            //     console.log(data);

            //     hot.loadData(data.records);
            //     exampleConsole.innerText = 'Data loaded';
            // });
            var xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function() {
                if (this.readyState === 4) {
                    // console.log(this.responseText);

                    var jsonData = JSON.parse((this.response));
                    console.log(jsonData.records);

                    hot.loadData(jsonData.records);
                    exampleConsole.innerText = 'Data loaded';

                }
            });

            xhr.open("GET", "http://localhost/simremuna3/api/pegawai");
            xhr.setRequestHeader("key", "bbkpm2019");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.responseType = 'json';
            xhr.send();
        });

        Handsontable.dom.addEvent(save, 'click', function() {
            // save all cell's data
            ajax('https://handsontable.com/docs/7.3.0/scripts/json/save.json', 'GET', JSON.stringify({
                data: hot.getData()
            }), function(res) {
                var response = JSON.parse(res.response);
                console.log();

                if (response.result === 'ok') {
                    exampleConsole.innerText = 'Data saved';
                } else {
                    exampleConsole.innerText = 'Save error';
                }
            });
        });

        Handsontable.dom.addEvent(autosave, 'click', function() {
            if (autosave.checked) {
                exampleConsole.innerText = 'Changes will be autosaved';
            } else {
                exampleConsole.innerText = 'Changes will not be autosaved';
            }
        });
    </script>

    <script>
    <?php
    if (($this->session->flashdata('success')==TRUE)) {

    ?>
        Swal.fire(
            'The Internet?',
            'That thing is still around?',
            'question'
        )
    <?php
    }
    ?>
    </script>

</body>

</html>