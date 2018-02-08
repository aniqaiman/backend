<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          {{ HTML::image('img/user3.jpg', 'User Image',  array('class' => 'img-circle')) }}
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
          <a href="{{route('dashboard')}}">
            <i class="fa fa-bars"></i> <span class="text-info">Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-usd"></i>
            <span class="text-info">Supplier / Buyer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="text-info" href="{{route('seller')}}"><i class="fa fa-level-down"></i>Supplier Management</a></li>
            <li><a class="text-info" href="{{route('buyer')}}"><i class="fa fa-level-down"></i>Buyer Management</a></li>
            <li><a class="text-info" href="{{route('group')}}"><i class="fa fa-level-down"></i>Group Management</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span class="text-info">Product Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="text-info" href="{{route('fruit')}}"><i class="fa fa-level-down"></i>Fruits Management</a></li>
            <li><a class="text-info" href="{{route('vegetable')}}"><i class="fa fa-level-down"></i>Vegetables Management</a></li>
            <li><a class="text-info" href="{{route('price')}}"><i class="fa fa-level-down"></i>Price Management</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="{{route('driver')}}">
            <i class="fa fa-truck"></i> <span class="text-info">Driver Management</span>
          </a>
        </li>

        <li class="treeview">
          <a href="{{route('users')}}">
            <i class="fa fa-users"></i> <span class="text-info">User Management</span>
          </a>
        </li> 
        
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>