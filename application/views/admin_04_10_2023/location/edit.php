<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit Field Unit</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/location') ?>">
                                VIEW ALL Location
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

            <div class="app-card-body">
                <form class="settings-form" method="post" action="<?php echo base_url('admin/location/updatelocation'); ?>" enctype="multipart/form-data" autocomplete="off">
                    <input class="form-check-input" type="hidden" name="location_id" value="<?= $location['location_id'] ?>">

                    <div class="app-card-body">
                        <div class="row g-3">

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Division / Workshop<span class="asterisk"> *</span></label>

                                <select name="fieldunit_id" class="form-select" required>
                                    <option value="" selected disabled>Select Division / Workshop</option>
                                    <?php foreach ($fieldunits as $fieldunit) { ?>
                                        <option value="<?= $fieldunit['fieldunit_id'] ?>" <?=($location['fieldunit_id'] == $fieldunit['fieldunit_id'])?'selected':''?>><?= $fieldunit['fieldunit_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Location<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" id="location_name" name="location_name" value="<?=$location['location_name']?>" required>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label me-3">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_0" value="0" <?= ($location['status'] == '0') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" <?= ($location['status'] == '1') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/location')?>">CANCEL</a>
                </form>
            </div>
            <!--//app-card-body-->

        </div>
    </div>
    <!--//container-fluid-->
</div>