<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOT 2</title>

    <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">


    <link rel="stylesheet" href="<?php echo  base_url('assets/css/bootstrap.min.css') ?>">



    <link rel="stylesheet" href="<?php echo  base_url('assets/vendor/handsontable/handsontable.full.min.css') ?>">



</head>

<body>

    <div id="hot"></div>
    <div id="hot2" class="mt-4"></div>





    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery-3.4.1.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.bundle.min.js') ?>">
    </script>

    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>">
    </script>

    <script src="<?php echo site_url('assets/vendor/handsontable/handsontable.full.min.js') ?>">
    </script>
    <script>
        var dataObject = [{
                id: 1,
                flag: 'EUR',
                currencyCode: 'EUR',
                currency: 'Euro',
                level: 0.9033,
                units: 'EUR / USD',
                asOf: '08/19/2019',
                onedChng: 0.0026
            },
            {
                id: 2,
                flag: 'JPY',
                currencyCode: 'JPY',
                currency: 'Japanese Yen',
                level: 124.3870,
                units: 'JPY / USD',
                asOf: '08/19/2019',
                onedChng: 0.0001
            },
            {
                id: 3,
                flag: 'GBP',
                currencyCode: 'GBP',
                currency: 'Pound Sterling',
                level: 0.6396,
                units: 'GBP / USD',
                asOf: '08/19/2019',
                onedChng: 0.00
            },
            {
                id: 4,
                flag: 'CHF',
                currencyCode: 'CHF',
                currency: 'Swiss Franc',
                level: 0.9775,
                units: 'CHF / USD',
                asOf: '08/19/2019',
                onedChng: 0.0008
            },
            {
                id: 5,
                flag: 'CAD',
                currencyCode: 'CAD',
                currency: 'Canadian Dollar',
                level: 1.3097,
                units: 'CAD / USD',
                asOf: '08/19/2019',
                onedChng: -0.0005
            },
            {
                id: 6,
                flag: 'AUD',
                currencyCode: 'AUD',
                currency: 'Australian Dollar',
                level: 1.3589,
                units: 'AUD / USD',
                asOf: '08/19/2019',
                onedChng: 0.0020
            },
            {
                id: 7,
                flag: 'NZD',
                currencyCode: 'NZD',
                currency: 'New Zealand Dollar',
                level: 1.5218,
                units: 'NZD / USD',
                asOf: '08/19/2019',
                onedChng: -0.0036
            },
            {
                id: 8,
                flag: 'SEK',
                currencyCode: 'SEK',
                currency: 'Swedish Krona',
                level: 8.5280,
                units: 'SEK / USD',
                asOf: '08/19/2019',
                onedChng: 0.0016
            },
            {
                id: 9,
                flag: 'NOK',
                currencyCode: 'NOK',
                currency: 'Norwegian Krone',
                level: 8.2433,
                units: 'NOK / USD',
                asOf: '08/19/2019',
                onedChng: 0.0008
            },
            {
                id: 10,
                flag: 'BRL',
                currencyCode: 'BRL',
                currency: 'Brazilian Real',
                level: 3.4806,
                units: 'BRL / USD',
                asOf: '08/19/2019',
                onedChng: -0.0009
            },
            {
                id: 11,
                flag: 'CNY',
                currencyCode: 'CNY',
                currency: 'Chinese Yuan',
                level: 6.3961,
                units: 'CNY / USD',
                asOf: '08/19/2019',
                onedChng: 0.0004
            },
            {
                id: 12,
                flag: 'RUB',
                currencyCode: 'RUB',
                currency: 'Russian Rouble',
                level: 65.5980,
                units: 'RUB / USD',
                asOf: '08/19/2019',
                onedChng: 0.0059
            },
            {
                id: 13,
                flag: 'INR',
                currencyCode: 'INR',
                currency: 'Indian Rupee',
                level: 65.3724,
                units: 'INR / USD',
                asOf: '08/19/2019',
                onedChng: 0.0026
            },
            {
                id: 14,
                flag: 'TRY',
                currencyCode: 'TRY',
                currency: 'New Turkish Lira',
                level: 2.8689,
                units: 'TRY / USD',
                asOf: '08/19/2019',
                onedChng: 0.0092
            },
            {
                id: 15,
                flag: 'THB',
                currencyCode: 'THB',
                currency: 'Thai Baht',
                level: 35.5029,
                units: 'THB / USD',
                asOf: '08/19/2019',
                onedChng: 0.0044
            },
            {
                id: 16,
                flag: 'IDR',
                currencyCode: 'IDR',
                currency: 'Indonesian Rupiah',
                level: 13.83,
                units: 'IDR / USD',
                asOf: '08/19/2019',
                onedChng: -0.0009
            },
            {
                id: 17,
                flag: 'MYR',
                currencyCode: 'MYR',
                currency: 'Malaysian Ringgit',
                level: 4.0949,
                units: 'MYR / USD',
                asOf: '08/19/2019',
                onedChng: 0.0010
            },
            {
                id: 18,
                flag: 'MXN',
                currencyCode: 'MXN',
                currency: 'Mexican New Peso',
                level: 16.4309,
                units: 'MXN / USD',
                asOf: '08/19/2019',
                onedChng: 0.0017
            },
            {
                id: 19,
                flag: 'ARS',
                currencyCode: 'ARS',
                currency: 'Argentinian Peso',
                level: 9.2534,
                units: 'ARS / USD',
                asOf: '08/19/2019',
                onedChng: 0.0011
            },
            {
                id: 20,
                flag: 'DKK',
                currencyCode: 'DKK',
                currency: 'Danish Krone',
                level: 6.7417,
                units: 'DKK / USD',
                asOf: '08/19/2019',
                onedChng: 0.0025
            },
            {
                id: 21,
                flag: 'ILS',
                currencyCode: 'ILS',
                currency: 'Israeli New Sheqel',
                level: 3.8262,
                units: 'ILS / USD',
                asOf: '08/19/2019',
                onedChng: 0.0084
            },
            {
                id: 22,
                flag: 'PHP',
                currencyCode: 'PHP',
                currency: 'Philippine Peso',
                level: 46.3108,
                units: 'PHP / USD',
                asOf: '08/19/2019',
                onedChng: 0.0012
            }
        ];
        var currencyCodes = ['EUR', 'JPY', 'GBP', 'CHF', 'CAD', 'AUD', 'NZD', 'SEK', 'NOK', 'BRL', 'CNY', 'RUB', 'INR', 'TRY', 'THB', 'IDR', 'MYR', 'MXN', 'ARS', 'DKK', 'ILS', 'PHP'];
        var flagRenderer = function(instance, td, row, col, prop, value, cellProperties) {
            var currencyCode = value;
            while (td.firstChild) {
                td.removeChild(td.firstChild);
            }
            if (currencyCodes.indexOf(currencyCode) > -1) {
                var flagElement = document.createElement('DIV');
                flagElement.className = 'flag ' + currencyCode.toLowerCase();
                td.appendChild(flagElement);
            } else {
                var textNode = document.createTextNode(value === null ? '' : value);
                td.appendChild(textNode);
            }
        };
        var hotElement = document.querySelector('#hot');
        var hotElementContainer = hotElement.parentNode;
        var hotElement2 = document.querySelector('#hot2');
        var hotElementContainer2 = hotElement2.parentNode;

        var hotSettings = {
            data: dataObject,
            columns: [{
                    data: 'id',
                    type: 'numeric',
                    width: 40
                },
                {
                    data: 'flag',
                    renderer: flagRenderer
                },
                {
                    data: 'currencyCode',
                    type: 'text'
                },
                {
                    data: 'currency',
                    type: 'text'
                },
                {
                    data: 'level',
                    type: 'numeric',
                    numericFormat: {
                        pattern: '0.0000'
                    }
                },
                {
                    data: 'units',
                    type: 'text'
                },
                {
                    data: 'asOf',
                    type: 'date',
                    dateFormat: 'MM/DD/YYYY'
                },
                {
                    data: 'onedChng',
                    type: 'numeric',
                    numericFormat: {
                        pattern: '0.00%'
                    }
                }
            ],
            stretchH: 'all',
            width: 805,
            autoWrapRow: true,
            height: 487,
            maxRows: 22,
            rowHeaders: true,
            colHeaders: [
                'Indikator yang dinilai',
                'Definisi',
                'Target',
                'Bobot',
                'Level',
                'Units',
                'Date',
                'Change'
            ],
            manualRowResize: true,
            manualColumnResize: true
        };
        var hot = new Handsontable(hotElement, hotSettings);
        var hot2 = new Handsontable(hotElement2, hotSettings);
    </script>

</body>

</html>