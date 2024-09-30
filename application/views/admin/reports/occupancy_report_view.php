<style type="text/css">
table.dataTable.no-footer {
    border-bottom: 1px solid #e7e9ed!important;
}
table.dataTable{
border-collapse: collapse;
}
.dt-buttons{
margin-bottom: .25rem;
margin-right: .25rem;
float:right!important;
}
</style>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container">
		<div class="row g-3 mb-2 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">The State Fisheries Development Corporation Limited</h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<!--//col-->
						<div class="col-auto">
							<form method="POST">
							<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
								<div class="row g-2 justify-content-start justify-content-md-end">
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
											<a class="btn btn-secondary" href="">
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
						</div>
					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->
		</div>

		<div class="app-card app-card-settings shadow-sm mb-3">
			<div class="app-card-header p-3 mb-1">
				<div class="col-md-12 details_head">

					<h6 class="mb-0">Occupancy Rate of Rooms of different Guest Houses for the month of <span
							class="billDate"><?= !empty($start_date) ? date('F Y', strtotime($start_date)) : date('F Y') ?></span></h6>
				</div>
			</div>


			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle app-table-hover mb-0 pt-1 small" id="occupancy_table">
						<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">

							<tr>
								<th>Name of the Guest Houses</th>
								<th>Sl. No. </th>
								<th>Room&nbsp;Type </th>
								<th>Room&nbsp;Rate</th>
								<th>No. of Room</th>
								<th>No. of Bed</th>
								<th>Total No.of Bookings of that Room throughout the Month
								</th>
								<th>"Total Booking Capacity of that Room/Dormitory Beds though out the Month
									(Total No.of Rooms/Dormitory Beds X 30)"
								</th>
								<th>
									"Occupancy Rate (%)
									<div class="d-flex align-items-center">
										<span>
											Total No. of Booking (F)
											<div class=""> ____________________</div>
											Total Booking Capacity(G)"
										</span>
										<span>X&nbsp;100</span>
									</div>

								</th>

							</tr>
						</thead>
						
						<tbody>
						<?php
						$prev_line_id = $occupancyLists[0]['property_id'] ?? null;
						if(!empty($occupancyLists)){
							foreach($occupancyLists as $key => $row){
								if($row['property_id'] != $prev_line_id )
								{
									$k =0;
									$prev_line_id = $row['property_id'];
								}
								$agID_arr = explode(',', $prev_line_id);
								foreach($agID_arr as $key2 => $val){
									$k++;
								}
								//echo $k;
								//echo max($cArr);
						?>
							<tr>
								<td rowspan=""><?= $row['property_name'];?></td>
								<td><?= $k;?></td>
								<td><?= $row['accommodation_name'];?></td>
								<td>Rs.<?= $row['base_price'];?>/- </td>
								<td style="text-align:right;"><?= ($row['is_dormitory'] == 'No') ? $row['no_of_accomm'] : 0;?></td>
								<td style="text-align:right;"><?= ($row['is_dormitory'] == 'Yes') ? $row['no_of_accomm'] : 0;?></td>
								<td style="text-align:right;"><?= $row['no_of_booking_through_month'];?> </td>
								<td style="text-align:right;">
								<?php
								echo $tot_booking_capacity = ($row['no_of_accomm'] * 30);
								?>
								</td>
								<td style="text-align:right;">
								<?php
								$var = ($row['no_of_booking_through_month'] / $tot_booking_capacity);
								$occupancy_rate = ($var  * 100);
								echo number_format($occupancy_rate,2);
								?>
								</td>
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
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>
                                <th class="cell text-white text-end"></th>                                                                
                            </tr>
                        </tfoot>

					</table>
				</div>
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
    $('#occupancy_table').DataTable( {
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
            var nfpTotal = api
                .column( 3, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(String(a).replace(/\D/g, "")) + intVal(String(b).replace(/\D/g, ""));
                }, 0 );

            var oghc1Total = api
                .column( 4, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var oghc2Total = api
                .column( 5, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var odb1Total = api
                .column( 6, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var odb2Total = api
                .column( 7, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var mghcTotal = api
                .column( 8, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );			
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 3 ).footer() ).html(nfpTotal.toFixed(2));
            $( api.column( 4 ).footer() ).html(oghc1Total);
			$( api.column( 5 ).footer() ).html(oghc2Total);
			$( api.column( 6 ).footer() ).html(odb1Total);
			$( api.column( 7 ).footer() ).html(odb2Total);
			$( api.column( 8 ).footer() ).html(mghcTotal.toFixed(2));
        },*/
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
            'filename': 'Occupancy_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Occupancy_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
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
