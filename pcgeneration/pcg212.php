<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){

  if(!empty($_SESSION['one']) && $_SESSION['one']==$_POST['var']){
    unset($_SESSION['one']);
  if(!empty($_POST['htno']) && !empty($_POST['stname']) &&  !empty($_POST['fname']) &&  !empty($_FILES) &&  isset($_POST['adhar']) && !empty($_POST['mname']) && !empty($_POST['gender'])){
require("pcgs.php");
$res=$_POST;
$a212=new PCGS();
$_POST['course']=$a212->getCourse($res['htno']);
$res['course']=$_POST['course'];

$aadhar = "";
$img = "";
if(isset($_POST['adhar'])){
  $aadhar = $_POST['adhar'];
}

if(!empty($_FILES)){
  $upres=$a212->imgupload("image","img",$_POST['htno']);
  if(!empty($upres['status']) && $upres['status']==1){
    $img = $upres['imgpath'];
  }
}

$_POST['aadhar'] = $aadhar;
$_POST['image'] = $img;

$x=$a212->addSt_details($res['htno'],$res['stname'],$res['fname'],$res['mname'],$res['gender'],$aadhar,$img);

require("pcg3.php");

}
else{
  header('Location:pcg1.php');
}
}
else{
  header('Location:pcg1.php?');
}
}
else{
  header('Location: ./');
}

  ?>
