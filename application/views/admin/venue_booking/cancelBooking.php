<section class="py-0">
    <div class="container">
                <h5>Booking details</h5>
            <div class="row">
                <div>
                    <h6 class="text-info mb-2">Venue Details</h6>
                    <div class="row g-2">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <label for="" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location_name" value="<?=$bookings[0]['property_name'] ?>" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-9">
                            <label for="" class="form-label">Venue Name</label>
                            <input type="text" class="form-control" id="venue_name" value="<?=$bookings[0]['venue_names'] ?>" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <label for="" class="form-label">Booking ID</label>
                            <input type="text" class="form-control" id="booking_id_dtl" value="<?=$bookings[0]['booking_id'] ?>" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-5">
                            <label for="" class="form-label">Reservation Request Received on</label>
                            <input type="text" class="form-control" id="created_at" value="<?=date('d-m-Y H:s:i',strtotime($bookings[0]['created_at'])) ?>" readonly="">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="" class="form-label">Booking Amount</label>
                            <input type="text" class="form-control" id="booking_amount" value="<?=$bookings[0]['net_amount'] ?>" readonly="">
                        </div>
                    </div>
                </div>
                <div>
                    <h6 class="text-info mt-3 mb-2">Details of the Reservee </h6>
                        <div class="row g-2">
                            <?php if($bookings[0]['is_indivisual']==1){ ?>
                                <div class="col-sm-12 col-md-4">
                                    <label for="" class="form-label nameType">Individual Name </label>
                                    <input type="text" class="form-control" id="name"  value="<?=$bookings[0]['indivisual_full_name'] ?>" readonly="">
                                </div>                                    
                                <div class="col-sm-12 col-md-4">                                        
                                    <label for="" class="form-label">Contact No.</label>
                                    <input type="text" class="form-control" id="contact" value="<?=$bookings[0]['indivisual_contact_no'] ?>" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="" class="form-label">e-mail ID</label>
                                    <input type="email" class="form-control" id="email" value="<?=$bookings[0]['indivisual_email'] ?>" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="" class="form-label">Mailing Address with PIN Code </label>
                                    <textarea class="form-control" name="" id="address" cols="" rows="3" readonly=""><?=$bookings[0]['indivisual_full_address'] ?></textarea>
                                </div>
                            <?php }
                            else { ?>
                                <div class="col-sm-12 col-md-4">
                                    <label for="" class="form-label nameType">Business Name </label>
                                    <input type="text" class="form-control" id="name" value="<?=$bookings[0]['business_full_name'] ?>" readonly="">
                                </div>                                    
                                <div class="col-sm-12 col-md-4">                                        
                                    <label for="" class="form-label">Contact No.</label>
                                    <input type="text" class="form-control" id="contact" value="<?=$bookings[0]['business_contact_no'] ?>" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="" class="form-label">e-mail ID</label>
                                    <input type="email" class="form-control" id="email" value="<?=$bookings[0]['business_email'] ?>" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="" class="form-label">Mailing Address with PIN Code </label>
                                    <textarea class="form-control" name="" id="address" cols="" rows="3" readonly=""><?=$bookings[0]['business_full_address'] ?></textarea>
                                </div>
                           
                            <!--if individual this section will hide, visible if it is filled by organisation-->
                                <!-- Contact Person Information Block (Initially Hidden) -->
                            <?php } if($bookings[0]['is_indivisual']!=1){ ?>    
                            <div class="col-12 contact-person-info">
                                <h6 class="mt-3 text-info">Contact Person Information</h6>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="c_name" value="<?=$bookings[0]['contact_person_name'] ?>" readonly="">
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">Contact No.</label>
                                        <input type="text" class="form-control" id="c_contact" value="<?=$bookings[0]['contact_person_contact_no'] ?>" readonly="">
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="" class="form-label">e-mail ID</label>
                                        <input type="email" class="form-control" id="c_email" value="<?=$bookings[0]['contact_person_email'] ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                </div> 
                <?php if($bookings[0]['is_agency']==1){ ?>    

                    <div class="agency-details">   
                        <h6 class="text-info mb-2">Agency Details </h6>
                        <div class="row g-2">
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Name </label>
                                <input type="text" class="form-control" id="a_name" value="<?=$bookings[0]['agency_full_name'] ?>" readonly="">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">Contact No.</label>
                                <input type="text" class="form-control" id="a_contact" value="<?=$bookings[0]['agency_contact_no'] ?>" readonly="">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">e-mail ID</label>
                                <input type="email" class="form-control" id="a_email" value="<?=$bookings[0]['agency_email'] ?>" readonly="">
                            </div>                                    
                            <div class="col-sm-12 col-md-8">
                                <label for="" class="form-label">Mailing Address with PIN Code </label>
                                <textarea class="form-control" name="" id="a_address" cols="" rows="2" readonly=""><?=$bookings[0]['agency_full_address'] ?></textarea>
                            </div>
                            <?php
                                if( $bookings[0]['agency_gst_no'])
                                { 
                            ?>
                            <div class="col-sm-12 col-md-4">
                                <label for="" class="form-label">GSTIN</label>
                                <input type="text" class="form-control" id="a_gst" value="<?=$bookings[0]['agency_gst_no'] ?>" readonly="">
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>
                <div>
                    <h6 class="text-info mb-2">Payment Details</h6>
                    <!-- <div class="row g-2">                                     
                        <div class="col-sm-12 mb-3"> -->
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered app-table-hover mb-0 text-left paymentDetails">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="cell text-center">Date </th>
                                            <th class="cell text-right">Payable for the day Amount (INR)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php if(isset($bookings[0]['booking_details']) && $bookings[0]['booking_details']){
                                                foreach($bookings[0]['booking_details'] as $reservation_detail){ ?>
                                            <tr>
                                                <td class="cell text-center"><?=date('d-m-Y',strtotime($reservation_detail['start_date']))?> </td>
                                                <td class="cell text-right"><?= $reservation_detail['rate'] ?> </td>
                                            </tr>
                                            <?php } } ?>
                                            <tr>
                                                <td class="cell text-center fw-bold">Total Amount</td>
                                                <td class="cell text-right fw-bold"><?= $bookings[0]['total_rate'] ?> </td>
                                            </tr>
                                            <tr><td class="cell text-center fw-bold">GST Amount(<?=$bookings[0]['gst_percentage']  ?>%)</td>
                                                <td class="cell text-right fw-bold"><?=$bookings[0]['gst_amount']  ?></td>
                                            </tr>
                                            <tr style="background: #4fd8f4;font-size: 1.1rem;"><td class="cell text-center fw-bold">Total Payable Amount</td>
                                            <td class="cell text-right fw-bold"><?=$bookings[0]['net_amount']?></td>
                                            </tr>
                                            <tr>
                                                <input type="hidden" class="form-control" id="total_rate" name="total_rate" value="<?= $bookings[0]['total_rate'] ?>">
                                                <input type="hidden" class="form-control" id="net_amount" name="net_amount" value="<?= $bookings[0]['net_amount'] ?>">
                                                <input type="hidden" class="form-control" id="gst_amount" name="gst_amount" value="<?= $bookings[0]['gst_amount'] ?>">
                                        </tbody>
                                </table> 
                            </div>
                       <!--  </div>
                    </div> -->
                </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 90%;; margin: 10 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;border:#9e9e9e 1px solid; padding: 15px;text-align: center;">
            <tr>
			<input type="hidden" id="booking_id" name="booking_id" value="<?=$bookings[0]['booking_id']?>">
            <?php if(($bookings[0]['status'] == '1' || $bookings[0]['status'] == '2'|| $bookings[0]['status'] == '3')){ ?>
				<td style="padding: 10px;">
				<h4>Cancellation Information</h4><br>
				<?php 
					$cancel_percent = $cancellation_details['cancellation_per'];
					$cancel_charge = intval((($bookings[0]['total_rate'] * $cancellation_details['cancellation_per']) / 100)*100)/100;
					$refund_amt = intval(($bookings[0]['total_rate'] - $cancel_charge)*100)/100;
				?>
				<h6>Cancellation Charge (Rs.) : <?= $cancel_charge ?></h6>
				<h6>Refund Amount (Rs.) : <?= $refund_amt ?></h6>
				<textarea type="text" class="form-control" id="cancel_remarks" name="cancel_remarks" placeholder="Cancel Remarks" rows="4" cols="50"></textarea>
				<input type="hidden" id="paid_amount" name="paid_amount" value="<?=$bookings[0]['total_rate']?>">
				<input type="hidden" id="cancel_percent" name="cancel_percent" value="<?=$cancel_percent?>">
				<input type="hidden" id="cancel_charge" name="cancel_charge" value="<?=$cancel_charge?>">
				<input type="hidden" id="refund_amt" name="refund_amt" value="<?=$refund_amt?>">

				
				<input type="button" id="cancel_booking_btn" style="float:right;margin-bottom:10px;margin-top:10px;" value="Cancel Booking" class="btn btn-danger">  
				</td>
                <?php } ?>
			<?php if($booking_header['booking_status'] == '5' && isset($booking_header['cancellation_remarks'])){ ?>
				<td style="padding: 10px;">
					<h4>Cancellation Information</h4><br>
					<h6>Cancellation Percentage : <?= $cancellation_request_details['cancel_percent'] ?></h6>
					<h6>Cancellation Charge (Rs.) : <?= $cancellation_request_details['cancel_charge'] ?></h6>
					<h6>Refund Amount (Rs.) : <?= $cancellation_request_details['refund_amt'] ?></h6>
					<h6>Refund Status : <?= ($cancellation_request_details['is_refunded'] == '1') ? 'Refunded' :'Refund Initiated'?></h6>
					
					<textarea type="text" class="form-control" placeholder="Cancel Remarks" rows="4" cols="50" disabled><?=$booking_header['cancellation_remarks']?></textarea>
				</td>
			<?php } ?> 
		</tr>
	</table>            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>   
</section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).on('click',"#cancel_booking_btn",function(){
var booking_id = $("#booking_id").val();
var cancel_remarks = $("#cancel_remarks").val();
var paid_amount = $("#paid_amount").val();
var cancel_percent = $("#cancel_percent").val();
var cancel_charge = $("#cancel_charge").val();
var refund_amt = $("#refund_amt").val();
var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";

if (!cancel_remarks) {

$.alert({
	title: 'Alert!',
	content: 'Please enter cancellation reason',
	type: 'red',
	typeAnimated: true,
})
return false;
}

$.confirm({
	type: 'red',
	title: 'Confirm',
	content: 'Do you want to cancel this booking?',
	buttons: {

		confirm: {
			action: function() {
				$("#cancel_booking_btn").prop('disabled',true);
				$("#cancel_booking_btn").val('Processing...');
				
				$.ajax({
					url: '<?= base_url("frontend/venue_booking/cancel_booking_refund_process"); ?>',
					method: 'post',
					data: {
						booking_id: booking_id,
						cancel_remarks : cancel_remarks,
						paid_amount : paid_amount,
						cancel_percent : cancel_percent,
						cancel_charge : cancel_charge,
						refund_amt : refund_amt, 
                        "<?= $this->security->get_csrf_token_name(); ?>": csrf_token

					},
					dataType: 'json',
					async: false,
					success: function(response) {
						if (response.status) {
							$("#cancel_booking_btn").prop('disabled',false);
							$("#cancel_booking_btn").val('Cancel Booking');
	
							$.confirm({
								type: 'green',
								title: 'Success!',
								content: response.msg,
								buttons: {

									OK: {
										btnClass: 'btn-default',
										action: function() {
											

												window.location.href="<?=base_url('my-booking?tab=hall-venue')?>";
											}
											
										}
									}
							})

						} else {
							$("#cancel_booking_btn").prop('disabled',false);
							$("#cancel_booking_btn").val('Cancel Booking');

							$.alert({ 
								title: 'Alert!',
								content: response.msg,
								type: 'red',
								typeAnimated: true,
							})
						}
					}
				})

			}
				
		},
		cancel: {
			btnClass: 'btn-default',
			action: function() {

			}
		}
	}
})
})
</script>