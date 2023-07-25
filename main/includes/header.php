<?php include "core_functions/functions.php";
        if (isset($_SESSION['NCG_TIMEOUT']) && (time() - $_SESSION['NCG_TIMEOUT'] > 10000000)) {
            NCG_FUNCT::LOGOUT();
        }
        NCG_FUNCT::VALID_SESSION();

        if($level_of_access == "root"){
            if($_SESSION['ncg-active']['ROLE'] != "Admin"){
              header("Location: index");
              exit();
            }
        }
        
        $_SESSION['NCG_TIMEOUT'] = time();
        include "core_functions/crud.php";
        $prm = NCG_FUNCT::GET_INTERNAL_USER_PERMISSIONS($_SESSION['ncg-active']['UID']);
        
        if($_SESSION['ncg-active']['ROLE'] == "Admin"){
            $auth_badge = '<svg class="badge" style="float: right; margin: 4px; width:38px; height:38px;" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
<path style="fill:#FFFFFF;" d="M29,0c0,0-6.667,8-22,8v19.085c0,9.966,4.328,19.577,12.164,25.735C21.937,55,25.208,56.875,29,58
    c3.792-1.125,7.062-3,9.836-5.18C46.672,46.662,51,37.051,51,27.085V8C35.667,8,29,0,29,0z"/>
<path style="fill:#1AA912;" d="M29,51.661c-2.123-0.833-4.178-2.025-6.128-3.558C16.69,43.245,13,35.388,13,27.085V13.628
    c7.391-0.943,12.639-3.514,16-5.798c3.361,2.284,8.609,4.855,16,5.798v13.457c0,8.303-3.69,16.16-9.871,21.018
    C33.178,49.636,31.123,50.828,29,51.661z"/>
<path style="fill:#FFFFFF;" d="M41.659,20.248c-0.416-0.364-1.047-0.321-1.411,0.094L26.951,35.537l-7.244-7.244
    c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l8,8C26.481,37.895,26.735,38,27,38c0.011,0,0.022,0,0.033,0
    c0.277-0.009,0.537-0.133,0.719-0.341l14-16C42.116,21.243,42.074,20.611,41.659,20.248z"/><g></g><g></g><g></g><g></g><g></g><g>
</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
</svg>';



        }elseif(NCG_FUNCT::IS_SPECIAL($_SESSION['ncg-active']['UID'])){
                $auth_badge = '<p style="float: right; margin:4px;" class="badge badge-secondary">SPECIAL</p>';
        }else{
            if($prm['permissions'] != ""){
                $auth_badge = '<p style="float: right; margin:4px;" class="badge badge-secondary"><span style="color:'.$prm['c_color'].'">'.$prm['C'].'</span><span style="color:'.$prm['r_color'].'">'.$prm['R'].'</span><span style="color:'.$prm['u_color'].'">'.$prm['U'].'</span><span style="color:'.$prm['d_color'].'">'.$prm['D'].'</span></p>';
            }else{
                $auth_badge = '<svg xmlns="http://www.w3.org/2000/svg" style="float: right; margin: 4px; width:24px; height:24px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg>';
            }
        }
        $user_info = NCG_FUNCT::GET_USER_INFO($_SESSION['ncg-active']['UID']);
        $notification_count = NCG_FUNCT::COUNT_USER_NOTIFICATIONS($_SESSION['ncg-active']['UID']);
            if($notification_count > 0){
                $notification_badge = "block";
            }else{
                $notification_badge = "none";
            }
            $name = explode(" ", $user_info['NAME']);
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo $page; ?></title>
    <link href="assets/img/logo.png" rel="icon" type="image/x-icon" />
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <link href="plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/editors/quill/quill.snow.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/search.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages/privacy/privacy.css" rel="stylesheet" type="text/css" />
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/jquery-step/jquery.steps.css"/>
    <link href="assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/tooltip.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
    <link href="assets/css/pages/secondary.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="plugins/editors/markdown/simplemde.min.css">
    <link href="plugins/lightbox/photoswipe.css" rel="stylesheet" type="text/css" />
    <link href="plugins/lightbox/default-skin/default-skin.css" rel="stylesheet" type="text/css" />
    <link href="plugins/lightbox/custom-photswipe.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/pdfThumbnails.js" data-pdfjs-src="build/pdf.js"></script>
    <link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="assets/css/apps/mailbox.css" rel="stylesheet" type="text/css" />

     <style>
        #formValidate .wizard > .content {min-height: 25em;}
        #example-vertical.wizard > .content {min-height: 24.5em;}
    </style>
</head>
<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content" style="width: 100%!important;">
                <center>
                    <img alt="INYATSI Logo" src="assets/img/ww_logo.png" width="60">
                </center>
                <center>
                    <h4 class="text-white" style="margin-top: 15px;">Inyatsi Construction Group</h4>
                </center>
                <center>
                    <p style="color: #000; position: fixed; bottom: 0!important; width: 100%">poweredby <a href="https://outsourceszl.com" target="_blank" class="text-dark">OUTSOURCE ESWATINI</a></p>
                </center>
                <center>
                    <div class="spinner-border spinner-border-reverse text-white mt-5"></div>
                </center>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="index.php">
                        <img src="assets/img/ww_logo.png" class="navbar-logo" alt="INYATSI">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="index.php" class="nav-link"> INYATSI </a>
                </li>
                <li class="nav-item toggle-sidebar">
                    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></a>
                </li>
            </ul>

               <ul class="navbar-item flex-row navbar-dropdown search-ul fix-end">
                
               <li class="nav-item dropdown language-dropdown more-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Toolbox</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                        <div class="dropdown-menu position-absolute animated fadeInUp">
                            <?php
                                if($_SESSION['ncg-active']['ROLE'] == "Admin"){?>
                                    <a class="dropdown-item" href="faq_mgt" data-value="FAQ Management" target="_blank"> FAQ Management</a>
                                    <!--<a class="dropdown-item" target="_blank" href="ncg_admin_manual" data-value="Admin Manual"> Admin Manual</a>-->
                                    <a class="dropdown-item" href="ncg_manual" target="_blank" data-value="User Manual"> User Manual</a>

                            <?php }?>
                            <a class="dropdown-item" href="faqs" target="_blank" data-value="FAQs"> FAQs</a>
                             <?php if($_SESSION['ncg-active']['ROLE'] != "Admin"){?>
                            <a class="dropdown-item" href="ncg_manual" target="_blank" data-value="User Manual"> User Manual</a>
                        <?php }?>
                        </div>
                    </div>
                </li>

                <?php
                    if($notification_count > 0){?>
                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="btn btn-outline-dark mb-2 mr-2 rounded-circle nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success" style="display: <?php echo $notification_badge?>"></span>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">
                            <?php 
                                $notifications = NCG_FUNCT::GET_USER_NOTIFICATIONS($_SESSION['ncg-active']['UID']);
                                while($notification = $notifications ->fetch_assoc()){
                                    switch ($notification['TYPE']) {
                                        case "success":
                                            $not_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
                                            break;
                                        case "warning":
                                            $not_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path></svg>';
                                            break;
                                        case "error":
                                            $not_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>';
                                            break;
                                    }
                                    ?>
                            <div class="dropdown-item">
                                <div class="media server-log">
                                    <?php echo $not_icon?>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class=""><?php echo $notification['MESSAGE']?></h6>
                                            <p class=""><?php echo $notification['TIMESTAMP']?></p>
                                        </div>

                                        <div class="icon-status">
                                              <?php
                                              $dom = "action=clear-notification&id=".$notification['NOTIFICATION_ID']."&page=".$link;
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>
                                            <a href="<?php echo str_replace(".php", "", $link)?>?xyz=<?=$dirty_data?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        <hr/>
                          <?php
                              $dom = "action=clear-notifications&id=".$_SESSION['ncg-active']['UID']."&page=".$link;
                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                              ?>
                        <center><a href="<?php echo str_replace(".php", "", $link)?>?xyz=<?=$dirty_data?>">Clear all notification</a></center>
                        </div>
                    </div>
                </li>
                <?php }?>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="btn btn-outline-dark mb-2 mr-2 rounded-circle nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <?php 
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
                                        }?>
                                <img src="<?php echo $photo?>" class="img-fluid mr-2" alt="avatar" style="background-color: #fff;">
                                <div class="media-body">
                                    <h5><?php echo $name[0]?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                              <?php
                                  $dom = "id=".$_SESSION['ncg-active']['UID']."&control=control";
                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                  ?>
                            <a href="ncg_user_profile?xyz=<?=$dirty_data?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>My Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                              <?php
                                  $dom = "logout=1&control=control";
                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                  ?>
                            <a href="ncg_login.php?xyz=<?=$dirty_data?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->
<!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="profile-info">
                    <figure class="user-cover-image"><?=$auth_badge?></figure>
                    <div class="user-info">
                        <img src="<?php echo $photo?>" alt="avatar" style="background-color: #fff;">
                        <h6 class=""><?php echo $user_info['NAME']?></h6>
                        <p class=""><?php echo $user_info['DEPARTMENT']?></p>
                    </div>
                </div>
                <ul class="list-unstyled menu-categories" id="menu-accordion">
                    <li class="menu">
                        <a href="ncg_customers" class="dropdown-toggle" aria-expanded="true">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Customers</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="ncg_projects"  class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                                <span>Projects</span>
                            </div>
                        </a>
                    </li>
                    <?php 
                        if($_SESSION["ncg-active"]["ROLE"] == "Admin"){  ?>
                            <li class="menu">
                                <a href="#security" data-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                        <span>Security</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </a>
                                <ul class="collapse submenu recent-submenu mini-recent-submenu list" id="security" data-parent="#menu-accordion">
                                    <li class="menu">
                                        <a href="ncg_sec_groups"  class="dropdown-toggle" aria-expanded="false">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2" height="2" viewBox="0 0 2 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""></svg>
                                                <span>Security Groups</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="menu">
                                        <a href="ncg_users"  class="dropdown-toggle" aria-expanded="false">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""></svg>
                                                <span>Users</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu">
                                <a href="#legal" data-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                        <span>Legal</span>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </a>
                                <ul class="collapse submenu recent-submenu mini-recent-submenu list" id="legal" data-parent="#menu-accordion">
                                    <li class="menu">
                                        <a href="ncg_privacy"  class="dropdown-toggle" aria-expanded="false">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2" height="2" viewBox="0 0 2 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""></svg>
                                                <span>Privacy Policy</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="menu">
                                        <a href="ncg_terms"  class="dropdown-toggle" aria-expanded="false">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""></svg>
                                                <span>Terms & Conditions</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <hr/>

                            <li class="menu">
                                <a href="ncg_settings"  class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                        <span>Settings</span>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                   </ul>
                   
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->