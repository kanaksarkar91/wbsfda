<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">ADD ACCOMMODATION BLOCK</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="<?= base_url('admin/AccommodationBlock') ?>">
                                VIEW ALL ACCOMMODATION BLOCK
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
                <form class="settings-form" id="accommodation-form" method="post" action="<?= base_url('admin/AccommodationBlock/save') ?>" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
				
                    <div class="row g-3 mb-3">
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="start_date" class="form-label">Start Date<span class="asterisk"> *</span></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="" required onchange="getPropertyDetails()">
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="end_date" class="form-label">Till Date<span class="asterisk"> *</span></label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="" required onchange="getPropertyDetails()">
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="property_id" class="form-label">Property<span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select" id="property_id" required onchange="populate_accommodation(this.value)">
                            <option value="" selected disabled>Select Property</option>
                                <?php
                                    if(!empty($properties)){
                                        foreach($properties as $propertie){
                                            ?>
                                            <option value="<?= $propertie['property_id'] ?>" ><?= $propertie['property_name'] ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="accommodation_id" class="form-label">Accommodation<span class="asterisk"> *</span></label>
                            <select name="accommodation_id" class="form-select" id="accommodation_id" required onchange="validateAccommodationInput(this.value)">
                                <option value="" selected disabled>Select Accommodation </option>
                            </select>
                        </div>
                        <?php /*?><div class="col-sm-12 col-md-4 mb-3">
                            <label for="room" class="form-label">Rooms<span class="room asterisk"></span></label>
                            <input type="number" step=1 min=1 class="form-control" id="room" name="room" value="" required>
                        </div><?php */?>
						
						<div class="col-sm-12 col-md-4 mb-3">
                            <label for="room" class="form-label">Room No<span class="room asterisk"></span></label>
                            <select id="room_no" name="room_no[]" class="form-select" data-placeholder="Choose Room..." multiple="multiple" required>
							
							</select>
                        </div>
						
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="remarks" class="form-label">Remarks</span></label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn app-btn-primary" id="btn-form-submit">SUBMIT</button>
                    <a class="btn app-btn-danger" href="<?=base_url('admin/AccommodationBlock')?>">CANCEL</a>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var available_accommodations = new Array();
    $(document).ready(function(){
	
		var check_in_date = document.getElementById('start_date');
        var check_out_date = document.getElementById('end_date');

        check_in_date.addEventListener('change', function() {
            if (check_in_date.value)
                check_out_date.min = check_in_date.value;
        }, false);
        check_out_date.addEventListener('change', function() {
            if (check_out_date.value)
                check_in_date.max = check_out_date.value;
        }, false);
		
		
		$('#accommodation-form').submit(function(e){
            e.preventDefault();
            /**
             * Check accommodation availability
            */
           var can_proceed = true;
            if(available_accommodations.length >0 ){
                available_accommodations.forEach((v)=>{
					if(v.accommodation_id == $('#accommodation_id').val()){
						if(parseInt($('#room').val()) >  parseInt(v.no_of_accomm)){
							swal('Alert', 'Sorry!!, Maximum room/s available: '+v.no_of_accomm, 'warning');
                            can_proceed = false;
							return false;
						}
					}
				})
			}
            if(can_proceed){
                var fd = $(this).serialize();
                $.ajax({
                    type: 'POST',	
                    url: "<?php echo base_url('admin/AccommodationBlock/save'); ?>",
                    data: fd,
                    dataType: 'json',
                    encode: true,
                    async: false
                })
                .done(function(data){
                    if(data.success){
                        swal('Success', data.message, 'success');
                        setTimeout(function(){
                            window.location.href = "<?= base_url('admin/AccommodationBlock') ?>";
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

     function populate_accommodation(property_id){
        var result='';
        $.ajax({
            type: 'GET',	
            url: "<?php echo base_url('admin/accommodation/getAccommodationByProperty'); ?>",
            data: {
                csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
				'property_id':property_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            if(data.status){
                result +='<option value="" selected >Select Accommodation</option>';
                //result +='<option value="all">All Accommodations</option>';
                $.each(data.list,function(key,value){
                    var selected_txt='';
                    result +='<option value="'+value.accommodation_id+'">'+value.accommodation_name+'</option>';
                });

                getPropertyDetails();
            }
            else{
                result +='<option value="">No Unit selected</option>'
            }
            $("#accommodation_id").html(result);
        
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
        // console.log(start_date, end_date, property_id);
        if(start_date.length <=0 || end_date  <=0 || property_id  <=0){
            return false;
        }
        var result='';
        $.ajax({
            type: 'POST',	
            url: "<?php echo base_url('admin/AccommodationBlock/getPropertyDetails'); ?>",
            data: {
                csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
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
                available_accommodations = data.list;
                // result +='<option value="" selected >Select Accommodation</option>';
                // result +='<option value="all">All Accommodations</option>';
                // $.each(data.list,function(key,value){
                //     var selected_txt='';
                //     result +='<option value="'+value.accommodation_id+'">'+value.accommodation_name+'</option>';
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
	
	function validateAccommodationInput(accomo_value){
        var accommodation_id = accomo_value;
		var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
		var result='';
		console.log(accommodation_id);
		
		$.ajax({
            type: 'POST',	
            url: "<?php echo base_url('admin/AccommodationBlock/getRoomDetails'); ?>",
            data: {
                csrf_test_name: '<?php echo $this->csrf['hash']; ?>',
				'start_date':start_date,
                'end_date':end_date,
                'accommodation_id':accommodation_id
            },
            dataType: 'json',
            encode: true,
            async: false
        })
        .done(function(data){
            // console.log(data);
            if(data.success){
                 $.each(data.list,function(key,value){
                     var selected_txt='';
                     result +='<option value="'+value.room_no+'">'+value.room_no+'</option>';
                 });
            }
            else{
                result +='<option value="">No Room Found</option>'
            }
			
			$('#room_no').html(result);
        
        })
        .fail(function(data){
            // show the any errors
            console.log(data);
        });
    }

    /*function validateAccommodationInput(select){
        $('#room').prop('required', true);
            $('#room').prop('disabled', false);
        $('.room.asterisk').html(' *');
        if(select == 'all'){
            $('#room').prop('required', false);
            $('#room').prop('disabled', true);
            $('.room.asterisk').html('');
        }
    }*/
</script>