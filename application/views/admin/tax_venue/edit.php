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
                <h1 class="app-page-title mb-0">Edit Tax </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/tax_venue'); ?>">
                                VIEW ALL Tax 
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

            <form class="settings-form" method="post" action="<?= base_url('admin/tax_venue/update_tax'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="tax_id" value="<?= $tax['tax_id'];?>">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="tax_name" class="form-label">Define Tax Name <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="tax_name" placeholder="Define Tax Name" value="<?= $tax['tax_name'];?>" required>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="tax_percentage" class="form-label">Tax Percentage <span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="tax_percentage" placeholder="Tax Percentage" value="<?= $tax['tax_percentage'];?>" required>
                            </div>
                            
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="cgst_percentage" class="form-label">CGST Percentage <span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="cgst_percentage" placeholder="CGST Percentage" value="<?= $tax['cgst_percentage'];?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="sgst_percentage" class="form-label">SGST Percentage<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="sgst_percentage" placeholder="SGST Percentage" value="<?= $tax['sgst_percentage'];?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="eff_start_date" class="form-label">Effective Start Date<span class="asterisk"> *</span></label>
                                <input type="date" class="form-control" name="eff_start_date" placeholder="Effective Start Date" value="<?= $tax['eff_start_date'];?>" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="tax_status" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="tax_status" class="form-select" id="" required>
                                    <option value="1" <?= $tax['is_active'] == '1' ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?= $tax['is_active'] == '0' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>

                        </div>
                       
                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?= base_url('admin/tax_venue'); ?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type='text/javascript'>
 
  $(document).ready(function(){
 
  
    });

</script>
