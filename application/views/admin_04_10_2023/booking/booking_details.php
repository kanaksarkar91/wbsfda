<div class="app-content pt-3 p-md-3 p-lg-4">
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

            <div class="row gy-4">
                    <div class="col-6">
                <h1 class="app-page-title">Payment Details</h1> 
                    </div>
                <div class="col-6" style="text-align: right;">
                <a href="<?=base_url('admin/reservation')?>" class="btn btn-warning">Back to Reservations</a>
                    </div>
                    </div>
                
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="row app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="col-12 py-3">
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th width="15%">Booking No.</th>
                                        <td width="35%"><?=(isset($booking_details[0]['booking_no'])?$booking_details[0]['booking_no']:'')?></td>
                                        <th width="15%">Booking Date</th>
                                        <td width="35%"><?=(isset($booking_details[0]['created_ts'])?date('d-m-Y H:i:s',strtotime($booking_details[0]['created_ts'])):'')?></td>
                                    </tr>
                                    <tr>
                                        <th width="15%">Guest Name</th>
                                        <td width="35%"><?=(isset($booking_details[0]['first_name'])?$booking_details[0]['first_name'].' '.$booking_details[0]['last_name']:'')?></td>
                                        <th width="15%">Mobile No</th>
                                        <td width="35%"><?=(isset($booking_details[0]['mobile'])?$booking_details[0]['mobile']:'')?></td>
                                    </tr>
                                    <tr>
                                        <th>Check-in</th>
                                        <td><?=(isset($booking_details[0]['check_in'])?date('d-m-Y',strtotime($booking_details[0]['check_in'])):'')?></td>
                                        <th>Check-out</th>
                                        <td><?=(isset($booking_details[0]['check_out'])?date('d-m-Y',strtotime($booking_details[0]['check_out'])):'')?></td>
                                    </tr>
                                    <tr>
                                        <th>Booking For</th>
                                        <td><?=(isset($booking_details[0]['property_name'])?$booking_details[0]['property_name']:'')?></td>
                                        <th>Payable Amount</th>
                                        <td><?=number_format($payable_amount['payable_amt'],2);?></td>
                                    </tr>
                                    <tr>
                                        <th>Booking Status</th>
                                        <td><span class="text-success"><?=(isset($booking_details[0]['booking_status'])?(($booking_details[0]['booking_status'] =='I')?'Initiated':(($booking_details[0]['booking_status'] =='C')?'Cancelled':(($booking_details[0]['booking_status'] =='A')?'Approved':(($booking_details[0]['booking_status'] =='F')?'Payment Failed':''))   )):'')?></span></td>
                                        <th>Adults/Child</th>
                                        <td><?= $booking_details[0]['adults'] . '/' . $booking_details[0]['children'] ?></td>
                                    </tr>
                                    
                                </table>
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Particulars</th>
                                        <!-- <th>Adult</th>
                                        <th>Child</th> -->
                                        <th>Allotment Status</th>
                                        <th colspan="2" class="text-center">Date of Stay</th>
                                        <!--<th>Checkout Date</th>-->
                                        <th>Net Amount</th>
                                    </tr>
                                    <?php if(!empty($booking_details)){
                                        foreach($booking_details as $details_key => $booking_detail){
                                        ?>
                                    <tr>
                                        <td><?=($details_key + 1)?></td>
                                        <td><?=$booking_detail['accommodation_name']?></td>
                                        <!-- <td><?=$booking_detail['adults']?></td>
                                        <td><?=!empty($booking_detail['children'])?$booking_detail['children']:'N/A'?></td> -->
                                        <td><?=(($booking_detail['allotment_status'] == 'B') ? 'Booked' : (($booking_detail['allotment_status'] == 'C')?'Cancelled':(($booking_detail['allotment_status'] == 'I')?'Checked in / Allotted':'Checked Out')))?></td>
                                        <td><?=date('d-m-Y',strtotime($booking_detail['in_date']))?></td>
                                        <td><?=date('d-m-Y',strtotime($booking_detail['out_date']))?></td>
                                        <td style="text-align:right;"><?=$booking_detail['room_net_amount']?></td>
                                    </tr>
                                    <?php } } ?>
                                </table>
								
								<table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Particulars</th>
                                        <th>Date & Time</th>
                                        <th>Net Amount</th>
                                    </tr>
                                    <?php 
									if(!empty($pos_details)){
                                        foreach($pos_details as $pos_key => $pos_detail){
                                    ?>
                                    <tr>
                                        <td><?=($pos_key + 1)?></td>
                                        <td><?=$pos_detail['cost_center_name']?></td>
                                        <td><?=date('d-m-Y H:i',strtotime($pos_detail['order_generate_time']))?></td>
                                        <td style="text-align:right;">
											<a href="<?php echo base_url();?>admin/pos/pos_invoice/<?php echo $pos_detail['sale_order_id'];?>?type=view" style="text-decoration:underline; font-weight:700;" target="_blank">
											<?php 
											echo $pos_detail['net_bill_amount'];
											$pos_net_amt += $pos_detail['net_bill_amount'];
											?>
											</a>
										</td>
                                    </tr>
                                    <?php 
										} 
									} 
									?>
                                </table>

                                <?php 
								//if(empty($booking_payment_details)){
									if($booking_details[0]['booking_status'] != 'C'){
								?>
                                    <div class="text-center mb-3">
                                        <button class="btn app-btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMakePayment" aria-expanded="false" aria-controls="collapseMakePayment">
                                            Make Payment
                                        </button>
                                    </div> 
                                <?php
									}
								 //} 
								?>

                                <div class="collapse" id="collapseMakePayment">
                                    <form id="booking_payment_form" class="settings-form" method="post" action="<?=base_url('admin/booking/submit_payment')?>" enctype="" autocomplete="off">
                                    <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
									<input type="hidden" id="booking_id" name="booking_id" value="<?=(isset($booking_details[0]['booking_id'])?$booking_details[0]['booking_id']:'')?>" required>

                                        <table class="mb-3 w-100 table-sm table table-bordered">
                                        <tr>
                                            <th>Receipt Date</th>
                                            <th>Select Payment Mode</th>
                                            <th>Amount</th>
                                            <th colspan="2">Remarks</th>
                                        </tr>
                                        <tr>
                                            <td width="20%">
                                                <input type="date" class="form-control" id="payment_date" name="payment_date" required="">
                                            </td>
                                            <td width="20%">
                                                <select class="form-control" id="payment_mode" name="payment_mode">
													<option value="Cash">Cash</option>
													<option value="Bank Transfer">Bank Transfer</option>
													<option value="Cheque">Cheque</option>
													<option value="EDC">EDC</option>
													<option value="Adjustment">Adjustment</option>
												</select>
                                            </td>
                                            <td width="15%">
                                                <input type="text" class="form-control" id="amount" name="amount" placeholder="0.00" required="" value="">
                                            </td>
                                            <td width="45%">
                                                <textarea class="form-control" id="remarks" name="remarks" required=""></textarea>
                                            </td>
                                            <td class="text-end">
                                                <button class="btn app-btn-primary" type="submit">Submit</button>
                                            </td>
                                        </tr>
                                    </table>
                                    </form>
                                </div>


                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Payment Date</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Status</th>
                                        <th>Remarks</th>
                                        <th>Amount</th>
                                    </tr>
                                    <?php 
                                    $total_payment_amount = 0;
                                    $net_payable_booking_amount = (isset($booking_details[0]['net_payable_amount'])?$booking_details[0]['net_payable_amount']:0);
                                    
                                        if(!empty($booking_payment_details)){
                                            foreach($booking_payment_details as $payment_key => $booking_payment_detail){

                                                if(strtolower($booking_payment_detail['status']) =='success'){
                                                    $total_payment_amount +=$booking_payment_detail['amount'];
                                                }
                                    ?>
                                    <tr>
                                        <td><?=($payment_key + 1)?></td>
                                        <td><?=date('d-m-Y H:i:s',strtotime($booking_payment_detail['payment_date']))?></td>
                                        <td><?=$booking_payment_detail['payment_mode']?></td>
                                        <td><?=ucfirst($booking_payment_detail['status'])?></td>
                                        <td><?=$booking_payment_detail['remarks']?></td>
                                        <td><?=$booking_payment_detail['amount']?></td>
                                        
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="5">No Data Available</td></tr>
                                    <?php } ?>
                                    <tr>
                                        <th class="text-end" colspan="6">Payable Amount : 
										<?php
										$payableAmt = ($payable_amount['payable_amt'] + $pos_net_amt);
										echo number_format($payableAmt,2)
										?>
										</th>
                                    </tr>
									<tr>
                                        <th class="text-end" colspan="6">Paid Amount : <?=number_format($total_payment_amount,2)?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-end" colspan="6">Due Amount : <?=number_format(($payableAmt - $total_payment_amount),2)?></th>
                                    </tr>
									
                                </table>

                                <?php if(!empty($cancellation_request_details)){ ?>
                                <table class="mb-3 w-100 table-sm table table-bordered">
                                    <tr>
                                        <th>Cancellation Date</th>
                                        <th>Cancellation Remarks</th>
                                        <th>Cancellation Percentage</th>
                                        <th>Cancellation Charge</th>
                                        <th>Refund Amount</th>
                                        <th>Refund Status</th>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><?=date('d-m-Y H:i:s',strtotime($cancellation_request_details['created_ts']))?></td>
                                        <td><?=$booking_details[0]['cancellation_remarks']?></td>
                                        <td><?=$cancellation_request_details['cancel_percent']?></td>
                                        <td><?=$cancellation_request_details['cancel_charge']?></td>
                                        <td><?=$cancellation_request_details['refund_amt']?></td>
                                        <td><?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' :'Refund in process'?></td>
                                        
                                    </tr>
                                    
                                </table>
                                <?php } ?>

                            </div>
                            <div class="col-12 pb-3">
							<?php
							if($booking_details[0]['booking_source'] == 'B'){// for admin booking
							?>
							
								<?php
								if($booking_details[0]['booking_status'] =='A' && strtotime(date('Y-m-d')) <= strtotime($booking_details[0]['check_in']) && empty($booking_payment_details)){
									echo '<button class="btn btn-warning" id="admin_canel_booking" data-toggle="modal" data-target="bookingCancelModalAdmin">Cancel Booking</button>';
								}
								else if($booking_details[0]['booking_status'] =='A' && strtotime(date('Y-m-d')) <= strtotime($booking_details[0]['check_in']) && !empty($booking_payment_details)){
									echo '<button class="btn btn-warning" id="btn_booking_cancel" data-toggle="modal" data-target="bookingCancelModal">Cancel Booking</button>';
								}
								?>
							
							<?php
							}
							else{
							?>
                                
								<?php
                                    if(isset($booking_details[0]['booking_status']) && !empty($booking_payment_details)){
                                        if(strtolower($booking_payment_detail['status']) =='success' && ($booking_details[0]['booking_status'] =='I' || ($booking_details[0]['booking_status'] =='A' &&  strtotime(date('Y-m-d')) <= strtotime($booking_details[0]['check_in'])))){
                                            echo '<button class="btn btn-warning" id="btn_booking_cancel" data-toggle="modal" data-target="bookingCancelModal">Cancel Booking</button>';
                                        }
                                    }
                                ?>
								
							<?php
							}
							?>
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
		
		
        <!-- Modal -->
        <div class="modal fade" id="bookingCancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <h6>Cancellation Information</h6><br>
				<?php
                
                //if($booking_source == 'F'){
					$cancel_percent = ($booking_details[0]['booking_status'] =='I')?0:$cancellation_details['cancellation_per'];
					$cancel_charge = ($booking_details[0]['booking_status'] =='I')?0:intval((($booking_details[0]['room_price_before_tax'] * $cancellation_details['cancellation_per']) / 100) *100)/100;
					$refund_amt = ($booking_details[0]['booking_status'] =='I')?0:intval(($booking_details[0]['room_price_before_tax'] - $cancel_charge)*100)/100;
                //}
				?>
                <?php // if($booking_source == 'F'){ ?>
                    <h6>Booking Amount Before GST (Rs.) : <?= $booking_details[0]['room_price_before_tax']; ?></h6>
					<h6>Booking Amount After GST (Rs.) : <?= $booking_payment_detail['amount']; ?></h6>
					<h6>Cancellation Charge (Rs.) : <input style="border:none;" readonly="" type="text" id="cancel_charge_show" value="<?=$cancel_charge?>"></h6>
					<h6>GST (Rs.) : <input style="border:none;" readonly="" type="text" id="gst_charge_show" name="gst_charge_show" value="<?=$booking_details[0]['room_total_igst']?>"></h6>
                    <h6>Refund Amount (Rs.) : <input type="text" id="refund_amt" name="refund_amt" value="<?=$refund_amt?>"></h6>
                    
					
					<input type="hidden" id="net_payble_amount" name="net_payble_amount" value="<?=$booking_details[0]['room_price_before_tax']?>">
                    <input type="hidden" id="paid_amount" name="paid_amount" value="<?=($booking_details[0]['booking_status'] =='I')?0:$booking_details[0]['room_price_before_tax']?>">
                    <input type="hidden" id="cancel_percent" name="cancel_percent" value="<?=$cancel_percent?>">
                    <input type="hidden" id="cancel_charge" name="cancel_charge" value="<?=$cancel_charge?>">
					<input type="hidden" id="room_net_amount" name="room_net_amount" value="<?=$booking_payment_detail['amount'];?>">
                    <?php /*?><input type="text" id="refund_amt" name="refund_amt" value="<?=$refund_amt?>"><?php */?>
                <?php // } ?>
                <input type="hidden" id="booking_source" name="booking_source" value="<?=$booking_source?>">
                
                        <textarea name="cancellation_reason" id="cancellation_reason" rows="4" style="width: 100%" placeholder="Cancellation Reason"></textarea>
                        
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary" id="btn-booking-cancel-submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
		
		
		<!-- Admin cancel Modal -->
        <div class="modal fade" id="bookingCancelModalAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="cancellation_reason_admin" id="cancellation_reason_admin" rows="4" style="width: 100%" placeholder="Cancellation Reason"></textarea>
						
						<input type="hidden" id="booking_source_admin" name="booking_source_admin" value="<?=$booking_details[0]['booking_source'];?>">
                        
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary" id="btn-booking-cancel-submit-admin">Submit</button>
                    </div>
                </div>
            </div>
        </div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const booking_id = <?= $booking_details[0]['booking_id'] ?>;
    $(document).ready(function(){
        $('#btn_booking_cancel').on('click', function(){
            $('#bookingCancelModal').modal('show');
        });

        $('#bookingCancelModal .close').on('click', function(){
            $('#cancellation_reason').val('');
            $('#bookingCancelModal').modal('hide');
        });
		
		$('#admin_canel_booking').on('click', function(){
            $('#bookingCancelModalAdmin').modal('show');
        });

        $('#bookingCancelModalAdmin .close').on('click', function(){
            $('#cancellation_reason').val('');
            $('#bookingCancelModalAdmin').modal('hide');
        });
		
		$('body').on('keyup keypress paste','#refund_amt',function(e){
			var refund_amt = $("#refund_amt").val();
			var room_net_amount = $("#room_net_amount").val();
			var room_amount_without_gst = $("#net_payble_amount").val();
			var gst_amount = $("#gst_charge_show").val();
			
			var temp_cancellation_amount = parseFloat(room_amount_without_gst - refund_amt).toFixed(2);
			var cancellation_amount = (temp_cancellation_amount < 0) ? '0' : temp_cancellation_amount;
			var cancellation_amount_for_percentage = parseFloat(room_amount_without_gst - refund_amt).toFixed(2);
			var temp_cancel_percentage = parseFloat((cancellation_amount_for_percentage / room_amount_without_gst) * 100).toFixed(2);
			var cancel_percentage = (temp_cancel_percentage < 0) ? '0' : temp_cancel_percentage;
			
			if(temp_cancellation_amount < 0){
				var cancellation_amount_gst = parseFloat(room_net_amount - refund_amt).toFixed(2);
				$("#gst_charge_show").val(cancellation_amount_gst);
				//console.log(cancellation_amount_gst);
			}
			else {
				$("#gst_charge_show").val(<?=$booking_details[0]['room_total_igst']?>);
			}
			//console.log(room_amount_without_gst);
			
			$("#cancel_charge_show").val(cancellation_amount);
			$("#cancel_charge").val(cancellation_amount);
			$("#cancel_percent").val(cancel_percentage);
		});

        $('#btn-booking-cancel-submit').on('click', function(){
            var tHis = $(this);
			var reason = $('#cancellation_reason').val();
            if(reason == ""){
                swal('Alert', 'Reason is required to cancel booking', 'warning');
                return false;
            }

            var paid_amount = $("#paid_amount").val();
            var net_payble_amount = $("#net_payble_amount").val();
			var room_net_amount = $("#room_net_amount").val();
            
            var cancel_percent = $("#cancel_percent").val();
            var cancel_charge = $("#cancel_charge").val();
            var refund_amt = $("#refund_amt").val();
            var booking_source = $("#booking_source").val();
			
			if(refund_amt > room_net_amount){
                swal('Alert', 'Refund AMT is Greater Than Total Amount With GST', 'warning');
                return false;
            }
            
            tHis.html('<i class="fa fa-spinner fa-spin"></i>Wait..');
            $.ajax({
                url:'<?= base_url("admin/booking/cancel_booking") ?>',
                method: 'POST',
                data: {
                    'booking_id' : booking_id,
                    'reason'    : reason,
                    paid_amount : paid_amount,
                    net_payble_amount : net_payble_amount,
						cancel_percent : cancel_percent,
						cancel_charge : cancel_charge,
						refund_amt : refund_amt, 
                        booking_source:booking_source
                },
                dataType: 'json',
                success: function(response){
                    tHis.text('Cancelled');
                    if(response.success){
                        swal(response.message)
                        .then((value) => {
                            window.location.reload();
                        });
                    }else{
                        $('#btn-booking-cancel-submit').before('<p class="result-msg text-danger">'+response.message+'</p>');
                    }
                },
                complete: function(){
                    setTimeout(function(){
                        $('.result-msg').remove();
                    }, 5000);
                },
                error: function(er){
                    $('#btn-booking-cancel-submit').prop('disabled', false);
                    $('#btn-booking-cancel-submit').before('<p class="result-msg text-danger">'+response.message+'</p>');
                }
            });
        });
		
		
		//Admin Cancel booking without payment
		
		$('#btn-booking-cancel-submit-admin').on('click', function(){
            var tHis = $(this);
			var reason = $('#cancellation_reason_admin').val();
            if(reason == ""){
                swal('Alert', 'Reason is required to cancel booking', 'warning');
                return false;
            }
            
            var booking_source = $('#booking_source_admin').val();
			tHis.html('<i class="fa fa-spinner fa-spin"></i>Wait..');
            $.ajax({
                url:'<?= base_url("admin/booking/cancel_booking_admin") ?>',
                method: 'POST',
                data: {
                    'booking_id' : booking_id,
                    'reason'    : reason,
                    booking_source:booking_source
                },
                dataType: 'json',
                success: function(response){
                    tHis.text('Cancelled');
                    if(response.success){
                        swal(response.message)
                        .then((value) => {
                            window.location.reload();
                        });
                    }else{
                        $('#btn-booking-cancel-submit-admin').before('<p class="result-msg text-danger">'+response.message+'</p>');
                    }
                },
                complete: function(){
                    setTimeout(function(){
                        $('.result-msg').remove();
                    }, 5000);
                },
                error: function(er){
                    $('#btn-booking-cancel-submit-admin').prop('disabled', false);
                    $('#btn-booking-cancel-submit-admin').before('<p class="result-msg text-danger">'+response.message+'</p>');
                }
            });
        });
		
    })
</script>