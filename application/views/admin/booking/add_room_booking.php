<div class="app-content pt-3 p-md-3 p-lg-3">

    <div class="container-xl search_select_room_div">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add Booking</h1>
            </div>

            <!--//col-auto-->
        </div>

        <style type="text/css">
            .text-right {
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

            .btn {
                margin: 2.5px 0;
            }

            .btn-apply {
                padding: 8.5px 15px;
                position: relative !important;
                top: -2px;
            }

            .bg_grey {
                background: #eee;
            }

            .room_details {
                padding: 20px;
            }

            .room_details .card {
                padding: 15px;
            }

            .room_dtl_sec {
                padding-top: 15px;
                padding-bottom: 15px;
                border-bottom: #ddd 1px solid;
                -webkit-transition-duration: .5s;
                -moz-transition-duration: .5s;
                -o-transition-duration: .5s;
                transition-duration: .5s;
            }

            .room_dtl_sec:hover {
                background: #eee;
                -webkit-transition-duration: .5s;
                -moz-transition-duration: .5s;
                -o-transition-duration: .5s;
                transition-duration: .5s;

            }

            .room_dtl_sec p {
                font-size: 12px;
            }

            .room_dtl_sec .price_sec {
                text-align: center;
            }

            .room_dtl_sec .price_sec h4 {
                font-weight: 500;
            }

            .room_dtl_sec .price_sec h4,
            .room_dtl_sec .price_sec p {
                margin-bottom: 0;
            }

            .room_dtl_sec .btn_sec {
                text-align: right;
            }

            .room_dtl_sec .btn-green {
                font-size: 15px;
                padding: 10px 50px;
            }

            .room_details h4 {
                font-weight: 500;
            }

            .room_details {
                display: none;
            }

            .room_item_list {
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

            .room_item_list li p {
                font-size: 12px;
            }

            .room_item_list li h5 {
                color: #fff;
            }

            .room_item_txt {
                text-align: center;
                padding-top: 31px;
            }

            .room_item_txt h4 {
                font-weight: 600;
                font-size: 17px;
            }

            .room_item_txt h4 small {
                font-weight: 400;
            }

            .room_item_txt p,
            .room_item_txt h4 {
                margin-bottom: 0;
            }

            .room_store_sec {
                background: #ffff;
                /*position: fixed;*/
                width: 100%;
                height: auto;
                bottom: 0;
                padding: 15px;
                display: none;
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.25);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.25);
                box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.25);
            }

            .btn-continue {
                font-size: 20px;
                padding: 10px 40px;
                margin-top: 27px;
            }

            .append-buttons button#remove-button:disabled {
                display: none;
            }

            .append-buttons button#remove-button {
                margin-top: 16px;
            }

            .btn-red {
                color: #fff;
                background: #f00;
                border: #f00 1px solid;
            }
			
			.label-default {
background-color: #777;
}
.label-default[href]:hover,
.label-default[href]:focus {
background-color: #5e5e5e;
}
.label-primary {
background-color: #337ab7;
}
.label-primary[href]:hover,
.label-primary[href]:focus {
background-color: #286090;
}
.label-success {
background-color: #5cb85c;
}
.label-success[href]:hover,
.label-success[href]:focus {
background-color: #449d44;
}
.label-info {
background-color: #5bc0de;
}
.label-info[href]:hover,
.label-info[href]:focus {
background-color: #31b0d5;
}
.label-warning {
background-color: #f0ad4e;
}
.label-warning[href]:hover,
.label-warning[href]:focus {
background-color: #ec971f;
}
.label-danger {
background-color: #d9534f;
}
.label-danger[href]:hover,
.label-danger[href]:focus {
background-color: #c9302c;
}
.badge {
display: inline-block;
min-width: 10px;
padding: 3px 7px;
font-size: 12px;
font-weight: bold;
line-height: 1;
color: #fff;
text-align: center;
white-space: nowrap;
vertical-align: middle;
background-color: #777;
border-radius: 10px;
}
.badge:empty {
display: none;
}
.btn .badge {
position: relative;
top: -1px;
}
.btn-xs .badge,
.btn-group-xs > .btn .badge {
top: 0;
padding: 1px 5px;
}
a.badge:hover,
a.badge:focus {
color: #fff;
text-decoration: none;
cursor: pointer;
}
.list-group-item.active > .badge,
.nav-pills > .active > a > .badge {
color: #337ab7;
background-color: #fff;
}
.list-group-item > .badge {
float: right;
}
.list-group-item > .badge + .badge {
margin-right: 5px;
}
.nav-pills > li > a > .badge {
margin-left: 3px;
}
				.f12 {font-size: 12px;border-radius: 2px;}
.table_custom thead tr th:first-child, .table_custom2 thead tr th:first-child {border-radius: 6px 0 0 0;}
.table_custom thead tr th:last-child, .table_custom2 thead tr th:last-child {border-radius: 0 6px 0 0;}
.table_custom tbody tr {border-bottom: 10px solid #ccc;}
.table_custom tbody tr:hover {background: #e4f0f5;}
.table_custom tbody tr:last-child td:nth-child(1) {border-radius:0 0 0 6px;}
.roomtype {font-size: 17px;cursor: pointer;}    
.roomtype:hover a {text-decoration: none;}
.label {font-weight: normal;transition: all 0.5s ease;}
.label-normal {background-color: #eee;color: #000;}
a.label:hover, a.label:focus {color: #000;}
a.label {width: 85px; display: block; padding: 3px 0;color: #fff;}
table.table_custom thead th, table.table_custom2 thead th {text-align: center;}
table.table_custom thead th small, table.table_custom2 thead th small {text-transform: uppercase; display: block;text-align: center;font-weight: normal;letter-spacing: 1px;}
table#avs_table {position: relative;}
table#avs_table thead.stick {position: fixed;top:51px; z-index: 3;width: 100%; display: block;}
table#avs_table thead.stick tr {width: 92.5%; display: table;}

table#avs_table thead.stick tr th:nth-child(1) {width:23%;max-width: 330px;}
table#chi_table thead tr#calhead th:nth-child(1) {width:23%;max-width: 330px;}
table#chi_table thead tr#calhead th:nth-child(2) {width:15%;max-width: 330px;text-align: left;}
table#chi_table thead tr#calhead th:nth-child(2) small {text-align: left;}
tbody#list_tbl_body_id tr td.roomtype:nth-child(1) {width:23%;max-width: 330px;}

#header-fixed {position: fixed; width: 93.7%;top: 50px; display:none;background-color:white;}
#header-fixed thead tr th:nth-child(1) {width: 240px;}
.continue {margin: 0px;cursor: pointer;position: relative;}
.continue:before {background: #ff9600; width: 100%; height: 20px;content: '';position: absolute;left: 0;right: 0;top:-10px;}
/*.continue:after {background: #2b982b; width: 100%; height: 10px;content: '';position: absolute;right: 0;}*/
.s_checkin.continue {}
.s_checkin.continue:before {left: 30px;right: auto; border-radius: 10px 0 0 10px;}
.e_checkout.continue:before {right: 30px;left: auto; border-radius:0 10px 10px 0;}
.s_checkin.e_checkout.continue:before {right: 20px;left: 20px; border-radius:10px;width: auto;}
.r_chek_out {display: block;position: absolute;top: -20px;right: 0px;z-index:9;background: #fff;font-size: 15px;}

.reserved {margin-top: 5px;cursor: pointer;}
.reserved:before {background: #ff2d00; width: 100%; height: 20px;content: '';position: absolute;left: 0;right: 0;}
#property_availability thead tr{font-size:80%;}
#property_availability tr td:first-child a{color: #000;}
        </style>
        <!--//row-->
	<div>
	<form id="room_search_form" class="settings-form" method="post" action="#" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
	
        <div class="app-card app-card-settings shadow-sm p-3">


            <div class="app-card-body">

                

                    <div class="row g-3 mb-3">
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="property_id" class="form-label">Select Property <span class="asterisk"> *</span></label>
                            <select name="property_id" class="form-select select2" id="property_id">
                                <option value="">Select Property</option>
                                <?php foreach ($properties as $property) { ?>
                                    <option value="<?= $property['property_id'] ?>" <?= (isset($request_data['property_id']) && $request_data['property_id'] == $property['property_id']) ? 'selected' : '' ?> data-is_hall="<?= $property['is_hall'] ?>"><?= $property['property_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="check_in_date" class="form-label">Check In <span class="asterisk"> *</span></label>
                            <input type="date" id="check_in_date" name="check_in_date" min="<?= date('Y-m-d') ?>" class="form-control" placeholder="Check In">
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="check_out_date" class="form-label">Check Out <span class="asterisk"> *</span></label>
                            <input type="date" id="check_out_date" name="check_out_date" min="<?= date('Y-m-d') ?>" class="form-control" placeholder="Check Out">
                        </div>
                    </div>
                    <div class="row g-3 add_room_div">
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="tax_name" class="form-label">Adults <span class="asterisk"> *</span></label>
                            <select class="form-select" name="adult[]">
                                <option value="" selected>Select Adults</option>
                                <?php for ($x = 1; $x <= 10; $x++) { ?>
                                    <option value="<?= $x ?>"><?= $x ?></option>
                                <?php } ?>
                                <option value="5000">Not Applicable</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="tax_name" class="form-label">Children </label>
                            <select class="form-select" name="child[]">
                                <option value="" selected>Select Children</option>
                                <?php for ($x = 1; $x <= 10; $x++) { ?>
                                    <option value="<?= $x ?>"><?= $x ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-2">
                                                <label for="tax_name" class="form-label">Infants <span class="asterisk"> *</span></label>
                                                <select class="form-control" name="infants[]">
                                                    <option selected>Select Infants</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                                  </div> -->
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <label for="tax_name" class="form-label">Accommodation </label>
                            <select class="form-select select2 accommodation_id" name="accommodation_id[]">
                                <option value="" selected>Select Accommodation</option>
                            </select>
                        </div>


                        <!--<div class="col-lg-2 col-sm-12 col-md-6" style="margin-top: 45px;">
                            <button type="button" class="btn app-btn-primary" id="add_more_button"><i class="fa fa-plus"></i> Add Room</button>
                        </div>-->


                    </div>

                    <div class="add_room_div" id="add_more_paste"></div>

                    <div class="col-md-12 mt-3">
                        <button id="search_room_btn" type="button" class="btn app-btn-primary">Search</button>
                    </div>

					<div class="col-md-12 room_details bg_grey mt-3">
                        <div class="row">
							<div class="table-responsive" id="property_availability">
				
							</div>
                        </div>
                    </div>

                    <div class="col-md-12 room_details bg_grey mt-3">
                        <div class="row" id="room_search_div">





                        </div>
                    </div>

               



            </div>

        </div>
		
		<div class="app-card app-card-orders-table shadow-sm mb-5">
			<div class="app-card-body">
				<div class="table-responsive" id="property_availability">
				
				</div>
			</div>
		</div>

        <div class="room_store_sec">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">

                        <ul class="room_item_list">

                        </ul>

                    </div>
                    <div class="col-md-8">
                        <div class="row align-items-center">
							
							<div class="col-md-7 room_item_txt">

                            </div>
                            <div class="col-md-2 text-center">
                                <button type="button" id="continue_to_book_room" class="btn btn-green btn-continue">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
		
		</form>
	</div>

    </div>
	

    <div class="container-xl book_room_div" style="display:none;">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Book Room </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->

                        <div class="col-auto">
                            <strong id="check_in_out_details_book_room">

                            </strong>
                        </div>
                        <div class="col-auto">
                            <button class="btn app-btn-primary" id="back_to_search_room">
                                Back
                            </button>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>

        <style type="text/css">
            /* Style the tab */
            .Assign_Customer_Sec .tab {
                overflow: hidden;
                border: 1px solid transparent;
                background-color: transparent;
                text-align: center;
            }

            /* Style the buttons inside the tab */
            .Assign_Customer_Sec .tab button {
                /*background-color: inherit;*/
                float: none;
                text-align: center;
                /*  border: none;
                    outline: none;
                    cursor: pointer;
                    padding: 14px 16px;
                    transition: 0.3s;
                    font-size: 17px;*/
            }

            /* Change background color of buttons on hover */
            .Assign_Customer_Sec .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .Assign_Customer_Sec .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .Assign_Customer_Sec .tabcontent {
                display: none;
                padding: 6px 0;
                border: 1px solid transparent;
                border-top: none;
            }

            .text-right {
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

            .btn {
                margin: 2.5px 0;
            }

            .btn-apply {
                padding: 8.5px 15px;
                position: relative !important;
                top: -2px;
            }

            .Assign_Customer_Sec .tab button {
                display: inline-block;
                border: 1px solid #6dafff;
                padding: 7px 15px;
                color: #fff;
                min-height: 51px;
                font-size: 19px;
                background: #6dafff;
            }

            .Assign_Customer_Sec .tab button:first-child {
                border-radius: 30px 0 0 30px;
                margin-right: -2px;
            }

            .Assign_Customer_Sec .tab button:last-child {
                border-radius: 0 30px 30px 0;
                border-left: none;
                margin-left: -2px;
            }

            .Assign_Customer_Sec .tab button.active,
            .Assign_Customer_Sec .tab button:hover {
                border-color: #246fc9;
                background: #246fc9;
                color: #fff;
            }
        </style>
        <!--//row-->

        <div class="app-card app-card-settings shadow-sm p-3">

            <form id="room_book_form" class="settings-form" method="post" action="#" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">



                <div class="app-card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <h4><i class="fa fa-info-circle"></i> Room Details</h4>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left" id="sports_facilities">
                                    <thead>
                                        <tr>
                                            <th class="cell">SL No.</th>
                                            <th class="cell">Room Description </th>
                                            <th class="cell">Room Rate</th>
                                            <th class="cell">Qty</th>
                                            <th class="cell">Discount</th>
                                            <th class="cell">Taxable Amount</th>
                                            <th class="cell">Tax Amount</th>
                                            <th class="cell">Total Payble Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody id="room_details_tbody">


                                    </tbody>
                                    <tfoot>
                                        <tr>



                                            <input type="hidden" id="room_base_price" name="room_base_price" value="">
                                            <input type="hidden" id="room_price_before_tax" name="room_price_before_tax" value="">
                                            <input type="hidden" id="room_total_cgst" name="room_total_cgst" value="">
                                            <input type="hidden" id="room_total_sgst" name="room_total_sgst" value="">
                                            <input type="hidden" id="room_total_igst" name="room_total_igst" value="">
                                            <input type="hidden" id="net_amount" name="net_amount" value="">
                                            <input type="hidden" id="total_amount" name="total_amount" value="">
                                            <input type="hidden" id="total_base_price_b4_disc" name="total_base_price_b4_disc" value="">


                                            <td style="font-size: 15px;">Discount (%) </td>  
                                            <td style="font-size: 15px;">
                                                <input type="number" class="form-control discount_cls" id="discount_perc" name="discount_perc" data-type="perc" placeholder="Discount (%)" min="0" step="1">
                                            </td>
                                            <td style="font-size: 15px;">Amount </td>
                                            <td style="font-size: 15px;">
                                                <input type="number" class="form-control discount_cls" id="discount_amount" name="discount_amount" data-type="amount" placeholder="Discount" min="0" step="1" readonly="">
                                            </td>
											
											<td style="font-size: 15px;">Upload Documents </td>
                                            <td>
												<!--<input class="form-control" type="file" name="supporting_doc[]" id="supporting_doc" style="width:100px;">-->
												<input class="form-control" id="fileUpload" type="file" name="supporting_doc[]" multiple />	
											</td>
											<td style="font-size: 15px;">Remarks </td>
                                            <td>
												<textarea class="form-control" name="remarks"></textarea>
											</td>

                                        </tr>
                                        <tr>
                                            <td colspan="8" style="text-align:right; font-weight:bold;font-size: 19px;">Total : <span class=""><i class="fa fa-inr"></i></span> <span id="net_amount_txt"></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!--//table-responsive-->
                        </div>

                        <div class="col-md-12">
                            <h4><i class="fa fa-user"></i> Assign Customer</h4>
                            <hr>
                        </div>
                        <!-- <div class="col-md-10">
                            <div class="form-group" style="position:relative;">
                                <div class="input-group">
                                    <input class="form-control search" id="" name="search" placeholder="Search By Guest Name, Mobile No, E-mail" autocomplete="off" tabindex="0" autofocus="" type="text">
                                    <span class="input-group-btn">
                                        <button class="btn te-nor btn-green btn-apply" type="button" id="" tabindex="-1"><span style="margin-left:10px; ">Search</span> </button>
                                    </span>
                                </div>

                            </div>

                        </div> -->
                        <div class="col-md-12">
                            <label for="tax_name" class="form-label">Select Customer <span class="asterisk"> *</span></label>
                            <select class="form-select select2" id="customer_id" name="customer_id" required>
                                <option value="">Search Customer Name Or Contact No</option>
                                <option value="0">Add New Customer</option>
                                <!-- <option value="">-----------------</option> -->
                                <?php if (!empty($customer_list)) { ?>
                                    <?php foreach ($customer_list as $customer) { ?>
                                        <option value="<?= $customer['customer_id']; ?>" data-customer_data='<?= json_encode($customer) ?>'><?= $customer['first_name'] . ' ' . $customer['last_name'] . ' - ' . $customer['mobile'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="Assign_Customer_Sec" style="display:none;">

                            <div class="tab">
                                <button id="customer_type_I" type="button" class="tablinks customer_type active" data-customer_type="P">Personal</button>
                                <button id="customer_type_B" type="button" class="tablinks customer_type" data-customer_type="B">Business</button>

                            </div>

                            <div id="Personal" style="display:block;">

                                <div class="col-md-12">
                                    <h4><i class="fa fa-user"></i> Personal Details</h4>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <!--<div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">Salutation</label>
                                            <select class="form-control" id="customer_title" name="customer_title">
                                            
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Dr.">Dr.</option>
                                            </select>
                                        </div>-->
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">Full Name <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Full Name">

                                        </div>
                                        <!--<div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_percentage" class="form-label">Last Name <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                        </div>-->

                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="cgst_percentage" class="form-label">Email Address <span class="asterisk"> *</span></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="sgst_percentage" class="form-label">Mobile No. <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No">
                                        </div>
										
										<div class="col-lg-12 col-sm-12 col-md-6">
                                            <label for="sgst_percentage" class="form-label">Designation <span class="asterisk"> </span></label>
                                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                                        </div>




                                    </div>
                                </div>
                            </div>

                            <div id="Business" style="display:none;">
                                <div class="col-md-12 mt-3">
                                    <h4><i class="fa fa-briefcase"></i> Business Details</h4>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">GST Number <span class="asterisk"> </span></label>
                                            <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="GST Number">

                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_percentage" class="form-label">Company Name <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                                        </div>

                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="cgst_percentage" class="form-label">Business Email id  <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Business Email id">
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-md-6">
                                            <label for="sgst_percentage" class="form-label">Company Address </label>
                                            <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="sgst_percentage" class="form-label">Phone No. <span class="asterisk"> *</span></label>
                                            <input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Phone No.">
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">Country <span class="asterisk"> </span></label>
                                            <select class="form-control" id="company_country_id" name="company_country_id">
                                                <option value="">Select country</option>
                                                <?php
                                                if (isset($countries))
                                                    foreach ($countries as $c) {
                                                ?>
                                                    <option value="<?= $c['country_id']; ?>" selected><?= $c['country_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">State <span class="asterisk"> </span></label>
                                            <select class="form-control" id="company_state_id" name="company_state_id">
                                                <option value="">Select state</option>
                                                <?php
                                                if (isset($states))
                                                    foreach ($states as $s) {
                                                ?>
                                                    <option value="<?= $s['state_id']; ?>"><?= $s['state_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-12 mt-3">
							    <div class="form-group">
									<label>Whether any of the guest is a foreign national? <i class="req">*</i></label><br />
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="radio" name="guest_type_foreign" id="guestTypeForeign1" value="2" checked="checked">
									  <label class="form-check-label" for="guestTypeForeign1">No</label>
									</div>
									<div class="form-check form-check-inline">
									  <input class="form-check-input" type="radio" name="guest_type_foreign" id="guestTypeForeign2" value="1">
									  <label class="form-check-label" for="guestTypeForeign2">Yes</label>
									</div>
								</div>
							</div>
							
							<div class="col-12 mt-3" id="show_when_foreigner" style="display:none;">
							
								<div class="col-12">
								
									<div class="table-responsive applicants-data-add-table" id="after_accommo_change_show">
										<table class="table table-sm align-middle table-bordered mb-0" id="myTableForeigner">
											<tr>
												<th>Name</th>
												<th>Age</th>
												<th>Gender</th>
												<th>Nationality</th>
												<th></th>
											</tr>
											
											<?php
											$counter++;
											?>
												<tr class="text-box">
													<td><input type="text" class="form-control" name="foreigner_name[]" id="foreigner_name" placeholder="Name" required>
													</td>
													
													<td>
														<select class="form-control" name="foreigner_age[]" id="foreigner_age" required>
															<option value="">Age</option>
															<?php for ($a = 1; $a <= 120; $a++) { ?>
															<option value="<?= $a; ?>"><?= $a; ?></option>
															<?php } ?>
														</select>
													</td>
													
													<td>
														<select class="form-control" name="foreigner_gender[]" id="foreigner_gender" required>
															<option value="">Gender</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
															<option value="Other">Transgender</option>
														</select>
													</td>
													
													<td>
														<select class="form-control" name="foreigner_nationality[]" id="foreigner_nationality" required>
															<option value="">Nationality</option>
															<?php
															if(!empty($nationalities)){
																foreach($nationalities as $natio){
															?>
																<option value="<?= $natio['nationality'];?>"><?= $natio['nationality'];?></option>
															<?php
																}
															}
															?>
														</select>
													</td>
													<td></td>
													
												</tr>
										</table>
									</div>
									
									<div class="text-end mt-3">
										<button type="button" class="btn btn-info text-white" id="add_row_foreigner"><i class="fa fa-plus"></i></button>
									</div>
								</div>
								
							
							</div>



                        </div>

                        <div class="col-md-12">
                            <input type="hidden" id="customer_type" name="customer_type" value="P">
							<button type="button" id="book_room_submit" class="btn app-btn-primary">SUBMIT</button>
                            <!-- <a class="btn app-btn-danger" href="https://panchayet.syscentricdev.com/admin/tax">CANCEL</a> -->
                        </div>


                    </div>

                </div>


            </form>
        </div>
        <!--//app-card-body-->

    </div>


    <!--//app-card-body-->

</div>



<script type="text/javascript">
    $(document).ready(function() {

        //$("#customer_id").select2();

        var check_in_date = document.getElementById('check_in_date');
        var check_out_date = document.getElementById('check_out_date');

        check_in_date.addEventListener('change', function() {
            if (check_in_date.value)
                check_out_date.min = check_in_date.value;
        }, false);
        check_out_date.addEventListener('change', function() {
            if (check_out_date.value)
                check_in_date.max = check_out_date.value;
        }, false);


        $("#add_more_button").click(function() {

            var accommodation_id_HTML = $(".accommodation_id").html();
            accommodation_id_HTML.replace('selected', '');
            //console.log(accommodation_id_HTML);
            var resultHTML = `<div class="row g-3 add_more_div">
                                        
                                        <div class="col-lg-3 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">Adults <span class="asterisk"> *</span></label>
                                        <select class="form-select" name="adult[]">
                                            <option value="" selected>Select Adults</option>
                                            <?php for ($x = 1; $x <= 10; $x++) { ?>
                                                <option value="<?= $x ?>"><?= $x ?></option>
                                            <?php } ?>
                                        </select>
                                          </div>
                                          <div class="col-lg-3 col-sm-12 col-md-6">
                                            <label for="tax_name" class="form-label">Children </label>
                                        <select class="form-select" name="child[]">
                                            <option value="" selected>Select Children</option>
                                            <?php for ($x = 1; $x <= 10; $x++) { ?>
                                                <option value="<?= $x ?>"><?= $x ?></option>
                                            <?php } ?> 
                                        </select>
                                          </div>
                                          
                                                  <div class="col-lg-4 col-sm-12 col-md-6">
                                        <label for="tax_name" class="form-label">Accommodation </label>
                                         <select class="form-select accommodation_id" name="accommodation_id[]">
                                         ` + accommodation_id_HTML + `
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 col-md-6" style="margin-top: 45px;">
                                        <button type="button" class="btn app-btn-danger remove_btn"><i class="fa fa-trash"></i> Remove</button>
                                      </div>
                                    </div>`;

            $("#add_more_paste").append(resultHTML);
        })
    });

    $(document).on('click', '.remove_btn', function() {

        $(this).parents('.add_more_div').remove();
    })



    $('#property_id').change(function() {
        var property_id = $(this).val();
        var is_hall = $(this).find('option:selected').data('is_hall');
        if (is_hall == 1) {


            $(".add_room_div").hide();
            $("#add_more_paste").html('');
            $("select[name='adult[]']").val('5000');

        } else {
            $(".add_room_div").show();
            $("select[name='adult[]']").val('');
        }

        $.ajax({
            url: '<?= base_url("admin/booking/getaccommodation"); ?>',
            method: 'post',
            data: {
                property_id: property_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>'
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                var resultHTML = '<option value="" selected>Select Accommodation</option>';
                $.each(response, function(index, data) {

                    resultHTML += '<option value="' + data.accommodation_id + '">' + data.accommodation_name + '</option>';

                });
                $('.accommodation_id').html(resultHTML);
            }
        });
    });


    $('#search_room_btn').click(function() {

        var is_set_adult = true;
        $("select[name='adult[]']").each(function(index) {

            if (!$(this).val()) {

                is_set_adult = false;

            }
        });

        if (!$("#property_id").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please select property',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!$("#check_in_date").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please enter check in date',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!$("#check_out_date").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please enter check out date',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!is_set_adult) {

            $.alert({
                title: 'Alert!',
                content: 'Please select no of adult',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        }

        var base_url = "<?= base_url('public/admin_images/') ?>";

        var room_search_form = $('#room_search_form')[0];
        // Create an FormData object 
        var formData = new FormData(room_search_form);
        //console.log(formData);

        $.ajax({
            url: '<?= base_url("admin/booking/search_room"); ?>',
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,

            success: function(response) {
                if (response.status) {
                    
					$('#property_availability').html(response.accommodation_available);
					
					var resultHTML = '';
                    if (response.search_room_data.length > 0) {

                        $.each(response.search_room_data, function(index, data) {
                            resultHTML += `<div class="col-md-12">
                                        <h5><i class="fa fa-home"></i> Room ` + (index + 1) + `</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 room_details_row mb-3">

                                    <input type="hidden" name="base_price[]" value="` + data.base_price + `">
                                    <input type="hidden" name="accommodation_name[]" value="` + data.accommodation_name + `">
                                    <input type="hidden" name="room_no[]" value="` + (index + 1) + `">
                                    <input type="hidden" name="select_accommodation_id[]" value="` + data.accommodation_id + `">
                                    <input type="hidden" name="select_adult[]" value="` + data.adult + `">
                                    <input type="hidden" name="select_child[]" value="` + data.child + `">
                                    <input type="hidden" name="select_tax_amount_base_price[]" value="` + data.tax_amount_base_price + `">
									
									<input type="hidden" name="extra_bed_price_b4_disc[]" value="` + data.extra_bed_price_b4_disc + `">
									<input type="hidden" name="tax_amount_base_plus_extra[]" value="` + data.tax_amount_base_plus_extra + `">
									<input type="hidden" name="gst_percentage[]" value="` + data.gst_percentage + `">
									



                                        <div class="card">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12"><h5>` + data.accommodation_name + ` <small>( ` + data.adult + ` Adult, ` + data.child + ` Child)  [Available: ` + data.no_of_accomm + `]</small></h5></div>
                                                    <div class="col-md-3">
                                                        <a class="room_photo" href="" target="_new"><img src="` + ((data.accomm_image1) ? base_url + data.accomm_image1 : 'https://jmd.syscentricdev.com/hotel_pms/assets/images/accomodation2.jpg') + `" alt="Room Details : " class="" width="100%"></a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row room_dtl_sec border-0">
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-3 price_sec">
                                                                <h5><i class="fa fa-inr"></i> ` + data.base_price + `</h5>
                                                                <p>` + response.diff_check_in_out_nights + `</p>
                                                                <p><small><i class="fa fa-inr"></i> + ` + parseFloat(data.tax_amount_base_price).toFixed(2) + ` Taxes & Other Charges</small></p>  
                                                            </div>
                                                            <div class="col-md-3 btn_sec">
                                                                
                                                                <select class="form-select select_room_qty"  name="select_room_qty[]">
                                                                    <option value="" selected>Select Qty</option>`;
                                                                    for (var qty = 1; qty <= data.no_of_accomm; qty++) {
                                                                        resultHTML += `<option value="` + qty + `">` + qty + `</option>`;
                                                                    }
                                                                    resultHTML += `</select>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                        </div>
                                    </div>`;



                        });
						
                    } else {
                        resultHTML += `No room available`;
                    }
                    $(".room_details").show();
                    $("#room_search_div").html(resultHTML);

                }
            }
        });
    });

    $(document).on('change', '.select_room_qty', function() {

        var select_room_HTML = '';
		var select_extra_pax = '';
        var check_in_date = $("#check_in_date").val();
        var check_out_date = $("#check_out_date").val();
        var total_amount = Number(0);
        var total_tax_amount = Number(0);
        $(".select_room_qty").each(function(index) {
            var select_room_qty = Number($(this).val());
            if (select_room_qty > 0) {
                var base_price = $(this).parents('.room_details_row').find("input[name='base_price[]']").val();
                var select_tax_amount_base_price = $(this).parents('.room_details_row').find("input[name='select_tax_amount_base_price[]']").val();
                var accommodation_name = $(this).parents('.room_details_row').find("input[name='accommodation_name[]']").val();
                var room_no = $(this).parents('.room_details_row').find("input[name='room_no[]']").val();
				
				var extra_bed_price_b4_disc = $(this).parents('.room_details_row').find("input[name='extra_bed_price_b4_disc[]']").val();
				var tax_amount_base_plus_extra = $(this).parents('.room_details_row').find("input[name='tax_amount_base_plus_extra[]']").val();
				var gst_percentage = $(this).parents('.room_details_row').find("input[name='gst_percentage[]']").val();


                var base_price_amount = Number(base_price) * select_room_qty;
                var select_tax_amount_base_price_amount = Number(select_tax_amount_base_price) * select_room_qty;
                total_amount += base_price_amount;
                total_tax_amount += select_tax_amount_base_price_amount;

                select_room_HTML += `<li>
                        <h5>Room ` + room_no + ` (Qty : ` + select_room_qty + `)</h5>
                        <p><small>` + accommodation_name + ` <span class="WebRupee">Rs.</span> ` + parseFloat(base_price_amount).toFixed(2) + ` </small></p>
                        <p><small> Taxes & Other Charges <span class="WebRupee">Rs.</span> ` + parseFloat(select_tax_amount_base_price_amount).toFixed(2) + ` </small></p>
						
						<p>Extra Person<br>
							<input type="hidden" id="base_price_amount` + room_no + `" value="` + base_price_amount + `" readonly>
							<input type="hidden" id="select_tax_amount_base_price_amount` + room_no + `" value="` + select_tax_amount_base_price_amount + `" readonly>
							<input type="hidden" id="extra_bed_price_b4_disc` + room_no + `" value="` + extra_bed_price_b4_disc + `" readonly>
							<input type="hidden" id="tax_amount_base_plus_extra` + room_no + `" value="` + tax_amount_base_plus_extra + `" readonly>
							<input type="hidden" id="gst_percentage` + room_no + `" value="` + gst_percentage + `" readonly>
							
							
							<select name="choose_extra_pax[]" class="form-select form-select-sm select_extra_pax" data-qty="` + select_room_qty + `" data-room-no="` + room_no + `">
							<option value="0" selected>Select extra person here (If required)</option>`;
							for (var eqty = 1; eqty <= select_room_qty; eqty++) {
								select_room_HTML += `<option value="` + eqty + `">` + eqty + `</option>`;
							}
							select_room_HTML += `</select>
							
							
						</p>
                    </li>`;

            }


        });

        //alert(moment(check_in_date,"YYYY-MM-DD").format("DD-MM-YYYY"));
        var room_item_txt_HTML = `<p>Check In : ` + moment(check_in_date, "YYYY-MM-DD").format("DD-MM-YYYY") + ` - Check Out : ` + moment(check_out_date, "YYYY-MM-DD").format("DD-MM-YYYY") + `</p>
                        <h4>Base Amount  <i class="fa fa-inr"></i> ` + parseFloat(total_amount).toFixed(2) + `</h4>
                        <h6>Taxes & Other Carges  <i class="fa fa-inr"></i> ` + parseFloat(total_tax_amount).toFixed(2) + `</h4>`;
						

        $(".room_item_list").html(select_room_HTML);
        $(".room_item_txt").html(room_item_txt_HTML);

        $(".room_store_sec").show();
    })
	
	
	$(document).on('change', '.select_extra_pax', function() {

        var check_in_date = $("#check_in_date").val();
        var check_out_date = $("#check_out_date").val();
        var total_amount = Number(0);
        var total_tax_amount = Number(0);
        $(".select_extra_pax").each(function(index) {
            var select_extra_pax = Number($(this).val());
			var select_room_qty = $(this).data('qty');
			var room_no = $(this).data('room-no');
            if (select_extra_pax > 0) {
                var base_price = $('#base_price_amount'+room_no).val();
                var select_tax_amount_base_price = $('#select_tax_amount_base_price_amount'+room_no).val();
				
				var extra_bed_price_b4_disc = $('#extra_bed_price_b4_disc'+room_no).val() * select_extra_pax;
				var tax_amount_base_plus_extra = $('#tax_amount_base_plus_extra'+room_no).val();
				var gst_percentage = $('#gst_percentage'+room_no).val();
				var extra_bed_tax = ((Number(extra_bed_price_b4_disc) * gst_percentage) / 100);
				console.log(extra_bed_tax);
				//var price_extra_bed = Number(extra_bed_price_b4_disc) * select_room_qty;
				var base_price_after_extra_bed = Number(base_price) + Number(extra_bed_price_b4_disc);

                var base_price_amount = Number(base_price_after_extra_bed);
                var select_tax_amount_base_price_amount = Number(select_tax_amount_base_price) + Number(extra_bed_tax);
                total_amount += base_price_amount;
                total_tax_amount += select_tax_amount_base_price_amount;


            }
			else if(select_extra_pax == 0){
				
				var base_price = $('#base_price_amount'+room_no).val();
                var select_tax_amount_base_price = $('#select_tax_amount_base_price_amount'+room_no).val();
				
				
				var base_price_amount = Number(base_price);
                var select_tax_amount_base_price_amount = Number(select_tax_amount_base_price);
                total_amount += base_price_amount;
                total_tax_amount += select_tax_amount_base_price_amount;
				
			}


        });

        //alert(moment(check_in_date,"YYYY-MM-DD").format("DD-MM-YYYY"));
        var room_item_txt_HTML = `<p>Check In : ` + moment(check_in_date, "YYYY-MM-DD").format("DD-MM-YYYY") + ` - Check Out : ` + moment(check_out_date, "YYYY-MM-DD").format("DD-MM-YYYY") + `</p>
                        <h4>Base Amount  <i class="fa fa-inr"></i> ` + parseFloat(total_amount).toFixed(2) + `</h4>
                        <h6>Taxes & Other Carges  <i class="fa fa-inr"></i> ` + parseFloat(total_tax_amount).toFixed(2) + `</h4>`;
						

        $(".room_item_txt").html(room_item_txt_HTML);

        $(".room_store_sec").show();
    });
	
	

    $("#continue_to_book_room").click(function() {

        $(".search_select_room_div").hide();
        $(".book_room_div").show();
        continue_to_book_room(0, 'perc');

    })

    $("#back_to_search_room").click(function() {
        $(".search_select_room_div").show();
        $(".book_room_div").hide();

    })

    function continue_to_book_room(discount_callback = 0, type) {


                var discount_perc = !isNaN($("#discount_perc").val()) ? $("#discount_perc").val() : 0;
                var discount_amount = Number($("#discount_amount").val());
                var total_base_price_b4_disc = $("#total_base_price_b4_disc").val();

                //alert(type);
                //alert(total_base_price_b4_disc);
                if (type == 'perc') {

                    if (discount_perc > 100) {

                        $.alert({
                            title: 'Alert!',
                            content: 'Discount percentage should not greater than 100',
                            type: 'red',
                            typeAnimated: true,
                        })
                        $(this).val(0);
                        discount_amount = 0;
                    }

                    var dec = Number(discount_perc / 100).toFixed(4); //its convert 10 into 0.10
                    //console.log(dec);
                    discount_amount = Number(total_base_price_b4_disc * dec).toFixed(2);
                    //console.log(discount_amount);
                    $("#discount_amount").val(discount_amount);

                } else if (type == 'amount') {

                    discount_perc = Number(discount_amount * 100 / total_base_price_b4_disc).toFixed(2);
                    if (discount_perc > 100) {

                        $.alert({
                            title: 'Alert!',
                            content: 'Discount amount should not greater than total amount',
                            type: 'red',
                            typeAnimated: true,
                        })
                        $(this).val(0);
                        discount_perc = 0;
                    }
                    $("#discount_perc").val(discount_perc);
                }

        var book_room_HTML = '';
        var check_in_date = $("#check_in_date").val();
        var check_out_date = $("#check_out_date").val();
        var check_in_date_moment = moment(check_in_date, "YYYY-MM-DD");
        var check_out_date_moment = moment(check_out_date, "YYYY-MM-DD");
		//var choose_extra_pax = $("select[name='choose_extra_pax[]']").val();
        

        var difference = check_out_date_moment.diff(check_in_date_moment, 'days');

        $("#check_in_out_details_book_room").text("Check in Date : " + moment(check_in_date, "YYYY-MM-DD").format("DD-MM-YYYY") + " Check out Date : " + moment(check_out_date, "YYYY-MM-DD").format("DD-MM-YYYY") + " Number of Days : " + difference + "");

        var room_search_form = $('#room_search_form')[0];
        // Create an FormData object 
        var formData = new FormData(room_search_form);
        formData.append('discount_perc', discount_perc);
		//formData.append('choose_extra_pax', choose_extra_pax);

        $.ajax({
            url: '<?= base_url("admin/booking/search_room"); ?>',
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                //console.log(response);
                if (response.status) {

                    if (response.search_room_data.length > 0) {
                        var total_amount = Number(0);
                        var total_base_price_b4_disc = Number(0);
                        var total_room_price_before_tax = Number(0);
                        var total_disc_amt_on_base = Number(0);
                        var room_total_cgst = Number(0);
                        var room_total_sgst = Number(0);
                        var room_total_igst = Number(0);

                        
                        $.each(response.search_room_data, function(index1, data) {

                            
                            var accommodation_name = data.accommodation_name;
                            var room_no = index1  + 1;
                            var select_accommodation_id = data.accommodation_id;
                            var select_adult = data.adult;
                            var select_child = data.child;
                            var select_room_qty = data.select_room_qty;
							
							var extra_bed_price = (data.choose_extra_pax > 0) ? (data.extra_bed_price * data.choose_extra_pax) : '0.00';
							var extra_bed_tax = parseFloat(extra_bed_price * (data.gst_percentage / 100)).toFixed(2);
							var tax_amount_base_plus_extra = (data.choose_extra_pax > 0) ? (Number(data.tax_amount_base_price * select_room_qty) + Number(extra_bed_tax)) : (data.tax_amount_base_price * select_room_qty);
                            
                            var base_price = Number(data.base_price * select_room_qty);
                            var disc_amt_on_base = Number(data.disc_amt_on_base * select_room_qty);
                            total_disc_amt_on_base +=Number(disc_amt_on_base);
                            
                            if(index1 == response.search_room_data.length - 1){
                                var diff_discount_amount = parseFloat(Number(discount_amount) - Number(total_disc_amt_on_base)).toFixed(2);
                                base_price = Number(base_price) - Number(diff_discount_amount);
                                disc_amt_on_base = Number(disc_amt_on_base) + Number(diff_discount_amount);
                                //alert(base_price);
                            }

                            var base_price_b4_disc = Number(data.base_price_b4_disc  * select_room_qty);
                            var room_price_before_tax = base_price;
                            var tax_amount_base_price = parseFloat(base_price * (data.gst_percentage / 100)).toFixed(2);
                            var room_tax_cgst = parseFloat(base_price * (data.cgst_percentage / 100)).toFixed(2);
                            var room_tax_sgst = parseFloat(base_price * (data.sgst_percentage / 100)).toFixed(2);
                            var room_tax_igst = parseFloat(base_price * (data.igst_percentage / 100)).toFixed(2);
							
							var taxable_amount = Number(base_price) + Number(extra_bed_price);
							var total_payable_amount = Number(taxable_amount) + Number(tax_amount_base_plus_extra);
                            
                            total_base_price_b4_disc += Number(base_price_b4_disc);
                            total_room_price_before_tax += Number(base_price);
                            total_amount += total_payable_amount;
                            
                            room_total_cgst += room_tax_cgst;
                            room_total_sgst += room_tax_sgst;
                            room_total_igst += room_tax_igst;
                            
                            
                            book_room_HTML += `<tr>
                            
                            <input type="hidden" name="book_room_base_price[]" value="` + parseFloat(base_price_b4_disc / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="book_room_room_charge[]" value="` + parseFloat(base_price_b4_disc / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="room_discount_percent[]" value="` + discount_perc + `">
                            <input type="hidden" name="room_discount_amount[]" value="` + parseFloat(disc_amt_on_base / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="room_taxable_amount[]" value="` + parseFloat(base_price / select_room_qty).toFixed(2) + `">
                            

                            <input type="hidden" name="tax_amount_base_price[]" value="` + parseFloat(tax_amount_base_price / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="book_room_accommodation_id[]" value="` + select_accommodation_id + `">
                            <input type="hidden" name="book_room_adult[]" value="` + select_adult + `">
                            <input type="hidden" name="book_room_child[]" value="` + select_child + `">
                            <input type="hidden" name="book_room_qty[]" value="` + select_room_qty + `">
                            
                            <input type="hidden" name="book_room_net_amount[]" value="` + parseFloat(total_payable_amount / select_room_qty).toFixed(2) + `">

                            

                            <input type="hidden" name="room_cgst[]" value="` + parseFloat(room_tax_cgst / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="room_sgst[]" value="` + parseFloat(room_tax_sgst / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="room_igst[]" value="` + parseFloat(room_tax_igst / select_room_qty).toFixed(2) + `">
                            <input type="hidden" name="room_cgst_percent[]" value="` + data.cgst_percentage + `">
                            <input type="hidden" name="room_sgst_percent[]" value="` + data.sgst_percentage + `">
                            <input type="hidden" name="room_igst_percent[]" value="` + data.igst_percentage + `">
							<input type="hidden" name="day_wise_rates_json[]" value="` + data.day_wise_rates_json + `">
							<input type="hidden" name="is_select_extra_bed[]" value="` + data.choose_extra_pax + `">




                                        <td>Room ` + room_no + `</td>
                                        <td>` + accommodation_name + ` </td>
                                        <td class="cell">` + parseFloat(base_price_b4_disc / select_room_qty).toFixed(2) + `</td>
                                        <td>` + select_room_qty + `</td>
                                        <th class="cell">` + parseFloat(disc_amt_on_base).toFixed(2) + `</th>
                                            <th class="cell">` + parseFloat(taxable_amount).toFixed(2) + `</th>
                                            <th class="cell">` + parseFloat(tax_amount_base_plus_extra).toFixed(2) + `</th>
                                        
                                        <td class="text-right"><span class="WebRupee"><i class="fa fa-inr"></i></span> ` + parseFloat(total_payable_amount).toFixed(2) + `</td>
                                    </tr>`;

                                    



                                

                            

                        })

                        book_room_HTML += ``;


                        // <td style="text-align:right; font-weight:bold;font-size: 19px;"><span class="WebRupee"><i class="fa fa-inr"></i></span> <span id="discount_amount_txt">- 0.00</span></td>




                    } else {
                        book_room_HTML += `<tr>
                            <td colspan="8">No Room Selected</td>
                        </tr>`;
                    }



                }

                $("#net_amount").val(parseFloat(total_amount).toFixed(2));
                $("#total_amount").val(parseFloat(total_amount).toFixed(2));
                $("#net_amount_txt").text(parseFloat(total_amount).toFixed(2));
                $("#total_base_price_b4_disc").val(parseFloat(total_base_price_b4_disc).toFixed(2));
                $("#room_base_price").val(parseFloat(total_base_price_b4_disc).toFixed(2));
                $("#room_price_before_tax").val(parseFloat(total_room_price_before_tax).toFixed(2));
                $("#room_total_cgst").val(parseFloat(room_total_cgst).toFixed(2));
                $("#room_total_sgst").val(parseFloat(room_total_sgst).toFixed(2));
                $("#room_total_igst").val(parseFloat(room_total_igst).toFixed(2));

                $("#room_details_tbody").html(book_room_HTML);

            }
        })

    }


    $(document).on('blur', '.discount_cls', function() {

        continue_to_book_room(1, $(this).data('type'));

        //$("#discount_amount_txt").text('-'+parseFloat(discount_amount).toFixed(2));
        //var net_amount = (total_base_price_b4_disc - discount_amount).toFixed(2);
        //$("#net_amount").val(net_amount);
        //$("#net_amount_txt").text(net_amount);


    })

    $(document).on('click', '.customer_type', function() {
        $(".customer_type").removeClass('active');
        $(this).addClass('active');
        var customer_type = $(this).data('customer_type');
        $("#customer_type").val(customer_type);
        if (customer_type == 'P') {
            $("#Personal").show();
            $("#Business").hide();
        } else {
            $("#Personal").hide();
            $("#Business").show();

        }
    })

    $('#book_room_submit').click(function() {

        
        var is_set_room = true;
        $("select[name='book_room_accommodation_id[]']").each(function(index) {

            if (!$(this).val()) {

                is_set_room = false;

            }

        });

        if (!$("#property_id").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please select property',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!$("#check_in_date").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please enter check in date',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!$("#check_out_date").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please enter check out date',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!is_set_room) {
            $.alert({
                title: 'Alert!',
                content: 'Please select atleast one accomodation to proceed',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if (!$("#customer_id").val()) {

            $.alert({
                title: 'Alert!',
                content: 'Please select customer',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if ($("#customer_id").val() == 0 && $("#customer_type").val() == 'P' && (!$("#first_name").val() || !$("#email").val() || !$("#mobile").val())) {

            $.alert({
                title: 'Alert!',
                content: 'Full name, Email & Mobile is mandatory',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        } else if ($("#customer_id").val() == 0 && $("#customer_type").val() == 'B' && (!$("#company_phone").val() || !$("#company_name").val() || !$("#company_email").val())) {

            $.alert({
                title: 'Alert!', 
                content: 'Company Name, Business Email id & Phone No. is mandatory',
                type: 'red',
                typeAnimated: true,
            })
            return false;
        }





        $("#book_room_submit").prop('disabled',true);
        $("#book_room_submit").text('Processing...');
        var base_url = "<?= base_url() ?>";
        //alert(base_url); 
        //console.log(base_url); 
        var room_search_form = $('#room_search_form')[0];
        var room_book_form = $('#room_book_form')[0];


        // Create an FormData object 
        var formData = new FormData(room_search_form);
        //formData.append('room_book_form', new FormData(room_book_form));
        //console.log(formData);

        var room_book_form = jQuery(document.forms['room_book_form']).serializeArray();
        for (var i = 0; i < room_book_form.length; i++) {
            formData.append(room_book_form[i].name, room_book_form[i].value);
        }
		//formData.append('supporting_doc', $('#supporting_doc')[0].files[0]);
		
		for( var j = 0, len = document.getElementById('fileUpload').files.length; j < len; j++ ){
			formData.append( "supporting_doc[]", document.getElementById('fileUpload').files[j] );
		}
		//console.log(document.getElementById('fileUpload').files.length);
		
        $.ajax({
            url: '<?= base_url("admin/booking/book_room_submit"); ?>',
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,

            success: function(response) {
                if (response.status) {

                    $.confirm({
                        type: 'green',
                        title: 'Success!',
                        content: response.msg,
                        buttons: {

                            OK: {
                                btnClass: 'btn-primary',
                                action: function() {


                                    window.location.href = "<?= base_url('admin/reservation') ?>";
                                }

                            }
                        }



                    })

                } else {
                    $("#book_room_submit").prop('disabled',false);
        $("#book_room_submit").text('SUBMIT');


                    $.alert({
                        title: 'Alert!',
                        content: response.msg,
                        type: 'red',
                        typeAnimated: true,
                    })
                }
            },
            error: function(xhr, status, error) {
                $("#book_room_submit").prop('disabled',false);
        $("#book_room_submit").text('SUBMIT');


                    $.alert({
                        title: 'Alert!',
                        content: 'Error',
                        type: 'red',
                        typeAnimated: true,
                    })
            }
        });
    });


    $(document).on('change', '#customer_id', function() {

        
        $(".Assign_Customer_Sec").show();
        $(".customer_type").removeClass('active');
        var customer_id = $(this).val();
        if (customer_id > 0) {

            $('#Personal input').prop('readonly', true);
            $('#Personal select').prop('disabled', true);

            $('#Business input').prop('readonly', true);
            $('#Business select').prop('disabled', true);

            $(".customer_type").prop('disabled', true);


            var customer_data = $(this).find('option:selected').data('customer_data');
            $("#customer_title").val(customer_data.customer_title);
            $("#first_name").val(customer_data.first_name);
            $("#last_name").val(customer_data.last_name);
            $("#email").val(customer_data.email);
            $("#mobile").val(customer_data.mobile);
            $("#customer_type").val(customer_data.customer_type);
            $("#company_name").val(customer_data.company_name);
            $("#company_email").val(customer_data.company_email);
            $("#company_phone").val(customer_data.company_phone);
            $("#gst_number").val(customer_data.gst_number);
            $("#company_state_id").val(customer_data.company_state_id);
            $("#company_country_id").val(customer_data.company_country_id);
            $("#company_address").val(customer_data.company_address);

            if (customer_data.customer_type == 'P') {
                $("#Personal").show();
                $("#Business").hide();
                $("#customer_type_I").addClass('active');
            } else {
                $("#Personal").show();
                $("#Business").show();
                $("#customer_type_B").addClass('active');
            }


        } else {
            $("#customer_type_I").addClass('active');
            $('#Personal input').prop('readonly', false);
            $('#Personal select').prop('disabled', false);

            $('#Business input').prop('readonly', false);
            $('#Business select').prop('disabled', false);
            $(".customer_type").prop('disabled', false);

            $('#Personal input').val('');
            $('#Business input').val('');

            $('#Personal select').val('');
            $('#Business select').val('');

        }

    });
	
	
	$('input[name="guest_type_foreign"]').on("change", function() {
		var guest_type_foreign = $('input:radio[name="guest_type_foreign"]:checked').val();
		
		if(guest_type_foreign == 1){
			$("#show_when_foreigner").show();
		}
		else{
			$("#show_when_foreigner").hide();
		}
	});
	
	$('#myTableForeigner').on('click', '#delete_row_foreigner', function () {
		$(this).closest('tr').remove();
	});
	
	
	$('#add_row_foreigner').click(function () {
		
		var counter = $('.text-box').length + 1;
		
		$('#myTableForeigner').append('<tr class="text-box"><td><input type="text" class="form-control" name="foreigner_name[]" id="foreigner_name" placeholder="Name" required></td><td><select class="form-control" name="foreigner_age[]" id="foreigner_age" required>													<option value="">Age</option><?php for ($a = 1; $a <= 120; $a++) { ?><option value="<?= $a; ?>"><?= $a; ?></option><?php } ?></select></td><td><select class="form-control" name="foreigner_gender[]" id="foreigner_gender" required><option value="">Gender</option><option value="Male">Male</option><option value="Female">Female</option><option value="Other">Transgender</option></select></td><td><select class="form-control" name="foreigner_nationality[]" id="foreigner_nationality" required><option value="">Nationality</option><?php if(!empty($nationalities)){ foreach($nationalities as $natio){ ?><option value="<?= $natio['nationality'];?>"><?= $natio['nationality'];?></option><?php } } ?></select></td><td><button type="button" class="btn btn-danger btn-sm text-white" id="delete_row_foreigner"><i class="fa fa-sm fa-trash"></i></button></td></tr>')
		
	
	});
</script>