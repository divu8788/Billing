 <?php
  $sql1="select * from shopping_group_name where n_id='$id'";	
  $result = $this->login_db->get_results($sql1);
         if($result)
				  {
		         foreach($result as $rows)
		           {
					   $c_group_name=$rows->c_group_name;
				   }
				  }
 ?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Attribute Group</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  
    
       <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Edit Attribute Group</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="categoryform" name="categoryform" >
                <div class="box-body">
					 <input type="hidden" value="<?php echo $id; ?>" name="n_id" id="n_id"> 
 
                <div class="form-group">
                  <label for="exampleInputEmail1">Filter Name</label>
                  <input type="text" class="form-control" id="c_group_name" name="c_group_name" placeholder="Group Name" value="<?php echo $c_group_name; ?>">
                </div>
           
     
          <?php
					if($this->session->flashdata('msg')) {
					$message = $this->session->flashdata('msg');
				 ?>
				<span ><font color="red"><?php echo $message; ?></font></span>
				<?php
														}
					?>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                	 <span  id="err_msgs"><font color="red"></font></span>
              </div>
            </form>
          </div>
      


 
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <link rel="stylesheet" href="<?php echo member_path ?>bower_components/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="<?php echo member_path ?>dist/css/AdminLTE.min.css">
<!-- jQuery 3 -->
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo member_path ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>
<script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  });
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>

<script>
 $("#categoryform").validate({
              rules:
                {
                      c_group_name:  {  required: true },

					  
                },
				 
				  messages:
				 {
					 c_group_name:
					 {
						 required: "Category name required"
					 },

				 },
					  	submitHandler: function ()
                  {
			
		      if($("#categoryform").valid()){
			
			    var formData = new FormData($('#categoryform')[0]); 
		      $('#submit').attr('Disabled',true);
		      $('#err_msgs').html("<img src='../ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
			
			    $.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('update_group');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
						  if(msd == 'success'){
						  swal({title: "Success!", type: "success", text: "Added Successfully", showConfirmButton: false, timer: 2000});
					   window.location="<?php echo site_url('group_list') ?>";
						   }
						   else if(msd == 1){
							 swal({title: "Error!", type: "error", text: "Enter all fields", showConfirmButton: false, timer: 2000});
						    $('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else if(msd == 2){
							  swal({title: "Error!", type: "error", text: "Already Added..!", showConfirmButton: false, timer: 2000});
							$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else{
                      swal({title: "Error!", type: "error", text: "Some error occurs.. Try after sometimes..", showConfirmButton: false, timer: 2000});    
                         $('#submit').attr('Disabled',false);
						 $('#err_msgs').html("");
						   }
						   
						}
			});
				  
         }
		}		  
      
    });

  </script>
</body>
</html>
