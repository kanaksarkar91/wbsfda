
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container">
        <div class="row g-3 mb-3 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Venue Booking Report</h1>
            </div>
            <div class="col-auto">
                
            </div>
            <!--//col-auto-->
        </div>
        

        <div class="app-card app-card-orders-table shadow-sm mb-3">
            <div class="app-card-body px-2">
                
                <form action="" method="post" id="bookingReport">
                    <input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

                    <div class="row g-2">
                        <div class="col-lg-3 col-sm-12 col-md-12 mb-3">
                            <label for="" class="form-label">Property <span class="asterisk"></span></label>
                            <select name="property_id" class="form-select select2" id="property_id" onchange="populate_venue(this.value)" required>
                                <option value="">Select Property</option>

                                <?php if(!empty($property_list)){ ?>

                                    <?php foreach($property_list as $property){ ?>
                                        <option value="<?= $property['property_id']; ?>" <?php if(!empty($propertyId)){ if($property['property_id'] == $propertyId){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg-3 col-sm-12 col-md-12 mb-3">
                            <label for="" class="form-label">Venue <span class="asterisk"></span></label>
                            <select name="venue_id" class="form-select select2" id="venue_id" required>
                                <option value="0">All</option> 
                                <?php if(!empty($venue_list)){ ?>     
                                    <?php foreach($venue_list as $venue){ ?>
                                        <option value="<?php echo $venue['venue_id']; ?>" <?php if($venueId == $venue['venue_id']){ echo 'selected'; } ?>><?php echo $venue['venue_name']; ?></option>
                                    <?php } ?>
                                <?php } ?>                              
                            </select>                            
                        </div>

                        <div class="col-lg-2 col-sm-12 col-md-3">
                            <label for="" class="form-label">From</label>
                            <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($startDate) ? date('d-m-Y', strtotime($startDate)) : "" ?>">
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-3">
                            <label for="" class="form-label">To</label>
                            <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($endDate) ? date('d-m-Y', strtotime($endDate)) : "" ?>">
                        </div>
                        
                        <div class="col-lg-2 col-sm-12 col-md-3">
                            <label for="" class="form-label w-100">&nbsp;</label>
                            <button class="btn app-btn-primary w-100" type="submit">Search</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm mb-3 pt-2">
            <div class="app-card-body px-2 pb-4">

                <div class="table-responsive">

                    <table class="table align-middle app-table-hover mb-0 pt-1 small" id="venueBooking">

                        <thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
                            <tr>
                                <th>Transaction Date</th>
                                <th>Transaction Time</th>
                                <th>Property</th>
                                <th>Venue</th>
                                <th>Client</th>
                                <th>GSTIN (if available)</th>
                                <th>Primary Contact No.</th>
                                <th>Alternative Contact No. (if available)</th>
                                <th>Booking ID</th>
                                <th>Booking Start Date</th>
                                <th>Booking End Date</th>
                                <th class="text-end">Booking Value before GST</th>
                                <th class="text-end">GST</th>
                                <th class="text-end">Booking Value after GST</th>
                                <th class="text-end">Amount</th>
                                <th>Receipt Transaction No.</th>
                                <th>Payment Mode</th>
                                <th>Reference No.</th>
                                <th>Initiated by</th>
                                <th>Present Status</th>
                                <th>Invoice No.</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(!empty($booking_report)){ ?>

                                <?php foreach($booking_report as $report){ ?>

                                    <?php
                                        if($report['is_indivisual'] == 1){
                                            $primaryContact = $report['indivisual_contact_no'];
                                        } else {
                                            $primaryContact = $report['business_contact_no'];
                                        }

                                        if($report['booked_customer_name'] == ''){
                                            $intiatedBy = $report['booked_admin_name'];
                                        } else {
                                            $intiatedBy = $report['booked_customer_name'];
                                        }

                                        if($report['booking_status'] == 1){
                                            $bookingStatus = 'Advance paid';
                                        } else if($report['booking_status'] == 2){
                                            $bookingStatus = 'Fully Paid & Invoice Generated';
                                        } else if($report['booking_status'] == 3){
                                            $bookingStatus = 'FOC ( Free of Cost)';
                                        } else if($report['booking_status'] == 4){
                                            $bookingStatus = 'NOC issued';
                                        } else if($report['booking_status'] == 5){
                                            $bookingStatus = 'Cancellation Request';
                                        } else if($report['booking_status'] == 6){
                                            $bookingStatus = 'Refunded';
                                        } else if($report['booking_status'] == 7){
                                            $bookingStatus = 'Payment failed';
                                        } else if($report['booking_status'] == 8){
                                            $bookingStatus = 'Payment Pending';
                                        }

                                        $paymentAmount = $report['payment_amount'];
                                        $gstAmount = ($paymentAmount * 18)/100;

                                        $beforeAmount = $paymentAmount - $gstAmount;
                                    ?>

                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($report['payment_date'])); ?></td>
                                        <td><?php echo date('H:i:s', strtotime($report['payment_date'])); ?></td>
                                        <td><?php echo $report['property_name']; ?></td>
                                        <td><?php echo $report['venue_name']; ?></td>
                                        <td><?php echo $report['customer_name']; ?></td>
                                        <td><?php echo $report['gst_number']; ?></td>
                                        <td><?php echo $primaryContact; ?></td>
                                        <td><?php echo $report['contact_person_contact_no']; ?></td>
                                        <td><?php echo $report['booking_id']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($report['booking_start_date'])); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($report['booking_end_date'])); ?></td>
                                        <td class="text-end beforegstTotal"><?php echo $beforeAmount; ?></td>
                                        <td class="text-end gstTotal"><?php echo $gstAmount; ?></td>
                                        <td class="text-end aftergstTotal"><?php echo $paymentAmount; ?></td>
                                        <td class="text-end amountTotal"><?php echo $report['net_amount']; ?></td>
                                        <td><?php echo $report['txnid']; ?></td>
                                        <td><?php echo $report['payment_mode']; ?></td>
                                        <td><?php echo $report['transaction_ref_id']; ?></td>
                                        <td><?php echo $intiatedBy; ?></td>
                                        <td><?php echo $bookingStatus; ?></td>
                                        <td><?php echo $report['order_id']; ?></td>
                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="21">No data found.</td>
                                </tr>

                            <?php } ?>

                        </tbody>

                        <tfoot style="background-color: #1a4919; font-size: 1.1rem;">
                            <tr>									
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white text-end beforegstgrandTotal"></th>
                                <th class="cell text-white text-end gstgrandTotal"></th>
                                <th class="cell text-white text-end aftergstgrandTotal"></th>
                                <th class="cell text-white text-end amountgrandTotal"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
                
            </div>
        </div>

    </div>
</div>
<!--//app-content-->

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<script>
 $(document).ready(function() {

    $(function() {

        $('#start_date').datepicker({ 
            maxDate: new Date,
            dateFormat: 'dd-mm-yy',
            onSelect: function(date) {
                $("#end_date").datepicker('option', 'minDate', date);
            }
        });  

        $( "#end_date" ).datepicker({  
            maxDate: new Date,
            dateFormat: 'dd-mm-yy',
            onSelect: function(date) {
                $("#start_date").datepicker('option', 'maxDate', date);
            } 
        });

    });


    var today = new Date();
    $('#venueBooking').DataTable( {
       /*"order": [[ 3, "desc" ]],
       "paging": false,
       "showNEntries" : false,
       "bPaginate": false,
        "bFilter": false,*/
        "scrollCollapse": true,
        "scrollY": '448px',
        "scrollX": 'true',
        "bInfo": false,
        "ordering": false,
		"bPaginate": false,
        "dom": 'Bfrtip',
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // computing column Total of the complete result 
            var beforegstSum = api
                .column( 11, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var gstSum = api
                .column( 12, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var aftergstSum = api
                .column( 13, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var amountSum = api
                .column( 14, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 11 ).footer() ).html(beforegstSum.toFixed(2));
            $( api.column( 12 ).footer() ).html(gstSum.toFixed(2));
            $( api.column( 13 ).footer() ).html(aftergstSum.toFixed(2));
            $( api.column( 14 ).footer() ).html(amountSum.toFixed(2));
            
        },
        buttons: [{
            "extend": 'excel',
            "footer": true,
            "text": 'Download Excel', 
            exportOptions: {
            columns: ':visible',
            orthogonal: null,
            format: {
                body: function (data, row, column, node) {
                var momentDate = moment(data, 'DD/MM/YYYY', true);
                    if (momentDate.isValid()) {
                        return momentDate.format('YYYY-MM-DD');
                        }
                    else {
                        return data;
                         }
                    }
                }
            } ,     
            'className': 'btn app-btn-primary',
            'filename': 'Venue_Booking_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "footer": true,
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Venue_Booking_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        "searching": false
        
    });    

});
    
function populate_venue(property_id){    
    var result='';
    $.ajax({
        type: 'GET',	
        url: "<?= base_url('admin/venue/getVenueByProperty'); ?>",
        data: {
            'property_id':property_id
        },
        dataType: 'json',
        encode: true,
        async: false
    })
    .done(function(data){
        if(data.status){
            result +='<option value="0" selected >All</option>';
            $.each(data.list,function(key,value){
                var selected_txt='';
                result +='<option value="'+value.venue_id+'">'+value.venue_name+'</option>';
            });
        }
        else{
            result +='<option value="">No Venue selected</option>'
        }
        $("#venue_id").html(result);
    
    })
    .fail(function(data){
        // show the any errors
        console.log(data);
    });
}

</script>