            <div class="box-body table-responsive no-padding">
         <table class="table table-hover table-bordered">
                <tr>
                  <th>Category Name</th>
                  <th>Parent Name</th>
                  <th>Image</th>
                  <!--<th>Action</th>-->
                  <th>Activate/Deactivate</th>
                </tr>
				<?php
				//$qry="select * from category where c_status='A'";
                //$result = $this->login_db->get_results($qry);
		          if($result)
				  {
		         foreach($result as $rows)
		           {
				
				?>
                <tr>
                  <td><?php echo $rows->c_category_name; ?></td>
                  <td><?php echo $rows->c_category_name; ?></td>
				  <td><a href="<?php echo base_url().'assets/adminarea/images/category/300X300/'.$rows->image; ?>" style="width:70px;" class="fancybox">
				  
				  <img src="<?php echo base_url().'assets/adminarea/images/category/300X300/'.$rows->image; ?>" style="width:70px;" ></a>
				  </td>
                  <!--<td><a href="<?php echo site_url('edit_category/'. $rows->n_id) ?>">Edit</a></td>-->
				    <?php
				  if($rows->c_status!='A')
				  {
					  ?>
                  <td>
				 
				 <button type="button" class="btn btn-danger" id="id<?php echo $rows->n_id; ?>" onclick="deactivate_category(<?php echo $rows->n_id; ?>)" value="<?php echo $rows->n_id; ?>">Disabled</button></td>
				  <?php
				  }
				  else{
				  ?>
				  <td>
				   	 <button type="button" class="btn btn-success " id="id<?php echo $rows->n_id; ?>" onclick="activate_category(<?php echo $rows->n_id; ?>)" value="<?php echo $rows->n_id; ?>">Active</button>  </td>
				  <?php
				  }
				  ?>
				

                </tr>
				   <?php
				   }
				  }
                ?>
              </table>
			       <?php echo $links ?>
            </div>
            <script type="text/javascript" src="<?php echo member_path ?>js/jquery.fancybox.pack.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo member_path ?>css/jquery.fancybox.css" media="screen" />
<script>
  $(document).ready(function () {
	   applyPagination();
    $('.sidebar-menu').tree();
	 $('.fancybox').fancybox();
  });
  </script>