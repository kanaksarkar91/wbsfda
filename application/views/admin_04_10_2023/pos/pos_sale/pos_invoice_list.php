        <div class="app-content pt-3 p-md-3 p-lg-3">
           
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>
               <div class="alert alert-success">
                     <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>

                <div class="row g-3 mb-2 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">POS <?php echo $pos_invoice_list[0]['cost_center_name']?> Outstanding Receivable List</h1>
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

                <div class="app-card app-card-orders-table shadow-sm mb-5" id="divShow">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="pos_invoice_list">
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
                                    if(!empty($pos_invoice_list)){
                                        $i = 0;
                                    	foreach($pos_invoice_list as $row) {
										
										$due_amount = ($row['net_bill_amount'] - $row['paid_amount']);
								?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?=$row['order_generate_time']?></td>
										<td class="cell"><?=$row['invoice_no']?></td>
                                        <td class="cell"><?=$row['cost_center_name']?></td>
                                        <td class="cell"><?=$row['table_no']?></td>
										<td class="cell"><?=$row['payment_mode']?></td>
										<td class="cell text-end"><?=$row['net_bill_amount']?></td>
										<td class="cell text-end"><?=$row['paid_amount']?></td>
                                        <td class="cell text-center">
										<?php
										if($due_amount != 0){
										?>
                                            <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/pos/receive_against_pos/' . encode_url($row['sale_order_id']));?>">Receive</a>
											
											<button class="btn-sm btn-danger text-white cancel_pos_invoice" data-sale-order-id="<?php echo $row['sale_order_id'];?>">Cancel</button>
										<?php
										}
										else{
											echo '<span class="badge bg-success">Paid</span>';
										}
										?>
                                        </td>
                                    </tr>
                                    <?php 
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
                
<script>
 $(document).ready(function() {
	setTimeout(function() {
		$("#divShow").load();
	}, 5000);
	
	
	$('#pos_invoice_list').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
		"pageLength": 50,
       // "searching": false
        
    } );
	
	$(document).on("click",".cancel_pos_invoice",function() {
			
		var tHis = $(this);
		var sale_order_id = $(this).data('sale-order-id');
		
		$.confirm({
			title: "Confirm!!",
			content: "Do you really want to Cancel the Invoice?",
			buttons: {
				Yes: {
					btnClass: 'btn-green',
						action: function(){
							
							tHis.html('<i class="fa fa-spinner fa-spin"></i>Wait..');

							$.ajax({
								type: 'POST',	
								url: "<?php echo base_url('admin/pos/cancel_pos_invoice'); ?>",
								data: {csrf_test_name: '<?php echo $this->csrf['hash']; ?>', sale_order_id:sale_order_id},
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
</script>