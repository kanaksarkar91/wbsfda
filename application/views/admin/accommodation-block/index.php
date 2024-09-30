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
                <h1 class="app-page-title mb-0">Accomodation Block</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                         <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center" method="post">
							<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                                <div class="col-auto">
                                    <select name="property_id" class="form-select select2" id="property_id">                               
										<option value="0">All Property</option>
										<?php
										if ($property_details)
											foreach($property_details as $row) {
										?>
										<option value="<?= $row['property_id']; ?>" <?= set_select('property_id', $row['property_id'], isset($d_property_id) && $d_property_id == $row['property_id'] ? true : false); ?>><?= $row['property_name']; ?></option>
										<?php } ?>
									</select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>
                        </div> 
                        <!--//col-->
                        <div class="col-auto">
                            <?php
                                if(check_user_permission($menu_id, 'add_flag')){
                            ?>
                            <a class="btn app-btn-primary" href="<?=base_url('admin/AccommodationBlock/add')?>">
                                ADD ACCOMMODATION BLOCK
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

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left" id="accommodation-blocked">
                        <thead>
                            <tr>
                                <th class="cell">ID</th>
                                <th class="cell">Start Date</th>
                                <th class="cell">End Date</th>
                                <th class="cell">Property</th>
                                <th class="cell">Accommodation</th>
                                <th class="cell">Room No.</th>
                                <th class="cell">Remarks</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i=0;
                            if(!empty($accommodations)){
                            foreach($accommodations as $accommodation) {$i++; ?>
                            <tr>
                                <td class="cell"><?= $i ?></td>
                                <td class="cell"><?= date('d-m-Y', strtotime($accommodation->from_date)) ?></td>
                                <td class="cell"><?= date('d-m-Y', strtotime($accommodation->to_date)) ?></td>
                                <td class="cell"><?= $accommodation->property_name ?></td>
                                <td class="cell"><?= !empty($accommodation->accommodation_name) ? $accommodation->accommodation_name : "All Accommodations" ?></td>
                                <td class="cell"><?= $accommodation->room_no;?></td>
                                <td class="cell"><?= !empty($accommodation->remarks) ? $accommodation->remarks : '' ?></td>
                                <td class="cell">
                                <?php
                                    if(check_user_permission($menu_id, 'edit_flag')){
                                ?>
                                    <?php /*?><a class="btn-sm app-btn-secondary" href="<?= base_url('admin/AccommodationBlock/edit/' . $accommodation->blocked_id ) ?>">Edit</a><?php */?>
                                <?php
                                    }
                                ?>
                                    <a class="btn-sm btn-danger text-white" href="<?= base_url('admin/AccommodationBlock/delete/' . $accommodation->blocked_id) ?>" onclick="return confirm('Are you sure to delete this?')">Delete</a>
                                </td>
                            </tr>
                            <?php } 
                            }?>

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
    $('#accommodation-blocked').DataTable( {
        "bInfo": false,
       "ordering": false        
    } );
} );
</script>