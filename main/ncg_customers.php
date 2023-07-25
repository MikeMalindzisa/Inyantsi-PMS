<?php
  $link = "ncg_customers.php";
  $page = "INYATSI CUSTOMERS";
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
            <input type="hidden" id="title" value="Customer Management">
            <input type="hidden" id="response" value="<?php echo $response?>">
            <input type="hidden" id="html" value="<?php echo $html?>">
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing" id="cancel-row">
      <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
          <h3>Customer List
            <?php
            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){?>
            <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#new-customer">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </a><?php }?>
          </h3>

          <div class="modal fade" id="new-customer" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              
              <div class="modal-content">
                <form method="post"  action="ncg_customers.php">
                  <div class="modal-header">
                      <h4>New Customer</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div id="circle-basic" class="">
                        <h3>Details</h3>
                        <section class="">
                         <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon7">Customer Name</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Customer Name" name="cname" requred onkeyup="takenCName(this.value)" >
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
                                  <div class="col-sm-4">
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
                            <div class="col-sm-4">
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
                    <button type="submit" class="btn btn-primary" name="new-client">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>
          <div class="table-responsive mb-4 mt-4">
            <table id="customers_table" class="table" style="width:100%">
              <thead>
                  <tr>
                      <th>Customer Name</th>
                      <th># Projects</th>
                      <th>Status</th>
                      <?php
                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || $prm['permissions'] != ""){?>
                      <th class="text-center">Action</th>
                    <?php }?>
                  </tr>
              </thead>
              <tbody> 
                <?php 
                  $customers_request_response = NCG_FUNCT::GET_CUSTOMERS();
                  while($customer = $customers_request_response ->fetch_assoc()){
                    $addresses_request_response = NCG_FUNCT::GET_CUSTOMER_ADDRESSES($customer['CUSTOMER_ID']);
                    $contacts_request_response = NCG_FUNCT::GET_CUSTOMER_CONTACTS($customer['CUSTOMER_ID']);
                    if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID']) || NCG_FUNCT::IS_SPECIAL($_SESSION['ncg-active']['UID'])){
                    ?>
                    <tr>
                      <td><?php echo $customer['CLIENT_NAME']?></td>
                      <td><?php echo NCG_FUNCT::GET_CUSTOMER_PROJECTS_COUNT($customer['CUSTOMER_ID'])?></td>
                      <td><?php echo $customer['STATUS']?></td>

                      <?php
                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || $prm['permissions'] != ""){?>
                      <td class="text-center"> 
                          <div class="btn-group mb-4" role="group">
                              <button id="customerAction" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Select <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="customerAction">
                                <?php
                                  $dom = "id=".$customer['CUSTOMER_ID']."&control=control";
                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                  ?>
                                  <a class="dropdown-item" href="ncg_customer_info?xyz=<?=$dirty_data?>">View</a>
                                  <?php 
                                  if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){ ?>
                                  <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#customer-edit<?php echo $customer['CUSTOMER_ID']?>" onclick="set_search_id(<?php echo $customer['CUSTOMER_ID']?>)">Edit</a>
                                <?php }
                                if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_DELETE($_SESSION['ncg-active']['UID'])){?>
                                  <a class="dropdown-item" href="ncg_customer_info?xyz=<?=$dirty_data?>">Delete</a>
                                <?php }?>
                              </div>
                          </div>
                      </td>
                    <?php }?>
                      <input type="hidden" id="con-search-id">
                      <input type="hidden" id="ad-search-id">
                      <div class="modal fade" id="customer-edit<?php echo $customer['CUSTOMER_ID']?>" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="myExtraLargeModalLabel">Edit <strong><?php echo $customer['CLIENT_NAME']?></strong></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body animated-underline-content">
                              <ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details<?php echo $customer['CUSTOMER_ID']?>" role="tab" aria-controls="details" aria-selected="true">Edit Details</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses<?php echo $customer['CUSTOMER_ID']?>" role="tab" aria-controls="addresses" aria-selected="false">Edit Addresses</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts<?php echo $customer['CUSTOMER_ID']?>" role="tab" aria-controls="contacts" aria-selected="false">Edit Contact</a>
                                  </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="details<?php echo $customer['CUSTOMER_ID']?>" role="tabpanel" aria-labelledby="details-tab">
                                  <form method="post" action="ncg_customers.php">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon7">Customer Name</span>
                                    </div>
                                    <input type="hidden" name="name" value="<?php echo $customer['CLIENT_NAME']?>">
                                    <input type="hidden" name="cid" value="<?php echo $customer['CUSTOMER_ID']?>">
                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Customer Name" name="new-name" requred value="<?php echo $customer['CLIENT_NAME']?>">
                                  </div>
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea class="form-control" aria-label="" rows="6" name="description" requred value="<?php echo $customer['DESCRIPTION']?>"  placeholder="Description"></textarea>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                    <button type="submit" name="update-details" class="btn btn-primary">Save Changes</button>
                                  </div>
                                </form>
                                </div> 
                                <div class="tab-pane fade" id="addresses<?php echo $customer['CUSTOMER_ID']?>" role="tabpanel" aria-labelledby="addresses-tab">
                                  <section>
                                    <div id="searchLive" class="col-lg-12 layout-spacing">
                                        <div class="statbox">
                                            <div class="row">
                                              <div class="col-lg-8 col-md-8 col-sm-9 filtered-list-search mx-auto">
                                                  <form class="form-inline my-2 my-lg-0 justify-content-center">
                                                      <div class="w-100">
                                                          <input type="text" class="w-100 form-control product-search br-30" id="address-search<?php echo $customer['CUSTOMER_ID']?>" placeholder="Search address">
                                                      </div>
                                                  </form>
                                              </div>
                                              <div class="col-lg-12">
                                                <div class="searchable-container addresses-container">
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                      <div class="searchable-items" style="border: 0; padding: 10px; max-height: 300px;">
                                                        <?php
                                                            if(mysqli_num_rows($addresses_request_response) == 0){
                                                                echo "<center><h4>No addresses available</h4></center>";?>
                                                                <center><a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#new-address">Add primary address</a></center>
                                                    <div class="modal fade" id="new-address" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                              <form method="post" action="ncg_customers.php">
                                                            <div class="modal-header">
                                                              <h4>New Primary Address for <strong><?php echo $customer['CLIENT_NAME']?></strong></h4>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                              </button>
                                                            </div>
                                                            <input type="hidden" name="cid" value="<?php echo $customer['CUSTOMER_ID']?>">
                                                            <input type="hidden" name="cname" value="<?php echo $customer['CLIENT_NAME']?>">
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
                                                              <button class="btn btn-primary" type="submit" name="new-primary-address"><i class="flaticon-cancel-12"></i> Save</button>
                                                            </div>
                                                        </form>
                                                          </div>
                                                        </div>
                                                      </div>
                                                        <?php
                                                        }else{
                                                            while($address = $addresses_request_response ->fetch_assoc()){
                                                                $full_address = $address['ADDRESS_LINE_ONE'].",".$address['ADDRESS_LINE_TWO'].",".$address['ADDRESS_LINE_THREE'].",".$address['ADDRESS_LINE_FOUR'];
                                                                    $ad_status = $address['STATUS'];
                                                                    if($ad_status == "Active"){
                                                                        $badge = "badge-primary";
                                                                        $active_select= "selected";
                                                                        $inactive_select= "";
                                                                    }else{
                                                                        $badge = "badge-warning";
                                                                        $active_select= "";
                                                                        $inactive_select= "selected";
                                                                    }
                                                        ?>
                                                        <div class="items">
                                                          <div class="user-name">
                                                            <p class=""><?php echo $address['ADDRESS_TYPE']?></p>
                                                          </div>
                                                          <div class="user-email">
                                                            <p><?php echo $full_address;?></p>
                                                          </div>
                                                          <div class="user-status">
                                                            <span class="badge <?php echo $badge?>"><?php echo $address['STATUS']?></span>
                                                          </div>
                                                          <div class="action-btn">
                                                            <a class="btn btn-dark mb-2 mr-2 rounded-circle" href="javascript:void(0);"  data-toggle="modal" data-target="#ad-edit<?php echo $customer['CUSTOMER_ID'].$address['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                                          </div>

                                                              <?php 
                                                                if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_DELETE($_SESSION['ncg-active']['UID'])){?>
                                                          <div class="action-btn">
                                                            <a class="btn btn-danger mb-2 mr-2 rounded-circle" href="javascript:void(0);"data-toggle="modal" data-target="#ad-delete<?php echo $customer['CUSTOMER_ID'].$address['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                          </div>
                                                        <?php }?>
                                                        </div>
                                                        <div class="modal fade" id="ad-edit<?php echo $customer['CUSTOMER_ID'].$address['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"   aria-hidden="true">
                                                          <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                              <form method="post" action="ncg_customers.php">
                                                                <div class="modal-header">
                                                                    <h4>Edit <strong><?php echo $customer['CLIENT_NAME']."'s "?></strong> Address</h4>
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
                                                                                  <input type="text" class="form-control" value="<?php echo $address['ADDRESS_TYPE']?>" name="ad_type" placeholder="Address type" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group mb-4">
                                                                                  <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="basic-addon5">Line 1</span>
                                                                                  </div>
                                                                                  <input type="text" class="form-control" value="<?php echo $address['ADDRESS_LINE_ONE']?>" name="line_one" placeholder="Line 1" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group mb-4">
                                                                                  <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="basic-addon5">Line 2</span>
                                                                                  </div>
                                                                                  <input type="text" class="form-control" value="<?php echo $address['ADDRESS_LINE_TWO']?>" name="line_two" placeholder="Line 2" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group mb-4">
                                                                                  <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="basic-addon5">Line 3</span>
                                                                                  </div>
                                                                                  <input type="text" class="form-control" value="<?php echo $address['ADDRESS_LINE_THREE']?>" name="line_three" placeholder="Line 3" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6">
                                                                                <div class="input-group mb-4">
                                                                                  <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="basic-addon5">Line 4</span>
                                                                                  </div>
                                                                                  <input type="text" class="form-control" value="<?php echo $address['ADDRESS_LINE_FOUR']?>" name="line_four" placeholder="Line 4" required>
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
                                                                                      <option>Select</option>
                                                                                      <option value="Active" <?php echo $active_select?>>Active</option>
                                                                                      <option value="Inactive" <?php echo $inactive_select?>>Inactive</option>
                                                                                  </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="cid" value="<?php echo $customer['CUSTOMER_ID']?>">
                                                                <input type="hidden" name="cname" value="<?php echo $customer['CLIENT_NAME']?>">
                                                                <input type="hidden" name="aid" value="<?php echo $address['REC_ID']?>">
                                                                <div class="modal-footer">
                                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                    <button type="submit" class="btn btn-primary" name="update-address">Save Changes</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="modal fade modal-notification" id="ad-delete<?php echo $customer['CUSTOMER_ID'].$address['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby=  "as" aria-hidden="true">
                                                          <div class="modal-dialog" role="document" id="as">
                                                            <div class="modal-content">
                                                              <div class="modal-body text-center">
                                                                  <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                  </div></center>
                                                                  <br>
                                                                  <hr/>
                                                                  <h4>Delete <strong><?php echo $customer['CLIENT_NAME']."'s "?></strong> Address</h4> 
                                                                  <hr/>
                                                                  <h5 class="modal-text"><?php echo $full_address;?></h5><br>

                                                                  <strong><p><?php echo $address['ADDRESS_TYPE']?>
                                                                  </p></strong> <br>
                                                                  <br><hr/>

                                                                  <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                                  <br>
                                                                  <strong>
                                                                    <p class="modal-text">Continue at your discretion</p></strong>
                                                               </div>
                                                              <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-danger" href="ncg_customers.php?action=delete-add&aid=<?php echo $address['REC_ID']?>&value=<?php echo $full_address?>" class="dropdown-item">Delete</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <?php } }?>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                  </section>
                                  <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                  </div>   
                                </div>
                                <div class="tab-pane fade" id="contacts<?php echo $customer['CUSTOMER_ID']?>" role="tabpanel" aria-labelledby="contacts-tab">
                                  <section>
                                    <div id="searchLive" class="col-lg-12 layout-spacing">
                                      <div class="statbox">
                                        <div class="row">
                                          <div class="col-lg-8 col-md-8 col-sm-9 filtered-list-search mx-auto">
                                            <form class="form-inline my-2 my-lg-0 justify-content-center">
                                              <div class="w-100">
                                                <input type="text" class="w-100 form-control product-search br-30" id="contact-search<?php echo $customer['CUSTOMER_ID']?>" placeholder="Search contact">
                                              </div>
                                            </form>
                                          </div>
                                          <div class="col-lg-12">
                                            <div class="searchable-container contacts-container">
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="searchable-items" style="border: 0; padding: 10px; max-height: 300px;">
                                                    <?php
                                                        if(mysqli_num_rows($contacts_request_response) == 0){
                                                            echo "<center><h4>No contacts available</h4></center>";?>
                                                            <center><a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#new-contact">Add primary contact</a></center>
                                                            <div class="modal fade" id="new-contact" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">

                          <form method="post" action="ncg_customers.php" >
                            <input type="hidden" name="cid" value="<?php echo $customer['CUSTOMER_ID']?>">
                            <input type="hidden" name="cname" value="<?php echo $customer['CLIENT_NAME']?>">
                          <div class="modal-header">
                            <h4>New Primary Contact for <strong><?php echo $customer['CLIENT_NAME']?></strong></h4>
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
                            <button class="btn btn-primary" type="submit" name="new-primary-contact"><i class="flaticon-cancel-12"></i> Save</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                                                        <?php
                                                        }
                                                        else{
                                                          while($contact = $contacts_request_response ->fetch_assoc()){
                                                            switch ($contact['CONTACT_TITLE']){
                                                              case "Mr":
                                                                $mr_select = "selected";
                                                                $miss_select = "";
                                                                $mrs_select = "";
                                                                $dr_select = "";
                                                                $proff_select = "";
                                                                $hon_select = "";
                                                              break;
                                                              case 'Miss':
                                                                $mr_select = "";
                                                                $miss_select = "selected";
                                                                $mrs_select = "";
                                                                $dr_select = "";
                                                                $proff_select = "";
                                                                $hon_select = "";
                                                              break;
                                                              case 'Mrs':
                                                                $mr_select = "";
                                                                $miss_select = "";
                                                                $mrs_select = "selected";
                                                                $dr_select = "";
                                                                $proff_select = "";
                                                                $hon_select = "";
                                                              break;
                                                              case 'Dr.':
                                                                $mr_select = "";
                                                                $miss_select = "";
                                                                $mrs_select = "";
                                                                $dr_select = "selected";
                                                                $proff_select = "";
                                                                $hon_select = "";
                                                              break;
                                                              case 'Prof.':
                                                                $mr_select = "";
                                                                $miss_select = "";
                                                                $mrs_select = "";
                                                                $dr_select = "";
                                                                $proff_select = "selected";
                                                                $hon_select = "";
                                                              break;
                                                              case 'Hon.':
                                                                $mr_select = "";
                                                                $miss_select = "";
                                                                $mrs_select = "";
                                                                $dr_select = "";
                                                                $proff_select = "";
                                                                $hon_select = "selected";
                                                              break;
                                                              default:
                                                                $mr_select = "";
                                                                $miss_select = "";
                                                                $mrs_select = "";
                                                                $dr_select = "";
                                                                $proff_select = "";
                                                                $hon_select = "";
                                                              break;
                                                            }
                                                            $name_parts = explode(" ", $contact['CONTACT_FULL_NAME']);
                                                            $display_name = $contact['CONTACT_TITLE']." ".$contact['CONTACT_INITIALS']." ".end($name_parts);
                                                            $cn_status = $contact['STATUS'];
                                                            if($cn_status == "Active"){
                                                              $cn_badge = "badge-primary";
                                                              $cn_active = "selected";
                                                              $cn_inactive = "";
                                                            }else{
                                                              $cn_badge = "badge-warning";
                                                              $cn_active = "";
                                                              $cn_inactive = "selected";
                                                            }
                                                            ?>
                                                            <div class="items">
                                                              <div class="user-name">
                                                                <p class=""><?php echo $display_name?></p>
                                                              </div>
                                                              <div class="user-email">
                                                                <p><?php echo $contact['JOB_ROLE']?></p>
                                                              </div>
                                                              <div class="user-email">
                                                                <p><?php echo $contact['CONTACT_EMAIL']?></p>
                                                              </div>
                                                              <div class="user-status">
                                                                <span class="badge <?php echo $cn_badge?>"><?php echo $contact['STATUS']?></span>
                                                              </div>
                                                              <div class="action-btn">
                                                                <a class="btn btn-dark mb-2 mr-2 rounded-circle" href="javascript:void(0);"  data-toggle="modal" data-target="#cn-edit<?php echo $customer['CUSTOMER_ID'].$contact['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                                              </div>

                                                              <?php 
                                                                if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_DELETE($_SESSION['ncg-active']['UID'])){?>
                                                              <div class="action-btn">
                                                                <a class="btn btn-danger mb-2 mr-2 rounded-circle" href="javascript:void(0);"data-toggle="modal" data-target="#cn-delete<?php echo $customer['CUSTOMER_ID'].$contact['REC_ID']?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                              </div>
                                                            <?php }?>
                                                            </div>
                                                            <div class="modal fade" id="cn-edit<?php echo $customer['CUSTOMER_ID'].$contact['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                  <form method="post" action="ncg_customers.php">
                                                                  <div class="modal-header">
                                                                    <h4>Edit Contact <strong><?php echo $contact['CONTACT_FULL_NAME']?></strong></h4>
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
                                                                            <select class="form-control" name="con_title" required>
                                                                              <option value="">Select</option>
                                                                              <option value="Mr" <?php echo $mr_select ?>>Mr</option>
                                                                              <option value="Miss" <?php echo $miss_select ?>>Miss</option>
                                                                              <option value="Mrs" <?php echo $mrs_select ?>>Mrs</option>
                                                                              <option value="Dr." <?php echo $dr_select ?>>Dr.</option>
                                                                              <option value="Prof." <?php echo $proff_select ?>>Prof.</option>
                                                                              <option value="Hon." <?php echo $hon_select ?>>Hon.</option>
                                                                            </select>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Job Role</span>
                                                                            </div>
                                                                            <input type="text" class="form-control" placeholder="Job role" name="con_role" required value="<?php echo $contact['JOB_ROLE']?>">
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Initials</span>
                                                                            </div>
                                                                            <input type="text" class="form-control" value="<?php echo $contact['CONTACT_INITIALS']?>" placeholder="Initials" name="con_initials" required>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Name</span>
                                                                            </div>
                                                                            <input type="text" class="form-control" value="<?php echo $contact['CONTACT_FULL_NAME']?>" placeholder="Full name" name="con_name" required>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-6">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Tel No (w)</span>
                                                                            </div>
                                                                            <input type="tel" class="form-control" value="<?php echo $contact['CONTACT_TELL']?>" placeholder="Tel number" name="con_tel" required>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="input-group mb-4">
                                                                              <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon5">Cell No</span>
                                                                              </div>
                                                                              <input type="tel" class="form-control" value="<?php echo $contact['CONTACT_CELL']?>" placeholder="Cell number" name="con_cell" required>
                                                                            </div>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-sm-12">
                                                                          <div class="input-group mb-4">
                                                                            <div class="input-group-prepend">
                                                                              <span class="input-group-text" id="basic-addon5">Email Address</span>
                                                                            </div>
                                                                            <input type="email" class="form-control" value="<?php echo $contact['CONTACT_EMAIL']?>" placeholder="Email address" name="con_email" required>
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
                                                                              <option value="Active" <?php echo $cn_active ?>>Active</option>
                                                                              <option value="Inactive" <?php echo $cn_inactive ?>>Inactive</option>
                                                                            </select>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <input type="hidden" name="cid" value="<?php echo $customer['CUSTOMER_ID']?>">
                                                                  <input type="hidden" name="cname" value="<?php echo $customer['CLIENT_NAME']?>">
                                                                  <input type="hidden" name="con_id" value="<?php echo $contact['REC_ID']?>">
                                                                  <div class="modal-footer">
                                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                    <button type="submit" name="update-contact" class="btn btn-primary">Save Changes</button>
                                                                  </div>
                                                                </form>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="modal fade modal-notification" id="cn-delete<?php echo $customer['CUSTOMER_ID'].$contact['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="as" aria-hidden="true">
                                                              <div class="modal-dialog" role="document" id="as">
                                                                <div class="modal-content">
                                                                  <div class="modal-body text-center">
                                                                    <center>
                                                                      <div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                                                        <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                                                      </div>
                                                                    </center>
                                                                    <br>
                                                                    <hr/>
                                                                    <h4>Delete <strong><?php echo $customer['CLIENT_NAME']."'s "?></strong> Contact<br><hr/><?php echo $display_name?></h4> 
                                                                    <strong><p class="modal-text"><?php echo $contact['JOB_ROLE']?></p></strong> <br><br><hr/>
                                                                    <span class="badge badge-danger" style="cursor: default;"> This action can not be undone! </span>
                                                                    <br>
                                                                    <strong>
                                                                      <p class="modal-text">Continue at your discretion</p>
                                                                    </strong>
                                                                  </div>
                                                                  <div class="modal-footer justify-content-between">
                                                                    <button class="btn" data-dismiss="modal">Cancel</button>
                                                                    <a class="btn btn-danger" href="ncg_customers.php?action=delete-cn&cid=<?php echo $contact['REC_ID']?>&value=<?php echo $display_name?>" class="dropdown-item">Delete</a>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <?php 
                                                          }
                                                        }
                                                      ?>
                                                  </div>

                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </section>
                                  <div class="modal-footer">
                                     <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                  </div>  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
                    <?php 
                  }
                  }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Customer Name</th>
                  <th># Projects</th>
                  <th>Status</th>
                  <?php
                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || $prm['permissions'] != ""){?>
                      <th class="text-center">Action</th>
                    <?php }?>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    include 'includes/footer.php';
  ?>
</div> 
<script type="text/javascript">
  function switcher(id){
    var detail_input = document.getElementById("details");
    var address_input = document.getElementById("addresses");
    var contact_input = document.getElementById("contacts");
    if(id === "details"){
      detail_input.style.display = "block";
      address_input.style.display = "none";
      contact_input.style.display = "none";
    }
    if(id === "addresses"){
      detail_input.style.display = "none";
      address_input.style.display = "block";
      contact_input.style.display = "none";
    }if(id === "contacts"){
      detail_input.style.display = "none";
      address_input.style.display = "none";
      contact_input.style.display = "block";
    }
  }
</script>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="plugins/jquery-step/jquery.steps.min.js"></script>
<script src="plugins/jquery-step/custom-jquery.steps.js"></script>
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
<script src="assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
<script src="plugins/table/datatable/datatables.js"></script>

<script src="assets/js/elements/custom-search.js"></script>
<script>
    $(document).ready(function() {
        $('#customers_table').DataTable( {
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
<!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>
</html>