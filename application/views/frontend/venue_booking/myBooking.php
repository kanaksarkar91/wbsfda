<section class="section">
    <div class="container text-center">
        <h4>My Bookings</h4>
    </div>
    <div style="width: 90%; margin:0 auto; padding-top: 30px;">
        <section class="p_20 text-left" style="min-height: 480px;background: #fff;">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th class="text-center">Booking id</th>
                            <th class="text-center">Booking At</th>
                            <th class="text-center">Location Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Venue</th>
                            <th class="text-center">Total Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Payment Mode</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if(isset($bookings) && $bookings): ?>
                            <?php foreach($bookings as $booking):?>
                                <?php $booking_date = array()?>
                                <?php if(isset($booking['booking_details']) && $booking['booking_details']): foreach($booking['booking_details'] as $details) :?>
                                    <?php $booking_date[] = date("d-m-Y", strtotime($details['start_date']))?>
                                <?php endforeach; endif?>
                                <tr>
                                    <td class="text-center"><?= $booking['booking_id']?></td>
                                    <td class="text-center"><?= date('d-m-Y F',strtotime($booking['created_at']))?></td>
                                    <td class="text-center"><?= $booking['property_name']?></td>
                                    <td class="text-center"><?= $booking['property_address_line_1']?></td>
                                    <td class="text-center"><?= $booking['venue_names']?></td>
                                    <td class="text-center"><?= $booking['total_rate']?></td>
                                    <td class="text-center"><?= ($booking['booking_status'] == '0')?'Pending':(($booking['booking_status'] == '1') ?'Approved' :(($booking['booking_status'] == '2')?'Rejected' :'Confirmed'))?></td>
                                    <td class="text-center"><?= $booking['payment_method']?></td>
                                    <td class="text-center" width="300">
                                    <a class="cmn-btn btn-bg-1 view_details" href="javascript:void(0)" data-booking_id="<?= $booking['booking_id']?>" data-venue_name="<?= $booking['venue_names']?>" data-location_name="<?= $booking['property_name']?>" data-created_at="<?= $booking['created_at']?>" data-total_rate="<?= $booking['total_rate']?>" data-organization_name="<?= ($booking['is_indivisual']==1)? $booking['indivisual_full_name'] :  $booking['business_full_name'] ?>" data-mailing_address="<?= ($booking['is_indivisual']==1)? $booking['indivisual_full_address'] :  $booking['business_full_address'] ?>" data-contact_no="<?= ($booking['is_indivisual']==1)? $booking['indivisual_contact_no'] :  $booking['business_contact_no'] ?>" data-email="<?= ($booking['is_indivisual']==1)? $booking['indivisual_email'] :  $booking['business_email'] ?>" data-contact_person="<?= $booking['contact_person_name'] ?>" data-designation="<?=$booking['contact_person_designation'] ?>" data-reservation_date = "<?= implode(', ',$booking_date)?>" >View Details</a>

                                        <?php if($booking['booking_status'] == '1' || $booking['booking_status'] == '3'|| $booking['booking_status'] == '6') {?>
                                                <a target="_blank" class="cmn-btn btn-bg-1" href="<?= base_url($booking['approval_letter_filepath']) ?>">Approval Letter</a>
                                            <?php } ?>

                                            <?php if($booking['booking_status'] == '3'|| $booking['booking_status'] == '6') {?>
                                                <a target="_blank" class="btn-sm app-btn-secondary" href="<?= base_url('frontend/venue_booking/booking_slip/'.$booking['booking_id']) ?>">Booking Slip</a>
                                            <?php } ?>

                                            <?php if($booking['booking_status'] == '3') {?>
                                                <a target="_blank" class="cmn-btn btn-bg-1" href="<?= base_url($booking['noc_file_path']) ?>">NOC Letter</a>
                                            <?php } ?>

                                        <?php if(($booking['booking_status'] == '1') && ($booking['payment_method'] == 'Online')){ ?>
                                            <button class="btn btn-sm btn-main pay_now" data-booking_id = "<?= $booking['booking_id']?>" data-amount="<?= $booking['net_amount']?>">Pay Now</button>
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
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="BookingModalLabel" aria-hidden="true">
    <form method="post" id="bookingForm" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 10px;">
                    <table class="table table-bordered">
                        <tr>
                            <th>Booking ID :</th>
                            <td id="booking_id"></td>
                        </tr>
                        <tr>
                            <th>Availed Venue :</th>
                            <td id="venue_name"></td>
                        </tr>
                        <tr>
                            <th>Location :</th>
                            <td id="location_name"></td>
                        </tr>
                        <tr>
                            <th>Booking Date :</th>
                            <td id="created_at"></td>
                        </tr>
                        <tr>
                            <th>Reservation Date :</th>
                            <td id="reservation_date"></td>
                        </tr>
                        <tr>
                            <th>To be reserved in favour of :</th>
                            <td id="organization_name"></td>
                        </tr>
                        <tr>
                            <th>Mailing Address :</th>
                            <td id="mailing_address"></td>
                        </tr>
                        <tr>
                            <th>Contact No. :</th>
                            <td id="contact_no"></td>
                        </tr>
                        <tr>
                            <th>e-mail ID :</th>
                            <td id="email"></td>
                        </tr>
                        <tr>
                            <th>Request Submitted by :</th>
                            <td id="contact_person"></td>
                        </tr>
                        <tr>
                            <th>Designation :</th>
                            <td id="designation"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<form action="<?= base_url('proceed-to-booking-payment')?>" method="POST" id="proceedPayment" style="display: none">
<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <button class="btn btn-blue" id="ajaxSubmit">Proceed to Pay <i class="fa fa-long-arrow-right ml-2"></i></button>
</form>
<script type="text/javascript">
    $(document).on('click', '.pay_now', function() {
        //let amount = $(this).data('amount');
        let booking_id = $(this).data('booking_id');
        let surl = "<?= base_url('booking-venue-success')?>";
        let furl = "<?= base_url('booking-venue-failure')?>";
        var csrf_token = "<?= $this->security->get_csrf_hash(); ?>";

        //alert(amount);
        $.ajax({
            url:'<?= base_url('generate-venue-txnid')?>',
            method: 'post',
            data: {booking_id:booking_id,surl:surl,furl:furl, "<?= $this->security->get_csrf_token_name(); ?>": csrf_token,
},
            dataType: 'json',
            success: function(response){
                //console.log(response.txnid);
                if(response) {
                    
                    $( "#proceedPayment" ).submit();
                }
            }
        });
    });
    $(document).on('click','.view_details', function() {
        let booking_id = $(this).data('booking_id');
        let venue_name=$(this).data('venue_name');
        let location_name=$(this).data('location_name');
        let created_at=$(this).data('created_at'); 
        let total_rate=$(this).data('total_rate'); 
        let organization_name=$(this).data('organization_name'); 
        let mailing_address=$(this).data('mailing_address'); 
        let contact_no=$(this).data('contact_no'); 
        let email=$(this).data('email'); 
        let contact_person=$(this).data('contact_person'); 
        let designation=$(this).data('designation');
        let reservation_date=$(this).data('reservation_date');

        $('#booking_id').text(booking_id);
        $('#venue_name').text(venue_name);
        $('#location_name').text(location_name);
        $('#reservation_date').text(reservation_date);
        $('#created_at').text(created_at);
        $('#total_rent').text(total_rate);
        $('#organization_name').text(organization_name);
        $('#mailing_address').text(mailing_address);
        $('#contact_no').text(contact_no);
        $('#email').text(email);
        $('#category_name').text(organization_name);
        $('#contact_person').text(contact_person);
        $('#designation').text(designation);

        $('#bookingModal').modal('show');
    })

    function dateformat(inputDate) {
        var date = new Date(inputDate);
        if (!isNaN(date.getTime())) {
            // Months use 0 index.
            return date.getDate() + 1 + '-' + date.getMonth() + '-' + date.getFullYear();
        }
    }
</script>