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
                <h1 class="app-page-title mb-0">Add New GST Slab </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/gst_slab_venue'); ?>">
                                VIEW ALL GST Slab 
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

            <form class="settings-form" method="post" action="<?= base_url('admin/gst_slab_venue/update_gst_slab'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="venue_gst_slab_id" value="<?= $gst_slab['venue_gst_slab_id'];?>">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="hsn_sac_code" class="form-label">HSN/SAC code <span class="asterisk"> *</span></label>
								<!--<input type="text" class="form-control" name="hsn_sac_code" placeholder="HSN/SAC Code" required>-->
                                <select name="hsn_sac_code" class="form-select" required>
									<option>Select HSN/SAC Code</option>
									<?php
									if (isset($hsns))
										foreach($hsns as $hsn) {
									?>
									<option value="<?= $hsn['hsn_sac_id']; ?>" <?= $hsn['hsn_sac_id'] == $gst_slab['hsn_sac_id'] ? 'selected' : ''; ?>><?= $hsn['hsn_sac_code']; ?></option>
									<?php } ?>
								</select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="gst_percentage" class="form-label">Select TAX <span class="asterisk"> *</span></label>
                                <select name="gst_percentage" id="gst_percentage" class="form-select gst_percentage" required>
                                  <option>--Select TAX--</option>
                                  <?php
                                  if (isset($taxes))
                                    foreach($taxes as $tax) {
                                  ?>
                                  <option value="<?= $tax['tax_percentage']; ?>" data-sgst="<?=$tax['sgst_percentage']?>" data-cgst="<?=$tax['cgst_percentage']?>" <?= $tax['tax_percentage'] == $gst_slab['gst_percentage'] ? 'selected' : ''; ?>><?= $tax['tax_name']; ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="gst_percentage" class="form-label">GST Percentage <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="gst_percentage" placeholder="GST Percentage" value="<?= $gst_slab['gst_percentage']; ?>" required>
                            </div>
                            
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="cgst_percentage" class="form-label">CGST Percentage <span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="cgst_percentage" placeholder="CGST Percentage" value="<?= $gst_slab['cgst_percentage']; ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="sgst_percentage" class="form-label">SGST Percentage<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="sgst_percentage" placeholder="SGST Percentage" value="<?= $gst_slab['sgst_percentage']; ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="igst_percentage" class="form-label">IGST Percentage<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="igst_percentage" placeholder="IGST Percentage" value="<?= $gst_slab['igst_percentage']; ?>" required>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="eff_startg_date" class="form-label">Effective Start Date<span class="asterisk"> *</span></label>
                                <input type="date" class="form-control" name="eff_startg_date" placeholder="Effective Start Date" value="<?= $gst_slab['eff_start_date']; ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="start_price" class="form-label">Starting Price<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="start_price" placeholder="SGST Percentage" value="<?= $gst_slab['startg_price']; ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="end_price" class="form-label">Ending Price<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="end_price" placeholder="Ending Price" value="<?= $gst_slab['ending_price']; ?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="status" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="status" class="form-select" id="status" required>
                                    <option value="1" <?= $gst_slab['is_active'] == '1' ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?= $gst_slab['is_active'] == '0' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                <a class="btn app-btn-danger" href="<?= base_url('admin/gst_slab_venue'); ?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>
<script>
$(document).ready(function() {
    // When the GST Percentage dropdown changes
    $('#gst_percentage').change(function() {
        // Get the selected option
        var selectedOption = $('#gst_percentage option:selected');

        // Update the SGST and CGST fields
        $('#sgst_percentage').val(selectedOption.data('sgst'));
        $('#cgst_percentage').val(selectedOption.data('cgst'));

        // Update the IGST field with GST Percentage
        $('#igst_percentage').val(selectedOption.val());

        // Make all three fields readonly
        $('#sgst_percentage, #cgst_percentage, #igst_percentage').prop('readonly', true);
    });
});
</script>