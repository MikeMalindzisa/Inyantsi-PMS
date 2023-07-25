<?php
$link = "ncg_vo_info.php";
$page = "INYATSI VO INFORMATION";
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
    if(isset($_GET['vo'])){
      $vo = $_GET['vo'];
      $variation_order = NCG_FUNCT::GET_VARIATION_ORDER($vo);
    }
      ?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
          <input type="hidden" id="message" value="<?php echo $msg?>">
          <input type="hidden" id="title" value="Variation Order">
          <input type="hidden" id="response" value="<?php echo $response?>">
          <input type="hidden" id="html" value="<?php echo $html?>">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>Variation Order Details</h3>                                
                  <div class="animated-underline-content">
                    <div class="tab-content" id="animateLineContent-4">
                      <!--variation order tab panel-->
                      <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="animated-underline-home-tab">

                        <section id="variation-edit" style="display: block;">
                          <div class="row">

                        <div class="col-sm-12">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Reason for VO</span>
                                </div>
                                <h4 class="form-control" ><?php echo $variation_order['VO_REASON']?></h4>
                              </div>
                          </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Previous Contract Value</span>
                              </div>
                              <h4 class="form-control" ><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER($variation_order['PREV_CONTRACT_VALUE'])?></h4>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">New Contract Value</span>
                              </div>
                              <h4 class="form-control" ><?php echo $_GET['C']." ".NCG_FUNCT::MINIFY_NUMBER($variation_order['NEW_CONTRACT_VALUE'])?></h4>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <h4 class="form-control" ><?php echo $variation_order['VO_DESC']?></h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Status</span>
                            </div>
                            <h4 class="form-control" ><?php echo $variation_order['VO_STATUS']?></h4>

                                 <?php
                                    if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID']) || NCG_FUNCT::CAN_UPDATE($_SESSION['ncg-active']['UID'])){?>
                            <div class="input-group-append">
                              <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#updateVoStatus">Edit</a>
                            </div>
                          <?php }?>
                            </div>
                        </div>
                        </div>
                        <div class="modal fade modal-notification" id="updateVoStatus" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="ncg_vo_info">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Update Variation Order Status</h4>
                                  
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon5">Status</span>
                                        </div>
                                        <select class="form-control" name="status" required>
                                            <option value="">Select</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="vo" value="<?php echo $vo ?>">
                                  <input type="hidden" name="pid" value="<?php echo $_GET['pid'] ?>">
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="update-vo-status-jl21">Update</button>
                              </div>
                            </div>
                          </div>
                      </form>
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
                                <a  href="javascript:void(0);" data-toggle="modal" data-target="#edit-vo" class="btn btn-warning mb-2 mr-2 btn-rounded">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit" style="color: #FFFFFF; fill: transparent;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>  Edit</a>

                              <?php }
                              if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_DELETE($_SESSION['ncg-active']['UID'])){?>
                            <button class="btn btn-danger mb-2 mr-2 btn-rounded"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash" style="color: #FFFFFF; fill: transparent;">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>  Delete
                                </button>
                              <?php }?>
                            </div>
                                </div>
                            </div>
                          </section>
                      </div>
                      <div class="modal fade" id="edit-vo" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              
              <div class="modal-content">
                <form method="post"  action="ncg_vo_info">
                  <input type="hidden" name="projectId" value="<?php echo $_GET['pid']?>">
                  <input type="hidden" name="voId" value="<?php echo $vo?>">
                  <input type="hidden" name="c" value="<?php echo $_GET['C']?>">
                  <div class="modal-header">
                      <h4>Edit Variation Order</h4>
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
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Reason" name="voReason" value="<?php echo $variation_order['VO_REASON']?>" requred >
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
                                    <input type="hidden" id="oldValue" value="<?php echo number_format($variation_order['PREV_CONTRACT_VALUE'], "2", ".", ",")?>">
                                    <input id="newVOA" onkeyup="newAmount(this.value)" class="form-control" value="<?php echo $variation_order['VO_AMOUNT']?>" name="voAmount">
                                  </div>
                                </div>
                                </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Previous Contract Value</span>
                                    </div>
                                    <input class="form-control" value="<?php echo $_GET['C']." ".number_format($variation_order['PREV_CONTRACT_VALUE'], "2", ".", ",")?>" readonly >
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">New Contract Value</span>
                                    </div>
                                    <input class="form-control" id="newCV" value="<?php echo $_GET['C']." ". number_format($variation_order['PREV_CONTRACT_VALUE'] + $variation_order['VO_AMOUNT'], "2", ".", ",")?>" readonly >
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
                            <textarea class="form-control" aria-label="" rows="6" name="voDesc" requred   placeholder="Description"><?php echo $variation_order['VO_DESC']?></textarea>
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
                                </select>
                              </div>
                            </div>
                          </div>
                        </section>

                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary" name="edit-vo">Save</button>
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
        var c = "<?php echo $_GET['C']?>";
        var b = c;
        c = c.concat(" ");
        i = i.replaceAll(c,"");
        i = i.replaceAll(" ","");
        i = i.replaceAll(b,"");
        var h = document.getElementById("newCV");
        var m = document.getElementById("newVOA");
        var y = document.getElementById("oldValue").value;
        var x = y.replaceAll(",","");
        var z = parseFloat(x) + parseFloat(i);
        h.value = c.concat(String(new Number(z).toLocaleString("en-US")));
        
        if(i <= 0){
          h.value = c.concat(String(y));
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