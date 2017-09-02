<?php
session_start();
include 'constant.php';
class DB_Connect {
	//constructor
	protected $table_name;
	/*function __construct(){

	$cn=mysql_connect("quickoprder.db.11897964.hostedresource.com","quickorder","iSHA@91919") or die("Could not Connect My Sql");
	mysql_select_db("quickorder",$cn)  or die("Could connect to Database");
//$cn=mysql_connect("quickoprder.db.11897964.hostedresource.com","quickorder","iSHA@91919") or die("Could not Connect My Sql");
	//mysql_select_db("quickorder",$cn)  or die("Could connect to Database");

	$cn=mysql_connect("localhost","root","") or die("Could not Connect My Sql");
	mysql_select_db("quickorder",$cn)  or die("Could connect to Database");

	}*/
	function __construct(){

		// $db=mysql_connect("quickorder.db.11897964.hostedresource.com","quickorder","iSHA@91919") or die("Could not Connect My Sql");
		// mysql_select_db("quickorder",$db)  or die("Could connect to Database");
		// $this->table_name= $_SESSION['table_val'];
		$db=mysql_connect("localhost","quickorder","ZBMi45APo1&G") or die("Could not Connect My Sql");
		mysql_select_db("quick_order",$db)  or die("Could connect to Database");	
		$this->table_name= $_SESSION['table_val'];
		// $cn=mysql_connect("localhost","root","") or die("Could not Connect My Sql");
		// mysql_select_db("quickorder",$cn)  or die("Could connect to Database");
	// $db=mysql_connect("50.62.209.108","hosting123456","hostingtest@1") or die("Could not Connect My Sql");
		// mysql_select_db("quickorder",$db)  or die("Could connect to Database");
	}
	//destructor
	function __destruct()    {
		//$this->close();
	}
	public function close() {
		mysql_close();
	}
	public function Insert_feedback_rating($name,$email,$phone,$birthday,$comments,$rating,$total_rating,$status)
	{
		$insert="INSERT INTO ".$this->table_name."_feedback_rating(id, name, email, phone, birthday, comments, rating, total_rating, status)
 VALUES ('','$name','$email','$phone','$birthday','$comments','$rating','$total_rating','$status')";
		$res=mysql_query($insert) or die(mysql_error());
		return $res;
	}
	public function getfeedbackBirthdays(){
		$qry = "select phone as mobile_num,email from ".$this->table_name."_feedback_rating  where birthday like date(now())";
		
			$res=mysql_query($qry) or die(mysql_error());
		return $res;
	}
	public function getfeedbackContacts(){
		$qry = "select  phone as mobile_num,email from ".$this->table_name."_feedback_rating ";
		
			$res=mysql_query($qry) or die(mysql_error());
		return $res;
	}
	
	public function food_types($food_cat)  {
			
		$create = mysql_query("create table if not exists food_type(id int(20) not null auto_increment,food_cat varchar(30),primary key(id))") or die(mysql_error());

		$ins=mysql_query("INSERT INTO ".$this->table_name."_food_type values('','$food_cat')") or die(mysql_error());
		if($ins){
			echo "inserted successfully" ;
		}else {
			echo mysql_error();
		}

	}

	public function food_categories($name,$image)  {
			
		$create = mysql_query("create table if not exists food_category(id int(20) not null auto_increment,name varchar(30),image varchar(200),primary key(id))") or die(mysql_error());

		$ins=mysql_query("INSERT INTO ".$this->table_name."_food_category values('','$name','$image')") or die(mysql_error());
		if($ins){
			echo "inserted successfully" ;
		}else {
			echo mysql_error();
		}

	}

	public function food_insert($food_type_id,$foodcat_id,$food_name,$sub_title,$sub_categoryarray,$ingradiensarray,$description,$image,$video,$price) {

		$create = mysql_query("CREATE TABLE IF NOT EXISTS foods (
  id int(10) NOT NULL AUTO_INCREMENT,
  food_type_id varchar(20) DEFAULT NULL,
  foodcat_id varchar(20) DEFAULT NULL,
  food_name varchar(30) DEFAULT NULL,
  sub_title varchar(30) DEFAULT NULL,
  sub_category varchar(30) DEFAULT NULL,
  ingradients varchar(200) DEFAULT NULL,
  ref_code varchar(20) DEFAULT NULL,
  description varchar(200) DEFAULT NULL,
  image varchar(200) DEFAULT NULL,
  video varchar(200) DEFAULT NULL,
  price varchar(20) DEFAULT NULL,
  original_price double(13,2) NOT NULL,
  dynamic_per int(11) NOT NULL,
  modified_time int(11) NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;") or die(mysql_error());

		$s =mysql_query("select max(id) from  ".$this->table_name."_foods");
		$arr=mysql_fetch_array($s);
		$ref_code=$arr[0]+1;
		// $qry = "INSERT INTO ".$this->table_name."_foods values('','$food_type_id','$foodcat_id','$food_name','$sub_title','$sub_categoryarray','$ingradiensarray','$ref_code','$description','$image','$video','$price','$price',0,now(),1)";
		$ins=mysql_query("INSERT INTO ".$this->table_name."_foods values('','$food_type_id','$foodcat_id','$food_name','$sub_title','$sub_categoryarray','$ingradiensarray','$ref_code','$description','$image','$video','$price','$price',0,now(),1)") or die(mysql_error());

		if ($ins){
			return	mysql_insert_id();
		}else {
			return	-1;
		}


	}

	public function food_attributes_insert($food_id,$foodavailfrom,$foodavailto,$hide,$description,$foodsession,$kitchen,$ordercopy) {

		$create = mysql_query("CREATE TABLE IF NOT EXISTS food_attributes(id INT(10) NOT NULL AUTO_INCREMENT,
		food_id VARCHAR(20),foodavailfrom VARCHAR(30),foodavailto VARCHAR(30),hide VARCHAR(30),description 
		VARCHAR(200),foodsession VARCHAR(30),kitchen VARCHAR(30),ordercopy VARCHAR(30),PRIMARY KEY(id))") or die(mysql_error());
		$query = "INSERT INTO ".$this->table_name."_food_attributes values('','$food_id','$foodavailfrom','$foodavailto','$hide','$description','$foodsession','$kitchen','$ordercopy')";
		$ins=mysql_query($query) or die(mysql_error());

		return  $ins;
	}


	public function get_food_categories_by_type($food_type_id) {
		$qry = "select * from  ".$this->table_name."_food_category where id in (select distinct foodcat_id from  ".$this->table_name."_foods where food_type_id = '$food_type_id')";
		$res=mysql_query($qry) or die(mysql_error());
		return $res;
	}

	public function get_food_by_foodcategoryid($foodcat_id) {
		//		echo "select distinct ".$this->table_name."_foods.id,".$this->table_name."_foods.food_name
		//		from  ".$this->table_name."_foods join  ".$this->table_name."_order_items on
		//		(".$this->table_name."_foods.foodcat_id = '$foodcat_id' and
		//		".$this->table_name."_foods.id=".$this->table_name."_order_items.food_id  ) ";
		$res=mysql_query("select distinct ".$this->table_name."_foods.id,".$this->table_name."_foods.food_name
		from  ".$this->table_name."_foods join  ".$this->table_name."_order_items on 
		(".$this->table_name."_foods.foodcat_id = '$foodcat_id' and 
		".$this->table_name."_foods.id=".$this->table_name."_order_items.food_id  ) ") or die(mysql_error());
		return $res;
	}
	public function get_foodcategorydetails($foodcat_id) {
		$res=mysql_query("SELECT * from  ".$this->table_name."_food_category where id=  '$foodcat_id'") or die(mysql_error());
		return $res;
	}

	public function insert_profiles($name,$mailid,$phoneno,$prefname,$password,$address,$type) {
		$table_val =$this->table_name;
		$create =mysql_query("create table if not exists profiles_table(s_no int auto_increment, name VARCHAR(20),mailid VARCHAR(30),
        phoneno VARCHAR(20), prefname  VARCHAR(30),password VARCHAR(20),address VARCHAR(200),type VARCHAR(20),unique key(s_no),branch_admin_id bigint ,status tinyint ,primary key(mailid,phoneno))") or die(mysql_error());
		$date_val =date("Y-m-d");

		$ins=mysql_query("INSERT INTO profiles_table  VALUES ('','$name','$mailid','$phoneno','$prefname','$password','$address','$type','$table_val')") ;
		if($ins){
			echo "inserted successfully" ;
		}else {
			echo mysql_error();
		}
	}

	public function  get_login_profile($mailid,$password) {
		$res=mysql_query("select s_no,type from  ".$this->table_name."_profiles_table where mailid = '$mailid' and password = '$password'") or die(mysql_error());
		return $res;
	}
	public function  get_All_profile($type) {
		$res=mysql_query("select * from  profiles_table where category = '$type'") or die(mysql_error());
		return $res;
	}

	public function  get_food_categories() {
		$res=mysql_query("select * from  ".$this->table_name."_food_category") or die(mysql_error());
		return $res;
	}

	public function  get_category_name() {
		$res=mysql_query("select name from  ".$this->table_name."_food_category") or die(mysql_error());
		return $res;
	}

	public function getCatName($catid){
		$res=mysql_query("select name from  ".$this->table_name."_food_category where id = '$catid' ") or die(mysql_error());
		$r=mysql_fetch_array($res);
		return $r['name'];
	}

	public function getTypeId($ftype){
		$res=mysql_query("select id from  ".$this->table_name."_food_type where food_cat = '$ftype' ") or die(mysql_error());
		$r=mysql_fetch_array($res);
		return $r['id'];
	}

	public function getTypeName($typeid){
		$res=mysql_query("select food_cat from  ".$this->table_name."_food_type where id = '$typeid' ") or die(mysql_error());
		$r=mysql_fetch_array($res);
		return $r['food_cat'];
	}


	public function getCatId($fcat){
		$res=mysql_query("select id from  ".$this->table_name."_food_category where name = '$fcat' ") or die(mysql_error());
		$r=mysql_fetch_array($res);
		return $r['id'];
	}

	public function order_details_insert($cust_name,$cust_phno,$porter_name,$order_cost,$order_qty,$noofpersons,
	$table_no,$delivery_status,$status,$time,$order_type=0) {

		$create = mysql_query("CREATE TABLE if not exists ".$this->table_name."_order_details (
  id int(10) NOT NULL AUTO_INCREMENT,
  porter_id varchar(10) DEFAULT NULL,
  order_cost int(10) DEFAULT NULL,
  order_qty int(10) DEFAULT NULL,
  noofpersons int(10) DEFAULT NULL,
  table_no varchar(20) DEFAULT NULL,
  delivery_status varchar(200) DEFAULT NULL,
  status varchar(200) DEFAULT NULL,
  time varchar(50) NOT NULL,
  order_type int(10) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=480 ;") or die(mysql_error());
// echo "INSERT INTO ".$this->table_name."_order_details values('','$porter_name','$order_cost','$noofpersons','$order_qty','$table_no','$delivery_status','$status',now(),1)";
		$ins=mysql_query("INSERT INTO ".$this->table_name."_order_details values('','$porter_name',
		'$order_cost','$noofpersons','$order_qty','$table_no','$delivery_status','$status',now(),$order_type)") or die(mysql_error());
		$order_id =mysql_insert_id();
		if ($ins){
			$this->insert_cust_details($order_id, $cust_name,$cust_phno);
$update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='$order_id',
table_status='Started' WHERE table_no='$table_no'") or die(mysql_error());
                 
     
			return	$order_id;
		}else {
			return	-1;
		}
	}

	public function order_items_insert($order_id,$food_id,$item_qty,$parcel_item_qty,$table_item_qty) {

		$create = mysql_query("CREATE TABLE IF NOT EXISTS order_items (
  id int(10) NOT NULL AUTO_INCREMENT,
  order_id varchar(20) DEFAULT NULL,
  food_id varchar(20) DEFAULT NULL,
  item_qty int(10) DEFAULT NULL,
   parcel_item_qty int(11) NOT NULL,
  table_item_qty int(11) NOT NULL,
  
  status varchar(10) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;
    
    ") or die(mysql_error());

		$ins=mysql_query("INSERT INTO ".$this->table_name."_order_items values('','$order_id',
		'$food_id','$item_qty','$parcel_item_qty','$table_item_qty','processing')") or die(mysql_error());

		if ($ins){
			return	mysql_insert_id();
		}else {
			return	-1;
		}
	}
	public function get_all_order_details($sort_val) {
		$q =  "select * from  ".$this->table_name."_order_details where order_type = 0 order by $sort_val" ;
		$res=mysql_query($q) or die(mysql_error());
		return $res;

	}
	public function get_all_order_items_foodItems($sort_val) {
		$q =  "select * from  ".$this->table_name."_order_items order by $sort_val" ;
		$res=mysql_query($q) or die(mysql_error());
		return $res;

	}

	public function get_order_items($oid) {
		$q =  "SELECT  ".$this->table_name."_foods.price,".$this->table_name."_foods.food_name,
		".$this->table_name."_order_items.item_qty,".$this->table_name."_order_items.id,
		".$this->table_name."_order_items.status,".$this->table_name."_order_attributes.discount from  ".$this->table_name."_foods join 
		 ".$this->table_name."_order_items on (".$this->table_name."_foods.id = 
		 ".$this->table_name."_order_items.food_id ) join  ".$this->table_name."_order_details 
		 on(".$this->table_name."_order_items.order_id =".$this->table_name."_order_details.id 
		 and ".$this->table_name."_order_details.id='$oid' ) left join ".$this->table_name."_order_attributes on (".$this->table_name."_order_attributes.order_id ='$oid' )" ;
		$res=mysql_query($q) or die(mysql_error());
		return $res;

	}

	public  function insert_order_attrs($order_id,$salt_level,$spicy_level,$remarks) {


	 $create = mysql_query("CREATE TABLE IF NOT EXISTS ".$this->table_name."_order_attributes (
  id int(11) NOT NULL AUTO_INCREMENT,
   starter_time varchar(30) DEFAULT NULL,
  
  order_id text NOT NULL,
  salt_level varchar(10) NOT NULL,
  spicy_level varchar(10) NOT NULL,
  remarks text NOT NULL,
   discount int(11) NOT NULL,
  porter_discount int(11) NOT NULL,
  
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;") or die(mysql_error());
// echo "INSERT INTO ".$this->table_name."_order_attributes ( order_id, salt_level, spicy_level, remarks) VALUES
// ( '$order_id', '$salt_level', '$spicy_level','$remarks');";
	 $ins=mysql_query("INSERT INTO ".$this->table_name."_order_attributes ( order_id, salt_level, spicy_level, remarks) VALUES
( '$order_id', '$salt_level', '$spicy_level','$remarks');") or die(mysql_error());

	 if ($ins){
	 	return	mysql_insert_id();
		}else {
			return	-1;
		}

			



	}


	public function get_order_attrs($oid) {
		$q =  "SELECT * from  ".$this->table_name."_order_attributes WHERE order_id = '$oid'" ;
		$res=mysql_query($q) or die(mysql_error());
		return $res;

	}

	public  function oreder_item_remove($id) {
			
		$q = "DELETE from  ".$this->table_name."_order_items WHERE  id =  '$id'";
			
		$ins=mysql_query($q) or die(mysql_error());
		if ($ins){
			return	1;
		}else {
			return	0;
		}

	}
	public  function oreder_remove($id) {
			
		$q = "DELETE from  ".$this->table_name."_order_details WHERE id =  '$id'";
			
		$ins=mysql_query($q) or die(mysql_error());
		if ($ins){
			return	1;
		}else {
			return	0;
		}

	}
	public function order_time_update($st_time,$mc_time,$id) {
		$q="UPDATE ".$this->table_name."_order_attributes SET starter_time='$st_time',maincourse_time='$mc_time' WHERE order_id='$id'";

		$ins=mysql_query($q) or die(mysql_error());
		if ($ins){
			$qry = "UPDATE ".$this->table_name."_order_details SET status='preparing' WHERE id='$id'";
			$res=mysql_query($qry) or die(mysql_error());
			return	$res;
		}else {
			return	0;
		}

	}

	public  function order_status_update($id,$value) {
		$qry = "UPDATE ".$this->table_name."_order_details SET status='$value' WHERE id='$id'";
		$res=mysql_query($qry) or die(mysql_error());
		return $res ;
	}

	public  function order_item_status_update($id,$value) {
		$qry = "UPDATE ".$this->table_name."_order_items SET status='$value' WHERE id='$id'";
		$res=mysql_query($qry) or die(mysql_error());
		if ($res) {
			return  1;
		}
		else return 0;

	}

	public function getfood_BY_cat_type($foodtype_id,$foodcat_id) {
		$qry = "SELECT * from  ".$this->table_name."_foods WHERE food_type_id = '$foodtype_id' and foodcat_id = '$foodcat_id'";
		$res=mysql_query($qry) or die(mysql_error());
		return $res ;
			
	}

	public function getTotal_Food_details($food_id) {
		$q = "SELECT ".$this->table_name."_order_details.table_no,".$this->table_name."_order_details.id,food_id,sum(parcel_item_qty) as parcel,sum(table_item_qty) as table_val from  ".$this->table_name."_order_items  join  ".$this->table_name."_order_details  on(".$this->table_name."_order_items.order_id=".$this->table_name."_order_details.id and ".$this->table_name."_order_items.food_id='$food_id' and ".$this->table_name."_order_items.status <> 'completed')  group by ".$this->table_name."_order_details.table_no , ".$this->table_name."_order_items.food_id";
		$res = mysql_query($q);
		return $res ;
	}
	public function get_Food_total_vals($food_id) {
		$q = "SELECT ".$this->table_name."_order_details.table_no,".$this->table_name."_order_details.id,food_id,sum(parcel_item_qty) as parcel,sum(table_item_qty) as table_val from  ".$this->table_name."_order_items  join  ".$this->table_name."_order_details  on(".$this->table_name."_order_items.order_id=".$this->table_name."_order_details.id and ".$this->table_name."_order_items.food_id='$food_id' and ".$this->table_name."_order_items.status <> 'completed')";
		$res = mysql_query($q);
		return $res ;
	}
	public function getTotal_Food_details_limit($food_id,$start, $limit,$parcel_val=0) {


		$q = "SELECT ".$this->table_name."_order_details.table_no,".$this->table_name."_order_details.id,food_id,sum(parcel_item_qty) as parcel,sum(table_item_qty) as table_val from  ".$this->table_name."_order_items  join  ".$this->table_name."_order_details  on(".$this->table_name."_order_items.order_id=".$this->table_name."_order_details.id and ".$this->table_name."_order_items.food_id='$food_id'  and ".$this->table_name."_order_items.status <> 'completed')  group by ".$this->table_name."_order_details.table_no , ".$this->table_name."_order_items.food_id LIMIT $start, $limit";


		$res = mysql_query($q);
		return $res ;
	}

	public function get_food_details_by_id($food_id) {
	 	$q = "SELECT * from  ".$this->table_name."_foods WHERE id ='$food_id'";
		$res = mysql_query($q);
		return $res ;
	}
	public function changefood_status($order_ids,$food_id) {
		// $q ="SELECT order_items.id from  ".$this->table_name."_order_items  join  ".$this->table_name."_order_details on (".$this->table_name."_order_details.id in ($order_ids) and order_items.order_id = ".$this->table_name."_order_details.id and  order_items.food_id=$food_id)";
		$qry = "UPDATE ".$this->table_name."_order_items SET status='$value' WHERE ".$this->table_name."_order_details.order_id in ($order_ids) and ".$this->table_name."_order_items.food_id=$food_id ";
		$res = mysql_query($q);
		return $res ;
	}

	public  function changefood_status_order_item_by_orederid($id,$value) {
		$qry = "UPDATE ".$this->table_name."_order_items SET status='$value' WHERE order_id='$id'";
		$res=mysql_query($qry) or die(mysql_error());
		if ($res) {
			return  1;
		}
		else return 0;

	}

	///////////////
	public function insert_emp_profiles($name,$username,$password,$category,$address,$phoneno,$mailid,$emergencyphno,$education,$idfroof,$photo,$date) {

		$create =mysql_query("create table if not exists profiles_table(s_no int auto_increment, name VARCHAR(20),
		username VARCHAR(30),
password VARCHAR(20),category VARCHAR(20),address VARCHAR(200),phoneno VARCHAR(20),mailid VARCHAR(50),emergencyphno VARCHAR(20),
education VARCHAR(50),idfroof VARCHAR(200),photo VARCHAR(200),date date,branch_admin_id int,status tinyint,unique key(s_no),primary key(mailid,phoneno))") or die(mysql_error());
		$admin_id = isset($this->table_name)?$this->table_name:'-1';
		$ins=mysql_query("INSERT INTO profiles_table VALUES ('','$name','$username','$password',
		'$category','$address','$phoneno','$mailid','$emergencyphno','$education','$idfroof',
		'$photo','$date','$admin_id','1')") or die(mysql_error());
		if($ins){
			return mysql_insert_id() ;
		}else {
			return 0;
		}
	}

	public function get_emp_login_profile($username,$password) {
		$res=mysql_query("select s_no,category,username from  ".$this->table_name."_profiles_table where username = '$username' and password = '$password'") or die(mysql_error());
		return $res;
	}
	//////////

	function insert_chat_info($chat_id,$sender_type,$chat_desc) {
		$qry  = "INSERT INTO ".$this->table_name."_notifications_data (id, notifications_id, sender_cat, 
		description, time) VALUES (NULL, '$chat_id', '$sender_type', '$chat_desc', now());";
		
		$res = mysql_query($qry)or die(mysql_error());
		 
		if ($res) {
			// $this->update_notification_viewed($chat_id, 'complete');
			return mysql_insert_id();
		}
		else{
			return -1;
		}
	}


	function chat_insert($order_id,$table_no,$sender_type,$chat_desc) {

		$selct_qry  =  "select * from  ".$this->table_name."_notifications where table_no ='$order_id' " ;
		$select_res = mysql_query($selct_qry);
		$notification_parent = '' ;
		if (mysql_num_rows($select_res)>0) {
			$select_res_vals = mysql_fetch_array($select_res);
			$notification_parent = $select_res_vals['id'];
			$this->update_notification_viewed($notification_parent , 'pending');
		}
		else{

			$ins_qry  ="INSERT INTO ".$this->table_name."_notifications (id, table_no, order_id, status) VALUES
('', '$table_no','$order_id', 'pending')";
			$res = mysql_query($ins_qry)or die(mysql_error());
			$notification_parent = mysql_insert_id();
		}
		if (!empty($notification_parent)){

			$qry  = "INSERT INTO ".$this->table_name."_notifications_data (id, notifications_id, sender_cat, description, time) VALUES
(NULL, '$notification_parent', '$sender_type', '$chat_desc', now());";
			$res1 = mysql_query($qry)or die(mysql_error());

			if ($res1) {
				return mysql_insert_id();
			}
			else{
				return -1;
			}

		}else{
			return -1;
		}

	}

	function get_chat_ids() {
		$qry ="SELECT ".$this->table_name."_notifications.*,
		profiles_table.category as sender_category FROM ".$this->table_name."_notifications join ".$this->table_name."_order_attributes on (".$this->table_name."_notifications.order_id = ".$this->table_name."_order_attributes.order_id) join ".$this->table_name."_order_details on (".$this->table_name."_notifications.order_id = ".$this->table_name."_order_details.id) join profiles_table on (".$this->table_name."_order_details.porter_id = profiles_table.s_no);";
		//		$qry = "SELECT * from  ".$this->table_name."_notifications order by table_no";
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;
	}

	function get_chat_info($id) {
		$qry = "SELECT id,notifications_id,sender_cat,description,time(time) as time from  ".$this->table_name."_notifications_data WHERE notifications_id ='$id'";
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;
	}
	function get_order_info($id) {
		$qry = "SELECT *
from  ".$this->table_name."_order_details
join  ".$this->table_name."_order_attributes ON ( ".$this->table_name."_order_details.id = ".$this->table_name."_order_attributes.order_id 
AND ".$this->table_name."_order_details.id =  '$id' ) ";

		$res = mysql_query($qry)or die(mysql_error());
		return $res ;
	}
	function get_order_status_details() {

		$qry = "SELECT * from  ".$this->table_name."_order_details  order by table_no"  ;
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;

	}

	function get_order_item_food_details($order_id) {
		$qry = "SELECT ".$this->table_name."_order_details.id as order_val ,
		".$this->table_name."_customers_table.cust_name, ".$this->table_name."_customers_table.cust_phno,
		".$this->table_name."_order_details. porter_id, 
		".$this->table_name."_order_details.order_cost,
		 ".$this->table_name."_order_details.order_qty,
		  ".$this->table_name."_order_details.noofpersons,
		  ".$this->table_name."_order_details.table_no, 
		  ".$this->table_name."_order_details.delivery_status,
		   ".$this->table_name."_order_details.status as order_status,
		    ".$this->table_name."_order_details.time,
".$this->table_name."_order_items.id as order_item_val , 
".$this->table_name."_order_items.order_id, 
".$this->table_name."_order_items.food_id, 
".$this->table_name."_order_items.item_qty, 
".$this->table_name."_order_items.parcel_item_qty,
".$this->table_name."_order_items. table_item_qty, 
".$this->table_name."_order_items.status as order_item_val_status ,
".$this->table_name."_order_attributes.id, ".$this->table_name."_order_attributes.starter_time, 
".$this->table_name."_order_attributes.maincourse_time, 
".$this->table_name."_order_attributes.order_id,
 ".$this->table_name."_order_attributes.salt_level,
  ".$this->table_name."_order_attributes.spicy_level, ".$this->table_name."_order_attributes.remarks,

".$this->table_name."_foods.id as food_id  , ".$this->table_name."_foods.food_type_id, ".$this->table_name."_foods.foodcat_id, ".$this->table_name."_foods.food_name, ".$this->table_name."_foods.sub_title, ".$this->table_name."_foods.sub_category, 
".$this->table_name."_foods.ingradients, ".$this->table_name."_foods.ref_code, 
".$this->table_name."_foods.description, ".$this->table_name."_foods.image, ".$this->table_name."_foods.video, ".$this->table_name."_foods.price

from  ".$this->table_name."_order_details join ".$this->table_name."_customers_table on (".$this->table_name."_order_details.id = ".$this->table_name."_customers_table.order_id)
join  ".$this->table_name."_order_items ON ( ".$this->table_name."_order_details.id =  ".$this->table_name."_order_items.order_id ) 
join  ".$this->table_name."_foods ON (  ".$this->table_name."_order_items.food_id = ".$this->table_name."_foods.id
AND  ".$this->table_name."_order_items.order_id =  '$order_id' ) join  ".$this->table_name."_order_attributes on (".$this->table_name."_order_details.id = ".$this->table_name."_order_attributes.order_id) ";

		$res = mysql_query($qry)or die(mysql_error());
		$order_foods =array();
		if ($res) {
			while ($qry_arr = mysql_fetch_array($res)) {


				$user_cart =array();
				$product_id=$qry_arr['food_id'];

				$product_name=$qry_arr['food_name'];
				$user_cart['order_item_id']=$qry_arr['order_item_val'];
				$user_cart['product_id']=$qry_arr['food_id'];
				$user_cart['product_name']=$qry_arr['food_name'];
				$user_cart['product_image']=$qry_arr['image'];
				$user_cart['table_val']=$qry_arr['table_item_qty'];
				$user_cart['parcel_val']=$qry_arr['parcel_item_qty'];
				$user_cart['quantity']=$qry_arr['item_qty'];
				$user_cart['cost']=$qry_arr['price'];
				$user_cart['maincourse_time']=$qry_arr['maincourse_time'];
				$user_cart['maincourse_time']=$qry_arr['maincourse_time'];
				$order_foods['user_cart'][$product_name.$product_id]=$user_cart;
				$order_foods['total_quantity']=$qry_arr['order_qty'];
				$order_foods['total_order_cost']=$qry_arr['order_cost'];
				$order_foods['order_table_no']=$qry_arr['table_no'];
				$order_foods['noofpersons']=$qry_arr['noofpersons'];
				$order_foods['salt_level']=$qry_arr['salt_level'];
				$order_foods['spice_level']=$qry_arr['spicy_level'];
				$order_foods['remarks']=$qry_arr['remarks'];
				$order_foods['cust_name']=$qry_arr['cust_name'];
				$order_foods['porter_name']=$qry_arr['porter_id'];
				$order_foods['time']=$qry_arr['time'];
			}
		}
		return $order_foods ;

	}

	public function  update_order_details($order_id , $cust_name,$cust_phno,$porter_name,$order_cost,$order_qty,
	$noofpersons,$table_no,$delivery_status,$status,$time)
	{

		$qry =  "UPDATE ".$this->table_name."_customers_table SET cust_name='$cust_name',cust_phno='$cust_phno'	 WHERE order_id='$order_id'" ;
		$res = mysql_query($qry)or die(mysql_error());

		$qry =  "UPDATE ".$this->table_name."_order_details SET order_cost='$order_cost',order_qty='$order_qty',noofpersons='$noofpersons',
		table_no='$table_no',delivery_status='$delivery_status',status='$status',time='$time' WHERE id='$order_id'" ; 
$update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='$order_id',
table_status='Started' WHERE table_no='$table_no'") or die(mysql_error());
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;
	}

	function update_order_item_details($order_id,$food_id,$item_qty,$parcel_item_qty,$table_item_qty) {

		$checking = "SELECT * from  ".$this->table_name."_order_items WHERE  order_id='$order_id' and  food_id='$food_id'";
		$checking_res = mysql_query($checking);
		if ($checking) {
			if (mysql_num_rows($checking_res)) {
				$qry= "UPDATE ".$this->table_name."_order_items SET item_qty='$item_qty',parcel_item_qty='$parcel_item_qty',
		table_item_qty='$table_item_qty'  WHERE  order_id='$order_id' and  food_id='$food_id'";
				$res = mysql_query($qry)or die(mysql_error());
			}
			else{
				$ins=mysql_query("INSERT INTO ".$this->table_name."_order_items values('','$order_id','$food_id','$item_qty','$parcel_item_qty','$table_item_qty','processing')") or die(mysql_error());
				$res = mysql_insert_id();
			}
		}

		return $res ;

	}

	function update_order_attrs($order_id,$salt_level,$spicy_level,$remarks)
	{
		$qry ="UPDATE ".$this->table_name."_order_attributes SET salt_level='$salt_level',spicy_level='$spicy_level',remarks='$remarks' WHERE order_id='$order_id' ";

		$res = mysql_query($qry)or die(mysql_error());
		return $res ;
	}

	function get_order_details_ByCust_mobile($phno) {
		$qry = "SELECT od.* , ct.cust_name ,ct.cust_phno from  ".$this->table_name."_order_details od join ".$this->table_name."_customers_table ct WHERE ct.cust_phno = '$phno' and ct.order_id = od.id";
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;
	}

	function notifications_latest()
	{
		//$qry  = " SELECT * from  ".$this->table_name."_notifications_data join  ".$this->table_name."_notifications on (notifications.status='pending' and notifications_data.notifications_id = notifications.id) group by notifications_id , sender_cat order by notifications_data.id desc";
		$qry  = "SELECT * from  ".$this->table_name."_notifications_data join  
		".$this->table_name."_notifications on (".$this->table_name."_notifications.status='pending' 
		and ".$this->table_name."_notifications_data.notifications_id = ".$this->table_name."_notifications.id) 
		group by table_no order by notifications_id desc ";
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;


	}
	function update_notification_viewed($id=0,$status='pending'){
		if($id == 0){
			
		$qry = "update ".$this->table_name."_notifications set status ='$status' ";
		}else{
			
		$qry = "update ".$this->table_name."_notifications set status ='$status' where id=$id ";
		}
		$res = mysql_query($qry)or die(mysql_error());
		return $res ;

		
	}

	public function insert_tables_reserve($name,$phoneno,$noofpersons,$tables) {

		$create = mysql_query("CREATE TABLE IF NOT EXISTS ".$this->table_name."_reserve_tables (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(30) NOT NULL,
  phoneno varchar(20) NOT NULL,
  noofpersons int(10) NOT NULL,
  tables varchar(20) NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  notif_status tinyint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
		") or die(mysql_error());
 "INSERT INTO ".$this->table_name."_reserve_tables values('','$name','$phoneno','$noofpersons','$tables',now(),0)";
		$ins=mysql_query("INSERT INTO ".$this->table_name."_reserve_tables values('','$name','$phoneno','$noofpersons','$tables',now(),0)") or die(mysql_error());

		if($ins){
			return mysql_insert_id();
		}else {
			return -1;
		}

	}     

	public function get_reserve_tables_unassigned(){
		$result = mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,".$this->table_name."_reserve_tables.noofpersons,".$this->table_name."_reserve_tables.name,".$this->table_name."_reserve_tables.phoneno,".$this->table_name."_reserve_tables.time from  ".$this->table_name."_reserve_tables join  ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id  not in (select ".$this->table_name."_tables_table.status from  ".$this->table_name."_tables_table)) ") or die(mysql_error());
		return $result;
  
	}
	public function get_reserve_tables_assigned(){
		$result = mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,
		".$this->table_name."_reserve_tables.noofpersons,".$this->table_name."_reserve_tables.name,
		".$this->table_name."_reserve_tables.phoneno,".$this->table_name."_reserve_tables.time,
		group_concat(".$this->table_name."_tables_table.table_no  SEPARATOR '-') as assigned_tables 
		from  ".$this->table_name."_reserve_tables join  ".$this->table_name."_tables_table on 
		(".$this->table_name."_reserve_tables.id in (  ".$this->table_name."_tables_table.status) ) group by ".$this->table_name."_reserve_tables.id ") or die(mysql_error());
		return $result;

	}


	public function get_reserve_tables_assigned_latest(){

		$result = mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,
		".$this->table_name."_reserve_tables.noofpersons,
		".$this->table_name."_reserve_tables.name,
		".$this->table_name."_reserve_tables.phoneno,time(time) as time,
		group_concat(".$this->table_name."_tables_table.table_no  SEPARATOR '-') as assigned_tables from  ".$this->table_name."_reserve_tables join  ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id   in ( ".$this->table_name."_tables_table.status )  and  TIMESTAMPDIFF(
MINUTE ,  time , NOW() ) <=10 ) group by ".$this->table_name."_reserve_tables.id") or die(mysql_error());
		return $result;

	}

	public function get_reserve_tables_assigned_old(){

		$result = mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,
		".$this->table_name."_reserve_tables.noofpersons,
		".$this->table_name."_reserve_tables.name,
		".$this->table_name."_reserve_tables.phoneno,time(time) as time,
		group_concat(".$this->table_name."_tables_table.table_no  SEPARATOR '-') as assigned_tables 
		from  ".$this->table_name."_reserve_tables join  ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id   in ( ".$this->table_name."_tables_table.status )  and  TIMESTAMPDIFF(
MINUTE ,  time , NOW() ) >10 ) group by ".$this->table_name."_reserve_tables.id") or die(mysql_error());
		return $result;

	}

	public function reserve_table_remove($id,$table_vals) {

		$delete=mysql_query("DELETE from  ".$this->table_name."_reserve_tables WHERE id = '$id'") or die(mysql_error());

		if ($delete){
   $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='0',table_status='Ready To Seat' WHERE table_no in ($table_vals) ") or die(mysql_error());
      
			return 1;
		}else {
			return 0;
		}

	}
 

	public function reserve_table_update($id,$name,$phoneno,$noofpersons) {

		$update=mysql_query("UPDATE ".$this->table_name."_reserve_tables SET name='$name',phoneno='$phoneno',noofpersons='$noofpersons' WHERE id='$id'") or die(mysql_error());

		if ($update){
			return mysql_insert_id();
		} else {
			return -1;
		}

	}

	public function reserve_table_assign($id,$table_ids) {

		for ($i = 0; $i < count($table_ids); $i++) {
			$id_val = $table_ids[$i];
		 $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='$id' , 
		 table_status='Seated'  WHERE table_no='$id_val'") or die(mysql_error());

		}
		if ($update){
			return  1;
		} else {
			return 0;
		}

	}

	function getTables_vals() {
		$result = mysql_query("SELECT * from  ".$this->table_name."_tables_table ") or die(mysql_error());
		return $result;
	}
	function getTables_ordered_vals() {
		$result = mysql_query("SELECT distinct  group_concat(id order by  table_no  ) as table_ids,group_concat(table_no order by  table_no  ) as tables,IF (status='0', group_concat(seating order by  table_no  ),sum(seating))    as seats_count,status  from  ".$this->table_name."_tables_table group by status   order by  table_no ");
		return  $result;
	}
	function getQuickMenu_foods_details($cat_id)
	{

		$qry = "select ".$this->table_name."_foods.food_name,sum(".$this->table_name."_order_items.item_qty)as item_qty ,sum(".$this->table_name."_order_items.parcel_item_qty) as parcel_item_qty,(sum(".$this->table_name."_order_items.item_qty)*".$this->table_name."_foods.price) as price_val  from  ".$this->table_name."_order_items join  ".$this->table_name."_foods where ".$this->table_name."_order_items.food_id = ".$this->table_name."_foods.id and ".$this->table_name."_foods.food_type_id = '$cat_id' group by ".$this->table_name."_foods.id";
		$result = mysql_query($qry) or die(mysql_error());
		return $result;
	}
	function getQuickMenu_AllFood_types()
	{

		$qry = "SELECT * from  ".$this->table_name."_food_type";
		$result = mysql_query($qry) or die(mysql_error());
		return $result;
	}
	function getQuickMenu_foods_categories($type_id) {
		$qry = "SELECT  ".$this->table_name."_foods.food_type_id,foodcat_id,".$this->table_name."_foods.food_name,".$this->table_name."_foods.image as food_image  ,".$this->table_name."_food_category.name as food_category_name , ".$this->table_name."_food_category.image as food_category_image   from  ".$this->table_name."_foods join  ".$this->table_name."_food_category on ( ".$this->table_name."_foods.foodcat_id =   ".$this->table_name."_food_category.id and ".$this->table_name."_foods.food_type_id='$type_id') group by foodcat_id";
		$result = mysql_query($qry) or die(mysql_error());
		return $result;
	}
	function getQuickMenu_foods($main_id,$sub_id) {
		$qry = "SELECT * FROM ".$this->table_name."_foods WHERE food_type_id = '$main_id' and foodcat_id = '$sub_id'";
		$result = mysql_query($qry) or die(mysql_error());
		return $result;
	}
	function getQuickMenu_foods_limit($main_id,$sub_id,$page) {
		$page_num = $page*10;
		$limit = $page_num+10;
		   $qry = "SELECT * FROM ".$this->table_name."_foods WHERE food_type_id = '$main_id' and foodcat_id = '$sub_id'  limit $page_num,$limit";
		$result = mysql_query($qry) or die(mysql_error());
		return $result;
	}
	function get_occupancy_count()
	{
		$qry ="SELECT time(DATE_FORMAT(".$this->table_name."_order_details.time,'%Y-%m-%d %H:00:00')) as timeslice,

count(".$this->table_name."_order_details.order_qty) as mycount
from  ".$this->table_name."_order_details 
where date(time) = '2015-02-11' and status = 'occupancy'
GROUP BY 
round(UNIX_TIMESTAMP(".$this->table_name."_order_details.time) / 3600)
ORDER BY ".$this->table_name."_order_details.time";

		$result = mysql_query($qry);
		return $result  ;


	}
	function get_total_num_tables()
	{
		$result=mysql_query("SELECT count(status) as total_tables  from  ".$this->table_name."_tables_table WHERE 1 ") or die(mysql_error());
		if($result)
		{
	  $result_arr = mysql_fetch_array($result);

	  $result_count = $result_arr['total_tables'];
	  return $result_count ;
		}
		else{
			return -1;
		}

	}
	///campaign screens

	function create_campaign_group($group_name, $message,$type) {
			
		$create_qry = "
CREATE TABLE IF NOT EXISTS campaign_groups (
  group_id int(20) NOT NULL AUTO_INCREMENT,
  group_name varchar(100) NOT NULL,
  message text NOT NULL,
  type varchar(20) NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY (group_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;	";
			
		$res =  	mysql_query($create_qry)or die(mysql_error());
			
		  $ins_qry = "INSERT INTO ".$this->table_name."_campaign_groups ( group_name, message,type,status) VALUES
('$group_name', '$message','$type', 1)";
		$ins_qry_res =  	mysql_query($ins_qry)or die(mysql_error());
		if($ins_qry_res)
		{
			return mysql_insert_id();
		}
		else {
			return -1 ;
		}

			
			
	}

	function create_ins_group_member($name, $mobile_num, $email, $group_id,$type) {
		$create_qry = "CREATE TABLE IF NOT EXISTS campaign_group_members (
  member_id int(20) NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  mobile_num text NOT NULL,
  email text NOT NULL,
  group_id int(11) NOT NULL,
   
  status tinyint(4) NOT NULL,
  
  PRIMARY KEY (member_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
      	";
		$res =  	mysql_query($create_qry)or die(mysql_error());
		$ins_qry = "INSERT INTO ".$this->table_name."_campaign_group_members (name, mobile_num, email, group_id,status) VALUES
('$name', '$mobile_num', '$email', $group_id,'$type', 1),
      	";
		$ins_qry_res =  	mysql_query($ins_qry)or die(mysql_error());
		if($ins_qry_res)
		{
			return 1;
		}

	}
	function get_all_groups($type) {
		$sel_qry = "SELECT * from  ".$this->table_name."_campaign_groups where type ='$type' ";
		$ins_qry_res =  	mysql_query($sel_qry)or die(mysql_error());
		if($ins_qry_res)
		{
			return $ins_qry_res ;
		}
	}
function get_template_message($grpid) {
		$sel_qry = "SELECT * from  ".$this->table_name."_campaign_groups where group_id='$grpid' ";
		$ins_qry_res =  	mysql_query($sel_qry)or die(mysql_error());
		if($ins_qry_res)
		{
			return $ins_qry_res ;
		}
	}

	function get_campaing_group_members($group_id) {
	$sel_grp_qry ="SELECT * from  ".$this->table_name."_campaign_group_members WHERE  group_id ='$group_id'";
		$sel_grp_qry_res =  	mysql_query($sel_grp_qry)or die(mysql_error());
		
			return $sel_grp_qry_res ;
		


	}

	function create_campaign_tablet($campaign_type,$image_path,$text, $transistion_time,$duration,
	$from_time, $to_time) {

		$create_qry = "CREATE TABLE IF NOT EXISTS campagin_tablet_data (
  campaign_id int(11) NOT NULL AUTO_INCREMENT,
  campaign_type varchar(20) NOT NULL,
  image_path text NOT NULL,
  text text NOT NULL,
  transistion_time varchar(50) NOT NULL,
  duration varchar(50) NOT NULL,
  from_time time NOT NULL,
  to_time time NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY (campaign_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
		";
		$res =  	mysql_query($create_qry)or die(mysql_error());
		$ins_qry = "INSERT INTO ".$this->table_name."_campagin_tablet_data
		 (campaign_type, image_path, text, transistion_time, duration, from_time,
		  to_time, status) VALUES
('$campaign_type', '$image_path', '$text', '$transistion_time', '$duration', '$from_time', '$to_time', 1)";
		$ins_qry_res =  	mysql_query($ins_qry)or die(mysql_error());
		if($ins_qry_res)
		{
			return 1;
		}

	}
	function discount_list_function($result)
	{
		$qry = "SELECT * from  ".$this->table_name."_order_attributes  where order_id='".$result."'"  ;
		$discount = mysql_query($qry)or die(mysql_error());
		return $discount;

	}
	function menu_food_items_function($id,$start, $limit) {

	 $get_item=mysql_query("select * from  ".$this->table_name."_foods where foodcat_id = '$id' LIMIT $start, $limit") or die(mysql_error());
	 return $get_item;
	}
	function menu_food_items_function_maincat($id,$start, $limit,$main_cat=1) {
// echo "select * from  ".$this->table_name."_foods where food_type_id ='$main_cat' and  foodcat_id = '$id' LIMIT $start, $limit";
	 $get_item=mysql_query("select * from  ".$this->table_name."_foods where food_type_id ='$main_cat' and  foodcat_id = '$id' LIMIT $start, $limit") or die(mysql_error());
	 return $get_item;
	}
	function create_insert_admin_profile($admin_profile_table_id, $contact_person,
	$country, $state, $city, $price, $tax, $billing_cycle, $total, $salesperson_name,
	$salesperson_no, $status, $activation_date, $end_date) {
		$qry ="INSERT INTO admin_profile_price_details (admin_profile_table_id, contact_person,
		country, state, city, price, tax, billing_cycle, total, salesperson_name, 
		salesperson_no, status, activation_date, end_date,web_menu_options,tab_menu_options) VALUES 
		( '$admin_profile_table_id', '$contact_person', 
		'$country', '$state', '$city', '$price', '$tax', '$billing_cycle', '$total', '$salesperson_name', 
		'$salesperson_no', '$status', '$activation_date', '$end_date','','');";
		$id = mysql_query($qry)or die(mysql_error());

		if($id ){
			return mysql_insert_id();
		}
	}

	function insert_catering__cust_data($name,$type,$location,$email,$address,$land_mark,$mobile_num,
	$food_loc,$food_from,$food_to,$food_type,$food_plate_type,$food_image_path,$actual_price,
	$price_additional_charges, $price_deductions, $grand_total, $payment_mobile,$payment_status,$no_plates,$catering_type) {

		$qry = "INSERT INTO ".$this->table_name."_catering_cust (cust_id, name, type, location, email, address, land_mark, mobile_num, status) VALUES (NULL,'$name','$type','$location','$email','$address','$land_mark','$mobile_num','1')";
		$id = mysql_query($qry)or die(mysql_error());

		if($id ){
			$cust_caering_id = mysql_insert_id() ;
			$qry_food="INSERT INTO ".$this->table_name."_catering_food (id, food_loc, food_from, food_to, food_type, food_plate_type, food_image_path, status) VALUES (NULL,'$food_loc', '$food_from', '$food_to', '$food_type', '$food_plate_type', '$food_image_path', '1');";
			$food_resid = mysql_query($qry_food)or die(mysql_error());
			if($food_resid){
				$food_caering_id = mysql_insert_id() ;

		 	$qry_main_catering="INSERT INTO ".$this->table_name."_catering_main_table (id, catering_cust_id, catering_food_id, actual_price, price_additional_charges, price_deductions, grand_total, payment_mobile, status, no_plates,catering_type) VALUES (NULL, '$cust_caering_id', '$food_caering_id', '$actual_price', '$price_additional_charges', '$price_deductions', '$grand_total', '$payment_mobile', '$payment_status','$no_plates','$catering_type')";
		 	$qry_main_cateringid = mysql_query($qry_main_catering)or die(mysql_error());
		 	if($qry_main_cateringid)
		 	return mysql_insert_id();
			}
		}

	}
	function insert_tax_info($service_tax,$service_charge,$hotel_star) {
		$qry ="INSERT INTO ".$this->table_name."_tax_info (id, service_tax, service_charge, created_date, hotel_star, status) VALUES (NULL, '$service_tax', '$service_charge', date(now()), '$hotel_star', '1');";

		$resid = mysql_query($qry)or die(mysql_error());
		return $resid;
	}
	function get_tax_info($hotel_star = -1 ) {
		if($hotel_star == -1){
			$qry ="select * from ".$this->table_name."_tax_info order by id desc limit 1";
		
		}else{
			
		$qry ="select * from ".$this->table_name."_tax_info where hotel_star = $hotel_star  order by id desc limit 1";
		}

		$resid = mysql_query($qry)or die(mysql_error());
		return $resid;
	}
	function insert_store_settings($arr) {
		//	$qry_str_arr =array();
		//
		//	foreach ($arr as $key => $value){
		//		if(!$key == 'save_form')
		//		$qry_str_arr[]="(NULL, '$key', '$value', '1')";
		//	}
		//echo	$qry_str = implode(",", $qry_str_arr);
	 $qry="INSERT INTO ".$this->table_name."_store_settings (id, store_key, store_value, status) VALUES $arr;";
		$resid = mysql_query($qry);
		return $resid;

	}


	/////

	public function  get_All_Admin_data() {
		$res=mysql_query("SELECT * FROM  admin_profile_price_details a_price
		join profiles_table pt on 
		(a_price.admin_profile_table_id = pt.s_no and pt.category='ADMIN') ") or die(mysql_error());
		return $res;
	}


	public function  get_Admin_Screen_data() {
		$res=mysql_query("SELECT * FROM  home_screen_options") or die(mysql_error());
		return $res;
	}
public function  get_Admin_data_complete($admin_id) {
		$res=mysql_query("SELECT * FROM  admin_profile_price_details a_price
		join profiles_table pt on 
		(a_price.admin_id = '$admin_id' and   a_price.admin_profile_table_id = pt.s_no and pt.category='ADMIN' ) ") or die(mysql_error());
		return $res;
	}
	
public function  get_single_Admin_data($admin_id) {
		$res=mysql_query("SELECT status FROM  admin_profile_price_details a_price where	a_price.admin_id = $admin_id ") or die(mysql_error());
$res_arr = mysql_fetch_array($res);
		return $res_arr['status'];
	}
	public function update_admin_menu_options($admin_id,$menu_options,$menu_options_val) {
		$res=mysql_query("UPDATE admin_profile_price_details SET  ".$menu_options_val." = '$menu_options' where admin_id = '$admin_id'") or die(mysql_error());
		return $res;
	}

	function get_menu_options() {

	 	$qry = "select web_menu_options from admin_profile_price_details where admin_id = '$this->table_name'";
		$res=mysql_query($qry)or die(mysql_error());
		$menu_options = "";
		if($res){
			while ($res_arr = mysql_fetch_array($res)) {
				$menu_options = $res_arr['web_menu_options'];
			}
		}
		$menu_qry_res ="select * from home_screen_options where menu_item_id in ($menu_options) ";
		$res=mysql_query($menu_qry_res) or die(mysql_error());
		return $res;


	}
	function get_menu_options_single_admin($admin_id) {
$qry = "select web_menu_options from admin_profile_price_details where admin_id = '$admin_id'";
		$res=mysql_query($qry)or die(mysql_error());
		$menu_options = "";
		if($res){
			while ($res_arr = mysql_fetch_array($res)) {
				$menu_options = $res_arr['web_menu_options'];
			}
		}
		$opts_arr = explode(",",$menu_options);
		return $opts_arr;


	}
	
	function change_admin_status($admin_id,$status=0) {
		$qry = "UPDATE  `admin_profile_price_details` SET  `status` ='$status' WHERE  `admin_id` =  '$admin_id'";
		$res=mysql_query($qry);
		return  	$res;
	
	}
	function get_application_settings_options() {
		$qry = "SELECT * FROM   application_setting_options ";
		$res=mysql_query($qry);
		return  	$res;
	}
	function insert_application_settings_options($option_name) {
		$qry = "INSERT INTO  application_setting_options
		(option_id, option_name, option_status) VALUES (NULL, '$option_name', '');";
		$res=mysql_query($qry);
		return  	$res;
	}

	function insert_create_dynamic_price_date($main_cat,$sub_cat,$from_date,$to_date,$discount_per,
	$daytime_start,$daytime_end,$evngtime_start,$evngtime_end) {

		$qry ="INSERT INTO ".$this->table_name."_dynamicprice_date (id, main_cat, sub_cat, from_date, to_date, discount_per,
	daytime_start, daytime_end, evngtime_start, evngtime_end, status, created_date,entry_type,recurring) 
	VALUES (null,'$main_cat','$sub_cat','$from_date','$to_date','$discount_per',
	'$daytime_start','$daytime_end','$evngtime_start','$evngtime_end','1',now(),'date','');";
		$res=mysql_query($qry);
		return  	$res;
	}
	function insert_create_dynamic_price_days_wise($main_cat,$sub_cat,$day_value,$discount_per,
	$daytime_start,$daytime_end,$evngtime_start,$evngtime_end,$recurring) {

		$qry ="INSERT INTO ".$this->table_name."_dynamicprice_date (id, main_cat, sub_cat, day_value, discount_per,
	daytime_start, daytime_end, evngtime_start, evngtime_end, status, created_date,entry_type,recurring) 
	VALUES (null,'$main_cat','$sub_cat','$day_value','$discount_per',
	'$daytime_start','$daytime_end','$evngtime_start','$evngtime_end','1',now(),'day','$recurring');";
		$res=mysql_query($qry);
		return  $res;
	}



	function get_dynamic_price_data() {
		$qry = "select main_cat,group_concat(sub_cat) , discount_per from ".$this->table_name."_dynamicprice_date where date(now())
between from_date and to_date and ((time(now()) between daytime_start and daytime_end)
or (time(now()) between evngtime_start and evngtime_end )) and status =1  group by main_cat,discount_per";
		$res=mysql_query($qry);
		return  	$res;

	}


	function update_dynamic_price_val_foods() {

		$update_qry_frst = "UPDATE  ".$this->table_name."_foods SET price = ".$this->table_name."_foods.original_price, dynamic_per =0,modified_time = NOW() ";
		$res2=mysql_query($update_qry_frst);

		$qry = "select group_concat(id) as ids ,main_cat,group_concat(sub_cat) as sub_cat_vals , discount_per
	from ".$this->table_name."_dynamicprice_date where date(now()) 
between from_date and to_date and ((time(now()) between daytime_start and daytime_end)
or (time(now()) between evngtime_start and evngtime_end )) and status =1  group by main_cat,discount_per";
		$res1=mysql_query($qry);
		if (empty($res1) || mysql_num_rows($res1)<0) {
			$qry = "select group_concat(id) as ids ,main_cat,group_concat(sub_cat) as sub_cat_vals , discount_per
	from ".$this->table_name."_dynamicprice_date where  day_value = dayname(now()) and ((time(now()) between daytime_start and daytime_end)
or (time(now()) between evngtime_start and evngtime_end ))  and status =1  and entry_type = 'day'  group by main_cat,discount_per";
			$res1=mysql_query($qry);


		}
		if ($res1 && mysql_num_rows($res1)) {
			while ($res_arr_val = mysql_fetch_array($res1)) {
				$dynamic_per = $res_arr_val['discount_per'];
				$main_cat = $res_arr_val['main_cat'];
				$sub_cat_vals = $res_arr_val['sub_cat_vals'];
				$ids_vals = $res_arr_val['ids'];
				$update_day_status = "UPDATE ".$this->table_name."_dynamicprice_date SET status=0  WHERE id in ($ids_vals) and  recurring = 'no' and and entry_type = 'day'";
				$res=mysql_query($update_day_status);
				if($main_cat == 'All'){
					$update_qry = "UPDATE  ".$this->table_name."_foods SET  price = ".$this->table_name."_foods.original_price - ( ( $dynamic_per * ".$this->table_name."_foods.original_price ) /100 ) ,
 dynamic_per =$dynamic_per,modified_time = NOW() ";
					$res=mysql_query($update_qry);
					 
					break;
				}
				else{
					$update_qry = "UPDATE  ".$this->table_name."_foods SET  price = ".$this->table_name."_foods.original_price - ( ( $dynamic_per * ".$this->table_name."_foods.original_price ) /100 ) ,
 dynamic_per =$dynamic_per,modified_time = NOW() WHERE food_type_id = '$main_cat' and   foodcat_id IN ( $sub_cat_vals )";

				}
				$res=mysql_query($update_qry);
			}

		}


		//return  $res;


	}


	function get_user_login_details($user_name,$user_pwd,$user_level) {
		if ($user_level == "admin") {
			$qry ="SELECT * FROM  admin_profile_price_details a_price
		join profiles_table pt on 
		( pt.username='$user_name' and pt.password='$user_pwd' and a_price.admin_profile_table_id = pt.s_no and pt.category='ADMIN') ";
			$res=mysql_query(	$qry) or die(mysql_error());

		}
		else{
			$res=mysql_query("select s_no,category,username,branch_admin_id as admin_id from profiles_table where username = '$username' and password = '$password'") or die(mysql_error());

		}
		return $res;
	}

	function insert_cust_details($order_id,$cust_name,$mobile)
	{
		$qry = "INSERT INTO ".$this->table_name."_customers_table (id,order_id,cust_name,cust_phno) VALUES('','$order_id','$cust_name','$mobile')";
		$res=mysql_query($qry) or die(mysql_error());
		return $res;
	}
	function update_order_attrs_dis($dis,$id) {
		$qry ="update ".$this->table_name."_order_attributes set porter_discount='".$dis."' where order_id='".$id."'";
		$res=mysql_query($qry) or die(mysql_error());
		return $res;

	}
	function update_admin_discount($discount,$id){
		$qry = "update ".$this->table_name."_order_attributes set discount='".$discount."',porter_discount='".$discount."'
where order_id='".$id."'";
		$res=mysql_query($qry) or die(mysql_error());
		return $res;
	}


	function insert_campaign_data($name,$mobile_num, $email, $group_id){

	 	$qry = "INSERT INTO ".$this->table_name."_campaign_group_members
		(member_id, name, mobile_num, email, group_id, status ) VALUES 
		('','$name','$mobile_num','$email','$group_id','1' )";

		$res=mysql_query($qry) or die(mysql_error());
		return $res;





	}

	function update_discount($discount,$id) {


		$update_total_price=mysql_Query("update ".$this->table_name."_order_attributes set discount='".$discount."',porter_discount='".$discount."'
where order_id='".$id."'") or die(mysql_error());
		return $update_total_price;

	}
	function update_cust_delivery_address_details($cust_phno,$cust_mail_id,$delivery_address,$order_id) {

		$qry =  "UPDATE ".$this->table_name."_customers_table SET cust_phno='$cust_phno',
		cust_mail_id='$cust_mail_id',delivery_address = '$delivery_address' 
		WHERE order_id='$order_id'" ;
		$res = mysql_query($qry)or die(mysql_error());
	}

	function insert_buffet_data($buffet_cost,$buffet_data) {
		$date_time = date("Y-m-d h:m:i");
		$qry ="INSERT INTO ".$this->table_name."_buffet_data (b_no, buffet_cost,
		 buffet_data, created_at, status) VALUES (NULL, '$buffet_cost','$buffet_data','$date_time', '1');";	
		$res = mysql_query($qry)or die(mysql_error());
	}
	public function report_per_duration($col_name,$type,$table_name)
	{
		$grp_type = "";
		$select_type = "";
		$frst_col = "";
		$time_type = "";
		if(strtolower($type) == 'day')
		{
			$grp_type = 'hour';
			$select_type ="time";
			$frst_col = "hour";
			$time_type = 'day';
		}
		else if(strtolower($type) == 'week')
		{
			$grp_type = 'date';
			$select_type ="dayName";
			$time_type = 'week';
			$frst_col = "dayName";
		}else if(strtolower($type) == 'month')
		{
			$grp_type = 'date';
			$select_type ="day";
			$time_type = 'month';
			$frst_col = "day" ;
		}
		else
		{
			$grp_type = 'date';
			$select_type ="date";
		}
		$funct_type ="";
		$qry = "";
		$where_cond ="1";
		if($col_name == 'order_cost')
		{

			$funct_type ='sum';
			//$qry = "SELECT $frst_col(".$this->table_name."_order_details.time) as time_part,$select_type( DATE_FORMAT(  ".$this->table_name."_order_details.time ,'%Y-%m-%d %H:00:00' ) ) AS timeslice,
			// $funct_type($col_name) AS mycount
			//FROM  ".$this->table_name."_order_details WHERE date(time) > DATE_SUB( DATE(NOW()) , INTERVAL 1 $type ) and $time_type(".$this->table_name."_order_details.time) = $time_type(NOW()) GROUP BY $grp_type(time) DESC ";
			$where_cond="1";
		}
		else if($col_name == 'status')
		{

			$funct_type='count';
			//$where_cond="status= 'occupancy'";
			$where_cond=1;
			// $qry = "SELECT $frst_col(".$this->table_name."_order_details.time) as time_part,$select_type( DATE_FORMAT(  ".$this->table_name."_order_details.time ,'%Y-%m-%d %H:00:00' ) ) AS timeslice,
			// $funct_type($col_name) AS mycount
			//FROM  ".$this->table_name."_order_details WHERE status= 'occupancy' and date(time) > DATE_SUB( DATE(NOW()) , INTERVAL 1 $type ) and $time_type(".$this->table_name."_order_details.time) = $time_type(NOW()) GROUP BY $grp_type(time) DESC ";
		}
		if($table_name == "catering_main_table"){
			$col_name="grand_total";$funct_type ='sum';
				$where_cond="1";
		}
		 $qry = "SELECT $select_type( DATE_FORMAT(  ".$this->table_name."_".$table_name.".time ,'%Y-%m-%d %H:00:00' ) ) AS timeslice,
		$funct_type($col_name) AS mycount
FROM  ".$this->table_name."_".$table_name." WHERE date(time) > DATE_SUB( DATE(NOW()) , INTERVAL 1 $type ) and $time_type(".$this->table_name."_".$table_name.".time) = $time_type(NOW()) and $where_cond  GROUP BY $grp_type(time) DESC ";

		$res=mysql_query($qry) or die(mysql_error());
		return $res;
	}

	function get_buffet_data(){
		$qry ="SELECT * FROM ".$this->table_name."_buffet_data WHERE  status = 1 group by buffet_cost  order by b_no desc";


		$res=mysql_query($qry) or die(mysql_error());
		return $res;

	}
	function get_buffet_data_total(){
		$qry ="SELECT * FROM ".$this->table_name."_buffet_data WHERE  status = 1   order by b_no desc";


		$res=mysql_query($qry) or die(mysql_error());
		return $res;

	}
	//////05-03-2015
	function parcel_verification() {
		$qry ="SELECT o_items.food_id,sum(o_items.parcel_item_qty) as total_num_qty ,fds.price ,
	fds.food_name  FROM ".$this->table_name."_order_items  o_items join 
	".$this->table_name."_foods fds on (o_items.food_id=fds.id) 
	group by o_items.food_id";

		$res=mysql_query($qry) or die(mysql_error());
		return $res;

	}
	function order_status_discount($order_status_id) {
		$qry = "SELECT * FROM ".$this->table_name."_order_attributes  where order_id='".$order_status_id."'"  ;
		$discount = mysql_query($qry)or die(mysql_error());
		return $discount;
	}

	function update_order_status($order_id,$status) {
		$time = date("Y-m-d h:i:s");
		  $qry =  "UPDATE ".$this->table_name."_order_details SET status='$status',time='$time' WHERE id='$order_id'" ;
		  $res = mysql_query($qry)or die(mysql_error());
if($status == "Paid" || $status == "Cancel"){
	$update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='0',
table_status='Ready To Seat' WHERE status='$order_id'") or die(mysql_error());
		
}
		
		return $res ;

		 
	}
	function check_username_exists($username) {

		$res=mysql_query("select * from  profiles_table where username = '$username' ") or die(mysql_error());
		if(mysql_num_rows($res)>0){
			return 0 ;
			
		}
		else
		return 1;
	}

  function get_tables() {
       
       $res=mysql_query("SELECT DISTINCT GROUP_CONCAT(  id ) as id, GROUP_CONCAT(  table_no ) as table_no,
	   IF( STATUS =  '0',GROUP_CONCAT(  seating ) , SUM(  seating ) ) AS seating,  status,
	   GROUP_CONCAT(  table_status ) as table_status FROM  ".$this->table_name."_tables_table  GROUP BY STATUS 
	   ORDER BY id ASC;") or die(mysql_error());        return $res;
   }
 function get_tables_vacate($status=0) {
       
       $res=mysql_query("SELECT id, table_no,
	    seating  ,  status ,	    table_status FROM  ".$this->table_name."_tables_table where  STATUS  =  '$status'   ORDER BY id ASC;") or die(mysql_error());    
$result_arr  =array();		
		if($res){
			 while($res_arr = mysql_fetch_array($res)){
				$result_arr[]= $res_arr;
			 }
		 }
return $result_arr;
   }
     public function tables_insert($table_no,$seating,$status,$table_status) {
                    
        
        $ins=mysql_query("insert into ".$this->table_name."_tables_table values('','$table_no','$seating','$status','$table_status')") or die(mysql_error());
        
        if ($ins){
            return	mysql_insert_id();
		}else {
			return	-1;
		}    
    }
    
   
    
    public function get_alltables() {
        
        $res=mysql_query("SELECT * FROM ".$this->table_name."_tables_table") or die(mysql_error());        
        return $res;
    }
    
    
    public function tables_status_update($id,$status,$table_status) {

        $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='$status',table_status='$table_status' WHERE id='$id'") or die(mysql_error());
                 
        if ($update){				
            $update1=mysql_query("UPDATE ".$this->table_name."_reserve_tables SET time=now() WHERE id='$status'") or die(mysql_error());               
            return    mysql_insert_id();
        } else {
			return	-1;
		} 
        
    }  
    
    public function tablestatus_update($table_no,$table_status) {

		if($table_status=='Paid'){
			$update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='0',table_status='".table_status_free."' WHERE table_no='$table_no'") or die(mysql_error());
		}else{
			$update=mysql_query("UPDATE ".$this->table_name."_tables_table SET table_status='$table_status' WHERE table_no='$table_no'") or die(mysql_error());
		}
				 
        if ($update){    			             
            return   mysql_insert_id();
        } else {
			return	-1;
		} 
        
    }  

	
	
	
	
	}
	

// <?php
// include 'QUICK_ORDER/constants.php';

// class DB_Connect {
 

// protected $table_name;

// function __construct($tablename){
	
		// $this->table_name=  $tablename;
		
		 
		// $db=mysql_connect("localhost","quickorder","XIDoW6-hHCtK") or die("Could not Connect My Sql");
		// mysql_select_db("quickorder",$db)  or die("Could connect to Database");
	// }
 
    // function __destruct()    {
  
    // }
    // public function close() {
        	// mysql_close();
    // }
    
    //////////////////////
	
    // public function food_types($food_cat)  {
   
    
    // $ins=mysql_query("insert into ".$this->table_name."_food_type values('','$food_cat')") or die(mysql_error());
        // if($ins){
            // echo "inserted successfully" ;
		// }else {
			// echo mysql_error();
		// }
    
    // }
        
    // public function  get_food_types() {
        // $res=mysql_query("select * from ".$this->table_name."_food_type") or die(mysql_error());
        // return $res;
    // }
    
      //////////////////////
    
    // public function food_categories($name,$image)  {
   
    
    // $ins=mysql_query("insert into ".$this->table_name."_food_category values('','$name','$image')") or die(mysql_error());
        // if($ins){
        	// echo "inserted successfully" ;
		// }else {
			// echo mysql_error();
		// }
    
    // }
    
    // public function  get_food_categories() {
        // $res=mysql_query("select * from ".$this->table_name."_food_category") or die(mysql_error());
        // return $res;
    // }
    
    // public function get_food_categories_by_type($food_type_id) {
        // $res=mysql_query("select * from ".$this->table_name."_food_category where id in (select distinct foodcat_id from ".$this->table_name."_foods where food_type_id = '$food_type_id');") or die(mysql_error());
        // return $res;
    // }
        
          //////////////////////
          
    // public function food_insert($food_type_id,$foodcat_id,$food_name,$sub_title,$sub_categoryarray,$ingradiensarray,$description,$image,$video,$price) {
                    
// $date_val = date('Y-m-d');
        // $s =mysql_query("select max(id) from ".$this->table_name."_foods");
        // $arr=mysql_fetch_array($s);
        // $ref_code=$arr[0]+1;
        // $ins=mysql_query("insert into ".$this->table_name."_foods (`id`, `food_type_id`, `foodcat_id`, `food_name`, `sub_title`, `sub_category`, `ingradients`, `ref_code`, `description`, `image`, `video`, `price`, `original_price`, `dynamic_per`, `modified_time`, `status`) values('','$food_type_id','$foodcat_id','$food_name','$sub_title','$sub_categoryarray','$ingradiensarray','$ref_code','$description','$image','$video','$price','$price','0','$date_val',1)") or die(mysql_error());
        
        // if ($ins){
    		// return	mysql_insert_id();
		// }else {
			// return	-1;
		// }    
    // }
    
    // public function get_food_by_foodcatandtypeid($food_type_id,$foodcat_id) {
        
        // $res=mysql_query("select * from ".$this->table_name."_foods where food_type_id = '$food_type_id' and foodcat_id = '$foodcat_id'") or die(mysql_error());
        // return $res;
        
    // }
    
    // public function get_food_by_foodcat_id($foodcat_id) {
        
        
        // $res=mysql_query("select distinct ".$this->table_name."_foods.id,".$this->table_name."_foods.food_name from ".$this->table_name."_foods join ".$this->table_name."_order_items on (".$this->table_name."_foods.foodcat_id = '$foodcat_id' and ".$this->table_name."_foods.id=".$this->table_name."_order_items.food_id ) ") or die(mysql_error());
        // return $res;

        
    // }
    
    // public function get_all_foods() {
        
        // $res=mysql_query("select * from ".$this->table_name."_foods") or die(mysql_error());
        // return $res;
        
    // }
    
      //////////////////////
    
    // public function food_attributes_insert($food_id,$foodhidefrom,$foodhideto,$foodsession,$kitchen,$ordercopy,$date) {


		// $ins=mysql_query("insert into ".$this->table_name."_food_attributes values('','$food_id','$foodhidefrom','$foodhideto','$date','$foodsession','$kitchen','$ordercopy')") or die(mysql_error());

    	// if($ins){
        	// echo "inserted successfully" ;
		// }else {
			// echo mysql_error();
		// }
	// }    
    
     //////////////////////
    
    // public function insert_profiles($name,$username,$password,$category,$address,$phoneno,$mailid,$emergencyphno,$education,$idfroof,$photo,$date) {

// $table_val =$this->table_name;
		// $ins=mysql_query("INSERT INTO profiles_table VALUES ('','$name','$username','$password',
		// '$category','$address','$phoneno','$mailid','$emergencyphno','$education','$idfroof',
		// '$photo','$date','$table_val',1)") ;
	
        // if ($ins){
        	// return	mysql_insert_id();
		// }else {
			// return	-1;
		// }
	// }
    
    // public function insert_profile_attributes($profile_id,$emp_type,$agency_name,$agency_phno,$shift,$floor_no,$tablefrom,$tableto) {


    	// $ins=mysql_query("INSERT INTO profile_attributes_table VALUES ('','$profile_id','$emp_type','$agency_name','$agency_phno','$shift','$floor_no','$tablefrom','$fableto')") ;
	
        // if ($ins){
            // return	mysql_insert_id();
		// }else {
			// return	-1;
		// }
	// }
    
    // public function  get_login_profile($username,$password) {
        // $res=mysql_query("select s_no,category,username from profiles_table where username = '$username' and password = '$password'") or die(mysql_error());
        // return $res;
    // }
    
      //////////////////////
    
    // public function order_details_insert($porter_id,$order_cost,$order_qty,$noofpersons,$table_no,$delivery_status,$status,$time,$order_type) {
                    
        
        // $ins=mysql_query("insert into ".$this->table_name."_order_details values('','$porter_id','$order_cost','$noofpersons','$order_qty','$table_no','$delivery_status','$status','$time','$order_type')") or die(mysql_error());
        
        // if ($ins){
    		// return	mysql_insert_id();
		// }else {
			// return	-1;
		// }    
    // }
        // public  function oreder_remove($id) {
			
		// $q = "DELETE from  ".$this->table_name."_order_details WHERE id =  '$id'";
			
		// $ins=mysql_query($q) or die(mysql_error());
		// if ($ins){
			// return	1;
		// }else {
			// return	0;
		// }

	// }
    //////////////////////
        
    // public function order_items_insert($order_id,$food_id,$item_qty,$parcel_item_qty,$table_item_qty,$status) {
                    
        // $ins=mysql_query("insert into ".$this->table_name."_order_items values('','$order_id','$food_id','$item_qty','$parcel_item_qty','$table_item_qty','$status')") or die(mysql_error());
        
        // if ($ins){
    		// return	mysql_insert_id();
		// }else {
			// return	-1;
		// }    
    // }
    
    // public  function cancel_order($id) {
        
    	// $delete0=mysql_query("DELETE FROM  ".$this->table_name."_order_details WHERE  id =  '$id'") or die(mysql_error());
        
    	// if ($delete0){
                // $delete1=mysql_query("DELETE FROM  ".$this->table_name."_order_attributes WHERE  order_id =  '$id'") or die(mysql_error());
            // if ($delete1){
                    // $delete2=mysql_query("DELETE FROM  ".$this->table_name."_order_items WHERE  order_id =  '$id'") or die(mysql_error());
                // if ($delete2){
                    // return	3;
                // } else {
                	// return	0;
                // }   
                // return	2;
        	// } else {
        		// return	0;
        	// } 
    	    // return	1;
        // } else {
        	// return	0;
        // } 
	
    // }
    
    
    
    //////////////////////////
    
    // public function order_attributes_insert($starter_time,$maincourse_time,$order_id,$salt_level,$spicy_level,$remarks) {
                    
        // $ins=mysql_query("insert into ".$this->table_name."_order_attributes (id ,starter_time ,
    // maincourse_time,order_id ,salt_level ,spicy_level, remarks) values('','$starter_time','$maincourse_time','$order_id','$salt_level','$spicy_level','$remarks')") or die(mysql_error());
        
        // if ($ins){
        	// return	mysql_insert_id();
		// }else {
			// return	-1;
		// }    
    // }
    
    
    
    //////////////////////////
    
    // public function tables_insert($table_no,$seating,$status,$table_status) {
                    
        
        // $ins=mysql_query("insert into ".$this->table_name."_tables_table values('','$table_no','$seating','$status','$table_status')") or die(mysql_error());
        
        // if ($ins){
            // return	mysql_insert_id();
		// }else {
			// return	-1;
		// }    
    // }
    
    // public function get_tables() {
        
        // $res=mysql_query("SELECT DISTINCT GROUP_CONCAT(  id ) as id, GROUP_CONCAT(  table_no ) as table_no, IF( STATUS =  '0',GROUP_CONCAT(  seating ) , SUM(  seating ) ) AS seating,  status, GROUP_CONCAT(  table_status ) as table_status FROM  ".$this->table_name."_tables_table GROUP BY STATUS    ORDER BY id ASC;") or die(mysql_error());        return $res;
    // }
    
    // public function get_alltables() {
        
        // $res=mysql_query("SELECT * FROM ".$this->table_name."_tables_table") or die(mysql_error());        
        // return $res;
    // }
    
    
    // public function tables_status_update($id,$status,$table_status) {

        // $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='$status',table_status='$table_status' WHERE id='$id'") or die(mysql_error());
                 
        // if ($update){				
            // $update1=mysql_query("UPDATE ".$this->table_name."_reserve_tables SET time=now() WHERE id='$status'") or die(mysql_error());               
            // return    mysql_insert_id();
        // } else {
			// return	-1;
		// } 
        
    // }  
    
    // public function tablestatus_update($table_no,$table_status) {

		// if($table_status=='Paid'){
			// $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='0',table_status='".table_status_free."' WHERE table_no='$table_no'") or die(mysql_error());
		// }else{
			// $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET table_status='$table_status' WHERE table_no='$table_no'") or die(mysql_error());
		// }
				 
        // if ($update){    			          
            // return   mysql_insert_id();
        // } else {
			// return	-1;
		// } 
        
    // }  


    ///////////////////////
    
     
    // public function floors_insert($floor_no) {
                    
        
        // $ins=mysql_query("insert into ".$this->table_name."_floors_table values('','$floor_no')") or die(mysql_error());
        
        // if ($ins){
            // return    mysql_insert_id();
		// }else {
			// return	-1;
		// }    
    // }
    
    // public function get_floors() {
        
        // $res=mysql_query("select * from ".$this->table_name."_floors_table") or die(mysql_error());
        // return $res;
    // }
    
    ////////////////////////
    
    
    // public function get_all_order_details($sort_val) {
        
    	// $res=mysql_query("SELECT ".$this->table_name."_order_details.id as order_id,
		// ".$this->table_name."_order_details.order_type,porter_id,profiles_table.name as 
		// porter_name,order_cost,order_qty,noofpersons,table_no,delivery_status,".$this->table_name."_order_details.status, profiles_table.status as profile_status,time,
		// ".$this->table_name."_order_attributes.id as attr_id,starter_time,maincourse_time,
		// ".$this->table_name."_order_attributes.discount as discount,
		// ".$this->table_name."_order_attributes.porter_discount as porter_discount,
		// salt_level,spicy_level,remarks FROM ".$this->table_name."_order_details JOIN 
		// ".$this->table_name."_order_attributes ON 
		// ( ".$this->table_name."_order_details.id = ".$this->table_name."_order_attributes.order_id)  JOIN 
		// profiles_table ON ( ".$this->table_name."_order_details.porter_id = profiles_table.s_no) 
		// where ".$this->table_name."_order_details.order_type = '0' order by ".$this->table_name."_order_details.$sort_val;") or die(mysql_error());
    
    // return $res;

    // }
    
    // public function get_all_orders_by_porter($porter_id) {
        
        // $res=mysql_query("SELECT ".$this->table_name."_order_details.id AS order_id,".$this->table_name."_order_attributes.discount, 
		// ".$this->table_name."_order_attributes.porter_discount as porter_discount,
		// ".$this->table_name."_order_details.order_type, profiles_table.name as porter_name,".$this->table_name."_order_details.porter_id as porter_id,
		// order_cost, order_qty, noofpersons, ".$this->table_name."_tables_table.table_no, delivery_status,
		// ".$this->table_name."_tables_table.table_status as status, time, ".$this->table_name."_order_attributes.id AS attr_id, starter_time, 
		// maincourse_time, salt_level, spicy_level, remarks FROM  ".$this->table_name."_order_details JOIN ".$this->table_name."_order_attributes ON 
		// ( ".$this->table_name."_order_details.id = ".$this->table_name."_order_attributes.order_id )join ".$this->table_name."_tables_table on 
		// (".$this->table_name."_tables_table.table_no = ".$this->table_name."_order_details.table_no ) JOIN profiles_table ON 
		// ( ".$this->table_name."_order_details.porter_id = profiles_table.s_no AND porter_id =  '$porter_id' );") or die(mysql_error());
		// return $res;

    // }
    
    // public function get_order_items($order_id) {
        
    	// $res=mysql_query("SELECT ".$this->table_name."_order_details.order_type,
		// ".$this->table_name."_foods.food_name,".$this->table_name."_foods.image,
		// ".$this->table_name."_foods.price,".$this->table_name."_order_items.item_qty,
		// ".$this->table_name."_order_items.status,".$this->table_name."_order_items.id, 
		// ".$this->table_name."_order_items.parcel_item_qty, ".$this->table_name."_order_attributes.discount,
		// ".$this->table_name."_order_attributes.porter_discount as porter_discount,
		// ".$this->table_name."_order_items.table_item_qty, 
		// ".$this->table_name."_order_details.noofpersons,
		// ".$this->table_name."_order_details.time, ".$this->table_name."_order_details.table_no,
		// profiles_table.name,".$this->table_name."_order_attributes.starter_time,
		// ".$this->table_name."_order_attributes.starter_time,".$this->table_name."_foods.food_type_id,
		// ".$this->table_name."_foods.image,".$this->table_name."_foods.foodcat_id,".$this->table_name.
		// "_foods.sub_title,".$this->table_name."_foods.sub_category,
		// ".$this->table_name."_foods.ingradients,".$this->table_name."_foods.ref_code,
		// ".$this->table_name."_foods.description,".$this->table_name."_foods.video,
		// ".$this->table_name."_foods.original_price,".$this->table_name."_foods.dynamic_per,
		// ".$this->table_name."_foods.status as foodstatus FROM  ".$this->table_name."_order_items join 
		// ".$this->table_name."_order_details on (".$this->table_name."_order_items.order_id =  ".$this->table_name."_order_details.id and  ".$this->table_name."_order_items.order_id = '$order_id') join  ".$this->table_name."_foods on ( ".$this->table_name."_order_items.food_id = ".$this->table_name."_foods.id) join profiles_table on (profiles_table.s_no =  ".$this->table_name."_order_details.porter_id) join ".$this->table_name."_order_attributes on (".$this->table_name."_order_attributes.order_id = ".$this->table_name."_order_items.order_id);") or die(mysql_error());
		// return $res;
        
	// }
    // public function get_preorder_items($cust_phno) {
        
        // $res=mysql_query("SELECT ".$this->table_name."_order_details.id as order_id,".$this->table_name."_order_details.noofpersons,".$this->table_name."_order_attributes.salt_level,".$this->table_name."_order_attributes.remarks,".$this->table_name."_order_attributes.spicy_level,".$this->table_name."_customers_table.cust_name,".$this->table_name."_foods.price,".$this->table_name."_foods.image,".$this->table_name."_foods.food_name,".$this->table_name."_foods.id as food_id,".$this->table_name."_order_items.item_qty,".$this->table_name."_order_items.status,".$this->table_name."_order_items.id,".$this->table_name."_order_items.parcel_item_qty,".$this->table_name."_order_items.table_item_qty FROM ".$this->table_name."_order_items join ".$this->table_name."_order_details on (".$this->table_name."_order_items.order_id = ".$this->table_name."_order_details.id) join ".$this->table_name."_foods on (".$this->table_name."_order_items.food_id = ".$this->table_name."_foods.id) join ".$this->table_name."_customers_table on (".$this->table_name."_order_details.id = ".$this->table_name."_customers_table.order_id and ".$this->table_name."_customers_table.cust_phno = '$cust_phno' and ".$this->table_name."_order_details.order_type = '1') join ".$this->table_name."_order_attributes on(".$this->table_name."_order_details.id = ".$this->table_name."_order_attributes.order_id);") or die(mysql_error());
		// return $res;
            
    // }
	
	// public function preorder_customers_insert($order_id,$cust_name,$cust_phno) {
	
        // $ins=mysql_query("insert into ".$this->table_name."_customers_table (id,order_id,cust_name,cust_phno) values('','$order_id','$cust_name','$cust_phno');") ;
         
        // if ($ins){
            // return	mysql_insert_id();
		// }else {
			// return	-1;
		// }  
                   
    // }
    
    // public function preorder_items_update($item_qty,$parcel_item_qty,$table_item_qty,$order_id,$food_id) {

        // $update=mysql_query("UPDATE ".$this->table_name."_order_items SET item_qty='$item_qty',parcel_item_qty='$parcel_item_qty',table_item_qty='$table_item_qty' WHERE order_id='$order_id' and food_id ='$food_id'") or die(mysql_error());
                 
        // if ($update){
            // return    mysql_insert_id();
		// } else {
			// return	-1;
		// } 
        
    // }  
    
    // public  function order_item_remove($id) {
    	
    	// $delete=mysql_query("DELETE FROM  ".$this->table_name."_order_items WHERE  id =  '$id'") or die(mysql_error());
        
    	// if ($delete){
    		// return	1;
		// }else {
			// return	0;
		// } 
	
    // }
    
    
    // public function order_time_update($starter_time,$maincourse_time,$id) {
        

    	// $update=mysql_query("UPDATE ".$this->table_name."_order_attributes SET starter_time='$starter_time',maincourse_time='$maincourse_time' WHERE order_id='$id'") or die(mysql_error());
        
        // if ($update){
            // $res=mysql_query("UPDATE ".$this->table_name."_order_details SET status='preparing' WHERE id='$id'") or die(mysql_error());
         	// return	$res;
		// } else {
			// return	0;
		// } 
	
    // }
    
    
    // public function preorder_details_update($id,$porter_id,$noofpersons,$table_no,$time,$order_type,$salt_level,$spicy_level,$remarks,$order_cost,$order_qty) {
        
        // $update1=mysql_query("UPDATE ".$this->table_name."_order_details SET porter_id='$porter_id',noofpersons='$noofpersons',table_no='$table_no',time=now(),order_type='$order_type' WHERE id='$id'") or die(mysql_error());
        // if ($update1){
            // $update2=mysql_query("UPDATE ".$this->table_name."_order_attributes SET salt_level='$salt_level',spicy_level='$spicy_level',remarks='$remarks' WHERE order_id='$id'") or die(mysql_error());
                // if ($update2){
                     // $update3 = mysql_query("UPDATE ".$this->table_name."_order_details SET order_cost='$order_cost',order_qty='$order_qty',order_type='0' WHERE id='$id'") or die(mysql_error());          
                     // if ($update3){
						  // $update=mysql_query("UPDATE ".$this->table_name."_tables_table SET status='$id' WHERE table_no='$table_no'") or die(mysql_error());
							// if ($update){    			          
								// return    mysql_insert_id();
							// } else {
								// return	-4;
							// } 
						 // }else{
							// return   -3;
						 // }
                // }else{
                     // return   -2;
                // }
            // return    $update1;
		// } else {
			// return	-1;
		// } 
	
    // }
    
        
    // public function order_item_status_update($id,$status) {
        
        // $res=mysql_query("UPDATE ".$this->table_name."_order_items SET status='$status' WHERE id='$id'") or die(mysql_error());
        // return $res ;
        
    // }
    
    // public function get_order_details_by_foodid($food_id) {
        
        // $res = mysql_query("SELECT ".$this->table_name."_order_details.table_no,food_id,sum(parcel_item_qty) as parcel_qty,sum(table_item_qty) as table_qty FROM ".$this->table_name."_order_items join ".$this->table_name."_order_details on(".$this->table_name."_order_items.order_id=".$this->table_name."_order_details.id and ".$this->table_name."_order_items.food_id='$food_id') where ".$this->table_name."_order_details.order_type = '0' group by ".$this->table_name."_order_details.table_no , ".$this->table_name."_order_items.food_id") or die(mysql_error());
        // return $res ;
        
    // }
    
    
    // public function get_food_details_by_id($food_id) {
        
        // $res = mysql_query("SELECT * FROM ".$this->table_name."_foods WHERE id ='$food_id'");
        // return $res ;
    
    // }
   // public function sinkup_login($phoneno,$password) {
       
        // $result = mysql_query("SELECT * FROM sinkup_customers where phoneno = '$phoneno' and password = '$password'") or die(mysql_error());
		// return $result;
        
   // }
    
     
   // public function getorder_details_by_orderid($id) {
       
        // $result = mysql_query("SELECT ".$this->table_name."_order_details.id AS order_id, ".$this->table_name."_order_items.id AS item_id, ".$this->table_name."_order_items.item_qty,".$this->table_name."_foods.id AS food_id, ".$this->table_name."_foods.food_name, ".$this->table_name."_foods.price, sinkup_customers.id AS cust_id FROM  ".$this->table_name."_order_details JOIN ".$this->table_name."_order_items ON (".$this->table_name."_order_details.id = ".$this->table_name."_order_items.order_id ) JOIN ".$this->table_name."_foods ON (".$this->table_name."_order_items.food_id =".$this->table_name."_foods.id ) JOIN ".$this->table_name."_customers_table ON (".$this->table_name."_order_details.id = ".$this->table_name."_customers_table.order_id AND ".$this->table_name."_order_details.id ='$id' )  JOIN sinkup_customers ON (sinkup_customers.phoneno = ".$this->table_name."_customers_table.cust_phno);" ) or die(mysql_error());
    	// return $result;
        
   // }
   
   // public function check_phonenumber($phoneno){
       
        // $result = mysql_query("SELECT * FROM sinkup_customers where phoneno = '$phoneno'") or die(mysql_error());
		// return $result;
        
   // }
   
   // public function insert_splitdetails($cid,$name,$phoneno,$status,$order_id) {


		// $ins=mysql_query("INSERT INTO sinkup_splittable VALUES ('','$cid','$name','$phoneno','$status','$order_id')") ;
		// if($ins){
			// echo "inserted successfully" ;
		// }else {
			// echo mysql_error();
		// }
	// }
    
    // public function update_split_status($order_id,$phoneno,$status) {

        // $update=mysql_query("update sinkup_splittable set status='$status' where order_id='$order_id' and phoneno='$phoneno'") or die(mysql_error());
		// if($update){
			// echo "updated successfully";
		// }
		// else
		// echo mysql_error();
	// }
   
   
   // public function get_splitdetails($order_id){
       
        // $result = mysql_query("SELECT * FROM sinkup_splittable where order_id = '$order_id'") or die(mysql_error());
    	// return $result;
        
   // }
   
   // public function insert_customer($name,$phoneno,$password){


		// $ins=mysql_query("INSERT INTO sinkup_customers VALUES ('','$name','$phoneno','$password')") ;
		// if($ins){
			// echo "inserted successfully" ;
		// }else {
			// echo mysql_error();
		// }
	// }
    
    // public function insert_req($phoneno,$status)  {
   
    // $ins=mysql_query("insert into ".$this->table_name."_req_table values('','$phoneno','$status')") or die(mysql_error());
    
        // if($ins){
              // return mysql_insert_id();
		// }else {
			  // return  -1;
		// }
    
    // }
    
    // public function update_req($phoneno,$status)  {
   
     // $update=mysql_query("update ".$this->table_name."_req_table set status='$status' where phoneno='$phoneno'") or die(mysql_error());
    
     // if($update){
			// echo "updated successfully";
		// }
		// else
		// echo mysql_error();
    
    // }
    
    //////////////////////////////////////////////////////////
    
    // public function insert_notifications($table_no,$order_id,$status)  {
    
    // $ins=mysql_query("insert into ".$this->table_name."_notifications values('','$table_no','$order_id','$status')") or die(mysql_error());
    
        // if($ins){
              // return mysql_insert_id();
    	// }else {
			  // return  -1;
		// }
    
    // }
    
    
    // public function insert_notifications_data($notifications_id,$sender_cat,$description)  {
    
    // $ins=mysql_query("insert into ".$this->table_name."_notifications_data values('','$notifications_id','$sender_cat','$description',now())") or die(mysql_error());
    
        // if($ins){
              // return mysql_insert_id();
        // }else {
			  // return  -1;
		// }
    
    // }
    
   // public function get_notifications(){
        // $result = mysql_query("SELECT ".$this->table_name."_notifications.id,".$this->table_name."_notifications.table_no,".$this->table_name."_notifications.order_id,".$this->table_name."_notifications.status,".$this->table_name."_order_attributes.spicy_level,profiles_table.name as porter_name,".$this->table_name."_order_details.status,".$this->table_name."_order_details.delivery_status,".$this->table_name."_order_details.noofpersons,".$this->table_name."_order_details.time FROM ".$this->table_name."_notifications join ".$this->table_name."_order_attributes on (".$this->table_name."_notifications.order_id = ".$this->table_name."_order_attributes.order_id) join ".$this->table_name."_order_details on (".$this->table_name."_notifications.order_id = ".$this->table_name."_order_details.id) join profiles_table on (".$this->table_name."_order_details.porter_id = profiles_table.s_no);") or die(mysql_error());
        // return $result;
        
   // }
   
   // public function get_notifs_data_by_notifid($notifications_id){
       
        // $result = mysql_query("SELECT ".$this->table_name."_notifications_data.id,".$this->table_name."_notifications_data.notifications_id,".$this->table_name."_notifications_data.description,".$this->table_name."_notifications_data.time, profiles_table.name as sender_cat,profiles_table.category as sender_type FROM ".$this->table_name."_notifications_data join  profiles_table on (".$this->table_name."_notifications_data.sender_cat = profiles_table.s_no and ".$this->table_name."_notifications_data.notifications_id = '$notifications_id' ) ORDER BY time DESC;") or die(mysql_error());
        // return $result;
        
   // }
    
    ////////////////////////////////////////////////////
    
    
    // public function insert_tables_reserve($name,$phoneno,$noofpersons,$notif_status)  {
   
	// $ins=mysql_query("insert into ".$this->table_name."_reserve_tables values('','$name','$phoneno','$noofpersons',0,'$notif_status',now())") or die(mysql_error());
    
        // if($ins){
              // return mysql_insert_id();
        // }else {
    		  // return  -1;
		// }
    
    // }
    
   // public function get_reserve_tables(){
       
        // $result = mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,".$this->table_name."_reserve_tables.noofpersons,".$this->table_name."_reserve_tables.name,".$this->table_name."_reserve_tables.phoneno,".$this->table_name."_reserve_tables.time FROM ".$this->table_name."_reserve_tables join ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id in ( ".$this->table_name."_tables_table.status ));") or die(mysql_error());
        // return $result;
        
   // }      public function get_reserve_tables1(){               $result = mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,".$this->table_name."_reserve_tables.noofpersons,".$this->table_name."_reserve_tables.name,".$this->table_name."_reserve_tables.phoneno,".$this->table_name."_reserve_tables.time FROM ".$this->table_name."_reserve_tables join ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id not in (select ".$this->table_name."_tables_table.status from ".$this->table_name."_tables_table));") or die(mysql_error());        return $result;           }
    
   // public  function reserve_table_remove($id) {
        
    	// $delete=mysql_query("DELETE FROM ".$this->table_name."_reserve_tables WHERE  id =  '$id'") or die(mysql_error());
        
    	// if ($delete){
    		// return	1;
		// }else {
			// return	0;
		// } 
	
    // }
    
    // public function reserve_table_update($id,$name,$phoneno,$noofpersons) {

        // $update=mysql_query("UPDATE ".$this->table_name."_reserve_tables SET name='$name',phoneno='$phoneno',noofpersons='$noofpersons' WHERE id='$id'") or die(mysql_error());
                 
        // if ($update){
            // return    mysql_insert_id();
		// } else {
			// return	-1;
		// } 
        
    // }  
    
    // public function reserve_table_status_update($id,$notif_status) {

        // $update=mysql_query("UPDATE ".$this->table_name."_reserve_tables SET notif_status='$notif_status' WHERE id='$id'") or die(mysql_error());
                   
        // if ($update){
            // return    mysql_insert_id();
        // } else {
			// return	-1;
		// }         
    // }  
    // public function get_assigned_reservetables() {

        // $result=mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,".$this->table_name."_reserve_tables.noofpersons,".$this->table_name."_reserve_tables.name,".$this->table_name."_reserve_tables.notif_status,".$this->table_name."_reserve_tables.phoneno, TIMESTAMPDIFF(MINUTE, time , NOW( ) ) as time,group_concat(".$this->table_name."_tables_table.table_no separator '-') as assigned_tables FROM ".$this->table_name."_reserve_tables join ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id in ( ".$this->table_name."_tables_table.status ) and TIMESTAMPDIFF(MINUTE , time , NOW( ) ) < 10 ) group by ".$this->table_name."_reserve_tables.id ;") or die(mysql_error());
        // return $result;
        
    // } 
    // public function get_unassigned_reservetables() {

        // $result=mysql_query("SELECT distinct ".$this->table_name."_reserve_tables.id,".$this->table_name."_reserve_tables.noofpersons,".$this->table_name."_reserve_tables.name,".$this->table_name."_reserve_tables.notif_status,".$this->table_name."_reserve_tables.phoneno, TIMESTAMPDIFF(MINUTE, time , NOW( ) ) as time,group_concat(".$this->table_name."_tables_table.table_no separator '-') as assigned_tables FROM ".$this->table_name."_reserve_tables join ".$this->table_name."_tables_table on (".$this->table_name."_reserve_tables.id in ( ".$this->table_name."_tables_table.status ) and TIMESTAMPDIFF(MINUTE , time , NOW( ) ) > 10 ) group by ".$this->table_name."_reserve_tables.id ;") or die(mysql_error());
        // return $result;        
    // } 
	//04/12/2014
	
	// function get_porter_reports()
	// {
	  // $result=mysql_query("SELECT count(*) as count_order,status FROM ".$this->table_name."_order_details group by status ") or die(mysql_error());
        // return $result;  
	
	// }
	// function get_total_orders_count()
	// {
	  // $result=mysql_query("SELECT count(*) as total_orders FROM ".$this->table_name."_order_details ") or die(mysql_error());
	  // if($result)
	  // {
	  // $result_arr = mysql_fetch_array($result);

// $result_count = $result_arr['total_orders'];
// return $result_count ; 
	  // }
	  // else{
        // return -1; 
// }		
	// }
	
	// function get_order_count_per_fifteen_min()
	// {
	
	 // $qry = "SELECT time(FROM_UNIXTIME(floor(UNIX_TIMESTAMP(time)/1800)*1800)) AS timeslice
     // , COUNT(*) AS mycount
  // FROM ".$this->table_name."_order_details
 // WHERE date(time) = '2015-02-11' 
// GROUP 
    // BY timeslice";
	// $result = mysql_query($qry);
	// return $result  ;
	
	
	// }
	
	// function get_occupancy_count()
	// {
	// $qry ="SELECT time(DATE_FORMAT(".$this->table_name."_order_details.time,'%Y-%m-%d %H:00:00')) as timeslice, 

// count(".$this->table_name."_order_details.order_qty) as mycount
// FROM ".$this->table_name."_order_details 
// where date(time) = '2014-10-10' and status = 'occupancy'
// GROUP BY 
// round(UNIX_TIMESTAMP(".$this->table_name."_order_details.time) / 3600)
// ORDER BY ".$this->table_name."_order_details.time";

	// $result = mysql_query($qry);
	// return $result  ;


	// }
    // function get_total_num_tables()
    // {
	// $result=mysql_query("SELECT count(status) as total_tables  FROM ".$this->table_name."_tables_table WHERE 1 ") or die(mysql_error());
	  // if($result)
	  // {
	  // $result_arr = mysql_fetch_array($result);

// $result_count = $result_arr['total_tables'];
// return $result_count ; 
	  // }
	  // else{
        // return -1; 
// }		

      // }    
	  
	  // public function Insert_feedback_rating($name,$email,$phone,$birthday,$comments,$rating,$total_rating,$status)
// {

 
 // $insert="INSERT INTO ".$this->table_name."_feedback_rating(order_id, name, email, phone, birthday, comments, rating, total_rating, status)
// VALUES ('','$name','$email','$phone','$birthday','$comments','$rating','$total_rating','$status')";
// $res=mysql_query($insert) or die(mysql_error());
// return $res;
// }

// public function get_feedback_avg_latest()
// {
// $qry = "select avg(v1.total_rating) as feedback_rate from ".$this->table_name."_feedback_rating as v1   INNER JOIN (select id from ".$this->table_name."_feedback_rating order by id desc limit 5 )  as v2 on v1.id = v2.id";
// $res=mysql_query($qry) or die(mysql_error());
// $res_arr = mysql_fetch_array($res);
// if($res)
// { 
 // if(count($res_arr) >0 )
 // {
 // $feedback_rate = $res_arr['feedback_rate'];
 // }
 // else{
 // $feedback_rate = 0 ; 
 // }
// }
// else{
// $feedback_rate = 0 ; 
// }
// return $feedback_rate;
// }
// public function get_occpancy_avg_latest()
// {
// $qry="SELECT count(od.id)/5 as occupancy_rate FROM ".$this->table_name."_order_details as od inner join (select id from ".$this->table_name."_order_details order by id desc limit 5 ) as od2
// on od.id=od2.id and od.status = 'occupancy'";
// $res=mysql_query($qry) or die(mysql_error());
// $res_arr = mysql_fetch_array($res);
// if($res)
// { 
 // if(count($res_arr) >0 )
 // {
 // $occupancy_rate = $res_arr['occupancy_rate'];
 // }
 // else{
 // $occupancy_rate = 0 ; 
 // }
// }
// else{
// $occupancy_rate = 0 ; 
// }
// return $occupancy_rate;
// }
// public function report_per_duration($col_name,$type)
// {
// $grp_type = "";
// $select_type = "";
// $frst_col = "";
// $time_type = "";
// if(strtolower($type) == 'day')
// {
// $grp_type = 'hour';
// $select_type ="time";
// $frst_col = "hour";
// $time_type = 'day';
// }
// else if(strtolower($type) == 'week')
// {
// $grp_type = 'date';
// $select_type ="date";
// $time_type = 'week';
// $frst_col = "dayName";
// }else if(strtolower($type) == 'month')
// {
// $grp_type = 'date';
// $select_type ="date";
// $time_type = 'month';
// $frst_col = "day" ;
// }
// else
// {
// $grp_type = 'date';
// $select_type ="date";
// }
// $funct_type ="";
// $qry = "";
// $where_cond ="1";
// if($col_name == 'order_cost')
// {

// $funct_type ='sum';
// $where_cond="1";
// }
// else 
// {

// $funct_type='count';
// $where_cond="status= 'occupancy'";
// }

 // $qry = "SELECT max(order_cost) as max_cost, $frst_col(".$this->table_name."_order_details.time) as time_part,$select_type( DATE_FORMAT(  ".$this->table_name."_order_details.time ,'%Y-%m-%d %H:00:00' ) ) AS timeslice,
 // $funct_type($col_name) AS mycount
// FROM  ".$this->table_name."_order_details WHERE date(time) > DATE_SUB( DATE(NOW()) , INTERVAL 1 $type ) and $time_type(".$this->table_name."_order_details.time) = $time_type(NOW()) and $where_cond  GROUP BY $grp_type(time) DESC ";

// $res=mysql_query($qry) or die(mysql_error());
// return $res;
// }
		// function update_dynamic_price_val_foods() {

		// $update_qry_frst = "UPDATE  ".$this->table_name."_foods SET price = ".$this->table_name."_foods.original_price, dynamic_per =0,modified_time = NOW() ";
		// $res=mysql_query($update_qry_frst);

		// $qry = "select group_concat(id) as ids ,main_cat,group_concat(sub_cat) as sub_cat_vals , discount_per
			// from ".$this->table_name."_dynamicprice_date where date(now()) 
			// between from_date and to_date and ((time(now()) between daytime_start and daytime_end)
			// or (time(now()) between evngtime_start and evngtime_end )) and status =1  group by main_cat,discount_per";
		// $res1=mysql_query($qry);
		// if (empty($res1) || mysql_num_rows($res1)<0) {
			// $qry = "select group_concat(id) as ids ,main_cat,group_concat(sub_cat) as sub_cat_vals , discount_per
			// from ".$this->table_name."_dynamicprice_date where  day_value = dayname(now()) and ((time(now()) between daytime_start and daytime_end)
			// or (time(now()) between evngtime_start and evngtime_end ))  and status =1  and entry_type = 'day'  group by main_cat,discount_per";
			// $res1=mysql_query($qry);


		// }
		 
		// if ($res1 && mysql_num_rows($res1) >0) {
			// while ($res_arr_val = mysql_fetch_array($res1)) {
				// $dynamic_per = $res_arr_val['discount_per'];
				// $main_cat = $res_arr_val['main_cat'];
				// $sub_cat_vals = $res_arr_val['sub_cat_vals'];
				// $ids_vals = $res_arr_val['ids'];
				// $update_day_status = "UPDATE ".$this->table_name."_dynamicprice_date SET status=0  WHERE id in ($ids_vals) and  recurring = 'no' and and entry_type = 'day'";
				// $res=mysql_query($update_day_status);
				// if($main_cat == 'All'){
					// $update_qry = "UPDATE  ".$this->table_name."_foods SET  price = ".$this->table_name."_foods.original_price - ( ( $dynamic_per * ".$this->table_name."_foods.original_price ) /100 ) ,
					// dynamic_per =$dynamic_per,modified_time = NOW() ";
					// $res=mysql_query($update_qry);
				 
					// break;
				// }
				// else{
					// $update_qry = "UPDATE  ".$this->table_name."_foods SET  price = ".$this->table_name."_foods.original_price - ( ( $dynamic_per * ".$this->table_name."_foods.original_price ) /100 ) ,
					// dynamic_per =$dynamic_per,modified_time = NOW() WHERE food_type_id = '$main_cat' and   foodcat_id IN ( $sub_cat_vals )";

				// }
				// $res=mysql_query($update_qry);
			// }

		// }


		// return  $res;


	// }

	// function insert_create_dynamic_price_date($main_cat,$sub_cat,$from_date,$to_date,$discount_per,
	// $daytime_start,$daytime_end,$evngtime_start,$evngtime_end) {

		// $qry ="INSERT INTO ".$this->table_name."_dynamicprice_date (id, main_cat, sub_cat, from_date, to_date, discount_per,
	// daytime_start, daytime_end, evngtime_start, evngtime_end, status, created_date,entry_type,recurring) 
	// VALUES (null,'$main_cat','$sub_cat','$from_date','$to_date','$discount_per',
	// '$daytime_start','$daytime_end','$evngtime_start','$evngtime_end','1',now(),'date','');";
		// $res=mysql_query($qry);
		// return  	$res;
	// }
	
	// function insert_create_dynamic_price_days_wise($main_cat,$sub_cat,$day_value,$discount_per,
	// $daytime_start,$daytime_end,$evngtime_start,$evngtime_end,$recurring) {

	// echo $qry ="INSERT INTO ".$this->table_name."_dynamicprice_date (id, main_cat, sub_cat, day_value, discount_per, daytime_start, daytime_end, 
	// evngtime_start, evngtime_end, status, created_date,entry_type,recurring) VALUES (null,'$main_cat','$sub_cat',$day_value,'$discount_per',
	// '$daytime_start','$daytime_end','$evngtime_start','$evngtime_end','1',now(),'day','$recurring');";
		// $res=mysql_query($qry);
		// return  $res;
	// }
	
	// function insert_catering__cust_data($name,$type,$location,$email,$address,$land_mark,$mobile_num,
	// $food_loc,$food_from,$food_to,$food_type,$food_plate_type,$food_image_path,$actual_price,
	// $price_additional_charges, $price_deductions, $grand_total, $payment_mobile,$payment_status,$no_plates,$catering_type) {

		// $qry = "INSERT INTO ".$this->table_name."_catering_cust (cust_id, name, type, location, email, address, land_mark, mobile_num, status) VALUES (NULL,'$name','$type','$location','$email','$address','$land_mark','$mobile_num','1')";
		// $id = mysql_query($qry)or die(mysql_error());

		// if($id ){
			// $cust_caering_id = mysql_insert_id() ;
			// $qry_food="INSERT INTO ".$this->table_name."_catering_food (id, food_loc, food_from, food_to, food_type, food_plate_type, food_image_path, status) VALUES (NULL,'$food_loc', '$food_from', '$food_to', '$food_type', '$food_plate_type', '$food_image_path', '1');";
			// $food_resid = mysql_query($qry_food)or die(mysql_error());
			// if($food_resid){
				// $food_caering_id = mysql_insert_id() ;

		 	// $qry_main_catering="INSERT INTO ".$this->table_name."_catering_main_table (id, catering_cust_id, catering_food_id, actual_price, price_additional_charges, price_deductions, grand_total, payment_mobile, status, no_plates,catering_type) VALUES (NULL, '$cust_caering_id', '$food_caering_id', '$actual_price', '$price_additional_charges', '$price_deductions', '$grand_total', '$payment_mobile', '$payment_status','$no_plates','$catering_type')";
		 	// $qry_main_cateringid = mysql_query($qry_main_catering)or die(mysql_error());
		 	// if($qry_main_cateringid)
		 	// return mysql_insert_id();
			// }
		// }

	// }
	
	
	// function create_campaign_tablet($campaign_type,$image_path,$text, $transistion_time,$duration,
	// $from_time, $to_time) {

		
		// $ins_qry = "INSERT INTO ".$this->table_name."_campagin_tablet_data (campaign_type, image_path, text, transistion_time, duration, from_time,
		 // to_time, status) VALUES('$campaign_type', '$image_path', '$text', '$transistion_time', '$duration', '$from_time', '$to_time', 1)";
		// $ins_qry_res =  	mysql_query($ins_qry)or die(mysql_error());
		// if($ins_qry_res){
			// return 1;
		// }

	// }
	// function insert_store_settings($arr) {
	 // $qry="INSERT INTO ".$this->table_name."_store_settings (id, store_key, store_value, status) VALUES $arr;";
		// $resid = mysql_query($qry);
		// return $resid;

	// }

	
	    // function insert_tax_info($service_tax,$service_charge,$hotel_star) {
			// $qry ="INSERT INTO ".$this->table_name."_tax_info (id, service_tax, service_charge, created_date, hotel_star, status) VALUES (NULL, '$service_tax', '$service_charge', date(now()), '$hotel_star', '1');";
			// $resid = mysql_query($qry)or die(mysql_error());
			// return $resid;
		// }
		
		// function get_tax_info() {
			// $qry ="select * from ".$this->table_name."_tax_info ";
			// $resid = mysql_query($qry)or die(mysql_error());
			// return $resid;
		// }
	


		// public function get_order_status_graph($type)		{
			
			// $grp_type = "";
			// $select_type = "";
			// $frst_col = "";
			// $time_type = "";
			// if(strtolower($type) == 'day')		{
			// $grp_type = 'hour';
			// $select_type ="time";
			// $frst_col = "hour";
			// $time_type = 'day';
			// }		else if(strtolower($type) == 'week')		{
			// $grp_type = 'date';
			// $select_type ="date";
			// $time_type = 'week';
			// $frst_col = "dayName";
			// }else if(strtolower($type) == 'month')		{
			// $grp_type = 'date';
			// $select_type ="date";
			// $time_type = 'month';
			// $frst_col = "day" ;
			// }		else		{
			// $grp_type = 'date';
			// $select_type ="date";
			// }
			// $funct_type ="";
			// $qry = "";
			// $where_cond ="1";


			// $qry = "SELECT count(*) as count_order,status, $frst_col(".$this->table_name."_order_details.time) as time_part,$select_type( DATE_FORMAT(  ".$this->table_name."_order_details.time ,'%Y-%m-%d %H:00:00' ) ) AS timeslice

			// FROM  ".$this->table_name."_order_details WHERE date(time) > DATE_SUB( DATE(NOW()) , INTERVAL 1 $type ) and $time_type(".$this->table_name."_order_details.time) = $time_type(NOW())  GROUP BY status,$grp_type(time) DESC ";

			// $res=mysql_query($qry) or die(mysql_error());
			// return $res;
		// }
		
	// function update_discount_porter($discount,$id) {    
		
		 
		// $update_total_price=mysql_Query("update ".$this->table_name."_order_attributes set porter_discount='".$discount."' where order_id='".$id."'") or die(mysql_error());
		// return $update_total_price;
		
	// }
	
	// function update_discount_admin($id,$discount) {    
		
		// $update_total_price=mysql_Query("update ".$this->table_name."_order_attributes set discount='".$discount."' , porter_discount='".$discount."' where order_id='".$id."'") or die(mysql_error());
		// return $update_total_price;
		
	// }
	// function chat_insert($order_id,$table_no,$sender_type,$chat_desc) {

		// $selct_qry  =  "select * from  ".$this->table_name."_notifications where table_no ='$table_no' and order_id ='$order_id'" ;
		// $select_res = mysql_query($selct_qry);
		// $notification_parent = '' ;
		// if (mysql_num_rows($select_res)>0) {
			// $select_res_vals = mysql_fetch_array($select_res);
			// $notification_parent = $select_res_vals['id'];
		// }else{

			// $ins_qry  ="INSERT INTO ".$this->table_name."_notifications (id, table_no, order_id, status) VALUES ('', '$table_no','$order_id', 'pending')";
			// $res = mysql_query($ins_qry)or die(mysql_error());
			// $notification_parent = mysql_insert_id();
		// }
		
		// if (!empty($notification_parent)){

			// $qry  = "INSERT INTO ".$this->table_name."_notifications_data (id, notifications_id, sender_cat, description, time) VALUES (NULL, '$notification_parent', '$sender_type', '$chat_desc', now());";
			// $res1 = mysql_query($qry)or die(mysql_error());

			// if ($res1) {
				// return mysql_insert_id();
			// }
			// else{
				// return -1;
			// }

		// }else{
			// return -1;
		// }

	// }
	
		// function get_buffet_data(){
		// $qry ="SELECT * FROM ".$this->table_name."_buffet_data WHERE  status = 1 group by buffet_cost  order by b_no desc";


		// $res=mysql_query($qry) or die(mysql_error());
		// return $res;

	// }
	// function get_buffet_data_total(){
		// $qry ="SELECT * FROM ".$this->table_name."_buffet_data WHERE  status = 1   order by b_no desc";


		// $res=mysql_query($qry) or die(mysql_error());
		// return $res;

	// }
	// function create_campaign_group($group_name, $message,$type) {
			
		// $ins_qry = "INSERT INTO ".$this->table_name."_campaign_groups ( group_name, message,type,status) VALUES
// ('$group_name', '$message','$type', 1)";
		// $ins_qry_res =  	mysql_query($ins_qry)or die(mysql_error());
		// if($ins_qry_res)
		// {
			// return 1;
		// }
		// else {
			// return -1 ;
		// }

			
			
	// }

	// function create_ins_group_member($name, $mobile_num, $email, $group_id,$type) {
	
		
		// $ins_qry = "INSERT INTO ".$this->table_name."_campaign_group_members (name, mobile_num, email, group_id,status) VALUES ('$name', '$mobile_num', '$email', $group_id,'$type', 1),
      	// ";
		// $ins_qry_res =  	mysql_query($ins_qry)or die(mysql_error());
		// if($ins_qry_res)
		// {
			// return 1;
		// }

	// }
	// function get_all_groups($type) {
		// $sel_qry = "SELECT * from  ".$this->table_name."_campaign_groups where type  like '%$type%' ";
		// $ins_qry_res =  	mysql_query($sel_qry)or die(mysql_error());
		// if($ins_qry_res)
		// {
			// return $ins_qry_res ;
		// }
	// }

	// function get_campaing_group_members($group_id) {
		
		// $sel_grp_qry ="SELECT * from  ".$this->table_name."_campaign_group_members WHERE  group_id ='$group_id'";
		// $sel_grp_qry_res =  mysql_query($sel_grp_qry)or die(mysql_error());
		// if($sel_grp_qry_res)
		// {
			// return $sel_grp_qry_res ;
		// }


	// }
	
	// function update_cust_delivery_address_details($cust_mail_id,$delivery_address,$order_id) {

		// $qry =  "UPDATE ".$this->table_name."_customers_table SET cust_mail_id='$cust_mail_id',delivery_address = '$delivery_address' WHERE order_id='$order_id'" ;
		// $res = mysql_query($qry)or die(mysql_error());
		// return $res;
	// }

// }
// $cn = new DB_Connect($_REQUEST['tablename']);