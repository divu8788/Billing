  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Group List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Group List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Attribute Group List</h3>

        </div>
        <div class="box-body">
              <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            <div class="row">
			<form id="grpform">
			<div class="col-md-6">
                  <label for="exampleInputEmail1">Attribute Group Name</label>
                  <input type="text" class="form-control" required="" id="c_group_name" name="c_group_name" placeholder="group Name">
				   </div>
				  <div class="col-md-6">
				   <label for="exampleInputEmail1"></label>
                    <button type="submit" id="submit" class="btn btn-success" style="margin-top:23px;">Add</button>
                    <span  id="err_msgs"><font color="red"></font></span>
				  </div>
				         <?php
					if($this->session->flashdata('msg')) {
					$message = $this->session->flashdata('msg');
				 ?>
				<span ><font color="red"><?php echo $message; ?></font></span>
				<?php
														}
					?>
               </form >
				</div>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="search" id="search" required="" class="form-control pull-right" placeholder="Search">

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
                  <th>Group Name</th>
                  <th>Action</th>
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
                  <td><?php echo $rows->c_group_name; ?></td>
                <td><a href=<?php echo site_url('edit_group/'. $rows->n_id) ?>><button type="button" class="btn  btn-info" name='edit_group'>Edit</button>   </a></td>
				    <?php
				  if($rows->c_status!='A')
				  {
					  ?>
                  <td>
				 
				 <button type="button" class="btn btn-danger" id="id<?php echo $rows->n_id; ?>" onclick="activate_group(<?php echo $rows->n_id; ?>)" value="<?php echo $rows->n_id; ?>">Disabled</button></td>
				  <?php
				  }
				  else{
				  ?>
				  <td>
				   	 <button type="button" class="btn btn-success" id="id<?php echo $rows->n_id; ?>" onclick="deactivate_group(<?php echo $rows->n_id; ?>)" value="<?php echo $rows->n_id; ?>">Active</button>  </td>
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
  
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo member_path ?>bower_components/jquery/dist/jquery.validate.min.js"></script>
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
<script type="text/javascript" src="<?php echo member_path ?>js/swal.js"></script>
<script>
  $(document).ready(function () {
	   applyPagination();
    $('.sidebar-menu').tree();
    
    		$("#search").keyup(function(){
		  var  search=$("#search").val();	
	         $.ajax({
                type: "POST",
                url: "<?php echo site_url('group_list') ?>",
				data: {search:search,ajax:1},
                success: function (msd)
                        {
							$(".list").html(msd);
						}
	  });
		 });
  });
  
  
    function deactivate_group(id)
  {
	        var conf = confirm('Do you want to Deactivate?');
            if (!conf)
            return false;
            $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo site_url('admin_area/admin_area/deactivate_group') ?>',
            success: function(msg) {
		
				if(msg=="success")
				{	
				     swal({title: "Success!", type: "success", text: "Deactivated Successfully", showConfirmButton: false, timer: 2000});
					$("#id"+id).html("disabled");
					location.reload();
				}
				else
				{
					//$("#id"+id).html("Error");
					 swal({title: "Error!", type: "error", text: "error occurs", showConfirmButton: false, timer: 2000});
				}
            }
          });
  }
  
      function activate_group(id)
  {
	             var conf = confirm('Do you want to Activate?');
            if (!conf)
            return false;
            $.ajax({
            type: "POST",			  
            data:{id:id},
            url: '<?php echo site_url('admin_area/admin_area/activate_group') ?>',
            success: function(msg) {

							if(msg=="success")
				{	
				    
				     swal({title: "Success!", type: "success", text: "Activated Successfully", showConfirmButton: false, timer: 2000});
					$("#id"+id).html("Active");
					location.reload();
				}
				else
				{
				//	$("#id"+id).html("Error");
				 swal({title: "Error!", type: "error", text: "Error occurs", showConfirmButton: false, timer: 2000});
				}

            }
          });
  }

 $("#grpform").validate({
              rules:
                {
                      c_group_name:  {  required: true },

                },
				 
				  messages:
				 {
					 c_group_name:
					 {
						 required: "Group name required"
					 },
	
				 },
				 
		    	submitHandler: function ()
                  {
			
		      if($("#grpform").valid()){
		        var formData = new FormData($('#grpform')[0]); 
		     	$('#submit').attr('Disabled',true);
		     	$('#err_msgs').html("<img src='ajax-loaders/ajax-loader-1.gif' title='img/ajax-loaders/ajax-loader.gif' >");
			    $.ajax({
                type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo site_url('group_insert');?>",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
                success: function (msd)
                        {
						  if(msd == 'success'){
						  swal({title: "Success!", type: "success", text: "Added Successfully", showConfirmButton: false, timer: 2000});

								   window.location="<?php echo site_url('group_list') ?>";
						   }
						   else if(msd == 1){
							 swal({title: "Error!", type: "error", text: "Enter all fields", showConfirmButton: false, timer: 2000});
							$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else if(msd == 2){
							  swal({title: "Error!", type: "error", text: "Already Added..!", showConfirmButton: false, timer: 2000});
							$('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   else{
                                  swal({title: "Error!", type: "error", text: "Some error occurs.. Try after sometimes..", showConfirmButton: false, timer: 2000});
                            $('#submit').attr('Disabled',false);
							$('#err_msgs').html("");
						   }
						   
						}
			});
				  
         }
		}
				  
      
    });

  
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
