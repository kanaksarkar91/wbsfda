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
                <h1 class="app-page-title mb-0">VENUE BLOCK</h1>
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
                            <a class="btn app-btn-primary" href="<?=base_url('admin/VenueBlock/add')?>">
                                ADD VENUE BLOCK
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
                    <table class="table app-table-hover mb-0 text-left" id="venue-blocked">
                        <thead>
                            <tr>
                                <th class="cell">ID</th>
                                <th class="cell">Start Date</th>
                                <th class="cell">End Date</th>
                                <th class="cell">Property</th>
                                <th class="cell" colspan="2">Venue</th>
                                <th class="cell">Remarks</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i=0;
                            if(!empty($venues)){
                            foreach($venues as $venue) {$i++; ?>
                            <tr>
                                <td class="cell"><?= $i ?></td>
                                <td class="cell"><?= date('d-m-Y', strtotime($venue->from_date)) ?></td>
                                <td class="cell"><?= date('d-m-Y', strtotime($venue->to_date)) ?></td>
                                <td class="cell"><?= $venue->property_name ?></td>
                                <td class="cell"><?= !empty($venue->venue_name) ? $venue->venue_name : "All Venues" ?></td>
                                <td class="cell"><?= !empty($venue->venue_name) ? $venue->no_of_venue : 'All' ?></td>
                                <td class="cell"><?= !empty($venue->remarks) ? $venue->remarks : '' ?></td>
                                <td class="cell">
                                <?php
                                    if(check_user_permission($menu_id, 'edit_flag')){
                                ?>
                                    <div class="m-1"><a class="btn-sm app-btn-primary" href="<?= base_url('admin/VenueBlock/edit/' . $venue->blocked_id ) ?>">Edit</a></div>
                                <?php
                                    }
                                ?>
                                    <div class="m-1"><a class="btn-sm app-btn-danger text-white" href="<?= base_url('admin/VenueBlock/delete/' . $venue->blocked_id) ?>" onclick="return confirm('Are you sure to delete this?')">Delete</a></div>
                                </td>
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
    $('#venue-blocked').DataTable( {
        "bInfo": false,
       "ordering": false        
    } );
} );
</script>