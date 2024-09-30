<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                        <form class="settings-form" method="post" action="<?php echo base_url('admin/reservation/submitpayment'); ?>" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" class="form-control" name="booking_id" value="<?= $reservation['booking_id'] ?>" readonly>
                            
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
                                    <input type="text" class="form-control" name="remarks" value="<?= $reservation['remarks'] ?>" readonly>
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
                                    <h4><?= ($reservation['status'] == 1) ? 'Approved' : (($reservation['status'] == 2)?'Rejected':(($reservation['status'] == 3)?'Confirmed':'Pending')) ?></h4>
                                </div>

                                <div class="col-sm-12 col-md-12 mb-3" style="<?=($reservation['status'] == '0')?'display:block;':'display:none;'?>">
                                <label for="" class="form-label me-3">Status</label>
                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_0" value="0" checked>
                                    <label class="form-check-label" for="status_0">Pending</label>
                                </div> -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required <?= ($reservation['status'] == '1')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_1">Approve</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" required <?= ($reservation['status'] == '2')?'checked':'' ?>>
                                    <label class="form-check-label" for="status_2">Reject</label>
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
                                                <option value="Offline" <?=($reservation['payment_method'] == 'Offline')?'selected':''?>>Offline</option>
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
                        <a href="<?=base_url('admin/reservation')?>" class="btn app-btn-primary">CANCEL</a>

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