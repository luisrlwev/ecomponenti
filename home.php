<?php
  $page_title = 'Inicio - Ecomponenti';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
        <h1>¡Bienvenido a Ecomponenti!</h1>
        <h3>¿Qué quieres hacer hoy?</h3>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <?php if($user['user_level'] === '1'): ?>
    <!-- admin menu -->
  <?php include_once('layouts/admin_menu_2.php');?>

  <?php elseif($user['user_level'] === '2'): ?>
    <!-- Special user -->
  <?php include_once('layouts/special_menu_2.php');?>

  <?php elseif($user['user_level'] === '3'): ?>
    <!-- User menu -->
  <?php include_once('layouts/user_menu_2.php');?>

  <?php endif;?>
</div>
<?php include_once('layouts/footer.php'); ?>
