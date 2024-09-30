
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
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
                        <h1 class="app-page-title mb-0">Reservation View Details</h1>
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
                        <form class="settings-form" method="post" action="<?php echo base_url('admin/reservation/submitreservation'); ?>" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" class="form-control" name="booking_id" value="<?= $reservation['booking_id'] ?>" readonly>
                        <input type="hidden" class="form-control" id="organization_type" name="organization_type" value="<?= $reservation['organization_type'] ?>" readonly>
                        
                            <div class="row g-3">

                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Reservation ID / Reservation Request ID</label>
                                    <input type="text" class="form-control" value="<?='Re-'.str_pad($reservation['booking_id'],6,"0",STR_PAD_LEFT)?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Reservation Request Received on</label>
                                    <input type="text" class="form-control" value="<?=date('d-m-Y H:i:s',strtotime($reservation['created_at']))?>" readonly>
                                </div>

                                <div class="col-md-12 details_head">
                                    <h4>Details of the Reservee </h4>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Category </label>
                                    <input type="text" class="form-control" value="<?= $reservation['category_name'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Organisation </label>
                                    <input type="text" class="form-control" value="<?= $reservation['organization_name'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-8 mb-3">
                                    <label for="" class="form-label">Mailing Address  with PIN Code </label>
                                    <textarea class="form-control" name="" id="" cols="" rows="8" readonly><?= $reservation['mailing_address'] ?></textarea>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    
                                    <label for="" class="form-label mrg10T">Verified Contact No.</label>
                                    <input type="text" class="form-control" value="<?= $reservation['mobile'] ?>" readonly>
                                    <label for="" class="form-label mrg10T">Other Contact No.</label>
                                    <input type="text" class="form-control" value="<?= $reservation['contact_no'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">E-mail ID</label>
                                    <input type="email" class="form-control" value="<?= $reservation['email'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" value="<?= $reservation['contact_person'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Designation</label>
                                    <input type="text" class="form-control" value="<?= $reservation['designation'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Contact No.</label>
                                    <input type="number" class="form-control" value="<?= $reservation['contact_no'] ?>" readonly>
                                </div>
                                
                                <div class="col-md-12 details_head">
                                    <h4>Sports Facility </h4>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Division </label>
                                    <input type="text" class="form-control" value="<?= $reservation['fieldunit_name'] ?>" readonly>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Location </label>
                                    <input type="text" class="form-control" value="<?= $reservation['location_name'] ?>" readonly>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Sports Facility </label>
                                    <input type="text" class="form-control" value="<?= $reservation['sports_facilities_name'] ?>" readonly>
                                </div>
                                <div class="col-md-12 details_head">
                                    <h4>Sports Facility </h4>
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
                                                <?php if(!empty($reservation_details)){
                                                    foreach($reservation_details as $reservation_detail){ ?>
                                                <tr>
                                                    <td class="cell text-center"><?=date('d-m-Y',strtotime($reservation_detail['start_date']))?> </td>
                                                    <td class="cell text-right"><?= $reservation_detail['rate'] ?> </td>

                                                </tr>
                                                <?php } } ?>
                                                <tr>
                                                    <td class="cell text-center"><b>Total Payable</b></td>
                                                    <td class="cell text-right"><?= $reservation['total_rate'] ?> </td>
                                                    <input type="hidden" class="form-control" id="total_rate" name="total_rate" value="<?= $reservation['total_rate'] ?>">

                                                </tr>
                                                <tr>
                                                    <td class="cell text-center">Less : Discount </td>
                                                    <td class="cell text-right"><input type="text" class="form-control text-right calculate_total" id="discount" name="discount" value="<?= $reservation['discount'] ?>" <?= ($reservation['status'] == '0')?'':'readonly'?>></td>

                                                </tr>
                                                <tr>
                                                    <td class="cell text-center"><b>Amount after Discount	</b></td>
                                                    <td class="cell text-right" id="amount_after_discount_txt"><?= $reservation['total_rate'] ?></td>
                                                    <input type="hidden" class="form-control" id="amount_after_discount" name="amount_after_discount" value="">

                                                </tr>
                                                <tr class="gst_cell" style="display: none;">
                                                    <td class="cell text-center">GST @ 0%</td>
                                                    <td class="cell text-right">0 </td>
                                                    <input type="hidden" class="form-control" id="gst_percentage" name="gst_percentage" value="0">
                                                    <input type="hidden" class="form-control" id="gst_amount" name="gst_amount" value="0">

                                                </tr>
                                                <tr class="brown_bg">
                                                    <td class="cell text-center"><b>Net Payable	</b> </td>
                                                    <td class="cell text-right"><b id="net_amount_txt"><?= $reservation['total_rate'] ?></b></td>
                                                    <input type="hidden" class="form-control" id="net_amount" name="net_amount" value="<?= $reservation['total_rate'] ?>">

                                                </tr>






                                            </tbody>
                                        </table> 
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" value="<?= $reservation['remarks'] ?>">
                                </div>
                                </div>

                                <?php if($reservation['discount_given_by'] != '') { ?>

                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label mrg10T">Discount Allowed by	</label>
                                        <input type="text" class="form-control" value="<?= $reservation['discount_given_by'] ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label mrg10T">as on </label>
                                        <input type="text" class="form-control" value="<?= $reservation['discount_given_ts'] ?>" readonly>
                                    </div>
                                    <?php } ?>

                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="" class="form-label me-3">Current Status</label>
                                    <h4><?= ($reservation['status'] == 1) ? 'Approved' : (($reservation['status'] == 2)?'Rejected':(($reservation['status'] == 3)?'Confirmed':(($reservation['status'] == 4)?'Cancelled':(($reservation['status'] == 5)?'Not responded':'Pending')))) ?></h4>
                                </div>

                                <div class="col-sm-12 col-md-12 mb-3" style="<?=(in_array($reservation['status'],array('0','3')) && $reservation['is_event_started'] == 0)?'display:block;':'display:none;'?>">
                                <label for="" class="form-label me-3">Status</label>
                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_0" value="0" checked>
                                    <label class="form-check-label" for="status_0">Pending</label>
                                </div> -->
                                <div class="form-check form-check-inline" style="<?=($reservation['status'] == '0')?'display:block;':'display:none;'?>">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required <?= ($reservation['status'] == '1')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_1">Approve</label>
                                </div>
                                <div class="form-check form-check-inline" style="<?=($reservation['status'] == '0')?'display:block;':'display:none;'?>">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required <?= ($reservation['status'] == '2')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_2">Reject</label>
                                </div>
                                <div class="form-check form-check-inline" style="<?=(($reservation['status'] == '3' && $reservation['is_event_started'] == 0))?'display:block;':'display:none;'?>">
                                    <input class="form-check-input" type="radio" name="status" id="status_4" value="4" required <?= ($reservation['status'] == '4')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_4">Cancel</label>
                                </div>
                                
                                </div> 

                                

                                <div class="col-sm-12 col-md-9 mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mb-3 approve_div" style="<?= ($reservation['status'] == '1')?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Aprroval is Valid till	</label>
                                            <input type="text" id="approval_valid_till" name="approval_valid_till" class="form-control" value="<?= $reservation['approval_valid_till'] ?>" <?= ($reservation['status'] == '0')?'':'readonly' ?>>
                                        </div>

                                        <div class="col-sm-12 col-md-6 mb-3 approve_div" style="<?= ($reservation['status'] == '1')?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Payment Method	</label>
                                            <select name="payment_method" id="payment_method" class="form-select" <?= ($reservation['status'] == '0')?'':'disabled' ?>> 
                                                <option value="" selected disabled>Select Payment Method</option>
                                                <option value="Online" <?=($reservation['payment_method'] == 'Online')?'selected':''?>>Online</option>
                                                <option value="Offline" <?=($reservation['payment_method'] == 'Offline')?'selected':(($reservation['organization_type'] == 5)?'selected':'')?>>Offline</option>
                                            </select> 
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                    <?php if($reservation['approved_by'] != '' && $reservation['status'] == '1') { ?>
                                        
                                        <div class="col-sm-12 col-md-6 mb-3 approve_div">
                                            <label for="" class="form-label">Approved by      </label>
                                            <input type="text" class="form-control" value="<?= $reservation['approved_by'] ?>" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-3 approve_div">
                                            <label for="" class="form-label">as on   </label>
                                            <input type="text" class="form-control" value="<?= $reservation['approved_ts'] ?>" readonly>
                                        </div>

                                    <?php } ?>
                                        <div class="col-sm-12 col-md-12 mb-3 reject_div" style="<?= ($reservation['status'] == '2')?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Reason </label>
                                            <textarea name="rejection_reason" id="rejection_reason" cols="" rows="4" class="form-control" placeholder="Reason"><?= $reservation['rejection_reason'] ?></textarea>
                                        </div>

                                        <?php if($reservation['rejected_by'] != '' && $reservation['status'] == '2') { ?>
                                            <div class="col-sm-12 col-md-6 mb-3 reject_div">
                                                <label for="" class="form-label">Rejected by </label>
                                                <input type="text" class="form-control" value="<?= $reservation['rejected_by'] ?>" readonly>
                                            </div>
                                            <div class="col-sm-12 col-md-6 mb-3 reject_div">
                                                <label for="" class="form-label">as on  </label>
                                                <input type="time" class="form-control" value="<?= $reservation['rejected_ts'] ?>" readonly>
                                            </div>
                                        <?php } ?> 

                                    </div> 

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 mb-3 cancellation_div" style="<?= !empty($reservation['cancellation_reason'])?'display: block;':'display: none;' ?>">
                                            <label for="" class="form-label">Reason of Cancellation </label>
                                            <textarea name="cancellation_reason" id="cancellation_reason" cols="" rows="4" class="form-control" placeholder="Reason of Cancellation"><?= $reservation['cancellation_reason'] ?></textarea>
                                        </div>
                                    </div>
                                

                            
                            </div>
                        
                        </div>
                        <?php if($reservation['status'] == '0' || $reservation['status'] == '3') { ?> 
                        <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                        <?php } ?>
                        <a href="<?=base_url('admin/reservation')?>" class="btn app-btn-primary">Go Back</a>

                    </form>
                </div>
                <!--//app-card-body--> 

            </div>
        </div>
        <!--//container-fluid-->
        <script>

            $(document).ready(function(){ 

                var status = "<?=$reservation['status']?>";
                if(status != '0'){
                    calculate_total();
                }

                $('#approval_valid_till').datetimepicker({ 
                    format:'d-m-Y H:i',
                    minDate: new Date()
                });
                
            })
            $("input[name='status']").change(function(){
                var status = $(this).val();
                if(status == '1'){

                        $(".approve_div").show();
                        $(".reject_div").hide();
                } else if(status == '2'){
                    $(".approve_div").hide();
                        $(".reject_div").show();
                        $("#discount").val(0);
                        calculate_total();

                } else if(status == '4'){
                    $(".approve_div").hide();
                    $(".reject_div").hide();
                    $(".cancellation_div").show();
                    calculate_total();

                } 
                
                else{
                    $(".approve_div").hide();
                        $(".reject_div").hide();
                }
            })

            $(".calculate_total").keyup(function(){
                calculate_total();
                
            })

            function calculate_total(){
                var total_rate = $("#total_rate").val();
                var discount = $("#discount").val();
                var gst_amount = $("#gst_amount").val();
                var status = "<?=$reservation['status']?>";
                var organization_type = $("#organization_type").val();

                if(Number(discount) > Number(total_rate)){

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

                    
                    if(net_amount == 0 || organization_type == 5){
                        $("#payment_method").val('Offline'); 
                        $("#payment_method").attr('disabled',true);
                    } else { 

                        $("#payment_method").val('');
                        $("#payment_method").attr('disabled',false);
                    }

                }
                
            }

            $("input[name='status']").change(function(){


            })



            


        </script>