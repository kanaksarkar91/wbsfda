<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Checkin Guest Detail
                </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?=base_url('admin/reservation/checkin_details/'.$booking_details['booking_id'])?>">
                                View CheckIn
                            </a>
                        </div>
                       
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
	<form class="settings-form" method="POST" action="<?=base_url('admin/reservation/checkin_guest_update')?>" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
	<input type="hidden" name="booking_id" value="<?php echo $booking_details['booking_id']; ?>">
	
        <div class="app-card app-card-settings shadow-sm p-4">             

                <div class="app-card-body">
                    <div class="row g-3">  

                        <div class="col-md-12">
                            <div class="panel-heading"><div class="panel-title"><strong><?php echo $booking_details['property_name']; ?></strong><span style="float:right;"><img src="<?php echo base_url(); ?>public/admin_images/adult.png"> = 
							<?php
							$split_adult_child = explode('-', $booking_details['adult_children']); 
							echo $split_adult_child[0]; 
							?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/admin_images/children.png"> = <?php echo $split_adult_child[1]; ?></span></div></div>
                            <h5>Guest Details of Booking No.:  <?php echo $booking_details['booking_no']; ?></h5>
                            <hr>
                        </div>
                        <?php $i = 1; 
						//echo '<pre>'; print_r($booking_details['guest_details']); die;
						?>
                        <?php foreach ($booking_details['guest_details'] as $guest) { ?>                              

                            <div class="row guest_main">

                                <div class="col-md-9">
                                    <h6>Guest - <?php echo $i; ?>
                                    </h6>
                                </div>

                                <?php /*?><div class="col-md-3 text-right">
                                    <input type="radio" class="select_primary" name="select_primary[]" value="<?php echo $guest['guest_type']; ?>" <?php if($guest['guest_type'] == 'P'){ echo 'checked'; } ?> disabled><label for="select-guest_<?php echo $i; ?>" style="margin-left:10px;">Select for primary guest</label>
                                    <input type="hidden" class="select_primary_hidden" name="select_primary_hidden[]" value="<?php echo $guest['guest_type']; ?>">
                                </div><?php */?>

                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label">Guest Name <span class="asterisk"> *</span></label>
                                    <input type="hidden" name="check_in_guest_id[]" value="<?php echo $guest['check_in_guest_id']; ?>">
									
									<input type="text" class="form-control" name="guest_name[]" placeholder="Guest Name" value="<?php echo $guest['name']; ?>" required>                                
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label"> Date of Birth <span class="asterisk"> <?php  if($i == 1) { ?>*<?php } ?> </span></label>
                                    <input type="date" class="form-control" name="guest_dob[]" placeholder="Guest Name" value="<?php echo $guest['dob']; ?>" <?php  if($i == 1) { ?> required <?php } ?>>                                
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label">Select Gender  <span class="asterisk"> <?php  if($i == 1) { ?>*<?php } ?> </span></label>
                                    <select class="form-select" name="guest_gender[]" <?php  if($i == 1) { ?> required <?php } ?>>
                                        <option value="" selected disabaled>Select Gender</option>
                                        <option value="Male" <?php if($guest['gender'] == 'Male'){ echo 'selected'; } ?>>Male</option>
                                        <option value="Female" <?php if($guest['gender'] == 'Female'){ echo 'selected'; } ?>>Female</option>
                                        <option value="Transgender" <?php if($guest['gender'] == 'Transgender'){ echo 'selected'; } ?>>Transgender</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label">Select relation <span class="asterisk"> <?php  if($i == 1) { ?>*<?php } ?> </span></label>
                                    <select class="form-select" name="guest_relation[]" <?php  if($i == 1) { ?> required <?php } ?>>
                                        <option value="" selected disabaled>Select relation</option>
                                        <option value="Mother" <?php if($guest['relation'] == 'Mother'){ echo 'selected'; } ?>>Mother</option>
                                        <option value="Father" <?php if($guest['relation'] == 'Father'){ echo 'selected'; } ?>>Father</option>
                                        <option value="Daughter" <?php if($guest['relation'] == 'Daughter'){ echo 'selected'; } ?>>Daughter</option>
                                        <option value="Son" <?php if($guest['relation'] == 'Son'){ echo 'selected'; } ?>>Son</option>
                                        <option value="Self" <?php if($guest['relation'] == 'Self'){ echo 'selected'; } ?>>Self</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label">Select ID Type <span class="asterisk"> *</span></label>
                                    <select class="form-select" name="guest_id[]" required>
                                        <option value="" selected disabaled>Select ID Type</option>
                                        <option value="1" <?php if($guest['document_type'] == 1){ echo 'selected'; } ?>>Aadhar Card</option>
                                        <option value="2" <?php if($guest['document_type'] == 2){ echo 'selected'; } ?>>Voter Card</option>
                                        <option value="3" <?php if($guest['document_type'] == 3){ echo 'selected'; } ?>>Driving Licence</option>
                                        <option value="4" <?php if($guest['document_type'] == 4){ echo 'selected'; } ?>>Pan Card</option>
                                        <option value="5" <?php if($guest['document_type'] == 5){ echo 'selected'; } ?>>Passport</option>
                                        
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label">Identity No. <span class="asterisk"> *</span></label>
                                    <input type="text" class="form-control" name="guest_id_number[]" placeholder="Identity No." value="<?php echo $guest['document_no']; ?>" required>                                
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                    <label for="tax_name" class="form-label">ID Proof <span class="asterisk"> *</span></label>
                                    <input type="file" class="form-control" name="guest_id_file[]" placeholder="" value="" required>                                
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3 address_div" <?php if($guest['guest_type'] == 'N'){ echo 'style="display: none;"'; } ?>>
                                    <label for="tax_name" class="form-label">Address <span class="asterisk"> </span></label>
                                    <input type="text" class="form-control guest_address" name="guest_address[]" value="<?php echo $guest['address']; ?>" placeholder="Address">                                    
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3 coming_div" <?php if($guest['guest_type'] == 'N'){ echo 'style="display: none;"'; } ?>>
                                    <label for="tax_name" class="form-label">Coming from <span class="asterisk"> </span></label>
                                    <input type="text" class="form-control guest_from" name="guest_from[]" value="<?php echo $guest['coming_from']; ?>" placeholder="Coming from">                                    
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3 going_div" <?php if($guest['guest_type'] == 'N'){ echo 'style="display: none;"'; } ?>>
                                    <label for="tax_name" class="form-label">Going to <span class="asterisk"> </span></label>
                                    <input type="text" class="form-control guest_to" name="guest_to[]" placeholder="Going to" value="<?php echo $guest['going_to']; ?>">                                    
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3 purpose_div" <?php if($guest['guest_type'] == 'N'){ echo 'style="display: none;"'; } ?>>
                                    <label for="tax_name" class="form-label">Purpose <span class="asterisk"> </span></label>
                                    <input type="text" class="form-control guest_purpose" name="guest_purpose[]" placeholder="Purpose" value="<?php echo $guest['purpose']; ?>">                                    
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-3 contact_div" <?php if($guest['guest_type'] == 'N'){ echo 'style="display: none;"'; } ?>>
                                    <label for="tax_name" class="form-label">Contact No. <span class="asterisk"> </span></label>
                                    <input type="text" class="form-control guest_contact" name="guest_contact[]" placeholder="Contact No." value="<?php echo $guest['phone']; ?>">                                    
                                </div>
								
                                <?php /*?><div class="col-lg-4 col-sm-12 col-md-6 mb-3 aniver_div" <?php if($guest['guest_type'] == 'N'){ echo 'style="display: none;"'; } ?>>
                                    <label for="tax_name" class="form-label">Aniversary Date <span class="asterisk"> </span></label>
                                    <input type="Date" class="form-control guest_aniversary" name="guest_aniversary[]" placeholder="" value="<?php echo $guest['aniversary_date']; ?>">                                    
                                </div><?php */?>

                            </div>
							
						<?php
						if($guest['name'] != ''){
						?>

                            <?php if($guest['doc_file']){ ?>
                                <div class="col-md-12">
                                    <label for="tax_name" class="form-label">ID Proof Image</label><br>
                                    <img src="<?php echo base_url(); ?>public/guest_id/<?php echo $guest['doc_file']; ?>" width="25%">
                                </div>
                            <?php } ?>
							
						<?php
						}
						?>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <?php $i++; ?>

                        <?php } ?> 

                    </div>
					
					<?php
					if($guest['name'] == ''){
					?>
					
						<div class="col-md-12">
							<input type="submit" class="btn app-btn-primary" value="Submit">
						</div>
						
					<?php
					}
					?>
                       
                </div>

        </div>
        <!--//app-card-body-->
	</form>

    </div>
</div>