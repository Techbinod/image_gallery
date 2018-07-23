<?php  
function debugger($data, $is_die,$dump=false){
	echo "<pre style='color:#000; background-color:#ccc;'>";
	if($dump){
		var_dump($data);
		/*echo "I am dump";*/

	}else {
		print_r($data);
		/*echo "I am print_r";*/

	}
	echo "</pre>";
	if ($is_die){
		exit;
	}
	
}



function classAutoLoader($class){
 
 $class = strtolower($class);

 $the_path = "includes/{$class}.php";

   if(is_file($the_path)){
   	require_once($the_path);
   }else{

   die("This file named {$class}.php was not found");

  }
}


function redirect($location){

  header("Location:{$location}");

}