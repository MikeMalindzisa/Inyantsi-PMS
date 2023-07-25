<?php
$link = "ncg_customer_info.php";
$page = "INYATSI CUSTOMER INFORMATION";
    include "includes/header.php";
      $customer_id = $_GET['id'];
      $customer_primary_contact_request_response = NCG_FUNCT::GET_CUSTOMER_PRIMARY_CONTACT($customer_id);
      $customer_primary_address_request_response = NCG_FUNCT::GET_CUSTOMER_PRIMARY_ADDRESS($customer_id);
      $addresses_request_response = NCG_FUNCT::GET_CUSTOMER_ADDRESSES($customer_id);
      $contacts_request_response = NCG_FUNCT::GET_CUSTOMER_CONTACTS($customer_id);
      $customer_primary_contact_data = mysqli_fetch_assoc($customer_primary_contact_request_response);
      $customer_primary_address_data = mysqli_fetch_assoc($customer_primary_address_request_response);
      $customer_info = NCG_FUNCT::GET_CUSTOMER($customer_id);
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
            <input type="hidden" id="title" value="Customer Information Management">
            <input type="hidden" id="response" value="<?php echo $response?>">
            <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Customer Details</h3>                                
                  <div class="animated-underline-content">
                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Details</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="animated-underline-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg> Addresses</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Contacts</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="animateLineContent-4">


                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="animated-underline-home-tab">

                    <div class="row">
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="infobox-2" style="width: 100%; background-color: #252525;">
                            <div class="row">
                                <div class="col-md-8">
                                      <h5 class="info-heading"><strong><?php echo $customer_info['CLIENT_NAME'];?></strong></h5>
                                      <p class="info-text"><?php echo $customer_info['DESCRIPTION'];?></p>
                                      <?php
                                      $dom = "cid=".$customer_id."&control=control";
                                      $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);?>
                                      <a class=" cus-projects" href="ncg_client_projects?xyz=<?=$dirty_data?>">See Customer Projects <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>  
                                </div>
                                <?php
                                    if(NCG_FUNCT::CHECK_CUSTOMER_IMAGE($customer_id)){
                                        $img = NCG_FUNCT::GET_CUSTOMER_LOGO($customer_id);
                                        $temp_img = NCG_FUNCT::GET_CUSTOMER_LOGO($customer_id);
                                        ?>
                                <div class="col-md-4">
                                    <div class="" style="float: right; width: 100px; height: 100px; background-image: url(<?php echo $img; ?>); background-size:contain; background-position: center; background-repeat: no-repeat;">
                                    </div>
                                </div><?php }
                                else{

                               $img = "assets/img/temp.png";
                               $temp_img = "assets/img/logo.png";
                              if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){
                                $edit_img = "modal";?>
                                <div class="col-md-4">
                                    <a href="javascript:void(0);" data-toggle="<?=$edit_img?>" data-target="#add-logo">
                                        <div class="" style="line-height:100px; float: right; width: 100px; height: 100px; background-image: url(<?php echo $img; ?>); background-size:contain; background-position: center; border-radius: 10%; background-repeat: no-repeat;">
                                        <div class="logo-add">
                                            <span style="background-color: rgb(0,0,0,0.6); border-radius: 100%; color: #fff; border-radius: 5px; padding: 5px;">Add Logo</span>
                                        </div>
                                    </div>
                                    
                                    </a>
                                </div>
                                <?php
                               }else{
                                ?>
                                <div class="col-md-4">
                                    <div class="" style="float: right; width: 100px; height: 100px; background-image: url(assets/img/ww_logo.png); background-size:contain; background-position: center; background-repeat: no-repeat;">
                                    </div>
                                </div>
                                <?php

                               }
                               ?>
                                

                                <?php
                                }
                                ?>
                            </div>
                             <div class="modal fade modal-notification" id="update-email" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" id="standardModalLabel">
                                  <div class="modal-content">
                                    <form method="post" action="ncg_customer_info">
                                        <input type="hidden" name="cid" value="<?php echo $customer_id; ?>">
                                        <input type="hidden" name="from" value="ncg_customer_info.php">
                                        <input type="hidden" name="uid" value="<?php echo $customer_primary_contact_data['USER_ID']; ?>">
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
                            <div class="modal fade modal-notification" id="add-logo" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" id="standardModalLabel">
                                  <div class="modal-content">
                                    <form  enctype="multipart/form-data" method="post" action="core_functions/functions">
                                        <input type="hidden" name="cid" value="<?php echo $customer_id; ?>">
                                        <input type="hidden" name="cid" value="<?php echo $customer_primary_contact_data['USER_ID'];?>">
                                        <input type="hidden" name="from" value="ncg_users.php">
                                    <div class="modal-body text-center">
                                        <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                          <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                        </div></center>
                                        <br>
                                        <hr/>
                                        <h4>Add Customer Logo</h4> 
                                        <div class="upload mt-4 pr-md-4">
                                            <input type="file" id="input-file-max-fs" class="dropify" data-default-file="<?php echo $temp_img?>" name="image" data-max-file-size="2M" required />
                                            <p class="mt-2" style="font-size: 12px;"><i class="flaticon-cloud-upload mr-1"></i></p>
                                        </div>
                                     </div>
                                    <div class="modal-footer justify-content-between">
                                      <button class="btn" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="client-logo">Upload</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Primary Contact</h5>
                            </div>

                            <div class="widget-content">
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_contact_data['CONTACT_TITLE'];?> <?php echo $customer_primary_contact_data['CONTACT_FULL_NAME'];?></h4>
                                                <p class="meta-date">Contact Name</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-dec">
                                            <p><span><?php echo $customer_primary_contact_data['JOB_ROLE'];?></span> </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_contact_data['CONTACT_TELL'];?></h4>
                                                <p class="meta-date">Contact Tel</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smartphone"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_contact_data['CONTACT_CELL'];?></h4>
                                                <p class="meta-date">Contact Cell</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                              <?php 
                                                if($customer_primary_contact_data['CONTACT_EMAIL'] == "0"){
                                                  $con_email = "<span style='color:#ff0000;'>Unavailable</span>";
                                                }else{
                                                  $con_email = $customer_primary_contact_data['CONTACT_EMAIL'];
                                                }?>
                                                <h4><?php echo $con_email;?></h4>
                                                <p class="meta-date">Contact Email</p>
                                            </div>

                                        </div>
                                        <?php 
                                          if($customer_primary_contact_data['CONTACT_EMAIL'] == "0"){
                                             if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                                         <div class="t-rate rate-dec">
                                            <p><span> <a class="btn btn-dark btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#update-email">Update Email</a></span> </p>
                                        </div>
                                       
                                      <?php }}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Primary Address</h5>
                            </div>

                            <div class="widget-content">
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_address_data['ADDRESS_LINE_ONE'];?></h4>
                                                <p class="meta-date">Address Line 1</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-dec">
                                            <p><span><?php echo $customer_primary_address_data['ADDRESS_TYPE'];?></span> </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_address_data['ADDRESS_LINE_TWO'];?></h4>
                                                <p class="meta-date">Address Line 2</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon" >
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_address_data['ADDRESS_LINE_THREE'];?></h4>
                                                <p class="meta-date">Address Line 3</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon" style="background-color: #252525; ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $customer_primary_address_data['ADDRESS_LINE_FOUR'];?></h4>
                                                <p class="meta-date">Address Line 4</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                      </div>
                      

                      <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                        <div id="address-list" style="display: block;">
                          <?php 
                          if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){?>
                            <a class="btn btn-primary" style="float: center;" href="javascript:void(0);" data-toggle="modal" data-target="#new-address"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Address</a>
                          <?php }?>
                          <div class="table-responsive mb-4 mt-4">
                            <table id="customer_addresses_table" class="table table-hover" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Address Type</th>
                                      <th>Address</th>
                                      <th>Status</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  while($address = $addresses_request_response ->fetch_assoc()){?>
                                    <tr>
                                        <td><?php echo $address['ADDRESS_TYPE']?></td>
                                        <td><?php echo $address['ADDRESS_LINE_ONE']?>, <?php echo $address['ADDRESS_LINE_TWO']?>, <?php echo $address['ADDRESS_LINE_THREE']?>, <?php echo $address['ADDRESS_LINE_FOUR']?></td>
                                        <td><?php echo $address['STATUS']?></td>
                                        <td class="text-center"> <a class="btn btn-primary"  href="javascript:void(0);" data-toggle="modal" data-target="#add-view<?php echo $address['REC_ID']?>" >view</a> </td>
                                        <div class="modal fade" id="add-view<?php echo $address['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"   aria-hidden="true">
                                          <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4><strong><?php echo $customer_info['CLIENT_NAME']."'s "?></strong> Address</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <div id="address-details">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Address Type</span>
                                                                  </div>
                                                                  <h4 class="form-control"><?php echo $address['ADDRESS_TYPE']?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Line 1</span>
                                                                  </div>
                                                                  <h4 class="form-control" ><?php echo $address['ADDRESS_LINE_ONE']?></h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Line 2</span>
                                                                  </div>
                                                                  <h4 class="form-control"><?php echo $address['ADDRESS_LINE_TWO']?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Line 3</span>
                                                                  </div>
                                                                  <h4 class="form-control"><?php echo $address['ADDRESS_LINE_THREE']?></h4>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Line 4</span>
                                                                  </div>
                                                                  <h4 class="form-control"><?php echo $address['ADDRESS_LINE_FOUR']?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                              <div class="input-group mb-4">
                                                                  <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon5">Status</span>
                                                                  </div>
                                                                  <h4 class="form-control"><?php echo $address['STATUS']?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </tr>
                                    <?php
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                      <div class="modal fade" id="new-address" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form method="post" action="ncg_customer_info">
                          <div class="modal-header">
                            <h4>New Address for <strong><?php echo $customer_info['CLIENT_NAME']?></strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <input type="hidden" name="cid" value="<?php echo $customer_id?>">
                          <input type="hidden" name="cname" value="<?php echo $customer_info['CLIENT_NAME']?>">
                          <div class="modal-body">
                           <section class="slide">
                          <div id="address-details">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Address Type</span>
                                    </div>
                                    <input type="text" class="form-control" name="ad_type" required placeholder="Address type">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Line 1</span>
                                    </div>
                                    <input type="text" class="form-control" name="line_one" required placeholder="Line 1">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Line 2</span>
                                    </div>
                                    <input type="text" class="form-control" name="line_two" required placeholder="Line 2">
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Line 3</span>
                                     </div>
                                     <input type="text" class="form-control" name="line_three" required placeholder="Line 3">
                                   </div>
                                 </div>
                                 <div class="col-lg-6">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Line 4</span>
                                     </div>
                                     <input type="text" class="form-control" name="line_four" required placeholder="Line 4">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Status</span>
                                      </div>
                                      <select class="form-control" required name="ad_status">
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
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-address"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>
                      </div>

                      <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                        <div id="contact-list" style="display: block;">
                          
                          <?php 
                          if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){?>
                          <a class="btn btn-primary" style="float: center;" href="javascript:void(0);" data-toggle="modal" data-target="#new-contact"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> New Contact</a>
                        <?php }?>
                          <div class="table-responsive mb-4 mt-4">
                            <table id="customer_contacts_table" class="table table-hover" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Job Role</th>
                                      <th>Tel No</th>
                                      <th>Cell No</th>
                                      <th>Email Address</th>
                                      <th>Status</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  while($contact = $contacts_request_response ->fetch_assoc()){
                                    $name_parts = explode(" ", $contact['CONTACT_FULL_NAME']);
                                    ?>
                                    <tr>
                                        <td><?php echo $contact['CONTACT_TITLE']." ".$contact['CONTACT_INITIALS']." ".end($name_parts)?></td>
                                        <td><?php echo $contact['JOB_ROLE']?></td>
                                        <td><?php echo $contact['CONTACT_TELL']?></td>
                                        <td><?php echo $contact['CONTACT_CELL']?></td>
                                        <td><?php echo $contact['CONTACT_EMAIL']?></td>
                                        <td><?php echo $contact['STATUS']?></td>
                                        <td class="text-center"> <a class="btn btn-primary"  href="javascript:void(0);" data-toggle="modal" data-target="#cn-view<?php echo $contact['REC_ID']?>" >view</a> </td>
                                        <div class="modal fade" id="cn-view<?php echo $contact['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h4><strong><?php echo $contact['CONTACT_TITLE']." ".$contact['CONTACT_INITIALS']." ".end($name_parts)?></strong></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div id="contact-details">
                                                                      <div class="row">     
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Title</span>
                                                                            </div>
                                                                            <h4 type="text" class="form-control"><?php echo $contact['CONTACT_TITLE']?></h4>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Job Role</span>
                                                                            </div>
                                                                            <h4 type="text" class="form-control"><?php echo $contact['JOB_ROLE']?></h4>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Initials</span>
                                                                            </div>
                                                                            <h4 class="form-control"><?php echo $contact['CONTACT_INITIALS']?></h4>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Name</span>
                                                                            </div>
                                                                            <h4 class="form-control"><?php echo $contact['CONTACT_FULL_NAME']?></h4>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Tel No (w)</span>
                                                                            </div>
                                                                            <h4 Class="form-control"><?php echo $contact['CONTACT_TELL']?></h4>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="input-group mb-4">
                                                                              <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon5">Cell No</span>
                                                                              </div>
                                                                              <h4 class="form-control" ><?php echo $contact['CONTACT_CELL']?></h4>
                                                                            </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-12">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Email Address</span>
                                                                            </div>
                                                                            <h4 class="form-control"><?php echo $contact['CONTACT_EMAIL']?></h4>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-3">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Status</span>
                                                                            </div>
                                                                            <h4 type="text" class="form-control"><?php echo $contact['STATUS']?></h4>
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
                                    </tr>
                                    <?php
                                  }
                                ?>
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Name</th>
                                      <th>Job Role</th>
                                      <th>Tel No</th>
                                      <th>Email Address</th>
                                      <th>Cell No</th>
                                      <th>Status</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </tfoot>
                            </table>
                          </div>
                      </div>
                      <div class="modal fade" id="new-contact" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">

                          <form method="post" action="ncg_customer_info" >
                            <input type="hidden" name="cid" value="<?php echo $customer_id?>">
                            <input type="hidden" name="cname" value="<?php echo $customer_info['CLIENT_NAME']?>">
                          <div class="modal-header">
                            <h4>New Contact for <strong><?php echo $customer_info['CLIENT_NAME']?></strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                          </div>
                          <div class="modal-body">
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
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Email Address</span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email adrress" name="con_email" required>
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
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button class="btn btn-primary" type="submit" name="new-contact"><i class="flaticon-cancel-12"></i> Save</button>
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
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
</body>
</html>