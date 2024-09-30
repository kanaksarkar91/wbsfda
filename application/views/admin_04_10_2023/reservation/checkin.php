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
                    <form name="checkin_form" id="checkin_form" action="<?=base_url('admin/reservation/checkin_submit')?>" method="POST">
                        <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
						<input type="hidden" name="booking_id" id="booking_id" value="<?php echo $booking_details['booking_id']; ?>">
                        <input type="hidden" name="is_hall" value="<?php echo $booking_details['is_hall']; ?>">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <div class="m-2">
                                    <table class="table table-bordered table-striped">
                    
                                        <tbody><tr>
                                            <td width="33%"><strong>Booking NO :</strong> <span id="" style="margin-left:08px;"><?php echo $booking_details['booking_no']; ?></span> </td>
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
                                        <td><strong>Booking Amount :</strong>  <span id="" style="margin-left:08px;"><?php echo $booking_details['net_payable_amount']; ?></span></td>
                                        <?php /*?><td><strong>Booking Status :</strong> <span id="" style="margin-left:08px;"><?php if($booking_details['booking_status'] == 'I'){ echo 'Initiate'; } else if($booking_details['booking_status'] == 'A'){ echo 'Approved'; } else if($booking_details['booking_status'] == 'C'){ echo 'Cancelled'; } else { echo 'Check Out'; } ?></span></td><?php */?>
										<td><strong>Guests :</strong> <span id="" style="margin-left:08px;"><img src="<?php echo base_url(); ?>public/admin_images/adult.png"> = <?php echo $booking_details_with_room[0]['adults']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/admin_images/children.png"> = <?php echo $booking_details_with_room[0]['children']; ?></span></td>
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
                                            <th class="cell">Select for check in </th>
                                            <th class="cell">Accommodation</th>
                                            <!--<th class="cell">Guests</th>-->
                                            <th class="cell">Status</th>
                                            <th class="cell text-center" colspan="2">Will Stay Date</th>
                                            <!--<th class="cell">Checkout Date</th>-->
                                            <th class="cell">Enter Room No.</th>
                                            <th class="cell">Per Day Room Rate</th>
                                            <!--<th class="cell">No. of Day	</th>-->
                                            <th class="cell">Net Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($booking_details_with_room as $key => $booking_d){ ?>

                                            <tr>
                                                <td class="cell"><?php echo $i; ?></td>
                                                <td class="cell">
                                                    <input type="checkbox" name="selected_checkin[]" class="" id="selected_checkin_<?php echo $i; ?>" value="<?php echo $booking_d['booking_detail_id']; ?>" checked>
                                                </td>
                                                <td class="cell"><?php echo $booking_d['accommodation_name']; ?></td>
                                                <?php /*?><td class="cell"><img src="<?php echo base_url(); ?>public/admin_images/adult.png"> = <?php echo $booking_d['adults']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/admin_images/children.png"> = <?php echo $booking_d['children']; ?> </td><?php */?>
                                                <td class="cell"><?php if($booking_d['allotment_status'] == 'B'){ echo 'Booked'; } else if($booking_d['allotment_status'] == 'C'){ echo 'Cancelled'; } else if($booking_d['allotment_status'] == 'I'){ echo 'Checked in / Allotted'; } else { echo 'Checked Out'; } ?></td>
                                                <td class="cell"><?php echo date("d/m/Y", strtotime($booking_d['in_date'])); ?></td>
                                                <td class="cell"><?php echo date("d/m/Y", strtotime($booking_d['out_date'])); ?></td>
                                                <td class="cell">
												<?php 
												if($booking_d['booking_detail_id'] != $booking_d['first_chield_of_same_line_item']) 
												{ 
												?>
												<input type="text" class="form-control room_id<?php echo $booking_d['same_line_item']; ?><?php echo $booking_d['same_line_item']; ?>" name="room_number[]" readonly=""  />
												<?php
												}
												else {
												?>
												<select name="room_number[]" id="room_id<?php echo $booking_d['same_line_item']; ?>" class="form-select room_id" onchange="return auto_populate_room_no(<?php echo $booking_d['same_line_item']; ?>);" required>
													<option value="" selected disabled>Select Room</option>
													<?php
													if(!empty($booking_d['available_rooms'])){
														foreach ($booking_d['available_rooms'] as $room) { 
													?>
														<option value="<?= $room['room_no'] ?>"><?= $room['room_no'] ?></option>
													<?php 
														}
													}
													?>
												   
												</select>
												<?php
												}
												?>
												</td>
                                                <td class="cell">Rs. <?php echo $booking_d['room_rate']; ?></td>
                                                <?php /*?><td class="cell">
                                                    <?php
                                                        $toDate = strtotime($booking_d['out_date']);
                                                        $fromDate = strtotime($booking_d['in_date']);
                                                        $datediff = $toDate - $fromDate;

                                                        echo round($datediff / (60 * 60 * 24));
                                                    ?>
                                                </td><?php */?>
                                                <td class="cell">Rs. <?php echo $booking_d['room_net_amount']; ?>	</td>
                                                
                                            </tr>

                                            <?php $i++; ?>

                                        <?php } ?>   
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!--//table-responsive-->
                            <div class="col-md-12 text-center">
                               <!--  <button type="button" class="btn app-btn-primary mt-3 mb-3" id="" > Submit</button>
                            <button type="button" class="btn app-btn-primary open_room">Search</button> -->
                            <input type="submit" class="btn app-btn-primary mt-3 mb-3" value="Submit">
                        </div>
                        </div>
                        <!--//app-card-body-->
                    </form>
                </div>
            </div>
            <!--//container-fluid-->
    </div>
	
<script>
//$(document).ready(function(){

	$("#checkin_form").submit(function(event){
		//alert('Ayan');
		var room_id = [];
		$(".room_id").each(function (key,value){
			if($(this).val() && $("#selected_checkin_" + (key + 1)).is(':checked')){
				//alert($(this).val());
				room_id.push($(this).val());			
				room_id.sort();
				//alert(room_id);
			}
		});
		var valid_room = true;
		//console.log(room_id);
		for(var i=0; i<room_id.length; i++){
		   var room_chk = room_id[i];
			if(room_chk == room_id[i+1]){
			   valid_room = false;
			}
		}
		if(!valid_room){
			alert('Change room no.');
			return false;
		}
		else {
			$("#checkin_form").submit();
			return true;
		}
		
		
	});
	
	function auto_populate_room_no(counter){
		var room_no = document.getElementById("room_id"+counter).value;
		//console.log(room_no);
		$(".room_id"+counter+counter).val(room_no);
	
	}

//});
</script>