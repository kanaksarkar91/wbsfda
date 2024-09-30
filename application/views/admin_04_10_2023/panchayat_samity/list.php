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
                        <h1 class="app-page-title mb-0">List Panchayat Samity</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                
                                <!--//col--> 
                                <div class="col-auto">
                                    <?php
                                        if(check_user_permission($menu_id, 'add_flag')){
                                    ?>
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/panchayat_samity/addpanchayat_samity') ?>">
                                        ADD NEW Panchayat Samity 
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
                                        <th class="cell">Id</th>
                                        <th class="cell">Zilla Parishad Name</th>
                                        <th class="cell">Panchayat Samity Name</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(!empty($panchayat_samitys)){
                                            $i = 0;
                                        foreach($panchayat_samitys as $panchayat_samity) { ?>
                                        <tr>
                                            <td class="cell"><?=++$i;?></td>
                                            <td class="cell"><?=$panchayat_samity['zilla_parishad_name']?></td>
                                            <td class="cell"><?=$panchayat_samity['panchayat_samity_name']?></td>
                                            <td class="cell"><span class="<?= ($panchayat_samity['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($panchayat_samity['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                            <td class="cell">
                                            <?php
                                                if(check_user_permission($menu_id, 'edit_flag')){
                                            ?>
                                                <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/panchayat_samity/editpanchayat_samity/' . $panchayat_samity['id']) ?>">Edit</a>
                                            <?php
                                                }
                                            ?>
                                                <?php /* ?><a class="btn-sm btn-danger text-white" href="<?= base_url('admin/sports_facilities/deletesports_facilities/' . $sports_facilities['sports_facilities_id']) ?>">Delete</a> <?php */ ?>
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