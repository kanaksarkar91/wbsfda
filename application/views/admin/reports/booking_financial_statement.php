
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
                
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Financial Statement</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                <form method="POST" id="search_form">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--<span id="date_validation" class="hidden small text-danger">
                        End date must be greater than Start Date
					</span>-->
                            <!--//col--> 
							<div class="col-auto">
                                <select class="form-select select2" name="property" id="sel_property" required>
									<option value="" selected disabled>Select Property</option>
									<?php
									if (isset($properties))
										foreach ($properties as $p) {
									?>
									<option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
									<?php } ?>
								</select>
                            </div>
                            <div class="col-auto">
                            <select class="form-select select2" name="cuttoffDates" id="sel_cuttoffDates" required>
									<option value="" selected disabled>Select Cut-off Date</option>
									<?php
									if (isset($cutoffDates))
										foreach ($cutoffDates as $cd) {
									?>
									<option value="<?= $cd['cutoff_date']; ?>" <?= set_select('cuttoffDates', $cd['cutoff_date'], isset($cuttoffDates) && $cuttoffDates == $cd['cutoff_date'] ? true : false); ?>><?= date('d-m-Y', strtotime($cd['cutoff_date'])); ?></option>
									<?php } ?>
								</select>
                            </div>
                            <div class="col-auto">
                                <button class="btn app-btn-primary">
                                    Search
                                </button>
                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-primary" href="">
                                    Reset
                                </a>
                            </div>
                            <!--//col--> 
                            <!--<div class="col-auto">
                                <a class="btn app-btn-primary" href="add.html">
                                    Download Excel
                                </a>
                            </div>-->
                    </div>
                        </form>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <style type="text/css">
                .btn-green {
                    background: #33c543;
                    color: #fff;
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 4px;
                    font-family: 'Barlow', sans-serif;
                    border: #33c543 1px solid;
                    padding: 6px 16px;
                    font-size: 13px;
                    font-weight: 400;
                    text-decoration: none;
                    transition-duration: 0.5s;
                    -webkit-transition-duration: 0.5s;
                    display: inline-block;
                }

                .btn-green:focus,
                .btn-green:hover {
                    background: #000;
                    color: #33c543;
                    border: #33c543 1px solid;
                    transition-duration: 0.5s;
                    -webkit-transition-duration: 0.5s;
                    outline: 0;
                }
                .btn-yellow {
                    background: #ff9600;
                    color: #fff;
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 4px;
                    font-family: 'Barlow', sans-serif;
                    border: #ff9600 1px solid;
                    padding: 6px 16px;
                    font-size: 13px;
                    font-weight: 400;
                    text-decoration: none;
                    transition-duration: 0.5s;
                    -webkit-transition-duration: 0.5s;
                    display: inline-block;
                }
                .btn-info {
                    background: #6dafff;
                    color: #fff;
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 4px;
                    font-family: 'Barlow', sans-serif;
                    border: #6dafff 1px solid;
                    padding: 6px 16px;
                    font-size: 13px;
                    font-weight: 400;
                    text-decoration: none;
                    transition-duration: 0.5s;
                    -webkit-transition-duration: 0.5s;
                    display: inline-block;
                }
                .btn-info:focus,
                .btn-info:hover {
                    background: #246fc9;
                    color: #fff;
                    border: #246fc9 1px solid;
                    transition-duration: 0.5s;
                    -webkit-transition-duration: 0.5s;
                    outline: 0;
                }

                .btn-primary {
                    color: #fff !important;
                    background-color: #246fc9;
                    border-color: #246fc9;
                }

                .btn-primary:hover {
                    color: #fff;
                    background-color: #6dafff;
                    border-color: #6dafff
                }
                .btn{
                    margin: 2.5px 0;
                }
                div.dt-buttons{
                    margin-top: 18px;
                    margin-left: 15px; 
                }                
                .date-input{
                    position: relative;
                }
                .date-input::before {
                    right: 15px;
                    top: 12px;
                    position: absolute;
                    content: "\f073";
                    font: normal normal normal 14px/1 FontAwesome;
                }
                /* 
				.dt-buttons button.buttons-csv.buttons-html5{
                    margin-top: 18px;
                    margin-left: 15px;
                } */
        </style>

        <div class="app-card app-card-orders-table shadow-sm mb-5">
        <h5>Receivable</h5>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left" id="tbl_recievable">
                        <thead>
                            <tr>
                            <th class="cell">SL No.</th>
								<th class="cell">Property Name</th>
								<th class="cell">Total Booking Amount before GST</th>
								<th class="cell">Total GST</th>
                                <th class="cell">Total Booking Amount after GST</th>
								<th class="cell">Total Cancellation Charge</th>
								<th class="cell">Total GST on Cancellation Charge</th>
								<th class="cell">Total Refund Amount</th>
                                <th class="cell">Total Amount Receivable</th>		
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell"><?= (!empty($reservations))? '1' :'' ?></td>
                                <td class="cell"><?= $reservations[0]['property_name'] ?></td>               
                                <td class="cell" style="text-align:right"><?= $total_booking_Amount_before_GST ?> </td>
                                <td class="cell" style="text-align:right"><?= $total_gst ?> </td>
                                <td class="cell" style="text-align:right"><?= $total_booking_Amount_after_GST ?> </td>
                                <td class="cell" style="text-align:right"><?= $total_actual_cancellation_Charge ?> </td>
                                <td class="cell" style="text-align:right"><?= $total_cancel_gst_percent ?> </td>
                                <td class="cell" style="text-align:right"><?= $total_Refund_Amount ?> </td>
                                <td class="cell" style="text-align:right"><?= $total_amount_receivable ?> </td>                                                             
                            </tr>
                        </tbody>
                    </table>
                    </div>
            <!--//app-card-body-->
            <h5>Recieved/Adjustment </h5>
            <div class="app-card-body">
                    <table class="table app-table-hover mb-0 text-left" id="tbl_recieved">
                        <thead>
                            <tr>
                            <th class="cell">SL No.</th>
								<th class="cell">Date</th>
								<th class="cell">UTR/Reference</th>
                                <th class="cell">Amount</th>	
                                <th class="cell">Outstanding Amount</th>						
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                             if(!empty($transferDetails)){
                                    foreach($transferDetails as $index => $transferDetail){                                       
                            ?>
                            <tr>
                                <td class="cell"><?=  $index+1 ?></td>
                                <td class="cell"><?=  date('d-m-Y', strtotime($transferDetail['payment_date'])) ?> </td>
                                <td class="cell"><?= $transferDetail['utr_reference_no'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $transferDetail['amount'] ?> </td>
                                <td class="cell"> </td>                                                                                     
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                        <?php
                             if(!empty($transferDetails)){
                            ?>
                        <tfoot align="right">
		                <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?= $total_transferdtls_amount ?></th>
                            <th><?= $outstanding_amount ?></th>
                        </tr>
	                    </tfoot>
                        <?php
                                    }
                            ?>
                    </table>
                </div>
                <!--//table-responsive-->

            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<script>
 $(document).ready(function() {
    $(function() {
    $('#start_date').datepicker({  
        maxDate: -1,
        dateFormat: 'dd-mm-yy',
            onSelect: function(date) {
                $("#end_date").datepicker('option', 'minDate', date);
            }
     });  
  $( "#end_date" ).datepicker({ 
     maxDate: -1,
     dateFormat: 'dd-mm-yy',
     onSelect: function(date) {
                $("#start_date").datepicker('option', 'maxDate', date);
            } 
        });
});
    var today = new Date();
    $('#tbl_recievable').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
        "ordering": false
       // "searching": false
        
    });

    $('#tbl_recieved').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
        "ordering": false
       // "searching": false
        
    });
});

</script>
<!--<script>
 $(document).ready(function() {
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
       "ordering": false

       // "searching": false
        
    } );
} );
</script>-->