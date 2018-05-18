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

      <li class="header">PER SKETCH (TEMPORARY)</li>

      <li class="treeview">
        <a href="{{ route('orders.index.receipts') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A1 - Order Receipt</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('orders.index.trackings') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A2 - Order Tracking</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('orders.index.rejects') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A4 - Feedback Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('inventories.index') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A5 - Inventory Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('prices.index.promos') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A6 - Promo Price Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('inventories.index.wastages') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A7 - Wastage Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('prices.index') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A8 - Price Dashboard</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('prices.index.histories') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A9 - Historic Price Data</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('orders.index.lorries') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A10 - Lorry Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('users.sellers.index') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A12 - Supplier Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('users.buyers.index') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A15 - Buyer Management</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('orders.index.transactions') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A18 - Buyer Transcation</span>
          </a>
      </li>

      <li class="treeview">
        <a href="{{ route('orders.index.transactions') }}">
            <i class="fa fa-chevron-circle-right"></i> <span class="text-info">A20 - Supplier Transcation</span>
          </a>
      </li>

      <li class="header">GROUPED (TEMPORARY)</li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-shopping-cart"></i>
          <span class="text-info">Order Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('orders.index.receipts') }}"><i class="fa fa-circle-o"></i>Manage Receipts</a></li>
          <li><a href="{{ route('orders.index.trackings') }}"><i class="fa fa-circle-o"></i>Manage Trackings</a></li>
          <li><a href="{{ route('orders.index.rejects') }}"><i class="fa fa-circle-o"></i>Manage Rejects</a></li>
          <li><a href="{{ route('orders.index.transactions') }}"><i class="fa fa-circle-o"></i>Historical Transaction</a></li>
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
          <li><a href="{{ route('products.fruits.index') }}"><i class="fa fa-circle-o"></i>Manage Fruits</a></li>
          <li><a href="{{ route('products.vegetables.index') }}"><i class="fa fa-circle-o"></i>Manage Vegetables</a></li>
          <li><a href="{{ route('inventories.index') }}"><i class="fa fa-circle-o"></i>Manage Inventories</a></li>
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
          <li><a href="{{ route('users.drivers.index') }}"><i class="fa fa-circle-o"></i>Manage Lorries</a></li>
          <li><a href="{{ route('users.sellers.index') }}"><i class="fa fa-circle-o"></i>Manage Suppliers</a></li>
          <li><a href="{{ route('users.buyers.index') }}"><i class="fa fa-circle-o"></i>Manage Buyers</a></li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>