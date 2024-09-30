<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-2 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit Facilities</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-primary" href="<?=base_url('admin/facilities_amenitis')?>">
                                        View All Facilities
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

                    <div class="app-card-body">
                        <form class="settings-form" method="post" action="<?= base_url('admin/facilities_amenitis/updatefacilities_amenitis'); ?>" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
							<input class="form-check-input" type="hidden" name="facilities_amenitis_id" value="<?=$facilities_amenitis['facility_id'] ?>">
                            
                            <div class="app-card-body"> 
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="" class="form-label">Facilities<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="facilities_amenitis_name" name="facilities_amenitis_name" value="<?=$facilities_amenitis['facility_name']?>" required>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="" class="form-label me-3">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_0" value="1" <?=($facilities_amenitis['status'] == '1') ? 'checked' : ''?>>
                                            <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_1" value="0" <?=($facilities_amenitis['status'] == '0') ? 'checked' : ''?>>
                                            <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="" class="form-label me-3">Type</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="facility_type" id="status_2" value="P" <?=($facilities_amenitis['facility_type'] == 'P') ? 'checked' : ''?> >
                                            <label class="form-check-label" for="FieldStatusRadio1">Property</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="facility_type" id="status_3" value="R" <?=($facilities_amenitis['facility_type'] == 'R') ? 'checked' : ''?>>
                                            <label class="form-check-label" for="FieldStatusRadio2">Room</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <button type="submit" class="btn app-btn-primary">UPDATE</button>
                                        <a class="btn app-btn-danger" href="<?=base_url('admin/facilities_amenitis')?>">CANCEL</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--//app-card-body-->

                </div>
            </div>
            <!--//container-fluid-->
        </div>