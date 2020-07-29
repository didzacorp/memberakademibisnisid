<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Surya Duta</title>

    <!-- <link rel="shortcut icon" href="<?= base_url();?>assets/ui-users/mages/favicon.ico"> -->

    <link rel="stylesheet" href="<?= base_url();?>assets/ui-users/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url();?>assets/ui-users/revslider/css/settings.css">

    <link rel="stylesheet" href="<?= base_url();?>assets/ui-users/css/typography.css">

    <link rel="stylesheet" href="<?= base_url();?>assets/ui-users/css/style.css">

    <link rel="stylesheet" href="<?= base_url();?>assets/ui-users/css/bootoast.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url();?>assets/custom/css/cetak.css"> -->
    <!-- <link rel="stylesheet" href="<?= base_url();?>assets/custom/css/my_custom.css"> -->
</head>

<body>
    <input type="hidden" name="content_now" id="content_now">

    <div id="loading">
        <div id="loading-center">
            <img src="<?= base_url();?>assets/ui-users/images/loader.gif" alt="loder">
        </div>
    </div> 

    <header id="main-header" class="header-one">
      <?php echo $this->load->view('tpl_header_users'); ?>
    </header>

    <!-- <div id="banner"></div> -->
    

    <div class="main-content" id="main-content">
        <?php echo $this->load->view('banner_users'); ?>
    </div>

    <footer class="main-footer" id="main-footer">
       <?php echo $this->load->view('tpl_footer_users'); ?>
    </footer>

    <script src="<?= base_url();?>assets/ui-users/js/jquery-min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/popper.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/bootstrap.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/modernizr.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/appear.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/mega_menu.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/timeline.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/wow.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/jquery.scrollme.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/countdown.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/waypoints.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/jquery.counterup.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/owl.carousel.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/jquery.magnific-popup.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/isotope.pkgd.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/circle-progress.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/canvasjs.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/js/bootoast.js"></script>

    <script src="<?= base_url();?>assets/ui-users/revslider/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/jquery.themepunch.revolution.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="<?= base_url();?>assets/ui-users/revslider/js/extensions/revolution.extension.video.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/retina.min.js"></script>

    <script src="<?= base_url();?>assets/ui-users/js/custom.js"></script>
    <script src="<?= base_url();?>assets/custom/js/my_scripts.js"></script>

    <script>
        $(function () {
            
        }); 

        var tpj = jQuery;

        var revapi3;
        tpj(document).ready(function() {
            if (tpj("#rev_slider_3_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_3_1");
            } else {
                revapi3 = tpj("#rev_slider_3_1").show().revolution({
                    sliderType: "standard",
                    jsFileLocation: "//localhost/revslider-standalone/revslider-standalone/revslider/public/revslider/assets/js/",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    gridwidth: 1366,
                    gridheight: 790,
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 400,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        type: "mouse",
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }); /*ready*/
    </script>

</body>


</html>