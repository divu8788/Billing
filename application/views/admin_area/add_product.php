<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1>
       Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Product</h3>
<button type="button" class="btn btn-block btn-success btn-xs pull-right" style="width: 10% !important;" onclick="product_list()">Product List</button>
        </div>
        <div class="box-body">
              <div class="row">
        <div class="col-xs-12">
 <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" id="product_tab"><a href="#product_list" data-toggle="tab">Product Details</a></li>
              <li id="attribute_tab"><a href="#attribute_list" data-toggle="tab">Attribute</a></li>
			 <!-- <li id="filter_tab"><a href="#filter_list" data-toggle="tab">Filters</a></li>-->
              <li id="image_tab"><a href="#image_list" data-toggle="tab">Upload Image</a></li>
            </ul>
			<form class="form-horizontal" id="productform" name="productform">
            <div class="tab-content">
			    
              <div class="active tab-pane" id="product_list">
          <br>
          
    

                  <div class="form-group">
                    <label for="Productname" class="col-sm-2 control-label">Product Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="c_product_name" name="c_product_name" placeholder="Product Name">
                    </div>
                  </div>
                   <div class="form-group">
              <label for="category" class="col-sm-2 control-label">Category</label>
			  <div class="col-sm-10">
                <select class="form-control select2" id="category" name="category[]" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">
               

                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_category',$value,'c_status','A','desc','n_id');
							foreach($cat as $row)
							{			  
							?>
							<option value="<?php echo $row->n_id ?>"><?php echo $row->c_display ?></option>
							<?php
							}
							?>
                </select>
				</div>
              </div>
			  
			  <div class="form-group">
              <label for="brand" class="col-sm-2 control-label">Brand</label>
			  <div class="col-sm-10">
                <select class="form-control" id="brand" name="brand" style="width: 100%;">
				<option selected="selected" value="">Select Brand</option>
                  <?php
							$value ='';				
							$brand =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_brand',$value,'c_status','A','desc','n_id');
							foreach($brand as $rows)
							{			  
							?>
							<option value="<?php echo $rows->n_id ?>"><?php echo $rows->c_brand_name ?></option>
							<?php
							}
							?>
                </select>
				</div>
              </div>
                  <div class="form-group">
                    <label for="hsn_code" class="col-sm-2 control-label">HSN code</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="HSN code">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Product Code</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Product Code">

                    </div>
                  </div>
                 <div class="form-group">
                    <label for="supplier name" class="col-sm-2 control-label">Supplier Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Supplier Name">
                    </div>
                  </div>  
                  
                  
      
                  
                  
                  
                  
                  
				  <div class="form-group">
                    <label for="supplier name" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                        <textarea class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="description" name="description"></textarea>
                    </div>
                  </div>
				<div class="box-footer">
 				<label for="Productname" class="col-sm-2 control-label">&nbsp;</label>

                    <div class="col-sm-10">
                <button type="button" class="btn btn-success" id="nextone">Next Step</button>
					  <span  id="err_list"><font color="red"></font></span>
                      </div>
              </div>
                  
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="attribute_list">
			  <br>
                   <div class="form-group">
                    <label for="attribute group" class="col-sm-2 control-label">Attribute Group</label>

                    <div class="col-sm-10">
		
                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_group_name',$value,'c_status','A','desc','n_id');
							foreach($cat as $row)
							{			  
							?>
							<input type="checkbox" name="attributes" class="attributes" value="<?php echo $row->n_id ?>"><?php echo $row->c_group_name ?>
							<?php
							}
							?>
					<!--<input type="checkbox" name="noattributes" class="noattributes"> No attribute-->
                  </div>

                  </div>

				  
<div class="col-md-12">
<div class="row">
				  <div id="result">
				
				</div>
				</div>   
				</div>
				<div id="imgresults">
				
				</div>
				<div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-success" id="addmore" >Add more</button>
					    <span id="uploaded_image2"></span>
					 <span id="preview2" style="width:20px;"></span>
					 </div>
                  </div>
                  
                  <div class="box-footer">
                <button type="button" class="btn btn-success" id="nexttwo">Next Step</button>
					  <span  id="err_two"><font color="red"></font></span>
              </div>
                  
				     
              </div>
              <!-- /.tab-pane -->
         

              <div class="tab-pane" id="image_list">
				<br>
				<div id="mainview">
				
				</div>
				 <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                          <input type="file" id="main_image" name="main_image">
										    <span id="uploaded_image1"></span>
												<span id="preview1" style="width:10px; height:10px;"></span>
					</div>
                    </div>
			
             <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-success">Save</button>
					  
                      <a href="<?php echo site_url('add_stock_price') ?>" style="display:none;" id="add_next_stock"><button type="button" id="movenext" class="btn btn-success">Click here to Add stock</button></a>
					  <span  id="err_msgs"><font color="red"></font></span>
              </div>
            
            
	                
              </div>
			  
              <!-- /.tab-pane -->
            </div>
			</form>
            <!-- /.tab-content -->
          </div>
        </div>
        <!-- /.box-body -->
      <!--  <div class="box-footer">
       
        </div>-->
        <!-- /.box-footer-->
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

<!-- jQuery 3 -->
  <link rel="stylesheet" href="<?php echo member_path ?>bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo member_path ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>

<script src="<?php echo member_path ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>
<script src="<?php echo member_path ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script>
<script>
  $(function () {

    $('.textarea').wysihtml5()
  });
   function product_list()
  {
	  window.location.href='<?php echo site_url('product_list')?>';
  }
</script>
<script>
  $(document).ready(function () {
	$('.select2').select2()
    $('.sidebar-menu').tree();
	$("#addmore").hide();
  });

  $('.attributes').click(function(){
					var checkValues = $('input[name=attributes]:checked').map(function()
					{
						return $(this).val();
					}).get();
				if(checkValues==''){
						$("#noattribute").show();
						$("#result").html("");
						$('#imgresults').html("");
						$("#addmore").hide();
				}
				else{
						  $("#noattribute").hide();
   	                    $.ajax({
						url: '<?php echo base_url();?>attributes_view',
						type: 'post',
						data: { approve_users: checkValues },
						success:function(data){
						
							$("#result").html(data);
							$("#addmore").show();
							
						}
					});
				}
  });
  
    $('#addmore').click(function(){
		var checkValues = $('input[name=attributes]:checked').map(function()
					{
						return $(this).val();
					}).get();
				if(checkValues==''){
					  swal({title: "Error!", type: "error", text: "Pleast select atleat one attribute group", showConfirmButton: false, timer: 2000});
				}
				else{
   	                    $.ajax({
						url: '<?php echo base_url();?>attributes_views',
						type: 'post',
						data: { approve_users: checkValues },
						success:function(data){
							$('#result').append(data);
						}
					});
				}
	});
	$(document).on('click', '.remove', function(){
	$(this).parent().parent().parent().parent().remove();
	});
	
	$(document).on('click', '.fremove', function(){
	$(this).parent().parent().parent().parent().remove();
	});	



</script>

<script>
  $(document).ready(function () {
	$(document).on('click','#nextone',function(){
	var product_name=$('#c_product_name').val();
	var category=$('#category').val();
	var brand=$('#brand').val();
	var hsn_code=$('#hsn_code').val();
	var description=$('#description').val();
	var supplier_name=$('#supplier_name').val();
	var c_product_type=$('#c_product_type').val();

	if(c_product_type =="")
	{
	
		 swal({title: "Error!", type: "error", text: "Please select product type", showConfirmButton: false, timer: 2000});
	}else
	if(product_name =="")
	{
	
		     swal({title: "Error!", type: "error", text: "Enter product name", showConfirmButton: false, timer: 2000});
	}
	else if(category =="")
	{
	
	  swal({title: "Error!", type: "error", text: "Enter category", showConfirmButton: false, timer: 2000});
	}
		else if(brand =="")
	{
		
		  swal({title: "Error!", type: "error", text: "Select Brand", showConfirmButton: false, timer: 2000});
	}
		else if(hsn_code =="")
	{
		
		  swal({title: "Error!", type: "error", text: "Enter HSN code", showConfirmButton: false, timer: 2000});
	}
		else if(description =="")
	{
		
		  swal({title: "Error!", type: "error", text: "Enter description", showConfirmButton: false, timer: 2000});
	}
			else if(supplier_name =="")
	{
		
		  swal({title: "Error!", type: "error", text: "Enter supplier name", showConfirmButton: false, timer: 2000});
	}
	else{
		$('#product_tab').removeClass("active");
		$('#product_list').removeClass("active");
		$('#attribute_list').addClass("active");
		$('#attribute_tab').addClass("active");
		$('#attribute_list').trigger("click");
		$('#err_list').html("");
	}

});

$(document).on('click','#nexttwo',function(){
	
var checkValues = $('input[name=attributes]:checked').map(function()
					{
						return $(this).val();
					}).get();
				if(checkValues==''){
					$('#imgresults').html("");
					  $('#err_two').html("");
					  $('#attribute_tab').removeClass("active");
		              $('#attribute_list').removeClass("active");
		              $('#image_tab').addClass("active");
		              $('#image_list').addClass("active");
				    	}
					
					else
					{
					var images = [];
					$("input[name='images[]']").each(function() {
                    var values = $(this).val();
                        if (values) {
                     images.push(values);
                                   }
                       });

					if (images.length === 0 ) {
						$('#err_two').html('<button  type="button" class="btn btn-danger">Select an image </button'); 
					}
					
					else{
					  	$('#attribute_tab').removeClass("active");
		              	$('#attribute_list').removeClass("active");
		             	$('#image_tab').addClass("active");
		              	$('#image_list').addClass("active");
				    	}
					}	

		
});


$(document).on('click','#nextthree',function(){

		$('#image_tab').addClass("active");
		 $('#image_list').addClass("active");
	
	
});
    });
  </script>
  
  <script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize >5000)
  {
 
     swal({title: "Error!", type: "error", text: "Image File Size is very big", showConfirmButton: false, timer: 2000});
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"<?php echo site_url('upload_photo');?>",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
     
    },   
    success:function(data)
    {
		if(data=="2")
		{
		
		  swal({title: "Error!", type: "error", text: "Can't upload .. Some error occurs", showConfirmButton: false, timer: 2000});
		}
		else{
			var d=data;
       
         swal({title: "Success!", type: "success", text: "Successfully Uploaded", showConfirmButton: false, timer: 2000});
		  $('#preview').html('<img src=<?php echo product_image_path_admin ?>'+d+' style="width:60px; height:60px;">');
		  $('#image').val(data);
		   $('#uploaded_image').html("");
		}
    }
   });
  }
 });
 
 
  $(document).on('change', '.file', function(){
  var name = $(this).prop("files")[0];
  var form_data = new FormData();
 
   form_data.append("file",$(this).prop("files")[0]);
   
   swal({
  title: 'Uploading Please wait !',
  text: '',
   showCancelButton: false,
  showConfirmButton: false
})
   $.ajax({
    url:"<?php echo site_url('upload_photo');?>",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
		if(data=="2")
		{
			
	     swal({title: "Error!", type: "error", text: "Can't upload .. Some error occurs", showConfirmButton: false, timer: 2000});
			
		}
		else{
			var d=data;
        
          swal('Uploaded Successfully','','success');
		  $('#preview2').html('<img src=<?php echo product_image_path_admin ?>'+d+' style="width:60px; height:60px;">');
		  content = '<input type="hidden" name="img[]" id="img'+data+'" value="'+data+'" readonly/>';
          $('#imgresults').append(content);
		   $('#uploaded_image').html("");
	
		}
    }
   });

 });
 
 
 $(document).on('change', '#main_image', function(){
  var name = document.getElementById("main_image").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
  
   	  swal({title: "Error!", type: "error", text: "invalid Image file", showConfirmButton: false, timer: 2000});
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("main_image").files[0]);
  var f = document.getElementById("main_image").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
  
  	  swal({title: "Error!", type: "error", text: "Image File size is very Big", showConfirmButton: false, timer: 2000});
  }
  else
  {
   form_data.append("file", document.getElementById('main_image').files[0]);
   $.ajax({
    url:"<?php echo site_url('upload_photo');?>",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image1').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
		if(data=="2")
		{
			
		swal({title: "Error!", type: "error", text: "Can't upload .. Some error occurs", showConfirmButton: false, timer: 2000});
		}
		else{
			var d=data;
			var c='<img src=<?php echo product_image_path_admin ?>'+d+' style="width:60px; height:60px;">';
         
         	  swal({title: "Success!", type: "success", text: "Successfully Uploaded", showConfirmButton: false, timer: 2000});
		  $('#preview1').append(c);
		   content = '<input type="hidden" name="mainimage[]" id="mainimage'+data+'" value="'+data+'" readonly/>'
          $('#mainview').append(content);
		  $('#uploaded_image1').html("");
		}
    }
   });
  }
 });
});
</script>
<script>
$(document).ready(function(){
 $("#productform").validate({
              rules:
                {
                      c_product_name:  {  
					  required: true, 
					  },
					  'category[]':  { 
					 required: true,
					 },
					  brand:  { 
					  required: true, 
					  },
					  hsn_code:  { 
					  required: true,
					  },
					  description:  {
						  required: true, 
						  },
					  supplier_name:  {  
					  required: true, 
					  },
					  supplier_name:  { 
					  required: true, 
					  },					  
					  main_mage:  { 
					  required: true, 
					  },
					  c_product_role:  { 
					  required: true, 
					  },
            product_code:{ required: true,},

					  
                },				 
				  messages:
				 {
					 c_product_name:
					 {
						 required: "Product name Reuired"
					 },
					 'category[]':
					 {
						required: "Select Category"
					 },
					  brand:
					 {
						 required: "Select brand"
					 },
					 hsn_code:
					 {
						 required: "Enter HSN code"
					 },					
					 description:
					 {
						 required: "Enter something bout product"
					 },					
					 supplier_name:
					 {
						 required: "Enter Supplier name"
					 },
					  main_mage:
					 {
						 required: "Select atleast one image"
					 },
					 c_product_role:
					 {
						 required: "Select package or Normal"
					 },
           product_code:"Enter Product Code"
				 },
		 
		    	submitHandler: function ()
                  {
 //$('#submit').click(function(){
		      if($("#productform").valid()){
			
			    var formData = new FormData($('#productform')[0]); 
		        $('#submit').attr('Disabled',true);
		     	$('#err_msgs').html("<img src='ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
			
			    $.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('product_insert');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
						  if(msd == 'success'){
									  swal({title: "Success!", type: "success", text: "Added Successfully", showConfirmButton: false, timer: 2000});
									  $('#submit').html('Saved');
									  $('#submit').attr('Disabled',true);
									  $('#add_next_stock').show();
									  $('#err_msgs').html("");
									
						   }
						   else if(msd == 1){
					  swal({title: "Error!", type: "error", text: "Enter all fields", showConfirmButton: false, timer: 2000});
							$('#submit').attr('Disabled',false);

							$('#err_msgs').html("");
						   }
						   else if(msd == 2){
								swal({title: "Error!", type: "error", text: "Already added", showConfirmButton: false, timer: 2000});
					 	$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }						  
						   else if(msd == 5){
							 	  swal({title: "Error!", type: "error", text: "Select atleast one image", showConfirmButton: false, timer: 2000});
							  	$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else{							   
						 		  swal({title: "Error!", type: "error", text: "Some error occurs..!", showConfirmButton: false, timer: 2000});
                                	$('#submit').attr('Disabled',false);
						         	$('#err_msgs').html("");      
						   }
						   
						}
			});
				  
         }
 }
		//});			       
		    });
    });
</script>

</body>
</html>

