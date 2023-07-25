<?php
$link = "ncg_project_info.php";
$page = "INYATSI PROJECT INFORMATION";
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

    if(isset($_GET['pid'])){
      $pid = $_GET['pid'];
      $project = NCG_FUNCT::GET_PROJECT($pid);
      $project_info = NCG_FUNCT::GET_PROJECT_INFO($pid);
      $project_finances = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
    }

      if($project['CUSTOMER_ID'] == 0){
        $tooltip = "Project not assigned to client!";
        $toggle = "";
      }else{
        if($_SESSION['ncg-active']['ROLE'] == 'Admin' || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){
        $tooltip = "";
        $toggle = "modal";
      }else{
        
        $tooltip = "You have restricted permission on this project!";
        $toggle = "";
      }
      }
      ?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
          <input type="hidden" id="message" value="<?php echo $msg?>">
          <input type="hidden" id="title" value="Project Update">
          <input type="hidden" id="response" value="<?php echo $response?>">
          <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Project Details
                    <?php
                        if($project['CUSTOMER_ID'] == 0){
                      if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                          <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#assignClient"> Assign Client<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></a>
                        <?php }
                    } 
                        $dom_id = "pid=".$pid."&control=control";
                        $dirty_id = NCG_FUNCT::MAKE_DIRTY($dom_id);
                    ?>
                    <a class="btn btn-primary" style="float: right;" href="ncg_project_gallery?xyz=<?=$dirty_id?>"> Project Gallery <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg></a>

                  </h3>                                
                  <div class="animated-underline-content">
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Detail</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="animated-underline-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg> Variation Orders</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#certificates" role="tab" aria-controls="animated-underline-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg> Payment Certificates</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#completion" role="tab" aria-controls="animated-underline-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Project Dates</a>
                      </li>
                    </ul>
                    <div class="modal fade modal-notification" id="updateProgress" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_project_info">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Update Work Progress</h4>
                                  <strong><p class="modal-text"><?php echo $project_info['PROJECT_NAME']?></p></strong> <br>
                                  <p>[<?php echo $project_info['PROJECT_PROGRESS']?>]%</p><hr>
                                  
                                  <div class="row">
                                 <div class="col-lg-12">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Work Progress</span>
                                     </div>
                                      <div class="form-control custom-progress progress-up">
                                        <div class="row">
                                          <div class="col-sm-9">
                                            <input type="range" min="0" max="100" class="custom-range progress-range-counter" value="<?php echo $project_info['PROJECT_PROGRESS']?>" name="progress">   
                                          </div>
                                             <div class="col-sm-3 range-count range count-display">
                                              <span class="range-count-unit">%</span>
                                              <span class="range-count-number" data-rangecountnumber="<?php echo $project_info['PROJECT_PROGRESS']?>"><?php echo $project_info['PROJECT_PROGRESS']?></span> 
                                            </div>
                                        </div>
                                     </div>
                                   </div>
                                 </div>
                                  <div class="col-sm-12" id="proDesc">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Progress Notes</span>
                                            </div>
                                            <textarea class="form-control" aria-label="" rows="6" name="progressDesc"  placeholder="Type here.."></textarea>
                                          </div>
                                            </div>
                                </div>
                                  <input type="hidden" name="pid" value="<?php echo $pid ?>">
                                  <input type="hidden" name="prev" value="<?php echo $project_info['PROJECT_PROGRESS'] ?>">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="update-project-progress-jl21">Update</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
                    <div class="modal fade modal-notification" id="changeCV" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_project_info">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Change Contract Value</h4>
                                  <strong><p class="modal-text">Current Value: <?php echo $project_info['CURRENCY']." ".number_format($project_info['CONTRACT_VALUE'], "2",".",",")?></p></strong>
                                  
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="input-group mb-4">
                                         <label class="new-control new-checkbox checkbox-primary">
                                           <input type="radio" class="new-control-input" value="+" name="cv-operation" checked="checked" onchange="setBounds()" id="add">
                                           <span class="new-control-indicator"></span><span class="text-dark">Increase Value by:</span>
                                         </label> 
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="input-group mb-4">
                                         <label class="new-control new-checkbox checkbox-primary">
                                           <input type="radio" class="new-control-input" value="-" name="cv-operation" onchange="setBounds()" id="sub">
                                           <span class="new-control-indicator"></span><span class="text-dark">Reduce Value by:</span>
                                         </label> 
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                         <div class="input-group-prepend">
                                           <span class="input-group-text" id="basic-addon7">Value</span>
                                         </div>
                                         <input type="number" min="0.0" class="form-control decimal-formatter" id="edit-cv-val" aria-describedby="basic-addon3" placeholder="<?php echo $project_info['CURRENCY']." ".number_format($project_info['CONTRACT_VALUE'],"2",".",",")?>" name="value" requred>
                                       </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="cv" id="c-cv" value="<?=$project_info['CONTRACT_VALUE']?>">
                                  <input type="hidden" name="pid" value="<?php echo $pid ?>">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="update-cv">Update</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
                    <div class="modal fade modal-notification" id="renameProject" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_project_info">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Rename project</h4>
                                  <strong><p class="modal-text"><?php echo $project_info['PROJECT_NAME']?></p></strong>
                                  
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                         <div class="input-group-prepend">
                                           <span class="input-group-text" id="basic-addon7">New Project Name</span>
                                         </div>
                                         <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Project Name" name="pname" requred value="<?php echo $project_info['PROJECT_NAME']?>"  onkeyup="takenPName(this.value)" value="<?php echo $project_info['PROJECT_NAME']?>">
                                       </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="pid" value="<?php echo $pid ?>">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="rename-project">Rename</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
                    <div class="modal fade modal-notification" id="updateStatus" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_project_info">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Update Project Status</h4>
                                  <strong><p class="modal-text"><?php echo $project_info['PROJECT_NAME']?></p></strong> <br>
                                  <p>[<?php echo $project['STATUS']?>]</p><hr>
                                  
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon5">Status</span>
                                        </div>
                                        <select class="form-control" name="projectStatus" required>
                                            <option value="">Select</option>
                                            <option value="Complete">Complete</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Terminated">Terminated</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="pid" value="<?php echo $pid ?>">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="update-project-status">Update</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
                    <div class="modal fade modal-notification" id="assignClient" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_project_info">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Add Project Owner</h4>
                                  <strong><p class="modal-text"><?php echo $project_info['PROJECT_NAME']?></p></strong> <br><hr/>
                                  <div class="row" id="clientSelectDiv">
                                  <div class="col-sm-12">
                                  <?php
                                   $customers_request_response = NCG_FUNCT::GET_CUSTOMERS();
                                    if(mysqli_num_rows($customers_request_response) > 0){
                                   ?>
                                      <select class="selectpicker dropdown" data-header="Search client"  data-size="5" data-width="100%"  data-actions-box="true" data-live-search="true" name="cid" title="Select client" required>
                                        <?php
                                           while($customer = $customers_request_response ->fetch_assoc()){
                                              echo "<option value='{$customer['CUSTOMER_ID']}' data-tokens='{$customer['CLIENT_NAME']}'>{$customer['CLIENT_NAME']}</option>";
                                           }?>
                                      </select>
                                      <?php } else{ ?>
                                        <h4>No Register Customers</h4>
                                        <?php
                                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) ){?>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#new-customer" class="btn btn-primary">Add Customer</a>
                                      <?php } }?>
                                  </div>
                                </div>
                                  <input type="hidden" name="pid" value="<?php echo $pid ?>">
                                  <input type="hidden" name="from" value="ncg_project_info.php">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="assign-owner">Add</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
                    <div class="modal fade modal-notification" id="new-customer" tabindex="1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              
              <div class="modal-content">
                <form method="post"  action="ncg_project_info">
                  <div class="modal-header">
                      <h4>New Customer</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                  </div>

                  <input type="hidden" name="pid" value="<?php echo $pid ?>">
                  <div class="modal-body">
                      <div id="circle-basic" class="">
                        <h3>Details</h3>
                        <section class="">
                         <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon7">Customer Name</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Customer Name" name="cname" requred  onchange="takenCName(this.value)">
                          </div>
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" aria-label="" rows="6" name="description" requred   placeholder="Description"></textarea>
                          </div>
                        </section>
                        <h3>Address</h3>
                        <section class="slide">
                          <div id="address-details">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Address Type</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Address Type" required name="address_type">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Line 1</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Line 1" name="line_one" required>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Line 2</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Line 2" name="line_two" required>
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Line 3</span>
                                     </div>
                                     <input type="text" class="form-control" placeholder="Line 3" name="line_three" required>
                                   </div>
                                 </div>
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Line 4</span>
                                     </div>
                                     <input type="text" class="form-control" placeholder="Line 4" name="line_four" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Status</span>
                                      </div>
                                      <select class="form-control" name="ad_status" required>
                                        <option value="">Select</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                      </select>
                                    </div>
                                 </div>
                               </div>
                          </div>
                        </section>
                        <h3>Contacts</h3>
                        <section class="slide">
                          <div id="contact-details">
                            <div class="row">     
                              <div class="col-sm-6">
                                <div class="input-group mb-4">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">Title</span>
                                  </div>
                                  <select class="form-control" name="con_title" required>
                                      <option value="">Select...</option>
                                      <option value="Mr">Mr</option>
                                      <option value="Miss">Miss</option>
                                      <option value="Mrs">Mrs</option>
                                      <option value="Dr.">Dr.</option>
                                      <option value="Prof.">Prof.</option>
                                      <option value="Hon.">Hon.</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="input-group mb-4">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">Job Role</span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Job role" name="con_role" required>
                                </div>
                              </div>
                            </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Initials</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Initials" name="con_initials" required>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Name</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Full name" name="con_name" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Tel No (w)</span>
                                </div>
                                <input type="tel" class="form-control" placeholder="Tel Work" name="con_tel" required>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Cell No</span>
                                </div>
                                <input type="tel" class="form-control" placeholder="Cell number" name="con_cell" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="input-group mb-4">
                                    <label class="new-control new-checkbox checkbox-primary form-control">
                                      <input type="checkbox" id="email-l-chb" onchange="emailLater()" class="new-control-input">
                                      <span class="new-control-indicator"></span><span>Add email later.</span>
                                    </label>                             
                                  </div>
                            </div>
                            <div class="col-sm-12" id="email-l-div">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Email Address</span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email adrress" name="con_email" required id="con-email">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Status</span>
                                </div>
                                <select class="form-control" name="con_status" required>
                                    <option value="">Select</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                              </div>
                            </div>
                          </div>
                      </div>
                    </section>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary" name="new-client-secondary">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>
                    
                    <div class="tab-content" id="animateLineContent-4">

                      <!--details tab panel-->
                      <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                       <div class="row">
                          <div class="col-sm-12 col-md-12 col-lg-8">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Project Name</span>
                                </div>
                                <h4 class="form-control"><?php echo $project_info['PROJECT_NAME']?></h4>
                                <div class="input-group-append">
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" title="<?=$tooltip?>" data-toggle="<?=$toggle?>" data-target="#renameProject"   style="margin-left: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                              </div>
                              </div>
                          </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text form-control" id="basic-addon5">Work Progress</span>
                              </div>
                              <div class="form-control"><?php echo $project_info['PROJECT_PROGRESS']?>%</div>
                               <div class="input-group-append">
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" title="<?=$tooltip?>" data-toggle="<?=$toggle?>" data-target="#updateProgress"   style="margin-left: 5px;">Update</a>
                              </div>
                              
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12" style="display: none;">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Contract Date</span>
                              </div>
                              <h4 class="form-control"><?php echo date("d M Y ", strtotime($project_info['CONTRACT_DATE']))?></h4>
                            </div>
                        </div>
                       </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Start Date (Baseline)</span>
                              </div>
                              <h4 class="form-control"><?php echo date("d M Y ", strtotime($project_info['BASE_START']))?></h4>
                            </div>
                        </div>
                        </div>
                        <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Contractual End Date</span>
                              </div>
                              <h4 class="form-control"><?php echo date("d M Y ", strtotime($project_info['CONTRACTUAL_END']))?></h4>
                            </div>
                        </div>
                          <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Estimated Completion Date</span>
                              </div>
                              <h4 class="form-control"><?php echo date("d M Y ", strtotime($project_info['ESTIMATED_END_DATE']))?></h4>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Contract Value (Start)</span>
                              </div>
                              <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_info['CONTRACT_VALUE'])?></h4>
                              <div class="input-group-append">
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" title="<?=$tooltip?>" data-toggle="<?=$toggle?>" data-target="#changeCV"   style="margin-left: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                              </div>
                            </div>
                        </div>
                        </div>
                        <div class="row" >
                          <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Variation Value</span>
                              </div>
                              <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['VARIATION_VALUE'])?></h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Contract Value (Current)</span>
                              </div>
                             <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE'])?></h4>
                            </div>
                        </div>
                        </div>
                        <div class="row" >
                          <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Total Amount Claimed</span>
                              </div>
                              <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CLAIMED'])?></h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Remaining Value</span>
                              </div>
                             <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE'] - $project_finances['CLAIMED'])?></h4>
                            </div>
                        </div>
                        </div>
                        <div class="row" >
                          <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Paid Total</span>
                              </div>
                              <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['PAID'])?></h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Amount Owed</span>
                              </div>
                             <h4 class="form-control"><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CLAIMED'] - $project_finances['PAID'])?></h4>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea readonly class="form-control" rows="6"><?php echo $project_info['PROJECT_DESC']?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text form-control" id="basic-addon5">Status</span>
                              </div>
                              <h4 class="form-control"><?php echo $project['STATUS']?></h4>
                               <div class="input-group-append">
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" title="<?=$tooltip?>" data-toggle="<?=$toggle?>" data-target="#updateStatus" style="margin-left: 5px;">Update</a>
                              </div>
                              
                            </div>
                        </div>
                        </div>
                        <div class="footer-wrapper">
                                <div class="footer-section f-section-2">
                                    <div class="col-sm-12">
                                <a href="ncg_projects" class="btn btn-primary mb-2 mr-2 btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" style="color: #FFFFFF; fill: transparent;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Close </a>
                            </div>
                                </div>
                            </div>
                      </div>
                      <!--details tab panel-->
                      <!--variation order tab panel-->
                      <div class="tab-pane fade show" id="orders" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <?php 
                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){
                        if($project['STATUS'] != "Complete" && $project['STATUS'] != "Terminated"){
                          if($project['CUSTOMER_ID'] != 0){?>
                        <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#new-vo"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New VO</a>
                      <?php }}} ?>
                         <div class="modal fade" id="new-vo" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              
              <div class="modal-content">
                <form method="post"  action="ncg_project_info">
                  <input type="hidden" name="projectId" value="<?php echo $pid?>">
                  <div class="modal-header">
                      <h4>New Variation Order</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div id="circle-basic" class="">
                        <section class="">
                         <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon7">Reason for VO</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Reason" name="voReason" required >
                          </div>
                        </section>
                        <section class="slide">
                          <div id="address-details">
                               <div class="row">
                                 <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Variation Value</span>
                                    </div>
                                    <input type="hidden" id="oldValue" value="<?php echo number_format($project_finances['CURRENT_VALUE'], "0", ".", ",")?>">
                                    <input id="newVOA" onkeyup="newAmount(this.value)" class="form-control" placeholder="<?php echo $project_info['CURRENCY']?> 0.00" name="voAmount" >
                                  </div>
                                </div>
                                </div>

                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Current Contract Value</span>
                                    </div>
                                    <input class="form-control" value="<?php echo $project_info['CURRENCY']." ".number_format($project_finances['CURRENT_VALUE'], "0", ".", ",")?>" readonly >
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">New Contract Value</span>
                                    </div>
                                    <input class="form-control" id="newCV" value="<?php echo number_format($project_finances['CURRENT_VALUE'], "0", ".", ",")?>" readonly >
                                  </div>
                                </div>
                              </div>
                          </div>
                        </section>

                        <section class="slide">
                         
                          <div class="row">
                          <div class="col-sm-12">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" aria-label="" rows="6" name="voDesc" required   placeholder="Description"></textarea>
                          </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Status</span>
                                </div>
                                <select class="form-control" name="voStatus" required>
                                    <option value="">Select</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </section>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary" name="new-vo">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>
                        <section id="variation-list">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="variation-pagination" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>VO Value</th>
                                            <th>Total VO</th>
                                            <th>Prev Contract Value</th>
                                            <th>New Contract Value</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center">Action</th>
                                          <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $variation_orders = NCG_FUNCT::GET_VARIATION_ORDERS($pid);
                                        $total_vo = 0;
                                        while($variation_order = $variation_orders ->fetch_assoc()){
                                          $total_vo +=$variation_order['VO_AMOUNT'];
                                      ?>
                                        <tr>
                                            <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($variation_order['VO_AMOUNT'])?></td>
                                            <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($total_vo)?></td>
                                            <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($variation_order['PREV_CONTRACT_VALUE'])?></td>
                                            <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($variation_order['NEW_CONTRACT_VALUE'])?></td>
                                            <td><?php echo $variation_order['VO_DESC']?></td>
                                            <td><?php echo $variation_order['VO_STATUS']?></td>
                                             <?php
                                              $dom = "vo=".$variation_order['REC_ID']."&C=".$project_info['CURRENCY']."&pid=".$pid;
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){
                                              ?>
                                            <td class="text-center"> <a class="btn btn-primary" href="ncg_vo_info?xyz=<?=$dirty_data?>">view</a> </td>
                                          <?php }?>
                                        </tr>
                                        <?php
                                          }
                                          ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>VO Value</th>
                                            <th>Total VO</th>
                                            <th>Prev Contract Value</th>
                                            <th>New Contract Value</th>
                                            <th>Description</th>
                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center">Action</th>
                                          <?php }?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                      </div>
                      <!--variation order tab panel-->
                      <!--payment certificate tab panel-->
                      <div class="tab-pane fade show" id="certificates" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <?php 
                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){
                        if($project['STATUS'] != "Complete" && $project['STATUS'] != "Terminated"){
                          if($project['CUSTOMER_ID'] != 0){
                            if($project_finances['PAID']< $project_finances['CURRENT_VALUE']){?>
                        <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#new-payment"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Payment Certificate</a>
                      <?php }}}}?>
                         <div class="modal fade" id="new-payment" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                              
                              <div class="modal-content">
                                <form method="post"  action="ncg_project_info">
                                  <input type="hidden" name="projectId" value="<?php echo $pid?>">
                                  <div class="modal-header">
                                      <h4>New Payment Certificate</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div id="circle-basic" class="">
                                        <section class="">
                                         <div class="row">
                                          <div class="col-lg-6">
                                           <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon7">Pay Cert Number</span>
                                              </div>
                                              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Cert Number" name="certNum" required >
                                            </div>
                                          </div>
                                          <div class="col-lg-6">
                                           <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon7">Reason for Pay Cert</span>
                                              </div>
                                              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Reason" name="payCertReason" required >
                                            </div>
                                          </div>
                                        </div>
                                        </section>
                                        <section class="slide">
                                          <div id="address-details">
                                               <div class="row">
                                                <div class="col-lg-6">
                                                  <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                  <span class="input-group-text">Submission Date</span>
                                                      </div>
                                                      <input id="submission-id" onchange="updateDue(this.value)"  class="form-control flatpickr flatpickr-input active" type="text" name="subDate" placeholder="Select Date.." required>
                                                  </div>
                                                </div>
                                                 <div class="col-lg-6">
                                                  <div class="input-group mb-4">
                                                   <div class="input-group-prepend">
                                                  <span class="input-group-text">Pay Cert Due Date</span>
                                                </div>
                                                <input id="due-id"  class="form-control flatpickr flatpickr-input active" type="text" name="dueDate" placeholder="Select Date.." required>
                                                  </div>
                                                </div>
                                                </div>
                                          </div>
                                        </section>

                                        <section class="slide">
                                          <div id="address-details">
                                               <div class="row">
                                                 <div class="col-lg-6">
                                                  <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text" id="basic-addon5">Pay Cert Amount</span>
                                                    </div>
                                                    <input  class="form-control" placeholder="<?php echo $project_info['CURRENCY']?> 0.00" name="payCertAmt" required type="number" min="0" max="<?=$project_finances['CURRENT_VALUE'] - $project_finances['CLAIMED']?>">
                                                  </div>
                                                </div>

                                                <div class="col-sm-6">
                                                  <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text" id="basic-addon5">Status</span>
                                                    </div>
                                                    <select class="form-control" name="certStatus" required>
                                                        <option value="">Select</option>
                                                        <option value="Paid">Paid</option>
                                                        <option selected value="Outstanding">Outstanding</option>
                                                        <option value="Partially">Partially</option>
                                                        <option value="Overdue">Overdue</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                </div>
                                          </div>
                                        </section>

                                        <section class="slide">
                                         
                                          <div class="row">
                                          <div class="col-sm-12">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Description</span>
                                            </div>
                                            <textarea class="form-control" aria-label="" rows="6" name="payCertDesc" required   placeholder="Description"></textarea>
                                          </div>
                                            </div>
                                          </div>
                                        </section>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary" name="new-pay-cert-jl21">Save</button>
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                        <section id="certificate-list">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="certificate-pagination" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Submission Date</th>
                                            <th>CERT NUM</th>
                                            <th>Pay-Cert Claimed Amount</th>
                                            <th>Total Paid Amount</th>
                                            <th>Description</th>
                                            <th>Status</th>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center">Action</th>
                                          <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $payment_certificates = NCG_FUNCT::GET_PAYMENT_CERTIFICATES($pid);
                                        $temp = 0;
                                        while($payment_cert = $payment_certificates ->fetch_assoc()){
                                            $payDate = date("d M Y ", strtotime($payment_cert["CERT_SUB_DATE"]));
                                            if($temp == 0){
                                              $totalAmnt = $payment_cert['CERT_AMOUNT'];
                                            }else{
                                              $totalAmnt = $temp + $payment_cert['CERT_AMOUNT'];
                                            }
                                            $temp = $totalAmnt;
                                        ?>
                                        <tr>
                                            <td><?php echo $payDate ?></td>
                                            <td><?php echo $payment_cert['CERT_NUM'] ?></td>
                                            <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($payment_cert['CERT_AMOUNT'])?></td>
                                            <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER(NCG_FUNCT::GET_TOTAL_PAID_JL21($payment_cert['CERT_NUM'], $pid))?></td>
                                            <td><?php echo $payment_cert['CERT_DESC']?></td>
                                            <td><?php echo $payment_cert['CERT_STATUS']?></td>
                                             <?php
                                              $dom = "pc=".$payment_cert['REC_ID']."&C=".$project_info['CURRENCY']."&pid=".$pid;
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <td class="text-center"> <a class="btn btn-primary" href="ncg_pay_cert_info?xyz=<?=$dirty_data?>">view</a> </td>
                                          <?php }?>
                                          
                                        </tr>
                                        <?php
                                          }
                                          ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Submission Date</th>
                                            <th>Cert Num</th>
                                            <th>Pay-Cert Claimed Amount</th>
                                            <th>Total Claimed Amount</th>
                                            <th>Description</th>
                                            <th>Status</th>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center">Action</th>
                                            <?php }?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                      </div>
                      <!--payment certificate tab panel-->
                       <!--completion date tab panel-->
                      <div class="tab-pane fade show" id="completion" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                        <?php 
                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){
                        if($project['STATUS'] != "Complete" && $project['STATUS'] != "Terminated"){
                          if($project['CUSTOMER_ID'] != 0){?>
                         <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#new-date"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New  Date</a>
                       <?php }}}?>
                          <div class="modal fade" id="new-date" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                              
                              <div class="modal-content">
                                <form method="post"  action="ncg_project_info">
                                  <input type="hidden" name="projectId" value="<?php echo $pid?>">
                                  <input type="hidden" id="contrDate" value="<?php echo date("d M Y ", strtotime($project_info['CONTRACT_DATE']))?>">
                                  <input type="hidden" name="" id="cEnd" value="<?php echo date("d M Y ", strtotime($project_info['ESTIMATED_END_DATE']))?>">
                                  <div class="modal-header">
                                      <h4>New Delivery Date</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div id="circle-basic" class="">

                                       <div class="row">
                                       <div class="col-sm-12">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="basic-addon5">Reason for Update</span>
                                             </div>
                                             <input type="text" class="form-control" required name="amdReason">
                                           </div>
                                       </div>
                                       <div class="col-lg-6">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="dateTag">Current Project Timeline</span>
                                             </div>
                                             <h4 class="form-control" id="currentDate"><?php echo date("d M Y ", strtotime($project_info['BASE_START']))?> to <?php echo date("d M Y ", strtotime($project_info['ESTIMATED_END_DATE']))?></h4>
                                           </div>
                                       </div>
                                       <div class="col-lg-6" id="dateDiv">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="dateInputTag">New Delivery Date</span>
                                             </div>
                                             <input id="dateInp"  class="form-control flatpickr flatpickr-input active" type="text" name="newDate" placeholder="Select Date.." required>
                                           </div>
                                       </div>
                                       <div class="col-sm-12">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text">Description</span>
                                           </div>
                                           <textarea class="form-control" aria-label="" rows="10" required name="amdDesc"></textarea>
                                           </div>
                                       </div>
                                     </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary" name="new-date-amd-jl21">Save</button>
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                        <section id="completion-list">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="completions-pagination" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Previous Date</th>
                                            <th>New Date</th>
                                            <th>Reason</th>
                                            <th>Description</th>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center">Action</th>
                                          <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $project_dates = NCG_FUNCT::GET_PROJECT_DATES($pid);
                                        while($project_date = $project_dates ->fetch_assoc()){ 
                                          $previous_date = date("d M Y ", strtotime($project_date['PREV_DATE']));
                                          $new_date = date("d M Y ", strtotime($project_date['NEW_DATE']));
                                          ?>
                                        <tr>
                                            <td><?php echo $previous_date ?></td>
                                            <td><?php echo $new_date ?></td>
                                            <td><?php echo $project_date['DATE_REASON']?></td>
                                            <td><?php echo $project_date['DATE_DESC']?></td>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <td class="text-center"> <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#view-date-<?php echo $project_date['REC_ID']?>">view</a> </td>
                                          <?php }?>
                                        </tr>
                                        <div class="modal fade" id="view-date-<?php echo $project_date['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                              
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4>Project <strong><?php echo strtoupper($project_info['PROJECT_NAME'])?> </strong>Delivery Date</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div id="circle-basic" class="">
                                        <div class="row">
                                       <div class="col-sm-12">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="basic-addon5">Reason for Update</span>
                                             </div>
                                             <h4 class="form-control"><?php echo $project_date['DATE_REASON']?></h4>
                                           </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="dateTag">Previous Date</span>
                                             </div>
                                             <h4 class="form-control" id="currentDate"><?php echo $previous_date?></h4>
                                           </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text" id="dateInputTag">New Delivery Date</span>
                                             </div>
                                             <h4 class="form-control"><?php echo $new_date ?></h4>
                                           </div>
                                       </div>
                                       <div class="col-sm-12">
                                           <div class="input-group mb-4">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text">Description</span>
                                           </div>
                                           <h4 class="form-control"><?php echo $project_date['DATE_DESC']?></h4>
                                           </div>
                                       </div>
                                       <?php
                                       $user_info = NCG_FUNCT::GET_USER_INFO($project_date['CREATED_BY']);
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
                                           <div class="col-sm-12" style="display: none;">
                                               <div class="input-group mb-4">
                                                 <div class="input-group-prepend">
                                                   <h4 class="input-group-text">Created By:</h4>
                                               </div>
                                               <h4 class="form-control"><img src="<?php echo $photo;?>" style="width: 30px; height: 30px; border-radius: 30px;">  <?php echo $user_info['NAME']?></h4>
                                               <div class="input-group-append">
                                                 <?php
                                              $dom = "id=".$project_date['CREATED_BY']."&control=control";
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>
                                                 <a class="btn btn-primary" href="ncg_user_profile?xyz=<?=$dirty_data?>" target="_blank">view</a>
                                               </div>
                                               </div>
                                           </div>
                                           </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                                        <?php
                                          }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Previous Date</th>
                                            <th>New Date</th>
                                            <th>Reason</th>
                                            <th>Description</th>
                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID']) ){?>
                                            <th class="text-center">Action</th>
                                          <?php }?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                        
                      </div>
                      <!--payment certificate tab panel-->


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
                    include 'includes/footer.php';?>
           </div>
       </div>
        <script type="text/javascript">

          
      function variations(id){
        var list = document.getElementById("variation-list");
        var edit = document.getElementById("variation-edit");
        if(id == "list"){
          list.style.display = "block";
          edit.style.display = "none";
        }
        if(id == "details"){
          list.style.display = "none";
          edit.style.display = "block";
        }

      }function certificates(id){
        var list = document.getElementById("certificate-list");
        var edit = document.getElementById("certificate-edit");
        if(id == "list"){
          list.style.display = "block";
          edit.style.display = "none";
        }
        if(id == "details"){
          list.style.display = "none";
          edit.style.display = "block";
        }

      }function completion(id){
        var list = document.getElementById("completion-list");
        var edit = document.getElementById("completion-edit");
        if(id == "list"){
          list.style.display = "block";
          edit.style.display = "none";
        }
        if(id == "details"){
          list.style.display = "none";
          edit.style.display = "block";
        }

      }
    </script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="plugins/jquery-step/custom-jquery.steps.js"></script>

    <script src="plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
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
            App.init();
            var $_min_date = document.getElementById("contrDate").value;
            setMinDelivery($_min_date);
        });
    </script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="plugins/noUiSlider/nouislider.min.js"></script>

    <script type="text/javascript">

      var f4 = flatpickr(document.getElementById('dateInp'));
      function setMinDelivery($date){
        f4.set('minDate', date);
      }
      var submission = flatpickr(document.getElementById('submission-id'));

      var due = flatpickr(document.getElementById('due-id'));
      function updateDue(date) {
         
          var due = flatpickr(document.getElementById('due-id'));
          due.set("minDate", date);
          due.value = date;
      }
      
    </script>
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
    <script>
        $(document).ready(function() {
            $('#variation-pagination').DataTable( {
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
            $('#certificate-pagination').DataTable( {
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
            $('#completions-pagination').DataTable( {
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
    <script type="text/javascript">
       $('.decimal-formatter').formatter({
            'pattern': "{{999}}.{{99}}"
          });
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
      function newAmount(i){
        var h = document.getElementById("newCV");
        var y = document.getElementById("oldValue").value;
        var x = y.replaceAll(",","");
        var z = parseFloat(x) + parseFloat(i);
        h.value = new Number(z).toLocaleString("en-US");
        if(i <= 0){
          h.value = y;
        }

      }
    </script>
    
    <script type="text/javascript">
      $('.warning-tt').tooltip({
          template: '<div class="tooltip tooltip-warning" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
      });
    </script>
</body>
</html>