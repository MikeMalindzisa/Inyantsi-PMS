<?php 
  include "../core_functions/functions.php";
  if (isset($_SESSION['ncg-mb-active'])) {
    if(NCG_FUNCT::NCG_MB_TIMEOUT()){
      NCG_FUNCT::MB_LOGOUT();
    }
  }
  if(NCG_FUNCT::MB_VALID_SESSION()){
    if($_SESSION['ncg-mb-active']['ROLE'] == "Customer"){
      header("Location: ncg_mb_ex_home.php");
      exit();
    }
  }else{
    header("Location: index.php");
    exit();
  }
  $img = "mb-assets/img/logo.png";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="../mb-assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="../mb-assets/js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../mb-assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="../mb-assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/apps/project-view.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="../mb-assets/css/pages/helpdesk.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->    
</head>
<body class="sidebar-noneoverflow">
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
                    <p style="color: #999!important; position: fixed; bottom: 0!important; width: 100%">poweredby <a href="https://outsourceszl.com" target="_blank" style="color:#ddd;">OUTSOURCE ESWATINI</a></p>
                </center>
                <center>
                    <div class="spinner-border spinner-border-reverse text-dark mt-5"></div>
                </center>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
    <div class="helpdesk container" style="margin-bottom: 100px!important;">

        <nav class="navbar navbar-expand navbar-light">
            <img src="<?php echo "../".$img ?>" class="navbar-brand" style="width: 35px; height: 35px; border-radius: 35px; padding: 5px; background-color: #dddddd;" />

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link ellipsis" href="ncg_mb_in_settings.php"><?php echo NCG_FUNCT::GET_MB_BADGE()." ".$_SESSION['ncg-mb-active']['NAME']?></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="helpdesk layout-spacing" style="padding: 5px!important; margin-bottom: 50px!important">
            <div class="hd-tab-section" style="margin-top: 80px;">
                <div class="widget-content searchable-container list">
                      <div class="row">

                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-end">

                                        <div class="switch align-self-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list active-view"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                    <form class="form-inline my-2 my-lg-0">
                                        <div class="" style="border: .5px solid #D6D6D6; border-radius: 5px; margin-top: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control product-search" id="input-search" placeholder="Search Project...">
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <div class="searchable-items list" style="margin-top: 20px;">
                    <?php 
                    if($_SESSION['ncg-mb-active']['ROLE'] == "Admin"){
                        $projects = NCG_FUNCT::GET_PROJECTS();
                        if(mysqli_num_rows($projects) > 0){
                          while($project = $projects ->fetch_assoc()){
                            $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PROJECT_ID']);
                            $project_finances = NCG_FUNCT::GET_PROJECT_FINANCES($project['PROJECT_ID']);

                             if($project_info['PROJECT_PROGRESS'] < 100 || $project_finances['REMAINING_VALUE'] > 0){
                                if($project['CUSTOMER_ID'] == NULL){
                                  $projectOwner = "Not Assigned";
                                  $color = "#ff0000";
                                }else{
                                  $customerData = NCG_FUNCT::GET_CUSTOMER($project['CUSTOMER_ID']);
                                  $color = "#000000";
                                  $projectOwner = $customerData['CLIENT_NAME'];
                                }
                                $addedByData = NCG_FUNCT::GET_USER_INFO($project['ADDED_BY']);
                                $addedBy = $addedByData['NAME'];?>
                                     <div class="items">
                                    <a href="ncg_mb_in_project_info.php?pid=<?php echo $project['PROJECT_ID']?>">
                                      <div class="item-content">
                                          <br>
                                            <center><h5 class="card-user_name"><?php echo $projectOwner?></h5></center>
                                            <hr/>
                                          <div class="project-profile">
                                              <div class="project-meta-info">
                                                  <p class="project-name" data-name="<?php echo $project_info['PROJECT_NAME']?>"><?php echo $project_info['PROJECT_NAME']?></p>
                                                  <p class="pr-st-date" data-project-st-date="<?php echo date("d M Y ", strtotime($project_info['BASE_START']))?>"><strong>Base Start:</strong> <?php echo date("d M Y ", strtotime($project_info['BASE_START']))?></p>
                                              </div>
                                          </div>
                                          <div class="project-en-date">
                                              <p class="info-title">Est. Delivery Date: </p>
                                              <p class="pr-en-date" data-project-en-date="<?php echo date("d M Y ", strtotime($project_info['ESTIMATED_END_DATE']))?>"><?php echo date("d M Y ", strtotime($project_info['ESTIMATED_END_DATE']))?></p>

                                          </div>
                                          <div class="project-cv">
                                              <p class="info-title">Contract Value: </p>
                                              <p class="pr-cv" data-cv="<?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE']);?>"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE']);?></p>
                                          </div>
                                          <div class="project-pv">
                                              <p class="info-title">Total Paid: </p>
                                              <p class="usr-pv" data-pv="<?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['PAID']);?>"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['PAID']);?></p>
                                          </div>
                                          <center>
                                              
                                              <p class=""> <?php echo $project_info['PROJECT_DESC']?> </p>
                                          </center>
                                          <div class="progress-order-body">
                                              <div class="row mt-4">
                                                  <div class="col-md-12 text-right">
                                                      <span class=" p-o-percentage mr-4" style="color:#fff;"><?php echo $project_info['PROJECT_PROGRESS']?>%</span>
                                                      <div class="progress p-o-progress mt-2">
                                                          <div class="progress-bar pb-nyatsi" role="progressbar" style="width: <?php echo $project_info['PROJECT_PROGRESS']?>%" aria-valuenow="<?php echo $project_info['PROJECT_PROGRESS']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="action-btn">
                                              <a class="btn btn-primary  btn-rounded" href="javascript:void(0);" data-toggle="modal" data-target="#progress-<?php echo $project['PROJECT_ID']?>" style="width: 100%; padding: 5px; text-align: center" id="click-btn">Update Work Progress</a>
                                          </div>
                                      </div>
                                  </a>
                                  </div>
                                <div class="modal fade" id="progress-<?php echo $project['PROJECT_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Progress</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </div>
                                            <form action="ncg_mb_in_home.php" method="post">
                                                <input type="hidden" name="mobile" value="mobile">
                                                <input type="hidden" name="projectId" value="<?php echo $project['PROJECT_ID']?>">
                                                <div class="modal-body">
                                                   <div class="form-control custom-progress progress-up">
                                                <div class="row">
                                                  <div class="col-sm-12">
                                                    <div class="input-group mb-4">
                                                        <input type="range" min="0" max="100" class="custom-range progress-range-counter" value="<?php echo $project_info['PROJECT_PROGRESS']?>" name="progress"> 
                                                      <div class="input-group-append">
                                                         <div class="col-sm-1 range-count range count-display" style="background-color: #fff; border-radius: 4px; padding: 5px; border: 1px solid #000;">
                                                      <span class="range-count-unit">%</span> 
                                                      <span class="range-count-number" data-rangecountnumber="<?php echo $project_info['PROJECT_PROGRESS']?>"><?php echo $project_info['PROJECT_PROGRESS']?></span>
                                                    </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                             </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    <button type="submit" name="up-progress" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                             }
                          }
                        }
                        if(mysqli_num_rows($projects) == 0){
                        ?>                               
                            <div class="row" style="width: 100%; height: 90px; top: 40%; bottom: 60%; position: absolute; background-image: url(<?php echo "../".$img ?>); background-position: center; background-repeat: no-repeat; background-size: contain;">

                                <p style="width: 100%; margin-top: 100px; text-align: center; color: #000!important"> No existing projects. </p>
                            </div>
                      <?php }
                      }       
                      elseif(NCG_FUNCT::GET_USER_ROLE($_SESSION['ncg-mb-active']['UID']) == "User" && NCG_FUNCT::CAN_READ($_SESSION['ncg-mb-active']['UID']) || NCG_FUNCT::IS_SPECIAL($_SESSION['ncg-mb-active']['UID'])){
                        if(NCG_FUNCT::IS_SPECIAL($_SESSION['ncg-mb-active']['UID'])){
                          $projects = NCG_FUNCT::GET_PROJECTS();
                          $px = "PROJECT_ID" ;
                        }else{
                          $projects = NCG_FUNCT::GET_USER_ASSIGNMENTS($_SESSION['ncg-mb-active']['UID']);  
                          $px = "PID" ;
                        }
                        
                        
                        if(mysqli_num_rows($projects) > 0){
                          while($pr = $projects ->fetch_assoc()){
                            $project = NCG_FUNCT::GET_PROJECT($pr[$px]);
                            $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PROJECT_ID']);
                            $project_finances = NCG_FUNCT::GET_PROJECT_FINANCES($project['PROJECT_ID']);
                            if($project_info['PROJECT_PROGRESS'] < 100 || $project_finances['REMAINING_VALUE'] > 0){
                              if($project['CUSTOMER_ID'] == NULL){
                                $projectOwner = "Not Assigned";
                                $color = "#ff0000";
                              }else{
                                $customerData = NCG_FUNCT::GET_CUSTOMER($project['CUSTOMER_ID']);
                                $color = "#000000";
                                $projectOwner = $customerData['CLIENT_NAME'];
                              }
                              $addedByData = NCG_FUNCT::GET_USER_INFO($project['ADDED_BY']);
                              $addedBy = $addedByData['NAME'];?>
                            <div class="items">
                                <a href="ncg_mb_in_project_info.php?pid=<?php echo $project['PROJECT_ID']?>">
                              <div class="item-content">
                                  <br>
                                    <center><h5 class="card-user_name"><?php echo $projectOwner?></h5></center>
                                    <hr/>
                                  <div class="project-profile">
                                      <div class="project-meta-info">
                                          <p class="project-name" data-name="<?php echo $project_info['PROJECT_NAME']?>"><?php echo $project_info['PROJECT_NAME']?></p>
                                          <p class="pr-st-date" data-project-st-date="<?php echo date("d M Y ", strtotime($project_info['START_DATE']))?>"><strong>Start Date:</strong> <?php echo date("d M Y ", strtotime($project_info['START_DATE']))?></p>
                                      </div>
                                  </div>
                                  <div class="project-en-date">
                                      <p class="info-title">Est. Delivery Date: </p>
                                      <p class="pr-en-date" data-project-en-date="<?php echo date("d M Y ", strtotime($project_info['END_DATE']))?>"><?php echo date("d M Y ", strtotime($project_info['END_DATE']))?></p>

                                  </div>
                                  <div class="project-cv">
                                      <p class="info-title">Contract Value: </p>
                                      <p class="pr-cv" data-cv="<?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE']);?>"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE']);?></p>
                                  </div>
                                  <div class="project-pv">
                                      <p class="info-title">Total PayCert Value: </p>
                                      <p class="usr-pv" data-pv="<?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['PAYMENT_VALUE']);?>"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['PAYMENT_VALUE']);?></p>
                                  </div>
                                  <center>
                                      
                                      <p class="card-text"> <?php echo $project_info['PROJECT_DESC']?> </p>
                                  </center>
                                  <div class="progress-order-body">
                                      <div class="row mt-4">
                                          <div class="col-md-12 text-right">
                                              <span class=" p-o-percentage mr-4" style="color:#fff;"><?php echo $project_info['PROJECT_PROGRESS']?>%</span>
                                              <div class="progress p-o-progress mt-2">
                                                  <div class="progress-bar pb-nyatsi" role="progressbar" style="width: <?php echo $project_info['PROJECT_PROGRESS']?>%" aria-valuenow="<?php echo $project_info['PROJECT_PROGRESS']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <?php
                                  if(NCG_FUNCT::CAN_WRITE($_SESSION['ncg-mb-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-mb-active']['UID'])){?>
                                  <div class="action-btn">
                                      <a class="btn btn-primary  btn-rounded" href="javascript:void(0);" data-toggle="modal" data-target="#progress-<?php echo $project['PROJECT_ID']?>" style="width: 100%; padding: 5px; text-align: center" id="click-btn">Update Progress</a>
                                  </div>
                                <?php }?>
                              </div>
                                </a>
                            </div>
                              <div class="modal fade" id="progress-<?php echo $project['PROJECT_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Progress</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <form action="ncg_mb_in_home.php" method="post">
                                            <input type="hidden" name="mobile" value="mobile">
                                            <input type="hidden" name="projectId" value="<?php echo $project['PROJECT_ID']?>">
                                            <div class="modal-body">
                                               <div class="form-control custom-progress progress-up">
                                            <div class="row">
                                              <div class="col-sm-12">
                                                <div class="input-group mb-4">
                                                    <input type="range" min="0" max="100" class="custom-range progress-range-counter" value="<?php echo $project_info['PROJECT_PROGRESS']?>" name="progress"> 
                                                  <div class="input-group-append">
                                                     <div class="col-sm-1 range-count range count-display" style="background-color: #fff; border-radius: 4px; padding: 5px; border: 1px solid #000;">
                                                  <span class="range-count-unit">%</span> 
                                                  <span class="range-count-number" data-rangecountnumber="<?php echo $project_info['PROJECT_PROGRESS']?>"><?php echo $project_info['PROJECT_PROGRESS']?></span>
                                                </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                         </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                <button type="submit" name="up-progress" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                              </div>
                            <?php
                            }
                          }
                        }
                        if(mysqli_num_rows($projects) == 0){
                        ?>                               
                            <div class="row" style="width: 100%; height: 90px; top: 40%; bottom: 60%; position: absolute; background-image: url(<?php echo "../".$img ?>); background-position: center; background-repeat: no-repeat; background-size: contain;">

                                <p style="width: 100%; margin-top: 100px; text-align: center; color: #000!important;"> No existing projects. </p>
                            </div>
                      <?php }
                      } 
                      else{
                        ?>                               
                            <div class="row" style="width: 100%; height: 90px; top: 40%; bottom: 60%; position: absolute; background-image: url(<?php echo "../".$img ?>); background-position: center; background-repeat: no-repeat; background-size: contain;">

                                <p style="width: 100%; margin-top: 100px; text-align: center; color: #000!important;"> No existing projects. </p>
                            </div>
                      <?php }/**/ 
                      ?>
                  </div>
                </div>                            
            </div>
              
        </div>
    </div>
    <div id="miniFooterWrapper" class="">
        <div class="container">
            <div class="row">
                <center><div class="navbar navbar-expand navbar-light">
                        <div class="col-sm-4 col-lg-4 nav-link">
                            <a class="" href="index.php"><center><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>Home</center></a>
                        </div>
                        <div class="col-sm-4 col-lg-4 nav-link">
                            <a class="" href="ncg_mb_about.php"><center><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>About</center></a>
                        </div>
                        <div class="col-sm-4 col-lg-4 nav-link">
                            <a class="" href="ncg_mb_contact.php">
                                <center><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" width="25" height="25" viewBox="0, 0, 732, 524">
                                  <defs>
                                    <clipPath id="Clip_1">
                                      <path d="M-0,2 L731.148,2 L731.148,524 L-0,524 z"/>
                                    </clipPath>
                                  </defs>
                                  <g id="Layer_1">
                                    <g clip-path="url(#Clip_1)">
                                      <path d="M453.716,117.136 C458.11,116.904 461.684,113.57 461.682,109.168 C461.68,104.332 461.684,92.094 461.444,85 L518.444,85 C538.444,120 546.444,156 553.444,179 C560.444,202 585.444,218 606.444,232 C627.444,246 650.444,275 663.444,340 C676.444,405 693.444,524 612.444,524 L201.112,524 C120.112,524 137.112,405 150.112,340 C163.112,275 186.112,246 207.112,232 C228.112,218 253.112,202 260.112,179 C267.112,156 275.112,120 295.112,85 L352.112,85 C351.872,92.094 351.876,104.332 351.874,109.168 C351.872,113.57 355.446,116.904 359.84,117.136 L453.716,117.136" fill="#999999"/>
                                      <path d="M406.778,2 C585.718,2 722.776,54 729.444,111.334 C733.02,142.096 734.982,223.47 692.11,228.666 C648.11,234 574.77,179.846 564.11,150 C557.444,131.334 559.744,122.654 569.444,111.334 C574.566,105.36 580.78,100.26 583.19,96.104 C584.544,93.766 585.034,84.756 575.178,85.372 C546.97,87.136 454.688,89.024 406.778,89.95 C358.868,90.874 266.586,87.136 238.376,85.372 C228.522,84.756 229.012,93.766 230.366,96.104 C232.776,100.26 238.992,105.36 244.112,111.334 C253.814,122.654 256.112,131.334 249.446,150 C238.786,179.846 165.446,234 121.446,228.666 C78.576,223.47 80.536,142.096 84.112,111.334 C90.78,54 227.838,2 406.778,2" fill="#999999"/>
                                      <path d="M98.112,111 C27.112,134 3.112,189 10.112,261 C17.112,333 62.112,333 89.112,324 C116.112,315 129.262,269.152 99.112,239 C79.112,219 11.058,218.002 9.112,302 C7.458,373.43 97.112,416 146.112,389" fill-opacity="0" stroke="#999999" stroke-width="2"/>
                                    </g>
                                    <path d="M542.758,269.604 C542.758,344.706 481.88,405.584 406.778,405.584 C331.676,405.584 270.798,344.706 270.798,269.604 C270.798,194.504 331.676,133.624 406.778,133.624 C481.88,133.624 542.758,194.504 542.758,269.604" fill="#FFFFFE"/>
                                    <path d="M482.376,186.958 C481.958,196.338 474.014,203.602 464.634,203.184 C455.254,202.764 447.992,194.82 448.412,185.442 C448.83,176.062 456.772,168.798 466.154,169.216 C475.532,169.636 482.796,177.58 482.376,186.958" fill="#999999"/>
                                    <path d="M436.578,161.634 C440.464,170.18 436.688,180.26 428.144,184.148 C419.598,188.036 409.516,184.26 405.63,175.714 C401.742,167.168 405.518,157.088 414.064,153.2 C422.608,149.312 432.688,153.088 436.578,161.634" fill="#999999"/>
                                    <path d="M384.27,159.882 C391.616,165.728 392.834,176.424 386.988,183.77 C381.142,191.116 370.442,192.33 363.1,186.484 C355.752,180.638 354.538,169.942 360.384,162.596 C366.23,155.25 376.924,154.036 384.27,159.882" fill="#999999"/>
                                    <path d="M336.878,182.084 C346.08,183.956 352.022,192.93 350.15,202.13 C348.282,211.332 339.304,217.274 330.104,215.402 C320.904,213.532 314.962,204.556 316.834,195.356 C318.704,186.156 327.678,180.214 336.878,182.084" fill="#999999"/>
                                    <path d="M304.748,223.394 C313.794,220.882 323.166,226.176 325.678,235.222 C328.192,244.268 322.896,253.642 313.85,256.154 C304.804,258.666 295.434,253.37 292.918,244.326 C290.406,235.28 295.702,225.908 304.748,223.394" fill="#999999"/>
                                    <path d="M294.894,274.794 C301.81,268.446 312.564,268.904 318.912,275.822 C325.26,282.738 324.8,293.494 317.884,299.84 C310.968,306.188 300.214,305.728 293.864,298.812 C287.516,291.898 287.976,281.144 294.894,274.794" fill="#999999"/>
                                    <path d="M309.464,325.058 C312.744,316.26 322.532,311.784 331.33,315.062 C340.126,318.338 344.604,328.128 341.326,336.926 C338.048,345.724 328.26,350.198 319.46,346.922 C310.664,343.646 306.188,333.858 309.464,325.058" fill="#999999"/>
                                    <path d="M345.282,363.216 C344.208,353.89 350.892,345.454 360.218,344.376 C369.546,343.3 377.98,349.986 379.058,359.312 C380.136,368.64 373.448,377.072 364.12,378.154 C354.794,379.23 346.362,372.544 345.282,363.216" fill="#999999"/>
                                    <path d="M394.526,380.936 C389.33,373.116 391.456,362.564 399.272,357.366 C407.09,352.168 417.644,354.294 422.84,362.112 C428.038,369.93 425.914,380.484 418.094,385.682 C410.276,390.88 399.726,388.754 394.526,380.936" fill="#999999"/>
                                    <path d="M446.444,374.348 C438.262,369.744 435.362,359.378 439.966,351.194 C444.57,343.012 454.934,340.112 463.116,344.716 C471.298,349.32 474.2,359.686 469.596,367.87 C464.994,376.052 454.628,378.95 446.444,374.348" fill="#999999"/>
                                    <path d="M476.112,269.604 C476.112,307.898 445.072,338.938 406.778,338.938 C368.486,338.938 337.444,307.898 337.444,269.604 C337.444,231.312 368.486,200.27 406.778,200.27 C445.072,200.27 476.112,231.312 476.112,269.604" fill="#999999"/>
                                    <path d="M519.12,361.974 C519.12,361.974 488.342,338.888 485.974,314.026 C472.95,337.704 480.052,365.526 502.546,379.732 C507.282,374.996 519.12,361.974 519.12,361.974" fill="#999999"/>
                                  </g>
                                </svg>Contact</center>
                            </a>
                        </div>

                        <div class="col-sm-4 col-lg-4 nav-link">
                            <a class="" href="index.php?mb-logout=1"><center><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>Logout</center></a>
                        </div>

              </div></center>
                </div>      
            </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="../mb-assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="../mb-assets/js/pages/helpdesk.js"></script>
    <script src="../plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="../plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <script src="../assets/js/apps/project-view.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>
</html>