  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
          <li class="active">Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  
    
       <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="categoryform" name="categoryform" method="POST"  >
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control" id="c_category_name" name="c_category_name" placeholder="Category Name">
                </div>
                 <div class="form-group">
                <label>Parent</label>
                <select class="form-control select2 select2-hidden-accessible" id="n_parent_id" name="n_parent_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option selected="selected">Blank</option>
                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_category',$value,'c_status','A','desc','n_id');
							foreach($cat as $row)
							{			  
							?>
							<option value="<?php echo $row->n_id ?>*<?php echo $row->c_display ?>"><?php echo $row->c_display ?></option>
							<?php
							}
							?>
                                                           
                </select>
              </div>
                <div class="form-group">
                  <label for="img">Image</label>
                  <input type="file" id="image" name="image">

                </div>
          
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
                      c_category_name:  {  required: true },
					  n_parent_id:  {  required: true },
					  image:  {  required: true },
					  
                },
				 
				  messages:
				 {
					 c_category_name:
					 {
						 required: "Category name required"
					 },
					 n_parent_id:
					 {
						 required: "Select Parent Category"
					 },
					  image:
					 {
						 required: "Select one image"
					 },
				 },
				 
		    	submitHandler: function ()
                  {
			
		      if($("#categoryform").valid()){
			      $('#submit').attr('Disabled',true);
			    var formData = new FormData($('#categoryform')[0]); 
		     	$('#err_msgs').html("<img src='ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
			
			    $.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('category_insert');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
							
						  if(msd == 'success'){
						  swal({title: "Success!", type: "success", text: "Added Successfully", showConfirmButton: false, timer: 2000});

								   window.location="<?php echo site_url('category_list') ?>";
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
