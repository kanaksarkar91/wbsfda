<div class="app-content pt-3 p-md-3 p-lg-3">
           
		<div class="container-xl">
					
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">PRD Summary Report</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col--> 
						   
							 
							<div class="col-auto">
								<input type="button" class="btn app-btn-primary" id="" value="Download Excel" onclick="exportTableToExcel('dataContent', 'PRD_Unit_Summary_Report')">
							</div>
						</div>
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
			/********22/09/2022*******/
			
			.table.excel_report thead th{
				background-color: #f5f5f5;
				border-color: #ddd;
				text-align: center;
			}   
			.table.excel_report tbody td{
				text-align: center;
			} 
			.table.excel_report th.blue_bg{
				background-color: #b7dee8;
			}
			.table.excel_report th.green_bg{
				background-color: #c4d79b;
			}
			.table.excel_report tfoot th{
				background-color: #fabf8f;
				text-align: center;
			}


			.table.excel_report thead th small{
				color: rgb(255, 0, 0);
				display: block;
			} 


			
		</style>

		<div class="app-card app-card-orders-table shadow-sm mb-5">
			<div class="app-card-body">
				<div id="" class="table-responsive" >
					
					 <table class="table app-table-hover mb-0 mt-3 text-left excel_report" id="dataContent">
						<thead>
							<tr>
								<th class="cell">SL No.</th>
								<th class="cell">DISTRICT</th>
								<th class="cell">Registration of DPRDO (Y/N)</th>
								<th class="cell">Total No. of District Level Users Created </th>
								<th class="cell"> Target Total Block </th>
								<th class="cell"> Total No. of Block Level Users Created  </th>
								<th class="cell"> Target Total Gram Panchayats</th>
								<th class="cell"> Total No. of GP Level User Created  </th>
								<th class="cell"> Total No. Of Property Details Registered <small>[Other Than WBCADC and WBSRLM]</small></th>
								<th class="cell blue_bg">Total No. of Users Created under WBCADC</th>
								<th class="cell blue_bg"> Total No. Of Property Details under WBCADC Registered  </th>
								<th class="cell green_bg"> Total No. of Users Created under WBSRLM </th>
								<th class="cell green_bg"> Total No. Of Property Detailsunder WBSRLM Registered </th>
							   
							</tr>
						</thead>

						<tbody>
							<?php
							$i = 1;
							$total_users = 0;
							$total_no_properties = 0;
							if (isset($report_det))
								foreach ($report_det as $r) {
							?>
								<tr>
									<td class="cell"><?= $i; ?></td>
									<td class="cell"><?= $r['district_name']; ?></td>
									<td class="cell"><?= $r['reg_of_drprd_flat']; ?></td>
									<td class="cell"><?= $r['tot_no_zilla_users']; ?></td>
									<td class="cell"><?= $r['target_no_of_block']; ?></td>
									<td class="cell"><?= $r['tot_no_block_users']; ?></td>
									<td class="cell"><?= $r['target_no_of_gram']; ?></td>
									<td class="cell"><?= $r['tot_no_of_gram_users']; ?></td>
									<td class="cell"><?= $r['tot_no_prop_regi']; ?></td>
									<td class="cell"><?= $r['tot_no_of_users_WBCADC']; ?></td>
									<td class="cell"><?= $r['tot_no_of_property_WBCADC']; ?></td>
									<td class="cell"><?= $r['tot_no_of_users_WBSRLM']; ?></td>
									<td class="cell"><?= $r['tot_no_of_property_WBSRLM']; ?></td>
								</tr>
							<?php 
									$i++;
									$total_users += intval($r['tot_no_zilla_users']) + intval($r['tot_no_block_users']) + intval($r['tot_no_of_gram_users']) + intval($r['tot_no_of_users_WBCADC']) + intval($r['tot_no_of_users_WBSRLM']);
									$total_no_properties += intval($r['tot_no_prop_regi']) + intval($r['tot_no_of_property_WBCADC']) + intval($r['tot_no_of_property_WBSRLM']);
								} 
							?>
							<tr>
								<th class="cell green_bg">&nbsp;</th>
								<th class="cell green_bg" colspan="6">Total no of users :  <span><?= $total_users; ?></span></th>
								<th class="cell green_bg" colspan="6">Total no of properties: <span><?= $total_no_properties; ?></span>	</th>
							</tr>
						</tfoot>
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
	$("#excelBtn").click(function (e) {
		window.open('data:application/vnd.ms-excel,' + $('#dataContent').html());
		e.preventDefault();
	});
});
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>