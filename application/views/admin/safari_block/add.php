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
</div>
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