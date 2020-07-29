<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Akademi Bisnis | Member</title>

    <link href="<?= base_url();?>assets/ui-login/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/ui-login/css/common.css" rel="stylesheet">
    <link rel="shortcut icon"  sizes="123x46" href="<?= base_url();?>assets/ui-member/images/logo/icon.png" />

        
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-toast-plugin/jquery.toast.min.css">
    <link href="<?= base_url();?>assets/ui-login/css/theme-03.css" rel="stylesheet">
  </head>


<body>
    <input type="hidden" name="content_now" id="content_now">

    <!-- <div class="container-fluid page-body-wrapper"> -->
    <!-- <div class="container-scroller"> -->
        <!-- <div class="container-fluid page-body-wrapper full-page-wrapper"> -->
            <div class="main-panel" id="main-panel" style="width: 100%;">
            </div>
        <!-- </div> -->
    <!-- </div> -->
<!-- 
    -->

    <script src="<?= base_url();?>assets/ui-login/js/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/ui-login/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/ui-login/js/main.js"></script>
    <script src="<?= base_url();?>assets/ui-login/js/demo.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/toast.js"></script>
    <script src="<?= base_url();?>assets/custom/js/my_scripts.js"></script>

    <script>
        $(function () {
            <?php 

                if ($this->session->userdata('id')){
                    ?>
                        window.location.href = base_url(1)+'/member';
                    <?php
                }else{
                    ?>
                        loadMainContent('users.login/manage');
                    <?php
                }

             ?>
            
        }); 

     
    </script>

</body>


</html>