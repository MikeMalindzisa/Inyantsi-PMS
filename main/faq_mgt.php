<?php include "core_functions/functions.php";
$level_of_access = "root";
if($level_of_access == "root"){
    if($_SESSION['ncg-active']['ROLE'] != "Admin"){
      header("Location: index");
      exit();
    }
}
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>INYATSI - FAQ MANAGEMENT</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/manual.css" rel="stylesheet" type="text/css" /> 

    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->     
</head>
<body class="sidebar-noneoverflow">
    <input type="hidden" id="message" value="<?php echo $msg?>">
    <input type="hidden" id="title" value="Frequently Asked Questions">
    <input type="hidden" id="response" value="<?php echo $response?>">
    <input type="hidden" id="html" value="<?php echo $html?>">
    <div class="fq-header-wrapper">
        <nav class="navbar navbar-expand" style="position: fixed; top: 0; width: 100%; background: rgb(0,0,0,0.5); height: 75px; z-index: 999">
            <div class="container">
                <a class="navbar-brand" href="index"><img src="assets/img/ww_logo.png" width="70" class="navbar-logo" alt="INYATSI" style="padding: 10px;"></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="height: 300px!important">
            <div class="row">
                <div class="col-md-8 align-self-center order-md-0 order-1">
                    <h1 class="">FAQs Management</h1>
                </div>
                <div class="col-md-4 order-md-0 order-0">
                        <img src="assets/img/faq.svg" class="d-block" style="width: 640px!important;" alt="header-image">
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>

    <div class="faq container" style="margin-top: 300px!important">

        <div class="faq-layouting layout-spacing">
            <div class="modal fade modal-notification" id="askFaq" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                      <form method="post" action="faqs">
                          <div class="modal-dialog" role="document" id="standardModalLabel">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4>Ask your question</h4>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon5">Relation</span>
                                        </div>
                                         <select class="form-control" name="faq-class" required>
                                            <option value="">Select</option>
                                            <option value="User Accounts">User Accounts</option>
                                            <option value="User Permissions">User Permissions</option>
                                            <option value="Inyatsi Customers">Inyatsi Customers</option>
                                            <option value="Inyatsi Customer Projects">Inyatsi Customer Projects</option>
                                            <option value="variations">Project Variation Orders</option>
                                            <option value="Project Variation Orders">Project Payment Certificates</option>
                                            <option value="Project Dates">Project Dates</option>
                                            <option value="Technical Issues">Technical Issues</option>
                                            <option value="Miscellaneous Questions">Other</option>
                                        </select>
                                      </div>
                                    </div>
                                    <?php
                                        if(isset($_SESSION['ncg-active'])){?>
                                            <input type="hidden" name="user-email" value="<?= $_SESSION['ncg-active']['W_EMAIL']?>">
                                        <?php }else{?>
                                            <div class="col-sm-12">
                                                <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon5">Email Address</span>
                                                </div>
                                                <input type="email" name="user-email" required placeholder="Email address...">
                                              </div>
                                            </div>
                                        <?php }?>
                                    
                                  </div>
                                  <div class="row">
                                 <div class="col-lg-12">
                                    <input type="hidden" name="from" value="faqs.php">
                                   <textarea aria-label="Question" rows="6" required name="faq-question" class="form-control" placeholder="What is your question?"></textarea>
                                 </div>
                                </div>
                               </div>
                              <div class="modal-footer justify-content-between">
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="ask-question">Submit</button>
                              </div>
                            </div>
                          </div>
                      </form>
                        </div>
            <div class="fq-article-section">
                <div class="row">
                   
                   <?php
                    $faqs = NCG_FUNCT::GET_PENDING_FAQS();
                    if(mysqli_num_rows($faqs)>0){
                    while($faq = $faqs ->fetch_assoc()){?>
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-4">
                        <div class="card" style="height: 240px!important;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $faq['FAQ_CLASS']?></h5>
                                <div class="fq-rating">
                                    <?php
                                        if($faq['FAQ_RATED'] == 0){
                                        $rating = 0;
                                        }else{
                                            $rating = $faq['FAQ_RATING']/$faq['FAQ_RATED'];
                                        }
                                        $rating = number_format($rating, "0",".",",");
                                        for($i=1; $i<=5; $i++){
                                            if($i<= $rating){?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#FEAC01" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star checked"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <?php }else{?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#999" stroke="#ffffff" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <?php }
                                        }?>
                                </div>
                                <p class="card-text" style="max-width: 90%;overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><?= $faq['FAQ_QUESTION']?></p>
                                <p class="meta-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> <?= date("d M Y ", strtotime($faq['TIMESTAMP']))?></p>
                                <hr>
                                <a class="btn btn-primary mb-2 mr-2 form-control warning-tt" data-container="body" data-placement="auto" data-html="true" href="javascript:void(0);" data-toggle="modal" data-target="#faq-<?=$faq['REC_ID']?>"   style="margin-bottom:-50px!important;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade modal-notification" id="faq-<?=$faq['REC_ID']?>" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document" id="standardModalLabel">
                            <form method="post" action="faq_mgt">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                   <center><div class="icon-content" style="width: 50px; height: 50px; line-height: 50px; border-radius: 50px; padding: 10px;">
                                    <img  style="width: 50px; height: 50px;" src="assets/img/logo.png" class="navbar-logo" alt="INYATSI">
                                  </div></center>
                                  <br>
                                  <hr/>
                                  <h4><?=$faq['FAQ_CLASS']?></h4>
                                  <br>
                                  <h5>Question</h5>
                                  <p><?=$faq['FAQ_QUESTION']?></p>
                                  <hr>
                                  <h5>Answer</h5>
                                  <textarea aria-label="Question" rows="6" required name="faq-reply" class="form-control" placeholder="Reply to question..."></textarea>
                                  <input type="hidden" name="faq-id" value="<?=$faq['REC_ID']?>">

                               </div>
                              <div class="modal-footer justify-content-between">
                                <p><?= date("d M Y ", strtotime($faq['TIMESTAMP']))?></p>
                                <button class="btn" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="reply-question">Reply</button>
                              </div>
                            </div>
                          </form>
                          </div>
                        </div>
                <?php }
                  }else{?>
                    <h4 class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> No unanswered FAQs!</h4>
                  <?php }?>
                </div>

            </div>

        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="assets/js/pages/faq/faq.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script type="text/javascript">
        function setSize(id){
            $('.mg-con').removeClass('margin-control');
            $('#'+id).addClass('margin-control');
        }
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
</body>
</html>