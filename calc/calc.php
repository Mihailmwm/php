<!DOCTYPE html> 
<html> 

<?php 
	ini_set('resplay_errors',0); 
	
	if( isset( $_REQUEST['calculator'] )) 
	{ 
		$op=$_REQUEST['operator']; 
		$num1 = $_REQUEST['firstnum']; 
		$num2 = $_REQUEST['secondnum']; 
	} 
	if($op=="+") 
	{ 
		$res= $num1+$num2; 
	} 
	if($op=="-") 
	{ 
		$res= $num1-$num2; 
	} 
	if($op=="*") 
	{ 
		$res =$num1*$num2; 
	} 
	if($op=="/") 
	{ 
		$res= $num1/$num2; 
	} 
	
	if($_REQUEST['firstnum']==NULL || $_REQUEST['secondnum']==NULL) 
	{ 
		echo "<script language=javascript> alert(\"Enter values.\");</script>"; 
	} 
 
?> 

<head> 
</head> 

</html>
