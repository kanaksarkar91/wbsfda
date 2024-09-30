<style>
.bg-blue1 {
    background-color: #0346a8;
}
.bg-blue3 {
    background-color: #898989;
}
.bg-blue4 {
    background-color: #002760;
}
.bg-green {
    background-color: #02480d;
}
.bg-orng {
    background-color: #ff7c09;
}
.bg-orng3 {
    background-color: #e9b700;
}
.bg-vl {
    background-color: #4f065c;
}
</style>

<div class="app-content pt-3 p-md-3 p-lg-3">
   
	<div class="container-xl">
	<?php if ($this->session->flashdata('success_msg')) : ?>
	   <div class="alert alert-success">
			 <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">�</a>
			<?php echo $this->session->flashdata('success_msg') ?>
		</div>
	<?php endif ?>
	<?php if ($this->session->flashdata('error_msg')) : ?>
		<div class="alert alert-danger">
			<a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">�</a>
			<?php echo $this->session->flashdata('error_msg') ?>
		</div>
	<?php endif ?>

		<div class="row g-3 mb-2 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">POS Sale</h1>
			</div>
			
			<!--//col-auto-->
		</div>
		<!--//row-->
		
		<div class="app-card app-card-orders-table shadow-sm mb-2 p-3">
			<div class="app-card-body">
				<div class="row g-3">
					<div class="col-lg-6 col-sm-12 col-md-6">
						<label for="property_zp" class="form-label">Property <span class="asterisk"></span></label>
						<select name="property_id" class="form-select select2" id="property_id">                               
							<option value="">All Property</option>
							<?php
							if ($property_details)
								foreach($property_details as $row) {
							?>
							<option value="<?= $row['property_id']; ?>" <?= set_select('property_id', $row['property_id'], isset($d_property_id) && $d_property_id == $row['property_id'] ? true : false); ?>><?= $row['property_name']; ?></option>
							<?php } ?>
						</select>
					</div>
					
				</div>
			</div>
		</div>

		<div class="app-card app-card-orders-table shadow-sm mb-5">
			<div class="app-card-body">
				<div class="row p-3" id="populate_pos_data">
					
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
    $("#property_id").change(function(){ 
		var property_id = $(this).val();
		
		$.ajax({
			type: 'POST',	
			url: '<?php echo base_url("admin/pos/getAjaxData"); ?>',
			data: {
				property_id: property_id,
				csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
				action_type: 'pos_data'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				$('#populate_pos_data').html(response.html);
			}
		});
	});
} );
</script>