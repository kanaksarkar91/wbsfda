<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">EDIT WORKER</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/wages/worker_list">
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

			<div class="row g-3 mb-3 align-items-center">
				<?= $this->session->flashdata('msg'); ?>
			</div>


			<form method="POST" action="" id="osaleform">

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<input type="hidden" name="worker_id" value="<?= $worker_details['worker_master_id']; ?>">

				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					<!--<div class="app-card-header mb-3">
						<div class="col-md-12 details_head">
							<h5 class="text-info"><span class="propName"></span> EDIT WORKER</h5>
						</div>
					</div>-->
					<div class="app-card-body">
						<div class="row g-2">
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Select Unit</label>
								<select name="property_id" class="form-control select2 property_id" id="property_id" required>
									<option value="">Select Unit</option>
									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if($worker_details['harbour_id'] == $property['property_id']){ echo 'selected'; } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Name</label>
								<input type="text" name="worker_name" class="form-control worker_name" id="worker_name" value="<?= $worker_details['worker_name']; ?>" required>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Gender</label>
								<select name="worker_gender" class="form-control select2 worker_gender" id="worker_gender">
									<option value="">Select Gender</option>	
									<option value="Male" <?php if(!empty($worker_details['worker_gender'])){ if($worker_details['worker_gender'] == 'Male'){ echo 'selected'; } } ?>>Male</option>
									<option value="Female" <?php if(!empty($worker_details['worker_gender'])){ if($worker_details['worker_gender'] == 'Female'){ echo 'selected'; } } ?>>Female</option>
									<option value="Transgender" <?php if(!empty($worker_details['worker_gender'])){ if($worker_details['worker_gender'] == 'Transgender'){ echo 'selected'; } } ?>>Transgender</option>								
								</select>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Mobile No.</label>
								<input type="text" name="mobile_no" class="form-control mobile_no" id="mobile_no" value="<?= $worker_details['mobile_no']; ?>" required>
							</div>

							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Beneficiary Account Name</label>
								<input type="text" name="beneficiary_account_name" class="form-control beneficiary_account_name" id="beneficiary_account_name" value="<?php if(!empty($worker_details['beneficiary_account_name'])){ echo $worker_details['beneficiary_account_name']; } ?>">
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Beneficiary Account No.</label>
								<input type="text" name="beneficiary_account_no" class="form-control beneficiary_account_no" id="beneficiary_account_no" value="<?php if(!empty($worker_details['beneficiary_account_no'])){ echo $worker_details['beneficiary_account_no']; } ?>">
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Beneficiary Bank</label>
								<input type="text" name="beneficiary_bank" class="form-control beneficiary_bank" id="beneficiary_bank" value="<?php if(!empty($worker_details['beneficiary_bank'])){ echo $worker_details['beneficiary_bank']; } ?>">
							</div>
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="" class="form-label">Beneficiary IFSC</label>
								<input type="text" name="beneficiary_ifsc" class="form-control beneficiary_ifsc" id="beneficiary_ifsc" value="<?php if(!empty($worker_details['beneficiary_ifsc'])){ echo $worker_details['beneficiary_ifsc']; } ?>">
							</div>

							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Daily Wages</label>
								<input type="text" name="wage_amount" class="form-control wage_amount" id="wage_amount" value="<?php if(!empty($worker_details['daily_wage_amount'])){ echo $worker_details['daily_wage_amount']; } ?>" required>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Applicable From Date</label>
								<div class="date-container">
									<input type="text" name="bill_date" class="form-control bill_date" id="bill-date" value="<?php if(!empty($worker_details['applicable_date'])){ echo date("d-m-Y", strtotime($worker_details['applicable_date'])); } ?>" required>
									<i class="date-icon fa fa-calendar"></i>
								</div>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label w-100">&nbsp;</label>
								<div>
									<label for="" class="form-label">Active</label>
									<input type="radio" name="is_active" class="is_active" value="1" <?php if($worker_details['is_active'] == '1'){ echo 'checked'; } ?>>

									<label for="" class="form-label">Inactive</label>
									<input type="radio" name="is_active" class="is_active" value="0" <?php if($worker_details['is_active'] == '0'){ echo 'checked'; } ?>>
								</div>
							</div>
							<div class="col-md-12 text-end">
								<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
								<input type="submit" class="btn app-btn-primary submitAgreement" value="UPDATE">
							</div>

						</div>
					</div>
				</div>
				
			</form>


		</div>
	</div>
	<!--//app-content-->

	<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<!--</div>
//app-wrapper-->


