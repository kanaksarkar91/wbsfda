<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Bank Account Details</h1>
                    </div>
                    <!-- <div class="alert alert-success" style="display: none"></div> -->
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <input type="button" class="btn app-btn-primary" id="" value="Download Excel" onclick="exportTableToExcel('dataContent', 'PRD_Bank_Details_Report')">
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 mt-3 text-left excel_report" id="dataContent">
                                <thead>
                                    <tr>
                                        <th class="cell">Sl no</th>
                                        <th class="cell">Payment Code</th>
                                        <th class="cell">Zilla Parishad & Others</th>
                                        <th class="cell">Panchayat Samiti</th>
                                        <th class="cell">Gram Panchayat</th>
                                        <th class="cell">Property Name</th>
                                        <th class="cell">Property Owner GST Number</th>
                                        <th class="cell">Contact Person</th>
                                        <th class="cell">Mobile No.</th>
                                        <th class="cell">Email</th>
                                        <th class="cell">Bank Name</th>
                                        <th class="cell">Beneficiary Account No</th>
                                        <th class="cell">Beneficiary Account Name</th>
                                        <th class="cell">IFS Code</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									$i = 1;
									if (isset($user_property_det))
										foreach ($user_property_det as $p) {
											
									?>
                                    <tr>
                                        <td class="cell"><?= $i; ?></td>
                                        <td class="cell"><?= isset($p['payment_code']) && $p['payment_code'] != '' ? $p['payment_code'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['zilla_name']) && $p['zilla_name'] != '' ? $p['zilla_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['panchayet_name']) && $p['panchayet_name'] != '' ? $p['panchayet_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['gram_name']) && $p['gram_name'] != '' ? $p['gram_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['property_name']) && $p['property_name'] != '' ? $p['property_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['gst_no']) && $p['gst_no'] != '' ? $p['gst_no'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['contact_person_1_name']) && $p['contact_person_1_name'] != '' ? $p['contact_person_1_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['contact_person_1_mobile_no']) && $p['contact_person_1_mobile_no'] != '' ? $p['contact_person_1_mobile_no'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['contact_person_1_email']) && $p['contact_person_1_email'] != '' ? $p['contact_person_1_email'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['bank_name']) && $p['bank_name'] != '' ? $p['bank_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['bank_account_no']) && $p['bank_account_no'] != '' ? $p['bank_account_no'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['bank_account_name']) && $p['bank_account_name'] != '' ? $p['bank_account_name'] : '-'; ?></td>
                                        <td class="cell"><?= isset($p['bank_ifsc_code']) && $p['bank_ifsc_code'] != '' ? $p['bank_ifsc_code'] : '-'; ?></td>
                                    </tr>
									<?php 
										$i++;
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
<script>
$(document).ready(function() {
	$("#excelBtn").click(function (e) {
		window.open('data:application/vnd.ms-excel,' + $('#dataContent').html());
		e.preventDefault();
	});
	
	$('#dataContent').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : true,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
        
    } );
	
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