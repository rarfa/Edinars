<?php
#################################################################################
# PROGRAM     : EDINAR APPLICATION                                             	#
# VERSION     : 0.01                                                          	#
# AUTHOR      : Arfa Abderrahim                                               	#
# COMPANY     : HOSTDZ	                                             			#
# COPYRIGHTS  : (C) HOSTDZ. ALL RIGHTS RESERVED                    				#
#         COPYRIGHTS BY (C)2011 HOSTDZ. ALL RIGHTS RESERVDED  	  				#
###############################################################################
#               	     DEVELOPED BY HOSTDZ             `		        		#
###############################################################################
#    ALL SOURCE CODE, IMAGES, PROGRAMS, FILES INCLUDED IN THIS DISTRIBUTION   	#
#         COPYRIGHTS BY (C)2012 HOSTDZ. ALL RIGHTS RESERVDED  	      			#
###############################################################################
#       ANY REDISTRIBUTION WITHOUT PERMISSION OF HOSTDZ AND IS          		#
#                            STRICTLY FORBIDDEN                                 #
###############################################################################
#         COPYRIGHTS BY (C)2012 HOSTDZ. ALL RIGHTS RESERVDED  	      			#
###############################################################################


###############################################################################

// error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
if(function_exists('set_magic_quotes_runtime')) set_magic_quotes_runtime(0);

if(!ini_get('safe_mode'))set_time_limit(3600);

ignore_user_abort(true);

###############################################################################

$data['PostSent']=false;

$data['ScriptLoaded']=true;

if (!$_COOKIE["ln"]){

  $data['lang_ch']=$data['DefaultLanguage'];

  setcookie("ln", $data['lang_ch']);

}

$data['lang_ch'] = $_COOKIE["ln"];

###############################################################################

$data['Path']=dirname(__FILE__);

//if($_SERVER["HTTPS"]=='on')$data['Prot']='https'; else $data['Prot']='http';
//$data['Prot']='http'; // Locahost
$data['Prot']='https'; // Live system

$data['Templates']="{$data['Path']}/templates";
$data['BannersPath']="{$data['Path']}/images/banners";
$data['SinBtnsPath']="{$data['Path']}/images/buttons/single";
$data['DonBtnsPath']="{$data['Path']}/images/buttons/donations";
$data['SubBtnsPath']="{$data['Path']}/images/buttons/subscriptions";
$data['ShopBtnsPath']="{$data['Path']}/images/buttons/shopcart";

if($data['Folder'])$data['Folder']="/{$data['Folder']}";

$data['Addr']="{$_SERVER['REMOTE_ADDR']}";
$data['Host']="{$data['Prot']}://{$_SERVER['HTTP_HOST']}{$data['Folder']}";
$data['Images']="{$data['Host']}/images";
$data['Banners']="{$data['Images']}/banners";
$data['SinBtns']="{$data['Images']}/buttons/single";
$data['DonBtns']="{$data['Images']}/buttons/donations";
$data['SubBtns']="{$data['Images']}/buttons/subscriptions";
$data['ShopBtns']="{$data['Images']}/buttons/shopcart";
$data['Admins']="{$data['Host']}/online";
$data['Members']="{$data['Host']}/secure";
$data['Home']="Location:{$data['Host']}/acceuil-Edinars.html";
$data['DbPrefix']="{$data['DbPrefix']}_";

#################################### Audit ###########################################

function audit($subject, $body, $objtable , $objid,$user){
	global $data;
	    db_query(
		"INSERT INTO `{$data['DbPrefix']}audit`".
		"(`aud_subject`,`aud_body`,`aud_date`,`aud_obj_table`, `aud_obj_id` , `aud_user`)VALUES ".
		"('".addslashes($subject)."','".addslashes($body)."' , NOW(),'{$objtable}',{$objid},'{$user}')");

}


#################################### notifications ###########################################

function get_user_notifications($user_id, $view='', $type=''){

	global $data;

  $sql = "SELECT `{$data['DbPrefix']}notifications`.*, `{$data['DbPrefix']}transactions`.type as transaction_type".
          ", `{$data['DbPrefix']}transactions`.comments as transaction_comments ".
          " FROM `{$data['DbPrefix']}notifications`".
          " LEFT JOIN {$data['DbPrefix']}transactions ON ({$data['DbPrefix']}transactions.id = {$data['DbPrefix']}notifications.transaction_id) ".
          " WHERE `member_id`='{$user_id}' ".
          ($type? " AND `type`='{$type}'" : '').
          ($view? " AND `view`='{$view}'" : ' AND `hide_in_list` = \'no\' ').
          " Limit 30";

  $notifications=db_rows($sql);
  // prnuser

  foreach ($notifications as $key => $value) {
    $notifications[$key]["sender"] = prnuser($notifications[$key]["sender"]);
    if($notifications[$key]["type"]=="transaction") $notifications[$key]["message"] = $notifications[$key]["transaction_comments"];

    $notifications[$key]["_message"] = strip_tags(str_replace("</p>","\r\n", $notifications[$key]["message"]));
  }
  //echo nl2br($sql);

  return $notifications;

}

function set_notification_viewed($user_id,$notification_id, $transaction_id = null ){
  global $data;

  $sql =  "UPDATE `{$data['DbPrefix']}notifications` "."\r\n".
          "SET `view` = 'yes' "."\r\n".
          "WHERE `{$data['DbPrefix']}notifications`.`member_id` = '".$user_id."' "."\r\n";

  if(is_null($transaction_id)){
    $sql .= "AND `{$data['DbPrefix']}notifications`.`id` = '".$notification_id."' "."\r\n";
  }else{
    $sql .= "AND `{$data['DbPrefix']}notifications`.`transaction_id` = '".$transaction_id."' "."\r\n";
  }

  $update = db_query($sql);
  // echo nl2br($sql);
  return $update;
}



#################################### Product ###########################################
function select_products($uid, $type=0, $id=0, $single=false){

	global $data;

	$products=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}products`".

		" WHERE `owner`={$uid} AND `type`={$type}".

		($id?" AND `id`={$id}":'').($single?" LIMIT 1":'')

	);

	$result=array();

	foreach($products as $key=>$value){

		foreach($value as $name=>$v){
        $result[$key][$name]=$v;
    }
    $result[$key]['vendu'] = prnsumm($result[$key]['prix'] * $result[$key]['sold']);
	}

	return $result;

}

function delete_product($id){

	global $data;

	$rows=db_rows(

		"SELECT `member`".

		" FROM `{$data['DbPrefix']}subscriptions`".

		" WHERE `product`={$id}"

	);

	$members=array();

	foreach($rows as $key=>$value){

		$row=get_member_info($value['member']);

		$members[$key]['username']=$row['username'];

		$members[$key]['fullname']="{$row['fname']} {$row['lname']}";

	}

	db_query(

		"DELETE FROM `{$data['DbPrefix']}subscriptions`".

		" WHERE `product`={$id}"

	);

	$rows=db_rows(

		"SELECT `name` FROM `{$data['DbPrefix']}products`".

		" WHERE `id`={$id}"

	);

	$product=$rows[0]['name'];

	$delete = db_query(

		"DELETE FROM `{$data['DbPrefix']}products` WHERE `id`={$id}"

	);

	foreach($members as $key=>$value){

		$post['username']=$value['username'];

		$post['fullname']=$value['fullname'];

		$post['product']=$product;

		send_email('OWNER-CANCELLED-SUBSCRIPTION', $post);

	}

  return $delete;
}


function insert_product($uid, $type, $post){

	global $data;

	$insert = db_query(
		"INSERT INTO `{$data['DbPrefix']}products`(".
		"`type`,`owner`,`prix`,`periode`,`installation`,`essai`,`tva`,`livraison`,".
		"`button`,`nom`,`ureturn`,`unotify`,`ucancel`,`comments`".
		")VALUES(".
		"{$type},{$uid},{$post['prix']},".
		($post['periode']?"{$post['periode']},":'0,').
		($post['installation']?"{$post['installation']},":'0.00,').
		($post['essai']?"{$post['essai']},":'0.00,').
		($post['tva']?"{$post['tva']},":'0.00,').
		($post['livraison']?"{$post['livraison']},":'0.00,').
		"'{$post['button']}','{$post['nom']}','{$post['ureturn']}',".
		"'{$post['unotify']}','{$post['ucancel']}','".
		addslashes($post['comments'])."')"
	);

  return $insert;

}

function insert_notification($array_infos){

	global $data;
  $sql = "INSERT INTO `{$data['DbPrefix']}notifications` ";

  $sql_keys  = "(";
  $sql_value  = "VALUES(";

  foreach ($array_infos as $key => $value) {
    # code...
    $sql_keys .= '`'.$key.'`, ';
    $sql_value .= "'".$value."', ";
  }

  $sql_keys = substr($sql_keys, 0, strlen($sql_keys)-2);
  $sql_value = substr($sql_value, 0, strlen($sql_value)-2);

  $sql_value .= ")";
  $sql_keys .= ")";

  $insert = db_query($sql.$sql_keys.$sql_value);
  // $insert = db_query(
	// 	"INSERT INTO `{$data['DbPrefix']}products`(".
	// 	"`type`,`owner`,`prix`,`periode`,`installation`,`essai`,`tva`,`livraison`,".
	// 	"`button`,`nom`,`ureturn`,`unotify`,`ucancel`,`comments`".
	// 	")VALUES(".
	// 	"{$type},{$uid},{$post['prix']},".
	// 	($post['periode']?"{$post['periode']},":'0,').
	// 	($post['installation']?"{$post['installation']},":'0.00,').
	// 	($post['essai']?"{$post['essai']},":'0.00,').
	// 	($post['tva']?"{$post['tva']},":'0.00,').
	// 	($post['livraison']?"{$post['livraison']},":'0.00,').
	// 	"'{$post['button']}','{$post['nom']}','{$post['ureturn']}',".
	// 	"'{$post['unotify']}','{$post['ucancel']}','".
	// 	addslashes($post['comments'])."')"
	// );

  return $insert;

}

function update_product($id, $post){

	global $data;

	$update = db_query(

		"UPDATE `{$data['DbPrefix']}products` SET ".

		"`prix`={$post['prix']},".

		"`periode`=".($post['periode']?"{$post['periode']},":'0,').

		"`installation`=".($post['installation']?"{$post['installation']},":'0.00,').

		"`essai`=".($post['essai']?"{$post['essai']},":'0.00,').

		"`tva`=".($post['tva']?"{$post['tva']},":'0.00,').

		"`livraison`=".($post['livraison']?"{$post['livraison']},":'0.00,').

		"`button`='{$post['button']}',`nom`='{$post['nom']}',".

		"`ureturn`='{$post['ureturn']}',`unotify`='{$post['unotify']}',".

		"`ucancel`='{$post['ucancel']}',`comments`='".addslashes($post['comments'])."'".

		" WHERE `id`={$id}"

	);
  return $update;

}

###############################################################################

function get_post(){

	global $_POST;

	$result=array();

	foreach($_POST as $key=>$value)$result[$key]=$value;

	reset($_POST);

	return $result;

}

###############################################################################

function protect($buffer){

	global $data, $_SERVER, $_SESSION;

	if($data['ProtectHtml']&&$_SESSION['login'])return encrypt_pages($buffer);

	else return $buffer;

}



function prepare($buffer){

	return protect($buffer);

}



function show($template){

	global $data, $post;

	//echo $template;

	if(file_exists($template))include($template);

	else echo("Template \"{$template}\" not found!");

}



function display($path=''){

	global $data;

	ob_start("prepare");

	if($path){
		$path="/{$path}";
		}

	if (!$data['lang_ch']){
		$data['lang_ch']=$data['DefaultLanguage'];
   }

	if ($path == "" ){$path="/langs/{$data['lang_ch']}".$path;}
	if ($path == "/secure" ){$path="/langs/{$data['lang_ch']}".$path;}
	if ($data['PageFile'] == 'process')  {
	    show("{$data['Templates']}{$path}/template.header.process.php");
		show("{$data['Templates']}{$path}/template.{$data['PageFile']}.php");
		//show("{$data['Templates']}{$path}/template.footer.process.php");
	} else {
		show("{$data['Templates']}{$path}/template.header.php");
		show("{$data['Templates']}{$path}/template.{$data['PageFile']}.php");
		show("{$data['Templates']}{$path}/template.footer.php");
	}
	ob_end_flush();

}



function showpage($template){

	global $data;

	ob_start("prepare");

	show("{$data['Templates']}/{$template}");

	ob_end_flush();

}



function showmenu($mode, $path=''){

	global $data;

	$data['mode']=$mode;

	if($path)$path="/{$path}";

	if (!$data['lang_ch']){

		$data['lang_ch']=$data['DefaultLanguage'];

	}

	if ($path != "/admins"){$path="/langs/{$data['lang_ch']}".$path;}

	show("{$data['Templates']}{$path}/template.menu.htm");



}

function showbanner(){

	global $data;

	show("{$data['Templates']}/template.banners.htm");

}


function showbar($mode, $path=''){

	global $data;

	$data['mode']=$mode;

	if($path)$path="/{$path}";

	if (!$data['lang_ch']){

		$data['lang_ch']=$data['DefaultLanguage'];

	}

	if ($path != "/admins"){$path="/langs/{$data['lang_ch']}".$path;}

	show("{$data['Templates']}{$path}/template.menu.htm");



}
###############################################################################

$data['cid']=null;



function show_menu_langs(){

	global $data;


	$langs_dir_obj = dir($data['Templates']."/langs/");
	while($entry = $langs_dir_obj->read()){

     if ($entry != "." && $entry != ".." && $entry != "default") {

       if($_COOKIE["ln"]==$entry || (!$_COOKIE["ln"] && $data['DefaultLanguage']==$entry)){$select="selected";}
       else{$select="";}

       echo "<option value='".$entry."' ".$select.">".$entry."</option>";

     }

	}

}

function show_default_select_lang(){

	global $data;


	$langs_dir_obj = dir($data['Templates']."/langs/");
	while($entry = $langs_dir_obj->read()){

     if ($entry != "." && $entry != ".." && $entry != "default") {

       if($data['DefaultLanguage']==$entry){$select="selected";}else{$select="";}

       echo "<option value='".$entry."' ".$select.">".$entry."</option>";

     }

	}

}



function db_connect(){

	global $data;

	$data['cid']=@mysql_connect(

		$data['Hostname'], $data['Username'], $data['Password']

	);

	if(!$data['cid']){

		echo(

			'<font style="font:10px Verdana;color:#FF0000">'.mysql_error().

			".<br>Please contact to site administrator <a href=\"mailto:{$data['AdminEmail']}\">".

			"{$data['AdminEmail']}</a>.</font>"

		);


		exit;

	}

	@mysql_select_db($data['Database'], $data['cid']);

  mysql_query("SET NAMES 'utf8'");

	return (bool)$data['cid'];

}



function db_disconnect(){

	global $data;

	return (bool)@mysql_close($data['cid']);

}



function db_query($statement,$print=false){

	global $data;

	if($print) echo("-->{$statement}<--<br>");

	return @mysql_query($statement, $data['cid']);

}



function newid(){

	global $data;

	return @mysql_insert_id($data['cid']);

}



function db_count($result){

	return (int)@mysql_num_rows($result);

}



function db_rows($statement,$print=false) {

	$result=array();

	if($print) echo("-->{$statement}<--<br>");

	$query=db_query($statement);

	$count=db_count($query);

	for($i=0; $i<$count; $i++){

		$record=@mysql_fetch_array($query, MYSQL_ASSOC);

		foreach($record as $key=>$value)$result[$i][$key]=$value;

	}

	return $result;

}

###############################################################################

function verify_email($email){

	return !(bool)ereg("^.+@.+\\..+$", $email);

}



function verify_username($username){

	return !(bool)ereg("^[a-zA-Z0-9]+$", $username);

}



function gencode(){

	global $data;

	list($usec, $sec)=explode(' ', microtime());

	$rand=(float)$sec+((float)$usec*100000);

	srand($rand);

	if($data['TuringNumbers']){

		return (string)rand(pow(10, $data['TuringSize']-1), pow(10, $data['TuringSize'])-1);

	}else{

		return strtoupper(substr(md5(rand()), rand(1, 26), $data['TuringSize']));

	}

}



function around($amount){

	return sprintf("%6.2f", $amount);

}



function encode($number, $size){

	$result='';

	$length=strlen($number);

	for($i=0;$i<$length-$size;$i++)$result.='X';

	return $result.substr($number, $length-$size, $length);

}



function is_changed($number){

    return (bool)ereg("^[0-9]+$", $number);

}



function is_number($text){
	if (!is_changed($text)) { return true ; }
 	return (bool)is_changed($text);

}



function showselect($values, $current=null){

	$result='';
	$exclute = array ('template.faq.htm','template.banners.htm') ;
	foreach($values as $key=>$value){

		$result.=

			"<option value=\"{$key}\"".

			($current!=null?($current==$key?' selected':''):'').

			">{$value}</option>"

		;

	}

	return $result;

}



function read_csv( $filename, $break) {

	if ( $file=fopen($filename,"r") ) {

		while ($content[]=fgetcsv($file,1024,$break));

		fclose($file);

		array_pop($content);

		return $content;

	}

}

###############################################################################

function prndate($date){

	global $data;

	if($date=='0000-00-00 00:00:00')return '---';
	else return  date($data['DateFormat'], strtotime($date));


}
function smalldate($date){

	global $data;

	if($date=='0000-00-00 00:00:00')return '---';
	else return  date($data['SmallDateFormat'], strtotime($date));


}
function prnintg($number){

	return number_format($number, 0, '', ',');

}
function prnsum($sum){

	return (float)str_replace(",", "", $sum);

}
function prnsumm($summ){

	global $data;

	$summ=str_replace(",", ".", $summ);

	return number_format(($summ>0?$summ:-$summ), $data['CurrSize'], '.', ',');

}

function prnsumm_two($summ){

	global $data;

	$summ=str_replace(",", "", $summ);

	$summn = $summ>0?$summ:-$summ;

	return $summn;

}

function prnpays($summ, $splus=true){

	global $data;

	if($summ<0)$color='red';else $color='green';

		return
		"<font color={$color}>".
		($summ>=0?($splus?'+':''):'-').prnsumm($summ)." ".$data['Currency'].
		'</font>';

}

function showBalance($summ, $splus=true){
	global $data;
		return
		($summ>=0?($splus?'+':''):'-').prnsumm($summ)." ".$data['Currency'];
}

function prnfees($summ){
	return $summ!=0?prnpays($summ):'<font color="maroon">---</font>';
}


function prntext($text){

    $search = array ('@<script[^>]*?>.*?</script>@si', // Strip out javascript

                 '@<[\/\!]*?[^<>]*?>@si',          // Strip out HTML tags

                 '@([\r\n])[\s]+@',                // Strip out white space

                 '@&(quot|#34);@i',                // Replace HTML entities

                 '@&(amp|#38);@i',

                 '@&(lt|#60);@i',

                 '@&(gt|#62);@i',

                 '@&(nbsp|#160);@i',

                 '@&(iexcl|#161);@i',

                 '@&(cent|#162);@i',

                 '@&(pound|#163);@i',

                 '@&(copy|#169);@i',

                 '@&#(\d+);@e');                    // evaluate as php



$replace = array ('',

                 '',

                 '\1',

                 '"',

                 '&',

                 '<',

                 '>',

                 ' ',

                 chr(161),

                 chr(162),

                 chr(163),

                 chr(169),

                 'chr(\1)');



return preg_replace($search, $replace, $text);

}

function balance($summ){

	return prnpays($summ, false);

}



function prnuser($uid){

	// if($uid>0)return get_member_username($uid);
  //
	// else return 'System';

  global $data;

  if($uid>0){

    $result=db_rows(

      "SELECT type, company, fname, lname FROM `{$data['DbPrefix']}members`".

      " WHERE `id`={$uid} LIMIT 1"
    );
    if($result[0]['type']==0){
      return $result[0]['fname']." ".$result[0]['lname'];
    }else{
      return $result[0]['company'];
    }
  }else{
    return 'System';
  }

}




function get_files_list($path){

	$result=array();

	if(@file_exists($path)){

		$handle=@opendir($path);

		while(($file=@readdir($handle))!==false){

			if($file!='.'&&$file!='..'){

				$x=strtolower(substr($file, -4));

				if($x&&$x=='.jpg'||$x=='.gif'||$x=='.png')$result[]="{$file}";

			}

		}

	}

	return $result;

}



function get_html_templates(){

	global $data;

	$result=array('0'=>'--');

	if(@file_exists($data['Templates']."/langs/default")){

		$handle=@opendir($data['Templates']."/langs/default");

		while(($file=@readdir($handle))!==false){
			if($file!='.'&&$file!='..'){

				$x=strtolower(substr($file, -4));

				if($x&&$x=='.htm'){$result[$file]="{$file}";}else{
					$handle_mem=@opendir($data['Templates']."/langs/default/".$file);
					while(($file_mem=@readdir($handle_mem))!==false){
					  if($file_mem!='.'&&$file_mem!='..'){
					  	$x_mem=strtolower(substr($file_mem, -4));
					  	if($x_mem&&$x_mem=='.htm')$result[$file."/".$file_mem]="{$file}/{$file_mem}";
					  }
					}
				}

			}

		}

	}

	return $result;

}

###############################################################################

function send_email($key, $post){

	global $data;

	$template=db_rows(

		"SELECT `name`,`value` FROM `{$data['DbPrefix']}emails`".

		" WHERE `key`='{$key}'"

	);

	$text=$template[0]['value'];

	$subject=$template[0]['name'];



	if($post['username']){

		$text=str_replace("[username]", $post['username'], $text);

		$text=str_replace("[usersite]", "{$data['Host']}/?rid={$post['username']}", $text);

	}

	if($post['password'])$text=str_replace("[password]", $post['password'], $text);

	if($post['emailadr'])$text=str_replace("[emailadr]", $post['emailadr'], $text);

	if($post['buyer'])$text=str_replace("[buyeradr]", $post['buyer'], $text);

	if($post['seller'])$text=str_replace("[selleradr]", $post['seller'], $text);

	if($post['sellerusername'])$text=str_replace("[sellerusername]", $post['sellerusername'], $text);

	if($post['product'])$text=str_replace("[product]", $post['product'], $text);

	if($post['ccode'])$text=str_replace("[confcode]", $post['ccode'], $text);

	if($post['chash'])$text=str_replace("[confhash]", $post['chash'], $text);

	if($post['comments'])$text=str_replace("[comments]", $post['comments'], $text);

	else $text=str_replace("[comments]", '---', $text);

	if($post['uid'])$text=str_replace("[uid]", $post['uid'], $text);

	if($post['nom'])$text=str_replace("[contact_nom]", $post['nom'], $text);

	if($post['mail'])$text=str_replace("[contact_email]", $post['mail'], $text);

	if($post['phone'])$text=str_replace("[contact_phone]", $post['phone'], $text);

	if($post['msg'])$text=str_replace("[contact_msg]", $post['msg'], $text);

	$text=str_replace("[fullname]", get_member_name($post['uid']), $text);

	$text=str_replace("[date]", date("d/m/Y H:i:s") , $text);

	$text=str_replace("[emailpage]", "{$data['Host']}/verifer-email-edinars.html", $text);

	$text=str_replace("[email]", $post['email'], $text);

	$text=str_replace("[sitename]", $data['SiteName'], $text);

	$text=str_replace("[hostname]", $data['Host'], $text);

	$text=str_replace("[singpage]", "{$data['Host']}/ouvrir-un-compte-Edinars.html", $text);

	$text=str_replace("[confpage]", "{$data['Host']}/activation.html", $text);

	$text=str_replace("[forgotpage]", "{$data['Host']}/", $text);

	$text=str_replace("[lognpage]", "{$data['Host']}", $text);

	$text=str_replace("[montant_payment]", ( prnsumm($post['montant'])).' '.$data['Currency'], $text);

	$text=str_replace("[montant]",(prnsumm($post['montant']- $post['fees'])).' '.$data['Currency'], $text);

	$text=str_replace("[trxid]", $post['trxid'], $text);

	$text=str_replace("[depot_info]", $post['depot_info'], $text);

	$text=str_replace("[total]",  prnsumm($post['total']).' '.$data['Currency'], $text);

	$text=str_replace("[error]", $post['error'] , $text);

	$text=str_replace("[email-id]", $post['email-id'] , $text);

//echo  "<BR><BR><BR>".$text."<BR><BR><BR>";


	switch  ($key) {

		case 'DEPOT-PAYMENT-CCP-ADMIN' :
				$header ="From: {$data['AdminEmail']}\nReturn-Path: {$data['AdminEmail']}\n";
				$header .= "MIME-version: 1.0\n";
				$header .= "Content-type: text/html; charset=utf-8\n";
				//insert_sent_email ($post['email-id'],$data['CCP_email'],stripslashes($subject),htmlspecialchars($text,ENT_QUOTES) );
				return @mail($data['CCP_email'], stripslashes($subject), stripslashes($text), $header);
				break ;
		case 'WITHDRAW-PAYMENT-ADMIN' :
				$header.="From: {$data['AdminEmail']}\nReturn-Path: {$data['AdminEmail']}\n";
				$header .= "MIME-version: 1.0\n";
				$header .= "Content-type: text/html; charset=utf-8\n";
				//insert_sent_email ($post['email-id'],$data['withdraw_email'],stripslashes($subject), htmlspecialchars( $text, ENT_QUOTES) );
				return @mail($data['withdraw_email'], stripslashes($subject), stripslashes($text), $header);
		case 'ERROR-EMAIL-ADMIN' :
				$header.="From: {$data['AdminEmail']}\nReturn-Path: {$data['AdminEmail']}\n";
				$header .= "MIME-version: 1.0\n";
				$header .= "Content-type: text/html; charset=utf-8\n";
				//insert_sent_email ($post['email-id'],$data['error_email'],stripslashes($subject),htmlspecialchars($text, ENT_QUOTES) ) ;
				return @mail($data['error_email'], stripslashes($subject), stripslashes($text), $header);
		}

		$header="From: {$data['AdminEmail']}\nReturn-Path: {$data['AdminEmail']}\n";
		$header .= "MIME-version: 1.0\n";
		$header .= "Content-type: text/html; charset=utf-8\n";
		//insert_sent_email ($post['email-id'],$post['email'],stripslashes($subject) ,htmlspecialchars($text, ENT_QUOTES) ) ;
		return @mail($post['email'], stripslashes($subject), stripslashes($text), $header);

}

function send_mass_email($subject, $message, $active=-1){

	global $data;

	$header="From: {$data['AdminEmail']}\nReturn-Path: {$data['AdminEmail']}\n";

	$members=db_rows(

		"SELECT `username`,`email`,`fname`,`lname`".

		" FROM `{$data['DbPrefix']}members`".

		($active<0?'':" WHERE `active`={$active}")

	);

	foreach($members as $value){
		mail($value['email'], $subject, $message, $header);
	}

}

function insert_sent_email( $pin_id , $mail, $subject, $message){

	global $data;

	db_query(
		"INSERT INTO `{$data['DbPrefix']}email_sent`(".
		"`email_id``email_address`,`email_subject`,`email_content`,`email_created_date` )VALUES(".
		"'{$pin_id}','{$mail}','{$subject}','{$message}','".date("Y-m-d H:i:s")."')"
	,true);
}
###############################################################################

function use_curl($href, $post=null){

	$handle=curl_init();

	curl_setopt($handle, CURLOPT_URL, $href);

	if($post){

		if($post){

			curl_setopt($handle, CURLOPT_POST, 1);

			curl_setopt($handle, CURLOPT_POSTFIELDS, $post);

		}

		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($handle, CURLOPT_TIMEOUT, 90);

	}

	$result=curl_exec($handle);

	curl_close($handle);

	return $result;

}




###############################################################################

// function is_user_available($username){
//
// 	global $data;
//
// 	$confirms=db_rows(
//
// 		"SELECT `id` FROM `{$data['DbPrefix']}confirms`".
//
// 		" WHERE(`newuser`='{$username}') LIMIT 1"
//
// 	);
//
// 	$members=db_rows(
//
// 		"SELECT `id` FROM `{$data['DbPrefix']}members`".
//
// 		" WHERE(`username`='{$username}') LIMIT 1"
//
// 	);
//
// 	return (bool)(!$confirms&&!$members);
//
// }



function is_mail_available($email){

        global $data;

        $confirms=db_rows(

                "SELECT `id` FROM `{$data['DbPrefix']}confirms`".

                " WHERE(`newmail`='{$email}') LIMIT 1"

        );

        $members=db_rows(

                "SELECT `id` FROM `{$data['DbPrefix']}members`".

                " WHERE(`email`='{$email}') LIMIT 1"

        );

        $emails=db_rows(

                "SELECT `id` FROM `{$data['DbPrefix']}member_emails`".

                " WHERE(`email`='{$email}') LIMIT 1"

        );

        return (bool)(!$confirms&&!$members&&!$emails);

}



function create_confirmation($newpass, $newques, $newansw, $newmail, $newtype, $sponsor=0){

	global $data;

	$result=gencode();

	$sponsor=($sponsor?$sponsor:0);

  $add_query = db_query( "INSERT INTO `{$data['DbPrefix']}confirms` ".
        		"(`newpass`,`newmail`,`newtype`,`sponsor`,`confirm` )VALUES(".
        		"'".strtoupper(md5($newpass.'|'.$result))."','{$newmail}','{$newtype}',{$sponsor},'{$result}')");

  if($add_query){
    $post['ccode'] = $result;

    $post['email']=$newmail;

    $post['chash']=strtoupper(md5($post['ccode'].'|'.$post['email']));

    $send_email = send_email('CONFIRM-TO-MEMBER', $post);
    if($send_email){
      return true;
    }else {
      return false;
    }
  }else{
    return false;
  }
}

function select_confirmation($ccode, $email, $chash=''){

	global $data;

	if(isset($chash)&&!empty($chash)){

		$query="WHERE MD5(CONCAT(`confirm`,'|',`newmail`))='{$chash}'";

	}else{

		$query="WHERE(`confirm`='{$ccode}' AND `newmail`='{$email}')";

	}

	$confirm=db_rows(

		"SELECT `id` FROM `{$data['DbPrefix']}confirms` {$query} LIMIT 1"

	);
  //echo "<br>SELECT `id` FROM `{$data['DbPrefix']}confirms` {$query} LIMIT 1<br>";
  //print_r($confirm);
	return $confirm[0]['id'];

}

function select_email_confirmation($ccode, $email, $chash=''){

	global $data;

	if(isset($chash)&&!empty($chash)){

		$query="WHERE MD5(CONCAT(`confirm`,'|',`email`))='{$chash}'";

	}else{

		$query="WHERE(`confirm`='{$ccode}' AND `email`='{$email}')";

	}

	$confirm=db_rows(

		"SELECT `id` FROM `{$data['DbPrefix']}member_emails` {$query} LIMIT 1"

	);

	return $confirm[0]['id'];

}


// Functions Created by: Yacine Ait chalal
function update_security_question($uid, $question, $answer, $notify=true){

	global $data;

	$edit_security_question = db_query(

		"UPDATE `{$data['DbPrefix']}members` SET ".

		"`question`='{$question}',`answer`='{$answer}'".

		" WHERE `id`={$uid}"

	);

	if($notify){

		$post['email'] = get_member_email($uid);
		$post['uid'] = $uid;
		send_email('UPDATE-MEMBER-PROFILE', $post);

	}
	// ajoutre un audit
	$mcheckinfo = "Modification des detail sur S&egravecurit&egrave acc&egraces";
	audit(
        'MODIFICATION DES DETAIL SUR S&EgraveCURIT&Egrace ACC&EgraveS',
        $mcheckinfo,
        'members',
        $uid,
        prnuser($uid)
        );

  return $edit_security_question;
}

function update_my_profile_empty($uid){
  $info_user = get_member_info($uid);

  // var_dump($info_user);

  if($info_user['type'] == 0){ //Particulier
    if($info_user['fname'] && $info_user['address']){
      $post_empty['empty'] = 0;
    }
  }else{
    if($info_user['fname'] && $info_user['address'] && $info_user['company']){
      $post_empty['empty'] = 0;
    }
  }

  $edit_profile = update_my_profile($post_empty, $uid, false);

  return $edit_profile;
}

function update_my_profile($post, $uid, $notify=true){
  global $data;

  $profile = get_member_info($uid);

  $sql = " UPDATE `{$data['DbPrefix']}members` SET ";
  $sql .= " id = id ";
  //$sql .= " `empty`= 0 ";
  if(!is_null($post['sponsor'])) $sql .= " ,`sponsor`=".addslashes($post['sponsor'])." ";
  if(!is_null($post['fname'])) $sql .= " ,`fname`='".addslashes($post['fname'])."' ";
  if(!is_null($post['lname'])) $sql .= " ,`lname`='".addslashes($post['lname'])."' ";
  if(!is_null($post['type'])){
    if($post['type']=="") $post['type'] = 0;
    $sql .= " , `type`='".addslashes($post['type'])."' ";
  }
  if(!is_null($post['phone'])) $sql .= " ,`phone`='".addslashes($post['phone'])."' ";
  if(!is_null($post['fax'])) $sql .= " ,`fax`='".addslashes($post['fax'])."' ";
  if(!is_null($post['mobile'])){

    $sql .= " , `mobile`='".addslashes($post['mobile'])."', `confirm_mobile` = '0', confirm_mobile_code = '".generate_pin_code(6)."' ";
  }
  if(!is_null($post['confirm_mobile'])) $sql .= " , `confirm_mobile`='".addslashes($post['confirm_mobile'])."' ";
  if(!is_null($post['address'])) $sql .= " , `address`='".addslashes($post['address'])."' ";
  if(!is_null($post['city'])) $sql .= " , `city`='".addslashes($post['city'])."' ";
  if(!is_null($post['postcode'])) $sql .= " , `postcode`='".addslashes($post['postcode'])."' ";
  if(!is_null($post['wilaya'])) $sql .= " , `wilaya`='".addslashes($post['wilaya'])."' ";
  if(!is_null($post['company'])) $sql .= " , `company`='".addslashes($post['company'])."' ";
  if(!is_null($post['nrc'])) $sql .= " , `nrc`='".addslashes($post['nrc'])."' ";
  if(!is_null($post['nnif'])) $sql .= " , `nnif`='".addslashes($post['nnif'])."' ";
  if(!is_null($post['nart'])) $sql .= " , `nart`='".addslashes($post['nart'])."' ";
  if(!is_null($post['nfis'])) $sql .= " , `nfis`='".addslashes($post['nfis'])."' ";
  if(!is_null($post['empty'])) $sql .= " , `empty`='".addslashes($post['empty'])."' ";
  // var_dump($post);
  $sql .= " WHERE `id`={$uid} ";

  // echo nl2br($sql);

  $edit_profile = db_query($sql);

  if($edit_profile){
    $mcheckinfo  =" NOM : ".addslashes($post['fname'])." \n ";
    $mcheckinfo .=" PRENOM  : ".addslashes($post['lname'])." \n ";
    $mcheckinfo .=" TELEPHONE : ".addslashes($post['phone'])." \n" ;
    $mcheckinfo .=" MOBILE    : ".addslashes($post['mobile'])." \n " ;
    $mcheckinfo .=" FAX : ".addslashes($post['fax']);

    // ajoutre un audit
    // audit(
    //   'AJOUTER DES DETAIL SUR PROFILE',
    //   $mcheckinfo,
    //   'members',
    //   $profile['id'],
    //   prnuser($uid)
    // );


    if($notify){
      $post['email'] = get_member_email($uid);
      send_email('UPDATE-MEMBER-PROFILE', $post);
    }
  }

  return $edit_profile;
}

function update_confirmation($cid){

	global $data;

	db_query(

		"DELETE FROM `{$data['DbPrefix']}confirms`".

		" WHERE(TO_DAYS(NOW())-TO_DAYS(`cdate`)>=2)"

	);

	$confirm=db_rows("SELECT". "`id`,`newpass`,`newquestion`,`newanswer`,`newmail`,`newtype`,". ($data['UseExtRegForm']? "`newfname`,`newlname`,`newcompany`,`newregnum`,`newdrvnum`,`newaddress`,". "`newcity`,`newcountry`,`newstate`,`newzip`,`newphone`,`newfax`,":"" ). "`sponsor`". " ,`confirm` FROM `{$data['DbPrefix']}confirms` WHERE(`id`='{$cid}')");

	$confirm=$confirm[0];

	foreach($confirm as $key=>$value){

		$confirm[$key] = @addslashes($value);

	}

  $pin_code = generate_pin_code(4);

	db_query(

		"INSERT INTO `{$data['DbPrefix']}members`(".

		"`sponsor`,`mem_id`,`password`,`email`,`question`,`answer`,`type`,".

		($data['UseExtRegForm']?

		"`fname`,`lname`,`company`,`regnum`,`drvnum`,`address`,".

		"`city`,`country`,`state`,`zip`,`phone`,`fax`, `pin_code`,":''

      ).

      "`active`,`empty`,`cdate`".

		")VALUES(".

		"{$confirm['sponsor']},'{$confirm['confirm']}','{$confirm['newpass']}','{$confirm['newmail']}',".

		"'{$confirm['newquestion']}','{$confirm['newanswer']}','{$confirm['newtype']}',".

		($data['UseExtRegForm']?

		"'{$confirm['newfname']}','{$confirm['newlname']}','{$confirm['newcompany']}',".

      "'{$confirm['newregnum']}','{$confirm['newdrvnum']}','{$confirm['newaddress']}',".

      "'{$confirm['newcity']}','{$confirm['newcountry']}','{$confirm['newstate']}',".

      "'{$confirm['newzip']}','{$confirm['newphone']}','{$confirm['newfax']}', '{$pin_code}'":''

      ).

      "1,".($data['UseExtRegForm']?'0':'1').",'".date('Y-m-d H:i:s')."')"

	);



	$code=gencode();

	$receiver=newid();

	db_query("INSERT INTO `{$data['DbPrefix']}member_emails`

	(`owner`,`email`,`active`,`primary`) VALUES

	('{$receiver}','{$confirm['newmail']}',1,1)

	");



	db_query(

		"DELETE FROM `{$data['DbPrefix']}confirms`".

		" WHERE(`id`={$confirm['id']})"

	);



	if($data['SignupPays']){

		transaction(
			get_trx_id(),
			-1,
			$receiver,
			$data['SignupBonus'],
			0,
			4,
			1,
			'Bonus d\'inscription'

		);

	}

	$post['username']=$confirm['newuser'];

	$post['password']=$confirm['newpass'];

	$post['email']=$confirm['newmail'];

	send_email('SIGNUP-TO-MEMBER', $post);

	if($data['ReferralPays']){

		$post['email']=get_member_email($confirm['sponsor']);

		send_email('DOWNLINE-CHANGE', $post);

	}

	$tmpays=get_unreg_member_pay($receiver,'RECEIVER');



	if($tmpays[0]) update_unreg_member_pays($receiver);

}



function update_email_confirmation($eid){

        global $data;

        db_query(

                "UPDATE `{$data['DbPrefix']}member_emails`".

                " SET `confirm`='', `status`=2".

                " WHERE `id`={$eid}"

        );

}



function get_members_count($active=0 ,$All=1){

	global $data;

	$result=db_rows(

		"SELECT COUNT(`id`) AS `count`".

		" FROM `{$data['DbPrefix']}members`".

		//" WHERE  `active`={$active}".
		($All?" WHERE  `active`={$active}":'').
		" LIMIT 1"

	);

	return $result[0]['count'];

}



function get_members_list($active=0, $start=0, $count=0, $online=false){

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$members=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}members`".

		" WHERE `active`={$active}".($online?' AND (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(`adate`)<1800)':'').

		" ORDER BY `username` ASC{$limit}"

	);



	$result=array();

	foreach($members as $key=>$value){

		$result[$key]=$value;

		$trans=db_rows(

			"SELECT COUNT(`id`) AS `count`".

			" FROM `{$data['DbPrefix']}transactions`".

			" WHERE `sender`={$result[$key]['id']}".

			" OR `receiver`={$result[$key]['id']} LIMIT 1"

		);

		$result[$key]['transactions']=$trans[0]['count'];

		$result[$key]['candelete']=$trans[0]['count']<2;

		$result[$key]['email']=get_member_email($result[$key]['id'],true,true);

		if($result[$key]['sponsor']){

			$result[$key]['sname']=

				get_member_username($result[$key]['sponsor']).'<br>('.

				get_member_email($result[$key]['sponsor'],true,true).')'

			;

		}else $result[$key]['sname']='N/A';

	}

	return $result;

}



function get_members_count_where_pred($where_pred){

	global $data;

	$result=db_rows(

		"SELECT COUNT(`id`) AS `count`".

		" FROM `{$data['DbPrefix']}members`".

		" WHERE $where_pred ".

		" LIMIT 1"

	);

	return $result[0]['count'];

}



function get_members_list_where_pred($start=0, $count=0, $where_pred){

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$members=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}members`".

		" WHERE $where_pred ".

		" ORDER BY `id` ASC {$limit}"

	);

	$result=array();

	foreach($members as $key=>$value){

		$result[$key]=$value;

		$trans=db_rows(

			"SELECT COUNT(`id`) AS `count`".

			" FROM `{$data['DbPrefix']}transactions` ".

			" WHERE `sender`={$result[$key]['id']}".

			" OR `receiver`={$result[$key]['id']} LIMIT 1"

		);

		$result[$key]['transactions']=$trans[0]['count'];

		$result[$key]['candelete']=$trans[0]['count']==0;

		if($result[$key]['sponsor']){

			$result[$key]['sname']=

				get_member_username($result[$key]['sponsor']).'<br>('.

				get_member_email($result[$key]['sponsor']).')'

			;

		}else $result[$key]['sname']='N/A';

	}

	return $result;

}


function get_member_id($username, $password='', $where=''){

	global $data;

	$Crypt = db_rows("SELECT `mem_id` FROM `{$data['DbPrefix']}members` WHERE `email`='{$username}' LIMIT 1");

	if(!$Crypt){
		$result=db_rows("SELECT `owner` as `id` FROM `{$data['DbPrefix']}member_emails` WHERE `email`='{$username}' LIMIT 1");
		if($result){
              $result = db_rows("SELECT `mem_id` FROM `{$data['DbPrefix']}members` WHERE `id`={$result[0]['id']} LIMIT 1" );
              $CrypPassword =  strtoupper(md5($password.'|'.$result[0]['mem_id'])) ;
			}
	}
	else {
		$CrypPassword =  strtoupper(md5($password.'|'.$Crypt[0]['mem_id']) ) ;
	}

	$result=db_rows(

		"SELECT `id` FROM `{$data['DbPrefix']}members`".

		" WHERE  `email`='{$username}'".

		($password?" AND `password`='{$CrypPassword}'":'').

		($where?" AND $where":'')." LIMIT 1");

        if(!$result){

           $result=db_rows(

                "SELECT `owner` as `id` FROM `{$data['DbPrefix']}member_emails`".

                " WHERE `email`='{$username}' LIMIT 1"

           );

           if($result&&($password||$where)){

              $result=db_rows(

                 "SELECT `id` FROM `{$data['DbPrefix']}members`".

                 " WHERE `id`={$result[0]['id']}".

                 ($password?" AND `password`='{$CrypPassword}'":'').

                 ($where?" AND $where":'')." LIMIT 1"

              );

           }

        }


        return $result[0]['id'];

}
//*****************************************************//
function insert_member_id_session($member_id)
{
	global $data;
  $result=db_query( "INSERT INTO `{$data['DbPrefix']}members_sessions`
                  (`member_session_id`, `member_id`, `login_date`,`last_activity`)
                  VALUES (NULL, '{$member_id}', NOW(),NOW() )");

  $newid = newid();
  $result_md5=db_rows("SELECT MD5 (CONCAT(member_id,member_session_id)) as access_token
                        FROM `{$data['DbPrefix']}members_sessions`
                        WHERE member_session_id = '".$newid."'
                        ORDER BY `{$data['DbPrefix']}members_sessions`.member_session_id DESC
                        LIMIT 1");

  return $result_md5[0]['access_token'];
}
//****************************************************//

function update_member_forgot_password($email, $password){

	global $data;

	$forgotEmail = db_rows("SELECT `mem_id` FROM `{$data['DbPrefix']}members` WHERE `email`='{$email}' LIMIT 1");

	if(!$forgotEmail){
		$result=db_rows("SELECT `owner` as `id` FROM `{$data['DbPrefix']}member_emails` WHERE `email`='{$email}' LIMIT 1");
		if($result){
              $result = db_rows("SELECT `mem_id` FROM `{$data['DbPrefix']}members` WHERE `id`={$result[0]['id']} LIMIT 1" );
              $CryptPassword =  strtoupper(md5($password.'|'.$result[0]['mem_id'])) ;
			}
	}
	else {
		$CryptPassword =  strtoupper(md5($password.'|'.$forgotEmail[0]['mem_id']) ) ;
	}
 	 if($CryptPassword){
			db_query(
				"UPDATE `{$data['DbPrefix']}members` SET `password`='{$CryptPassword}' WHERE `mem_id`={$forgotEmail[0]['mem_id']}"
			);
	}
}

function get_member_logo($username){

	global $data;

	$result=db_rows(

		"SELECT `logo` FROM `{$data['DbPrefix']}members`".

		" WHERE (`username`='{$username}') LIMIT 1");

        return $result[0]['logo'];

}

function get_member_email($uid, $primary=false, $confirmed=true){

	global $data;

	$result=db_rows(

		"SELECT `email` FROM `{$data['DbPrefix']}member_emails`".

		" WHERE `owner`={$uid}".

		($primary?" AND `primary`='{$primary}'":'').

		($confirmed?" AND `active`='{$confirmed}'":'').

		" ORDER BY `primary` DESC"



	);

	return $result[0]['email'];

}
function get_member_email_by_username($username){

	global $data;

	$result=db_rows(

		"SELECT `email` FROM `{$data['DbPrefix']}members`".

		" WHERE `username`= '".$username."' "
	);

	return $result[0]['email'];

}



function count_member_emails($uid, $primary=false, $confirmed=true) {

	global $data;

	$result=db_rows(

		"SELECT COUNT(`email`) AS `count`".

		" FROM `{$data['DbPrefix']}member_emails`".

		" WHERE `owner`={$uid}".

		($primary?" AND `primary`='{$primary}'":'').

		($confirmed?" AND `active`='{$confirmed}'":'').

		" LIMIT 1"

	);

	return $result[0]['count'];

}



function get_email_details($uid, $primary=false, $confirmed=true){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}member_emails`".

		" WHERE `owner`={$uid}".

		($primary?" AND `primary`='{$primary}'":'').

		($confirmed?" AND `active`='{$confirmed}'":'')

	);

	return $result;

}



function prnmemberemails($uid) {

	global $data;

	$str_add="";

	$result=db_rows(

		"SELECT `email` FROM `{$data['DbPrefix']}member_emails`".

		" WHERE `owner`={$uid} AND `active`='1'".

		" ORDER BY `primary` DESC"



	);

	foreach($result as $key=>$value) {

		$str_add .=  $result[$key]['email']."<br>";

	}

	return $str_add;

}



/* Users emails functions */



function add_email($uid,$email){

	global $data;

	$max_email=$data['maxemails'];

	$nb_emails=count_member_emails($uid,false,false);

	if($nb_emails >= $max_email) return TOO_MANY_EMAILS;

	elseif(verify_email($email)) return INVALID_EMAIL_ADDRESS;

	elseif(email_exists($email)) return EMAIL_EXISTS;

	else {

		$verifcode=gencode($email);



		$result=db_query(

			"INSERT INTO `{$data['DbPrefix']}member_emails`".

			"(`owner`,`email`,`active`,`primary`,`verifcode`) VALUES ".

			"($uid,'{$email}',0,0,'{$verifcode}')"

		);

		if (!$result) return DB_ERROR;

		$info=get_member_info($uid);

		$post['email']=$email;

		$post['fullname']=get_member_name($uid);

		$post['ccode']=$verifcode;

		$post['uid']=$uid;

		$post['emailpage'];

		send_email('CONFIRM-NEW-EMAIL',$post);

		return SUCCESS;

	}

}



function activate_email($uid, $verifcode){

	global $data;

	$confirm=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}member_emails` WHERE `owner`='$uid' AND `verifcode`='$verifcode' AND `active`=0");

	if (!isset($confirm[0])) return CONFIRMATION_NOT_FOUND;

	db_query("UPDATE `{$data['DbPrefix']}member_emails` SET `active`=1 WHERE `owner`={$uid} AND `verifcode`='{$verifcode}'");



	$info=get_member_info($uid);

	$post['email']=$confirm[0]['email'];

	$post['fullname']=get_member_name($uid);

	send_email('NEW-EMAIL-ACTIVATED',$post);

	return SUCCESS;

}



function make_email_prim($uid, $email){

	global $data;

	if (verify_email($email)) return INVALID_EMAIL_ADDRESS;

	$emails=get_email_details($uid,false,false);

	$oldprim=get_member_email($uid,true);

	foreach ($emails as $addr)

		if($addr['email']==$email && $addr['primary']) return ALREADY_PRIMARY;

		elseif($addr['email']==$email && !$addr['active']) return EMAIL_NOT_ACTIVE;

		elseif($addr['email']==$email){

			/* un-prim old, make prim new*/

			db_query("UPDATE {$data['DbPrefix']}member_emails SET `primary`=1 WHERE `owner`='{$uid}' AND `email`='{$email}'");

			db_query("UPDATE {$data['DbPrefix']}member_emails SET `primary`=0 WHERE `owner`='{$uid}' AND `email`='{$oldprim}'");

			db_query("UPDATE {$data['DbPrefix']}members SET `email`='{$email}' WHERE `id`='{$uid}'");

			return SUCCESS;

		}

	return EMAIL_NOT_FOUND;

}



function get_email_detail($email, $type=ALL){

	global $data;

	if ($type==CONFIRMED) $result=db_rows(

		"SELECT * FROM {$data['DbPrefix']}member_emails WHERE `email`='$email' AND `active`=1");

	else $result=db_rows(

		"SELECT * FROM {$data['DbPrefix']}member_emails WHERE `email`='$email'");

	return $result[0];

}



function delete_member_email($uid, $email){

	global $data;

	if(verify_email($email)) return INVALID_EMAIL_ADDRESS;

	$todel=get_email_detail($email);

	if(!$todel) return EMAIL_NOT_FOUND;

	elseif($todel['primary']) return CANNOT_DELETE_PRIMARY;



	db_query("DELETE FROM {$data['DbPrefix']}member_emails WHERE owner='{$uid}' AND `email`='{$email}'");

	return SUCCESS;

}



function email_exists ($email){

	global $data;

	$result=db_rows("SELECT owner FROM {$data['DbPrefix']}members_emails WHERE email='{$email}'");

	return (bool)$result['0'];

}



function get_user_id($unoremail){

	global $data;

	if(verify_email($unoremail)){

	// here we know its the username

		$result=db_rows(

			"SELECT `id` FROM `{$data['DbPrefix']}members`".

			" WHERE (`username`='{$unoremail}') AND `active`=1 LIMIT 1");

		return $result[0]['id'];

	} else {

	//... here the email address

		$result=db_rows(

			"SELECT `owner` FROM `{$data['DbPrefix']}member_emails` e, ".

			"`{$data['DbPrefix']}members` m".

			" WHERE (e.`email`='{$unoremail}' AND m.`active`=1)".

			" LIMIT 1");

		return $result[0]['owner'];

	}

}





/* --------PROFILE ---- */



function get_sponsor_id($uid){

	global $data;

	$result=db_rows(

		"SELECT `sponsor` FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1"

	);

	return $result[0]['sponsor'];

}



function get_sponsors($uid){

	global $data;

	$members=db_rows(

		"SELECT `id`,`email`".

		" FROM `{$data['DbPrefix']}members`".

		($uid?" WHERE `id`<>{$uid} AND `sponsor`<>{$uid}":'')

	);

	$result=array('--');

	foreach($members as $value)$result[$value['id']]="{$value['username']} ({$value['email']})";

	return $result;

}

function get_member_username_hashkey($uid){

	global $data;

	if($uid<0)return 'System';

	$result=db_rows(

		"SELECT `username` ,`mem_id` FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1");

		$PerHashKey = encryptPerHashKey($result[0]['mem_id'] ,$result[0]['username']) ;

	return  $PerHashKey ;

}

function get_member_username($uid){

	global $data;

	if($uid<0)return 'System';

	$result=db_rows(

		"SELECT `username` FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1");

	return $result[0]['username'];

}

function get_member_username_pincode($uid){

	global $data;

	if($uid<0) return 'System';

  $sql = "SELECT `mem_id` FROM `{$data['DbPrefix']}members`".
          " WHERE `id`={$uid} LIMIT 1";
  //echo $sql;
  $result = db_rows($sql);

	return $result[0]['mem_id'];

}


function get_member_name($uid){

	global $data;

	if($uid<0)return 'system';

	$result=db_rows(

		"SELECT `fname`,`lname` FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1");

	return ucfirst($result[0]['fname'])." ".ucfirst($result[0]['lname']);

}



function get_member_info($uid){

        global $data;

        $result=db_rows(

                "SELECT * FROM `{$data['DbPrefix']}members`".

                " WHERE `id`={$uid} LIMIT 1");

        $result[0]['emails']=db_rows(

                "SELECT * FROM `{$data['DbPrefix']}member_emails`".

                " WHERE `owner`={$uid} AND `email`<>'{$result[0]['email']}'");

        return $result[0];

}
function get_member_info_by_mem_id($mem_id){

      global $data;

      $result=db_rows(

              "SELECT * FROM `{$data['DbPrefix']}members`".

              " WHERE `mem_id`={$mem_id} LIMIT 1");

      $result[0]['emails']=db_rows(

              "SELECT * FROM `{$data['DbPrefix']}member_emails`".

              " WHERE `owner`='".$result[0]['id']."' AND `email`<>'{$result[0]['email']}'");

      return $result[0];
}

function get_member_info_by_mobile_code($mobile, $code){

      global $data;

      $result=db_rows(

              "SELECT * FROM `{$data['DbPrefix']}members`".

              " WHERE REPLACE(mobile, ' ', '') = '{$mobile}'".
              " AND confirm_mobile_code = '{$code}' ".
              " LIMIT 1");

      $result[0]['emails']=db_rows(

              "SELECT * FROM `{$data['DbPrefix']}member_emails`".

              " WHERE `owner`='".$result[0]['id']."' AND `email`<>'{$result[0]['email']}'");

      return $result[0];
}



function get_member_info_reciever($uid){


        global $data;
        $result=db_rows(
                "SELECT * FROM `{$data['DbPrefix']}members`".
                " WHERE `mem_id`={$uid} LIMIT 1");



        $result[0]['emails']=db_rows(
                "SELECT * FROM `{$data['DbPrefix']}member_emails`".
				" INNER JOIN `{$data['DbPrefix']}members` ON `owner`= `id` ".
                " WHERE `membmem_ider_id`={$uid} AND `email`<>'{$result[0]['email']}'");

        return $result[0];

}



function get_member_status($uid){

	global $data;

	$result=db_rows(

		"SELECT `status` FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1"

	);

	return $result[0]['status'];

}



function get_ip_history($uid, $order=''){

	global $data;

	$result=db_rows(

		"SELECT `date`,`address` FROM `{$data['DbPrefix']}visits`".

		" WHERE `member`={$uid} ".($order?"ORDER BY `{$order}`":'ORDER BY `date` DESC')

	);

	return $result;

}



function is_member_found($username, $password){

	return (bool)get_member_id($username, $password);

}



function is_member_active($username){

	return (bool)get_member_id($username, '', '`active`=1');

}



function set_member_status($uid, $active){

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}members`".

		" SET `active`=".(int)$active.

		" WHERE `id`={$uid}"

	);


}



function set_member_status_ex($uid, $status){

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}members`".

		" SET `status`={$status}".

		" WHERE `id`={$uid}"

	);

}



function get_member_status_ex($uid){

	global $data;

	$record=db_rows(

		"SELECT `status` FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1"

	);

	return $record[0]['status'];

}



function set_member_inactive($username){

	global $data;

	set_member_status(get_member_id($username), false);

}



function delete_member($uid){

	global $data;

	db_query(

		"DELETE FROM `{$data['DbPrefix']}members` WHERE `id`={$uid}"

	);

}



function select_balance($uid){

	global $data;

	if($uid<0){
		$isql=
			"SELECT SUM(`fees`) AS `summ`".
			" FROM `{$data['DbPrefix']}transactions`".
			" WHERE (`status`=1 OR `status`=6) LIMIT 1";
	}else{
		$isql=
			"SELECT SUM(`amount`-`fees`) AS `summ`".
			" FROM `{$data['DbPrefix']}transactions`".
			" WHERE `receiver`={$uid} AND (`status`=1 OR `status`=6) LIMIT 1";
	}

	$outgoing=db_rows(
		"SELECT SUM(`amount`) AS `summ`".
		" FROM `{$data['DbPrefix']}transactions`".
		" WHERE `sender`={$uid} AND (`status`=1 OR `status`=6) AND type != 3  LIMIT 1"
	);

	$outgoingmobile=db_rows(
		"SELECT SUM(`amount`+`fees`) AS `summ`".
		" FROM `{$data['DbPrefix']}transactions`".
		" WHERE `sender`={$uid} AND (`status`=1 OR `status`=6)  AND type = 3 LIMIT 1"
		);
	$pending_out_unreg=db_rows(
		"SELECT SUM(`amount`) AS `summ`".
		" FROM `{$data['DbPrefix']}temp_pays`".
		" WHERE `sender`={$uid} AND (`status`=0) LIMIT 1"
    );

	$incoming=db_rows($isql);
	$outgoing=(double)$outgoing[0]['summ'];
	$pending_out_unreg=(double)$pending_out_unreg[0]['summ'];
	$outgoing=$outgoing+$pending_out_unreg;
	$incoming=(double)$incoming[0]['summ'];
	$outgoingmobile=(double)$outgoingmobile[0]['summ'];


	return $incoming-$outgoing-$outgoingmobile;

}




function select_balance_disponible($uid){

	global $data;

	$incoming=db_rows(
		"SELECT SUM(`amount`-`fees`) AS `summ`".
		" FROM `{$data['DbPrefix']}transactions`".
		" WHERE `receiver`={$uid} AND (tdate < DATE_SUB( NOW(), INTERVAL 5 DAY)  OR `sender` = -1) AND (`status`=1 OR `status`=6) AND `type` not in (1, 3) LIMIT 1"		);

	$incoming_topup=db_rows(
		"SELECT SUM(`amount`-`fees`) AS `summ`".
		" FROM `{$data['DbPrefix']}transactions`".
		" WHERE `receiver`={$uid} AND `status`=1 AND `type` in (1, 3) LIMIT 1"
		);


	$outgoing=db_rows(
		"SELECT SUM(`amount`) AS `summ`".
		" FROM `{$data['DbPrefix']}transactions`".
		" WHERE `sender`={$uid} AND (`status`=1 OR `status`=6)  AND type != 3  LIMIT 1"
	);

	$outgoingmobile=db_rows(
		"SELECT SUM(`amount`+`fees`) AS `summ`".
		" FROM `{$data['DbPrefix']}transactions`".
		" WHERE `sender`={$uid} AND (`status`=1 OR `status`=6)  AND type = 3  LIMIT 1"
	);

	$pending_out_unreg=db_rows(
		"SELECT SUM(`amount`) AS `summ`".
		" FROM `{$data['DbPrefix']}temp_pays`".
		" WHERE `sender`={$uid} AND tdate < DATE_SUB( NOW(), INTERVAL 5 DAY) AND (`status`=0) LIMIT 1"
	);

	$outgoing=(double)$outgoing[0]['summ'];

	$pending_out_unreg=(double)$pending_out_unreg[0]['summ'];

	$outgoing=$outgoing+$pending_out_unreg;

	$incoming=(double)$incoming[0]['summ'];
	$incoming_topup=(double)$incoming_topup[0]['summ'];

	$outgoingmobile=(double)$outgoingmobile[0]['summ'];

	return ($incoming + $incoming_topup) - $outgoing-$outgoingmobile;

}

function set_last_access($username){

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}members`".

		" SET `ldate`='".date("Y-m-d H:i:s")."',".

		"`last_ip`='{$_SERVER['REMOTE_ADDR']}'".

		" WHERE `id`=".get_member_id($username)

	);

}



function set_last_access_date($uid, $reset=false){

	global $data;

	if(!$reset)$curr=date("Y-m-d H:i:s");else $curr=0;

	db_query(

		"UPDATE `{$data['DbPrefix']}members`".

		" SET `adate`='{$curr}'".

		" WHERE `id`={$uid}"

	);

}



function save_remote_ip($uid, $address){

	global $data;

	db_query(

		"INSERT `{$data['DbPrefix']}visits`(`member`,`date`,`address`".

		")VALUES({$uid},'".date('Y-m-d H:i:s')."','{$address}')"

	);

}



function is_valid_mail($email){

        global $data;

        $result=db_rows("SELECT `id` FROM `{$data['DbPrefix']}members` WHERE `email`='{$email}' LIMIT 1");

        $emails=db_rows("SELECT  `owner` AS `id` FROM `{$data['DbPrefix']}member_emails` WHERE(`email`='{$email}') LIMIT 1");

        return (bool)($result&&$emails);
}

function get_member_by_email($email){

        global $data;

        $result=db_rows(

                " SELECT CASE  WHEN  LENGTH(lname) > 1 THEN lname + ' ' + fname".
				" WHEN LENGTH(lname) = 0  THEN username END  as fullname ,`mem_id`,`password`,`question`,`answer` FROM `{$data['DbPrefix']}members`".
				" WHERE `email`='{$email}'"

        );

        if(!$result){

           $emails=db_rows(

                "SELECT `owner` FROM `{$data['DbPrefix']}member_emails`".

                " WHERE `email`='{$email}' LIMIT 1"

           );

           if($emails){

              $result=db_rows(

                 " SELECT CASE  WHEN  LENGTH(lname) > 1 THEN lname + ' ' + fname ".
				 " WHEN LENGTH(lname) = 0  THEN username END  as fullname , `mem_id`,`password`,`question`,`answer` FROM `{$data['DbPrefix']}members`".
                 " WHERE `id`={$emails[0]['owner']}"

              );

           }

        }

        return $result[0];

}

function is_info_empty($uid){

	global $data;

	$result=db_rows(

		"SELECT `empty`".

		" FROM `{$data['DbPrefix']}members`".

		" WHERE `id`={$uid} LIMIT 1"

	);

	return (bool)$result[0]['empty'];

}



function select_info($uid, $post){

	global $data;

	$result = $post;

	$member=get_member_info($uid);

	if(!$member){

		$_SESSION['uid']=0;

		$_SESSION['login']=false;

		header("Location:{$data['Host']}/acceuil-Edinars.html");

		echo('ACCESS DENIED.');

		exit;

	}

	foreach($member as $key=>$value)
		if(!isset($post[$key]))
			$result[$key]=$value;

	if(!$result['active']){

		$_SESSION['uid']=0;

		$_SESSION['login']=false;

		header("Location:{$data['Host']}/cceuil-Edinars");

		echo('ACCESS DENIED.');

		exit;

	}

	return $result;

}



function insert_profile_info($post){

	global $data;

	if(!$post['sponsor'])$post['sponsor']=0;

	db_query(

		"INSERT INTO `{$data['DbPrefix']}members`(".

		"`sponsor`,`username`,`password`,`email`,`active`,`empty`,".

		"`fname`,`lname`,`company`,`regnum`,`drvnum`,".

		"`address`,`city`,`country`,`state`,`zip`,`phone`,`fax`".

		")VALUES(".

		"{$post['sponsor']},'{$post['username']}','{$post['password']}',".

		"'{$post['email']}',0,0,'{$post['fname']}','{$post['lname']}',".

		"'{$post['company']}','{$post['regnum']}','{$post['drvnum']}',".

		"'{$post['address']}','{$post['city']}','{$post['country']}',".

		"'{$post['state']}','{$post['zip']}','{$post['phone']}',".

		"'{$post['fax']}'".

		")"

	);

	$newid=newid();

	db_query("INSERT INTO `{$data['DbPrefix']}member_emails`

	(`owner`,`email`,`active`,`primary`) VALUES

	('{$newid}','{$post['email']}',1,1)

	");

	return $newid;

}



function update_profile_info($post, $uid, $notify=true){

	global $data;

	if(!$post['sponsor'])$post['sponsor']=0;

	db_query(

		"UPDATE `{$data['DbPrefix']}members` SET ".

		"`sponsor`={$post['sponsor']},`type`='{$post['type']}',".

		"`empty`=0,`fname`='{$post['fname']}',`lname`='{$post['lname']}',".

		"`company`='{$post['company']}',`address`='{$post['address']}',".

		"`city`='{$post['city']}',`wilaya`='{$post['wilaya']}',".

		"`state`='{$post['state']}',`postcode`='{$post['postcode']}',".

		"`phone`='{$post['phone']}',`fax`='{$post['fax']}',".

		"`mobile`='{$post['mobile']}',`description`='{$post['description']}'".

		" WHERE `id`={$uid}"

	);

	if($notify){

		$post['email']=get_member_email($uid);

		send_email('UPDATE-MEMBER-PROFILE', $post);

	}

}



function update_private_info($post, $uid){

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}members` SET ".

		"`username`='{$post['username']}',`password`='{$post['password']}',".

		"`email`='{$post['email']}' WHERE `id`={$uid}"

	);

}




function insert_email_info($email, $uid, $notify=true){

        global $data;

        db_query(

                "INSERT INTO `{$data['DbPrefix']}member_emails`(".

                "`owner`,`email`,`status`".

                ")VALUES(".

                "{$uid},'{$email}',0)"

        );

        if($notify)send_email_request(newid());

        return newid();

}



function delete_email_info($gid){

        global $data;

        db_query(

                "DELETE FROM `{$data['DbPrefix']}member_emails`".

                " WHERE `id`={$gid}"

        );

}



function send_email_request($gid){

        global $data;

        $emails=db_rows(

                "SELECT * FROM `{$data['DbPrefix']}member_emails`".

                " WHERE `id`={$gid} LIMIT 1"

        );

        if($emails[0]){

                $post['ccode']=gencode();

                db_query(

                         "UPDATE `{$data['DbPrefix']}member_emails`".

                         " SET `confirm`='{$post['ccode']}', `status`=1".

                         " WHERE `id`={$gid}"

                );

                $post['email']=$emails[0]['email'];

                send_email('CONFIRM-EMAIL', $post);

        }

}



function set_default_email($gid){

        global $data;

        $emails=db_rows(

                "SELECT * FROM `{$data['DbPrefix']}member_emails`".

                " WHERE `id`={$gid} LIMIT 1"

        );

        if($emails[0]){

                db_query(

                         "INSERT INTO `{$data['DbPrefix']}member_emails`(".

                         "`owner`,`email`,`status`".

                         ")VALUES(".

                         "{$emails[0]['owner']},'".get_member_email($emails[0]['owner'])."',2)"

                );

                db_query(

                         "UPDATE `{$data['DbPrefix']}members`".

                         " SET `email`='{$emails[0]['email']}'".

                         " WHERE `id`={$emails[0]['owner']}"

                );

                db_query(

                         "DELETE FROM `{$data['DbPrefix']}member_emails`".

                         " WHERE `id`={$emails[0]['id']}"

                );

        }

}



function insert_card_info($post, $uid, $notify=true){

        global $data;

        db_query(

                "INSERT INTO `{$data['DbPrefix']}cards`(".

                "`owner`,`ctype`,`cname`,`cnumber`,`ccvv`,`cmonth`,`cyear`,".

                "`status`,`default`".

                ")VALUES(".

                "{$uid},'{$post['ctype']}','{$post['cname']}',".

                "'{$post['cnumber']}','{$post['ccvv']}',".

                "{$post['cmonth']},{$post['cyear']},".

                "0,0)"

        );

        if($notify){

                $post['email']=get_member_email($uid);

                send_email('UPDATE-CARD-INFORMATION', $post);

        }

        return newid();

}



function update_card_info($post, $gid, $uid, $notify=true){

        global $data;

        $cnumber=(is_changed($post['cnumber']))?"`cnumber`='{$post['cnumber']}',":'';

        $ccvv=(is_changed($post['ccvv']))?"`ccvv`='{$post['ccvv']}',":'';

        db_query(

                "UPDATE `{$data['DbPrefix']}cards` SET ".

                "`ctype`='{$post['ctype']}',`cname`='{$post['cname']}',".

                "{$cnumber}{$ccvv}".

                "`cmonth`={$post['cmonth']},`cyear`={$post['cyear']}".

                " WHERE `id`={$gid}"

        );

        if($notify){

                $post['email']=get_member_email($uid);

                send_email('UPDATE-CARD-INFORMATION', $post);

        }

}



function delete_card($gid){

        global $data;

        db_query(

                "DELETE FROM `{$data['DbPrefix']}cards`".

                " WHERE `id`={$gid}"

        );

}



function select_cards($uid, $hiden=true, $id=0, $single=false){

        global $data;

        $cards=db_rows(

                "SELECT * FROM `{$data['DbPrefix']}cards`".

                " WHERE `owner`={$uid}".

                ($id?" AND `id`={$id}":'').($single?" LIMIT 1":'')

        );

        $result=array();

        foreach($cards as $key=>$value){

                foreach($value as $name=>$v){

                   $result[$key][$name]=$v;

                   if($hiden){

                     if($name=='cnumber') $result[$key][$name]=encode($v, 4);

                     elseif($name=='ccvv') $result[$key][$name]=encode($v, 1);

                   }

                }

        }

        return $result;

}



function insert_bank_info($post, $uid, $notify=true){

        global $data;

        db_query(

                "INSERT INTO `{$data['DbPrefix']}banks`(".

                "`owner`,`bname`,`baddress`,`bcity`,`bzip`,`bcountry`,`bstate`,".

                "`bphone`,`bnameacc`,`baccount`,`btype`,`brtgnum`,`bswift`,".

                "`status`,`default`".

                ")VALUES(".

                "{$uid},'{$post['bname']}','{$post['baddress']}','{$post['bcity']}',".

                "'{$post['bzip']}','{$post['bcountry']}','{$post['bstate']}',".

                "'{$post['bphone']}','{$post['bnameacc']}','{$post['baccount']}',".

                "'{$post['btype']}','{$post['brtgnum']}','{$post['bswift']}',".

                "0,0)"

        );

        if($notify){

                $post['email']=get_member_email($uid);

                send_email('UPDATE-BANK-INFORMATION', $post);

        }

        return newid();

}



function update_bank_info($post, $gid, $uid, $notify=true){

        global $data;

        db_query(

                "UPDATE `{$data['DbPrefix']}banks` SET ".

                "`bname`='{$post['bname']}',`baddress`='{$post['baddress']}',".

                "`bcity`='{$post['bcity']}',`bzip`='{$post['bzip']}',".

                "`bcountry`='{$post['bcountry']}',`bstate`='{$post['bstate']}',".

                "`bphone`='{$post['bphone']}',`bnameacc`='{$post['bnameacc']}',".

                "`baccount`='{$post['baccount']}',`btype`='{$post['btype']}',".

                "`brtgnum`='{$post['brtgnum']}',`bswift`='{$post['bswift']}'".

                " WHERE `id`={$gid}"

        );

        if($notify){

                $post['email']=get_member_email($uid);

                send_email('UPDATE-BANK-INFORMATION', $post);

        }

}



function delete_bank($gid){

        global $data;

        db_query(

                "DELETE FROM `{$data['DbPrefix']}banks`".

                " WHERE `id`={$gid}"

        );

}



function select_banks($uid, $id=0, $single=false){

        global $data;

        $banks=db_rows(

                "SELECT * FROM `{$data['DbPrefix']}banks`".

                " WHERE `owner`={$uid}".

                ($id?" AND `id`={$id}":'').($single?" LIMIT 1":'')

        );

        $result=array();

        foreach($banks as $key=>$value){

                foreach($value as $name=>$v)$result[$key][$name]=$v;

        }

        return $result;

}



function set_trtype($uid, $dir){

	switch($dir){

		case 'both':

			return "(`sender`={$uid} OR `receiver`={$uid})";

		case 'incoming':

			return "`receiver`={$uid}";

		case 'outgoing':

			return "`sender`={$uid}";

	}

	return '';

}



function get_trans_count($where=''){
	global $data;
	$result=db_rows("SELECT COUNT(`id`) AS `count` FROM `{$data['DbPrefix']}transactions`{$where} LIMIT 1");
	return $result[0]['count'];
}

function get_transactions_count($uid, $dir='both', $extra='1'){

	$result=get_trans_count(

		' WHERE '.($uid>0?set_trtype($uid, $dir).

		($extra?" AND {$extra}":''):($extra?" {$extra}":''))

	);

	return $result;

}



function get_transactions_summ($where){

	global $data;

	$rows=db_rows(

		'SELECT SUM(`amount`) AS `summ`, SUM(`fees`) AS `fees`'.

		" FROM `{$data['DbPrefix']}transactions`".

		($where?" WHERE {$where}":'').' ORDER BY `tdate` LIMIT 1'

	);

	$result['summ']=$rows[0]['summ'];

	$result['fees']=$rows[0]['fees'];

	return $result;

}



function get_transactions_summary($dateA, $dateB){

	global $data;

	foreach($data['TransactionType'] as $key=>$value){

		$rows=get_transactions_summ(

			"`type`={$key} AND".

			" UNIX_TIMESTAMP(`tdate`)>={$dateA} AND".

			" UNIX_TIMESTAMP(`tdate`)<{$dateB}"

		);

		$result[$value]['Summ']=$rows['summ']?$rows['summ']:0;
		$result[$value]['Fees']=$rows['fees']?$rows['fees']:0;

	}

	return $result;

}



function get_transactions_year(){

	global $data;

	$years=db_rows(

		"SELECT MIN(YEAR(`tdate`)) AS `min`, MAX(YEAR(`tdate`)) AS `max`".

		" FROM `{$data['DbPrefix']}transactions` LIMIT 1"

	);

	$result['min']=$years[0]['min'];

	$result['max']=$years[0]['max'];

	return $result;

}



function get_transactions_period(){

        global $data;

        $period=db_rows(

                "SELECT MIN(`tdate`) AS `min`, MAX(`tdate`) AS `max`".

                " FROM `{$data['DbPrefix']}transactions` LIMIT 1"

        );

        $result['min']=getdate(strtotime($period[0]['min']));

        $result['max']=getdate(strtotime($period[0]['max']));

        return $result;

}



function can_refund($id, $uid){

	global $data;

	$balance=select_balance($uid);

	$result=db_rows(

		"SELECT `id` FROM `{$data['DbPrefix']}transactions`".

		" WHERE `id`={$id} AND `receiver`={$uid}".

		" AND `type` in (0,1) AND (`status`=0 OR `status`=1)".

		" AND `amount`<{$balance}".

		" AND TO_DAYS(NOW())-TO_DAYS(`tdate`)<{$data['RefundPeriod']}"

	);

	return $result[0];

}



function get_status_color($status){

	$result='000000';

	switch($status){

	case 0:
		$result='blue';
		break;
	case 1:
		$result='green';
		break;
	case 2:
		$result='red';
		break;
	case 3:
		$result='maroon';
		break;
	case 4:
		$result='orange';
		break;
	case 99:
		$result='red';
		break;
	}
	return $result;
}

function get_notification_by_id($user_id, $notification_id ){
  global $data;

  $sql = "SELECT *".
  " FROM `{$data['DbPrefix']}notifications` ".
  " WHERE `{$data['DbPrefix']}notifications`.id = '".$notification_id."' ".
  " AND `{$data['DbPrefix']}notifications`.member_id = '".$user_id."' ";

  // echo nl2br($sql);
  $notification = db_rows($sql);
  return $notification[0];
}

function get_transaction_by_id($user_id, $transaction_id ){
  $transaction = get_transactions($user_id, 'both', -1, -1, 0, 0, '', '', '', $transaction_id);
  // var_dump($transaction);
  return $transaction[0];
}

function get_transactions($uid, $dir='both', $type=-1, $status=-1, $start=0,$count=0, $order='', $suser='', $sdate='', $transaction_id=''){

	global $data;

	if($suser||$sdata){
		$start=0;
		$count=0;
	}

	$order=($order?$order:'ORDER BY `tdate` DESC');
	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):
		($count?" LIMIT {$count}":''));

  $sql = "SELECT *,(TO_DAYS(NOW())-TO_DAYS(`tdate`)) as `period`".
  " FROM `{$data['DbPrefix']}transactions` ".
  " WHERE `{$data['DbPrefix']}transactions`.id !=0 ".
  ($uid?" AND ".set_trtype($uid, $dir):'').
  ($type<0? '' : " AND `type`={$type}").
  ($status<0? '' : " AND `status`={$status}").
  ($transaction_id==''? '' : " AND `id`={$transaction_id}").
  " {$order}{$limit}";

  // echo nl2br($sql);

  $trans=db_rows($sql);

	$result=array();

	foreach($trans as $key=>$value){
		if($suser){
			if(
				strpos(get_member_username($value['sender']), $suser)===false
				&&
				strpos(get_member_username($value['receiver']), $suser)===false
			)continue;
		}elseif($sdate){
			if(strpos($value['tdate'], $sdate)===false)continue;
		}
		$dir=(bool)($value['sender']!=$uid);
		$result[$key]['id']=$value['id'];
		$result[$key]['direction']=$dir?'1':'0';
		$result[$key]['sender']=$value['sender'];
		// $result[$key]['senduser']=prnuser($value['sender']);
		$result[$key]['senduser']=prnuser($value['sender']);
		$result[$key]['receiver']=$value['receiver'];
		// $result[$key]['recvuser']=prnuser($value['receiver']);
		$result[$key]['recvuser']=prnuser($value['receiver']);
		$result[$key]['userid']=$dir?$value['sender']:$value['receiver'];
		// $result[$key]['username']=prnuser($result[$key]['userid']);
		$result[$key]['username']=prnuser($result[$key]['userid']);
		$result[$key]['oamount']=$dir?$value['amount']:-$value['amount'];
		$result[$key]['amount']=prnpays($result[$key]['oamount']);
		$result[$key]['tdate']=prndate($value['tdate']);
		$result[$key]['period']=$value['period'];
		$result[$key]['ostatus']=$value['status'];
		$result[$key]['type']=$data['TransactionType'][$value['type']];
		$result[$key]['status']="<font color=".get_status_color($value['status']).">".$data['TransactionStatus'][$value['status']].'</font>';
    $result[$key]['status_color'] = get_status_color($value['status']);
		if($value['fees']>0 && ($value['type']==1||$value['type']==2||($dir&&$value['type']==0)) ){
			$result[$key]['ofees']=-$value['fees'];
		}elseif ($value['type']==3 ){
				$result[$key]['ofees']=-$value['fees'];
		}else {
			$result[$key]['ofees']=0;
		}
		$result[$key]['fees']=prnfees($result[$key]['ofees']);
		if ($value['type']==3) {
			$result[$key]['onets'] = $value['amount']+$value['fees'];
		} else {
			$result[$key]['onets']=$value['sender']>0&&$value['sender']==$uid&&$value['receiver']>0?$value['amount']:$value['amount']-$value['fees'];
		}
		$result[$key]['nets']=prnpays($result[$key]['onets'], false);
		$result[$key]['comments']=prntext($value['comments']);
		$result[$key]['ecomments']=prntext($value['ecomments']);
		$result[$key]['canview']=($value['type']>=0&&$value['type']<=3);
		$result[$key]['canrefund']=can_refund($value['id'], $uid);
		$result[$key]['trxid']=$value['trxid'];
	}
	return $result;
}


function get_transactions_ussd ($uid, $start=0,$count=0 ){

	global $data;

	$order=($order?$order:'ORDER BY `tdate` DESC');
	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):
		($count?" LIMIT {$count}":''));
	$trans=db_rows(
		"SELECT *,(TO_DAYS(NOW())-TO_DAYS(`tdate`)) as `period`".
		" FROM `{$data['DbPrefix']}transactions` INNER JOIN `{$data['DbPrefix']}ussd` ON id = ussd_trx_id  ".
		" WHERE `sender` =".$uid." AND `type`=3 ".
		" {$order}{$limit}");
	$result=array();

	foreach($trans as $key=>$value){

		$dir=(bool)($value['sender']!=$uid);
		$result[$key]['id']=$value['id'];
		$result[$key]['direction']=$dir?'1':'0';
		$result[$key]['sender']=$value['sender'];
		$result[$key]['senduser']=prnuser($value['sender']);
		$result[$key]['receiver']=$value['receiver'];
		$result[$key]['recvuser']=prnuser($value['receiver']);
		$result[$key]['userid']=$dir?$value['sender']:$value['receiver'];
		$result[$key]['username']=prnuser($result[$key]['userid']);
		$result[$key]['oamount']=$dir?$value['amount']:-$value['amount'];
		$result[$key]['amount']=prnpays($result[$key]['oamount']);
		//$result[$key]['tdate']=smalldate($value['tdate']);
		$result[$key]['tdate']=prndate($value['tdate']);
		$result[$key]['period']=$value['period'];
		$result[$key]['ostatus']=$value['status'];
		$result[$key]['type']=$data['TransactionType'][$value['type']];
		$result[$key]['status']="<font color=".get_status_color($value['status']).">".$data['TransactionStatus'][$value['status']].'</font>';

		if($value['fees']>0 && ($value['type']==1||$value['type']==2||($dir&&$value['type']==0)) ){
			$result[$key]['ofees']=-$value['fees'];
		}elseif ($value['type']==3 ){
				$result[$key]['ofees']=-$value['fees'];
		}else {
			$result[$key]['ofees']=0;
		}
		$result[$key]['fees']=prnfees($result[$key]['ofees']);
		//if ($value['type']==3) {
		//	$result[$key]['onets'] = $value['amount']+$value['fees'];
		//} else {
			$result[$key]['onets']=$value['sender']>0&&$value['sender']==$uid&&$value['receiver']>0?$value['amount']:$value['amount']+$value['fees'];
		//}
		$result[$key]['nets']=prnpays($result[$key]['onets'], false);
		$result[$key]['comments']=prntext($value['comments']);
		$result[$key]['ecomments']=prntext($value['ecomments']);
		$result[$key]['canview']=($value['type']>=0&&$value['type']<=3);
		$result[$key]['canrefund']=can_refund($value['id'], $uid);
		$result[$key]['ussd_operator']=$value['ussd_operator'];
		$result[$key]['ussd_number']=$value['ussd_number'];
		$result[$key]['ussd_retries']=$value['ussd_retries'];


	}
	return $result;
}




function get_transaction_detail($id, $uid){

	global $data;
	$trans=db_rows("SELECT * FROM `{$data['DbPrefix']}transactions` WHERE `id`={$id} LIMIT 1");
	$trans=$trans[0];
	if($trans){

		$dir=(bool)($trans['sender']!=$uid);
		$result['id']=$trans['id'];
		$result['direction']=$dir?'FROM':'TO';
		$result['sender']=$trans['sender'];
		$result['receiver']=$trans['receiver'];
		$result['userid']=$dir?$trans['sender']:$trans['receiver'];
		$result['username']=prnuser($result['userid']);
		$result['oamount']=$dir?$trans['amount']:-$trans['amount'];
		$result['amount']=prnpays($dir?$trans['amount']:-$trans['amount']);
		$result['ofees']=$dir?$trans['fees']:+$trans['fees'];
		$result['tdate']=prndate($trans['tdate']);
		$result['otype']=$trans['type'];
		$result['type']=ucfirst($data['TransactionType'][$trans['type']]);
		$result['ostatus']=$trans['status'];
		$result['status']=
			"<font color=".get_status_color($trans['status']).">".
			ucfirst($data['TransactionStatus'][$trans['status']]).
			"</font>";
		if($trans['fees']>0&&($trans['type']==1||$trans['type']==2|| $trans['type']==3 || ($dir&&$trans['type']==0))){
			$result['fees']=-$trans['fees'];
		}else{
			$result['fees']=0;
		}
		if ($trans['type']==3) {
			$result['nets'] = prnpays($trans['amount'] + $trans['fees'],false);
		} else {
			$result['nets']=$trans['sender']>0&&$trans['sender']==$uid&&$trans['receiver']>0?prnpays($trans['amount'], false):prnpays($trans['amount']-$trans['fees'], false);
		}
		$result['comments']=prntext($trans['comments']);
		$result['ecomments']=prntext($trans['ecomments']);
		$result['canrefund']=can_refund($trans['id'], $uid);
		$result['trxid']=$trans['trxid'];
	}
	return $result;
}
function get_receiver($id){
	global $data;
	$result=db_rows("SELECT `receiver`,`fees` FROM `{$data['DbPrefix']}transactions` WHERE `id`={$id} LIMIT 1");
	return $result[0];
}

function insert_transaction($trx_id ,$sender, $receiver, $related, $amount, $fees, $type, $status, $comments='', $ecomments='' ){

	global $data;
  $sql = "INSERT INTO `{$data['DbPrefix']}transactions`".
  "(`tdate`,`sender`,`receiver`,`related`,`amount`,`fees`,`type`,`status`,".
  "`comments`,`ecomments` ,`trxid` )VALUES".
  "('".date("Y-m-d H:i:s")."',{$sender},{$receiver},{$related},{$amount},{$fees},{$type},{$status},".
  "'".addslashes($comments)."','".addslashes($ecomments)."','".addslashes($trx_id)."')";

  $insert = db_query($sql);

  // echo nl2br($sql);

  return $insert;

}



function insert_commissions($uid, $amount){

	global $data;

	$i=0;

	$fees=($amount*$data['ReferralPercent']/100);

	$sponsor=get_sponsor_id($uid);

	$recvname=get_member_username($uid);

	$trxid = get_trx_id();

	while($sponsor&&$i<$data['ReferralLevels']-1){

		insert_transaction(

			$trxid,
			-1,
			$sponsor,
			$uid,
			$fees,
			0,
			5,
			1,
			"Commission from member {$recvname}"


		);

		$sponsor=get_sponsor_id($sponsor);

		$i++;

	}

}



function unreg_member_pay($sender, $receiver, $amount, $comments) {

	global $data;

	db_query(

		"INSERT INTO `{$data['DbPrefix']}temp_pays`".

		" (`tdate`,`sender`,`receiver`,`amount`,`status`,".

		"`comments`)VALUES".

		"(NOW(),{$sender},'{$receiver}',{$amount},0,".

		"'".addslashes($comments)."')"

	);

	$post['email']=$receiver;

	$post['username']=get_member_username($sender);

	$post['emailadr']=get_member_email($sender);

	$post['amount']=$amount;

	$post['comments']=$comments;

	send_email('PAYMENT-TO-UNREGMEMBER', $post);



}



function get_unreg_member_pay($uid, $which='SENDER', $status=0) {

	global $data;

	if($which=='RECEIVER') $receiver=get_member_email($uid);

	$trans=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}temp_pays`".

		($which=='RECEIVER'?" WHERE `receiver`='{$receiver}' AND `status`={$status} ":

		" WHERE `sender`={$uid} AND `status`={$status} ")



	);

	$result=array();

	foreach($trans as $key=>$value){

		$result[$key]['id']=$value['id'];

		$result[$key]['receiver']=$value['receiver'];

		$result[$key]['sender']=$value['sender'];

		$result[$key]['recvuser']=prnuser($value['receiver']);

		$result[$key]['amount']=prnpays($value['amount']);

		$result[$key]['tdate']=prndate($value['tdate']);

		$result[$key]['comments']=prntext($value['comments']);



	}

	return $result;

}



function delete_unreg_member_pay($id) {

	global $data;

	db_query(

                "DELETE FROM `{$data['DbPrefix']}unreg_member_pays`".

                " WHERE `id`={$id}"

        );

}



function update_unreg_member_pays($receiver) {

	global $data;

	// purge older than 10 days

	db_query(

		"DELETE FROM `{$data['DbPrefix']}temp_pays`".

		" WHERE(TO_DAYS(NOW())-TO_DAYS(`tdate`)>=10 AND `status`=0)"

	);

	$receiver_email=get_member_email($receiver);

	$pending=db_rows("SELECT *".

" FROM `{$data['DbPrefix']}temp_pays` WHERE(`receiver`='{$receiver_email}' AND `status`=0)"

	);

	$pending=$pending[0];

	foreach($pending as $key=>$value){

		$pending[$key] = @addslashes($value);

	}

	$fees=($pending['amount']*$data['PaymentPercent']/100)+$data['PaymentFees'];

	transaction(get_trx_id() ,$pending['sender'], $receiver, $pending['amount'], $fees,0,1, $pending['comments'] );

	db_query(

                "UPDATE `{$data['DbPrefix']}temp_pays`".

                " SET `status`=1".

                " WHERE `receiver`='{$receiver_email}'"
        );
	//TO DO: email confirmation to sender

	$post['fees']=$fees;
	$post['email']=get_member_email($pending['receiver']);
	$post['amount']=$pending['amount'];
	$post['sender']=$pending['sender'];
	send_email('PAY-FROM-UNREGMEM-ACCEPTED', $post);
	// delete old completed transactions in table temp_pays?? or not?
}

function transaction($trxid ,$sender, $receiver, $amount, $fees, $type, $status, $comments='', $ecomments='' ){

	global $data;

	$insert = insert_transaction($trxid ,$sender, $receiver, 0, $amount, $fees, $type, $status, $comments, $ecomments);

	if($sender>0 && $type==0){

		if($data['ReferralPays']) insert_commissions($receiver, $fees);

	}

  return $insert;

}



function update_transaction_status($uid, $id, $status){

	global $data;
	if($uid>0){
		$user=get_member_info($uid);
		$name="{$user['fname']} {$user['lname']} ({$user['username']})";
	}else{
		$name='System Administrator (system)';
	}
	$tran=get_transaction_detail($id, $uid);
	$post['email']=get_member_email($tran['receiver']);
	$where='';
	$comments='';
	switch($status){
		case 1:
			if($uid>0)$where=" AND `sender`={$uid}";
			$comments="La transaction a &eacute;t&eacute; confirm&eacute;e par {$name}";

			if($tran['otype']==1||$tran['otype']==3){
				if($data['ReferralPays'])insert_commissions($tran['receiver'], $tran['ofees']);
			}
			if($tran['otype']==3)send_email('CONFIRM-ESCROW', $post);
			break;
		case 2:
			if(($uid>0)&&($uid==$tran['sender'])){
				unset($status);
				break;
			}
			$comments="La transaction a &eacute;t&eacute; annul&eacute;e par {$name}";
			if($tran['otype']==3)send_email('CANCEL-ESCROW', $post);
			break;
		case 3:
			$comments="La transaction a &eacute;t&eacute; rembours&eacute;e par {$name}";
			if($tran['otype']==3)send_email('REFUND-ESCROW', $post);
			break;
	}
	$update = db_query(
		"UPDATE `{$data['DbPrefix']}transactions`".
		" SET `tdate`=NOW(),`status`={$status},`comments`='{$comments}'".
		" WHERE `id`={$id}{$where}"
	);

  return $update;
}

function update_transaction_status_topup( $id, $status,$comments){

	global $data;

	db_query(
		"UPDATE `{$data['DbPrefix']}transactions`".
		" SET `tdate`=NOW(),`status`={$status},`comments`='{$comments}'".
		" WHERE `id`={$id}"
	);
}
#################################################################################################
# ussd function
#################################################################################################
 function get_ussd_by_trx_id($trx_id=''){
   global $data;

   $result=db_rows(

     "SELECT  `{$data['DbPrefix']}transactions`.status, {$data['DbPrefix']}ussd.* FROM `{$data['DbPrefix']}ussd` ".
     "INNER JOIN  `{$data['DbPrefix']}transactions` ".
          "ON (`{$data['DbPrefix']}transactions`.id = `{$data['DbPrefix']}ussd`.ussd_trx_id) ".
     "WHERE `ussd_retries`={$trx_id} LIMIT 1"
    );

   return $result[0];
}

function ussd($user_id,$trx_id ,$operator, $mobile, $montant,$status,$api_trx_id ){

	global $data;

	if($operator == 'Djezzy') {
		$server_span = '1';
	} else if($operator == 'Mobilis') {
		$server_span = '3';
	} else if($operator == 'Ooredoo') {
		$server_span = '2';
	}

	db_query(
		"INSERT INTO `{$data['DbPrefix']}ussd`".
		"(`ussd_trx_id`,`ussd_user_id`, `ussd_operator`,`ussd_number`,`ussd_amount`,`ussd_status`,`ussd_created_date`, `ussd_type`,`ussd_source`, `ussd_server_ip`, `ussd_server_span`,`ussd_retries`) VALUES".
"('{$trx_id}','{$user_id}','{$operator}','{$mobile}',{$montant},'{$status}','".date("Y-m-d H:i:s")."','Credit', 'Edinars', '192.168.30.220', '{$server_span}' , {$api_trx_id})");

}

#################################################################################################
# Produit function
#################################################################################################



function select_product_details($id, $uid){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}products`".

		" WHERE `id`={$id} AND `owner`={$uid} LIMIT 1"

	 );

	return $result[0];

}


function update_sold($id, $quantity){

	global $data;

	db_query(
		"UPDATE `{$data['DbPrefix']}products` SET `sold`= `sold` + {$quantity}".
		" WHERE `id`={$id}" );
}


###############################################################################

function select_button($id){

	global $data;

	$result=db_rows(

		"SELECT `button` FROM `{$data['DbPrefix']}products` WHERE `id`={$id} LIMIT 1"

	);

	return $result[0]['button'];

}



function select_type($id){

	global $data;

	$result=db_rows(

		"SELECT `type` FROM `{$data['DbPrefix']}products` WHERE `id`={$id} LIMIT 1"

	);

	return $result[0]['type'];

}



function insert_subscription($owner, $member, $product){

	global $data;

	db_query(

		"INSERT INTO `{$data['DbPrefix']}subscriptions`(".

		"`owner`,`member`,`product`,`sdate`,`pdate`".

		")VALUES(".

		"{$owner},{$member},{$product},NOW(),NOW()".

		")"

	);

	db_query(

		"UPDATE `{$data['DbPrefix']}products` SET".

		" `sold`=`sold`+1".

		" WHERE `id`={$product}"

	);

}



function select_subscriptions($uid){

	global $data;

	$subscr=db_rows(

		"SELECT s.id,s.owner,s.pdate,p.nom,p.prix,p.periode".

		" FROM `{$data['DbPrefix']}subscriptions` AS s,`{$data['DbPrefix']}products` AS p".

		" WHERE s.owner={$uid} AND p.id=s.product"

	);
	$result=array();

	foreach($subscr as $key=>$value){

		$result[$key]['id']=$value['id'];

		$result[$key]['owner']=get_member_username($value['owner']);

		$result[$key]['prix']=$value['prix'];

		$result[$key]['periode']=$value['periode'];

		$result[$key]['nom']=$value['nom'];

		$result[$key]['pdate']=$value['pdate'];

	}

	return $result;

}



function cancel_subscription($id){

	global $data;

	$rows=db_rows(

		"SELECT `owner`,`member`,`product`".

		" FROM `{$data['DbPrefix']}subscriptions`".

		" WHERE `id`={$id}"

	);

	$owner=$rows[0]['owner'];

	$member=$rows[0]['member'];

	$product=$rows[0]['product'];

	$rows=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}products`".

		" WHERE `id`={$product}"

	);

	$product_infos=$rows[0];

  // echo nl2br("UPDATE `{$data['DbPrefix']}products` SET".
  // " `sold`=`sold`-1".
  //
  // " WHERE `id`={$product}");
  // exit();

	db_query(

		"UPDATE `{$data['DbPrefix']}products` SET".

		" `sold`=`sold`-1".

		" WHERE `id`={$product}"

	);

	$cancel = db_query(

		"DELETE FROM `{$data['DbPrefix']}subscriptions` WHERE `id`={$id}"

	);

	$owner=get_member_info($owner);

	$post['product']=$product;

	$post['username']=$owner['username'];

	$post['fullname']="{$owner['fname']} {$owner['lname']}";

	$post['email']=$owner['email'];

	$member=get_member_info($member);

	$post['comments']=

		"Member username: {$member['username']}\n".

		"Member e-mail address: {$member['email']}\n"

	;

	send_email('MEMBER-CANCELLED-SUBSCRIPTION', $post);

  return $cancel;
}



function get_referrals_count($uid){

	global $data;

	$result=db_rows(

		"SELECT COUNT(`id`) as total FROM `{$data['DbPrefix']}members`".

		" WHERE `sponsor`={$uid}"

	);

	return $result[0]['total'];

}



function optimize($uid){

	global $data;

	$fp=@fopen("{$data['Path']}/{$uid}.htm", 'w+');

	@fwrite($fp, '');

	@fclose($fp);

}



function calculate_downline($uid, $clevel, $result=null){

	global $data;

	$members=mysql_query("SELECT * FROM `{$data['DbPrefix']}members` WHERE `sponsor`={$uid}");

	if($members){

		while($row=mysql_fetch_array($members, MYSQL_ASSOC)){

			$nlevel=$clevel+1;

			if($nlevel>$data['ReferralLevels'])return $result;

			$query=mysql_query(

				"SELECT SUM(`amount`) AS `earned`".

				" FROM `{$data['DbPrefix']}transactions`".

				" WHERE `receiver`={$uid} AND `sender`=-1 AND `related`={$row['id']}"

			);

			if($query){

				$arow=mysql_fetch_array($query, MYSQL_ASSOC);

				$result+=$arow['earned'];

			}

			$result=calculate_downline($row['id'], $nlevel, $result);

		}

	}

	return $result;

}



function get_referrals($uid, $start=0, $count=0){

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$members=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}members`".

		" WHERE `sponsor`={$uid} ORDER BY `cdate` DESC{$limit}"

	);

	$result=array();

	foreach($members as $key=>$value){

		$result[$key]['id']=$value['id'];

		$result[$key]['cdate']=prndate($value['cdate']);

		$result[$key]['username']=prnuser($value['id']);

		$result[$key]['fullname']="{$value['fname']} {$value['lname']}";

		$result[$key]['email']=prntext($value['email']);

		$result[$key]['fname']=prntext($value['fname']);

		$result[$key]['lname']=prntext($value['lname']);

		$result[$key]['referrals']=get_referrals_count($value['id']);

		$result[$key]['payments']=get_transactions_count(

			$value['id'], 'both', '`type`=0 AND `status`=1'

		);

		$result[$key]['earned']=prnpays(calculate_downline($uid, 1));

	}

	return $result;

}

###############################################################################

function get_news($where){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}news`".

		" WHERE {$where} ORDER BY `date` DESC"

	);

	return $result;

}



function get_latest_news(){

	global $data;

	$result=get_news('`active`>0');

	return $result;

}

###############################################################################

function select_banners($owner){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}banners` WHERE `owner`={$owner}"

	);

	return $result;

}



function fetch_banner($id){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}banners` WHERE `id`={$id}"

	);

	return $result[0];

}



function insert_banner($owner, $burl, $lurl, $pkg, $per){

	global $data;

	db_query(

		"INSERT INTO `{$data['DbPrefix']}banners` (".

		"`owner`,`burl`,`lurl`,`package`,`views`,`clicks`,".

		"`cdate`,`fdate`,`ldate`,`active`".

		")VALUES(".

		"{$owner},'{$burl}','{$lurl}',{$pkg},0,0,NOW(),NOW()+interval $per day,NOW(),0".

		")"

	);

}



function delete_banners($id){

	global $data;

	db_query(

		"DELETE FROM `{$data['DbPrefix']}banners` WHERE `id`={$id}"

	);

}



function get_banner_id(){

	global $data;

	$result=db_rows(

		"SELECT b.`id`,p.`credits`,now()-b.`ldate`,(now()-b.`ldate`)*p.`credits`".

		" FROM `dp_banners` b, `dp_banners_packages` p ".

		" WHERE b.`package`=p.`id` AND b.`active`=1 ".

		" ORDER BY (now()-b.`ldate`)*p.`credits` desc"

	);

	return ($result)? $result[0]['id']:0;

}



function inc_banner_views($id){

	global $data;

	db_query(

		"UPDATE `dp_banners` SET `ldate`=now(), `views`=`views`+1 WHERE `id`={$id}"

	);

}



function inc_banner_clicks($id){

	global $data;

	db_query(

		"UPDATE `dp_banners` SET `clicks`=`clicks`+1 WHERE `id`={$id}"

	);

}



function select_banners_packages(){

	global $data;

	$rows=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}banners_packages` WHERE `active`=1"

	);

	$result=array();

	if($rows)foreach($rows as $val) $result[$val['id']]=$val['name'];

	return $result;

}



function fetch_banners_packages($id){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}banners_packages` WHERE `id`={$id}"

	);

	return $result[0];

}

###############################################################################

function get_mail_templates(){

	global $data;

	return db_rows("SELECT * FROM `{$data['DbPrefix']}emails`");

}



function select_mail_template($key){

	global $data;

	$result=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}emails`".

		" WHERE `key`='{$key}' LIMIT 1"

	);

	return $result[0];

}



function update_mail_template($key, $name, $value){

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}emails`".

		" SET `name`='".addslashes($name)."',`value`='".addslashes($value)."'".

		" WHERE `key`='{$key}'"

	);

}

###############################################################################

function get_categories_tree($categoryid) {

  global $data;

  if ($categoryid == 0) return "TOP CATEGORIES";

  $parent = db_rows(

		"SELECT `id`, `parentid`, `name` FROM `{$data['DbPrefix']}shop_categories` ".

    "WHERE id={$categoryid}"

  );

  $result = "<a href='{$GLOBALS['PHP_SELF']}?action=view&cid={$parent[0]['id']}'>{$parent[0]['name']}</a>";

  while ($parent[0]['parentid'] != 0 && $parent) {

    $parent = db_rows(

      "SELECT `id`, `parentid`, `name` FROM `{$data['DbPrefix']}shop_categories` ".

      "WHERE `id`={$parent[0]['parentid']}"

    );

    $result = "<a href='{$GLOBALS['PHP_SELF']}?action=view&cid={$parent[0]['id']}'>{$parent[0]['name']}</a>&nbsp;&nbsp;&gt;&gt;&nbsp;" . $result;

  }

  return "<a href='{$GLOBALS['PHP_SELF']}?action=view'>TOP CATEGORIES</a>&nbsp;&nbsp;&gt;&gt;&nbsp;$result";

}



function get_first_root_category_id()

{

  global $data;

	$categories=db_rows(

		"SELECT id FROM `{$data['DbPrefix']}shop_categories` ".

    "WHERE parentid=0 ".

    "ORDER BY `id` ASC ".

    "LIMIT 1"

	);

  return $categories[0]['id'];

}



function get_category_parent($categoryid) {

  global $data;

	$categories=db_rows(

		"SELECT parentid FROM `{$data['DbPrefix']}shop_categories` ".

    "WHERE `id`={$categoryid}"

	);

  return $categories[0]['parentid'];

}



function get_shop_categories_count($categoryid) {

  global $data;

  $result=db_rows(

		"SELECT COUNT(`id`) AS `count` ".

    " FROM `{$data['DbPrefix']}shop_categories`".

		" WHERE `parentid`='{$categoryid}' ".

		" LIMIT 1"

  );

  return $result[0]['count'];

}



function get_shop_categories_list($categoryid, $start=0, $count=0) {

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$categories=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}shop_categories`".

		" WHERE `parentid`='{$categoryid}' ".

		" ORDER BY `id` ASC{$limit}"

	);

	$result=array();

	foreach($categories as $key=>$value){

		$result[$key]=$value;

		$subcat=db_rows(

			"SELECT COUNT(`id`) AS `count`".

			" FROM `{$data['DbPrefix']}shop_categories`".

			" WHERE `parentid`={$result[$key]['id']}".

			" LIMIT 1"

		);

    $result[$key]['subcategories']=$subcat[0]['count'];

		$items=db_rows(

			"SELECT COUNT(`id`) AS `count`".

			" FROM `{$data['DbPrefix']}shop_items`".

			" WHERE `categoryid`={$result[$key]['id']}".

			" LIMIT 1"

		);

		$result[$key]['items']=$items[0]['count'];

		$result[$key]['candelete']=($items[0]['count']==0 && $subcat[0]['count']==0);

	}

	return $result;

}



function get_shop_categories_count_where_pred($where_pred) {

  global $data;

  $result=db_rows(

		"SELECT COUNT(`id`) AS `count` ".

    " FROM `{$data['DbPrefix']}shop_categories`".

		" WHERE {$where_pred} ".

		" LIMIT 1"

  );

  return $result[0]['count'];

}



function get_shop_categories_list_where_pred($where_pred) {

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$categories=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}shop_categories`".

		" WHERE {$where_pred} ".

		" ORDER BY `id` ASC{$limit}"

	);

	$result=array();

	foreach($categories as $key=>$value){

		$result[$key]=$value;

		$subcat=db_rows(

			"SELECT COUNT(`id`) AS `count`".

			" FROM `{$data['DbPrefix']}shop_categories`".

			" WHERE `parentid`={$result[$key]['id']}".

			" LIMIT 1"

		);

    $result[$key]['subcategories']=$subcat[0]['count'];

		$items=db_rows(

			"SELECT COUNT(`id`) AS `count`".

			" FROM `{$data['DbPrefix']}shop_items`".

			" WHERE `categoryid`={$result[$key]['id']}".

			" LIMIT 1"

		);

		$result[$key]['items']=$items[0]['count'];

		$result[$key]['candelete']=($items[0]['count']==0 && $subcat[0]['count']==0);

	}

	return $result;

}



function insert_category($parentid, $post){

	global $data;

  $description = $post['categorydescription'];

  if (empty($description)) $description = "Top ".addslashes($post['categoryname']);

	db_query(

		"INSERT INTO `{$data['DbPrefix']}shop_categories`(".

		"`parentid`,`name`,`description`".

		")VALUES(".

		"{$parentid},".

		"'".addslashes($post['categoryname'])."','".addslashes($description)."')"

	);

}



function update_category($categoryid, $parentid, $post){

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}shop_categories` ".

		"SET `parentid` = {$parentid}, ".

    "`name`='".addslashes($post['categoryname'])."', ".

    "`description`='".addslashes($post['categorydescription'])."' ".

    "WHERE `id`={$categoryid}"

	);

}



function delete_category($categoryid){

	global $data;

	db_query(

		"DELETE FROM `{$data['DbPrefix']}shop_categories` ".

    "WHERE `id`={$categoryid}"

	);

}



function get_category($categoryid) {

	global $data;

	$categories=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}shop_categories` ".

    "WHERE `id`={$categoryid}".

		" LIMIT 1"

	);

  return $categories[0];

}

###############################################################################

function get_shop_items_count($categoryid) {

  global $data;

  $result=db_rows(

		"SELECT COUNT(`id`) AS `count` ".

    " FROM `{$data['DbPrefix']}shop_items`".

		" WHERE `categoryid`='{$categoryid}' ".

		" LIMIT 1"

  );

  return $result[0]['count'];

}



function get_shop_items_list($categoryid, $start=0, $count=0) {

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$categories=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}shop_items`".

		" WHERE `categoryid`='{$categoryid}' ".

		" ORDER BY `id` ASC{$limit}"

	);

	$result=array();

	foreach($categories as $key=>$value){

		$result[$key]=$value;

		$result[$key]['candelete']=true;

	}

	return $result;

}



function get_shop_items_count_where_pred($where_pred) {

  global $data;

  $result=db_rows(

		"SELECT COUNT(`id`) AS `count` ".

    " FROM `{$data['DbPrefix']}shop_items`".

		" WHERE {$where_pred} ".

		" LIMIT 1"

  );

  return $result[0]['count'];

}



function get_shop_items_list_where_pred($where_pred) {

	global $data;

	$limit=($start?($count?" LIMIT {$start},{$count}":" LIMIT {$start}"):

		($count?" LIMIT {$count}":''));

	$categories=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}shop_items`".

		" WHERE {$where_pred} ".

		" ORDER BY `id` ASC{$limit}"

	);

	$result=array();

	foreach($categories as $key=>$value){

		$result[$key]=$value;

		$result[$key]['candelete']=true;

	}

	return $result;

}



function get_shop_item($itemid) {

	global $data;

	$items=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}shop_items` ".

    "WHERE `id`={$itemid}".

		" LIMIT 1"

	);

  return $items[0];

}



function insert_shop_item($categoryid, $name, $url, $description) {

	global $data;

  if (empty($description)) $description = "Top ".addslashes($name);

	db_query(

		"INSERT INTO `{$data['DbPrefix']}shop_items`(".

		"`categoryid`,`name`, `url`, `description`".

		")VALUES(".

		"{$categoryid},".

		"'".addslashes($name)."','".addslashes($url)."','".addslashes($description)."')"

	);

}



function update_shop_item($itemid, $name, $url, $description) {

	global $data;

	db_query(

		"UPDATE `{$data['DbPrefix']}shop_items` ".

		"SET `name`='{$name}', ".

    "`url`='{$url}', ".

    "`description`='{$description}' ".

		"WHERE `id`={$itemid}"

	);

}



function delete_shop_item($itemid){

	global $data;

	db_query(
		"DELETE FROM `{$data['DbPrefix']}shop_items` WHERE `id`={$itemid}"
	);
}

###############################################################################

function insert_shopcart_item($productid, $quantity){

  if ($quantity <= 0) return false;

  $newid = count($_SESSION['ptobuy']);

  $_SESSION['ptobuy'][$newid] = array();

  $_SESSION['ptobuy'][$newid]['product'] = $productid;

  $_SESSION['ptobuy'][$newid]['quantity'] = $quantity;

}



function get_shopcart_items_list($id=-1)

{

  global $data;

  $result = array();

  for ($i = 0; $i<count($_SESSION['ptobuy']); $i++)

  if ($_SESSION['ptobuy'][$i]['product'] != -1) {

    $result[$i] = array();

    $shopitems=db_rows(

      "SELECT id, name, tax, shipping, price FROM `{$data['DbPrefix']}products` ".

      "WHERE `id` = (" . $_SESSION['ptobuy'][$i]['product'] .") "

    );

    $result[$i]['shopitemid'] = $i;

    $result[$i]['id'] = $shopitems[0]['id'];

    $result[$i]['name'] = $shopitems[0]['name'];

    $result[$i]['tax'] = $shopitems[0]['tax'];

    $result[$i]['shipping'] = $shopitems[0]['shipping'];

    $result[$i]['price'] = $shopitems[0]['price'];

    $result[$i]['quantity'] = $_SESSION['ptobuy'][$i]['quantity'];

  }

  if ($id==-1) return $result; else return $result[$id];

}



function delete_shopcart_item($itemstodel){

  $_SESSION['ptobuy'][$itemstodel]['product'] = -1;

}



function get_shopcart_items_price(){

  global $data;

  $price=0;

  $r = get_shopcart_items_list();

  foreach ($r as $key=>$value) $price += $value['quantity'] * ($value['price'] + $value['tax']) + $value['shipping'];

  return prnsumm($price);

}



function get_one_item_price($id){

  $r = get_shopcart_items_list($id);

  $price = $value['quantity'] * ($value['price'] + $value['tax']) + $value['shipping'];

  return $price;

}



function update_shopcart_item_quantity($id, $quantity){

  if ($quantity <= 0) return;

  $_SESSION['ptobuy'][$id]['quantity'] = ceil($quantity);

}



function set_shopitems_paid(){

  $_SESSION['ptobuy'] = array();

}

###############################################################################

function unhtmlentities($text){

	$table=get_html_translation_table(HTML_ENTITIES);

	$table=array_flip($table);

	return strtr($text, $table);

}

############################### SECURITY ################################################

function encrypt_pages($content){
	$r="<NOSOURCE>";
	for($i=0;$i<255;$i++)$r.="\n";
	return $r.encrypt($content);
}

function encryptPerHashKey($keypwd ,$hachkey)
{
	$Cryptkey  = trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $keypwd, $hachkey, MCRYPT_MODE_ECB)));
	return str_replace(array('+','/','='),array('-','_',''),$Cryptkey );
}
function decryptPerHashKey($keypwd ,$hachkey)
{
	$hachkey = str_replace(array('-','_'),array('+','/'),$hachkey);
	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$keypwd, base64_decode($hachkey), MCRYPT_MODE_ECB));
}



function generate_pin_code($size=7){

	$code=str_split(strrev(md5(microtime())));
	$index=0;
	foreach($code as $value){
		if((int)$value>0){
			$key.=$value;
			$index++;
		}
	}
	$key=substr($key, 0, $size);
	if(strlen($key)<$size)$key.=strrev(substr($key, 0, $size-strlen($key)));
	return $key;
}

function generate_char_code(){

	$code=str_split(strrev(md5(microtime())));
	$index=0;
	foreach($code as $value){
		if((int)$value>0){
			$key.=$value;
			if($index==3){
				$key.='-';
				$index=0;
			}
			$index++;
		}
	}
	$key=substr($key, 0, 14);
	if(strlen($key)<14)$key.=strrev(substr($key, 0, 14-strlen($key)));
	return $key;

}

function generate_topup_code(){

	$code=str_split(strrev(md5(microtime())));
	$index=0;
	foreach($code as $value){
		if((int)$value>0){
			$key.=$value;
			$index++;
		}
	}
	$key=substr($key, 0, 16);
	if(strlen($key)<16)$key.=strrev(substr($key, 0, 16-strlen($key)));
	return $key;
}

function get_trx_id (){

	$code=str_split(strrev(md5(microtime())));
	$index=0;
	foreach($code as $value){
		if((int)$value>0){
			$key.=$value;
			$index++;
		 }

	}
	$key=substr($key, 0, 12);
	if(strlen($key)<12)$key.=strrev(substr($key, 0, 12-strlen($key)));
	return 'TRX'.$key;
}

function get_transaction_trx_id($trxid){

global $data;
if($suser||$sdata){
	$start=0;
	$count=0;
}
	$trans=db_rows(

		"SELECT * FROM `{$data['DbPrefix']}transactions`".
		" WHERE `trxid`='{$trxid}' LIMIT 1");

		$result=array();

	foreach($trans as $key=>$value){
		if($suser){
			if(
				strpos(get_member_username($value['sender']), $suser)===false
				&&
				strpos(get_member_username($value['receiver']), $suser)===false
			)continue;
		}elseif($sdate){
			if(strpos($value['tdate'], $sdate)===false)continue;
		}

		$dir=(bool)($value['sender']!=$uid);
		$result[$key]['id']=$value['id'];
		$result[$key]['direction']=$dir?'1':'0';
		//$result[$key]['sender']=$value['sender'];
		$result[$key]['senduser']=prnuser($value['sender']);
		//$result[$key]['receiver']=$value['receiver'];
		$result[$key]['recvuser']=prnuser($value['receiver']);
		//$result[$key]['userid']=$dir?$value['sender']:$value['receiver'];
		//$result[$key]['username']=prnuser($result[$key]['userid']);
		$result[$key]['oamount']=$dir?$value['amount']:-$value['amount'];
		//$result[$key]['amount']=prnpays($result[$key]['oamount']);
		$result[$key]['tdate']=prndate($value['tdate']);
		$result[$key]['period']=$value['period'];

		//$result[$key]['ostatus']=$value['status'];
		$result[$key]['type']=$data['TransactionType'][$value['type']];
		$result[$key]['status']=$data['TransactionStatus'][$value['status']];

		if($value['fees']>0 && ($value['type']==1||$value['type']==2||($dir&&$value['type']==0)) ){
			$result[$key]['ofees']=-$value['fees'];
		}elseif ($value['type']==3 ){
				$result[$key]['ofees']=-$value['fees'];
		}else {
			$result[$key]['ofees']=0;
		}
		//$result[$key]['fees']=prnfees($result[$key]['ofees']);
		if ($value['type']==3) {
			$result[$key]['onets'] = $value['amount']+$value['fees'];
		} else {
			$result[$key]['onets']=$value['sender']>0&&$value['sender']==$uid&&$value['receiver']>0?$value['amount']:$value['amount']-$value['fees'];
		}
		//$result[$key]['nets']=prnpays($result[$key]['onets'], false);
		$result[$key]['comments']=prntext($value['comments']);
		$result[$key]['ecomments']=prntext($value['ecomments']);
		$result[$key]['canview']=($value['type']>=0&&$value['type']<=3);
		$result[$key]['canrefund']=can_refund($value['id'], $uid);
		$result[$key]['trxid']=$value['trxid'];
	}

		return $result;
}

function get_pin_id (){

	$code=str_split(strrev(md5(microtime())));
	$index=0;
	foreach($code as $value){
		if((int)$value>0){
			$key.=$value;
			$index++;
		 }

	}
	$key=substr($key, 0, 6);
	if(strlen($key)<5)$key.=strrev(substr($key, 0, 6-strlen($key)));
	return 'ED-'.$key;
}

###############################################################################

if(isset($_GET['sid']))$post['sid']=$_GET['sid'];

if(isset($_GET['bid']))$post['bid']=$_GET['bid'];

if(isset($_GET['id']))$post['gid']=$_GET['id'];

if(isset($_GET['bp']))$post['bp']=$_GET['bp'];

if(isset($_GET['cid']))$post['cid']=$_GET['cid'];

if(isset($_GET['updateid']))$post['updateid']=$_GET['updateid'];

if(isset($_GET['itemid']))$post['itemid']=$_GET['itemid'];

if(isset($_GET['type']))$post['type']=$_GET['type'];

if(isset($_GET['email']))$post['email']=$_GET['email'];

if(isset($_GET['status']))$post['status']=$_GET['status'];

if(isset($_GET['page']))$post['StartPage']=$_GET['page'];

if(isset($_GET['order']))$post['order']=$_GET['order'];

if(isset($_GET['action']))$post['action']=$_GET['action'];

if(isset($_GET['member']))$post['member']=$_GET['member'];

if(isset($_GET['product']))$post['product']=$_GET['product'];

if(isset($_GET['keyword']))$post['keyword']=$_GET['keyword'];

if(isset($_GET['pincode']))$post['pincode']=$_GET['pincode'];

if(isset($_GET['prehashkey']))$post['prehashkey']=$_GET['prehashkey'];

if(isset($_GET['crypt']))$post['crypt']=$_GET['crypt'];
###############################################################################

if(isset($_GET['rid']))$post['sponsor']=$_GET['rid'];

elseif(isset($_COOKIE['rid']))$post['sponsor']=$_COOKIE['rid'];

reset($_GET);

################################### SESSION ############################################

if(!session_id())session_start();

$data['sid']=session_id();

header("Cache-control: private");

#################################### CSRF ###########################################
function generate_csrf_token(){
    if (function_exists('mcrypt_create_iv')) {
        $csrf_token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
        $csrf_token = bin2hex(openssl_random_pseudo_bytes(32));
    }

    return $csrf_token;
}

function update_csrf_token($user_id, $csrf_token){
  global $data;

  $update = db_query("UPDATE `{$data['DbPrefix']}members`
                        SET `csrf_token` = '{$csrf_token}'
                        WHERE `{$data['DbPrefix']}members`.`id` = '{$user_id}';"
  );

  return $update;
}

function get_user_csrf_token($user_id){
  global $data;

  $row = db_rows("SELECT csrf_token FROM `{$data['DbPrefix']}members` WHERE `id` = '{$user_id}' ");

  // var_dump("SELECT csrf_token FROM `{$data['DbPrefix']}members` WHERE `id` = '{$user_id}' ");
  // var_dump($row);
  return $row[0]['csrf_token'];
}
//generate_csrf_token();

###############################################################################

if($_POST)$post=get_post();

if(isset($post['StartPage']))$post['StartPage']=0;

###############################################################################

db_connect();

###############################################################################

if(!$uid)$uid=$_SESSION['uid'];

if($uid){

	$balance=select_balance($uid);

	$post['Balance']=$balance;

	$post['Address']=$data['Addr'];

	$post['MailAddr']=get_member_email($uid);

	$post['Username']=get_member_username($uid);

	set_last_access_date($uid);

}

###############################################################################

if($data['ReferralPays']){

	if(get_member_id($post['sponsor'], '', "`active`=1")){

		$_SESSION['sponsor']=$post['sponsor'];

		setcookie('rid', $post['sponsor']);

	}elseif(!$_POST['sponsor'])unset($post['sponsor']);

}unset($_POST['sponsor']);

###############################################################################

?>
