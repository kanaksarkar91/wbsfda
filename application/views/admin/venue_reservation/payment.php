
<style>
    .text-right{
        text-align: right;
    }

    .text-center{
        text-align: center;
    }
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Collect Payment for Reservation</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">

                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="post" action="<?= base_url('admin/venue_reservation/submitpayment'); ?>" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" class="form-control" name="booking_id" value="<?= $reservation[0]['booking_id'] ?>" readonly>
                        <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                            <div class="row g-3">

                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Booking ID</label>
                                    <input type="text" class="form-control" value="<?=$reservation[0]['booking_id']?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Reservation Request Received on</label>
                                    <input type="text" class="form-control" value="<?=date('d-m-Y H:i:s',strtotime($reservation[0]['created_at']))?>" readonly>
                                </div>

                                <div class="col-md-12 details_head">
                                    <h4>Details of the Reservee </h4>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label"><?=($reservation[0]['is_indivisual']==1)? 'Indivisual Name' : 'Business Name'?> </label>
                                    <input type="text" class="form-control" value="<?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_full_name'] :  $reservation[0]['business_full_name'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-8 mb-3">
                                    <label for="" class="form-label">Mailing Address  with PIN Code </label>
                                    <textarea class="form-control" name="" id="" cols="" rows="8" readonly><?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_full_address'] :  $reservation[0]['business_full_address']?></textarea>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    
                                    <label for="" class="form-label mrg10T">Contact No.</label>
                                    <input type="text" class="form-control" value="<?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_contact_no'] :  $reservation[0]['business_contact_no']   ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">E-mail ID</label>
                                    <input type="email" class="form-control" value="<?= ($reservation[0]['is_indivisual']==1)? $reservation[0]['indivisual_email'] :  $reservation[0]['business_email']  ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" value="<?= ($reservation[0]['contact_person_name']) ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Designation</label>
                                    <input type="text" class="form-control" value="<?= ($reservation[0]['contact_person_designation']) ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Contact No.</label>
                                    <input type="number" class="form-control" value="<?= ($reservation[0]['contact_person_contact_no']) ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Contact Person Email id.</label>
                                    <input type="number" class="form-control" value="<?= ($reservation[0]['contact_person_email']) ?>" readonly>
                                </div>
                                
                                <div class="col-md-12 details_head">
                                    <h4> Details</h4>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Location </label>
                                    <input type="text" class="form-control" value="<?= $reservation[0]['property_name'] ?>" readonly>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Venue Details </label>
                                    <input type="text" class="form-control" value="<?= $reservation[0]['venue_names'] ?>" readonly>
                                </div>
                                <div class="col-md-12 details_head">
                                    <h4>Venue Booking </h4>
                                </div>
                                <div class="col-sm-12 col-md-12 mb-3 Sports_Facility_table">
                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr class="brown_bg">
                                                    <th class="cell text-center">Date </th>
                                                    <th class="cell text-right">Payable for the day Amount (INR)</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(isset($reservation[0]['booking_details']) && $reservation[0]['booking_details']){
                                                    foreach($reservation[0]['booking_details'] as $reservation_detail){ ?>
                                                <tr>
                                                    <td class="cell text-center"><?=date('d-m-Y',strtotime($reservation_detail['start_date']))?> </td>
                                                    <td class="cell text-right"><?= $reservation_detail['rate'] ?> </td>

                                                </tr>
                                                <?php } } ?>
                                                <tr>
                                                    <td class="cell text-center"><b>Total Payable</b></td>
                                                    <td class="cell text-right"><?= $reservation[0]['total_rate'] ?> </td>
                                                    <input type="hidden" class="form-control" id="total_rate" name="total_rate" value="<?= $reservation[0]['total_rate'] ?>">
                                                    <input type="hidden" class="form-control" id="net_amount" name="net_amount" value="<?= $reservation[0]['total_rate'] ?>">

                                                </tr>

                                            </tbody>
                                        </table> 
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Remarks</label>
                                    <input type="text" class="form-control" id="remarks" name="remarks" value="<?= $reservation[0]['remarks'] ?>">
                                </div>
                                </div>

                                <?php if($reservation[0]['discount_given_by'] != '') { ?>

                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label mrg10T">Discount Allowed by	</label>
                                        <input type="text" class="form-control" value="<?= $reservation[0]['discount_given_by'] ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label mrg10T">as on </label>
                                        <input type="text" class="form-control" value="<?= $reservation[0]['discount_given_ts'] ?>" readonly>
                                    </div>
                                    <?php } ?>

                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="" class="form-label me-3">Current Status</label>
                                    <h4><?= ($reservation[0]['booking_status'] == 1) ? 'Approved' : (($reservation[0]['booking_status'] == 2)?'Rejected':(($reservation[0]['booking_status'] == 3)?'Confirmed':'Pending')) ?></h4>
                                </div>

                                <div class="col-sm-12 col-md-12 mb-3" style="<?=($reservation[0]['booking_status'] == '0')?'display:block;':'display:none;'?>">
                                <label for="" class="form-label me-3">Status</label>
                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_0" value="0" checked>
                                    <label class="form-check-label" for="status_0">Pending</label>
                                </div> -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required <?= ($reservation[0]['booking_status'] == '1')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_1">Approve</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required <?= ($reservation[0]['booking_status'] == '2')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_2">Reject</label>
                                </div> 
                                </div> 

                                

                                <div class="col-sm-12 col-md-9 mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mb-3 approve_div" style="<?= ($reservation[0]['booking_status'] == '1')?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Aprroval is Valid till	</label>
                                            <input type="text" id="approval_valid_till" name="approval_valid_till" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['approval_valid_till'])) ?>" <?= ($reservation['booking_status'] == '0')?'':'readonly' ?>>
                                        </div>

                                        <div class="col-sm-12 col-md-6 mb-3 approve_div" style="<?= ($reservation[0]['booking_status'] == '1')?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Payment Method	</label>
                                            <select name="payment_method" id="payment_method" class="form-select" <?= ($reservation[0]['booking_status'] == '0')?'':'disabled' ?>> 
                                                <option value="" selected disabled>Select Payment Method</option>
                                                <option value="Online" <?=($reservation[0]['payment_method'] == 'Online')?'selected':''?>>Online</option>
                                                <option value="Offline" <?=($reservation[0]['payment_method'] == 'Offline')?'selected':''?>>Offline</option>
                                            </select> 
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                    <?php if($reservation[0]['approved_by'] != '' && $reservation[0]['booking_status'] == '1') { ?>
                                        
                                        <div class="col-sm-12 col-md-6 mb-3 approve_div">
                                            <label for="" class="form-label">Approved by      </label>
                                            <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3 approve_div">
                                            <label for="" class="form-label">as on   </label>
                                            <input type="text" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['approved_ts'])) ?>" readonly>
                                        </div>

                                    <?php } ?>
                                        <div class="col-sm-12 col-md-12 mb-3 reject_div" style="<?= ($reservation[0]['booking_status']== '2')?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Reason </label>
                                            <textarea name="rejection_reason" id="rejection_reason" cols="" rows="4" class="form-control" placeholder="Reason"><?= $reservation[0]['rejection_reason'] ?></textarea>
                                        </div>

                                        <?php if($reservation[0]['rejected_by'] != '' && $reservation[0]['booking_status'] == '2') { ?>
                                            <div class="col-sm-12 col-md-6 mb-3 reject_div">
                                                <label for="" class="form-label">Rejected by </label>
                                                <input type="text" class="form-control" value="<?= $reservation[0]['approvedorRejected_by_name'] ?>" readonly>
                                            </div>
                                            <div class="col-sm-12 col-md-6 mb-3 reject_div">
                                                <label for="" class="form-label">as on  </label>
                                                <input type="time" class="form-control" value="<?= date('d-m-Y H:i',strtotime($reservation[0]['rejected_ts'])) ?>" readonly>
                                            </div>
                                        <?php } ?> 

                                    </div> 
                                

                            
                            </div>

                            <div class="col-md-12 details_head">
                                    <h4>Payment Details </h4>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Check / Draft No </label>
                                    <input type="text" class="form-control" name="check_draft_no" value="" placeholder="Check / Draft No" required>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Branch Name </label>
                                    <input type="text" class="form-control" name="branch_name" value="" placeholder="Branch Name" required>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Bank Name </label>
                                    <input type="text" class="form-control" name="bank_name" value="" placeholder="Bank Name" required>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Check / Draft Date </label>
                                    <input type="text" class="form-control" id="check_draft_date" name="check_draft_date" value="" placeholder="Check / Draft Date" required>
                                </div>

                                <div class="col-sm-12 col-md-8 mb-9">
                                    <label for="" class="form-label">Remarks </label>
                                    <textarea class="form-control" name="remarks" id="remarks" cols="" rows="1" placeholder="Remarks"></textarea>
                                </div>
                        
                        </div>
                        
                        <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                        <a href="<?=base_url('admin/venue_reservation')?>" class="btn app-btn-primary">CANCEL</a>

                    </form>
                </div>
                <!--//app-card-body--> 

            </div>
        </div>
        <!--//container-fluid-->
        <script>

            $(document).ready(function(){  
                calculate_total();
                

                $('#check_draft_date').datepicker({ 
                    format: 'dd-mm-yyyy',
                    startDate: '+0d',
                    autoclose:true
                });
                
            })
            

            
            function calculate_total(){
                var total_rate = $("#total_rate").val();
                var discount = $("#discount").val();
                var gst_amount = $("#gst_amount").val();
                var status = "<?=$reservation['status']?>";

                if(discount > total_rate){

                    $.alert({
                        type:'red',
                        title: 'Alert!',
                        content: 'Discount should not greater than total amount'
                    });

                    return false;
                }

                var amount_after_discount = parseFloat(Number(total_rate) - Number(discount)).toFixed(2);
                $("#amount_after_discount").val(amount_after_discount);
                $("#amount_after_discount_txt").text(amount_after_discount);
                var net_amount = parseFloat(Number(amount_after_discount) + Number(gst_amount)).toFixed(2);
                $("#net_amount").val(net_amount);
                $("#net_amount_txt").text(net_amount);
                
                if(status == '0'){

                    if(net_amount == 0){
                    $("#payment_method").val('Offline'); 
                    $("#payment_method").attr('disabled',true);
                    } else { 

                        $("#payment_method").val('');
                        $("#payment_method").attr('disabled',false);
                    }

                }
                
            }



            


        </script>