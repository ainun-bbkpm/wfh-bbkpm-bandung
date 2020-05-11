<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOT</title>

    <link href="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.css" rel="stylesheet" media="screen">
</head>

<body>


<p>
            <button name="load">Load</button>
            <button name="save">Save</button>
            <button name="reset">Reset</button>
            <label><input type="checkbox" name="autosave" checked="checked" autocomplete="off"> Autosave</label>
          </p>

          <div id="exampleConsole" class="console">Click "Load" to load data from server</div>

          <div id="example1"></div>

          <div id="example2"></div>


          <script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.js"></script>


    <script>
        var $container = $("#example1");
        var $container2 = $("#example2");
        var $console = $("#exampleConsole");
        var $parent = $container.parent();
        var autosaveNotification;
        $container.handsontable({
            startRows: 8,
            startCols: 3,
            rowHeaders: true,
            colHeaders: ['Indikator Yang Dinilai', 'Definisi Operasional', 'Target','Capaian','Bobot (%)','Nilai Hasil Kinerja'],
            columns: [
                {},
                {},
                {},
                {},
                {},
                {}
        ],
        

        minSpareCols: 0,
        minSpareRows: 1,
        contextMenu: true,
        licenseKey: 'non-commercial-and-evaluation',
        afterChange: function (change, source) {
            if (source === 'loadData') {
            return; //don't save this change
            }
            if ($parent.find('input[name=autosave]').is(':checked')) {
            clearTimeout(autosaveNotification);
            $.ajax({
                url: "http://localhost/jquery-handsontable-master/demo/php/save.php",
                dataType: "json",
                type: "POST",
                data: {changes: change}, //contains changed cells' data
                success: function () {
                $console.text('Autosaved (' + change.length + ' cell' + (change.length > 1 ? 's' : '') + ')');
                autosaveNotification = setTimeout(function () {
                    $console.text('Changes will be autosaved');
                }, 1000);
                }
            });
            }
        }
        });
        var handsontable = $container.data('handsontable');

        $parent.find('button[name=load]').click(function () {
        $.ajax({
            url: "http://localhost/jquery-handsontable-master/demo/php/load.php",
            dataType: 'json',
            type: 'GET',
            success: function (res) {
            var data = [], row;
            for (var i = 0, ilen = res.cars.length; i < ilen; i++) {
                row = [];
                row[0] = res.cars[i].manufacturer;
                row[1] = res.cars[i].year;
                row[2] = res.cars[i].price;
                row[2] = res.cars[i].price;
                row[2] = res.cars[i].price;
                row[2] = res.cars[i].price;
                data[res.cars[i].id - 1] = row;
            }
            $console.text('Data loaded');
            handsontable.loadData(data);
            }
        });
        }).click(); //execute immediately

        $parent.find('button[name=save]').click(function () {
        $.ajax({
            url: "http://localhost/jquery-handsontable-master/demo/php/save.php",
            data: {"data": handsontable.getData()}, //returns all cells' data
            dataType: 'json',
            type: 'POST',
            success: function (res) {
            if (res.result === 'ok') {
                $console.text('Data saved');
            }
            else {
                $console.text('Save error');
            }
            },
            error: function () {
            $console.text('Save error');
            }
        });
        });


        $parent.find('button[name=reset]').click(function () {
        $.ajax({
            url: "http://localhost/jquery-handsontable-master/demo/php/reset.php",
            // url: "php/reset.php",
            success: function () {
            $parent.find('button[name=load]').click();
            },
            error: function () {
            $console.text('Data reset failed');
            }
        });
        });

        $parent.find('input[name=autosave]').click(function () {
        if ($(this).is(':checked')) {
            $console.text('Changes will be autosaved');
        }
        else {
            $console.text('Changes will not be autosaved');
        }
        });
    </script>

</body>

</html>