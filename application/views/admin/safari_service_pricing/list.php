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
                        <h1 class="app-page-title mb-0">Safari Services Pricing</h1>
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
                                    <?php
                                        if(check_user_permission($menu_id, 'add_flag')){
                                    ?>
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/safari_service_pricing/add_service_pricing'); ?>">
                                        Add Safari Service Pricing
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
                                <label for="property_zp" class="form-label">Division <span class="asterisk"></span></label>
                                <select name="division_id" class="form-select select2" id="division_id" <?= in_array($this->admin_session_data['role_id'], [ROLE_SUPERADMIN]) ? '' : 'disabled' ?> >                               
                                    <option value="">All Division</option>
                                    <?php
                                    if ($divisions)
                                        foreach($divisions as $row) {
                                    ?>
                                    <option value="<?= $row['division_id']; ?>" <?php echo ($row['division_id'] == $division_id) ? 'selected' : ''; ?>><?= $row['division_name']; ?></option>
                                    <?php } ?>
                                </select>
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
                            <table class="table app-table-hover mb-0 text-left" id="property_listing_table">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <th class="cell">Division</th>
                                        <th class="cell">Service Type</th>
                                        <th class="cell">Service</th>
                                        <th class="cell">Season</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
								$i = 1;
								if (isset($servicePricing))
									foreach($servicePricing as $row) {
								?>
                                    <tr>
                                        <td class="cell"><?= $i++; ?></td>
                                        <td class="cell"><?= $row['division_name']; ?></td>
                                        <td class="cell"><?= $row['type_name']; ?></td>
                                        <td class="cell"><?= $row['service_definition']; ?></td>
                                        <td class="cell"><?= $row['showing_desc']; ?></td>
                                        <td class="cell"><span class="<?= ($row['is_active'] != 0) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($row['is_active'] != 0) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <a class="btn-sm app-btn-primary" href="<?= base_url('admin/safari_service_pricing/edit_service_pricing/' . encode_url($row['safari_service_header_id']).'/'.encode_url($row['service_period_master_id'])) ?>">View & Terminate</a>
                                        <?php
                                            }
                                        ?>
                                        </td>
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
 $(document).ready(function() {
    $('#property_listing_table').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
		"pageLength": 50,
       // "searching": false
        
    } );
} );
</script>
