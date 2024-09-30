<style type="text/css">
.dt-buttons{
margin-right: .25rem;
float:right!important;
}
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
                
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Cancellation List</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                        <form method="POST">
						<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
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
                            <div class="col-auto date-input">
								<input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy"
									value="<?= !empty($start_date) ? date('d-m-Y', strtotime($start_date)) : "" ?>" style="width:180px;" >
							</div>
							<div class="col-auto date-input">
								<input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" placeholder="dd-mm-yyyy"
								value="<?= !empty($end_date) ? date('d-m-Y', strtotime($end_date)) : "" ?>"  style="width:180px;">
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

       <!-- <style type="text/css">
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
                .dt-button.buttons-csv.buttons-html5{
                    font-weight: 600;
                    padding: .4rem 1rem;
                    font-size: .875rem;
                    background: #246fc9;
                    color: #fff;
                    border-color: #246fc9;
                    display: inline-block;
                    line-height: 1.5;
                    text-align: center;
                    text-decoration: none;
                    vertical-align: middle;
                    cursor: pointer;
                    border-radius: .25rem;
                }
                .dt-button.buttons-csv.buttons-html5:hover {
                    color: #fff;
                    background: #6dafff;
                    border-color: #6dafff;
                }
        </style>-->
<style type="text/css">
table.dataTable.no-footer {
    border-bottom: 1px solid #e7e9ed!important;
}
table.dataTable{
border-collapse: collapse;
}
.dt-buttons{
margin-bottom: .25rem;
}
</style>


        <div class="app-card app-card-settings shadow-sm">
			<div class="app-card-header p-3 mb-1">
				<div class="col-md-12 details_head">
					<h6 class="mb-0">DETAILS OF GUEST HOUSE BOOKING CANCELLATION (THROUGH ONLINE ) </h6>
				</div>
			</div>


			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle app-table-hover mb-0 pt-1 small" id="cancellation_detail_table">
						<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
					
							<tr>
					
								<th>S.L. NO.</th>
								<th>DATE </th>
								<th>BOOKING NO. </th>
								<th>COMPLEX </th>
								<th>NAME OF THE PARTY, CONTACT NO. </th>
								<th>FROM </th>
								<th>TO </th>
								<th>DURATION OF STAY </th>
								<th>ROOM TYPE </th>
								<th>DATE OF RECEIVING CANCELLATION APPLICATION </th>
								<th>TOTAL AMOUNT PAID AGAINST ROOM RENT (in Rs.) </th>
								<th>MONEY RECEIPT NO. /PAYMENT ID. </th>
								<th>REFUNDED REQUEST ID </th>
								<th>REFUNDED AMOUNT PAID TO THE PARTY(in Rs.) </th>
								<th>REFUNDED DATE </th>
								<th>REMARKS </th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(!empty($reservations)){
							foreach($reservations as $row){
						?>
							<tr>
								<td><?= ++$sl;?></td>
								<td><?= date('d/m/Y', strtotime($row->created_ts));?></td>
								<td><?= $row->booking_no;?></td>
								<td><?= $row->property_name;?></td>
								<td><?= $row->customer_name.', '.$row->mobile;?></td>
								<td><?= date('d/m/Y', strtotime($row->check_in));?></td>
								<td><?= date('d/m/Y', strtotime($row->check_out));?></td>
								<td style="text-align:right;"><?= daysBetween($row->check_in, $row->check_out);?></td>
								<td><?= $row->accommodation_name;?></td>
								<td><?= date('d/m/Y', strtotime($row->cancellation_date));?></td>
								<td class="text-end"><?= $row->room_payable_amount;?></td>
								<td><?= $row->txnid;?></td>
								<td><?= $row->cancel_refund_request_id;?></td>
								<td><?= $row->refunded_amount;?></td>
								<td class="text-end"><?= date('d/m/Y', strtotime($row->cancellation_date));?></td>
								<td><?= $row->cancellation_remarks;?></td>
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
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white"></th>
                            </tr>
                        </tfoot>
					</table>
				</div>
			</div>
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
			changeMonth: true,
        	changeYear: true,
			yearRange: '2023:' + new Date().getFullYear(),
			onSelect: function(date) {
					$("#end_date").datepicker('option', 'minDate', date);
				}
		});  
	  $( "#end_date" ).datepicker({  
		maxDate: new Date,
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '2023:' + new Date().getFullYear(),
		onSelect: function(date) {
					$("#start_date").datepicker('option', 'maxDate', date);
				} 
		});
	});
	
	
	
	var today = new Date();
    $('#cancellation_detail_table').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "scrollCollapse": 'true',
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
            var amountTotal = api
                .column( 10, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var refundTotal = api
                .column( 13, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 10 ).footer() ).html(amountTotal.toFixed(2));
            $( api.column( 13 ).footer() ).html(refundTotal.toFixed(2));
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
            'filename': 'Cancellation_Details'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "footer": true,
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Cancellation_Details'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
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
