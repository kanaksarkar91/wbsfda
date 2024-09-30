<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
	
	<?php if ($this->session->flashdata('success_msg')) : ?>
	   <div class="alert alert-success">
			 <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">x</a>
			<?= $this->session->flashdata('success_msg') ?>
		</div>
	<?php endif ?>
	<?php if ($this->session->flashdata('error_msg')) : ?>
		<div class="alert alert-danger">
			<a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">x</a>
			<?= $this->session->flashdata('error_msg') ?>
		</div>
	<?php endif ?>
	
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Reservation List</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                        <form method="POST">
						<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <!--//col--> 
							<div class="col-auto">
                                <label for="" class="form-label">Property</label>
								<select name="property_id" class="form-select select2" id="property_id">                               
                                    <option value="0">All Property</option>
                                    <?php
                                    if ($property_details)
                                        foreach($property_details as $row) {
                                    ?>
                                    <option value="<?= $row['property_id']; ?>" <?= set_select('property_id', $row['property_id'], isset($d_property_id) && $d_property_id == $row['property_id'] ? true : false); ?>><?= $row['property_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-auto">
								<label for="" class="form-label">Check-In From</label>
                                <input type="date" class="form-control" name="start_date" 
                                    value="<?= !empty($start_date) ? date('Y-m-d', strtotime($start_date)) : "" ?>" required>
                            </div>
                            <div class="col-auto">
                                <label for="" class="form-label">Check-In To</label>
								<input type="date" class="form-control" name="end_date" 
                                value="<?= !empty($end_date) ? date('Y-m-d', strtotime($end_date)) : "" ?>" required>
                            </div>
                            <div class="col-auto" style="padding-top:28px;">
                                <button class="btn app-btn-primary">
                                    Search
                                </button>
                            </div>
                            <div class="col-auto" style="padding-top:28px;">
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
                /*.dt-buttons button.buttons-csv.buttons-html5{
                    margin-top: 18px;
                    margin-left: 15px;
                }*/
        </style>

        <div class="app-card app-card-orders-table shadow-sm mb-5 mt-5">
            <div class="app-card-body">
                <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="reservation_list_table">
                        <thead>
                            <tr>
                            	<th class="cell">SL No.</th>
                            	<th class="cell notexport">Action</th>
                                <th class="cell">Booking No. </th>
                                <th class="cell">Transaction ID </th>
                                <th class="cell">Booking Date</th>
                                <th class="cell">Property Name</th>
								<th class="cell">Accommodation Name</th>
                                <th class="cell">Customer Name</th>
                                <th class="cell">Customer Phone</th>
								<th class="cell">Designation</th>
								<th class="cell">Remarks</th>
                                <th class="cell">Checkin Date</th>
                                <th class="cell">Checkout Date</th>
                                <th class="cell">Booking source</th>
                                <th class="cell">Amount</th>
                                <th class="cell notexport">Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($reservations)){
								//echo '<pre>'; print_r($reservations); die;
                                    foreach($reservations as $index => $reservation){
                            ?>
                            <tr>
                                <td class="cell"><?= $index+1 ?></td>
                                <td >
                                <div class="btn-group dropend">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li style="background: #C5E1A5;">
                                        <a href="<?=base_url('admin/booking/booking_details/'.$reservation->booking_id)?>" type="button" class="dropdown-item" title="Payment Details">Payment</a>
                                    </li>
                                    <?php
									if($reservation->checked_in == 0){
									?> 
                                     <li style="background: #D7CCC8;"><a href="<?=base_url('admin/reservation/edit_booking/'.$reservation->booking_id)?>" type="button" class="dropdown-item" title="Edit Booking">Change Room</a></li>
									 <?php
									 }
									 ?>
									 
									 <li style="background: #b3e5fc;"><a target="_blank" href="<?=base_url('admin/booking/viewBookingSlip/'.encode_url($reservation->booking_id))?>" type="button" class="dropdown-item" title="Download">Download&nbsp;Booking&nbsp;Slip</a></li>
									 
									 <li style="background: #b3e5fc;"><a target="_blank" href="<?=base_url('admin/booking/viewPaymentDetails/'.encode_url($reservation->booking_id))?>" type="button" class="dropdown-item" title="Download">Download&nbsp;Payment&nbsp;Details</a></li>
									 
									 
                                    <?php
									 if($reservation->booking_status == 'O'){
									 ?>
                                    <li style="background: #B2EBF2;"><a target="_blank" href="<?=base_url('admin/booking/downloadInvoice/'.encode_url($reservation->booking_id))?>" type="button" class="dropdown-item" title="Download">Download&nbsp;Tax&nbsp;Invoice</a></li>
									<?php
									}
									//if($reservation->booking_status == 'A'){
									?>
									<?php /*?><li style="background: #b3e5fc;"><a target="_blank" href="<?=base_url('admin/booking/viewBookingSlip/'.encode_url($reservation->booking_id))?>" type="button" class="dropdown-item" title="Download">Download&nbsp;Booking&nbsp;Slip</a></li><?php */?>
									<?php
									//}
									?>
                                    <?php if($reservation->booking_status == 'A'){ ?>
                                        <?php 
										if($reservation->checked_in == 0){
											if((date('Y-m-d') >= $reservation->check_in) && (date('Y-m-d') <= $reservation->check_out)){
										?>
                                            <li style="background: #FFECB3;"><a href="<?=base_url('admin/reservation/checkin/'.$reservation->booking_id)?>" type="button" class="dropdown-item">Check-In</a></li>
                                        <?php
											}
											else{
										?>
											<li style="background: #FFECB3;"><a href="#" type="button" class="dropdown-item checkin_button_alert" data-checkin_date="<?= date('d/m/Y', strtotime($reservation->check_in));?>">Check-In</a></li>
										<?php
											}
										} 
										else { 
										?> 
                                            <li style="background: #FFECB3;"><a href="<?=base_url('admin/reservation/checkin_details/'.$reservation->booking_id)?>" type="button" class="dropdown-item">View CheckIn</a></li>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                    </ul>
                                </div>
                                    <!-- <a href="<?=base_url('admin/booking/booking_details/'.$reservation->booking_id)?>" type="button" class="btn btn-info" title="Payment Details">Action</a> &nbsp;
									<?php
									if($reservation->checked_in == 0){
									?> 
                                     <a href="<?=base_url('admin/reservation/edit_booking/'.$reservation->booking_id)?>" type="button" class="btn btn-primary" title="Edit Booking"><i class="fa fa-pencil"></i></a> &nbsp;
									 <?php
									 }
									 ?> 
									 
									 
                                    <?php
									 if($reservation->booking_status == 'O'){
									 ?>
                                    <a target="_blank" href="<?=base_url('admin/booking/downloadInvoice/'.$reservation->booking_id)?>" type="button" class="btn btn-yellow" title="Download Vowcher">Download&nbsp;Tax&nbsp;Invoice</a> &nbsp;
									<?php
									}
									if($reservation->booking_status == 'A'){
									?>
									<a target="_blank" href="<?=base_url('admin/booking/viewBookingSlip/'.encode_url($reservation->booking_id))?>" type="button" class="btn btn-yellow" title="Download Vowcher">Download&nbsp;Booking&nbsp;Slip</a> &nbsp;
									<?php
									}
									?>
                                   
								   
								    <?php if($reservation->booking_status == 'A'){ ?>
                                        <?php 
										if($reservation->checked_in == 0){
											if((date('Y-m-d') >= $reservation->check_in) && (date('Y-m-d') <= $reservation->check_out)){
										?>
                                            <a href="<?=base_url('admin/reservation/checkin/'.$reservation->booking_id)?>" type="button" class="btn btn-green">Check-In</a>
                                        <?php
											}
											else{
										?>
											<a href="#" type="button" class="btn btn-secondary checkin_button_alert" data-checkin_date="<?= date('d/m/Y', strtotime($reservation->check_in));?>">Check-In</a>
										<?php
											}
										} 
										else { 
										?> 
                                            <a href="<?=base_url('admin/reservation/checkin_details/'.$reservation->booking_id)?>" type="button" class="btn btn-green">View CheckIn</a>
                                        <?php } ?>
                                    <?php } ?> -->
                                </td>
                                <td class="cell"><?= $reservation->booking_no ?></td>
                                <td class="cell"><?= $reservation->order_id ?></td>
                                <td class="cell"><?= date('d/m/Y H:i:s A', strtotime($reservation->created_ts)) ?></td>
                                <td class="cell"><?= $reservation->property_name ?> </td>
								<td class="cell"><?= $reservation->accommodation_name ?> </td>
                                <td class="cell"><?= ($reservation->first_name != '') ? $reservation->customer_name : $reservation->company_name; ?> </td>
                                <td class="cell"><?= ($reservation->mobile != '') ? $reservation->mobile : $reservation->company_phone ?> </td>
								<td class="cell"><?= $reservation->designation ?> </td>
								<td class="cell"><?= $reservation->remarks ?> </td>
                                <td class="cell"><?= date('d/m/Y', strtotime($reservation->check_in)) ?> </td>
                                <td class="cell"><?= date('d/m/Y', strtotime($reservation->check_out)) ?> </td>
                                <td class="cell"><?= ($reservation->booking_source == 'F')?'Frontend':'Backend' ?></td>
                                <td class="cell"><?= $reservation->net_payable_amount ?></td>                                
                                <td class="cell">
                                    <?php
                                        if($reservation->booking_status == 'I'){
                                            echo '<span class="badge bg-info">Initiate </span>';
                                        }else if($reservation->booking_status == 'A'){
                                            echo '<span class="badge bg-success">Approved </span>';
                                        }else if($reservation->booking_status == 'C'){
                                            echo '<span class="badge bg-danger">Cancelled </span>';
                                            
                                            echo ($reservation->is_refunded == 1)?'<span class="badge bg-success">Refunded </span>':'<span class="badge bg-warning">Refund in process</span>'; 

                                        }else if($reservation->booking_status == 'O'){
                                            echo '<span class="badge bg-info">Check Out </span>';
                                        }else if($reservation->booking_status == 'F'){
                                            echo '<span class="badge bg-info">Payment Failed</span>';
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
    
	var today = new Date();
    $('#reservation_list_table').DataTable( {
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
            'filename': 'Reservation_List'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
				exportOptions: {
                    columns: ':visible:not(.notexport)'
                }
            },
            {
            "extend": 'csv',
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Reservation_List'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
				exportOptions: {
                    columns: ':visible:not(.notexport)'
                }
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        "searching": false
        
    } );
	
	
	$(document).on('click', '.checkin_button_alert', function(e) {
            
	e.preventDefault();
	var checkin_date= $(this).data("checkin_date");
	$.confirm({
		title: "Alert!!",
		content: "Available on : "+checkin_date,
		buttons: {
			Ok: {
				btnClass: 'btn-red',
				action: function(){
				
				}
			}
		}
	});

	});
	
	
} );
</script>