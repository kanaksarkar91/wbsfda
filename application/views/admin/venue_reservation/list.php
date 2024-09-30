        <div class="app-content pt-3 p-md-3 p-lg-3">
           
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>
               <div class="alert alert-success">
                     <a href="" class="close" data-bs-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?= $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-bs-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?= $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>

                <div class="row g-3 mb-3 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Venue Reservation List</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                
                                <!--//col--> 
                                <!-- <div class="col-auto">
                                    <a class="btn app-btn-primary" href="#">
                                        ADD NEW 
                                    </a>
                                </div> -->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->
                <div class="app-card app-card-orders-table shadow-sm mb-3">
                    <div class="app-card-body px-2">
                        <form action="" method="post">
                            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
						    <div class="row g-2">
                                <div class="col-lg-2 col-sm-12 col-md-5 mb-3">
                                    <label for="" class="form-label">Select Location <span class="asterisk">*</span></label>
                                    <select name="property_id" class="form-select select2" name="location" id="sel_location" onchange="populate_venue(this.value)" required>                               
                                        <option value="" selected disabled>--Select Location--</option>
                                        <?php
                                        if (isset($properties))
                                            foreach ($properties as $p) {
                                        ?>
                                        <option value="<?= $p['property_id']; ?>" <?= set_select('location', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
                                        <?php } ?>
                                    </select>                                
                                </div>
                                <!--<div class="col-lg-4 col-sm-12 col-md-7 mb-3">
                                    <label for="" class="form-label">Select Venue <span class="asterisk"></span></label>
                                    <select name="" class="form-select select2" name="venue" id="sel_venue">                               
                                        <option value="">All Venue</option>
                                        <option value="">Venue Name A</option>
                                        <option value="">Venue Name B</option>
                                        <option value="">Venue Name C</option>
                                    </select>                                
                                </div>-->
                                <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                                    <label for="venue_id" class="form-label">Venue<span class="asterisk"> *</span></label>
                                    <select name="venue_id" class="form-select select2" id="venue_id" required>
                                        <?php if(!empty($venue_list)){ ?>

                                            <?php foreach($venue_list as $venues){ ?>

                                                <option value="<?= $venues['venue_id']; ?>" <?php if($venues['venue_id'] == $venueID){ echo 'selected'; } ?>><?= $venues['venue_name']; ?></option>

                                            <?php } ?>

                                        <?php } else { ?>

                                            <option value="" selected disabled>Select Venue </option>

                                        <?php } ?>
                                        
                                    </select>
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Start Date <span class="asterisk"></span></label>
                                    <!--<div class="date-container">
                                        <input type="text" name="date_range" class="form-control datepicker" id="">
                                        <i class="date-icon fa fa-calendar"></i>
                                    </div>  -->
                                    <input type="date" class="form-control" name="start_date" value="<?= !empty($start_date) ? date('Y-m-d', strtotime($start_date)) : "" ?>">                                                  
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">End Date <span class="asterisk"></span></label>
                                    <input type="date" class="form-control" name="end_date" value="<?= !empty($end_date) ? date('Y-m-d', strtotime($end_date)) : "" ?>">                                                  
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Select Status <span class="asterisk"></span></label>
                                    <select name="venue_status" class="form-select" id="">                               
                                        <option value="">All Status</option>
                                        <option value="1" <?php if(!empty($venueStatus)){ if($venueStatus == 1){ echo 'selected'; } } ?>>Advance Paid</option>
                                        <option value="2" <?php if(!empty($venueStatus)){ if($venueStatus == 2){ echo 'selected'; } } ?>>Fully Paid</option>
                                        <option value="4" <?php if(!empty($venueStatus)){ if($venueStatus == 4){ echo 'selected'; } } ?>>NOC Issued</option>
                                        <option value="7" <?php if(!empty($venueStatus)){ if($venueStatus == 7){ echo 'selected'; } } ?>>Payment failed</option>
                                        <option value="8" <?php if(!empty($venueStatus)){ if($venueStatus == 8){ echo 'selected'; } } ?>>Payment Pending</option>
                                        <option value="6" <?php if(!empty($venueStatus)){ if($venueStatus == 6){ echo 'selected'; } } ?>>Cancelled/Refunded</option>
                                    </select>                                
                                </div>
                                <div class="col-lg-1 col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
                                    <input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
                                </div>
						    </div>
						</form>
                    </div>
                </div>                
                
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left small" id="sports_facilities">
                                <thead>
                                    <tr>
                                        <th class="cell">Booking ID</th>
                                        <th class="cell" style="min-width:95px;">Action</th>                                        
                                        <th class="cell">Status</th>
                                        <th class="cell">Requested At</th>
                                        <th class="cell" style="min-width:160px;">Booked For</th>                                        
                                        <th class="cell">Total Amount</th>
                                        <th class="cell" style="min-width:250px;">Booked Venue</th>                                        
                                        <th class="cell" style="min-width:150px;">Location</th>
                                        <th class="cell" style="min-width:120px;">Individual/Business Name</th>
                                        <th class="cell">Contact No</th>
                                        <th class="cell">Email-ID</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($reservations)){
                                    foreach($reservations as $reservation) { ?>
                                    <tr>
                                        <td class="cell"><?= ($reservation['booking_id']) ?$reservation['booking_id'] :'N/A'?></td>
                                        <td class="cell">

                                            <div class="btn-group dropend">

                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>

                                                <ul class="dropdown-menu">

                                                    <?php //if($reservation['booking_from'] == 'A' && ($reservation['booking_status'] == '1' || $reservation['booking_status'] == '8')) {?>
                                                    <?php if($reservation['booking_status'] == '1' || $reservation['booking_status'] == '8') {?>
                                                        <li style="background: #C5E1A5;">
                                                            <a href="<?= base_url('admin/venue_reservation/view_details/'.$reservation['booking_id']) ?>?type=payment" type="button" class="dropdown-item" title="Payment">Payment</a>
                                                        </li>
                                                    <?php } ?>

                                                    <?php if(check_user_permission($menu_id, 'add_flag')):?>    
                                                        <li style="background: #D7CCC8;">
                                                            <a href="<?= base_url('admin/venue_reservation/view_details/'.$reservation['booking_id']) ?>" type="button" class="dropdown-item" title="Booking Details">Details</a>
                                                        </li>
                                                    <?php endif?>

                                                    <?php if($reservation['booking_status'] == '4') {?>
                                                        <li style="background: #FFECB3;">
                                                            <a href="<?= base_url($reservation['noc_file_path']) ?>" type="button" class="dropdown-item" title="NOC Letter" target="_blank">NOC Letter</a>
                                                        </li>
                                                    <?php } ?>

                                                    <?php if(($reservation['booking_status'] == '2' && $reservation['net_amount'] >0)|| ($reservation['booking_status'] == '4' && $reservation['net_amount'] >0)) {?>
                                                        <li style="background: #B2EBF2;">
                                                            <a href="<?= base_url('admin/venue_reservation/booking_slip/'.encode_url($reservation['booking_id'])) ?>" type="button" class="dropdown-item" title="Invoice" target="_blank">Invoice</a>
                                                        </li>
                                                    <?php } ?>

                                                </ul>

                                            </div>


                                            <!--<?php if(check_user_permission($menu_id, 'add_flag')):?>
                                                <div class="m-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/venue_reservation/view_details/'.$reservation['booking_id']) ?>">Details</a></div>
                                            <?php endif?>-->

                                            <!--<?php if($reservation['payment_method'] == 'Offline' && $reservation['booking_status'] == '1') {?>
                                                <div class="m-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/venue_reservation/payment/'.$reservation['booking_id']) ?>">Payment</a></div>
                                            <?php } ?>-->

                                            <!--<?php if($reservation['booking_status'] == '1'|| $reservation['booking_status'] == '3' || $reservation['booking_status'] == '6' || $reservation['booking_status'] == '4' || $reservation['booking_status'] == '5' || $reservation['booking_status'] == '7') {?>
                                                <div class="m-1"><a class="btn-sm app-btn-primary" href="<?= base_url($reservation['approval_letter_filepath']) ?>" target="_blank">Approval Letter</a></div>
                                            <?php } ?>-->

                                            <!--<?php if($reservation['booking_status'] == '4') {?>
                                                <div class="m-1"><a class="btn-sm app-btn-primary" href="<?= base_url($reservation['noc_file_path']) ?>" target="_blank">NOC Letter</a></div>
                                            <?php } ?>  
                                            <?php if(($reservation['booking_status'] == '2' && $reservation['net_amount'] >0)|| ($reservation['booking_status'] == '4' && $reservation['net_amount'] >0)) {?>                                                 
                                                <div class="m-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/venue_reservation/booking_slip/'.encode_url($reservation['booking_id'])) ?>" target="_blank">Invoice</a></div>
                                            <?php } ?>-->
                                            
                                        </td>
                                        <td class="cell"><span class="<?= (($reservation['booking_status'] == 1) ? 'badge rounded-pill request-approved' : (($reservation['booking_status'] == 2)?'badge rounded-pill status-confirmed':(($reservation['booking_status'] == 3)?'badge rounded-pill request-waiting':(($reservation['booking_status'] == 4)?'badge rounded-pill approval-expired':(($reservation['booking_status'] == 5)?'badge rounded-pill status-cancelled':(($reservation['booking_status'] == 6)?'badge rounded-pill paid-not-confirm':(($reservation['booking_status'] == 7)?'badge rounded-pill request-reject':(($reservation['booking_status'] == 8)?'badge rounded-pill request-waiting':'badge rounded-pill request-waiting')))))))) ?>"><?= ($reservation['booking_status'] == 1) ? 'Advance paid' : (($reservation['booking_status'] == 2)?'Fully Paid & Invoice Generated':(($reservation['booking_status'] == 3)?'FOC(Free of Cost)':(($reservation['booking_status'] == 4)?'NOC Issued':(($reservation['booking_status'] == 5)?'Cancellation Request':(($reservation['booking_status'] == 6)?'Refunded':(($reservation['booking_status'] == 7)?'Payment failed':(($reservation['booking_status'] == 8)?'Payment Pending':''))))))) ?></span></td>

                                        <td class="cell"><?= date('d-m-Y H:i:s',strtotime($reservation['created_at'])) ?></td>
                                        <?php if (isset($reservation['booking_details']) && is_array($reservation['booking_details'])) {
                                            // Extract 'start_date' values from 'booking_details'
                                            $startDates = array_column($reservation['booking_details'], 'start_date');
                                            // Format 'start_date' values and then implode with a comma separator
                                            $formattedDates = array_map(function ($date) {
                                                return date('d-m-Y', strtotime($date));
                                            }, $startDates);
                                            // Implode 'start_date' values with a comma separator
                                            $startDatesString = implode(', ', $formattedDates);

                                            // Output the result in your table or view
                                            echo '<td class="cell">' . $startDatesString . '</td>'; // Display the imploded 'start_date' values
                                        }?>
                                        <td class="cell"><?= $reservation['net_amount'] ?></td>
                                        <td class="cell"><?= ($reservation['venue_names'])?$reservation['venue_names']:'N/A' ?></td>
                                        <td class="cell"><?= ($reservation['property_name'])?$reservation['property_name']:'N/A' ?></td>
                                        <?php /*?><td class="cell"><?= $reservation['category_name'] ?></td><?php */?>
                                        <td class="cell"><?=($reservation['is_indivisual']==1)? $reservation['indivisual_full_name'] :  $reservation['business_full_name']  ?></td>
                                        <td class="cell"><?= ($reservation['is_indivisual']==1)? $reservation['indivisual_contact_no'] :  $reservation['business_contact_no']  ?></td>
                                        <td class="cell"><?= ($reservation['is_indivisual']==1)? $reservation['indivisual_email'] :  $reservation['business_email']  ?></td>
                                        
                                                   
                                        
                                        
                                    </tr>
                                    <?php } 
                                    }else{ ?>
                                        <tr>
                                            <td class="cell">No data Found</td>
                                        </tr>
                                   <?php } ?>
                                    
                                   
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
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
       "ordering": false

       // "searching": false
        
    } );
} );


function populate_venue(property_id){
        var result='';
        $.ajax({
            type: 'GET',	
            url: "<?= base_url('admin/venue/getVenueByProperty'); ?>",
            data: {
                'property_id':property_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='<option value="" selected >Select Venue</option>';
                $.each(data.list,function(key,value){
                    var selected_txt='';
                    result +='<option value="'+value.venue_id+'">'+value.venue_name+'</option>';
                });
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#venue_id").html(result);
        
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }
  $( function() {
    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
  } );
  </script>
