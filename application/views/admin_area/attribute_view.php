
<?php
for($i=0;$i<sizeof($id);$i++){
$sql1= "SELECT * FROM shopping_group_name WHERE c_status='A' and n_id= '$id[$i]'";	
$query1 = $this->db->query($sql1);
foreach($query1->result() as $row)
	{
		$grp=$row->c_group_name;
		
	}		
?>

<input type="hidden" name="selected_attributes[]" value="<?php echo $grp; ?>">
<div class="col-md-2">
   <div class="form-group">
                 

                    <div class="col-sm-10">
					
  <select class="form-control" id="sel<?php echo $i; ?>" name="<?php echo $grp."[]"; ?>">
  <option value=""> <?php echo $grp; ?></option>
                  <?php
							$value ='';				
							//$brand =  $this->fetch_model->GetRowByIdMultiple_Front_All('shopping_attribute',$value,'c_status','A','desc','n_id');
							$sql= "SELECT * FROM shopping_attribute WHERE c_status='A' and n_attribute_group= '$id[$i]'";
				          	$query = $this->db->query($sql);
							foreach($query->result() as $rows)
							{			  
							?>
							<option value="<?php echo $rows->n_id ?>"><?php echo $rows->c_attribute_name ?></option>
							<?php
							}
							?>
                </select>
				</div>
				</div>
		</div>


		
				
<?php
}
?>
<div class="col-md-2">
<div class="form-group">
                 
                    <div class="col-sm-10">

                     <input type="file" id="images" name="images[]" class="file">
                    </div>
						<div id="preview" style="width:20px;">
					</div>
                  </div>
</div>
   <!--<div class="col-md-12">   
<div class="row">   
			<div class="col-md-2">
<div class="form-group">
                   

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="stock" name="stock[]" placeholder="Enter stock">
                    </div>
                  </div>
</div>
<div class="col-md-2">
<div class="form-group">
                 
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="price" name="price[]" placeholder="Enter price">
                    </div>
                  </div>
</div>	
<div class="col-md-2">
<div class="form-group">
                 
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mrp" name="mrp[]" placeholder="Enter MRP">
                    </div>
                  </div>
</div>
<div class="col-md-2">
<div class="form-group">
                 
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tax" name="tax[]" placeholder="Enter Tax">
                    </div>
                  </div>
</div>

</div>
</div>  -->                
				  

