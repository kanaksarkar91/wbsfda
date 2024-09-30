<div class="app-content pt-3 p-md-3 p-lg-3">
           
            <div class="container-xl">
                        
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Check In Detail</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col--> 
                               
                                <div class="col-auto">
                                    <a class="btn app-btn-primary" href="<?=base_url('admin/reservation')?>">
                                        Booking List
                                    </a>
                                </div>
                                <!--//col--> 
                                <div class="col-auto">
                                    <!--<a class="btn app-btn-primary" href="add.html">
                                        Edit Personal Details 
                                    </a>-->
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <style type="text/css">
                        .btn-green {
                            background: #33c543;
                            color: #fff;
                            -webkit-border-radius: 0;
                            -moz-border-radius: 0;
                            border-radius: 4px;
                            font-family: 'Barlow', sans-serif;
                            border: #33c543 1px solid;
                            padding: 6px 16px;
                            font-size: 13px;
                            font-weight: 400;
                            text-decoration: none;
                            transition-duration: 0.5s;
                            -webkit-transition-duration: 0.5s;
                            display: inline-block;
                        }

                        .btn-green:focus,
                        .btn-green:hover {
                            background: #000;
                            color: #33c543;
                            border: #33c543 1px solid;
                            transition-duration: 0.5s;
                            -webkit-transition-duration: 0.5s;
                            outline: 0;
                        }
                        .btn-yellow {
                            background: #ff9600;
                            color: #fff;
                            -webkit-border-radius: 0;
                            -moz-border-radius: 0;
                            border-radius: 4px;
                            font-family: 'Barlow', sans-serif;
                            border: #ff9600 1px solid;
                            padding: 6px 16px;
                            font-size: 13px;
                            font-weight: 400;
                            text-decoration: none;
                            transition-duration: 0.5s;
                            -webkit-transition-duration: 0.5s;
                            display: inline-block;
                        }
                        .btn-info {
                            background: #6dafff;
                            color: #fff;
                            -webkit-border-radius: 0;
                            -moz-border-radius: 0;
                            border-radius: 4px;
                            font-family: 'Barlow', sans-serif;
                            border: #6dafff 1px solid;
                            padding: 6px 16px;
                            font-size: 13px;
                            font-weight: 400;
                            text-decoration: none;
                            transition-duration: 0.5s;
                            -webkit-transition-duration: 0.5s;
                            display: inline-block;
                        }
                        .btn-info:focus,
                        .btn-info:hover {
                            background: #246fc9;
                            color: #fff;
                            border: #246fc9 1px solid;
                            transition-duration: 0.5s;
                            -webkit-transition-duration: 0.5s;
                            outline: 0;
                        }

                        .btn-primary {
                            color: #fff !important;
                            background-color: #246fc9;
                            border-color: #246fc9;
                        }

                        .btn-primary:hover {
                            color: #fff;
                            background-color: #6dafff;
                            border-color: #6dafff
                        }
                        .btn{
                            margin: 2.5px 0;
                        }
                </style>

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <div class="m-2">
                                <table class="table table-bordered table-striped">
                 
                                    <tbody><tr>
                                        <td width="33%"><strong>Booking No. :</strong> <span id="" style="margin-left:08px;"><?php echo $booking_details['booking_no']; ?></span> </td>
                                        <td width="33%"><strong>Booking Date :</strong><span id="" style="margin-left:08px;"><?php echo date("d/m/Y h:i:s A", strtotime($booking_details['created_ts'])); ?></span> </td>
                                        <td width="33%"><strong>Guest Name :</strong><span id="" style="margin-left:08px;" value=""><?php echo $booking_details['first_name']." ".$booking_details['last_name']; ?></span></td>
                                    </tr>
                  
                                    <tr>
                                        <td width="33%"><strong>Guest Phone :</strong> <span type="text" id="customer_phone" style="margin-left:08px;" value=""><?php echo $booking_details['mobile']; ?></span></td>
                                        <td><strong>Checkin Date :</strong> <span id="" style="margin-left:08px;"><?php echo date("d/m/Y", strtotime($booking_details['check_in'])); ?></span></td>
                                        <td><strong>Checkout Date :</strong> <span id="" style="margin-left:08px;"><?php echo date("d/m/Y", strtotime($booking_details['check_out'])); ?></span></td>
                                    </tr>
                                     
                                    <tr>
                                       <td><strong>Booking For :</strong> <span id="" style="margin-left:08px;"><?php echo $booking_details['property_name']; ?></span></td>
                                       <td><strong>Payable Amount :</strong>  <span id="" style="margin-left:08px;"><?php echo number_format($booking_details['payable']['payable_amt'],2); ?></span></td>
                                       <?php /*?><td><strong>Booking Status :</strong> <span id="" style="margin-left:08px;"><?php if($booking_details['booking_status'] == 'I'){ echo 'Initiate'; } else if($booking_details['booking_status'] == 'A'){ echo 'Approved'; } else if($booking_details['booking_status'] == 'C'){ echo 'Cancelled'; } else { echo 'Check Out'; } ?></span></td><?php */?>
									   <td><strong>Guests :</strong> <span id="" style="margin-left:08px;"><img src="<?php echo base_url(); ?>public/admin_images/adult.png"> = <?php echo $booking_details['b_details'][0]['adults']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/admin_images/children.png"> = <?php echo $booking_details['b_details'][0]['children']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
									   
									   <?php 
									   if($booking_details['is_hall'] == 0){
									   ?>
                                                <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/reservation/checkin_guest_details/'.$booking_details['booking_id']); ?>"><?php if($booking_details['guest_details'][0]['name'] != ''){?>View Guests<?php } else{ ?> Entry Guests<?php } ?></a>
                                       
									   <?php 
									   } 
									   ?>
									   
									   </td>
                                    </tr>
                                    <tr>
                                       <td colspan="3" id="invoice_generated_msg" align="center" style="display:none;">Booking Voucher and booking edit are not available for <span id="agency_name"></span> booking. Please refer to <span id="booking_ref_no"></span> for details.</td>
                                    </tr>
                                  </tbody></table>
                            </div>



                              
                             <table class="table app-table-hover mb-0 mt-3 text-left" id="sports_facilities">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <!--<th class="cell">Select for check in </th>-->
                                        <th class="cell">Accommodation</th>
                                        <!--<th class="cell">Guests</th>-->
                                        <th class="cell">Allotment Status</th>
                                        <th class="cell text-center" colspan="2">Date of Stay</th>
                                        <!--<th class="cell">Checkout Date</th>-->
                                        <th class="cell">Room No.</th>
                                        <th class="cell">Per Day Room Rate</th>
                                        <!--<th class="cell">No. of Day	</th>-->
										<th class="cell">CGST(%) & Amt</th>
										<th class="cell">SGST(%) & Amt</th>
                                        <th class="cell">Net Amount</th>
                                        <th class="cell">Action</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php foreach($booking_details['b_details'] as $booking_d){ ?>

                                        <tr>
                                            <td class="cell"><?php echo $i; ?></td>
                                            <!--<td class="cell">Room Allotted</td>-->
                                            <td class="cell"><?php echo $booking_d['accommodation_name']; ?></td>
                                            <?php /*?><td class="cell"><img src="<?php echo base_url(); ?>public/admin_images/adult.png"> = <?php echo $booking_d['adults']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/admin_images/children.png"> = <?php echo $booking_d['children']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/admin_images/infant.png"> = <?php echo $booking_d['infants']; ?> </td><?php */?>
                                            <td class="cell"><?php if($booking_d['allotment_status'] == 'B'){ echo 'Booked'; } else if($booking_d['allotment_status'] == 'C'){ echo 'Cancelled'; } else if($booking_d['allotment_status'] == 'I'){ echo 'Checked in / Allotted'; } else { echo 'Checked Out'; } ?></td>
                                            <td class="cell"><?php echo date("d/m/Y", strtotime($booking_d['in_date'])); ?></td>
                                            <td class="cell"><?php echo date("d/m/Y", strtotime($booking_d['out_date'])); ?></td>
                                            <td class="cell"><?php echo $booking_d['room_no']; ?></td>
											
                                            <td class="cell">
											<input type="text" class="form-control" name="" id="room_rate<?php echo $i; ?>" value="<?php echo $booking_d['room_rate']; ?>" onkeyup="return calculate_net_amount(<?php echo $i?>);" onkeydown="return calculate_net_amount(<?php echo $i?>);"  style="width:120px;" />
											
											
											<?php /*?><?php
											if($booking_d['allotment_status'] == 'I'){
												if($booking_d['out_date'] > date('Y-m-d')){
											?>
													<input type="text" class="form-control" name="" id="room_rate<?php echo $i; ?>" value="<?php echo $booking_d['room_rate']; ?>" onkeyup="return calculate_net_amount(<?php echo $i?>);" onkeydown="return calculate_net_amount(<?php echo $i?>);" style="width:120px;" />
											<?php
												}
												else if($booking_d['out_date'] == date('Y-m-d')){
													if(strtotime($booking_details['p_checkout_time']) > strtotime(date('H:i'))){
											?>
														<input type="text" class="form-control" name="" id="room_rate<?php echo $i; ?>" value="<?php echo $booking_d['room_rate']; ?>" onkeyup="return calculate_net_amount(<?php echo $i?>);" onkeydown="return calculate_net_amount(<?php echo $i?>);"  style="width:120px;" />
											<?php
													}
													else {
														echo 'Rs. '.$booking_d['room_rate'];
													}
												}
												else {
													echo 'Rs. '.$booking_d['room_rate'];
												}
											}
											else {
												echo 'Rs. '.$booking_d['room_rate'];
											}
											?><?php */?>
											</td>
											
                                            <?php /*?><td class="cell">
                                                <?php
                                                    $toDate = strtotime($booking_d['out_date']);
                                                    $fromDate = strtotime($booking_d['in_date']);
                                                    $datediff = $toDate - $fromDate;

                                                    echo round($datediff / (60 * 60 * 24));
                                                ?>
												<input type="hidden" id="net_amt_after_gst<?php echo $i; ?>" value="" />
                                            </td><?php */?>
											
											<td>
												<div class="d-flex flex-column">
													<div id="cgstPer<?php echo $i; ?>" class="border-bottom"><?php echo $booking_d['room_cgst_percent']; ?></div>
													<div id="cgstAmt<?php echo $i; ?>"><?php echo $booking_d['room_cgst']; ?></div>
												</div>
												
												
												<?php /*?><span><?php echo $booking_d['room_cgst']; ?></span><?php */?>
											</td>
											
											<td>
												<div id="sgstPer<?php echo $i; ?>" class="border-bottom"><?php echo $booking_d['room_sgst_percent']; ?></div>
												<div id="sgstAmt<?php echo $i; ?>"><?php echo $booking_d['room_sgst']; ?></div>
												
												
												<?php /*?><span id="sgstAmt<?php echo $i; ?>"><?php echo $booking_d['room_sgst']; ?></span><?php */?>
											</td>
                                            
											<td class="cell" id="net_amount<?php echo $i; ?>">
												<?php echo $booking_d['room_net_amount'];?>
											</td>
                                            
											<td class="cell">
                                                <?php
												if($booking_d['allotment_status'] == 'I'){
													if($booking_d['out_date'] > date('Y-m-d')){
												?>
														<a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/booking/change_room/'.$booking_details['booking_id'].'/'.$booking_d['booking_detail_id']); ?>">Change&nbsp;Room</a>
														<?php /*?><button type="button" class="btn btn-sm btn-warning text-white" data-booking-detail-id="<?php echo $booking_d['booking_detail_id'];?>" id="edit_room_rate<?php echo $i?>" onclick="return edited_amt_submit(<?php echo $i?>);">Submit</button><?php */?>
												<?php
													}
													if($booking_d['out_date'] == date('Y-m-d')){
														if(strtotime($booking_details['p_checkout_time']) > strtotime(date('H:i'))){
												?>
															<a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/reservation/checkin_guest_details/'.$booking_details['booking_id']); ?>">Change&nbsp;Room</a>
															<?php /*?><button type="button" class="btn btn-sm btn-warning text-white" data-booking-detail-id="<?php echo $booking_d['booking_detail_id'];?>" id="edit_room_rate<?php echo $i?>" onclick="return edited_amt_submit(<?php echo $i?>);">Submit</button><?php */?>
												<?php
														}
													}
												}
												?>
												
												<button type="button" class="btn btn-sm btn-warning text-white" data-booking-detail-id="<?php echo $booking_d['booking_detail_id'];?>" id="edit_room_rate<?php echo $i?>" onclick="return edited_amt_submit(<?php echo $i?>);">Submit</button>
												
                                            </td>
											
											<td class="cell">
												<?php if($booking_d['allotment_status'] == 'I'){ ?>
                                                    <button class="btn btn-sm btn-green checked_out" data-did="<?php echo $booking_d['booking_detail_id']; ?>" data-bid="<?php echo $booking_d['booking_id']; ?>">Check&nbsp;Out</button>
                                                <?php } else { ?>
                                                    <?php echo "--"; ?>
                                                <?php } ?>
                                            </td>
                                            <?php /*?><?php if($booking_details['is_hall'] == 0){ ?>
                                                <td class="cell"><a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/reservation/checkin_guest_details/'.$booking_d['booking_detail_id']); ?>">View Guests</a></td>
                                            <?php } else { ?>
                                                <td class="cell"><?php echo '--'; ?></td>
                                            <?php } ?><?php */?>
                                            
                                        </tr>

                                        <?php $i++; ?>

                                    <?php } ?>
                                    
                                    <!--<tr>
                                        <td colspan="8"></td>
                                        
                                        <td colspan="3" style="text-align:right; font-weight:bold;font-size: 19px;padding-top: 15px;">Total: <span class="WebRupee">Rs.</span> <span id="total_amt">6665.82</span></td>
                                        <td colspan="3" align="right">
                                            <div class="text-right">
                                                <span style="font-weight: bold">Paid Amount : <span id="paid_amount">5649.00</span></span>
                                                <br>
                                                <span style="font-weight: bold">Due Amount : <span id="due_amount">1016.82</span></span>
                                            </div>
                                        </td>
                                       
                                        
                                    </tr>-->   
                                    
                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->
                        <!--<div class="col-md-12 text-center">
                            <button type="button" class="btn app-btn-primary mt-3 mb-3" id="" > Submit</button>
                           <button type="button" class="btn app-btn-primary open_room">Search</button> 
                      </div>-->
                    </div>
                    <!--//app-card-body-->
                </div>
            </div>
            <!--//container-fluid-->
    </div>


<script>
    $(document).ready(function() {
        $(document).on("click",".checked_out",function() {

            var getBookingid = $(this).data('bid');
            var getDetailsid = $(this).data('did');

            var tHis = $(this);

            //alert(getBookingid+' - '+getDetailsid);

            tHis.html('<i class="fa fa-spinner fa-spin"></i>Wait..');

            $.ajax({
                type: 'POST',	
                url: "<?php echo base_url('admin/reservation/checkout_submit'); ?>",
                data: {getBookingid:getBookingid,getDetailsid:getDetailsid, csrf_test_name: '<?php echo $this->csrf['hash']; ?>'},
                dataType: 'json',
                encode: true,
                async: false
            })
            //ajax response
            .done(function(data){
                
                if(data.status){ 
                    
                    setTimeout(function () {

                        alert('Successfully Checked Out.');

                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    }, 2000);
                    
                    
                    //tHis.html('Check Out');
                }
                else{
                    alert('Something is Wrong. Try Again.');
                } 

            })
            
            .fail(function(data){
                // show the any errors
                console.log(data);
            });

        });
    });
	
	function calculate_net_amount(counter){
		var room_rate = document.getElementById("room_rate"+counter).value;
		console.log(room_rate);
		
		$.ajax({
			type: 'POST',	
			url: "<?php echo base_url('admin/reservation/calculate_net_amount_based_on_room_rate'); ?>",
			data: {room_rate:room_rate,csrf_test_name: '<?php echo $this->csrf['hash']; ?>'},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(data){
			
			if(data.status){ 
				$('#cgstPer'+counter).html(data.cgstPer);
				$('#sgstPer'+counter).html(data.sgstPer);
				$('#net_amount'+counter).html(data.net_amount);
				$('#cgstAmt'+counter).html(data.cgstAmt);
				$('#sgstAmt'+counter).html(data.sgstAmt);
				
				$('#net_amt_after_gst'+counter).val(data.net_amount);
			}
			else{
				$('#cgstPer'+counter).html('0');
				$('#sgstPer'+counter).html('0');
				$('#net_amount'+counter).html('0');
				$('#cgstAmt'+counter).html('0');
				$('#sgstAmt'+counter).html('0');
			} 

		})
		
		.fail(function(data){
			// show the any errors
			console.log(data);
		});
	}
	
	function edited_amt_submit(counter){
		var bookingDetailId = $('#edit_room_rate'+counter).data('booking-detail-id');
		var room_rate = document.getElementById("room_rate"+counter).value;
		console.log(room_rate);
		
		$('#edit_room_rate'+counter).html('<i class="fa fa-spinner fa-spin"></i>Wait..');
		
		$.ajax({
			type: 'POST',	
			url: "<?php echo base_url('admin/reservation/submit_edited_room_rate'); ?>",
			data: {bookingDetailId: bookingDetailId, room_rate: room_rate, csrf_test_name: '<?php echo $this->csrf['hash']; ?>'},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(data){
			
			if(data.status){ 
				setTimeout(function () {

					$.alert({
						title: 'Success!',
						content: data.msg,
						type: 'green',
						typeAnimated: true,
					})

					setTimeout(function () {
						location.reload();
					}, 1000);

				}, 2000);
			}
			else{
				$.alert({
					title: 'Alert!',
					content: data.msg,
					type: 'red',
					typeAnimated: true,
				});
			} 

		})
		
		.fail(function(data){
			// show the any errors
			console.log(data);
		});
	}
</script>