<?php 
    $link = "ncg_user_profile.php";
    $page = "INYATSI PROFILE";
    include 'includes/header.php';
     if(isset($_GET['response'])){
            $response = $_GET['response'];
            $msg = $_GET['msg'];
            $html = $_GET['html'];
        }else{
            $response = "";
            $msg = "";
            $html = "";
        }
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
        if($user_info['P_PHONE'] == NULL){
            $P_PHONE = "NULL";
        }else{
            $P_PHONE = $user_info['P_PHONE'];
        }
        if($user_info['P_EMAIL'] == NULL){
            $P_EMAIL = "NULL";
        }else{
            $P_EMAIL = $user_info['P_EMAIL'];
        }
        if($user_info['DEPARTMENT'] == NULL){
            $DEPARTMENT = "NULL";
        }else{
            $DEPARTMENT = $user_info['DEPARTMENT'];
        }
        if($user_info['EXTERNSION'] == NULL){
            $EXTENSION = "NULL";
        }else{
            $EXTENSION = $user_info['EXTERNSION'];
        }
    ?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

          <input type="hidden" id="message" value="<?php echo $msg?>">
          <input type="hidden" id="title" value="User Account Control">
          <input type="hidden" id="response" value="<?php echo $response?>">
          <input type="hidden" id="html" value="<?php echo $html?>">
            <div class="layout-px-spacing">

                <div class="row layout-spacing">

                    <!-- Content -->
                    <div class="col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <?php 
                                if($id == $_SESSION['ncg-active']['UID']){?>
                                <div class="d-flex justify-content-between">
                                    <h4 style="text-transform: uppercase;">Professional Info</h4>
                                    <a href="ncg_user_edit" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                </div>
                                <?php 
                                }else{
                                    if($_SESSION['ncg-active']['ROLE'] == "Admin"){
                                        $u = NCG_FUNCT::GET_USER($id);
                                        if($u['STATUS'] == "Active"){
                                            $da = "Deactivate";
                                            $wr = "btn-danger";
                                        }else{
                                            $da = "Activate";
                                            $wr = "btn-success";
                                        } 
                                        if($u['ROLE'] == "Admin"){
                                            $ad = "Remove As Admin";
                                            $wd = "btn-danger";
                                            $svg = '<svg xmlns="http://www.w3.org/2000/svg"  fill="#fff" stroke="currentColor" viewBox="0 0 640 512"><path d="M624 208H432c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h192c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>';
                                        }else{
                                            $ad = "Make Admin";
                                            $wd = "btn-success";
                                            $svg = '<svg xmlns="http://www.w3.org/2000/svg"  fill="#fff" stroke="currentColor" viewBox="0 0 640 512"><path d="M622.3 271.1l-115.2-45c-4.1-1.6-12.6-3.7-22.2 0l-115.2 45c-10.7 4.2-17.7 14-17.7 24.9 0 111.6 68.7 188.8 132.9 213.9 9.6 3.7 18 1.6 22.2 0C558.4 489.9 640 420.5 640 296c0-10.9-7-20.7-17.7-24.9zM496 462.4V273.3l95.5 37.3c-5.6 87.1-60.9 135.4-95.5 151.8zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm96 40c0-2.5.8-4.8 1.1-7.2-2.5-.1-4.9-.8-7.5-.8h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c6.8 0 13.3-1.5 19.2-4-54-42.9-99.2-116.7-99.2-212z"/></svg>';
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3">
                                                <form action="ncg_user_profile" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <input type="hidden" name="action" value="<?php echo $da ?>">
                                                <button type="submit" class="btn <?php echo $wr?>" name="de-activate-user"><?php echo $da ?> User</button>
                                                </form>
                                            </div>
                                            <?php 
                                            if($da == "Deactivate"){ ?>
                                            <div class="col-sm-9 col-lg-9">
                                                <form action="ncg_user_profile" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <input type="hidden" name="action" value="<?php echo $ad ?>">
                                                <button type="submit" class="btn <?php echo $wd?> pull-right" style="float: right;" name="uac"><?php echo $svg ?>  <?php echo $ad ?></button>
                                                </form>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        
                                        
                                   <?php } ?>

                               <?php }?>
                                <div class="text-center user-info">
                                    <img src="<?php echo $photo?>" alt="avatar" style="width: 80px; height: 80px; padding: .5px;">
                                    <p class=""><?php echo $user_info['NAME']?></p>
                                </div>
                                <div class="user-info-list">

                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <h4>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> <?php echo $DEPARTMENT?>
                                            </h4>
                                        </div>
                                        <br>
                                        <div class="col-sm-4">
                                            <p>WORK EMAIL</p>
                                            <h6>
                                                <a href="mailto:<?php echo $user_info['W_EMAIL']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>  <?php echo $user_info['W_EMAIL']?></a>
                                            </h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>WORK PHONE</p>
                                            <h6>
                                                <a href="tel:<?php echo $user_info['W_PHONE']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>  <?php echo $user_info['W_PHONE']?></a>
                                            </h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>EXTENSION</p>
                                            <h6>
                                                <a href="tel:<?php echo $EXTENSION;?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-forwarded"><polyline points="19 1 23 5 19 9"></polyline><line x1="15" y1="5" x2="23" y2="5"></line><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> <?php echo $EXTENSION;?></a>
                                            </h6>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h4 style="text-transform: uppercase;">Personal Info</h4>
                                </div>
                                <br>
                                <div class="user-info-list">

                                    <div class="row text-center">
                                        <div class="col-sm-6">
                                            <h6>
                                                <a href="mailto:<?php echo $P_EMAIL; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> <?php echo $P_EMAIL; ?></a>
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>
                                                <a href="tel:<?php echo $P_PHONE; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> <?php echo $P_PHONE; ?></a>
                                            </h6>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <?php 
                                    if(NCG_FUNCT::GET_USER_ROLE($id) == "User"){?>
                                <div class="d-flex justify-content-between">
                                    <h4 style="text-transform: uppercase;">Projects</h4>
                                    <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#assignProjects"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></a>
                                </div>
                                <br>
                                <?php 

                                    $projects = NCG_FUNCT::GET_USER_ASSIGNMENTS($id);
                                    if(mysqli_num_rows($projects) >0){ ?>
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="alter_pagination" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Client</th>
                                                <th>Contract Value</th>
                                                <th>Work Progress</th>
                                                <th>Estimated End Date</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            while($project = $projects ->fetch_assoc()){
                                                $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PID']);
                                                    $pro_data = NCG_FUNCT::GET_PROJECT($project['PID']);
                                                    if($pro_data['CUSTOMER_ID'] == NULL){
                                                 $projectOwner = "Not Assigned";
                                                 $color = "#ff0000";
                                               }else{
                                                 $customerData = NCG_FUNCT::GET_CUSTOMER($pro_data['CUSTOMER_ID']);
                                                 $color = "#000000";
                                                 $projectOwner = $customerData['CLIENT_NAME'];
                                               }
                                          ?>
                                            <tr>
                                                <td><?php echo $project_info['PROJECT_NAME']?></td>
                                                <td><?php echo $projectOwner?></td>
                                                <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_info['CONTRACT_VALUE'])?></td>
                                                <td><?php echo $project_info['PROJECT_PROGRESS']." %";?></td>
                                                <td><?php echo date("d M Y ", strtotime($project_info['ESTIMATED_END_DATE']))?></td>
                                                <td><?php echo $pro_data['STATUS']?></td>
                                                <td class="text-center">
                                                        <form action="ncg_user_profile" method="post">
                                                            <input type="hidden" name="pid" value="<?php echo $pro_data['PROJECT_ID']?>">
                                                            <input type="hidden" name="uid" value="<?php echo $id?>">
                                                            <input class="btn btn-warning" type="submit" name="rm-assignment" value="Remove Assignment">
                                                        </form>
                                                  </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Client</th>
                                                <th>Contract Value</th>
                                                <th>Work Progress</th>
                                                <th>Estimated End Date</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                        <?php }else{
                                                echo "<p>No assignments</p>";
                                            }
                             }
                                else{
                                if($da == "Deactivate"){
                                    $mv = "";
                                }else{
                                    $mv = "<h6 class ='badge badge-danger'> Deactivated Account</h6>";
                                } ?>
                                    <div class="d-flex justify-content-between">
                                    <h4 style="text-transform: uppercase;">Projects</h4>
                                </div>
                                <br>

                                <div class="user-info-list">

                                    <div class="row text-center">
                                        <div class="col-sm-6">
                                            <h6 class="badge badge-success">
                                               Unrestricted access!
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php 
                                            if($_SESSION['ncg-active']['UID'] != $id){
                                                echo $mv;   
                                            }?>
                                        </div>
                                    </div>
                            </div>
                               <?php }?>
                            </div>
                        </div>

                    </div>

                </div>
                </div>
                 <div class="modal fade modal-notification" id="assignProjects" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_user_profile">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Assign User</h4>
                                  <strong><p class="modal-text"><?php echo $user_info['NAME']?></p></strong> <br><hr/>
                                  <div class="row" id="clientSelectDiv">
                                  <div class="col-sm-12">
                                  <?php
                                    $projects = NCG_FUNCT::GET_PROJECTS();
                                    if(mysqli_num_rows($projects) > 0){
                                   ?>
                                      <select class="selectpicker dropdown" data-header="Search project(s)"  data-size="10" data-width="100%"  data-actions-box="true" data-live-search="true" name="pids[]" title="Select project(s)" required multiple="multiple">
                                        <?php
                                           while($project = $projects ->fetch_assoc()){
                                            $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PROJECT_ID']);
                                              echo "<option value='{$project['PROJECT_ID']}' data-tokens='{$project_info['PROJECT_NAME']}'>{$project_info['PROJECT_NAME']}</option>";
                                           }?>
                                      </select>
                                      <?php } else{ ?>
                                        <h4>No Register Projects</h4>
                                        <a href="ncg_projects"  class="btn btn-primary">Add Project</a>
                                      <?php }?>
                                  </div>
                                </div>
                                  <input type="hidden" name="uid" value="<?php echo $id ?>">
                                  <input type="hidden" name="page" value="ncg_user_profile.php">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="assign-projects">Add</button>
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                <?php
                    include 'includes/footer.php';?>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        // Scroll To Top
        $(document).on('click', '.arrow', function(event) {
          event.preventDefault();
          var body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing');
        });
    </script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
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

    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>