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
                        <h1 class="app-page-title mb-0"><?= $slug;?></h1>
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
                                    <a class="btn app-btn-primary" href="<?=base_url('admin/sports_facilities/addsports_facilities?slug='.$slug)?>">
                                        ADD NEW <?= strtoupper($slug)?>
                                    </a>
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
                                    <th class="cell">#</th>
                                        <th class="cell">Accommodation Category Name</th>
                                        <th class="cell">Accommodation Class</th>
                                        <th class="cell">Accommodation Type</th>
                                        <th class="cell">Allowed Pax</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($sports_facilitiess)){
                                    foreach($sports_facilitiess as $sports_facilities) { ?>
                                    <tr>
                                        <td class="cell">1</td>
                                        <td class="cell">Double Bedded Deluxe	</td>
                                        <td class="cell">AC	</td>
                                        <td class="cell">Room</td>
                                        <td class="cell">2</td>
                                        <td class="cell"><span class="<?= ($sports_facilities['status'] == 0) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($sports_facilities['status'] == 0) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                            <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/sports_facilities/editsports_facilities/' . $sports_facilities['sports_facilities_id'].'?slug='.$slug) ?>">Edit</a>
                                            <!-- <a class="btn-sm btn-danger text-white" href="<?= base_url('admin/sports_facilities/deletesports_facilities/' . $sports_facilities['sports_facilities_id']) ?>">Delete</a> -->
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