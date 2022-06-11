  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
          <li class="active">Product Billing</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  
    
       <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title">Product Billing</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="addform">
              <div class="box-body">
			  <div class="row">
			   <div class="col-lg-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone Number</label>
				  <span id="stockistseletionerrrordiv" style="color:#F00; display:none;"></span> <br />
                  <input name="phno" type="text" class="form-control" id="phno" placeholder="Enter customer phone number">
                </div>
				</div>
		
				<div id="stockistnamediv" style="margin-bottom:20px; min-height:20px;"></div>
				<div class="col-lg-2">
                          <button class="btn btn-success moreview"  type="button" id="addmore" style="margin-top:-18px;"><i class="fa fa-plus"></i> Add product</button>
                        </div>
						
						<div id="stockistnamediv" style="margin-bottom:20px; min-height:20px;"></div>
                      <div class="row form-group firsthidediv" align="center">
                        <table width="100%" class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="20%" align="center">Product</th>
                                <th width="10%" align="center">Item code</th>
                              <th width="10%" align="center">MRP</th>
                              <th width="10%" align="center">DP</th>
                              <th width="10%" align="center">Current stock</th>
                              <th width="10%" align="center">Required quantity</th>
                              <th width="10%" align="center">Option</th>
                            </tr>
                          </thead>
                          <tbody id="addeditems">
                          </tbody>
						  
						  
						  <tbody id="sumitems">
                          </tbody>
                        </table>
                    <span style="display:none;" for="selectedids" class="error-span">Select atleast one product for billing</span> </div>
                      <div class="row form-group firsthidediv">
                        <div class="col-sm-10">
                          <button class="btn btn-success" type="button" id="formsubmit">Submit</button>
                          <span id="formsaveloader" class="marginleft" style="color:#F00;"></span> </div>
                        <div class="col-sm-2"> </div>
                      </div>
						
						</div>
						
						
						
						
                
              
          
              </div>
			  </form>
              <!-- /.box-body -->

            
           
          </div>
      

<div class="modal" id="myModal">
  <div class="modal-dialog  " style="width:93%;">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" id="closeproductselectionmodal" type="button">×</button>
        <h4 class="modal-title">
          <input id="searchcontent" class="form-control searchinputclass" placeholder="Search product" type="text">
        </h4>
      </div>
      <div class="modal-body " style="height: 500px; overflow-y: scroll;" >

        <table width="100%" class="table table-bordered">
          <thead>
            <tr>
              <th width="32%" align="center">Product</th>
              <th width="11%" align="center">Item code</th>
               <th width="9%" align="center">MRP</th>
              <th width="9%" align="center">DP</th>
              <th width="12%" align="center">Current stock</th>
              <th width="13%" align="center">Required quantity </th>
              <th width="16%" align="center">Option</th>
            </tr>
          </thead>
          <tbody id="itemlist">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
 
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <link rel="stylesheet" href="<?php echo member_path ?>bower_components/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="<?php echo member_path ?>dist/css/AdminLTE.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo member_path?>css/jquery.toast.css" />
<!-- jQuery 3 -->
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo member_path ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo member_path ?>dist/js/demo.js"></script>
<script src="<?php echo member_path ?>js/jquery.toast.js"></script>
<script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  });
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>

<style>
.firsthidediv {
	display:none;
}
label.error {
	color: #f00 !important;
	font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 13px;
	font-weight: 400;
}
.stockstyle2 {
	width:15% !important;
}
.stockstyle {
	width:45% !important;
}
.totcntclass {
	color:#F00;
	font-weight:bold;
	margin-top:6px;
}
.errorClass {
	border:  2px solid red;
}
.pad {
	padding:3px !important;
	border: 2px solid #000 !important;
}
.tablescroll {
	display: block;
	overflow-x: auto;
	white-space: nowrap;
	height:auto !important;
}
</style>

<script>

var calltoast = function (msg,ic){
				$.toast({
				text:msg ,
				position: 'mid-center',
				icon: ic,
				loader: false,
				"timeOut": "10000", 
						});
					}


	$("#addeditems").on('click','.deleteaddeditems', function () {
						var delid=$(this).attr('id');
						$('#del_'+delid).remove();
						
						fileList = $.grep(fileList, function(e){ 
							 return e.sid != delid; 
						});
						
						selectedids.splice( $.inArray(delid,selectedids) ,1 );
						$('#selectedids').val(selectedids);
					
						$("#formsaveloader").html("");
						totalamout();
				});


					
					
					
					$('.moreview').click(function(e){

			var phno=$("#phno").val();


			if(phno==""){

				$('#stockistseletionerrrordiv').show().html('Please enter phone number');

				}
				
			else
				{
							
							$('#myModal').show();

							$('#stockistseletionerrrordiv').hide();

	 					$('#itemlist').html("<img src='<?php echo base_url();?>ajax-loaders/loading-big.gif' title='ajax-loaders/loading-big.gif' >");
							$('#searchcontent').val('');

									var selectedids=$('#selectedids').val();
									 $.ajax({
									cache: false,
									type: 'POST',
									data: {searchcontent:'',selectedids:selectedids,phno:phno},
									url: '<?php echo base_url();?>billing_franchisee_product_list',
									success: function(data) {	
										$('#itemlist').html(data);	
									}
								}); 
									}
			
    });
	
	$('#formsubmit').click(function(){
	    
	    var cnf = confirm('Please confirm before proceed .. Do you want to continue??');
	    if(!cnf)
	      return false;
	
	if($("#addform").valid()){
			$('#confirmbtn').prop('disabled', true).hide();
			$("#formsaveloader2").html("<img src='<?php echo base_url();?>ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader-1.gif' >");
			var phno = $("#phno").val();
			
			//var BillingDate = $("#BillingDate").val();
							$.ajax({
								type: "POST",
								url: "<?php echo base_url();?>customer_billing_save_public",
								dataType:'json',
								data  : {'phno':phno,'productitems':JSON.stringify(fileList)},
								success: function(data) {
									
									$('#confirmbtn').prop('disabled', false);
									$("#formsaveloader2").html("");
									 if(data){
										  if(data.status=='session_expired'){
											  $('#session_modal').show();
											  $('#overlay').show(); 
										  }
										
										  
										  
										  
										  else {
										 if(data.status=='success'){
											fileList=[];
											 calltoast('Billing succesfully &nbsp;&nbsp;&nbsp;&nbsp;','success');

											 $("#productselectdiv").html('');
											 $("#confirmbtn").hide().remove();
											 $("#backbtn").hide();
											 $("#printbtn").show();
											 $("#thermalprintbtn").show();
											  window.location.href="<?php echo site_url() ?>purchase_success/"+data.order_id;
											 //$('#thermalprintbtnlink').attr("href","<?php echo base_url();?>print_bill_thermal_franchisee/"+data.print_id);
										 }
										else if(data.status=='error'){
											if(data.errocondition=='norighttime'){
												calltoast(data.msg+'&nbsp;&nbsp;&nbsp;&nbsp;','error');
												setInterval(function(){ window.location.href = '<?php echo base_url();?>product_billing'; }, 4000);
												
											}
											else {
													
													var ar=data.errorproductarray;
													if((ar.length>0)){
													var ermsg="Please check the current stock of the following product&nbsp;&nbsp;&nbsp;&nbsp;";
													 for(var i=0;i<ar.length; i++)
								   					{
														ermsg+=" <br>"+ar[i].errorproductname;
													}
													calltoast(ermsg,'error');
													}else{
													calltoast(data.msg+'&nbsp;&nbsp;&nbsp;&nbsp;','error');
													}
												}
											}
											
											 else if(data.status=='no_active'){
											fileList=[];
											 calltoast('Product Not ACtivated &nbsp;&nbsp;&nbsp;&nbsp;','Warning');
										  }
									
										}
									 }
									},
								error: function() {
									calltoast('Please try again later &nbsp;&nbsp;&nbsp;&nbsp;','error');
								}
							});
					}
					
	});
	
	
	function loadcontent(page){
							var searchcontent=$('#searchcontent').val();
							var selectedids=$('#selectedids').val();
							var pstokistid=$('#pstokistid').val();
							var pdttype=$('#pdttype').val();
							$.ajax({
							cache: false,
							type: 'POST',
							//dataType:'json',
							data: {searchcontent:searchcontent,selectedids:selectedids,pstokistid:pstokistid,pdttype:pdttype},
							url: '<?php echo base_url();?>billing_franchisee_product_list',
							success: function(data) {
										$('#itemlist').html(data);	
							}
						}); 
				}
			$("#searchcontent").keyup(function(){
				 loadcontent(1);
			});
				var selectedids=[];var fileList=[];var i =0;var totamt =0;var totdp=0;
	
	$("#itemlist").on('click', '.validate', function () {
		
					//This function will add productid and n_slno to jquery array
					var did=$(this).attr('id');
					var prdctid=$('#prd_'+did).val();
					$('#reqqnty'+did).removeClass('errorClass');
						var currentstock=parseInt($('#currentstock'+did).val());
						var reqqnty=parseInt($('#reqqnty'+did).val());
					
						var productname=$(this).closest('tr').find('td:nth-child(1)').text();
						var itemcode=$(this).closest('tr').find('td:nth-child(2)').text();
						var unit_price=$(this).closest('tr').find('td:nth-child(3)').text();
						var mrp=$(this).closest('tr').find('td:nth-child(4)').text();
						var qty=$(this).closest('tr').find('td:nth-child(6)').text();

						totdp = totdp+parseInt(unit_price);
						totamt = totamt+parseInt(mrp);
						if(!isNaN(reqqnty)){
							if(reqqnty<1){
								$('#reqqnty'+did).addClass('errorClass');
								$('#er'+did).html('Enter a valid quantity greater than zero');
							}
							else if(reqqnty>currentstock){
								$('#reqqnty'+did).addClass('errorClass');
								$('#er'+did).html('Entered quantity is greater than current stock');
							}else {
								
									$('#reqqnty'+did).removeClass('errorClass');
									
									$("#l_"+did).html("<img src='<?php echo base_url();?>ajax-loaders/ajax-loader.gif'/>");
									
									$('#p_'+did).hide();
									
									selectedids.push(did);
									
									$('.firsthidediv').show();
									//alert(selectedids);
									fileList.push({'sid': did,'rqntity':reqqnty,'prdctid':prdctid});
									i++;
									$('#searchcontent').val('');
									loadcontent(1);
									var product_listadded='';
										product_listadded+='<tr class="sum" id="del_'+did+'">'+
										  '<td>'+productname+'</td>'+
										  '<td>'+itemcode+'</td>'+
										  '<td>'+unit_price+'</td>'+
										  '<td>'+mrp+'</td>'+										  
										  '<td>'+currentstock+'</td>'+
										  '<td>'+reqqnty+'</td><td><button class="btn btn-danger deleteaddeditems" type="button" id="'+did+'"><i class="fa fa-minus"></i> </button>			</td></tr>';


												var sumitems= '<tr>'+
										  '<td colspan="2">Total</td>'+
										  
										  '<td>'+totdp+'</td>'+
										  '<td>'+totamt+'</td>'+
										   '<td colspan="3"> </td>';

										  
										$('#addeditems').prepend(product_listadded);
										
									calltoast('Product added &nbsp;&nbsp;&nbsp;&nbsp;','success');
									
									totalamout();

							}
						}else $('#reqqnty'+did).addClass('errorClass');
						$('#selectedids').val(selectedids);
				 });
				 
				 $("#confirmationdiv").on('click', '#printbtn', function () {
					$("#showbill").printElement();
				});
				$("#closeproductselectionmodal").click(function () {
					$("#myModal").hide();
				});
				
				function totalamout()
		{
			

			var totamt1 =0;var totaldp=0; 
			$(".sum").each(function() {
				
           var unit_price=$(this).closest('tr').find('td:nth-child(3)').text();
		   
		   var mrp=$(this).closest('tr').find('td:nth-child(4)').text();
		  
            var reqqnty=$(this).closest('tr').find('td:nth-child(8)').text();
            
         //   alert(mrp);
			//alert(unit_price);
          
			var totamt1=(mrp)*reqqnty;
			var totaldp=(unit_price)*(reqqnty);
			totamt =totamt+totamt1;						
			totdp = totdp+totaldp;
			});

          var sumitems= '<tr>'+	
						'<td colspan="2">Total</td>'+	
						'<td>'+totdp+'</td>'+		
						'<td>'+totamt+'</td>'+			
						'<td colspan="3"> </td>';
			
			$('#sumitems').html(sumitems);
			
		}
 

  </script>
</body>
</html>
