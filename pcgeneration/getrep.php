<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){

require('header.php');
 ?>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
      <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 3;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->
			   <div class="col-xs-12 col-sm-9">
               <div class="form-group">
          						<div class="col-sm-offset-3 col-sm-9" style="top:30px;">
          							<a href="getug.php" class="btn btn-default">&nbsp;&nbsp;UG students report&nbsp;</a>
          						</div>
          					</div>
							  
          					
               <div class="form-group">
          						<div class="col-sm-offset-3 col-sm-9"style="top:50px;">
          							<a href="getpg.php" class="btn btn-default">&nbsp;&nbsp;PG students report&nbsp;</a>
          						</div>
          					</div>
				             </div>
							   </div>
							  </div>
	<?php
require('footer.php');
}
else {
  header('Location: ./');
}
 ?>
						  