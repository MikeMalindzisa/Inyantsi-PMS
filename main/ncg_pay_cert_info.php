<?php
$link = "ncg_pay_cert_info.php";
$page = "INYATSI PAYMENT CERTIFICATE INFORMATION";
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
        $pid = $_GET['pid'];
    if(isset($_GET['pc'])){
      $pc = $_GET['pc'];
      echo $pc." My PC";
      $payment_certificate = NCG_FUNCT::GET_PAYMENT_CERTIFICATE($pc);
      $project_finances = NCG_FUNCT::GET_PROJECT_FINANCES($pid);
    }
      ?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
          <input type="hidden" id="message" value="<?php echo $msg?>">
          <input type="hidden" id="title" value="Payment Certificate">
          <input type="hidden" id="response" value="<?php echo $response?>">
          <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Payment Certificate Details <strong><?php echo $payment_certificate['CERT_NUM']?></strong>
                    <?php
                      if(NCG_FUNCT::GET_TOTAL_PAID_JL21($payment_certificate['CERT_NUM'], $pid) < $payment_certificate['CERT_AMOUNT']){?>
                    <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#partial-payment-<?=$pc?>"> New Payment<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></a>
                  <?php }?>
                  </h3>  


                      <div class="modal fade" id="partial-payment-<?=$pc?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        
                        <div class="modal-content">
                          <form method="post"  action="ncg_project_info">
                            <input type="hidden" name="pid" value="<?php echo $pid?>">
                            <input type="hidden" name="certNum" value="<?php echo $payment_certificate['CERT_NUM']?>">
                            <input type="hidden" name="cid" value="<?php echo $pc?>">
                            <input type="hidden" name="c" value="<?php echo $_GET['C']?>">
                            <div class="modal-header">
                                <h4>New Payment for <strong><?= $payment_certificate['CERT_NUM']?></strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="circle-basic" class="">
                                  <section class="slide">
                                    <div id="address-details">
                                         <div class="row">
                                          <div class="col-lg-6">
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                            <span class="input-group-text">Pay Cert Date</span>
                                                </div>
                                                <input id="top-payment-id" class="form-control flatpickr flatpickr-input active" type="text" name="payDate" placeholder="Select Date.." required>
                                            </div>
                                          </div>

                                           <div class="col-lg-6">
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon5">Pay Cert Amount</span>
                                              </div>
                                              <input  class="form-control" type="number" min="0" max="<?=$payment_certificate['CERT_AMOUNT']?>" placeholder="<?php echo $_GET['C']?> 0.00" name="payAmount" required>
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
                                      <textarea class="form-control" aria-label="" rows="6" name="payDesc" required   placeholder="Description"></textarea>
                                    </div>
                                      </div>
                                    </div>
                                  </section>
                            </div>
                          </div>
                          <div class="modal-footer">
                              <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                              <button type="submit" class="btn btn-primary" name="new-payment-jl21">Save</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>                              
                  <div class="animated-underline-content">
                    <div class="tab-content" id="animateLineContent-4">
                      <!--variation order tab panel-->
                      <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="animated-underline-home-tab">

                        <section id="variation-edit" style="display: block;">
                        <div id="circle-basic" class="">
                          <section class="">
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon7">Submission Date</span>
                              </div>
                              <?php 
                                $payDate = date("d M Y ", strtotime($payment_certificate['CERT_SUB_DATE']));?>
                              <h4 class="form-control" id="basic-url" aria-describedby="basic-addon3"><?php echo $payDate?></h4>
                            </div>
                          </section>
                          <section class="">
                           <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon7">Reason for Pay Cert</span>
                              </div>
                              <h4 class="form-control" id="basic-url" aria-describedby="basic-addon3"><?php echo $payment_certificate['CERT_REASON']?></h4>
                            </div>
                          </section>
                          <section class="slide">
                            <div id="address-details">
                                 <div class="row">
                                   <div class="col-lg-6">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Claimed Amount</span>
                                      </div>
                                      <h4  class="form-control"><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER($payment_certificate['CERT_AMOUNT'])?></h4>
                                    </div>
                                  </div>
                                   <div class="col-lg-6">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Total Paid Amount</span>
                                      </div>
                                      <h4  class="form-control"><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER(NCG_FUNCT::GET_TOTAL_PAID_JL21($payment_certificate['CERT_NUM'], $pid))?></h4>
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
                              <h4 class="form-control" aria-label=""><?php echo $payment_certificate['CERT_DESC']?></h4>
                            </div>
                              </div>

                              
                            
                        <?php
                        $user_info = NCG_FUNCT::GET_USER_INFO($payment_certificate['CREATED_BY']);
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
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                  <div class="input-group-prepend">
                                    <h4 class="input-group-text">Created By:</h4>
                                </div>
                                <h4 class="form-control"><img src="<?php echo $photo;?>" style="width: 30px; height: 30px; border-radius: 30px;">  <?php echo $user_info['NAME']?></h4>
                                <div class="input-group-append">
                                  <?php
                                  $dom = "id=".$payment_certificate['CREATED_BY']."control=control";
                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                  ?>
                                  <a class="btn btn-primary" href="ncg_user_profile?xyz=<?=$dirty_data?>" target="_blank">view</a>
                                </div>
                                </div>
                            </div>

                              
                            </div>
                          </section>
                        </div>
                        <div class="footer-wrapper">
                                <div class="footer-section f-section-1">
                                    <div class="col-sm-12">
                                       <?php
                                  $dom = "pid=".$_GET['pid']."&control=control";
                                  $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                  ?>
                                <a class="btn btn-primary mb-2 mr-2 btn-rounded" href="ncg_project_info?xyz=<?=$dirty_data?>" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" style="color: #FFFFFF; fill: transparent;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Back </a>
                            </div>
                                </div>
                                <div class="footer-section f-section-2">
                                    <div class="col-sm-12">
                                <input type="hidden" value="false" id="edit-control">
                                 <?php
                                    if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                                <a  href="javascript:void(0);" data-toggle="modal" data-target="#edit-pc" class="btn btn-warning mb-2 mr-2 btn-rounded">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="color: #FFFFFF; fill: transparent;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>  Edit</a>
                              <?php }
                              if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_DELETE($_SESSION['ncg-active']['UID'])){?>
                                <a  href="javascript:void(0);" data-toggle="modal" data-target="#delete-pc" class="btn btn-danger mb-2 mr-2 btn-rounded">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash" style="color: #FFFFFF; fill: transparent;">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>  Delete</a>
                              <?php }?>
                            </div>
                                </div>
                            </div>
                          </section>
                      </div>
                                  <div class="modal fade" id="delete-pc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          
                          <div class="modal-content">
                            <form method="post"  action="ncg_pay_cert_info">
                              <input type="hidden" name="pid" value="<?php echo $pid?>">
                              <input type="hidden" name="cert-id" value="<?php echo $pc?>">
                              <input type="hidden" name="cert-value" value="<?php echo $payment_certificate['CERT_AMOUNT']?>">
                              <div class="modal-header">
                                  <h4>Delete Payment Certificate</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <div id="circle-basic" class="">

                                    <section class="slide">
                                     <p>Amount: <strong><?php echo $_GET['C']?> <?php echo number_format($payment_certificate['CERT_AMOUNT'],"2",".",",")?></strong> </p>
                                      <div class="row">
                                      <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Deletion Reason</span>
                                        </div>
                                        <textarea class="form-control" aria-label="" rows="6" name="del-reason" requred   placeholder="Reason..."></textarea>
                                      </div>
                                        </div>
                                      </div>
                                    </section>
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                <button type="submit" class="btn btn-danger" name="delete-paycert">Delete</button>
                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="edit-pc" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              
              <div class="modal-content">
                <form method="post"  action="ncg_pay_cert_info">
                  <input type="hidden" name="projectId" value="<?php echo $pid?>">
                  <input type="hidden" name="pcId" value="<?php echo $pc?>">
                  <input type="hidden" name="c" value="<?php echo $_GET['C']?>">
                  <div class="modal-header">
                      <h4>Edit Payment Certificate</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div id="circle-basic" class="">
                        <section class="">
                         <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon7">Reason for Pay Cert</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Reason" name="payCertReason" requred value="<?php echo $payment_certificate['CERT_REASON']?>">
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
                                    <input  class="form-control" placeholder="<?php echo $_GET['C']?> 0.00" value="<?php echo $payment_certificate['CERT_AMOUNT']?>" name="payCertAmt" >
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
                            <textarea class="form-control" aria-label="" rows="6" name="payCertDesc" requred   placeholder="Description"><?php echo $payment_certificate['CERT_DESC']?></textarea>
                          </div>
                            </div>
                          </div>
                        </section>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary" name="edit-pc-jl21">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>
                      <!--variation order tab panel-->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Certificate Partial Payments
                    <?php
                      if(NCG_FUNCT::GET_TOTAL_PAID_JL21($payment_certificate['CERT_NUM'], $pid) < $payment_certificate['CERT_AMOUNT']){?>
                    <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" id="new-payment-btn" data-toggle="modal" data-target="#partial-payment-<?=$pc?>"> New Payement<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></a><?php 
                    }?>
                  </h3>  

                    <div id="certificate-list" class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                          <div class="table-responsive mb-4 mt-4">
                                <table id="certificate-pagination" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>PAYMENT NUM</th>
                                            <th>Payment Date</th>
                                            <th>Paid Amount</th>
                                            <th>Total Paid Amount</th>
                                            <th>Remainig Amount</th>
                                            <th>Description</th>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center" style="display: block;">Action</th>
                                          <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $payments = NCG_FUNCT::GET_PAYMENTS($payment_certificate['CERT_NUM'], $pid);
                                        $temp = 0;
                                        while($payment = $payments ->fetch_assoc()){
                                            $payDate = date("d M Y ", strtotime($payment["PAY_DATE"]));
                                            if($temp == 0){
                                              $totalAmnt = $payment['AMOUNT'];
                                            }else{
                                              $totalAmnt = $temp + $payment['AMOUNT'];
                                            }
                                            $temp = $totalAmnt;
                                            $remainig =  $payment_certificate['CERT_AMOUNT'] - $temp;
                                        ?>
                                        <tr>
                                            <td><?php echo $payment['PAY_ID'] ?></td>
                                            <td><?php echo $payDate ?></td>
                                            <td><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER($payment['AMOUNT'])?></td>
                                            <td><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER($totalAmnt)?></td>
                                            <td><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER($remainig)?></td>
                                            <td><?php echo $payment['DESCRIPTION']?></td>
                                             <?php
                                              $dom = "pc=".$payment_certificate['REC_ID']."&C=".$_GET['C']."&pid=".$pid;
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                                            <td class="text-center" style="display: block;"> <a class="btn btn-warning" href="javascript:void(0);" data-toggle="modal" data-target="#edit-partial-payment-<?=$payment['PAY_ID']?>">Edit</a> </td>
                                          <?php }?>
                                          <div class="modal fade" id="edit-partial-payment-<?=$payment['PAY_ID']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                               <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                                 
                                                                 <div class="modal-content">
                                                                   <form method="post"  action="ncg_project_info">
                                                                     <input type="hidden" name="pid" value="<?php echo $pid?>">
                                                                     <input type="hidden" name="cid" value="<?php echo $pc?>">
                                                                     <input type="hidden" name="c" value="<?php echo $_GET['C']?>">
                                                                     <input type="hidden" name="pcid" value="<?php echo $payment['REC_ID']?>">
                                                                     <input type="hidden" name="payment" value="<?php echo $payment['PAY_ID']?>">
                                                                     <input type="hidden" name="certificate" value="<?php echo $payment_certificate['CERT_NUM']?>">
                                                                     <input type="hidden" name="cv" value="<?php echo $payment_certificate['CERT_AMOUNT']?>">
                                                                     <input type="hidden" name="old-amnt" value="<?php echo $payment['AMOUNT']?>">
                                                                     <input type="hidden" name="o-payment" value="<?php echo $project_finances['OVER_PAYMENT']?>">
                                                                     <input type="hidden" name="paid" value="<?php echo $project_finances['PAID']?>">
                                                                     <div class="modal-header">
                                                                         <h4>Edit Payment <strong><?= $payment['PAY_ID']?></strong></h4>
                                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                           <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                         </button>
                                                                     </div>
                                                                     <div class="modal-body">
                                                                         <div id="circle-basic" class="">
                                                                           <section class="slide">
                                                                             <div id="address-details">
                                                                                  <div class="row">
                                                                                   <div class="col-lg-6">
                                                                                     <div class="input-group mb-4">
                                                                                       <div class="input-group-prepend">
                                                                                     <span class="input-group-text">Pay Cert Date</span>
                                                                                         </div>
                                                                                         <input id="top-payment-id-edit" class="form-control flatpickr flatpickr-input active" type="text" name="payDate" placeholder="Select Date.." required value="<?=$payment["PAY_DATE"]?>">
                                                                                     </div>
                                                                                   </div>

                                                                                    <div class="col-lg-6">
                                                                                     <div class="input-group mb-4">
                                                                                       <div class="input-group-prepend">
                                                                                         <span class="input-group-text" id="basic-addon5">Pay Cert Amount</span>
                                                                                       </div>
                                                                                       <input  class="form-control" type="number" min="0" max="<?=$payment_certificate['CERT_AMOUNT']?>" placeholder="<?php echo $_GET['C']?> 0.00" name="new-amnt" step = 0.001 required value="<?=$payment['AMOUNT']?>">
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
                                                                               <textarea class="form-control" aria-label="" rows="6" name="payDesc" required   placeholder="Description"><?=$payment['DESCRIPTION']?></textarea>
                                                                             </div>
                                                                               </div>
                                                                             </div>
                                                                           </section>
                                                                     </div>
                                                                   </div>
                                                                   <div class="modal-footer">
                                                                       <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                       <button type="submit" class="btn btn-primary" name="edit-payment-jl21">Save</button>
                                                                   </div>
                                                               </form>
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
                                            <th>Payment Num</th>
                                            <th>Payment Date</th>
                                            <th>Paid Amount</th>
                                            <th>Total Paid Amount</th>
                                            <th>Remaining Amount</th>
                                            <th>Description</th>

                                            <?php
                                            if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_READ($_SESSION['ncg-active']['UID'])){?>
                                            <th class="text-center" style="display: block;">Action</th>
                                            <?php }?>
                                        </tr>
                                    </tfoot>
                                </table>
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
        });
    </script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="plugins/bootstrap-maxlength/custom-bs-maxlength.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="plugins/noUiSlider/nouislider.min.js"></script>
    <script>
        // Scroll To Top
      var f1 = flatpickr(document.getElementById('top-payment-id'));
      var f1 = flatpickr(document.getElementById('top-payment-id-edit'));
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
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="plugins/noUiSlider/nouislider.min.js"></script>

    <script src="plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
</body>
</html>