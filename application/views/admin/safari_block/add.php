<div class="app-content pt-3 p-md-3 p-lg-3">
    

<!--Block Seat Start-->
	<div class="container-xl">
		<form class="settings-form" id="form_seat_block" method="post" action="" enctype="multipart/form-data" autocomplete="off">
					
		<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
		
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Block Seat</h1>
				</div>
				<div class="col-auto">
					<a class="btn app-btn-secondary" href="<?= base_url('admin/safari_booking/block') ?>">
						View Safari Block
					</a>
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
								<button type="button" class="btn app-btn-primary" id="proceed_to_next">PROCEED</button>
							</div>
						</div>
					
				</div>
				<!--//app-card-body-->
			</div>
			<div id="shoeDetails"></div>
			
		</form>
	</div>
    <!--//container-fluid-->


</div>
<!-- // Block Seat End-->

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
	
	$("#block_date").change(function(){ 
		getSlots();
	});
	
	$("#proceed_to_next").click(function(){ 
		var division_id = $('#division_id').val();
		var safari_type_id = $('#safari_type_id').val();
		var safari_service_header_id = $('#safari_service_header_id').val();
		var block_date = $('#block_date').val();
		var period_slot_dtl_id = $('#period_slot_dtl_id').val();
		var result = '';
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/safari_booking/getSlots"); ?>',
			data: {
				safari_service_header_id: safari_service_header_id, block_date: block_date, division_id: division_id, safari_type_id: safari_type_id, period_slot_dtl_id: period_slot_dtl_id, csrf_test_name: '<?= $this->csrf['hash']; ?>'
			},
			dataType: 'json',
			encode: true,
			//async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				$('#shoeDetails').html(response.html);
			}
			else{
				$('#shoeDetails').html(response.html);
			}
		});
	});
	
	$(document).on('click', "#block_form_submit_btn", function() {
		var formData = new FormData($('#form_seat_block')[0]);
	
		if (!$("#no_of_person").val()) {
			Swal.fire({
				icon: 'error',
				title: 'Please enter seat!!',
				confirmButtonText: 'Ok',
				confirmButtonColor: '#69da68',
				allowOutsideClick: false,
			});
			return false;
		}
		if (!$("#remarks").val()) {
			Swal.fire({
				icon: 'error',
				title: 'Please enter remarks!!',
				confirmButtonText: 'Ok',
				confirmButtonColor: '#69da68',
				allowOutsideClick: false,
			});
			return false;
		}
		if (Number($("#no_of_person").val()) > Number($("#available_qty").val())) {
			Swal.fire({
				icon: 'error',
				title: 'Block seat is greater than seat available. Available Seat: '+$("#available_qty").val(),
				confirmButtonText: 'Ok',
				confirmButtonColor: '#69da68',
				allowOutsideClick: false,
			});
			return false;
		}
	
		// Confirmation before making the AJAX call
		Swal.fire({
			title: 'Are you sure you want to block?',
			text: "This action cannot be undone.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, block it!',
			cancelButtonText: 'No, keep it',
			allowOutsideClick: false,
		}).then((result) => {
			if (result.isConfirmed) {
				
				$("#block_form_submit_btn").prop('disabled',true);
				$("#block_form_submit_btn").html('Blocking...');
				// User confirmed, proceed with the AJAX call
				$.ajax({
					type: 'POST',
					url: '<?= base_url('admin/safari_booking/submit_block_data'); ?>',
					data: formData,
					dataType: 'json',
					encode: true,
					contentType: false,
        			processData: false,
					//async: false,
					/*beforeSend:function(){
						$("#cancel_booking_btn").html('<i class="fa fa-spinner fa-spin"></i>Wait..');
					 },*/
				})
				.done(function(response) {
					if (response.success) {
						$("#block_form_submit_btn").prop('disabled',false);
						$("#block_form_submit_btn").html('Submit');
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
						$("#block_form_submit_btn").prop('disabled',false);
						$("#block_form_submit_btn").html('Submit');
						
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
			result +='<option value="">Select Safari</option>'
		}
		$("#safari_service_header_id").html(result);
	});
}

function getSlots(){
	var division_id = $('#division_id').val();
	var safari_type_id = $('#safari_type_id').val();
	var safari_service_header_id = $('#safari_service_header_id').val();
	var block_date = $('#block_date').val();
	var period_slot_dtl_id = $('#period_slot_dtl_id').val();
	var result = '';
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/safari_booking/getSlots"); ?>',
		data: {
			safari_service_header_id: safari_service_header_id, block_date: block_date, division_id: division_id, safari_type_id: safari_type_id, period_slot_dtl_id: period_slot_dtl_id, csrf_test_name: '<?= $this->csrf['hash']; ?>'
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
			result +='<option value="">Select Slots</option>'
		}
		$("#period_slot_dtl_id").html(result);
	});
}
</script>