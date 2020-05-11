<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // Notification
    // toastr.info('Isi info', 'Info');
    // toastr.success('Hammmm', 'Success');

    <?php
    if (($this->session->flashdata('warning') == TRUE)) {

    ?>
        toastr.warning('<?php echo $this->session->flashdata('warning') ?>', 'Warning');
    <?php
    }
    ?>
</script>

<!-- Alert -->
<script type="application/javascript">
    /** After windod Load */
    $(window).bind("load", function() {
        window.setTimeout(function() {
            $(".alert-success").fadeTo(1500, 0).slideUp(1500, function() {
                $(this).remove();
            });
        }, 7500);
    });
</script>