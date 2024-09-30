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
                <h1 class="app-page-title mb-0">Edit Item </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/parking_item') ?>">
                                VIEW ALL Item
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

            <form class="settings-form" method="post" action="<?= base_url('admin/parking_item/updateitem'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                <input type="hidden" name="item_id" value="<?= encode_url($item['item_id']); ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>" <?= ($item['property_id'] == $property['property_id']) ? 'selected' : '' ?>><?= $property['property_name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Item Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="item_name" placeholder="Item Name" value="<?= $item['item_name'];?>" required>
							</div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Unit of Measurement<span class="asterisk"> *</span></label>
                                <select name="uom_id" class="form-select select2" id="uom_id" required>
                                    <option value="" selected disabled>Select Unit of Measurement</option>
                                    <?php foreach ($uoms as $uom) { ?>
                                        <option value="<?= $uom['uom_id'] ?>" <?= ($item['uom_id'] == $uom['uom_id']) ? 'selected' : '' ?>><?= $uom['uom_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">GST Rate(%)<span class="asterisk"> *</span></label>
                                <select name="gst_percentage" class="form-select select2" id="gst_percentage" required>
                                    <?php foreach ($taxs as $tax) { ?>
                                        <option value="<?= $tax['tax_percentage'] ?>"  <?= ($item['gst_percentage'] == $tax['tax_percentage']) ? 'selected' : '' ?>><?= $tax['tax_percentage'] ?></option>
                                    <?php } ?>
                                </select>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">HSN / SAC<span class="asterisk"> *</span></label>
                                <select name="sac_code" class="form-select select2" id="sac_code" required>
                                    <?php foreach ($sacs as $sac) { ?>
                                        <option value="<?= $sac['sac_code'] ?>" <?= ($item['sac_code'] == $sac['sac_code']) ? 'selected' : '' ?>><?= $sac['sac_code'] ?></option>
                                    <?php } ?>
                                </select>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Whether GST will be include in Price<span class="asterisk"> *</span></label>
                                <select class="form-select" name="gst_include_in_price" id="gst_include_in_price" required="">
									<option value="Yes" <?= ($item['gst_include_in_price'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
									<option value="No" <?= ($item['gst_include_in_price'] == 'No') ? 'selected' : '' ?>>No</option>
								</select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Item Price<span class="asterisk"> *</span></label>
                                <input type="number" class="form-control" name="price" placeholder="Item Price" step="0.01" value="<?= $item['price'];?>" required>
							</div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" <?= ($item['is_active'] == '1') ? 'selected' : '' ?>>Active</option>
                                    <option value="2" <?= ($item['is_active'] == '2') ? 'selected' : '' ?>>Inactive</option>
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

