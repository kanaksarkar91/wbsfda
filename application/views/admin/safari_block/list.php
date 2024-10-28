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
                        <h1 class="app-page-title mb-0">Block History</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
								<div class="col-auto">
                                    <?php
                                        if(check_user_permission($menu_id, 'add_flag')){
                                    ?>
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/safari_booking/add_safari_block'); ?>">
                                        Block Safari
                                    </a>
                                    <?php
                                        }
                                    ?>
                                </div>
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
									<option value="0">Select Safari</option>
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
								<label for="" class="form-label">Block From</label>
                                <input type="date" class="form-control" name="start_date" 
                                    value="<?= !empty($start_date) ? date('Y-m-d', strtotime($start_date)) : "" ?>">
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-6">
                                <label for="" class="form-label">Block To</label>
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
						<table class="table app-table-hover table-bordered">
							<tr>
								<th>Division/National Park</th>						
								<th>Safari Type</th>						
								<th>Service Definition</th>
								<th>Status as on</th>
								<th>Time Slot</th>
							</tr>
							<tr>
								<td><?= $mergedArray[0]->division_name;?></td>
								<td><?= $mergedArray[0]->type_name;?></td>
								<td><?= $mergedArray[0]->service_definition;?></td>
								<td><?= date('h:i A').' of '.date('d-m-Y').' for '.date('d-m-Y', strtotime($start_date));?></td>						
								<td><?= $mergedArray[0]->slot_desc.': '.$mergedArray[0]->start_time.' to '.$mergedArray[0]->end_time;?></td>
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
				
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="block_list_table">
                                <thead>
                                    <tr>
                                    	<th class="cell">SL No.</th>
                                        <th class="cell">Date & Time</th>
                                        <th class="cell">No. of Seats</th>
                                        <th class="cell">View File</th>
										<th class="cell">Remarks</th>
										<th class="cell">Blocked By</th>
                                        <th class="cell">Block Revoked by</th>
                                        <th class="cell">Revoked Date & Time</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($mergedArray)){
                                    foreach($mergedArray as $row) { ?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?= date('d-m-Y h:i A', strtotime($row->created_ts));?></td>
                                        <td class="cell"><?=$row->no_of_person;?></td>
                                        <td class="cell">
										<?php
										if($row->supporting_doc != ''){
										?>
										<a class="btn-sm app-btn-secondary" href="<?= base_url('public/admin_images/'.$row->supporting_doc);?>" target="_blank">View File</a>
										<?php } ?>
										</td>
										<td class="cell"><?= $row->remarks;?></td>
										<td class="cell"><?= $row->full_name;?></td>
                                        <td class="cell"><?= $row->archive_id > 0 ? $row->full_name : '';?></td>
                                        <td class="cell"><?= $row->archive_id > 0 ? date('d-m-Y h:i A', strtotime($row->archive_date)) : '';?></td>
                                        <td class="cell">
										<?= $row->archive_id > 0 ? '<span class="badge bg-danger">Terminated </span>' : '<span class="badge bg-info">Active </span>';?> 
										</td>
                                        <td class="cell">
										<?php
										if($row->block_date >= date('Y-m-d') && $row->archive_id == ''){
										?>
										<button class="btn-sm app-btn-primary" data-blockid="<?= encode_url($row->blocked_id);?>" id="terminateRecordBtn">Revoke</button>
										<?php } ?>
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
				<?php } else { ?>
				<div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="block_list_table">
                                <thead>
                                    <tr>
                                    	<th class="cell">SL No.</th>
                                        <th class="cell">Division/National Park</th>
                                        <th class="cell">Safari Definition</th>
                                        <th class="cell">Safari Type</th>
										<th class="cell">Booking Date</th>
										<th class="cell">Time Slot</th>
                                        <th class="cell">No. of Seats</th>
										<th class="cell">Block Revoked by</th>
                                        <th class="cell">Revoked Date & Time</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($mergedArray)){
                                    foreach($mergedArray as $row) { ?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?=$row->division_name;?></td>
                                        <td class="cell"><?=$row->service_definition;?></td>
                                        <td class="cell"><?=$row->type_name;?></td>
										<td class="cell"><?= date('d-m-Y', strtotime($row->block_date));?></td>
										<td class="cell"><?=$row->slot_desc.': '.$row->start_time.' to '.$row->end_time;?></td>
                                        
                                        <td class="cell"><?=$row->no_of_person;?></td>
										<td class="cell"><?= $row->archive_id > 0 ? $row->full_name : '';?></td>
                                        <td class="cell"><?= $row->archive_id > 0 ? date('d-m-Y h:i A', strtotime($row->archive_date)) : '';?></td>
                                        <td class="cell">
										<?= $row->archive_id > 0 ? '<span class="badge bg-danger">Terminated </span>' : '<span class="badge bg-info">Active </span>';?> 
										</td>
                                        <td class="cell">
										<?php
										if($row->block_date >= date('Y-m-d') && $row->archive_id == ''){
										?>
										<button class="btn-sm app-btn-primary" data-blockid="<?= encode_url($row->blocked_id);?>" id="terminateRecordBtn">Revoke</button>
										<?php } ?>
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
	
	$(document).on('click', "#terminateRecordBtn", function() {
		var blocked_id = $(this).data('blockid');
	
		// Confirmation before making the AJAX call
		Swal.fire({
			title: 'Are you sure you want to revoke?',
			text: "This action cannot be undone.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, revoke it!',
			cancelButtonText: 'No, keep it',
			allowOutsideClick: false,
		}).then((result) => {
			if (result.isConfirmed) {
				
				$("#terminateRecordBtn").prop('disabled',true);
				$("#terminateRecordBtn").html('Revoking...');
				// User confirmed, proceed with the AJAX call
				$.ajax({
					type: 'POST',
					url: '<?= base_url('admin/safari_booking/blockRevoke'); ?>',
					data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', blocked_id: blocked_id},
					dataType: 'json',
					encode: true,
				})
				.done(function(response) {
					if (response.success) {
						$("#terminateRecordBtn").prop('disabled',false);
						$("#terminateRecordBtn").html('Revoke');
						Swal.fire({
							icon: 'success',
							title: response.message,
							confirmButtonText: 'Ok',
							confirmButtonColor: '#69da68',
							allowOutsideClick: false,
						}).then(result => {
							if (result.value) {
								window.location.replace(response.redirect);
							}
						});
					} else {
						$("#terminateRecordBtn").prop('disabled',false);
						$("#terminateRecordBtn").html('Revoke');
						
						Swal.fire({
							icon: 'error',
							title: response.message,
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
</script>