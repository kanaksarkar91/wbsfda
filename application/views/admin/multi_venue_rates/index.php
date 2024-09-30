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

.rate-table-sec .table > thead > tr > th {
    color: #fff;
    background: #800000;
}
#rate-form {
    display: inline-flex;
}
#rate-form .sec-btn {
    margin-top: 32px;
}
#btn-form-submit{
    color: #fff;
}
.d-none{
    display: none;
}
.mrg15R{
    margin-right: 15px;
}
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <?php if ($this->session->flashdata('success_msg')) : ?>
            <div class="alert alert-success">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('success_msg') ?>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('error_msg')) : ?>
            <div class="alert alert-danger">
                <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('error_msg') ?>
            </div>
        <?php endif ?>
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">View All Rate</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <?php
                                if(check_user_permission($menu_id, 'add_flag')){
                            ?>
                            <a class="btn app-btn-primary" href="<?= base_url('admin/venue_rates/multi_add') ?>">
                                Add New Rate
                            </a>
                            <?php
                                }
                            ?>
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
            <!-- <form class="settings-form" method="post" action="" enctype="multipart/form-data" autocomplete="off"> -->
            <div class="app-card-body">
                <div class="row g-3">
                <?php
                    if(check_user_permission($menu_id, 'delete_flag')){
                ?>
                    <form class="settings-form" id="rate-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                        <div class="col-lg-3 col-sm-12 col-md-6 mrg15R">
                            <label for="property_id" class="form-label">Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select select2" id="" required>
                                <option value="" selected disabled>Select Property</option>
                                <?php
                                    if(!empty($properties)){
                                        foreach($properties as $propertie){
                                            ?>
                                            <?php if($propertie['is_venue'] == '1'){ ?>
                                                <option value="<?= $propertie['property_id'] ?>" ><?= $propertie['property_name'] ?></option>
                                            <?php } ?>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-12 col-md-6 d-none">
                            <label for="rate_category_id" class="form-label">Rate Category <span class="asterisk"> *</span></label>
                            <select name="rate_category_id" class="form-select" id="" required>
                                <!-- <option value="" selected disabled>Select Rate Category </option> -->
                                <?php
                                    if(!empty($rate_categories)){
                                        foreach($rate_categories as $index => $rate_categorie){
                                            ?>
                                            <option value="<?= $rate_categorie->rate_category_id ?>" <?= $index==0 ? 'selected' : '' ?>>
                                                <?= $rate_categorie->rate_category_code ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-12 col-md-6 sec-btn">
                            <label for="" class="form-label">&nbsp;</label>
                            <button type="submit" id="btn-form-submit" class="btn app-btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            <a href="<?= base_url('admin/venue_rates/multi_venue') ?>" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <div class="table-responsive rate-table-sec">
                            <table class="table table-striped table-hover mb-0 text-left" id="rate-table">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Property</th>
                                        <th style="min-width:200px;">Venue</th>
                                        <!--<th>Rate Category</th>-->
                                        <th>Base Rate</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Hourly Booking?</th>
                                        <th>Booking Hours</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <!-- </form> -->
        </div>
        <!--//app-card-body-->
    </div>
</div>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script type='text/javascript'>
    const base_url = "<?= base_url() ?>";
    const has_edit_access = "<?= check_user_permission($menu_id, 'add_flag') ?>";
  $(document).ready(function(){
        $('table#rate-table').DataTable({
            destroy:true,
            processing:true,
            select:true,
            paging:true,
            lengthChange:true,
            "lengthMenu": [[13, 25, 50, -1], [13, 25, 50,"All"]],
            searching:true,
            "order": [],
            info:false,
            responsive:true,
            autoWidth:false
        });

        $('#rate-form').submit(function(e){
            e.preventDefault();
            var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";
            $('#btn-form-submit').prop('disabled', true);
            $.ajax({
                url:'<?= base_url("admin/venue_rates/getFilterMultiVenueData") ?>',
                method: 'GET',
                data: $(this).serialize(),
                dataType: 'json',
                encode: true,
                    async: false,
                    headers: {
                        "<?= $this->security->get_csrf_hash(); ?>": csrf_token
        },
                success: function(response){
                    $('#btn-form-submit').prop('disabled', false);
                    if(response.success){
                        var list = '<tr><td colspan="13" class="text-center text-warning">Sorry! No data found.</td></tr>';
                        console.log(response.data.length)
                        if(response.data.length > 0){
                            list = '';
                            $.each(response.data, function(index, data){
                                let edit = has_edit_access ? '<a href="'+base_url+'admin/venue_rates/multi_edit/'+data.rate_id+'/'+ data.property_id+'" class="btn-sm app-btn-primary">Edit</a>': '';
                                let is_hourly_booking_avl=(data.is_hourly_booking=='1')? 'Yes' : 'No';
                                let b_hours=(data.booking_hours)?data.booking_hours : 'N/A';

                                list +='<tr>\
                                            <td>'+moment(data.eff_start_date).format('DD/MM/YYYY')+'</td>\
                                            <td>'+( data.eff_end_date != "9999-12-31" ? moment(data.eff_end_date).format('DD/MM/YYYY') : "" )+'</td>\
                                            <td>'+data.property_name+'</td>\
                                            <td>'+data.venue_names+'</td>\
                                            <td>'+data.base_price+'</td>\
                                            <td>'+data.mon_price+'</td>\
                                            <td>'+data.tue_price+'</td>\
                                            <td>'+data.wed_price+'</td>\
                                            <td>'+data.thu_price+'</td>\
                                            <td>'+data.fri_price+'</td>\
                                            <td>'+data.sat_price+'</td>\
                                            <td>'+data.sun_price+'</td>\
                                            <td>'+is_hourly_booking_avl+'</td>\
                                            <td>'+b_hours+'</td>\
                                            <td>'+edit+'</td>\
                                        </tr>';
                            });
                        }
                        $('table#rate-table tbody').html(list);
                    }else{

                    }
                }
            });
        })
    });


</script>