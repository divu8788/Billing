            <div class="box-body table-responsive no-padding">
     <table class="table table-hover table-bordered">
                <tr>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Image</th>
                  <th>Edit</th>
                  <th>Activate/Deactivate</th>
				<!--  <th>Offer Category</th>-->
                </tr>
				<?php
		          if($result)
				  {
		         foreach($result as $rows)
		           {
					                  $id=$rows->n_product_id;
									  $c_product_name=$rows->c_product_name;
									  $c_product_code=$rows->c_product_code;
				                
						 $sql1i="select * from product_images where n_product_id='$id' and c_status='A' order by n_id asc limit 1";	
	                 	 $resultsi = $this->login_db->get_results($sql1i);
						  if($resultsi)
				                {
		                        foreach($resultsi as $rowi)
		                          {
									  $c_image=$rowi->c_image;
				                  }
				                }
				?>
                <tr>
                  <td><?php echo $c_product_name; ?></td>
                  <td><?php echo $c_product_code; ?></td>
				  
				    <td><a href="<?php echo base_url().'assets/adminarea/images/products/300X300/'.$c_image; ?>" style="width:70px;" class="fancybox">
				  
				  <img src="<?php echo base_url().'assets/adminarea/images/products/'.$c_image; ?>" style="width:70px;" ></a>
				  </td>
                  <td><a href=<?php echo site_url('edit_product/'. $id) ?>><button type="button" class="btn  btn-info" name='edit_product'>Edit </button>   </a></td>
				  
				  </td>
				    <?php
				  if($rows->c_status!='A')
				  {
					  ?>
                  <td>
				 
				 <button type="button" class="btn btn-danger" id="id<?php echo $id; ?>" value="<?php echo $id; ?>" onclick="product_activate(<?php echo $id; ?>)">Disabled</button></td>
				  <?php
				  }
				  else{
				  ?>
				  <td>
				   	 <button type="button" class="btn btn-success" id="id<?php echo $id; ?>"  value="<?php echo $id; ?>" onclick="product_deactivate(<?php echo $id; ?>)">Active</button>  </td>
				  <?php
				  }
				  ?>
				  
				<!--<td>
				
			  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick="update_offer_category(<?php echo $id; ?>)">
               ADD OFFER
              </button>
				  </td>-->

                </tr>
				   <?php
				   }
				  }
                ?>
              </table>
			       <?php echo $links ?>
            </div>
            <script>
  $(document).ready(function () {
	   applyPagination();
    $('.sidebar-menu').tree()
	 $('.fancybox').fancybox();
  });
  </script>