            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Group Name</th>
                  <th>Action</th>
                  <th>Activate/Deactivate</th>
                </tr>
				<?php
				//$qry="select * from category where status='A'";
               // $result = $this->login_db->get_results($sql);
		          if($result)
				  {
		         foreach($result as $row)
		           {

				
				?>
                <tr>
                  <td><?php echo $row->c_group_name; ?></td>
                  <td><a href=<?php echo site_url('edit_group/'. $row->n_id) ?>><button type="button" class="btn  btn-info" name='edit_group'>Edit</button>   </a></td>
				    <?php
				  if($row->c_status!='A')
				  {
					  ?>
                  <td>
				 
				 <button type="button" class="btn btn-danger" id="id<?php echo $row->n_id; ?>" onclick="activate_group(<?php echo $row->n_id; ?>)" value="<?php echo $row->n_id; ?>">Disabled</button></td>
				  <?php
				  }
				  else{
				  ?>
				  <td>
				   	 <button type="button" class="btn btn-success" id="id<?php echo $row->n_id; ?>" onclick="deactivate_group(<?php echo $row->n_id; ?>)" value="<?php echo $rows->n_id; ?>">Active</button>  </td>
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