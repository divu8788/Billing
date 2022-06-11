  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Attribute</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  
    
       <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Add Attribute</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="categoryform" name="categoryform" method="POST"  enctype="multipart/form-data" >
              <div class="box-body">
			        <div class="form-group">
                <label>Group </label>
                <select class="form-control select2 select2-hidden-accessible" id="n_attribute_group" name="n_attribute_group" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option selected="selected" value="">Blank</option>
                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_group_name',$value,'c_status','A','desc','n_id');
							foreach($cat as $row)
							{			  
							?>
							<option value="<?php echo $row->n_id ?>"><?php echo $row->c_display ?></option>
							<?php
							}
							?>
                                                           
                </select>
                <label for="n_attribute_group" class="error"></label>
              </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Attribute Name</label>
                  <input type="text" class="form-control" id="c_attribute_name" name="c_attribute_name[]" placeholder="Attribute Name">			  			    
                </div>
           <button id="addmore" name="addmore" class="btn btn-success pull-right" type="button" >Add more</button><br>
		   <div id="add_more">
		 </div><br>

          <?php
					if($this->session->flashdata('msg')) {
					$message = $this->session->flashdata('msg');
				 ?>
				<span  ><font color="red"><?php echo $message; ?></font></span>
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
  
 $('#addmore').on('click', function () {
	  
$('#add_more').append('<div id="extramore"><div class="form-group"><label for="attributename">Attribute Name</label><input type="text" class="form-control" id="c_attribute_names" name="c_attribute_name[]" placeholder="Attribute Name">	 </div><div class="row"><div class="col-md-12 text-right"><label></label><button id="remove" name="remove"  class="btn btn-danger remove" type="button" style="margin-top: 20px !important;">Remove</button> </div></div></div>');

 });
 
  $(document).on('click', '.remove', function () {		 
		$(this).parent().parent().remove(); 			
		    });
</script>

<script>
  $(document).ready(function () {
 $("#categoryform").validate({
	 
              rules:
                {
                      'c_attribute_name[]':  {  required: true },
					  n_attribute_group:  {  required: true },
					  
                },
				 
				  messages:
				 {
					 'c_attribute_name[]':
					 {
						 required: "Attribute name required"
					 },
					 n_attribute_group:
					 {
						 required: "Select Attribute Group"
					 },
				 },
				 		submitHandler: function ()
                  {
			
		      if($("#categoryform").valid()){
			     $('#submit').attr('Disabled',true);
		     	$('#err_msgs').html("<img src='ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
			
			    $.ajax({
                type: "POST",
                url: "<?php echo site_url('attribute_insert') ?>",
				data: $('#categoryform').serialize(),
                success: function (msd)
                        {
						  if(msd == 'success'){
                            swal({title: "Success!", type: "success", text: "Added Successfully", showConfirmButton: false, timer: 2000});
								   window.location="<?php echo site_url('attribute_list') ?>";
						   }
						   else if(msd == 1){
							swal({title: "Error!", type: "error", text: "enter all fields", showConfirmButton: false, timer: 2000});
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
	
	  });

  </script>
</body>
</html>
