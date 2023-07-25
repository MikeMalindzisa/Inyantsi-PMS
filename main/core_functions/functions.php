<?php
ini_set("display_errors", 1);
session_start();
	include "sql_db.php";
	NCG_FUNCT::PRIVACY_AND_TERMS_CONTROL();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';
		$smtp_config_request = NCG_FUNCT::GET_SMTP_ACTIVE_CONFIGURATION();
		if(mysqli_num_rows($smtp_config_request) > 0){
		$config = $smtp_config_request->fetch_assoc();
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = NCG_FUNCT::NCG_DECRYPT($config['SMTP_SERVER']);
		$mail->Port       = NCG_FUNCT::NCG_DECRYPT($config['SMTP_PORT']);
		$mail->SMTPSecure = NCG_FUNCT::NCG_DECRYPT($config['SMTP_SECURE']);
		$mail->SMTPAuth   = NCG_FUNCT::NCG_DECRYPT($config['SMTP_AUTH']);
		$mail->Username = NCG_FUNCT::NCG_DECRYPT($config['EMAIL']);
		$mail->Password = NCG_FUNCT::NCG_DECRYPT($config['PASSWORD']);
		$mail->SetFrom(NCG_FUNCT::NCG_DECRYPT($config['EMAIL']), 'Inyatsi Construction');
		$mail->SMTPDebug = 0;   
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
		$mail->IsHTML(true);
		}
	if(isset($_GET['xyz'])){
	 NCG_FUNCT::DIRTY_DATA($_GET['xyz']);
	}
	if(isset($_GET['logout'])){
		NCG_FUNCT::LOGOUT();
	}
	if(isset($_GET['mb-logout'])){
		NCG_FUNCT::MB_LOGOUT();
	}
	if(isset($_POST['update-con-email'])){
		$email = $_POST['con-email'];
		$cid = $_POST['cid'];
		$uid = $_POST['uid'];
		$from = $_POST['from'];
		if(NCG_FUNCT::ACCOUNT_CLASH($email)){
			$dom = "id=".$cid."&response=warning&msg=User with the same email already exists!&html";
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ".$from."?xyz=".$dirty_data);
				exit();
		}else{
			NCG_FUNCT::UPDATE_CON_EMAIL($email, $cid, $uid, $from);
		}
	}
	/*SYSTEM UPDATES JULY 2021
	NEW METHODS
	NEW FUNCTIONS WILL BE IDENTIFIED WITH ..._JL21 AT THE END OF FUNCTION NAME
	NEW METHODS WILL BE IDENTIFIED WITH ...-jl21 AT THE END OF FUNCTION NAME*/

	if(isset($_POST['edit-payment-jl21'])){
		$pid = $_POST['pid'];
		$cid = $_POST['cid'];
		$pcid = $_POST['pcid'];
		$c = $_POST['c'];
		$payment = $_POST['payment'];
		$certificate = $_POST['certificate'];
		$cv = $_POST['cv'];

		$oA = $_POST['old-amnt'];
		$nA = $_POST['new-amnt'];

		$paid = $_POST['paid'];

		$ov = $_POST['o-payment'];

		$payDate = $_POST['payDate'];
		$payDesc = $_POST['payDesc'];
		$request_package = array("pid" =>$pid, "pc" => $cid, "pcid" =>$pcid, "c" =>$c, "cv" =>$cv, "old-amnt" =>$oA, "new-amnt" =>$nA, "paid" =>$paid, "o-payment" =>$ov, "date" =>$payDate, "desc" =>$payDesc, "payement" =>$payment, "certificate" =>$certificate);
		NCG_FUNCT::EDIT_PAYMENT_JL21($request_package);
	}
	

	if(isset($_POST['update-vo-status-jl21'])){
		$vo = $_POST['vo'];
		$pid = $_POST['pid'];
		$status = $_POST['status'];

		$update_query = "UPDATE ncg_variation_orders SET VO_STATUS = '$status' WHERE REC_ID = $vo";
		$res = DATABASE::RUN_QUERY($update_query);
		if($res['response'] == "success"){
		
			$dom = "pid=".$pid."&vo=".$vo."&response=success&msg=Variation order status updated successfully to &html=<hr><h4>".$status."</h4>";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_vo_info.php?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "pid=".$pid."&vo=".$vo."&response=error&msg=Failed to update variation order status.&html=<hr/><br><hr>REASON:".$res['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_vo_info.php?xyz=".$dirty_data);
				exit();
		}
	}if(isset($_POST['update-project-progress-jl21'])){
		$pid = $_POST['pid'];
		$progress = $_POST['progress'];
		$prev_progress = $_POST['prev'];
		$pro_desc = $_POST['progressDesc'];



		$update_request = array("pid" =>$pid, "progress" =>$progress, "progressDesc" =>$pro_desc, "addedBy" =>$_SESSION['ncg-active']['UID']);

		$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
        $response = NCG_FUNCT::UPDATE_PROJECT_PROGRESS_PRIMARY_JL21($update_request);
		if($response == "success"){
			$ures = NCG_FUNCT::LOG_PROJECT_PROGRESS_JL21($update_request, $pid, $prev_progress);
			if($progress == 100){
				$status_query = "UPDATE ncg_projects SET STATUS = 'Complete' WHERE PROJECT_ID = $pid";
				DATABASE::RUN_QUERY($status_query);
			}
			
			$values = array();
			array_push($values, "OLD PROJECT PROGRESS: ".$project_info['PROJECT_PROGRESS']."%");
			array_push($values, "NEW PROJECT PROGRESS: ".$progress."%");
			if($project_info['PROJECT_PROGRESS'] == 100){
				NCG_FUNCT::CONTROL_STATUS($pid);
				array_push($values, "Project is now ongoing.");
			}
			$email_request = array("subject" =>"Project Progreess Report", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." updated progress for the project " );
			//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
			$dom = "pid=".$pid."&response=success&msg=Project ".$project_info['PROJECT_NAME']." progress updated successfully to &html=<hr/><br>".$progress."%";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "pid=".$pid."&response=error&msg=Failed to update project progress.&html=<hr/><br><hr>REASON:".$response;
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['up-progress-jl21'])){
		$pid = $_POST['projectId'];
		$progress = $_POST['progress'];
		$prev_progress = $_POST['prev'];
		$pro_desc = $_POST['progressDesc'];
		$request_package = array("projectId" =>$pid, "progress" =>$progress, "prev" =>$prev_progress, "progressDesc" =>$pro_desc);
		NCG_FUNCT::UPDATE_PROJECT_PROGRESS_JL21($request_package);
	}
	if(isset($_POST['new-pay-cert-jl21'])){
		$source = "desktop";
		$pid = $_POST['projectId'];
		$cert_num = $_POST['certNum'];
		$cert_reason = $_POST['payCertReason'];
		$sub_date = $_POST['subDate'];
		$due_date = $_POST['dueDate'];
		$cert_amt = $_POST['payCertAmt'];
		$cert_status = $_POST['certStatus'];
		$cert_desc = $_POST['payCertDesc'];
		if(isset($_POST['source'])){
			$source = $_POST['source'];
		}
		$cert_request = array("projectId" =>$pid, "certNum" =>$cert_num, "dueDate" =>$due_date, "subDate" =>$sub_date, "certStatus" =>$cert_status, "payCertReason" =>$cert_reason, "payCertDesc" =>$cert_desc, "payCertAmt" =>$cert_amt, "source" =>$source);
		NCG_FUNCT::NEW_PAYMENT_CERTIFICATE_RJL21($cert_request);

	}
	if(isset($_POST['new-payment-jl21'])){
		$pid = $_POST['pid'];
		$cid = $_POST['cid'];
		$c = $_POST['c'];
		$cert_num = $_POST['certNum'];
		$pay_date = $_POST['payDate'];
		$pay_amount = $_POST['payAmount'];
		$pay_desc = $_POST['payDesc'];

		$request_payment_package = array("pid" =>$pid, "certNum" =>$cert_num, "payDate" =>$pay_date, "payAmount" =>$pay_amount, "payDesc" =>$pay_desc, "pc" =>$cid, "c" =>$c);
		NCG_FUNCT::NEW_PAYMENT_JL21($request_payment_package);
	}
	if(isset($_POST['edit-pc-jl21'])){
		$pid = $_POST['projectId'];
		$cert_reason = $_POST['payCertReason'];
		$cert_amt = $_POST['payCertAmt'];
		$cert_desc = $_POST['payCertDesc'];
		$pc_id = $_POST['pcId'];
		$c = $_POST['c'];

		$cert_request = array("projectId" =>$pid, "c" =>$c, "payCertReason" =>$cert_reason, "payCertDesc" =>$cert_desc, "payCertAmt" =>$cert_amt, "pcId" =>$pc_id);
		NCG_FUNCT::EDIT_PAYMENT_CERTIFICATE_JL21($cert_request);

	}

	if(isset($_POST['new-project-jl21'])){
		$pname = $_POST['pname'];
		$contract_date = $_POST['contractDate'];
		$contr_end_date = $_POST['contrEndDate'];
		$base_start_date = $_POST['baseStartDate'];
		$end_date = $_POST['endDate'];
		$progress = $_POST['progress'];
		$progress_desc = $_POST['progressDesc'];
		$contract_value = $_POST['conValue'];
		$currency = $_POST['currency'];
		$cid = $_POST['projectClient'];
		$project_desc = $_POST['projectDesc'];
		$status = $_POST['projectStatus'];
		if($progress == 100){
			$Status = "Complete";
		}
		if($status == "Complete"){
			$progress = 100;
		}

		$request_package = array("pname" =>$pname, "contractDate" =>$contract_date, "contrEndDate" =>$contr_end_date, "baseStartDate" =>$base_start_date, "endDate" =>$end_date, "progress" =>$progress, "progressDesc" =>$progress_desc, "conValue" =>$contract_value, "currency" =>$currency, "projectClient" =>$cid, "projectDesc" =>$project_desc, "projectStatus" =>$status, "addedBy" =>$_SESSION['ncg-active']['UID']);
		NCG_FUNCT::NEW_PROJECT_JL21($request_package);
	}
	if(isset($_POST['new-project-secondary-jl21'])){
		$pname = $_POST['pname'];
		$contract_date = $_POST['contractDate'];
		$contr_end_date = $_POST['contrEndDate'];
		$base_start_date = $_POST['baseStartDate'];
		$end_date = $_POST['endDate'];
		$progress = $_POST['progress'];
		$progress_desc = $_POST['progressDesc'];
		$contract_value = $_POST['conValue'];
		$currency = $_POST['currency'];
		$cid = $_POST['projectClient'];
		$project_desc = $_POST['projectDesc'];
		$status = $_POST['projectStatus'];
		if($progress == 100){
			$Status = "Complete";
		}
		if($status == "Complete"){
			$progress = 100;
		}

		$request_package = array("pname" =>$pname, "contractDate" =>$contract_date, "contrEndDate" =>$contr_end_date, "baseStartDate" =>$base_start_date, "endDate" =>$end_date, "progress" =>$progress, "progressDesc" =>$progress_desc, "conValue" =>$contract_value, "currency" =>$currency, "projectClient" =>$cid, "projectDesc" =>$project_desc, "projectStatus" =>$status, "addedBy" =>$_SESSION['ncg-active']['UID']);
		NCG_FUNCT::NEW_PROJECT_SECONDARY_JL21($request_package);
	}

	if(isset($_POST['new-date-amd-jl21'])){

			$pid = $_POST['projectId'];
			$new_date = $_POST['newDate'];
			$amendment_desc = $_POST['amdDesc'];
			$amendment_reason = $_POST['amdReason'];

		$amendment_request = array("projectId" =>$pid, "newDate" =>$new_date, "amdDesc" =>$amendment_desc, "amdReason" =>$amendment_reason);
		NCG_FUNCT::NEW_COMPLETION_DATE_JL21($amendment_request);

	}

	if(isset($_GET['delete-imgs-jl21'])){
		$id = $_GET['img-id'];
		$path = $_GET['path'];
		$name = $_GET['name'];
		$pid = $_GET['pid'];
		$delete_query = "DELETE FROM ncg_project_images WHERE REC_ID = $id";
		$db_res = DATABASE::RUN_QUERY($delete_query);

		if($db_res['response'] == "success"){
				unlink($path);

				$dom = "pid=".$pid."&response=success&msg=Image file ".$name." deleted successfully!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_gallery?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "pid=".$pid."&response=error&msg=Image file ".$name." failed to delete!&html=<hr>".$db_res['message'];
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_gallery?xyz=".$dirty_data);
			exit();
		}
	}
	if(isset($_POST['rename-img-file-jl21'])){
		$img_id = $_POST['img-id'];
		$img_name = $_POST['new-name'];
		$pid = $_POST['pid'];

		$rename_query = "UPDATE ncg_project_images SET IMG_NAME = '$img_name' WHERE REC_ID = $img_id";
		$db_res = DATABASE::RUN_QUERY($rename_query);

		if($db_res['response'] == "success"){
				$dom = "pid=".$pid."&response=success&msg=Image file renamed successfully!&html=<hr><h4>New File Name</h4><br><strong>".$img_name."</strong>";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_gallery?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "pid=".$pid."&response=error&msg=Image file failed to rename!&html=<hr>".$db_res['message'];
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_gallery?xyz=".$dirty_data);
			exit();
		}
	}

	if(isset($_POST['upload-to-gallery-jl21'])){
		$REPO = "assets/repo/gallery/";
		$pid = $_POST['pid'];

		$images = array();
		$img_errors = array();
		$timestamp = date("Ymdhis");
		foreach ($_FILES['files']['name'] as $img_data) {
			$image_name = $img_data;
			$name_parts = explode(".",$image_name);
			$A = "INY_PR_".$pid."_".strtoupper(date('MY')).rand(100000000,999999999);
			$image_new_name = $A.'.'.end($name_parts);
			array_push($images, $image_new_name);
			$comp_paths = $REPO.basename($image_new_name);
			$request_package = array("NAME" =>$A, "pid" =>$pid, "UP_PHOTO" =>$comp_paths);
			$res = NCG_FUNCT::CREATE_PROJECT_GALLERY_JL21($request_package);
			if($res['response'] != "success"){
				array_push($img_errors, $res['message']);
			}
		}

			$errors = array();
			for($z=0; $z < sizeof($images); $z++){
				$repository = $REPO.basename($images[$z]);
				if(move_uploaded_file($_FILES['files']['tmp_name'][$z], $repository)){
					
				}else{
					array_push($errors, basename($images[$z]));
				}
			}
				$mes = "";
				for($x=0; $x < sizeof($img_errors); $x++){
					$mes .= $img_errors[$x]."<br>";
				}
			if(sizeof($errors)<= 0 ){
				
				$dom = "pid=".$pid."&response=success&msg=Images added to project gallery!&html=".$mes;
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_gallery?xyz=".$dirty_data);
				exit();
			}
		if(sizeof($errors) == sizeof($images)){
			$dom = "pid=".$pid."&response=error&msg=failed to upload images to gallery!&html=<hr><p>Please Try Again.</p>".$mes;
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_gallery?xyz=".$dirty_data);
				exit();
		}

		if(sizeof($errors) > 0 && sizeof($errors) < sizeof($images)){
			$dom = "pid=".$pid."&response=warning&msg=Image upload finished with warnings!&html=<hr><p>Failed to upload (".sizeof($errors).") images out of (".sizeof($images).") .</p>".$mes;
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_gallery?xyz=".$dirty_data);
				exit();
		}
		
	}

	/*END OF NEW METHODS
	 END OF JULY 2021 SYSTEM UPDATES */
	if(isset($_POST['ask-question'])){
		$from = $_POST['from'];
		$question = $_POST['faq-question'];
		$status = "asked";
		$class = $_POST['faq-class'];
		$email = $_POST['user-email'];

		if(isset($_SESSION['ncg-active'])){
			$user_id = $_SESSION['ncg-active']['UID'];
		}else{
			$user_id = 0;
		}
		$question_query = "INSERT INTO ncg_faqs (USER, FAQ_CLASS, FAQ_QUESTION, FAQ_STATUS, USER_EMAIL) VALUES($user_id, '$class', '$question', '$status', '$email')";
		$response = DATABASE::RUN_QUERY($question_query);

		if($response['response'] == "success"){
			$dom = "response=success&msg=Your question was submitted!&html=<hr><p>Thank you for improving our system with your question. We will try to reply soon as possible.</p>";
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ".$from."?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "response=error&msg=Failed to submit your question!&html=<hr><p>Sorry, we encountered an error while performing your request. Please try again. If the error persist, please contact Inyatsi IT Support.</p>";
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ".$from."?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['reply-question'])){
		$id = $_POST['faq-id'];
		$answer = $_POST['faq-reply'];
		$reply_by = $_SESSION['ncg-active']['UID'];
		$reply_query = "UPDATE ncg_faqs SET FAQ_ANSWER = '$answer', FAQ_STATUS = 'answered', REPLY_BY = $reply_by WHERE REC_ID = $id";
		$reply_response = DATABASE::RUN_QUERY($reply_query);

		if($reply_response['response'] == "success"){
			$dom = "response=success&msg=FAQ reply finished with success!&html=</p>";
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: faq_mgt?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "response=error&msg=Failed to reply to FAQ!&html=<hr>REASON: ".$reply_response['message'];
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: faq_mgt?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['delete-paycert'])){
		$cert_value = $_POST['cert-value'];
		$cert_id = $_POST['cert-id'];
		$reason = $_POST['del-reason'];
		$project = $_POST['pid'];
		$cert_delete_request = array("cert-value" =>$cert_value, "cert-id" =>$cert_id, "reason" =>$reason, "pid" =>$project);
		NCG_FUNCT::DELETE_PAY_CERT($cert_delete_request);
	}
	if(isset($_GET['resend-creds'])){
		$id = $_GET['id'];
		$from = $_GET['from'];
		$request = array("id" =>$id, "from" =>$from);
		NCG_FUNCT::RESEND_CREDENTIALS($request);
	}
	if(isset($_POST['change-pass'])){
		$request = array("pass" =>$_POST['new-password']);
		NCG_FUNCT::UPDATE_PASS($request);
	}
	if(isset($_POST['mb-change-pass'])){
		$request = array("pass" =>$_POST['new-pass']);
		NCG_FUNCT::MB_UPDATE_PASS($request);
	}

	if(isset($_GET['new-request'])){
		$email = $_GET['new-request'];
		NCG_FUNCT::REQUEST_PSW_RESET($email);
	}
	if(isset($_GET['mb-new-request'])){
		$email = $_GET['new-request'];
		NCG_FUNCT::MB_REQUEST_PSW_RESET($email);
	}
	if(isset($_POST['psw-recovery'])){
		$email = $_POST['email'];
		NCG_FUNCT::REQUEST_PSW_RESET($email);
	}
	if(isset($_POST['mb-psw-recovery'])){
		$email = $_POST['email'];
		NCG_FUNCT::MB_REQUEST_PSW_RESET($email);
	}
	if(isset($_POST['otp-verification'])){
		$otp = $_POST['otp'];
		$otp = str_replace("-", "", $otp);
		$email = $_POST['email'];
		$res = NCG_FUNCT::GET_TOKEN_VALIDATION(md5($otp));
		if($res["USER_ID"] == $email){
            $x = "email=".$res['USER_ID']."&control=control";
            $y = NCG_FUNCT::MAKE_DIRTY($x);
            NCG_FUNCT::VOID_TOKEN($email);
            header("Location: ncg_new_pass.php?xyz=".$y);
            exit(); 
		}else{
			 $x = "email=".$_POST['email']."&m=The OTP provided has expired or invalid.";
            $y = NCG_FUNCT::MAKE_DIRTY($x);
            header("Location: ncg_recover_validate.php?xyz=".$y);
		}
	}
	if(isset($_POST['mb-otp-validation'])){
		$otp = $_POST['otp'];
		$otp = str_replace("-", "", $otp);
		$email = $_POST['email'];
		$res = NCG_FUNCT::GET_TOKEN_VALIDATION(md5($otp));
		if($res["USER_ID"] == $email){
            $x = "email=".$res['USER_ID']."&control=control";
            $y = NCG_FUNCT::MAKE_DIRTY($x);
            NCG_FUNCT::VOID_TOKEN($email);
            header("Location: ncg_mb_new_pass.php?xyz=".$y);
            exit(); 
		}else{
			 $x = "email=".$_POST['email']."&m=The OTP provided has expired or invalid.&";
            $y = NCG_FUNCT::MAKE_DIRTY($x);
            header("Location: ncg_mb_psw_reset_validate.php?xyz=".$y);
		}
	}
	if(isset($_POST['update-smtp-config'])){
		$smtp_email = $_POST['smtp-email'];
		$smtp_pass = $_POST['smtp-pass'];
		$smtp_port_a = $_POST['smtp-port-1'];
		$smtp_port_b = $_POST['smtp-port-2'];
		$smtp_auth = $_POST['smtp-auth'];
		$smtp_server =$_POST['smtp-server'];
		$smtp_protocol = $_POST['smtp-protocol'];
		$config_status = $_POST['config-status'];
		$cid = $_POST['config-id'];
		$config_request = array("smtp-email" =>$smtp_email, "smtp-pass" =>$smtp_pass, "smtp-port-a" =>$smtp_port_a, "smtp-port-b" =>$smtp_port_b, "smtp-auth" =>$smtp_auth, "smtp-protocol" =>$smtp_protocol, "config-status" =>$config_status, "config-id" =>$cid, "smtp-server" =>$smtp_server);

		NCG_FUNCT::UPDATE_SMTP_CONFIG($config_request);
	}
	if(isset($_POST['new-smtp-config'])){
		$smtp_email = $_POST['smtp-email'];
		$smtp_pass = $_POST['smtp-pass'];
		$smtp_port_a = $_POST['smtp-port-1'];
		$smtp_port_b = $_POST['smtp-port-2'];
		$smtp_auth = $_POST['smtp-auth'];
		$smtp_server =$_POST['smtp-server'];
		$smtp_protocol = $_POST['smtp-protocol'];
		$config_status = $_POST['config-status'];
		$config_request = array("smtp-email" =>$smtp_email, "smtp-pass" =>$smtp_pass, "smtp-port-a" =>$smtp_port_a, "smtp-port-b" =>$smtp_port_b, "smtp-auth" =>$smtp_auth, "smtp-protocol" =>$smtp_protocol, "config-status" =>$config_status, "smtp-server" =>$smtp_server);

		NCG_FUNCT::NEW_SMTP_CONFIG($config_request);
	}
	if(isset($_POST['uac'])){
		$action = $_POST['action'];
		$id = $_POST['id'];

		if($action == "Make Admin"){
			$role = "Admin";
		}else{
			$role = "User";
		}
		$request_package = array("uid" =>$id, "role" =>$role);
		NCG_FUNCT::UAC($request_package);
	}
	if(isset($_POST['de-activate-user'])){
		$id = $_POST['id'];

		$action = $_POST['action'];
		if($action == "Activate"){
			$status = "Active";
			$x = "Activated";
			$a = "Activated your account, you can now login using your email ";
		}else{
			$status = "Inactive";
			$x = "Deactivated";
			$a = "Deactivated your account, you can nolonger login using the email ";
		}
		$page = "ncg_user_profile";
		$query = "UPDATE ncg_users SET STATUS = '$status' WHERE REC_ID = $id";
		DATABASE::RUN_QUERY($query);
		$user_ = NCG_FUNCT::GET_USER($id);
		$mail_request = array("subject" =>"User Account Control (UAC)", "email" =>$user_['USER_ID'], "msg" => $_SESSION['ncg-active']['NAME']." ".$a.$user_['USER_ID'], "projects" =>"");
		NCG_FUNCT::SEND_EMAIL_NOTIFICATION_UAC($mail_request);
		$dom = "response=success&id=".$id."&msg=User ".$x." successfully!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
		header("Location: ".$page."?xyz=".$dirty_data);
			exit();
	}
	if(isset($_GET['action'])){
		if($_GET['action']  == "delete-smtp-config"){
			$cid = $_GET['cid'];
			$query = "DELETE FROM ncg_smtp_settings WHERE REC_ID = $cid";
			$response = DATABASE::RUN_QUERY($query);
			if($response['response'] == "success"){
				$dom = "response=success&msg=SMTP Configuration deleted successfully!&html";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
				exit();
			}else{
				$dom = "response=error&msg=Failed to delete SMTP Configuration!&html=<hr/><br><h4>REASON: </h4>".$response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}
		}
		if($_GET['action'] == "promote-ext"){
			$uid = $_GET['uid'];
			$gid = $_GET['gid'];
			$current = $_GET['current'];
			$promote_request = array("uid" =>$uid, "gid" =>$gid, "current" =>$current);
			NCG_FUNCT::PROMOTE_EXT_GROUP_MEMBER($promote_request);
		}
		if($_GET['action'] == "promote"){
			$uid = $_GET['uid'];
			$gid = $_GET['gid'];
			$current = $_GET['current'];
			$promote_request = array("uid" =>$uid, "gid" =>$gid, "current" =>$current);
			NCG_FUNCT::PROMOTE_GROUP_MEMBER($promote_request);
		}
		if($_GET['action'] == "demote-ext"){
			$uid = $_GET['uid'];
			$gid = $_GET['gid'];
			$current = $_GET['current'];
			$demote_request = array("uid" =>$uid, "gid" =>$gid, "current" =>$current);
			NCG_FUNCT::DEMOTE_EXT_GROUP_MEMBER($demote_request);
		}
		if($_GET['action'] == "demote"){
			$uid = $_GET['uid'];
			$gid = $_GET['gid'];
			$current = $_GET['current'];
			$demote_request = array("uid" =>$uid, "gid" =>$gid, "current" =>$current);
			NCG_FUNCT::DEMOTE_GROUP_MEMBER($demote_request);
		}
		if($_GET['action'] == "remove"){
			$uid = $_GET['uid'];
			$gid = $_GET['gid'];
			$current = $_GET['current'];
			$remove_request = array("uid" =>$uid, "gid" =>$gid, "current" =>$current);
			NCG_FUNCT::REMOVE_GROUP_MEMBER($remove_request);
		}
		if($_GET['action'] == "remove-ext"){
			$uid = $_GET['uid'];
			$gid = $_GET['gid'];
			$current = $_GET['current'];
			$remove_request = array("uid" =>$uid, "gid" =>$gid, "current" =>$current);
			NCG_FUNCT::REMOVE_EXT_GROUP_MEMBER($remove_request);
		}
		if($_GET['action'] == "group-a-d"){
			$command = $_GET['command'];
			$gid = $_GET['gid'];
			$name = $_GET['name'];
			$a_d_request = array("command" =>$command, "gid" =>$gid, "name" =>$name);
			NCG_FUNCT::ACTIVATE_DEACTIVATE_SECURITY_GROUP($a_d_request);
		}
		if($_GET['action'] == "delete-grp"){
			$gid = $_GET['gid'];
			$name = $_GET['name'];
			$delete_group_request = array("gid" =>$gid, "name" =>$name);
			NCG_FUNCT::DELETE_INTERNAL_SEC_GROUP($delete_group_request);
		}
		if($_GET['action'] == "delete-grp-ext"){
			$gid = $_GET['gid'];
			$name = $_GET['name'];
			$delete_group_request = array("gid" =>$gid, "name" =>$name);
			NCG_FUNCT::DELETE_EXTERNAL_SEC_GROUP($delete_group_request);
		}
		if($_GET['action'] == "reset-group"){
			$gid = $_GET['gid'];
			$name = $_GET['name'];
			$reset_group_request = array("gid" =>$gid, "name" =>$name);
			NCG_FUNCT::RESET_SECURITY_GROUP($reset_group_request);
		}
		if($_GET['action'] == "reset-group-ext"){
			$gid = $_GET['gid'];
			$name = $_GET['name'];
			$reset_group_request = array("gid" =>$gid, "name" =>$name);
			NCG_FUNCT::RESET_EXT_SECURITY_GROUP($reset_group_request);
		}
		if($_GET['action'] == "clear-notification"){
			$id = $_GET['id'];
			$page = $_GET['page'];
			NCG_FUNCT::CLEAR_NOTIFICATION($id);
			header("Location: ".$page);
			exit();
		}
		if($_GET['action'] == "clear-notifications"){
			$id = $_GET['id'];
			$page = $_GET['page'];
			NCG_FUNCT::CLEAR_ALL_NOTIFICATION($id);
			header("Location: ".$page);
			exit();
		}
	}


	if(isset($_POST['client-logo'])){
		$USR_PHOTO_TEMP = $_FILES['image']['name'];
		$CID = $_POST['cid'];
		$REPO = "assets/repo/logos/";
		$MAIN_IMG_NAME = explode(".", $USR_PHOTO_TEMP);
		$USR_PHOTO_FILE_NAME = "CUS_IMG_".strtoupper(date('MY')).rand(100000000,999999999).".".end($MAIN_IMG_NAME);
		$USR_PHOTO = $REPO.$USR_PHOTO_FILE_NAME;
		$request_package = array("cid" =>$CID, "UP_PHOTO" =>$USR_PHOTO, "IMG_TEMP" =>$_FILES['image']['tmp_name']);
		NCG_FUNCT::UPDATE_CUSTOMER_IMAGE($request_package);
	}

	if(isset($_POST['rename-group'])){
			$new_name = $_POST['new-name'];
			$gid = $_POST['gid'];
			$name = $_POST['name'];
			$group_rename_request = array("new-name" =>$new_name, "gid" =>$gid, "name" =>$name);
			NCG_FUNCT::RENAME_SECURITY_GROUP($group_rename_request);
		}
	if(isset($_POST['modify-permissions'])){
			$permission_array = $_POST['permissions'];
			$gid = $_POST['gid'];
			$name = $_POST['name'];
			foreach ($permission_array as $permission) {
				if(empty($permissions)){
					$permissions = $permissions.$permission;
				}else{
					$permissions = $permissions.",".$permission;
				}
			}
			$group_modify_permission_request = array("permissions" =>$permissions, "gid" =>$gid, "name" =>$name);
			NCG_FUNCT::MODIFY_GROUP_PERMISSIONS($group_modify_permission_request);
		}
	if(isset($_POST['add-members'])){
		$members = $_POST['members-list'];
		$group_id = $_POST['grp-id'];
		$new_members_request = array("members" =>$members, "grp-id" =>$group_id);
		NCG_FUNCT::REC_NEW_INTERNAL_MEMBERS($new_members_request);
	}if(isset($_POST['add-ext-members'])){
		$members = $_POST['members-list'];
		$group_id = $_POST['grp-id'];
		$new_members_request = array("members" =>$members, "grp-id" =>$group_id);
		NCG_FUNCT::REC_NEW_EXTERNAL_MEMBERS($new_members_request);
	}
	if(isset($_POST['new-group'])){
		$name = $_POST['name'];
		$permission_array = $_POST['permissions'];
		$domain = $_POST['domain'];
		$status = $_POST['status'];
		$permissions = "";
		if($domain == "External"){
			$permissions = "R";
		}else{
			foreach ($permission_array as $permission) {
				if(empty($permissions)){
					$permissions = $permissions.$permission;
				}else{
					$permissions = $permissions.",".$permission;
				}
			}
		}
		$group_info = array("name" =>$name, "permissions" =>$permissions, "domain" =>$domain, "status" =>$status);
		NCG_FUNCT::CREATE_SECURITY_GROUP($group_info);
	}
	if(isset($_POST['update-address'])){
		$cid = $_POST['cid'];
		$aid = $_POST['aid'];
		$cname = $_POST['cname'];
		$ad_type = $_POST['ad_type'];
		$ad_line_one = $_POST['line_one'];
		$ad_line_two = $_POST['line_two'];
		$ad_line_three = $_POST['line_three'];
		$ad_line_four = $_POST['line_four'];
		$ad_status = $_POST['ad_status'];
		$request_client_update_address = array("address_type" =>$ad_type, "line_one" =>$ad_line_one, "line_two" =>$ad_line_two, "line_three" =>$ad_line_three, "line_four" =>$ad_line_four, "ad_status" =>$ad_status, "cid" =>$cid, "aid" =>$aid);
		$address_update_feedback = NCG_FUNCT::UPDATE_ADDRESS($request_client_update_address);
		if($address_update_feedback['response'] == "success"){
			$dom = "response=success&id=".$cid."&msg=Customer ".$cname." address updated successfully!&html";
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
			exit();
		}else{
			$dom = "response=error&id=".$cid."&msg=Failed to update customer ".$cname."'s address!&html=<hr/><br><h4>REASON: </h4>".$address_update_feedback['message'];
			$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['new-address'])){
		$cid = $_POST['cid'];
		$cname = $_POST['cname'];
		$ad_type = $_POST['ad_type'];
		$ad_line_one = $_POST['line_one'];
		$ad_line_two = $_POST['line_two'];
		$ad_line_three = $_POST['line_three'];
		$ad_line_four = $_POST['line_four'];
		$ad_status = $_POST['ad_status'];
		if(NCG_FUNCT::GET_CUSTOMER_ADDRESSES_COUNT($cid) <=0){
			$ad_priority = "Primary";
		}else{
			$ad_priority = "Secondary";
		}
		
		$request_client_rec_address = array("address_type" =>$ad_type, "line_one" =>$ad_line_one, "line_two" =>$ad_line_two, "line_three" =>$ad_line_three, "line_four" =>$ad_line_four, "ad_status" =>$ad_status, "ad_priority" =>$ad_priority);
		$address_rec_feedback = NCG_FUNCT::REC_ADDRESS($request_client_rec_address, $cid);
		if($address_rec_feedback['response'] == "success"){
			$dom = "response=success&id=".$cid."&msg=Customer ".$cname."'s' ".strtolower($ad_priority)." address added successfully!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customer_info.php?xyz=".$dirty_data);
			exit();
		}else{
			$dom = "response=error&id=".$cid."&msg=Failed to add customer ".$cname."'s' ".strtolower($ad_priority)." address!&html=<hr/><br><h4>REASON: </h4>".$address_rec_feedback['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customer_info.php?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['new-primary-address'])){
		$cid = $_POST['cid'];
		$cname = $_POST['cname'];
		$ad_type = $_POST['ad_type'];
		$ad_line_one = $_POST['line_one'];
		$ad_line_two = $_POST['line_two'];
		$ad_line_three = $_POST['line_three'];
		$ad_line_four = $_POST['line_four'];
		$ad_status = $_POST['ad_status'];
		$ad_priority = "Primary";
		$request_client_rec_address = array("address_type" =>$ad_type, "line_one" =>$ad_line_one, "line_two" =>$ad_line_two, "line_three" =>$ad_line_three, "line_four" =>$ad_line_four, "ad_status" =>$ad_status, "ad_priority" =>$ad_priority);
		$address_rec_feedback = NCG_FUNCT::REC_ADDRESS($request_client_rec_address, $cid);
		if($address_rec_feedback['response'] == "success"){
			$dom = "response=success&id=".$cid."&msg=Customer ".$cname." primary address added successfully!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
			exit();
		}else{
			$dom = "response=error&id=".$cid."&msg=Failed to add customer ".$cname."'s primary address!&html=<hr/><br><h4>REASON: </h4>".$address_rec_feedback['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['new-primary-contact'])){
		$cid = $_POST['cid'];
		$cname = $_POST['cname'];

		$con_title = $_POST['con_title'];
		$con_role = $_POST['con_role'];
		$con_initials = $_POST['con_initials'];
		$con_name = $_POST['con_name'];
		$con_tel = $_POST['con_tel'];
		$con_cell = $_POST['con_cell'];
		$con_email = $_POST['con_email'];
		$con_status = $_POST['con_status'];
		$con_priority = "Primary";

		$request_client_rec_contact = array("con_title" =>$con_title, "con_role" =>$con_role, "con_initials" =>$con_initials,"con_name" =>$con_name, "con_tel" =>$con_tel, "con_cell" =>$con_cell, "con_email" =>$con_email, "con_status" =>$con_status, "con_priority" =>$con_priority);
		$contact_rec_feedback = NCG_FUNCT::REC_CONTACTS($request_client_rec_contact, $cid);
		if($contact_rec_feedback['response'] == "success"){
			$dom = "response=success&id=".$cid."&msg=Customer ".$cname." primary contact added successfully!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
			exit();
		}else{
			$dom = "response=error&id=".$cid."&msg=Failed to add customer ".$cname."'s primary contact!&html=<hr/><br><h4>REASON: </h4>".$contact_rec_feedback['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
				exit();
		}

	}
	if(isset($_POST['new-contact'])){
		$cid = $_POST['cid'];
		$cname = $_POST['cname'];

		$con_title = $_POST['con_title'];
		$con_role = $_POST['con_role'];
		$con_initials = $_POST['con_initials'];
		$con_name = $_POST['con_name'];
		$con_tel = $_POST['con_tel'];
		$con_cell = $_POST['con_cell'];
		$con_email = $_POST['con_email'];
		$con_status = $_POST['con_status'];

		if(NCG_FUNCT::GET_CUSTOMER_CONTACTS_COUNT($cid) <=0){
			$con_priority = "Primary";
		}else{
			$con_priority = "Secondary";
		}

		$request_client_rec_contact = array("con_title" =>$con_title, "con_role" =>$con_role, "con_initials" =>$con_initials,"con_name" =>$con_name, "con_tel" =>$con_tel, "con_cell" =>$con_cell, "con_email" =>$con_email, "con_status" =>$con_status, "con_priority" =>$con_priority);
		$contact_rec_feedback = NCG_FUNCT::REC_CONTACTS($request_client_rec_contact, $cid);
		if($contact_rec_feedback['response'] == "success"){
			$dom = "response=success&id=".$cid."&msg=Customer ".$cname."'s' ".strtolower($con_priority)." contact added successfully!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customer_info.php?xyz=".$dirty_data);
			exit();
		}else{
			$dom = "response=error&id=".$cid."&msg=Failed to add customer ".$cname."'s' ".strtolower($con_priority)." contact!&html=<hr/><br><h4>REASON: </h4>".$contact_rec_feedback['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customer_info.php?xyz=".$dirty_data);
				exit();
		}

	}
	if(isset($_POST['update-details'])){
		$name = $_POST['new-name'];
		$old_name = $_POST['name'];
		$description = $_POST['description'];
		$cid = $_POST['cid'];
		$detail_update_request = array("new_name" =>$name, "old_name" =>$old_name, "description" =>$description, "cid" =>$cid);
		NCG_FUNCT::UPDATE_CUSTOMER_DETAILS($detail_update_request);
	}
	if(isset($_POST['update-contact'])){
		$cid = $_POST['cid'];
		$con_id = $_POST['con_id'];
		$cname = $_POST['cname'];

		$con_title = $_POST['con_title'];
		$con_role = $_POST['con_role'];
		$con_initials = $_POST['con_initials'];
		$con_name = $_POST['con_name'];
		$con_tel = $_POST['con_tel'];
		$con_cell = $_POST['con_cell'];
		$con_email = $_POST['con_email'];
		$con_status = $_POST['con_status'];

		$request_client_update_contact = array("con_title" =>$con_title, "con_role" =>$con_role, "con_initials" =>$con_initials,"con_name" =>$con_name, "con_tel" =>$con_tel, "con_cell" =>$con_cell, "con_email" =>$con_email, "con_status" =>$con_status, "con_id" =>$con_id, "cid" =>$cid);
		$contact_update_feedback = NCG_FUNCT::UPDATE_CONTACTS($request_client_update_contact);
		if($contact_update_feedback['response'] == "success"){
			$dom = "response=success&id=".$cid."&msg=Customer ".$cname." contact updated successfully!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
			exit();
		}else{
			$dom = "response=error&id=".$cid."&msg=Failed to update customer ".$cname."'s contact!&html=<hr/><br><h4>REASON: </h4>".$contact_update_feedback['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
				exit();
		}

	}
	if(isset($_POST['new-client'])){
		$cname = $_POST['cname'];
		$cdescription = $_POST['description'];

		$con_title = $_POST['con_title'];
		$con_role = $_POST['con_role'];
		$con_initials = $_POST['con_initials'];
		$con_name = $_POST['con_name'];
		$con_tel = $_POST['con_tel'];
		$con_cell = $_POST['con_cell'];
		$con_email = $_POST['con_email'];
		$con_status = $_POST['con_status'];
		$con_priority = "Primary";

		$ad_type = $_POST['address_type'];
		$ad_line_one = $_POST['line_one'];
		$ad_line_two = $_POST['line_two'];
		$ad_line_three = $_POST['line_three'];
		$ad_line_four = $_POST['line_four'];
		$ad_status = $_POST['ad_status'];
		$ad_priority = "Primary";
		if(NCG_FUNCT::ACCOUNT_CLASH($con_email)){
			$con_email = 0;
		}
		$request_client_rec = array("cname" =>$cname, "description" =>$cdescription, "con_title" =>$con_title, "con_role" =>$con_role, "con_initials" =>$con_initials,"con_name" =>$con_name, "con_tel" =>$con_tel, "con_cell" =>$con_cell, "con_email" =>$con_email, "con_status" =>$con_status, "address_type" =>$ad_type, "line_one" =>$ad_line_one, "line_two" =>$ad_line_two, "line_three" =>$ad_line_three, "line_four" =>$ad_line_four, "ad_status" =>$ad_status, "con_priority" =>$con_priority, "ad_priority" =>$ad_priority);
		NCG_FUNCT::REC_CLIENT($request_client_rec);

	}

	if(isset($_POST['update-cv'])){
		$pid = $_POST['pid'];
		$_operation_ = $_POST['cv-operation'];
		$_value_ = $_POST['value'];
		$_cv_ = $_POST['cv'];

		$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
		$fin_request_response = NCG_FUNCT::HANDLE_FINACIALS_EDIT($pid, $_operation_, $_cv_, $_value_);
		
		if($fin_request_response['response']){
			if(NCG_FUNCT::HANDLE_VARIATION_EDIT($pid, $_value_, $_operation_, $fin_request_response['backup_id'], $_cv_)){
					$dom = "pid=".$pid."&response=success&msg=Project ".$project_info['PROJECT_NAME']." contract value updated successfully!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
			}else{
				$dom = "pid=".$pid."&response=error&msg=Failed to update project contract value.&html=<hr/><br><hr>REASON: Failed updating project financials.";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
			}
		}else{
			$dom = "pid=".$pid."&response=error&msg=Failed to update project contract value.&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}

	}

	if(isset($_POST['rename-project'])){
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$update_request = array("pid" =>$pid, "pname" =>$pname);

		$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
		$project_ = NCG_FUNCT::GET_PROJECT($pid);
        $response = NCG_FUNCT::UPDATE_PROJECT_NAME($update_request);
		if($response == "success"){
			$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
			$values = array();
			array_push($values, "PREV PROJECT NAME: ".$project_info['PROJECT_NAME']);
			array_push($values, "NEW PROJECT NAME: ".$pname);

			$email_request = array("subject" =>"Project Name Change", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." renamed the project " );
			NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
			$dom = "pid=".$pid."&response=success&msg=Project ".$project_info['PROJECT_NAME']." renamed successfully!&html=<hr/><br>New Project name is<br><h4>".$pname."</h4>";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "pid=".$pid."&response=error&msg=Failed to rename project.&html=<hr/><br><hr>REASON:".$response;
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['update-project-status'])){
		$pid = $_POST['pid'];
		$status = $_POST['projectStatus'];
		$update_request = array("pid" =>$pid, "status" =>$status);

		$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
		$project_ = NCG_FUNCT::GET_PROJECT($pid);
        $response = NCG_FUNCT::UPDATE_PROJECT_STATUS($update_request);
		if($response == "success"){
			$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
			$values = array();
			array_push($values, "PREV PROJECT STATUS: ".$project_['STATUS']);
			array_push($values, "NEW PROJECT STATUS: ".$status);

			$email_request = array("subject" =>"Project Status Change", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." updated the status of the project " );
			NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
			$dom = "pid=".$pid."&response=success&msg=Project ".$project_info['PROJECT_NAME']." status updated successfully to &html=<hr/><br>".$status;
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}else{
			$dom = "pid=".$pid."&response=error&msg=Failed to update project status.&html=<hr/><br><hr>REASON:".$response;
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
		}
	}
	if(isset($_POST['assign-owner'])){
		$pid = $_POST['pid'];
		$cid = $_POST['cid'];
		$from = $_POST['from'];
		$assign_request = array("pid" =>$pid, "cid" =>$cid);
				$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
				 $customerData = NCG_FUNCT::GET_CUSTOMER($cid);
                 $projectOwner = $customerData['CLIENT_NAME'];
                 $response = NCG_FUNCT::ADD_PROJECT_OWNER($assign_request);
				if($response == "success"){
					$dom = "pid=".$pid."&response=success&msg=Project ".$project_info['PROJECT_NAME']." assigned successfully to &html=<hr/><br>".$projectOwner;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ".$from."?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "pid=".$pid."&response=error&msg=Failed to assign project ".$project_info['PROJECT_NAME']. "pid-[".$pid."] cid-[".$cid."] to &html=<hr/><br>".$projectOwner."<hr>".$response;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ".$from."?xyz=".$dirty_data);
						exit();
				}
	}
	if(isset($_POST['new-client-secondary'])){
		$cname = $_POST['cname'];
		$cdescription = $_POST['description'];
		$pid = $_POST['pid'];
		$con_title = $_POST['con_title'];
		$con_role = $_POST['con_role'];
		$con_initials = $_POST['con_initials'];
		$con_name = $_POST['con_name'];
		$con_tel = $_POST['con_tel'];
		$con_cell = $_POST['con_cell'];
		$con_email = $_POST['con_email'];
		$con_status = $_POST['con_status'];
		$con_priority = "Primary";

		$ad_type = $_POST['address_type'];
		$ad_line_one = $_POST['line_one'];
		$ad_line_two = $_POST['line_two'];
		$ad_line_three = $_POST['line_three'];
		$ad_line_four = $_POST['line_four'];
		$ad_status = $_POST['ad_status'];
		$ad_priority = "Primary";
		if(NCG_FUNCT::ACCOUNT_CLASH($con_email)){
			$con_email = 0;
		}
		$request_client_rec = array("pid" =>$pid, "cname" =>$cname, "description" =>$cdescription, "con_title" =>$con_title, "con_role" =>$con_role, "con_initials" =>$con_initials,"con_name" =>$con_name, "con_tel" =>$con_tel, "con_cell" =>$con_cell, "con_email" =>$con_email, "con_status" =>$con_status, "address_type" =>$ad_type, "line_one" =>$ad_line_one, "line_two" =>$ad_line_two, "line_three" =>$ad_line_three, "line_four" =>$ad_line_four, "ad_status" =>$ad_status, "con_priority" =>$con_priority, "ad_priority" =>$ad_priority);
		NCG_FUNCT::REC_CLIENT_SECONDARY($request_client_rec);

	}
	if(isset($_POST['new-pass'])){
		$email = $_POST['email'];
		$pass = $_POST['pass']; 
		$new_pass_request = array("email" =>$email, "pass" =>$pass);
		NCG_FUNCT::UPDATE_PASSWORD($new_pass_request);
	}
	if(isset($_POST['mb-new-pass'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$new_pass_request = array("email" =>$email, "pass" =>$pass);
		NCG_FUNCT::UPDATE_MB_PASSWORD($new_pass_request);
	}
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$login_request = array("email" =>$email, "pass" =>$pass);
		NCG_FUNCT::USER_LOGIN($login_request);
	}
	if(isset($_POST['login-mb'])){
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$mb_login_request = array("email" =>$email, "pass" =>$pass);
		NCG_FUNCT::MB_USER_LOGIN($mb_login_request);
	}
	if(isset($_POST['register'])){
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$pass = $_POST['password'];
		$repass = $_POST['re-password'];

		if(NCG_FUNCT::COUNT_SYS_ADMINS() <= 0){
			$role = "Admin";
			$status = "Active";
		}else{
			$role = $_POST['role'];
			$status = "Inactive";
		}

		if(NCG_FUNCT::ACCOUNT_CLASH($email)){
			$dom = "m=The Email Provided Is Already In Use.";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_register.php?xyz=".$dirty_data);
			exit();
		}else{
			if(NCG_FUNCT::PASSWORD_VALID($pass, $repass)){
				$registration_request = array("name" =>$user_name, "email" =>$email, "phone" =>$phone, "status" =>$status, "pass" =>$pass, "role" =>$role);
				if(NCG_FUNCT::REG_USER($registration_request)){
					$login_request = array("email" =>$email, "pass" =>$pass);
					NCG_FUNCT::USER_LOGIN($login_request);
				}else{
					$dom = "m=User registration failed.";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_register.php?xyz=".$dirty_data);
					exit();
				}
			}
		}
	}
	if(isset($_POST['new-external-user'])){
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$pass = $_POST['pass'];
		$status = $_POST['status'];
		$affiliation = $_POST['affiliation'];
		$role = "Customer";
		$pass = md5($pass);
		if(NCG_FUNCT::ACCOUNT_CLASH($email)){
			$dom = "response=warning&msg=Provided email is already taken!&html";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_users.php?xyz=".$dirty_data);
				exit();
		}else{
			$registration_request = array("status" =>$status, "name" =>$user_name, "email" =>$email, "phone" =>$phone, "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$_POST['pass']);

			$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, ROLE, STATUS, AFFILIATION) VALUES ('$email', '$pass', '$role', '$status', '$affiliation')";

			$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
			if($reg_user_request_response['response'] == "success"){
				NCG_FUNCT::REG_EXTERNAL_USER_INFO($registration_request, $reg_user_request_response['query_id']);
			}else{
				$dom = "response=error&msg=Failed to register ".$user_name."!&html=<hr/><br><h4>".$reg_user_request_response['message']."</h4>";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_users.php?xyz=".$dirty_data);
				exit();

			}
		}
	}
		
	if(isset($_POST['update-professional'])){
		$department = $_POST['department'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$extension = $_POST['extension'];
		$request_package = array("department" =>$department, "phone" =>$phone, "email" =>$email, "extension" =>$extension);
		NCG_FUNCT::UPDATE_INTERNAL_PROFESSIONAL_USER_INFO($request_package);
	}
	if(isset($_POST['update-personal'])){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		$USR_PHOTO_TEMP = $_FILES['image']['name'];
		$REPO = "assets/repo/users/";
			$MAIN_IMG_NAME = explode(".", $USR_PHOTO_TEMP);
			$USR_PHOTO_FILE_NAME = "USR_IMG_".strtoupper(date('MY')).rand(100000000,999999999).".".end($MAIN_IMG_NAME);
			$USR_PHOTO = $REPO.$USR_PHOTO_FILE_NAME;
		$request_package = array("name" =>$name, "phone" =>$phone, "email" =>$email, "UP_PHOTO" =>$USR_PHOTO, "IMG_TEMP" =>$_FILES['image']['tmp_name']);
		NCG_FUNCT::UPDATE_INTERNAL_PERSONAL_USER_INFO($request_package);
	}
	if(isset($_POST['new-vo'])){
		$project_id = $_POST['projectId'];
		$finances = NCG_FUNCT::GET_PROJECT_FINANCES($project_id);
		$prev_cv = $finances['CURRENT_VALUE'];
		$vo_amount = $_POST['voAmount'];
		$new_cv = $prev_cv + $vo_amount;
		$vo_reason = $_POST['voReason'];
		$vo_desc = $_POST['voDesc'];
		$vo_status = $_POST['voStatus'];
		
		
		if(isset($_POST['source'])){
			$source = $_POST['source'];
			$added_by = $_SESSION['ncg-mb-active']['UID'];
		}else{
			$added_by = $_SESSION['ncg-active']['UID'];
			$source = "desktop";
		}
		$vo_request = array("projectId" =>$project_id, "voStatus" =>$vo_status, "addedBy" =>$added_by, "prevCV" =>$prev_cv, "voAmount" =>$vo_amount, "newCV" =>$new_cv, "voReason" =>$vo_reason, "voDesc" =>$vo_desc);
		NCG_FUNCT::NEW_VARIATION_ORDER($vo_request);

	}
	if(isset($_POST['edit-vo'])){
		$project_id = $_POST['projectId'];
		$vo_id = $_POST['voId'];
		$c = $_POST['c'];
		$vo_amount = $_POST['voAmount'];
		$finances = NCG_FUNCT::GET_VARIATION_ORDER($vo_id);
		$prev_cv = $finances['PREV_CONTRACT_VALUE'];

		$new_cv = $prev_cv + $vo_amount;
		$vo_reason = $_POST['voReason'];
		$vo_desc = $_POST['voDesc'];

		$vo_status = $_POST['voStatus'];

		$vo_request = array("projectId" =>$project_id, "voStatus" =>$voStatus, "voId" =>$vo_id, "c" =>$c, "voAmount" =>$vo_amount, "newCV" =>$new_cv, "voReason" =>$vo_reason, "voDesc" =>$vo_desc, "prevCV");
		NCG_FUNCT::EDIT_VARIATION_ORDER($vo_request);

	}
	if(isset($_POST['new-pay-cert'])){
		$source = "desktop";
		$pid = $_POST['projectId'];
		$cert_reason = $_POST['payCertReason'];
		$cert_amt = $_POST['payCertAmt'];
		$cert_desc = $_POST['payCertDesc'];
		if(isset($_POST['source'])){
			$source = $_POST['source'];
		}
		$cert_request = array("projectId" =>$pid, "payCertReason" =>$cert_reason, "payCertDesc" =>$cert_desc, "payCertAmt" =>$cert_amt, "source" =>$source);
		NCG_FUNCT::NEW_PAYMENT_CERTIFICATE($cert_request);

	}
	
	if(isset($_POST['edit-pc'])){
		$pid = $_POST['projectId'];
		$cert_reason = $_POST['payCertReason'];
		$cert_amt = $_POST['payCertAmt'];
		$cert_desc = $_POST['payCertDesc'];
		$pc_id = $_POST['pcId'];
		$c = $_POST['c'];

		$cert_request = array("projectId" =>$pid, "c" =>$c, "payCertReason" =>$cert_reason, "payCertDesc" =>$cert_desc, "payCertAmt" =>$cert_amt, "pcId" =>$pc_id);
		NCG_FUNCT::EDIT_PAYMENT_CERTIFICATE($cert_request);

	}
	if(isset($_POST['new-con-us'])){
		$title = $_POST['title'];
		$con_line1 = $_POST['con-line-1'];
		$con_line2 = $_POST['con-line-2'];

		$loc_line1 = $_POST['loc-line-1'];
		$loc_line2 = $_POST['loc-line-2'];
		$loc_line3 = $_POST['loc-line-3'];
		$loc_line4 = $_POST['loc-line-4'];
		$loc_line5 = $_POST['loc-line-5'];

		$pos_line1 = $_POST['pos-line-1'];
		$pos_line2 = $_POST['pos-line-2'];
		$pos_line3 = $_POST['pos-line-3'];
		$pos_line4 = $_POST['pos-line-4'];

		$request_package = array("title" =>$title, "con-line-1" =>$con_line1, "con-line-2" =>$con_line1, "loc-line-1" =>$loc_line1, "loc-line-2" =>$loc_line2, "loc-line-3" =>$loc_line3, "loc-line-4" =>$loc_line4, "loc-line-5" =>$loc_line5, "pos-line-1" =>$pos_line1, "pos-line-2" =>$pos_line2, "pos-line-3" =>$pos_line3, "pos-line-4" =>$pos_line4);
			NCG_FUNCT::NEW_SET_CONTACT_US($request_package);
	}
	if(isset($_POST['new-con-postal'])){
		$rec_id = $_POST['rec-id'];

		$pos_line1 = $_POST['pos-line-1'];
		$pos_line2 = $_POST['pos-line-2'];
		$pos_line3 = $_POST['pos-line-3'];
		$pos_line4 = $_POST['pos-line-4'];

		$request_package = array("pos-line-1" =>$pos_line1, "pos-line-2" =>$pos_line2, "pos-line-3" =>$pos_line3, "pos-line-4" =>$pos_line4);
			$request_response = NCG_FUNCT::SET_POSTAL($request_package, $rec_id);
			if($request_response['response'] == "success"){
				$dom = "response=success&msg=Postal address added successfully!";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed to add postal address!&html=<hr/><br>REASON: ".$request_response['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}
	}
	if(isset($_POST['new-con-location'])){
		$rec_id = $_POST['rec-id'];

		$loc_line1 = $_POST['loc-line-1'];
		$loc_line2 = $_POST['loc-line-2'];
		$loc_line3 = $_POST['loc-line-3'];
		$loc_line4 = $_POST['loc-line-4'];
		$loc_line5 = $_POST['loc-line-5'];

		$request_package = array("loc-line-1" =>$loc_line1, "loc-line-2" =>$loc_line2, "loc-line-3" =>$loc_line3, "loc-line-4" =>$loc_line4, "loc-line-5" =>$loc_line5);
			$request_response = NCG_FUNCT::SET_LOCATION($request_package, $rec_id);
			if($request_response['response'] == "success"){
				$dom = "response=success&msg=Address added successfully!";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed to add address!&html=<hr/><br>REASON: ".$request_response['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}
	}
	if(isset($_POST['new-con-contact'])){
		$rec_id = $_POST['rec-id'];
		$con_line1 = $_POST['con-line-1'];
		$con_line2 = $_POST['con-line-2'];

		$a = str_replace("+","plus ", $con_line1);
		$a = str_replace("/"," slash ", $a);
		$a = str_replace("("," open ", $a);
		$a = str_replace(")"," close ", $a);

		$request_package = array("con-line-1" =>$a, "con-line-2" =>$con_line2);
			$request_response = NCG_FUNCT::SET_CONTACTS($request_package, $rec_id);
			if($request_response['response'] == "success"){
				$dom = "response=success&msg=Contact added successfully!";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed to add contact!&html=<hr/><br>REASON: ".$request_response['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}
	}
	if(isset($_POST['new-abt-us'])){
		$title = $_POST['item-title'];
		$content = $_POST['item-content'];
		$request_package = array("item-title" =>$title, "item-content" =>$content);
		NCG_FUNCT::NEW_SET_ABOUT_ITEM($request_package);
	}

	if(isset($_POST['terms-save'])){
		$terms = $_POST['terms'];
		$terms = NCG_FUNCT::NCG_CRYPT($terms);
		$terms = bin2hex($terms);
		NCG_FUNCT::CHECK_TERMS($terms);

	}

	if(isset($_POST['privacy-save'])){
		$privacy = $_POST['privacy-data'];
		NCG_FUNCT::CHECK_PRIVACY($privacy);

	}
	if(isset($_POST['rm-ex-assignment'])){
		$uid = $_POST['uid'];
		$pid = $_POST['pid'];
		NCG_FUNCT::REMOVE_EX_USER_ASSIGNMENTS($uid, $pid);
	}
	if(isset($_POST['rm-assignment'])){
		$uid = $_POST['uid'];
		$pid = $_POST['pid'];
		NCG_FUNCT::REMOVE_USER_ASSIGNMENTS($uid, $pid);
	}
	if(isset($_POST['assign-projects'])){
		$projects = $_POST['pids'];
		$uid = $_POST['uid'];
		$errors = array();
		$page = $_POST['page'];
		$count = sizeof($projects);
		var_dump($projects);
		echo $count;
		$projects_asigned = array();
		foreach($projects as $pid){
			$check_request_response = NCG_FUNCT::CHECK_EXISTANCE($pid, $uid);
			if($check_request_response == 0 ){
				$insert_query = "INSERT INTO ncg_assignments (UID, PID) VALUES ($uid, $pid)";
				$res = DATABASE::RUN_QUERY($insert_query);
				if($res["response"] == "failed"){
					array_push($errors, $res['message']);
				}else{
					$projects_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
					array_push($projects_asigned, $projects_info['PROJECT_NAME']);					
				}
			}else{
				array_push($errors, "Already issigned to user!");
			}
		}
		$user_ = NCG_FUNCT::GET_USER($uid);
		$mail_request = array("subject" =>"Project Assignments", "email" =>$user_['USER_ID'], "msg" => "You have been assigned to the following projects.", "projects" =>$projects_asigned);
		NCG_FUNCT::SEND_EMAIL_NOTIFICATION($mail_request);
		if(sizeof($errors)>0){
			$dom = "id=".$uid."&response=error&msg=User assigned with warnings!&html=";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ".$page."?xyz=".$dirty_data);
					exit();
		}else{
			$dom = "id=".$uid."&response=success&msg=User assigned successfully!&html=";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ".$page."?xyz=".$dirty_data);
					exit();
		}
		
	}
	class NCG_FUNCT{
		static function RATE_FAQ($info){
			$id = $info['id'];
			$rate = $info['rate'];

			$get_query = "SELECT * FROM ncg_faqs WHERE REC_ID = $id";
			$get_response = DATABASE::RUN_QUERY($get_query);
			$get_data = mysqli_fetch_assoc($get_response['data']);
			$faq_rating = $get_data['FAQ_RATING'] + $rate;

			$faq_rated = $get_data['FAQ_RATED']+1;;
			$rate_query = "UPDATE ncg_faqs SET FAQ_RATING = $faq_rating, FAQ_RATED = $faq_rated WHERE REC_ID = $id";
			$rate_response = DATABASE::RUN_QUERY($rate_query);
			if($rate_response['response'] == "success"){
				return true;
			}else{
				return false;
			}
		}
		static function HANDLE_VARIATION_EDIT($pid, $_value_, $_operation_, $backup_id, $_cv_){
			$new_cv = 0;
			$get_vo = "SELECT * FROM ncg_variation_orders WHERE PROJECT_ID = $pid";
			$vo_raw_data = DATABASE::RUN_QUERY($get_vo);
			if($_operation_ == "+"){
				$new_cv = 0 + $_value_;
			}if($_operation_=="-"){
				$new_cv = 0 - $_value_;
			}
			if(NCG_FUNCT::BACKUP_VARIATIONS($pid, $backup_id, $new_cv)){
				while($vo_data = $vo_raw_data['data'] ->fetch_assoc()){
					$x = 0;
					$y = 0;
					if($_operation_ == "+"){
						$x = $vo_data['PREV_CONTRACT_VALUE'] + $_value_;
						$y = $vo_data['NEW_CONTRACT_VALUE'] + $_value_;
					}if($_operation_=="-"){
						$x = $vo_data['PREV_CONTRACT_VALUE'] - $_value_;
						$y = $vo_data['NEW_CONTRACT_VALUE'] - $_value_;
					}
					NCG_FUNCT::ACT_ON_VO($vo_data['REC_ID'], $x, $y);
				}
				return true;
			}else{
				$ncg_restore_info_query = "UPDATE ncg_project_info SET CONTRACT_VALUE = '$_cv_' WHERE PROJECT_ID = $pid";
					DATABASE::RUN_QUERY($ncg_restore_info_query);
					$del_fin_history = "DELETE FROM ncg_project_finances_bak WHERE BACKUP_ID = '$backup_id'";
					$del_edit_history = "DELETE FROM edit_history WHERE EDIT_ID = '$backup_id'";
					DATABASE::RUN_QUERY($del_fin_history);
					DATABASE::RUN_QUERY($del_edit_history);
					return false;
			}
		}
		static function ACT_ON_VO($id, $new_p_cv, $new_n_cv){
			$query = "UPDATE ncg_variation_orders SET PREV_CONTRACT_VALUE = $new_p_cv, NEW_CONTRACT_VALUE = $new_n_cv WHERE REC_ID = $id";
			DATABASE::RUN_QUERY($query);
		}
		static function BACKUP_VARIATIONS($pid, $bid, $n_val){
			$uid = $_SESSION['ncg-active']['UID'];
			$edit_query = "INSERT INTO edit_history (EDIT_ID, EDIT_TYPE, EFFECT_VALUE, EDITED_BY) VALUES('$bid', 'variation', $n_val, '$uid')";
			$vo_bk_q = "INSERT INTO ncg_variation_orders_bak SELECT *, '$bid' as BACKUP_ID FROM ncg_variation_orders WHERE PROJECT_ID =$pid";

			$edit_h_res = DATABASE::RUN_QUERY($edit_query);
			if($edit_h_res['response'] == "success"){
				$back_res = DATABASE::RUN_QUERY($vo_bk_q);
				if($back_res['response'] == "success"){
						return true;
				}else{
					$del_vo_history = "DELETE FROM ncg_variation_orders_bak WHERE BACKUP_ID = '$bid'";
					$del_edit_history = "DELETE FROM edit_history WHERE EDIT_ID = '$bid'";
					DATABASE::RUN_QUERY($del_vo_history);
					DATABASE::RUN_QUERY($del_edit_history);
					return false;
				}
			}else{
				return false;
			}
		}

		static function HANDLE_FINACIALS_EDIT($pid, $op, $cv, $val){
			$bk_id = time();
			$n_val = 0;
			$n_cv = 0;
			$n_rv = 0;
			$n_op = 0;
			$nn_cv = 0;
			$response = false;
			if($op == "+"){
				$n_val = 0 + $val; 
			}else{
				$n_val = 0 - $val;
			}
		
			$uid = $_SESSION['ncg-active']['UID'];
			$edit_query = "INSERT INTO edit_history (EDIT_ID, EDIT_TYPE, EFFECT_VALUE, EDITED_BY) VALUES('$bk_id', 'finances', $n_val, '$uid')";
			$fin_bk_q = "INSERT INTO ncg_project_finances_bak SELECT *, '$bk_id' as BACKUP_ID FROM ncg_project_finances WHERE PROJECT_ID =$pid";

			$edit_h_res = DATABASE::RUN_QUERY($edit_query);
			if($edit_h_res['response'] == "success"){
				$back_res = DATABASE::RUN_QUERY($fin_bk_q);
				if($back_res['response'] == "success"){
				$get_fin = "SELECT * FROM ncg_project_finances WHERE PROJECT_ID = $pid";
				$fin = DATABASE::RUN_QUERY($get_fin);
				$fin_data = mysqli_fetch_assoc($fin['data']);

				$o_cv = $fin_data['CURRENT_VALUE'];
				$o_rv = $fin_data['REMAINING_VALUE'];
				$o_op = $fin_data['OVER_PAYMENT'];				
				$o_pv = $fin_data['PAYMENT_VALUE'];				

				switch ($op) {
					case '+':
						$n_cv = $o_cv + $val;
						$n_rv = $o_rv + $val;
						$nn_cv = $cv + $val;
					break;
					
					case '-':
						$n_cv = $o_cv - $val;
						$n_rv = $o_rv - $val;
						$nn_cv = $cv - $val;
					break;
				}

				$fin_update_query = "UPDATE ncg_project_finances SET CURRENT_VALUE = $n_cv, REMAINING_VALUE = $n_rv WHERE PROJECT_ID = $pid";
				$ncg_project_info_query = "UPDATE ncg_project_info SET CONTRACT_VALUE = $nn_cv WHERE PROJECT_ID = $pid";

				$info_q_res = DATABASE::RUN_QUERY($ncg_project_info_query);
					if($info_q_res['response'] == "success"){
						$fin_update_res = DATABASE::RUN_QUERY($fin_update_query);
						if($fin_update_res['response'] == "success"){
							$response = true;
						}else{
							$ncg_restore_info_query = "UPDATE ncg_project_info SET CONTRACT_VALUE = '$cv' WHERE PROJECT_ID = $pid";
							DATABASE::RUN_QUERY($ncg_restore_info_query);
							$del_fin_history = "DELETE FROM ncg_project_finances_bak WHERE BACKUP_ID = '$bk_id'";
							$del_edit_history = "DELETE FROM edit_history WHERE EDIT_ID = '$bk_id'";
							DATABASE::RUN_QUERY($del_fin_history);
							DATABASE::RUN_QUERY($del_edit_history);
							$response = false;
						}
					}else{
						$del_fin_history = "DELETE FROM ncg_project_finances_bak WHERE BACKUP_ID = '$bk_id'";
							$del_edit_history = "DELETE FROM edit_history WHERE EDIT_ID = '$bk_id'";
							DATABASE::RUN_QUERY($del_fin_history);
							DATABASE::RUN_QUERY($del_edit_history);
						$response = false;
					}

				}
			}
			return array("response" =>$response, "backup_id" =>$bk_id);

		}
		static function IS_ASSIGNED($uid, $pid){
			$ass_query = "SELECT * FROM ncg_assignments WHERE UID = $uid AND PID = $pid";
			$ass_response = DATABASE::RUN_QUERY($ass_query);
			if(mysqli_num_rows($ass_response['data'])> 0){
				return true;
			}else{
				return false;
			}
		}
		static function CAN_WRITE($UID){
			$x = "C";
			$member_query = "SELECT * FROM ncg_security_internal_members WHERE USER_ID = $UID";
			$member_response = DATABASE::RUN_QUERY($member_query);
			if(mysqli_num_rows($member_response['data']) > 0){
				while($group_id = $member_response['data'] ->fetch_assoc()){
					$permission_str = NCG_FUNCT::GET_GROUP_PERMISSIONS($group_id['GROUP_ID']);
					$group_data = $permission_str['data'] ->fetch_assoc();
					$permissions_arr = explode(",", $group_data['PERMISSIONS']);
					foreach ($permissions_arr as $key => $value) {
						if($value == $x){
							return true;
						}
						
					}
				}
			}
			return false;
		}
		static function CAN_READ($UID){
			$x = "R";
			$member_query = "SELECT * FROM ncg_security_internal_members WHERE USER_ID = $UID";
			$member_response = DATABASE::RUN_QUERY($member_query);
			if(mysqli_num_rows($member_response['data']) > 0){
				while($group_id = $member_response['data'] ->fetch_assoc()){
					$permission_str = NCG_FUNCT::GET_GROUP_PERMISSIONS($group_id['GROUP_ID']);
					$group_data = $permission_str['data'] ->fetch_assoc();
					$permissions_arr = explode(",", $group_data['PERMISSIONS']);
					foreach ($permissions_arr as $key => $value) {
						if($value == $x){
							return true;
						}
						
					}
				}
			}
			return false;
		}
		static function CAN_UPDATE($UID){
			$x = "U";
			$member_query = "SELECT * FROM ncg_security_internal_members WHERE USER_ID = $UID";
			$member_response = DATABASE::RUN_QUERY($member_query);
			if(mysqli_num_rows($member_response['data']) > 0){
				while($group_id = $member_response['data'] ->fetch_assoc()){
					$permission_str = NCG_FUNCT::GET_GROUP_PERMISSIONS($group_id['GROUP_ID']);
					$group_data = $permission_str['data'] ->fetch_assoc();
					$permissions_arr = explode(",", $group_data['PERMISSIONS']);
					foreach ($permissions_arr as $key => $value) {
						if($value == $x){
							return true;
						}
						
					}
				}
			}
			return false;
		}
		static function CAN_DELETE($UID){
			$x = "D";
			$member_query = "SELECT * FROM ncg_security_internal_members WHERE USER_ID = $UID";
			$member_response = DATABASE::RUN_QUERY($member_query);
			if(mysqli_num_rows($member_response['data']) > 0){
				while($group_id = $member_response['data'] ->fetch_assoc()){
					$permission_str = NCG_FUNCT::GET_GROUP_PERMISSIONS($group_id['GROUP_ID']);
					$group_data = $permission_str['data'] ->fetch_assoc();
					$permissions_arr = explode(",", $group_data['PERMISSIONS']);
					foreach ($permissions_arr as $key => $value) {
						if($value == $x){
							return true;
						}
						
					}
				}
			}
			return false;
		}
		static function IS_SPECIAL($UID){
			$x = "S";
			$member_query = "SELECT * FROM ncg_security_internal_members WHERE USER_ID = $UID";
			$member_response = DATABASE::RUN_QUERY($member_query);
			if(mysqli_num_rows($member_response['data']) > 0){
				while($group_id = $member_response['data'] ->fetch_assoc()){
					$permission_str = NCG_FUNCT::GET_GROUP_PERMISSIONS($group_id['GROUP_ID']);
					$group_data = $permission_str['data'] ->fetch_assoc();
					$permissions_arr = explode(",", $group_data['PERMISSIONS']);
					foreach ($permissions_arr as $key => $value) {
						if($value == $x){
							return true;
						}
						
					}
				}
			}
			return false;
		}

		static function GET_INTERNAL_USER_PERMISSIONS($UID){
			$c = "C";
			$r = "R";
			$u = "U";
			$d = "D";
			$c_color = "#66B6F7";
			$r_color = "#66B6F7";
			$u_color = "#66B6F7";
			$d_color = "#66B6F7";
			$user_permissions = "";
			if(NCG_FUNCT::CAN_WRITE($UID)){
				$user_permissions.="C";
				$c_color = "#FFFFFF";
			}
			if(NCG_FUNCT::CAN_READ($UID)){
				$user_permissions.="R";
				$r_color = "#FFFFFF";
			}
			if(NCG_FUNCT::CAN_UPDATE($UID)){
				$user_permissions.="U";
				$u_color = "#FFFFFF";
			}
			if(NCG_FUNCT::CAN_DELETE($UID)){
				$user_permissions.="D";
				$d_color = "#FFFFFF";
			}
			if(NCG_FUNCT::IS_SPECIAL($UID)){
				$user_permissions.="S";
			}
			return array("permissions" =>$user_permissions, "c_color" =>$c_color, "r_color" =>$r_color, "u_color" =>$u_color, "d_color" =>$d_color, "C" =>$c, "R" =>$r, "U" =>$u, "D" =>$d);
		}
		static function GET_GROUP_PERMISSIONS($GID){
			$group_query = "SELECT * FROM ncg_security_groups WHERE REC_ID = $GID AND STATUS = 'Active'";
			return DATABASE::RUN_QUERY($group_query);
		}
		static function PRIVACY_AND_TERMS_CONTROL(){
			$privacy_check = "SELECT * FROM ncg_privacy";
			$terms_check = "SELECT * FROM ncg_terms";
			$privacy_res = DATABASE::RUN_QUERY($privacy_check);
			$terms_res = DATABASE::RUN_QUERY($terms_check);

			if(mysqli_num_rows($privacy_res['data']) == 0){
				$repair_privacy = "INSERT INTO ncg_privacy (NCG_PRIVACY) VALUES('policy.php')";
				DATABASE::RUN_QUERY($repair_privacy);
			}
			if(mysqli_num_rows($terms_res['data']) == 0){
				$repair_terms = "INSERT INTO ncg_terms (NCG_TERMS) VALUES('terms.php')";
				DATABASE::RUN_QUERY($repair_terms);
			}
		}
		static function SEND_EMAIL_NOTIFICATION($info){
			global $mail;
			$_email = $info['email'];
			$_subject = $info['subject'];
			$_user_data = NCG_FUNCT::GET_USER_BY_EMAIL($_email);
			if($_user_data['ROLE'] == "Customer"){
				$_person_info = NCG_FUNCT::GET_EXTERNAL_USER_INFO($_user_data['UID']);
				$name = $_person_info['USER_NAME'];
			}else{
				$_person_info = NCG_FUNCT::GET_USER_INFO($_user_data['UID']);
				$name = $_person_info['NAME'];
			}
			foreach($info['projects'] as $project){
				$html_project_list .= $project."<hr>";
				$plain_project_list .= $project."\n";
			}
			$user_data = array(
			    'USR_NAME' => $name,
			    'MESSAGE' =>$info['msg'],
			    'PROJECTS' =>$html_project_list
			);
			$html_body = file_get_contents('ncg_general_mail.html');

			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->addAddress($_email, $name);
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $name.","."\n".$info['msg']."\n".$plain_project_list;

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function SEND_EMAIL_NOTIFICATION_UAC($info){
			global $mail;
			$_email = $info['email'];
			$_subject = $info['subject'];
			$_user_data = NCG_FUNCT::GET_USER_BY_EMAIL($_email);
			if($_user_data['ROLE'] == "Customer"){
				$_person_info = NCG_FUNCT::GET_EXTERNAL_USER_INFO($_user_data['REC_ID']);
				$name = $_person_info['USER_NAME'];
			}else{
				$_person_info = NCG_FUNCT::GET_USER_INFO($_user_data['REC_ID']);
				$name = $_person_info['NAME'];
			}
			$user_data = array(
			    'USR_NAME' => $name,
			    'MESSAGE' =>$info['msg'],
			    'PROJECTS' =>""
			);
			$html_body = file_get_contents('ncg_general_mail.html');

			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->addAddress($_email, $name);
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $name.","."\n".$info['msg'];

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function CHECK_EXISTANCE($pid, $uid){
			$query = "SELECT * FROM ncg_assignments WHERE UID = $uid AND PID = $pid";
			$res =  DATABASE::RUN_QUERY($query);
			return mysqli_num_rows($res['data']);
		}
		static function GET_USER_ASSIGNMENTS($uid){
			$assignments_requests = "SELECT * FROM ncg_assignments WHERE UID = $uid";
			$request_response = DATABASE::RUN_QUERY($assignments_requests);
			return $request_response['data'];
		}
		static function REMOVE_EX_USER_ASSIGNMENTS($uid,$pid){
			$assignments_requests = "DELETE FROM ncg_assignments WHERE UID = $uid AND PID = $pid";
			$request_response = DATABASE::RUN_QUERY($assignments_requests);
			if($request_response['response'] == "success"){
				$user_ = NCG_FUNCT::GET_USER($uid);
				$projects_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
				$mail_request = array("subject" =>"Project Assignments", "email" =>$user_['USER_ID'], "msg" => "Your assignment to the following projects was revoked.", "projects" =>$projects_info['PROJECT_NAME']);
					NCG_FUNCT::SEND_EMAIL_NOTIFICATION($mail_request);
				$dom = "id=".$uid."&response=success&msg=User assignment removed successfully!&html=";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location:ncg_ex_user_profile.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "id=".$uid."&response=errors&msg=Failed to remove user assignment!&html=";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location:ncg_ex_user_profile.php?xyz=".$dirty_data);
					exit();
			}
		}
		static function REMOVE_USER_ASSIGNMENTS($uid,$pid){
			$assignments_requests = "DELETE FROM ncg_assignments WHERE UID = $uid AND PID = $pid";
			$request_response = DATABASE::RUN_QUERY($assignments_requests);
			if($request_response['response'] == "success"){
				$dom = "id=".$uid."&response=success&msg=User assignment removed successfully!";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location:ncg_user_profile.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "id=".$uid."&response=errors&msg=Failed to remove user assignment!";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location:ncg_user_profile.php?xyz=".$dirty_data);
					exit();
			}
		}
		static function COUNT_SYS_ADMINS(){
			$role = "Admin";
			$user_count_query = "SELECT * FROM ncg_users WHERE ROLE LIKE '$role'";
			$user_count_response = DATABASE::RUN_QUERY($user_count_query);
			return mysqli_num_rows($user_count_response['data']);
		}
		static function CONTROL_STATUS($pid){
			$status = "Ongoing";
			$control_query = "UPDATE ncg_projects SET STATUS = '$status' WHERE PROJECT_ID = $pid";
			$r = DATABASE::RUN_QUERY($control_query);
			if($r['response'] == "success"){
				return true;
			}else{
				return false;
			}
			
		}
		static function CHECK_TERMS($terms){
			$check_query = "SELECT * FROM ncg_terms";
			$check_response = DATABASE::RUN_QUERY($check_query);
			if(mysqli_num_rows($check_response['data']) > 0){
				$terms_update = "UPDATE ncg_terms SET NCG_TERMS = '$terms'";
				$update_response = DATABASE::RUN_QUERY($terms_update);

				if($update_response['response'] == "success"){
					$dom = "response=success&msg=Terms and Conditions updated successfully!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
										exit();
								}else{
									$dom = "response=error&msg=Failed to update Terms and Conditions!&html=<hr/><br>REASON: ".$update_response['message'];
									$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
									header("Location: ncg_settings.php?xyz=".$dirty_data);
										exit();
								}
			}
			else{
				$record_terms = "INSERT INTO `ncg_terms` (`NCG_TERMS`) VALUES ('$terms')";
				$record_response = DATABASE::RUN_QUERY($record_terms);
				if($record_response['response'] == "success"){
					$dom = "response=success&msg=Terms and Conditions added successfully!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
				}else{
					$dom = "response=error&msg=Failed to add Terms and Conditions!&html=<hr/><br>REASON: ".$record_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
				}
			}
		}
		static function GET_PRIVACY(){
			$privacy_query = "SELECT * FROM ncg_privacy";
			$privacy_response = DATABASE::RUN_QUERY($privacy_query);
			return mysqli_fetch_assoc($privacy_response['data']);
		}
		static function GET_TERMS(){
			$terms_query = "SELECT * FROM ncg_terms";
			$terms_response = DATABASE::RUN_QUERY($terms_query);
			return mysqli_fetch_assoc($terms_response['data']);
		}
		static function CHECK_PRIVACY($privacy){
			$check_query = "SELECT * FROM ncg_privacy";
			$check_response = DATABASE::RUN_QUERY($check_query);
			if(mysqli_num_rows($check_response['data']) > 0){
				$privacy_update = "UPDATE ncg_privacy SET NCG_PRIVACY = '$terms'";
				$update_response = DATABASE::RUN_QUERY($privacy_update);

				if($update_response['response'] == "success"){
					$dom = "response=success&msg=Privacy Policy updated successfully!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=error&msg=Failed to update Privacy Policy!&html=<hr/><br>REASON: ".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
					}
			}else{
				$record_privacy = "INSERT INTO ncg_privacy (NCG_PRIVACY) VALUES ('$privacy')";
				$record_response = DATABASE::RUN_QUERY($record_privacy);
				if($record_response['response'] == "success"){
					$dom = "response=success&msg=Privacy Policy added successfully!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
				}else{
					$dom = "response=error&msg=Failed to add Privacy Policy!&html=<hr/><br>REASON: ".$record_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}	}
		}
		static function UPDATE_SMTP_CONFIG($args){
			$smtp_email = $args['smtp-email'];
			$smtp_pass = $args['smtp-pass'];
			$smtp_port_a = $args['smtp-port-a'];
			$smtp_port_b = $args['smtp-port-b'];
			$smtp_auth = $args['smtp-auth'];
			$smtp_protocol = $args['smtp-protocol'];
			$smtp_server = $args['smtp-server'];
			$config_status = $args['smtp-status'];
			$cid = $args['config-id'];

			$server = NCG_FUNCT::NCG_CRYPT($smtp_server);
			$email = NCG_FUNCT::NCG_CRYPT($smtp_email);
			$pass = NCG_FUNCT::NCG_CRYPT($smtp_pass);
			$port_a = NCG_FUNCT::NCG_CRYPT($smtp_port_a);
			$port_b = NCG_FUNCT::NCG_CRYPT($smtp_port_b);
			$auth = NCG_FUNCT::NCG_CRYPT($smtp_auth);
			$protocol = NCG_FUNCT::NCG_CRYPT($smtp_protocol);

			if(NCG_FUNCT::CONFIG_EXTISTANCE($email)){
				
				$request_query = "UPDATE ncg_smtp_settings SET EMAIL = '$email', SMTP_SERVER = '$server', SMTP_PORT_DEFAULT = '$port_a', SMTP_PORT = '$port_b', PASSWORD = '$pass', SMTP_AUTH = '$auth', SMTP_SECURE = '$protocol', STATUS = '$config_status' WHERE REC_ID = $cid";
				$request_response = DATABASE::RUN_QUERY($request_query);

				if($request_response['response'] == "success"){
					if($config_status == "Active"){
						$config_response = NCG_FUNCT::SET_ACTIVE_SMTP_CONFIG($email);
					}
					$dom = "response=success&msg=SMTP Configuration Updated!&html=<br>".$config_response;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed to update SMTP Configuration&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
				exit();
			}else{
				NCG_FUNCT::NEW_SMTP_CONFIG($args);
			}
		}
		static function NEW_SMTP_CONFIG($args){
			$smtp_email = $args['smtp-email'];
			$smtp_pass = $args['smtp-pass'];
			$smtp_port_a = $args['smtp-port-a'];
			$smtp_port_b = $args['smtp-port-b'];
			$smtp_auth = $args['smtp-auth'];
			$smtp_protocol = $args['smtp-protocol'];
			$config_status = $args['config-status'];
			$smtp_server = $args['smtp-server'];

			$server = NCG_FUNCT::NCG_CRYPT($smtp_server);
			$email = NCG_FUNCT::NCG_CRYPT($smtp_email);
			$pass = NCG_FUNCT::NCG_CRYPT($smtp_pass);
			$port_a = NCG_FUNCT::NCG_CRYPT($smtp_port_a);
			$port_b = NCG_FUNCT::NCG_CRYPT($smtp_port_b);
			$auth = NCG_FUNCT::NCG_CRYPT($smtp_auth);
			$protocol = NCG_FUNCT::NCG_CRYPT($smtp_protocol);

			if(NCG_FUNCT::CONFIG_EXTISTANCE($email)){
				
				$dom = "response=warning&msg=SMTP Configuration already exists with the same email account!&html=<hr/><br>";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
				exit();
			}else{
				$request_query = "INSERT INTO ncg_smtp_settings (EMAIL, SMTP_SERVER, SMTP_PORT_DEFAULT, SMTP_PORT, PASSWORD, SMTP_AUTH, SMTP_SECURE, STATUS) VALUES ('$email', '$server', '$port_a', '$port_b', '$pass', '$auth', '$protocol', '$config_status')";
				$request_response = DATABASE::RUN_QUERY($request_query);

				if($request_response['response'] == "success"){
					if($config_status == "Active"){
						$config_response = NCG_FUNCT::SET_ACTIVE_SMTP_CONFIG($email);
					}
					$dom = "response=success&msg=SMTP Configuration Saved!&html=<br>".$config_response;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed saving SMTP Configuration&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
			}
		}
		static function UPDATE_SMTP_EMAIL_AND_PASS($info){
			$smtp_email = $args['smtp-email'];
			$smtp_pass = $args['smtp-pass'];
			$smtp_email = NCG_FUNCT::NCG_CRYPT($smtp_email);
			$smtp_pass = NCG_FUNCT::NCG_CRYPT($smtp_pass);
			$update_query = "UPDATE ncg_smtp_settings SET EMAIL ='$smtp_email', PASSWORD = '$smtp_pass' WHERE REC_ID = $config_id";
			$response = DATABASE::RUN_QUERY($update_query);
			if($request_response['response'] == "success"){
					$dom = "response=success&msg=SMTP Account Updated!&html";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed to update SMTP Account.&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
		}
		static function UPDATE_SMTP_DEFAULT_PORT($port, $config_id){
			$port = NCG_FUNCT::NCG_CRYPT($port);
			$update_query = "UPDATE ncg_smtp_settings SET SMTP_PORT_DEFAULT ='$port' WHERE REC_ID = $config_id";
			$response = DATABASE::RUN_QUERY($update_query);
			if($request_response['response'] == "success"){
					$dom = "response=success&msg=SMTP Default Port Updated!&html";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed to update SMTP Default Port.&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
		}
		static function UPDATE_SMTP_ALT_PORT($port, $config_id){
			$port = NCG_FUNCT::NCG_CRYPT($port);
			$update_query = "UPDATE ncg_smtp_settings SET SMTP_PORT_DEFAULT ='$port' WHERE REC_ID = $config_id";
			$response = DATABASE::RUN_QUERY($update_query);
			if($request_response['response'] == "success"){
					$dom = "response=success&msg=SMTP Port Updated!&html";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed to update SMTP Port.&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
		}
		static function UPDATE_SMTP_PROTOCOL($protocol, $config_id){
			$port = NCG_FUNCT::NCG_CRYPT($port);
			$update_query = "UPDATE ncg_smtp_settings SET SMTP_SECURE ='$protocol' WHERE REC_ID = $config_id";
			$response = DATABASE::RUN_QUERY($update_query);
			if($request_response['response'] == "success"){
					$dom = "response=success&msg=SMTP Protocol Updated!&html";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed to update SMTP Protocol.&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
		}
		static function UPDATE_SMTP_STATUS($status, $config_id){

			$update_query = "UPDATE ncg_smtp_settings SET STATUS ='$status' WHERE REC_ID = $config_id";
			$response = DATABASE::RUN_QUERY($update_query);
			if($request_response['response'] == "success"){
				if($status == "Active"){
					NCG_FUNCT::UPDATE_ACTIVE_SMTP_CONFIG($config_id);
				}
					$dom = "response=success&msg=Configuration Status Updated!&html";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=error&msg=Failed to update Configuration Status.&html=<hr/><br>REASON: ".$request_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_settings.php?xyz=".$dirty_data);
						exit();
				}
		}
		static function GET_SMTP_ACTIVE_CONFIGURATION(){
			$config_query = "SELECT * FROM ncg_smtp_settings WHERE STATUS = 'Active'";
			$request_response = DATABASE::RUN_QUERY($config_query);
			return $request_response['data'];
		}
		static function GET_SMTP_CONFIGURATIONS(){
			$config_query = "SELECT * FROM ncg_smtp_settings";
			$request_response = DATABASE::RUN_QUERY($config_query);
			return $request_response['data'];
		}
		static function SET_ACTIVE_SMTP_CONFIG($config_id){
			$config_query = "UPDATE ncg_smtp_settings SET STATUS = 'Inactive' WHERE EMAIL NOT LIKE '$config_id'";
			$response = DATABASE::RUN_QUERY($config_query);
			if($response['response'] == "success"){
				return "Updatetd to active configuration";
			}
			else{
				return "";
			}
		}
		static function UPDATE_ACTIVE_SMTP_CONFIG($config_id){
			$config_query = "UPDATE ncg_smtp_settings SET STATUS = 'Inactive' WHERE REC_ID NOT LIKE '$config_id'";
			$response = DATABASE::RUN_QUERY($config_query);
			if($response['response'] == "success"){
				return "Updatetd to active configuration";
			}
			else{
				return "";
			}
		}
		static function CONFIG_EXTISTANCE($id){

			$request_query = "SELECT * FROM ncg_smtp_settings";
			$request_response = DATABASE::RUN_QUERY($request_query);
			while($profile = $request_response['data'] ->fetch_assoc()){
				if(NCG_FUNCT::NCG_DECRYPT($profile['EMAIL']) == NCG_FUNCT::NCG_DECRYPT($id)){
					return true;
				}
			}
			return false;
		}
		static function NEW_SET_ABOUT_ITEM($args){
			$title = $args['item-title'];
			$content = $args['item-content'];
			$content = NCG_FUNCT::NCG_CRYPT($content);

			$request_query = "INSERT INTO ncg_set_about_us (ITEM_TITLE, ITEM_CONTENT) VALUES ('$title', '$content')";
			$request_response = DATABASE::RUN_QUERY($request_query);
			if($request_response['response'] == "success"){
				$dom = "response=success&msg=About us information updated!";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed updating About us information!&html=<hr/><br>REASON: ".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}

		}
		static function NEW_SET_CONTACT_US($args){
			$title = $args['title'];

			$request_query = "INSERT INTO ncg_set_contact_us (REC_TITLE) VALUES ('$title')";
			$request_response = DATABASE::RUN_QUERY($request_query);

			if($request_response['response'] == "success"){
				NCG_FUNCT::SET_CONTACTS($args, $request_response['query_id']);
				NCG_FUNCT::SET_LOCATION($args, $request_response['query_id']);
				NCG_FUNCT::SET_POSTAL($args, $request_response['query_id']);
				$dom = "response=success&msg=Cuntact us information updated!";
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed updating Cuntact us information!&html=<hr/><br>REASON: ".$request_response['message'];
		$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_settings.php?xyz=".$dirty_data);
					exit();
			}
		}
		static function SET_CONTACTS($args, $id){
			$contact_value = $args['con-line-1'];
			$contact_type = $args['con-line-2'];

			$contact_request_query = "INSERT INTO ncg_set_contacts (CON_SET_ID, CON_SET_TYPE, CON_SET_VALUE) VALUES ($id, '$contact_type', '$contact_value')";
			return DATABASE::RUN_QUERY($contact_request_query);
		}
		static function SET_LOCATION($args, $id){
			$line1 = $args['loc-line-1'];
			$line2 = $args['loc-line-2'];
			$line3 = $args['loc-line-3'];
			$line4 = $args['loc-line-4'];
			$line5 = $args['loc-line-5'];

			$location_request_query = "INSERT INTO ncg_set_location (ADD_SET_ID, LINE_1, LINE_2, LINE_3, LINE_4, LINE_5) VALUES ($id, '$line1', '$line2', '$line3', '$line4', '$line5')";
			return DATABASE::RUN_QUERY($location_request_query);
		}
		static function SET_POSTAL($args, $id){
			$line1 = $args['pos-line-1'];
			$line2 = $args['pos-line-2'];
			$line3 = $args['pos-line-3'];
			$line4 = $args['pos-line-4'];

			$postal_request_query = "INSERT INTO ncg_set_postal (POS_SET_ID, LINE_1, LINE_2, LINE_3, LINE_4) VALUES ($id, '$line1', '$line2', '$line3', '$line4')";
			return DATABASE::RUN_QUERY($postal_request_query);
		}
		static function GET_ABOUT_US(){
			$request_query = "SELECT * FROM ncg_set_about_us";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function GET_CONTACT_US(){
			$request_query = "SELECT * FROM ncg_set_contact_us";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function GET_CON_CONTACTS($id){
			$request_query = "SELECT * FROM ncg_set_contacts WHERE CON_SET_ID = $id";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function GET_CON_LOCATIONS($id){
			$request_query = "SELECT * FROM ncg_set_location WHERE ADD_SET_ID = $id";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function GET_CON_POSTALS($id){
			$request_query = "SELECT * FROM ncg_set_postal WHERE POS_SET_ID = $id";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function NEW_VARIATION_ORDER($info){
			$project_id = $info['projectId'];
			$prev_cv = $info['prevCV'];
			$vo_amount = $info['voAmount'];
			$new_cv = $info['newCV'];
			$vo_reason = $info['voReason'];
			$vo_desc = $info['voDesc'];
			$added_by = $info['addedBy'];
			$vo_status = $info['voStatus'];

			$variation_order_query = "INSERT INTO ncg_variation_orders (PROJECT_ID, CREATED_BY, PREV_CONTRACT_VALUE, VO_AMOUNT, NEW_CONTRACT_VALUE, VO_REASON, VO_DESC, VO_STATUS) VALUES ('$project_id', '$added_by', '$prev_cv', '$vo_amount', '$new_cv', '$vo_reason', '$vo_desc', '$vo_status')";
			$vo_response = DATABASE::RUN_QUERY($variation_order_query);

			if($vo_response['response'] == "success"){
				$info['voId'] = $vo_response['query_id'];
				$finances_update_request = NCG_FUNCT::VO_UPDATE_PROJECT_FINANCES($info, "new");
				if($finances_update_request['response'] == "success"){
					$_add = NCG_FUNCT::GET_USER_INFO($added_by);
					$project_info = NCG_FUNCT::GET_PROJECT_INFO($project_id);
					$values = array();
					array_push($values, "VO AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($vo_amount));
					array_push($values, "OLD CONTRACT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($prev_cv));
					array_push($values, "NEW CONTRACT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_cv));
					array_push($values, "VO REASON: ".$vo_reason);
					array_push($values, "VO DESCRIPTION: ".$vo_desc);
					array_push($values, "VO STATUS: ".$vo_status);

					$email_request = array("subject" =>"New Project Variation Order", "pid" =>$project_id, "values" =>$values, "msg" =>$_add['NAME']." Added a new variation order for the project ");
					NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					$dom = "pid=".$project_id."&response=success&msg=Variation order saved!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}else{
					$correction_id = $vo_response['query_id'];
					$correction_query = "DELETE FROM ncg_variation_orders WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					$dom = "pid=".$project_id."&response=error&msg=Failed to save variation order &html=<hr/><br>REASON: Failed updating finances record:".$finances_update_request['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}
			}else{
				$dom = "pid=".$project_id."&response=error&msg=Failed to save variation order &html=<hr/><br>REASON: ".$vo_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
			}

		}
		static function MINIFY_NUMBER($input){
			if ($input < 10000) {
			    $n_format = number_format($input);
			}
			else if ($input < 1000000) {
			    $n_format = number_format($input / 1000, 2) . ' K';
			} else if ($input < 1000000000) {
			    $n_format = number_format($input / 1000000, 2) . ' M';
			} else {
			    $n_format = number_format($input / 1000000000, 2) . ' B';
			}
			return $n_format;
		}
		static function EDIT_VARIATION_ORDER($info){
			$project_id = $info['projectId'];
			$vo_amount = $info['voAmount'];
			$new_cv = $info['newCV'];
			$vo_reason = $info['voReason'];
			$vo_desc = $info['voDesc'];
			$vo_id = $info['voId'];
			$c = $info['c'];
			$vo_status = $info['voStatus'];
			$prev_cv = $info['prevCV'];

				$finances_update_request = NCG_FUNCT::VO_UPDATE_PROJECT_FINANCES($info, "edit");
				if($finances_update_request['response'] == "success"){

					$variation_order_query = "UPDATE ncg_variation_orders SET  VO_AMOUNT = '$vo_amount', NEW_CONTRACT_VALUE = '$new_cv', VO_REASON = '$vo_reason', VO_DESC = '$vo_desc', VO_STATUS = '$vo_status' WHERE REC_ID = $vo_id";
					$vo_response = DATABASE::RUN_QUERY($variation_order_query);

					if($vo_response['response'] == "success"){
						$_add = NCG_FUNCT::GET_USER_INFO($added_by);
						$project_info = NCG_FUNCT::GET_PROJECT_INFO($project_id);
						$values = array();
						array_push($values, "VO AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($vo_amount));
						array_push($values, "OLD CONTRACT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($prev_cv));
						array_push($values, "NEW CONTRACT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_cv));
						array_push($values, "VO REASON: ".$vo_reason);
						array_push($values, "VO DESCRIPTION: ".$vo_desc);
						array_push($values, "VO STATUS: ".$vo_status);

						$email_request = array("subject" =>"Project Variation Order Update", "pid" =>$project_id, "values" =>$values, "msg" =>$_add['NAME']." updated a variation order for the project " );
						NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
						$dom = "vo=".$vo_id."&C=".$c."&pid=".$project_id."&response=success&msg=Variation order updated!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_vo_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "vo=".$vo_id."&C=".$c."&pid=".$project_id."&response=error&msg=Failed to update variation order &html=<hr/><br>REASON:".$vo_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_vo_info.php?xyz=".$dirty_data);
						exit();
					}
					
				}else{
					$dom = "vo=".$vo_id."&C=".$c."&pid=".$project_id."&response=error&msg=Failed to update variation order &html=<hr/><br>REASON: ".$finances_update_request['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_vo_info.php?xyz=".$dirty_data);
						exit();
					
				}

		}
		static function EDIT_PAYMENT_CERTIFICATE($info){
			$pid = $info['projectId'];
			$cert_reason = $info['payCertReason'];
			$cert_amt = $info['payCertAmt'];
			$cert_desc = $info['payCertDesc'];
			$pc_id = $info['pcId'];
			$c = $info['c'];

			$old_pc = NCG_FUNCT::GET_PAYMENT_CERTIFICATE($pc_id);

			$pc_diff = $cert_amt - $old_pc['CERT_AMOUNT'];

			$cert_edit_query = "UPDATE ncg_payment_certificates SET CERT_AMOUNT = $cert_amt, CERT_REASON = '$cert_reason', CERT_DESC = '$cert_desc' WHERE REC_ID = $pc_id";
			$edit_response = DATABASE::RUN_QUERY($cert_edit_query);

			if($edit_response['response'] == "success"){
				$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
				$pv = $project_finance_data['PAYMENT_VALUE'];
				$rv = $project_finance_data['REMAINING_VALUE'];
				$op = $project_finance_data['OVER_PAYMENT'];

				$new_pv = $pv + $pc_diff;
				$new_rv = $rv - $pc_diff;
				$op -= $old_pc['CERT_AMOUNT'];
				if($op < 0){
					$op = 0;
				}
				if($new_rv < 0){
					$new_rv = 0;
					$op += $cert_amt - $rv;
				}
				$update_query = "UPDATE ncg_project_finances SET PAYMENT_VALUE = $new_pv, REMAINING_VALUE = $new_rv, OVER_PAYMENT = $op WHERE PROJECT_ID = $pid";
				$update_response = DATABASE::RUN_QUERY($update_query);

				if($update_response['response'] == "success"){
						$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
						$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
						$values = array();
						array_push($values, "EDIT PAYMENT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($cert_amt));
						array_push($values, "OLD PAYMENT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($old_pc));
						array_push($values, "NEW PAYMENT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_pv));
						array_push($values, "OLD REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($rv));
						array_push($values, "NEW REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_rv));
						array_push($values, "OVER PAYMENT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($op));
						array_push($values, "PAY-CERTIFICATE REASON: ".$cert_reason);
						array_push($values, "PAY-CERTIFICATE DESCRIPTION: ".$cert_desc);

						$email_request = array("subject" =>"Project Pay-Cert Edit", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." edited a payment certificate for the project " );
						NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=success&msg=Payment certificate updated!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
					exit();
				}
				else{
					$correction_id = $edit_response['query_id'];
					$correction_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=error&msg=Failed to update payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
					exit();
				}

			}
			else{
				$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=error&msg=Failed to update payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
				exit();
			}

		}
		static function DELETE_PAY_CERT($info){
			$cert_value = $info['cert-value'];
			$cert_id = $info['cert-id'];
			$reason = $info['reason'];
			$project = $info['pid'];
			$r_op = 0;

			$project_info = NCG_FUNCT::GET_PROJECT_INFO($project);
			$c = $project_info['CURRENCY'];
			$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($project);
				$pv = $project_finance_data['PAYMENT_VALUE'];
				$rv = $project_finance_data['REMAINING_VALUE'];
				$op = $project_finance_data['OVER_PAYMENT'];

				$r_pv = $pv - $cert_value;
				$r_rv = $rv + $cert_value;
				if($op > 0){
					$r_op = $op - $cert_value;

				}

				$get_cert = "SELECT * FROM ncg_payment_certificates WHERE REC_ID = $cert_id";
				$get_cert_res = DATABASE::RUN_QUERY($get_cert);
				$get_cert_go = mysqli_fetch_assoc($get_cert_res['data']);

				$creator = $get_cert_go['CREATED_BY'];
				$deleter = $_SESSION['ncg-active']['UID'];
				$cert_reason = $get_cert_go['CERT_REASON'];
				$cert_desc = $get_cert_go['CERT_DESC'];

				$cert_history_query = "INSERT INTO ncg_pay_cert_del_history (PROJECT_ID, CREATED_BY, DELETED_BY, DEL_REASON, CERT_AMOUNT, CERT_REASON, CERT_DESC) VALUES ($project, $creator, $deleter, '$reason', '$cert_value', '$cert_reason', '$cert_desc')";
				$cert_history_res = DATABASE::RUN_QUERY($cert_history_query);

				if($cert_history_res['response'] === "success"){
					$update_query = "UPDATE ncg_project_finances SET PAYMENT_VALUE = $r_pv, REMAINING_VALUE = $r_rv, OVER_PAYMENT = $r_op WHERE PROJECT_ID = $project";
					$update_response = DATABASE::RUN_QUERY($update_query);

					if($update_response['response'] == "success"){
						$remove_cert_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $cert_id";
						$remove_cert_res = DATABASE::RUN_QUERY($remove_cert_query);

						if($remove_cert_res['response'] == "success"){
							$_rem = NCG_FUNCT::GET_USER_INFO($deleter);
							$_add = NCG_FUNCT::GET_USER_INFO($creator);
								$values = array();
								array_push($values, "DELETED PAY-CERT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($cert_value));
								array_push($values, "NEW PAYMENT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($r_pv));
								array_push($values, "REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($r_rv));
								array_push($values, "OVER PAYMENT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($r_op));
								array_push($values, "REASON FOR DELETION: ".$reason);

								$email_request = array("subject" =>"Pay-Cert Deletion", "pid" =>$project, "values" =>$values, "msg" =>$_rem['NAME']." deleted a payment certificate that was initially added by ".$_add['NAME']." on ".date('d M Y ', strtotime($get_cert_go['TIMESTAMP']))." at ".date('H:i A', strtotime($get_cert_go['TIMESTAMP']))." for the project: ", "source" =>"desktop" );
								NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
								
								$dom = "pid=".$project."&response=success&msg=Payment certificate deleted!";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_project_info.php?xyz=".$dirty_data);
								exit();
						}else{

							$update_query = "UPDATE ncg_project_finances SET PAYMENT_VALUE = $pv, REMAINING_VALUE = $rv, OVER_PAYMENT = $op WHERE PROJECT_ID = $project";
							$update_response = DATABASE::RUN_QUERY($update_query);
							$h_id = $cert_history_res['query_id'];
							$history_clear_query = "DELETE FROM ncg_pay_cert_history WHERE REC_ID =$h_id";
							DATABASE::RUN_QUERY($history_clear_query);
							$dom = "pc=".$cert_id."&C=".$c."&pid=".$project."&response=error&msg=Failed to delete payment certificate &html=<hr/><br>REASON: ".$remove_cert_res['message'];
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
							exit();
						}
					}else{
							$h_id = $cert_history_res['query_id'];
							$history_clear_query = "DELETE FROM ncg_pay_cert_history WHERE REC_ID =$h_id";
							DATABASE::RUN_QUERY($history_clear_query);
							$dom = "pc=".$cert_id."&C=".$c."&pid=".$project."&response=error&msg=Failed to delete payment certificate &html=<hr/><br>REASON: ".$update_response['message'];
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
							exit();
					}
					
				}else{
					$dom = "pc=".$cert_id."&C=".$c."&pid=".$project."&response=error&msg=Failed to delete payment certificate &html=<hr/><br>REASON: Failed to create history record. ".$cert_history_res['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
					exit();
				}
		}
		/*SYSTEM UPDATES JULY 2021
			NEW FUNCTIONS
			NEW FUNCTIONS WILL BE IDENTIFIED WITH ..._JL21 AT THE END OF FUNCTION NAME*/


			static function GET_PROJECT_GALLERY_FILES($pid){
				$query = "SELECT * FROM ncg_project_images WHERE PID = $pid";
				$response = DATABASE::RUN_QUERY($query);

				return $response['data'];
			}
			static function CREATE_PROJECT_GALLERY_JL21($info){
			$image = $info['UP_PHOTO'];
			$pid = $info['pid'];
			$name = $info['NAME'];
			$image_query = "INSERT INTO ncg_project_images (PID, IMG_NAME, IMG_URL) VALUES ($pid, '$name', '$image')";

			
			return  DATABASE::RUN_QUERY($image_query);

		}


		static function DELETE_PAY_CERT_JL21($info){
			$cert_value = $info['cert-value'];
			$cert_id = $info['cert-id'];
			$reason = $info['reason'];
			$project = $info['pid'];
			$r_op = 0;

			$project_info = NCG_FUNCT::GET_PROJECT_INFO($project);
			$c = $project_info['CURRENCY'];
			$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($project);
				$pv = $project_finance_data['PAYMENT_VALUE'];
				$rv = $project_finance_data['REMAINING_VALUE'];
				$op = $project_finance_data['OVER_PAYMENT'];

				$r_pv = $pv - $cert_value;
				$r_rv = $rv + $cert_value;
				if($op > 0){
					$r_op = $op - $cert_value;

				}

				$get_cert = "SELECT * FROM ncg_payment_certificates WHERE REC_ID = $cert_id";
				$get_cert_res = DATABASE::RUN_QUERY($get_cert);
				$get_cert_go = mysqli_fetch_assoc($get_cert_res['data']);

				$creator = $get_cert_go['CREATED_BY'];
				$deleter = $_SESSION['ncg-active']['UID'];
				$cert_reason = $get_cert_go['CERT_REASON'];
				$cert_desc = $get_cert_go['CERT_DESC'];

				$cert_history_query = "INSERT INTO ncg_pay_cert_del_history (PROJECT_ID, CREATED_BY, DELETED_BY, DEL_REASON, CERT_AMOUNT, CERT_REASON, CERT_DESC) VALUES ($project, $creator, $deleter, '$reason', '$cert_value', '$cert_reason', '$cert_desc')";
				$cert_history_res = DATABASE::RUN_QUERY($cert_history_query);

				if($cert_history_res['response'] === "success"){
					$update_query = "UPDATE ncg_project_finances SET PAYMENT_VALUE = $r_pv, REMAINING_VALUE = $r_rv, OVER_PAYMENT = $r_op WHERE PROJECT_ID = $project";
					$update_response = DATABASE::RUN_QUERY($update_query);

					if($update_response['response'] == "success"){
						$remove_cert_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $cert_id";
						$remove_cert_res = DATABASE::RUN_QUERY($remove_cert_query);

						if($remove_cert_res['response'] == "success"){
							$_rem = NCG_FUNCT::GET_USER_INFO($deleter);
							$_add = NCG_FUNCT::GET_USER_INFO($creator);
								$values = array();
								array_push($values, "DELETED PAY-CERT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($cert_value));
								array_push($values, "NEW PAYMENT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($r_pv));
								array_push($values, "REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($r_rv));
								array_push($values, "OVER PAYMENT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($r_op));
								array_push($values, "REASON FOR DELETION: ".$reason);

								$email_request = array("subject" =>"Pay-Cert Deletion", "pid" =>$project, "values" =>$values, "msg" =>$_rem['NAME']." deleted a payment certificate that was initially added by ".$_add['NAME']." on ".date('d M Y ', strtotime($get_cert_go['TIMESTAMP']))." at ".date('H:i A', strtotime($get_cert_go['TIMESTAMP']))." for the project: ", "source" =>"desktop" );
								NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
								
								$dom = "pid=".$project."&response=success&msg=Payment certificate deleted!";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_project_info.php?xyz=".$dirty_data);
								exit();
						}else{

							$update_query = "UPDATE ncg_project_finances SET PAYMENT_VALUE = $pv, REMAINING_VALUE = $rv, OVER_PAYMENT = $op WHERE PROJECT_ID = $project";
							$update_response = DATABASE::RUN_QUERY($update_query);
							$h_id = $cert_history_res['query_id'];
							$history_clear_query = "DELETE FROM ncg_pay_cert_history WHERE REC_ID =$h_id";
							DATABASE::RUN_QUERY($history_clear_query);
							$dom = "pc=".$cert_id."&C=".$c."&pid=".$project."&response=error&msg=Failed to delete payment certificate &html=<hr/><br>REASON: ".$remove_cert_res['message'];
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
							exit();
						}
					}else{
							$h_id = $cert_history_res['query_id'];
							$history_clear_query = "DELETE FROM ncg_pay_cert_history WHERE REC_ID =$h_id";
							DATABASE::RUN_QUERY($history_clear_query);
							$dom = "pc=".$cert_id."&C=".$c."&pid=".$project."&response=error&msg=Failed to delete payment certificate &html=<hr/><br>REASON: ".$update_response['message'];
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
							exit();
					}
					
				}else{
					$dom = "pc=".$cert_id."&C=".$c."&pid=".$project."&response=error&msg=Failed to delete payment certificate &html=<hr/><br>REASON: Failed to create history record. ".$cert_history_res['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
					exit();
				}
		}

		static function NEW_COMPLETION_DATE_JL21($info){
			$project_id = $info['projectId'];
			$project_info = NCG_FUNCT::GET_PROJECT_INFO($project_id);
			$new_date = $info['newDate'];
			$amendment_desc = $info['amdDesc'];
			$amendment_reason = $info['amdReason'];
			if(isset($_POST['mobile'])){
				$amended_by = $_SESSION['ncg-mb-active']['UID'];
			}else{
				$amended_by = $_SESSION['ncg-active']['UID'];	
			}
				$prev_date = $project_info['ESTIMATED_END_DATE'];

				$project_update_query = "UPDATE ncg_project_info SET ESTIMATED_END_DATE = '$new_date' WHERE PROJECT_ID = $project_id";


			$amendment_query = "INSERT INTO ncg_delivery_dates (PROJECT_ID, CREATED_BY, PREV_DATE, NEW_DATE, DATE_REASON, DATE_DESC) VALUES ('$project_id', '$amended_by', '$prev_date', '$new_date', '$amendment_reason', '$amendment_desc')";
			$amendment_response = DATABASE::RUN_QUERY($amendment_query);

			if($amendment_response['response'] == "success"){
				$project_update_response = DATABASE::RUN_QUERY($project_update_query);
				if($project_update_response['response'] == "success"){
					$_add = NCG_FUNCT::GET_USER_INFO($amended_by);
					$project_info = NCG_FUNCT::GET_PROJECT_INFO($project_id);
					$values = array();
					array_push($values, "OLD DELIVERY DATE: ".$prev_date);
					array_push($values, "NEW DELIVERY DATE: ".$new_date);
					array_push($values, "UPDATE REASON: ".$amendment_reason);
					array_push($values, "UPDATE DESCRIPTION: ".$amendment_desc);

					$email_request = array("subject" =>"New Project Delivery Date.", "pid" =>$project_id, "values" =>$values, "msg" =>$_add['NAME']." Added a new delivery date for the project " );
					//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$project_id."&response=success&msg=Delivery date updated!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pid=".$project_id."&response=success&msg=Delivery date updated!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$correction_id = $amendment_response['query_id'];
					$correction_query = "DELETE FROM ncg_delivery_dates WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$project_id."&response=error&msg=Failed to update delivery date.&html=<hr/><br>REASON: Failed updating project record:".$project_update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pid=".$project_id."&response=error&msg=Failed to update delivery date.&html=<hr/><br>REASON: Failed updating project record:".$project_update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
					}
				}
			}else{
				if(isset($_POST['mobile'])){
					$dom = "pid=".$project_id."&response=error&msg=Failed to update delivery date.&html=<hr/><br>REASON: ".$amendment_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
					exit();
				}else{
					$dom = "pid=".$project_id."&response=error&msg=Failed to update delivery date.&html=<hr/><br>REASON: ".$amendment_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}
			}

		}

		static function NEW_PROJECT_JL21($info){
			$added_by = $info['addedBy'];
			$cid = $info['projectClient'];
			$status = $info['projectStatus'];
			if ($cid == "null") {
				$cid = 0;
			}
			$new_project_query = "INSERT INTO ncg_projects (ADDED_BY, CUSTOMER_ID, STATUS) VALUES ('$added_by', '$cid', '$status')";
			$request_response = DATABASE::RUN_QUERY($new_project_query);
			if($request_response['response'] == "success"){
				NCG_FUNCT::SAVE_PROJECT_INFO_JL21($info, $request_response['query_id']);
			}else{
				$dom = "response=error&msg=Failed recording project ".$info['pname']."&html=<hr/><br>REASON: ".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_projects.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function NEW_PROJECT_SECONDARY_JL21($info){
			$added_by = $info['addedBy'];
			$cid = $info['projectClient'];
			$status = $info['projectStatus'];
			if ($cid == "null") {
				$cid = 0;
			}
			$new_project_query = "INSERT INTO ncg_projects (ADDED_BY, CUSTOMER_ID, STATUS) VALUES ('$added_by', '$cid', '$status')";
			$request_response = DATABASE::RUN_QUERY($new_project_query);
			if($request_response['response'] == "success"){
				NCG_FUNCT::SAVE_PROJECT_INFO_SECONDARY_JL21($info, $request_response['query_id']);
			}else{
				$dom = "cid=".$cid."&response=error&msg=Failed recording project ".$info['pname']."&html=<hr/><br>REASON: ".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_client_projects.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function LOG_PROJECT_PROGRESS_JL21($info, $pid, $prev){
			$curr_pro = $info['progress'];
			$pro_desc = $info['progressDesc'];
			$added_by = $info['addedBy'];
			$query = "INSERT INTO ncg_progress_log (PID, PREV_PROGRESS, NEW_PROGRESS, PROGRESS_DESC, ADDED_BY) VALUES($pid, $prev, $curr_pro, '$pro_desc', $added_by)";
			return DATABASE::RUN_QUERY($query);
		}

		static function SAVE_PROJECT_INFO_SECONDARY_JL21($info, $project_id){


			$pname = $info['pname'];
			$contract_date = $info['contractDate'];

			$contr_end_date = $info['contrEndDate'];
			$base_start_date = $info['baseStartDate'];
			$end_date = $info['endDate'];
			$progress = $info['progress'];

			$contract_value = $info['conValue'];
			$currency = $info['currency'];
			$project_desc = $info['projectDesc'];
			$finances_query = "INSERT INTO ncg_project_finances (PROJECT_ID, CURRENT_VALUE, REMAINING_VALUE) VALUES ('$project_id', '$contract_value', '$contract_value')";
			DATABASE::RUN_QUERY($finances_query);
			$project_info_query = "INSERT INTO ncg_project_info (PROJECT_ID, PROJECT_NAME, CONTRACT_DATE, BASE_START, CONTRACTUAL_END, ESTIMATED_END_DATE, PROJECT_PROGRESS, CONTRACT_VALUE, CURRENCY, PROJECT_DESC) VALUES ('$project_id', '$pname', '$contract_date', '$base_start_date', '$contr_end_date', '$end_date', '$progress', '$contract_value', '$currency', '$project_desc')";
			$request_response = DATABASE::RUN_QUERY($project_info_query);

			if($request_response['response'] == "success"){

				if($progress > 0){
					NCG_FUNCT::LOG_PROJECT_PROGRESS_JL21($info, $project_id, 0);
				}

				if($info['projectClient'] == "null"){
					$values = array();
					array_push($values, "PROJECT NAME: ".$pname);
					array_push($values, "CLIENT: No client assigned");
					array_push($values, "CONTRACT VALUE: ".$currency." ".NCG_FUNCT::MINIFY_NUMBER($contract_value));
					array_push($values, "CONTRACT DATE: ".date("d M Y ", strtotime($contract_date)));
					array_push($values, "START DATE: ".date("d M Y ", strtotime($start_date)));
					array_push($values, "END DATE: ".date("d M Y ", strtotime($end_date)));
					array_push($values, "CURRENT PROGRESS: ".$progress."%");
					array_push($values, "PROJECT STATUS: ".$info['projectStatus']);
					array_push($values, "DESCRIPTION: ".$project_desc);
					$mail_request = array("subject" =>"New Project", "msg" => $_SESSION['ncg-active']['NAME']." Created a new project.", "values" =>$values, "project" =>$info['pname']);
					//NCG_FUNCT::SEND_EMAIL_NOTIFICATION_ADMINS($mail_request);
					$dom = "cid=".$info['projectClient']."&response=success&msg=Project ".$info['pname']." added successfully!&html=<hr/><br>No client assigned to project!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_client_projects.php?xyz=".$dirty_data);
					exit();
				}else{
					$customer = NCG_FUNCT::GET_CUSTOMER($info['projectClient']);
					$values = array();
					array_push($values, "PROJECT NAME: ".$pname);
					array_push($values, "CLIENT: ".$customer['CLIENT_NAME']);
					array_push($values, "CONTRACT VALUE: ".$currency." ".NCG_FUNCT::MINIFY_NUMBER($contract_value));
					array_push($values, "CONTRACT DATE: ".date("d M Y ", strtotime($contract_date)));
					array_push($values, "START DATE: ".date("d M Y ", strtotime($start_date)));
					array_push($values, "END DATE: ".date("d M Y ", strtotime($end_date)));
					array_push($values, "CURRENT PROGRESS: ".$progress."%");
					array_push($values, "PROJECT STATUS: ".$info['projectStatus']);
					array_push($values, "DESCRIPTION: ".$project_desc);
					$mail_request = array("subject" =>"New Project", "msg" => $_SESSION['ncg-active']['NAME']." Created a new project.", "values" =>$values, "project" =>$info['pname']);
					//NCG_FUNCT::SEND_EMAIL_NOTIFICATION_ADMINS($mail_request);
					$dom = "cid=".$info['projectClient']."&response=success&msg=Project ".$info['pname']." added successfully!&html=<hr/><br>Project Owner <h4>".$customer['CLIENT_NAME']."</h4>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location:  ncg_client_projects.php?xyz=".$dirty_data);
					exit();
				}
			}
			else{
				$control_query = "DELETE FROM ncg_projects WHERE REC_ID LIKE '$project_id'";
				DATABASE::RUN_QUERY($control_query);
				header("Location:  ncg_client_projects.php?xyz=".$dirty_data);
				exit();
			}

		}
		static function SAVE_PROJECT_INFO_JL21($info, $project_id){
			$pname = $info['pname'];
			$contract_date = $info['contractDate'];

			$contr_end_date = $info['contrEndDate'];
			$base_start_date = $info['baseStartDate'];
			$end_date = $info['endDate'];
			$progress = $info['progress'];

			$contract_value = $info['conValue'];
			$currency = $info['currency'];
			$project_desc = $info['projectDesc'];
			$finances_query = "INSERT INTO ncg_project_finances (PROJECT_ID, CURRENT_VALUE, REMAINING_VALUE) VALUES ('$project_id', '$contract_value', '$contract_value')";
			DATABASE::RUN_QUERY($finances_query);
			$project_info_query = "INSERT INTO ncg_project_info (PROJECT_ID, PROJECT_NAME, CONTRACT_DATE, BASE_START, CONTRACTUAL_END, ESTIMATED_END_DATE, PROJECT_PROGRESS, CONTRACT_VALUE, CURRENCY, PROJECT_DESC) VALUES ('$project_id', '$pname', '$contract_date', '$base_start_date', '$contr_end_date', '$end_date', '$progress', '$contract_value', '$currency', '$project_desc')";
			$request_response = DATABASE::RUN_QUERY($project_info_query);
			if($request_response['response'] == "success"){

				if($progress > 0){
					NCG_FUNCT::LOG_PROJECT_PROGRESS_JL21($info, $project_id, 0);
				}

				if($info['projectClient'] == "null"){
					$values = array();
					array_push($values, "PROJECT NAME: ".$pname);
					array_push($values, "CLIENT: No client assigned");
					array_push($values, "CONTRACT VALUE: ".$currency." ".NCG_FUNCT::MINIFY_NUMBER($contract_value));
					array_push($values, "CONTRACT DATE: ".date("d M Y ", strtotime($contract_date)));
					array_push($values, "START DATE: ".date("d M Y ", strtotime($start_date)));
					array_push($values, "END DATE: ".date("d M Y ", strtotime($end_date)));
					array_push($values, "CURRENT PROGRESS: ".$progress."%");
					array_push($values, "PROJECT STATUS: ".$info['projectStatus']);
					array_push($values, "DESCRIPTION: ".$project_desc);
					$mail_request = array("subject" =>"New Project", "msg" => $_SESSION['ncg-active']['NAME']." Created a new project.", "values" =>$values, "project" =>$info['pname']);
					//NCG_FUNCT::SEND_EMAIL_NOTIFICATION_ADMINS($mail_request);

					$dom = "response=success&msg=Project ".$info['pname']." added successfully!&html=<hr/><br>No client assigned to project!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_projects.php?xyz=".$dirty_data);
					exit();
				}else{
					$customer = NCG_FUNCT::GET_CUSTOMER($info['projectClient']);
					$values = array();
					array_push($values, "PROJECT NAME: ".$pname);
					array_push($values, "CLIENT: ".$customer['CLIENT_NAME']);
					array_push($values, "CONTRACT VALUE: ".$currency." ".NCG_FUNCT::MINIFY_NUMBER($contract_value));
					array_push($values, "CONTRACT DATE: ".date("d M Y ", strtotime($contract_date)));
					array_push($values, "START DATE: ".date("d M Y ", strtotime($start_date)));
					array_push($values, "END DATE: ".date("d M Y ", strtotime($end_date)));
					array_push($values, "CURRENT PROGRESS: ".$progress."%");
					array_push($values, "PROJECT STATUS: ".$info['projectStatus']);
					array_push($values, "DESCRIPTION: ".$project_desc);
					$mail_request = array("subject" =>"New Project", "msg" => $_SESSION['ncg-active']['NAME']." Created a new project.", "values" =>$values, "project" =>$info['pname']);
					//NCG_FUNCT::SEND_EMAIL_NOTIFICATION_ADMINS($mail_request);
					$dom = "response=success&msg=Project ".$info['pname']." added successfully!&html=<hr/><br>Project Owner <h4>".$customer['CLIENT_NAME']."</h4>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_projects.php?xyz=".$dirty_data);
					exit();
				}
			}
			else{
				$control_query = "DELETE FROM ncg_projects WHERE REC_ID LIKE '$project_id'";
				DATABASE::RUN_QUERY($control_query);
				$dom = "response=error&msg=Failed recording project ".$info['pname']."&html=<hr/><br>REASON: ".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_projects.php?xyz=".$dirty_data);
				exit();
			}

		}

		static function UPDATE_PROJECT_PROGRESS_PRIMARY_JL21($info){
			$pid = $info['pid'];
			$progress = $info['progress'];
			$request_query = "UPDATE ncg_project_info SET PROJECT_PROGRESS = '$progress' WHERE PROJECT_ID = $pid";
			$request_response = DATABASE::RUN_QUERY($request_query);

			if($request_response['response'] == "success"){
				return "success";
			}else{
				return $request_response['message'];
			}
		}

		static function UPDATE_PROJECT_PROGRESS_JL21($args){
			$pid = $args['projectId'];
			$progress = $args['progress'];
			$prev = $args['prev'];

			$_project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
			$progress_query = "UPDATE ncg_project_info SET PROJECT_PROGRESS = $progress WHERE PROJECT_ID = $pid";
			$progress_response = DATABASE::RUN_QUERY($progress_query);
			if($progress_response['response'] == "success"){
						if($progress == 100){
							$status_query = "UPDATE ncg_projects SET STATUS = 'Complete' WHERE PROJECT_ID = $pid";
							DATABASE::RUN_QUERY($status_query);
						}
						if(isset($_POST['mobile'])){
							$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-mb-active']['UID']);
						}else{
							$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
						}
						$update_request = array("pid" =>$pid, "progress" =>$progress, "progressDesc" =>$args['progressDesc'], "addedBy" =>$_add);
						NCG_FUNCT::LOG_PROJECT_PROGRESS_JL21($update_request, $pid, $prev);

						$values = array();
						array_push($values, "OLD PROJECT PROGRESS: ".$_project_info['PROJECT_PROGRESS']."%");
						array_push($values, "NEW PROJECT PROGRESS: ".$progress."%");
						if($_project_info['PROJECT_PROGRESS'] == 100){
							NCG_FUNCT::CONTROL_STATUS($pid);
							array_push($values, "Project is now ongoing.");
						}

						$email_request = array("subject" =>"Project Progreess Report", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." updated progress for the project " );
						//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
				if(isset($_POST['mobile'])){
					$dom = "response=success&msg=Progress updated successfully!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_mb_in_home.php?xyz=".$dirty_data);
					exit();
				}else{
					$dom = "response=error&msg=Failed to update progress!&html=<hr/><br>REASON: ".$progress_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}
			}else{
				if(isset($_POST['mobile'])){
					$dom = "response=error&msg=Failed to update progress!&html=<hr/><br>REASON: ".$progress_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_mb_in_home.php?xyz=".$dirty_data);
					exit();
				}else{
					$dom = "response=error&msg=Failed to update progress!&html=<hr/><br>REASON: ".$progress_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}
			}
		}
		static function NEW_PAYMENT_CERTIFICATE_RJL21($info){
			$pid = $_POST['projectId'];
			$cert_num = $_POST['certNum'];
			$cert_reason = $_POST['payCertReason'];
			$sub_date = $_POST['subDate'];
			$due_date = $_POST['dueDate'];
			$cert_amt = $_POST['payCertAmt'];
			$cert_status = $_POST['certStatus'];
			$cert_desc = $_POST['payCertDesc'];
			if(isset($_POST['mobile'])){
				$amended_by = $_SESSION['ncg-mb-active']['UID'];
			}else{
				$amended_by = $_SESSION['ncg-active']['UID'];	
			}
			$cert_save_query = "INSERT INTO ncg_payment_certificates (PROJECT_ID, CERT_NUM, CREATED_BY, CERT_SUB_DATE, CERT_DUE_DATE, CERT_AMOUNT, CERT_REASON, CERT_STATUS, CERT_DESC) VALUES ($pid, '$cert_num', $amended_by, '$sub_date', '$due_date', $cert_amt, '$cert_reason', '$cert_status', '$cert_desc')";
			$save_response = DATABASE::RUN_QUERY($cert_save_query);

			if($save_response['response'] == "success"){
				$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
				$cert_value = $project_finance_data['CLAIMED'];
				$new_cert_value = $cert_value + $cert_amt;

				$update_query = "UPDATE ncg_project_finances SET CLAIMED = $new_cert_value WHERE PROJECT_ID = $pid";
				$update_response = DATABASE::RUN_QUERY($update_query);

				if($update_response['response'] == "success"){
					$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
						$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
						$values = array();
						array_push($values, "CLAIMED CERT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($cert_amt));
						array_push($values, "TOTAL CLAIMED CERT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_cert_value));
						array_push($values, "PAY-CERTIFICATE REASON: ".$cert_reason);
						array_push($values, "PAY-CERTIFICATE DESCRIPTION: ".$cert_desc);

						$email_request = array("subject" =>"Payment Certificate".$cert_num."(New)", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." added a new payment certificate (".$cert_num.") for the project ", "source" =>$info['source'] );
						//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$pid."&response=success&msg=Payment certificate saved!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pid=".$pid."&response=success&msg=Payment certificate saved!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
					}
				}
				else{
					$correction_id = $save_response['query_id'];
					$correction_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
					}
				}
			}
			else{
				if(isset($_POST['mobile'])){
					$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}else{
				$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
				}
			}
		}
		static function GEN_PAY_ID($CERT_ID){
			$alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','Z','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];
			$cert_query = "SELECT * FROM ncg_payments WHERE CERT_NUM ='$CERT_ID'";
			$res = DATABASE::RUN_QUERY($cert_query);
			$count = mysqli_num_rows($res['data']);

			return $CERT_ID."-".$alpha[$count];
		}
		function CERT_PARTIAL_PAYMENTS($cert_num){
			$payments_query = "SELECT * FROM ncg_payments WHERE CERT_NUM ='$cert_num'";
			$res = DATABASE::RUN_QUERY($payments_query);

			if(mysqli_num_rows($res['data']) > 0){
				return true;
			}else{
				return false;
			}
		}
		static function EDIT_PAYMENT_JL21($info){
			$pid = $info['pid'];
			$cid = $info['pc'];
			$pcid = $info['pcid'];
			$c = $info['c'];
			$payement_id = $info['payment'];
			$certificate_id = $info['certificate'];
			$date = $info['date'];
			$desc = $info['desc'];
			$cv = $info['cv'];

			$oA = $info['old-amnt'];
			$nA = $info['new-amnt'];

			$p = $info['paid'];

			$ov = $info['o-payment'];

			$update_request = "UPDATE ncg_payments SET PAY_DATE = '$date', AMOUNT = $nA , DESCRIPTION = '$desc' WHERE REC_ID = $pcid";
			$request_response = DATABASE::RUN_QUERY($update_request);
			$project_finances_query = "SELECT * FROM ncg_project_finances WHERE PROJECT_ID = $pid";
			$finances_data = DATABASE::RUN_QUERY($project_finances_query);
			$finances = mysqli_fetch_assoc($finances_data['data']);

			$project_cert_query = "SELECT * FROM ncg_payment_certificates WHERE REC_ID = $cid";
			$cert_data = DATABASE::RUN_QUERY($project_cert_query);
			$cert = mysqli_fetch_assoc($cert_data['data']);
			$old_status =$cert['CERT_STATUS'];
			$old_cert_paid =$cert['CERT_PAID'];

			$project_remaining = $finances['REMAINING_VALUE'] + $oA;
			$new_project_remaining = $project_remaining - $nA;

			$cert_paid = $cert['CERT_PAID'] - $oA;
			$new_cert_paid = $cert_paid + $nA;

			$project_paid = $finances['PAID'] - $oA;
			$new_project_paid = $project_paid + $nA;

			if($request_response['response'] == "success"){

					$status = "Partially";
				if($cert['CERT_AMOUNT'] == $new_cert_paid){
					$status = "Paid";					
				}
				if($new_cert_paid == 0){
					$status = "Outstanding";					
				}
				if($cert['CERT_AMOUNT'] < $new_cert_paid){
					$status = "Paid";
				 	$ov = $new_cert_paid - $cert['CERT_AMOUNT'];
				 	$new_project_remaining = 0;
				 	$new_project_paid = $finances['CURRENT_VALUE'];					
				}

				 $q = "UPDATE ncg_payment_certificates SET CERT_PAID = $new_cert_paid,  CERT_STATUS = '$status' WHERE REC_ID = $cid";
				 DATABASE::RUN_QUERY($q);

				 $fin_update = "UPDATE ncg_project_finances SET PAID = $new_project_paid, REMAINING_VALUE = $new_project_remaining, OVER_PAYMENT = $ov WHERE PROJECT_ID = $pid";
				 $res = DATABASE::RUN_QUERY($fin_update);

				 if($res['response'] == "success"){
				 		$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
				 		$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
				 		$values = array();
				 		array_push($values, "OLD AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($oA));
				 		array_push($values, "NEW AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($nA));

				 		array_push($values, "REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_project_remaining));
				 		array_push($values, "OVER PAYMENT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($ov));

				 		$email_request = array("subject" =>"Partial Payment ".$payement_id."(Edited)", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." updated partial payment ".$payement_id." for the certificate ".$certificate_id. " under the project ", "source" =>"desktop" );
				 		//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);

				 	$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=success&msg=Payment Updated successfully!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_pay_cert_info?xyz=".$dirty_data);
						exit();
				 }else{
				 	$q = "UPDATE ncg_payment_certificates SET CERT_PAID = $old_cert_paid,  CERT_STATUS = '$old_status' WHERE REC_ID = $cid";
				 	DATABASE::RUN_QUERY($q);
				 	$revert = "UPDATE ncg_payments SET AMOUNT = $oA WHERE REC_ID = $pcid";
				 	DATABASE::RUN_QUERY($revert);
				 	$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=error&msg=Failed to update payment"." CID :".$cid."&html=<hr/><br>REASON: Failed updating finances record:".$res['message'];
				 	$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				 	header("Location: ncg_pay_cert_info?xyz=".$dirty_data);
				 	exit();
				 }
			}else{
				$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=error&msg=Failed to update payment &html=<hr/><br>REASON: Failed updating payment record:".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_pay_cerdt_info?xyz=".$dirty_data);
				 	exit();
			}

		}
		static function NEW_PAYMENT_JL21($info){
			$pid = $info['pid'];
			$cid = $info['pc'];
			$c = $info['c'];
			$cert_num = $info['certNum'];
			$pay_date = $info['payDate'];
			$pay_amount = $info['payAmount'];
			$pay_desc = $info['payDesc'];
			$pay_id = NCG_FUNCT::GEN_PAY_ID($cert_num);
			if(isset($info['mobile'])){
				$added_by = $_SESSION['ncg-mb-active']['UID'];
			}else{
				$added_by = $_SESSION['ncg-active']['UID'];	
			}

			$payment_query = "INSERT INTO ncg_payments (PROJECT_ID, CERT_NUM, PAY_ID, PAY_DATE, AMOUNT, ADDED_BY, DESCRIPTION) VALUES ($pid,'$cert_num', '$pay_id', '$pay_date', $pay_amount, $added_by, '$pay_desc')";
			$pay_response = DATABASE::RUN_QUERY($payment_query);
			if($pay_response['response'] == "success"){
				$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
				$pv = $project_finance_data['PAID'];
				$rv = $project_finance_data['REMAINING_VALUE'];
				$op = $project_finance_data['OVER_PAYMENT'];
				$new_pv = $pv + $pay_amount;
				$status_cert = "Partially";
				$new_rv = $rv - $pay_amount;
				if($new_rv < 0){
					$new_rv = 0;
					$op += $pay_amount - $rv;
					$status_cert = "Paid";
				}
				if($new_rv == 0){
					$status_cert = "Paid";
				}else{
					$status_cert = "Partially";
				}
				$project_cert_query = "SELECT * FROM ncg_payment_certificates WHERE REC_ID = $cid";
				$cert_data = DATABASE::RUN_QUERY($project_cert_query);
				$cert = mysqli_fetch_assoc($cert_data['data']);
				$cert_paid = $cert['CERT_PAID'] + $pay_amount;

				$update_cert_query = "UPDATE ncg_payment_certificates SET CERT_PAID = $cert_paid, CERT_STATUS = '$status_cert' WHERE REC_ID = $cid";
				DATABASE::RUN_QUERY($update_cert_query);


				$update_query = "UPDATE ncg_project_finances SET PAID = $new_pv, REMAINING_VALUE = $new_rv, OVER_PAYMENT = $op WHERE PROJECT_ID = $pid";
				$update_response = DATABASE::RUN_QUERY($update_query);

				if($update_response['response'] == "success"){
					$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
						$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
						$values = array();
						array_push($values, "PAID AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($payAmount));
						array_push($values, "TOTAL PAID AMOUNT (PROJECT): ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_pv));
						array_push($values, "REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_rv));
						array_push($values, "OVER PAYMENT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($op));

						$email_request = array("subject" =>"Partial Payment ".$pay_id."(New)", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." added a new partial payment for the certificate ".$cert_num." for the project ", "source" =>$info['source'] );
						//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$pid."&response=success&msg=Payment certificate saved!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=success&msg=Payment certificate saved!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
						exit();
					}
				}
				else{
					$correction_id = $save_response['query_id'];
					$correction_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					if(isset($_POST['mobile'])){
						$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_cert_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
						exit();
					}
				}
			}
			else{
				if(isset($_POST['mobile'])){
					$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
					exit();
				}else{
				$dom = "pc=".$cid."&C=".$c."&pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
				exit();
				}
			}
		}

		static function EDIT_PAYMENT_CERTIFICATE_JL21($info){
			$pid = $info['projectId'];
			$cert_reason = $info['payCertReason'];
			$cert_amt = $info['payCertAmt'];
			$cert_desc = $info['payCertDesc'];
			$pc_id = $info['pcId'];
			$c = $info['c'];

			$old_pc = NCG_FUNCT::GET_PAYMENT_CERTIFICATE($pc_id);

			$pc_diff = $cert_amt - $old_pc['CERT_AMOUNT'];

			$cert_edit_query = "UPDATE ncg_payment_certificates SET CERT_AMOUNT = $cert_amt, CERT_REASON = '$cert_reason', CERT_DESC = '$cert_desc' WHERE REC_ID = $pc_id";
			$edit_response = DATABASE::RUN_QUERY($cert_edit_query);

			if($edit_response['response'] == "success"){
				$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
				$claimed = $project_finance_data['CLAIMED'];

				$new_claimed = $claimed + $pc_diff;

				$update_query = "UPDATE ncg_project_finances SET CLAIMED = $new_claimed WHERE PROJECT_ID = $pid";
				$update_response = DATABASE::RUN_QUERY($update_query);

				if($update_response['response'] == "success"){
						$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
						$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
						$values = array();
						array_push($values, "EDIT PAY-CERTIFICATE CLAIM AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($cert_amt));
						array_push($values, "OLD PAY-CERTIFICATE CLAIM AMOUNT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($old_pc['CERT_AMOUNT']));
						array_push($values, "OLD TOTAL CLAIMED: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($claimed));
						array_push($values, "NEW TOTAL CLAIMED: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_claimed));
						array_push($values, "PAY-CERTIFICATE REASON: ".$cert_reason);
						array_push($values, "PAY-CERTIFICATE DESCRIPTION: ".$cert_desc);

						$email_request = array("subject" =>"Payment Certificate ".$pcid."(Edited)", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." edited a the payment certificate ".$pcid." for the project " );
						//NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					if(isset($_POST['mobile'])){

						$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=success&msg=Payment certificate updated!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_cert_info.php?xyz=".$dirty_data);
						exit();
					}
					else{

						$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=success&msg=Payment certificate updated!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
						exit();
					}
				}
				else{
					$correction_id = $edit_response['query_id'];
					$correction_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=error&msg=Failed to update payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
					exit();
				}

			}
			else{
				$dom = "pc=".$pc_id."&C=".$c."&pid=".$pid."&response=error&msg=Failed to update payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_pay_cert_info.php?xyz=".$dirty_data);
				exit();
			}

		}
		static function GET_TOTAL_PAID_JL21($cert, $pid){
			$paid = 0;
			$query = "SELECT * FROM ncg_payments WHERE CERT_NUM = '$cert' AND PROJECT_ID = $pid";
			$res = DATABASE::RUN_QUERY($query);
			$res_data = $res['data'];
			while($data = $res_data ->fetch_assoc()){
				$paid +=$data['AMOUNT'];
			}

			return $paid;
		}

		/*END OF NEW FUNCTIONS
	 	END OF JULY 2021 SYSTEM UPDATES */
		static function NEW_PAYMENT_CERTIFICATE($info){
			$pid = $info['projectId'];
			$cert_reason = $info['payCertReason'];
			$cert_amt = $info['payCertAmt'];
			$cert_desc = $info['payCertDesc'];
			if(isset($_POST['mobile'])){
				$amended_by = $_SESSION['ncg-mb-active']['UID'];
			}else{
				$amended_by = $_SESSION['ncg-active']['UID'];	
			}
			$cert_save_query = "INSERT INTO ncg_payment_certificates (PROJECT_ID, CREATED_BY, CERT_AMOUNT, CERT_REASON, CERT_DESC) VALUES ($pid, $amended_by, $cert_amt, '$cert_reason', '$cert_desc')";
			$save_response = DATABASE::RUN_QUERY($cert_save_query);

			if($save_response['response'] == "success"){
				$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
				$pv = $project_finance_data['PAYMENT_VALUE'];
				$rv = $project_finance_data['REMAINING_VALUE'];
				$op = $project_finance_data['OVER_PAYMENT'];
				$new_pv = $pv + $cert_amt;
				
				$new_rv = $rv - $cert_amt;
				if($new_rv < 0){
					$new_rv = 0;
					$op += $cert_amt - $rv;
				}

				$update_query = "UPDATE ncg_project_finances SET PAYMENT_VALUE = $new_pv, REMAINING_VALUE = $new_rv, OVER_PAYMENT = $op WHERE PROJECT_ID = $pid";
				$update_response = DATABASE::RUN_QUERY($update_query);

				if($update_response['response'] == "success"){
					$_add = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
						$project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
						$values = array();
						array_push($values, "PAYMENT VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($cert_amt));
						array_push($values, "NEW PAY-CERTIFICATE VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_pv));
						array_push($values, "REMAINING VALUE: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($new_rv));
						array_push($values, "OVER PAYMENT: ".$project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($op));
						array_push($values, "PAY-CERTIFICATE REASON: ".$cert_reason);
						array_push($values, "PAY-CERTIFICATE DESCRIPTION: ".$cert_desc);

						$email_request = array("subject" =>"New Project Pay-Cert", "pid" =>$pid, "values" =>$values, "msg" =>$_add['NAME']." added a new payment certificate for the project ", "source" =>$info['source'] );
						NCG_FUNCT::SEND_PROJECT_UPDATE_EMAIL($email_request);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$pid."&response=success&msg=Payment certificate saved!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pid=".$pid."&response=success&msg=Payment certificate saved!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
					}
				}
				else{
					$correction_id = $save_response['query_id'];
					$correction_query = "DELETE FROM ncg_payment_certificates WHERE REC_ID = $correction_id";
					DATABASE::RUN_QUERY($correction_query);
					if(isset($_POST['mobile'])){
						$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: Failed updating finances record:".$update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
					}
				}
			}
			else{
				if(isset($_POST['mobile'])){
					$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_mb_in_project_info.php?xyz=".$dirty_data);
					exit();
				}else{
				$dom = "pid=".$pid."&response=error&msg=Failed to save payment certificate &html=<hr/><br>REASON: ".$save_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
				}
			}
		}
		static function VO_UPDATE_PROJECT_FINANCES($info, $action){

			$pid = $info['projectId'];
			$project_finance_data = NCG_FUNCT::GET_PROJECT_FINANCES($pid);

			$old_va_data = NCG_FUNCT::GET_VARIATION_ORDER($info['voId']);

			$o_va = $project_finance_data['VARIATION_VALUE'];
			$o_cv = $project_finance_data['CURRENT_VALUE'];
			$o_rv = $project_finance_data['REMAINING_VALUE'];

			$x_va = $o_va - $old_va_data['VO_AMOUNT'];
			$x_cv = $o_cv - $old_va_data['VO_AMOUNT'];
			$x_rv = $o_rv - $old_va_data['VO_AMOUNT'];

			$va = $info['voAmount'];
			if($action == "new"){

			$n_va = $o_va + $va;
			$n_cv = $o_cv + $va;
			$n_rv = $o_rv + $va;


			$finance_update_query = "UPDATE ncg_project_finances SET VARIATION_VALUE = $n_va, CURRENT_VALUE = $n_cv, REMAINING_VALUE = $n_rv WHERE PROJECT_ID = $pid";
			}
			if($action == "edit"){
					$n_va = $x_va + $va;
					$n_cv = $x_cv + $va;
					$n_rv = $x_rv + $va;
			$vo_id = $info['voId'];


			$finance_update_query = "UPDATE ncg_project_finances SET VARIATION_VALUE = $n_va, CURRENT_VALUE = $n_cv, REMAINING_VALUE = $n_rv WHERE REC_ID = $vo_id";
			}
			return DATABASE::RUN_QUERY($finance_update_query);
		}
		
		static function NEW_PROJECT($info){
			$added_by = $info['addedBy'];
			$cid = $info['projectClient'];
			$status = $info['projectStatus'];
			if ($cid == "null") {
				$cid = 0;
			}
			$new_project_query = "INSERT INTO ncg_projects (ADDED_BY, CUSTOMER_ID, STATUS) VALUES ('$added_by', '$cid', '$status')";
			$request_response = DATABASE::RUN_QUERY($new_project_query);
			if($request_response['response'] == "success"){
				NCG_FUNCT::SAVE_PROJECT_INFO($info, $request_response['query_id']);
			}else{
				$dom = "response=error&msg=Failed recording project ".$info['pname']."&html=<hr/><br>REASON: ".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_projects.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function SAVE_PROJECT_INFO($info, $project_id){
			$pname = $info['pname'];
			$contract_date = $info['contractDate'];
			$start_date = $info['startDate'];
			$end_date = $info['endDate'];
			$progress = $info['progress'];
			$contract_value = $info['conValue'];
			$currency = $info['currency'];
			$project_desc = $info['projectDesc'];
			$finances_query = "INSERT INTO ncg_project_finances (PROJECT_ID, CURRENT_VALUE, REMAINING_VALUE) VALUES ('$project_id', '$contract_value', '$contract_value')";
			DATABASE::RUN_QUERY($finances_query);
			$project_info_query = "INSERT INTO ncg_project_info (PROJECT_ID, PROJECT_NAME, CONTRACT_DATE, BASE_START, BASE_END, START_DATE, END_DATE, PROJECT_PROGRESS, CONTRACT_VALUE, CURRENCY, PROJECT_DESC) VALUES ('$project_id', '$pname', '$contract_date', '$start_date', '$end_date', '$start_date', '$end_date', '$progress', '$contract_value', '$currency', '$project_desc')";
			$request_response = DATABASE::RUN_QUERY($project_info_query);
			if($request_response['response'] == "success"){
				if($info['projectClient'] == "null"){
					$values = array();
					array_push($values, "PROJECT NAME: ".$pname);
					array_push($values, "CLIENT: No client assigned");
					array_push($values, "CONTRACT VALUE: ".$currency." ".NCG_FUNCT::MINIFY_NUMBER($contract_value));
					array_push($values, "CONTRACT DATE: ".date("d M Y ", strtotime($contract_date)));
					array_push($values, "START DATE: ".date("d M Y ", strtotime($start_date)));
					array_push($values, "END DATE: ".date("d M Y ", strtotime($end_date)));
					array_push($values, "CURRENT PROGRESS: ".$progress."%");
					array_push($values, "PROJECT STATUS: ".$info['projectStatus']);
					array_push($values, "DESCRIPTION: ".$project_desc);
					$mail_request = array("subject" =>"New Project", "msg" => $_SESSION['ncg-active']['NAME']." Created a new project.", "values" =>$values, "project" =>$info['pname']);
					NCG_FUNCT::SEND_EMAIL_NOTIFICATION_ADMINS($mail_request);

					$dom = "response=success&msg=Project ".$info['pname']." added successfully!&html=<hr/><br>No client assigned to project!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_projects.php?xyz=".$dirty_data);
					exit();
				}else{
					$customer = NCG_FUNCT::GET_CUSTOMER($info['projectClient']);
					$values = array();
					array_push($values, "PROJECT NAME: ".$pname);
					array_push($values, "CLIENT: ".$customer['CLIENT_NAME']);
					array_push($values, "CONTRACT VALUE: ".$currency." ".NCG_FUNCT::MINIFY_NUMBER($contract_value));
					array_push($values, "CONTRACT DATE: ".date("d M Y ", strtotime($contract_date)));
					array_push($values, "START DATE: ".date("d M Y ", strtotime($start_date)));
					array_push($values, "END DATE: ".date("d M Y ", strtotime($end_date)));
					array_push($values, "CURRENT PROGRESS: ".$progress."%");
					array_push($values, "PROJECT STATUS: ".$info['projectStatus']);
					array_push($values, "DESCRIPTION: ".$project_desc);
					$mail_request = array("subject" =>"New Project", "msg" => $_SESSION['ncg-active']['NAME']." Created a new project.", "values" =>$values, "project" =>$info['pname']);
					NCG_FUNCT::SEND_EMAIL_NOTIFICATION_ADMINS($mail_request);
					$dom = "response=success&msg=Project ".$info['pname']." added successfully!&html=<hr/><br>Project Owner <h4>".$customer['CLIENT_NAME']."</h4>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_projects.php?xyz=".$dirty_data);
					exit();
				}
			}
			else{
				$control_query = "DELETE FROM ncg_projects WHERE REC_ID LIKE '$project_id'";
				DATABASE::RUN_QUERY($control_query);
				$dom = "response=error&msg=Failed recording project ".$info['pname']."&html=<hr/><br>REASON: ".$request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_projects.php?xyz=".$dirty_data);
				exit();
			}

		}
		static function GET_AFFILIATE_PROJECT($id){
			$projects_query = "SELECT * FROM ncg_projects WHERE CUSTOMER_ID = $id";
			$request_response = DATABASE::RUN_QUERY($projects_query);
			return $request_response['data'];
		}
		static function GET_PROJECT($id){
			$projects_query = "SELECT * FROM ncg_projects WHERE PROJECT_ID = $id";
			$request_response = DATABASE::RUN_QUERY($projects_query);
			return mysqli_fetch_assoc($request_response['data']);
		}
		static function GET_PROJECT_FINANCES($id){
			$finances_query = "SELECT * FROM ncg_project_finances WHERE PROJECT_ID = $id";
			$request_response = DATABASE::RUN_QUERY($finances_query);
			return mysqli_fetch_assoc($request_response['data']);
		}
		static function GET_PROJECTS(){
			$projects_query = "SELECT * FROM ncg_projects";
			$request_response = DATABASE::RUN_QUERY($projects_query);
			return $request_response['data'];
		}
		static function GET_PROJECT_INFO($id){
			$project_info_query = "SELECT * FROM ncg_project_info WHERE PROJECT_ID = $id";
			$project_info_response = DATABASE::RUN_QUERY($project_info_query);
			return mysqli_fetch_assoc($project_info_response['data']);
		}
		static function GET_PROJECT_DATES($id){
			$projects_dates_query = "SELECT * FROM ncg_delivery_dates WHERE PROJECT_ID = $id ORDER BY TIMESTAMP ASC";
			$projects_dates_response = DATABASE::RUN_QUERY($projects_dates_query);
			return $projects_dates_response['data'];
		}
		static function GET_VARIATION_ORDER($id){
			$variation_order_query = "SELECT * FROM ncg_variation_orders WHERE REC_ID = $id";
			$variation_order_response = DATABASE::RUN_QUERY($variation_order_query);
			return mysqli_fetch_assoc($variation_order_response['data']);
		}
		static function GET_VARIATION_ORDERS($id){
			$variation_order_query = "SELECT * FROM ncg_variation_orders WHERE PROJECT_ID = $id";
			$variation_order_response = DATABASE::RUN_QUERY($variation_order_query);
			return $variation_order_response['data'];
		}
		static function GET_PAYMENT_CERTIFICATE($id){
			$payment_cert_query = "SELECT * FROM ncg_payment_certificates WHERE REC_ID = $id";
			$payment_cert_response = DATABASE::RUN_QUERY($payment_cert_query);
			return mysqli_fetch_assoc($payment_cert_response['data']);
		}
		static function GET_PAYMENT_CERTIFICATES($id){
			$payment_cert_query = "SELECT * FROM ncg_payment_certificates WHERE PROJECT_ID = $id ORDER BY CERT_SUB_DATE ASC";
			$payment_cert_response = DATABASE::RUN_QUERY($payment_cert_query);
			return $payment_cert_response['data'];
		}
		static function GET_PAYMENTS($id, $pid){
			$payment_query = "SELECT * FROM ncg_payments WHERE CERT_NUM = '$id' AND PROJECT_ID = $pid";
			$payment_response = DATABASE::RUN_QUERY($payment_query);
			return $payment_response['data'];
		}
		static function GET_CUSTOMER($id){
			$customer_query = "SELECT * FROM ncg_clients WHERE CUSTOMER_ID LIKE '$id'";
			$customer_request_response = DATABASE::RUN_QUERY($customer_query);
			return mysqli_fetch_assoc($customer_request_response['data']);
		}
		static function GET_CUSTOMERS(){
			$customer_query = "SELECT * FROM ncg_clients";
			$customer_request_response = DATABASE::RUN_QUERY($customer_query);
			return $customer_request_response['data'];
		}
		static function GET_CUSTOMER_CONTACTS($id){
			$customer_contacts_query = "SELECT * FROM ncg_contacts WHERE CLIENT_ID LIKE '$id'";
			$customer_contacts_response = DATABASE::RUN_QUERY($customer_contacts_query);
			return $customer_contacts_response['data'];
		}
		static function GET_CUSTOMER_CONTACTS_COUNT($id){
			$customer_contacts_query = "SELECT * FROM ncg_contacts WHERE CLIENT_ID LIKE '$id'";
			$customer_contacts_response = DATABASE::RUN_QUERY($customer_contacts_query);
			return mysqli_num_rows($customer_contacts_response['data']);
		}
		static function GET_CUSTOMER_ADDRESSES($id){
			$customer_addresses_query = "SELECT * FROM ncg_addresses WHERE CLIENT_ID LIKE '$id'";
			$customer_addresses_response = DATABASE::RUN_QUERY($customer_addresses_query);
			return $customer_addresses_response['data'];
		}
		static function GET_CUSTOMER_ADDRESSES_COUNT($id){
			$customer_addresses_query = "SELECT * FROM ncg_addresses WHERE CLIENT_ID LIKE '$id'";
			$customer_addresses_response = DATABASE::RUN_QUERY($customer_addresses_query);
			return mysqli_num_rows($customer_addresses_response['data']);
		}
		static function GET_CUSTOMER_PROJECTS($id){
			$customer_projects_query = "SELECT * FROM ncg_projects WHERE CUSTOMER_ID LIKE '$id'";
			$customer_projects_response = DATABASE::RUN_QUERY($customer_projects_query);
			return $customer_projects_response['data'];
		}
		static function GET_CUSTOMER_PROJECTS_COUNT($id){
			$customer_projects_query = "SELECT * FROM ncg_projects WHERE CUSTOMER_ID LIKE '$id'";
			$customer_projects_response = DATABASE::RUN_QUERY($customer_projects_query);
			return mysqli_num_rows($customer_projects_response['data']);
		}static function REG_EXTERNAL_USER_INFO_SEC($info, $user_id){
			$name = $info['name'];
			$phone = $info['phone'];
			$email = $info['email'];

			$reg_user_info_query = "INSERT INTO ncg_external_users_info (USER_ID, USER_NAME, USER_PHONE, USER_EMAIL) VALUES ('$user_id', '$name', '$phone', '$email')";
			$reg_user_info_response = DATABASE::RUN_QUERY($reg_user_info_query);
			if($reg_user_info_response['response'] == "success"){
				$affiliation = NCG_FUNCT::GET_AFFILIATION($user_id);
				$email_request = array("email" =>$email, "pass" =>$info['clean-pass'], "name" =>$name, "client" =>$affiliation, "msg" =>"please find login credentials to your account on the Inyatsi Client project management mobile application.", "subject" =>"Mobile App Credentials");
				if($email != 0){
					if(NCG_FUNCT::SEND_EMAIL($email_request)){
						if(!(!NCG_FUNCT::CHECK_EXTERNAL_GROUP_EXISTANCE())){
						$g_data = NCG_FUNCT::GET_EXTERNAL_GROUP();
						$mail_response = "Credentials sent to ".$email;
						NCG_FUNCT::ADD_TO_EXTERNAL_GROUP($g_data['REC_ID'], $user_id);
						$res ="User ". $info['name']." added successfully!<hr/><br>User added to <h4>".$g_data['GRP_NAME']."</h4> security group<hr/>".$mail_response;
					}else{
						$mail_response = "Credentials sent to ".$email;
						$res ="User ".$info['name']." added successfully!<hr/><br>User not added to security group<br><h4>No External Group Found</h4><hr/>".$mail_response;
					}
				}else{
					if(!(!NCG_FUNCT::CHECK_EXTERNAL_GROUP_EXISTANCE())){
						$g_data = NCG_FUNCT::GET_EXTERNAL_GROUP();
						$mail_response = "Failed to send credentials to ".$email;
						NCG_FUNCT::ADD_TO_EXTERNAL_GROUP($g_data['REC_ID'], $user_id);
						$res = "User ".$info['name']." added successfully!<hr/><br>User added to <h4>".$g_data['GRP_NAME']."</h4> security group<hr/>".$mail_response;
					}else{
						$res = "User ".$info['name']." added successfully!<hr/><br>User not added to security group<br><h4>No External Group Found</h4><hr/>".$mail_response;
					}
				}
					
				}else{
					if(!(!NCG_FUNCT::CHECK_EXTERNAL_GROUP_EXISTANCE())){
						$g_data = NCG_FUNCT::GET_EXTERNAL_GROUP();
						$mail_response = "No Credentials Sent";
						NCG_FUNCT::ADD_TO_EXTERNAL_GROUP($g_data['REC_ID'], $user_id);
						$res = "User ".$info['name']." added successfully!<hr/><br>User added to <h4>".$g_data['GRP_NAME']."</h4> security group<hr/>".$mail_response;
					}else{
						$res = "User ".$info['name']." added successfully!<hr/><br>User not added to security group<br><h4>No External Group Found</h4><hr/>".$mail_response;
					}
				}
			}else{
				$res = "User Account Registered. Failed to register ".$name." information!<hr/><br>Information can be updated later.<hr/><h4>".$reg_user_info_response['message']."</h4>";
			}
		}static function REG_EXTERNAL_USER_INFO($info, $user_id){
			$name = $info['name'];
			$phone = $info['phone'];
			$email = $info['email'];

			$reg_user_info_query = "INSERT INTO ncg_external_users_info (USER_ID, USER_NAME, USER_PHONE, USER_EMAIL) VALUES ('$user_id', '$name', '$phone', '$email')";
			$reg_user_info_response = DATABASE::RUN_QUERY($reg_user_info_query);
			if($reg_user_info_response['response'] == "success"){
				$affiliation = NCG_FUNCT::GET_AFFILIATION($user_id);
				$email_request = array("email" =>$email, "pass" =>$info['clean-pass'], "name" =>$name, "client" =>$affiliation, "msg" =>"please find login credentials to your account on the Inyatsi Client project management mobile application.", "subject" =>"Mobile App Credentials");
				if(NCG_FUNCT::SEND_EMAIL($email_request)){
					if(!(!NCG_FUNCT::CHECK_EXTERNAL_GROUP_EXISTANCE())){
						$g_data = NCG_FUNCT::GET_EXTERNAL_GROUP();
						$mail_response = "Credentials sent to ".$email;
						NCG_FUNCT::ADD_TO_EXTERNAL_GROUP($g_data['REC_ID'], $user_id);
						$dom = "response=success&msg=".$info['name']." added successfully!&html=<hr/><br>User added to <h4>".$g_data['GRP_NAME']."</h4> security group<hr/>".$mail_response;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_users.php?xyz=".$dirty_data);
						exit();
					}else{
						$mail_response = "Credentials sent to ".$email;
						$dom = "response=success&msg=".$info['name']." added successfully!&html=<hr/><br>User not added to security group<br><h4>No External Group Found</h4><hr/>".$mail_response;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_users.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					if(!(!NCG_FUNCT::CHECK_EXTERNAL_GROUP_EXISTANCE())){
						$g_data = NCG_FUNCT::GET_EXTERNAL_GROUP();
						$mail_response = "Failed to send credentials to ".$email;
						NCG_FUNCT::ADD_TO_EXTERNAL_GROUP($g_data['REC_ID'], $user_id);
						$dom = "response=success&msg=".$info['name']." added successfully!&html=<hr/><br>User added to <h4>".$g_data['GRP_NAME']."</h4> security group<hr/>".$mail_response;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_users.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=success&msg=".$info['name']." added successfully!&html=<hr/><br>User not added to security group<br><h4>No External Group Found</h4><hr/>".$mail_response;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_users.php?xyz=".$dirty_data);
						exit();
					}
				}
			}else{
				$dom = "response=warning&msg=Account Registered. Failed to register ".$name." information!&html=<hr/><br>Information can be updated later.<hr/><h4>".$reg_user_info_response['message']."</h4>";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_users.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function MIME_DECODE($string) {
		  $elements = imap_mime_header_decode($string);
		  for($x = 0;$x < count($elements);$x++) {
		    $charset = $elements[$x]->charset;
		    $text =$elements[$x]->text;
		    if(!strcasecmp($charset, "utf-8") ||
		       !strcasecmp($charset, "utf-7"))
		    {
		      $text = iconv($charset, "EUC-KR", $text);
		    }
		    $decoded_string .= $text;
		  }
		  return $decoded;
		}
		static function GENERATE_PASS($length = 4) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $autoPass = '';
		    for ($i = 0; $i < $length; $i++) {
		        $autoPass .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $autoPass;
		}
		static function RESEND_CREDENTIALS($info){
			$id = $info['id'];
			$from = $info['from'];
			$user_request = "SELECT * FROM ncg_users WHERE REC_ID = $id";
			$res = DATABASE::RUN_QUERY($user_request);
			$user_info_request = "SELECT * FROM ncg_external_users_info WHERE USER_ID = $id";
			$user_info_response = DATABASE::RUN_QUERY($user_info_request);
			$user_info = mysqli_fetch_assoc($res['data']);

			$clean_pass = NCG_FUNCT::NCG_DECRYPT($user_info['PASS_RECOVERY']);
			$user_info_data = mysqli_fetch_assoc($user_info_response['data']);
			$affiliation = NCG_FUNCT::GET_AFFILIATION($user_info['AFFILIATION']);
			$email_request = array("email" =>$user_info_data['USER_EMAIL'], "pass" =>$clean_pass, "name" =>$user_info_data['USER_NAME'], "client" =>$affiliation, "msg" =>"please find login credentials to your account on the Inyatsi Client project management mobile application.", "subject" =>"Mobile App Credentials");
				if(NCG_FUNCT::SEND_EMAIL($email_request)){
					$dom = "id=".$id."&response=success&msg=User credentials successfully resent to &html=<hr><h4><strong>".$user_info_data['USER_NAME']."</strong></h4><br> USER EMAIL: ".$user_info_data['USER_EMAIL']."</p>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ".$from."?xyz=".$dirty_data);
					exit();
				}else{
					$dom = "id=".$id."&response=error&msg=Failed to resend user credentials to &html=<hr><h4><strong>".$user_info_data['USER_NAME']."</strong></h4><br> USER EMAIL: ".$user_info_data['USER_EMAIL']."</p>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ".$from."?xyz=".$dirty_data);
					exit();
				}
		}
		static function UPDATE_CON_EMAIL($email, $cid, $uid, $from){
			$q = "SELECT * FROM ncg_temp_user_data WHERE CLIENT_ID = $cid AND REGISTERED = 0";
			$RES = DATABASE::RUN_QUERY($q);
			$data = mysqli_fetch_assoc($RES['data']);
			$email_data = $data['EMAIL_REQUEST'];
			$reg_data = $data['REG_REQUEST'];
			$reg_data = json_decode($reg_data);
			$email_data = json_decode($email_data);
			$contacts = $email_data->contacts;
			$contacts[4] = "CONTACT EMAIL: ".$email;

			$pass = $reg_data->pass;
			$role = $reg_data->role;
			$status = $reg_data->status;
			$affiliation = $reg_data->affiliation;

			$mail_request_con_person = array("subject" =>$email_data->subject, "msg" =>$email_data->msg, "client" =>$email_data->client, "description" =>$email_data->description, "addresses" =>$email_data->addresses, "contacts" =>$contacts, "c_name" =>$email_data->c_name, "c_email" =>$email);

			
			$reg_user_query = "UPDATE ncg_users SET USER_ID = '$email' WHERE REC_ID = $uid";

			$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
			if($reg_user_request_response['response'] == "success"){
				$up_user_info = "UPDATE ncg_external_users_info SET USER_EMAIL = '$email' WHERE USER_ID = '$uid'";
				$up_data = "UPDATE ncg_temp_user_data SET REGISTERED = 1 WHERE CLIENT_ID = '$cid'";
				$up_contact = "UPDATE ncg_contacts SET CONTACT_EMAIL = '$email' WHERE PRIORITY LIKE 'Primary' AND CLIENT_ID = '$cid'";

				DATABASE::RUN_QUERY($up_user_info);
				DATABASE::RUN_QUERY($up_data);
				DATABASE::RUN_QUERY($up_contact);

				NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
				$dom = "id=".$cid."&response=success&msg=Customer ".$email_data->client." primary email updated successfully!&html=<hr>User <h4><strong>".$reg_data->name."</strong></h4> was created and credentials sent to: <p style='color:#ff0000; font-weight:bolder;'>".$email."</p>";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ".$from."?xyz=".$dirty_data);
				exit();
			}else{
				$dom = "id=".$cid."&response=error&msg=Failed to update ".$info['cname']."'s primary contact email&html=<hr/><br>REASON: ".$reg_user_request_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ".$from."?xyz=".$dirty_data);
				exit();
			}
		}
		static function REC_CLIENT($info){
			$cname = $info['cname'];
			$cdescription = $info['description'];
			$client_query = "INSERT INTO ncg_clients (CLIENT_NAME, DESCRIPTION, STATUS) VALUES ('$cname', '$cdescription', 'Active')";
			$client_rec_feedback = DATABASE::RUN_QUERY($client_query);
			if($client_rec_feedback['response'] == "success"){
				$client_id = $client_rec_feedback['query_id'];
				$contact_rec_feedback = NCG_FUNCT::REC_CONTACTS($info, $client_id);
				if($contact_rec_feedback['response'] == "success"){
					$address_rec_feedback = NCG_FUNCT::REC_ADDRESS($info, $client_id);
					if($address_rec_feedback['response'] == "success"){

						$addresses = array();
						$contacts = array();
						array_push($addresses, "ADDRESS TYPE: ".$info['address_type']);
						array_push($addresses, "CLIENT ADDRESS: ".$info['line_one'].", ".$info["line_two"].", ".$info['line_three'].", ".$info['line_four']);
						array_push($contacts, "CONTACT TYPE: ".$info['con_priority']." Contact");
						array_push($contacts, "CONTACT TITLE: ".$info['con_role']);
						array_push($contacts, "CONTACT: ".$info['con_title']." ".$info['con_name']);
						array_push($contacts, "CONTACT CELL: ".$info['con_cell']);
						array_push($contacts, "CONTACT EMAIL: ".$info['con_email']);
						array_push($contacts, "CONTACT STATUS: ".$info['con_status']);
						$mail_request = array("subject" =>"New Client", "msg" => $_SESSION['ncg-active']['NAME']." added a new client, ", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts);
						NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($mail_request);

						$mail_request_con_person = array("subject" =>"Client Registered", "msg" =>" has been registered with Inyatsi Construction ltd as a new Client. Thank you for choosing our services.", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts, "c_name" =>$info['con_title']." ".$info['con_name'], "c_email" =>$info['con_email']);
						
						$autoPass = NCG_FUNCT::GENERATE_PASS();
						$recovery_pass = NCG_FUNCT::NCG_CRYPT($autoPass);
						$pass = md5($autoPass);
						$role ="Customer";
						$status ="Active";
						$affiliation =$client_id;
						$registration_request = array("status" =>$status, "name" =>$info['con_name'], "email" =>$info['con_email'], "phone" =>$info['con_cell'], "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$autoPass);
						if($info['con_email'] == 0){
							$m_request_con_person = json_encode($mail_request_con_person);
							$reg_request = json_encode($registration_request);
							$save_query = "INSERT INTO  ncg_temp_user_data (REG_REQUEST, EMAIL_REQUEST, CLIENT_ID, REGISTERED) VALUES ('$reg_request', '$m_request_con_person', '$client_id', 0)";

							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$ui = $reg_user_request_response['query_id'];
								$ci = $contact_rec_feedback['query_id'];
								$con_update = "UPDATE ncg_contacts SET USER_ID = $ui WHERE REC_ID = $ci";
								DATABASE::RUN_QUERY($con_update);
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
								$sv_q = DATABASE::RUN_QUERY($save_query);
								$dom = "response=success&msg=Customer ".$info['cname']." added successfully!&html";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_customers.php?xyz=".$dirty_data);
								exit();
							}

						}else{
							NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, ROLE, STATUS, AFFILIATION) VALUES ('$email', '$pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$ui = $reg_user_request_response['query_id'];
								$ci = $contact_rec_feedback['query_id'];
								$con_update = "UPDATE ncg_contacts SET USER_ID = $ui WHERE REC_ID = $ci";
								DATABASE::RUN_QUERY($con_update);
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
								$dom = "response=success&msg=Customer ".$info['cname']." added successfully!&html=".$reg_res;
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_customers.php?xyz=".$dirty_data);
								exit();
							}
						}
					}else{

						$addresses = array();
						$contacts = array();
						array_push($addresses, "CLIENT ADDRESS WAS NOT RECORDED");
						array_push($contacts, "CONTACT TYPE: ".$info['con_priority']." Contact");
						array_push($contacts, "CONTACT TITLE: ".$info['con_role']);
						array_push($contacts, "CONTACT: ".$info['con_title']." ".$info['con_name']);
						array_push($contacts, "CONTACT CELL: ".$info['con_cell']);
						array_push($contacts, "CONTACT EMAIL: ".$info['con_email']);
						array_push($contacts, "CONTACT STATUS: ".$info['con_status']);
						$mail_request = array("subject" =>"New Client", "msg" => $_SESSION['ncg-active']['NAME']." added a new client, ", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts);
						NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($mail_request);


						$mail_request_con_person = array("subject" =>"Client Registered", "msg" =>" has been registered with Inyatsi Construction ltd as a new Client. Thank you for choosing our services.", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts, "c_name" =>$info['con_title']." ".$info['con_name'], "c_email" =>$info['con_email']);
							$autoPass = NCG_FUNCT::GENERATE_PASS();
							$recovery_pass = NCG_FUNCT::NCG_CRYPT($autoPass);
							$pass = md5($autoPass);
							$role ="Customer";
							$status ="Active";
							$affiliation =$client_id;
							$registration_request = array("status" =>$status, "name" =>$info['con_name'], "email" =>$info['con_email'], "phone" =>$info['con_cell'], "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$autoPass);
							if($info['con_email'] == 0){
								$m_request_con_person = json_encode($mail_request_con_person);
								$reg_request = json_encode($registration_request);
								$save_query = "INSERT INTO  ncg_temp_user_data (REG_REQUEST, EMAIL_REQUEST, CLIENT_ID, REGISTERED) VALUES ('$reg_request', '$m_request_con_person', '$client_id', 0)";
								$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

								$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
								if($reg_user_request_response['response'] == "success"){
									$ui = $reg_user_request_response['query_id'];
									$ci = $contact_rec_feedback['query_id'];
									$con_update = "UPDATE ncg_contacts SET USER_ID = $ui WHERE REC_ID = $ci";
									DATABASE::RUN_QUERY($con_update);
									$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
									$sv_q = DATABASE::RUN_QUERY($save_query);
									$dom = "response=success&msg=Customer ".$info['cname']." added successfully!&html";
									$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
									header("Location: ncg_customers.php?xyz=".$dirty_data);
									exit();
								}

							}else{
								NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
								$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, ROLE, STATUS, AFFILIATION) VALUES ('$email', '$pass', '$role', '$status', '$affiliation')";

								$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
								if($reg_user_request_response['response'] == "success"){
									$ui = $reg_user_request_response['query_id'];
									$ci = $contact_rec_feedback['query_id'];
									$con_update = "UPDATE ncg_contacts SET USER_ID = $ui WHERE REC_ID = $ci";
									DATABASE::RUN_QUERY($con_update);
									$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);

									$dom = "response=warning&msg=Customer ".$info['cname']." added successfully!&html=<hr/><br>Failed recording client address. REASON: ".$address_rec_feedback['message'].$reg_res;
									$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
									header("Location: ncg_customers.php?xyz=".$dirty_data);
									exit();
								}
							}
					}
				}else{
					$reg_res ="";
					$address_rec_feedback = NCG_FUNCT::REC_ADDRESS($info, $client_id);
					if($address_rec_feedback['response'] == "success"){
						$addresses = array();
						$contacts = array();
						array_push($addresses, "ADDRESS TYPE: ".$info['address_type']);
						array_push($addresses, "CLIENT ADDRESS: ".$info['line_one'].", ".$info["line_two"].", ".$info['line_three'].", ".$info['line_four']);
						array_push($contacts, "CLIENT CONTACT WAS NOT RECORDED");

						$mail_request_con_person = array("subject" =>"Client Registered", "msg" =>" has been registered with Inyatsi Construction ltd as a new Client. Thank you for choosing our services.", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts, "c_name" =>$info['con_title']." ".$info['con_name'], "c_email" =>$info['con_email']);

						$mail_request = array("subject" =>"New Client", "msg" => $_SESSION['ncg-active']['NAME']." added a new client, ", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts);

						$autoPass = NCG_FUNCT::GENERATE_PASS();
						$recovery_pass = NCG_FUNCT::NCG_CRYPT($autoPass);
						$pass = md5($autoPass);
						$role ="Customer";
						$status ="Active";
						$affiliation =$client_id;
						$registration_request = array("status" =>$status, "name" =>$info['con_name'], "email" =>$info['con_email'], "phone" =>$info['con_cell'], "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$autoPass);
						if($info['con_email'] == 0){
							$m_request_con_person = json_encode($mail_request_con_person);
							$reg_request = json_encode($registration_request);
							$save_query = "INSERT INTO  ncg_temp_user_data (REG_REQUEST, EMAIL_REQUEST, CLIENT_ID, REGISTERED) VALUES ('$reg_request', '$m_request_con_person', '$client_id', 0)";
							$sv_q = DATABASE::RUN_QUERY($save_query);
							$dom = "response=success&msg=Customer ".$info['cname']." added successfully!&html";
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_customers.php?xyz=".$dirty_data);
							exit();
						}else{
							NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
							}
						}

						NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($mail_request);
						$dom = "response=warning&msg=Customer ".$info['cname']." added successfully!&html=<hr/><br>Failed recording client contact. REASON: ".$contact_rec_feedback['message'].$reg_res;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_customers.php?xyz=".$dirty_data);
						exit();
					}else{
						$reg_res = "";
						$addresses = array();
						$contacts = array();
						array_push($addresses, "ADDRESS TYPE: ".$info['address_type']);
						array_push($addresses, "CLIENT ADDRESS: ".$info['line_one'].", ".$info["line_two"].", ".$info['line_three'].", ".$info['line_four']);
						array_push($contacts, "CLIENT CONTACT WAS NOT RECORDED");
						$mail_request = array("subject" =>"New Client", "msg" => $_SESSION['ncg-active']['NAME']." added a new client, ", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts);
						NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($mail_request);

						$mail_request_con_person = array("subject" =>"Client Registered", "msg" =>" has been registered with Inyatsi Construction ltd as a new Client. Thank you for choosing our services.", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts, "c_name" =>$info['con_title']." ".$info['con_name'], "c_email" =>$info['con_email']);
						$autoPass = NCG_FUNCT::GENERATE_PASS();
						$recovery_pass = NCG_FUNCT::NCG_CRYPT($autoPass);
						$pass = md5($autoPass);
						$role ="Customer";
						$status ="Active";
						$affiliation =$client_id;
						$registration_request = array("status" =>$status, "name" =>$info['con_name'], "email" =>$info['con_email'], "phone" =>$info['con_cell'], "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$autoPass);
						if($info['con_email'] == 0){
							$m_request_con_person = json_encode($mail_request_con_person);
							$reg_request = json_encode($registration_request);
							$save_query = "INSERT INTO  ncg_temp_user_data (REG_REQUEST, EMAIL_REQUEST, CLIENT_ID, REGISTERED) VALUES ('$reg_request', '$m_request_con_person', '$client_id', 0)";
							DATABASE::RUN_QUERY($save_query);
						}else{
							NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
							}
						}

						$dom = "response=warning&msg=Customer ".$info['cname']." added successfully!&html=<hr/><br>Failed recording client contact. REASON: ".$contact_rec_feedback['message'].$reg_res;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_customers.php?xyz=".$dirty_data);
						exit();
					}
						$reg_res = "";
						$addresses = array();
						$contacts = array();
						array_push($addresses, "ADDRESS TYPE: ".$info['address_type']);
						array_push($addresses, "CLIENT ADDRESS: ".$info['line_one'].", ".$info["line_two"].", ".$info['line_three'].", ".$info['line_four']);
						array_push($contacts, "CLIENT CONTACT WAS NOT RECORDED");
						$mail_request = array("subject" =>"New Client", "msg" => $_SESSION['ncg-active']['NAME']." added a new client, ", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts);
						NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($mail_request);


						$mail_request_con_person = array("subject" =>"Client Registered", "msg" =>" has been registered with Inyatsi Construction ltd as a new Client. Thank you for choosing our services.", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts, "c_name" =>$info['con_title']." ".$info['con_name'], "c_email" =>$info['con_email']);
						$autoPass = NCG_FUNCT::GENERATE_PASS();
						$recovery_pass = NCG_FUNCT::NCG_CRYPT($autoPass);
						$pass = md5($autoPass);
						$role ="Customer";
						$status ="Active";
						$affiliation =$client_id;
						$registration_request = array("status" =>$status, "name" =>$info['con_name'], "email" =>$info['con_email'], "phone" =>$info['con_cell'], "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$autoPass);
						if($info['con_email'] == 0){
							$m_request_con_person = json_encode($mail_request_con_person);
							$reg_request = json_encode($registration_request);
							$save_query = "INSERT INTO  ncg_temp_user_data (REG_REQUEST, EMAIL_REQUEST, CLIENT_ID, REGISTERED) VALUES ('$reg_request', '$m_request_con_person', '$client_id', 0)";
							DATABASE::RUN_QUERY($save_query);
						}else{
							NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
							}
						}

					$dom = "response=warning&msg=Customer ".$info['cname']." added successfully!&html=<hr/><br>Failed recording client contact. REASON: ".$contact_rec_feedback['message'].$reg_res;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_customers.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$dom = "response=error&msg=Failed recording client ".$info['cname']."&html=<hr/><br>REASON: ".$client_rec_feedback['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_customers.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function REC_CLIENT_SECONDARY($info){
			$cname = $info['cname'];
			$reg_res = "";
			$cdescription = $info['description'];
			$client_query = "INSERT INTO ncg_clients (CLIENT_NAME, DESCRIPTION, STATUS) VALUES ('$cname', '$cdescription', 'Active')";
			$client_rec_feedback = DATABASE::RUN_QUERY($client_query);
			if($client_rec_feedback['response'] == "success"){
				$client_id = $client_rec_feedback['query_id'];
				$contact_rec_feedback = NCG_FUNCT::REC_CONTACTS($info, $client_id);
				$address_rec_feedback = NCG_FUNCT::REC_ADDRESS($info, $client_id);
				$assign_request = array("pid" =>$info['pid'], "cid" =>$client_id);

						$addresses = array();
						$contacts = array();
						array_push($addresses, "ADDRESS TYPE: ".$info['address_type']);
						array_push($addresses, "CLIENT ADDRESS: ".$info['line_one'].", ".$info["line_two"].", ".$info['line_three'].", ".$info['line_four']);
						array_push($contacts, "CONTACT TYPE: ".$info['con_priority']." Contact");
						array_push($contacts, "CONTACT TITLE: ".$info['con_role']);
						array_push($contacts, "CONTACT: ".$info['con_title']." ".$info['con_name']);
						array_push($contacts, "CONTACT CELL: ".$info['con_cell']);
						array_push($contacts, "CONTACT EMAIL: ".$info['con_email']);
						array_push($contacts, "CONTACT STATUS: ".$info['con_status']);
						$mail_request = array("subject" =>"New Client", "msg" => $_SESSION['ncg-active']['NAME']." added a new client, ", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts);
						NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($mail_request);

						$mail_request_con_person = array("subject" =>"Client Registered", "msg" =>" has been registered with Inyatsi Construction ltd as a new Client. Thank you for choosing our services.", "client" =>$cname, "description" =>$info['description'], "addresses" =>$addresses, "contacts" =>$contacts, "c_name" =>$info['con_title']." ".$info['con_name'], "c_email" =>$info['con_email']);
						
						$autoPass = NCG_FUNCT::GENERATE_PASS();
						$recovery_pass = NCG_FUNCT::NCG_CRYPT($autoPass);
						$pass = md5($autoPass);
						$role ="Customer";
						$status ="Active";
						$affiliation =$client_id;
						$registration_request = array("status" =>$status, "name" =>$info['con_name'], "email" =>$info['con_email'], "phone" =>$info['con_cell'], "pass" =>$pass, "role" =>$role, "affiliation" =>$affiliation, "clean-pass" =>$autoPass);
						if($info['con_email'] == 0){
							$m_request_con_person = json_encode($mail_request_con_person);
							$reg_request = json_encode($registration_request);
							$save_query = "INSERT INTO  ncg_temp_user_data (REG_REQUEST, EMAIL_REQUEST, CLIENT_ID, REGISTERED) VALUES ('$reg_request', '$m_request_con_person', $client_id, 0)";
							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$ui = $reg_user_request_response['query_id'];
								$ci = $contact_rec_feedback['query_id'];
								$con_update = "UPDATE ncg_contacts SET USER_ID = $ui WHERE REC_ID = $ci";
								DATABASE::RUN_QUERY($con_update);
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
								DATABASE::RUN_QUERY($save_query);
								$dom = "response=success&msg=Customer ".$info['cname']." added successfully!&html";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_customers.php?xyz=".$dirty_data);
								exit();
							}

						}else{
							NCG_FUNCT::SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($mail_request_con_person);
							$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS, AFFILIATION) VALUES ('0', '$pass', '$recovery_pass', '$role', '$status', '$affiliation')";

							$reg_user_request_response = DATABASE::RUN_QUERY($reg_user_query);
							if($reg_user_request_response['response'] == "success"){
								$ui = $reg_user_request_response['query_id'];
								$ci = $contact_rec_feedback['query_id'];
								$con_update = "UPDATE ncg_contacts SET USER_ID = $ui WHERE REC_ID = $ci";
								DATABASE::RUN_QUERY($con_update);
								$reg_res = NCG_FUNCT::REG_EXTERNAL_USER_INFO_SEC($registration_request, $reg_user_request_response['query_id']);
							}
						}


				$project_info = NCG_FUNCT::GET_PROJECT_INFO($info['pid']);
				$response = NCG_FUNCT::ADD_PROJECT_OWNER($assign_request);
				if($response == "success"){
					header("Location: ncg_project_info.php?pid=".$info['pid']."&response=success&msg=Project ".$project_info['PROJECT_NAME']." assigned successfully to &html=<hr/><br>".$cname.$reg_res);
						exit();
				}else{
					$dom = "pid=".$info['pid']."&response=warning&msg=Failed to assign project ".$project_info['PROJECT_NAME']." to &html=<hr/><br>".$cname.$reg_res;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_project_info.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$dom = "pid=".$info['pid']."&response=error&msg=Failed Adding Project Owner ".$info['cname']."&html=<hr/><br>REASON: Failed recording client ".$reg_res;
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_project_info.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function GET_BROADCAST_FAQS(){
			$faqs_query = "SELECT * FROM ncg_faqs WHERE FAQ_STATUS ='answered'";
			$faq_response = DATABASE::RUN_QUERY($faqs_query);
			return $faq_response['data'];
		}
		static function GET_PENDING_FAQS(){
			$faqs_query = "SELECT * FROM ncg_faqs WHERE FAQ_STATUS ='asked'";
			$faq_response = DATABASE::RUN_QUERY($faqs_query);
			return $faq_response['data'];
		}
		static function UPDATE_PROJECT_NAME($info){
			$pid = $info['pid'];
			$pname = $info['pname'];
			$request_query = "UPDATE ncg_project_info SET PROJECT_NAME = '$pname' WHERE PROJECT_ID = $pid";
			$request_response = DATABASE::RUN_QUERY($request_query);

			if($request_response['response'] == "success"){
				return "success";
			}else{
				return $request_response['message'];
			}
		}
		static function UPDATE_PROJECT_STATUS($info){
			$pid = $info['pid'];
			$status = $info['status'];
			$request_query = "UPDATE ncg_projects SET STATUS = '$status' WHERE PROJECT_ID = $pid";
			$request_response = DATABASE::RUN_QUERY($request_query);

			if($request_response['response'] == "success"){
				return "success";
			}else{
				return $request_response['message'];
			}
		}
		static function CHECK_C_NAME($name){
			$check_query = "SELECT * FROM ncg_clients WHERE CLIENT_NAME LIKE '$name'";
			$res = DATABASE::RUN_QUERY($check_query);
			if(mysqli_num_rows($res['data']) > 0){
				return true;
			}else{
				return false;
			}
		}
		static function CHECK_P_NAME($name){
			$check_query = "SELECT * FROM ncg_project_info WHERE PROJECT_NAME LIKE '$name'";
			$res = DATABASE::RUN_QUERY($check_query);
			if(mysqli_num_rows($res['data']) > 0){
				return true;
			}else{
				return false;
			}
		}
		static function ADD_PROJECT_OWNER($info){
			$pid = $info['pid'];
			$cid = $info['cid'];
			$request_query = "UPDATE ncg_projects SET CUSTOMER_ID = $cid WHERE PROJECT_ID = $pid";
			$request_response = DATABASE::RUN_QUERY($request_query);

			if($request_response['response'] == "success"){
				return "success";
			}else{
				return $request_response['message'];
			}
		}
		static function ADD_TO_EXTERNAL_GROUP($gid, $cid){
			$add_to_group_query = "INSERT INTO ncg_security_external_members (USER_ID, GROUP_ID) VALUES ('$cid', '$gid')";
			DATABASE::RUN_QUERY($add_to_group_query);
		}
		static function REC_CONTACTS($info, $client_id){
			$con_priority = $info['con_priority'];
			$con_title = $info['con_title'];
			$con_initials = $info['con_initials'];
			$con_role = $info['con_role'];
			$con_tel = $info['con_tel'];
			$con_cell = $info['con_cell'];
			$con_email = $info['con_email'];
			$con_status = $info['con_status'];
			$con_name = $info['con_name'];
			$contact_query = "INSERT INTO ncg_contacts (JOB_ROLE, CONTACT_TITLE, CONTACT_INITIALS, CONTACT_FULL_NAME, CONTACT_TELL, CONTACT_CELL, CONTACT_EMAIL, STATUS, PRIORITY, CLIENT_ID) VALUES ('$con_role', '$con_title', '$con_initials', '$con_name', '$con_tel', '$con_cell', '$con_email', '$con_status','$con_priority', '$client_id')";
			return DATABASE::RUN_QUERY($contact_query);
		}
		static function UPDATE_CUSTOMER_DETAILS($info){
			$name = $info['new_name'];
			$old_name = $info['old_name'];
			$description = $info['description'];
			$cid = $info['cid'];
			$detail_update_query = "UPDATE ncg_clients SET CLIENT_NAME = '$name', DESCRIPTION = '$description' WHERE CUSTOMER_ID = '$cid'";
			$update_response = DATABASE::RUN_QUERY($detail_update_query);

			if($update_response['response'] == "success"){
				$dom = "response=success&id=".$cid."&msg=Customer details updated successfully!&html";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			header("Location: ncg_customers.php?xyz=".$dirty_data);
			exit();
			}else{
				$dom = "response=error&id=".$cid."&msg=Failed to update customer details!&html=<hr/><br><h4>REASON: </h4>".$update_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_customers.php?xyz=".$dirty_data);
					exit();
			}
		}
		static function UPDATE_CONTACTS($info){
			$cid = $info['cid'];
			$con_id = $info['con_id'];
			$con_title = $info['con_title'];
			$con_role = $info['con_role'];
			$con_initials = $info['con_initials'];
			$con_tel = $info['con_tel'];
			$con_cell = $info['con_cell'];
			$con_email = $info['con_email'];
			$con_status = $info['con_status'];
			$con_name = $info['con_name'];
			$contact_update_query = "UPDATE ncg_contacts SET JOB_ROLE = '$con_role', CONTACT_TITLE = '$con_title', CONTACT_INITIALS = '$con_initials', CONTACT_FULL_NAME = '$con_name', CONTACT_TELL = '$con_tel', CONTACT_CELL = '$con_cell', CONTACT_EMAIL = '$con_email', STATUS = '$con_status' WHERE CLIENT_ID LIKE '$cid' AND REC_ID LIKE '$con_id'";
			return DATABASE::RUN_QUERY($contact_update_query);
		}
		static function REC_ADDRESS($info, $client_id){
			$ad_type = $info['address_type'];
			$ad_line_one = $info['line_one'];
			$ad_line_two = $info['line_two'];
			$ad_line_three = $info['line_three'];
			$ad_line_four = $info['line_four'];
			$ad_status = $info['ad_status'];
			$ad_priority = $info['ad_priority'];

			$address_query = "INSERT INTO ncg_addresses (ADDRESS_TYPE, ADDRESS_LINE_ONE, ADDRESS_LINE_TWO, ADDRESS_LINE_THREE, ADDRESS_LINE_FOUR, STATUS, PRIORITY, CLIENT_ID) VALUES ('$ad_type', '$ad_line_one', '$ad_line_two', '$ad_line_three', '$ad_line_four', '$ad_status', '$ad_priority', '$client_id')";
			return DATABASE::RUN_QUERY($address_query);

		}
		static function UPDATE_ADDRESS($info){
			$cid = $info['cid'];
			$aid = $info['aid'];
			$ad_type = $info['address_type'];
			$ad_line_one = $info['line_one'];
			$ad_line_two = $info['line_two'];
			$ad_line_three = $info['line_three'];
			$ad_line_four = $info['line_four'];
			$ad_status = $info['ad_status'];

			$address_update_query = "UPDATE ncg_addresses SET ADDRESS_TYPE = '$ad_type' , ADDRESS_LINE_ONE = '$ad_line_one', ADDRESS_LINE_TWO = '$ad_line_two', ADDRESS_LINE_THREE = '$ad_line_three', ADDRESS_LINE_FOUR = '$ad_line_four', STATUS = '$ad_status' WHERE CLIENT_ID LIKE '$cid' AND REC_ID LIKE '$aid'";
			return DATABASE::RUN_QUERY($address_update_query);

		}
		static function REG_INTERNAL_USER_INFO($info, $user_id){
			$name = $info['name'];
			$phone = $info['phone'];
			$email = $info['email'];
			$reg_user_info_query = "INSERT INTO ncg_internal_users_info (USER_ID, NAME, W_PHONE, W_EMAIL) VALUES ('$user_id', '$name', '$phone', '$email')";
			$reg_user_info_response = DATABASE::RUN_QUERY($reg_user_info_query);
			if($reg_user_info_response['response'] == "success"){
				return true;
			}else{
				return false;
			}
		}
		static function REC_NEW_INTERNAL_MEMBERS($info){
			$members = $info['members'];
			$group_id = $info['grp-id'];
			$errors = array();
			$added = array();
			foreach ($members as $member) {
				$rec_member_query = "INSERT INTO ncg_security_internal_members (USER_ID, GROUP_ID) VALUES ('$member', '$group_id')";
				$response = DATABASE::RUN_QUERY($rec_member_query);
				if($response['response'] == "failed"){
					array_push($errors, $member);
				}else{
					array_push($added, $member);

					$notification = $_SESSION['ncg-active']['NAME']." added you to the group ".NCG_FUNCT::GET_SECURITY_GROUP_NAME($group_id);
					NCG_FUNCT::SEND_SINGLE_USER_NOTIFICATION($notification, $member, "success");
				}
			}
			if(sizeof($errors) > 0){
				$failed = "";
					$num = 1;
					foreach ($errors as $fails) {
						if(empty($failed)){
							$failed = $failed.NCG_FUNCT::GET_FACILITATOR_NAME($fails);
						}else{
							$failed = $failed."<br>".NCG_FUNCT::GET_FACILITATOR_NAME($fails);
						}
						$num++;
					}
				if(sizeof($errors) == sizeof($members)){
					$dom = "response=error&msg=Failed to add ".sizeof($errors)." out of ".sizeof($members)." members&html=<br><hr/></strong><br><p>".$failed."<hr/><br>".$response['message']."</p>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
				}else{
					$dom = "response=warning&msg=Failed to add ".sizeof($errors)." out of ".sizeof($members)." members&html=<br><hr/><p>".$failed."<hr/><br>".$response['message']."</p>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
				}
			}if(sizeof($errors) == 0){
				$adds = "";
					$count = 1;
					foreach ($added as $good) {
						if($count < 3){
							$extra_pre = "";
							$extra_post = "";
						if(empty($adds)){
							$adds = $adds.NCG_FUNCT::GET_FACILITATOR_NAME($good);
						}else{
							$adds = $adds."<br>".NCG_FUNCT::GET_FACILITATOR_NAME($good);
						}
					}else{
						$extra_pre = "plus";
						$extra_post = "More";
					}
						$count++;
					}
					$extra = sizeof($added) - 2;
					if($extra <= 0){
						$extra = "";
					}
					$dom = "response=success&msg=Group members added successfully!&html=<br><hr/><h4>".$adds."</h4><br><center>".$extra_pre." ".$extra." ".$extra_post."</center>";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function REC_NEW_EXTERNAL_MEMBERS($info){
			$members = $info['members'];
			$group_id = $info['grp-id'];
			$errors = array();
			$added = array();
			foreach ($members as $member) {
				$rec_member_query = "INSERT INTO ncg_security_external_members (USER_ID, GROUP_ID) VALUES ('$member', '$group_id')";
				$response = DATABASE::RUN_QUERY($rec_member_query);
				if($response['response'] == "failed"){
					array_push($errors, $member);
				}else{
					array_push($added, $member);
				}
			}
			if(sizeof($errors) > 0){
				$failed = "";
					$num = 1;
					foreach ($errors as $fails) {
						if(empty($failed)){
							$failed = $failed.NCG_FUNCT::GET_FACILITATOR_NAME($fails);
						}else{
							$failed = $failed."<br>".NCG_FUNCT::GET_FACILITATOR_NAME($fails);
						}
						$num++;
					}
				if(sizeof($errors) == sizeof($members)){
					$dom = "response=error&msg=Failed to add ".sizeof($errors)." out of ".sizeof($members)." members&html=<br><hr/></strong><br><p>".$failed."<hr/><br>".$response['message']."</p>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
				}else{
					$dom = "response=warning&msg=Failed to add ".sizeof($errors)." out of ".sizeof($members)." members&html=<br><hr/><p>".$failed."<hr/><br>".$response['message']."</p>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
				}
			}if(sizeof($errors) == 0){
				$adds = "";
					$count = 1;
					foreach ($added as $good) {
						if($count < 3){
							$extra_pre = "";
							$extra_post = "";
						if(empty($adds)){
							$adds = $adds.NCG_FUNCT::GET_FACILITATOR_NAME($good);
						}else{
							$adds = $adds."<br>".NCG_FUNCT::GET_FACILITATOR_NAME($good);
						}
					}else{
						$extra_pre = "plus";
						$extra_post = "More";
					}
						$count++;
					}
					$extra = sizeof($added) - 2;
					if($extra <= 0){
						$extra = "";
					}
					$dom = "response=success&msg=Group members added successfully!&html=<br><hr/><h4>".$adds."</h4><br><center>".$extra_pre." ".$extra." ".$extra_post."</center>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
				exit();
			}
		}
		/*############################### FILE static functionS ##########################*/

		static function MOVE_IMG($IMG_DATA){
			if(move_uploaded_file($IMG_DATA['IMG_TEMP'], "../".$IMG_DATA['UP_PHOTO'])){
					return true;
				}else{
					return false;
				}
		}
		/*############################### END FILE static functionS ##########################*/
		static function UPDATE_INTERNAL_PROFESSIONAL_USER_INFO($info){
			$department = $info['department'];
			$extension = $info['extension'];
			$phone = $info['phone'];
			$email = $info['email'];
			$uid = $_SESSION['ncg-active']['UID'];
			$update_user_professional_info_query = "UPDATE ncg_internal_users_info SET DEPARTMENT = '$department', W_PHONE = '$phone', W_EMAIL = '$email', EXTERNSION = '$extension' WHERE USER_ID LIKE '$uid'";
			$update_user_professional_info_response = DATABASE::RUN_QUERY($update_user_professional_info_query);
			if($update_user_professional_info_response['response'] == "success"){
				$dom = "response=success&msg=User information updated successfully!";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_user_edit.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed to update user information!<br>".$update_user_professional_info_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_user_edit.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function GET_CUSTOMER_LOGO($id){
			$image_query = "SELECT * FROM ncg_client_logos WHERE COMPANY_ID LIKE '$id'";
			$response = DATABASE::RUN_QUERY($image_query);
			if($response['response'] == "success"){
				$img_data = mysqli_fetch_assoc($response['data']);
				return $img_data['LOGO'];
			}else{
				return $response['message'];
			}
		}
		static function UPDATE_CUSTOMER_IMAGE($info){
			$image = $info['UP_PHOTO'];
			$company_id = $info['cid'];
			if(NCG_FUNCT::CHECK_CUSTOMER_IMAGE($company_id)){
				$image_query = "UPDATE ncg_client_logos SET LOGO = '$image' WHERE COMPANY_ID LIKE '$company_id'";
			}else{
				$image_query = "INSERT INTO ncg_client_logos (COMPANY_ID, LOGO) VALUES ('$company_id', '$image')";
			}

			$image_response = DATABASE::RUN_QUERY($image_query);
			if($image_response['response'] == "success"){
				if(NCG_FUNCT::MOVE_IMG($info)){
						$dom = "response=success&id=".$company_id."&msg=User logo updated successfully!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ../ncg_customer_info.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=error&id=".$company_id."&msg=Failed to update custmer logo!<br>".$image_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ../ncg_customer_info.php?xyz=".$dirty_data);
						exit();
					}
				
			}else{
				$dom = "response=error&id=".$company_id."&msg=Failed to update custmer logo!<br>".$image_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ../ncg_customer_info.php?xyz=".$dirty_data);
				exit();
			}

		}
		static function CHECK_CUSTOMER_IMAGE($id){
			$image_query = "SELECT * FROM ncg_client_logos WHERE COMPANY_ID LIKE '$id'";
			$response = DATABASE::RUN_QUERY($image_query);
			if(mysqli_num_rows($response['data']) > 0){
				return true;
			}else{
				return false;
			}
			
		}
		static function UPDATE_INTERNAL_PERSONAL_USER_INFO($info){
			$UID = $_SESSION['ncg-active']['UID'];
			$name = $info['name'];
			$phone = $info['phone'];
			$email = $info['email'];
			$image = $info['UP_PHOTO'];

				$image_parts = explode(".", $image);
				$required = array("png","jpg", "jpeg");
				if(sizeof($image_parts) <= 1 || !in_array(end($image_parts), $required)){
					$update_user_personal_info_query = "UPDATE ncg_internal_users_info SET NAME = '$name', P_PHONE = '$phone', P_EMAIL = '$email' WHERE USER_ID LIKE '$UID'";
				}else{
					$update_user_personal_info_query = "UPDATE ncg_internal_users_info SET NAME = '$name', P_PHONE = '$phone', P_EMAIL = '$email', IMAGE = '$image' WHERE USER_ID LIKE '$UID'";
				}
			
			$update_user_personal_info_response = DATABASE::RUN_QUERY($update_user_personal_info_query);
			if($update_user_personal_info_response['response'] == "success"){
				if(sizeof($image_parts) <= 1 || !in_array(end($image_parts), $required)){
					$dom = "response=success&msg=User information updated successfully!";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ../ncg_user_edit.php?xyz=".$dirty_data);
					exit();
				}else{
					if(NCG_FUNCT::MOVE_IMG($info)){
						$dom = "response=success&msg=User information updated successfully!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ../ncg_user_edit.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=error&msg=Failed to upload user image!";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ../ncg_user_edit.php?xyz=".$dirty_data);
							exit();
					}
				}
			}else{
				$dom = "response=error&msg=Failed to update user information!<br>".$update_user_personal_info_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ../ncg_user_edit.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function GET_EXTERNAL_USER_AFFILIATION($ID){
			$user_affiliation_request_query = "SELECT * FROM ncg_clients WHERE CUSTOMER_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($user_affiliation_request_query);
			if($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) > 0){

				$affiliation =  mysqli_fetch_assoc($request_response['data']);
				return $affiliation['CLIENT_NAME'];	
				}else{
					return "No client by the id ".$ID;
				}
			}else{
				return "Couldn't get client name.".$request_response['message'];
			}
		}
		static function GET_AFFILIATION($user_id){
			$affiliate_id_request_query = "SELECT * FROM ncg_users WHERE REC_ID LIKE '$user_id'";
			$request_response = DATABASE::RUN_QUERY($affiliate_id_request_query);
			if($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) > 0){
					$user_data = mysqli_fetch_assoc($request_response['data']);
					return NCG_FUNCT::GET_EXTERNAL_USER_AFFILIATION($user_data['AFFILIATION']);
				}else{
					return "No client by the id ".$user_id;
				}
			}else{
				return "Couldn't get affiliation ID. ".$request_response['message'];
			}
		}
		static function GET_AFFILIATION_ID($user_id){
			$affiliate_id_request_query = "SELECT * FROM ncg_users WHERE REC_ID LIKE '$user_id'";
			$request_response = DATABASE::RUN_QUERY($affiliate_id_request_query);
			$user_data = mysqli_fetch_assoc($request_response['data']);
			return $user_data['AFFILIATION'];
		}
		static function GET_EXTERNAL_USER_INFO($ID){
			$user_info_request_query = "SELECT * FROM ncg_external_users_info WHERE USER_ID = $ID";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return mysqli_fetch_assoc($request_response['data']);
			}
		}
		static function GET_EXTERNAL_USER_INFO_GROUPS($ID){
			$user_info_request_query = "SELECT * FROM ncg_external_users_info WHERE USER_ID = $ID";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_USER_INFO($ID){
			$user_info_request_query = "SELECT * FROM ncg_internal_users_info WHERE USER_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return mysqli_fetch_assoc($request_response['data']);
			}
		}
		static function GET_USER_BY_EMAIL($email){
			$query  =  "SELECT * FROM ncg_users WHERE USER_ID LIKE '$email'";
			$res = DATABASE::RUN_QUERY($query);
			return mysqli_fetch_assoc($res['data']);
		}
		static function GET_USER($ID){
			$query  =  "SELECT * FROM ncg_users WHERE REC_ID = $ID";
			$res = DATABASE::RUN_QUERY($query);
			return mysqli_fetch_assoc($res['data']);
		}
		static function GET_ALL_EXTERNAL_USER_INFO(){
			$user_info_request_query = "SELECT * FROM ncg_external_users_info";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_EXTERNAL_USER_GROUP($ID){
			$user_group_query = "SELECT * FROM 	ncg_security_external_members WHERE USER_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($user_group_query);
			if($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) > 0){
					$g_data =  mysqli_fetch_assoc($request_response['data']);
					return NCG_FUNCT::GET_EXTERNAL_GROUP_NAME($g_data['GROUP_ID']);
				}else{
					return "Not in a group";
				}
			}
		}
		static function GET_ALL_USER_INFO(){
			$user_info_request_query = "SELECT * FROM ncg_internal_users_info";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_GROUP_MEMBERS_INFO($ID){
			$user_info_request_query = "SELECT * FROM ncg_internal_users_info WHERE USER_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_GROUP_MEMBER_INFO($ID){
			$user_info_request_query = "SELECT * FROM ncg_security_internal_members WHERE GROUP_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_EXTERNAL_GROUP_MEMBER_INFO($ID){
			$user_info_request_query = "SELECT * FROM ncg_security_external_members WHERE GROUP_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($user_info_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_SECURITY_GROUPS($domain){
			$security_group_request_query = "SELECT * FROM ncg_security_groups WHERE DOMAIN LIKE '$domain'";
			$request_response = DATABASE::RUN_QUERY($security_group_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function GET_SECURITY_GROUP_NAME($ID){
			$security_group_request_query = "SELECT * FROM ncg_security_groups WHERE REC_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($security_group_request_query);
			if($request_response['response'] == "success"){
				$group_data = mysqli_fetch_assoc($request_response['data']);
				return $group_data['GRP_NAME'];
			}
		}
		static function GET_FACILITATOR_NAME($ID){
			$facilitator_name_request_query = "SELECT * FROM ncg_internal_users_info WHERE USER_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($facilitator_name_request_query);
			if($request_response['response'] == "success"){
				$data = mysqli_fetch_assoc($request_response['data']);
				return $data['NAME'];
			}
		}
		static function GET_EXTERNAL_USER_NAME($ID){
			$facilitator_name_request_query = "SELECT * FROM ncg_external_users_info WHERE USER_ID LIKE '$ID'";
			$request_response = DATABASE::RUN_QUERY($facilitator_name_request_query);
			if($request_response['response'] == "success"){
				$data = mysqli_fetch_assoc($request_response['data']);
				return $data['USER_NAME'];
			}
		}
		static function GET_GROUP_MEMBERS($ID, $domain){
			switch($domain){
				case "Internal":
				default:
					$group_members_request_query = "SELECT * FROM ncg_security_internal_members WHERE GROUP_ID LIKE '$ID'";
				break;
				case "External":
					$group_members_request_query = "SELECT * FROM ncg_security_external_members WHERE GROUP_ID LIKE '$ID'";
				break;
			}
			
			$request_response = DATABASE::RUN_QUERY($group_members_request_query);
			if($request_response['response'] == "success"){
				return $request_response['data'];
			}
		}
		static function COUNT_GROUP_MEMBERS($ID, $domain){
			switch($domain){
				case "Internal":
				default:
					$group_members_count_request_query = "SELECT * FROM ncg_security_internal_members WHERE GROUP_ID LIKE '$ID'";
				break;
				case "External":
					$group_members_count_request_query = "SELECT * FROM ncg_security_external_members WHERE GROUP_ID LIKE '$ID'";
				break;
			}
			
			$request_response = DATABASE::RUN_QUERY($group_members_count_request_query);
			if($request_response['response'] == "success"){
				return mysqli_num_rows($request_response['data']);
			}
		}
		static function COUNT_INTERNAL_USERS(){
			$users_count_request_query = "SELECT * FROM ncg_internal_users_info";
			$request_response = DATABASE::RUN_QUERY($users_count_request_query);
			if($request_response['response'] == "success"){
				return mysqli_num_rows($request_response['data']);
			}
		}
		static function COUNT_EXTERNAL_USERS(){
			$users_count_request_query = "SELECT * FROM ncg_external_users_info";
			$request_response = DATABASE::RUN_QUERY($users_count_request_query);
			if($request_response['response'] == "success"){
				return mysqli_num_rows($request_response['data']);
			}
		}
		static function CREATE_SECURITY_GROUP($group_info){
			$name = $group_info['name'];
			$permissions = $group_info['permissions'];
			$domain = $group_info['domain'];
			$status = $group_info['status'];
			if($domain == "External"){
				$external_group_exist = NCG_FUNCT::CHECK_EXTERNAL_GROUP_EXISTANCE();
			}else{
				$external_group_exist = false;
			}
			$group_name_conflict = NCG_FUNCT::CHECK_GROUP_NAME_CONFLICTS($name, false);
			$name = $group_name_conflict['name'];
			if(!$external_group_exist){

			  $new_sec_group_query = "INSERT INTO ncg_security_groups (GRP_NAME, PERMISSIONS, DOMAIN, STATUS) VALUES('$name', '$permissions', '$domain', '$status')";
			  $new_sec_group_response = DATABASE::RUN_QUERY($new_sec_group_query);
			  if($new_sec_group_response['response'] == "success"){
			    
    			if($group_name_conflict['renamed']){
    				$dom = "response=warning&msg=".$group_info['name']." name taken!&html=<br><hr/><p>Group created and renamed</p><hr/><h6>NEW GROUP NAME</h6><h4>".$group_name_conflict['name']."</h4><br><hr/><h6>PERMISSIONS</h6><h4>".$permissions."</h4><hr/>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
    				 header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
    			          exit();
    			}else{
    				$dom = "response=success&msg=Security group created successfully!&html=<br><hr/><h4>GROUP NAME</h4><br>".$name."<br><h4>PERMISSIONS</h4><br>".$permissions;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
    				 header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
              			exit();
    			}
			  }else{
			  	$dom = "response=error&msg=Failed to create security group!&html=".$new_sec_group_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			    header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
			    exit();
			  }
			}else{
				$dom = "response=error&msg=Failed to create security group!&html=<br><hr/>".$external_group_exist;
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
			  header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
			    exit();
			}
		}
		static function GET_CUSTOMER_PRIMARY_CONTACT($id){
			$primary_contact_request_query = "SELECT * FROM ncg_contacts WHERE PRIORITY LIKE 'Primary' AND CLIENT_ID LIKE '$id'";
			$primary_contact_request_response = DATABASE::RUN_QUERY($primary_contact_request_query);
			if($primary_contact_request_response['response'] == "success"){
				return $primary_contact_request_response['data'];
			}else{
				return $primary_contact_request_response['message'];
			}
		}
		static function GET_CUSTOMER_PRIMARY_ADDRESS($id){
			$primary_address_request_query = "SELECT * FROM ncg_addresses WHERE PRIORITY LIKE 'Primary' AND CLIENT_ID LIKE '$id'";
			$primary_address_request_response = DATABASE::RUN_QUERY($primary_address_request_query);
			if($primary_address_request_response['response'] == "success"){
				return $primary_address_request_response['data'];
			}else{
				return $primary_address_request_response['message'];
			}
		}
		static function CHECK_GROUP_NAME_CONFLICTS($name, $renamed){
		    $rename = "";
		    $check_query = "SELECT GRP_NAME FROM ncg_security_groups WHERE GRP_NAME LIKE '$name'";
			$check_response = DATABASE::RUN_QUERY($check_query);
		    if($check_response['response'] == "success"){
		      if(mysqli_num_rows($check_response['data']) > 0){
		        $name_parts = explode(" ", $name);
		        if(number_format(end($name_parts))){
		          $_append_ = end($name_parts)+1;
		          for($x = 0; $x < sizeof($name_parts)-1; $x++){
		            if($rename == ""){
		              $rename = $name_parts[$x];
		            }else{
		              $rename = $rename." ".$name_parts[$x];
		            }
		          }

		          $name = $rename." ".$_append_;
		          $renamed = true;
		         return NCG_FUNCT::CHECK_GROUP_NAME_CONFLICTS($name, $renamed);
		        }else{
		          $name = $name." 1";
		          $renamed = true;
		         return NCG_FUNCT::CHECK_GROUP_NAME_CONFLICTS($name, $renamed);
		        
		        }
		      }else{
		        return array("renamed" =>$renamed, "name" =>$name);
		      }
		    }else{
		      return array("renamed" =>$renamed, "name" =>$name);
		    }
		  }
		static function GET_EXTERNAL_GROUP(){
			$check_query = "SELECT * FROM ncg_security_groups WHERE DOMAIN LIKE 'External' LIMIT 1";
			$check_response = DATABASE::RUN_QUERY($check_query);
			if($check_response['response'] == "success"){
				return mysqli_fetch_assoc($check_response['data']);
			}
		}
		static function GET_EXTERNAL_GROUP_NAME($ID){
			$check_query = "SELECT * FROM ncg_security_groups WHERE REC_ID LIKE '$ID'";
			$check_response = DATABASE::RUN_QUERY($check_query);
			if($check_response['response'] == "success"){
				$g_data = mysqli_fetch_assoc($check_response['data']);
				return $g_data['GRP_NAME'];
			}else{
				return "Not in group";
			}
		}
		static function CHECK_EXTERNAL_GROUP_EXISTANCE(){
			$check_query = "SELECT * FROM ncg_security_groups WHERE DOMAIN LIKE 'External'";
			$check_response = DATABASE::RUN_QUERY($check_query);
			if($check_response['response'] == "success"){
				if(mysqli_num_rows($check_response['data']) > 0 ){
					return "An external group already exist.";
				}else{
					return false;
				}
			}else{
				return "An error occured while creating group.";
			}
		}
		static function MODIFY_GROUP_PERMISSIONS($group_info){
			$name = $group_info['name'];
			$permissions = $group_info['permissions'];
			$gid = $group_info['gid'];
			$modify_group_permissions_query = "UPDATE ncg_security_groups SET PERMISSIONS = '$permissions' WHERE REC_ID LIKE '$gid'";
			$modify_group_permissions_response = DATABASE::RUN_QUERY($modify_group_permissions_query);

			if($modify_group_permissions_response['response'] == "success"){
				$dom = "response=success&msg=".$name." permissions modified successfully!&html=<br><hr/><center><h4>New Permissions</h4></center><br><strong><center><h4>".$permissions."</h4></center><strong>";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed to modify ".$name." permissions!&html=<br><hr/>".$modify_group_permissions_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
			}

		}
		static function PROMOTE_EXT_GROUP_MEMBER($info){
			$uid = $info['uid'];
			$gid = $info['gid'];
			$current = $info['current'];
			if($current != $uid){
				$promote_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
				$promote_member_group_response = DATABASE::RUN_QUERY($promote_member_group_query);
				if($promote_member_group_response['response'] == "success"){
					$dom = "response=success&msg=Group member promoted!&html=";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=warning&msg=Failed to promote member!&html=<br>".$member_update_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$dom = "response=info&msg=Memeber is already promoted!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
			}
		}
		static function SEND_SINGLE_USER_NOTIFICATION($message, $uid, $type){
			$notifications_query = "INSERT INTO ncg_user_notification (UID, MESSAGE, TYPE) VALUES ('$uid', '$message', '$type')";
			DATABASE::RUN_QUERY($notifications_query);
		}
		static function PROMOTE_GROUP_MEMBER($info){
			$uid = $info['uid'];
			$gid = $info['gid'];
			$current = $info['current'];
			if($current != $uid){
				$promote_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
				$promote_member_group_response = DATABASE::RUN_QUERY($promote_member_group_query);
				if($promote_member_group_response['response'] == "success"){
					$member_update_query = "UPDATE ncg_security_internal_members SET ROLE = 'Facilitator' WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
					$member_update_response = DATABASE::RUN_QUERY($member_update_query);
					if($member_update_response['response'] == "success"){
					$notification = $_SESSION['ncg-active']['NAME']." made you a facilitator to group ".NCG_FUNCT::GET_SECURITY_GROUP_NAME($gid);
					NCG_FUNCT::SEND_SINGLE_USER_NOTIFICATION($notification, $uid, "success");

					$notification = "You were demoted from facilitating ".NCG_FUNCT::GET_SECURITY_GROUP_NAME($gid);
					NCG_FUNCT::SEND_SINGLE_USER_NOTIFICATION($notification, $current, "error");

						$dom = "response=success&msg=Group member promoted!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$restore_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = NULL WHERE REC_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_group_query);
						$restore_member_update_query = "UPDATE ncg_security_internal_members SET ROLE = 'Member' WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_update_query);
						$dom = "response=error&msg=Failed to promote member!&html=<br>".$member_update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$dom = "response=warning&msg=Failed to promote member!&html=<br>".$member_update_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$dom = "response=info&msg=Memeber is already promoted!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
			}
		}
		static function REMOVE_EXT_GROUP_MEMBER($info){
			$uid = $info['uid'];
			$gid = $info['gid'];
			$current = $info['current'];
			if($current == $uid){
				$demote_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = NULL WHERE REC_ID LIKE '$gid'";
				$demote_member_group_response = DATABASE::RUN_QUERY($demote_member_group_query);
				if($demote_member_group_response['response'] == "success"){
					$member_remove_query = "DELETE FROM ncg_security_external_members WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
					$member_remove_response = DATABASE::RUN_QUERY($member_remove_query);
					if($member_remove_response['response'] == "success"){
						$dom = "response=success&msg=Group member removed!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);	
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$restore_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_group_query);

						$restore_member_update_query = "INSERT INTO ncg_security_external_members (USER_ID, GROUP_ID) VALUES ('$uid', '$gid')";
						DATABASE::RUN_QUERY($restore_member_update_query);
						$dom = "response=error&msg=Failed to remove member!&html=<br>".$member_remove_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$dom = "response=warning&msg=Failed to remove member!&html=<br>".$member_remove_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$member_remove_query = "DELETE FROM ncg_security_external_members WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
					$member_remove_response = DATABASE::RUN_QUERY($member_remove_query);
					if($member_remove_response['response'] == "success"){
						$dom = "response=success&msg=Group member removed!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$restore_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_group_query);

						$restore_member_update_query = "INSERT INTO ncg_security_external_members (USER_ID, GROUP_ID) VALUES ('$uid', '$gid')";
						DATABASE::RUN_QUERY($restore_member_update_query);
						$dom = "response=error&msg=Failed to remove member!&html=<br>".$member_remove_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
			}
		}
		static function REMOVE_GROUP_MEMBER($info){
			$uid = $info['uid'];
			$gid = $info['gid'];
			$current = $info['current'];
			if($current == $uid){
				$demote_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = NULL WHERE REC_ID LIKE '$gid'";
				$demote_member_group_response = DATABASE::RUN_QUERY($demote_member_group_query);
				if($demote_member_group_response['response'] == "success"){
					$member_remove_query = "DELETE FROM ncg_security_internal_members WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
					$member_remove_response = DATABASE::RUN_QUERY($member_remove_query);
					if($member_remove_response['response'] == "success"){

						$notification = "You were removed from the group ".NCG_FUNCT::GET_SECURITY_GROUP_NAME($gid);
						NCG_FUNCT::SEND_SINGLE_USER_NOTIFICATION($notification, $uid, "error");
						$dom = "response=success&msg=Group member removed!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$restore_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_group_query);

						$restore_member_update_query = "INSERT INTO ncg_security_internal_members (USER_ID, GROUP_ID, ROLE) VALUES ('$uid', '$gid', 'Facilitator')";
						DATABASE::RUN_QUERY($restore_member_update_query);
						$dom = "response=error&msg=Failed to remove member!&html=<br>".$member_remove_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$dom = "response=warning&msg=Failed to remove member!&html=<br>".$member_remove_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$member_remove_query = "DELETE FROM ncg_security_internal_members WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
					$member_remove_response = DATABASE::RUN_QUERY($member_remove_query);
					if($member_remove_response['response'] == "success"){
						$notification = "You were removed from the group ".NCG_FUNCT::GET_SECURITY_GROUP_NAME($gid);
						NCG_FUNCT::SEND_SINGLE_USER_NOTIFICATION($notification, $uid, "error");
						$dom = "response=success&msg=Group member removed!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$restore_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_group_query);

						$restore_member_update_query = "INSERT INTO ncg_security_internal_members (USER_ID, GROUP_ID, ROLE) VALUES ('$uid', '$gid', 'Facilitator')";
						DATABASE::RUN_QUERY($restore_member_update_query);
						$dom = "response=error&msg=Failed to remove member!&html=<br>".$member_remove_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
			}
		}
		static function ACTIVATE_DEACTIVATE_SECURITY_GROUP($info){
			$command = $info['command'];
			$gid = $info['gid'];
			if($command == "activate"){
				$command_positive_msg = "activated";
				$command_negetive_msg = "activate";
				$activate_deativate_query = "UPDATE ncg_security_groups SET STATUS = 'Active' WHERE REC_ID LIKE '$gid'";
			}else{
				$command_positive_msg = "deactivated";
				$command_negetive_msg = "deactivate";
				$activate_deativate_query = "UPDATE ncg_security_groups SET STATUS = 'Inactive' WHERE REC_ID LIKE '$gid'";
			}
			
			$activate_deativate_response = DATABASE::RUN_QUERY($activate_deativate_query);
			if($activate_deativate_response['response'] == "success"){
				$dom = "response=success&msg=".$info['name']." ".$command_positive_msg." successfully!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
			}else{
				$dom = "response=error&msg=Failed to ".$command_negetive_msg." ".$info['name']."!&html=<br>".$activate_deativate_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
			}
		}
		static function RENAME_SECURITY_GROUP($info){
			$new_name = $info['new-name'];
			$gid = $info['gid'];


			$group_name_conflict = NCG_FUNCT::CHECK_GROUP_NAME_CONFLICTS($new_name, false);
			$new_name = $group_name_conflict['name'];

			if($info['new-name'] == $info['name']){
				$dom = "response=warning&msg=New and Old group names are the same!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
			}else{
				$rename_group_query = "UPDATE ncg_security_groups SET GRP_NAME = '$new_name' WHERE REC_ID LIKE '$gid'";
			}

			$rename_group_response = DATABASE::RUN_QUERY($rename_group_query);

			if($rename_group_response['response'] == "success"){

				if($group_name_conflict['renamed']){
					$dom = "response=warning&msg=".$info['new-name']." name taken!&html=<br><hr/><p>".$info['name']." renamed to</p><hr/><h4>NEW GROUP NAME</h4>".$group_name_conflict['name']."<br><hr/>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				 header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
    			          exit();
				}else{
					$dom = "response=success&msg=".$info['name']." renamed to&html=<br><h4><strong>".$new_name."</strong></h4>";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
				}
				
			}else{
				$dom = "response=error&msg=Failed to rename ".$info['name']." to !&html=<br><h4><strong>".$new_name."</strong></h4><hr/>".$rename_group_response['message'];
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
					exit();
			}
		}

		static function GET_USER_NOTIFICATIONS($UID){
			$count_query =  "SELECT * FROM ncg_user_notification WHERE UID = '$UID' AND STATUS = 0";
			$response = DATABASE::RUN_QUERY($count_query);
			if($response['response'] == "success"){
				return $response['data'];
			}
		}
		static function COUNT_USER_NOTIFICATIONS($UID){
			$count_query =  "SELECT * FROM ncg_user_notification WHERE UID = '$UID' AND STATUS = 0";
			$response = DATABASE::RUN_QUERY($count_query);
			if($response['response'] == "success"){
				return mysqli_num_rows($response['data']);
			}else{
				return 0;
			}
		}
		static function DEMOTE_EXT_GROUP_MEMBER($info){
			$uid = $info['uid'];
			$gid = $info['gid'];
			$current = $info['current'];
			if($current == $uid){
				$demote_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = NULL WHERE REC_ID LIKE '$gid'";
				$demote_member_group_response = DATABASE::RUN_QUERY($demote_member_group_query);
				if($demote_member_group_response['response'] == "success"){
					$dom = "response=success&msg=Group member demoted!&html=";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}else{
					$dom = "response=warning&msg=Failed to demote member!&html=<br>".$member_update_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$dom = "response=info&msg=Memeber is already demoted!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
			}
		}
		static function CLEAR_ALL_NOTIFICATION($ID){
			$notification_query = "UPDATE ncg_user_notification SET STATUS = 1 WHERE UID = $ID";
			DATABASE::RUN_QUERY($notification_query);
		}
		static function CLEAR_NOTIFICATION($ID){
			$notification_query = "UPDATE ncg_user_notification SET STATUS = 1 WHERE NOTIFICATION_ID = $ID";
			DATABASE::RUN_QUERY($notification_query);
		}
		static function DEMOTE_GROUP_MEMBER($info){
			$uid = $info['uid'];
			$gid = $info['gid'];
			$current = $info['current'];
			if($current == $uid){
				$demote_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = NULL WHERE REC_ID LIKE '$gid'";
				$demote_member_group_response = DATABASE::RUN_QUERY($demote_member_group_query);
				if($demote_member_group_response['response'] == "success"){
					$member_update_query = "UPDATE ncg_security_internal_members SET ROLE = 'Member' WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
					$member_update_response = DATABASE::RUN_QUERY($member_update_query);
					if($member_update_response['response'] == "success"){

					$notification = "You were demoted from facilitating ".NCG_FUNCT::GET_SECURITY_GROUP_NAME($gid);
					NCG_FUNCT::SEND_SINGLE_USER_NOTIFICATION($notification, $uid, "error");
						$dom = "response=success&msg=Group member demoted!&html=";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$restore_member_group_query = "UPDATE ncg_security_groups SET FACILITATOR = '$uid' WHERE REC_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_group_query);

						$restore_member_update_query = "UPDATE ncg_security_internal_members SET ROLE = 'Facilitator' WHERE USER_ID LIKE '$uid' AND GROUP_ID LIKE '$gid'";
						DATABASE::RUN_QUERY($restore_member_update_query);
						$dom = "response=error&msg=Failed to demote member!&html=<br>".$member_update_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$dom = "response=warning&msg=Failed to demote member!&html=<br>".$member_update_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}else{
				$dom = "response=info&msg=Memeber is already demoted!&html=";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
			}
		}
		/*############################### CLASH static functionS ##########################*/
		static function ACCOUNT_CLASH($email_id){
			$check_query = "SELECT USER_ID FROM ncg_users WHERE USER_ID LIKE '$email_id'";
			$res = DATABASE::RUN_QUERY($check_query);
			if($res['response'] == "success"){
				if(mysqli_num_rows($res['data']) > 0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		static function USER_INFO_CLASH($uid){
			$validation_query = "SELECT * FROM ncg_internal_users_info WHERE USER_ID = '$uid'";
			$validation_results = DATABASE::RUN_QUERY($validation_query);
			if($validation_results['response'] == "success"){
				if(mysqli_num_rows($validation_results['data']) > 0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		/*############################### END CLASH static functionS ##########################*/
		/*############################### AUTH static functionS ##########################*/
		static function REG_USER($user_info){
				$email = $user_info['email'];
				$role = $user_info['role'];
				$status = $user_info['status'];
				$pass = md5($user_info['pass']);
				$recovery_pass = NCG_FUNCT::NCG_CRYPT($user_info['pass']);
				$reg_user_query = "INSERT INTO ncg_users (USER_ID, PASS, PASS_RECOVERY, ROLE, STATUS) VALUES ('$email','$pass', '$recovery_pass', '$role', '$status')";
				$reg_user_response = DATABASE::RUN_QUERY($reg_user_query);
				if($reg_user_response['response'] == "success"){
					NCG_FUNCT::REG_INTERNAL_USER_INFO($user_info, $reg_user_response['query_id']);
					return true;
				}else{
					return false;
				}
			}
		static function MB_UPDATE_PASS($info){
			$uid = $_SESSION['ncg-mb-active']['UID'];
			$recovery_pass = NCG_FUNCT::NCG_CRYPT($info['pass']);
			$pass = md5($info['pass']);
			$update_query = "UPDATE ncg_users SET PASS = '$pass', PASS_RECOVERY = '$recovery_pass' WHERE REC_ID = $uid";
			$res = DATABASE::RUN_QUERY($update_query);
			if($res['response'] == "success"){
				
				$creds = array("email" =>$_SESSION['ncg-mb-active']['AUTH_ID'], "pass" =>$info['pass']);
				
				NCG_FUNCT::MB_USER_LOGIN($creds);
			}
		}
		static function MB_USER_LOGIN($credentials){
			$email_id = $credentials['email'];
			$password = md5($credentials['pass']);
			$login_query = "SELECT * FROM ncg_users WHERE USER_ID LIKE '$email_id' AND PASS = '$password'";
			$request_response = DATABASE::RUN_QUERY($login_query);
			if ($request_response['response'] == "success" && mysqli_num_rows($request_response['data']) == 1){
					$user_data = mysqli_fetch_assoc($request_response['data']);
						if($user_data['STATUS'] == "Active"){
							if($user_data['ROLE'] =="User" || $user_data['ROLE'] == "Admin"){
								$user_info_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
								$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "W_EMAIL" =>$user_info_data['W_EMAIL'], "NAME" => $user_info_data['NAME'], "W_PHONE" =>$user_info_data['W_PHONE'], "AUTH_ID" =>$user_data['USER_ID']);
								$_SESSION['ncg-mb-active'] = $session_data;
								$_SESSION['NCG_MB_TIMEOUT'] = time();
								header("Location: ncg_mb_in_home.php");
								exit();

							}if($user_data['ROLE'] == "Customer"){
								$user_info_data = NCG_FUNCT::GET_EXTERNAL_USER_INFO($user_data['REC_ID']);
								$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "EMAIL" =>$user_info_data['USER_EMAIL'], "NAME" => $user_info_data['USER_NAME'], "PHONE" =>$user_info_data['USER_PHONE'], "AFFILIATION" => $user_data['AFFILIATION'], "AUTH_ID" =>$user_data['USER_ID']);
									$_SESSION['ncg-mb-active'] = $session_data;
									$_SESSION['NCG_MB_TIMEOUT'] = time();
									header("Location: ncg_mb_ex_home.php");
									exit();
							}
						}else{
							if($user_data['ROLE'] == "User" || $user_data['ROLE'] == "Admin"){

								$name_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
								$name = $name_data['NAME'];
								$dom = "name=".$name."&control=colntrol";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_mb_warning_inactive.php?xyz=".$dirty_data);
								exit();
							}else{
								
								$name_data = NCG_FUNCT::GET_EXTERNAL_USER_INFO($user_data['REC_ID']);
								$name = $name_data['USER_NAME'];
								$dom = "name=".$name."&control=colntrol";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_mb_warning_inactive.php?xyz=".$dirty_data);
								exit();
							}
						}				
			}else{
				$dom = "m=Invalid login credentials.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_mb_login.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function UAC($args){
			$role = $args['role'];
			if($role == "Admin"){
				$x = "User promoted ";
				$y = "promote ";
				$a = "Made you a System Admin, you now have unrestricted access to the system.";
			}else{
				$x = "User demoted ";
				$y = "demote ";
				$a = "Removed you as a System Admin, you now have restricted access to the system.";
			}
			$uid = $args['uid'];
			$request_query = "UPDATE ncg_users SET ROLE = '$role' WHERE REC_ID = $uid";
			$request_response = DATABASE::RUN_QUERY($request_query);
			if($request_response['response'] == "success"){
				$user_ = NCG_FUNCT::GET_USER($uid);
				$mail_request = array("subject" =>"User Account Control (UAC)", "email" =>$user_['USER_ID'], "msg" => $_SESSION['ncg-active']['NAME']." ".$a, "projects" =>"");
				NCG_FUNCT::SEND_EMAIL_NOTIFICATION_UAC($mail_request);
				$dom = "id=".$uid."&response=success&msg=".$x."!&html";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_user_profile.php?xyz=".$dirty_data);
				exit();
			}else{
				$dom = "id=".$uid."response=error&msg=Failed to ".$y."!&html";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_user_profile.php?xyz=".$dirty_data);
				exit();
			}
		}

		static function UPDATE_PASS($info){
			$uid = $_SESSION['ncg-active']['UID'];
			$pass = md5($info['pass']);
			$recovery_pass = NCG_FUNCT::NCG_CRYPT($info['pass']);
			$update_query = "UPDATE ncg_users SET PASS = '$pass', PASS_RECOVERY = '$recovery_pass' WHERE REC_ID = $uid";
			$res = DATABASE::RUN_QUERY($update_query);
			if($res['response'] == "success"){
				
				$creds = array("email" =>$_SESSION['ncg-active']['AUTH_ID'], "pass" =>$info['pass']);
				
				NCG_FUNCT::USER_RE_LOGIN($creds);
			}
		}
		static function USER_RE_LOGIN($creds){
		$email_id = $creds['email'];
		$pass = $creds['pass'];
		$password = md5($pass);
		$role = "Customer";
			$login_query = "SELECT * FROM ncg_users WHERE USER_ID LIKE '$email_id' AND PASS = '$password' AND ROLE NOT LIKE '$role'";
			$request_response = DATABASE::RUN_QUERY($login_query);
			if ($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) == 1){
					$user_data = mysqli_fetch_assoc($request_response['data']);
					if($user_data['STATUS'] == "Active"){
						$user_info_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
						$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "W_EMAIL" =>$user_info_data['W_EMAIL'], "NAME" => $user_info_data['NAME'], "W_PHONE" =>$user_info_data['W_PHONE'], "AUTH_ID" =>$user_data['USER_ID']);

						$_SESSION['ncg-active'] = $session_data;

						$dom = "response=success&msg=Password updated successfuly!&html=<br><hr/>";
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: index.php?xyz=".$dirty_data);
								exit();
					}else{
						$u_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
						$name = $u_data['NAME'];
						$dom = "id=".$u_data['USER_ID']."&control=control";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_warning_inactive.php?xyz=".$dirty_data);
						exit();
					}
					
				}else{
					$dom = "m=Invalid login credentials.&control=control";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_login.php?xyz=".$dirty_data);
				exit();
				}
			}else{
				$dom = "m=Invalid login credentialds.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_login.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function USER_LOGIN($creds){
		$email_id = $creds['email'];
		$pass = $creds['pass'];
		$password = md5($pass);
		$role = "Customer";
			$login_query = "SELECT * FROM ncg_users WHERE USER_ID LIKE '$email_id' AND PASS = '$password' AND ROLE NOT LIKE '$role'";
			$request_response = DATABASE::RUN_QUERY($login_query);
			if ($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) == 1){
					$user_data = mysqli_fetch_assoc($request_response['data']);
					if($user_data['STATUS'] == "Active"){
						$user_info_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
						$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "W_EMAIL" =>$user_info_data['W_EMAIL'], "NAME" => $user_info_data['NAME'], "W_PHONE" =>$user_info_data['W_PHONE'], "AUTH_ID" =>$user_data['USER_ID']);
						$_SESSION['NCG_TIMEOUT'] = time();
						$_SESSION['ncg-active'] = $session_data;
						header("Location: index.php");
					}else{
						$u_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
						$name = $u_data['NAME'];
						$dom = "id=".$u_data['USER_ID']."&control=control";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_warning_inactive.php?xyz=".$dirty_data);
						exit();
					}
					
				}else{
					$dom = "m=Invalid login credentials.&control=control";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_login.php?xyz=".$dirty_data);
				exit();
				}
			}else{
				$dom = "m=Invalid login credentialds.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_login.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function RE_USER_LOGIN($creds){
		$email_id = $creds['email'];
		$pass = $creds['pass'];
		$password = md5($pass);
		$role = "Customer";
			$login_query = "SELECT * FROM ncg_users WHERE USER_ID LIKE '$email_id' AND PASS = '$password' AND ROLE NOT LIKE '$role'";
			$request_response = DATABASE::RUN_QUERY($login_query);
			if ($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) == 1){
					$user_data = mysqli_fetch_assoc($request_response['data']);
					if($user_data['STATUS'] == "Active"){
						$user_info_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
						$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "W_EMAIL" =>$user_info_data['W_EMAIL'], "NAME" => $user_info_data['NAME'], "W_PHONE" =>$user_info_data['W_PHONE']);
						$_SESSION['NCG_TIMEOUT'] = time();
						$_SESSION['ncg-active'] = $session_data;
						$dom = "response=success&msg=Password reset was successful!&html=<br><hr/>";
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: index.php?xyz=".$dirty_data);
								exit();
					}else{
						$u_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
						$name = $u_data['NAME'];
						$dom = "id=".$u_data['USER_ID']."&control=control";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_warning_inactive.php?xyz=".$dirty_data);
						exit();
					}
					
				}else{
					$dom = "m=Invalid login credentials.&control=control";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_login.php?xyz=".$dirty_data);
				exit();
				}
			}else{
				$dom = "m=Invalid login credentialds.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_login.php?xyz=".$dirty_data);
				exit();
			}
		}

		static function MB_RE_USER_LOGIN($credentials){
			$email_id = $credentials['email'];
			$password = md5($credentials['pass']);
			$login_query = "SELECT * FROM ncg_users WHERE USER_ID LIKE '$email_id' AND PASS = '$password'";
			$request_response = DATABASE::RUN_QUERY($login_query);
			if ($request_response['response'] == "success" && mysqli_num_rows($request_response['data']) == 1){
					$user_data = mysqli_fetch_assoc($request_response['data']);
						if($user_data['STATUS'] == "Active"){
							if($user_data['ROLE'] =="User" || $user_data['ROLE'] == "Admin"){
								$user_info_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
								$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "W_EMAIL" =>$user_info_data['W_EMAIL'], "NAME" => $user_info_data['NAME'], "W_PHONE" =>$user_info_data['W_PHONE']);
								$_SESSION['ncg-mb-active'] = $session_data;
								header("Location: ncg_mb_in_home.php");
								exit();

							}if($user_data['ROLE'] == "Customer"){
								$user_info_data = NCG_FUNCT::GET_EXTERNAL_USER_INFO($user_data['REC_ID']);
								$session_data = array("UID" =>$user_data['REC_ID'], "PASS" =>$user_data['PASS'], "ROLE" =>$user_data['ROLE'], "STATUS" =>$user_data['STATUS'], "EMAIL" =>$user_info_data['USER_EMAIL'], "NAME" => $user_info_data['USER_NAME'], "PHONE" =>$user_info_data['USER_PHONE'], "AFFILIATION" => $user_data['AFFILIATION']);
									$_SESSION['ncg-mb-active'] = $session_data;

									header("Location: ncg_mb_ex_home.php");
									exit();
							}
						}else{
							if($user_data['ROLE'] == "User"){

								$name_data = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
								$name = $name_data['NAME'];
								$dom = "name=".$name."&control=colntrol";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_mb_warning_inactive.php?xyz=".$dirty_data);
								exit();
							}else{
								
								$name_data = NCG_FUNCT::GET_EXTERNAL_USER_INFO($user_data['REC_ID']);
								$name = $name_data['USER_NAME'];
								$dom = "name=".$name."&control=colntrol";
								$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
								header("Location: ncg_mb_warning_inactive.php?xyz=".$dirty_data);
								exit();
							}
						}				
			}else{
				$dom = "m=Invalid login credentials.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_mb_login.php?xyz=".$dirty_data);
				exit();
			}
		}
		static function DELETE_EXTERNAL_SEC_GROUP($info){
			$gid = $info['gid'];
			$delete_group_query = "DELETE FROM ncg_security_groups WHERE REC_ID LIKE '$gid'";
				if(NCG_FUNCT::COUNT_GROUP_MEMBERS($gid, "External") > 0){
					$members_delete_response = NCG_FUNCT::DELETE_EXT_GROUP_MEMBERS($info);
					if($members_delete_response){
						$delete_group_response = DATABASE::RUN_QUERY($delete_group_query);
						if($delete_group_response['response'] == "success"){
							$dom = "response=success&msg=".$info['name']." Group deleted successfully!&html";
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
							exit();
						}else{
							$dom = "response=error&msg=Failed to delete group ".$info['name']."!&html=<br><hr/>".$delete_group_response['message'];
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
								exit();
						}
					}else{
						$dom = "response=warning&msg=".$info['name']." was not deleted!&html=<br><hr/>Failed to delete group members<br>".$members_delete_response;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
								exit();
						}
				}else{
					$delete_group_response = DATABASE::RUN_QUERY($delete_group_query);
					if($delete_group_response['response'] == "success"){
						$dom = "response=success&msg=".$info['name']." Group deleted successfully!&html";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "vresponse=error&msg=Failed to delete group ".$info['name']."!&html=<br><hr/>".$delete_group_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
							exit();
					}
				}
		}
		static function DELETE_INTERNAL_SEC_GROUP($info){
			$gid = $info['gid'];
			$delete_group_query = "DELETE FROM ncg_security_groups WHERE REC_ID LIKE '$gid'";
				if(NCG_FUNCT::COUNT_GROUP_MEMBERS($gid, "Internal") > 0){
					$members_delete_response = NCG_FUNCT::DELETE_GROUP_MEMBERS($info);
					if($members_delete_response){
						$delete_group_response = DATABASE::RUN_QUERY($delete_group_query);
						if($delete_group_response['response'] == "success"){
							$dom = "response=success&msg=".$info['name']." Group deleted successfully!&html";
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
							exit();
						}else{
							$dom = "response=error&msg=Failed to delete group ".$info['name']."!&html=<br><hr/>".$delete_group_response['message'];
							$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
							header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
								exit();
						}
					}else{
						$dom = "response=warning&msg=".$info['name']." was not deleted!&html=<br><hr/>Failed to delete group members<br>".$members_delete_response;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
								exit();
						}
				}else{
					$delete_group_response = DATABASE::RUN_QUERY($delete_group_query);
					if($delete_group_response['response'] == "success"){
						$dom = "response=success&msg=".$info['name']." Group deleted successfully!&html";
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=error&msg=Failed to delete group ".$info['name']."!&html=<br><hr/>".$delete_group_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
							exit();
					}
				}
		}
		static function RESET_SECURITY_FACILITATOR($info){
			$gid = $info['gid'];
			$reset_group_facilitator_query = "UPDATE ncg_security_groups SET FACILITATOR = NULL WHERE REC_ID LIKE '$gid'";
			$reset_group_facilitator_response = DATABASE::RUN_QUERY($reset_group_facilitator_query);
			if($reset_group_facilitator_response['response'] == "success"){
				return true;
			}else{
				return $reset_group_facilitator_response['message'];
			}
		}
		static function RESET_EXT_SECURITY_GROUP($info){
			$gid = $info['gid'];
			$members_data = NCG_FUNCT::GET_GROUP_MEMBERS($gid, "External");
			if(mysqli_num_rows($members_data) > 0){
				$count = 1;
				$node = 0;
				$prefix = "";
				$suffix = "";
				$more_text = "";
				$to_display = "";
				$people = array();
				while($member = $members_data ->fetch_assoc()){
					if($count < 3){
						array_push($people, NCG_FUNCT::GET_EXTERNAL_USER_NAME($member['USER_ID']));
					}
					$count++;
				}
				foreach($people as $person){
					if(empty($to_display)){
							$to_display = $to_display.$person;
					}else{
						$to_display = $to_display."<br>".$person;
					}
				}
				if(mysqli_num_rows($members_data) > sizeof($people)){
					$prefix = "plus ";
					$suffix = " More";
					$node = mysqli_num_rows($members_data) - sizeof($people);
				}else{
					$node = "";
				}
				$remove_members_query = "DELETE FROM ncg_security_external_members WHERE GROUP_ID LIKE '$gid'";
				$remove_members_response = DATABASE::RUN_QUERY($remove_members_query);
				if($remove_members_response['response'] == "success"){
					$reset_facilitator_response = NCG_FUNCT::RESET_SECURITY_FACILITATOR($info);
					if($reset_facilitator_response){
						$dom = "response=success&msg=".$info['name']." Group members deleted successfully!&html=<br><h4>Affected Members</h4><hr/><h4>".$to_display."</h4><br>".$prefix.$node.$suffix;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=warning&msg=Group members deleted successfully!&html=<br><h4>Affected Members</h4><hr/><h4>".$to_display."</h4><br>".$prefix.$node.$suffix."<br><hr/><br>Failed to reset facilitator<br>".$remove_members_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$dom = "response=error&msg=Failed to delete group members!&html=<br><hr/>".$remove_members_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}
		}
		static function GET_INITIALS(string $name) : string{
        	$name_parts = explode(" ", $name);
        		$first_name = $name_parts[0];
        		$last_name = end($name_parts);
        	if (count($name_parts) >= 2) {
            	return mb_strtoupper($first_name[0]) . mb_strtolower($last_name[1]);
        	}else{
        		return mb_strtoupper($name[0]).mb_strtolower($name[2]);
        	}
    	}

		static function RESET_SECURITY_GROUP($info){
			$gid = $info['gid'];
			$members_data = NCG_FUNCT::GET_GROUP_MEMBERS($gid, "Internal");
			if(mysqli_num_rows($members_data) > 0){
				$count = 1;
				$node = 0;
				$prefix = "";
				$suffix = "";
				$more_text = "";
				$to_display = "";
				$people = array();
				while($member = $members_data ->fetch_assoc()){
					if($count < 3){
						array_push($people, NCG_FUNCT::GET_FACILITATOR_NAME($member['USER_ID']));
					}
					$count++;
				}
				foreach($people as $person){
					if(empty($to_display)){
							$to_display = $to_display.$person;
					}else{
						$to_display = $to_display."<br>".$person;
					}
				}
				if(mysqli_num_rows($members_data) > sizeof($people)){
					$prefix = "plus ";
					$suffix = " More";
					$node = mysqli_num_rows($members_data) - sizeof($people);
				}else{
					$node = "";
				}
				$remove_members_query = "DELETE FROM ncg_security_internal_members WHERE GROUP_ID LIKE '$gid'";
				$remove_members_response = DATABASE::RUN_QUERY($remove_members_query);
				if($remove_members_response['response'] == "success"){
					$reset_facilitator_response = NCG_FUNCT::RESET_SECURITY_FACILITATOR($info);
					if($reset_facilitator_response){
						$dom = "response=success&msg=".$info['name']." Group members deleted successfully!&html=<br><h4>Affected Members</h4><hr/><h4>".$to_display."</h4><br>".$prefix.$node.$suffix;
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}else{
						$dom = "response=warning&msg=Group members deleted successfully!&html=<br><h4>Affected Members</h4><hr/><h4>".$to_display."</h4><br>".$prefix.$node.$suffix."<br><hr/><br>Failed to reset facilitator<br>".$remove_members_response['message'];
						$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
						header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
					}
				}else{
					$dom = "response=error&msg=Failed to delete group members!&html=<br><hr/>".$remove_members_response['message'];
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_sec_groups.php?xyz=".$dirty_data);
						exit();
				}
			}
		}
		static function DELETE_GROUP_MEMBERS($info){
			$gid = $info['gid'];
			$remove_members_query = "DELETE FROM ncg_security_internal_members WHERE GROUP_ID LIKE '$gid'";
			$remove_members_response = DATABASE::RUN_QUERY($remove_members_query);
			if($remove_members_response['response'] == "success"){
				return true;
			}else{
				return $remove_members_response['message'];
			}
		}
		static function DELETE_EXT_GROUP_MEMBERS($info){
			$gid = $info['gid'];
			$remove_members_query = "DELETE FROM ncg_security_internal_members WHERE GROUP_ID LIKE '$gid'";
			$remove_members_response = DATABASE::RUN_QUERY($remove_members_query);
			if($remove_members_response['response'] == "success"){
				return true;
			}else{
				return $remove_members_response['message'];
			}
		}
		static function DELETE_INTERNAL_ACCOUNT($id){
			$page = $_POST['page'];
			$_account_check_existance = "SELECT * FROM ncg_users WHERE REC_ID = $id";
			$_check_existance_response = DATABASE::RUN_QUERY($_account_check_existance);
			if(mysqli_num_rows($_check_existance_response['data']) > 0){
				$_delete_account_request = "DELETE FROM ncg_users WHERE REC_ID = $id";
				$_delete_account_response = DATABASE::RUN_QUERY($_delete_account_request);

				if($_delete_account_response['response'] == "success"){
					$_clear_residual_data_request = "DELETE FROM ncg_internal_users_info WHERE USER_ID = $id";
					$_crear_residual_data_response = DATABASE::RUN_QUERY($_clear_residual_data_request);

					if($_crear_residual_data_response['response'] == "success"){
						header("Location: ".$page);
						exit();
					}
				}
			}
		}
		static function GET_USER_ROLE($id){
			$role_request = "SELECT * FROM ncg_users WHERE REC_ID = $id";
			$request_response = DATABASE::RUN_QUERY($role_request);
			$role_data = mysqli_fetch_assoc($request_response['data']);
			return $role_data['ROLE'];
		}
		static function UPDATE_PASSWORD($info){
			$pass = $info['pass'];
			$email = $info['email'];

				$recovery_pass = NCG_FUNCT::NCG_CRYPT($pass);
				$pass = md5($pass);

				$pass_update_query = "UPDATE ncg_users SET PASS = '$pass', PASS_RECOVERY = '$recovery_pass' WHERE USER_ID LIKE '$email'";
				$pass_update_response = DATABASE::RUN_QUERY($pass_update_query);
				if($pass_update_response['response'] == "success"){
					$login_request = array("email" =>$email, "pass" =>$info['pass']);
					NCG_FUNCT::RE_USER_LOGIN($login_request);
				}else{
					$dom = "m=Failed to change password.&email=".$email;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_new_pass.php?xyz=".$dirty_data);
					exit();
				}
		}
		static function UPDATE_MB_PASSWORD($info){
			$pass = $info['pass'];
			$email = $info['email'];
				$pass = md5($pass);
				$recovery_pass = NCG_FUNCT::NCG_CRYPT($info['pass']);
				$pass_update_query = "UPDATE ncg_users SET PASS = '$pass', PASS_RECOVERY = '$recovery_pass' WHERE USER_ID LIKE '$email'";
				$pass_update_response = DATABASE::RUN_QUERY($pass_update_query);
				if($pass_update_response['response'] == "success"){
					$login_request = array("email" =>$email, "pass" =>$info['pass']);
					NCG_FUNCT::MB_RE_USER_LOGIN($login_request);
				}else{
					$dom = "m=Failed to change password.&email=".$email;
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ncg_mb_new_pass.php?xyz=".$dirty_data);
					exit();
				}
		}
		static function UPDATE_AUTH_EMAIL($info){
			$email = $info['email'];
			$mail->ClearAllRecipients();
			$from = $info['from'];
			$ORG_ID = $_SESSION['ncg-active']['ORGANISATION_ID'];
			$email_update_query = "UPDATE users SET USER_ID = '$email' WHERE ORGANISATION_ID LIKE '$ORG_ID'";
			$email_update_response = DATABASE::RUN_QUERY($email_update_query);
			if($email_update_response['response'] == "success"){
				
			$credentials = array("email" =>$email, "password" =>NCG_FUNCT::RETRIVE_PASS($ORG_ID));
				session_destroy();
				if(NCG_FUNCT::USER_RE_AUTH($credentials)){
					$dom = "res=success&msg=Login email updated successfully.";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ".$from."?xyz=".$dirty_data);
					exit();
				}
				else{
					$dom = "res=failed&msg=Failed to change login email.";
					$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
					header("Location: ".$from."?xyz=".$dirty_data);
						exit();
				}
			}
			else{
				$dom = "res=failed&msg=Failed to change login email.";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ".$from."?xyz=".$dirty_data);
						exit();
				}
		}
		static function SEND_EMAIL($info){
			global $mail;
			$mail->ClearAllRecipients();
			$_email = $info['email'];
			$_pass = $info['pass'];
			$_subject = $info['subject'];
			$user_data = array(
			    'USR_EMAIL' => $_email,
			    'USR_PSW' => $_pass,
			    'USR_NAME' => $info['name'],
			    'CLIENT' => $info['client'], "MESSAGE" =>$info['msg']
			);
			$html_body = file_get_contents('ncg_email_new_user_temp.html');

			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->addAddress($_email, $info['name']);
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $info['name'].","."\n".$info['msg']."\n\nEmail: ".$_email."\nPassword: ".$_pass;
			//$mail->AltBody = "Login credentials\nEmail: ".$_email."\nPassword: ".$_pass;

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		 static function SEND_PASS_RESET_EMAIL($info){
			global $mail;
			$mail->ClearAllRecipients();
			$_email = $info['email'];
			$_subject = $info['subject'];
			$_link = $info['link'];
			$user_data = array(
			    'USR_NAME' => $info['name'],
			    'MESSAGE' =>$info['msg'],
			    'TOKEN' =>$info['token'],
			    'LINK' =>$_link
			);
			$html_body = file_get_contents('pass_reset_email.html');
			$html_body = str_replace("url_placeholder", $_link, $html_body);
			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->addAddress($_email, $info['name']);
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $info['name'].","."\n".$info['msg']."\n Follow the link => https://".$_link."'\nOTP: ".$info['token'];

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		 static function SEND_MB_PASS_RESET_EMAIL($info){
			global $mail;
			$mail->ClearAllRecipients();
			$_email = $info['email'];
			$_subject = $info['subject'];
			$user_data = array(
			    'USR_NAME' => $info['name'],
			    'MESSAGE' =>$info['msg'],
			    'TOKEN' =>$info['token']
			);
			$html_body = file_get_contents('../mb_pass_reset_email.html');
			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->addAddress($_email, $info['name']);
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $info['name'].","."\n".$info['msg']."'\nOTP: ".$info['token'];

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function SEND_NEW_CLIENT_EMAIL_NOTIFICATION_CON_PERSON($info){
			global $mail;
			$mail->ClearAllRecipients();
			$_subject = $info['subject'];
			$contacts = $info['contacts'];
			$client = $info['client'];
			$con_email = $info['c_email'];
			$con_name = $info['c_name'];
			$description = $info['description'];
			$addresses = $info['addresses'];

			

			$plain_values = "CLIENT CONTACTS\n";
			foreach ($contacts as $contact) {
				$plain_values .="\n".$contact;
			}
			$plain_values .= "\nCLIENT ADDRESS\n";
			foreach ($addresses as $address) {
				$plain_values .="\n".$address;
			}
			$plain_values .= "\n".$description;


			$html_values = "<strong><br><br>CLIENT CONTACTS</strong><br><br>";
			foreach ($contacts as $contact) {
				$html_values .=$contact."<hr>";
			}
			$html_values .= "<strong><br><br>CLIENT ADDRESS</strong><br><br>";
			foreach ($addresses as $address) {
				$html_values .=$address."<hr>";
			}
			$html_values .= "<p style='font-style: italic; font-weight: normal;'>".$description."</p>";
			$user_data = array(
			    'PROJECT' => strtoupper($con_name),
			    'MESSAGE' =>$client." ".$info['msg'],
			    'VALUES' =>$html_values
			);
			$html_body = file_get_contents('ncg_project_update.html');
			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}

			$mail->addAddress($con_email, $con_name);
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = strtoupper($client)." ".$info['msg']."\n".$plain_values;

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function SEND_NEW_CLIENT_EMAIL_NOTIFICATION_ADMINS($info){
			global $mail;
			global $user_info;
			$mail->ClearAllRecipients();
			$_subject = $info['subject'];
			$contacts = $info['contacts'];
			$client = $info['client'];
			$description = $info['description'];
			$addresses = $info['addresses'];
			$handled = array();
			$admins = NCG_FUNCT::GET_ADMINS();
			if(mysqli_num_rows($admins) == 1){
				$admin = $admins->fetch_assoc();
				$mail->addAddress($admin['USER_ID'],  $user_info['NAME']);
			}else{
				while($admin = $admins->fetch_assoc()){
					if(!in_array($admin['REC_ID'], $handled)){
						$_admin_info = NCG_FUNCT::GET_USER_INFO($admin['REC_ID']);
						$mail->AddCC($admin['USER_ID'], $_admin_info['NAME']);
					}
				}
			}

			$plain_values = "CLIENT CONTACTS\n";
			foreach ($contacts as $contact) {
				$plain_values .="\n".$contact;
			}
			$plain_values .= "\nCLIENT ADDRESS\n";
			foreach ($addresses as $address) {
				$plain_values .="\n".$address;
			}
			$plain_values .= "\n".$description;


			$html_values = "<strong>CLIENT CONTACTS</strong><br><br>";
			foreach ($contacts as $contact) {
				$html_values .=$contact."<hr>";
			}
			$html_values .= "<strong>CLIENT ADDRESS</strong><br><br>";
			foreach ($addresses as $address) {
				$html_values .=$address."<hr>";
			}
			$html_values .= "<p style='font-style: italic; font-weight: normal;'>".$description."</p>";
			$user_data = array(
			    'PROJECT' => strtoupper($client),
			    'MESSAGE' =>$info['msg']." <strong>".$client."</strong>",
			    'VALUES' =>$html_values
			);
			$html_body = file_get_contents('ncg_project_update.html');
			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = strtoupper($client).","."\n".$info['msg'].$client."\n".$plain_values;

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function SEND_EMAIL_NOTIFICATION_ADMINS($info){
			global $mail;
			$mail->ClearAllRecipients();
			$_subject = $info['subject'];
			$values = $info['values'];
			$project = $info['project'];
			$admins = NCG_FUNCT::GET_ADMINS();
			while($admin = $admins->fetch_assoc()){
					$_admin_info = NCG_FUNCT::GET_USER_INFO($admin['REC_ID']);
					$mail->AddCC($admin['USER_ID'], $_admin_info['NAME']);
			}
			$plain_values = "";
			foreach ($values as $value) {
				$plain_values .="\n".$value;
			}
			$html_values = "";
			foreach ($values as $value) {
				$html_values .=$value."<hr>";
			}
			$user_data = array(
			    'PROJECT' => strtoupper($project),
			    'MESSAGE' =>$info['msg'],
			    'VALUES' =>$html_values
			);
			$html_body = file_get_contents('ncg_project_update.html');
			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $project.","."\n".$info['msg']."\n".$plain_values;

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function SEND_PROJECT_UPDATE_EMAIL($info){
			global $mail;
			$mail->ClearAllRecipients( );
			$_pid = $info['pid'];
			$_subject = $info['subject'];
			$values = $info['values'];
			if(isset($_POST['source'])){
				$source =$_POST['source'];
			}else{
				$source = "desktop";
			}
			$project_info = NCG_FUNCT::GET_PROJECT_INFO($_pid);
			$people = NCG_FUNCT::GET_PROJECT_ASSIGNMENTS($_pid);
			$handled = array();
			while($person = $people->fetch_assoc()){
				$_person = NCG_FUNCT::GET_USER($person['UID']);
				if($_person['ROLE'] == "Customer"){
					$_person_info = NCG_FUNCT::GET_EXTERNAL_USER_INFO($person['UID']);
					$mail->AddCC($_person['USER_ID'], $_person_info['USER_NAME']);
					array_push($handled, $person['UID']);
				}else{
					$_person_info = NCG_FUNCT::GET_USER_INFO($person['UID']);
					$mail->AddCC($_person['USER_ID'], $_person_info['NAME']);
					array_push($handled, $person['UID']);
				}
			}
			$admins = NCG_FUNCT::GET_ADMINS();
			while($admin = $admins->fetch_assoc()){
				if(!in_array($admin['REC_ID'], $handled)){
					$_admin_info = NCG_FUNCT::GET_USER_INFO($admin['REC_ID']);
					$mail->AddCC($admin['USER_ID'], $_admin_info['NAME']);
				}
			}
			$plain_values = "";
			foreach ($values as $value) {
				$plain_values .="\n".$value;
			}
			$html_values = "";
			foreach ($values as $value) {
				$html_values .=$value."<hr>";
			}
			$user_data = array(
			    'PROJECT' => $project_info['PROJECT_NAME'],
			    'MESSAGE' =>$info['msg'].$project_info['PROJECT_NAME'],
			    'VALUES' =>$html_values
			);
			
			if(isset($_POST['mobile']) == "mobile"){
				$html_body = file_get_contents('../ncg_project_update.html');
			}else{
				$html_body = file_get_contents('ncg_project_update.html');
			}
			if(isset($user_data)){
			    foreach($user_data as $data => $i){
			        $html_body = str_replace('{'.strtoupper($data).'}', $i, $html_body);
			    }
			}
			$mail->Subject = $_subject;
			$mail->Body    = $html_body;
			$mail->AltBody = $project_info['PROJECT_NAME'].","."\n".$info['msg'].$project_info['PROJECT_NAME']."\n".$plain_values;

			if(!$mail->send()) {
			    return false;
			} else {
			    return true;
			}
		}
		static function GET_PROJECT_ASSIGNMENTS($uid){
			$request_query = "SELECT * FROM ncg_assignments WHERE PID = $uid";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function GET_ADMINS(){
			$request_query = "SELECT * FROM ncg_users WHERE ROLE = 'Admin'";
			$request_response = DATABASE::RUN_QUERY($request_query);
			return $request_response['data'];
		}
		static function NCG_DECRYPT($data){
		    if(empty($data)){
		        return $data;
		    }
		    $c = base64_decode($data);
		    $cipher = "AES-128-CBC"; 
		    $ivlen = openssl_cipher_iv_length($cipher);
		    $iv = substr($c, 0, $ivlen);
		    $hmac = substr($c, $ivlen, $sha2len=32);
		    $key = "inyatsi";
		    $options = OPENSSL_RAW_DATA;
		    
		    $ciphertext_raw = substr($c, $ivlen+$sha2len);
		    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options, $iv);
		    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		    if(hash_equals($hmac, $calcmac)){
		        return $original_plaintext;
		    }
		    
		    return false;
		}
		  static function NCG_CRYPT($data){
		    if(empty($data)){
		        return $data;
		    }
		    $cipher = "AES-128-CBC"; 
		    $ivlen = openssl_cipher_iv_length($cipher);
		    $iv = openssl_random_pseudo_bytes($ivlen);
		    $key = "inyatsi";
		    $options = OPENSSL_RAW_DATA;
		    
		    $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options, $iv);
		    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
		    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
		            
		    return $ciphertext;
		}
		static function VOID_TOKEN($email){
			$void_query = "UPDATE ncg_password_reset SET  TOKEN_VALIDATION = 0 , TOKEN_EXPIRED = now() WHERE USER_ID = '$email'";
			$response = DATABASE::RUN_QUERY($void_query);
		}
		static function MB_REQUEST_PSW_RESET($email){
			NCG_FUNCT::VOID_TOKEN($email);
			if(NCG_FUNCT::ACCOUNT_CLASH($email)){
				$user_data = NCG_FUNCT::GET_USER_BY_EMAIL($email);
				$user_info = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
				$name = $user_info['NAME'];
				$token = rand(1000,9999);
				$encry_token = md5($token);



				$time = date('Y-m-d H:i:s');
				// expire the token after 2 hour
				$RESET_TOKEN_LIFE = '2 hours';
				$expiration = date('Y-m-d H:i:s', strtotime($time . ' + ' . $RESET_TOKEN_LIFE));


				$token_query = "INSERT INTO ncg_password_reset (USER_ID, PASS_TOKEN, TOKEN_EXPIRATION, TOKEN_VALIDATION) VALUES ('$email', '$encry_token', '$expiration', 1)";
				$request_response = DATABASE::RUN_QUERY($token_query);
				if($request_response['response'] == "success"){

					$x = "email=".$email."&control=control";
					$y = NCG_FUNCT::MAKE_DIRTY($x);
					$a = "email=".$email."&token=".$encry_token;
					$b = NCG_FUNCT::MAKE_DIRTY($a);
					$email_request = array("email" =>$email, "name" =>$name, "subject" =>"Password reset request", "msg" =>"You have requested a password reset. Find your password reset OTP bellow. OTP EXPIRES AT: {$expiration}", "token" =>$token);
					if(NCG_FUNCT::SEND_MB_PASS_RESET_EMAIL($email_request)){
						header("Location: ncg_mb_psw_reset_validate.php?xyz=".$y);
						exit();	
					}
					

			}else{
				$dom = "m=The email you provided does not have an account.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_mb_psw_reset.php?xyz=".$dirty_data);
				exit();
			}
		}
	}
		static function REQUEST_PSW_RESET($email){
			NCG_FUNCT::VOID_TOKEN($email);
			if(NCG_FUNCT::ACCOUNT_CLASH($email)){
				$user_data = NCG_FUNCT::GET_USER_BY_EMAIL($email);
				$user_info = NCG_FUNCT::GET_USER_INFO($user_data['REC_ID']);
				$name = $user_info['NAME'];
				$token = rand(1000,9999);
				$encry_token = md5($token);



				$time = date('Y-m-d H:i:s');
				// expire the token after 12 hours
				$RESET_TOKEN_LIFE = '12 hours';
				$expiration = date('Y-m-d H:i:s', strtotime($time . ' + ' . $RESET_TOKEN_LIFE));


				$token_query = "INSERT INTO ncg_password_reset (USER_ID, PASS_TOKEN, TOKEN_EXPIRATION, TOKEN_VALIDATION) VALUES ('$email', '$encry_token', '$expiration', 1)";
				$request_response = DATABASE::RUN_QUERY($token_query);
				if($request_response['response'] == "success"){

					$x = "email=".$email."&control=control";
					$y = NCG_FUNCT::MAKE_DIRTY($x);
					$a = "email=".$email."&token=".$encry_token;
					$b = NCG_FUNCT::MAKE_DIRTY($a);
					$email_request = array("email" =>$email, "name" =>$name, "subject" =>"Password reset request", "msg" =>"You have requested a password reset. Find your password reset instructions bellow.", "link" =>"localhost/inyatsi/ncg_recover_validate.php?xyz=".$b, "token" =>$token);
					if(NCG_FUNCT::SEND_PASS_RESET_EMAIL($email_request)){
						header("Location: ncg_recover_validate.php?xyz=".$y);
						exit();	
					}
					

			}else{
				$dom = "m=The email you provided does not have an account.&control=control";
				$dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
				header("Location: ncg_pass_recovery.php?xyz=".$dirty_data);
				exit();
			}
		}
	}
		static function GET_TOKEN_VALIDATION($otp){
		    $query = "SELECT * FROM ncg_password_reset WHERE PASS_TOKEN = '$otp' AND TOKEN_VALIDATION = 1 AND TOKEN_EXPIRATION >= now()";
		    $response = DATABASE::RUN_QUERY($query);

		    return mysqli_fetch_assoc($response['data']);
		}
		static function RE_AUTH($email, $pass){
			$_pass = md5($pass);
			$request_login = "SELECT * FROM ncg_users WHERE USER_ID = '$email' AND PASS = '$_pass'";
			$response = DATABASE::RUN_QUERY($request_login);
			if($response['response'] == "success"){
				$update_query = "UPDATE ncg_users SET PASS = '$_pass' WHERE USER_ID = '$email'";
				$res = DATABASE::RUN_QUERY($update_query);

			}
			
		}
		static function USER_RE_AUTH($credentials){
			session_start();
			$email_id = $credentials['email'];
			$password = $credentials['password'];
			$login_query = "SELECT * FROM users WHERE USER_ID LIKE '$email_id' AND PASSWORD = '$password'";
			$request_response = DATABASE::RUN_QUERY($login_query);
			if ($request_response['response'] == "success"){
				if(mysqli_num_rows($request_response['data']) == 1){
					$user_data = mysqli_fetch_assoc($request_response['data']);
					$org_data = NCG_FUNCT::GET_ORGANISATION_BY_ID($user_data['ORGANISATION_ID']);
					$session_data = array("NAME" =>$org_data['NAME'], "PHONE" =>$org_data['PHONE'], "REGION" =>$org_data['REGION'], "EMAIL" =>$email_id, "UID" =>$user_data['REC_ID'], "ORGANISATION_ID" => $org_data['REC_ID'], "ELEVATION" =>$user_data['ELEVATION']);
					$_SESSION['ncg-active'] = $session_data;
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		static function PASSWORD_VALID($pass, $repass){
			if($pass != $repass){
				return false;
			}else{
				return true;
			}
		}
		static function RETRIVE_PASS($ORG_ID){
			$pass_query = "SELECT * FROM users WHERE ORGANISATION_ID LIKE '$ORG_ID'";
			$pass_response = DATABASE::RUN_QUERY($pass_query);
			$pass_data = mysqli_fetch_assoc($pass_response['data']);
			return $pass_data['PASSWORD'];
		}
		static function USER_ELEVATION_CONTROL(){
			if($_SESSION['ncg-active']["ELEVATION"] == "external"){
				header("Location: external.php");
					exit();
			}else{
				header("Location: index.php");
					exit();
			}
		}
		static function LOGOUT(){
			unset($_SESSION['ncg-active']);
		}
		static function MB_LOGOUT(){
			unset($_SESSION['ncg-mb-active']);
		}
		static function VALID_SESSION(){
			if(isset($_SESSION['ncg-active'])){
				return true;
			}else{
				header("Location: ncg_login.php");
				exit();
			}
		}
		static function MB_VALID_SESSION(){
			if(isset($_SESSION['ncg-mb-active'])){
				return true;
			}else{
				return false;
			}
		}
		static function GET_MB_BADGE(){
	        $prm = NCG_FUNCT::GET_INTERNAL_USER_PERMISSIONS($_SESSION['ncg-mb-active']['UID']);
	        
	        if($_SESSION['ncg-mb-active']['ROLE'] == "Admin"){
	            $auth_badge = '<svg class="badge" style="float: left; width:28px;" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	     viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
	<path style="fill:#1AA912;" d="M29,0c0,0-6.667,8-22,8v19.085c0,9.966,4.328,19.577,12.164,25.735C21.937,55,25.208,56.875,29,58
	    c3.792-1.125,7.062-3,9.836-5.18C46.672,46.662,51,37.051,51,27.085V8C35.667,8,29,0,29,0z"/>
	<path style="fill:#FFFFFF;" d="M29,51.661c-2.123-0.833-4.178-2.025-6.128-3.558C16.69,43.245,13,35.388,13,27.085V13.628
	    c7.391-0.943,12.639-3.514,16-5.798c3.361,2.284,8.609,4.855,16,5.798v13.457c0,8.303-3.69,16.16-9.871,21.018
	    C33.178,49.636,31.123,50.828,29,51.661z"/>
	<path style="fill:#1AA912;" d="M41.659,20.248c-0.416-0.364-1.047-0.321-1.411,0.094L26.951,35.537l-7.244-7.244
	    c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l8,8C26.481,37.895,26.735,38,27,38c0.011,0,0.022,0,0.033,0
	    c0.277-0.009,0.537-0.133,0.719-0.341l14-16C42.116,21.243,42.074,20.611,41.659,20.248z"/><g></g><g></g><g></g><g></g><g></g><g>
	</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
	</svg>';



	        }elseif(NCG_FUNCT::IS_SPECIAL($_SESSION['ncg-mb-active']['UID'])){
	        	$auth_badge = '<p style="float: left; margin-right:4px;" class="badge badge-secondary">SPECIAL</p>';
	        }else{
	            if($prm['permissions'] != ""){
	                $auth_badge = '<p style="float: left; margin-right:4px;" class="badge badge-info"><span style="color:'.$prm['c_color'].'">'.$prm['C'].'</span><span style="color:'.$prm['r_color'].'">'.$prm['R'].'</span><span style="color:'.$prm['u_color'].'">'.$prm['U'].'</span><span style="color:'.$prm['d_color'].'">'.$prm['D'].'</span></p>';
	            }
	        }
	        return $auth_badge;
		}
		static function NCG_MB_TIMEOUT(){
			if (isset($_SESSION['NCG_MB_TIMEOUT']) && (time() - $_SESSION['NCG_MB_TIMEOUT'] > 3600)) {
    			return true;
			}else{
				$_SESSION['NCG_MB_TIMEOUT'] = time();
			}
		}
		static function INVALID_OUTBOUND_REDIRECT(){
			if(isset($_SESSION['ncg-active'])){
				header("Location: index.php");
				exit();
			}
		}
		/*############################### END AUTH static functionS ##########################*/


	    static function URL_DECODE($data){
	    	return base64_decode(strtr($data, '-_,', '+/='));
	    }
	    static function MAKE_DIRTY($data){
			return strtr(base64_encode($data), '+/=', '-_,');
		}
    	static function DIRTY_DATA($data){
    		$decoded = NCG_FUNCT::URL_DECODE($data);
    	 	$raw_data = explode("&", $decoded);
    	 	if(sizeof($raw_data) > 1){
    	 	foreach ($raw_data as $key => $value) {
    	 		$new_data = explode("=", $value);
    	 		$_GET[$new_data[0]] = $new_data[1];
    	 	}
    	 }else{
    	 	$_GET[$raw_data[0]] = $raw_data[0];
    	 }
    	 return $_GET;	
    	}
	}
