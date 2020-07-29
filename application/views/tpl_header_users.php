<nav id="menu-1" class="mega-menu" data-color="">

    <div class="menu-list-items">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <ul class="menu-logo">
                        <li>
                            <a href="index.html"><img src="<?= base_url();?>assets/ui-users/images/logo.png" alt="logo" class="img-fluid"></a>
                        </li>
                    </ul>

                   <!--  <ul class="menu-search-bar">
                        <li class="menu-contact">
                        	<a href="javascript:void(0)">Login</a>
                        </li>
                        <li class="menu-contact iq-fw-5">
	                        <a href="javascript:void(0)">Register</a>
                        </li>
                    </ul> -->

                    <ul class="menu-links">

                        <li>
                            <a href="javascript:void(0)" id="linkToHome" onclick="loadMainContent('')">Home</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" id="linkToProduct" onclick="loadMainContent('')">Product</a>
                        </li>
                        <li>
                        	<a href="javascript:void(0)" id="linkToAbout" onclick="loadMainContent('')">About</a>
                        </li>
                        <li>
                        	<a href="javascript:void(0)" id="linkToGallery" onclick="loadMainContent('')">Gallery</a>
                        </li>
                        <li>
                        	<a href="javascript:void(0)" id="linkToContact" onclick="loadMainContent('')">Contact us</a>
                        </li>
                        <li>
                        	<a href="javascript:void(0)" id="linkToCart" onclick="loadMainContent('')"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                        <?php 
                            if ($this->session->userdata('id') != '') {
                                ?>
                                    <li class="pull-right" style="border-left: 1px solid;">
                                        <a href="<?= base_url();?>member" >
                                            <?= $this->session->userdata('nama'); ?>
                                        </a>
                                    </li>
                                <?php
                            }else{
                                ?>
                                    <li class="pull-right" style="border-left: 1px solid;">
                                        <a href="javascript:void(0)" id="linkToSignIn" onclick="loadMainContent('users.login/manage')">SignIn</a>
                                    </li>
                                <?php
                            }
                         ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>