<?php include "../core_functions/functions.php";
$img = "assets/img/logo.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link href="../mb-assets/img/logo.png" rel="icon" type="image/x-icon" />
    <link href="../mb-assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="../mb-assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../mb-assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../mb-assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="../mb-assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="../mb-assets/css/forms/switches.css">
    <link href="../mb-assets/css/pages/helpdesk.css" rel="stylesheet" type="text/css" />
</head>
<body class="form" style="background-image: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201440%20320%22%3E%3Cpath%20fill%3D%22%23273036%22%20fill-opacity%3D%221%22%20d%3D%22M0%2C0L60%2C21.3C120%2C43%2C240%2C85%2C360%2C101.3C480%2C117%2C600%2C107%2C720%2C96C840%2C85%2C960%2C75%2C1080%2C96C1200%2C117%2C1320%2C171%2C1380%2C197.3L1440%2C224L1440%2C320L1380%2C320C1320%2C320%2C1200%2C320%2C1080%2C320C960%2C320%2C840%2C320%2C720%2C320C600%2C320%2C480%2C320%2C360%2C320C240%2C320%2C120%2C320%2C60%2C320L0%2C320Z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: bottom;">>
    
    <?php 
        if(isset($_GET['m'])){
            $m = $_GET['m'];
        }else{
            $m = "";
        }?>
        <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content" style="width: 100%!important;">
                <center>
                    <img alt="INYATSI Logo" src="../assets/img/logo.png" width="60">
                </center>
                <center>
                    <h4 class="text-dark" style="margin-top: 15px;">Inyatsi Construction Group</h4>
                </center>
                <center>
                    <p style="color: #999; position: fixed; bottom: 0!important; width: 100%">poweredby <a href="https://outsourceszl.com" target="_blank" style="color:#ddd;">OUTSOURCE ESWATINI</a></p>
                </center>
                <center>
                    <div class="spinner-border spinner-border-reverse text-dark mt-5"></div>
                </center>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
<div class="form-container outer helpdesk">

        <nav class=" navbar navbar-expand navbar-light">
           <a class="navbar-brand" href="ncg_mb_psw_reset.php" style="width:70px; border-radius: 25px; background-color: #dddddd; padding-left: 4px; margin: 0px; height: 35px; line-height: 100%;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
              <img src="<?php echo "../".$img ?>" class="navbar-brand" style="width: 24px; height: 24px; border-radius: 24px; background-color: #999999; margin: 0px;">
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link ellipsis" href="ncg_mb_psw_reset.php">OTP Validation</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <div class="col-md-12 text-center" style="margin-top: 35px;">
                            <img src="../assets/img/logo.png" class="img-fluid" alt="logo" style="width: 100px; height: 100px;">
                            <p class="ps-reset"><span style="font-weight: bold;">Note:</span> Enter the code you recieved at <span style="font-weight: bolder;"><?php echo $_GET['email']?>.</span></p>
                        </div>
                        <center><p style="color: #ff0000;"><?php echo $m?></p></center>
                        <form class="text-left" method="post" action="ncg_mb_psw_reset_validate.php">
                            <div class="form">

                                <input type="hidden" name="email" value="<?=$_GET['email']?>">
                                <div id="affiliation-field" class="field-wrapper input mb-2">
                                    <input name="otp" type="text" class="form-control" placeholder="OTP" id="code">
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" name="mb-otp-validation">VALIDATE</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../mb-assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="../mb-assets/js/authentication/form-2.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#code").inputmask("9-9-9-9");
        });
    </script>

</body>
</html>