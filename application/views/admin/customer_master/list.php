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
            <h1 class="app-page-title mb-0">List Customer</h1>
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
                        <!-- <a class="btn app-btn-primary" href="<?= base_url('admin/district_master/add_tax'); ?>">
                            ADD NEW District Master
                        </a> -->
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
                <table class="table app-table-hover mb-0 text-left" id="district_table">
                    <thead>
                        <tr>
                            <th class="cell">SL No.</th>
                            <th class="cell">Customer Name</th>
                            <th class="cell" style="width: 95.2125px;">Date of Birth</th>
                            <th class="cell">Email Id</th>
                            <th class="cell">Contact No</th>
                            <th class="cell">Profile Pic</th>
                            <th class="cell">Address</th>
                            <th class="cell">Status</th>
                            <!--<th class="cell">Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customers)) {
                             $i = 0;
                            foreach ($customers as $row) {
                        ?>
                                <tr>
                                    <td class="cell"><?=++$i;?></td>
                                    <td class="cell"><?=$row['customer_title'].' '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'] ?></td>
                                    <td class="cell"><?= (($row['dob'] == 'NULL') || ($row['dob'] == '')) ? '' : date('d-m-Y',strtotime($row['dob'])) ?></td>
                                    <td class="cell"><?=$row['email'] ?></td>
                                    <td class="cell"><?=$row['mobile_country_code'].''.$row['mobile'] ?></td>
                                    <td class="cell"><img src="<?= base_url('public/customer_images/'.$row['profile_pic']) ?>" width="100px" alt="No !image"></td>
                                    <td class="cell"><?=$row['address'] ?></td>
                                    <td class="cell"><span class="<?= ($row['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($row['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                    <?php /*?><td class="cell">
                                    <?php
                                        if(check_user_permission($menu_id, 'edit_flag')){
                                    ?>
                                        <a class="btn-sm app-btn-primary" href="<?= base_url('admin/customer/edit_customer/' . $row['customer_id']) ?>">Edit</a>
                                    <?php
                                        }
                                    ?>
                                    </td><?php */?>
                                </tr>
                        <?php }
                        } ?>
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
    $('#district_table').DataTable({
        // "order": [[ 3, "desc" ]],
        //"paging": false,
        //"showNEntries" : false,
        //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
        // "searching": false

    });
});
</script>