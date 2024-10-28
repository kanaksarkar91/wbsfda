<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add Safari Block</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/safari_booking/block') ?>">
                                View All Safari Block
                            </a>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="app-card app-card-settings shadow-sm p-3">
            <div class="app-card-body">
                <?php
                    if($msg = $this->session->flashdata('error_msg')){
                        echo '<p class="text-danger validation_message">'.$msg.'</p>';
                    }
                ?>
                <form class="settings-form" id="accommodation-form" method="post" action="<?= base_url('admin/safari_booking/submit_block_data') ?>" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
				
                    <div class="row g-3 mb-3">
                        <div class="col-lg-4 col-sm-12 col-md-6">
							<label for="property_zp" class="form-label">Safari Type <span class="asterisk"> *</span></label>
							<select name="safari_type_id" class="form-select select2" id="safari_type_id" required>                               
								<option value="">All Safari Type</option>
								<?php
								if ($typeData)
									foreach($typeData as $row) {
								?>
								<option value="<?= $row['safari_type_id']; ?>" <?php echo ($row['safari_type_id'] == $safari_type_id) ? 'selected' : ''; ?>><?= $row['type_name']; ?></option>
								<?php } ?>
							</select>
						</div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
							<label for="property_zp" class="form-label">Park <span class="asterisk"> *</span></label>
							<select name="division_id" class="form-select select2" id="division_id" required>                               
								<option value="">All Park</option>
								<?php
								if ($divisionData)
									foreach($divisionData as $row) {
								?>
								<option value="<?= $row['division_id']; ?>" <?php echo ($row['division_id'] == $division_id) ? 'selected' : ''; ?>><?= $row['division_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-6">
							<label for="property_zp" class="form-label">Safari <span class="asterisk"> *</span></label>
							<select name="safari_service_header_id" id="safari_service_header_id" class="form-select select2" required>
								<option value="">Select Safari</option>
							</select>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-6">
							<label for="property_zp" class="form-label">Period <span class="asterisk"> *</span></label>
							<select name="service_period_master_id" class="form-select select2" id="service_period_master_id" required>
								<option value="">All Period</option>
								<?php
								if ($periods){
									foreach($periods as $period) {
								?>
								<option value="<?= $period['service_period_master_id']; ?>"><?= $period['showing_desc']; ?></option>
								<?php } } ?>
							</select>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-6">
							<label for="property_zp" class="form-label">Slot <span class="asterisk"> *</span></label>
							<select name="period_slot_dtl_id" id="period_slot_dtl_id" class="form-select select2" required>
								<option value="">Select Slot</option>
							</select>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-6">
							<label for="" class="form-label">Block Date<span class="asterisk"> *</span></label>
							<input type="date" class="form-control" name="block_date" id="block_date" required>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-6">
							<label for="" class="form-label">No. of Person<span class="asterisk"> *</span></label>
							<input type="text" class="form-control" name="no_of_person" id="no_of_person" required>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-6">
							<label for="service_status" class="form-label">Status<span class="asterisk"> *</span></label>
							<select name="status_flag" class="form-select" id="status_flag" required>
								<option value="1" >Active</option>
								<option value="2" >Terminate</option>
							</select>
						</div>
						
                        <div class="col-sm-12 col-md-12">
                            <label for="remarks" class="form-label">Remarks<span class="asterisk"> *</span></label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn app-btn-primary" id="btn-form-submit">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/safari_booking/block')?>">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->


<!--Block Seat Start-->
<div class="container-xl">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Block Seat</h1>
            </div>
            <div class="col-auto">
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="app-card app-card-settings shadow-sm mb-2 p-3">
            <div class="app-card-body">
                <?php
                    if($msg = $this->session->flashdata('error_msg')){
                        echo '<p class="text-danger validation_message">'.$msg.'</p>';
                    }
                ?>
                <form class="settings-form" id="accommodation-form" method="post" action="<?= base_url('admin/safari_booking/submit_block_data') ?>" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
				
                    <div class="row g-3 mb-3 justify-content-center">
						<div class="col-lg-4 col-sm-12 col-md-4">
							<label for="property_zp" class="form-label">Park <span class="asterisk"> *</span></label>
							<select name="division_id" class="form-select select2" id="division_id" required>                               
								<option value="">All Park</option>
								<?php
								if ($divisionData)
									foreach($divisionData as $row) {
								?>
								<option value="<?= $row['division_id']; ?>" <?php echo ($row['division_id'] == $division_id) ? 'selected' : ''; ?>><?= $row['division_name']; ?></option>
								<?php } ?>
							</select>
						</div>
                        <div class="col-lg-4 col-sm-12 col-md-4">
							<label for="property_zp" class="form-label">Safari Type <span class="asterisk"> *</span></label>
							<select name="safari_type_id" class="form-select select2" id="safari_type_id" required>                               
								<option value="">All Safari Type</option>
								<?php
								if ($typeData)
									foreach($typeData as $row) {
								?>
								<option value="<?= $row['safari_type_id']; ?>" <?php echo ($row['safari_type_id'] == $safari_type_id) ? 'selected' : ''; ?>><?= $row['type_name']; ?></option>
								<?php } ?>
							</select>
						</div>                        
						
						<div class="col-lg-4 col-sm-12 col-md-4">
							<label for="property_zp" class="form-label">Safari <span class="asterisk"> *</span></label>
							<select name="safari_service_header_id" id="safari_service_header_id" class="form-select select2" required>
								<option value="">Select Safari</option>
							</select>
						</div>

						<div class="col-lg-4 col-sm-12 col-md-4">
							<label for="" class="form-label">Select Date<span class="asterisk"> *</span></label>
							<input type="date" class="form-control" name="block_date" id="block_date" required>
						</div>
						
						<div class="col-lg-4 col-sm-12 col-md-4">
							<label for="property_zp" class="form-label">Select Time Slot <span class="asterisk"> *</span></label>
							<select name="period_slot_dtl_id" id="period_slot_dtl_id" class="form-select select2" required>
								<option value="">Select Time Slot</option>
							</select>
						</div>						
						
                        <div class="col-lg-4 col-sm-12 col-md-4">
							<label class="form-label w-100">&nbsp;</label>
                            <button type="submit" class="btn app-btn-primary" id="btn-form-submit">PROCEED</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>

		<div class="app-card app-card-settings shadow-sm mb-2 p-3">
            <div class="app-card-body">
				<table class="table app-table-hover table-bordered">
					<tr>
						<th>Division/National Park</th>						
						<th>Safari Type</th>						
						<th>Service Definition</th>
						<th>Status as on</th>
						<th>Time Slot</th>
					</tr>
					<tr>
						<td>Jaldapara National Park</td>
						<td>Car Safari</td>
						<td>Chilapata Car Safari</td>
						<td>HH:MM am of DD-MM-YYYY for DD-MM-YYYY</td>						
						<td>Morning Slot 6:30 am to 8:00 am</td>
					</tr>
				</table>
				

				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Total Capacity</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">42</span>
							</div>
						</div>
                    </div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Booked</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">22</span>
							</div>
						</div>
                    </div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Blocked</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">10</span>
							</div>
						</div>
                    </div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Available</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">10</span>
							</div>
						</div>
                    </div>

					<div class="clearfix w-100"></div>
					<div class="col-sm-12 mb-3 text-end">
						<button type="submit" class="btn app-btn-primary" id="btn-form-submit">View Booking Details</button>
						<button type="submit" class="btn app-btn-primary" id="btn-form-submit">View Block History</button>
					</div>
				</div>
			</div>
		</div>

		<div class="app-card app-card-settings shadow-sm mb-2 p-3">
            <div class="app-card-body">
				<div class="row g-3 mb-3">
					<div class="col-lg-3 col-sm-12 col-md-3">
						<label for="" class="form-label">Block Seat<span class="asterisk"> *</span></label>
						<input type="text" class="form-control" name="" id="" required>
					</div>
					<div class="col-lg-4 col-sm-12 col-md-5">
						<label for="" class="form-label">Upload File<span class="asterisk"> *</span></label>
						<input type="file" class="form-control" name="" id="" required>
					</div>
					<div class="col-lg-7 col-sm-12 col-md-8">
						<label for="remarks" class="form-label">Remarks<span class="asterisk"> *</span></label>
						<textarea type="text" class="form-control" id="remarks" name="remarks" required></textarea>
					</div>
					<div class="col-12">
						<button type="submit" class="btn app-btn-primary" id="btn-form-submit">SUBMIT</button>
						<a class="btn app-btn-danger" href="<?=base_url('admin/safari_booking/block')?>">CANCEL</a>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!--//container-fluid-->


</div>
<!-- // Block Seat End-->

<!--Block Booking Details Start-->
	<div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Booking Details</h1>
            </div>
            <div class="col-auto">
            </div>
            <!--//col-auto-->
        </div>
		<!--//row-->
		<div class="app-card app-card-settings shadow-sm mb-2 p-3">
			<div class="app-card-body">
				<table class="table app-table-hover table-bordered">
					<tr>
						<th>Division/National Park</th>						
						<th>Safari Type</th>						
						<th>Service Definition</th>
						<th>Status as on</th>
						<th>Time Slot</th>
					</tr>
					<tr>
						<td>Jaldapara National Park</td>
						<td>Car Safari</td>
						<td>Chilapata Car Safari</td>
						<td>HH:MM am of DD-MM-YYYY for DD-MM-YYYY</td>						
						<td>Morning Slot 6:30 am to 8:00 am</td>
					</tr>
				</table>
				

				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Total Capacity</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">42</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Booked</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">22</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Blocked</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">10</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Available</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">10</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="app-card app-card-settings shadow-sm mb-2">
			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table app-table-hover mb-0">
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
							<tr>
								<td>XXABCD1234</td>
								<td class="text-center">24-10-2024</td>
								<td class="text-center">12:42 PM</td>
								<td>Sourabh Hazari</td>
								<td class="text-center">Indian</td>
								<td>9876543210</td>
								<td class="text-center">2</td>
								<td class="text-center">1</td>
								<td class="text-center"><span class="badge bg-success">Approved </span></td>
								<td class="text-center"><a class="btn-sm app-btn-primary" href="#.">Button</a></td>
							</tr>
							<tr>
								<td>XXABCD1234</td>
								<td class="text-center">24-10-2024</td>
								<td class="text-center">12:42 PM</td>
								<td>Sourabh Hazari</td>
								<td class="text-center">Indian</td>
								<td>9876543210</td>
								<td class="text-center">2</td>
								<td class="text-center">1</td>
								<td class="text-center"><span class="badge bg-info">Initiate </span></td>
								<td class="text-center"><a class="btn-sm app-btn-primary" href="#.">Button</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--//container-fluid-->
<!-- // Block Booking Details End-->

<!--Block History Start-->
	<div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Block History</h1>
            </div>
            <div class="col-auto">
            </div>
            <!--//col-auto-->
        </div>
		<!--//row-->
		<div class="app-card app-card-settings shadow-sm mb-2 p-3">
			<div class="app-card-body">
				<table class="table app-table-hover table-bordered">
					<tr>
						<th>Division/National Park</th>						
						<th>Safari Type</th>						
						<th>Service Definition</th>
						<th>Status as on</th>
						<th>Time Slot</th>
					</tr>
					<tr>
						<td>Jaldapara National Park</td>
						<td>Car Safari</td>
						<td>Chilapata Car Safari</td>
						<td>HH:MM am of DD-MM-YYYY for DD-MM-YYYY</td>						
						<td>Morning Slot 6:30 am to 8:00 am</td>
					</tr>
				</table>
				

				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Total Capacity</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">42</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Booked</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">22</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Blocked</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">10</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12 mb-3">
						<div class="info-box border shadow-none rounded-0 mb-0" >
							<div class="info-box-content text-center">
							<span class="info-box-text fw-bold">Seats Available</span>
							<span class="fs-5 fw-bold" style="color: #009e60;">10</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="app-card app-card-settings shadow-sm mb-2">
			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table app-table-hover mb-0">
						<thead>
							<tr>
								<th class="cell text-center">Date</th>
								<th class="cell text-center">Time</th>
								<th class="cell text-center">No. of Seats</th>
								<th class="cell text-center">View File</th>
								<th class="cell">Remarks</th>
								<th class="cell">User</th>
								<th class="cell">Block Revoked by</th>
								<th class="cell text-center">Date</th>
								<th class="cell text-center">Time</th>
								<th class="cell text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">24-10-2024</td>
								<td class="text-center">12:42 PM</td>
								<td class="text-center">4</td>
								<td class="text-center"><a class="btn-sm app-btn-secondary" href="#.">View File</a></td>
								<td class="">Test remarks content</td>
								<td class="">Sourabh Hazari</td>
								<td class="">Mohan Das</td>
								<td class=" text-center">24-10-2024</td>
								<td class=" text-center">12:42 PM</td>
								<td class="text-center"><a class="btn-sm app-btn-primary" href="#.">Button</a></td>
							</tr>
							<tr>
								<td class="text-center">24-10-2024</td>
								<td class="text-center">12:42 PM</td>
								<td class="text-center">4</td>
								<td class="text-center"><a class="btn-sm app-btn-secondary" href="#.">View File</a></td>
								<td class="">Test remarks content</td>
								<td class="">Sourabh Hazari</td>
								<td class="">Mohan Das</td>
								<td class=" text-center">24-10-2024</td>
								<td class=" text-center">12:42 PM</td>
								<td class="text-center"><a class="btn-sm app-btn-primary" href="#.">Button</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--//container-fluid-->
<!-- // Block History End-->

<script>
// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];

// Set the min attribute to today's date
document.getElementById('block_date').setAttribute('min', today);
 
 $(document).ready(function() {
	getServices();
	$("#division_id").change(function(){ 
		getServices();
	});
	
	$("#safari_type_id").change(function(){ 
		getServices();
	});
	
	$("#safari_service_header_id").change(function(){ 
		getSlots();
	});
	
	$("#service_period_master_id").change(function(){ 
		getSlots();
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
			result +='<option value="">No Data found</option>'
		}
		$("#safari_service_header_id").html(result);
	});
}

function getSlots(){
	var safari_service_header_id = $('#safari_service_header_id').val();
	var service_period_master_id = $('#service_period_master_id').val();
	var result = '';
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/safari_booking/getSlots"); ?>',
		data: {
			safari_service_header_id: safari_service_header_id, service_period_master_id: service_period_master_id, csrf_test_name: '<?= $this->csrf['hash']; ?>'
		},
		dataType: 'json',
		encode: true,
		//async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			result +='<option value="">Select Slots</option>';
			$.each(response.list,function(key,value){
				
				result +='<option value="'+value.period_slot_dtl_id+'">'+value.slot_desc+': '+value.start_time+' to '+value.end_time+'</option>';
			});
		}
		else{
			result +='<option value="">No Data found</option>'
		}
		$("#period_slot_dtl_id").html(result);
	});
}
</script>