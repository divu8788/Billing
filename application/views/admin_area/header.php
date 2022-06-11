	<?php
	$refer=explode("/",$_SERVER['REQUEST_URI']);
	$cont=count($refer);
	$fnam=explode("?",$refer[$cont-1]);
	$loadedpage = $fnam[0];
	$mobilemenu=$mobilemenuopenul=$mobilelink1=$mobilelink2=$mobilelink3=$mobilelink4=$mobilelink5=$mobilelink6=$mobilelink7=$mobilelink8=$mobilelink9=$mobilelink10="";
	$phmenu=$phmenuopenul=$phlink1=$phlink2=$phlink3=$phlink4=$phlink5=$phlink6=$phlink7=$phlink8=$phlink9=$phlink10="";
	
	$reportmenu=$reportmenuopenul=$reportlink1=$reportlink2=$reportlink3=$reportlink4=$reportlink5=$reportlink6=$reportlink7=$reportlink8=$reportlink9=$reportlink10="";
	
	$pdtmenu=$pdtmenuopenul=$pdtlink1=$pdtlink2="";
	
	$frntmenu=$frntmenuopenul=$frntmenulink1=$frntmenulink2=$frntmenulink3=$frntmenulink4=$frntmenulink5=$frntmenulink6=$frntmenulink7=$frntmenulink8=$frntmenulink9=$frntmenulink10="";
	
	
	if(!empty($loadedpage)){

	switch($loadedpage){

	case 'category_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink1="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Category"; 
	break;
	
	case 'add_category': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink1="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Category"; 
	break;
	
	case 'group_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink2="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;

	case 'attribute_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink3="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	
	case 'add_attribute': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink3="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;

	case 'filter_group_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink4="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;

	case 'filter_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink5="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	
	case 'add_filter': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink5="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	
	case 'brand_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink6="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	case 'product_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink7="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	case 'add_stock_price': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink8="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	case 'stock_price_list': 
	$mobilemenu='active';$mobilemenuopenul="style='display:block;'"; $mobilelink9="class='active'";
	$crumb1="Shopping cart Management"; $crumb2="Attribute group"; 
	break;
	
	case 'product_billing_public': 
	$pdtmenu='active';$pdtmenuopenul="style='display:block;'"; $pdtlink1="class='active'";
	$crumb1="Product billing"; $crumb2="Product billing"; 
	break; 
	
	case 'billing_report': 
	$reportmenu='active';$pdtmenuopenul="style='display:block;'"; $pdtlink2="class='active'";
	$crumb1="billing report"; $crumb2="billing report"; 
	break;
	}
	}
	
	$sql="select c_logo,c_title from settings";
    $query=$this->db->query($sql);
    $rslt=$query->result();
    foreach($rslt as $row)
    {
		$c_logo=$row->c_logo;
		$c_title=$row->c_title;
    }
	?>
	<!DOCTYPE html>
	<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $c_title;?>| Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo member_path ?>dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo member_path ?>dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/morris.js/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo member_path ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

	<header class="main-header">
	<!-- Logo -->
	<a href="index2.html" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->

	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><img src="<?php echo logo_path2 ?>"></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	<span class="sr-only">Toggle navigation</span>
	</a>

	<div class="navbar-custom-menu">
	<ul class="nav navbar-nav">



	<!-- User Account: style can be found in dropdown.less -->
	<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	<img src="<?php echo member_path ?>dist/img/17241-200.png" class="user-image" alt="User Image">
	<span class="hidden-xs"><?php echo $c_title;?></span>
	</a>
	<ul class="dropdown-menu">
	<!-- User image -->
	<li class="user-header">
	<img src="<?php echo member_path ?>dist/img/17241-200.png" class="img-circle" alt="User Image">

	<p>
	<?php echo $c_title;?> - Admin
	<small><?php echo date('d-m-Y'); ?></small>
	</p>
	</li>

	<!-- Menu Footer-->
	<li class="user-footer">
	<div class="pull-left">
	<!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
	</div>
	<div class="pull-right">
	<a href="<?php echo site_url('admin_logout') ?>" class="btn btn-default btn-flat">Sign out</a>
	</div>
	</li>
	</ul>
	</li>
	<!-- Control Sidebar Toggle Button -->
	<!--<li>
	<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
	</li>-->
	</ul>
	</div>
	</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
	<div class="pull-left image">
	<img src="<?php echo member_path ?>dist/img/17241-200.png" class="img-circle" alt="User Image">
	</div>
	<div class="pull-left info">
	<p>Admin</p>
	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	</div>
	</div>
>
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu" data-widget="tree">
	<li>
	<a href="<?php echo site_url('dashboard') ?>">
	<i class="fa fa-dashboard"></i> <span>Dashboard</span>
	<span class="pull-right-container">
	<!-- <small class="label pull-right bg-green">new</small>-->
	</span>
	</a>
	</li>


	<li class="treeview <?php echo $mobilemenu;?>">
	<a href="#">
	<i class="fa fa-pie-chart"></i>
	<span>Shopping Cart Management</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu <?php echo $mobilemenuopenul;?>">
	<li <?php echo $mobilelink1;?>><a href="<?php echo site_url('category_list') ?>"><i class="fa fa-circle-o"></i>Category</a></li>
	<li <?php echo $mobilelink2;?>><a href="<?php echo site_url('group_list') ?>"><i class="fa fa-circle-o"></i>Attribute Group</a></li>
	<li <?php echo $mobilelink3;?>><a href="<?php echo site_url('attribute_list') ?>"><i class="fa fa-circle-o"></i>Attribute</a></li>
<li <?php echo $mobilelink6;?>><a href="<?php echo site_url('brand_list') ?>"><i class="fa fa-circle-o"></i>Brand</a></li>
	<li <?php echo $mobilelink7;?>><a href="<?php echo site_url('product_list') ?>"><i class="fa fa-circle-o"></i>Product</a></li>
	<li <?php echo $mobilelink8;?>><a href="<?php echo site_url('add_stock_price') ?>"><i class="fa fa-circle-o"></i>Add Stock & Price</a></li>
	<li <?php echo $mobilelink9;?>><a href="<?php echo site_url('stock_price_list') ?>"><i class="fa fa-circle-o"></i> Stock & Price List</a></li>

	</ul>
	</li>
	

	
	<li class="treeview <?php echo $pdtmenu;?>">
	<a href="#">
	<i class="fa fa-pie-chart"></i>
	<span>Product Billing</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu <?php echo $pdtmenuopenul;?>">
	<li <?php echo $pdtlink1;?>><a href="<?php echo site_url('product_billing_public') ?>"><i class="fa fa-circle-o"></i>Product Billing</a></li>
  <li <?php echo $pdtlink2;?>><a href="<?php echo site_url('billing_report') ?>"><i class="fa fa-circle-o"></i>Product Billing Report</a></li>

	</ul>
	</li>

	</ul>

	
	</section>
	<!-- /.sidebar -->
	</aside>

	</body>
	</html>
    <style>
	.logo-lg img {
    height: 53px;
}
.logo-mini img {
    height: 37px;
}
.skin-blue .main-header .navbar {
    background-color: #e1f7ff!important;
    box-shadow: 10px 10px #00000005;
}
.content-wrapper {
    background: #d8f4fd;
}

element.style {
}
.skin-blue .main-header .logo {
    background-color: #e1f7ff;
    color: #fff;
    border-bottom: 0 solid transparent;
    box-shadow: 10px 10px 10px #0000001f;
}
.pull-left.image img {
    background: white;
    padding: 3px;
}
.skin-blue .main-header .navbar .sidebar-toggle:hover {
    background-color: #e1f7ff;
}
.skin-blue .main-header .logo:hover {
    background-color: #e1f7ff;
}

.skin-blue .main-header .navbar .nav>li>a {
    color: #222d32;
}
.info-box-content {
    padding: 22px 10px;
    margin-left: 90px;
}
	</style>