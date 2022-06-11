    
  <div class="container">
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" id="result">
    
    
      
    </div>
  </div>
  
</div>
  
  
    <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>Product purchase list <small></small> </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Product Billing list</li>
    </ol>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
    
    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
    <h3 class="box-title">Product Billing list</h3>
    </div>
    <div class="box-body">
    <div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-header">
    <h3 class="box-title"></h3>
   
  </br></br>
    
     <div class="row">
      <div id="result">
    
    <table class="table table-hover table-bordered">
    <thead>
    <tr>
    <th colspan="6"> </th>
   
    </tr>
    <tr>
    <th>Sl.No</th>
    <th>Order Id</th>
     <th>Package</th>
    <th>Usename/Name</th>
    <th>Invoice</th>
    <th>Total Amount</th>
    <th>Sum Of BV</th>
    <th>Date</th>
    
    
    
    <th>View More</th>
   
    
    </tr>
    </thead>
    <tbody class="addlist">
  <?php

$user = $this->input->post('user');
$att = '';
if($user != '')
$att .= " and c_username='$user' ";
 $TG = 0;$TBV=0;

if($from_date != '' && $to_date!='')
   {
       $fromdate=date('Y-m-d',strtotime($from_date));
        $todate=date('Y-m-d',strtotime($to_date));
        
        $att .= " and  DATE_FORMAT(d_date, '%Y-%m-%d')BETWEEN '$fromdate' AND '$todate' ";
       
   }
  $count=0;
        $sql = "select n_order_id,sum(bv*n_quantity) sum_bv,d_date,n_id,c_invoice_no,c_package from cart_order_detail c,bc_master b 
           where c.n_id=b.pn_id  and c_mode_of_payment='Shop Purchase' and c_order_status!='REJECTED' ".$att."  group by n_order_id"; 
        $query = $this->db->query($sql);
        $result =   $query->result();
        if($result)
        {
            foreach($result as $row1)
            {
                $count=$count+1;
                $n_order_id         =$row1->n_order_id;
                $bv                 =$row1->sum_bv;
                $d_date             =$row1->d_date;
                $n_id               =$row1->n_id;
                $c_invoice_no       =$row1->c_invoice_no;
                $c_package          =$row1->c_package;

                $sql = "select n_shipping_charge,n_grand_total,n_discount from cart_grand_total where n_order_id='$n_order_id'"; 
                $query = $this->db->query($sql);
                $result =   $query->result();
                if($result)
                {
                    foreach($result as $row)
                    {
                        $n_grand_total        =$row->n_grand_total;
                        $n_discount           =$row->n_discount;
                        $n_shipping_charge    =$row->n_shipping_charge;
                       
                    }
                }

                $sql = "select c_username,C_FNAME,N_REF_ID from bc_master,address_dtl where pn_id=n_id and n_id=$n_id"; 
                $query = $this->db->query($sql);
                $result =   $query->result();
                if($result)
                {
                    foreach($result as $row)
                    {
                        $c_username     =$row->c_username;
                        $C_FNAME        =$row->C_FNAME;
                         $N_REF_ID       =$row->N_REF_ID;
                       
                       
                    }
                }
                
                $sql = "select c_username,C_FNAME from bc_master,address_dtl where pn_id=n_id and n_id=$N_REF_ID"; 
                $query = $this->db->query($sql);
                $result =   $query->result();
                if($result)
                {
                    foreach($result as $row)
                    {
                        $REFc_username     =$row->c_username;
                        $REFC_FNAME        =$row->C_FNAME;
                        
                       
                       
                    }
                }
              
      
      $date = date("d-m-Y", strtotime($d_date));
     $TG =$TG+ $n_grand_total;
    $TBV=$TBV+$bv;
    
    
    if($c_package == 'Package')
      $color = "style='border:3px solid green'";    
      else
       $color ='';
     ?>
    
   <tr <?php echo $color ?>>
    <td><?php echo $count?></td>
    <td><?php echo $n_order_id?></td>
    <td><?php 
    
    if($c_package == 'Package')
      echo 'YES';
    else
       echo 'NO';
     
     
     echo '<br>';
     
    
    ?>
    Sponsor : <?php   echo $REFc_username  ?>
    <br>
    <?php   echo $REFC_FNAME  ?>
    </td>
    <td>Username:<?php echo  $c_username?><br>Name:<?php echo $C_FNAME?></td>
    <td><?php echo $c_invoice_no ?></td>
    <td><?php echo $n_grand_total ?></td>
    <td><?php echo $bv ?></td>
    <td><?php echo $date ?></td>
   
   <td><button type="button" class="btn btn-primary btn-sm viewmodal" id="<?php echo $n_order_id;?>" data_val="<?php echo $n_order_id;?>" onclick="send_process(<?php echo $n_order_id; ?>)" >View More</button></td>
   </tr>
    
      <?php }
  }?>
  </tbody>
  <tfoot>
        
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><b>Total</b></td>
    <td><b><?php echo $TG ?></b></td>
    <td><b><?php echo $TBV ?></b></td>
    <td></td>
   
   <td></td>
   </tr>
  </tfoot>
    </table>
   
    </div>
  </div>
 
    
    
    </div>
    
   
    </div>
    </div>
    <!-- /.box-body --> 
    <!--  <div class="box-footer">
    
    </div>--> 
    <!-- /.box-footer--> 
    </div>
    <!-- /.box --> 
    
    <!-- /.content --> 
    </div>
    
    <!-- /.control-sidebar --> 
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    </section>
  </div>
  

  
  
  
  
    <!-- ./wrapper -->
    <link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo member_path ?>bower_components/select2/dist/css/select2.min.css">
    <!-- jQuery 3 --> 
    <script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script> 
    <!-- Bootstrap 3.3.7 --> 
    <script src="<?php echo member_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 
    <script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script> 
    <!-- SlimScroll --> 
    <script src="<?php echo member_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> 
    <!-- FastClick --> 
    <script src="<?php echo member_path ?>bower_components/fastclick/lib/fastclick.js"></script> 
    <!-- AdminLTE App --> 
    <script src="<?php echo member_path ?>dist/js/adminlte.min.js"></script> 
    <!-- AdminLTE for demo purposes --> 
    <script src="<?php echo member_path ?>dist/js/demo.js"></script> 
    <script type="text/javascript" src="<?php echo member_path ?>js/jquery.fancybox.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo member_path ?>css/jquery.fancybox.css" media="screen" />
    <script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script> 
    <script src="<?php echo member_path ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <link rel="stylesheet" href="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="<?php echo member_path ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 
    <script>
      applyPagination();
       var k=0;  var start = 0;
    $(document).ready(function () {

      
    $('#bill_date').datepicker({
    autoclose: true,
    });
    $('#n_fromdate').datepicker({
    autoclose: true,
    });
    $('#n_todate').datepicker({
    autoclose: true
    });
    
    $('.select2').select2()
    applyPagination();
    $('.sidebar-menu').tree();
    $('.fancybox').fancybox();
    
   /* $("#search").keyup(function(){
    var  search=$("#search").val(); 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('purchase') ?>",
    data: {search:search,ajax:1},
    success: function (msd)
    {
    $(".list").html(msd);
    }
    });
    });*/
    
  
    
    });


function send_process(n_order_id)
{
    $('#myModal').modal('show'); 
    $.ajax({
                        url: '<?php echo base_url();?>product_modal',
                        type: 'post',
                        data: {n_order_id: n_order_id},
                        success:function(data)
                        {
                            $('#result').html(data)
                        }
        
        
        
        
    });
    
    
}
    
     
    </script>
    </body></html><style>
    ul.tsc_pagination {
    margin:4px 0;
    padding:0px;
    height:100%;
    overflow:hidden;
    font:12px 'Tahoma';
    list-style-type:none;
    }
    ul.tsc_pagination li {
    float:left;
    margin:0px;
    padding:0px;
    margin-left:5px;
    }
    ul.tsc_pagination li a {
    color:black;
    display:block;
    text-decoration:none;
    padding:7px 10px 7px 10px;
    }
    ul.tsc_paginationA li a {
    color:#FFFFFF;
    border-radius:3px;
    -moz-border-radius:3px;
    -webkit-border-radius:3px;
    }
    ul.tsc_paginationA01 li a {
    color:#fff;
    border:solid 1px #F26639;
    padding:6px 9px 6px 9px;
    background:#E6E6E6;
    background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #000);
    background: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #277c88), color-stop(0.02, #036483), color-stop(1, #569da0));
    }
    ul.tsc_paginationA01 li:hover a, ul.tsc_paginationA01 li.current a {
    background:#00a651;
    }
    .error {
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
    right: 7px;
    margin-bottom:-5px !important;
    }
    .pac-container {
    z-index: 1051 !important;
    }
    </style>
    <style>
    .search-btn {
    background-color: #e03535;
    padding: 4px 10px;
    text-align: center;
    color: #FFF;
    }
    </style>