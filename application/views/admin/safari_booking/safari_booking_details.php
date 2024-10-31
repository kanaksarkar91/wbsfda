<style>
.error{
color:#CC0000 !important;
}
.form-control-refund-amt {
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>

<div class="app-content pt-3 p-md-3 p-lg-4">
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

            <div class="row gy-4">
                    <div class="col-6 mb-2">
                <h1 class="app-page-title">Booking Details</h1> 
                    </div>
                <div class="col-6 mb-2" style="text-align: right;">
                <!--<a href="<?=base_url('admin/reservation')?>" class="btn app-btn-primary">Back to Reservations</a>-->
                    </div>
                    </div>
                
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="row app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="col-12 py-3">
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th width="15%">Booking No.</th>
                                        <td width="35%"><?=(isset($booking_details[0]['booking_number'])?$booking_details[0]['booking_number']:'')?></td>
                                        <th width="15%">Booking Date</th>
                                        <td width="35%"><?=(isset($booking_details[0]['created_ts'])?date('d-m-Y h:i A',strtotime($booking_details[0]['created_ts'])):'')?></td>
                                    </tr>
                                    <tr>
                                        <th width="15%"><?= ($booking_details[0]['first_name'] != '') ? 'Guest Name' : 'Company Name';?></th>
                                        <td width="35%"><?= ($booking_details[0]['first_name'] != '') ? $booking_details[0]['first_name']." ".$booking_details[0]['last_name'] : $booking_details[0]['company_name']; ?></td>
                                        
										<th width="15%"><?= ($booking_details[0]['mobile'] != '') ? 'Mobile No.' : 'Company Phone';?></th>
                                        <td width="35%"><?= ($booking_details[0]['mobile'] != '') ? $booking_details[0]['mobile'] : $booking_details[0]['company_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Safari date</th>
                                        <td><?=(isset($booking_details[0]['booking_date'])?date('d-m-Y',strtotime($booking_details[0]['booking_date'])):'')?></td>
                                        <th>Payable Amount</th>
                                        <td><?=(isset($booking_payment_details)?formatIndianCurrency($booking_payment_details['amount']):'0.00');?></td>
                                    </tr>
                                    <tr>
                                        <th>Booking Status</th>
                                        <td><span class="text-success"><?=(isset($booking_details[0]['booking_status'])?(($booking_details[0]['booking_status'] =='I')?'Initiated':(($booking_details[0]['booking_status'] =='C')?'Cancelled':(($booking_details[0]['booking_status'] =='A')?'Approved':(($booking_details[0]['booking_status'] =='F')?'Payment Failed':($booking_details[0]['booking_status'] =='O' ? 'Check-Out' : '')))   )):'')?></span></td>
                                        <th>Adults/Child</th>
                                        <td><?= (isset($booking_details[0]['no_of_person'])?$booking_details[0]['no_of_person']:'').' / '.(isset($booking_details[0]['child_count'])?$booking_details[0]['child_count']:0);?></td>
                                    </tr>
									
                                </table>
								
								<div>Payment Information</div>
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Mode</th>
                                        <th>Processed / Taken by</th>
                                        <th>Payment ID</th>
                                        <th>Date & Time</th>
                                        <th>Amount Paid</th>
                                    </tr>
                                    <tr>
                                        <td>Online</td>
                                        <td>Internet Payment Gateway</td>
                                        <td><?= (isset($booking_payment_details)?$booking_payment_details['razorpay_payment_id']:'');?></td>
                                        <td><?= (isset($booking_payment_details)?date('d-m-Y H:i', strtotime($booking_payment_details['payment_date'])):'');?></td>
                                        <td style="text-align:right;"><?= (isset($booking_payment_details)?formatIndianCurrency($booking_payment_details['amount']):'0.00');?></td>
                                    </tr>
                                </table>
								
								<div>Visitor's Information</div>
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Sl.</th>
										<th>Visitor's Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>ID Card Type</th>
                                        <th>ID Card No.</th>
										<th>Status</th>
										<?php if($booking_details[0]['booking_status'] === 'A' && $cancel_button_visible === "Yes" && $calcelButtonShowing === true){ ?><th>Action</th> <?php } ?>
                                    </tr>
									<?php
									if(!empty($booking_details[0]['booking_details'])){
										foreach($booking_details[0]['booking_details'] as $row){
									?>
										<tr>
											<td><?= ++$sl;?></td>
											<td><?= $row['visitor_name'];?></td>
											<td><?= $row['visitor_gender'];?></td>
											<td><?= $row['visitor_age'];?></td>
											<td><?= $row['visitor_id_type'];?></td>
											<td><?= str_pad(substr($row['visitor_id_no'], -4), strlen($row['visitor_id_no']), 'x', STR_PAD_LEFT); ?></td>
											<td><?= $row['is_status'] == 1 ? '<span class="badge bg-success">Confirmed</span>' : '<span class="badge bg-danger">Cancelled</span>';?></td>
											<?php if($booking_details[0]['booking_status'] === 'A' && $cancel_button_visible === "Yes" && $calcelButtonShowing === true){ ?>
											<td style="text-align:center;">
											<?php
											if($row['is_status'] == 1){
											?>
											<input class="form-check-input checkbox" type="checkbox" name="safari_booking_detail_id[]" value="<?= $row['safari_booking_detail_id'];?>">
											<input type="hidden" id="is_free<?= $row['safari_booking_detail_id'];?>" value="<?=$row['is_free']?>">
											<input type="hidden" id="visitor_age<?= $row['safari_booking_detail_id'];?>" value="<?=$row['visitor_age']?>">
											<?php } ?>
											</td>
											<?php } ?>
										</tr>
									<?php } } ?>
                                </table>
                                

                                <table class="mb-3 w-100 table-sm table table-bordered" style="text-align:center;">
									<tr>
											<input type="hidden" id="booking_id" name="booking_id" value="<?= encode_url($booking_details[0]['booking_id']);?>">
											<?php 
											if($booking_details[0]['booking_status'] === 'A' && $cancel_button_visible === "Yes" && $calcelButtonShowing === true){
												if($booking_details[0]['source'] == 'F'){
											?>
												<td style="padding: 2px;">
												<h4>Cancellation Information</h4><br>
												<h6 id="cancelPercent"></h6>
												<h6 id="cancelCharge"></h6>
												<h6 id="actualRefundAmt"></h6>
												<h6 id="refundAmt"></h6>
												
												<textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancellation Reason" rows="4" cols="50" style="width:100%;"></textarea><br>
												<input type="hidden" id="paid_amount" name="paid_amount" value="<?=$booking_details[0]['base_price']?>">
												<input type="hidden" id="cancel_percent" name="cancel_percent" value="<?=$cancel_percent?>">
												<input type="hidden" id="cancel_charge" name="cancel_charge" value="<?=$cancel_charge?>">
												<input type="hidden" id="safari_net_amount" name="safari_net_amount" value="<?=$basePrice;?>">
												
												<?php
												if(isset($booking_details[0]['booking_status']) && !empty($booking_payment_details) && $booking_details[0]['booking_status'] === 'A' && $cancel_button_visible === "Yes" && $calcelButtonShowing === true){
												?>
												<input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px; margin-right:10px;" value="Cancel Safari" class="btn app-btn-danger"> 
												<?php } ?> 
												</td>
											<?php 
												}
											}
											?>
									</tr>
								</table>
								
								
								
								
								<?php if(!empty($cancellation_request_details)){ ?>
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Cancellation Date</th>
										<th>Cancelled By</th>
										<th>No. of Person</th>
                                        <th>Cancellation Remarks</th>
                                        <th>Cancellation Rate(%)</th>
                                        <th>Cancellation Charge</th>
                                        <th>Refund Amount</th>
                                        <th>Refund Status</th>
                                    </tr>
                                    <?php foreach($cancellation_request_details as $crow) { ?>
                                    <tr>
                                        
                                        <td><?=date('d-m-Y h:i A',strtotime($crow['created_ts']));?></td>
										<td><?=$crow['created_by_name'];?></td>
										<td><?=$crow['no_of_person_cancelled'];?></td>
                                        <td><?=$crow['cancellation_remarks'];?></td>
                                        <td class="text-end"><?=$crow['cancel_percent'];?></td>
                                        <td class="text-end"><?=formatIndianCurrency($crow['cancel_charge']);?></td>
                                        <td class="text-end"><?=formatIndianCurrency($crow['refund_amt']);?></td>
                                        <td><?= ($crow['is_refunded'] == '1') ? '<span class="badge bg-success">Refunded</span>' :'<span class="badge bg-primary">Refund in process</span>';?></td>
                                        
                                    </tr>
									<?php } ?>
                                    
                                </table>
                                <?php } ?>

                            </div>
                        </div>
                        <!--//app-card-->
                    </div>
                </div>
                <!--//row-->

            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->
		

<script>
const booking_id = <?= $booking_details[0]['booking_id'] ?>;
$(document).ready(function(){
	
	$(document).on("click",".checkbox",function() {
			
		var tHis = $(this);
		var isChecked = false;
		var checkedValues = [];
		var isFreeValues = [];
		var booking_id = $("#booking_id").val();
		// Iterate through each checked checkbox
		$('.checkbox:checked').each(function() {
			if($(this).is(':checked')){
				isChecked = true;
				checkedValues.push($(this).val());
				isFreeValues.push($('#is_free'+$(this).val()).val());
			}
			
		});
		
		console.log(isFreeValues);
		
		  $.ajax({
			type:'POST',
			url:"<?php echo base_url('cancellation-information'); ?>",
			data:{safari_booking_detail_ids: checkedValues, booking_id: booking_id, is_frees: isFreeValues, csrf_test_name: '<?= $this->csrf['hash']; ?>'},
			dataType: 'json',
			encode: true,
			success:function(d){
			  if(d.success){
				/*$("#cancelPercent").html('Cancellation Percent (%) :'+ d.cancel_percent);
				$("#cancelCharge").html('Cancellation Charge (Rs.) :'+ d.cancel_charge);
				$("#refundAmt").html('Refund Amount (Rs.) : <input type="text" class="form-control-refund-amt" style="width:10%;" id="refund_amt" name="refund_amt" value="'+d.refund_amt+'">');*/
				$("#cancelPercent").html('Cancellation Rate (%) : 0');
				$("#cancelCharge").html('Cancellation Charge (Rs.) : 0.00');
				$("#actualRefundAmt").html('Actual Refund Amount (Rs.) :'+ d.basePrice);
				$("#refundAmt").html('Refund Amount (Rs.) : <input type="text" class="form-control-refund-amt" style="width:10%;" id="refund_amt" name="refund_amt" value="'+d.basePrice+'">');
				
				/*$("#cancel_percent").val(d.cancel_percent);
				$("#cancel_charge").val(d.cancel_charge);
				$("#refund_amt").val(d.refund_amt);*/
				$("#cancel_percent").val('0');
				$("#cancel_charge").val('0.00');
				$("#refund_amt").val(d.basePrice);
				$("#safari_net_amount").val(d.basePrice);
			  }else{
				
			  }
			}
		  });
	});
	
	$('body').on('keyup keypress paste','#refund_amt',function(e){
		var refund_amt = $("#refund_amt").val();
		var safari_net_amount = $("#safari_net_amount").val();
		
		var temp_cancellation_amount = parseFloat(safari_net_amount - refund_amt).toFixed(2);
		var cancellation_amount = (temp_cancellation_amount < 0) ? '0' : temp_cancellation_amount;
		var cancellation_amount_for_percentage = parseFloat(safari_net_amount - refund_amt).toFixed(2);
		var temp_cancel_percentage = parseFloat((cancellation_amount_for_percentage / safari_net_amount) * 100).toFixed(2);
		var cancel_percentage = (temp_cancel_percentage < 0) ? '0' : temp_cancel_percentage;
		
		$("#cancelPercent").html('Cancellation Rate (%) :'+ cancel_percentage);
		$("#cancelCharge").html('Cancellation Charge (Rs.) :'+ cancellation_amount);
				
		$("#cancel_charge").val(cancellation_amount);
		$("#cancel_percent").val(cancel_percentage);
	});
	
	
	$(document).on('click', "#cancel_booking_btn", function() {
		var booking_id = $("#booking_id").val();
		var cancel_remarks = $("#cancel_remarks").val();
		var paid_amount = $("#paid_amount").val();
		var safari_net_amount = $("#safari_net_amount").val();
		var cancel_percent = $("#cancel_percent").val();
		var cancel_charge = $("#cancel_charge").val();
		var refund_amt = $("#refund_amt").val();
		
		var tHis = $(this);
		var isChecked = false;
		var checkedValues = [];
		var checkedAgeValues = [];
		var isFreeValues = [];
		// Iterate through each checked checkbox
		$('.checkbox:checked').each(function() {
			if($(this).is(':checked')){
				isChecked = true;
				checkedValues.push($(this).val());
				checkedAgeValues.push($('#visitor_age'+$(this).val()).val());
				isFreeValues.push($('#is_free'+$(this).val()).val());
			}
			
		});
		
		// Get the PHP string into JavaScript
		var visitorAgesString = '<?= $visitorAges; ?>';
		
		var visitorAgesArray = visitorAgesString.split(",").map(Number); // Convert string to array
		
		var array2Numeric = checkedAgeValues.map(function(value) {
			return parseInt(value);
		});
		var newArray = [...visitorAgesArray]; 
		// Function to remove elements from newArray based on the count in array2
		array2Numeric.forEach(function(value) {
			var index = newArray.indexOf(value);  // Find the index of the value in newArray
			if (index !== -1) {
				newArray.splice(index, 1);  // Remove the element at that index
			}
		});
		
		console.log(newArray);
		
		var hasValueGreaterThan18 = newArray.some(function(value) {
			return parseInt(value) >= <?= ADULT_AGE;?>;
		});
		
		// Get the count of elements in the first array
		var arrayLength = visitorAgesArray.length;
		var arrayLength2 = array2Numeric.length;
		var no_of_visitor = '<?= $booking_details[0]['no_of_person'];?>';
		
		if(!isChecked){
			Swal.fire({
			  icon: 'error',
			  title: 'Please check at least one visitor!!',
			  confirmButtonText:'Ok',
			  confirmButtonColor:'#69da68',
			  allowOutsideClick: false,
			});
			return false;
		}
		
		if(arrayLength != arrayLength2){//partial cancellation
			if (!hasValueGreaterThan18) {
				Swal.fire({
				  icon: 'error',
				  title: 'No adults are present on this booking!!',
				  confirmButtonText:'Ok',
				  confirmButtonColor:'#69da68',
				  allowOutsideClick: false,
				});
				return false;
			}
		}
		
		if(refund_amt > safari_net_amount){
			if (!hasValueGreaterThan18) {
				Swal.fire({
				  icon: 'error',
				  title: 'The refund amount is more than the actual amount!!',
				  confirmButtonText:'Ok',
				  confirmButtonColor:'#69da68',
				  allowOutsideClick: false,
				});
				return false;
			}
		}
	
		if (!cancel_remarks) {
			Swal.fire({
				icon: 'error',
				title: 'Please enter cancellation reason!!',
				confirmButtonText: 'Ok',
				confirmButtonColor: '#69da68',
				allowOutsideClick: false,
			});
			return false;
		}
	
		// Confirmation before making the AJAX call
		Swal.fire({
			title: 'Are you sure you want to cancel the safari?',
			text: "This action cannot be undone.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, cancel it!',
			cancelButtonText: 'No, keep it',
			allowOutsideClick: false,
		}).then((result) => {
			if (result.isConfirmed) {
				
				$("#cancel_booking_btn").prop('disabled',true);
				$("#cancel_booking_btn").val('Processing...');
				// User confirmed, proceed with the AJAX call
				$.ajax({
					type: 'POST',
					url: '<?= base_url('admin/safari_booking/cancelSafariBooking'); ?>',
					data: {
						csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
						booking_id: booking_id,
						cancel_remarks : cancel_remarks,
						paid_amount : paid_amount,
						cancel_percent : cancel_percent,
						cancel_charge : cancel_charge,
						refund_amt : refund_amt,
						safari_booking_detail_ids: checkedValues,
						visitor_ages: checkedAgeValues,
						is_free: isFreeValues,
					},
					dataType: 'json',
					encode: true,
					//async: false,
					/*beforeSend:function(){
						$("#cancel_booking_btn").html('<i class="fa fa-spinner fa-spin"></i>Wait..');
					 },*/
				})
				.done(function(response) {
					if (response.status) {
						$("#cancel_booking_btn").prop('disabled',false);
						$("#cancel_booking_btn").val('Cancel Booking');
						Swal.fire({
							icon: 'success',
							title: response.msg,
							confirmButtonText: 'Ok',
							confirmButtonColor: '#69da68',
							allowOutsideClick: false,
						}).then(result => {
							if (result.value) {
								location.reload();
							}
						});
					} else {
						$("#cancel_booking_btn").prop('disabled',false);
						$("#cancel_booking_btn").val('Cancel Booking');
						
						Swal.fire({
							icon: 'error',
							title: response.msg,
							confirmButtonText: 'Ok',
							confirmButtonColor: '#69da68',
							allowOutsideClick: false,
						});
					}
				});
			}
		});
	});
	
});
</script>