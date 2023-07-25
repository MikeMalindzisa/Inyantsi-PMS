<?php include "core_functions/functions.php";
NCG_FUNCT::INVALID_OUTBOUND_REDIRECT();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI REGISTER</title>
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
<body class="form" style="background-image: url(assets/img/cover.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    
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
                                <img src="assets/img/logo.png" class="img-fluid" alt="inyatsi logo" style="width: 80px;height: 80px;">
                            </a>
                        </div>
                        <p class="signup-link register">Already have an account? <a href="ncg_login">Login</a></p>
                        <center><p style="color: #ff0000;"><?php echo $m?></p></center>
                        <form class="text-left" method="post" action ="ncg_register">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">Full Name</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="" name="username" type="text" class="form-control" placeholder="Full name" required>
                                </div>
                                <input type="hidden" name="role" value="User">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="email-field" class="field-wrapper input">
                                            <label for="email">EMAIL</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail register"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                            
                                            <input id="email" name="email" type="email" value="" class="form-control" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="email-field" class="field-wrapper input">
                                            <label for="email">PHONE</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone register"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                            
                                            <input id="phone" name="phone" type="tel" value="" class="form-control" placeholder="Phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        
                                        <div id="password-field" class="field-wrapper input mb-2">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">RE-PASSWORD</label>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                            <input id="re-password" name="re-password" type="password" class="form-control" placeholder="Re-Password" required>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-re-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="field-wrapper terms_condition">
                                    <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-primary">
                                          <input type="checkbox" id="terms" onchange="control()" class="new-control-input" required>
                                          <span class="new-control-indicator"></span><span>I agree to the <a href="ncg_public_terms" target="_blank">  terms and conditions </a></span>
                                        </label>
                                    </div>
                                    <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-primary">
                                          <input type="checkbox" id="policy" onchange="control()" class="new-control-input" required>
                                          <span class="new-control-indicator"></span><span>I agree with the <a href="ncg_public_policy" target="_blank">  privacy policy </a></span>
                                        </label>
                                    </div>

                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" id="register-btn" name="register" style="display: none;" class="btn btn-primary" value="">Register</button>
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
    <script type="text/javascript">
        function control(){
            var terms = document.getElementById("terms");
            var policy = document.getElementById("policy");
            var reg = document.getElementById("register-btn");

            if(terms.checked == true && policy.checked == true){
                reg.style.display = "block";
            }else{
                reg.style.display = "none";
            }
        }
        
    </script>

</body>
</html>