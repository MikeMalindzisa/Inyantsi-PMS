<?php
	require("../core_functions/functions.php");
	echo json_encode(NCG_FUNCT::CHECK_C_NAME($_POST['cname']));