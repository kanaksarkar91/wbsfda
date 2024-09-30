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

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add POS </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/pos') ?>">
                                View All POS
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

        <div class="app-card app-card-settings shadow-sm p-3">

            <form class="settings-form" method="post" action="<?= base_url('admin/pos/insertpos'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
			<input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-6">
								<label for="" class="form-label w-100">Is it a POS</label>
								<div>
									<input type="radio" name="is_it_pos" value="1" checked="" autocomplete="off">
									<label for="" class="form-label">Yes</label>
									

									<input type="radio" name="is_it_pos" value="2" autocomplete="off">
									<label for="" class="form-label">No</label>
									
								</div>
							</div>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="" class="form-label">POS Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="cost_center_name" placeholder="POS Name" required>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="" class="form-label">GSTIN<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="gstin" placeholder="GSTIN" required>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="" class="form-label">FSSAI<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="fssai" placeholder="FSSAI">                              
                            </div>
                            <!--<div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">POS Code<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="cost_center_code" placeholder="POS Code">                              
                            </div>-->
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="submit" value="1"/>                               
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                                <a class="btn app-btn-danger" href="">CANCEL</a>
                            </div>
							
                        </div>
                       
                </div>
                 
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

