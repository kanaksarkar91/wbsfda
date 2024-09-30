
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
                
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Booking Receivable Statement</h1>
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
                            <!--<div class="col-auto">
                                <input type="text" class="form-control" name="start_date" id="start_date" 
                                value="<?= empty($this->input->post($start_date)) || !date('d-m-Y',strtotime($this->input->post($start_date))) ?  date('d-m-Y', strtotime(date('Y-m')." -1 month")) : date('d-m-Y', strtotime($start_date)) ?>">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="end_date" id="end_date" 
                                value="<?=empty($this->input->post($end_date)) || !date('d-m-Y',strtotime($this->input->post($end_date))) ? date('d-m-Y') : date('d-m-Y', strtotime($end_date)) ?>" >
                            </div>-->
                            <div class="col-auto date-input">
                                <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy"
                                    value="<?= !empty($start_date) ? date('d-m-Y', strtotime($start_date)) : "" ?>" >
                            </div>
                            <div class="col-auto date-input">
                                <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" placeholder="dd-mm-yyyy"
                                value="<?= !empty($end_date) ? date('d-m-Y', strtotime($end_date)) : "" ?>" >
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="pt-2" for="lblcanceledby">Canceled By</label>
                                    </div>
                                    <div class="col-7">
                                        <select class="form-select" name="canceledby" id="cancekedby">
                                            <option value="">--Select All--</option>
                                            <option value="B" <?php echo (set_value('canceledby')=='B')?" selected=' selected'":""?>>Admin</option>
                                            <option value="F" <?php echo (set_value('canceledby')=='F')?" selected=' selected'":""?>>Guest</option>                             
                                        </select>
                                    </div>
                                </div>
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
            <div class="app-card-body">
                <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="sports_facilities">
                        <thead>
                            <tr>
                            <th class="cell">SL No.</th>
								<th class="cell">Property Name </th>
								<th class="cell">Booking Date</th>
								<th class="cell">Booked By</th>
                                <th class="cell">Booking No</th>
								<th class="cell">Transaction ID</th>
								<th class="cell">Booking Amount Before GST</th>
								<th class="cell">GST</th>
								<th class="cell">Booking Amount After GST</th>
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
                                if(!empty($reservations)){
                                    foreach($reservations as $index => $reservation){                                       
                            ?>
                            <tr>
                                <td class="cell"><?= $index+1 ?></td>
                                <td class="cell"><?= $reservation['property_name'] ?></td>
                                <td class="cell"><?= ($reservation['booking_date'])?date('d/m/Y', strtotime($reservation['booking_date'])):"N/A" ?></td>
                                <td class="cell"><?= $reservation['booked_by'] ?></td>
                                <td class="cell"><?= $reservation['booking_no'] ?></td>
                                <td class="cell"><?= isset($reservation['txnid']) && $reservation['txnid'] != '' ? $reservation['txnid'] : '';  ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['Booking_Amount_before_GST'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['gst'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['Booking_Amount_after_GST'] ?> </td>
                                <td class="cell"><?= ($reservation['Check_In_Date'])?date('d/m/Y', strtotime($reservation['Check_In_Date'])):"N/A" ?> </td>
                                <td class="cell"><?=  ($reservation['Check_Out_Date'])?date('d/m/Y', strtotime($reservation['Check_Out_Date'])):"N/A" ?> </td>
                                <td class="cell"><?= ($reservation['booking_status']=='C')?"Cancelled": (($reservation['booking_status']=='A')?"Approved":(($reservation['booking_status']=='I')?"Initiate":"Check")) ?></td>
                                <td class="cell"><?= ($reservation['cancel_datetime_ts'])?date('d/m/Y', strtotime($reservation['cancel_datetime_ts'])): "N/A" ?> </td>
                                <td class="cell"><?= ($reservation['booking_status']=='C')?$reservation['canceled_by']:'N/A' ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['cancel_percent'] ?></td>
                                <td class="cell" style="text-align:right"><?= $reservation['actual_cancellation_Charge'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['cancel_gst_percent'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['Refund_Amount'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $reservation['amount_receivable'] ?> </td>                                
                                
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
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
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
        "ordering": false,
        "dom": 'Bfrtip',
        buttons: [{
            "extend": 'excel',
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
            'filename': 'PTA_recievable_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'PTA_recievable_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
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