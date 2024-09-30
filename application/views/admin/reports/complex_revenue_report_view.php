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
							<!--<a class="btn app-btn-primary" href="admin/revenue/add_daily_income">
								Add New Daily Income
							</a>-->
						</div>
					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->
		</div>

		<div class="app-card app-card-orders-table shadow-sm mb-3">
			<div class="app-card-body p-3">


				<form method="post" class="row g-2">
				<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
				   
					<div class="col-lg-8 col-sm-12 col-md-8 mb-3" data-select2-id="26">
						<label for="" class="form-label">Financial Year <span class="asterisk"></span></label>
						<select name="financial_year" class="form-select">
						<?php
						if(!empty($financial_years)){
							foreach($financial_years as $fy){
						?>
							<option value="<?= $fy['financial_year'];?>" <?= set_select('financial_year', $fy['financial_year'], isset($financialYear) && $financialYear == $fy['financial_year'] ? true : false); ?>><?= $fy['financial_year'];?></option>
						<?php
							}
						}
						?>
						</select>
					</div>

				   
					<div class="col-lg-4 col-sm-12 col-md-4 mb-3">
						<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
						<input type="submit" class="form-select btn app-btn-primary" name="search"
							value="Search">
					</div>
					
					
				</form>


			</div>

		</div>

		<div class="app-card app-card-settings shadow-sm mb-3">
			<div class="app-card-header p-3 mb-1">
				<div class="col-md-12 details_head">
					<h6 class="mb-0">Total amount of Revenue earned from guest house boking in the financial year <span class="billDate"><?php  echo getFinancialYear(date('Y-m-d', 'Y', 'y'));?></span></h6>
				</div>
			</div>


			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle app-table-hover mb-0 pt-1 small" id="complex_revenue_table">
						<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
							<tr class="text-center">
								<th>Month</th>
								<?php
								if(!empty($properties)){
									foreach($properties as $prop){
								?>
									<th><?= $prop['property_name'];?></th>
								<?php
									}
								}
								?>
								<!--<th>Grand Total</th>-->
							</tr>
						</thead>
						<tbody>
						<?php
						if(!empty($lists)){
							foreach($lists as $key => $row){
							//echo '<pre>'; print_r($row); die;
						?>
							<tr>
								<td class="text-start"><?= $key;?></td>
								<?php
								if(!empty($properties)){
									foreach($row as $rr){
								?>
									<td  class="text-end">
										<?php 
										echo $rr['total_revenue'];
										$total_revenue += $rr['total_revenue'];
										?>
									</td>
								<?php
									}
								}
								?>
								<!--<td class="text-end"></td>-->
							</tr>
						<?php
							}
						}
						?>	
							
							<?php /*?><tr class="fw-bold">
								<td class="text-start">Total</td>
								<?php
								if(!empty($properties)){
									foreach($properties as $prop){
								?>
									<th></th>
								<?php
									}
								}
								?>
								<td class="text-end">0</td>
							</tr><?php */?>
						</tbody>
						<tfoot style="background-color: #1a4919; font-size: 1.0rem;">
                            <tr>									
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
    $('#complex_revenue_table').DataTable( {
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
            var nfpTotal = api
                .column( 1, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var oghc1Total = api
                .column( 2, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var oghc2Total = api
                .column( 3, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var odb1Total = api
                .column( 4, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var odb2Total = api
                .column( 5, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var mghcTotal = api
                .column( 6, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var mghTotal = api
                .column( 7, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var aghcTotal = api
                .column( 8, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var sghcTotal = api
                .column( 9, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var kghcTotal = api
                .column( 10, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var gghcTotal = api
                .column( 11, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var sfhTotal = api
                .column( 12, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var dfhTotal = api
                .column( 13, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var nfppTotal = api
                .column( 14, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(nfpTotal.toFixed(2));
            $( api.column( 2 ).footer() ).html(oghc1Total.toFixed(2));
			$( api.column( 3 ).footer() ).html(oghc2Total.toFixed(2));
			$( api.column( 4 ).footer() ).html(odb1Total.toFixed(2));
			$( api.column( 5 ).footer() ).html(odb2Total.toFixed(2));
			$( api.column( 6 ).footer() ).html(mghcTotal.toFixed(2));
			$( api.column( 7 ).footer() ).html(mghTotal.toFixed(2));
			$( api.column( 8 ).footer() ).html(aghcTotal.toFixed(2));
			$( api.column( 9 ).footer() ).html(sghcTotal.toFixed(2));
			$( api.column( 10 ).footer() ).html(kghcTotal.toFixed(2));
			$( api.column( 11 ).footer() ).html(gghcTotal.toFixed(2));
			$( api.column( 12 ).footer() ).html(sfhTotal.toFixed(2));
			$( api.column( 13 ).footer() ).html(dfhTotal.toFixed(2));
			$( api.column( 14 ).footer() ).html(nfppTotal.toFixed(2));
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
            'filename': 'Complex_Revenue_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
			"footer": true,
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Complex_Revenue_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
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
