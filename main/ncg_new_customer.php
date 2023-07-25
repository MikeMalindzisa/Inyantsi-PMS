<?php
$link = "ncg_new_customer.php";
$page = "INYATSI ADD NEW CUSTOMER";
    include "includes/header.php";?>
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
           <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                  <h3>New Customer</h3>                                
                  <div class="animated-underline-content">
                    <div class="tab-content" id="animateLineContent-4">
                      <div class="tab-pane fade show" id="details" style="display: block;">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon7">Customer Name</span>
                          </div>
                          <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="">
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" aria-label="" rows="10"></textarea>
                        </div>  
                          <div class="footer-wrapper">
                                <div class="footer-section f-section-1">
                                    <div class="col-sm-12">
                                      <a href="ncg_customers.php" class="btn btn-primary mb-2 mr-2 btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" style="color: #FFFFFF; fill: transparent;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel </a>
                                    </div>
                                </div>
                                <div class="footer-section f-section-2">
                                    <div class="col-sm-12">
                                      <button class="btn btn-primary mb-2 mr-2 btn-rounded" onclick="switcher('addresses')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right" style="color: #FFFFFF; fill: transparent;"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>  Next</button>
                                    </div>
                                </div>
                        </div>   
                      </div>


                      <div class="tab-pane fade show" id="addresses" style="display: none;">
                        <div id="address-details">
                          <div class="col-sm-12">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Address Type</span>
                                </div>
                                <input type="text" class="form-control" >
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Line 1</span>
                                </div>
                                <input type="text" class="form-control" >
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Line 2</span>
                                </div>
                                <input type="text" class="form-control" >
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Line 3</span>
                                </div>
                                <input type="text" class="form-control" >
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Line 4</span>
                                </div>
                                <input type="text" class="form-control">
                              </div>
                          </div>

                          <div class="row" style="padding-left: 14px;">
                            <div class="col-sm-6">
                                <div class="input-group mb-4">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">Province</span>
                                  </div>
                                  <input type="text" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6" style="margin-top: 5px;">
                                <button class="btn btn-primary mb-2 mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> Select Location</button>
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Area</span>
                                </div>
                                <input type="text" class="form-control" readonly>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Suburb</span>
                                </div>
                                <input type="text" class="form-control" readonly>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Pcode</span>
                                </div>
                                <input type="text" class="form-control" readonly>
                              </div>
                          </div>


                          <div class="col-sm-3">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Status</span>
                                </div>
                                <select class="form-control">
                                    <option>Select</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                              </div>
                          </div>
                          <div class="footer-wrapper">
                                <div class="footer-section f-section-1">
                                    <div class="col-sm-12">
                                      <a href="ncg_customers.php" class="btn btn-primary mb-2 mr-2 btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" style="color: #FFFFFF; fill: transparent;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel </a>
                                    </div>
                                </div>
                                <div class="footer-section f-section-2">
                                    <div class="col-sm-12">
                                      <button class="btn btn-primary mb-2 mr-2 btn-rounded" onclick="switcher('details')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left" style="color: #FFFFFF; fill: transparent;"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>  Prev
                                      </button>
                                      <button class="btn btn-primary mb-2 mr-2 btn-rounded" onclick="switcher('contacts')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right" style="color: #FFFFFF; fill: transparent;"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>  Next</button>
                                    </div>
                                </div>
                        </div>
                        </div>
                      </div>

                      <div class="tab-pane fade show" id="contacts" style="display: none;">
                          <div id="contact-details">
                        <div class="col-sm-3">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Title</span>
                              </div>
                              <select class="form-control">
                                  <option>Select...</option>
                                  <option>Mr</option>
                                  <option>Miss</option>
                                  <option>Mrs</option>
                                  <option>Dr.</option>
                                  <option>Prof.</option>
                                  <option>Honurable.</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Initials</span>
                              </div>
                              <input type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Name</span>
                              </div>
                              <input type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Surname</span>
                              </div>
                              <input type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Tel No (w)</span>
                              </div>
                              <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Email Address</span>
                              </div>
                              <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Cell No</span>
                              </div>
                              <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Status</span>
                              </div>
                              <select class="form-control">
                                  <option>Select</option>
                                  <option>Active</option>
                                  <option>Inactive</option>
                              </select>
                            </div>
                        </div>
                        <div class="footer-wrapper">
                                <div class="footer-section f-section-1">
                                    <div class="col-sm-12">
                                      <button class="btn btn-primary mb-2 mr-2 btn-rounded" onclick="contact_switcher('contact-list')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" style="color: #FFFFFF; fill: transparent;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel </button>
                                    </div>
                                </div>
                                <div class="footer-section f-section-2">
                                    <div class="col-sm-12">
                                      <button class="btn btn-primary mb-2 mr-2 btn-rounded" onclick="switcher('addresses')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left" style="color: #FFFFFF; fill: transparent;"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>  Prev
                                      </button>
                                      <button class="btn btn-success mb-2 mr-2 btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save" style="color: #FFFFFF; fill: transparent;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>  Save</button>
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
           </div>
            <?php
                    include 'includes/footer.php';?>
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
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
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
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="plugins/bootstrap-maxlength/custom-bs-maxlength.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
</body>
</html>