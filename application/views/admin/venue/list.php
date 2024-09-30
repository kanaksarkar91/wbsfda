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
                        <h1 class="app-page-title mb-0">Venue List</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                <?php
                                    if(check_user_permission($menu_id, 'add_flag')){
                                ?>
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/venue/addvenue/') ?>">
                                        ADD NEW venue 
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

                <div class="app-card app-card-settings shadow-sm p-3 mb-2">                                     
                    <form class="settings-form" id="" method="post" action="" autocomplete="off">

						<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

                        <div class="app-card-body">   
                            <div class="row g-3">
                                <div class="col-lg-2 col-sm-12 col-md-4">
                                    <label class="col-form-label">Select Property<span class="asterisk"> *</span></label>
                                </div>
                                <div class="col-lg-3 col-sm-12 col-md-4">
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                        <option value="" selected disabled>Select Property</option>
                                        <?php foreach ($property_details as $property) { ?>
                                            <option value="<?= $property['property_id'] ?>" <?php if(!empty($property_id)){ if($property_id == $property['property_id']){ echo 'selected'; } } ?>><?= $property['property_name'] ?></option>
                                        <?php } ?>
                                    
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-12 col-md-4">
                                    <label for="" class="form-label">&nbsp;</label>
                                    <button type="submit" id="btn-form-submit" class="btn app-btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="sports_facilities">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <th class="cell">Venue Name</th>
                                        <th class="cell">Property Name</th>
                                        <th class="cell">Contact No.</th>
                                        <th class="cell">Alt.Contact No.</th>
                                        <th class="cell">Email-id</th>
                                        <th class="cell">Alt. Email-id</th>
                                        <th class="cell">Description</th>
                                        <th class="cell">Available Facilities</th>
                                        <!--<th class="cell">Is hourly booking?</th>
                                        <th class="cell">Hours</th>-->
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($venues)){
                                        $i = 0;
                                    foreach($venues as $venue) { ?>
                                    <tr>
                                        <td class="cell"><?=++$i;?></td>
                                        <td class="cell" style="min-width: 272px;"><?=$venue['venue_name']?></td>
                                        <td class="cell" style="min-width: 150px;"><?=$venue['property_name']?></td>
                                        <td class="cell"><?=$venue['contact_no']?></td>
                                        <td class="cell"><?=($venue['alternative_contact_no'])?$venue['alternative_contact_no']:'N/A'?></td>
                                        <td class="cell"><?=($venue['email'])?$venue['email']:'N/A'?></td>
                                        <td class="cell"><?=($venue['alternative_email'])?$venue['alternative_email']:'N/A'?></td>
                                        <td class="cell" style="min-width: 150px;"><?=($venue['venue_description'])?$venue['venue_description']:'N/A'?></td>
                                        <td class="cell"><?=($venue['available_facilities'])?$venue['available_facilities']:'N/A'?></td>
                                        <!--<td class="cell"><?=($venue['is_hourly_booking'])?'Yes':'No'?></td>
                                        <td class="cell"><?=($venue['booking_hours'])?$venue['booking_hours']:'N/A'?></td>-->
                                        <td class="cell"><span class="<?= ($venue['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($venue['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                        <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                            <a class="btn-sm app-btn-primary" href="<?= base_url('admin/venue/editvenue/' . $venue['venue_id']) ?>">Edit</a>
                                            <?php /* ?><a class="btn app-btn-danger" href="<?= base_url('admin/sports_facilities/deletesports_facilities/' . $sports_facilities['sports_facilities_id']) ?>">Delete</a> <?php */ ?>
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
