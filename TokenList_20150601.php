<?php
  include_once 'ApplicationHeader.php'; 
  if(!$oCustomer->isLoggedIn())
  {
	header("Location: login.php");
  }
  $aCustomerInfo = $oSession->getSession('sesCustomerInfo');
  $aRequest = $_REQUEST;
  $allResult = $oMaster->getFuelTokenList();
/* echo '<pre>';
  print_r( $allResult );
  echo '</pre>';
  exit();*/
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>EAMS|Fuel Token List </title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta http-equiv="Cache-control" content="No-Cache">
  <?php include('Stylesheets.php');?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<?php include_once 'Header.php'; ?>
	<!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
        <?php include_once 'LeftMenu.php'; ?>
		<!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div class="page-content">
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <div id="portlet-config" class="modal hide">
            <div class="modal-header">
               <button data-dismiss="modal" class="close" type="button"></button>
               <h3>portlet Settings</h3>
            </div>
            <div class="modal-body">
               <p>Here will be a configuration form</p>
            </div>
         </div>
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN STYLE CUSTOMIZER -->
                 
                  <!-- END STYLE CUSTOMIZER -->  
                  <h3 class="page-title">
                     Fuel  
                     <small>Fuel Token master</small>
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="index.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Transport</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Fuel </a></li>
                  </ul>
               </div>
            </div>
            
                              <?php
							     if(isset($aRequest['msg']))
								 {
							   ?>
							    <div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<?php
									if($aRequest['msg'] == 'success')
									{
										echo $msg = 'New Fuel Token Added Successfully';
									}
									else if($aRequest['msg'] == 'updatesucess')
									{
										echo $msg = 'Fuel Token Updated Successfully';
									}
									else if($aRequest['msg'] =='delsuccess')
									{
										echo $msg = 'Fuel Token Deleted Successfully';
									}
									else if($aRequest['msg'] =='undelsuccess')
									{
										echo $msg = 'This Fuel is parent, so we can not delete';
									}
									?>
								</div>
								<?php
								  }
								?> 
                              
                                
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            
            <!-- BEGIN PAGE CONTENT-->
									<div class="row-fluid">
									<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-globe"></i>Fuel Token Master</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix">
                                  <div class="btn-group">
                                  <a href="TokenEdit.php?action=Add"  role="button" class="btn green" data-toggle="modal">Add Token <i class="icon-plus"></i></a>								
							      </div>
								</div>
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th>S.No</th>
                                            <th>Asset Number</th>
                                            <th>Vehicle Number</th>
                                            <th>Vehicle</th>
                                            <th>Fuel Type</th>
                                            <th>Fuel Qty</th>
                                            <th>Oil Qty</th>
                                            <th>Employee Name</th>
                                            <th>Vendor Name</th>
                                            <th>Date</th>
                                            <th>Action</th>	
										</tr>
									</thead>
									<tbody>
                                    	<?php 
										$a=1;
										foreach ($allResult as $item){ ?>
                                       
										<tr class="odd gradeX">
                                            <td><?php echo $a; ?></td>
											<td><?php echo $item['asset_no']; ?></td>
											<td><?php echo $item['machine_no']; ?></td>
                                           	<td><?php echo $item['item_name']; ?></td>
                                            <td><?php $aFueltype = $oUtil->getFuelType1();
											$fuel = $item['id_fuel_type'];
											echo $aFueltype[$fuel];  ?></td>
                                            <td><?php echo $item['qty'].' Lt';  ?></td>
                                            <td><?php echo $item['oil_qty']; ?></td>
                                            <td><?php echo $item['first_name'].'&nbsp;'.$item['last_name']; ?></td>
                                            <td><?php echo $item['vendor_name']; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($item['token_date'])); ?></td>
                                           	<td>
                                            <div class="flash" id="flash_<?php echo  $item['id_fuel_token']; ?>"></div>
                                      <a href="TokenEdit.php?id=<?php echo  $item['id_fuel_token']; ?>&action=edit" class="btn mini purple"><i class="icon-edit"></i>Edit</a> &nbsp; &nbsp;
                                            
                                            <?php /*?> <?php if($item['status']!=2)
											{
											?>
                                            <a  class="delete btn mini black" href="javascript:void()" onclick=deleteBox('<?php echo  $item['id_fuel']; ?>','fueldelete','Move')><i class="icon-trash"></i>Delete</a>   
                                           <?php } else { ?>
										      <a  class="delete btn mini red" href="javascript:void()" onclick=deleteBox('<?php echo  $item['id_fuel']; ?>','fueldelete','Permanent')><i class="icon-trash"></i>Delete</a>   
										   	<?php } ?> <?php */?>
                                           
                                            </td>
                                          
										</tr>
                                        <?php $a++; } ?>
										
									</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
									</div>
				
									<!-- END PAGE CONTENT-->
            
            
            
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      
      
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
	<?php include_once 'Footer1.php'; ?>
    
</body>
<!-- END BODY -->
</html>