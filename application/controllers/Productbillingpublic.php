<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Productbillingpublic extends CI_Controller {

	function __construct()

	{

		parent::__construct();

		$this->load->library('session');	

		$this->load->model('fetch_model');
		
		$this->load->model('common_db');
		
		$this->load->model('login_db');

		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');			

		$this->load->library('encryption');

		$this->load->helper('string');

		$this->load->helper('date');

		$this->load->helper('security');

		 if($this->session->userdata('admin_logged_in'))
		{

		}
		else
		{
		    redirect('admin_login', 'refresh');
		}			

	}	 

	public function product_billing_public()

		{

			  $this->load->view('admin_area/header');
	    	  $this->load->view('admin_area/product_billing_public');

		}	


	public function product_billing_generate_public()

	{

		$vicibfranchiseeuserid = $this->session->userdata('vicibfranchiseeuserid');

		$stockistname  = $this->input->post('stockist');

		$productitems  = $this->input->post('productitems');

		$billno=$this->ayurzone_model->get_new_bill_no($vicibfranchiseeuserid);

		date_default_timezone_set('Asia/Kolkata');

		$today= date('d-m-Y');

		$todaydatetime= date('Y-m-d H:i:s');

		$customerstatus=false;

		$checking_product_bv=0;$total_bv_check=0;
		$C_FNAME= "";$C_LNAME="";$C_ADDRESS1="";$C_ADDRESS2="";$C_STATE=""; $C_EMAIL="";$C_MOBILE = ""; 	
		$sql2= "SELECT n_id,C_FNAME,C_LNAME,C_ADDRESS1,C_ADDRESS2,C_STATE,C_EMAIL,C_MOBILE,C_USERNAME
		 from oneid_master where c_username = '$stockistname'";

			$c_username="";		

						$result2 = $this->ayurzone_model->get_results($sql2);

						if($result2){

							foreach($result2 as $row)

						  {

								$stockist = $row->n_id;
								$C_USERNAME 	 = $row->C_USERNAME;

								$C_FNAME 	 = $row->C_FNAME;
				
								$C_LNAME 	 = $row->C_LNAME;
				
								$C_ADDRESS1  = $row->C_ADDRESS1;	
				
								$C_ADDRESS2  = $row->C_ADDRESS2;
				
								$C_STATE 	 = $row->C_STATE;
				
								$C_EMAIL 	 = $row->C_EMAIL;	
				
								$C_MOBILE 	 = $row->C_MOBILE;
								
								$customerstatus=true;


						  }

						}

		if($customerstatus){


		

		

		

	$sql="SELECT c_store_name,c_store_username,c_store_address,c_store_phone,c_store_state FROM 

		stockist_master WHERE  n_id='$vicibfranchiseeuserid' ";

		$result = $this->ayurzone_model->get_results($sql);		

		$c_store_name= ""; $c_store_username=""; $c_store_address=""; $c_store_phone="";	$c_store_state="";

		if($result)

		{

			foreach($result as $row)

			{

				$c_store_name 		 	= $row->c_store_name;

				$c_store_username 	    = $row->c_store_username;

				$c_store_address		= $row->c_store_address;

				$c_store_phone		 	= $row->c_store_phone;

				$c_store_state		 	= $row->c_store_state;

			}

		}

		

		 $team_leader=0;

		 $c_silver_active="N";$c_gold_active="N";$c_repurchase_active="N";

		

		$c_silver_active_billing_flag=true;

		$zero_bv_billing_flag=true;

		

		$items=json_decode($productitems);

		function object_to_array($obj) 

		{

			$_arr = is_object($obj) ? get_object_vars($obj) : $obj;

			foreach ($_arr as $key => $val) 

			{

				$val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;

				$arr[$key] = $val;

			}

				return $arr;

		}

		$product_array = object_to_array($items);

		

		if($c_silver_active=="N"){

			$bvchecking=0;$grandtotalbvchecking=0;

	

		

					if($zero_bv_billing_flag){

		
		

	?><!--<table width="100%" border="1" cellspacing="0" cellpadding="0" class="table">
    <?php
	if($team_leader==1){
		?>
<tr>

    <td colspan="2" bgcolor="#C1F9CE"><b><i class="fa fa-user"></i> LEADER'S ID</b></td>

  </tr>
  <?php }?>
  <tr>

    <td bgcolor="#C1F9CE">Silver plan</td>

    <td bgcolor="#C1F9CE"><?php if($c_silver_active=="Y"){echo "Activated"; } else {echo "Not Activated";}?></td>

  </tr>

  <tr>

    <td bgcolor="#C1F9CE">Gold plan</td>

    <td bgcolor="#C1F9CE"><?php if($c_gold_active=="Y"){echo "Activated"; } else {echo "Not Activated";}?></td>

  </tr>

  <tr>

    <td width="20%" bgcolor="#C1F9CE">Current Silver BV</td>

    <td width="80%" bgcolor="#C1F9CE"><?php echo $totalsilverbv;?></td>

  </tr>

  <tr>

    <td bgcolor="#C1F9CE">Current Gold BV</td>

    <td bgcolor="#C1F9CE"><?php echo $totalgoldbv;?></td>

  </tr>

  <tr>

    <td bgcolor="#C1F9CE">Current Repurchase BV</td>

    <td bgcolor="#C1F9CE"><?php echo $totalrepurchasebv;?></td>

  </tr>

</table>-->



        <div id="showbill">

        <table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td width="19%" ><img src="<?php echo base_url();?>img/logo/logo.png" alt="LALA" class="img-responsive" height="30" width="155">

             </td>

    <td width="37%"  valign="top" style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif !important;

    font-size: 13px !important;

    font-weight: 400 !important;">  

   Sandhya Development Society<br /> Kodumpidy Post<br /> Pala, Kerala <br /> 686 651<br /> 04822 - 247880</td>

    <td width="3%" valign="top" >To</td>

    <td width="41%" align="left" valign="top"><?php echo $C_USERNAME;?><br /><?php echo $C_FNAME; ?> <?php //echo $C_LNAME; ?> <br/><?php echo $C_ADDRESS1;?><br/> <?php echo $C_MOBILE;?><br/></td>

  </tr>

  <tr>

    <td align="center"><br />

      <br /></td>

    <td align="center">&nbsp;</td>

    <td align="center">&nbsp;</td>

    <td align="center">&nbsp;</td>



  </tr>

        </table>

        <br />

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td colspan="3" align="center" class="pad">TAX INVOICE PUBLIC</td>

          </tr>

          <tr>

            <td class="pad" width="13%">GSTIN Number</td>

            <td class="pad" width="1%">:</td>

            <td class="pad" width="86%">32AABAS6678N1ZX</td>

          </tr>

          <tr>
            <td class="pad">Franchisee</td>
            <td class="pad">:</td>
            <td class="pad"><?php echo $c_store_username;?></td>
          </tr>
          <tr>

            <td class="pad">Invoice No.</td>

            <td class="pad">:</td>

            <td class="pad"><?php echo $billno;?></td>

          </tr>

          <tr>

            <td class="pad"> Date</td>

            <td class="pad">:</td>

            <td class="pad"><span class="text-right"><?php echo $today;?></span></td>

          </tr>

        </table>

<table width="100%" class="table table-bordered">

<tr>

					<td class="pad" width="3%" height="41" rowspan="2" align="center" valign="bottom">No.</td>

					<td class="pad" width="3%" rowspan="2" align="center" valign="bottom">Item code</td>

					<td class="pad" width="7%" rowspan="2" align="center" valign="bottom">HSN Code</td>

					<td class="pad" width="26%" rowspan="2" align="left" valign="top">Description of Goods</td>

					<td class="pad" width="5%" rowspan="2" align="center" valign="bottom">DP</td>

					<td class="pad" width="4%" rowspan="2" align="center" valign="bottom">Qty.</td>

					<td class="pad" width="4%" rowspan="2" align="center" valign="bottom">BV</td>

					<td class="pad" colspan="2" align="center">CGST</td>

					<td colspan="2" align="center" class="pad">SGST</td>

					<td colspan="2" align="center" class="pad">KFCS</td>

					<td class="pad" width="10%" rowspan="2" align="center">Total</td>

    				

			  </tr>

 				<tr>

 				  <td class="pad" width="5%" align="center">Rate</td>

 				  <td class="pad" width="7%" align="center">Amount</td>

 				  <td class="pad" width="5%" align="center">Rate</td>

 				  <td class="pad" width="8%" align="center">Amount</td>

 				  <td class="pad" width="6%" align="center">Rate</td>

 				  <td class="pad" width="7%" align="center">Amount</td>

              </tr>

  				<?php

					  $cnt=0;$subtotal=0;$marginpercentage=0;$rqntity=0; $qntytotal=0;$total_grand_total=0;$total_grand_totalrounded=0;

					  $lessamount=0;

					  $today=date('d-m-Y');

					  $grandtotalbv=0;

  					  foreach($product_array as $it)

					  {

							 $rqntity=$it['rqntity'];

							 $n_slno= $it['sid'];

							 $cnt++;

	

							$cgst=0;$sgst=0;$totalprice=0;$sgstval=0;$cgstval=0;$totalitemprice=0;$zonalprice=0;

							$sellingprice=0;$producttax=0;$preduction=0;

							$tax=0;$pmrp=0;

							$unit_price=0;

							 $sql2="SELECT productid,n_quantity,dp,n_sgst,n_cgst,n_igst,n_bv,
							 n_kfcs,mastercategoryid from stock_master where 
							to_id='$vicibfranchiseeuserid' and  n_price_productid='$n_slno'";

	

							$productname=$status=$cid=$hsncode=$producttype=$productquantity="";		
							$gst=0;$cgst=0;$igst=0;	$bv=0;	$n_kfcs=0;$n_kfcsval=0;
							$result2 = $this->ayurzone_model->get_results($sql2);

							if($result2)

							{

								foreach($result2 as $row)

								{

								 	$productid=$row->productid;

									$qty=$row->n_quantity;

									$pmrp=$row->dp;
									$gst=$row->n_sgst;
									$cgst=$row->n_cgst;
									$igst=$row->n_igst;
									$bv=$row->n_bv;
									//$pv=$row7->pv;
									$n_kfcs=$row->n_kfcs;
									$mastercategory=$row->mastercategoryid;

									$productname= $this->ayurzone_model->get_product_name($productid);

									$hsncode= $this->ayurzone_model->get_hsncode($productid);

									$producttype= $this->ayurzone_model->get_producttype($productid);

									$productquantity= $this->ayurzone_model->get_productquantity($productid);

									$itemcode= $this->ayurzone_model->get_item_code($productid);

									//$mrp=$rqntity*$sellingprice;

							  }

						   }

							$cgstval=(($pmrp*$rqntity)*($cgst))/100;

							$sgstval=(($pmrp*$rqntity)*($gst))/100;

							$n_kfcsval=(($pmrp*$rqntity)*($n_kfcs))/100;

							$totalmrp=($rqntity*$pmrp);

							$totalbv=$rqntity*$bv;

							$totalmrp=number_format((float)$totalmrp, 2, '.', '');

					 ?>

					  <tr>

						<td class="pad" height="25" align="center"><?php echo $cnt;?></td>

						<td class="pad" align="center"><?php echo $itemcode;?></td>

						<td class="pad" align="center"><?php echo $hsncode;?></td>

						<td class="pad" align="left"><?php echo $productname;?></td>

						<td class="pad" align="center"><?php echo $pmrp;?></td>

                        <td class="pad" align="center"><?php echo $rqntity;?></td>

                        <td class="pad" align="center"><?php echo $totalbv;?></td>

                        <td class="pad" align="center"><?php echo $gst;?></td>

                        <td class="pad" align="center"><?php echo number_format($sgstval,2);?></td>

                        <td class="pad" align="center"><?php echo $cgst;?></td>

                        <td class="pad" align="center"><?php echo number_format($cgstval,2);?></td>

                        <td align="center" class="pad"><?php echo $n_kfcs;?></td>

                        <td align="center" class="pad"><?php echo number_format($n_kfcsval,2);?></td>

                        <td class="pad" align="center"><?php echo $totalmrp;?></td>

					  </tr>

					  <?php

					  $qntytotal+=$rqntity;

					  $total_grand_total+=$totalmrp;

					  $total_grand_total=number_format((float)$total_grand_total, 2, '.', '');

					  $total_grand_totalrounded=floor($total_grand_total);

					  $lessamount=$total_grand_total-$total_grand_totalrounded;

					  $totalinwords=$this->ayurzone_model->getIndianCurrency($total_grand_totalrounded);

					  $totalinwords=ucfirst($totalinwords);

					  $grandtotalbv+=$totalbv;

                    }

                  ?>

                      <tr>

                        <td colspan="6" align="right" class="pad"><b>Total BV</b></td>

                        <td class="pad" align="center"><b><?php echo $grandtotalbv;?></b></td>

                        <td class="pad" colspan="6" align="right">Less : Round off</td>

                        <td class="pad" align="center">(-) <?php echo round($lessamount,1,2);?></td>

                      </tr>

                      <tr>

                        <td class="pad" colspan="7" align="center"><?php echo $totalinwords;?></td>

                        <td class="pad" colspan="6" align="right">Total</td>

                        <td class="pad" align="center"><?php echo $total_grand_totalrounded;?></td>

                      </tr>

                      <tr>

                        <td class="pad" colspan="14" align="center"><table width="100%" border="0" cellpadding="1" cellspacing="1">

                          <tr>

                            <td width="73%" height="21" align="center">&nbsp;</td>

                            <td width="27%" align="center">VICIB<?php //echo $c_store_name; ?></td>

                          </tr>

                          <tr>

                            <td  height="21" align="center">&nbsp;</td>

                            <td align="center">&nbsp;</td>

                          </tr>

                          <tr>

                            <td height="21" align="center">&nbsp;</td>

                            <td  align="center">Authorised Signatory</td>

                          </tr>

                        </table></td>

                      </tr>

          </table>

<button class="btn btn-danger " id="backbtn" type="button" ><i class="fa fa-backward"></i> Back</button> <button class="btn btn-success " id="confirmbtn" type="button" ><i class="fa fa-forward"></i> Confirm</button> <span id="formsaveloader2" class="marginleft"></span>  </div>

        

     				<button class="btn btn-success " id="printbtn" type="button" style="display:none;" ><i class="fa fa-print"></i> Print</button>   <a id="thermalprintbtnlink" href="" target="_new"><button class="btn btn-yellow " id="thermalprintbtn" type="button" style="display:none;" ><i class="fa fa-print"></i> Thermal Print</button>   </a>

					<?php

					

					}else {

				echo "notallowedzerobv";

			}

					}else {

				echo "exceededbv";

			}

		}else {

			echo "customererror";

		}



	}



	public function customer_billing_save29_4_2020()

	{

		 $stockist  = $this->input->post('stockist');

	     $productitems  = $this->input->post('productitems');  

		echo $status = $this->Product_billing_db->customer_billing_save($stockist,$productitems);		

	}

		

	public function more_bill_details()//TO SEE THE BILL WHEN CLICK ON VIEW BILL BUTTON

	{

		$this->load->view('more_bill_details');

	}

	

	public function print_bill_detailsold()

	{

	 	$vicibfranchiseeuserid = $this->session->userdata('vicibfranchiseeuserid');

		//$passvalues=$customerid="";

		$passvalues=$orderid="";

		$passvalues = $this->input->post('passvalues');

     	$passvaluesarray=explode("_",$passvalues);

		$customerid=$passvaluesarray[0];

		$billingno=$passvaluesarray[1];

		$slno=$passvaluesarray[2];



 		 $sql2="SELECT a.n_slno,a.bsellerid,a.billingno,DATE_FORMAT(a.bdatetime, '%d-%m-%Y') AS 

		  bdatetime,a.bcustomerid FROM customer_billing_master a,customer_billing_items b WHERE 

		  a.billingno=b.billingno AND a.billingno='$billingno'

		  and b.bsellerid='$vicibfranchiseeuserid' and a.n_slno='$slno' and a.bcustomerid='$customerid'";

		$bsellerid=$status=$cid=$bdatetime=$billingno="";		

		$result2 = $this->ayurzone_model->get_results($sql2);



		if($result2)

		{

			foreach($result2 as $row)

			{

				$n_slno=$row->n_slno;

				$customerid=$row->bcustomerid;

				$bsellerid=$row->bsellerid;

				$billingno=$row->billingno;

				$bdatetime=$row->bdatetime;

			}

		}

		?>



		<div id="showbill">

		<table width="100%" border="0"  class="table">

  			<tr>

   				<td colspan="2">TAX INVOICE</td>

   				<td width="15%"></td>

    			<td width="39%"></td>

		  </tr>

  			<tr>

    			<td width="11%">Details</td>

    			<td width="35%">&nbsp;</td>

    			<td>Invoice No.</td>

    			<td><?php echo $billingno;?></td>

  			</tr>

  			<tr>

    			<td>Name </td>

    			<td><?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_FNAME');?></td>

    			<td>Invoice Date</td>

    			<td><?php echo $bdatetime;?></td>

 			</tr>

  			<tr>

    			<td>Address</td>

   				<td colspan="3"><?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_ADDRESS1');?><br />

				<?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_ADDRESS1');?><br />

				<?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_MOBILE');?></td>

  			</tr>

		</table>



<br />

		<table width="100%" border="0"  class="table table-bordered">



  			<tr>

    			<td width="4%" height="41" rowspan="2" align="center">No.</td>

    			<td width="17%" rowspan="2" align="center">Name of product</td>

    			<td width="7%" rowspan="2" align="center">Qty</td>

    			<td width="7%" rowspan="2" align="center">DP</td>

   	 			<td colspan="2" align="center">CGST</td>

    			<td colspan="2" align="center">SGST</td>

    			<td colspan="2" align="center">IGST</td>

    			<td width="7%" rowspan="2" align="center">Total Amount</td>

  			</tr>

  			<tr>

    			<td width="8%" align="center">Rate</td>

    			<td width="8%" align="center">Amt</td>

    			<td width="8%" align="center">Rate</td>

    			<td width="8%" align="center">Amt</td>

    			<td width="8%" align="center">Rate</td>

    			<td width="8%" align="center">Amt</td>

		  </tr>



  			<?php

  			  $cnt=0;$subtotal=0;

			  $cgst=0;$sgst=0;$totalprice=0;$sgstval=0;$cgstval=0;$totalitemprice=$qntytotal=0;

			  $details = $this->ayurzone_model->get_customer_billing_details_new($bsellerid,$customerid,$billingno);

			 // print_r($details);

			  for($k=0;$k<count($details);$k++){

				  $cnt++;



 			?>

  			<tr>

   				<td><?php echo $cnt;?></td>

    			<td><?php echo $this->ayurzone_model->get_product_name($details[$k]['bproductid']);?></td>

    			<td align="center"><?php echo $details[$k]['bquantity'];?></td>

    			<td align="center"><?php echo $details[$k]['dp'];?></td>

    			<td align="center"><?php echo $details[$k]['cgstrate'];?></td>

    			<td align="center"><?php echo $details[$k]['cgstval'];?></td>

    			<td align="center"><?php echo $details[$k]['sgstrate'];?></td>

    			<td align="center"><?php echo $details[$k]['sgstval'];?></td>

   				<td align="center"><?php echo $details[$k]['igstrate'];?></td>

    			<td align="center"><?php echo $details[$k]['igstval'];?></td>

    			<td><?php echo $details[$k]['btotal'];?></td>

  			</tr>



  		<?php

  			$qntytotal+=$details[$k]['bquantity'];

  			$subtotal+=$details[$k]['btotal'];

			  }

  			?>

  			<tr>

    			<td colspan="2" align="right">Total </td>

    			<td align="center"><?php echo $qntytotal;?></td>

    			<td>&nbsp;</td>

    			<td>&nbsp;</td>

    			<td>&nbsp;</td>

    			<td>&nbsp;</td>

    			<td>&nbsp;</td>

    			<td>&nbsp;</td>

    			<td>&nbsp;</td>

   				<td><?php echo $subtotal;?></td>

  			</tr>

		</table>

<?php	

	}

		public function print_bill_details()

	{

	 	
	 	$vicibfranchiseeuserid = $this->session->userdata('vicibfranchiseeuserid');
		//$passvalues=$customerid="";
		$passvalues=$orderid="";
		$passvalues = $this->input->post('passvalues');
     	$passvaluesarray=explode("_",$passvalues);
		$customerid=$passvaluesarray[0];
		$billingno=$passvaluesarray[1];
		$slno=$passvaluesarray[2];

 		 $sql2="SELECT a.n_slno,a.bsellerid,a.billingno,DATE_FORMAT(a.bdatetime, '%d-%m-%Y') AS 
		  bdatetime,a.bcustomerid FROM customer_billing_master a,customer_billing_items b WHERE 
		  a.billingno=b.billingno AND a.billingno='$billingno'
		  and b.bsellerid='$vicibfranchiseeuserid' and a.n_slno='$slno' and a.bcustomerid='$customerid'";
		$bsellerid=$status=$cid=$bdatetime=$billingno="";		
		$result2 = $this->ayurzone_model->get_results($sql2);

		if($result2)
		{
			foreach($result2 as $row)
			{
				$n_slno=$row->n_slno;
				$customerid=$row->bcustomerid;
				$bsellerid=$row->bsellerid;
				$billingno=$row->billingno;
				$bdatetime=$row->bdatetime;
			}
		}
		
		 $sql21="SELECT c_username from bc_master where pn_id='$customerid'";
		$customer_user_id="";		
		$result21 = $this->ayurzone_model->get_results($sql21);

		if($result21)
		{
			foreach($result21 as $row21)
			{
				$customer_user_id=$row21->c_username;
			}
		}
		?>

		<div id="showbill" class="tablescroll">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19%" ><img src="<?php echo base_url();?>img/logo/logo.png" alt="LOGO" class="img-responsive" height="30" width="155">
    </td>
    <td width="37%"  valign="top" style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif !important;
    font-size: 13px !important;
    font-weight: 400 !important;">  
    Sandhya Development Society<br /> Kodumpidy Post<br /> Pala, Kerala <br /> 686 651<br /> 04822 - 247880</td>
    <td width="3%" valign="top" >To</td>
    <td width="41%" align="left" valign="top"><br /><?php echo $customer_user_id;?><br />
      <?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_FNAME');?> <br/><?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_ADDRESS1');?><br/><?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_DISTRICT');?><br/><?php echo $this->ayurzone_model->customer_billing_detail($customerid,'C_MOBILE');?></td>
  </tr>
  <tr>
    <td align="center"><br />
      <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>

  </tr>
</table>
		<table width="100%" border="1" cellspacing="0" cellpadding="0" >
          <tr>
            <td colspan="3" align="center" class="pad">TAX INVOICE</td>
          </tr>
          <tr>
            <td class="pad" width="13%">GSTIN Number</td>
            <td class="pad" width="1%">:</td>
            <td class="pad" width="86%">32AABAS6678N1ZX</td>
          </tr>
          <tr>
            <td class="pad">Invoice No.</td>
            <td class="pad">:</td>
            <td class="pad"><?php echo $billingno;?></td>
          </tr>
          <tr>
            <td class="pad"> Date</td>
            <td class="pad">:</td>
            <td class="pad"><?php echo $bdatetime;?></td>
          </tr>
        </table>


		<table width="100%"  class="table table-bordered" >

  			<tr>
    			<td class="pad" width="2%" height="41" rowspan="2" align="center">No.</td>
    			<td class="pad" width="7%" rowspan="2" align="center">Item code</td>
    			<td class="pad" width="6%" rowspan="2" align="center">HSN Code</td>
    			<td class="pad" width="26%" rowspan="2" align="center">Description of Goods</td>
    			<td class="pad" width="6%" rowspan="2" align="center">DP</td>
    			<td class="pad" width="5%" rowspan="2" align="center">Qty</td>
    			<td class="pad" width="5%" rowspan="2" align="center">BV</td>
    			<td class="pad" colspan="2" align="center">CGST</td>
    			<td class="pad" colspan="2" align="center">SGST</td>
    			<td class="pad" width="10%" rowspan="2" align="center">Total Amount</td>
  			</tr>
  			<tr>
    			<td class="pad" width="6%" align="center">Rate</td>
    			<td class="pad" width="7%" align="center">Amt</td>
    			<td class="pad" width="7%" align="center">Rate</td>
    			<td class="pad" width="7%" align="center">Amt</td>
   			 </tr>

  			<?php
  			  $cnt=0;$subtotal=0;
			  $cgst=0;$sgst=0;$totalprice=0;$sgstval=0;$cgstval=0;$totalitemprice=$qntytotal=0;
			  $grandtotalbv=0;
			  $details = $this->ayurzone_model->get_customer_billing_details_new($bsellerid,$customerid,$billingno);
			 // print_r($details);
			  for($k=0;$k<count($details);$k++){
				  $cnt++;
				  $bquantity=0;$n_bv=0;$total_bv=0;
				  $pid=$details[$k]['bproductid'];
				  $n_bv=$details[$k]['n_bv'];
				  $sql29="SELECT sgst,cgst,preduction from pricetable where pid='$pid'";
	
							$gst=$cgst="";		
							$result29 = $this->ayurzone_model->get_results($sql29);
							if($result29)
							{
								foreach($result29 as $row29)
								{
								 	$preduction=$row29->preduction;
									$gst=$row29->sgst;
									$cgst=$row29->cgst;
								}
							}
							$bquantity=$details[$k]['bquantity'];
							$total_bv=$n_bv*$bquantity;
 			?>
  			<tr>
   				<td class="pad" align="center"><?php echo $cnt;?></td>
   				<td class="pad" align="center"><?php echo $this->ayurzone_model->get_item_code($details[$k]['bproductid']);?></td>
   				<td class="pad" align="center"><?php echo $this->ayurzone_model->get_hsncode($details[$k]['bproductid']);?></td>
   				<td class="pad" align="center"><?php echo $this->ayurzone_model->get_product_name($details[$k]['bproductid']);?></td>
   				<td class="pad" align="center"><?php echo $details[$k]['dp'];?></td>
   				<td class="pad" align="center"><?php echo $details[$k]['bquantity'];?></td>
   				<td class="pad" align="center"><?php echo $total_bv;?></td>
    			<td class="pad" align="center"><?php echo $details[$k]['cgstrate'];?></td>
    			<td class="pad" align="center"><?php echo $details[$k]['cgstval'];?></td>
    			<td class="pad" align="center"><?php echo $details[$k]['sgstrate'];?></td>
    			<td class="pad" align="center"><?php echo $details[$k]['sgstval'];?></td>
   				<td class="pad" align="center"><?php echo $details[$k]['btotal'];?></td>
  			</tr>

  		<?php
  			$qntytotal+=$details[$k]['bquantity'];
  			$subtotal+=$details[$k]['btotal'];
			$grandtotalbv+=$total_bv;
			  }
  			?>
  			<tr>
    			<td class="pad" colspan="5" align="right">Total </td>
    			<td class="pad" align="center"><?php echo $qntytotal;?></td>
    			<td class="pad" align="center"><?php echo $grandtotalbv;?></td>
    			<td class="pad">&nbsp;</td>
    			<td class="pad">&nbsp;</td>
    			<td class="pad">&nbsp;</td>
    			<td class="pad">&nbsp;</td>
    			<td class="pad" align="center"><?php echo $subtotal;?></td>
  			</tr>
		</table>
        </div>
        <button class="btn btn-success " id="printbtn" type="button" ><i class="fa fa-print"></i> Print</button>
        <a target="_new" href="<?php echo base_url();?>print_bill_thermal/<?php echo $passvalues;?>"><button class="btn btn-yellow " id="thermalprintbtn" type="button" ><i class="fa fa-print"></i> Thermal Print</button>   </a> 
   
        

	<?php	

	}

	public function print_bill_thermal($billingdata)

	{

		$data['billingdata'] = $billingdata;

		$this->load->view('print_bill_thermal',$data);

		

	}

	public function print_bill_thermal_franchisee($billingno)

	{

		$data['billingno'] = $billingno;

		$this->load->view('print_bill_thermal_franchisee',$data);

		

	}
	
	
	
	public function purchase_success($id)

	{

		$data['id'] = $id;
		 $this->load->view('admin_area/header');

		$this->load->view('admin_area/purchase_success',$data);

		

	}
	
	
	
	
	
	
	


}







/* End of file welcome.php *//* Location: ./application/controllers/welcome.php */