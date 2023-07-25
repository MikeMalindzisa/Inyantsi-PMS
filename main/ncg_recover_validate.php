<?php include "core_functions/functions.php";
NCG_FUNCT::INVALID_OUTBOUND_REDIRECT();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI PASSWORD RECOVERY AUTH</title>
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
                        <br>
                        <br>
                        <br>
                        <h4 class="signup-link recovery">Password Recovery Auth</h4>
                        <center><p style="color: #ff0000;"><?php echo $m?></p>
                            <?php 
                                if(isset($_GET['m'])){
                                    $a = "new-request=".$_GET['email']."&control=control";
                                    $b = NCG_FUNCT::MAKE_DIRTY($a);
                                    echo "<p class='text-dark'><a href='ncg_recover_validate?xyz={$b}'>Request OTP</a></p>";
                                }
                                ?>
                        </center>
                        </div>
                        <?php 
                            if(isset($_GET['token'])){
                                $res = NCG_FUNCT::GET_TOKEN_VALIDATION($_GET['token']); 
                                if($res['USER_ID'] = $_GET['email']){
                                    $x = "email=".$res['USER_ID']."&control=control";
                                    $y = NCG_FUNCT::MAKE_DIRTY($x);
                                    header("Location: ncg_new_pass.php?xyz=".$y);
                                    exit(); 
                                }
                                ?>
                                <center>
                                    <div class="spinner-border spinner-border-reverse align-self-center text-dark"></div>
                                </center>
                                <center><p class="text-dark">Please wait...</p></center>

                            <?php } else{?>
                        <form class="text-left" action="ncg_recover_validate" method="post">
                            <p >Enter the OTP sent to <strong><?=$_GET['email']?></strong></p>
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="pass">OTP</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="token-mask" type="text" class="form-control" placeholder="" name="otp">
                                </div>
                                <input type="hidden" name="email" value="<?=$_GET['email']?>">
                                <div class="d-sm-flex justify-content-between">

                                    <div class="field-wrapper">
                                        <button type="submit" name="otp-verification" class="btn btn-primary">Verify</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    <?php }?>
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
    <script src="plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
       <script type="text/javascript">
           $(document).ready(function(){
               $("#token-mask").inputmask("9-9-9-9");
           });
       </script>
</body>
</html>