<section class="section">
    <div class="container text-center">
        <h4>Welcome <?php echo $this->session->userdata('contact_person')?> on behalf of</h4>
        <h3 class="title" style="color:#800000;font-weight:bold;"><?php echo $this->session->userdata('organization_name')?></h3>
        <h4>Please submit your Reservation Request</h4>
    </div>
    <div style="width: 90%; margin:0 auto; padding-top: 30px;">
        <section class="p_20 text-left" style="min-height: 480px;background: #fff;box-shadow: 0 2px 5px rgb(0 0 0 / 18%);">
            <div class="row">
                <!-- <div class="col-md-3 col-sm-4">
                    <div class="nav list-group" role="tablist">
                        <a class="list-group-item" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
                        <a class="list-group-item" href="#transaction_history" aria-controls="transaction_history" role="tab" data-toggle="tab">Transaction History</a>
                        <a class="list-group-item" href="#pending_request" aria-controls="pending_request" role="tab" data-toggle="tab">Pending Reservation Request</a>
                        <a class="list-group-item" href="#confirme_reservation" aria-controls="confirme_reservation" role="tab" data-toggle="tab">Upcoming Confirmed Reservation</a>
                    </div>
                </div> -->
                <div class="col-md-12 col-sm-12">
                    
                    <!-- <form>
                        <div class="row">
                            <div class="col-xs-4 col-sm-3">
                                <label class="h4" style="margin-top:15px;">Select Sports Facility</label>
                            </div>
                            <div class="col-xs-5 col-sm-7">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <select class="form-control">
                                            <option><b>By Location</b></option>
                                            <option>Adra</option>
                                            <option>Chakradharpur</option>
                                            <option>Kharagpur</option>
                                            <option>Kahargpur Workshop</option>
                                            <option>Garden Reach</option>
                                            <option>Ranchi</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <label class="h4" style="margin-top:15px;">OR</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <select class="form-control">
                                            <option><b>By Sports Infrastructure</b></option>
                                            <option>Football</option>
                                            <option>Cricket</option>
                                            <option>Hockey</option>
                                            <option>Athletics</option>
                                            <option>Swimming</option>
                                            <option>Table Tennis</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2" style="padding-top:5px;">
                                <a class="btn btn-block btn-main"> Search </a>
                            </div>
                        </div>
                    </form> -->
                    <!-- <div class="row m_top20">
                        <div class="col-xs-12">
                            <table class="table">
                                <tr>
                                    <th class="text-center">Location</th>
                                    <th class="text-center">Sports Facility</th>
                                    <th class="text-center">Available Sports Infrastructure</th>
                                    <th class="text-center" colspan="2">&nbsp;</th>
                                </tr>
                                <tr>
                                    <td class="text-center">Garden Reach</td>
                                    <td class="text-center">Birsa Munda Hockey Hockey Stadium</td>
                                    <td class="text-center">Hockey, Athletics</td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-main btn_select" href="view-details.html">View Details</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-main btn_select" href="check-available-rate.html">Check Availability & Rate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Garden Reach</td>
                                    <td class="text-center">Pankaj Gupta Indoor Stadium</td>
                                    <td class="text-center">Table Tennis, Gymnastics</td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-main btn_select" href="view-details.html">View Details</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-main btn_select" href="check-available-rate.html">Check Availability & Rate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Garden Reach</td>
                                    <td class="text-center">Netaji Bagan Stadium</td>
                                    <td class="text-center">Cricket, Football</td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-main btn_select" href="view-details.html">View Details</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-main btn_select" href="check-available-rate.html">Check Availability & Rate</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> -->
                    <div class="p_top30 p_bot30">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <th colspan="8" class="text-center">
                                            <h3><?php echo $facilities['sports_facilities_name']?></h3>
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
                                    <?php if(isset($rates) && $rates): foreach($rates as $date => $value):?>
                                        <tr>
                                            <td>
                                                <label class="check_cont">
                                                    <input type="checkbox" class="checkboxClass" name="check" value="<?php echo $date?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center"><?php echo date('d-m-Y D',strtotime($date))?></td>
                                            <td class="text-center">Available</td>
                                            <?php foreach($value['rates'] as $rate):?>
                                                <td class="text-center">
                                                    <input type="hidden" class="price_<?php echo $rate['organization_type']?>" data-rate_id = "<?php echo $rate['rate_id']?>" value="<?php echo $rate['rate']?>" >
                                                    Rs. <?php echo number_format($rate['rate'],2,",",".")?>
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
    </div>
</section>
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="BookingModalLabel" aria-hidden="true">
    <form method="post" id="bookingForm" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify & Confirm the Reservation Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px;">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sports Facility :</th>
                            <td><?php echo $facilities['sports_facilities_name']?></td>
                            <input type="hidden" name="sports_facilities_id" id="sports_facilities_id" value="<?php echo $facilities['sports_facilities_id']?>">
                        </tr>
                        <tr>
                            <th>Location :</th>
                            <td><?php echo $facilities['location_name']?></td>
                            <input type="hidden" name="location_name" id="location_name" value="<?php echo $facilities['location_name']?>">
                        </tr>
                        <tr>
                            <th>Reservation Date :</th>
                            <td id="preview_selected_date"></td>
                            <!-- <input type="hidden" name="set_selected_date" id="set_selected_date" > -->
                        </tr>
                        <tr>
                            <th>Total Payable Rent :</th>
                            <td id="total_rent"></td>
                            <!-- <input type="hidden" name="total_price_rent" id="total_price_rent" > -->
                        </tr>
                        <tr>
                            <th>To be reserved in favour of :</th>
                            <td><?php echo $this->session->userdata('organization_name')?></td>
                            <input type="hidden" name="organization_name" id="organization_name" value="<?php echo $this->session->userdata('organization_name')?>" >
                        </tr>
                        <tr>
                            <th>Mailing Address :</th>
                            <td><?php echo $this->session->userdata('mailing_address')?></td>
                            <input type="hidden" name="mailing_address" id="mailing_address" value="<?php echo $this->session->userdata('mailing_address')?>" >
                        </tr>
                        <tr>
                            <th>Contact No. :</th>
                            <td><?php echo $this->session->userdata('contact_no')?></td>
                            <input type="hidden" name="contact_no" id="contact_no" value="<?php echo $this->session->userdata('contact_no')?>" >
                        </tr>
                        <tr>
                            <th>e-mail ID :</th>
                            <td><?php echo $this->session->userdata('email')?></td>
                            <input type="hidden" name="email" id="email" value="<?php echo $this->session->userdata('email')?>" >
                        </tr>
                        <tr>
                            <th>Under the Category :</th>
                            <td><?php echo $this->session->userdata('organization_type')?></td>
                            <input type="hidden" name="organization_type" id="organization_type" value="<?php echo $this->session->userdata('organization_type')?>" >
                        </tr>
                        <tr>
                            <th>Request Submitted by :</th>
                            <td><?php echo $this->session->userdata('contact_person')?></td>
                            <input type="hidden" name="contact_person" id="contact_person" value="<?php echo $this->session->userdata('contact_person')?>" >
                        </tr>
                        <tr>
                            <th>Designation :</th>
                            <td><?php echo $this->session->userdata('designation')?></td>
                            <input type="hidden" name="designation" id="designation" value="<?php echo $this->session->userdata('designation')?>" >
                        </tr>
                        <tr>
                            <th>Contact No. :</th>
                            <td><?php echo $this->session->userdata('contact_no')?></td>
                        </tr>
                        <tr>
                            <th>e-mail ID :</th>
                            <td><?php echo $this->session->userdata('email')?></td>
                        </tr>
                    </table>

                    <label class="check_cont">
                        <small>I/we do hereby agree to accept the terms and conditions as mentioned in this website to Reserve this Sports Facility</small>
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back to Modify</button>
                    <!-- <button type="button" class="btn btn_visitor_book">Submit</button> -->
                    <button class="btn btn_visitor_book" id="submit_request" type="button" href="#." >Submit Request</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="bookingsuccessModal" tabindex="-1" role="dialog" aria-labelledby="bookingsuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Booking Successfull</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center"><b>Your request for reservation has been received with the 
                    Reservation Request ID : <span id="booking_id"></span>.
                    SERSA will contact with you shortly</b></p>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn_visitor_book" type="button" href="#." data-toggle="modal" data-target="#bookingsuccessModal">Submit</a>
            </div> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    let total_price = 0; let date = []; let rate_id =[]; let prices = [];
    $(document).on('change','.checkboxClass', function(){
        let date_data = ''; let set_selected_date = '';
        if(this.checked) {
            date.push(this.value);
            rate_id.push($(this).parent().parent().parent().find('.price_<?php echo $this->session->userdata('organization_type')?>').data('rate_id'));
            prices.push($(this).parent().parent().parent().find('.price_<?php echo $this->session->userdata('organization_type')?>').val());
            total_price = total_price + (+$(this).parent().parent().parent().find('.price_<?php echo $this->session->userdata('organization_type')?>').val());
        }else{
            //date.pop(this.value);
            date.splice(date.indexOf(this.value), 1);
            rate_id.splice(rate_id.indexOf($(this).parent().parent().parent().find('.price_<?php echo $this->session->userdata('organization_type')?>').data('rate_id')), 1);
            prices.splice(prices.indexOf($(this).parent().parent().parent().find('.price_<?php echo $this->session->userdata('organization_type')?>').val()), 1);
            total_price = total_price - (+$(this).parent().parent().parent().find('.price_<?php echo $this->session->userdata('organization_type')?>').val());
        }
        console.log('date : ', date);
        console.log('total : ', total_price);
        console.log('rate_id : ', rate_id);
        console.log('prices : ', prices);
        $('#total_price').val(total_price);
        $('#total_price_text').text('Rs. '+total_price.toFixed(2));
        for (let i = 0; i < date.length; i++) {
            date_data += '<span>' + changeDateFormatTo(date[i]) + '</span>, ';
            set_selected_date += date[i]+',';
        }
        set_selected_date=set_selected_date.substring(0, set_selected_date.length - 1);
        date_data=date_data.substring(0, date_data.length - 2);
        console.log(date_data);
        $('#selected_date').html('');
        $('#selected_date').html(date_data);
        $('#preview_selected_date').html(date_data);
        //$('#set_selected_date').val(set_selected_date);
        $('#total_rent').text('Rs. '+total_price.toFixed(2));
        $('#total_price_rent').val(total_price);
        if(date.length > 0 && total_price > 0) {
            $('#proceed').prop('disabled', false);
        }else{
            alert('Organization Category not Available. Please select available sports facility');
            $('#proceed').prop('disabled', true);
        }
    });
    $(document).on('click','#submit_request', function() {
        $('#bookingsuccessModal').modal('show'); false;
        $('#booking_id').text('');
        let data = {
            date: date,
            total_price: total_price,
            rate_id: rate_id,
            prices: prices,
            form_data: $('form#bookingForm').serializeArray()
        };
        $.ajax({
            url: "<?=base_url('booking-facility')?>",
            cache: false,
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(res){
                $('#booking_id').text(res.booking_id);
                $('#bookingModal').modal('hide');
                $('#bookingsuccessModal').modal('show');
            }
        });
    });
    const changeDateFormatTo = date => {
      const [yy, mm, dd] = date.split(/-/g);
      return `${dd}-${mm}-${yy}`;
    };
</script>
