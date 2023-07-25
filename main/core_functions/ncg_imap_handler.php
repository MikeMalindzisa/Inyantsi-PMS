<?php
$server = "{mail.outsourceszl.com:993/ssl/novalidate-cert}INBOX";
$email = "test@outsourceszl.com";
$pas = "pass";

try {
	$connection = imap_open($server, $email, $pas);
} catch (Exception $e) {
	echo $e;
}
class NCG_EMAILS {
	
	function INBOX_UNREAD_COUNT(){
		global $connection;
		if($connection){
			$check = imap_mailboxmsginfo($connection);
			return $check ->Unread;
		}else{
			return 0;
		}
	}function GET_INBOX(){
		global $connection;
		$mail_check = imap_check($connection);
		return  imap_fetch_overview($connection,"1:{$mail_check->Nmsgs}",0);

	}
	function GET_NEW_EMAIL_HEADERS(){
		global $connection;
		$email_headers = array();
		$inbox = NCG_EMAILS::GET_INBOX();
		foreach ($inbox as $message) {
    		if(!$message->seen){
    			$header_text ="";
    			$char_sets = imap_mime_header_decode($message->subject);
    			for ($x=0; $x<count($char_sets); $x++) {
    			    $header_text = $header_text.$char_sets[$x]->text;
    			}

          		$info = imap_headerinfo($connection,$message->msgno);
    			$header = array("sender" =>$message->from, "subject" =>$header_text, "mid" =>$message ->msgno, "from" =>$info->senderaddress);
    			array_push($email_headers, $header);
    		}
    	}

	return $email_headers;
	}
	function GET_NEW_EMAIL_HEADER($id){
		global $connection;
		return imap_header($connection, $id);
	}
	function GET_USER_MESSAGE($id){
		global $connection;
		$emailMessage = new NCG_EMAIL_MSG($connection, $id);
		$emailMessage->getAttachments = true;
		$emailMessage->FETCH_IMAP_STRUCTURE();
		return array("msg_body_plain_txt" =>$emailMessage->bodyHTML, "msg_body_html" =>$emailMessage->bodyHTML);
	}
}