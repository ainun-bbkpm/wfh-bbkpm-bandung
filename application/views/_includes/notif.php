<!-- Notif Error -->
<?php
if (($this->session->flashdata('error')==TRUE) OR (validation_errors() == TRUE)) {

?>
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error</strong>
        <br>
     <?php echo $this->session->flashdata('error') ?>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
<?php 
}
?>


<?php
if (($this->session->flashdata('success')==TRUE)) {

?>
 <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Sukses</strong> 
     
     <br>
     <?php echo $this->session->flashdata('success') ?>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
 <?php 
}
?>