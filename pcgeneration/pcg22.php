<?php
@session_start();

if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){
require("header.php");

if(!empty($_GET['id'])){
  $res['htno']=$_GET['id'];
  require("pcgs.php");
  $a=new PCGS();
  $q=$a->getStDetails($_GET['id']);

  if(!empty($q['status']) && $q['status']==1){
    $_SESSION['pcg1']=rand(0,1000);
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
            <form class="form-horizontal" role="form" action="pcg221.php" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-5 control-label labelapply3">Hall Ticket Number:</label>
                    <div class="col-sm-4">
                      <?php echo $_GET['id']; ?>
                    </div>
                    <div class="col-sm-3">
                    &nbsp;
                      </div>
                    </div>
                          <input type="hidden" name="pcg2" value="<?php echo $_SESSION['pcg2']?>">
                                <input type="hidden" name="htno" value="<?php echo $_GET['id']?>">
                      <div class="form-group">
                  <label for="inputFName" class="col-sm-5 control-label labelapply3">Student Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="stname" id="inputFName"
                        placeholder="student name" pattern="[a-zA-Z ]{1,60}" required="required" value="<?php echo $q['stname'] ?>" />
                    </div>
                    <div class="col-sm-3">
                    &nbsp;
                      </div>
                    </div>

					<div class="form-group">
                        <label for="adrno" class="col-sm-5 control-label labelapply3">Aadhar Number:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="adhar" id="inputFName"
                            placeholder="Adhar Number" pattern="[0-9]{12}" title="12-digit aadhar number (without space)" maxlength="12"  value="<?php echo $q['adhar'] ?>" />
                        </div>
                        <div class="col-sm-3">
                               &nbsp;
                          </div>

                        </div>

                        <?php  if(!empty($q['image'])){
                           ?>
                           <div class="form-group">
                             <label for="adrno" class="col-sm-5 control-label labelapply3">Existing Image:</label>
                             <div class="col-sm-4">
                               <img src="<?php echo $q['image']; ?>" height="120" width="100"/>
                             </div>
                             <div class="col-sm-3">
                                  &nbsp;
                             </div>
                           </div>

                           <div class="form-group">
                             <label for="adrno" class="col-sm-5 control-label labelapply3">Edit Image:</label>
                             <div class="col-sm-4">
                               <input type="file" class="form-control" name="image" id="InputImage" />
                             </div>
                             <div class="col-sm-3">
                                  &nbsp;
                             </div>
                           </div>
                        <?php
                        }else {
                        ?>
                           <div class="form-group">
                             <label for="adrno" class="col-sm-5 control-label labelapply3">Upload Image:</label>
                             <div class="col-sm-4">
                               <input type="file" class="form-control" name="image" id="InputImage" required="required" />
                             </div>
                             <div class="col-sm-3">
                                  &nbsp;
                             </div>
                           </div>
                           <?php
                         }
                        ?>



                    <div class="form-group">
                      <label for="inputFName" class="col-sm-5 control-label labelapply3">Father's Name:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="fname" id="inputFName"
                          placeholder="father name" pattern="[a-zA-Z ]{1,60}" required="required"  value="<?php echo $q['fname'] ?>" />
                      </div>
                      <div class="col-sm-3">
                      &nbsp;
                        </div>

                      </div>
                      <div class="form-group">
                        <label for="inputFName" class="col-sm-5 control-label labelapply3">Mother's Name:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="mname" id="inputFName"
                            placeholder="mother name" pattern="[a-zA-Z ]{1,60}" required="required"  value="<?php echo $q['mname'] ?>" />
                        </div>
                        <div class="col-sm-3">
                        &nbsp;
                          </div>

                        </div>

                        <div class="form-group">
                          <label for="inputGender" class="col-sm-5 control-label">Gender</label>
                          <div class="col-sm-4">
                            <input type="radio" name="gender" id="inputGender"
                             required="required" value="M" <?php if($q['gender']=="M" || $q['gender']=="MALE") { echo "checked"; } ?> /> Male
                          <br>
                            <input type="radio" name="gender" id="inputGender"
                             required="required" value="F" <?php if($q['gender']=="F" || $q['gender']=="FEMALE") { echo "checked"; } ?> /> FeMale
                          </div>
                          <div class="col-sm-3">
                               &nbsp;
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-4" align='right'>
                            &nbsp;
                          </div>
                          <div class="col-sm-offset-3 col-sm-5">

                            <input type="hidden" name="pcg1" value="<?php echo $_SESSION['pcg1']; ?>" />
                            <button type="submit" class="btn btn-default">update</button>
                          </div>
                        </div>



                        <input type='hidden' name='sthtno' value='<?php echo $res['htno']?>' />


                      </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <?php
          require('footer.php');

      }
    }
        else{
          header('Location:pcg1.php?');
        }
      }

      else {
        header('Location:./');

                  }


?>
