<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
                
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Approved Booking List</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                        <form method="POST">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
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
                            <div class="col-auto">
                                <input type="date" class="form-control" name="start_date" 
                                    value="<?= !empty($start_date) ? date('Y-m-d', strtotime($start_date)) : "" ?>" >
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control" name="end_date" 
                                value="<?= !empty($end_date) ? date('Y-m-d', strtotime($end_date)) : "" ?>" >
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
				.dt-buttons button.buttons-csv.buttons-html5{
                    margin-top: 18px;
                    margin-left: 15px;
                }
        </style>

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="sports_facilities">
                        <thead>
                            <tr>
								<th class="cell">SL No.</th>
								<th class="cell">Action</th>
                                <th class="cell">Booking No. </th>
								<th class="cell">Transaction ID</th>
                                <th class="cell">Booking Date</th>
                                <th class="cell">Property Name</th>
                                <th class="cell">Customer Name</th>
                                <th class="cell">Customer Phone</th>
                                <th class="cell">Checkin Date</th>
                                <th class="cell">Checkout Date</th>
                                <th class="cell">Booked For</th>
								<th class="cell">Booking Source</th>
                                <th class="cell">Amount</th>
                                <th class="cell">Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($reservations)){
                                    foreach($reservations as $index => $reservation){
                            ?>
                            <tr>
                                <td class="cell"><?= $index+1 ?></td>
                                <td >
                                    <a href="<?=base_url('admin/booking/booking_details/'.$reservation->booking_id)?>" type="button" class="btn btn-info" title="Payment Details"><i class="fa fa-eye"></i></a> &nbsp;  
                                    <!-- <a href="" type="button" class="btn btn-primary" title="Edit Booking"><i class="fa fa-pencil"></i></a> &nbsp;  -->
                                    <a target="_blank" href="<?=base_url('admin/booking/downloadInvoice/'.$reservation->booking_id)?>" type="button" class="btn btn-yellow" title="Download Vowcher"><i class="fa fa-download"></i></a> &nbsp; 
                                    <?php if($reservation->booking_status != 'C'){ ?>
                                        <?php if($reservation->checked_in == 0){ ?>
                                            <a href="<?=base_url('admin/reservation/checkin/'.$reservation->booking_id)?>" type="button" class="btn btn-green">CheckIn</a>
                                        <?php } else { ?> 
                                            <a href="<?=base_url('admin/reservation/checkin_details/'.$reservation->booking_id)?>" type="button" class="btn btn-green">View CheckIn</a>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                                <td class="cell"><?= $reservation->booking_no ?></td>
								<td class="cell"><?= isset($reservation->txnid) && $reservation->txnid != '' ? $reservation->txnid : ''; ?></td>
                                <td class="cell"><?= date('d/m/Y H:i:s A', strtotime($reservation->created_ts)) ?></td>
                                <td class="cell"><?= $reservation->property_name ?> </td>
                                <td class="cell"><?= $reservation->customer_name ?> </td>
                                <td class="cell"><?= $reservation->mobile ?> </td>
                                <td class="cell"><?= date('d/m/Y', strtotime($reservation->check_in)) ?> </td>
                                <td class="cell"><?= date('d/m/Y', strtotime($reservation->check_out)) ?> </td>
                                <td class="cell"><?= $reservation->booking_for ?></td>
								<td class="cell"><?= isset($reservation->booking_source) && $reservation->booking_source == 'F' ? 'Frontend' : ($reservation->booking_source == 'B' ? 'Backend' : '') ?></td>
                                <td class="cell"><?= $reservation->net_payable_amount ?></td>                                
                                <td class="cell">
                                    <?php
                                        if($reservation->booking_status == 'I'){
                                            echo '<span class="btn btn-primary">Initiate</span>';
                                        }else if($reservation->booking_status == 'A'){
                                            echo '<span class="btn btn-green">Approved</span>';
                                        }else if($reservation->booking_status == 'C'){
                                            echo '<span class="btn btn-danger">Cancelled</span>';
                                        }else if($reservation->booking_status == 'O'){
                                            echo '<span class="btn btn-info">Check Out</span>';
                                        }
                                    ?>                                    
                                </td>
                                
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
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
        "ordering": false,
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'csv',
                text: 'Download CSV',
                exportOptions: {
                    columns: [0,2,3,4,5,6,7,8,9,10,11,12]
                }
            },
        ]
       // "searching": false
        
    } );
} );
</script>