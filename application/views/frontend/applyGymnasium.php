<section class="section">
    <div class="container text-center">
        <h3>Please pay the amount stated below to submit the application</h3>

    </div>

    <div style="width: 80%; margin:0 auto; padding-top: 30px;">
    	<form action="<?= base_url('generate-schedule')?>" method="POST" id="schedule-form">
	    	<section class="p_20 text-left" style="background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);">
	            <?php $curr_month = date('m')?>
	            <?php 
	            	$months_arr = [];
	            	$jan_date = date('Y',  strtotime( date('Y').' +1 year')).'-01-01';
	            	$feb_date = date('Y',  strtotime( date('Y').' +1 year')).'-02-01';
	            	$mar_date = date('Y',  strtotime( date('Y').' +1 year')).'-03-01';
	            	$timestamp1 = strtotime($jan_date);
	            	$timestamp2 = strtotime($feb_date);
	            	$timestamp3 = strtotime($mar_date);
	            	if($curr_month >= 3) {
		            	for($i = $curr_month; $i<= 12; $i++) {
		            		$months_arr[date('Y-m-d', strtotime(date('Y').'-'.$i.'-01'))] = date('M - Y', strtotime(date('Y').'-'.$i.'-01'));
		            	}
		            	$months_arr[date("Y-m-d", $timestamp1)] = date("M - Y", $timestamp1);
		            	$months_arr[date("Y-m-d", $timestamp2)] = date("M - Y", $timestamp2);
		            	$months_arr[date("Y-m-d", $timestamp3)] = date("M - Y", $timestamp3);
		            }else{
		            	$months_arr[date("Y-m-d", $timestamp1)] = date("M - Y", $timestamp1);
		            	$months_arr[date("Y-m-d", $timestamp2)] = date("M - Y", $timestamp2);
		            	$months_arr[date("Y-m-d", $timestamp3)] = date("M - Y", $timestamp3);
		            }
	            ?>
	            <table class="table">
	                <tbody>
	                	<tr>
	                		<td></td>
		                    <td>Registration Fee (One Time Payable)</td>
		                    <td align="right">Rs. <?= @$gymnasium_rates['registration_fee']?></td>
		                </tr>
		                <?php $i=1; foreach($months_arr as $key => $month):?>
			                <tr>
			                	<td style="width: 10px;">
		                            <label class="check_cont">
		                                <input type="checkbox" class="checkboxClass monthly_subscription_fee" name="monthly_subscription_fee" value="<?= $key?>" data-amount="<?= @$gymnasium_rates['monthly_subscription_fee']?>" >
		                                <span class="checkmark"></span>
		                            </label>
		                        </td>
			                    <td>Subscription for the month of <?= @$month?></td>
			                    <td align="right">Rs. <?= @$gymnasium_rates['monthly_subscription_fee']?></td>
			                </tr>
		            	<?php $i++; endforeach?>
		                <tr>
		                    <th>Total Payable</th>
		                    <th></th>
		                    <th style="text-align: right;"><span id="total_payment_txt">Rs. <?= @$gymnasium_rates['registration_fee']?></span></th>
		                </tr>
		            </tbody>
		        </table>
	            <div class="checkbox">
	                <label class="check_cont">
		                <input type="checkbox" class="terms" name="terms">I accept the terms &amp; conditions 
		                <span class="checkmark"></span>
	                </label>
	            </div>
	            <div class="col-sm-12" style="float: none;">
	            	<input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id')?>">
	            	<input type="hidden" name="gymnasium_rate_id" id="gymnasium_rate_id" value="<?= @$gymnasium_rates['gymnasium_rate_id']?>">
	            	<input type="hidden" name="total_payment" id="total_payment" value="">
	                <button type="button" class="btn btn_visitor_book proceed_to_pay" disabled="disabled">Proceed to Pay</button>
	            </div>
	        </section>
    	</form>
    	<form action="<?= base_url('proceed-to-payment')?>" method="POST" id="proceedPayment" style="display: none">
    		<input type="hidden" id="grand_total" value="" name="grand_total">
    		<input type="hidden" name="surl" id="surl" value="<?= base_url('gymnasium-success')?>">
            <input type="hidden" name="furl" id="furl" value="<?= base_url('gymnasium-failure')?>">
            <input type="hidden" id="txnid" value="" name="txnid">
            <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
        </form>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		let total_payable = 0;
		let registration_fee = parseInt(<?= @$gymnasium_rates['registration_fee']?>);
		const $months = $("[data-amount]");
		$months.on("click", function() {
			const idx = $months.index(this)
			if (this.checked && idx > 0) { // only check from Feb onwards
				const checked = $("[data-amount]:lt(" + idx + ")").map(function() { 
					return this.checked 
				}).get()
				this.checked = checked.every(c => c); // only allow checking if previous are checked
				
			}else{
				$("[data-amount]:gt(" + idx + ")").prop("checked", false);
			}
		});


		$(document).on('change','.monthly_subscription_fee', function() {
			let count_mon_subs = $('input[name=monthly_subscription_fee]:checked').length;
			console.log(count_mon_subs);
			let total_monthly_subs_fee = count_mon_subs * <?= @$gymnasium_rates['monthly_subscription_fee']?>;
			total_payable = registration_fee + total_monthly_subs_fee;
			console.log(total_payable);
			$('#total_payment_txt').text('Rs. '+total_payable.toFixed(2));
			$('#total_payment').val(total_payable.toFixed(2));
			$('#grand_total').val(total_payable.toFixed(2));
		});

		$(document).on('change','.terms', function() {
			//alert();
			let terms_check = $('input[name=terms]:checked').length;
			console.log(terms_check)
			if(terms_check) {
				$('.proceed_to_pay').prop('disabled', false);
			}else{
				$('.proceed_to_pay').prop('disabled', true);
			}

		});

		$(document).on('click', '.proceed_to_pay', function(){

		    // $(":checkbox:not(:checked)").each(function(element, index){
		    //     $(this).attr({checked:'checked'});
		    // });
		    let schedule_data = {};
		    $('.monthly_subscription_fee').each(function(element, index){
		    	if (this.checked === true) {
		    		schedule_data[$(this).val()] = {
		    			'check': 'yes',
		    			'date': $(this).val(),
		    			'amount': $(this).data('amount')
		    		};
		    		console.log(($(this).data('amount')));
		    	}else{
		    		schedule_data[$(this).val()] = {
		    			'check': 'no',
		    			'date': $(this).val(),
		    			'amount': $(this).data('amount')
		    		};
		    		console.log('no');	
		    	}
		        
		    });
		    //console.log('schedule_data',schedule_data);
		    let user_id = $('#user_id').val();
		    let gymnasium_rate_id = $('#gymnasium_rate_id').val();
		    let total_payment = $('#total_payment').val();
		    //$('#schedule-form').submit();
		    //return true;
		    $.ajax({
	            url:'<?= base_url('generate-schedule')?>',
	            method: 'post',
	            data: {schedule_data: schedule_data, user_id:user_id, gymnasium_rate_id:gymnasium_rate_id, total_payment:total_payment},
	            dataType: 'json',
	            success: function(response){
	                //console.log(response.txnid);
	                if(response) {
	                	$('#txnid').val(response.txnid);
	                	$( "#proceedPayment" ).submit();
	                	//window.location.replace("<?php //echo base_url('my-subscription')?>");
	                }
	            }
	        });
		});

	});
</script>