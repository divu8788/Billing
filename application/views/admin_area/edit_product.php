 <?php
$sql1="select * from product_master where n_product_id='$id'";	
  $result = $this->login_db->get_results($sql1);
         if($result)
				  {
		         foreach($result as $row)
		           {
					 $c_product_name=$row->c_product_name;  
					 $n_category=$row->n_category;  
					 $n_brand_id=$row->n_brand_id;  
					 $n_hsncode=$row->n_hsncode;  
					 $c_description=$row->c_description;  
					 $c_supplier_name=$row->c_supplier_name;  
					 $c_product_code=$row->c_product_code;  
					 $c_status	=$row->c_status;  
					 $c_product_type	=$row->c_product_type;  
					   }
				  }	
  $sql="select * from product_attribute where n_product_id='$id' and c_status='A'";	
  $results = $this->login_db->get_results($sql);
         if($results)
				  {
		         foreach($results as $rows)
		           {

					   $n_product_id=$rows->n_product_id;
					   $n_attributes=$rows->n_attributes;
					   if($rows->n_attributes !='')
					   $n_attributess[]=$rows->n_attributes;
					   //print_r($n_attributess);
					   $c_status=$rows->c_status;
					   $c_image=$rows->c_image;
	
				      }
				     }
  
	  			
if($n_attributes!=0)
{
 $c_grp=implode(',',$n_attributess);
 $sqlg="select distinct(n_attribute_group) as n_attr_grp from shopping_attribute where n_id IN($c_grp)";	
  $resultg = $this->login_db->get_results($sqlg);
         if($resultg)
				  {
		         foreach($resultg as $rowg)
		           {
					   $n_attr_grp[]=$rowg->n_attr_grp;
				   }
				  }				   
}

  /*$n_filters="";
  $sql="select * from product_filters where n_product_id='$id'";	
  $results = $this->login_db->get_results($sql);
         if($results)
				  {
		         foreach($results as $rows)
		           {

					   $n_product_id=$rows->n_product_id;
					   $n_filters=$rows->n_filters;
					   $n_filterss[]=$rows->n_filters;
					   //print_r($n_attributess);
					   $c_status=$rows->c_status;
	
				      }
				     }
if($n_filters!="")
{
$c_ftr=implode(',',$n_filterss);
$sqlf="select distinct(n_parent_filter) as n_ftr_grp from shopping_filter where n_id IN($c_ftr)";	
$resultf = $this->login_db->get_results($sqlf);
     if($resultf)
	 {
	    foreach($resultf as $rowf)
		    {
		      $n_ftr_grp[]=$rowf->n_ftr_grp;
		    }
    }	
}*/
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
          <li class="active">Edit Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Product</h3>
<button type="button" class="btn btn-block btn-success btn-xs pull-right" style="width: 10% !important;" onclick="product_list()">Product List</button>
        </div>
        <div class="box-body">
              <div class="row">
        <div class="col-xs-12">
 <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" id="product_tab"><a href="#product_list" data-toggle="tab">Product Details</a></li>
              <li id="attribute_tab"><a href="#attribute_list" data-toggle="tab">Attribute & Filters</a></li>
			<!--  <li id="filter_tab"><a href="#filter_list" data-toggle="tab">Filters</a></li>-->
              <li id="image_tab"><a href="#image_list" data-toggle="tab">Upload Image</a></li>
            </ul>
			<form class="form-horizontal" id="productform" name="productform">
            <div class="tab-content">
			    
              <div class="active tab-pane" id="product_list">
          <br>
          
          <div class="form-group">
              <label for="category" class="col-sm-2 control-label">Product type</label>
			  <div class="col-sm-10">
                <select class="form-control select2" id="c_product_type" name="c_product_type" data-placeholder="Select product type" style="width: 100%;">
 <option value="">Select product type</option>
                            <?php
							$value ='';				
							$producttype =  $this->fetch_model->GetRowByIdMultiple_Front_All('product_type',$value,'c_status','A','desc','n_slno');
							foreach($producttype as $row){
								
								 if($c_product_type==$row->c_type_code)
                                      $producttypeselected = 'selected="selected"';
                                      else
                                      $producttypeselected = '';		
							?>
							<option <?php echo $producttypeselected;?> value="<?php echo $row->c_type_code ?>"><?php echo $row->c_product_type ?></option>
							<?php
							}
							?>
                </select>
				</div>
              </div>
                  <div class="form-group">
                    <label for="Productname" class="col-sm-2 control-label">Product Name</label>

                    <div class="col-sm-10">
					<input type="hidden" name="product_id" value="<?php echo $id; ?>">
                      <input type="text" class="form-control" id="c_product_name" name="c_product_name" placeholder="Product Name" value="<?php echo $c_product_name; ?>">
                    </div>
                  </div>
                   <div class="form-group">
              <label for="category" class="col-sm-2 control-label">Category</label>
			  <div class="col-sm-10">
                <select class="form-control select2" id="category" name="category[]" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">

                            <?php
							$arr = explode(',',$n_category);
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_category',$value,'c_status','A','desc','n_id');
							foreach($cat as $roww)
							{	
                                   if(in_array($roww->n_id,$arr))
                                      $catselected = 'selected="selected"';
                                      else
                                      $catselected = '';						
							?>
							<option <?php echo $catselected; ?> value="<?php echo $roww->n_id ?>"><?php echo $roww->c_display ?></option>
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
							foreach($brand as $rowss)
							{	
								  if($rowss->n_id==$n_brand_id)
                                      $brandselected = 'selected="selected"';
                                      else
                                      $brandselected = '';
							?>
							<option <?php echo $brandselected; ?> value="<?php echo $rowss->n_id ?>"><?php echo $rowss->c_brand_name ?></option>
							<?php
							}
							?>
                </select>
				</div>
              </div>
                  <div class="form-group">
                    <label for="hsn_code" class="col-sm-2 control-label">HSN code</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="HSN code" value="<?php echo $n_hsncode; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Product Code</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Product code" value="<?php echo $c_product_code; ?>">
                    </div>
                  </div>
               <!--  <div class="form-group">
                    <label for="supplier name" class="col-sm-2 control-label">Supplier Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Supplier Name" value="<?php echo $c_supplier_name; ?>">
                    </div>
                  </div>-->
                  
                  
                  	  <div class="form-group">
              <label for="brand" class="col-sm-2 control-label">Supplier Name</label>
			  <div class="col-sm-10">
                <select class="form-control" id="supplier_name" name="supplier_name" style="width: 100%;">
				<option selected="selected" value="">Select Supplier</option>
                  <?php
							$value ='';				
							$brand =  $this->fetch_model->GetRowByIdMultiple_Front_All('supplier_dtl',$value,'c_status','Y','desc','n_slno');
							foreach($brand as $rowss)
							{	
								  if($rowss->n_slno==$c_supplier_name)
                                      $brandselected = 'selected="selected"';
                                      else
                                      $brandselected = '';
							?>
							<option <?php echo $brandselected; ?> value="<?php echo $rowss->n_slno ?>"><?php echo $rowss->c_supplier_name ?></option>
							<?php
							}
							?>
                </select>
				</div>
              </div>
                  
                  
                  
                  
                  
                  
                  
                  
                  
				  
				  				  <div class="form-group">
                    <label for="supplier name" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                        <textarea class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="description" name="description"><?php echo $c_description; ?></textarea>
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

				  <?php
				  if($n_attributes!=0)
				  {
				 ?>
	                   <div class="form-group">
                    <label for="attribute group" class="col-sm-2 control-label">Attribute Group</label>

                    <div class="col-sm-10">
		
                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_group_name',$value,'c_status','A','desc','n_id');
							foreach($cat as $rowv)
							{
								
                           		 if(in_array($rowv->n_id,$n_attr_grp))	

                                                                $stateselected = 'checked="checked"';
                                                             else
                                                                $stateselected = '';									 
							?>
							<input type="checkbox" name="attributes" class="attributes" value="<?php echo $rowv->n_id ?>" <?php echo $stateselected; ?> ><?php echo $rowv->c_group_name ?>
							<?php
							}
							?>
					<!--<input type="checkbox" name="noattributes" class="noattributes"> No attribute-->
                  </div>

                  </div>			  
<div class="col-md-12">
<div class="row">

<table class="table table-hover table-bordered">
<tr>
<th>Attributes</th>
<th>Image</th>
<th>Action</th>
</tr>
<?php

  $sql="select * from product_attribute where n_product_id='$id' and c_status IN('A','C')";	
  $results1 = $this->login_db->get_results($sql);
  
         if($results1)
				  {
		         foreach($results1 as $rows1)
		           {
                       $attra=array();
					   $n_attribute_id=$rows1->n_attribute_id;
					   $n_product_id=$rows1->n_product_id;
					   
					   if( $rows1->n_attributes != '')
					      $n_attributes=$rows1->n_attributes;
					   else
					     $n_attributes=0;
					      
					   //$n_attributess[]=$rows1->n_attributes;
					   $c_status=$rows1->c_status;
					   $c_image=$rows1->c_image;

				  $sql33="select * from shopping_attribute where n_id IN ($n_attributes)";	
                  $result33 = $this->login_db->get_results($sql33);
                   if($result33)
				  {
		         foreach($result33 as $row33)
		           {
					   
				   $attra[] = $row33->c_attribute_name;
			

				    }
				  }
		echo $c_name=implode(",",$attra);

				
				
?>
<tr id="tr<?php echo $n_attribute_id; ?>">
<td><?php echo $c_name;?></td>
<td id="td<?php echo $n_attribute_id; ?>"><a href="<?php echo product_image_path_admin.'300X300/'.$c_image; ?>" style="width:70px;" class="fancybox">
<img src="<?php echo product_image_path_admin.$c_image; ?>" style="width:70px;"></a> <input type="file" id="<?php echo $n_attribute_id; ?>" name="c_attr_image" class="c_attr_image"></td>
 <?php
				  if($rows1->c_status=='A')
				  {

					  ?>

				  <td>
				   	 <button type="button" class="btn btn-success" id="id<?php echo $n_attribute_id; ?>" onclick="deactivate_product(<?php echo $n_attribute_id; ?>)" value="<?php echo $n_attribute_id; ?>">Active</button>  </td>
				  <?php
				  }
				  else{
					  ?>
				 <td>
				   	 <button type="button" class="btn btn-danger" id="id<?php echo $n_attribute_id; ?>" onclick="activate_product(<?php echo $n_attribute_id; ?>)" value="<?php echo $n_attribute_id; ?>">Deactivate</button>  </td>
					  <?php
				  }
				  ?>
</tr>
<?php
	  }
				  }
	//print_r($results1);	
?>

</table>
		</div>


</div>   


				<div id="results">
				
				</div>
				<div id="result1">
				
				</div>
				<div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-success" id="addmore" >Add more</button>
					    <span id="uploaded_image2"></span>
					 <span id="preview2" style="width:20px;"></span>
					 </div>
                  </div>
				  <?php				
}
else
{
?>
            <div class="form-group">
                    <label for="attribute group" class="col-sm-2 control-label">Attribute Group</label>

                    <div class="col-sm-10">
		
                            <?php
							$value ='';				
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_group_name',$value,'c_status','A','desc','n_id');
							foreach($cat as $rowv)
							{
			
									 
							?>
							<input type="checkbox" name="attributes" class="attributes" value="<?php echo $rowv->n_id ?>"><?php echo $rowv->c_group_name ?>
							<?php
							}
							?>
					<!--<input type="checkbox" name="noattributes" class="noattributes"> No attribute-->
                  </div>

                  </div>
				  
				  				<div id="results">
				
				</div>
				<div id="result1">
				
				</div>
				<div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-success" id="addmore" >Add more</button>
					    <span id="uploaded_image2"></span>
					 <span id="preview2" style="width:20px;"></span>
					 </div>
                  </div>
				  <?php
				  }
               ?>
				   
                  
                   
                  <div class="box-footer">
                <button type="button" class="btn btn-success" id="nexttwo">Next Step</button>
					  <span  id="err_two"><font color="red"></font></span>
              </div>
              </div>
              <!-- /.tab-pane -->
                <!-- <div class="tab-pane" id="filter_list">
			  <br>
                   <div class="form-group">
                    <label for="filter group" class="col-sm-2 control-label">Filter Group</label>

                    <div class="col-sm-10">
		
                            <?php
							$value ='';	
							$ftrselected = '';							
							$cat =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_f_group',$value,'c_status','A','desc','n_id');
							foreach($cat as $row)
							{
                               if(isset($n_ftr_grp))
							   {
								if(in_array($row->n_id,$n_ftr_grp))	

                                       $ftrselected = 'checked="checked"';
                                 else
                                       $ftrselected = '';
							   }
							?>
							<input type="checkbox" name="filters" class="filters" value="<?php echo $row->n_id ?>" <?php echo $ftrselected; ?>><?php echo $row->c_f_name ?>
							<?php
							}
							?>
                  </div>

                  </div>
<div class="col-md-12">
<div class="row">

<table class="table table-hover table-bordered">
<tr>
<th>Filters</th>
<th>Action</th>
</tr>
<?php

  $sql9="select * from product_filters where n_product_id='$id' and c_status='A'";	
  $results9 = $this->login_db->get_results($sql9);
         if($results9)
				  {
		         foreach($results9 as $rows9)
		           {
                       $attra=array();
					   $n_filter_id=$rows9->n_filter_id;
					   $n_product_id=$rows9->n_product_id;
					   $n_filters=$rows9->n_filters;
					   $c_status=$rows9->c_status;

				  $sql39="select * from shopping_filter where n_id IN ($n_filters)";	
                  $result39 = $this->login_db->get_results($sql39);
                   if($result39)
				  {
		         foreach($result39 as $row39)
		           {
					   
				   $fltr[] = $row39->c_filter_name;
				    }
				  }
           $c_fltr=implode(",",$fltr);

				
				
?>
<tr>
<td><?php echo $c_fltr;?></td>
 <?php
				  if($rows9->c_status=='A')
				  {
					  ?>
				  <td>
				   	 <button type="button" class="btn btn-danger" id="fid<?php echo $n_filter_id; ?>" onclick="deactivate_filter(<?php echo $n_filter_id; ?>)" value="<?php echo $n_filter_id; ?>">Deactivate</button>  </td>
				  <?php
				  }
				  ?>
</tr>
<?php
	  }
				  }
?>

</table>
		</div>


</div>   


				  
<div class="col-md-12">
<div class="row">
				  <div id="fresult">
				
				</div>
				</div>   
				</div>
				<div id="fresults">
				
				</div>
				<!--<div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-success" id="faddmore" >Add more</button>
					    <span id="uploaded_image2"></span>
					 <span id="preview2" style="width:20px;"></span>
					 </div>
                  </div>-->
                  
               <!--   <div class="box-footer">
                <button type="button" class="btn btn-success" id="nextthree">Next Step</button>
					  <span  id="err_two"><font color="red"></font></span>
              </div>
                  
                  
				     
              </div>-->

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
<div class="col-md-12">   
<div class="row"> 
<?php
$sqli="select * from product_images where n_product_id='$id' and c_status='A'";	
  $resulti = $this->login_db->get_results($sqli);
         if($resulti)
				  {
		         foreach($resulti as $rowi)
		           {
					  $c_image1	=$rowi->c_image;  
					  $c_image_id	=$rowi->n_id;  
				      
				  

 ?>
<div class="col-md-2" id="<?php echo $c_image_id; ?>">
<img src="<?php echo product_image_path_admin.$c_image1; ?>" style="width:120px;">
<a class="image-sk-link" id="imgss"<?php echo $c_image_id; ?> href="javascript:;" onclick="remove_image(<?php echo $c_image_id.",'".$c_image1."'"; ?>)">Remove</a>
<span id="imgs"<?php echo $c_image_id; ?>></span>
</div>
<?php
 }
  }
?>
</div>
</div>
			
	                <div class="box-footer">
                <button type="submit" id="submit" class="btn btn-success">Save</button>
					  
                      
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

<script type="text/javascript" src="<?php echo member_path ?>js/jquery.fancybox.pack.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo member_path ?>css/jquery.fancybox.css" media="screen" />
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>
<script src="<?php echo member_path ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script>
<script>
  $(document).ready(function () {
	$('.select2').select2()
    $('.sidebar-menu').tree();
	//$("#addmore").hide();
	$('.fancybox').fancybox();
  });
  
    $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });

  function product_list()
  {
	  window.location.href='<?php echo site_url('product_list')?>';
  }

$('.attributes').click(function(){
					var checkValues = $('input[name=attributes]:checked').map(function()
					{
						return $(this).val();
					}).get();
				if(checkValues==''){
						$("#noattribute").show();
						$("#result").html("");
						$('#results').html("");
						$("#addmore").hide();
				}
				else{
						  $("#noattribute").hide();
   	                    $.ajax({
						url: '<?php echo base_url();?>attributes_view',
						type: 'post',
						data: { approve_users: checkValues },
						success:function(data){
						
							$("#results").html(data);
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
					//alert('Please select atleast one user');
					swal({title: "Error!", type: "error", text: "Please select atleast one attribute", showConfirmButton: false, timer: 2000});
				}
				else{
   	                    $.ajax({
						url: '<?php echo base_url();?>attributes_views',
						type: 'post',
						data: { approve_users: checkValues },
						success:function(data){
							$('#results').append(data);
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

	 $('.filters').click(function(){
					var checkValues = $('input[name=filters]:checked').map(function()
					{
						return $(this).val();
					}).get();
				if(checkValues==''){
						$("#noattribute").show();
						$("#fresult").html("");
						$('#fresults').html("");
						$("#addmore").hide();
				}
				else{
						  $("#noattribute").hide();
   	                    $.ajax({
						url: '<?php echo base_url();?>filter_view',
						type: 'post',
						data: { approve_users: checkValues },
						success:function(data){
						
							$("#fresult").html(data);
							$("#faddmore").show();
							
						}
					});
				}
  });
  
    $('#faddmore').click(function(){
		var checkValues = $('input[name=filters]:checked').map(function()
					{
						return $(this).val();
					}).get();
				if(checkValues==''){
					//alert('Please select atleast one user');
					swal({title: "Error!", type: "error", text: "Please select atleast one filter", showConfirmButton: false, timer: 2000});
				}
				else{
   	                    $.ajax({
						url: '<?php echo base_url();?>filter_views',
						type: 'post',
						data: { approve_users: checkValues },
						success:function(data){
							$('#fresult').append(data);
						}
					});
				}
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
	/*if(product_name =="" && category =="" && brand=="" && hsn_code =="" && description =="" && supplier_name =="")
	{
		//$('#err_list').html('<button  type="button" class="btn btn-danger">Enter all fields </button');
		swal({title: "Error!", type: "error", text: "Enter product Details..!", showConfirmButton: false, timer: 2000});
	}
	else*/ if(c_product_type =="")
	{
	//	$('#err_list').html('<button  type="button" class="btn btn-danger">Enter product Name</button');
		 swal({title: "Error!", type: "error", text: "Please select product type", showConfirmButton: false, timer: 2000});
	}
	else if(product_name =="")
	{
	//	$('#err_list').html('<button  type="button" class="btn btn-danger">Enter product Name</button');
	swal({title: "Error!", type: "error", text: "Enter product name", showConfirmButton: false, timer: 2000});
	}
	else if(category =="")
	{
		//$('#err_list').html('<button  type="button" class="btn btn-danger">Enter Category </button');
		swal({title: "Error!", type: "error", text: "Enter category", showConfirmButton: false, timer: 2000});
	}
		else if(brand =="")
	{
	//	$('#err_list').html('<button  type="button" class="btn btn-danger">Enter Brand </button');
	swal({title: "Error!", type: "error", text: "Enter brand", showConfirmButton: false, timer: 2000});
	}
		else if(hsn_code =="")
	{
		//$('#err_list').html('<button  type="button" class="btn btn-danger">Enter HSN code </button');
		swal({title: "Error!", type: "error", text: "Enter HSN code", showConfirmButton: false, timer: 2000});
	}
		else if(description =="")
	{
	//	$('#err_list').html('<button  type="button" class="btn btn-danger">Enter Description </button');
	swal({title: "Error!", type: "error", text: "Enter Description", showConfirmButton: false, timer: 2000});
	}
			else if(supplier_name =="")
	{
		//$('#err_list').html('<button  type="button" class="btn btn-danger">Enter Supplier name</button');
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
	
	


					
					  $('#attribute_tab').removeClass("active");
		              $('#attribute_list').removeClass("active");
		             $('#image_tab').addClass("active");
		              $('#image_list').addClass("active");
				    			
});

$(document).on('click','#nextthree',function(){

					$('#results').html("");
					  $('#err_two').html("");
					  $('#filter_tab').removeClass("active");
		              $('#filter_list').removeClass("active");
		              $('#image_tab').addClass("active");
		              $('#image_list').addClass("active");
	
	
});

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
					  product_code:{required: true, },
					  
                },
				 
				  messages:
				 {
					 c_product_name:
					 {
						 required: "Product name required"
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
					 product_code:"Enter Product Code"
				 },
				 
		    	submitHandler: function ()
                  {

		      if($("#productform").valid()){
			
			    var formData = new FormData($('#productform')[0]); 
		      $('#submit').attr('Disabled',true);
		      $('#err_msgs').html("<img src='../ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
			
			    $.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('product_update');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
						  if(msd == 'success'){
							swal({title: "Success!", type: "success", text: "Updated successfully", showConfirmButton: false, timer: 2000});
			                window.location.reload();

						   }
						   else if(msd == 1){
							 swal({title: "Error!", type: "error", text: "Enter all details", showConfirmButton: false, timer: 2000});
						    $('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else if(msd == 2){
							 swal({title: "Error!", type: "error", text: "Already added..!", showConfirmButton: false, timer: 2000});
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
   //alert("Invalid Image File");
   swal({title: "Error!", type: "error", text: "Invalid Image File", showConfirmButton: false, timer: 2000});
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   //alert("Image File Size is very big");
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
		//	$('#uploaded_image').html("Can't upload .. Some error occurs");
		      swal({title: "Error!", type: "error", text: "Can't upload .. Some error occurs", showConfirmButton: false, timer: 2000});
		}
		else{
			var d=data;
         // $('#uploaded_image').html("<label class='text-success'>Successfully Uploaded</label>");
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
		//	$('#uploaded_image').html("Can't upload .. Some error occurs");
				      swal({title: "Error!", type: "error", text: "Can't upload .. Some error occurs", showConfirmButton: false, timer: 2000});
		}
		else{
			var d=data;
         // $('#uploaded_image2').html("<label class='text-success'>Successfully Uploaded</label>");
          //swal({title: "Success!", type: "success", text: "Successfully Uploaded", showConfirmButton: false, timer: 2000});
		    swal('Uploaded Successfully','','success');
		  $('#preview2').html('<img src=<?php echo product_image_path_admin ?>'+d+' style="width:60px; height:60px;">');
		  content = '<input type="hidden" name="img[]" id="img'+data+'" value="'+data+'" readonly/>'
          $('#result1').append(content);
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
   //alert("Invalid Image File");
swal({title: "Error!", type: "error", text: "Invalid Image File", showConfirmButton: false, timer: 2000});
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("main_image").files[0]);
  var f = document.getElementById("main_image").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   //alert("Image File Size is very big");
   swal({title: "Error!", type: "error", text: "Image File Size is very big", showConfirmButton: false, timer: 2000});
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
			//$('#uploaded_image1').html("Can't upload .. Some error occurs");
	 swal({title: "Error!", type: "error", text: "Can't upload .. Some error occurs", showConfirmButton: false, timer: 2000});
		}
		else{
			var d=data;
			var c='<img src=<?php echo product_image_path_admin ?>'+d+' style="width:60px; height:60px;">';
         // $('#uploaded_image1').html("<label class='text-success'>Successfully Uploaded</label>");
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
 
 
 
 
    $(document).on('change', '.c_attr_image', function(){
  var name = $(this).prop("files")[0];
  var id = $(this).attr("id");
  var form_data = new FormData();
 
   form_data.append("file",$(this).prop("files")[0]);
   form_data.append("id",$(this).attr("id"));
   $.ajax({
    url:"<?php echo site_url('upload_attr_photo');?>",
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
		  content = '<a href="<?php echo product_image_path_admin ?>300X300/'+d+'" style="width:70px;" class="fancybox"><img src="<?php echo base_url()?>assets/adminarea/images/products/300X300/'+d+'" style="width:70px;"></a><input type="file" id="<?php echo $n_attribute_id; ?>" name="c_attr_image" class="c_attr_image">'
          $('#td'+id).html(content);

		}
		
    }
   });

 });
   
});


   function deactivate_product(id)
  {
	        var conf = confirm('Do you want to deactivate Product?');
            if (!conf)
            return false;
            $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo site_url('admin_area/product_details/deactivate_product') ?>',
            success: function(msg) {
		
				if(msg=="success")
				{	
				  	swal({title: "Success!", type: "success", text: "Successfully deactivated", showConfirmButton: false, timer: 2000});  
					$("#id"+id).html("Deactivated");
					$("#id"+id).attr("Disabled",true);
					$("#tr"+id).remove();
				}
				else
				{
				//	$("#id"+id).html("Error");
					swal({title: "Error!", type: "error", text: "Error occurs", showConfirmButton: false, timer: 2000});
				}
            }
          });
  }
  
      function activate_product(id)
  {
	             var conf = confirm('Do you want to Activate Product?');
            if (!conf)
            return false;
            $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo site_url('admin_area/product_details/activate_product') ?>',
            success: function(msg) {

							if(msg=="success")
				{					
					$("#id"+id).html("Activated");
					$("#id"+id).attr("Disabled",true);
				}
				else
				{
					$("#id"+id).html("Error");
				}

            }
          });
  }
  
  
  		function remove_image(id,type)
		{
				 var cnf = confirm('Do you want to remove?');
				if(!cnf)
					return false;
			$.ajax({
                type: "POST",
                url: "<?php echo site_url('admin_area/product_details/remove_image') ?>",
				data: {id:id,type:type},
                success: function (msd)
                 {
				    if(msd=="success"){
				        
						//$("#imgss"+id).html("Successfully Removed");
	swal({title: "Success!", type: "success", text: "Successfully Removed", showConfirmButton: false, timer: 2000});
						$("#"+id).remove();

					}
                else	{
  swal({title: "Error!", type: "error", text: "Some error occurs", showConfirmButton: false, timer: 2000});
					//$("#imgss"+id).html("Some error Occurs");
				}					
				 }
			});	
		}
		
   function deactivate_filter(id)
  {
	        var conf = confirm('Do you want to deactivate?');
            if (!conf)
            return false;
            $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo site_url('admin_area/product_details/deactivate_filter') ?>',
            success: function(msg) {
		
				if(msg=="success")
				{
				swal({title: "Success!", type: "success", text: "Successfully Deactivated", showConfirmButton: false, timer: 2000});
					$("#fid"+id).html("Deactivated");
					$("#fid"+id).attr("Disabled",true);
				}
				else
				{
					//$("#fid"+id).html("Error");
						swal({title: "Error!", type: "error", text: "error occurs", showConfirmButton: false, timer: 2000});
				}
            }
          });
  }
  
      function activate_filter(id)
  {
	        var conf = confirm('Do you want to Activate?');
            if (!conf)
            return false;
            $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo site_url('admin_area/product_details/activate_filter') ?>',
            success: function(msg) {

				if(msg=="success")
				{
				swal({title: "Success!", type: "success", text: "Successfully Activated", showConfirmButton: false, timer: 2000});
					$("#fid"+id).html("Activated");
					$("#fid"+id).attr("Disabled",true);
				}
				else
				{
					swal({title: "Error!", type: "error", text: "Error occurs", showConfirmButton: false, timer: 2000});
					//$("#fid"+id).html("Error");
				}

            }
          });
  }
  
</script>

</body>
</html>

