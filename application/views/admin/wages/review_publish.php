<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Review & Publish Wages Estimate</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url(); ?>admin/wages">
                                Back
                            </a>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>

        <div class="row g-3 mb-3 align-items-center">
            <?= $this->session->flashdata('msg'); ?>
        </div>

        <form action="<?= base_url(); ?>admin/wages/publish_wages" method="post" id="estimatedForm" enctype="multipart/form-data">

            <input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

            <input type="hidden" name="estimate_id" value="<?= $wage_estimate_details['wages_estimate_id']; ?>">

            <div class="app-card app-card-settings shadow-sm mb-3 p-3">
                <div class="app-card-body">
                    <div class="row g-2" style="margin-bottom: 10px;">
                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">Cash in Hand <span class="asterisk"></span></label>
                            <input type="text" name="cash_in_hand" class="form-control cash_in_hand" value="<?= $wage_estimate_details['cash_in_hand']; ?>" required>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">Cash at Bank <span class="asterisk"></span></label>
                            <input type="text" name="cash_at_bank" class="form-control cash_at_bank" value="<?= $wage_estimate_details['cash_at_bank']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover" style="border:1px solid #e7e9ed;">
                            <thead style="background-color: #608d5f;">
                                <tr>
                                    <th width="" class="cell text-white">Name</th>
                                    <th width="" class="cell text-white text-end">Daily Wages (Rs.)</th>
                                    <th width="" class="cell text-white">Payable Days</th>
                                    <th width="" class="cell text-white">Festival Bonus (Rs.)</th>
                                    <th width="" class="cell text-white">Gross Wages (Rs.)</th>
                                    <th width="" class="cell text-white">Profession Tax (Rs.)</th>
                                    <th width="" class="cell text-white">PF Employee's Contribution (Rs.)</th>
                                    <th width="" class="cell text-white">PF Employer's Contribution (Rs.)</th>
                                    <th width="" class="cell text-white">Total Deduction (Rs.)</th>
                                    <th width="" class="cell text-white">Wages Payable for the month <span class="mainDate"></span> (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody class="appendWages">	
                                
                                <?php foreach($wage_estimate_details['estimate_list'] as $estimate){ ?>
                                
                                    <tr class="wageItem">
                                        <input type="hidden" class="" name="estdetail_id[]" value="<?= $estimate['wages_details_id']; ?>">
                                        <td width="" class="cell fw-bold"><?= $estimate['worker_name']; ?><input type="hidden" class="" name="worker_id[]" value="<?= $estimate['worker_id']; ?>"></td>
                                        <td width="" class="cell text-end">
                                            <div class="input-group">
                                                <!--<span class="input-group-text" id="basic-addon1">Rs.</span>-->
                                                <input type="text" class="form-control text-end fw-bold daily_wage_amount" name="daily_wage_amount[]" value="<?= $estimate['daily_wages_amount']; ?>" readonly="">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="number" class="form-control payable_days" name="payable_days[]" placeholder="0" value="<?= $estimate['payable_day']; ?>">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="number" class="form-control text-end fw-bold festive_bonus" name="festive_bonus[]" placeholder="0.00" value="<?= $estimate['festive_bonus']; ?>">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="text" class="form-control text-end fw-bold gross_wages" name="gross_wages[]" placeholder="0.00" value="<?= $estimate['gross_wages']; ?>" readonly="">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="number" class="form-control text-end fw-bold p_tax" name="p_tax[]" placeholder="0.00" value="<?= $estimate['p_tax']; ?>">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="number" class="form-control text-end fw-bold employee_cnt" name="employee_cnt[]" placeholder="0.00" value="<?= $estimate['pf_employee_contribution']; ?>">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="number" class="form-control text-end fw-bold employer_cnt" name="employer_cnt[]" placeholder="0.00" value="<?= $estimate['pf_employer_contribution']; ?>">
                                            </div>
                                        </td>
                                        <td width="" class="cell">
                                            <div class="input-group">
                                                <input type="text" class="form-control text-end fw-bold total_deduct" name="total_deduct[]" placeholder="0.00" value="<?= $estimate['total_deduct']; ?>" readonly="">
                                            </div>
                                        </td>
                                        <td width="" class="cell text-end">
                                            <div class="input-group">
                                                <input type="text" class="form-control text-end fw-bold total_wage_amount" name="total_wage_amount[]" placeholder="0.00" value="<?= $estimate['total_wages_amount']; ?>" readonly="">
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>						
                </div>
                <div class="app-card-body">
                    <div class="row g-2" style="margin-bottom: 10px;">
                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <?php if(!empty($wage_estimate_details['wage_files'])){ ?>
                                <?php foreach($wage_estimate_details['wage_files'] as $suppFile){ ?>
                                    <a class="btn-sm app-btn-primary" href="<?= base_url(); ?>public/wage_files/<?= $suppFile['wage_file_title']; ?>" title="<?= $suppFile['wage_file_title']; ?>" download><i class="fa fa-download"></i></a>
                                <?php } ?>

                                <br><br>
                            <?php } ?>
                            
                            <label for="" class="form-label">Upload Files <span class="asterisk"></span></label>
                            <input type="file" multiple class="form-control wage_files" name="wage_files[]" value="">
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">Remarks <span class="asterisk"></span></label>
                            <textarea name="wage_remarks" id="" cols="" rows="2" class="form-control wage_remarks"><?= $wage_estimate_details['estimated_remarks']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="app-card-body">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <!--<button id="" type="button" class="btn app-btn-primary">SUBMIT</button>-->
                            
                            <input type="submit" class="btn app-btn-primary submitWages" value="Submit to Head Office">
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
<!--//app-content-->

<input type="hidden" id="base_url" value="<?= base_url(); ?>">


<script type="text/javascript">
	$( document ).ready(function() {
		
		$(document).on('input', '.payable_days', function() {

			$('.payable_days').each(function() {

				var monthDigit = parseInt($("#billing_month :selected").val());
                if (monthDigit >= 1 && monthDigit <= 12) {
                    var year = new Date().getFullYear(); // Get the current year
                    var lastDay = new Date(year, monthDigit, 0).getDate();

					var inputValue = $(this).val();

					if(inputValue <= lastDay){

						var numericValue = inputValue.replace(/[^0-9]/g, '');
						$(this).val(numericValue);

					} else {
						alert('Days should not exceed of selected month');
						$(this).val('');
					}
                    
                } /*else {
                    alert("Invalid month digit. Please enter a number between 1 and 12.");
                }*/

				
				//var inputValue = $(this).val();
				// Remove non-numeric characters using a regular expression
				//var numericValue = inputValue.replace(/[^0-9]/g, '');
				//$(this).val(numericValue);

				//var item = $('.wageItem');
				//calculateTotal(item);

			});

			$('.wageItem').each(function() {

				var item = $(this);
				calculategrossTotal(item);						

			});

		});


		$(document).on('input', '.festive_bonus, .p_tax, .employee_cnt, .employer_cnt', function() {

			$('.wageItem').each(function() {

				var item = $(this);
				calculategrossTotal(item);						

			});

		});


		$(document).on('click', '.submitWages', function(e) {

			e.preventDefault();

			var counter = 0;
			$(".payable_days").each(function() {
				if ($(this).val() === "") {
					$(this).addClass("redClass").css('border-color','red');
					counter++;
				} else {
					$(this).removeClass("redClass").css('border-color','#e7e9ed');
				}
			});
			if(counter == 0){

				$.confirm({

					title: "Alert!!",
					content: "Are you sure to submit details? You are not able to change details once submitted. Please check details before submit.",
					buttons: {
						Ok: {
							text: 'Yes',
							btnClass: 'btn-green',
							action: function(){  							
								$("#estimatedForm").submit();
							}
						},
						cancelAction: { //Close the confirmation Modal
							text: 'No',
							btnClass: 'btn-red',
							action: function(){
							
							}
						}
					}

				});

			}			

		});


		function calculategrossTotal(item) {
			var payableInput = item.find('.payable_days');
			var priceInput = item.find('.daily_wage_amount');
			var bonusInput = item.find('.festive_bonus');
			var grossInput = item.find('.gross_wages');

			var p_tax = item.find('.p_tax');
			var employee_cnt = item.find('.employee_cnt');
			var employer_cnt = item.find('.employer_cnt');

			var total_deduct = item.find('.total_deduct');
			var total_wage_amount = item.find('.total_wage_amount');
			
			var days = parseFloat(payableInput.val()) || 0;
			var price = parseFloat(priceInput.val()) || 0;
			var bonus = parseFloat(bonusInput.val()) || 0;

			var pTax = parseFloat(p_tax.val()) || 0;
			var employeeCnt = parseFloat(employee_cnt.val()) || 0;
			var employerCnt = parseFloat(employer_cnt.val()) || 0;

			var totalGross = (days * price) + bonus;
			var totalDeduct = pTax + employeeCnt + employerCnt;

			var totalWage = totalGross - totalDeduct;
			
			grossInput.val(totalGross.toFixed(2)); // Display the total gross with 2 decimal places
			total_deduct.val(totalDeduct.toFixed(2)); // Display the total deduct with 2 decimal places
			total_wage_amount.val(totalWage.toFixed(2)); // Display the total wages with 2 decimal places
		}
		

	});
</script>