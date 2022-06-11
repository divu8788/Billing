<?php

$sqladd="select c_company_name,c_title,c_address,c_contact1,c_email,c_logo from settings";
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
 $sql1="select distinct(c_invoice_no),n_order_id,DATE(d_invoice),c_shipping_name,c_shipping_address,n_id,n_shipping_pincode,c_shipping_phno,c_shipping_district,n_quantity,n_product_id,n_amount,n_attribute,n_subtotal,c_shipping_state,c_product from cart_order_detail where n_order_id='$id'";
		$sum_quantity=0;
    $sum_amount=0;
		$result = $this->login_db->get_results($sql1);
	                    	if($result){
							 foreach($result as $rowc)
						  {
							$invoice_id = $rowc->c_invoice_no; 
							$d_invoice = $rowc->d_invoice; 
							$c_shipping_name = $rowc->c_shipping_name; 
							$c_shipping_address = $rowc->c_shipping_address; 
							$n_shipping_pincode = $rowc->n_shipping_pincode; 
							$c_shipping_phno = $rowc->c_shipping_phno; 
							$c_shipping_district = $rowc->c_shipping_district; 
							$c_shipping_state = $rowc->c_shipping_state; 
							$n_order_id = $rowc->n_order_id; 
							$n_id = $rowc->n_id; 
              $c_product = $rowc->c_product; 
              $n_quantity = $rowc->n_quantity; 
              $n_amount = $rowc->n_subtotal; 
              $n_subtotal = $rowc->n_subtotal; 
              $n_attribute = $rowc->n_attribute; 

              $n_product_id = $rowc->n_product_id; 



              $sum_quantity=$sum_quantity+$n_quantity;

               $sum_amount=$sum_amount+$n_subtotal;
			   
			   $total_amount=$n_amount*$n_quantity;

						  }
							}


              $sql2="select C_FNAME,C_MOBILE,C_STATE from address_dtl where n_id='$n_id'";
    
              $result2 = $this->login_db->get_results($sql2);
                        if($result2){
               foreach($result2 as $row2)
              {
              $C_FNAME = $row2->C_FNAME; 
              $C_MOBILE = $row2->C_MOBILE; 
              $C_STATE = $row2->C_STATE; 
             
              }
              }

              $sql3="select name from country_states where code='$C_STATE'";
    
              $result3 = $this->login_db->get_results($sql3);
                        if($result3){
               foreach($result3 as $row3)
              {
              $state_name = $row3->name; 
              
             
              }
              }








              

              $sql6="select n_kfcs from product_price where n_attribute_id='$n_attribute'";
    
              $result6 = $this->login_db->get_results($sql6);
                        if($result4){
               foreach($result6 as $row6)
              {
              $n_kfcs = $row6->n_kfcs; 
              
             
              }
              }






                $i=0;
           $tot_tax=0;
      $sql7="select * from cart_order_detail where n_order_id='$n_order_id' ";
    
    $result7 = $this->login_db->get_results($sql7);
                        if($result){
               foreach($result7 as $row7)
              {
                $i++;
               
                $n_tax = $row7->n_tax; 
                $tot_tax+=$n_tax ;
                
              $cgst = 0;$sgst=0;$igst=0;
              if($CartData[0]->c_shipping_state == 'TN')
              {
                $cgst = $row7->n_subtotal*(($row7->n_tax/2)/100); 
                      $cgst =number_format((float)$cgst, 2, '.', '');
                $sgst = $cgst;

                $sgstsum=($sgst/100)*$n_subtotal;
                      $cgstsum=($cgst/100)*$n_subtotal;

               $gst= $sgst;
                
              }
              else
              {
                
                                $igst = $row7->n_subtotal*(($row7->n_tax)/100); 
                      $igst =number_format((float)$igst, 2, '.', '');


                      

                      $gst= $igst;

                      $cgst=$sgst= $igst/2;

                      $sgstsum=($sgst/100)*$n_subtotal;
                      $cgstsum=($cgst/100)*$n_subtotal;
              }
            }
          }

              

              $cgstamount=$n_subtotal*($cgst/100);
              

              $sgstamount=($sgst/100)*$n_subtotal;
              
              $totalgst=$cgstamount+ $sgstamount;

              $totalgstsum= $totalgst=$cgstamount+ $sgstamount;


$actual_amount=$n_subtotal-$gst;






?>
<?php
 $grand = 0;$totBV=0;$totQty=0;$totPV=0;$count=0;
 $selects = ''; //Selected filelds
 $wheres['n_order_id'] = $id;//where condition filelds
 $CartData = $this->common_db->GetSelectedAllData('cart_order_detail',$selects,$wheres,'asc','n_slno');
 
  $billingA[] = 'C_FNAME'; //Selected filelds
  $billingA[] = 'C_ADDRESS1'; //Selected filelds
   $billingA[] = 'C_STATE'; //Selected filelds
    $billingA[] = 'C_DISTRICT'; //Selected filelds
	 $billingA[] = 'C_MOBILE'; //Selected filelds
	  $billingA[] = 'C_ZIP_CODE'; //Selected filelds
 $whereShip['n_id'] = $n_id;//where condition filelds
 $BillingAddress = $this->common_db->GetSelectedAllData('address_dtl',$billingA,$whereShip,'asc','n_id');
 

$selState[] = 'name';
$whereState['code'] = $BillingAddress[0]->C_STATE;
 $BillingState = $this->common_db->GetSelectedAllData('country_states',$selState,$whereState,'asc','code');
 
 $selDist[] = 'c_district';
$whereDist['n_dist_id'] = $BillingAddress[0]->C_DISTRICT;
 $BillingDist = $this->common_db->GetSelectedAllData('district',$selDist,$whereDist,'asc','n_dist_id');
 
  $selShpState[] = 'name';
$whereShpState['code'] = $CartData[0]->c_shipping_state;
 $ShippingState = $this->common_db->GetSelectedAllData('country_states',$selShpState,$whereShpState,'asc','code');
 ?>
<!-- Content Wrapper. Contains page content -->
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  
  <title><?php echo $c_company_name ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">

  <link rel='stylesheet' type='text/css' href='<?php echo member_path ?>css/style.css' />
  <link rel='stylesheet' type='text/css' href='<?php echo member_path ?>css/print.css' media="print" />
  <script type="text/javascript" src="" charset="UTF-8"></script><script type='text/javascript' src='<?php echo member_path ?>js/jquery-1.3.2.min.js'></script>
  <script type='text/javascript' src='<?php echo member_path ?>js/example.js'></script>

</head>

<body>

  <div id="page-wrap">

  <h3>Tax Invoice
</h3>
    
    <div id="identity">

            <div id="logo">

             
              <div class="jeswadd bord-bottp">  
  <p><b><strong><?php echo $c_title ?></strong></b> <br>  
  <b><strong><?php echo $c_address ?></strong></b>
</p>
              </div>

              <div class="jeswadd"> 
  <p>Buyer <br> 
<b> <strong><?php echo $C_FNAME?></strong></b> <br>
Mob : <?php echo $C_MOBILE ?> <br>
State Name : <?php echo $state_name ?></p>
              </div>
            </div>
    

<div class="tablare">
  <table>

  <tr>
    <td style="    border-top: inherit;border-left: inherit;">Invoice No. <br><b><?php echo $invoice_id ?></b></td>
    <td style="    border-top: inherit;border-right: inherit; ">Dated <br><b><?php echo $d_invoice ?></b></td>
   
  </tr>
    <tr>
    <td style="border-left: inherit;">Delivery Note <br></td>
    <td style="    border-right: inherit;">Mode/Terms of Payment <br> </td>
   
  </tr>
    <tr>
    <td style="border-left: inherit;">Supplier’s Ref. <br>  </td>
    <td style="    border-right: inherit;">Other Reference(s) <br></td>
   
  </tr>
    <tr>
    <td style="border-left: inherit;">Buyer’s Order No. <br> <?php echo $n_order_id ?></td>
    <td style="    border-right: inherit;">Dated <br> <?php echo $d_date ?> </td>
   
  </tr>
    <tr>
    <td style="border-left: inherit;">Despatch Document No. <br> </td>
    <td style="    border-right: inherit;">Delivery Note Date <br>  </td>
   
  </tr>
    <tr>
    <td style="border-left: inherit;">Despatched through <br> </td>
    <td style="    border-right: inherit;">Destination <br> </td>
   
  </tr>

</table>

<div class="terms but"> 
  <p >Terms of Delivery <br>  



  </p>
  
</div>

</div>


   

    
    </div>
    
    <div style="clear:both"></div>
    


    <table id="items">
    <thead>
      <tr>
          <th width="2%">S No</th>
          <th width="30%">Description of Goods</th>
          <th >HSN/SAC</th>
          <th >GST RATE</th>
          <th >KFC RATE</th>
          <th >Quantity</th>
          <th >Rate</th>
          <th width="5%">Per(%)</th>
          <th >Amount</th>
        
      </tr>
    </thead>
    <tbody>
      <tr>  

<td class="pdfl">1</td>
<td><b><?php echo $c_product ?></b> 
</br>
</br>CGST
</br>SGST
</br>Kerala Flood Cess



</td>
<td>2009</td>
<td><?php echo $gst ?></td>
<td><?php echo $n_kfcs ?></td>
<td><b><?php echo $n_quantity ?> Nos</b></td>
<td><?php echo $n_amount?></td>
<td>Nos</td>
<td><b><?php echo $actual_amount ?></b>
</br><?php echo $cgst;?>
</br><?php echo $sgst;?>
</br><?php echo $n_kfcs;?></td>

      </tr>





      <tfoot>

<tr>
  <td></td>
  <td style="float: right;
    border: inherit;">Total</td>
  <td></td>
  <td></td>
  <td></td>
  <td><b><?php echo $sum_quantity ?>Nos</b></td>
  <td></td>
  <td></td>
  <td><b>₹ <?php echo $n_subtotal ?></b></td>
</tr>

        </tfoot>        
    </tbody>
    
    
    </table>


    
  <div class="inword">
    <h6>Amount Chargeable (in words) <span style="    float: right;"><i>  E. & O.E</i></span><br>
    <span class="amnt"><b>INR One thousand Seven Hundred Only</b></span></h6> 
  </div>






<table>
  <col>
  <colgroup span="2"></colgroup>
  <colgroup span="2"></colgroup>
  <tr>
    <td style="    border-top: inherit;" width="30%" rowspan="2">HSN/SAC</td>
    <td style="    border-top: inherit;"  rowspan="2">Taxable Value</td>
    <th style="    border-top: inherit;"  colspan="2" scope="colgroup">Central Tax</th>
    <th style="    border-top: inherit;"  colspan="2" scope="colgroup">State Tax</th>
     <td style="    border-top: inherit;"  rowspan="2">Total Tax Amount</td>
  </tr>
  <tr>
    <th scope="col">Rate</th>
    <th scope="col">Amount</th>
    <th scope="col">Rate</th>
    <th scope="col">Amount</th>
  </tr>
  <tr>
 
    <td></td>
    <td><?php echo $n_subtotal ?></td>
    <td><?php echo $cgst?></td>
    <td><?php echo $cgstamount?></td>
    <td><?php echo $sgst ?></td>
     <td><?php echo $sgstamount ?></td>
    <td><?php echo $totalgst ?></td>
   
  </tr>
  
      <tfoot style="text-align: center;">

<tr>
  
  <td style="border-bottom: inherit;"><span style="float: right;">Total</span></td>
  <td style="border-bottom: inherit;"><b><?php echo $sum_amount ?></b></td>
  <td style="border-bottom: inherit;"></td>
  <td style="border-bottom: inherit;"><b> <?php echo $cgstsum ?></b></td>
  <td style="border-bottom: inherit;"></td>
  <td style="border-bottom: inherit;"><b> <?php echo $sgstsum ?> </b></td>
  <td style="border-bottom: inherit;"><b><?php echo  $totalgstsum ?></b></td>

</tr>

        </tfoot>
</table>


<div class="taxamnt">
  <h3>Tax Amount (in words): <b>INR One Hundred Eighty and Fifty Four paise Only</b></h3>

  <div class="copan">
    <div class="pancp"> 
     <h3>Company's Pan&nbsp;&nbsp;&nbsp;&nbsp;: <b></b></h3>
     <h5>Declaration</h5>
     <p>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>

    </div>  
    <div class="bankcondet">
   <h3>Company's Bank Details</h3>
  <p><td> Bank Name</td>: <b></b></p>
  <p><td>A/c No.</td>: <b></b></p>
  <p><td> Branch & IFSC Code</td>: <b></b></p>
  <div class="fort">
  <p style="    margin-bottom: 23px">For Life Vision LLP</p>
  <p style="    text-align: right;">  Authorised Signatory</p>
</div>
</div>

  </div>




</div>  




  
  </div>
  
</body>

</html>
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