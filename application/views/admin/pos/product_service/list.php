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
                        <h1 class="app-page-title mb-0">Product/Service List</h1>
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
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/pos/addproductservice') ?>">
                                        ADD Product/Service
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
                            <table class="table app-table-hover mb-0 text-left" id="category_list_table">
                                <thead>
                                    <tr>
                                    	<th class="cell">SL No.</th>
                                        <th class="cell">Product/Service Name</th>
										<th class="cell">Type</th>
										<!--<th class="cell">Product/Service Code</th>-->
                                        <th class="cell">Property Name</th>
										<!--<th class="cell">POS Name</th>-->
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($products)){
                                        $i = 0;
                                    foreach($products as $row) { ?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell"><?=$row['product_service_name']?></td>
										<td class="cell"><?=($row['product_service_flag'] == 'P') ? 'Product' : 'Service';?></td>
										<?php /*?><td class="cell"><?=$row['product_service_code']?></td><?php */?>
                                        <td class="cell"><?=$row['property_name']?></td>
										<?php /*?><td class="cell"><?=$row['cost_center_name']?></td><?php */?>
                                        <td class="cell"><span class="<?= ($row['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($row['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <a class="btn btn-sm app-btn-primary" href="<?= base_url('admin/pos/editproductservice/' . encode_url($row['product_service_id']));?>">Edit</a>
											
											<a class="btn btn-sm btn-warning" href="<?= base_url('admin/pos/sale_rate/' . encode_url($row['product_service_id']));?>">&#x20B9;</a>
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
 $(document).ready(function() {
    $('#category_list_table').DataTable( {
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