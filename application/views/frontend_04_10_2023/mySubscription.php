<section class="section">
    <div class="container text-center">
        <h3>My Subscription</h3>

    </div>

    <div style="width: 80%; margin:0 auto; padding-top: 10px;">
    	<div style="background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);padding:20px; border-radius:8px;">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th></th>
                        <th>Subscription</th>
                        <th style="text-align: right">Amount</th>
                        <th style="text-align: right">Status</th>
                    </tr>
                    <!-- <pre><?php //print_r($subscription)?></pre> -->
                    <?php $i=1; foreach($subscription as $key => $month):?>
                        <tr>
                            <td style="width: 10px;">
                                <label class="check_cont">
                                    <input type="checkbox" class="checkboxClass <?php echo ($month['payment_status']==0)? '':'monthly_subscription_fee'?>" name="monthly_subscription_fee" value="<?php echo $month['month_year']?>" data-id="<?php echo @$month['gymnasium_schedule_id']?>" data-amount="<?php echo @$month['subscription_amount']?>" <?php echo ($month['payment_status']==0)?'checked="checked" disabled="disabled"':''?> >
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>Subscription for the month of <?php echo date('M, Y',  strtotime($month['month_year']))?></td>
                            <td style="text-align: right">Rs. <?php echo @$month['subscription_amount']?></td>
                            <td style="text-align: right"><span class="badge" <?php echo ($month['payment_status']==0)? 'style="background: #5cb85c"' : 'style="background: #dc3545"'?>><?php echo ($month['payment_status']==0)?'Complete':'Pending'?></span></td>
                        </tr>
                    <?php $i++; endforeach?>
                    <tr>
                        <th></th>
                        <th>Total Payable</th>
                        <th style="text-align: right;"><span id="total_payment_txt">Rs. 0.00</span></th>
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
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('user_id')?>">
                <input type="hidden" name="gymnasium_rate_id" id="gymnasium_rate_id" value="<?php echo @$gymnasium_rates['gymnasium_rate_id']?>">
                <input type="hidden" name="total_payment" id="total_payment" value="">
                <input type="hidden" name="surl" id="surl" value="<?php echo base_url('gymnasium-subscription-success')?>">
                <input type="hidden" name="furl" id="furl" value="<?php echo base_url('gymnasium-subscription-failure')?>">
                <button type="button" class="btn btn_visitor_book proceed_to_pay" disabled="disabled">Proceed to Pay</button>
            </div>
        </div>
    </div>
</section>
<form action="<?php echo base_url('proceed-to-payment')?>" method="POST" id="proceedPayment" style="display: none">
    <input type="hidden" id="grand_total" value="" name="grand_total">
    <input type="hidden" name="surl" id="surl" value="<?php echo base_url('gymnasium-subscription-success')?>">
    <input type="hidden" name="furl" id="furl" value="<?php echo base_url('gymnasium-subscription-failure')?>">
    <input type="hidden" id="txnid" value="" name="txnid">
    <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        let total_payable = 0;
        let registration_fee = parseInt('0');
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
            let count_mon_subs = $('input[name=monthly_subscription_fee]:checked:not(:disabled)').length;
            //console.log(count_mon_subs);
            let total_monthly_subs_fee = count_mon_subs * <?php echo @$gymnasium_rates['monthly_subscription_fee']?>;
            total_payable = registration_fee + total_monthly_subs_fee;
            //console.log(total_payable);
            $('#total_payment_txt').text('Rs. '+total_payable.toFixed(2));
            $('#total_payment').val(total_payable.toFixed(2));
            $('#grand_total').val(total_payable.toFixed(2));
            
            let terms_check = $('input[name=terms]:checked:not(:disabled)').length;
            if(terms_check && count_mon_subs) {
                $('.proceed_to_pay').prop('disabled', false);
            }else{
                $('.proceed_to_pay').prop('disabled', true);
            }
        });

        $(document).on('change','.terms', function() {
            let count_mon_subs = $('input[name=monthly_subscription_fee]:checked:not(:disabled)').length;
            let terms_check = $('input[name=terms]:checked:not(:disabled)').length;
            //console.log(terms_check)
            if(terms_check && count_mon_subs) {
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
                        'gymnasium_schedule_id': $(this).data('id'),
                        'date': $(this).val(),
                        'amount': $(this).data('amount')
                    };
                    console.log(($(this).data('amount')));
                }else{
                    schedule_data[$(this).val()] = {
                        'check': 'no',
                        'gymnasium_schedule_id': $(this).data('id'),
                        'date': $(this).val(),
                        'amount': $(this).data('amount')
                    };
                    console.log('no');  
                }
                
            });
            //console.log('schedule_data',schedule_data); return;
            let user_id = $('#user_id').val();
            let gymnasium_rate_id = $('#gymnasium_rate_id').val();
            let total_payment = $('#total_payment').val();
            //$('#schedule-form').submit();
            //return true;
            $.ajax({
                url:'<?php echo base_url('payment-schedule')?>',
                method: 'post',
                data: {schedule_data: schedule_data, user_id:user_id, gymnasium_rate_id:gymnasium_rate_id, total_payment:total_payment},
                dataType: 'json',
                success: function(response){
                    //console.log(response.txnid);
                    if(response) {
                        $('#txnid').val(response.txnid);
                        $( "#proceedPayment" ).submit();
                    }
                }
            });
        });

    });
</script>
<style type="text/css">
    .check_cont input:disabled~.checkmark {
        background-color: #5a5a5a;
    }
</style>