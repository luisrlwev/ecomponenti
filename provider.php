<?php
  $page_title = 'Lista de proveedores - Ecomponenti';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_providers = find_all('provider');
?>
<?php
 if(isset($_POST['add_prov'])){
   $req_field = array('provider-name');
   validate_fields($req_field);
   $prov_name = remove_junk($db->escape($_POST['provider-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO provider (name)";
      $sql .= " VALUES ('{$prov_name}')";
      if($db->query($sql)){
        $session->msg("s", "Proveedor agregado exitosamente.");
        redirect('provider.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="provider.php">
            <div class="form-group">
                <input type="text" class="form-control" name="provider-name" placeholder="Nombre del proveedor" required>
            </div>
            <button type="submit" name="add_prov" class="btn btn-primary">Agregar proveedor</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de proveedores</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Proveedor</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_providers as $prov):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($prov['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_provider.php?id=<?php echo (int)$prov['id'];?>"  class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_provider.php?id=<?php echo (int)$prov['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
