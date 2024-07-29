<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){
require("pcgs.php");
$q=new PCGS();
$val=array();
$cr="A";
 $val=$q->showPgValues($_POST['printdate'],$cr);
  $e=$q->courseName();
 $f=$q->specName();
 $g=$q->deptName();
  if($val['value']>1){

   date_default_timezone_set("Asia/Kolkata");
   $id = date('d_m_Y',strtotime($val['date']));
   $tstmp = date('d_m_Y_H_i_s');

   $name = "downloads/report_".$tstmp.".xls";
   $zipname="downloads/report_".$tstmp.".zip";

   require_once 'Classes/PHPExcel.php';
   require_once 'Classes/PHPExcel/Writer/Excel5.php';
   // Create new PHPExcel object
   $objPHPExcel = new PHPExcel();

   // Fill worksheet from values in array
   $objPHPExcel->setActiveSheetIndex(0);
   $j = 1; /* cell index*/

   $dtid = date("d-m-Y",strtotime($_POST['printdate']));
   $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
   $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PROVISIONAL CERTIFICATE ISSUED FROM : '.$dtid);
   $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
   $j++;


   $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'S.No.');
   $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Hall Ticket No.');
   $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'Student Name');
    $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Adhar No.');
   $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'Father Name');
   $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'Mother Name');
   $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'Gender');
   $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'Course');
   $objPHPExcel->getActiveSheet()->SetCellValue('I2', 'Specification');
      $objPHPExcel->getActiveSheet()->SetCellValue('J2', 'Department');
   $objPHPExcel->getActiveSheet()->SetCellValue('K2', 'Month & Year');
    $objPHPExcel->getActiveSheet()->SetCellValue('L2', 'Percentage');
   $objPHPExcel->getActiveSheet()->SetCellValue('M2', 'Class Awarded');
   $objPHPExcel->getActiveSheet()->SetCellValue('N2', 'Pc ISSUED');
   $objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFont()->setBold(true);
   $j++;

 	for($i=1;$i<$val['value'];$i++)
 	{

 	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$j, $val['sno'][$i]);
 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('B'.$j, $val['htno'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('C'.$j, $val['stname'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('D'.$j, $val['adhar'][$i],PHPExcel_Cell_DataType::TYPE_STRING);

 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('E'.$j, $val['fname'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('F'.$j, $val['mname'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('G'.$j, $val['gender'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('H'.$j, $e[$val['course'][$i]],PHPExcel_Cell_DataType::TYPE_STRING);
 	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('I'.$j, $f[$val['course'][$i]][$val['speccode'][$i]],PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->SetCellValueExplicit('J'.$j, $g[$val['course'][$i]][$val['speccode'][$i]],PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValueExplicit('K'.$j, $val['month'][$i].",".$val['year'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValueExplicit('L'.$j, $val['percentage'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValueExplicit('M'.$j, $val['classawd'][$i],PHPExcel_Cell_DataType::TYPE_STRING);
  $objPHPExcel->getActiveSheet()->SetCellValueExplicit('N'.$j, $val['pcissued'][$i],PHPExcel_Cell_DataType::TYPE_STRING);


 	$j++;
 	}


     $objPHPExcel->getActiveSheet()->setTitle('PROVISIONAL CERTIFICATES');
     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
      $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
     $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
     

     $xlname = $name;
     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
     $objWriter->save($xlname);
	 $zip=new ZipArchive();
      $zip->open($zipname,ZipArchive::CREATE|ZipArchive::OVERWRITE);
     $zip->addFile($xlname,"st_details.xls");
	 for($i=1;$i<$val[value];$i++){
		$zip->addFile($val['image'][$i],$val['htno'][$i].".jpg"); 
	 }
     $zip->close();

     header('Location: ./'.$zipname);
   }
   else{
     header('Location: getrep.php?id=empty');
   }

 } /*mysql else*/


 else{
   header('Location: getrep.php');
 }




 ?>
