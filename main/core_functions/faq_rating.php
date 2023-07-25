<?php require("../core_functions/functions.php");
$_rate = $_POST['rate'];
$_faq_id = $_POST['id'];
$request = array("rate" =>$_rate, "id" =>$_faq_id);
echo json_encode(NCG_FUNCT::RATE_FAQ($request));