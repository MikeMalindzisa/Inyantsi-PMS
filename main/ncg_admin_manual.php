<?php include "core_functions/functions.php";
    if(isset($_GET['response'])){
            $response = $_GET['response'];
            $msg = $_GET['msg'];
            $html = $_GET['html'];
        }else{
            $response = "";
            $msg = "";
            $html = "";
        }
    if(isset($_SESSION['ncg-active'])){
        if($_SESSION['ncg-active']['ROLE'] != "Admin"){
            header("Location: ncg_manual");
            exit();
        }
    }else{
        header("Location: ncg_manual");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI - ADMINISTRATIVE MANUAL</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/manual.css" rel="stylesheet" type="text/css" /> 
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->     
</head>
<body class="sidebar-noneoverflow">

    <input type="hidden" id="message" value="<?php echo $msg?>">
    <input type="hidden" id="title" value="Frequently Asked Questions">
    <input type="hidden" id="response" value="<?php echo $response?>">
    <input type="hidden" id="html" value="<?php echo $html?>">
    <div class="fq-header-wrapper">
        <nav class="navbar navbar-expand" style="position: fixed; top: 0; width: 100%; background: rgb(0,0,0,0.5); height: 75px; z-index: 999">
            <div class="container">
                <a class="navbar-brand" href="index"><img src="assets/img/ww_logo.png" width="70" class="navbar-logo" alt="INYATSI" style="padding: 10px;"></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ncg_manual" style="border-bottom: 3px solid #fff; border-radius: 0;">Admin Manual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ncg_public_terms">Terms &amp; Conditions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ncg_public_policy">Privacy Policy</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="faqs">FAQs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="padding-top: 79px!important;">
            <div class="row">
                <div class="col-md-6 align-self-center order-md-0 order-1">
                    <h1 class="">ADMINISTRAATIVE SYSTEM MANUAL</h1>
                    <p class="">For all non-administrative functions, please use the User manual.</p>
                    <a class="btn" href="ncg_manual">User Manual</a>
                </div>
                <div class="col-md-6 order-md-0 order-0">
                        <img src="assets/img/faq.svg" class="d-block" alt="header-image">
                </div>
            </div>
        </div>
    </div>

    <div class="faq container">

        <div class="faq-layouting layout-spacing">


            <div class="fq-comman-question-wrapper" id="tbl-content">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Table of contents</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="">
                                    <a href="#requirementsCard" onclick="setSize('requirementsCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#requirementsCol" aria-expanded="false" aria-controls="requirementsCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Requirements
                                        </li>
                                    </a>
                                    <a href="#registrationCard" onclick="setSize('registrationCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#registrationCol" aria-expanded="false" aria-controls="registrationCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Init Setup
                                        </li>
                                    </a>
                                    <a href="#recoveryCard" onclick="setSize('recoveryCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#recoveryCol" aria-expanded="false" aria-controls="recoveryCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Security Groups
                                        </li>
                                    </a>

                                    <a href="#loginCard" onclick="setSize('loginCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#loginCol" aria-expanded="false" aria-controls="loginCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            External User Management
                                        </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="">
                                    <a href="#profileCard" onclick="setSize('profileCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#profileCol" aria-expanded="false" aria-controls="profileCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Internal User Management
                                        </li>
                                    </a>
                                    <a href="#clientsCard" onclick="setSize('clientsCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#clientsCol" aria-expanded="false" aria-controls="clientsCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Inyatsi Customers
                                        </li>
                                    </a>
                                    <a href="#projectsCard" onclick="setSize('projectsCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#projectsCol" aria-expanded="false" aria-controls="projectsCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Inyatsi Customer Projects
                                        </li>
                                    </a>
                                    <a href="#faqsCard" onclick="setSize('faqsCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#faqsCol" aria-expanded="false" aria-controls="faqsCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            FAQs
                                        </li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fq-tab-section">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="accordionExample" >
                            <div  id="requirementsCard" class="mg-con"></div>
                            <h2>Internal User Manual</h2>
                            <div class="card">
                                <div class="card-header" id="requirementsHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#requirementsCol" aria-expanded="false" aria-controls="requirementsCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Requirements</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="requirementsCol" class="collapse" aria-labelledby="requirementsHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <h4 class="text-white">System Requirements</h4>
                                        <hr>
                                        <p>Laptop / Desktop Computer</p>
                                        <p>Web Browser (Google Chrome, Microsoft Edge, Safari, Mozilla Firefox are recommended)</p>
                                        <p>Internet Connectivity</p>
                                        <br>
                                        <h4 class="text-white">User Requirements</h4>
                                        <hr>
                                        <p>Valid Email Address</p>
                                        <p><a href="ncg_public_terms" class="link" target="_blank">Terms &amp; Condition</a>, <a href="ncg_public_policy" class="link" target="_blank">Privacy Policy </a>Consent</p>
                                    </div>
                                </div>
                            </div>
                            <div  id="registrationCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="registrationHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#registrationCol" aria-expanded="false" aria-controls="registrationCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Creating an Account</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="registrationCol" class="collapse" aria-labelledby="registrationHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>To create an account, open the <a class="link" href="ncg_register" target="_blank">Registration link</a> and follow the form instructions. Fill all the required fields. After you have accepted the <a class="link" href="ncg_public_terms" target="_blank">Terms &amp; Conditions</a> and have read, understood and accepted the <a href="ncg_public_policy" class="link" target="_blank">Privacy Policy</a>, you can then proceed to register by clicking to register button.</p>
                                        <br>
                                        <p>You will receive and email after your account has been validated and activated then you can start using your account.</p>

                                        <br>
                                        
                                        <p class="text-white" data-toggle="collapse" role="navigation" data-target="#loginCol" aria-expanded="false" aria-controls="loginCol">See also <a href="#loginCard" class="link" onclick="setSize('loginCard')">User Login</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="recoveryCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="recoveryHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#recoveryCol" aria-expanded="false" aria-controls="recoveryCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Account Recovery</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg> </div>
                                    </div>
                                </div>
                                <div id="recoveryCol" class="collapse" aria-labelledby="recoveryHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>In the <a class="link" href="ncg_login" target="_blank">Login Page</a>, click <strong>Reset password</strong>. Provide your registered email address and click the <strong>Reset</strong> button. You will be redirected to an account verification page and receive via email both a One Time Pin (OTP) for manual account verfication and a link for to follow for automatic account verification.</p>
                                        <br>
                                        <h5 class="text-white">Manual OTP Verification</h5>
                                        <p>Enter the received OTP into the redirect page where it says OTP. Click Verify</p>
                                        <p>If verification is successful, you will be redirected to a new password setup page where you will be able to set your new desired password.</p>
                                        <br>
                                        <h5 class="text-white">Automatic Link Verification</h5>
                                        <p>In the password reset instructions email sent, click on <strong>Follow Link</strong></p>
                                        <p>You will be redirected to a new password setup page where you will be able to set your new desired password.</p>
                                        <hr>
                                        <p><strong>*Both the Link and OTP are only valid for <span style="color: #ff0000;">2 Hours</span></strong></p>
                                        <p><strong>*Contact Inyatsi It support if you have forgotten or have no access to your email account <span style="color: #ff0000;">Inyatsi Managed Emails Only</span></strong></p>
                                         <br>
                                         <p class="text-white" data-toggle="collapse" role="navigation" data-target="#registrationCol" aria-expanded="false" aria-controls="registrationCol">See also <a href="#registrationCard" class="link" onclick="setSize('registrationCard')">Account Registration</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="loginCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="loginHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#loginCol" aria-expanded="false" aria-controls="loginCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">User Login</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="loginCol" class="collapse" aria-labelledby="loginHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>If you have a registered and activated account you can follow the <a class="link" href="ncg_login">Login Link</a>.</p>
                                        <p>If after you login, you are redirected to an inactive account page, contact Inyatsi It support to have your account activated.</p>

                                         <br>
                                         <hr>
                                         <p class="text-white" data-toggle="collapse" role="navigation" data-target="#recoveryCol" aria-expanded="false" aria-controls="recoveryCol">See also <a href="#recoveryCard" class="link" onclick="setSize('recoveryCard')">Account Recovery</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="profileCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="profileHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#profileCol" aria-expanded="false" aria-controls="profileCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">User Profile</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> </div>
                                    </div>
                                </div>
                                <div id="profileCol" class="collapse" aria-labelledby="profileHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Under User Profile, you can update your professional information, change account password and other account related information. To update that, click on the <a  href="javascript:void(0);" class="btn btn-dark mb-2 mr-2 rounded-circle" > <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a> button at the top right corner.</p>
                                        <p>Under User Profile, you can also find a list of projects you are assigned to.</p>
                                        <hr> <br>
                                        <p class="text-white" data-toggle="collapse" role="navigation" data-target="#projectsCol" aria-expanded="false" aria-controls="projectsCol">See also <a href="#projectsCard" class="link" onclick="setSize('projectsCard')">Inyatsi Customer Projects</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="clientsCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="clientsHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#clientsCol" aria-expanded="false" aria-controls="clientsCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Inyatsi Customers</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> </div>
                                    </div>
                                </div>
                                <div id="clientsCol" class="collapse" aria-labelledby="clientsHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>In the Inyatsi Customers Page, you can find, add or view Customers when a user has create, read, update, delete permissions respectively.</p>
                                        <br>
                                        <a class="btn btn-primary" href="ncg_customer_mgt_manual">Read More</a>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#projectsCol" aria-expanded="false" aria-controls="projectsCol">See also <a href="#projectsCard" class="link" onclick="setSize('projectsCard')">Inyatsi Customer Projects</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="projectsCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="projectsHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#projectsCol" aria-expanded="false" aria-controls="projectsCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Inyatsi Customer Projects</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> </div>
                                    </div>
                                </div>
                                <div id="projectsCol" class="collapse" aria-labelledby="projectsHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>To add, view, update, delete customer projects, a user has to have Create, Read, Update, Delete permissions respectively also must be assigned to a project.</p>
                                        <br>
                                        <a class="btn btn-primary" href="ncg_projects_manual">Read More</a>
                                        <hr>
                                         <br>
                                         <p class="text-white" data-toggle="collapse" role="navigation" data-target="#clientsCol" aria-expanded="false" aria-controls="clientsCol">See also <a href="#clientsCard" class="link" onclick="setSize('clientsCard')">Inyatsi Customers</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="faqsCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="faqsHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#faqsCol" aria-expanded="false" aria-controls="faqsCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">FAQs</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="faqsCol" class="collapse" aria-labelledby="faqsHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Are you not finding what you are looking for in the manual? Read our <a href="#" class="link">FAQs </a>or ask your question, Inyatsi IT Support would be happy to assist you.</p>
                                        <br>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-md-6 col-6">
                                                <a href="faqs" class="btn btn-primary">Read FAQs</a>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-md-6 col-6">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#askFaq" class="btn btn-primary" style="float: right;">Ask A Question</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                            
            </div>

            <div class="fq-article-section">
                <h2>Frequently Asked Questions</h2>
                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-lg-0 mb-4 mt-5" >
                        <div class="card" style="height: 240px!important;">
                            <div class="card-body">
                                <h5 class="card-title">Manage FAQs</h5>
                                <p class="card-text">Respond to newly asked questions, update existing answeres or remove some questions from broadcast.</p>
                                <hr>
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt"    style="bottom:0!important;"><svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg> Manage</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="assets/js/pages/faq/faq.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script type="text/javascript">
        function setSize(id){
            $('.mg-con').removeClass('margin-control');
            $('#'+id).addClass('margin-control');
        }
    </script>

    <script type="text/javascript">
        $( document ).ready(function(){
            var msg = document.getElementById("message").value;
            var response = document.getElementById("response").value;
            var title = document.getElementById("title").value;
            var html = document.getElementById("html").value;
            if(response !== ""){
                notify(msg, response, title, html);
            }
        });  
        function notify(msg, type, title, html){
            swal({
                  title: title,
                  type: type,
                  html: msg + html,
                  padding: '2em'
                });
        }
    </script>
    <script type="text/javascript">

        function rate(data){
            var idString = data.split("-");
            var faq_id = idString[1];
            var id = idString[0];
            document.getElementById("rating-"+faq_id).style.display = "none";
           var rate = 0;
            switch(id){
                case "one":
                    rate = 1;
                break;
                case "two":
                    rate = 2;
                break;
                case "three":
                    rate = 3;
                break;
                case "four":
                    rate = 4;
                break;
                case "five":
                    rate = 5;
                break;
            }
             $.post("core_functions/faq_rating.php", {"rate":rate, "id":faq_id},function(data,status){
                var res_data = JSON.parse(data);
                if(res_data == false){
                    swal({
                        type: 'warning',
                        title:'FAQ Rating',
                        text: 'Sorry, an error occured while trying to handle your request. Please trying again later.',
                        padding: '2em'
                      });            
                }else{
                    swal({
                        type: 'success',
                        title:'FAQ Rating',
                        text: 'Thank you for improving our system, your feedback is important to us.',
                        padding: '2em'
                      })
                }
            });
        }
    </script>
</body>
</html>