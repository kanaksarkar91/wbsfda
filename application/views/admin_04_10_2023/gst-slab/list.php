        <div class="app-content pt-3 p-md-3 p-lg-3">
           
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>
               <div class="alert alert-success">
                     <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">List GST Slab</h1>
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
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/gst_slab/add_gst_slab'); ?>">
                                        ADD NEW GST Slab 
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
                            <table class="table app-table-hover mb-0 text-left" id="sports_facilities">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <th class="cell">HSN/SAC Code</th>
                                        <th class="cell">GST Percentage</th>
                                        <th class="cell">CGST Percentage</th>
                                        <th class="cell">SGST Percentage</th>
                                        <th class="cell">IGST Percentage</th>
                                        <th class="cell">Starting Price</th>
                                        <th class="cell">Ending Price</th>
										<th class="cell">Starting Date</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
									$i = 1;
									if (isset($gst_slabs))
										foreach($gst_slabs as $slab) {
									?>
                                    <tr>
                                        <td class="cell"><?= $i++; ?></td>
                                        <td class="cell"><?= $slab['hsn_sac_code']; ?></td>
                                        <td class="cell"><?= $slab['gst_percentage']; ?></td>
                                        <td class="cell"><?= $slab['cgst_percentage']; ?></td>
                                        <td class="cell"><?= $slab['sgst_percentage']; ?></td>
                                        <td class="cell"><?= $slab['igst_percentage']; ?></td>
                                        <td class="cell"><?= $slab['startg_price']; ?></td>
										<td class="cell"><?= $slab['ending_price']; ?></td>
										<td class="cell"><?= date('d-m-Y', strtotime($slab['eff_start_date'])); ?></td>
                                        <td class="cell"><span class="<?= ($slab['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($slab['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                            <?php
                                                if(check_user_permission($menu_id, 'edit_flag')){
                                            ?>
                                            <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/gst_slab/edit_gst_slab/' . $slab['hotel_gst_slab_id']) ?>">Edit</a>
                                            <?php
                                                }
                                            ?>
                                            <?php /* ?><a class="btn-sm btn-danger text-white" href="<?= base_url('admin/sports_facilities/deletesports_facilities/' . $sports_facilities['sports_facilities_id']) ?>">Delete</a> <?php */ ?>
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
    $('#sports_facilities').DataTable( {
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