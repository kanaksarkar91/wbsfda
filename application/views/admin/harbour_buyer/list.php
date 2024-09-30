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
					<h1 class="app-page-title mb-0">Harbour Buyer List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/harbour_buyer/add_buyer">
									Add Buyer
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
									<th class="cell">Name</th>
									<th class="cell">Mobile</th>
									<th class="cell">Buyer Type</th>
									<th class="cell">Harbour</th>
									<th class="cell">Status</th>
									<th class="cell">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								if (isset($buyer_list))
									foreach($buyer_list as $buyer) {
								?>
								<tr>
									<td class="cell"><?= $i++; ?></td>
									<td class="cell"><?= $buyer['harbour_buyer_name'] ?></td>
									<td class="cell"><?= $buyer['harbour_buyer_mobile'] ?></td>
									<td class="cell"><?php if($buyer['buyer_type'] == 'B'){ echo 'Harbour Buyer'; } else { echo 'Licensee'; } ?></td>

									<td class="cell">
										<?php $j = 1; ?>
										<?php foreach($buyer['harbour_list'] as $harbours){ ?>
											<?php if($j <= 4){ ?>
												<span class="badge bg-info"><?= $harbours['property_name']; ?></span>
											<?php } ?>
											<?php $j++; ?>
										<?php } ?>
									</td>

									<td class="cell"><span class="<?= ($buyer['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($buyer['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
									<td class="cell">
										<?php
											//if(check_user_permission($menu_id, 'edit_flag')){
										?>
										<a class="btn-sm app-btn-primary" href="<?= base_url('admin/harbour_buyer/edit/' . $buyer['harbour_buyer_id']); ?>">Edit</a>
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

<script>
 $(document).ready(function() {
    $('#hurbour_buyer').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
       // "searching": false
        
    } );
} );
</script>

