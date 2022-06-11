

<?php

$sqladd="select c_company_name,c_title,c_address,c_email,c_logo,c_contact1 from settings";
$resultadd=$this->login_db->get_results($sqladd);
if($resultadd)
{
	foreach($resultadd as $rowadd)
	{
		$c_company_name=$rowadd->c_company_name;
		$c_title=$rowadd->c_title;
		$c_address=$rowadd->c_address;
		$c_email=$rowadd->c_email;
		$c_logo=$rowadd->c_logo;
		$c_contact1=$rowadd->c_contact1;
		
	}
}
$d_invoice="";
$n_id="";
 $sql1="select distinct(c_invoice_no),n_order_id,DATE(d_invoice) d_invoice,n_customer_id from cart_order_detail where n_order_id='$id'";
		
		$result = $this->login_db->get_results($sql1);
	                    	if($result){
							 foreach($result as $rowc)
						  {
							$invoice_id = $rowc->c_invoice_no; 
							$d_invoice = $rowc->d_invoice; 
							$n_order_id = $rowc->n_order_id; 
							$n_customer_id = $rowc->n_customer_id; 
							
						  }
							}
							
							

?>
<?php
 $grand = 0;$totBV=0;$totQty=0;$count=0;
 $selects = ''; //Selected filelds
 $wheres['n_order_id'] = $id;//where condition filelds
 $CartData = $this->common_db->GetSelectedAllData('cart_order_detail',$selects,$wheres,'asc','n_slno');
 
 
 
 
 
 	  $selbc[] = 'n_mobile_no'; //Selected filelds
 $whereBc['customer_id'] = $n_customer_id;//where condition filelds
 $BCAddress = $this->common_db->GetSelectedAllData('customer_details',$selbc,$whereBc,'asc','customer_id');
 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small><?php echo $invoice_id; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">Invoice</a></li>
        <li class="active"><?php echo $invoice_id; ?></li>
      </ol>
    </section>

 

    <!-- Main content -->
    <section class="invoice">
	<div id="printarea">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
         <img   style="width: 210px;"><?php echo $c_company_name;?>
            <small class="pull-right">Date: <?php echo date('d-m-Y',strtotime($CartData[0]->d_invoice))  ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
           <strong><?php echo $c_address;?></strong><br>
            Phone: <?php echo $c_contact1;?><br>
            Email:<?php echo $c_email;?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
              
              
            <strong><?php echo $BCAddress[0]->n_mobile_no; ?></strong><br>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice : <?php echo $CartData[0]->c_invoice_no  ?></b><br>
           <p class="lead">Invoice Date : <?php echo date('d-m-Y',strtotime($d_invoice)); ?></p>
          <br>
          <b>Order ID:</b> <?php echo $n_order_id; ?><br>
          <b>Payment Date:</b> <?php echo date('d-m-Y',strtotime($CartData[0]->d_invoice))  ?><br>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Serial #</th>
              <th>Product</th>
              <th>Product Code</th>
              <th>Qty</th>
              <th>Amount</th>
              <th>Tax%</th>
              <th>CGST</th>
              <th>SGST</th>
              <th>IGST</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
			<?php
					$i=0;
					 $tot_tax=0;
	    $sql1="select * from cart_order_detail where n_order_id='$n_order_id' order by d_date desc";
		
		$result = $this->login_db->get_results($sql1);
	                    	if($result){
							 foreach($result as $rowc)
						  {
							  $i++;
							  $c_product = $rowc->c_product;
							  $n_product_id = $rowc->n_product_id;
                $piid = $rowc->n_price_id;
							  
							    $sql12="select c_product_code,c_product_type from product_master where n_product_id='$n_product_id' ";
		
		$result2 = $this->login_db->get_results($sql12);
	                    	if($result2){
							 foreach($result2 as $rowmc)
						  {
						     $product_code = $rowmc->c_product_code;
						      $c_product_type = $rowmc->c_product_type;
						  }
	                    	}
							  
							  
							 
							  $n_quantity = $rowc->n_quantity;
							  $n_amount = $rowc->n_amount;
							  $n_subtotal  = $rowc->n_subtotal;
							  $n_tax = $rowc->n_tax; 
							  $tot_tax+=$n_tax ;
							  $c_shipping_state = 'KL';
							$cgst = 0;$sgst=0;$igst=0;
							if($c_shipping_state == 'KL')
							{
								$cgst = $rowc->n_subtotal*(($rowc->n_tax/2)/100); 
					            $cgst =number_format((float)$cgst, 2, '.', '');
								$sgst = $cgst;
								
							}
							else
							{
							 	
                                $igst = $rowc->n_subtotal*(($rowc->n_tax)/100); 
					            $igst =number_format((float)$igst, 2, '.', '');
							}
			?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $c_product; ?></td>
              <td><?php echo $product_code; ?></td>
              <td><?php echo $n_quantity; ?></td>
              <td><?php echo $n_amount; ?></td>
              <td><?php echo $n_tax; ?></td>
              <td><?php echo $cgst; ?></td>
              <td><?php echo $sgst; ?></td>
              <td><?php echo $igst; ?></td>
              <td><?php echo $n_subtotal; ?></td>
            </tr>
          <?php
		  

					 $grand = $grand+$rowc->n_subtotal;
						  }
							}
		  ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!--
        <!-- accepted payments column -->
        <div class="col-xs-6">
     
        </div>
        <!-- /.col -->
		<?php
		$sql="select * from cart_grand_total where n_order_id='$n_order_id'";
		$results = $this->login_db->get_results($sql);
	                    	if($results){
							 foreach($results as $rows)
						  {
							   $n_sub_tot = $rows->n_sub_total; 
							  $n_shipping_charge = $rows->n_shipping_charge; 
							  $n_grand_total = $rows->n_grand_total; 
						  }
							}
							
							
	
					$sql="select * from product_price where n_price_id='$piid'";
		$results = $this->login_db->get_results($sql);
	                    	if($results){
							 foreach($results as $rows)
						  {
							   
							  $d_distributor_price = $rows->d_distributor_price; 
						  }
							}		
							
							if($grand>$d_distributor_price)
							{
								$discount=$grand-$d_distributor_price;
								$GTotal = $d_distributor_price;
							}
							else
							{
								$GTotal =$grand;
								$discount=0;
							}
								
							
							?>
		<div class="row">
       <div class="col-xs-6">
         

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo currency." ".$grand ?></td>
              </tr>
              <tr>
                <th>Tax </th>
                <td><?php echo currency ?><?php echo $tot_tax; ?></td>
              </tr>
              <tr>
                <th>Shipping Charge:</th>
                <td><?php echo currency ?><?php echo $n_shipping_charge; ?></td>
              </tr>
			   <tr>
                <th>Discount:</th>
                <td><?php echo currency ?><?php echo $discount; ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo currency ?> <?php echo $GTotal+$n_shipping_charge ?></td>
              </tr>
		
            </table>
          </div>
        </div>
      </div>
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
		<button type="button" class="btn btn-success pull-right" id="btn"><i class="fa fa-print"></i> Print
          </button>
         
         <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>-->
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- jQuery 3 -->
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>
 <script>
 $("#btn").click(function () {
    $("#printarea").show();
    window.print();
});
 </script>