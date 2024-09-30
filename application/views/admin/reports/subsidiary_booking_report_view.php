<style type="text/css">
table.dataTable.no-footer {
    border-bottom: 1px solid #e7e9ed!important;
}
table.dataTable{
border-collapse: collapse;
}
.dt-buttons{
margin-top: .75rem;
margin-left: .75rem;
float:left!important;
}
.dataTables_scrollFootInner{
    padding-right: 0!important;
}
</style>

    <div class="app-content pt-3 p-md-3 p-lg-3">
        <div class="container-xl">
            <div class="row g-3 mb-2 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Guest House Subsidiary Booking Report</h1>
                </div>
                <div class="col-auto">

                </div>
            </div>

            <div class="app-card app-card-settings shadow-sm p-3">
                <div class="app-card-body">
                    <form method="POST">
					<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                        <div class="row g-3">
                            <div class="col-lg-3 col-sm-12 col-md-3">
                                <label for="" class="form-label">Select Property</label>
                                <select class="form-select select2" name="property" id="property_id" required>
                                    <option value="">Select Property</option>
                                    <?php
									if (isset($properties))
										foreach ($properties as $p) {
									?>
									<option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
                            <?php /*?><div class="col-lg-3 col-sm-12 col-md-3">
                                <label for="" class="form-label">Select POS</label>
                                <select class="form-select select2" name="cost_center_id" id="cost_center_id" required>
                                    <option value="">Select POS</option>
									<?php
									if (isset($cost_centers))
										foreach ($cost_centers as $cc) {
									?>
									<option value="<?= $cc['cost_center_id']; ?>" <?= set_select('cost_center_id', $cc['cost_center_id'], isset($cost_center_id) && $cost_center_id == $cc['cost_center_id'] ? true : false); ?>><?= $cc['cost_center_name']; ?></option>
									<?php } ?>
                                </select>
                            </div><?php */?>
                            <div class="col-lg-2 col-sm-12 col-md-3">
                                <label for="" class="form-label">From</label>
                                <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($start_date) ? date('d-m-Y', strtotime($start_date)) : "" ?>">
                            </div>
							<div class="col-lg-2 col-sm-12 col-md-3">
                                <label for="" class="form-label">To</label>
                                <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" placeholder="dd-mm-yyyy" value="<?= !empty($end_date) ? date('d-m-Y', strtotime($end_date)) : "" ?>">
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-3">
                                <label for="" class="form-label w-100">&nbsp;</label>
                                <button class="btn app-btn-primary w-100" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="app-card app-card-settings shadow-sm mt-3">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table align-middle app-table-hover mb-0 pt-1 small w-100" id="collection_list">
                            <thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
                                <tr>
                                    <th>Sl.</th>
									<th>Property Name</th>
									<th>Guest Name</th>
									<th>Booking ID</th>
									<th>Transaction Date</th>
									<th>Booking Start Date</th>
									<th>Booking End Date</th>
									<th>No. of Days</th>
                                    <th class="text-end">Amount Before GST (Rs.)</th>
                                    <th class="text-end">GST (Rs.)</th>
                                    <th class="text-end">Amount After GST (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							if(!empty($pos_transaction_data)){
								foreach($pos_transaction_data as $index => $row){
							?>
								<tr>
									<td><?= $index+1 ?></td>
									<td><?= $row['property_name'];?></td>
									<td><?= $row['first_name'];?></td>
									<td><?= $row['booking_no'];?></td>
									<td><?= $row['trns_date'];?></td>
									<td><?= $row['check_in'];?></td>
									<td><?= $row['check_out'];?></td>
									<td class="text-end"><?= $row['no_of_days'];?></td>
									<td class="text-end"><?= $row['amt_before_gst'];?></td>
									<td class="text-end"><?= $row['gst'];?></td>
									<td class="text-end"><?= $row['amt_after_gst'];?></td>
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
    $('#collection_list').DataTable( {
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
            var beforegstTotal = api
                .column( 8, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var gstTotal = api
                .column( 9, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var aftergstTotal = api
                .column( 10, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 8 ).footer() ).html(beforegstTotal.toFixed(2));
            $( api.column( 9 ).footer() ).html(gstTotal.toFixed(2));
            $( api.column( 10 ).footer() ).html(aftergstTotal.toFixed(2));
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
            'filename': 'Guest_House_Subsidiary_Booking_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "footer": true,
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Guest_House_Subsidiary_Booking_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        //"searching": false
        
    } );
	
	
	$("#property_id").change(function(){ 
		var property_id = $(this).val();
		var result = '';
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/pos/getCostCenterByProperty"); ?>',
			data: {
				property_id: property_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>',
				action_type: 'pos_data'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				result +='<option value="" selected >Select POS</option>';
                //result +='<option value="all">All Accommodations</option>';
                $.each(response.list,function(key,value){
                    var selected_txt='';
                    result +='<option value="'+value.cost_center_id+'">'+value.cost_center_name+'</option>';
                });
			}
			else{
                result +='<option value="">No Data found</option>'
            }
			$("#cost_center_id").html(result);
		});
	});
	
} );
</script>
