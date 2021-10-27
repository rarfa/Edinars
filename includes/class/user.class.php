<?php

//class

class user{

	public $infos;

	public $loged = false;

	private $errors;

	public function __construct(){
		//list of errors
		$this->get_errors_list();

	}

	public function get_session(){
		// loged ?
		if($_SESSION['user_id']==""){
			$this->loged = false;
		}else{
			$this->loged = true;
			$this->infos['id'] = $_SESSION['user_id'];

			$this->get_infos();
		}
	}

	private function get_errors_list(){
		global $lang;
		//list of errors
		$this->erreurs[1] = "Some of your info isn't correct. Please try again.";//
		$this->erreurs[2] = "Your account has been blocked!";//
	}

	public function get_infos(){
		global $db_c;
		$sql = db_query("SELECT *
							FROM  `users`
							WHERE  `id` = '".$this->infos['id']."'
							LIMIT 1");

		$num = mysql_num_rows($sql);
		$this->infos = mysql_fetch_array($sql);
	}

	public function update_session(){
		global $db_c;
		$sql_update = db_query("UPDATE `user_sessions`
								SET activite_time = NOW( ) ,
								nb_actions = nb_actions+1,
								page_actuel = '".$page_actuel."',
								adresse_ip = '".$_SERVER["REMOTE_ADDR"]."'
								WHERE `user_sessions`.`id` = '".$_SESSION['user_session_id']."'
								LIMIT 1 ;");
	}

	public function logout(){
		$_SESSION['user_id']="";
		$_SESSION['user_session_id'] = "";
		$this->loged = false;
	}

	public function is_logged(){
		return $this->loged = false;
	}

	public function identification($username, $password){
		global $db_c;
		$sql = mysql_query("SELECT *
											FROM `dp_members`
											WHERE (`username` = '".$username."'
											AND MD5(`password`) = '".$password."')

											OR

											(`email` = '".$username."'
											AND MD5(`password`) = '".$password."' )
											LIMIT 1 ");
		echo nl2br("SELECT *
											FROM `dp_members`
											WHERE (`username` = '".$username."'
											AND MD5(`password`) = '".$password."')

											OR

											(`email` = '".$username."'
											AND MD5(`password`) = '".$password."' )
											LIMIT 1 ");

		$num = mysql_num_rows($sql);
		$res = mysql_fetch_array($sql);
		mysql_free_result($sql);//libérer la mémoire


		if($num==0){ // si il n'existe pas
			$err_identification = $this->erreurs[1];
			$_SESSION['user_id'] = "";
			// echo $num.'ranihana';
			//if($site_config['test_server']) echo "erreur : ".$errors[1]."<br />";
		}

		elseif($num>0 && $res['active']!="yes"){ // si il existe mais activation = faux
			$_SESSION['user_id'] = "";
			$err_identification = $this->erreurs[2];
			//if($site_config['test_server']) echo "erreur : ".$errors[3]."<br />";
		}

		else{
			//ouvrir la session
			$_SESSION['user_id'] = $res['mem_id'];
			$this->loged = true;

			// $sql_connexion = db_query("INSERT INTO `user_sessions` (
			// 											`id` ,
			// 											`user_id` ,
			// 											`start_time` ,
			// 											`activite_time` ,
			// 											`nb_actions` ,
			// 											`system` ,
			// 											`loading_time`
			// 											)
			// 											VALUES (
			// 											NULL ,
			// 											'".$res['id']."',
			// 											NOW( ) ,
			// 											NOW( ) ,
			// 											'0',
			// 											'web',
			// 											'0'
			// 											);");
			// $user_session_id = mysql_insert_id();
			// $_SESSION['user_session_id'] = $user_session_id;
		}

		if($this->loged == false){
			return $err_identification;
		}else{
			return "yes";
		}

	}

	public function create_new_user($userinfos){
		// Add new user
		global $db_c;
		$return = array(
										'success'=>'yes' );
		//add to db
		$sql_insert = db_query("INSERT INTO `users` (
																	`id` ,
																	`username` ,
																	`email`,
																	`password`,
																	`registration_date`
																	)
																	VALUES (
																	NULL ,
																	'".$userinfos['username']."',
																	'".$userinfos['email']."',
																	'".$userinfos['password']."',
																	NOW()
																	);");
		if($sql_insert){
			$user_id = mysql_insert_id();

			$return["user_id"] = $user_id;


		}else{
			$return["success"]="no";
			$return["error"]="Error in database!";
		}
		// return insert id (user_id)
		return $return;
	}



	public function activation($code_activation){
		global $db_c;
		$sql = db_query(" SELECT id FROM `users`
																				WHERE MD5(`id`) LIKE '".$code_activation."'
																				LIMIT 1");
		$num = mysql_num_rows($sql);


		if($num>0){
			$res = mysql_fetch_array($sql);
			$this->infos = $res;
			$this->get_infos();

			$sql_activate = db_query(" UPDATE `users` SET  `email_active` =  'yes'
																			WHERE  `users`.`id` ='".$this->infos['id']."';");

			return true;
		}else{
			return false;
		}
	}

	/* Statics*/

	public static function exist_username($username){
		global $db_c;

		$num = mysql_num_rows(db_query(" SELECT * FROM `users`
																				WHERE `username` LIKE '".$username."'
																				LIMIT 1"));
		if($num>0){
			return true;
		}else{
			return false;
		}
	}

	public static function exist_email($email){
		global $db_c;

		$num = mysql_num_rows(db_query(" SELECT * FROM `users`
																				WHERE `email` LIKE '".$email."'
																				LIMIT 1"));
		if($num>0){
			return true;
		}else{
			return false;
		}
	}

	public static function format_email($email){
		if (preg_match('#^([a-z0-9%`=~&\'\_\.\-\+\!\$\*\?\^\{\}\/\|]+)\@([a-z0-9\.\-]+)\.[a-z]{2,6}$#iuU', strtolower($email))) {
			return true;
		}else{
			return false;
		}
	}

}

?>
