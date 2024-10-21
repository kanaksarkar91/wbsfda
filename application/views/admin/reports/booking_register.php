
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
	
        <div class="row g-3 mb-2 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Booking Register</h1>
			</div>
		</div>

        <div class="app-card app-card-settings shadow-sm p-3 mb-3">
            <div class="app-card-body">
                <form method="POST">
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    <div class="row g-3">
                        <div class="col-lg-3 col-sm-12 col-md-3">
                            <label for="" class="form-label">Select Property</label>
                            <select class="form-select select2" name="property">
                                <option value="">Select Property</option>
                                <?php

                                if (isset($properties))
                                    foreach ($properties as $p) {

                                ?>
                                <option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-2">
                            <label for="" class="form-label">From</label>
                            <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($start_date) ? date('d-m-Y', strtotime($start_date)) : "" ?>" >
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-2">
                            <label for="" class="form-label">To</label>
                            <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($end_date) ? date('d-m-Y', strtotime($end_date)) : "" ?>" >
                        </div>
                        <!--<div class="col-lg-2 col-sm-12 col-md-2">
                            <label for="" class="form-label">Booking Source</label>
                            <select class="form-select" name="bookingsource" id="bookingsource">
                                <option value="">--Select All--</option>
                                <option value="B" <?= (set_value('bookingsource')=='B')?" selected=' selected'":""?>>Backend</option>
                                <option value="F" <?= (set_value('bookingsource')=='F')?" selected=' selected'":""?>>Frontend</option>                             
                            </select>
                        </div>-->
                        <div class="col-lg-2 col-sm-12 col-md-2">
                            <label for="" class="form-label">Canceled By</label>
                            <select class="form-select" name="canceledby" id="cancekedby">
                                <option value="">--Select All--</option>
                                <option value="B" <?= (set_value('canceledby')=='B')?" selected=' selected'":""?>>Admin</option>
                                <option value="F" <?= (set_value('canceledby')=='F')?" selected=' selected'":""?>>Guest</option>                             
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-12 col-md-3 button-group">
                            <label for="" class="form-label"></label><br />
							<button class="btn app-btn-primary">Search</button>
                            <a class="btn app-btn-primary" href="">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>		

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
                    margin-bottom: .25rem;
					margin-right: .25rem;
					float:right!important;
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
				/* .dt-buttons button.buttons-csv.buttons-html5{
                    margin-top: 18px;
                    margin-left: 15px;
                } */
        </style>

        <div class="app-card app-card-orders-table shadow-sm mb-3">
            <div class="app-card-body">
                <div class="table-responsive pt-1">
                        <table class="table app-table-hover mb-0 text-left" id="sports_facilities">
                        <thead>
                            <tr>
								<th class="cell">SL No.</th>
								<th class="cell">Property Name </th>
								<th class="cell">Booking Date</th>
								<th class="cell">Booked By</th>
                                <th class="cell">Booking No</th>
								<th class="cell">Guest Name</th>
								<th class="cell">Primary Contact No.</th>
								<th class="cell">Transaction ID / MR No. & Date</th>
								<th class="cell">Booking Amount Before GST</th>
								<th class="cell">Extra Person</th>
								<th class="cell">GST</th>
								<th class="cell">Actual Booking Amount</th>
								<th class="cell">Booking Amount After GST</th>
								<th class="cell">Invoice Amount Before GST</th>
								<th class="cell">GST</th>
								<th class="cell">Invoice Amount After GST</th>
								<th class="cell">Previous Booking Amount Before GST</th>
								<th class="cell">Previous GST</th>
								<th class="cell">Previous Booking Amount After GST</th>
								<th class="cell">Check In Date</th>
								<th class="cell">Check Out Date</th>
								<th class="cell">Current Status</th>
								<th class="cell">Cancellation Date</th>
								<th class="cell">Cancelled By</th>
                                <th class="cell">Cancellation Rate(%)</th>
                                <th class="cell">Cancellation Charge</th>
                                <th class="cell">GST on Cancellation Charge</th>
								<th class="cell">Refund Amount</th>
                                <th class="cell">Amount Receivable</th>								
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($booking_register_data)){
                                    foreach($booking_register_data as $index => $reservation){                                       
                            ?>
                            <tr <?php if($reservation['Booking_Amount_before_GST'] != $reservation['invoice_amount_before_gst']){ ?> style="background-color:#E1FFFF;<?php } ?>">
                            <td class="cell"><?= $index+1 ?></td>
                                <td class="cell"><?= $reservation['property_name'] ?></td>
                                <td class="cell"><?= ($reservation['booking_date'])?date('d/m/Y', strtotime($reservation['booking_date'])):"N/A" ?></td>
                                <td class="cell"><?= $reservation['booked_by'] ?></td>
                                <td class="cell"><?= $reservation['booking_no'] ?></td>
								<td class="cell"><?= $reservation['first_name'] ?></td>
								<td class="cell"><?= $reservation['mobile'] ?></td>
                                <td class="cell">
									<?= ($reservation['money_receipt_no'] == '') ? $reservation['order_id'] : $reservation['money_receipt_no'] .' and '.$reservation['money_receipt_date'];
									?>
								</td>
                                <td class="cell" style="text-align:right"><?= $reservation['Booking_Amount_before_GST'] ?> </td>
								<td class="cell" style="text-align:right"><?= $reservation['tot_extra_bed_amt'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['invoice_gst'] ?> </td>
								<td class="cell" style="text-align:right"><?= number_format($reservation['actual_booking_amt'],2) ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['Booking_Amount_after_GST'] ?> </td>
								<td class="cell" style="text-align:right"><?= $reservation['invoice_amount_before_gst'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['invoice_gst'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['invoice_amount_after_gst'] ?> </td>
								<td class="cell" style="text-align:right"><?= $reservation['previous_room_base_price'] ?> </td>
								<td class="cell" style="text-align:right"><?= $reservation['previous_room_total_igst'] ?> </td>
								<td class="cell" style="text-align:right"><?= $reservation['previous_net_payable_amount'] ?> </td>
                                <td class="cell"><?= ($reservation['Check_In_Date'])?date('d/m/Y', strtotime($reservation['Check_In_Date'])):"N/A" ?> </td>
                                <td class="cell"><?=  ($reservation['Check_Out_Date'])?date('d/m/Y', strtotime($reservation['Check_Out_Date'])):"N/A" ?> </td>
                                <td class="cell">
								<?php /*?><?= ($reservation['booking_status']=='C')?"Cancelled": (($reservation['booking_status']=='A')?"Approved":(($reservation['booking_status']=='I')?"Initiate":"Check")) ?><?php */?>
								<?php
								if($reservation['checked_in']=='0' && $reservation['booking_status']=='A'){
									echo "Approved";
								}
								else if($reservation['checked_in']=='1' && $reservation['booking_status']=='A'){
									echo "Check-In";
								}
								else if($reservation['checked_in']=='0' && $reservation['booking_status']=='I'){
									echo "Initiate";
								}
								else if($reservation['checked_in']=='0' && $reservation['booking_status']=='C'){
									echo "Cancelled";
								}
								else if($reservation['checked_in']=='1' && $reservation['booking_status']=='O'){
									echo "Check-Out";
								}
								?>
								
								</td>
                                <td class="cell"><?= ($reservation['cancel_datetime_ts'])?date('d/m/Y', strtotime($reservation['cancel_datetime_ts'])): "N/A" ?> </td>
                                <td class="cell"><?= ($reservation['booking_status']=='C')?$reservation['canceled_by']:'N/A' ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['cancel_percent'] ?></td>
                                <td class="cell" style="text-align:right"><?= $reservation['actual_cancellation_Charge'] ?> </td>
                                <td class="cell"><?= $reservation['cancel_gst_percent'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['Refund_Amount'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['amount_receivable'] ?> </td>                           
                                
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                        <tfoot style="background-color: #1a4919; font-size: 1.0rem;">
                            <tr>									
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>  
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>                               
                            </tr>
                        </tfoot>
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
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "scrollCollapse": 'true',
        "scrollY": '360px',
        "scrollX": 'true',
        "bInfo": false,
        "ordering": false,
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
            var oneTotal = api
                .column( 8, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var twoTotal = api
                .column( 9, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var threeTotal = api
                .column( 10, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var fourTotal = api
                .column( 11, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var fiveTotal = api
                .column( 12, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var sixTotal = api
                .column( 13, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var sevenTotal = api
                .column( 14, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var eightTotal = api
                .column( 15, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var nineTotal = api
                .column( 16, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var tenTotal = api
                .column( 17, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var elevenTotal = api
                .column( 18, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var twelveTotal = api
                .column( 24, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var thirteenTotal = api
                .column( 25, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var fourteenTotal = api
                .column( 26, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var fifteenTotal = api
                .column( 27, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var sixteenTotal = api
                .column( 28, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 8 ).footer() ).html(oneTotal.toFixed(2));
            $( api.column( 9 ).footer() ).html(twoTotal.toFixed(2));
			$( api.column( 10 ).footer() ).html(threeTotal.toFixed(2));
			$( api.column( 11 ).footer() ).html(fourTotal.toFixed(2));
			$( api.column( 12 ).footer() ).html(fiveTotal.toFixed(2));
			$( api.column( 13 ).footer() ).html(sixTotal.toFixed(2));
			$( api.column( 14 ).footer() ).html(sevenTotal.toFixed(2));
			$( api.column( 15 ).footer() ).html(eightTotal.toFixed(2));
			$( api.column( 16 ).footer() ).html(nineTotal.toFixed(2));
			$( api.column( 17 ).footer() ).html(tenTotal.toFixed(2));
			$( api.column( 18 ).footer() ).html(elevenTotal.toFixed(2));
			$( api.column( 24 ).footer() ).html(twelveTotal.toFixed(2));
			$( api.column( 25 ).footer() ).html(thirteenTotal.toFixed(2));
			$( api.column( 26 ).footer() ).html(fourteenTotal.toFixed(2));
            $( api.column( 27 ).footer() ).html(fifteenTotal.toFixed(2));
            $( api.column( 28 ).footer() ).html(sixteenTotal.toFixed(2));
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
            'filename': 'PTA_Booking_register'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "footer": true,
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'PTA_Booking_register'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        "searching": false
        
    } );
} );
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