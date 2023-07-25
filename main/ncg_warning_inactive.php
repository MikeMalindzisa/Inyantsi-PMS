<?php
include "core_functions/functions.php";
if(isset($_GET['id'])){
       $id = $_GET['id']; 
    }else{
        $id = $_SESSION['ncg-active']['UID'];
    }
    
    $user_info = NCG_FUNCT::GET_USER_INFO($id);
        if($user_info['IMAGE'] == NULL){
            $photo = "assets/img/avatar.png";
        }if (!empty($user_info['IMAGE'])) {
            $image_parts = explode(".", $user_info['IMAGE']);
            $required = array("png","jpg", "jpeg");
            if(sizeof($image_parts) <= 1 || !in_array(end($image_parts), $required)){
             $photo = "assets/img/avatar.png";
            }else{
                $photo = $user_info['IMAGE'];
            }
        }else{
            $photo = "assets/img/avatar.png";
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI INACTIVE</title>
    <link href="assets/img/logo.png" rel="icon" type="image/x-icon" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages/common/common.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="common text-center">
    
    <div class="container-fluid" style="margin-bottom: -70px; position: fixed;">
        <div class="row">
            <div class="col-md-12 mr-auto mt-5 text-md-right text-center">
                <a href="#" class="ml-md-12">
                    <img alt="user" src="assets/img/ww_logo.png" class="common-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid common-content">
        <div class="">
            <div class="row" style="margin-top: 80px;">
                <div class="col-md-12 text-center">
                    <a href="#" class="ml-md-12">
                        <img alt="Inyatsi Logo" src="<?php echo $photo;?>" class="common-user">
                    </a>
                </div>
            </div>
            <h4 class="mb-4 mt-5 common-text"><?php echo $user_info['NAME']?></h4>
            <p class="mini-text">Sorry!</p>
            <p class="common-text mb-4 mt-1">Your account is inactive, please contact Inyatsi IT Support to have it activated.</p>
            <a href="ncg_login" class="btn btn-primary mt-5">Go Back</a>
        </div>
    </div> 
    <div class="row" style="margin-bottom: 80px!important;" >
        <div class="col-lg-3">
            <p class="link"><a href="ncg_manual" target="_blank" style="font-size: 11px!important;" class="text-white">User Manual</a></p>        
        </div>
        <div class="col-lg-3">
            <p class="link"><a href="ncg_public_terms" target="_blank" style="font-size: 11px!important;" class="text-white">Terms &amp; Conditions</a></p>        
        </div>
        <div class="col-lg-3">
            <p class="link"><a href="ncg_public_policy" target="_blank" style="font-size: 11px!important;" class="text-white">Privacy Policy</a></p>        
        </div>
        <div class="col-lg-3">
            <p class="link"><a href="faqs" target="_blank" style="font-size: 11px!important;" class="text-white">FAQs</a></p>        
        </div>
    </div>
        <div id="miniFooterWrapper" class="" style="position: fixed; width: 100%!important;bottom: 0; background-color: #273036;"> 
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright align-self-center">
                            <p class="" style="color: #FFFFFF;">&copy; <script>document.write(new Date().getFullYear());</script> Inyatsi Construction Group. All rights reserved.</p>
                        </div>
                        <div class="col-xl-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-right text-center align-self-center">
                            <p>poweredby <a target="_blank" href="https://outsourceszl.com" style="color: #FFFFFF!important;">OUTSOURCE ESWATINI</a></p>
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
</body>
</html>