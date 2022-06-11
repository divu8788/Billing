
<?php
$sql="select c_title from settings";
    $query=$this->db->query($sql);
    $rslt=$query->result();
    foreach($rslt as $row)
    {
		 $c_title=$row->c_title;
    }
	?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin <?php echo $c_title;?> | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo member_path ?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="container-fluid">
<div class="row jk">
  <!--  <div class="col-md-6">
        <img class="jhu" src="http://localhost/Billing/assets/adminarea/images/admin-logo.jpg">
    </div>-->
    
    
    <div class="col-md-6">
            <div style="    margin: 0 auto;
" class=" class="hold-transition login-page"">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b><?php echo $c_title;?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="loginform" >
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" id="username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <label for="username" class="error"></label>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         <label for="password" class="error"></label>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          	
        </div>
		<div class="col-xs-4"><span  id="err_msgs"><font color="red"></font></span></div>
      </div>
    </form>

   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>
    </div>
    
    
</div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo member_path ?>plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<style>
    .login-box, .register-box {
    width: 360px;
    margin: inherit;
}
.jk{
        display: flex;
    align-items: center;
    height: 100%;
}
body {
    /*background: url(http://localhost/Billing/assets/adminarea/images/admin-logo.jpg);
    /* position: fixed; */
    /* height: 100%; */
        display: flex;
}
.login-logo a, .register-logo a {
    color: #fff;
}
.login-box-body, .register-box-body {
    background: #e5f8ff;
    padding: 20px;
    border-top: 0;
    color: #666;
    border-radius: 20px;
    box-shadow: 10px 10px 10px #00000040;
}

@media only screen and (max-width: 1366px) {
  body {
        background-position: -235px;
  }
}
@media only screen and (max-width: 1200px) {
  body {
      background-position: -322px;
  }
}
@media only screen and (max-width: 1000px) {
  body {
    background-position: -452px;
  }
}
@media only screen and (max-width: 990px) {
    .jhu{
        width:40%;
    }
 .jk {
    display: inherit;
    align-items: center;
    height: 100%;
}
body {
    background-position: -3%;
}
.login-box, .register-box {
    width: inherit;}
    .login-logo a, .register-logo a {
    color: #000;
}
}


</style>
 <script>

 $("#loginform").validate({
              rules:
                {
                      username:  {  required: true },
					  password:  {  required: true },
					  
                 },
				 
				  messages:
				 {
					 username:
					 {
						 required: "Username required"
					 },
					 password:
					 {
						 required: "Password required"
					 },
				 },
				  
       submitHandler: function ()
        {
             if($("#loginform").valid()){
				 $('#err_msgs').html("<img src='<?php echo base_url(); ?>ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
                $('#submit').attr('Disabled',true);
		     	
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('login_check'); ?>",
				data: new FormData($('#loginform')[0]),				
                async: false,
				cache: false,
                contentType: false,
                processData: false,
                        success: function (result)
                        {
                            if (result == 1) {
                              swal({title: "Login Successfully!", type: "success", text: "Please wait...You are redirecting", showConfirmButton: false, timer: 2000});
			
							  window.location.href='<?php echo site_url('dashboard') ?>';
							}

							else {
								 //$("#error").html("<font color=red>Invalid Login..!</font>");
                             swal({title: "Error!", type: "error", text: "Invalid Username or Password", showConfirmButton: false, timer: 2000});
                             	 $('#submit').attr('Disabled',false);
							 	$('#err_msgs').html("");
                            }
                        }
						
            })

        }
        }
    });

  </script>
</body>
</html>
