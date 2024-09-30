<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">ADD CANCELLATION POLICY</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/CancellationPolicy') ?>">
                                VIEW ALL POLICIES
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
                <?php
                    if($msg = $this->session->flashdata('error_msg')){
                        echo '<p class="text-danger validation_message">'.$msg.'</p>';
                    }
                ?>
                <form class="settings-form" id="" method="post" action="<?= base_url('admin/CancellationPolicy/save') ?>" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
				
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="day_from" class="form-label">Days From<span class="asterisk"> *</span></label>
                            <input type="number" min="1" step="1" class="form-control" id="day_from" name="day_from" value="" required>
                        </div>
						<div class="col-sm-12 col-md-4 mb-3">
                            <label for="day_to" class="form-label">Days To<span class="asterisk"> *</span></label>
                            <input type="number" min="1" step="1" class="form-control" id="day_to" name="day_to" value="" required>
                        </div>						
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="cancellation_per" class="form-label">Cancellation Percentag<span class="asterisk"> *</span></label>
                            <input type="number" min=".01" step=".01" class="form-control" id="cancellation_per" name="cancellation_per" value="" required>
                        </div>
                    </div>
                            
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="status" class="form-label me-3">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" id="FieldStatusRadio1" value="0" checked="">
                                <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_active" id="FieldStatusRadio2" value="1">
                                <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="unit_id" name="unit_id">
                    <button type="submit" class="btn app-btn-primary" id="btn-form-submit">SUBMIT</button>
                    <a class="btn app-btn-danger" href="<?=base_url('admin/CancellationPolicy')?>">CANCEL</a>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>