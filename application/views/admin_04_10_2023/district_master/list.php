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
                        <h1 class="app-page-title mb-0"> District List</h1>
                    </div>
                    <!-- <div class="alert alert-success" style="display: none"></div> -->
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
                                    <a class="btn app-btn-primary" href="<?= base_url('admin/district/add_district'); ?>">
                                        ADD NEW District
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
                            <table class="table app-table-hover mb-0 text-left" id="district_table">
                                <thead>
                                    <tr>
                                        <th class="cell">SL No.</th>
                                        <th class="cell">District Name</th>
                                        <th class="cell">District Code</th>
                                        <th class="cell">State Name</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                        <!-- <th class="cell">Image</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($districts)) {
                                         $i = 0;
                                        foreach ($districts as $row) {
                                    ?>
                                            <tr>
                                                <td class="cell"><?=++$i;?></td>
                                                <td class="cell"><?=$row['district_name'] ?></td>
                                                <td class="cell"><?=$row['district_code'] ?></td>
                                                <td class="cell"><?=$row['state_name'] ?></td>
                                                <td class="cell"><span class="<?= ($row['is_active'] == 1) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($row['is_active'] == 1) ? 'Active' : 'Inactive' ?></span></td>
                                                <!-- <td class="cell"><input type="file" id="<?='district_image_'.$row['district_id'] ?>" name="district_image" placeholder="upload Image" ><button class="<?= ($row['district_image'] != NULL) ? 'badge bg-success' : 'badge bg-secondary' ?> upload_image" type="button" data-district_id="<?=$row['district_id'] ?>"><?= ($row['district_image'] != NULL) ? 'Uploaded' : 'Upload' ?></button></td> -->
                                                <!-- <td class="cell">
                                                <?php if($row['district_image'] != NULL){ ?>
                                                    <img src="<?= base_url('public/admin_images/district_images/'.$row['district_image']) ?>" width="100px" alt="No !image">
                                                <?php } ?>
                                                </td> -->
                                                <td class="cell">
                                                <?php
                                                    if(check_user_permission($menu_id, 'edit_flag')){
                                                ?>
                                                    <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/district/edit_district/' . $row['district_id']) ?>">Edit</a>
                                                <?php
                                                    }
                                                ?>
                                                </td>
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
        <script type='text/javascript'>
            
            $(document).ready(function(){

                $('.upload_image').click(function(){
                var district_id = $(this).data("district_id");
                var formData = new FormData();
                    formData.append('district_id', district_id);
                    formData.append('district_image', $('#district_image_'+district_id)[0].files[0]);

                    $.ajax({
                        url:'<?php echo base_url("admin/district/updatedistrictimages"); ?>',
                        method: 'post',
                        dataType: 'json',
                        data : formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            if(response.status==true){
                                $(".alert-success").html(response.msg);
                                $(".alert-success").show();
                                window.setTimeout(function(){location.reload()},3000)
                            }
                        }
                    });
                });
            });

        </script>