<?php
@session_start();

$_SESSION['one']=rand(0,100);
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){
require("header.php");
if(!empty($_POST['sthtno'])){
$res = array();
  $res['htno']=strtoupper($_POST['sthtno']);

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
            <form class="form-horizontal" role="form" action="pcg212.php" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-5 control-label labelapply3">Hall Ticket Number:</label>
                    <div class="col-sm-4">
                      <?php echo $_POST['sthtno']; ?>
                    </div>
                    <div class="col-sm-3">
                    &nbsp;
                      </div>
                    </div>
                       <input type="hidden" name="pcg2" value="<?php echo $_SESSION['pcg2']?>">
                       <input type="hidden" name="var" value="<?php echo $_SESSION['one']?>">
                                <input type="hidden" name="htno" value="<?php echo $_POST['sthtno']?>">
                      <div class="form-group">

                  <label for="inputFName" class="col-sm-5 control-label labelapply3">Student Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="stname" id="inputFName"
                        placeholder="student name" pattern="[a-zA-Z ]{1,60}" required="required" />
                    </div>
                    <div class="col-sm-3">

                      </div>
                    </div>
					<div class="form-group">
                        <label for="adrno" class="col-sm-5 control-label labelapply3">Aadhar Number:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="adhar" id="inputFName"
                            placeholder="Adhar Number" pattern="[0-9]{12}" title="12-digit aadhar number (without space)" required="required" maxlength="12" />
                        </div>
                        <div class="col-sm-3">
                               &nbsp;
                          </div>

                        </div>
						<div class="form-group">
                        <label for="adrno" class="col-sm-5 control-label labelapply3">Upload Image:</label>
                        <div class="col-sm-4">
                          <input type="file" class="form-control" name="image" id="InputImage" required="required" />
                        </div>
                        <div class="col-sm-3">
                               &nbsp;
                          </div>

                        </div>

                    <div class="form-group">
                      <label for="inputFName" class="col-sm-5 control-label labelapply3">Father's Name:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="fname" id="inputFName"
                          placeholder="father name" pattern="[a-zA-Z ]{1,60}" required="required" />
                      </div>
                      <div class="col-sm-3">
                      &nbsp;
                        </div>

                      </div>

                      <div class="form-group">
                        <label for="inputFName" class="col-sm-5 control-label labelapply3">Mother's Name:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="mname" id="inputFName"
                            placeholder="mother name" pattern="[a-zA-Z ]{1,60}" required="required" />
                        </div>
                        <div class="col-sm-3">
                               &nbsp;
                          </div>

                        </div>
                        <div class="form-group">
                          <label for="inputGender" class="col-sm-5 control-label">Gender</label>
                          <div class="col-sm-4">
                            <input type="radio" name="gender" id="inputGender"
                             required="required" value="M" /> Male
                          <br>
                            <input type="radio" name="gender" id="inputGender"
                             required="required" value="F" /> FeMale
                          </div>
                          <div class="col-sm-3">
                               &nbsp;
                          </div>
                        </div>

                        <div class="form-group">
                  <label for="inputFName" class="col-sm-5 control-label labelapply3">Percentage:</label>

                <div class="col-sm-4">
				   <input type="number" name="percentage" min="1" max="100" step="0.01" placeholder="percentage"  required="required" pattern="{5}" title ="Only two digits are allowed after decimal" />
                      </div>
					  <div class="col-sm-3">
                         &nbsp;
                      </div>
                  </div>


                          <div class="form-group">
                            <label for="" class="col-sm-5 control-label labelapply3">Month & Year of Examinations Passed:</label>
                            <div class="col-sm-2">
                              <select class="form-control" name="month" required="required">
                                <option value=""> --Select--</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                                <option value="January/February">January/February</option>
                                <option value="February/March">February/March</option>
                                <option value="March/April">March/April</option>
                                <option value="April/May">April/May</option>
                                <option value="May/June">May/June</option>
                                <option value="June/July">June/July</option>
                                <option value="July/August">July/August</option>
                                <option value="August/September">August/September</option>
                                <option value="September/October">September/October</option>
                                <option value="October/November">October/November</option>
                                <option value="November/December">November/December</option>
                              </select>
                            </div>
                            <div class="col-sm-2">
                              <select class="form-control" name="year" required="required">
                                <option value=""> --Select--</option>
                                <?php

                                $yr1 = (int)"20".substr($res['htno'],0,2);
                                $cr = substr($res['htno'],5,1);
                                $cr1 = substr($res['htno'],4,1);
                                $exp_yr = array('A'=>4,'F'=>3,'D'=>2);
						        if($cr=='A' && $cr1=='5'){
							     $exp_yr['A'] = 3;
						        }

                                $yr1 = $yr1+$exp_yr[$cr];
                                $yr = (int)date('Y');
                                for($i=$yr1;$i<=$yr;$i++){
                                echo "<option value=".$i.">".$i."</option>";
                                }
                                 ?>
                              </select>
                            </div>
                            <div class="col-sm-3">
                                     &nbsp;
                            </div>
                          </div>



                          <div class="form-group">
                            <label for="inputFName" class="col-sm-5 control-label labelapply3">PC Issued:</label>
                            <div class="col-sm-7">
                              <?php
                              $dt = date('d-m-Y');
                              echo $dt;

                               ?>
                              <input type="hidden" class="form-control" name="pcissued" value="<?php echo $dt; ?>" required="required" />
                            </div>
                            </div>

                        <div class="form-group">
                          <div class="col-sm-4" align='right'>
                            &nbsp;
                          </div>
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default">submit</button>
                          </div>
                        </div>



                        <input type='hidden' name='sthtno' value='<?php echo  strtoupper($res['htno'])?>' />



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
          header('Location:pcg1.php?');
        }
      }
      else {
          header('Location: ./');

                  }


?>
