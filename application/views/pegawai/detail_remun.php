<div class="tab-pane fade show active" id="januari" role="tabpanel" aria-labelledby="januari-tab">
    <div class="row mt-4">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php
                foreach ($remun as $key => $value) {
                    # code...

                ?>
                    <a class="nav-link " id="v-pills-<?= $value->id_penilaian ?>-tab" data-toggle="pill" data-nilai="<?= $value->id_penilaian ?>" data-remun="<?= $value->id_remun ?>" href="#v-pills-<?= $value->id_penilaian ?>" role="tab" aria-controls="v-pills-<?= $value->id_penilaian ?>" aria-selected="true"><?= $value->nama_penilaian ?></a>
                    <!-- <a class="nav-link" id="v-pills-kualitas-tab" data-toggle="pill" data-nilai="3" href="#v-pills-kualitas" role="tab" aria-controls="v-pills-kualitas" aria-selected="false">Kualitas</a>
                <a class="nav-link" id="v-pills-perilaku-tab" data-toggle="pill" data-nilai="4" href="#v-pills-perilaku" role="tab" aria-controls="v-pills-perilaku" aria-selected="false">Perilaku</a>
                <a class="nav-link" id="v-pills-tugas-tab" data-toggle="pill" data-nilai="5" href="#v-pills-tugas" role="tab" aria-controls="v-pills-tugas" aria-selected="false">Tugas Tambahan</a> -->
                <?php
                }
                ?>

            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">

                    <div id="hot1" class="hot"></div>

                </div>
                <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                    <div id="hot3" class="hot"></div>
                </div>
                <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-perilaku-tab">
                    <div id="hot4" class="hot"></div>
                </div>
                <div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-tugas-tab">
                    <div id="hot5" class="hot"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    <?php
    foreach ($remun as $key => $hmm) {
    ?>
        $.ajax({
            url: "<?php echo base_url("api/remun/indikator?id_remun=".$hmm->id_remun."&penilaian=".$hmm->id_penilaian."") ?>",
            type: "GET",

            success: function(res<?= $hmm->id_penilaian ?>) {
                // $('#myTabContent').html(res)
                // console.log(res.data);
                var Dataindikator<?= $hmm->id_penilaian ?> = res<?= $hmm->id_penilaian ?>.indikator
                // console.log(Dataindikator4);

                hot<?= $hmm->id_penilaian ?>.loadData(Dataindikator<?= $hmm->id_penilaian ?>);

                console.log(Dataindikator<?= $hmm->id_penilaian ?>);





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

    <?php } ?>






    // var dataObject = Dataremun

    var hotElement1 = document.querySelector('#hot1');
    var hotElementContainer1 = hotElement1.parentNode;

    var hotElement3 = document.querySelector('#hot3');
    var hotElementContainer3 = hotElement3.parentNode;

    var hotElement4 = document.querySelector('#hot4');
    var hotElementContainer4 = hotElement4.parentNode;

    var hotElement5 = document.querySelector('#hot5');
    var hotElementContainer5 = hotElement5.parentNode;

    var hotSettings = {
        // data: Dataremun,
        columns: [{

                //ini Indikator
                data: 'indikator',
                type: 'text',
                readOnly: true,
                width: 300
            },
            {
                //Ini Defisini
                data: 'definisi',
                type: 'text',
                readOnly: true,
                width: 300
                // renderer: flagRenderer

            },
            {
                //ini target
                data: 'target',
                type: 'numeric',
                
            },
            {
                // Ini Capaian
                data: 'bobot',
                type: 'numeric',
                numericFormat: {
                    pattern: '0.00%'
                }
            },
            {
                // ini Bobot
                data: 'bobot',
                type: 'numeric',

            },

            {

            }
        ],
        stretchH: 'all',
        width: 700,
        height: 400,
        autoWrapRow: true,
        maxRows: 22,
        rowHeaders: true,
        colHeaders: [
            'Indikator yang dinilai',
            'Definisi operasional',
            'Target',
            'Capaian',
            'Bobot',
            'Hasil nilai kinerja',

        ],
        hiddenColumns: {
            columns: [4],
            indicators: false
        },
        manualRowResize: true,
        manualColumnResize: true,
        afterChange: function (change, source) {
        var data;
        console.log(change);
        
        }
    };

    var hot1 = new Handsontable(hotElement1, hotSettings);
    var hot3 = new Handsontable(hotElement3, hotSettings);
    var hot4 = new Handsontable(hotElement4, hotSettings);
    var hot5 = new Handsontable(hotElement5, hotSettings);
</script>