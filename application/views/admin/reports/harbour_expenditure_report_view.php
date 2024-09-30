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
		<?php if ($this->session->flashdata('success_msg')) : ?>
		   <div class="alert alert-success">
				 <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">�</a>
				<?= $this->session->flashdata('success_msg') ?>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('error_msg')) : ?>
			<div class="alert alert-danger">
				<a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">�</a>
				<?= $this->session->flashdata('error_msg') ?>
			</div>
		<?php endif ?>
            <div class="row g-3 mb-2 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Harbour Expenditure Report</h1>
                </div>
                <div class="col-auto">

                </div>
            </div>

            <div class="app-card app-card-settings shadow-sm p-3">
                <div class="app-card-body">
                    <form method="POST">
					<input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-3">
                                <label for="" class="form-label">Select Property</label>
                                <select name="property_id" class="form-control select2 property_id" id="property_id" required>
									<option value="">Select Harbour</option>
									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if(!empty($harbourId)){ if($harbourId == $property['property_id']){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>									
								</select>
                            </div>
							<div class="col-lg-2 col-sm-12 col-md-3">
                                <label for="" class="form-label">Financial Year <span class="asterisk"></span></label>
									<select name="financial_year" class="form-select select2" id="financial_year" required>
										<option value="">Select Year</option>
										<option value="2022-2023" <?php if(!empty($financial_year)){ if($financial_year == '2022-2023'){ echo 'selected'; } } ?>>2022-23</option>
										<option value="2023-2024" <?php if(!empty($financial_year)){ if($financial_year == '2023-2024'){ echo 'selected'; } } ?>>2023-24</option>
										<option value="2024-2025" <?php if(!empty($financial_year)){ if($financial_year == '2024-2025'){ echo 'selected'; } } ?>>2024-25</option>
									</select>
                            </div>
                            <div class="col-lg-2 col-sm-12 col-md-3">
                                <label for="" class="form-label">From</label>
                                <select name="month_from" class="form-select select2" required>
									<option value="">Select Month</option>
									<?php
									for ($month = 1; $month <= 12; $month++) {
										$monthName = date("F", mktime(0, 0, 0, $month, 1));
									?>
										<option value="<?= $month;?>" <?php if(!empty($month_from)){ if($month_from == $month){ echo 'selected'; } } ?>><?= $monthName;?></option>
									<?php
									}
									?>
								</select>
                            </div>
							<div class="col-lg-2 col-sm-12 col-md-3">
                                <label for="" class="form-label">To</label>
                                <select name="month_to" class="form-select select2" required>
									<option value="">Select Month</option>
									<?php
									for ($month = 1; $month <= 12; $month++) {
										$monthName = date("F", mktime(0, 0, 0, $month, 1));
									?>
										<option value="<?= $month;?>" <?php if(!empty($month_to)){ if($month_to == $month){ echo 'selected'; } } ?>><?= $monthName;?></option>
									<?php
									}
									?>
								</select>
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
                        <table class="table align-middle app-table-hover mb-0 pt-1 small w-100" id="harbour_exp_list">
                            <thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
                                <tr>
                                    <th>Sl.</th>
									<th>Harbour</th>
									<th>Particulars</th>
                                    <th class="text-end">Amount (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							if(!empty($harbour_expenditure_data)){
								foreach($harbour_expenditure_data as $index => $row){
							?>
								<tr>
									<td><?= $index+1 ?></td>
									<td><?= $row['property_name'];?></td>
									<td><?= $row['particular_title'];?></td>
									<td class="text-end expendatureTotal"><?= $row['amount'];?></td>
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
									<th class="cell text-white text-end expendaturegrandTotal"></th>
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

<!--<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">


<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.dataTables.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js" type="text/javascript"></script>-->

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
    $('#harbour_exp_list').DataTable( {
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
        "pageLength": 200,
        "scrollY":500,
        "scrollX": true,
        "scrollCollapse": true,
        "fixedHeader": {
            "header": true,
        },
        //"fixedHeader": true,
        //"paging": false,
        //"responsive": true,
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
            var monTotal = api
                .column( 3, {page:'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
                
            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 3 ).footer() ).html(monTotal.toFixed(2));
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
            'filename': 'Harbour_Expenditure_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "footer": true,
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Harbour_Expenditure_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        //"searching": false
        
    } );
	
} );
</script>
