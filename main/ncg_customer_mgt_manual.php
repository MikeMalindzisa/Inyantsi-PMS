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
    <title>INYATSI - CUSTOMER MANAGEMENT MANUAL</title>
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
                    <h1 class="">INYATSI CUSTOMERS MANAGEMENT MANUAL</h1>
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
                                    <a href="#cviewCard" onclick="setSize('cviewCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#cviewCol" aria-expanded="false" aria-controls="cviewCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Viewing Customers
                                        </li>
                                    </a>
                                    <a href="#ccreateCard" onclick="setSize('ccreateCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#ccreateCol" aria-expanded="false" aria-controls="ccreateCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Customer Creation
                                        </li>
                                    </a>
                                    <a href="#ccaddCard" onclick="setSize('ccaddCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#ccaddCol" aria-expanded="false" aria-controls="ccaddCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Adding Customer Contacts
                                        </li>
                                    </a>

                                    <a href="#cceditCard" onclick="setSize('cceditCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#cceditCol" aria-expanded="false" aria-controls="cceditCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Editing Customer Contacts
                                        </li>
                                    </a>

                                    <a href="#ccdeleteCard" onclick="setSize('ccdeleteCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#ccdeleteCol" aria-expanded="false" aria-controls="ccdeleteCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Deleting Customer Contacts
                                        </li>
                                    </a>
                                    <a href="#caaddCard" onclick="setSize('caaddCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#caaddCol" aria-expanded="false" aria-controls="caaddCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Adding Customer Addresses
                                        </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="">
                                    <a href="#caeditCard" onclick="setSize('caeditCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#caeditCol" aria-expanded="false" aria-controls="caeditCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Editing Customer Addresses
                                        </li>
                                    </a>
                                    <a href="#cadeleteCard" onclick="setSize('cadeleteCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#cadeleteCol" aria-expanded="false" aria-controls="cadeleteCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Deleting Customer Addresses
                                        </li>
                                    </a>
                                    <a href="#cpviewCard" onclick="setSize('cpviewCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#cpviewCol" aria-expanded="false" aria-controls="cpviewCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Viewing Customer Projects
                                        </li>
                                    </a>
                                    <a href="#clogoCard" onclick="setSize('clogoCard')">
                                        <li class="list-unstyled" data-toggle="collapse" role="navigation" data-target="#clogoCol" aria-expanded="false" aria-controls="clogoCol">
                                            <div class="icon-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                            Adding Customer Logo
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
                            <div  id="cviewCard" class="mg-con"></div>
                            <h2>Internal User Manual (Inyatsi Customer Management)</h2>
                            <div class="card">
                                <div class="card-header" id="cviewHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#cviewCol" aria-expanded="false" aria-controls="cviewCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Viewing Customers</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="cviewCol" class="collapse" aria-labelledby="cviewHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>After you login, from the navigation panel on the left, select Customers.</p>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read (R)</strong> permissions can view customers.</p>
                                        <br>
                                        <p class="text-white" data-toggle="collapse" role="navigation" data-target="#ccreateCol" aria-expanded="false" aria-controls="ccreateCol">See also <a href="#ccreateCard" class="link" onclick="setSize('ccreateCard')">Customer Creation</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="ccreateCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="ccreateHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#ccreateCol" aria-expanded="false" aria-controls="ccreateCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Customer Creation</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="ccreateCol" class="collapse" aria-labelledby="ccreateHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>For a logged in user, to create aadd/create a new customer, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a> and click the <a class="btn btn-primary" href="javascript:void(0);">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                        </a> button. Fill all the required fields. Then proceed to create customer by clicking the Save button.</p>
                                        <p>A feedback prompt will show respective to customer creation success, finish with warnings and failure.</p>
                                        <br>
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> System Admins and customer contact person (if email was added) will receive New Customer creation email containing customer information and who created it.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Write (C)</strong> permissions can create a new customer.</p>

                                        <br>
                                        <p class="text-white" data-toggle="collapse" role="navigation" data-target="#cviewCol" aria-expanded="false" aria-controls="cviewCol">See also <a href="#cviewCard" class="link" onclick="setSize('cviewCard')">Viewing Customers</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="ccaddCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="ccaddHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#ccaddCol" aria-expanded="false" aria-controls="ccaddCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Adding Customer Contacts</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="ccaddCol" class="collapse" aria-labelledby="ccaddHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>- For a logged in user, to add a customer contact, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to add a new contact for by clicking the View Action button.</p>
                                        <p>- In the customer information page, switch to the <a class="text-white" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Contacts</a> Tab</p>
                                        <p>- Click the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Contact</a> button and fill all the fields then click the Save button.</p>
                                        <br>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read &amp; Write (CR)</strong> permissions can view and create a new contact.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#cceditCol" aria-expanded="false" aria-controls="cceditCol">See also <a href="#cceditCard" class="link" onclick="setSize('cceditCard')">Editing Customer Contacts</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="cceditCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="cceditHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#cceditCol" aria-expanded="false" aria-controls="cceditCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Editing Customer Contacts</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="cceditCol" class="collapse" aria-labelledby="cceditHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                         <p>- For a logged in user, to edit a customer contact, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to edit a contact for by clicking the Edit Action button.</p>
                                        <p>- Switch to the Edit Contact Tab.</p>
                                        <p>- Click on the <a  href="javascript:void(0);" class="btn btn-dark mb-2 mr-2 rounded-circle">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a> button on the contact you wish to edit, fill out the opened form accordingly then save.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read, Write or Update(CRU)</strong> permissions can view and update/edit a contact.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#ccdeleteCol" aria-expanded="false" aria-controls="ccdeleteCol">See also <a href="#ccdeleteCard" class="link" onclick="setSize('ccdeleteCard')">Deleting Customer Contacts</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="ccdeleteCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="ccdeleteHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#ccdeleteCol" aria-expanded="false" aria-controls="profileCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Deleting Customer Contacts</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="ccdeleteCol" class="collapse" aria-labelledby="ccdeleteHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                         <p>- For a logged in user, to delete a customer contact, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to delete a contact for by clicking the Edit Action button.</p>
                                        <p>- Switch to the Edit Contact Tab.</p>
                                        <p>- Click on the <a  href="javascript:void(0);" class="btn btn-danger mb-2 mr-2 rounded-circle">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a> button on the contact you wish to delete, confirm contact deletion.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Delete (D)</strong> permissions can delete a contact.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#cceditCol" aria-expanded="false" aria-controls="cceditCol">See also <a href="#cceditCard" class="link" onclick="setSize('cceditCard')">Editing Customer Contacts</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="caaddCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="caaddHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#caaddCol" aria-expanded="false" aria-controls="caaddCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Adding Customer Addresses</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="caaddCol" class="collapse" aria-labelledby="caaddHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>- For a logged in user, to add a customer address, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to add a new address for by clicking the View Action button.</p>
                                        <p>- In the customer information page, switch to the <a class="text-white" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg> Addresses</a> Tab</p>
                                        <p>- Click the <a class="btn btn-primary" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Address</a> button and fill all the fields then click the Save button.</p>
                                        <br>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read &amp; Write (CR)</strong> permissions can view and create a new address.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#caeditCol" aria-expanded="false" aria-controls="caeditCol">See also <a href="#caeditCard" class="link" onclick="setSize('caeditCard')">Editing Customer Addresses</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="caeditCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="caeditHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#caeditCol" aria-expanded="false" aria-controls="caeditCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Edititng Customer Addresses</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="caeditCol" class="collapse" aria-labelledby="caeditHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                       <p>- For a logged in user, to edit a customer address, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to edit an address for by clicking the Edit Action button.</p>
                                        <p>- Switch to the Edit Addresses Tab.</p>
                                        <p>- Click on the <a  href="javascript:void(0);" class="btn btn-dark mb-2 mr-2 rounded-circle">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a> button on the address you wish to edit, fill out the opened form accordingly then save.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Read, Write or Update(CRU)</strong> permissions can view and update/edit an address.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#caaddCol" aria-expanded="false" aria-controls="caaddCol">See also <a href="#caaddCard" class="link" onclick="setSize('caaddCard')">Adding Customer Assresses</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="cadeleteCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="cadeleteHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#cadeleteCol" aria-expanded="false" aria-controls="cadeleteCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Deleting Customer Addresses</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="cadeleteCol" class="collapse" aria-labelledby="cadeleteHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                         <p>- For a logged in user, to delete a customer address, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to delete an address for by clicking the Edit Action button.</p>
                                        <p>- Switch to the Edit Contact Tab.</p>
                                        <p>- Click on the <a  href="javascript:void(0);" class="btn btn-danger mb-2 mr-2 rounded-circle">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a> button on the address you wish to delete, confirm address deletion.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Delete (D)</strong> permissions can delete an address.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#cpviewCol" aria-expanded="false" aria-controls="cpviewCol">See also <a href="#cpviewCard" class="link" onclick="setSize('cpviewCard')">Editing Payment Certificate</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="cpviewCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="cpviewHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#cpviewCol" aria-expanded="false" aria-controls="cpviewCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Viewing Customer Projects</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="cpviewCol" class="collapse" aria-labelledby="cpviewHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>- For a logged in user, to view customer's projects , open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to view projects for by clicking the View Action button.</p>
                                        <p>- In the customer information page, switch to the <a class="text-white" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Details</a> Tab</p>
                                        <p>- Click the <a class="link" href="javascript:void(0);">See Customer Projects <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a> which will redirect you to a projects listing.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white">See also <a href="ncg_projects_manual" class="link">Inyatsi Customer Projects</a></p>
                                    </div>
                                </div>
                            </div>
                            <div  id="clogoCard" class="mg-con"></div>
                            <div class="card">
                                <div class="card-header" id="clogoHead">
                                    <div class="mb-0" data-toggle="collapse" role="navigation" data-target="#clogoCol" aria-expanded="false" aria-controls="clogoCol">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg> <span class="faq-q-title">Adding Customer Logo</span> <div class="like-faq"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> </div>
                                    </div>
                                </div>
                                <div id="clogoCol" class="collapse" aria-labelledby="clogoHead" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>- For a logged in user, to add a customer logo, open the <a class="link" href="ncg_customers" target="_blank">Customers link</a>.</p>
                                        <p>Select the customer you wish to add a logo for by clicking the View Action button.</p>
                                        <p>- In the customer information page, switch to the <a class="text-white" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Details</a> Tab</p>
                                        <p class="text-white">- Click the 
                                            <span><div class="col-md-4">
                                            <a href="javascript:void(0);">
                                                <div class="" style="line-height:100px; width: 100px; height: 100px; background-image: url(assets/img/temp.png); background-size:contain; background-position: center; border-radius: 10%; background-repeat: no-repeat;">
                                                <div class="logo-add">
                                                    <span style="background-color: rgb(0,0,0,0.6); border-radius: 100%; color: #fff; border-radius: 5px; padding: 5px; text-align: center;">Add Logo</span>
                                                </div>
                                            </div>
                                            
                                            </a>
                                        </div></span> </p>
                                        <p>box and follow the prompts.</p>
                                        <br>
                                        <p style="color: #ff0000;">*Only users with <strong style="color: #fff;">Update (U)</strong> permissions can upload a cuslomer logo.</p>
                                        <hr>
                                         <br>
                                          <p class="text-white" data-toggle="collapse" role="navigation" data-target="#cviewCol" aria-expanded="false" aria-controls="cviewCol">See also <a href="#cviewCard" class="link" onclick="setSize('cviewCard')">Viewing Customers</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                            
            </div>
            <div class="modal fade modal-notification" id="askFaq" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_customer_mgt_manual">
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
                                    <input type="hidden" name="from" value="ncg_customer_mgt_manual.php">
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