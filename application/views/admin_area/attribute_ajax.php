            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Attribute Name</th>
                  <th>Group Name</th>
                  <th>Action</th>
                  <th>Activate/Deactivate</th>
                </tr>
				<?php
				//$qry="select * from category where status='A'";
               // $result = $this->login_db->get_results($sql);
		          if($result)
				  {
		         foreach($result as $rows)
		           {
					   $gid=$rows->n_attribute_group;
					   $qrys="select * from shopping_group_name where n_id='$gid'";
                       $results = $this->login_db->get_results($qrys);
				           if($results)
				          {
		                  foreach($results as $rowi)
		                 {
							 $group_name=$rowi->c_group_name;
				         }
				         }
				?>
                <tr>
                  <td><?php echo $rows->c_attribute_name; ?></td>
                  <td><?php echo $group_name; ?></td>
                  <td><a href=<?php echo site_url('edit_attribute/'. $rows->n_id) ?>><button type="button" class="btn  btn-info" name='edit_attribute'>Edit </button>   </a></td>
                  
                  <td>
				  <?php
				  if($rows->c_status!='A')
				  {
					  ?>
				 <button type="button" class="btn btn-danger" onclick="activate_attribute(<?php echo $rows->n_id; ?>)" id="id<?php echo $rows->n_id; ?>"  value="<?php echo $rows->n_id; ?>">Disabled</button>
				  <?php
				  }
				  else{
				  ?>
				   	 <button type="button" class="btn btn-success" onclick="deactivate_attribute(<?php echo $rows->n_id; ?>)"  id="id<?php echo $rows->n_id; ?>"  value="<?php echo $rows->n_id; ?>">Active</button>
				  <?php
				  }
				  ?>
				  </td>
            
                </tr>
				   <?php
				   }
				  }
                ?>
              </table>
			       <?php echo $links ?>
            </div>