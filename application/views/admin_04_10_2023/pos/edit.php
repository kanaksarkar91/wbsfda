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
                <h1 class="app-page-title mb-0">Edit POS </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/pos') ?>">
                                VIEW ALL POS
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

            <form class="settings-form" method="post" action="<?= base_url('admin/pos/updatepos'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
				<input type="hidden" name="slug" value="<?= $slug; ?>">
                <input type="hidden" name="cost_center_id" value="<?= encode_url($pos['cost_center_id']); ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>" <?= ($pos['property_id'] == $property['property_id']) ? 'selected' : '' ?>><?= $property['property_name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">POS Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="cost_center_name" value="<?php echo $pos['cost_center_name'];?>" placeholder="POS Name" required>                              
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">GSTIN<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="gstin" placeholder="GSTIN" value="<?php echo $pos['gstin'];?>" required>                              
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">FSSAI<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="fssai" value="<?php echo $pos['fssai'];?>" placeholder="FSSAI">                              
                            </div>
                            <?php /*?><div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">POS Code<span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="cost_center_code" value="<?php echo $pos['cost_center_code'];?>" placeholder="POS Code">                              
                            </div><?php */?>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" <?= ($pos['is_active'] == 1) ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= ($pos['is_active'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="submit" value="1" />
                                <button type="submit" class="btn app-btn-primary">UPDATE</button>
                                <a class="btn app-btn-danger" href="">CANCEL</a>
                            </div>
							
                        </div>

                </div>
                
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>
