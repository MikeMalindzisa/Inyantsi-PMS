<?php
$link = "ncg_customer_info.php";
$level_of_access = "root";
$page = "INYATSI SYSTEM SETTINGS";
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

        <style type="text/css">
            
            .logo-add{
              text-align: center;
              width: 100px;
              height: 100px;
              border-radius: 10%;
              align-content: center;
            }
            .logo-add:hover{
              background-color: rgb(0,0,0,0.5);
            }
            .cus-projects{
                color :#fff;
                font-weight: bold;
                padding-top: 15px;
                padding-bottom: 15px;
        -webkit-transition: -webkit-transform .2s ease-in-out;
        transition: -webkit-transform .2s ease-in-out;
        transition: transform .2s ease-in-out;
        transition: transform .2s ease-in-out, -webkit-transform .2s ease-in-out;
            }

            .cus-projects:hover{
                color :#2387F3;
                margin-left: 15px;
            }
        </style>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <input type="hidden" id="message" value="<?php echo $msg?>">
            <input type="hidden" id="title" value="System Settings">
            <input type="hidden" id="response" value="<?php echo $response?>">
            <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>System Settings</h3>                                
                  <div class="animated-underline-content">
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="animated-underline-profile-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="animated-underline-contacts" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>  Contacts &amp; Addresses</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#animated-underline-about" role="tab" aria-controls="animated-underline-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> About Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-tcs-tab" data-toggle="tab" href="#animated-underline-terms" role="tab" aria-controls="animated-underline-terms" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Terms &amp; Conditions</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-prv-tab" data-toggle="tab" href="#animated-underline-prv" role="tab" aria-controls="animated-underline-prv" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg> Privacy Policy</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-mail-tab" data-toggle="tab" href="#animated-underline-mail" role="tab" aria-controls="animated-underline-mail" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg> Mail Setup</a>
                      </li>
                    </ul>

                    <div class="tab-content" id="animateLineContent-4">                      

                      <div class="tab-pane fade show active" id="addresses" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                        <div id="address-list" style="display: block;">
                            <a class="btn btn-primary" style="float: center;" href="javascript:void(0);" data-toggle="modal" data-target="#new-address"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Record</a>
                          <div class="hd-tab-section">
                      <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="hd-statistics">
                          <?php
                            $con_items = NCG_FUNCT::GET_CONTACT_US();
                            if(mysqli_num_rows($con_items) > 0){
                              $count = 1;
                              while($con_item = $con_items ->fetch_assoc()){?>
                                <div class="card">
                            <div class="card-header" id="hd-statistics-<?php echo $con_item['REC_ID']?>">
                              <div class="mb-0">
                                <div class="collapsed" data-toggle="collapse" role="navigation" data-target="#collapse-hd-statistics-<?php echo $con_item['REC_ID']?>" aria-expanded="false" aria-controls="collapse-hd-statistics-1">
                                  <span style="padding: 10px;"><?php echo $count;
                                  $count++;
                                  ?></span>
                                  <?php echo $con_item['REC_TITLE']?>
                                </div>
                              </div>
                            </div>

                            <div id="collapse-hd-statistics-<?php echo $con_item['REC_ID']?>" class="collapse" aria-labelledby="hd-statistics-<?php echo $con_item['REC_ID']?>" data-parent="#hd-statistics" style="">
                              <div class="card-body">
                                
                    <div class="row">
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <div class="row">
                                <div class="col-sm-10">
                                <h5 class="">Contacts</h5>
                                </div>
                                <div class="col-sm-2" style="float: right;">
                                  <a class="btn btn-dark mb-2 mr-2 rounded-circle" style="right: 0;" href="javascript:void(0);" data-toggle="modal" data-target="#new-contact-<?php echo $con_item['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                              </div>
                            </div>

                            <div class="widget-content">
                              <?php 
                                $contacts = NCG_FUNCT::GET_CON_CONTACTS($con_item['REC_ID']);
                                if(mysqli_num_rows($contacts) > 0){
                                  while($contact = $contacts ->fetch_assoc()){ 
                                    $contact_value = $contact['CON_SET_VALUE'];
                                        $contact_value = str_replace("plus ", "+", $contact_value);
                                        $contact_value = str_replace("open ", "(", $contact_value);
                                        $contact_value = str_replace(" close ", ") ", $contact_value);
                                        $contact_value = str_replace(" slash ", "/", $contact_value);
                                    ?>

                                    <div class="transactions-list">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="icon" style="background-color: #252525; ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4><?php echo $contact_value?></h4>
                                                </div>

                                            </div>
                                            <div class="t-rate rate-dec">
                                                <p><span><?php echo $contact['CON_SET_TYPE']?></span> </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                }
                                else{
                                  echo "<h4> No contacts</h4>"; ?>
                                  <?php
                                }
                                  ?>
                                  <div class="modal fade" id="new-contact-<?php echo $con_item['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                              <input type="hidden" name="rec-id" value="<?php echo $con_item['REC_ID']?>">
                          <div class="modal-header">
                            <h4>New Contact</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Contact</span>
                                    </div>
                                    <input type="tel" class="form-control" name="con-line-1" required placeholder="Contact" id="contact-id">
                                    <div class="input-group-append">
                                      <select onchange="switchType(this.options[this.selectedIndex].value)" name="con-line-2">
                                        <option selected value="Tel">Tel</option>
                                        <option value="Cell">Cell</option>
                                        <option value="Fax">Fax</option>
                                        <option value="Email">Email</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </section>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-con-contact"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                            </div>
                        </div>
                    </div>
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                              <div class="row">
                                <div class="col-sm-10">
                                <h5 class="">Street Addresses</h5>
                                </div>
                                <div class="col-sm-2" style="float: right;">
                                  <a class="btn btn-dark mb-2 mr-2 rounded-circle" style="right: 0;" href="javascript:void(0);" data-toggle="modal" data-target="#new-location-<?php echo $con_item['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                              </div>
                                
                            </div>

                            <div class="widget-content">
                                <?php 
                                $addresses = NCG_FUNCT::GET_CON_LOCATIONS($con_item['REC_ID']);
                                if(mysqli_num_rows($addresses) > 0){
                                  while($address = $addresses ->fetch_assoc()){
                                    $full_address = $address['LINE_1'].", Plot ".$address['LINE_2'];
                                    ?>
                                    <div class="transactions-list">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="icon" style="background-color: #252525; ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4><?php echo $full_address; ?></h4>
                                                    <p class="meta-date"><?php echo $address['LINE_3'].", ".$address['LINE_4']?></p>
                                                </div>

                                            </div>
                                            <div class="t-rate rate-dec">
                                                <p><span><?php echo $address['LINE_5']?></span> </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                }
                                else{
                                  echo "<h4> No addresses.</h4>"; ?>
                                  <?php
                                }
                                  ?>
                                  <div class="modal fade" id="new-location-<?php echo $con_item['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                              <input type="hidden" name="rec-id" value="<?php echo $con_item['REC_ID']?>">
                          <div class="modal-header">
                            <h4>New Address</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                              
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Building</span>
                                    </div>
                                    <input type="text" class="form-control" name="loc-line-1" required placeholder="Line 1">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Plot</span>
                                    </div>
                                    <input type="text" class="form-control" name="loc-line-2" required placeholder="Line 2">
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Street</span>
                                     </div>
                                     <input type="text" class="form-control" name="loc-line-3" required placeholder="Line 3">
                                   </div>
                                 </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Town</span>
                                     </div>
                                     <input type="text" class="form-control" name="loc-line-4" required placeholder="Line 4">
                                    </div>
                                  </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Country</span>
                                     </div>
                                     <input type="text" class="form-control" name="loc-line-5" required placeholder="Line 4">
                                    </div>
                                  </div>
                                </div>
                        </section>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-con-location"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                            </div>
                        </div>
                    </div>
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <div class="row">
                                <div class="col-sm-10">
                                <h5 class="">Postal Addresses</h5>
                                </div>
                                <div class="col-sm-2" style="float: right;">
                                  <a class="btn btn-dark mb-2 mr-2 rounded-circle" style="right: 0;" href="javascript:void(0);" data-toggle="modal" data-target="#new-postal-<?php echo $con_item['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                              </div>
                            </div>

                            <div class="widget-content">
                                <?php 
                                $postals = NCG_FUNCT::GET_CON_POSTALS($con_item['REC_ID']);
                                if(mysqli_num_rows($postals) > 0){
                                  while($postal = $postals ->fetch_assoc()){ ?>

                                    <div class="transactions-list">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="icon" style="background-color: #252525; ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4>P.O Box <?php echo $postal['LINE_1']?></h4>
                                                    <p class="meta-date"><?php echo $postal['LINE_2'].", ".$postal['LINE_3']?></p>
                                                </div>

                                            </div>
                                            <div class="t-rate rate-dec">
                                                <p><span><?php echo $postal['LINE_4']?></span> </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                }
                                else{
                                  echo "<h4> No postal address</h4>"; ?>
                                  <?php
                                }
                                  ?>
                                  <div class="modal fade" id="new-postal-<?php echo $con_item['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                              <input type="hidden" name="rec-id" value="<?php echo $con_item['REC_ID']?>">
                          <div class="modal-header">
                            <h4>New Postal Address</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">P.O Box</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-1" required placeholder="Line 1">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Town</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-2" required placeholder="Line 2">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Country</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-3" required placeholder="Line 3">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Postal Code</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-4" required placeholder="Line 4">
                                  </div>
                                </div>
                              </div>
                        </section>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-con-postal"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                            </div>
                        </div>
                    </div>
                  </div>
                              </div>
                            </div>
                          </div>
                              <?php }
                            }else{
                              echo "<h4>No contact us information!</h4>";
                            }

                            ?>

                        </div>


                    </div>
                </div>                            
            </div>
                        </div>

                      <div class="modal fade active" id="new-address" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                          <div class="modal-header">
                            <h4>New Contact Us Detail</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                          <div id="address-details">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Title</span>
                                    </div>
                                    <input type="text" class="form-control" name="title" required placeholder="Title">
                                  </div>
                                </div>
                              </div>
                              <hr/>
                              <h4>Contact Info</h4>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Contact</span>
                                    </div>
                                    <input type="text" class="form-control" name="con-line-1" required placeholder="Contact" id="contact-id">
                                    <div class="input-group-append">
                                      <select onchange="switchType(this.options[this.selectedIndex].value)" name="con-line-2">
                                        <option value="Tel">Tel</option>
                                        <option value="Cell">Cell</option>
                                        <option value="Fax">Fax</option>
                                        <option value="Email">Email</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr/>
                              <h4>Street Address</h4>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Building</span>
                                    </div>
                                    <input type="text" class="form-control" name="loc-line-1" required placeholder="Line 1">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Plot</span>
                                    </div>
                                    <input type="text" class="form-control" name="loc-line-2" required placeholder="Line 2">
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Street</span>
                                     </div>
                                     <input type="text" class="form-control" name="loc-line-3" required placeholder="Line 3">
                                   </div>
                                 </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Town</span>
                                     </div>
                                     <input type="text" class="form-control" name="loc-line-4" required placeholder="Line 4">
                                    </div>
                                  </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Country</span>
                                     </div>
                                     <input type="text" class="form-control" name="loc-line-5" required placeholder="Line 4">
                                    </div>
                                  </div>
                                </div>
                          </div>
                              <hr/>
                              <h4>Postal Address Info</h4>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">P.O Box</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-1" required placeholder="Line 1">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Town</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-2" required placeholder="Line 2">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Country</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-3" required placeholder="Line 3">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Postal Code</span>
                                    </div>
                                    <input type="text" class="form-control" name="pos-line-4" required placeholder="Line 4">
                                  </div>
                                </div>
                              </div>
                        </section>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-con-us"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                      </div>

                      <div class="tab-pane fade" id="animated-underline-about" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                        <a class="btn btn-primary" style="float: center;" href="javascript:void(0);" data-toggle="modal" data-target="#new-about-us-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Item</a>
                        <div class="hd-tab-section">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="about-us-info">
                          <?php 
                          $about_us_info = NCG_FUNCT::GET_ABOUT_US();
                          if(mysqli_num_rows($about_us_info) >0){
                            while($about = $about_us_info ->fetch_assoc()){?>
                              <div class="card">
                                <div class="card-header" id="about-us-<?php echo $about['REC_ID']?>">
                                  <div class="mb-0">
                                    <div class="collapsed" data-toggle="collapse" role="navigation" data-target="#collapse-about-us-<?php echo $about['REC_ID']?>" aria-expanded="false" aria-controls="collapse-hd-statistics-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                                      <?php echo $about['ITEM_TITLE']?>
                                    </div>
                                  </div>
                                </div>

                                <div id="collapse-about-us-<?php echo $about['REC_ID']?>" class="collapse" aria-labelledby="about-us-<?php echo $about['REC_ID']?>" data-parent="#about-us-info" style="">
                                  <div class="card-body">
                                    <p><?php echo NCG_FUNCT::NCG_DECRYPT($about['ITEM_CONTENT'])?></p>
                                  </div>
                                </div>
                              </div>
                            <?php }
                          }else{
                            echo "<h4>About Us information not set.";
                          }
                          ?>

                        </div>


                    </div>
                </div>                            
            </div>
                       <div class="modal fade" id="new-about-us-item" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                          <div class="modal-header">
                            <h4>New About Us Item</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Title</span>
                                    </div>
                                    <input type="text" class="form-control" name="item-title" required placeholder="Title">
                                  </div>
                                </div>
                              </div>
                              <hr/>
                              <h4>About Content</h4>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Content</span>
                                    </div>
                                    <textarea class="form-control" aria-label="" rows="6" name="item-content" requred   placeholder="Type here..."></textarea>
                                  </div>
                                </div>
                              </div>
                        </section>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-abt-us"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                      </div>




                      <div class="tab-pane fade" id="animated-underline-mail" role="tabpanel" aria-labelledby="animated-underline-mail-tab">        
                           <section id="external-groups">
                              <a class="btn btn-primary" style="float: left;" href="javascript:void(0);" data-toggle="modal" data-target="#new-configuration"> New Configuration
                              </a>
                              <br>
                            </h3>
                          <div class="table-responsive mb-4 mt-4">
                                <table id="smtp_config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>HOST</th>
                                            <th>EMAIL</th>
                                            <th>PASSWORD</th>
                                            <th>SMTP AUTH</th>
                                            <th>SMTP PROTOCOL</th>
                                            <th>PORT 1</th>
                                            <th>PORT 2</th>
                                            <th>STATUS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $configurations = NCG_FUNCT::GET_SMTP_CONFIGURATIONS();
                                            while($config = $configurations ->fetch_assoc()){
                                              $smtp_email = NCG_FUNCT::NCG_DECRYPT($config['EMAIL']);
                                              $smtp_pass = NCG_FUNCT::NCG_DECRYPT($config['PASSWORD']);
                                              $smtp_port_1 = NCG_FUNCT::NCG_DECRYPT($config['SMTP_PORT_DEFAULT']);
                                              $smtp_port_2 = NCG_FUNCT::NCG_DECRYPT($config['SMTP_PORT']);
                                              $smtp_protocol = NCG_FUNCT::NCG_DECRYPT($config['SMTP_SECURE']);
                                              $smtp_auth = NCG_FUNCT::NCG_DECRYPT($config['SMTP_AUTH']);
                                              $smtp_host = NCG_FUNCT::NCG_DECRYPT($config['SMTP_SERVER']);
                                                if($smtp_auth == "true"){
                                                  $true = "checked";
                                                  $false = "";
                                                }else{
                                                  $true = "";
                                                  $false = "checked";
                                                }
                                                if($smtp_protocol == "tls"){
                                                  $tls = "checked";
                                                  $ssl = "";
                                                }else{
                                                  $tls = "";
                                                  $ssl = "checked";
                                                }
                                                if($config['STATUS'] == "Active"){
                                                  $active = "checked";
                                                  $inactive = "";
                                                }else{
                                                  $active = "";
                                                  $inactive = "checked";
                                                }

                                              ?>
                                        <tr>
                                            <td><?=$smtp_host ?></td>
                                            <td><?=$smtp_email ?></td>
                                            <td><?=$smtp_pass?></td>
                                            <td><?=$smtp_auth ?></td>
                                            <td><?=$smtp_protocol?></td>
                                            <td><?=$smtp_port_1?></td>
                                            <td><?=$smtp_port_2?></td>
                                            <td><?=$config['STATUS']?></td>

                                              <?php
                                              $dom = "id=".$config['EMAIL']."&control=control";
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>
                                            <td><a class="btn btn-primary" style="float: left;" href="javascript:void(0);" data-toggle="modal" data-target="#edit-configuration-<?=$config['REC_ID']?>"> Edit Configuration
                                            </a></td> 

                         <div class="modal fade" id="edit-configuration-<?=$config['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                          <div class="modal-header">
                            <h4>Edit SMTP Configurations</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                              
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Email Account</span>
                                    </div>
                                    <input type="email" class="form-control" name="smtp-email" value="<?=$smtp_email?>" required placeholder="Email account">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Account Password</span>
                                    </div>
                                    <input type="password" class="form-control" value="<?=$smtp_pass?>" name="smtp-pass" required placeholder="password">
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Host / Server</span>
                                     </div>
                                     <input type="text" class="form-control" name="smtp-server" value="<?=$smtp_host?>" required placeholder="Host">
                                   </div>
                                 </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Port 1</span>
                                     </div>
                                     <input type="text" class="form-control" name="smtp-port-1" value="<?=$smtp_port_1?>" required placeholder="port 1">
                                   </div>
                                 </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Port 2</span>
                                     </div>
                                     <input type="text" class="form-control" name="smtp-port-2" value="<?=$smtp_port_2?>" required placeholder="port 2">
                                    </div>
                                  </div>
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Use SMTP Auth</span>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" required value="true" <?=$true?> name="smtp-auth" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline1">Turn On</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" required value="false" <?=$false?> name="smtp-auth" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline2">Turn Off</label>
                                        </div>
                                    </div>
                                  </div>

                                 <div class="col-lg-12">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Encryption Protocol</span>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline3" required value="ssl" <?=$ssl?> name="smtp-protocol" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline3">SSL (Secure Socket Layer)</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline4" required value="tls" <?=$tls?> name="smtp-protocol" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline4">TLS (Transport Layer Security)</label>
                                        </div>
                                    </div>
                                  </div>
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Set As Active Confuguration</span>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline5" value="Active" <?=$active?> name="config-status" class="custom-control-input" required>
                                            <label class="custom-control-label" for="customRadioInline5">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline6" value="Inactive" <?=$inactive?> name="config-status" class="custom-control-input" required>
                                            <label class="custom-control-label" for="customRadioInline6">No</label>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                        </section>
                          </div>
                          <input type="hidden" name="config-id" value="<?=$config['REC_ID']?>">
                          <div class="modal-footer">
                            <?php
                              $dom = "action=delete-smtp-config&cid=".$config['REC_ID'];
                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                              ?>
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="update-smtp-config"><i class="flaticon-cancel-12"></i> Save</button>
                            <a class="btn btn-danger" href="ncg_settings?xyz=<?=$dirty_data?>"><i class="flaticon-cancel-12"></i> Delete</a>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                                        </tr>

                                        <?php
                                        }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>HOST</th>
                                            <th>EMAIL</th>
                                            <th>PASSWORD</th>
                                            <th>SMTP AUTH</th>
                                            <th>SMTP PROTOCOL</th>
                                            <th>PORT 1</th>
                                            <th>PORT 2</th>
                                            <th>STATUS</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                         <div class="modal fade" id="new-configuration" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                          <div class="modal-header">
                            <h4>New SMTP Configurations</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
                           <section class="slide">
                              
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Email Account</span>
                                    </div>
                                    <input type="email" class="form-control" name="smtp-email" required placeholder="Email account">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Account Password</span>
                                    </div>
                                    <input type="password" class="form-control" name="smtp-pass" required placeholder="password">
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Host / Server</span>
                                     </div>
                                     <input type="text" class="form-control" name="smtp-server" required placeholder="Host">
                                   </div>
                                 </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Port 1</span>
                                     </div>
                                     <input type="text" class="form-control" name="smtp-port-1" required placeholder="port 1">
                                   </div>
                                 </div>
                                 <div class="col-lg-4">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Port 2</span>
                                     </div>
                                     <input type="text" class="form-control" name="smtp-port-2" required placeholder="port 2">
                                    </div>
                                  </div>
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Use SMTP Auth</span>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" required value="true" name="smtp-auth" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline1">Turn On</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" required value="false" name="smtp-auth" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline2">Turn Off</label>
                                        </div>
                                    </div>
                                  </div>

                                 <div class="col-lg-12">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">SMTP Encryption Protocol</span>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline3" required value="ssl" name="smtp-protocol" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline3">SSL (Secure Socket Layer)</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline4" required value="tls" name="smtp-protocol" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline4">TLS (Transport Layer Security)</label>
                                        </div>
                                    </div>
                                  </div>
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Set As Active Confuguration</span>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline5" value="Active" name="config-status" class="custom-control-input" required>
                                            <label class="custom-control-label" for="customRadioInline5">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline6" value="Inactive" name="config-status" class="custom-control-input" required>
                                            <label class="custom-control-label" for="customRadioInline6">No</label>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                        </section>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-smtp-config"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                      </div>



                      <div class="tab-pane fade" id="animated-underline-prv" role="tabpanel" aria-labelledby="animated-underline-prv-tab">           
                        <?php 
                          $privacy_data = NCG_FUNCT::GET_PRIVACY();
                          if(sizeof($privacy_data) > 0 ){?>
                            <div class="hd-tab-section">
                          
                            <div id="privacyWrapper" class="">
                              <div class="privacy-container">
                                  <div class="privacyContent">
                                      <div class="col-md-12 col-sm-12 col-12 text-center mb-5">
                                          <a href="index" class="navbar-brand-privacy">
                                              <img src="assets/img/wb_logo.png" class="img-fluid" alt="logo">
                                          </a>
                                      </div>
                                      <div class="d-flex justify-content-between privacy-head">
                                          <div class="privacyHeader">
                                              <h1>Privacy Policy</h1>
                                              <p>Updated <?php echo date("d M Y ", strtotime($privacy_data['TIMESTAMP']))?></p>
                                          </div>

                                          <div class="get-privacy-terms align-self-center">
                                              <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#edit-privacy" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg> Edit</a>
                                          </div>

                                      </div>

                                      <div class="privacy-content-container" style="color: #000!important">
                                          <?php include $privacy_data['NCG_PRIVACY'];?>
                                      </div>

                                  </div>
                              </div>
                          </div>      
                        </div>

                          <?php } 
                          else{ ?>
                            <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#edit-privacy" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg> Add Privacy Policy</a>
                          <?php }
                            ?>   
                       <div class="modal fade" id="edit-privacy" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form method="post" action="ncg_settings">
                          <div class="modal-header">
                            <h4>Update Privacy Policy</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                            <div class="widget-content widget-content-area">

                                <section class="slide">
                                 
                                  <div class="row">
                                  <div class="col-sm-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Policy</span>
                                    </div>
                                    <textarea class="form-control" aria-label="" rows="12" name="privacy-data" requred   placeholder="Type here..."></textarea>
                                  </div>
                                    </div>
                                  </div>
                                </section>

                                </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="privacy-save"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                      </div>


                      <div class="tab-pane fade" id="animated-underline-terms" role="tabpanel" aria-labelledby="animated-underline-tcs-tab">
                       <?php 
                          $terms_data = NCG_FUNCT::GET_TERMS();
                          if(sizeof($terms_data) > 0 ){?>
                            <div class="hd-tab-section">
                          
                            <div id="privacyWrapper" class="">
                              <div class="privacy-container">
                                  <div class="privacyContent">
                                      <div class="col-md-12 col-sm-12 col-12 text-center mb-5">
                                          <a href="index" class="navbar-brand-privacy">
                                              <img src="assets/img/wb_logo.png" class="img-fluid" alt="logo">
                                          </a>
                                      </div>
                                      <div class="d-flex justify-content-between privacy-head">
                                          <div class="privacyHeader">
                                              <h1>Terms and Conditions</h1>
                                              <p>Updated <?php echo date("d M Y ", strtotime($terms_data['TIMESTAMP']))?></p>
                                          </div>

                                          <div class="get-privacy-terms align-self-center">
                                              <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#edit-terms" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg> Edit</a>
                                          </div>

                                      </div>

                                      <div class="privacy-content-container" style="color:#000;">
                                        <?php include  $terms_data['NCG_TERMS'];?>
                                      </div>

                                  </div>
                              </div>
                          </div>      
                        </div>

                          <?php } 
                          else{ ?>
                            <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#edit-terms" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg> Add Terms &amp; Conditions</a>
                          <?php }
                            ?>  
                       <div class="modal fade" id="edit-terms" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_settings">
                          <div class="modal-header">
                            <h4>Update terms And Conditions</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                            <div class="widget-content widget-content-area">

                               <section class="slide">
                                 
                                  <div class="row">
                                  <div class="col-sm-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Terms</span>
                                    </div>
                                    <textarea class="form-control" aria-label="" rows="12" name="terms" requred   placeholder="Type here..."></textarea>
                                  </div>
                                    </div>
                                  </div>
                                </section>

                                </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="terms-save"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                      </div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
           </div>
            <?php
                    include 'includes/footer.php';?>
       </div>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script>
        function switchType(value){
          var input = document.getElementById("contact-id");
          if(value === "Email"){
            input.type = "email";
          }else{
            input.type = "tel";
          }
        }
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
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="plugins/bootstrap-maxlength/custom-bs-maxlength.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#customer_contacts_table').DataTable( {
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
            $('#customer_addresses_table').DataTable( {
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
            $('#smtp_config').DataTable( {
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
    
    <script src="assets/js/pages/helpdesk.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    
    <script src="plugins/editors/markdown/simplemde.min.js"></script>
    <script src="plugins/editors/markdown/custom-markdown.js"></script>
</body>
</html>