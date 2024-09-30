

        <div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Add New Job Role</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="<?=base_url('admin/role')?>">
                                        VIEW ALL JOB ROLE
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
                        <form class="settings-form" method="post" action="<?php echo base_url('admin/role/submitrole'); ?>" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="" class="form-label">Job Role Name<span class="asterisk"> *</span></label>
                                    <input type="text" class="form-control" id="role_name" name="role_name" value="" required="required">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="" class="form-label me-3">Job Role Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" checked>
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/role')?>">CANCEL</a>
                        </form>
                    </div>
                    <!--//app-card-body-->

                </div>
            </div>
            <!--//container-fluid-->
        </div>
    


