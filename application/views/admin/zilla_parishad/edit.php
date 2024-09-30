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
                <h1 class="app-page-title mb-0">Edit New Zilla Parishad & Others </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/zilla_parishad') ?>">
                                VIEW ALL Zilla Parishad & Others
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

            <form class="settings-form" method="post" action="<?= base_url('admin/zilla_parishad/updatezilla_parishad'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id" value="<?=$zilla_parishad['id'] ?>">

                <div class="app-card-body">
                    <div class="row g-3">
                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="tax_status" class="form-label">District<span class="asterisk"> *</span></label>
                            <select name="district_id" class="form-select select2" id="district_id" required="">
                                <option value="" selected>Select District</option>
                                <?php foreach ($districts as $district) { ?>
                                    <option value="<?= $district['district_id'] ?>" <?= ($district['district_id'] == $zilla_parishad['district_id']) ? 'selected' : '' ?>><?= $district['district_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="" class="form-label">Zilla Parishad Name <span class="asterisk">* </span></label>
                            <input type="text" class="form-control" name="unit_name" required="" value="<?= $zilla_parishad['unit_name'] ?>">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="is_active" class="form-label">Status<span class="asterisk"> *</span></label>
                            <select name="is_active" class="form-select" id="is_active" required>
                                <option value="1" <?= $zilla_parishad['is_active'] == '1' ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?= $zilla_parishad['is_active'] == '0' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                <a class="btn app-btn-danger" href="<?= base_url('admin/zilla_parishad'); ?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>