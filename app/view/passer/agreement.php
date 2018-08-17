<?php
if(isset($data) && !empty($data)){
    extract($data[0]);
    if(isset($userDetails) && !empty($userDetails)){
      extract($userDetails[0]);
    }
}  
require "../public/header-footer/seeker/seekerHeader.marvee";
?>
<div class="container mt-5">
  <?php echo $agreementForms; ?>
</div>
<div class="container mt-3">
  <div class="d-flex justify-content-center">
    <?php echo $paginationDOM; ?>
  </div>
</div>
<?php require "../public/header-footer/seeker/seekerFooter.marvee"; ?>