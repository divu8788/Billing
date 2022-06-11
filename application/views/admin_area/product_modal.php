<form id="list">
<div class="modal-content" >
        <div class="modal-header">
          <table class="table table-hover table-bordered">
    <thead>
    <tr>
    <th colspan="6"> </th>
   
    </tr>
    <tr>
    <th>Sl.No</th>
    <th>Product</th>
    <th>Quantity</th>
    <th>Amount</th>
   
   
    
    </tr>
    </thead>
    <tbody class="addlist">
  <?php
  $count=0;
  $sql = "select n_product_id,n_quantity,n_amount from cart_order_detail where n_order_id=$n_order_id"; 
        $query = $this->db->query($sql);
        $result =   $query->result();
        if($result)
        {
            foreach($result as $row1)
            {
                $count=$count+1;
                $n_product_id =$row1->n_product_id;
                $n_quantity         =$row1->n_quantity;
                $n_subtotal     =$row1->n_amount*$n_quantity;

                $sql = "select c_product_name from product_master where n_product_id='$n_product_id'"; 
                $query = $this->db->query($sql);
                $result =   $query->result();
                if($result)
                {
                    foreach($result as $row)
                    {
                        $c_product_name        =$row->c_product_name;
                        
                       
                    }
                }





?>
</tbody>
   <tr>
    <td><?php echo $count?>
    <td><?php echo $c_product_name?>
    <td><?php echo $n_quantity ?></td>
    <td><?php echo $n_subtotal ?></td>
    
   
  
   </tr>
    
      <?php }
  }?>
    </table>
        </div>
		 <div class="modal-body">
		
          <p><input type="hidden" name="n_slno" value="<?php echo $s_no;?>" id="n_slno">


        </div>


 <div class="modal-footer">
		
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</div>
  </form>
