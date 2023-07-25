<?php include "core_functions/functions.php";
NCG_FUNCT::INVALID_OUTBOUND_REDIRECT();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI PASSWORD RECOVERY</title>
    <link href="assets/img/logo.png" rel="icon" type="image/x-icon" />
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>
<body lass="form" style="background-image: url(assets/img/cover.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    
     <?php 
        if(isset($_GET['m'])){
            $m = $_GET['m'];
        }else{
            $m = "";
        }?>

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <div class="col-md-12 col-sm-12 col-12 text-center mb-5">
                            <a href="https://inyatsi.co.sz" target="_blank" class="navbar-brand-privacy">
                                <img src="assets/img/logo.png" class="img-fluid" alt="logo" style="width: 80px;height: 80px;">
                            </a>
                        <h4 class="signup-link recovery">Password Recovery</h4>
                        
                        <p class="signup-link register">Already have an account? <a href="ncg_login">Login</a></p>
                        <center><p style="color: #ff0000;"><?php echo $m?></p></center>
                        </div>

                        <form class="text-left" method="post" action="ncg_pass_recovery" >
                            <p >Enter your registered email and password reset instructions will sent to you!</p>
                            <div class="form">

                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">EMAIL</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    <input name="email" type="email" class="form-control" placeholder="Email">
                                </div>

                                <div class="d-sm-flex justify-content-between">

                                    <div class="field-wrapper">
                                        <input type="submit" class="btn btn-primary" name="psw-recovery" value="Reset">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="link"><a href="ncg_manual" target="_blank" style="font-size: 11px!important;">User Manual</a></p>        
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="link"><a href="ncg_public_terms" target="_blank" style="font-size: 11px!important;">Terms &amp; Conditions</a></p>        
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="link"><a href="ncg_public_policy" target="_blank" style="font-size: 11px!important;">Privacy Policy</a></p>        
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="link"><a href="faqs" target="_blank" style="font-size: 11px!important;">FAQs</a></p>        
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
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>

</body>
</html>