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

               <div class="row g-3 mb-4 align-items-center justify-content-between">
                   <div class="col-auto">
                       <h1 class="app-page-title mb-0">Banner List</h1>
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
                                   <a class="btn app-btn-primary" href="<?=base_url('admin/banner/addbanner')?>">
                                       ADD NEW BANNER
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
                           <table class="table app-table-hover mb-0 text-left" id="banner">
                               <thead>
                                   <tr>
                                       <th class="cell">Title</th>
                                       <th class="cell" width="275.7px">Description</th>
                                       <th class="cell">Banner Image</th>
                                       <th class="cell">Slug</th>
                                       <th class="cell">Created On</th>
                                       <th class="cell">Status</th>
                                       <th class="cell">Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                               <?php 
                                   if(!empty($banners)){
                                   foreach($banners as $banner) { ?>
                                   <tr>
                                       <td class="cell"><?= $banner['title'] ?></td>
                                       <td class="cell"><?= $banner['description'] ?></td>
                                       <td class="cell"><img src="<?= base_url('public/admin_images/banner_images/'.$banner['banner_image']) ?>" width="100px"></td>
                                       <td class="cell"><?= $banner['slug'] ?></td>
                                       <td class="cell"><?= date('d-m-Y H:i:s',strtotime($banner['created_ts'])) ?></td>
                                       <td class="cell"><span class="<?= ($banner['status'] == 0) ? 'badge bg-success' : 'badge bg-secondary' ?>"><?= ($banner['status'] == 0) ? 'Active' : 'Inactive' ?></span></td>
                                       <td class="cell">
                                       <?php
                                            if(check_user_permission($menu_id, 'edit_flag')){
                                        ?>
                                           <a class="btn-sm app-btn-secondary" href="<?= base_url('admin/banner/editbanner/' . $banner['banner_id']) ?>">Edit</a>
                                        <?php
                                            }
                                        ?>
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
   $('#banner').DataTable( {
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