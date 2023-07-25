<?php
$link = "ncg_users.php";
$level_of_access = "root";
$page = "INYATSI USERS";
    include "includes/header.php";
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
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <input type="hidden" id="message" value="<?php echo $msg?>">
            <input type="hidden" id="title" value="User Management">
            <input type="hidden" id="response" value="<?php echo $response?>">
            <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Users</h3>                                
                  <div class="animated-underline-content">
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#internal" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-left-down"><polyline points="14 15 9 20 4 15"></polyline><path d="M20 4h-7a4 4 0 0 0-4 4v12"></path></svg> Internal Users</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#external" role="tab" aria-controls="animated-underline-profile" aria-selected="false"></svg> External Users <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-right-up"><polyline points="10 9 15 4 20 9"></polyline><path d="M4 20h7a4 4 0 0 0 4-4V4"></path></a>
                      </li>                    </ul>
                    <div class="tab-content" id="animateLineContent-4">
                      <!--Internal Users tab panel-->
                      <div class="tab-pane fade show active" id="internal" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <section id="internal-groups">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="internal_pagination" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>User Name</th>
                                            <th>Department</th>
                                            <th>Work Phone</th>
                                            <th>Cell</th>
                                            <th>Extension</th>
                                            <th>Work Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $internal_users_data = NCG_FUNCT::GET_ALL_USER_INFO();
                                            while($internal_user = $internal_users_data ->fetch_assoc()){
                                                if($internal_user['IMAGE'] == NULL){
                                                    $u_photo = "assets/img/avatar.png";
                                                }if (!empty($internal_user['IMAGE'])) {
                                                    $image_parts = explode(".", $internal_user['IMAGE']);
                                                    $required = array("png","jpg", "jpeg");
                                                    if(sizeof($image_parts) <= 1 || !in_array(end($image_parts), $required)){
                                                     $u_photo = "assets/img/avatar.png";
                                                    }else{
                                                        $u_photo = $internal_user['IMAGE'];
                                                    }
                                                }else{
                                                    $u_photo = "assets/img/avatar.png";
                                                }?>
                                            ?>
                                        <tr>
                                            <td><img src="<?php echo $u_photo;?>" style="width: 30px; height: 30px; border-radius: 30px;"></td>
                                            <td><?php echo $internal_user['NAME']?></td>
                                            <td><?php echo $internal_user['DEPARTMENT']?></td>
                                            <td><?php echo $internal_user['W_PHONE']?></td>
                                            <td><?php echo $internal_user['P_PHONE']?></td>
                                            <td><?php echo $internal_user['EXTERNSION']?></td>
                                            <td><?php echo $internal_user['W_EMAIL']?></td>
                                              <?php
                                              $dom = "id=".$internal_user['USER_ID']."&control=control";
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>
                                            <td class="text-center"> <a class="btn btn-primary" href="ncg_user_profile?xyz=<?=$dirty_data?>">Details</a> </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>User Name</th>
                                            <th>Department</th>
                                            <th>Work Phone</th>
                                            <th>Cell</th>
                                            <th>Extension</th>
                                            <th>Work Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>

                      </div>
                      <!--Internal Users tab panel-->
                      <!--External Users tab panel-->
                      
                      <div class="tab-pane fade show" id="external" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <section id="external-groups">
                              <a class="btn btn-primary" style="float: left;" href="javascript:void(0);" data-toggle="modal" data-target="#new-user">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg> New User
                              </a>
                              <br>
                            </h3>
                          <div class="table-responsive mb-4 mt-4">
                                <table id="external_pagination" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Security Group</th>
                                            <th>Affiliation</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $external_user_data = NCG_FUNCT::GET_ALL_EXTERNAL_USER_INFO();
                                            while($external_user = $external_user_data ->fetch_assoc()){
                                                $affiliation = NCG_FUNCT::GET_AFFILIATION($external_user['USER_ID']);
                                                $user_group = NCG_FUNCT::GET_EXTERNAL_USER_GROUP($external_user['USER_ID']);?>
                                        <tr>
                                            <td><?php echo $external_user['USER_NAME']?></td>
                                            <td><?php echo $user_group?></td>
                                            <td><?php echo $affiliation ?></td>
                                            <td>
                                                <?php 
                                                  if($external_user['USER_EMAIL'] == "0"){
                                                     if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                                                 <div class="t-rate rate-dec">
                                                    <p><span> <a class="btn btn-dark btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#update-email-<?php echo $external_user['USER_ID']?>">Update Email</a></span> </p>
                                                </div>
                                                
                                               
                                              <?php }
                                              else{?>
                                                <span style="color: #ff0000; font-style: italic;">Unavailable</span> 
                                              <?php }}else{
                                                echo $external_user['USER_EMAIL'];
                                              }
                                              ?>
                                            </td>
                                            <td><?php echo $external_user['USER_PHONE']?></td>
                                              <?php
                                              ?>
                                              <td class="text-center"> 
                                                  <div class="btn-group mb-4" role="group">
                                                      <button id="customerAction" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Select <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="customerAction" style="z-index: 99999!important;">
                                                        <?php
                                                          $dom = "id=".$external_user['USER_ID']."&control=control";
                                                          $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                                          $creds_dom = "resend-creds=resend&from=ncg_users.php&id=".$external_user['USER_ID']."&control=control";
                                                          $resend_dirty_data = NCG_FUNCT::MAKE_DIRTY($creds_dom);
                                                          ?>
                                                          <a class="dropdown-item" href="ncg_ex_user_profile?xyz=<?=$dirty_data?>">Details</a>
                                                          <?php 
                                                            if($external_user['USER_EMAIL'] == "0"){?>
                                                              <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#update-email-<?php echo $external_user['USER_ID']?>">Update Email</a>
                                                            <?php }else{ ?>
                                                              <a class="dropdown-item" href="ncg_users?xyz=<?=$resend_dirty_data?>">Resend Credentials</a>
                                                            <?php }?>
                                                      </div>
                                                  </div>
                                            </td> 
                                            <div class="modal fade modal-notification" id="update-email-<?php echo $external_user['USER_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                               <div class="modal-dialog" role="document" id="standardModalLabel">
                                                 <div class="modal-content">
                                                   <form method="post" action="ncg_users">
                                                    <input type="hidden" name="from" value="ncg_users.php">
                                                       <input type="hidden" name="cid" value="<?php echo NCG_FUNCT::GET_AFFILIATION_ID($external_user['USER_ID']) ?>">
                                                       <input type="hidden" name="uid" value="<?php echo $external_user['USER_ID']?>">
                                                   <div class="modal-body text-center">
                                                       <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                         <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                       </div></center>
                                                       <br>
                                                       <hr/>
                                                       <h4>Update Email</h4> 
                                                       <div class="upload mt-4 pr-md-4">
                                                           <input type="email" name="con-email" class="form-control" placeholder="Email address" required />
                                                       </div>
                                                    </div>
                                                   <div class="modal-footer justify-content-between">
                                                     <button class="btn" data-dismiss="modal">Cancel</button>
                                                     <button type="submit" class="btn btn-primary" name="update-con-email">Update</button>
                                                   </div>
                                                   </form>
                                                 </div>
                                               </div>
                                             </div>
                                        </tr>


                                            <div class="modal fade modal-notification" id="assignProjects-<?php echo $external_user['USER_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                 <form method="POST" action="ncg_users" >
                                                     <div class="modal-dialog" role="document" id="standardModalLabel">
                                                       <div class="modal-content">
                                                         <div class="modal-body text-center">
                                                              <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                               <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                             </div></center>
                                                             <br>
                                                             <hr/>
                                                             <h4>Assign User</h4>
                                                             <strong><p class="modal-text"><?php echo $external_user['USER_NAME']?></p></strong> <br><hr/>
                                                             <div class="row" id="clientSelectDiv">
                                                             <div class="col-sm-12">
                                                             <?php
                                                               $projects = NCG_FUNCT::GET_PROJECTS();
                                                               if(mysqli_num_rows($projects) > 0){
                                                              ?>
                                                                 <select class="selectpicker dropdown" data-header="Search project(s)"  data-size="10" data-width="100%"  data-actions-box="true" data-live-search="true" name="pids[]" title="Select project(s)" required multiple="multiple">
                                                                  <option value="sdf"  selected >Event</option>
                                                                   <?php
                                                                     while($project = $projects ->fetch_assoc()){
                                                                      $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PROJECT_ID']);?>
                                                                        <option value="<?php echo $project['PROJECT_ID']?>" data-tokens="<?php echo $project_info['PROJECT_NAME']?>"> <?php echo $project_info['PROJECT_NAME']?></option>
                                                                    <?php }?>
                                                                 </select>
                                                                 <?php } else{ ?>
                                                                   <h4>No Register Projects</h4>
                                                                   <a href="ncg_projects.php"  class="btn btn-primary">Add Project</a>
                                                                 <?php }?>
                                                             </div>
                                                           </div>
                                                             <input type="hidden" name="uid" value="<?php echo $external_user['USER_ID'] ?>">
                                                             <input type="hidden" name="page" value="ncg_users.php">
                                                          </div>
                                                         <div class="modal-footer justify-content-between">
                                                           <button class="btn" data-dismiss="modal">Cancel</button>
                                                           <input  class="btn btn-primary" type="submit" name="assign-projects" value="Add">
                                                         </div>
                                                       </div>
                                                     </div>
                                                 </form>
                                               </div> 
                                        <?php
                                        }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Security Group</th>
                                            <th>Affiliation</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>

                      </div>
                      <!--External Users tab panel-->
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="new-user" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              
              <div class="modal-content">
                  <div class="modal-header">
                      <h4>New User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                  </div>
                <form method="post"  action="ncg_users">
                  <div class="modal-body">
                            <div class="input-group mb-4">
                              <?php
                             $customers_request_response = NCG_FUNCT::GET_CUSTOMERS();?>
                              <select class="form-control selectpicker dropup" required data-header="Search and select or select to Choose user affiliation"  data-size="5" data-width="100%"  data-actions-box="true" data-live-search="true" name="affiliation" required title="User Affiliation" style="overflow-y: scroll; z-index: 10000; display: flex;">
                                <?php
                                     while($customer = $customers_request_response ->fetch_assoc()){
                                        echo "<option value='{$customer['CUSTOMER_ID']}' data-tokens='{$customer['CLIENT_NAME']}'>{$customer['CLIENT_NAME']}</option>";
                                     }?>
                              </select>
                            </div>
                      <div id="circle-basic" class="">
                        <h3>Account Details</h3>
                        <section class="">
                         <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon7">User Name</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="User Name" name="username" requred >
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Status</span>
                                </div>
                                <select class="form-control" name="status" required>
                                    <option value="">Select</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </section>
                        <h3>Account Contacts</h3>
                        <section class="slide">
                          <div id="address-details">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Email</span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email address" required name="email">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Phone</span>
                                    </div>
                                    <input type="tel" class="form-control" placeholder="Contact phone" required name="phone">
                                  </div>
                                </div>
                              </div>
                          </div>
                        </section>
                        <h3>Account Security</h3>
                        <section class="slide">
                          <div id="contact-details">
                      <div class="row">
                        <div class="col-sm-12">
                          <span style="width: 100%" id="error" class="badge badge-danger">  </span>
                          </div>
                      </div>
                      </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Password</span>
                                </div>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="pass" required>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Confirm Password</span>
                                </div>
                                <input type="password" class="form-control" id="repass"  onkeyup="validate()" placeholder="Password" name="repass" required>
                              </div>
                            </div>
                          </div>
                    </section>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary" id="save-user" name="new-external-user">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>
            <?php
                    include 'includes/footer.php';?>
           </div>
       </div>
    
    <script type="text/javascript">
        function validate(){
        var pass = document.getElementById("password").value;
        var repass = document.getElementById("repass").value;
        var error = document.getElementById("error");
        var saveBtn = document.getElementById("save-user");
        if(pass !== repass){
                saveBtn.style.enabled = false;
                error.style.display = "block";
                error.innerHTML = "Passwords do not match!";
            }else{
                saveBtn.style.enabled = true;
                error.style.display = "none";
                error.innerHTML = "";
            }
        }
    </script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="plugins/jquery-step/custom-jquery.steps.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="assets/js/elements/custom-search.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="plugins/bootstrap-maxlength/custom-bs-maxlength.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        // Scroll To Top
        $(document).on('click', '.arrow', function(event) {
          event.preventDefault();
          var body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing');
        });
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
    <script>
        $(document).ready(function() {
            $('#external_pagination').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    
    <script>
        $(document).ready(function() {
            $('#internal_pagination').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="plugins/noUiSlider/nouislider.min.js"></script>

    <script src="plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
</body>
</html>