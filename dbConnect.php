<?php  
 class dbConnect {  
        function __construct() {  
	//	echo "hello";
           
		//	echo DB_DATABSE;
		 $conn=mysql_connect("localhost", "rushfuqn_test", "rushforme") or die(mysql_error());
		 mysql_select_db("rushfuqn_rushforme",$conn) or die("Could connect to Database");


            //$conn = mysql_connect("localhost","rushfuqn","Naveen321#") or die(mysql_error());
			//$db = mysql_select_db("rushfuqn_rushforme",$conn);
            if(!$conn)// testing the connection  
            {  
                die ("Cannot connect to the database");  
            }   
            return $conn;  
        }  
        public function Close(){  
            mysqli_close();  
        }  
    }  
	  
?>
