<?php
	require("../core_functions/functions.php");
	echo json_encode(NCG_FUNCT::CHECK_P_NAME($_POST['pname']));