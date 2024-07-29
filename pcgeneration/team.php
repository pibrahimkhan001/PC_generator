<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="generator"){

require('header.php');
 ?>
<!doctype html>
<html>
<head>
<title> team list of Pc Generation </title>
</head>
<body>
<table style="border:1px solid black,align:center,width:100%">
<tr>
<th>NAME </th><th>COURSE,DEPTARTMENT </th><th>CONTACT </th><th>EMAIL</th>
</tr>
<tr>
<td>K Anil Kumar</td><td>M.Tech,CSE</td><td>9393767927</td><td>katam.anilkumar@gmail.com</td>
</tr>
<tr>
<td>G Maheswari</td><td>III B.Tech,CSE</td><td>7386037000</td><td>Ganthi.maheswari@gmail.com</td>
</tr>
<tr>
<td>K Sarika</td><td>III B.Tech,CSE</td><td>9550617512</td><td>sarikareddy955@gmail.com</td>
</tr>
<tr>
<td>C Maneesha Sree</td><td>III B.Tech,CSE</td><td>8341830149</td><td>maneeshasree509@gmail.com</td>
</tr>

<tr>
<td>P Shanmukhanand</td><td>III B.Tech,CSE</td><td>9642900509</td><td>shanmukhanand9990@gmail.com</td>
</tr>
<tr>
<td>P Kalyan Kumar</td><td>III B.Tech,CSE</td><td>7075005534</td><td>pandlakalyankumar1@gmail.com</td>
</tr>
<td>Sravani K</td><td>II B.Tech,CSE</td><td>9494451346</td><td>sravanikookatikonda@gmail.com</td>
</tr>
<tr>
<td>Y Jyothsna</td><td>II B.Tech,CSE</td><td>9494354570</td><td>jyoshnasweety97@gmail.com</td>
</tr>




</table>


</body>
</html>
<?php
require('footer.php');
}
?>
