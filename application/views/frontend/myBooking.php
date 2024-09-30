<section class="section">
    <div class="container text-center">
        <h4>My Bookings</h4>
    </div>
    <!-- <div style="width: 90%; margin:0 auto; padding-top: 30px;">
        <section class="p_20 text-left" style="min-height: 480px;background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="p_top30 p_bot30">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <th colspan="8" class="text-center">
                                            <h3><?= $facilities['sports_facilities_name']?></h3>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">&nbsp;</th>
                                        <th rowspan="2" class="text-center">Date</th>
                                        <th rowspan="2" class="text-center">Status</th>
                                        <th colspan="5" class="text-center">Rent per Day for the</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Railway Department<br> Recreation Clubs & BNRRC</th>
                                        <th class="text-center">Other Railway<br> Associations, Institutions,<br> Organisations</th>
                                        <th class="text-center">Railway PSUs viz.<br> RVNL, IRCTC,<br> RailTel etc.</th>
                                        <th class="text-center">Other Government<br> Organisations, Associated<br> Units viz. CISF,<br> CRIS, IRCON,<br> CISF, CONCOR etc.</th>
                                        <th class="text-center">Other Open Registered<br> Clubs, Associations,<br> Corporate Bodies etc.</th>
                                    </tr>
                                    <?php if(isset($rates) && $rates): foreach($rates as $date):?>
                                        <tr>
                                            <td>
                                                <label class="check_cont">
                                                    <input type="checkbox" class="checkboxClass" name="check" value="<?= $date['start_date']?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center"><?= date('d-m-Y F',strtotime($date['start_date']))?></td>
                                            <td class="text-center">Available</td>
                                            <?php foreach($date['rates'] as $rate):?>
                                                <td class="text-center">
                                                    <input type="hidden" class="price_<?= $rate['organization_type']?>" data-rate_id = "<?= $rate['rate_id']?>" value="<?= $rate['rate']?>" >
                                                    Rs. <?= number_format($rate['rate'],2,",",".")?>
                                                </td>
                                            <?php endforeach?>
                                        </tr>
                                    <?php endforeach; endif?>
                                    
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <ul class="list-unstyled">
                                    <li>
                                        <p>You have selected this Sports Facility for Reservation on :</p>
                                        <h4 id="selected_date">
                                            
                                        </h4>
                                    </li>
                                    <li>
                                        <p>Total Payable Rent will be :</p>
                                        <h4 id="total_price_text">Rs. 0.00</h4>
                                        <input type="hidden" name="total_price" id="total_price" value="0">
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>
                                        <button type="button" class="btn btn_visitor_book" data-toggle="modal" data-target="#bookingModal" id="proceed" disabled="disabled">Proceed</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> -->
    <div style="width: 90%; margin:0 auto; padding-top: 30px;">
        <section class="p_20 text-left" style="min-height: 480px;background: #fff;">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th class="text-center">Booking id</th>
                            <th class="text-center">Booking At</th>
                            <th class="text-center">Sports Facilities Name</th>
                            <th class="text-center">Location Name</th>
                            <th class="text-center">Organization Name</th>
                            <th class="text-center">Total Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Payment Mode</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if(isset($bookings) && $bookings): ?>
                            <?php foreach($bookings as $booking):?>
                                <tr>
                                    <td class="text-center"><?= $booking['booking_id']?></td>
                                    <td class="text-center"><?= date('d-m-Y F',strtotime($booking['created_at']))?></td>
                                    <td class="text-center"><?= $booking['sports_facilities_name']?></td>
                                    <td class="text-center"><?= $booking['location_name']?></td>
                                    <td class="text-center"><?= $booking['organization_name']?></td>
                                    <td class="text-center"><?= $booking['total_rate']?></td>
                                    <td class="text-center"><?= ($booking['booking_status'] == '0')?'Pending':(($booking['booking_status'] == '1') ?'Approved' :(($booking['booking_status'] == '2')?'Rejected' :'Confirmed'))?></td>
                                    <td class="text-center"><?= $booking['payment_method']?></td>
                                    <td class="text-center">
                                        <a class="btn-sm app-btn-primary" href="#">View Details</a>
                                        <?php if(($booking['booking_status'] == '1') && ($booking['payment_method'] == 'Online')){ ?>
                                            <button class="btn btn-sm btn-main pay_now" data-booking_id = "<?= $booking['booking_id']?>" data-amount="<?= $booking['total_rate']?>">Pay Now</button>
                                        <?php }else if(($booking['booking_status'] == '3')){ ?>
                                            <a class="btn-sm app-btn-secondary" href="#">Invoice</a>
                                        <?php } ?>
                                    </td>
                                    <!-- <td class="text-center">
                                        <?php //foreach($booking['booking_details'] as $details):?>
                                            <p>
                                                Date  : <?php //echo date('d-m-Y F',strtotime($details['start_date']))?><br>
                                                Rate : <?php //echo number_format($details['rate'],2,",",".")?>
                                            </p>
                                        <?php //endforeach?>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="7" style="text-align: center; background: #eee;">No bookings yet</td>
                            </tr>
                        <?php endif?>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>
<form action="<?= base_url('proceed-to-payment')?>" method="POST" id="proceedPayment" style="display: none">
    <input type="hidden" id="grand_total" value="" name="grand_total">
    <input type="hidden" name="surl" id="surl" value="<?= base_url('booking-facility-success')?>">
    <input type="hidden" name="furl" id="furl" value="<?= base_url('booking-facility-failure')?>">
    <input type="hidden" id="txnid" value="" name="txnid">
    <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
</form>
<script type="text/javascript">
    $(document).on('click', '.pay_now', function() {
        let amount = $(this).data('amount');
        let booking_id = $(this).data('booking_id');
        $.ajax({
            url:'<?= base_url('generate-txnid')?>',
            method: 'post',
            data: {booking_id:booking_id},
            dataType: 'json',
            success: function(response){
                //console.log(response.txnid);
                if(response) {
                    $('#txnid').val(response.txnid);
                    $('#grand_total').val(amount);
                    $( "#proceedPayment" ).submit();
                }
            }
        });
    });
</script>