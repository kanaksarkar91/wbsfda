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
                        <h1 class="app-page-title mb-0">Safari Booking List</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->
				
				<div class="app-card app-card-orders-table shadow-sm mb-2 p-3">
					<div class="app-card-body">
						<form action="" method="post">
						<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
						<div class="row g-3">
						<?php
						if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
						?>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_zp" class="form-label">Type <span class="asterisk"></span></label>
                                <select name="safari_type_id" class="form-select select2" id="safari_type_id">                               
                                    <option value="0">All Type</option>
                                    <?php
                                    if ($typeData)
                                        foreach($typeData as $row) {
                                    ?>
                                    <option value="<?= $row['safari_type_id']; ?>" <?php echo ($row['safari_type_id'] == $safari_type_id) ? 'selected' : ''; ?>><?= $row['type_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_zp" class="form-label">Park <span class="asterisk"></span></label>
                                <select name="division_id" class="form-select select2" id="division_id">                               
                                    <option value="0">All Park</option>
                                    <?php
                                    if ($divisionData)
                                        foreach($divisionData as $row) {
                                    ?>
                                    <option value="<?= $row['division_id']; ?>" <?php echo ($row['division_id'] == $division_id) ? 'selected' : ''; ?>><?= $row['division_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
							
							<div class="col-lg-4 col-sm-12 col-md-6">
								<label for="property_zp" class="form-label">Safari <span class="asterisk"></span></label>
                                <select name="safari_service_header_id" id="safari_service_header_id" class="form-select select2">
									<option value="0">All Safari</option>
								</select>
							</div>
						<?php
						}
						else {
						?>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="property_zp" class="form-label">Safari <span class="asterisk"></span></label>
                                <select name="safari_service_header_id" class="form-select select2">                               
                                    <option value="0">All Safaris</option>
                                    <?php
                                    if ($userServices)
                                        foreach($userServices as $row) {
                                    ?>
                                    <option value="<?= $row['safari_service_header_id']; ?>" <?php echo ($row['safari_service_header_id'] == $safari_service_header_id) ? 'selected' : ''; ?>><?= $row['service_definition']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
						<?php } ?>
                            
							<div class="col-lg-2 col-sm-12 col-md-6">
								<label for="" class="form-label">Booking From</label>
                                <input type="date" class="form-control" name="start_date" 
                                    value="<?= !empty($start_date) ? date('Y-m-d', strtotime($start_date)) : "" ?>">
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-6">
                                <label for="" class="form-label">Booking To</label>
								<input type="date" class="form-control" name="end_date" 
                                value="<?= !empty($end_date) ? date('Y-m-d', strtotime($end_date)) : "" ?>">
                            </div>
                            
							<div class="col-lg-2 col-sm-12 col-md-6">
								<label for="property_gram_panchayat" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
							</div>
						</div>
						</form>
					</div>
				</div>
				
				<?php if($period_slot_dtl_id > 0){ ?>
				<div class="app-card app-card-settings shadow-sm mb-2 p-3">
					<div class="app-card-body">
						<table class="table app-table-hover table-bordered" id="safari_booking_listing_table">
							<tr>
								<th>Division/National Park</th>						
								<th>Safari Type</th>						
								<th>Service Definition</th>
								<th>Status as on</th>
								<th>Time Slot</th>
							</tr>
							<tr>
								<td><?= $bookings[0]->division_name;?></td>
								<td><?= $bookings[0]->type_name;?></td>
								<td><?= $bookings[0]->service_definition;?></td>
								<td><?= date('h:i A').' of '.date('d-m-Y').' for '.date('d-m-Y', strtotime($start_date));?></td>						
								<td><?= $bookings[0]->slot_desc.': '.$bookings[0]->start_time.' to '.$bookings[0]->end_time;?></td>
							</tr>
						</table>
						
		
						<div class="row">
							<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
								<div class="info-box border shadow-none rounded-0 mb-0" >
									<div class="info-box-content text-center">
									<span class="info-box-text fw-bold">Total Capacity</span>
									<span class="fs-5 fw-bold" style="color: #009e60;"><?= $foundSlot['capacity'];?></span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
								<div class="info-box border shadow-none rounded-0 mb-0" >
									<div class="info-box-content text-center">
									<span class="info-box-text fw-bold">Seats Booked</span>
									<span class="fs-5 fw-bold" style="color: #009e60;"><?= $foundSlot['no_of_booked_ticket'];?></span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
								<div class="info-box border shadow-none rounded-0 mb-0" >
									<div class="info-box-content text-center">
									<span class="info-box-text fw-bold">Seats Blocked</span>
									<span class="fs-5 fw-bold" style="color: #009e60;"><?= $foundSlot['blocked_count'];?></span>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
								<div class="info-box border shadow-none rounded-0 mb-0" >
									<div class="info-box-content text-center">
									<span class="info-box-text fw-bold">Seats Available</span>
									<span class="fs-5 fw-bold" style="color: #009e60;"><?= $foundSlot['available_qty'];?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="app-card app-card-settings shadow-sm mb-2">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="safari_booking_list_table">
								<thead>
									<tr>
										<th class="cell">Booking No.</th>
										<th class="cell text-center">Transaction Date</th>
										<th class="cell text-center">Transaction Time</th>
										<th class="cell">Primary Guest</th>
										<th class="cell text-center">Nationality</th>
										<th class="cell">Contact No.</th>
										<th class="cell text-center">Adult</th>
										<th class="cell text-center">Child</th>
										<th class="cell text-center">Present Status</th>
										<th class="cell text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if(!empty($bookings)){
									foreach($bookings as $row){
								?>
									<tr>
										<td><?= $row->booking_number;?></td>
										<td class="text-center"><?= date('d-m-Y', strtotime($row->payment_date));?></td>
										<td class="text-center"><?= date('h:i A', strtotime($row->payment_date));?></td>
										<td><?= $row->first_name;?></td>
										<td class="text-center"><?= $row->cat_name;?></td>
										<td><?= $row->mobile;?></td>
										<td class="text-center"><?= $row->no_of_person;?></td>
										<td class="text-center"><?= $row->child_count;?></td>
										<td class="text-center">
										<?php
											if($row->booking_status == 'I'){
												echo '<span class="badge bg-info">Initiate </span>';
											}else if($row->booking_status == 'A'){
												if($row->no_of_person == $row->booking_time_visitor_count){
													echo '<span class="badge bg-success">Approved </span>';
												}
												else{
													echo '<span class="badge bg-warning">Partialy Canceled</span>';
												}
											}else if($row->booking_status == 'C'){
												echo '<span class="badge bg-danger">Cancelled </span>';
												
												echo ($row->is_refunded == 1)?'<span class="badge bg-success">Refunded </span>':'<span class="badge bg-warning">Refund in process</span>'; 
	
											}else if($row->booking_status == 'F'){
												echo '<span class="badge bg-info">Payment Failed</span>';
											}
										?>
										</td>
										<td class="text-center">
											<div class="my-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/safari_booking/booking_details/'.encode_url($row->booking_id));?>">View</a></div>
											<div class="my-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/safari_booking/downloadSafariInvoice/'.encode_url($row->booking_id));?>" target="_blank">Download</a><!--<i class="fa fa-download"></i> Booking&nbsp;Slip--></div>
										</td>
									</tr>
								<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php } else { ?>
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="safari_booking_list_table">
                                <thead>
                                    <tr>
                                    	<th class="cell">SL No.</th>
                                        <th class="cell">Park</th>
                                        <th class="cell">Safari</th>
                                        <th class="cell">Type</th>
                                        <th class="cell">Booking Date</th>
                                        <th class="cell">No. of Person</th>
                                        <th class="cell">Amount</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                	if(!empty($bookings)){
                                    	foreach($bookings as $row) { 
								?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?=$row->division_name;?></td>
                                        <td class="cell"><?=$row->service_definition;?></td>
                                        <td class="cell"><?=$row->type_name;?></td>
                                        <td class="cell"><?= date('d/m/Y', strtotime($row->booking_date));?></td>
                                        <td class="cell"><?=$row->no_of_person;?></td>
                                        <td class="cell"><?=$row->total_price;?></td>
                                        <td class="cell">
										<?php
											if($row->booking_status == 'I'){
												echo '<span class="badge bg-info">Initiate </span>';
											}else if($row->booking_status == 'A'){
												if($row->no_of_person == $row->booking_time_visitor_count){
													echo '&nbsp;<span class="badge bg-success">Approved </span>';
												}
												else{
													echo '&nbsp;<span class="badge bg-warning">Partialy Canceled</span>';
												}
											}else if($row->booking_status == 'C'){
												echo '&nbsp;<span class="badge bg-danger">Cancelled </span>';
												
												echo ($row->is_refunded == 1)?'&nbsp;<span class="badge bg-success">Refunded </span>':'&nbsp;<span class="badge bg-warning">Refund in process</span>'; 
	
											}else if($row->booking_status == 'F'){
												echo '&nbsp;<span class="badge bg-info">Payment Failed</span>';
											}
										?> 
										</td>
                                        <td class="text-center">
											<div class="my-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/safari_booking/booking_details/'.encode_url($row->booking_id));?>">View</a>&nbsp;</div>
											<div class="my-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/safari_booking/downloadSafariInvoice/'.encode_url($row->booking_id));?>" target="_blank">Download</a><!--<i class="fa fa-download"></i> Booking&nbsp;Slip--></div>
										</td>
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
				<?php } ?>
            </div>
            <!--//container-fluid-->
        </div>
                
<script>
var safari_service_header_id = '<?= $safari_service_header_id;?>';
 $(document).ready(function() {
	getServices();
	$("#division_id").change(function(){ 
		getServices();
	});
	
	$("#safari_type_id").change(function(){ 
		getServices();
	});
	
	$('#safari_booking_list_table').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
		"pageLength": 50,
       // "searching": false
        
    });
	
});

function getServices(){
	var division_id = $('#division_id').val();
	var safari_type_id = $('#safari_type_id').val();
	console.log({
	  safari_type_id: safari_type_id,
	  division_id: division_id
	});
	var result = '';
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("index/getServices"); ?>',
		data: {
			safari_type_id: safari_type_id, division_id: division_id, csrf_test_name: '<?= $this->csrf['hash']; ?>'
		},
		dataType: 'json',
		encode: true,
		//async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			result +='<option value="">Select Safari</option>';
			$.each(response.list,function(key,value){
				
				if(safari_service_header_id == value.safari_service_header_id){
					var slct = 'selected';
				}
				
				result +='<option value="'+value.safari_service_header_id+'" '+slct+'>'+value.service_definition+'</option>';
			});
		}
		else{
			result +='<option value="">All Safari</option>'
		}
		$("#safari_service_header_id").html(result);
	});
}
</script>