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
                        <h1 class="app-page-title mb-0">Add Sale Rate: <?= $product_service['product_service_name'];?></h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!-- <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <select class="form-select w-auto">
                                                  <option selected value="option-1">All</option>
                                                  <option value="option-2">Active</option>
                                                  <option value="option-3">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>
                                </div> -->
                                <!--//col--> 
                                <div class="col-auto">
                                <a class="btn app-btn-secondary" href="<?= base_url('admin/pos/product_service') ?>">
									VIEW ALL PRODUCT/SERVICE
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
				
				<div class="app-card app-card-orders-table shadow-sm mb-5 p-3">
					<div class="app-card-body">
						<div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                    	<th class="cell">SL No.</th>
                                        <th class="cell">POS</th>
										<th class="cell">Rate</th>
										<th class="cell">Effective Start Date</th>
                                        <th class="cell">Effective End Date</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($ps_sale_rates)){
                                        $i = 0;
                                    foreach($ps_sale_rates as $row) { ?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?=$row['cost_center_name']?></td>
										<td class="cell"><?=$row['rate'];?></td>
										<td class="cell"><?=date('d/m/Y', strtotime($row['eff_start_date']));?></td>
                                        <td class="cell"><?=($row['eff_end_date'] != '0000-00-00') ? date('d/m/Y', strtotime($row['eff_end_date'])) : '';?></td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <button class="btn btn-sm app-btn-primary" onclick="edit_rate(<?= $row['product_service_sale_rate_id'];?>)">Edit</button>
                                        </td>
                                        <?php
                                            }
                                        ?>
                                    </tr>
                                    <?php } 
                                    }else{ ?>
                                        <tr>
                                            <td class="cell text-center" colspan="6">No data Found</td>
                                        </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
				
				
				<div class="app-card app-card-settings shadow-sm p-4">

					<form class="settings-form" method="post" action="<?= base_url('admin/pos/insertsalerate'); ?>" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
					<input type="hidden" name="product_service_id" value="<?= encode_url($product_service['product_service_id']); ?>">
		
						<div class="app-card-body">
								<div class="row g-3">
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">POS<span class="asterisk"> *</span></label>
										<select name="cost_center_id" class="form-select select2" id="cost_center_id" required>
											<option value="" selected disabled>Select POS</option>
											<?php
											if(!empty($cost_centers)){
												foreach ($cost_centers as $costc) { 
											?>
												<option value="<?= $costc['cost_center_id'] ?>"><?= $costc['cost_center_name'] ?></option>
											<?php 
											}
												} 
											?>
										   
										</select>
									</div>
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">Rate<span class="asterisk"> *</span></label>
										<input type="number" class="form-control" name="rate" id="rate" placeholder="Rate" required>                              
									</div>
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">Taxable<span class="asterisk"> *</span></label>
										<select name="is_taxable" class="form-select" id="is_taxable" required>
											<option value="" selected>Please Select</option>
											<option value="1">Yes</option>
											<option value="2">No</option>
										</select>                              
									</div>
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">Tax <span class="asterisk"> *</span></label>
										<select id="tax_id" name="tax_id" class="form-select" required>
											<option value="" selected disabled>Please Select Tax Percentage</option>
										</select>                              
									</div>
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">SAC Code <span class="asterisk"> *</span></label>
										<select id="sac_code_id" name="sac_code_id" class="form-select" required>
											<option value="" selected disabled>Please Select SAC Code</option>
										</select>                              
									</div>
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">Eff Start Date <span class="asterisk"> *</span></label>
										<input type="text" class="form-control" name="eff_start_date" id="eff_start_date" placeholder="Eff Start Date" readonly="" required>
									</div>
									<div class="col-lg-3 col-sm-12 col-md-3 mb-3">
										<label for="" class="form-label">Eff End Date <span class="asterisk"> </span></label>
										<input type="text" class="form-control" name="eff_end_date" id="eff_end_date" placeholder="Eff End Date" readonly="">
									</div>
									
								</div>
							   
						</div>
						 <input type="hidden" name="submit" value="1"/>
						 <input type="hidden" id="product_service_sale_rate_id" name="product_service_sale_rate_id">
						<button type="submit" class="btn app-btn-primary">SUBMIT</button>
						<a class="btn app-btn-danger" href="">CANCEL</a>
					</form>
				</div>

                
            </div>
            <!--//container-fluid-->
        </div>
                
<script>
$(function() {
    $('#eff_start_date').datepicker({ 
        maxDate: new Date,
		changeYear: true,
        dateFormat: 'yy-mm-dd',
		yearRange: new Date().getFullYear() + ':9999',
        onSelect: function(date) {
                $("#eff_end_date").datepicker('option', 'minDate', date);
            }
    });  
	$( "#eff_end_date" ).datepicker({  
		//maxDate: new Date,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: new Date().getFullYear() + ':9999',
		onSelect: function(date) {
					$("#eff_start_date").datepicker('option', 'maxDate', date);
				} 
	});
});


$("#is_taxable").change(function(){ 
	var is_taxable = $(this).val();
	
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/pos/getTaxSacData"); ?>',
		data: {
			is_taxable: is_taxable,
			csrf_test_name: '<?= $this->csrf['hash']; ?>'
		},
		dataType: 'json',
		encode: true,
		async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			$('#tax_id').html(response.tax_dropdown);
			$('#sac_code_id').html(response.sac_dropdown);
		}
	});
});

function edit_rate(product_service_sale_rate_id){
	$.ajax({
		type: 'POST',
		url: '<?= base_url("admin/pos/getSaleRateData"); ?>',
		data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', product_service_sale_rate_id: product_service_sale_rate_id},
		dataType: 'json',
		encode: true
	})
	.done(function(data){

		$("#rate").val(data.edit_rate_data.rate);
		$("#eff_start_date").val(data.edit_rate_data.eff_start_date);
		$("#eff_end_date").val(data.edit_rate_data.eff_end_date);
		$("#product_service_sale_rate_id").val(data.edit_rate_data.product_service_sale_rate_id);
		$("#is_taxable").val(data.edit_rate_data.is_taxable).change();
		
		populate_cost_center(data.edit_rate_data.cost_center_id);
		populate_tax(data.edit_rate_data.tax_id, data.edit_rate_data.is_taxable);
		populate_sac_code(data.edit_rate_data.sac_code_id, data.edit_rate_data.is_taxable);
		
	})
	.fail(function(data){
		console.log(data);
	})
}

function populate_cost_center(selected){
	//alert(selected);
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/pos/getAjaxData"); ?>',
		data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', property_id: <?= $product_service['property_id'];?>, action_type: 'cost_center_data'},
		dataType: 'json',
		encode: true
	})
	//ajax response
	.done(function(data){
		if(data.status){
			var result ='';
			result +='<option value="">Select POS</option>';
			$.each(data.cost_center_list,function(key,value){
				result +='<option value="'+value.cost_center_id+'">'+value.cost_center_name+'</option>';
			});
		}
		else{
			result +='<option value="">Nothing selected</option>'
		}
		//alert(result);
		$("#cost_center_id").html(result);
		if(selected){
			$("#cost_center_id").val(selected);
		}
		//$("#cost_center_id").selectpicker("refresh");
	
	})
	
	.fail(function(data){
		// show the any errors
		console.log(data);
	});
}

function populate_tax(selected, is_taxable){
	//alert(selected);
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/pos/getAjaxData"); ?>',
		data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', is_taxable: is_taxable , action_type: 'tax_data'},
		dataType: 'json',
		encode: true
	})
	//ajax response
	.done(function(data){
		if(data.status){
			var result ='';
			$.each(data.tax_master_list,function(key,value){
				result +='<option value="'+value.tax_id+'">'+value.tax_percentage+'</option>';
			});
		}
		else{
			result +='<option value="">Nothing selected</option>'
		}
		//alert(result);
		$("#tax_id").html(result);
		if(selected){
			$("#tax_id").val(selected);
		}
	
	})
	
	.fail(function(data){
		// show the any errors
		console.log(data);
	});
}

function populate_sac_code(selected, is_taxable){
	//alert(selected);
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/pos/getAjaxData"); ?>',
		data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', is_taxable: is_taxable , action_type: 'sac_code_data'},
		dataType: 'json',
		encode: true
	})
	//ajax response
	.done(function(data){
		if(data.status){
			var result ='';
			$.each(data.sac_code_master_list,function(key,value){
				result +='<option value="'+value.sac_code_id+'">'+value.sac_code+'</option>';
			});
		}
		else{
			result +='<option value="">Nothing selected</option>'
		}
		//alert(result);
		$("#sac_code_id").html(result);
		if(selected){
			$("#sac_code_id").val(selected);
		}
	
	})
	
	.fail(function(data){
		// show the any errors
		console.log(data);
	});
}
</script>