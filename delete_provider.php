<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $provider = find_by_id('provider',(int)$_GET['id']);
  if(!$provider){
    $session->msg("d","ID del proveedor falta.");
    redirect('provider.php');
  }
?>
<?php
  $delete_id = delete_by_id('provider',(int)$provider['id']);
  if($delete_id){
      $session->msg("s","Proveedor eliminado");
      redirect('provider.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('provider.php');
  }
?>
