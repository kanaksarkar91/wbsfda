<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">List of Payment Failed Reservation List</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                        <form method="POST">
						<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <!--//col--> 
                            <div class="col-auto">
                                <input type="date" class="form-control" name="start_date" id="start_date" 
                                    value="<?= !empty($start_date) ? date('Y-m-d', strtotime($start_date)) : "" ?>" required>
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control" name="end_date" id="end_date"
                                value="<?= !empty($end_date) ? date('Y-m-d', strtotime($end_date)) : "" ?>" required>
                            </div>
                            <div class="col-auto">
                                <button class="btn app-btn-primary">
                                    Search
                                </button>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-secondary" href="">
                                    Reset
                                </a>
                            </div>
                            <!--//col--> 
                            <!-- <div class="col-auto">
                                <a class="btn app-btn-primary" href="add.html">
                                    Download Excel
                                </a>
                            </div> -->
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
                            	<!--<th class="cell">Action</th>-->
                                <th class="cell">Booking No. </th>
                                <th class="cell">Transaction ID </th>
                                <th class="cell">Booking Date</th>
                                <th class="cell">Property Name</th>
								<th class="cell">Accommodation Name</th>
                                <th class="cell">Customer Name</th>
                                <th class="cell">Customer Phone</th>
                                <th class="cell">Checkin Date</th>
                                <th class="cell">Checkout Date</th>
                                <th class="cell">Booking source</th>
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
                                <?php /*?><td >
                                    <a href="<?=base_url('admin/reservation/failed_restored/'.$reservation->booking_id)?>" type="button" class="btn btn-info" title="Confirm Payment"><i class="fa fa-inr"></i></a> &nbsp;  

                                </td><?php */?>
                                <td class="cell"><?= $reservation->booking_no ?></td>
                                <td class="cell"><?= $reservation->txnid ?></td>
                                <td class="cell"><?= date('d/m/Y H:i:s A', strtotime($reservation->created_ts)) ?></td>
                                <td class="cell"><?= $reservation->property_name ?> </td>
								<td class="cell"><?= $reservation->accommodation_name ?> </td>
                                <td class="cell"><?= $reservation->customer_name ?> </td>
                                <td class="cell"><?= $reservation->mobile ?> </td>
                                <td class="cell"><?= date('d/m/Y', strtotime($reservation->check_in)) ?> </td>
                                <td class="cell"><?= date('d/m/Y', strtotime($reservation->check_out)) ?> </td>
                                <td class="cell"><?= ($reservation->booking_source == 'F')?'Frontend':'Backend' ?></td>
                                <td class="cell"><?= $reservation->net_payable_amount ?></td>                                
                                <td class="cell">
                                    <?php
                                        if($reservation->booking_status == 'I'){
                                            echo '<span class="btn btn-primary">Initiate </span>';
                                        }else if($reservation->booking_status == 'A'){
                                            echo '<span class="btn btn-success">Approved </span>';
                                        }else if($reservation->booking_status == 'C'){
                                            echo '<span class="btn btn-danger">Cancelled </span>';
                                            
                                            echo ($reservation->is_refunded == 1)?'<span class="btn btn-success">Refunded </span>':'<span class="btn btn-warning">Refund in process</span>'; 

                                        }else if($reservation->booking_status == 'O'){
                                            echo '<span class="btn btn-info">Check Out </span>';
                                        }else if($reservation->booking_status == 'F'){
                                            echo '<span class="btn btn-info">Payment Failed</span>';
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
    
	var start_date = document.getElementById('start_date');
	var end_date = document.getElementById('end_date');

	start_date.addEventListener('change', function() {
		if (start_date.value)
			end_date.min = start_date.value;
	}, false);
	end_date.addEventListener('change', function() {
		if (end_date.value)
			start_date.max = end_date.value;
	}, false);
	
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