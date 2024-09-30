<section class="section" style="padding: 100px 0 0 0;">
    <div class="container text-center">
        <h3>Member Details</h3>
    </div>
    <div style="width: 80%; margin:0 auto; padding-top: 10px;">
        <div style="background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);padding:20px; border-radius:8px;">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Member Name</th>
                    <th>Member Relation</th>
                    <th>Division</th>
                    <th>Location</th>
                    <th>Gymnasium</th>
                    <th>Status</th>
                </tr>
                <tbody>
                    <?php if(isset($member) && $member):?>
                        <tr>
                            <td><?= $member['member_name']?></td>
                            <td><?= $member['relation']?></td>
                            <td><?= $member['fieldunit_name']?></td>
                            <td><?= $member['location_name']?></td>
                            <td><?= $member['sports_facilities_name']?></td>
                            <td><span class="badge" style="background: #5cb85c;">
                                <?= ($member['status'] == 0)?'ACTIVE':'PENDING'?>
                            </span></td>
                        </tr>
                    <?php endif?>
                </tbody>
            </table>            
        </div>
    </div>
</section>
<section class="section" style="padding: 0px 0;">
    <div class="container text-center">
        <h3>Member Subscription</h3>

    </div>

    <div style="width: 80%; margin:0 auto; padding-top: 10px;">
    	<div style="background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);padding:20px; border-radius:8px;">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th></th>
                        <th>Subscription</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    <!-- <tr>
                        <td></td>
                        <td>Registration Fee (One Time Payable)</td>
                        <td><?= ($user_details['gymnasium_registration_fee'])? 'Rs. '.@$user_details['gymnasium_registration_fee']:''?></td>
                        <td><?php if(isset($user_details)&& $user_details):?>
                            <?= ($user_details['gymnasium_registration_fee'])?'Completed':'Pending'?>

                        <?php endif?></td>
                    </tr> -->
                    <?php $i=1; foreach($subscription as $month):?>
                        <tr>
                            <td style="width: 10px;">
                                <!-- <label class="check_cont">
                                    <input type="checkbox" class="checkboxClass monthly_subscription_fee" name="monthly_subscription_fee" value="<?= $key?>" data-amount="<?= @$gymnasium_rates['monthly_subscription_fee']?>" >
                                    <span class="checkmark"></span>
                                </label> -->
                            </td>
                            <td>Subscription for the month of <?= date('M, Y',  strtotime($month['month_year']))?></td>
                            <td>Rs. <?= @$month['subscription_amount']?></td>
                            <td><span class="badge" style="background: #5cb85c;"><?= ($month['payment_status']==0)?'Complete':'Pending'?></span></td>
                        </tr>
                    <?php $i++; endforeach?>
                    <!-- <tr>
                        <th>Total Payable</th>
                        <th></th>
                        <th style="text-align: right;"><span id="total_payment_txt">Rs. <?= @$gymnasium_rates['registration_fee']?></span></th>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</section>