<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){
  if(!empty($_POST['pcg2']) && !empty($_SESSION['pcg2']) && $_POST['pcg2']==$_SESSION['pcg2']){
    unset($_SESSION['pcg2']);
    $_SESSION['pcg3']=rand(0,1000);
if(!empty($_POST['htno']) && !empty($_POST['stname']) && isset($_POST['aadhar']) && !empty($_POST['image']) && !empty($_POST['fname']) && !empty($_POST['mname']) && !empty($_POST['course']) && !empty($_POST['gender']) && !empty($_POST['month']) && !empty($_POST['year']) && !empty($_POST['pcissued']) && !empty($_POST['percentage']) ){
$res=$_POST;
require_once('pcgs.php');
$a=new PCGS();
//$upres=$a->imgupload("image","img",$_POST['htno']);
$z=$a->getSpec($_POST['htno']);

if(!empty($z)){

$url = "pcg2c.php?sthtno=".$_POST['htno'];
require('header.php');
$c_code=array('fcd'=>"First Class with Distinction",'fc'=>"First Class",'sc'=>"Second Class",'pc'=>"Pass Class");
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
            <h4 align='center'>Provisional Certificate Generation</h4>
          </div>

          <div class="panel-body">
            <form class="form-horizontal" role="form" action="pcg4.php" method="post">


                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Hall Ticket Number:</label>
                    <div class="col-sm-6">
                      <?php echo $res['htno']; ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Student Name:</label>
                    <div class="col-sm-6">
                      <?php echo strtoupper($res['stname']); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPhoto" class="col-sm-6 control-label labelapply3">Student Photo:</label>
                    <div class="col-sm-6">
                      <img src="<?php echo $res['image']?>" height="120" width="100"/>
                    </div>
                  </div>

	                <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Adhar Number:</label>
                    <div class="col-sm-6">
                      <?php if(!empty($res['aadhar'])){ echo $res['aadhar']; }else{ echo "Not Provided"; } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Father Name:</label>
                    <div class="col-sm-6">
                      <?php echo strtoupper($res['fname']); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Mother Name:</label>
                    <div class="col-sm-6">
                      <?php echo strtoupper($res['mname']); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Gender:</label>
                    <div class="col-sm-6">
                      <?php
                      if(strtoupper($res['gender'])=='M' || strtoupper($res['gender'])=='MALE'){
                          echo "Male";
                      }
                      elseif(strtoupper($res['gender'])=='F' || strtoupper($res['gender'])=='FEMALE'){
                          echo "Female";
                      }
                      else{
                        echo "<span style='color:red'>Invalid</span>";
                      }
                       ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">course:</label>
                    <div class="col-sm-6">
                      <?php echo $res['course']; ?>
                    </div>
                  </div>
                  <?php if(!empty($z['spec'])){
                    ?>
                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Specification:</label>
                    <div class="col-sm-6">
                      <?php echo $z['spec']; ?>
                    </div>
                  </div>
                <?php
              }   ?>

              <?php if(!empty($z['dept'])){
                ?>
                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Department:</label>
                    <div class="col-sm-6">
                      <?php echo $z['dept']; ?>
                    </div>
                  </div>
                  <?php
                } ?>


                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Class Awarded :</label>
                    <div class="col-sm-6">
                      <?php


                          if(round($_POST['percentage'])>=70){
							  $_POST['class']="FIRST CLASS with DISTINCTION";
						  }
						  elseif(round($_POST['percentage'])>=60 && round($_POST['percentage'])<70){
							 $_POST['class']="FIRST CLASS";
						  }
						  elseif(round($_POST['percentage'])>=50 && round($_POST['percentage'])<60){
							 $_POST['class']="SECOND CLASS";
						  }
						  elseif(round($_POST['percentage'])>=40 && round($_POST['percentage'])<50){
							 $_POST['class']="PASS CLASS";
						  }
						  else{
							  //
						  }
						  echo $_POST['class'];
					  ?>
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">Month & Year of Examinations Passed:</label>
                    <div class="col-sm-6">
                      <?php echo $_POST['month'].", ".$_POST['year']; ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-6 control-label labelapply3">PC Issued On:</label>
                    <div class="col-sm-6">
                      <?php echo $res['pcissued']; ?>
                    </div>
                  </div>

                  <input type='hidden' name='htno' value='<?php echo  strtoupper($res['htno']); ?>' />
                  <input type='hidden' name='stname' value='<?php echo strtoupper($res['stname']); ?>' />
                  <input type='hidden' name='fname' value='<?php echo strtoupper($res['fname']); ?>' />
                  <input type='hidden' name='mname' value='<?php echo strtoupper($res['mname']); ?>' />
                  <input type='hidden' name='gender' value='<?php echo $res['gender']; ?>' />
                  <input type='hidden' name='course' value='<?php echo $res['course']; ?>' />
                  <input type='hidden' name='year' value='<?php echo $res['year']; ?>' />
                 <input type='hidden' name='month' value='<?php echo $res['month']; ?>' />
      				  <input type='hidden' name='aadhar' value='<?php echo $res['aadhar']; ?>' />
      				   <input type='hidden' name='image' value='<?php echo $res['image']; ?>' />
                     <input type='hidden' name='spec' value='<?php echo $z['spec']; ?>' />
                     <input type='hidden' name='dept' value='<?php echo  strtoupper($z['dept']); ?>' />
                      <input type='hidden' name='percentage' value='<?php echo $_POST['percentage']; ?>' />
                         <input type='hidden' name='class' value='<?php echo $_POST['class']; ?>' />
                          <input type='hidden' name='pcg3' value='<?php echo $_SESSION['pcg3'];?>' />
                             <input type='hidden' name='pcissued' value='<?php echo $res['pcissued']; ?>' />
                  <div class="form-group">
                    <div class="col-sm-4" align='right'>
                      <a href="<?php echo $url; ?>" class="btn btn-default">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>
                    </div>
                    <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-success">Generate Certificate</button>
                    </div>
                  </div>


                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
  <?php
    require('footer.php');
	}
  else{
    header('Location:pcg1.php?imguploaderr');
  }
  }
  else{
    header('Location:pcg1.php?postnotempty');
  }
}
else{
     header('Location:pcg1.php?session');
}
}
else {
  header('Location:./');

}
   ?>
