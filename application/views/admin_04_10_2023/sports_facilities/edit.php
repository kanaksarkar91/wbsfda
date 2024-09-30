<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit <?= $slug;?></h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/sports_facilities?slug='.$slug) ?>">
                                VIEW ALL <?= strtoupper($slug);?>
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

            <form class="settings-form" method="post" action="<?php echo base_url('admin/sports_facilities/updatesports_facilities'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="sports_facilities_id" id="sports_facilities_id" value="<?=$sports_facilities['sports_facilities_id']?>">
            <input type="hidden" name="slug" value="<?=$slug;?>">
                <div class="app-card-body">
                    <form class="settings-form">
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Division / Workshop<span class="asterisk"> *</span></label>

                                <select name="fieldunit_id" class="form-select" id="fieldunit_id" required>
                                    <option value="" selected disabled>Select Division / Workshop</option>
                                    <?php foreach ($fieldunits as $fieldunit) { ?>
                                        <option value="<?= $fieldunit['fieldunit_id'] ?>" <?=($sports_facilities['fieldunit_id'] == $fieldunit['fieldunit_id']) ?'selected' :''?>><?= $fieldunit['fieldunit_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Location<span class="asterisk"> *</span></label>
                                <select name="location_id" class="form-select" id="location_id" required>
                                    <option value="" selected disabled>Select Location</option>
                                    <?php foreach ($locations as $location) { ?>
                                        <option value="<?= $location['location_id'] ?>" <?=($sports_facilities['location_id'] == $location['location_id']) ?'selected' :''?>><?= $location['location_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="sports_facilities_name" placeholder="Name" value="<?=$sports_facilities['sports_facilities_name']?>" required>

                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Geo Location</label>
                                <div id="dvMap" style="width: 550px; height: 250px"></div>
                                <input type="hidden" name="latitude" id="latitude" value="<?=$sports_facilities['latitude']?>">
                                <input type="hidden" name="longitude" id="longitude" value="<?=$sports_facilities['longitude']?>">
                                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58940.9501933034!2d88.45778149168144!3d22.586231403804486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275350398a5b9%3A0x75e165b244323425!2sNewtown%2C%20Kolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1653471260110!5m2!1sen!2sin" width="100%" height="240" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->


                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Address<span class="asterisk"> *</span></label>
                                <textarea name="address" id="address" cols="" class="form-control" rows="9" placeholder="Address" style="height:auto;"><?=$sports_facilities['address']?></textarea>

                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Contact No.<span class="asterisk"> *</span></label>
                                    <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No." value="<?=$sports_facilities['contact_no']?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Alternative Contact No</label>
                                    <input type="number" class="form-control" name="alternate_contact_no" id="alternate_contact_no" value="<?=$sports_facilities['alternate_contact_no']?>" placeholder="Alternative Contact No">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">E-mail ID<span class="asterisk"> *</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail ID" value="<?=$sports_facilities['email']?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Alternative E-mail ID</label>
                                    <input type="email" class="form-control" name="alternate_email" id="alternate_email" value="<?=$sports_facilities['alternate_email']?>" placeholder="E-mail ID">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Available Facilities & Amenities<span class="asterisk"> *</span></label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" name="facilities_amenitis_id[]" data-placeholder="Select Available Facilities & Amenities" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                            <?php foreach ($facilities_amenitiss as $ret) {?>
                                                <option value="<?= $ret['facilities_amenitis_id']?>" 
                                                <?php foreach ($sports_facilities_amenitis as $row) { ?>
                                                   <?= ($row['facilities_amenitis_id']==$ret['facilities_amenitis_id'])?'selected':''?>
                                                     <?php } ?>>
                                                    <?= $ret['facilities_amenitis_name'] ?>
                                                </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Images<span class="asterisk"> *</span></label>
                                    <div class="wrap">
                                        <!-- <h1>File upload multiple</h1> -->

                                        <div class="file">
                                            <div class="file__input" id="file__input">
                                                <input class="file__input--file" type="file" multiple="multiple" name="sports_facilities_image_file[]" />
                                                <label class="file__input--label" for="customFile" data-text-btn="Upload">Add file:</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Available Sports Infrastructure<span class="asterisk"> *</span></label>

                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" name="sports_infrastructure_id[]" data-placeholder="Select Available Sports" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                            <?php foreach ($sports_infrastructures as $ret) { ?>
                                                <option value="<?= $ret['sports_infrastructure_id'] ?>"
                                                <?php foreach ($sports_facilities_infrastructure as $row) { ?>
                                                   <?= ($row['sports_infrastructure_id']==$ret['sports_infrastructure_id'])?'selected':''?>
                                                     <?php } ?>>
                                                <?= $ret['sports_infrastructure_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Uploaded Images<span class="asterisk"> *</span></label>
                                <div class="row">
                                    <?php foreach ($sports_facilities_images as $images) { ?>                                        
                                    <div class="col-md-3 col-sm-6 profile-pic" id="imgb_<?php echo $images['sports_facilities_images_id']; ?>">
                                        <img class="img-fluid" src="<?=base_url('public/admin_images/sports_facilities/'.$images['sports_facilities_image_file'])?>" alt="No Image !">
                                        <div class="edit"><a href="javascript:void(0);" onclick="deleteImage('<?php echo $images['sports_facilities_images_id']; ?>')"><i class="fa fa-trash fa-lg"></i></a></div>
                                    </div>
                                    <?php } ?>                                    
                                    </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label me-3">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio1" value="0" <?=($sports_facilities['status']=='0') ?'checked':''?>>
                                    <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="FieldStatusRadio2" value="1" <?=($sports_facilities['status']=='1') ?'checked':''?>>
                                    <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                                </div>
                            </div>
                        </div>
                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                <a class="btn app-btn-danger" href="<?=base_url('admin/sports_facilities?slug='.$slug)?>">CANCEL</a>
            </form>
        </div>
    </div>
    <!--//container-fluid-->
</div>
<script type='text/javascript'>
 
  $(document).ready(function(){
 
        $('#fieldunit_id').change(function(){
        var fieldunit_id = $(this).val();
        $('#location_id').html('');
        $('#location_id').append('<option value="" selected disabled>Select Location</option>');

            $.ajax({
                url:'<?php echo base_url("admin/Sports_facilities/getlocation"); ?>',
                method: 'post',
                data: {fieldunit_id: fieldunit_id},
                dataType: 'json',
                success: function(response){
             
                $.each(response,function(index,data){
                    $('#location_id').append('<option value="'+data.location_id+'">'+data.location_name+'</option>');
                  
                });
                }
            });
        });
    });

</script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(18.9300, 72.8200),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
            });
            google.maps.event.addListener(map, 'click', function (e) {
                $("#latitude").val(e.latLng.lat());
                $("#longitude").val(e.latLng.lng());
                // alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
            });
        }
    </script>
    <script>
        function deleteImage(sports_facilities_images_id){
            var result = confirm("Are you sure to delete?");
            if(result){
                    $.ajax({
                    url:'<?php echo base_url("admin/Sports_facilities/img_delete"); ?>',
                    method: 'post',
                    data: {sports_facilities_images_id: sports_facilities_images_id},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 'ok'){
                            $('#imgb_'+sports_facilities_images_id).remove();
                        }else{
                            alert('Some problem occurred, please try again.');
                        }
                    }
                });
            }
        }
    </script>