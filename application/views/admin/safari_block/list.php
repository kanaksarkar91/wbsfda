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
                        <h1 class="app-page-title mb-0">Safari Blocked List</h1>
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

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="block_list_table">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <th class="cell">Park</th>
                                        <th class="cell">Safari</th>
                                        <th class="cell">Type</th>
										<th class="cell">Period</th>
										<th class="cell">Slot</th>
                                        <th class="cell">Booking Date</th>
                                        <th class="cell">No. of Person</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($blockedBookings)){
                                    foreach($blockedBookings as $row) { ?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?=$row->division_name;?></td>
                                        <td class="cell"><?=$row->service_definition;?></td>
                                        <td class="cell"><?=$row->type_name;?></td>
										<td class="cell"><?=$row->showing_desc;?></td>
										<td class="cell"><?=$row->slot_desc.': '.$row->start_time.' to '.$row->end_time;?></td>
                                        <td class="cell"><?= date('d/m/Y', strtotime($row->block_date));?></td>
                                        <td class="cell"><?=$row->no_of_person;?></td>
                                        <td class="cell">
										<?php
											if($row->status_flag == 1){
												echo '<span class="badge bg-info">Active </span>';
											}else if($row->status_flag == 2){
												echo '<span class="badge bg-danger">Terminated </span>';
											}
										?> 
										</td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <!--<a class="btn-sm app-btn-primary" href="<?= base_url('admin/accommodation/editaccommodation/' . $accommodation['accommodation_id']) ?>">Edit</a>-->
                                        </td>
                                        <?php
                                            }
                                        ?>
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
var safari_service_header_id = '<?= $safari_service_header_id;?>';
 $(document).ready(function() {
	getServices();
	$("#division_id").change(function(){ 
		getServices();
	});
	
	$("#safari_type_id").change(function(){ 
		getServices();
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