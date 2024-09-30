<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-3 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Edit Buyer</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/harbour_buyer">
									Back
								</a>
							</div>
						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>

			<div class="row g-3 mb-2 align-items-center">
				<?= $this->session->flashdata('msg'); ?>
			</div>


			<form method="POST" action="" id="dailyIncomeform">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

                <input type="hidden" name="buyer_id" value="<?= $buyer_details['harbour_buyer_id']; ?>">
				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					
					<div class="app-card-body">
						<div class="row g-3">							
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label">Name</label>
								<input type="text" name="buyer_name" class="form-control buyer_name" value="<?= $buyer_details['harbour_buyer_name']; ?>" required>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label">Mobile No. (if available)</label>
								<input type="text" name="mobile_no" class="form-control mobile_no" value="<?= $buyer_details['harbour_buyer_mobile']; ?>">
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label">Select Harbour</label>
								<select name="property_id[]" multiple class="form-control property_id" id="selectEvents" required>
									<option value="0">All</option>
									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php foreach($buyer_details['harbour_list'] as $harbour_list){ if($harbour_list['harbour_id'] == $property['property_id']){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="" class="form-label w-100">&nbsp;</label>
								<div>
									<label for="" class="form-label">Harbour Buyer</label>
									<input type="radio" name="buyer_type" class="buyer_type" value="B" <?php if($buyer_details['buyer_type'] == 'B'){ echo 'checked'; } ?>>

									<label for="" class="form-label">Licensee</label>
									<input type="radio" name="buyer_type" class="buyer_type" value="L" <?php if($buyer_details['buyer_type'] == 'L'){ echo 'checked'; } ?>>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 text-end">
					<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
					<input type="submit" class="btn app-btn-primary" value="UPDATE">
				</div>
			</form>


		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->
