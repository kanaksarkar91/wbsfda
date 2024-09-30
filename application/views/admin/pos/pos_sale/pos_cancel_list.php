        <div class="app-content pt-3 p-md-3 p-lg-3">
           
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>
               <div class="alert alert-success">
                     <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?= $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?= $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>

                <div class="row g-3 mb-2 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">&nbsp;</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->
				
				<div class="app-card app-card-orders-table shadow-sm mb-3">
					<div class="app-card-body p-3">
		
		
						<form action="" class="row g-2" method="post">
						<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
						
							<div class="col-lg-4 col-sm-12 col-md-6 mb-3" data-select2-id="8">
								<label for="" class="form-label">Guest Houses <span class="asterisk"></span></label>
								<select class="form-select select2" name="property" required onchange="populate_cost_center(this.value)">
									<option value="">Select Property</option>
									<?php

									if (isset($properties))
										foreach ($properties as $p) {

									?>
									<option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-lg-4 col-sm-12 col-md-6 mb-3" data-select2-id="26">
								<label for="" class="form-label">POS <span class="asterisk"></span></label>
								<select name="cost_center_id" id="cost_center_id" class="form-select">
									<option value="">Select POS</option>
									<?php

									if (isset($cost_centers))
										foreach ($cost_centers as $cc) {

									?>
									<option value="<?= $cc['cost_center_id']; ?>" <?= set_select('cost_center_id', $cc['cost_center_id'], isset($cost_center_id) && $cost_center_id == $cc['cost_center_id'] ? true : false); ?>><?= $cc['cost_center_name']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-lg-2 col-sm-12 col-md-6 mb-3">
								<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search"
									value="Search">
							</div>
						</form>
		
		
					</div>
		
				</div>

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="pos_cancel_list">
                                <thead>
                                    <tr>
                                    	<th class="cell">SL No.</th>
                                        <th class="cell">Date</th>
										<th class="cell">Invoice No.</th>
                                        <th class="cell">POS</th>
                                        <th class="cell">Table No.</th>
                                        <th class="cell">Payment Mode</th>
										<th class="cell">Receivable</th>
										<th class="cell">Received</th>
										<th class="cell">Action / Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($lists)){
                                        $i = 0;
                                    	foreach($lists as $row) {
										
										$net_bill_amount = round($row['net_bill_amount']);
										$paid_amount = round($row['paid_amount']);
										$due_amount = ($net_bill_amount - $paid_amount);
										
										if($paid_amount <= 0){
								?>
										<tr>
											<td class="cell"><?=++$i;?></td>
											<td class="cell"><?=$row['order_generate_time'];?></td>
											<td class="cell"><?=$row['invoice_no'];?></td>
											<td class="cell"><?=$row['cost_center_name'];?></td>
											<td class="cell"><?=$row['table_no'];?></td>
											<td class="cell"><?=$row['payment_mode'];?></td>
											<td class="cell text-end"><?=number_format($net_bill_amount,2);?></td>
											<td class="cell text-end"><?=number_format($paid_amount,2);?></td>
											<td class="cell text-center">
												<button class="btn-sm btn-danger text-white open_cancel_modal" data-sale-order-id="<?= $row['sale_order_id'];?>">Cancel</button>
												
											</td>
										</tr>
                                    <?php
											}
										} 
                                    } 
									?>
                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>
            </div>
            <!--//container-fluid-->
        </div>
		
		
		<div class="modal fade right" id="cancel_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Cancellation Remarks</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-body">
			  	<div class="row g-3">
					<div class="col-lg-12 col-sm-12 col-md-6">
						<textarea class="form-control" name="cancel_remarks" id="cancel_remarks" rows="5" required></textarea>
						<input type="hidden" name="sale_order_id" id="sale_order_id" value=""  />                              
					</div>
					
					<div class="col-12" style="text-align:right;">
						<button type="submit" class="btn app-btn-primary cancel_pos_invoice">SUBMIT</button>
					</div>
				</div>
			  </div>
			 
			</div>
		  </div>
		</div>
                
<script>
 $(document).ready(function() {
    $('#pos_cancel_list').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
		"pageLength": 50,
       // "searching": false
        
    } );
	
	
	$(document).on("click",".open_cancel_modal",function() {
		var sale_order_id = $(this).data("sale-order-id");
		$("#sale_order_id").val(sale_order_id);
		console.log(sale_order_id);
		$('#cancel_popup').modal('toggle');
	});
	
	
	$(document).on("click",".cancel_pos_invoice",function() {
			
		var tHis = $(this);
		var sale_order_id = $("#sale_order_id").val();
		var cancel_remarks = $("#cancel_remarks").val();
		
		$.confirm({
			title: "Confirm!!",
			content: "Do you really want to Cancel the Invoice?",
			buttons: {
				Yes: {
					btnClass: 'btn-green',
						action: function(){
							
							if (!$("#cancel_remarks").val()) {

								$.alert({
									title: 'Alert!',
									content: 'Please enter remarks',
									type: 'red',
									typeAnimated: true,
								})
								return false;
							}
							
							tHis.html('<i class="fa fa-spinner fa-spin"></i>Wait..');

							$.ajax({
								type: 'POST',	
								url: "<?= base_url('admin/pos/cancel_pos_invoice'); ?>",
								data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', sale_order_id:sale_order_id, cancel_remarks: cancel_remarks},
								dataType: 'json',
								encode: true,
								async: false
							})
							//ajax response
							.done(function(data){

								if(data.status == true){

									setTimeout(function () {
										
										$.confirm({

											title: "Alert!!",
											content: "Successfully Canceled.",
											buttons: {
												Ok: {
													btnClass: 'btn-red',
													action: function(){
														tHis.text('Cancel');
														location.reload();                                       
													}
												}
											}

										}); 

									}, 2000);                                       

								} else {
									setTimeout(function () {
										
										$.confirm({

											title: "Alert!!",
											content: "Something is Wrong. Try again.",
											buttons: {
												Ok: {
													btnClass: 'btn-red',
													action: function(){
														tHis.text('Cancel');                                       
													}
												}
											}

										}); 

									}, 2000);
								}           
								
							})
							.fail(function(data){
								// show the any errors
								console.log(data);
							});                                       
						}
				},
				No: {
					btnClass: 'btn-red',
						action: function(){
							//e.preventDefault();
							//return false;
						}
				}
			}
		});
		
	});
} );



function populate_cost_center(property_id){
	var result='';
	$.ajax({
		type: 'GET',	
		url: "<?= base_url('admin/pos/getCostCenterByProperty'); ?>",
		data: {
			'property_id':property_id
		},
		dataType: 'json',
		encode: true,
		async: false
	})
	.done(function(data){
		if(data.status){
			result +='<option value="">Select POS</option>';
			$.each(data.list,function(key,value){
				var selected_txt='';
				result +='<option value="'+value.cost_center_id+'">'+value.cost_center_name+'</option>';
			});
		}
		else{
			result +='<option value="">No POS selected</option>'
		}
		$("#cost_center_id").html(result);
	
	})
	.fail(function(data){
		// show the any errors
		console.log(data);
	});
}
</script>