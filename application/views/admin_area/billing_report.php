    
    <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>Product Billing Details <small></small> </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Product Billing Details</li>
    </ol>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
    
    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <h3 class="box-title">Product Billing Details</h3>
    </div>
    <div class="box-body">
    <div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-header">
    <h3 class="box-title"></h3>
    <form method="POST" id="form" name="form"  action="<?php echo site_url('bill_report_list') ?>"  >
    <div class="row">
    
  
    <div class="col-md-4">
    <label for="exampleInputEmail1">From Date</label>
    <input type="text" class="form-control" id="n_fromdate" name="from_date" autocomplete="off" placeholder="From date"  value="<?php echo date('d-m-Y'); ?>">
    </div>
    
     <div class="col-md-4">
    <label for="exampleInputEmail1">To Date</label>
    <input type="text" class="form-control"  id="n_todate" name="to_date" placeholder="To date" autocomplete="off" value="<?php echo date('d-m-Y'); ?>">
    </div>
  
   <div class="col-md-4">
    <label for="exampleInputEmail1">User ID</label>
    <input type="text" class="form-control"  id="user" name="user" placeholder="User ID" autocomplete="off">
    </div>
 
    
    </div>


     <div class="row">
    
  
    
    
    
  
  
  <div class="col-md-4">
  <label for="add"></label>
  <button type="submit"  class="btn btn-success" style="margin-top:23px;">Search</button>
  <span  id="err_msgs"><font color="red"></font></span> </div>
    
    </div>
  </form >
  </br></br>
    
     
 
    
    
    </div>
    
   
    </div>
    </div>
    <!-- /.box-body --> 
    <!--  <div class="box-footer">
    
    </div>--> 
    <!-- /.box-footer--> 
    </div>
    <!-- /.box --> 
    
    <!-- /.content --> 
    </div>
    
    <!-- /.control-sidebar --> 
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    </section>
  </div>
  
  
  
  
  
  
  
    <!-- ./wrapper -->
    <link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo member_path ?>bower_components/select2/dist/css/select2.min.css">
    <!-- jQuery 3 --> 
    <script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script> 
    <!-- Bootstrap 3.3.7 --> 
    <script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 
    <script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script> 
    <!-- SlimScroll --> 
    <script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> 
    <!-- FastClick --> 
    <script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script> 
    <!-- AdminLTE App --> 
    <script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script> 
    <!-- AdminLTE for demo purposes --> 
    <script src="<?php echo member_path ?>dist/js/demo.js"></script> 
    <script type="text/javascript" src="<?php echo member_path ?>js/jquery.fancybox.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo member_path ?>css/jquery.fancybox.css" media="screen" />
    <script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script> 
    <script src="<?php echo member_path ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 
    <script>
    
    $(document).ready(function () {

      
    $('#bill_date').datepicker({
    autoclose: true,format: 'dd-mm-yyyy'
    });
    $('#n_fromdate').datepicker({
    autoclose: true,format: 'dd-mm-yyyy'
    });
    $('#n_todate').datepicker({
    autoclose: true,format: 'dd-mm-yyyy'
    });
    
    $('.select2').select2()
   
    $('.sidebar-menu').tree();
    $('.fancybox').fancybox();
    
   
    
    });
    
   /*  $('#searchpurchase').click(function(){
    var n_fromdate=$("#n_fromdate").val();
    var n_todate=$("#n_todate").val();
    
    $.ajax({
    type: "POST",       
    data:{n_fromdate:n_fromdate,n_todate:n_todate},
    url: '<?php echo site_url('bill_report_list') ?>',
    success: function(msg) {
    $("#result").html(msg);
    }
    });
    });*/
  
    
  

  
    </script>
    </body></html><style>
    ul.tsc_pagination {
    margin:4px 0;
    padding:0px;
    height:100%;
    overflow:hidden;
    font:12px 'Tahoma';
    list-style-type:none;
    }
    ul.tsc_pagination li {
    float:left;
    margin:0px;
    padding:0px;
    margin-left:5px;
    }
    ul.tsc_pagination li a {
    color:black;
    display:block;
    text-decoration:none;
    padding:7px 10px 7px 10px;
    }
    ul.tsc_paginationA li a {
    color:#FFFFFF;
    border-radius:3px;
    -moz-border-radius:3px;
    -webkit-border-radius:3px;
    }
    ul.tsc_paginationA01 li a {
    color:#fff;
    border:solid 1px #F26639;
    padding:6px 9px 6px 9px;
    background:#E6E6E6;
    background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #000);
    background: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #277c88), color-stop(0.02, #036483), color-stop(1, #569da0));
    }
    ul.tsc_paginationA01 li:hover a, ul.tsc_paginationA01 li.current a {
    background:#00a651;
    }
    .error {
    color:#F00 !important;
    }
    select.error, textarea.error, input.error {
    color:#FF0000;
    }
    label.error {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: #da202c none repeat scroll 0 0;
    border-color: #9e253b;
    border-image: none;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px 0 0 1px;
    bottom: 46px;
    color: #fff !important;
    display: block;
    font-size: 12px;
    font-weight: 700;
    line-height: 20px;
    padding: 0 5px;
    position: absolute;
    right: 7px;
    margin-bottom:-5px !important;
    }
    .pac-container {
    z-index: 1051 !important;
    }
    </style>
    <style>
    .search-btn {
    background-color: #e03535;
    padding: 4px 10px;
    text-align: center;
    color: #FFF;
    }
    </style>