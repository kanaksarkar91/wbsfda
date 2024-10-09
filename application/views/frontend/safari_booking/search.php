<section class="inner-banner-section" style="background: url(<?= base_url();?>public/frontend_assets/assets/img/car-safari.jpg); background-size: cover; background-position: center;">
	<div class="container-xxl">
		<h1 class="text-center"><?= $divisionData[0]['type_name'];?></h1>
		<div class="tab_area rounded-4">
			<div class="form-content" id="">
				<form action="" class="row g-2 align-items-center">
				<input type="hidden" name="safari_type_id" id="safari_type_id" value="<?= $safari_type_id;?>"  />
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					<div class="col-md-6 col-lg-3 mb-3">
						<div class="select_area">
							<select name="division_id" id="division_id" class="form-control" required>
								<option value="">Select Park</option>
								<?php
								if(!empty($divisionData)){
									foreach($divisionData as $row){
								?>
									<option value="<?= $row['division_id'];?>" <?php echo ($row['division_id'] == $division_id) ? 'selected' : ''; ?>><?= $row['division_name'];?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
					<div class="col-md-6 col-lg-3 mb-3">
						<div class="select_area">
							<select name="safari_service_header_id" id="safari_service_header_id" class="form-control" required>
								<option value="">Select Safari</option>
								<?php
								if(!empty($safariServices)){
									foreach($safariServices as $row){
								?>
									<option value="<?= $row['safari_service_header_id'];?>" <?php echo ($row['safari_service_header_id'] == $safari_service_header_id) ? 'selected' : ''; ?>><?= $row['service_definition'];?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-lg-2 mb-3">
						<div class="calenadr_area">
							<input type="text" class="form-control" name="saf_booking_date" id="saf_booking_date" value="<?= date('d-m-Y', strtotime($saf_booking_date));?>" placeholder="Date" required>
						</div>
					</div>
					<div class="col-md-4 col-lg-2 mb-3">
						<div class="select_area">
							<select name="safari_cat_id" id="safari_cat_id" class="form-control" required>
								<?php
								if(!empty($safariCat)){
									foreach($safariCat as $row){
								?>
									<option value="<?= $row['safari_cat_id'];?>" <?php echo ($row['safari_cat_id'] == $safari_cat_id) ? 'selected' : ''; ?>><?= $row['cat_name'];?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-lg-2 mb-3">
						<button type="button" class="w-100 btn btn-green" id="search_availability">Search Availability</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</section>

<section class="gray">
	<div class="container">
		<div class="row mt-3">
			<div class="col-lg-12">
				<ul class="list-unstyled" id="search_result_div">
		</div>
	</div>
</section>

<!--View Terms Modal -->
    <div class="modal fade" id="viewTerms" tabindex="-1" aria-labelledby="viewTermsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header light-grn-bg">
                    <h1 class="modal-title fw-bold thm-txt fs-5" id="viewTermsModalLabel">Terms & Conditions, Privacy Policy and Cancellation Rules.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Terms & Conditions:</h5>
                    <ol class="small text-justify">
                        <li>Visitors are required to carry the same ID proof in original at the time of visiting the national park.</li>
                        <li>The reservations of safari/ride are not transferable. The visitor should carry with him/her Print-out of the Electronic Reservation Slip.</li>
                        <li>One child below 5 years of age may ride with parents without additional charges.</li>
                        <li>Reservation may be cancelled in acute administrative requirement. No cancellation charge will be deducted in such case.</li>
                        <li>WBSFDA will not be liable against non-availability of amenities/services caused by irreparable technical faults or natural inconvenience.</li>
                    </ol>

                    <h5>Privacy Policy:</h5>
                    <ol class="small text-justify">
                        <li>As a general rule, this web site does not collect personal Information about you when you visit the site. You can generally visit this site, without revealing any personal information, unless you choose to provide such information.</li>
                        <li>Any personal information collected shall be used only for the stated purpose and shall NOT be shared with any other department/organization (Public/private).</li>
                        <li>This site may contain links to Governmental/Non-governmental sites whose data protection and privacy practices may differ from ours. We are not responsible for the content and privacy practices of these other websites and encourage
                            you to consult the privacy notices of those sites.</li>
                    </ol>

                    <h5>Cancellation Rules :</h5>
                    <ol class="small text-justify">
                        <li>More than clear 16 (Sixteen) days: 20% of the entry fee will be deducted.</li>
                        <li>Between Clear 08(Eight) to clear15(Fifteen)days:40% of the entry fee will be deducted.</li>
                        <li>Between Clear04(Four)to clear 07(Seven)days:80% of the entry fee will be deducted.</li>
                        <li>Less than or equal to 3 (Three)days: No refund.</li>
                        <li>"Clear Days" means that the date of occupation and the date of cancellation would not be counted. Moreover, Sunday & Holiday would not be excluded for calculation of cancellation charges.</li>
                        <li>For part cancellation, normal refund rules will be charged as per rules.</li>
                        <li>Refund admissible only upon production of the original reservation ticket.</li>
                        <li>Visitors have to pay vehicle entry free, Guide charge, Vehicle hiring charge and other requires charges at the entry gate/reporting point.</li>
                        <li>Visitors have to pay other charges for Folk dance, Handicrafts etc. for afternoon trips of Gorumara at the entry gate/reporting point.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--BOOKING INDEMNITY DECLARATION Modal -->
    <div class="modal fade" id="bookingindemnitydeclaration" tabindex="-1" aria-labelledby="bookingindemnitydeclarationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header light-grn-bg">
                    <h1 class="modal-title fw-bold thm-txt fs-5" id="bookingindemnitydeclarationModalLabel">INDEMNITY DECLARATION</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol class="small text-justify ps-3">
                        <li style="padding-top: 14px;">I / We understand the risk of undertaking Elephant Ride and Car Safari within the forest.</li>
                        <li style="padding-top: 11px;">I / We declare that I / We are physically and mentally fit to undertake the programme and do not have any such ailments or issues that may debar me / us in undertaking the programme. I / We further indemnify the West Bengal State
                            Forest Development Agency, Forest Directorate of West Bengal and the Department of Forests, Government of West Bengal for any liabilities or compensation in case of any physical or personal loss to body and / or property during
                            the programme. I / We declare that I / We will completely abide by the rules of the programme and will not violate any forest related Acts and Rules of the State Government / Govt. of India for the time being in force. I /
                            We also agree that in case of any contingencies and / or natural catastrophe and / or Act of God, the decision of the Forest Directorate will be ultimate and will be binding upon me / us.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success thm-bg px-4" id="proceed_to_book">I Agree</button>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function(){
	var today = new Date();
	var maxbookingdt = new Date();
	maxbookingdt.setMonth(today.getMonth() + 3);
	
	$("#saf_booking_date").datepicker({
		minDate: new Date,
		maxDate: maxbookingdt,
		dateFormat: "dd-mm-yy"
	});
	
	$("#division_id").change(function(){ 
		getServices();
	});
	
	$("#search_availability").click(function(){ 
		safari_search();
	});
	
	safari_search();
	
});

function getServices(){
	var division_id = $('#division_id').val();
	var safari_type_id = $('#safari_type_id').val();
	console.log({
	  safari_type_id: safari_type_id,
	  division_id: division_id
	});
	var result = '';
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("index/getServices"); ?>',
		data: {
			safari_type_id: safari_type_id, division_id: division_id, csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
		},
		dataType: 'json',
		encode: true,
		//async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			result +='<option value="">Select Safari</option>';
			$.each(response.list,function(key,value){
				result +='<option value="'+value.safari_service_header_id+'">'+value.service_definition+'</option>';
			});
		}
		else{
			result +='<option value="">No Data found</option>'
		}
		$("#safari_service_header_id").html(result);
	});
}

function safari_search() {
	var division_id = $('#division_id').val();
	var safari_type_id = $('#safari_type_id').val();
	var safari_service_header_id = $('#safari_service_header_id').val();
	var saf_booking_date = $('#saf_booking_date').val();
	var safari_cat_id = $('#safari_cat_id').val();
			
	$.ajax({
		type: 'POST',	
		url: '<?= base_url('safari-search-process'); ?>',
		data: {
			division_id: division_id,
			safari_type_id: safari_type_id,
			safari_service_header_id: safari_service_header_id,
			saf_booking_date: saf_booking_date,
			safari_cat_id: safari_cat_id,
			csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>'
		},
		dataType: 'json',
		encode: true,
		async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			$("#search_result_div").html(response.result);
		}
		else{
			$("#search_result_div").html(response.result);
		}
		
	});
}

</script>

<script>
$(document).ready(function() {
	$('#proceed_to_book').on('click', function() {
		var isChecked = false;
		var checkedValues = [];
		
		var period_slot_dtl_id = $('input[name="period_slot_dtl_id"]:checked').val();
		var division_id = $('#division_id').val();
		var safari_type_id = $('#safari_type_id').val();
		var safari_service_header_id = $('#safari_service_header_id').val();
		var saf_booking_date = $('#saf_booking_date').val();
		var safari_cat_id = $('#safari_cat_id').val();
		var no_of_visitor = $('#no_of_visitor').val();
		
		$('.checkbox:checked').each(function() {
			if($(this).is(':checked')){
				isChecked = true;
				checkedValues.push($(this).val());
			}
		});
		
		if(!isChecked){
			Swal.fire({
			  icon: 'error',
			  title: 'Please accept terms & conditions, privacy policy and cancellation rules!!',
			  confirmButtonText:'Ok',
			  confirmButtonColor:'#69da68',
			  allowOutsideClick: false,
			});
			return false;
		}
		
		if(!period_slot_dtl_id){
			Swal.fire({
			  icon: 'error',
			  title: 'Please select at least one slot!!',
			  confirmButtonText:'Ok',
			  confirmButtonColor:'#69da68',
			  allowOutsideClick: false,
			});
			
			return false;
		}
		
		if(no_of_visitor <= 0){
			Swal.fire({
			  icon: 'error',
			  title: 'Please enter number of visitor!!',
			  confirmButtonText:'Ok',
			  confirmButtonColor:'#69da68',
			  allowOutsideClick: false,
			});
			
			return false;
		}
		
		if(no_of_visitor > 6){
			Swal.fire({
			  icon: 'error',
			  title: 'Enter no. of person less than seven(7)!!',
			  confirmButtonText:'Ok',
			  confirmButtonColor:'#69da68',
			  allowOutsideClick: false,
			});
			
			return false;
		}
		
		
		$.ajax({
			type: 'POST',	
			url: '<?= base_url('initiate-booking'); ?>',
			data: {
				period_slot_dtl_id: period_slot_dtl_id,
				division_id: division_id,
				safari_type_id: safari_type_id,
				safari_service_header_id: safari_service_header_id,
				saf_booking_date: saf_booking_date,
				safari_cat_id: safari_cat_id,
				no_of_visitor: no_of_visitor,
				csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>',
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			//var responseObj = $.parseJSON(response);
			//console.log(responseObj);
			if (response.success == true) {
				$(location).attr("href", response.link);
			} else {
				Swal.fire({
				  icon: 'error',
				  title: response.msg,
				  confirmButtonText:'Ok',
				  confirmButtonColor:'#69da68',
				  allowOutsideClick: false,
				});
			}
			
		});
		
	});
});
</script>