<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){

if(!empty($_POST['sthtno'])){
  require("header.php");

?>
<div class="container-fluid">
  <div class="row row-offcanvas row-offcanvas-left">

    <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
      <div class="list-group">
        <?php
        $menu_id = 2;
        require_once("menu.php");
        ?>
      </div>
    </div><!--/span-->

    <div class="col-xs-12 col-sm-9">

      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 align='center'>Pc already issued Details</h4>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" role="form" action="pcg4.php" method="post">
                <div class="form-group">
                  <label for="inputHtno" class="col-sm-6 control-label labelapply3">Hall Ticket Number:</label>
                  <div class="col-sm-6">
                    <?php echo strtoupper($_POST['sthtno']); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputHtno" class="col-sm-6 control-label labelapply3">Student Name:</label>
                  <div class="col-sm-6">
                    <?php echo $t['stname']; ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputHtno" class="col-sm-6 control-label labelapply3">Pc issued:</label>
                  <div class="col-sm-6">
                    <?php echo $t['pcissued']; ?>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-7 col-sm-5">
                  <a href="pcg1.php" class="btn btn-default"> Back</a>
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>

    </div>
<?php
require("footer.php");
}
}
else{
  header('Location:./');
}


 ?>
