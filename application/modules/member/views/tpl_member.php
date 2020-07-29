<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Surya Duta Member</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/puse-icons-feather/feather.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-toast-plugin/jquery.toast.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon"  sizes="123x46" href="<?= base_url();?>assets/ui-member/images/logo/icon.png" />
    
  </head>
  <style type="text/css">
  .content-wrapper {
      background: #f4f4f8;
      padding: 0px;
      width: 100%;
      -webkit-flex-grow: 1;
      flex-grow: 1;
      border: 1px solid whitesmoke;
  }
  .sidebar .nav .nav-item .nav-link i {
      color: #1094f7;
  }
  </style>

  <body class="sidebar-fixed">
    <input type="hidden" name="content_now_member" id="content_now_member">
    <div class="container-scroller">
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-primary">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="javascript:void(0)" onclick="loadMainContentMember('/dashboard.member/manage');">
            <img style="width: 45%;" src="<?= base_url();?>assets/ui-member/images/logo/logo.png" alt="logo"/>
          </a>
          <a class="navbar-brand brand-logo-mini" href="javascript:void(0)" onclick="loadMainContentMember('/dashboard.member/manage');">
            <img style="width: 55%;" src="<?= base_url();?>assets/ui-member/images/logo/icon.png" alt="logo" />
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
           <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="javascript:void(0)" data-toggle="dropdown" aria-expanded="true" onclick="loadMainContentMember('/cart.member/manage')">
                <i class="mdi mdi-cart-outline"></i>
                <span class="count bg-danger" id="sumCart" style="display: none;"></span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url();?>assets/ui-member/images/logo/users.gif" alt="image">
                <span class="d-none d-lg-inline"><?= $this->session->userdata('nama'); ?></span>
              </a>
              <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="window.location.href = base_url(1);">
                  <i class="mdi mdi-home mr-2 text-primary"></i>
                  Home 
                </a> -->
                <a class="dropdown-item" href="javascript:void(0)" onclick="logout();">
                  <i class="mdi mdi-logout mr-2 text-danger"></i>
                  Signout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
        </div>
      </nav>

      <div class="container-fluid page-body-wrapper">
        <?php echo $this->load->view('member/tpl_sidebar_member'); ?>

          <div class="main-panel" id="main-panel">
           <!--  <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">DashBoard</h4>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
      </div>

    </div>


    <script src="<?= base_url();?>assets/ui-member/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="<?= base_url();?>assets/ui-member/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?= base_url();?>assets/ui-member/js/off-canvas.js"></script>
    <script src="<?= base_url();?>assets/ui-member/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/hoverable-collapse.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/misc.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/settings.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/todolist.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/toast.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/bootbox.min.js"></script>
    <script src="<?= base_url();?>assets/ui-member/js/bootbox.locales.min.js"></script>
    <script src="<?= base_url();?>assets/custom/js/my_scripts.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url();?>assets/ui-member/js/dashboard.js"></script>
    

    <script type="text/javascript">
     $(function () {
          loadMainContentMember('/dashboard.member/manage');
          refreshCart();
      });

      function refreshCart(){ 
        showProgres();
        $.post(base_url(1)+'/product.member/manage/refreshCart'
          ,function(result) {
            if (result.error) {
              $('#sumCart').hide();
              $('#sumCart').html('');
            }else{
               if (result.totalCart != 0) {
                $('#sumCart').show();
                $('#sumCart').html(result.totalCart);
               }else{
                $('#sumCart').hide();
                $('#sumCart').html('');
               }
            }
          }         
          ,"json"
        );
      }

      function logout() {
        $.post(base_url(1)+'/member/member/Logout'
            ,function(result) {
                    window.location.href = base_url(1);
            }                   
            ,"json"
        );
      }
    </script>
  </body>
</html>
