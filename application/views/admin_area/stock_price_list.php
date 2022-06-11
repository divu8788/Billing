  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Stock     <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Stock Sale List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Stock Sale List</h3>

        </div>
        <div class="box-body">
              <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 250px;">
              <input type="text" name="search" id="search" required="" class="form-control pull-right" placeholder="Search with Product Code">

                  <div class="input-group-btn">
                    <button type="button" id="btn_search" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
			
            <!-- /.box-header -->
			<div class="list">
                        <div class="box-body table-responsive no-padding list" >
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Product Name</th>
                  <th>Product Attribute</th>
                  <th>Batch code</th> 
                  <th>Inward Quantity</th>
                  <th>Outward Quantity</th>
                  <th>Stock</th>
				 
                </tr>
				<?php
		          if($result)
				  {
		         foreach($result as $rows)
		           {
					$attra=array();
					 $product_id= $rows->n_product_id;
					 $n_price_id= $rows->n_price_id;
				    $attribute_id= $rows->n_attribute_id;
							$n_added_stock= $rows->n_added_stock;
	
					
					
					 $qry="select sum(n_quantity) qty from cart_order_detail where n_price_id='$n_price_id' and c_order_status!='REJECTED'";	
		             $result12 = $this->login_db->get_results($qry);
					 if($result12)
				  {
		         foreach($result12 as $rowi)
		           {
					    $sales= $rowi->qty;
				   }
				  }
					if($sales == '')
						$sales=0;
					
					
					
			         $qry="select c_product_name from product_master where n_product_id='$product_id' order by c_product_name asc ";	
		             $result12 = $this->login_db->get_results($qry);
					 if($result12)
				  {
		         foreach($result12 as $rowi)
		           {
					    $c_product_name= $rowi->c_product_name;
				   }
				  }

          $sqlp="select c_product_name,n_category from product_master where n_product_id='$product_id'";
          $resultp = $this->login_db->get_results($sqlp);
              if($resultp)
              {
                foreach($resultp as $rowp)
                {
                  $new_product_name = $rowp->c_product_name;
                  $new_n_category = $rowp->n_category;
                }
              }
			         $qry1="select n_attributes from product_attribute where n_attribute_id='$attribute_id'";	
		             $result14 = $this->login_db->get_results($qry1);
					 if($result14)
				  {
		         foreach($result14 as $rowj)
		           {
					  $n_attributes= $rowj->n_attributes;
					if($n_attributes==0)
					   {
						$c_name="no attribute";   
					   }
					   else{	
				  $sql33="select * from shopping_attribute where n_id IN ($n_attributes)";	
                  $result33 = $this->login_db->get_results($sql33);
                   if($result33)
				  {
		         foreach($result33 as $row33)
		           {
					   
				   $attra[] = $row33->c_attribute_name;			

				   }
				  }
	              $c_name=implode(",",$attra);
					   }
				
				   }
				  }

			
				?>
                <tr>
                <tr>
                  <td><?php echo $c_product_name; ?></td>
                  <td><?php echo $c_name; ?></td>
                  <td><?php echo $rows->c_batch_code; ?></td>
                        <td><?php echo $n_added_stock; ?></td>
				  <td><?php echo $sales; ?></td>
                  <td><?php echo $rows->n_stock; ?></td>
                 
			
                </tr>
				   <?php
				   }
				  }
                ?>
              </table>
			<?php echo $links ?>
            </div>
			       
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
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
  
          <!-- /Start.modal -->
     <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
		  <form id="offer_category">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Offer Category</h4>
              </div>
             <div class="modal-body" id="result">
			 </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				 
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
			 
            </div>
			</form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">	
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>
<script src="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function () {
	   applyPagination();
    $('.sidebar-menu').tree();
    
      	$("#search").keyup(function(){
		  var  search=$("#search").val();	
	         $.ajax({
                type: "POST",
                url: "<?php echo site_url('stock_price_list') ?>",
				data: {search:search,ajax:1},
                success: function (msd)
                        {
							$(".list").html(msd);
						}
	  });
		 });
  });
  
       function update_offer_category(id,ids)
  {
	      $.ajax({
            type: "POST",			  
            data:{id:id,products:ids},
            url: '<?php echo base_url();?>add_offer_category',
            success: function(msg) {

					$("#result").html(msg);

            }
          });
  }
  
   function view_offers()
  {
	   var pid=$('#p_id').val();
	      $.ajax({
            type: "POST",			  
            data:{pid:pid},
            url: '<?php echo base_url();?>view_offers',
            success: function(msg) {

					$("#offers").html(msg);
                  $('#err_msgs'+pid).html('');
            }
          });
  }
          function remove_offer_category(id)
  {
       var conf = confirm('Do you want to Remove?');
            if (!conf)
            return false;
	      $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo base_url();?>remove_offer_category',
            success: function(msg) {
                  if(msg == 'success'){
					 view_offers();

				  }

            }
          });
  }
   
  function applyPagination() {
		  
         $("#ajax_pagingsearc  a").click(function() {
           var url = $(this).attr("href");
           $(".list").html('...loading....')
           $.ajax({
            type: "POST",
			  
            data:$('#filter').serialize()+"&ajax=1",
            url: url,
            success: function(msg) {
			  $(".list").html(msg);
              applyPagination();
            }
          });
        return false;
        });
      }
</script>
</body>
</html>

<style>

ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }
 
ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }
 
 
ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
 
ul.tsc_paginationA01 li a { color:#fff; border:solid 1px #F26639; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #000); background: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #277c88), color-stop(0.02, #036483), color-stop(1, #569da0)); }
ul.tsc_paginationA01 li:hover a,
ul.tsc_paginationA01 li.current a { background:#00a651; }
 .error{
	color:#F00 !important;
	
}
select.error, textarea.error, input.error {
    color:#FF0000;
}
label.error {

    -moz-border-bottom-colors: none;

    -moz-border-left-colors: none;

    -moz-border-right-colors: none;

    -moz-border-top-colors: none;

    background: #da202c none repeat scroll 0 0;

    border-color: #9e253b;

    border-image: none;

    border-radius: 3px;

    border-style: solid;

    border-width: 1px 0 0 1px;

    bottom: 46px;

    color: #fff !important;

    display: block;

    font-size: 12px;

    font-weight: 700;

    line-height: 20px;

    padding: 0 5px;

    position: absolute;

    right: 7px; margin-bottom:-5px !important;

}
.pac-container {
    z-index: 1051 !important;
}
</style>
