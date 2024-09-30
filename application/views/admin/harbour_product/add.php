<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-3 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Add Product</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/harbour_products">
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


				<div class="app-card app-card-settings shadow-sm p-3 mb-3">
					
					<div class="app-card-body">
						<div class="row g-3">							
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Product Name</label>
								<input type="text" name="product_name" class="form-control product_name" required>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label">Select UOM</label>
								<select name="uom_id" class="form-control select2 uom_id" id="uom_id" required>									
									<?php if(!empty($uom_list)){ ?>

										<?php foreach($uom_list as $uom){ ?>
											<option value="<?= $uom['uom_id']; ?>"><?= $uom['uom_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
							</div>
							<div class="col-sm-6 col-md-4 col-lg-4">
								<label for="" class="form-label w-100">&nbsp;</label>
								<div>
									<input type="radio" name="product_type" class="product_type" value="P" checked>
									<label for="" class="form-label">Harbour Products</label>
									
									<input type="radio" name="product_type" class="product_type" value="F">
									<label for="" class="form-label">Harbour Facility</label>
									
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 text-end">
					<!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
					<input type="submit" class="btn app-btn-primary" value="SUBMIT">
				</div>
			</form>


		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->
