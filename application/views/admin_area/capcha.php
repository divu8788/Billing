<!DOCTYPE html>

<html>

<head>

   <title>Implement Captcha in Codeigniter using helper</title>

   <script>

       $(document).ready(function(){

           $('.captcha-refresh').on('click', function(){

               $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){

                   $('#image_captcha').html(data);

               });

           });

       });

   </script>

<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>

</head>

<body>

<p id="image_captcha"><?php echo $captchaImg; ?></p>

<a href="javascript:void(0);" class="captcha-refresh" ><img src="<?php echo base_url().'images/refresh.png'; ?>"/></a>

<form method="post">

   <input type="text" name="captcha" value=""/>

   <input type="submit" name="submit" value="SUBMIT"/>

</form>

</body>

</html>