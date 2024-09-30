<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
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
			<div class="row g-3 mb-3 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Harbour Product List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/harbour_products/add_product">
									Add Product
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

			<div class="app-card app-card-orders-table shadow-sm mb-5">
				<div class="app-card-body">
					<div class="table-responsive">
						<table class="table app-table-hover mb-0 text-left" id="hurbour_buyer">
							<thead>
								<tr>
								<th class="cell">SL No.</th>
									<th class="cell">Product Name</th>
									<th class="cell">UOM</th>
									<th class="cell">Product Type</th>
									<th class="cell">Status</th>
									<th class="cell">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								if (isset($product_list))
									foreach($product_list as $product) {
								?>
								<tr>
									<td class="cell"><?= $i++; ?></td>
									<td class="cell"><?= $product['harbour_product_name'] ?></td>
									<td class="cell"><?= $product['uom_name'] ?></td>
									<td class="cell"><?php if($product['product_type'] == 'P'){ echo 'Harbour Products'; } else { echo 'Harbour Facility'; } ?></td>
									<td class="cell"><span class="<?= ($product['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($product['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
									<td class="cell">
										<?php
											//if(check_user_permission($menu_id, 'edit_flag')){
										?>
										<a class="btn-sm app-btn-primary" href="<?= base_url('admin/harbour_products/edit_product/' . $product['harbour_product_id']); ?>">Edit</a>
										<?php
											//}
										?>
										<?php /* ?><a class="btn-sm app-btn-danger" href="<?= base_url('admin/sports_facilities/deletesports_facilities/' . $sports_facilities['sports_facilities_id']) ?>">Delete</a> <?php */ ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!--//table-responsive-->
				</div>
			</div>

		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->

