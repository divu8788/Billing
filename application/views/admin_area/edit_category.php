 <?php
  $sql1="select * from shopping_category where n_id='$id'";	
  $result = $this->login_db->get_results($sql1);
         if($result)
				  {
		         foreach($result as $rows)
		           {
					   $c_category_name=$rows->c_category_name;
					   $n_parent_id=$rows->n_parent_id;
				   }
				  }
 ?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  
    
       <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Edit Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="categoryform" name="categoryform" method="POST" action="<?php echo site_url('category_insert')?>" enctype="multipart/form-data" >
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
				  <input type="hidden" value="<?php echo $id; ?>" name="n_id" id="n_id"> 
                  <input type="text" class="form-control" id="c_category_name" name="c_category_name" placeholder="Category Name" value="<?php echo $c_category_name; ?>">
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
                              if($row->n_id==$n_parent_id){
								  $selected="selected";
							  }
								else{
									$selected="";
								}
							?>
							<option <?php echo $selected; ?> value="<?php echo $row->n_id ?>*<?php echo $row->c_display ?>"><?php echo $row->c_display ?></option>
							<?php
							}
							?>
                                                           
                </select>
              </div>
                <div class="form-group">
                  <label for="img">Image</label>
                  <input type="file" id="image" name="image">

                  <p class="help-block">
				  <?php
					if($this->session->flashdata('msg')) {
					$message = $this->session->flashdata('msg');
				 ?>
				<span ><font color="red"><?php echo $message; ?></font></span>
				<?php
														}
					?>

				  </p>
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
					  img:  {  required: true },
					  
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
					  img:
					 {
						 required: "Select one image"
					 },
				 },
				  
      
    });

  </script>
</body>
</html>
