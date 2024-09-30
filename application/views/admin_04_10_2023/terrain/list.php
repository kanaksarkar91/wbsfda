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
                        <h1 class="app-page-title mb-0">Location List</h1>
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
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/terrain/add_terrain'); ?>">
                                        ADD Location
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
                            <table class="table app-table-hover mb-0 text-left" id="location_list_table">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <th class="cell">Location Name</th>
                                        <th class="cell">Location Image</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									$i = 1;
									if (isset($terrains))
										foreach($terrains as $terrain) {
									?>
                                    <tr>
                                        <td class="cell"><?= $i++; ?></td>
                                        <td class="cell"><?= $terrain['terrain_name']; ?></td>
                                        <td class="cell" style="width: 250.488px;"><img src="<?= base_url() . 'public/admin_images/landscape_images/' . $terrain['landscape_image'] ?>" class="img-bordered" alt="Landscape Images"></td>
                                        <td class="cell"><span class="<?= ($terrain['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($terrain['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/terrain/edit_terrain/' . $terrain['terrain_id']) ?>">Edit</a>
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
    $('#location_list_table').DataTable( {
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