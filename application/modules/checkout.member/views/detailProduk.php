<style type="text/css">
  img {
  max-width: 100%; 
}

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }


.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

</style>

<?php 

$media = json_decode($produk['media'] ? :'[]');
 ?>
  <div class="container">
    <div class="card">
      <h4 class="card-title"><a href="javascript:void(0)" onclick="backTolistProduct()" class="btn btn-sm btn-warning pull-right"> Kembali </a></h4>
      
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">
            <div class="preview-pic tab-content">              
                <?php
                  for ($i=0; $i < count($media); $i++) { 
                    if ($i == 0) {
                      ?>
                        <div class="tab-pane active" id="pic-<?= $i; ?>">
                           <img src="<?= $media[$i]->sourceMedia; ?>"/>
                        </div>
                      <?php
                    }else{
                      ?>
                        <div class="tab-pane" id="pic-<?= $i; ?>">
                           <img src="<?= $media[$i]->sourceMedia; ?>"/>
                        </div>
                      <?php
                    }
                   ?>
                   
                   <?php
                  }
                ?>           
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
              <?php
                  for ($i=0; $i < count($media); $i++) { 
                    if ($i == 0) {
                      ?>
                        <li class="active">
                          <a data-target="#pic-<?= $i; ?>" data-toggle="tab">
                            <img src="<?= $media[$i]->sourceMedia; ?>" />
                          </a>
                        </li>
                      <?php
                    }else{
                      ?>
                        <li>
                          <a data-target="#pic-<?= $i; ?>" data-toggle="tab">
                            <img src="<?= $media[$i]->sourceMedia; ?>" />
                          </a>
                        </li>
                      <?php
                    }
                   ?>
                   
                   <?php
                  }
              ?>
            </ul>
            
          </div>
          <div class="details col-md-6">
            <h3 class="product-title">
              <?= $produk['nama_produk'] ?>
              
            </h3>
          
            <p class="product-description">
              <?= base64_decode($produk['deskripsi']); ?>
            </p>  
            <h4 class="price">Harga: <span>Rp <?= number_format($produk['harga']); ?></span></h4>
            <h4 class="price">Harga Member: <span>Rp <?= number_format($produk['harga_member']); ?></span></h4>
            <!-- <h5 class="sizes">Quantity:
              
            </h5> -->
            <br>
            <br>
          
            <div class="row">
              <div class="col-md-3">
                <input style="width: 100%;height: 45px;font-size: 15px;text-align: center;"
                 type="number" name="qtyProduk" id="qtyProduk" class="form-control w-30" min='1' value="1" 
                >
              </div>
              <div class="col-md-3">
                <a class="add-to-cart btn btn-default" onclick="addToCart('<?=$produk['id'] ?>');">add to cart</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>