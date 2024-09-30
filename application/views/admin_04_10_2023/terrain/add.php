<style>
    #map {
  height: 400px;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}



</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add Location </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/terrain'); ?>">
                                View All Location 
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

        <div class="app-card app-card-settings shadow-sm p-4">

            <form class="settings-form" method="post" action="<?= base_url('admin/terrain/submit_terrain'); ?>" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
            <input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="terrain_name" class="form-label">Location Name <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="terrain_name" placeholder="Location Name" required>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="sgst_percentage" class="form-label">Image</label>
                                <input type="file" class="form-control" name="landscape_image" placeholder="Image">
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="status" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="status" class="form-select" id="" required>
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>

                        </div>
                       
                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?= base_url('admin/terrain'); ?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>
