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
					<h6 class="mb-0">Total  Amount Of Revenue (In Rupees) Earned From Sale Of Food (With & Without GST) From Different Guest House Complexes And Nalban Food Park In The Financial Year <span class="billDate"><?php  echo getFinancialYear(date('Y-m-d', 'Y', 'y'));?></span></h6>
				</div>
			</div>


			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table table-bordered align-middle app-table-hover mb-0 small pt-1" id="sale_food_table">
						<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
							<tr class="text-center">
								<th>Month</th>
								<?php
								if(!empty($cost_centers)){
									foreach($cost_centers as $cc){
								?>
									<th><?= $cc['cost_center_name'].' (With Gst)';?></th>
									<th><?= $cc['cost_center_name'].' (Without Gst)';?></th>
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
								if(!empty($cost_centers)){
									foreach($row as $rr){
								?>
									<td  class="text-end">
										<?php 
										$total_food_revenue = '';
										$total_food_revenue = round($rr['total_food_revenue']);
										echo number_format($total_food_revenue,2);
										$total_revenue += $rr['total_food_revenue'];
										?>
									</td>
									
									<td  class="text-end">
										<?php 
										echo $rr['total_food_revenue_without_gst'];
										$total_revenue_without_gst += $rr['total_food_revenue_without_gst'];
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
    $('#sale_food_table').DataTable( {
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
            var bhuriaftergstTotal = api
                .column( 1, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var bhuribeforegstTotal = api
                .column( 2, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var allfishaftergstTotal = api
                .column( 3, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var allfishbeforegstTotal = api
                .column( 4, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var baraftergstTotal = api
                .column( 5, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var barbeforegstTotal = api
                .column( 6, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var manafteregstTotal = api
                .column( 7, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var manbeforegstTotal = api
                .column( 8, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var sundariafteregstTotal = api
                .column( 9, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var sundaribeforegstTotal = api
                .column( 10, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var oceanaafteregstTotal = api
                .column( 11, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var oceanabeforegstTotal = api
                .column( 12, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var amrapaliafteregstTotal = api
                .column( 13, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var amrapalibeforegstTotal = api
                .column( 14, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var krisnaafteregstTotal = api
                .column( 15, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var krisnabeforegstTotal = api
                .column( 16, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var entry1afteregstTotal = api
                .column( 17, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var entry1beforegstTotal = api
                .column( 18, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var entry2afteregstTotal = api
                .column( 19, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var entry2beforegstTotal = api
                .column( 20, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var rsafteregstTotal = api
                .column( 21, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var rsbeforegstTotal = api
                .column( 22, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var exafteregstTotal = api
                .column( 23, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			var exbeforegstTotal = api
                .column( 24, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(bhuriaftergstTotal.toFixed(2));
            $( api.column( 2 ).footer() ).html(bhuribeforegstTotal.toFixed(2));
			$( api.column( 3 ).footer() ).html(allfishaftergstTotal.toFixed(2));
			$( api.column( 4 ).footer() ).html(allfishbeforegstTotal.toFixed(2));
			$( api.column( 5 ).footer() ).html(baraftergstTotal.toFixed(2));
			$( api.column( 6 ).footer() ).html(barbeforegstTotal.toFixed(2));
			$( api.column( 7 ).footer() ).html(manafteregstTotal.toFixed(2));
			$( api.column( 8 ).footer() ).html(manbeforegstTotal.toFixed(2));
			$( api.column( 9 ).footer() ).html(sundariafteregstTotal.toFixed(2));
			$( api.column( 10 ).footer() ).html(sundaribeforegstTotal.toFixed(2));
			$( api.column( 11 ).footer() ).html(oceanaafteregstTotal.toFixed(2));
			$( api.column( 12 ).footer() ).html(oceanabeforegstTotal.toFixed(2));
			$( api.column( 13 ).footer() ).html(amrapaliafteregstTotal.toFixed(2));
			$( api.column( 14 ).footer() ).html(amrapalibeforegstTotal.toFixed(2));
			$( api.column( 15 ).footer() ).html(krisnaafteregstTotal.toFixed(2));
			$( api.column( 16 ).footer() ).html(krisnabeforegstTotal.toFixed(2));
			$( api.column( 17 ).footer() ).html(entry1afteregstTotal.toFixed(2));
			$( api.column( 18 ).footer() ).html(entry1beforegstTotal.toFixed(2));
			$( api.column( 19 ).footer() ).html(entry2afteregstTotal.toFixed(2));
			$( api.column( 20 ).footer() ).html(entry2beforegstTotal.toFixed(2));
			$( api.column( 21 ).footer() ).html(rsafteregstTotal.toFixed(2));
			$( api.column( 22 ).footer() ).html(rsbeforegstTotal.toFixed(2));
			$( api.column( 23 ).footer() ).html(exafteregstTotal.toFixed(2));
			$( api.column( 24 ).footer() ).html(exbeforegstTotal.toFixed(2));
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
