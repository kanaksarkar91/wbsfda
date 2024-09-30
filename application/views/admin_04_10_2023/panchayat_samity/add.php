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
                <h1 class="app-page-title mb-0">Add Panchayat Samity
                </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/panchayat_samity') ?>">
                                VIEW ALL Panchayat Samity

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

            <form class="settings-form" method="post" action="<?= base_url('admin/panchayat_samity/submitpanchayat_samity'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="slug" value="">

                <div class="app-card-body">
                    <div class="row g-3">
                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="tax_status" class="form-label">Zilla Parishad Name<span class="asterisk"> *</span></label>
                            <select name="zilla_parishad" class="form-select select2" id="zilla_parishad" required="">
                                <option value="" selected>Select Zilla Parishad</option>
                                <?php foreach ($zilla_parishads as $zilla_parishad) { ?>
                                    <option value="<?= $zilla_parishad['id'] ?>"><?= $zilla_parishad['unit_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="tax_status" class="form-label">District</label>
                            <input type="hidden" class="form-control" id="district_id" name="district_id" placeholder="District Name">
                            <input type="text" class="form-control" id="district_name" placeholder="District Name" disabled>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                            <label for="" class="form-label">Panchayat Samity Name <span class="asterisk">* </span></label>
                            <input type="text" class="form-control" name="unit_name" placeholder="Panchayat Parishad Name" required="">
                        </div>

                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                            <select name="is_active" class="form-select" id="is_active" required>
                                <option value="">Select Status</option>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                <a class="btn app-btn-danger" href="<?= base_url('admin/panchayat_samity'); ?>">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {

        $('#zilla_parishad').on('change', function() {
            var zilla_parishad = $("#zilla_parishad").val();
            $.ajax({
                url: '<?php echo base_url("admin/panchayat_samity/fetch_district"); ?>',
                method: 'post',
                dataType: 'json',
                data: {
                    zilla_parishad: zilla_parishad
                },
                success: function(response) {
                    if (response.status == true) {
                        $("#district_name").val(response.district_details.district_name);
                        $("#district_id").val(response.district_details.district_id);
                    }
                }
            });
        });
    });
</script>