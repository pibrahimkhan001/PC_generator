<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){

if(!empty($_POST['htno']) && !empty($_POST['stname']) && !empty($_POST['fname']) && !empty($_POST['mname']) && !empty($_POST['gender'])){
  require('pcgs.php');
  $cgs_obj = new PCGS();
  $_POST['spec']=$cgs_obj->getSpec($_POST['htno']);

  $_POST['course']=$cgs_obj->getCourse($_POST['htno']);
  $res=$_POST;

  $aadhar = "";
  $img = "";
  if(isset($_POST['adhar'])){
    $aadhar = $_POST['adhar'];
  }

  if(!empty($_FILES)){
    $upres=$cgs_obj->imgupload("image","img",$_POST['htno']);
    if(!empty($upres['status']) && $upres['status']==1){
      $img = $upres['imgpath'];
    }
  }

  $c = $cgs_obj->editStDetails($_POST['stname'],$_POST['gender'],$_POST['fname'],$_POST['mname'],$aadhar,$img,$_POST['htno']);
  unset($cgs_obj);
   If($c==1){
     require("pcg2.php");
   }

 }else{
   header('Location:pcg1.php');
 }

}
else{
  header('Location:./');
}
?>
