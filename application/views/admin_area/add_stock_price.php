<?php
$new_pid =$new_n_category ="";
$new_pid = $this->session->userdata('new_product_id');
 $sqlp="select c_product_name,n_category from product_master where n_product_id='$new_pid'";
$resultp = $this->login_db->get_results($sqlp);
		if($resultp)
		{
		  foreach($resultp as $rowp)
		  {
			  $new_product_name = $rowp->c_product_name;
			  $new_n_category = $rowp->n_category;
		  }
		}
		  ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Stock And Price
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Stock And Price</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  
    
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Stock And Price</h3>
            </div>
            <div class="box-body">
			<form id="stock_price">
              <div class="row">
                <div class="col-xs-4">
                         <div class="form-group">
              <label for="category" class="col-sm-4 control-label">Category</label>
			  <div class="col-sm-10">
                <select class="form-control select2" id="category" name="category[]" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">

                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_category',$value,'c_status','A','desc','n_id');
							foreach($cat as $row)
							{
                              if($row->n_id==$new_n_category)		
							    $catselected = 'selected="selected"';
                                      else
                                      $catselected = '';							  
							?>
							<option <?php echo $catselected; ?> value="<?php echo $row->n_id ?>"><?php echo $row->c_display ?></option>
							<?php
							}
							?>
                </select>
                <label for="category" class="error"></label>
				</div>
              </div>
                </div>
                <div class="col-xs-4">
                          <div class="form-group">
              <label for="category" class="col-sm-4 control-label">Products</label>
			  <div class="col-sm-10">
                <select class="form-control" id="products" name="products" data-placeholder="Select a product" style="width: 100%;">
				<option value=''>Select product</option>
				<?php
      $pro =  "select n_product_id,c_product_name from product_master where n_category='$new_n_category'";
							foreach($pro as $rowpro)
							{
                              if($rowpro->n_product_id==$new_pid)		
							    $pselected = 'selected="selected"';
                                      else
                                      $pselected = '';							  
							?>
							
							<option <?php echo $pselected; ?> value="<?php echo $rowpro->n_product_id ?>"><?php echo $rowpro->c_product_name ?></option>
							<?php
							}
							?>
                </select>
				</div>
              </div>
                </div>
                <div class="col-xs-4">
                                 <div class="form-group">
              <label for="category" class="col-sm-4 control-label">Attribute</label>
			  <div class="col-sm-10">
                <select class="form-control" id="attribute" name="attribute" data-placeholder="Select a attribute" style="width: 100%;">
                  
                </select>
				</div>
              </div>
                </div>
              </div><br>
			      <div class="row">
	   <div class="col-xs-4">
           <div class="form-group">
              <label for="category" class="col-sm-4 control-label">Batch code</label>
			  <div class="col-sm-10">
                <select class="form-control" id="batchcode" name="batchcode" data-placeholder="Select a batchcode" style="width: 100%;">
           <option value='0'>Select batchcode</option>
                </select>
				</div>
              </div>
                </div>
					   <div class="col-xs-4">
           <div class="form-group">
              <label for="category" class="col-sm-6 control-label">New Batch code</label>
			  <div class="col-sm-10">
              <input type="text" class="form-control" id="new_batchcode" name="new_batchcode" placeholder="New Batch code">
				</div>
              </div>
                </div>
                

		<div class="col-xs-4">
            <div class="form-group">
              <label for="category" class="col-sm-6 control-label">MRP</label>
			  <div class="col-sm-10">
              <input type="text" class="form-control" id="mrp" name="mrp" placeholder="MRP">
			</div>
              </div>
                </div>
				  </div><br>
                
   
				  <div class="row">
	
			 <div class="col-xs-4">
             <div class="form-group">
              <label for="category" class="col-sm-6 control-label">Distributor Price</label>
			  <div class="col-sm-10">
              <input type="text" class="form-control" id="distributor_price" name="distributor_price" placeholder="Distributor Price">
				</div>
              </div>
                </div>
		<div class="col-xs-4">
           <div class="form-group">
              <label for="category" class="col-sm-6 control-label">Tax</label>
			  <div class="col-sm-10">
              <input type="text" class="form-control" id="tax" name="tax" placeholder="Tax">
				</div>
              </div>
                </div>
				<div class="col-xs-4">
             <div class="form-group">
              <label for="Stock" class="col-sm-6 control-label">Stock</label>
			  <div class="col-sm-10">
              <input  type="text" class="form-control" id="stock" name="stock" placeholder="Stock">
				</div>
              </div>
                </div>
            </div><br>
		 <div class="row">
	

		
		<div class="col-xs-4">
           <div class="form-group">
              <label for="Expiry date" class="col-sm-6 control-label">Expiry date</label>
			  <div class="col-sm-10">
              <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="Expiry date" autocomplete="off">
				</div>
              </div>
                </div>
                
                
            </div>
            
            <br>
            
			<div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
					 <span  id="err_msgs"><font color="red"></font></span>
                      <button type="submit" id="submit" class="btn btn-success">Save Data</button>

                    </div>
                  </div> 
            
            </div>
            
		
            <br>
			 
				  </form>
            </div>
            <!-- /.box-body -->
          </div>
  
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <link rel="stylesheet" href="<?php echo member_path ?>bower_components/select2/dist/css/select2.min.css">
 <link rel="stylesheet" href="<?php echo member_path ?>dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- jQuery 3 -->
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo member_path ?>bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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
    $('.sidebar-menu').tree();
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
    $('#expiry_date').datepicker({
      autoclose: true,format: 'dd-mm-yyyy'
    });
	
	

<?php if($new_n_category){  ?>
	$.ajax({
		type:"POST",
		url:'<?php echo site_url('get_product'); ?>',
		data: {'selectcat[]': <?php echo $new_n_category;?>
		,'isAjax':true},
		dataType:'json',
		success:function(data){

			if(data){
				var select = $("#products"), options = '';
				select.empty();
				options += "<option value=''>Select product</option>";      
				 for(var i=0;i<data.length; i++)
				 {
					options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
				 }
				 select.append(options);
				}
		                     }
				});
				<?php }  ?>
				
				
				<?php if($new_pid){  ?>
				$.ajax({
				type:"POST",
				url:'<?php echo site_url('get_attributes'); ?>',
				data: {selectcat:<?php echo  $new_pid;?>
				,'isAjax':true},
				dataType:'json',
				success:function(data){

				if(data){
						var select = $("#attribute"), options = '';
						select.empty();
						options += "<option value=''>Select Attribute</option>";      
						 for(var i=0;i<data.length; i++)
						 {
							options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
						 }
						 select.append(options);
						}
		          }
				});
		<?php }?>
				
				
  });

  	$("#category").change (function(){
		var st_id = $(this).val();
		$.ajax({
		type:"POST",
		url:'<?php echo site_url('get_product'); ?>',
		data: {selectcat: st_id
		,'isAjax':true},
		dataType:'json',
		success:function(data){

			if(data){
				var select = $("#products"), options = '';
				select.empty();
				options += "<option value=''>Select product</option>";      
				 for(var i=0;i<data.length; i++)
				 {
					options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
				 }
				 select.append(options);
				}
		                     }
				});
			});
			
	$("#products").change (function(){
		var st_id = $(this).val();
		
		$.ajax({
		type:"POST",
		url:'<?php echo site_url('get_attributes'); ?>',
		data: {selectcat: st_id
		,'isAjax':true},
		dataType:'json',
		success:function(data){

			if(data){
				var select = $("#attribute"), options = '';
				select.empty();
				options += "<option value=''>Select Attribute</option>";      
				 for(var i=0;i<data.length; i++)
				 {
					options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
				 }
				 select.append(options);
				}
		                     }
				});
			});
			
	$("#attribute").change (function(){
		var st_id = $(this).val();
		$.ajax({
		type:"POST",
		url:'<?php echo site_url('get_batchcode'); ?>',
		data: {selectcat: st_id
		,'isAjax':true},
		dataType:'json',
		success:function(data){

			if(data){
				var select = $("#batchcode"), options = '';
				select.empty();
				options += "<option value='0'>Select batchcode</option>";      
				 for(var i=0;i<data.length; i++)
				 {
					options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
				 }
				 select.append(options);
				}
		                     }
				});
			});
			
	$("#batchcode").change (function(){
		var st_id = $(this).val();
		if(st_id==0)
			   {
			$("#submit").html("Save Data"); 
		    $("#new_batchcode").val("");
			$("#mrp").val("");
			$("#d_actual_price").val("");
			$("#distributor_price").val("");
			$("#tax").val("");
			$("#bv").val("");
			$("#stock").val("");
			$("#expiry_date").val("");
			   }
	   else{
	       
	        $(".ddd").show();
	       
			  $("#submit").html("Update Data");
         
		$.ajax({
		type:"POST",
		url:'<?php echo site_url('get_details'); ?>',
		data: {selectcat: st_id
		,'isAjax':true},
		dataType:'json',
		success:function(data){
			 for(var i=0;i<data.length; i++)
				 {
			$("#new_batchcode").val(data[i].batch_code);
			$("#mrp").val(data[i].mrp);
			$("#distributor_price").val(data[i].distributor_price);
			$("#tax").val(data[i].tax);
			$("#stock").val(data[i].stock);
			$("#expiry_date").val(data[i].expiry_date);
				 }
		}
	});
	  }
	});
</script>

<script>
 $("#stock_price").validate({
     

              rules:
                {
                    
                      'category[]':  {  required: true },
					  products:  {  required: true },
					  attribute:  {  required: true },
					  mrp:  {  required: true },
					  distributor_price:  {  required: true },
					  tax:  {  required: true },
					  stock:  {  required: true },
					  expiry_date:  {  required: true },
					  
                },
				 
				  messages:
				 {
					 'category[]':
					 {
						 required: "Select category"
					 },
					 products:
					 {
						 required: "Select Product"
					 },
					
					 attribute:
					 {
						 required: "Select Attribute"
					 },			
					 mrp:
					 {
						 required: "Enter mrp"
					 },				
					 distributor_price:
					 {
						 required: "Enter Distributor Price"
					 },					
					 tax:
					 {
						 required: "Enter Tax"
					 },
					 stock:
					 {
						 required: "Enter stock"
					 },				
					 expiry_date:
					 {
						 required: "Select expiry date"
					 },
				 },
				 
		    	submitHandler: function ()
                  {
			
		      if($("#stock_price").valid()){
			
			    var formData = new FormData($('#stock_price')[0]); 
		       // $('#submit').attr('Disabled',true);
		     	$('#err_msgs').html("<img src='ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
				var bth=$('#batchcode').val();
			   if(bth==0)
			   {
			    $.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('price_insert');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
						  if(msd == 'success'){
                     swal({title: "Success!", type: "success", text: "Added Successfully", showConfirmButton: false, timer: 2000});
								   window.location.reload();
						   }
						   else if(msd == 1){
							 swal({title: "Error!", type: "error", text: "Enter all fields", showConfirmButton: false, timer: 2000});
					$('#submit').attr('Disabled',false);
					$('#err_msgs').html("");
						   }
						   else if(msd == 2){
			 		 swal({title: "Error!", type: "error", text: "Batch code existing..!", showConfirmButton: false, timer: 2000});
			 		 		$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else{
	 			 swal({title: "Error!", type: "error", text: "Some error occurs..Try after sometime.", showConfirmButton: false, timer: 2000});
                  			$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");                    
						   }
						   
						}
			});
			   }
			   else{
				$.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('price_update');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
						  if(msd == 'success'){
                     swal({title: "Success!", type: "success", text: "Updated Successfully", showConfirmButton: false, timer: 2000});
								   window.location.reload();

								  // window.location.reload();
						   }
						   else if(msd == 1){
				 swal({title: "Error!", type: "error", text: "Enter all fields", showConfirmButton: false, timer: 2000});
					$('#submit').attr('Disabled',false);
					$('#err_msgs').html("");  
						   }

						   else{
	 			 swal({title: "Error!", type: "error", text: "Some error occurs..Try after sometime.", showConfirmButton: false, timer: 2000});
                 	$('#submit').attr('Disabled',false);
					$('#err_msgs').html(""); 
                                      
						   }
						   
						}
			});
				   
			   }
				  
         }
		}
				  
      
    });

  </script>
</body>
</html>
