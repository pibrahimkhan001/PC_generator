<?php

require("DBCredentials.php");
/**
 *
 */
class PCGS extends DBCredentials
{
  public $myconn = "";
  private $myerr = 0;

  public function __construct()
  { 
    
    $this->myconn = new mysqli($this->getHost(),$this->getUser(),$this->getPass());
    
    if (mysqli_connect_errno()) {
      $this->myerr = mysqli_connect_errno();
    }

  }

 public function getCourse($htnoc){
    $course = "";

    if($this->myerr==0 && !empty($this->myconn)){
      $cr = substr($htnoc,5,1);
      if ($stmt = $this->myconn->prepare("SELECT longname FROM  st_details.coursenames WHERE  `coursecodes`=?")) {
		  $stmt->bind_param("s",$cr);
          if($stmt->execute()){
            $stmt->bind_result($courses);
            while ($stmt->fetch()) {
              $course = $courses;
            }
           }
       }
    }
    return $course;
  }


  public function getSpec($htnos){
    $spe = array();
    if($this->myerr==0 && !empty($this->myconn)){
      $cr = substr($htnos,5,1);
      $sp = substr($htnos,6,2);
      if ($stmt = $this->myconn->prepare("SELECT `spec`,`dept` FROM  st_details.specializations WHERE  `spec_code`=? AND  `cr_code`=?")) {
		 $stmt->bind_param("ss",$sp,$cr);
           if($stmt->execute()){
            $stmt->bind_result($specs,$depts);
            while ($stmt->fetch()) {
              $spe['spec'] = $specs;
              $spe['dept'] = $depts;

            }
           }
       }
    }
    return $spe;
  }

 //function to get the student details from database
  public function getStDetails($htnoa){
    $htnoa = strtoupper($htnoa);
    $res = array();
    $res['status'] = 0;

    if($this->myerr==0 && !empty($this->myconn)){
      $course = $this->getCourse($htnoa);
      $spec = $this->getSpec($htnoa);
      $yr = substr($htnoa,0,2);
      $query = "SELECT `stname`, `gender`, `fname`, `mname`,`adharno`,`imgpath`, `year`, `sem`, `doj`, `dob` FROM st_details.year".$yr." WHERE `htno`=?";
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("s",$htnoa);

           if($stmt->execute()){
            /* bind result variables */
            $stmt->bind_result($stname1,$gender1,$fname1,$mname1,$adharno1,$imgpath1,$year1,$sem1,$doj1,$dob1);
            while ($stmt->fetch()) {
              $res['htno'] = strtoupper($htnoa);
              $res['stname'] = strtoupper($stname1);
              $res['fname'] = strtoupper($fname1);
              $res['mname'] = strtoupper($mname1);

              $res['adhar'] = trim($adharno1);
              $res['image'] = $imgpath1;

              $res['gender'] = strtoupper($gender1);
              $res['year'] = strtoupper($year1);
              $res['sem'] = strtoupper($sem1);
              $res['doj'] = strtoupper($doj1);
              $res['dob'] = strtoupper($dob1);
              if(!empty($course) && !empty($spec)){
                $res['status'] = 1;
                $res['course'] = $course;
                $res['spec'] = $spec['spec'];
              }
            }
           }
           else{
             $res['status'] = 0;
             $res['error'] = "Data Error";
           }
       }
       else{
         $res['status'] = 0;
         $res['error'] = "Query Error";
       }
    }
    else{
      $res['status'] = 0;
      $res['error'] = "Error";
    }

    return $res;
  }



   public function add_details($htno,$stname,$adharno,$imgpath,$fname,$mname,$gender,$course,$branch,$percentage,$class,$month,$year,$pcissued,$bywhom){
      $inres = array();
      $inres['status']=0;
      if($this->myerr==0 && !empty($this->myconn)){

        $yr = substr($htno,0,2);
        if($stm = $this->myconn->prepare("INSERT INTO pc_jntuacea.year".$yr." (`htno`, `stname`, `fname`, `mname`, `gender`, `course`, `speccode`, `month`, `year`,`percentage`, `classawd`,`adharno`,`imgpath`, `pc_issued`,`bywhom`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {

            $stm->bind_param("sssssssssssssss",$htno,$stname,$fname,$mname,$gender,$course,$branch,$month,$year,$percentage,$class,$adharno,$imgpath,$pcissued,$bywhom);
             if($stm->execute()){
                $inres['status']=1;

             }else{

				 echo "error in execution";
			 }
         }else{

				 echo "error in the prepare statement";
			 }

      }else{

				 echo "error in connection";
			 }
      return $inres;
    }
 
 public function addSt_details($htno,$name,$fname,$mname,$gender,$adhar,$image){
      $insres = 0;
      if($this->myerr==0 && !empty($this->myconn)){
        $yr = substr($htno,0,2);
        $dummy = "";
        if($stmt = $this->myconn->prepare("INSERT INTO st_details.year".$yr."(`htno`, `stname`, `gender`, `fname`, `mname`,`adharno`,`imgpath`, `year`, `sem`, `doj`, `dob`) VALUES (?,?,?,?,?,?,?,?,?,?,?)")) {
            $stmt->bind_param("sssssssssss",$htno,$name,$gender,$fname,$mname,$adhar,$image,$dummy,$dummy,$dummy,$dummy);
             if($stmt->execute()){
               if($this->myconn->affected_rows){
                 $insres = 1;
               }
               else{
                 $insres = 0;
               }
             }
         }
      }
      return $insres;
    }

    public function editDetails($name,$gender,$fname,$mname,$htnoa){
        $htnoa = strtoupper($htnoa);
        $res = 0;
         if($this->myerr==0 && !empty($this->myconn)){
         $yr = substr($htnoa,0,2);
          if($stmt = $this->myconn->prepare("UPDATE st_details.year".$yr." SET `stname`=?,`gender`=?,`fname`=?,`mname`=? WHERE htno=?")) {

              $stmt->bind_param("sssss",$name,$gender,$fname,$mname,$htnoa);
    		  if($stmt->execute()){
            $res=1;
    		  }
    			else
    			{
    				echo "error in data";
    			}
    		}
    		else{
    			echo "error in connection";
    		}
    	 }
    	return $res;
    }

     public function editStDetails($name,$gender,$fname,$mname,$aadhar,$img,$htnoa){
        $htnoa = strtoupper($htnoa);
        $res = 0;
         if($this->myerr==0 && !empty($this->myconn)){
         $yr = substr($htnoa,0,2);

         if(!empty($img)){
           $sql = "UPDATE st_details.year".$yr." SET `stname`=?,`gender`=?,`fname`=?,`mname`=?,`adharno`=?,`imgpath`=? WHERE htno=?";
         }else{
           $sql = "UPDATE st_details.year".$yr." SET `stname`=?,`gender`=?,`fname`=?,`mname`=?,`adharno`=? WHERE htno=?";
         }

          if($stmt = $this->myconn->prepare($sql)) {
           if(!empty($img)){
             $stmt->bind_param("sssssss",$name,$gender,$fname,$mname,$aadhar,$img,$htnoa);
           }else {
             $stmt->bind_param("ssssss",$name,$gender,$fname,$mname,$aadhar,$htnoa);
           }

    		  if($stmt->execute()){
            $res=1;
    		  }
    			else
    			{
    				echo "error in data";
    			}
    		}
    		else{
    			echo "error in connection";
    		}
    	 }
    	return $res;
    }

     public function showTables(){
      $res=array();
      if($this->myerr==0 && !empty($this->myconn)){
        if($stmt = $this->myconn->prepare("SELECT `tnames` FROM pc_jntuacea.`yeartbls`")){
          if($stmt->execute()){
            $stmt->bind_result($tablename);
            $i=0;
            while($stmt->fetch()){
              $res[$i]=$tablename;
              $i++;
            }
          }
        }

      }
      return $res;
    }
     
	public function showUgValues($date,$cr){
     $res=array();
     $s=1;
       if($this->myerr==0 && !empty($this->myconn)){
         $a=new PCGS();
         $x= array();
         $x=$a->showTables();
         foreach($x as $tbl){
    $query = "SELECT `htno`, `stname`, `fname`,`mname`, `gender`,`course`,`speccode`,`month`,`year`,`percentage`, `classawd`,`adharno`,`imgpath`, `pc_issued` FROM pc_jntuacea.".$tbl." WHERE updatedon >= ? AND course=? order by updatedon asc";
    if ($stmt = $this->myconn->prepare($query)) {
     $dt = date("Y-m-d",strtotime($date));
     $dt = $dt."%";
      
       $stmt->bind_param("ss", $dt,$cr);

      
        if($stmt->execute()){

      
        $stmt->bind_result($actualids,$stnames,$fnames,$mnames,$genders,$courses,$speccodes,$months,$years,$percentages,$classawds,$adharnos,$imgpaths,$pcissued);
      
	  while ($stmt->fetch()) {
           $res['sno'][$s] = $s;
           $res['htno'][$s] = $actualids;
           $res['stname'][$s] = $stnames;
           $res['fname'][$s] = $fnames;
           $res['mname'][$s]=$mnames;
           $res['gender'][$s] = $genders;
           $res['course'][$s] = $courses;
           $res['speccode'][$s] = $speccodes;
           $res['month'][$s] = $months;
           $res['year'][$s] = $years;
           $res['percentage'][$s] = $percentages;
           $res['classawd'][$s] = $classawds;
		   $res['adhar'][$s] = $adharnos;
		   $res['image'][$s] = $imgpaths;
           $res['pcissued'][$s] =$pcissued;
           $s++;
         }
         $res['value']=$s;
         $res['date']=$dt;
          }else{
               header('Location: getreport.php?id=dateerror');
          }

      }
      else{
        header('Location: getreport.php?id=networkdberror');
      }
    }
  }
    else{
      echo "error";
    }

    return $res;
  }

   public function showPgValues($date,$crs){
     $res=array();
     $s=1;
       if($this->myerr==0 && !empty($this->myconn)){
         $a=new PCGS();
         $x= array();
         $x=$a->showTables();
         foreach($x as $tbl){
    $query = "SELECT `htno`, `stname`, `fname`,`mname`, `gender`,`course`,`speccode`,`month`,`year`,`percentage`, `classawd`,`adharno`,`imgpath`, `pc_issued` FROM pc_jntuacea.".$tbl." WHERE updatedon >= ? AND course!=? order by updatedon asc";
    if ($stmt = $this->myconn->prepare($query)) {
     $dt = date("Y-m-d",strtotime($date));
     $dt = $dt."%";
      
	  $stmt->bind_param("ss", $dt,$crs);

        if($stmt->execute()){

        $stmt->bind_result($actualids,$stnames,$fnames,$mnames,$genders,$courses,$speccodes,$months,$years,$percentages,$classawds,$adhars,$images,$pcissued);

         while ($stmt->fetch()) {
           $res['sno'][$s] = $s;
		   $res['adhar'][$s] = $adhars;
            $res['image'][$s] = $images;
           $res['htno'][$s] = $actualids;
           $res['stname'][$s] = $stnames;
           $res['fname'][$s] = $fnames;
           $res['mname'][$s]=$mnames;
           $res['gender'][$s] = $genders;
           $res['course'][$s] = $courses;
           $res['speccode'][$s] = $speccodes;
           $res['month'][$s] = $months;
           $res['year'][$s] = $years;
           $res['percentage'][$s] = $percentages;
           $res['classawd'][$s] = $classawds;
           $res['pcissued'][$s] =$pcissued;
           $s++;
         }
         $res['value']=$s;
         $res['date']=$dt;
          }else{
               header('Location: getreport.php?id=dateerror');
          }

      }
      else{
        header('Location: getreport.php?id=networkdberror');
      }
    }
  }
    else{
      echo "error";
    }

    return $res;
  }

  public function specName(){
    $res=array();
      if($this->myerr==0 && !empty($this->myconn)){
        if($stmt=$this->myconn->prepare("SELECT `spec_code`, `cr_code`, `spec` FROM st_details.`specializations`")){
        if($stmt->execute()){
          $stmt->bind_result($sc,$cc,$specname);
          while($stmt->fetch()){
            $res[$cc][$sc]=$specname;
          }
        }
        }
      }
      return $res;
    }
	
    public function deptName(){
      $res=array();
        if($this->myerr==0 && !empty($this->myconn)){
          if($stmt=$this->myconn->prepare("SELECT `spec_code`, `cr_code`, `dept` FROM st_details.`specializations`")){
          if($stmt->execute()){
            $stmt->bind_result($sc,$cc,$deptname);
            while($stmt->fetch()){
              $res[$cc][$sc]=$deptname;
            }
          }
          }
        }
        return $res;
      }

    public function courseName(){
      $res=array();
        if($this->myerr==0 && !empty($this->myconn)){
          if($stmt=$this->myconn->prepare("SELECT `coursecodes`, `longname` FROM st_details.`coursenames`")){
          if($stmt->execute()){
            $stmt->bind_result($cc,$cname);
            while($stmt->fetch()){
              $res[$cc]=$cname;
            }
          }
          }
        }
        return $res;


    }
	
   public function checkDetails($htno){
     $res=array();
     $res['status']=0;
       if($this->myerr==0 && !empty($this->myconn)){
         $a=new PCGS();
         $x= array();
         $x=$a->showTables();
         foreach($x as $tbl){
              $query = "SELECT  `pc_issued`,`stname` FROM pc_jntuacea.".$tbl." WHERE htno=?";
                if ($stmt = $this->myconn->prepare($query)) {
                  $stmt->bind_param("s", $htno);

                   if($stmt->execute()){

                
                   $stmt->bind_result($pcissued,$stname);
                        while ($stmt->fetch()) {

                      $res['status']=1;
                      $res['pcissued']=$pcissued;
                      $res['stname']=$stname;
                    }
              }
      }
     }
   }
     return $res;
   }
  
   public function checkHtno($htno){
     $r=0;
       if($this->myerr==0 && !empty($this->myconn)){
          $cr=$this->getCourse($htno);
           $spec=$this->getSpec($htno);
            $colg=substr($htno,2,2);
            if($colg=="00" && !empty($cr) && !empty($spec)){
				$r=1;
			}
       }

	   return $r;

   }


function imgupload($fname,$destfolder,$myfilename){
	$imglen = 513000;
	$res = array();
	$res['status'] = 0;
	if((!empty($_FILES[$fname])) && ($_FILES[$fname]['error'] == 0)) {
		$filename = basename($_FILES[$fname]['name']);
		$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));



		if((($ext == "jpg" || $ext == "jpeg") && ($_FILES[$fname]["type"] == "image/jpeg" || $_FILES[$fname]["type"] == "image/pjpeg"))){
		if($_FILES[$fname]["size"] < $imglen){
				if (is_dir($destfolder) && is_writable($destfolder)) {

				$dest = $destfolder.'/'.date('mY');
					if(!file_exists($dest)){
					  mkdir($dest,0777);
					}

					if(!empty($myfilename)){
						$filename = $myfilename."_".rand(0,100).".".$ext;
					}else{
						$filename = "a".time()."".rand(0,100).".".$ext;
					}
					$imgdest = $dest."/".$filename;

					if (move_uploaded_file($_FILES[$fname]['tmp_name'],$imgdest)) {
						$res['status'] = 1;
						$res['imgpath'] = $imgdest;
					} else {
					  $res['errmsg'] = "File Not Uploaded. Please try again.";
					}

				} else {
					$res['errmsg'] = 'Please check destination.';
				}

			}else{
				$res['errmsg'] = "Image length cannot exceed 500KB.";
			}
		}else{
			$res['errmsg'] = "Only .jpg images are allowed.";
		}

	} else {
		$res['errmsg'] = "File not uploaded";
	}
	return $res;
}


  function __destruct(){
    if(!empty($this->myconn)){
      $this->myconn->close();
    }
  }

}

?>
