<div id="wrapper">

 <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->


              <ul class="nav navbar-top-links navbar-right">
                           
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            @include('layouts.menu')

</nav>

 <div id="page-wrapper">
  	 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Control Electoral</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
       <div class="row">
       		<ui-view></ui-view>
       </div>


 </div>

</div>

<!-- Custom Theme JavaScript -->
<script src="app_cliente/dist/js/sb-admin-2.js"></script>