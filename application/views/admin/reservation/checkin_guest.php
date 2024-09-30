<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Checkin Guest Detail
                </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->

                       <button type="button" class="btn btn-primary" id="add_row">Add Extra Person if you selected extra person from POS</button>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>

        <style type="text/css">

                        
            .text-right{
                text-align: right !important;
            }
            .btn-green {
                background: #33c543;
                color: #fff;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 4px;
                font-family: 'Barlow', sans-serif;
                border: #33c543 1px solid;
                padding: 6px 16px;
                font-size: 13px;
                font-weight: 400;
                text-decoration: none;
                transition-duration: 0.5s;
                -webkit-transition-duration: 0.5s;
                display: inline-block;
            }

            .btn-green:focus,
            .btn-green:hover {
                background: #000;
                color: #33c543;
                border: #33c543 1px solid;
                transition-duration: 0.5s;
                -webkit-transition-duration: 0.5s;
                outline: 0;
            }
            .btn-yellow {
                background: #ff9600;
                color: #fff;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 4px;
                font-family: 'Barlow', sans-serif;
                border: #ff9600 1px solid;
                padding: 6px 16px;
                font-size: 13px;
                font-weight: 400;
                text-decoration: none;
                transition-duration: 0.5s;
                -webkit-transition-duration: 0.5s;
                display: inline-block;
            }
            .btn-info {
                background: #6dafff;
                color: #fff;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 4px;
                font-family: 'Barlow', sans-serif;
                border: #6dafff 1px solid;
                padding: 6px 16px;
                font-size: 13px;
                font-weight: 400;
                text-decoration: none;
                transition-duration: 0.5s;
                -webkit-transition-duration: 0.5s;
                display: inline-block;
            }
            .btn-info:focus,
            .btn-info:hover {
                background: #246fc9;
                color: #fff;
                border: #246fc9 1px solid;
                transition-duration: 0.5s;
                -webkit-transition-duration: 0.5s;
                outline: 0;
            }

            .btn-primary {
                color: #fff !important;
                background-color: #246fc9;
                border-color: #246fc9;
            }

            .btn-primary:hover {
                color: #fff;
                background-color: #6dafff;
                border-color: #6dafff
            }
            .btn{
                margin: 2.5px 0;
            }
            .btn-apply {
                padding: 8.5px 15px;
                position: relative !important;
                top: -2px;
            }
            .bg_grey{
                background: #eee;
            }
            .room_details{
                padding: 20px;
            }
            .room_details .card{
                padding: 15px;
            }
            .room_dtl_sec{
                padding-top: 15px;
                padding-bottom: 15px;
                border-bottom: #ddd 1px solid;
                -webkit-transition-duration: .5s;
                -moz-transition-duration: .5s;
                -o-transition-duration: .5s;
                transition-duration: .5s;
            }
            .room_dtl_sec:hover{
                background: #eee;
                -webkit-transition-duration: .5s;
                -moz-transition-duration: .5s;
                -o-transition-duration: .5s;
                transition-duration: .5s;

            }

            .room_dtl_sec p{
                font-size: 12px;
            }
            .room_dtl_sec .price_sec{
               text-align: center;
            }
            .room_dtl_sec .price_sec h4{
                font-weight: 500;
            }
            .room_dtl_sec .price_sec h4, .room_dtl_sec .price_sec p{
                margin-bottom: 0;
            }
            .room_dtl_sec .btn_sec{
                text-align: right;
            } 
             .room_dtl_sec .btn-green{
                font-size: 17px;
                padding: 10px 50px;
            }   
            .room_details h4{
                font-weight: 500;
            }    
            .room_details{
                display: none;
            }
            .room_item_list{
                padding: 0;
                margin: 0;
                list-style: none;
            }
            .room_item_list li {
                padding: 10px;
                margin: 10px;
                display: inline-block;
                min-width: 200px;
                vertical-align: middle;
                background: #246fc9;
                color: #fff;
                border-radius: 4px;
                position: relative;
                }
            .room_item_list li p{
                font-size: 12px;
            }
            .room_item_list li h5{
                color: #fff;
            }
            .room_item_txt {
                text-align: center;
                padding-top: 31px;
            }
            .room_item_txt h4{
                font-weight: 600;
                font-size: 17px;
            }
            .room_item_txt h4 small{
                font-weight: 400;
            }
            .room_item_txt p, .room_item_txt h4{
                margin-bottom: 0;
            }

            .room_store_sec {
                background: #ffff;
                position: fixed;
                width: 100%;
                height: auto;
                bottom: 0;
                padding: 15px;
                display: none;
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.25);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.25);
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.25);
            }
            .btn-continue {
                font-size: 20px;
                padding: 10px 40px;
                margin-top: 27px;
            }
            .append-buttons button#remove-button:disabled{
                display: none;
            }

            .append-buttons button#remove-button{
                   margin-top: 16px;
            }

            .btn-red{
                color: #fff;
                background: #f00;
                border: #f00 1px solid;
            }

            .panel-heading {
                padding: 15px;
                background: #d7eeff;
                border-radius: 6px;
                margin-bottom: 35px;
            }

        </style>
        <!--//row-->

        <div class="app-card app-card-settings shadow-sm p-3">

            <form class="settings-form" method="POST" action="<?=base_url('admin/reservation/checkin_guest_submit')?>" enctype="multipart/form-data" autocomplete="off">  
            
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
				<input type="hidden" name="booking_id" value="<?= $booking_id; ?>">

                <div class="app-card-body">
                    <div class="row g-3">
                        <?php //$i = 1; ?>
                        <?php //foreach($booking_details as $b_details){ ?>  
                            
                            

                            <?php /*?><div class="col-md-12">
                                <div class="panel-heading"><div class="panel-title"><?= $b_details['accommodation_name']; ?><span style="float:right;"><img src="<?= base_url(); ?>public/admin_images/adult.png"> = <?= $b_details['adults']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= base_url(); ?>public/admin_images/children.png"> = <?= $b_details['children']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= base_url(); ?>public/admin_images/infant.png"> = <?= $b_details['infants']; ?></span></div></div>
                                <h6>Guest Details of room <?= $b_details['room_no']; ?></h6>
                                <hr>
                            </div><?php */?>
                            <?php //$b_details['total_guest'] ?>
                            <?php for ($x = 1; $x <= $guests; $x++) { ?>  
                                
                                <input type="hidden" name="checkin_details_id[]" value="<?= $b_details['check_in_detail_id']; ?>">
                                <input type="hidden" name="checkin_date[]" value="<?= $booking_details[0]['in_date']; ?>">
                                <input type="hidden" name="checkout_date[]" value="<?= $booking_details[0]['out_date']; ?>">

                                <div class="row guest_main">

                                    <div class="col-md-9">
                                        <h6>Guest - <?= $x; ?>
                                        </h6>
                                    </div>

                                    <?php /*?><div class="col-md-3 text-right">
                                        <input type="radio" class="select_primary" name="select_primary[]" value="<?php if($x == 1){ echo 'P'; } else { echo 'N'; } ?>" <?php if($b_details['total_guest'] == 1){ echo 'checked'; } ?>><label for="select-guest_<?= $x; ?>" style="margin-left:10px;">Select for primary guest</label>
                                        <input type="hidden" class="select_primary_hidden" name="select_primary_hidden[]" value="<?php if($x == 1){ echo 'P'; } else { echo 'N'; } ?>">
                                    </div><?php */?>

                                    <div class="col-lg-4 col-sm-12 col-md-6 guestname_div">
                                        <label for="tax_name" class="form-label">Guest Name <span class="asterisk"> </span></label>
                                        <input type="text" class="form-control guest_name" name="guest_name[]" placeholder="Guest Name">                                
                                    </div>

                                    <div class="col-lg-4 col-sm-12 col-md-6">
                                        <label for="tax_name" class="form-label"> Date of Birth <span class="asterisk"> </span></label>
                                        <input type="date" class="form-control" name="guest_dob[]" >                                
                                    </div>
									<div class="col-lg-4 col-sm-12 col-md-6">
                                    <label for="tax_name" class="form-label">Nationality  <span class="asterisk"> * </span></label>
                                    <select class="form-select" name="nationality[]" required >
                                        <option value="Indian" <?php if($guest['nationality'] == 'Indian'){ echo 'selected'; } ?>>Indian</option>
										<?php
										if(!empty($nationalities)){
											foreach($nationalities as $natio){
										?>
											<option value="<?= $natio['nationality'];?>" <?php if($guest['nationality'] == $natio['nationality']){ echo 'selected'; } ?>><?= $natio['nationality'];?></option>
										<?php
											}
										}
										?>
                                    </select>
                                </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 guestgender_div">
                                        <label for="tax_name" class="form-label">Select Gender  <span class="asterisk"> </span></label>
                                        <select class="form-control guest_gender" name="guest_gender[]" >
                                            <option value="" selected disabaled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 guestrelation_div">
                                        <label for="tax_name" class="form-label">Select relation <span class="asterisk guestrelation_asterisk"></span></label>
                                        <select class="form-control guest_relation" name="guest_relation[]" >
                                            <option value="" selected disabaled>Select relation</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Father">Father</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Son">Son</option>
                                            <option value="Friend">Friend</option>
											<option value="Colleague">Colleague</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Self">Self</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 guestid_div">
                                        <label for="tax_name" class="form-label">Select ID Type <span class="asterisk guestid_asterisk"> </span></label>
                                        <select class="form-control guest_id" name="guest_id[]">
                                            <option value="" selected disabaled>Select ID Type</option>
                                            <option value="1">Aadhar Card</option>
                                            <option value="2">Voter Card</option>
                                            <option value="3">Driving Licence</option>
                                            <option value="4">Pan Card</option>
                                            <option value="5">Passport</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 guestidentity_div">
                                        <label for="tax_name" class="form-label">Identity No. <span class="asterisk guestidentity_asterisk"> </span></label>
                                        <input type="text" class="form-control guest_id_number" name="guest_id_number[]" placeholder="Identity No." >                                
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 guestidfile_div">
                                        <label for="tax_name" class="form-label">ID Proof <span class="asterisk guestidfile_asterisk"> </span></label>
                                        <input type="file" class="form-control guest_id_file" name="guest_id_file[]" placeholder="" >                                
                                    </div>

                                    <div class="col-lg-4 col-sm-12 col-md-6 address_div" <?php if($x == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                        <label for="tax_name" class="form-label">Address <span class="asterisk address_asterisk"> </span></label>
                                        <input type="text" class="form-control guest_address" name="guest_address[]" placeholder="Address" >                                    
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 coming_div" <?php if($x == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                        <label for="tax_name" class="form-label">Coming from <span class="asterisk coming_asterisk"> </span></label>
                                        <input type="text" class="form-control guest_from" name="guest_from[]" placeholder="Coming from">                                    
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 going_div" <?php if($x == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                        <label for="tax_name" class="form-label">Going to <span class="asterisk going_asterisk"> </span></label>
                                        <input type="text" class="form-control guest_to" name="guest_to[]" placeholder="Going to" >                                    
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 purpose_div" <?php if($x == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                        <label for="tax_name" class="form-label">Purpose <span class="asterisk purpose_asterisk"> </span></label>
                                        <input type="text" class="form-control guest_purpose" name="guest_purpose[]" placeholder="Purpose" >                                    
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-6 contact_div" <?php if($x == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                        <label for="tax_name" class="form-label">Contact No. <span class="asterisk contact_asterisk"> </span></label>
                                        <input type="text" class="form-control guest_contact" name="guest_contact[]" placeholder="Contact No." >                                    
                                    </div>
                                    <?php /*?><div class="col-lg-4 col-sm-12 col-md-6 aniver_div" <?php if($x == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                                        <label for="tax_name" class="form-label">Aniversary Date <span class="asterisk"> </span></label>
                                        <input type="Date" class="form-control guest_aniversary" name="guest_aniversary[]" placeholder="">                                    
                                    </div><?php */?>

                                </div>

                                <div class="col-md-12">
                                    <hr>
                                </div>

                            <?php } ?>                            

                            <?php //$i++; ?>

                        <?php //} ?>
						
						<div class="row guest_add_div">
						
						</div>

                        <div class="col-md-12">
                               <!--  <button type="button" class="btn app-btn-primary" id="" > Submit</button>
                            <button type="button" class="btn app-btn-primary open_room">Search</button> -->
                            <input type="submit" class="btn app-btn-primary guest_submit" value="Submit">
                        </div>                       


                        

                    </div>
                       
                </div>

              
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on("change",".select_primary",function() {

            //var getMain = $(this).parent('div').parent('div').prevAll('div.guest_main').find('.address_div').children('.guest_address').attr('class'); 
            //var getMainself = $(this).parent('div').parent('div').find('.address_div').attr('class');
            //alert(getMain); 
            
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.address_div').hide();
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.coming_div').hide();
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.going_div').hide();
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.purpose_div').hide();
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.contact_div').hide();
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.aniver_div').hide();            

            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.address_div').hide();
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.coming_div').hide();
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.going_div').hide();
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.purpose_div').hide();
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.contact_div').hide();
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.aniver_div').hide();

            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.address_div').children('.guest_address').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.coming_div').children('.guest_from').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.going_div').children('.guest_to').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.purpose_div').children('.guest_purpose').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.contact_div').children('.guest_contact').prop('required',false);
            //$(this).parent('div').parent('div').prevAll('div.guest_main').find('.aniver_div').children('.guest_aniversary').prop('required',false);
            //$(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestname_div').children('.guest_name').prop('required',false);
            //$(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestgender_div').children('.guest_gender').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestrelation_div').children('.guest_relation').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestid_div').children('.guest_id').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestidentity_div').children('.guest_id_number').prop('required',false);
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestidfile_div').children('.guest_id_file').prop('required',false);

            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.address_div').children('label').children('.address_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.coming_div').children('label').children('.coming_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.going_div').children('label').children('.going_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.purpose_div').children('label').children('.purpose_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.contact_div').children('label').children('.contact_asterisk').html('');
            //$(this).parent('div').parent('div').prevAll('div.guest_main').find('.aniver_div').children('span').children('.asterisk').html('');
            //$(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestname_div').children('span').children('.asterisk').html('');
            //$(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestgender_div').children('span').children('.asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestrelation_div').children('label').children('.guestrelation_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestid_div').children('label').children('.guestid_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestidentity_div').children('label').children('.guestidentity_asterisk').html('');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.guestidfile_div').children('label').children('.guestidfile_asterisk').html('');

            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.address_div').children('.guest_address').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.coming_div').children('.guest_from').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.going_div').children('.guest_to').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.purpose_div').children('.guest_purpose').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.contact_div').children('.guest_contact').prop('required',false);
            //$(this).parent('div').parent('div').nextAll('div.guest_main').find('.aniver_div').children('.guest_aniversary').prop('required',false);
            //$(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestname_div').children('.guest_name').prop('required',false);
            //$(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestgender_div').children('.guest_gender').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestrelation_div').children('.guest_relation').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestid_div').children('.guest_id').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestidentity_div').children('.guest_id_number').prop('required',false);
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestidfile_div').children('.guest_id_file').prop('required',false);

            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.address_div').children('label').children('.address_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.coming_div').children('label').children('.coming_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.going_div').children('label').children('.going_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.purpose_div').children('label').children('.purpose_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.contact_div').children('label').children('.contact_asterisk').html('');
            //$(this).parent('div').parent('div').nextAll('div.guest_main').find('.aniver_div').children('span').children('.asterisk').html('');
            //$(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestname_div').children('span').children('.asterisk').html('');
            //$(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestgender_div').children('span').children('.asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestrelation_div').children('label').children('.guestrelation_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestid_div').children('label').children('.guestid_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestidentity_div').children('label').children('.guestidentity_asterisk').html('');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.guestidfile_div').children('label').children('.guestidfile_asterisk').html('');

            $(this).parent('div').parent('div').find('.address_div').children('.guest_address').prop('required',true);
            $(this).parent('div').parent('div').find('.coming_div').children('.guest_from').prop('required',true);
            $(this).parent('div').parent('div').find('.going_div').children('.guest_to').prop('required',true);
            $(this).parent('div').parent('div').find('.purpose_div').children('.guest_purpose').prop('required',true);
            $(this).parent('div').parent('div').find('.contact_div').children('.guest_contact').prop('required',true);
            //$(this).parent('div').parent('div').find('.aniver_div').children('.guest_aniversary').prop('required',true);
            $(this).parent('div').parent('div').find('.guestrelation_div').children('.guest_relation').prop('required',true);
            $(this).parent('div').parent('div').find('.guestid_div').children('.guest_id').prop('required',true);
            $(this).parent('div').parent('div').find('.guestidentity_div').children('.guest_id_number').prop('required',true);
            $(this).parent('div').parent('div').find('.guestidfile_div').children('.guest_id_file').prop('required',true);

            $(this).parent('div').parent('div').find('.address_div').children('label').children('.address_asterisk').html('*');
            $(this).parent('div').parent('div').find('.coming_div').children('label').children('.coming_asterisk').html('*');
            $(this).parent('div').parent('div').find('.going_div').children('label').children('.going_asterisk').html('*');
            $(this).parent('div').parent('div').find('.purpose_div').children('label').children('.purpose_asterisk').html('*');
            $(this).parent('div').parent('div').find('.contact_div').children('label').children('.contact_asterisk').html('*');
            //$(this).parent('div').parent('div').find('.aniver_div').children('.asterisk').html('*');
            $(this).parent('div').parent('div').find('.guestrelation_div').children('label').children('.guestrelation_asterisk').html('*');
            $(this).parent('div').parent('div').find('.guestid_div').children('label').children('.guestid_asterisk').html('*');
            $(this).parent('div').parent('div').find('.guestidentity_div').children('label').children('.guestidentity_asterisk').html('*');
            $(this).parent('div').parent('div').find('.guestidfile_div').children('label').children('.guestidfile_asterisk').html('*');

            //alert($(this).parent('div').parent('div').find('.contact_div').children('label').children('span').attr('class'));

            $(this).parent('div').parent('div').find('.address_div').show();
            $(this).parent('div').parent('div').find('.coming_div').show();
            $(this).parent('div').parent('div').find('.going_div').show();
            $(this).parent('div').parent('div').find('.purpose_div').show();
            $(this).parent('div').parent('div').find('.contact_div').show();
            $(this).parent('div').parent('div').find('.aniver_div').show();

            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.text-right').children('.select_primary').val('N');
            $(this).parent('div').parent('div').prevAll('div.guest_main').find('.text-right').children('.select_primary_hidden').val('N');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.text-right').children('.select_primary').val('N');
            $(this).parent('div').parent('div').nextAll('div.guest_main').find('.text-right').children('.select_primary_hidden').val('N');

            $(this).parent('div').parent('div').find('.text-right').children('.select_primary').val('P');
            $(this).parent('div').parent('div').find('.text-right').children('.select_primary_hidden').val('P');

            
        });

        /*$(document).on("click",".guest_submit",function(e) {

            e.preventDefault();



        }*/
		
		
		$('#add_row').click(function () {
		
			var guestCount = $('.guestname_div').length;
			var counter = (guestCount + 1);
			
			$('.guest_add_div').append('<div class="col-md-9"><h6>Guest - '+counter+'</h6><input type="hidden" name="checkin_details_id[]" value="<?= $b_details['check_in_detail_id']; ?>"><input type="hidden" name="checkin_date[]" value="<?= $booking_details[0]['in_date']; ?>"><input type="hidden" name="checkout_date[]" value="<?= $booking_details[0]['out_date']; ?>"></div><div class="col-lg-4 col-sm-12 col-md-6 guestname_div"><label for="tax_name" class="form-label">Guest Name <span class="asterisk"> </span></label><input type="text" class="form-control guest_name" name="guest_name[]" placeholder="Guest Name"></div><div class="col-lg-4 col-sm-12 col-md-6"><label for="tax_name" class="form-label"> Date of Birth <span class="asterisk"> </span></label><input type="date" class="form-control" name="guest_dob[]" ></div><div class="col-lg-4 col-sm-12 col-md-6"><label for="tax_name" class="form-label">Nationality  <span class="asterisk"> * </span></label><select class="form-select" name="nationality[]" required ><option value="Indian">Indian</option></select></div><div class="col-lg-4 col-sm-12 col-md-6 guestgender_div"><label for="tax_name" class="form-label">Select Gender  <span class="asterisk"> </span></label><select class="form-control guest_gender" name="guest_gender[]" ><option value="" selected disabaled>Select Gender</option><option value="Male">Male</option><option value="Female">Female</option><option value="Transgender">Transgender</option></select></div><div class="col-lg-4 col-sm-12 col-md-6 guestrelation_div"><label for="tax_name" class="form-label">Select relation <span class="asterisk guestrelation_asterisk"></span></label><select class="form-control guest_relation" name="guest_relation[]" ><option value="" selected disabaled>Select relation</option><option value="Mother">Mother</option><option value="Father">Father</option><option value="Daughter">Daughter</option><option value="Son">Son</option><option value="Friend">Friend</option><option value="Colleague">Colleague</option><option value="Spouse">Spouse</option><option value="Self">Self</option></select></div><div class="col-lg-4 col-sm-12 col-md-6 guestid_div"><label for="tax_name" class="form-label">Select ID Type <span class="asterisk guestid_asterisk"> </span></label><select class="form-control guest_id" name="guest_id[]"><option value="" selected disabaled>Select ID Type</option><option value="1">Aadhar Card</option><option value="2">Voter Card</option><option value="3">Driving Licence</option><option value="4">Pan Card</option><option value="5">Passport</option></select></div><div class="col-lg-4 col-sm-12 col-md-6 guestidentity_div"><label for="tax_name" class="form-label">Identity No. <span class="asterisk guestidentity_asterisk"> </span></label><input type="text" class="form-control guest_id_number" name="guest_id_number[]" placeholder="Identity No." ></div><div class="col-lg-4 col-sm-12 col-md-6 guestidfile_div"><label for="tax_name" class="form-label">ID Proof <span class="asterisk guestidfile_asterisk"> </span></label><input type="file" class="form-control guest_id_file" name="guest_id_file[]" placeholder="" ></div><div class="col-md-12"><hr></div>')
		
		});
		
    });
</script>