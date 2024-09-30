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
                        <h1 class="app-page-title mb-0">List Coupons</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <?php
                                        if(check_user_permission($menu_id, 'add_flag')){
                                    ?>
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/CouponMaster/add'); ?>">
                                        ADD Coupon 
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
                            <table class="table app-table-hover mb-0 text-left" id="coupon_master">
                                <thead>
                                    <tr>
                                    <th class="cell">SL No.</th>
                                        <th class="cell">Code</th>
                                        <th class="cell">Description</th>
                                        <!-- <th class="cell">Property</th> -->
                                        <th class="cell">Valid From</th>
										<th class="cell">Valid Till</th>
										<th class="cell">Amount</th>
										<th class="cell">Type</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									$i = 1;
									if (isset($coupons))
										foreach($coupons as $coupon) {
									?>
                                    <tr>
                                        <td class="cell"><?= $i++; ?></td>
                                        <td class="cell"><?= $coupon['coupon_code'] ?></td>
                                        <td class="cell"><?= $coupon['coupon_desc'] ?></td>
                                        <!-- <td class="cell"><?= $coupon['property'] ?></td> -->
                                        <td class="cell"><?= date('d-m-Y', strtotime($coupon['valid_from_date'])) ?></td>
										<td class="cell"><?= date('d-m-Y', strtotime($coupon['valid_to_date'])) ?></td>
                                        <td class="cell"><?= !empty($coupon['offer_amount']) ? round($coupon['offer_amount']) : round($coupon['offer_perc']).'%' ?></td>
                                        <td class="cell"><?= !empty($coupon['offer_amount']) ? 'Flat' : 'Percentage' ?></td>
                                        <td class="cell"><span class="<?= ($coupon['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($coupon['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                        <td class="cell">
                                            <?php
                                                if(check_user_permission($menu_id, 'edit_flag')){
                                            ?>
                                            <a class="btn-sm app-btn-primary" href="<?= base_url('admin/CouponMaster/edit/' . $coupon['coupon_id']) ?>">Edit</a>
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
    $('#coupon_master').DataTable( {
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