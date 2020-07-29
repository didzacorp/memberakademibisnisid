<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    
    <li class="nav-item nav-profile">
      <div class="nav-link d-flex">
        <div class="profile-image">
          <img  src="<?= base_url();?>assets/ui-member/images/logo/users.gif" alt="image"/>
          <span class="online-status online" ></span> <!--change class online to offline or busy as needed-->
        </div>
        <div class="profile-name">
          <p class="name">
            <?= $this->session->userdata('nama'); ?>
          </p>
          <p class="designation">
            Lisence Of <?= $this->session->userdata('lisensi'); ?>
          </p>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Main</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/dashboard.member/manage');">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/trafic.member/manage');">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Trafic</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/profile.member/manage');">
        <i class="icon-user menu-icon"></i>
        <span class="menu-title">Profile</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/lead.member/manage');">
        <i class="icon-people menu-icon"></i>
        <span class="menu-title">My Lead</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/membership.member/manage');">
        <i class="icon-people menu-icon"></i>
        <span class="menu-title">Membership</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/training.member/manage');">
        <i class=" icon-layers menu-icon"></i>
        <span class="menu-title">Training</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/product.member/manage');">
        <i class="icon-tag menu-icon"></i>
        <span class="menu-title">Shop</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/order.status.member/manage');">
        <i class="icon-bag menu-icon"></i>
        <span class="menu-title">Order Status</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0)" onclick="loadMainContentMember('/copywriting.member/manage');">
        <i class=" icon-note menu-icon"></i>
        <span class="menu-title">Copywriting</span>
      </a>
    </li>
  </ul>
</nav>