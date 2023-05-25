<?php
  $page_title = 'Editar proveedor - Ecomponenti';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $provider = find_by_id('provider',(int)$_GET['id']);
  if(!$provider){
    $session->msg("d","Falta el ID de proveedor.");
    redirect('provider.php');
  }
?>

<?php
if(isset($_POST['edit_prov'])){
  $req_field = array('provider-name');
  validate_fields($req_field);
  $prov_name = remove_junk($db->escape($_POST['provider-name']));
  if(empty($errors)){
        $sql = "UPDATE provider SET name='{$prov_name}'";
       $sql .= " WHERE id='{$provider['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Proveedor actualizado con éxito.");
       redirect('provider.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('provider.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('provider.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($provider['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_provider.php?id=<?php echo (int)$provider['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="provider-name" value="<?php echo remove_junk(ucfirst($provider['name']));?>">
           </div>
           <button type="submit" name="edit_prov" class="btn btn-primary">Actualizar proveedor</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
