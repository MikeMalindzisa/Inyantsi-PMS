<?php
$link = "ncg_projects.php";
$page = "INYATSI PROJECTS";
    include "includes/header.php";
        if(isset($_GET['response'])){
            $response = $_GET['response'];
            $msg = $_GET['msg'];
            $html = $_GET['html'];
        }else{
            $response = "";
            $msg = "";
            $html = "";
        }?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
          <input type="hidden" id="message" value="<?php echo $msg?>">
          <input type="hidden" id="title" value="New Project">
          <input type="hidden" id="response" value="<?php echo $response?>">
          <input type="hidden" id="html" value="<?php echo $html?>">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <h3>Project List
                              <?php
                              if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::CAN_WRITE($_SESSION['ncg-active']['UID'])){?>
                              <a class="btn btn-primary" style="float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#new-project"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg></a><?php } ?></h3>

                             <div class="modal fade" id="new-project" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
              
              <div class="modal-content">
                <form method="post"  action="ncg_projects">
                  <div class="modal-header">
                      <h4>Add Project</h4>
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
                              <span class="input-group-text" id="basic-addon7">Project Name</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Project Name" name="pname" requred  onkeyup="takenPName(this.value)">
                          </div>
                          <div class="row">
                          <div class="col-sm-12">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" aria-label="" rows="6" name="projectDesc" requred   placeholder="Description"></textarea>
                          </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-3">
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
                        </section>

                        <h3>Dates</h3>
                        <section class="slide">
                          <div id="address-details">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Contract Date</span>
                                    </div>
                                    <input id="contractDate" onchange="updateStart(this.value)" class="form-control flatpickr flatpickr-input active" name="contractDate" type="text" placeholder="Select Date..">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Contractual End Date</span>
                                    </div>
                                    <input id="contrEndDate" class="form-control flatpickr flatpickr-input active" type="text" name="contrEndDate" placeholder="Select Date..">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Base Start Date</span>
                                    </div>
                                    <input id="baseStartDate"  class="form-control flatpickr flatpickr-input active" type="text" name="baseStartDate" placeholder="Select Date..">
                                    
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon5">Estimated End Date</span>
                                    </div>
                                    <input id="endDate"  class="form-control flatpickr flatpickr-input active" type="text" name="endDate" placeholder="Select Date..">
                                    
                                  </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-lg-12">
                                   <div class="input-group mb-4">
                                     <div class="input-group-prepend">
                                       <span class="input-group-text" id="basic-addon5">Work Progress</span>
                                     </div>
                                      <div class="form-control custom-progress progress-up">
                                        <div class="row">
                                          <div class="col-sm-11">
                                            <input type="range" min="0" max="100" onchange="progressUp(this.value)" class="custom-range progress-range-counter" value="0" name="progress">   
                                          </div>
                                             <div class="col-sm-1 range-count range count-display">
                                              <span class="range-count-unit">%</span>
                                              <span class="range-count-number" data-rangecountnumber="0">0</span> 
                                            </div>
                                        </div>
                                     </div>
                                   </div>
                                 </div>

                                 <div class="col-sm-12" id="proDesc" style="display: none;">
                                 <div class="input-group mb-4">
                                   <div class="input-group-prepend">
                                     <span class="input-group-text">Progress Description</span>
                                   </div>
                                   <textarea class="form-control" aria-label="" rows="6" name="progressDesc"  placeholder="Description"></textarea>
                                 </div>
                                   </div>
                                </div>
                          </div>
                        </section>

                        <h3>Finacials</h3>
                        <section class="slide">
                          <div id="contact-details">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Contract Value</span>
                                </div>
                                <input type="num" class="form-control" placeholder="Amount" name="conValue" required>

                                <select class="form-control input-group-append" name="currency" required>
                                    <option value="E">SZL</option>
                                    <option value="P">BWP</option>
                                    <option value="R">ZAR</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Add Client</span>
                                </div>
                                <div class="form-control">
                                  
                                <div class="custom-control custom-radio custom-control-inline">
                                      <input type="radio" id="noClient" name="clentSelect" class="custom-control-input" checked>
                                      <label class="custom-control-label" for="noClient">Add later</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                      <input type="radio" id="yesClient" name="clentSelect" class="custom-control-input">
                                      <label class="custom-control-label" for="yesClient">Show Clients</label>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="row" id="clientSelectDiv" style="display: none;">
                            <div class="col-sm-12">
                            <?php
                             $customers_request_response = NCG_FUNCT::GET_CUSTOMERS();?>
                                <select class="selectpicker dropup" data-header="Search client"  data-size="5" data-width="100%"  data-actions-box="true" data-live-search="true" name="projectClient" title="Select client">
                                  <option value="null" data-tokens="None" selected>None</option>
                                  <?php
                                     while($customer = $customers_request_response ->fetch_assoc()){
                                        echo "<option value='{$customer['CUSTOMER_ID']}' data-tokens='{$customer['CLIENT_NAME']}'>{$customer['CLIENT_NAME']}</option>";
                                     }?>
                                </select>
                            </div>
                          </div>
                    </section>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary" name="new-project-jl21">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>
                            <div class="table-responsive mb-4 mt-4">
                                <table id="alter_pagination" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Project Name</th>
                                            <th>Contract Value</th>
                                            <th>Work Progress</th>
                                            <th>Contractual End Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        if($_SESSION['ncg-active']['ROLE'] == "Admin" || NCG_FUNCT::IS_SPECIAL($_SESSION['ncg-active']['UID'])){
                                            $projects = NCG_FUNCT::GET_PROJECTS();
                                            while($project = $projects ->fetch_assoc()){
                                                $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PROJECT_ID']);
                                                $project_finances = NCG_FUNCT::GET_PROJECT_FINANCES($project['PROJECT_ID']);
                                                if($project['CUSTOMER_ID'] == 0){
                                                  $projectOwner = "Not Assigned";
                                                  $color = "#ff0000";
                                                }else{
                                                  $customerData = NCG_FUNCT::GET_CUSTOMER($project['CUSTOMER_ID']);
                                                  $color = "#000000";
                                                  $projectOwner = $customerData['CLIENT_NAME'];
                                                }
                                                $addedByData = NCG_FUNCT::GET_USER_INFO($project['ADDED_BY']);
                                                $addedBy = $addedByData['NAME'];
                                              
                                          ?>
                                            <tr>
                                                <td style="font-weight: bolder; color: <?php echo $color;?>"><?php echo $projectOwner?></td>
                                                <td><?php echo $project_info['PROJECT_NAME']?></td>
                                                <td><?php echo $project_info['CURRENCY']." ".NCG_FUNCT::MINIFY_NUMBER($project_finances['CURRENT_VALUE'])?></td>
                                                <td><?php echo $project_info['PROJECT_PROGRESS']." %";?></td>
                                                <td><?php echo date("d M Y ", strtotime($project_info['CONTRACTUAL_END']))?></td>
                                                <td><?php echo $project['STATUS']?></td>
                                                 <?php
                                              $dom = "pid=".$project['PROJECT_ID']."&control=control";
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>
                                                <td class="text-center"> <a class="btn btn-primary" href="ncg_project_info?xyz=<?=$dirty_data?>">view</a> </td>
                                            </tr>
                                            <?php
                                            }
                                        }else{
                                          $projects = NCG_FUNCT::GET_USER_ASSIGNMENTS($_SESSION['ncg-active']['UID']);
                                        while($pr = $projects ->fetch_assoc()){
                                            $project = NCG_FUNCT::GET_PROJECT($pr['PID']);
                                            $project_info = NCG_FUNCT::GET_PROJECT_INFO($project['PROJECT_ID']);
                                            if($project['CUSTOMER_ID'] == 0){
                                              $projectOwner = "Not Assigned";
                                              $color = "#ff0000";
                                            }else{
                                              $customerData = NCG_FUNCT::GET_CUSTOMER($project['CUSTOMER_ID']);
                                              $color = "#000000";
                                              $projectOwner = $customerData['CLIENT_NAME'];
                                            }
                                            $addedByData = NCG_FUNCT::GET_USER_INFO($project['ADDED_BY']);
                                            $addedBy = $addedByData['NAME'];
                                        
                                      ?>
                                        <tr>
                                            <td style="font-weight: bolder; color: <?php echo $color;?>"><?php echo $projectOwner?></td>
                                            <td><?php echo $project_info['PROJECT_NAME']?></td>
                                            <td><?php echo $project_info['CURRENCY']." ".  NCG_FUNCT::MINIFY_NUMBER($project_info['CONTRACT_VALUE'])?></td>
                                            <td><?php echo $project_info['PROJECT_PROGRESS']." %";?></td>
                                            <td><?php echo date("d M Y ", strtotime($project_info['CONTRACTUAL_END']))?></td>
                                            <td><?php echo $project['STATUS']?></td>
                                              <?php
                                              $dom = "pid=".$project['PROJECT_ID']."&control=control";
                                              $dirty_data = NCG_FUNCT::MAKE_DIRTY($dom);
                                              ?>
                                            <td class="text-center"> <a class="btn btn-primary" href="ncg_project_info?xyz=<?=$dirty_data?>">view</a> </td>
                                        </tr>
                                        <?php
                                        }
                                        }
                                        
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Project Name</th>
                                            <th>Contract Value</th>
                                            <th>Work Progress</th>
                                            <th>Contractual End Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <?php
                    include 'includes/footer.php';?>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->   
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script type="text/javascript">

      function updateStart(date){
        var startDate = document.getElementById("startDate");
        startDate.min = date;
        startDate.value = date;
      }

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

      function progressUp(value){
        if(value > 0){
          document.getElementById("proDesc").style.display = "block";
        }else{
          document.getElementById("proDesc").style.display = "none";
        }
      }
    </script>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
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
<script src="plugins/jquery-step/jquery.steps.min.js"></script>
<script src="plugins/jquery-step/custom-jquery.steps.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>

    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>
    <script src="plugins/noUiSlider/nouislider.min.js"></script>

    <script src="plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <script src="plugins/select2/select2.min.js"></script>
    <script src="plugins/select2/custom-select2.js"></script>
    <script>
        // Scroll To Top
        $(document).on('click', '.arrow', function(event) {
          event.preventDefault();
          var body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing');
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#alter_pagination').DataTable( {
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
         var selectBlock = document.getElementById("clientSelectDiv");
        $(document).on('change', '#noClient', function(event) {
          selectBlock.style.display = "none";
        });
        $(document).on('change', '#yesClient', function(event) {
          selectBlock.style.display = "block";
        });
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>
</html>