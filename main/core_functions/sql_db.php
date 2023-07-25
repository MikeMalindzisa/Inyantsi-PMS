<?php
$host="localhost";
    $user="root";
    $pass="";
    $database="ncg_db_re";
    $connect=mysqli_connect($host,$user,$pass,$database);

    class DATABASE {
    static	function RUN_QUERY($query){
			global $connect;

			$results = $connect ->query($query);
			$query_id=mysqli_insert_id($connect);
			if($results){
				$response = array("response" =>"success", "query_id" =>$query_id, "data" =>$results, "message" =>"Query executed successfully");
			}else{
				$msg = mysqli_error($connect);
				$response = array("response" =>"failed", "message" =>$msg);
			}
			return $response;
		}
		static function CLEAN($string){
			global $connect;
			$string = mysqli_real_escape_string($connect,$string);
			$string = htmlentities($string);
			$string = strip_tags($string,'<pre></pre><br><center><b><i><u>');
			return $string;
		}
  	}
?>