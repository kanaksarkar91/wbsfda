
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
	
        <div class="row g-3 mb-2 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Safari Booking Register</h1>
			</div>
		</div>

        <div class="app-card app-card-settings shadow-sm p-3 mb-3">
            <div class="app-card-body">
                <form method="POST">
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    <div class="row g-3">
                        
						<div class="col-lg-4 col-sm-12 col-md-4">
                            <label for="" class="form-label">Division</label>
                            <select name="division_id" id="division_id" class="form-select select2">
								<option value="0">All Division </option>
								<?php
								if ($divisions)
									foreach ($divisions as $row) {
								?>
									<option value="<?= $row['division_id']; ?>" <?php echo ($row['division_id'] == $division_id) ? 'selected' : ''; ?>><?= $row['division_name']; ?></option>
								<?php } ?>
							</select>
                        </div>
						
						<div class="col-lg-4 col-sm-12 col-md-4">
                            <label for="" class="form-label">Safari Type</label>
                            <select name="safari_type_id" id="safari_type_id" class="form-select select2">
								<option value="0">All Safari Type </option>
								<?php
								if ($safariTypes)
									foreach ($safariTypes as $row) {
								?>
									<option value="<?= $row['safari_type_id']; ?>" <?php echo ($row['safari_type_id'] == $safari_type_id) ? 'selected' : ''; ?>><?= $row['type_name']; ?></option>
								<?php } ?>
							</select>
                        </div>
						
						<div class="col-lg-4 col-sm-12 col-md-4">
                            <label for="" class="form-label">Service Definition</label>
                            <select name="safari_service_header_id" id="safari_service_header_id" class="form-select select2" required>
								<option value="0">All Service Definition </option>
								<?php
								if ($serviceDefinitions)
									foreach ($serviceDefinitions as $row) {
								?>
									<option value="<?= $row['safari_service_header_id']; ?>" <?php echo ($row['safari_service_header_id'] == $safari_service_header_id) ? 'selected' : ''; ?>><?= $row['service_definition']; ?></option>
								<?php } ?>
							</select>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-2">
                            <label for="" class="form-label">Visit Date</label>
                            <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($start_date) ? date('d-m-Y', strtotime($start_date)) : "" ?>" readonly="">
                        </div>
                        <div class="col-lg-3 col-sm-12 col-md-3 button-group">
                            <label for="" class="form-label w-100">&nbsp;</label>
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
								<th class="cell">Division/Location</th>
								<th class="cell">Safari Type</th>
								<th class="cell">Service Definition/Safari Name</th>
                                <th class="cell">Transaction / Booking Date</th>
								<th class="cell">Booking No.</th>
								<th class="cell">Visit Date</th>
								<th class="cell">Slot</th>
								<th class="cell">Visitor</th>
								<th class="cell">Contact No.</th>
								<th class="cell">Nationality</th>
								<th class="cell">Age</th>
								<th class="cell">Gender</th>
								<th class="cell">Document Type</th>
								<th class="cell">Document No.</th>
								<th class="cell">Booking Amount</th>
								<th class="cell">Current Status</th>
								<th class="cell">Cancelled by</th>
								<th class="cell">Cancelled on </th>
								<th class="cell">Cancellation Charge</th>
								<th class="cell">Refund</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($safariReservations)){
                                    foreach($safariReservations as $index => $row){
										$bookingAmt = ($row['total_price'] / $row['booking_time_visitor_count']);
										$cancelCharge = ($row['cancel_charge'] / $row['no_of_person_cancelled']);                                     
                            ?>
                            <tr>
                            	<td class="cell"><?= $index+1 ?></td>
                                <td class="cell"><?= $row['division_name'] ?></td>
                                <td class="cell"><?= $row['type_name'];?></td>
                                <td class="cell"><?= $row['service_definition'] ?></td>
                                <td class="cell"><?= ($row['created_ts_header'])?date('d/m/Y', strtotime($row['created_ts_header'])):"" ?></td>
								<td class="cell"><?= $row['booking_number'] ?></td>
								<td class="cell"><?= ($row['booking_date'])?date('d/m/Y', strtotime($row['booking_date'])):"" ?></td>
                                <td class="cell">
									<?= $row['slot_desc'] . ': ' . $row['start_time'] . ' - ' . $row['end_time']; ?>
								</td>
                                <td class="cell"><?= $row['visitor_name'] ?> </td>
								<td class="cell"><?= $row['customer_mobile'] ?> </td>
                                <td class="cell"><?= $row['cat_name'] ?> </td>
								<td class="cell"><?= $row['visitor_age'] ?> </td>
                                <td class="cell"><?= $row['visitor_gender'] ?> </td>
								<td class="cell"><?= $row['visitor_id_type'] ?> </td>
                                <td class="cell"><?= $row['visitor_id_no'] ?> </td>
                                <td class="cell text-end"><?= ($row['is_free'] == 2) ? number_format($bookingAmt,2) : '0.00';?> </td>
								<td class="cell"><?= $row['is_status'] == 1 ? '<span class="badge bg-success">Confirmed</span>' : '<span class="badge bg-danger">Cancelled</span>';?></td>
								<td class="cell"><?= $row['created_by_name'] ?> </td>
								<td class="cell"><?= ($row['cancelled_on'])?date('d/m/Y', strtotime($row['cancelled_on'])):"" ?></td>
                                <td class="cell text-end"><?= ($row['is_free'] == 2 && $row['is_status'] == 2) ? number_format($cancelCharge,2) : '';?></td>
                                <td class="cell text-end"><?= ($row['is_free'] == 2 && $row['is_status'] == 2) ? number_format($row['refunded_amount'],2) : '';?></td>
                                
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                        <!--<tfoot style="background-color: #1a4919; font-size: 1.0rem;">
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
                            </tr>
                        </tfoot>-->
                    </table>
                </div>
                <!--//table-responsive-->

            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>
<script>
 $(document).ready(function() {
    $(function() {
		$('#start_date').datepicker({ 
			//maxDate: new Date,
			dateFormat: 'dd-mm-yy',
			onSelect: function(date) {
					$("#end_date").datepicker('option', 'minDate', date);
				}
		});  
	  $( "#end_date" ).datepicker({  
		//maxDate: new Date,
		dateFormat: 'dd-mm-yy',
		onSelect: function(date) {
					$("#start_date").datepicker('option', 'maxDate', date);
				} 
		});
	});
	
	$("#safari_type_id").change(function(){ 
		getServiceDefinations();
	});
	
	
    var today = new Date();
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "scrollCollapse": 'true',
        //"scrollY": '360px',
        "scrollX": 'true',
        "bInfo": false,
        "ordering": false,
        "dom": 'Bflrtip',
        /*"footerCallback": function ( row, data, start, end, display ) {
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
        },*/
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
            'filename': 'Safari_Booking_Register_Booking_Date_Wise'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        "searching": false
        
    } );
} );

function getServiceDefinations(){
	var safari_type_id = $('#safari_type_id').val();
	var result = '';
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/safari_service_capacity/getServices"); ?>',
		data: {
			safari_type_id: safari_type_id,
			csrf_test_name: '<?= $this->csrf['hash']; ?>'
		},
		dataType: 'json',
		encode: true,
		async: false
	})
	//ajax response
	.done(function(response){
		if(response.status){
			result +='<option value="">Select Service</option>';
			$.each(response.list,function(key,value){
				result +='<option value="'+value.safari_service_header_id+'">'+value.service_definition+'</option>';
			});
		}
		else{
			result +='<option value="">No Data found</option>'
		}
		$("#safari_service_header_id").html(result);
	});
}
</script>
