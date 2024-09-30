<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">UPDATE VENUE BLOCK</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/VenueBlock') ?>">
                                VIEW ALL VENUE BLOCK
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
                <?php
                    if($msg = $this->session->flashdata('error_msg')){
                        echo '<p class="text-danger validation_message">'.$msg.'</p>';
                    }
                ?>
                <form class="settings-form" id="venue-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">   
                <div class="row g-3">
                        <div class="col-sm-12 col-md-3">
                            <label for="start_date" class="form-label">Start Date<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control datePicker" id="start_date" name="start_date" value="<?= date('d-m-Y', strtotime($venue->from_date))?>" required onchange="getPropertyDetails()">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="end_date" class="form-label">Till Date<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control datePicker" id="end_date" name="end_date" value="<?= date('d-m-Y', strtotime($venue->to_date))?>" required onchange="getPropertyDetails()">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="property_id" class="form-label">Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select" id="property_id" required onchange="populate_venue(this.value)">
                            <option value="" selected disabled>Select Property</option>
                                <?php
                                    if(!empty($properties)){
                                        foreach($properties as $propertie){
                                            if(($this->admin_session_data['role_id'] == ROLE_SUPERADMIN || $this->admin_session_data['role_id'] == '20' || $this->admin_session_data['role_id'] == '21')){
                                                if($propertie['is_venue'] == 1){
                                                ?>
                                                <option value="<?= $propertie['property_id'] ?>" 
                                                <?= $venue->property_id == $propertie['property_id']? 'selected':'' ?>
                                                ><?= $propertie['property_name'] ?></option>
                                                <?php
                                                }
                                            } else { ?>
                                                <option value="<?= $propertie['property_id'] ?>" 
                                                <?= $venue->property_id == $propertie['property_id']? 'selected':'' ?>
                                                ><?= $propertie['property_name'] ?></option>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="venue_id" class="form-label">Venue<span class="asterisk"> *</span></label>
                            <select name="venue_id" class="form-select select2" id="venue_id" required>
                                <option value="" selected disabled>--Select Venue--</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <label for="remarks" class="form-label">Remarks</span></label>
                            <textarea class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks"><?=$venue->remarks?></textarea>                             
                        </div>
			<div class="col-sm-12 col-md-12">
                            <button type="submit" class="btn app-btn-primary" id="btn-form-submit">Update</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/VenueBlock')?>">CANCEL</a>                            
                        </div>

                    </div>
                    
                </form>
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    var available_venues = new Array();
    const venue_id = '<?=$venue->venue_id==0?'all':$venue->venue_id?>';
    $(document).ready(function(){
        $('.datePicker').datepicker({
            dateFormat: "dd-mm-yy"
        });
        populate_venue(<?=$venue->property_id?>);
        $('#venue-form').submit(function(e){
            e.preventDefault();
            /**
             * Check venue availability
            */
           var can_proceed = true;
            if(available_venues.length >0 ){
                available_venues.forEach((v)=>{
					if(v.venue_id == $('#venue_id').val()){
						
					}
				})
			}
            if(can_proceed){
                var fd = $(this).serialize();
                $.ajax({
                    type: 'POST',	
                    url: "<?= base_url('admin/VenueBlock/update/'.$venue->blocked_id) ?>",
                    data: fd,
                    dataType: 'json',
                    encode: true,
                    async: false
                })
                .done(function(data){
                    // console.log(data);
                    if(data.success){
                        swal('Success', data.message, 'success');
                        setTimeout(function(){
                            window.location.href = "<?= base_url('admin/VenueBlock') ?>";
                        }, 2000);
                    }
                    else{
                        swal('Alert', data.message, 'warning');
                    }
                
                })
                .fail(function(data){
                    // show the any errors
                    console.log(data);
                });
            }
        })
    })

     function populate_venue(property_id){
        var result='';
        $.ajax({
            type: 'GET',	
            url: "<?= base_url('admin/venue/getVenueByProperty'); ?>",
            data: {
                'property_id':property_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='<option value="" selected >--Select Venue--</option>';
                //result +='<option value="all">All Venues</option>';
                $.each(data.list,function(key,value){
                    var selected_txt='';
                    result +='<option value="'+value.venue_id+'">'+value.venue_name+'</option>';
                });

                getPropertyDetails();
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#venue_id").html(result);
            $("#venue_id [value='"+venue_id+"']").attr('selected','selected');
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }

    function getPropertyDetails(){
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();
        let property_id = $('#property_id').val();
        if(start_date.length <=0 || end_date  <=0 || property_id  <=0){
            return false;
        }
        var result='';
        $.ajax({
            type: 'POST',	
            url: "<?= base_url('admin/VenueBlock/getPropertyDetails'); ?>",
            data: {
                'start_date':start_date,
                'end_date':end_date,
                'property_id':property_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            // console.log(data);
            if(data.success){
                available_venues = data.list;
                // result +='<option value="" selected >Select Venue</option>';
                // result +='<option value="all">All Venues</option>';
                // $.each(data.list,function(key,value){
                //     var selected_txt='';
                //     result +='<option value="'+value.venue_id+'">'+value.venue_name+'</option>';
                // });

                // getPropertyDetails();
            }
            else{
                //
            }
        
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }


</script>