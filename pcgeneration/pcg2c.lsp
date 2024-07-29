<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){
if(!empty($_SESSION['pcg1']) && !empty($_POST['pcg1']) && $_POST['pcg1']==$_SESSION['pcg1'] && !empty($_POST['sthtno'])){
  unset($_SESSION['pcg1']);
  $_SESSION['pcg2']=rand(0,1000);

  $x=$_POST['sthtno'];
  $_POST['sthtno'] = strtoupper($_POST['sthtno']);
  require('pcgs.php');
  $cgs_obj = new PCGS();
  $r = $cgs_obj->checkHtno($_POST['sthtno']);
  
if($r){
  $t = $cgs_obj->checkDetails($_POST['sthtno']);
  if($t['status']==1)
  {
        require("pcg11.php");
  }
  else{

  $res = $cgs_obj->getStDetails($_POST['sthtno']);
  if(empty($res['status']) || $res['status']==0){
   require("pcg21.php");
  }
  else{
    require('header.php');
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
            <form class="form-horizontal" role="form" action="pcg3.php" method="post">
              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">Hall Ticket Number:</label>
                <div class="col-sm-6">
                  <?php echo $res['htno']; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">Student Name:</label>
                <div class="col-sm-6">
                  <?php echo $res['stname']; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">Father Name:</label>
                <div class="col-sm-6">
                  <?php echo $res['fname']; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">mother Name:</label>
                <div class="col-sm-6">
                  <?php echo $res['mname']; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">Gender:</label>
                <div class="col-sm-6">
                  <?php
                  if($res['gender']=='M' || $res['gender']=="MALE"){
                      echo "Male<input type='hidden' name='gender' value='M' />";
                  }
                  elseif($res['gender']=='F' || $res['gender']=="FEMALE"){
                      echo "Female<input type='hidden' name='gender' value='F' />";
                  }
                  else{
                    echo "<span style='color:red'>Invalid</span>";
                  }
                   ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">Course:</label>
                <div class="col-sm-6">
                  <?php echo $res['course']; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputHtno" class="col-sm-6 control-label labelapply3">Branch/Specialization:</label>
                <div class="col-sm-6">
                  <?php echo $res['spec']; ?>
                </div>
              </div>
              <input type='hidden' name='pcg2' value='<?php echo $_SESSION['pcg2'];?>' />

                <div class="form-group">
                  <label for="inputFName" class="col-sm-6 control-label labelapply3">Percentage:</label>
				 
                <div class="col-sm-4">
				   <input type="number" name="percentage" min="1" max="100" step="0.01" placeholder="percentage"  required="required" />
                      </div>
					  <div class="col-sm-2">
                         &nbsp;
                      </div>
                  </div>

                  
                  <div class="form-group">
                    <label for="" class="col-sm-6 control-label labelapply3">Month & year Passed:</label>
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
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                         ?>
                      </select>
                    </div>
                    <div class="col-sm-2">&nbsp;
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputFName" class="col-sm-6 control-label labelapply3">Pc Issued:</label>
                    <div class="col-sm-6">
                      <?php
                      $dt = date('d-m-Y');
                      echo $dt;
                       ?>
                      <input type="hidden" class="form-control" name="pcissued" value="<?php echo $dt; ?>" required="required" />
                    </div>
                    </div>

                    <input type='hidden' name='htno' value='<?php echo $res['htno']?>' />
                    <input type='hidden' name='stname' value='<?php echo $res['stname']?>' />
                    <input type='hidden' name='fname' value='<?php echo $res['fname']?>' />
                    <input type='hidden' name='mname' value='<?php echo $res['mname']?>' />

                    <input type='hidden' name='course' value='<?php echo $res['course']?>' />
                    <input type='hidden' name='spec' value='<?php echo $res['spec']?>' />


              <div class="form-group">
                <div class="col-sm-4" align='center'>
                  <a href="pcg1.php" class="btn btn-warning">&nbsp;&nbsp;Abort&nbsp;&nbsp;</a>
                </div>
                <div class="col-sm-4" align='center'>
                  <a href="pcg22.php?id=<?php echo $res['htno']; ?>" class="btn btn-default">&nbsp;&nbsp;Edit Details&nbsp;&nbsp;</a>
                </div>
                <div class="col-sm-4" align="center">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

                    </form>
                  </div><!--panel body-->
                </div><!--panel info-->

              </div>
            </div>

          </div>
          <?php
          require('footer.php');
        }
  }
}
  else {
         header('Location: pcg1.php');
  }
}
else{
   header('Location: pcg1.php');
}
}
else {
  header('Location: ./');
}
 ?>
