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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI - PROJECTS MANAGEMENT MANUAL</title>
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
                            <a class="nav-link" href="ncg_manual" style="border-bottom: 3px solid #fff; border-radius: 0;">User Manual</a>
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
                    <h1 class="">INYATSI CUSTOMER PROJECTS MANAGEMENT MANUAL</h1>
                    <a class="btn" href="ncg_manual">Back</a>
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
                                    <a href="#pviewCard" onclick="setSize('pviewCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#pviewCol" aria-expanded="false" aria-controls="pviewCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Viewing Projects
                                        </li>
                                    </a>
                                    <a href="#pcreateCard" onclick="setSize('pcreateCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#pcreateCol" aria-expanded="false" aria-controls="pcreateCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Project Creation
                                        </li>
                                    </a>
                                    <a href="#vaddCard" onclick="setSize('vaddCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#vaddCol" aria-expanded="false" aria-controls="vaddCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Adding Variation Orders
                                        </li>
                                    </a>

                                    <a href="#veditCard" onclick="setSize('veditCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#veditCol" aria-expanded="false" aria-controls="veditCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Editing Variation Orders
                                        </li>
                                    </a>

                                    <a href="#vdeleteCard" onclick="setSize('vdeleteCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#vdeleteCol" aria-expanded="false" aria-controls="vdeleteCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Deleting Variation Orders
                                        </li>
                                    </a>
                                    <a href="#pstartCard" onclick="setSize('pstartCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#pstartCol" aria-expanded="false" aria-controls="pstartCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            New Project Start Date
                                        </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="">
                                    <a href="#pdeliveryCard" onclick="setSize('pdeliveryCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#pdeliveryCol" aria-expanded="false" aria-controls="pdeliveryCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            New Project Delivery Date
                                        </li>
                                    </a>
                                    <a href="#paycertAddCard" onclick="setSize('paycertAddCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#paycertAddCol" aria-expanded="false" aria-controls="paycertAddCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Adding Payment Certificates
                                        </li>
                                    </a>
                                    <a href="#paycertEditCard" onclick="setSize('paycertEditCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#paycertEditCol" aria-expanded="false" aria-controls="paycertEditCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Editing Payment Certificates
                                        </li>
                                    </a>
                                    <a href="#paycertDeleteCard" onclick="setSize('paycertDeleteCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#paycertDeleteCol" aria-expanded="false" aria-controls="paycertDeleteCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Deleting Payment Cetificates
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
                            <div  id="pviewCard" class="mg-con"></div>
                            <h2>Internal User Manual (Inyatsi Customer Projects)</h2>
                            <div class="card">
                                <div class="card-header" id="pviewHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#pviewCol" aria-expanded="false" aria-controls="pviewCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Viewing Projects</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="pviewCol" class="collapse" aria-labelledby="pviewHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>A user can view project assigned to that specific user.</p>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read (R)</strong> permissions can view projects.</p>
                                        <br>
                                        <p class="text-white" data-toggle="collapse" role="navigation" data-target="#pcreateCol" aria-expanded="false" aria-controls="pcreateCol">See also <a href="#pcreateCard" class="link" onclick="setSize('pcreateCard')">Project Creation</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="pcreateCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="pcreateHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#pcreateCol" aria-expanded="false" aria-controls="pcreateCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Project Creation</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="pcreateCol" class="collapse" aria-labelledby="pcreateHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>For a logged in user, to create a project, open the <a class="link" href="ncg_projects" target="_blank">Projects link</a> and click the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></a> button. Fill all the required fields. Then proceed to create project by clicking the Save button.</p>
                                        <p>A feedback prompt will show respective to project creation success, finish with warnings and failure.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins and customer contact person will receive New Project creation email containing project information and who created it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Write (C)</strong> permissions can create a new project.</p>

                                        <br>
                                        <p class="text-white" data-toggle="collapse" role="navigation" data-target="#pviewCol" aria-expanded="false" aria-controls="pviewCol">See also <a href="#pviewCard" class="link" onclick="setSize('pviewCard')">Viewing Projects</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="vaddCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="vaddHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#vaddCol" aria-expanded="false" aria-controls="vaddCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Adding Variation Orders</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="vaddCol" class="collapse" aria-labelledby="vaddHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>- For a logged in user, to add a variation order, open the <a class="link" href="ncg_projects" target="_blank">Projects link</a>.</p>
                                        <p>Select the project you wish to add a variation order for by clicking the View Action button.</p>
                                        <p>- In the project information page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Variation Orders</a> Tab.</p>
                                        <p>- Click the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New VO</a> button and fill all the fields then click the Save button.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins, customer contact person and Users assigned to the project will receive New Variation Order creation email containing variation order information and who created it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read &amp; Write (CR)</strong> permissions can view and create a new variaiton order.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#veditCol" aria-expanded="false" aria-controls="veditCol">See also <a href="#veditCard" class="link" onclick="setSize('veditCard')">Editing Variation Orders</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="veditCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="veditHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#veditCol" aria-expanded="false" aria-controls="veditCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Editing Variation Orders</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="veditCol" class="collapse" aria-labelledby="veditHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                         <p>- For a logged in user, to edit a variation order, open the <a class="link" href="ncg_projects" target="_blank">Projects link</a>.</p>
                                        <p>Select the project you wish to edit a variation order for by clicking the View Action button.</p>
                                        <p>- In the project information page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Variation Orders</a> Tab.</p>
                                        <p>- Select the variation order you wish to edit by clicking the View Action button</p>
                                        <p>- Click on the <a  href="javascript:void(0);" class="btn btn-warning mb-2 mr-2 btn-rounded">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="color: #FFFFFF; fill: transparent;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>  Edit</a> button, fill out the opened form accordingly the save.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins, customer contact person and Users assigned to the project will receive New Variation Order update email containing variation order update information and who updated it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read, Write or Update(CRU)</strong> permissions can view and update/edit a variaiton order.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#vdeleteCol" aria-expanded="false" aria-controls="vdeleteCol">See also <a href="#vdeleteCard" class="link" onclick="setSize('vdeleteCard')">Deleting Variation Orders</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="vdeleteCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="vdeleteHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#vdeleteCol" aria-expanded="false" aria-controls="profileCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Deleting Variation Orders</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="vdeleteCol" class="collapse" aria-labelledby="vdeleteHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>To delete a variation Order, In the project information page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Variation Orders</a> Tab.</p>
                                        <p>- Select the variation order you wish to delete by clicking the View Action button</p>
                                        <p>- Click on the <button class="btn btn-danger mb-2 mr-2 btn-rounded"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash" style="color: #FFFFFF; fill: transparent;">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>  Delete
                                        </button> button, and confirm Variation order deletion.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins, customer contact person and Users assigned to the project will receive Variation Order deletion email containing variation order information and who deleted it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Delete (D)</strong> permissions can delete a variaiton order.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#veditCol" aria-expanded="false" aria-controls="veditCol">See also <a href="#veditCard" class="link" onclick="setSize('veditCard')">Editing Variation Orders</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="pstartCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="pstartHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#pstartCol" aria-expanded="false" aria-controls="pstartCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">New Project Start Date</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="pstartCol" class="collapse" aria-labelledby="pstartHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>To add a new project start date, in the <strong>Project Information</strong> page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Project Dates</a> tab.</p>
                                        <p>Click on the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New  Date</a></p>
                                        <p>- Select <strong>Start Date</strong> from the
                                            <div class="col-sm-4">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="basic-addon5">Update On</span>
                                             </div>
                                             <select class="form-control" name="action">
                                                 <option value="" disabled>Select</option>
                                                 <option value="start" selected>Start Date</option>
                                                 <option value="end" disabled>End Date</option>
                                             </select>
                                           </div>
                                       </div> option menu.</p>
                                       <p>Fill out the form and Save.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#pdeliveryCol" aria-expanded="false" aria-controls="pdeliveryCol">See also <a href="#pdeliveryCard" class="link" onclick="setSize('pdeliveryCard')">New Poject Delivery Date</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="pdeliveryCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="pdeliveryHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#pdeliveryCol" aria-expanded="false" aria-controls="pdeliveryCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">New Project Delivery Date</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="pdeliveryCol" class="collapse" aria-labelledby="pdeliveryHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>To add a new project delivery date, in the <strong>Project Information</strong> page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Project Dates</a> tab.</p>
                                        <p>Click on the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New  Date</a></p>
                                        <p>- Select <strong>End Date</strong> from the
                                            <div class="col-sm-4">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="basic-addon5">Update On</span>
                                             </div>
                                             <select class="form-control" name="action">
                                                 <option value="" disabled>Select</option>
                                                 <option value="start" disabled>Start Date</option>
                                                 <option value="end" selected>End Date</option>
                                             </select>
                                           </div>
                                       </div> option menu.</p>
                                       <p>Fill out the form and Save.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#pstartCol" aria-expanded="false" aria-controls="pstartCol">See also <a href="#pstartCard" class="link" onclick="setSize('pstartCard')">New Poject Start Date</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="paycertAddCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="paycertAddHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#paycertAddCol" aria-expanded="false" aria-controls="paycertAddCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Adding Payment Certificates</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="paycertAddCol" class="collapse" aria-labelledby="paycertAddHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                         <p>- For a logged in user, to add a payment certificate, open the <a class="link" href="ncg_projects" target="_blank">Projects link</a>.</p>
                                        <p>Select the project you wish to add a payment certificate for by clicking the View Action button.</p>
                                        <p>- In the project information page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg> Payment Certificates</a> Tab.</p>
                                        <p>- Click the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Payment Certificate</a> button and fill all the fields then click the Save button.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins, customer contact person and Users assigned to the project will receive New Payment Certificate creation email containing Payment Certificate information and who created it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read &amp; Write (CR)</strong> permissions can view and create a new payment certificate.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#paycertEditCol" aria-expanded="false" aria-controls="paycertEditCol">See also <a href="#paycertEditCard" class="link" onclick="setSize('paycertEditCard')">Editing Payment Certificate</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="paycertEditCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="paycertEditHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#paycertEditCol" aria-expanded="false" aria-controls="paycertEditCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Editing Payment Certificates</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="paycertEditCol" class="collapse" aria-labelledby="paycertEditHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>- For a logged in user, to edit a Payment Certificate, open the <a class="link" href="ncg_projects" target="_blank">Projects link</a>.</p>
                                        <p>Select the project you wish to edit a Payment Certificate for by clicking the View Action button.</p>
                                        <p>- In the project information page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg> Payment Certificates</a> Tab.</p>
                                        <p>- Select the payment certificate you wish to edit by clicking the View Action button</p>
                                        <p>- Click on the <a  href="javascript:void(0);" class="btn btn-warning mb-2 mr-2 btn-rounded">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="color: #FFFFFF; fill: transparent;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>  Edit</a> button, fill out the opened form accordingly the save.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins, customer contact person and Users assigned to the project will receive Payment Certificate update email containing payment old and new payment certificate information and who updated it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read, Write or Update(CRU)</strong> permissions can view and update/edit a payment certificate.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#paycertDeleteCol" aria-expanded="false" aria-controls="paycertDeleteCol">See also <a href="#paycertDeleteCard" class="link" onclick="setSize('paycertDeleteCard')">Deleting Payment Certificates</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="paycertDeleteCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="paycertDeleteHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#paycertDeleteCol" aria-expanded="false" aria-controls="paycertDeleteCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Deleting Payment Certificates</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="paycertDeleteCol" class="collapse" aria-labelledby="paycertDeleteHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>To delete a payment certificate, In the project information page, switch to the <a href="javascript:void(0);" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg> Payment Certificates</a> Tab.</p>
                                        <p>- Select the payment certificate you wish to delete by clicking the View Action button</p>
                                        <p>- Click on the <button class="btn btn-danger mb-2 mr-2 btn-rounded"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash" style="color: #FFFFFF; fill: transparent;">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>  Delete
                                        </button> button, and confirm payment certificate deletion.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins, customer contact person and Users assigned to the project will receive payment certificate deletion email containing payment certificate information and who deleted it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Delete (D)</strong> permissions can delete a payment certificate.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#paycertEditCol" aria-expanded="false" aria-controls="paycertEditCol">See also <a href="#paycertEditCard" class="link" onclick="setSize('paycertEditCard')">Editing Payment Certificates</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                            
            </div>
            <div class="modal fade modal-notification" id="askFaq" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_projects_manual">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Ask your question</h4>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon5">Relation</span>
                                        </div>
                                         <select class="form-control" name="faq-class" required>
                                            <option value="">Select</option>
                                            <option value="User Accounts">User Accounts</option>
                                            <option value="User Permissions">User Permissions</option>
                                            <option value="Inyatsi Customers">Inyatsi Customers</option>
                                            <option value="Inyatsi Customer Projects">Inyatsi Customer Projects</option>
                                            <option value="variations">Project Variation Orders</option>
                                            <option value="Project Variation Orders">Project Payment Certificates</option>
                                            <option value="Project Dates">Project Dates</option>
                                            <option value="Technical Issues">Technical Issues</option>
                                            <option value="Miscellaneous Questions">Other</option>
                                        </select>
                                      </div>
                                    </div>
                                    <?php
                                        if(isset($_SESSION['ncg-active'])){?>
                                            <input type="hidden" name="user-email" value="<?= $_SESSION['ncg-active']['W_EMAIL']?>">
                                        <?php }else{?>
                                            <div class="col-sm-12">
                                                <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon5">Email Address</span>
                                                </div>
                                                <input type="email" name="user-email" required placeholder="Email address...">
                                              </div>
                                            </div>
                                        <?php }?>
                                    
                                  </div>
                                  <div class="row">
                                 <div class="col-lg-12">
                                    <input type="hidden" name="from" value="ncg_projects_manual.php">
                                   <textarea aria-label="Question" rows="6" required name="faq-question" class="form-control" placeholder="What is your question?"></textarea>
                                 </div>
                                </div>
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="ask-question">Submit</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
            <div class="fq-article-section">
                <h2>Frequently Asked Questions</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-lg-0 mb-4 mt-5" >
                        <div class="card" style="height: 240px!important;">
                            <div class="card-body">
                                <h5 class="card-title">Different Question?</h5>
                                <p class="card-text">Response to your question may not be instant. For fast response, contact the Inyatsi IT Support Office else read the user manual.</p>
                                <hr>
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" data-toggle="modal" data-target="#askFaq"   style="margin-bottom:-20px!important;"><svg style="float: left;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> Ask Now</a>
                            </div>
                        </div>
                    </div>
                   <?php
                    $faqs = NCG_FUNCT::GET_BROADCAST_FAQS();
                    while($faq = $faqs ->fetch_assoc()){?>
                    <div class="col-lg-3 col-md-6 mb-lg-0 mb-4 mt-5">
                        <div class="card" style="height: 240px!important;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $faq['FAQ_CLASS']?></h5>
                                <div class="fq-rating">
                                    <?php
                                        if($faq['FAQ_RATED'] == 0){
                                        $rating = 0;
                                        }else{
                                            $rating = $faq['FAQ_RATING']/$faq['FAQ_RATED'];
                                        }
                                        $rating = number_format($rating, "0",".",",");
                                        for($i=1; $i<=5; $i++){
                                            if($i<= $rating){?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FEAC01" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star checked"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <?php }else{?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#999" stroke="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <?php }
                                        }?>
                                </div>
                                <p class="card-text faq-ellipsis" style="max-width: 210px;overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><?= $faq['FAQ_QUESTION']?></p>
                                <p class="meta-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> <?= date("d M Y ", strtotime($faq['TIMESTAMP']))?></p>
                                <hr>
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" data-toggle="modal" data-target="#faq-<?=$faq['REC_ID']?>"   style="margin-bottom:-50px!important;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade modal-notification" id="faq-<?=$faq['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4><?=$faq['FAQ_CLASS']?></h4>
                                  <br>
                                  <h5>Question</h5>
                                  <p><?=$faq['FAQ_QUESTION']?></p>
                                  <hr>
                                  <h5>Answer</h5>
                                  <p><?=$faq['FAQ_ANSWER']?></p>


                               </div>
                              <div class="modal-footer justify-content-between">
                                <p><?= date("d M Y ", strtotime($faq['TIMESTAMP']))?></p>
                                <div class="n-chk" id="rating-<?=$faq['REC_ID']?>">
                                    <strong>Rate Answer </strong>
                                   <svg id="one-<?=$faq['REC_ID']?>" onclick="rate(this.id)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ddd" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;" class="rate-btn feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                   <svg id="two-<?=$faq['REC_ID']?>" onclick="rate(this.id)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ddd" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;" class="rate-btn feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                   <svg id="three-<?=$faq['REC_ID']?>" onclick="rate(this.id)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ddd" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;" class="rate-btn feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                   <svg id="four-<?=$faq['REC_ID']?>" onclick="rate(this.id)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ddd" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;" class="rate-btn feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                   <svg id="five-<?=$faq['REC_ID']?>" onclick="rate(this.id)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ddd" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;" class="rate-btn feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </div>
                                <button class="btn" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                <?php }?>
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