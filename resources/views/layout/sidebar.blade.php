<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        {{ HTML::image('img/foodrico.png', 'User Image',  array('class' => 'img-circle')) }}
      </div>
      <div class="pull-left info">
        <p>Admin</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

      <!-- sidebar menu: : style can be found in s
      idebar.less -->
      <ul class="sidebar-menu " data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="{{route('welcome')}}">
            <i class="fa fa-dashboard"></i> <span class="text-info">Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('order')}}">
            <i class="fa fa-shopping-cart"></i> <span class="text-info">Order Tracking</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
          <i class="fa fa-comments"></i> <span class="text-info">Feedback Trail n/a</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span class="text-info">Stock Count</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="text-info" href="{{route('fruit')}}"><i class="fa fa-level-down"></i>Fruit Stock</a></li>
            <li><a class="text-info" href="{{route('vege')}}"><i class="fa fa-level-down"></i>Vegetable Stock</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span class="text-info">SKU Member ID n/a</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span class="text-info">Price Setting Page n/a</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i> <span class="text-info">Earning Summary n/a</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('driver')}}">
            <i class="fa fa-truck"></i> <span class="text-info">Lorry Driver</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('seller')}}">
            <i class="fa fa-user"></i> <span class="text-info">Supplier Listing</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('buyer')}}">
            <i class="fa fa-user-plus"></i> <span class="text-info">Buyer Listing</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('users')}}">
            <i class="fa fa-male"></i> <span class="text-info">User Management</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('group')}}">
            <i class="fa fa-users"></i> <span class="text-info">Group Management</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
