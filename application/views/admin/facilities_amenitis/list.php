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
                        <h1 class="app-page-title mb-0">Facilities</h1>
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
                                    <a class="btn app-btn-primary" href="<?=base_url('admin/facilities_amenitis/addfacilities_amenitis')?>">
                                        ADD Facilities
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
                            <table class="table app-table-hover mb-0 text-left" id="facilities_amenitis">
                                <thead>
                                    <tr>
                                        <th class="cell">Sl. ID.</th>
                                        <th class="cell">Facilities</th>
                                        <!-- <th class="cell">Created On</th> -->
                                        <th class="cell">Facility Type</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($facilities_amenitiss)){
                                    foreach($facilities_amenitiss as $index => $facilities_amenitis) { ?>
                                    <tr>
                                        <td class="cell"><?= ($index+1) ?></td>
                                        <td class="cell"><?= $facilities_amenitis['facility_name'] ?></td>
                                        <!-- <td class="cell"><?= date('d-m-Y H:i:s',strtotime($facilities_amenitis['created_ts'])) ?></td> -->
                                        <td><?=($facilities_amenitis['facility_type'] == 'R' ? 'Room' : ( $facilities_amenitis['facility_type'] == 'P' ? 'Property' : '') ); ?></td>
                                        <td class="cell"><span class="<?= ($facilities_amenitis['status'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($facilities_amenitis['status'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <a class="btn btn-sm app-btn-primary" href="<?= base_url('admin/facilities_amenitis/editfacilities_amenitis/' . $facilities_amenitis['facility_id']) ?>">Edit</a>
                                        <?php
                                            }
                                        ?>
                                            <!-- <a class="btn-sm btn-danger text-white" href="<?= base_url('admin/facilities_amenitis/deletefacilities_amenitis/' . $facilities_amenitis['facility_id']) ?>">Delete</a> -->
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
    $('#facilities_amenitis').DataTable( {
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