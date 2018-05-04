<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        {{ HTML::image('img/foodrico.png', 'User Image', array('class' => 'img-circle')) }}
      </div>
      <div class="pull-left info">
        <p>FoodRico Admin</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Ready to Serve</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu " data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li class="treeview">
        <a href="{{ route('welcome') }}">
            <i class="fa fa-dashboard"></i> <span class="text-info">Dashboard</span>
          </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-shopping-cart"></i>
          <span class="text-info">Order Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('orders.receipts') }}"><i class="fa fa-circle-o"></i>Manage Receipts</a></li>
          <li><a href="{{ route('orders.trackings') }}"><i class="fa fa-circle-o"></i>Manage Trackings</a></li>
          <li><a href="{{ route('orders.rejects') }}"><i class="fa fa-circle-o"></i>Manage Rejects</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
            <i class="fa fa-archive"></i>
            <span class="text-info">Product Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('fruit') }}"><i class="fa fa-circle-o"></i>Manage Fruit</a></li>
          <li><a href="{{ route('vege') }}"><i class="fa fa-circle-o"></i>Manage Vegetable</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
            <i class="fa fa-dollar"></i> <span class="text-info">Price Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i>
            <span class="text-info">User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('driver') }}"><i class="fa fa-circle-o"></i>Manage Lorries</a></li>
          <li><a href="{{ route('seller') }}"><i class="fa fa-circle-o"></i>Manage Suppliers</a></li>
          <li><a href="{{ route('buyers') }}"><i class="fa fa-circle-o"></i>Manage Buyers</a></li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>