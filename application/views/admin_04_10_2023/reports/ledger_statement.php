
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
                
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Ledger Statement</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                        <form method="POST">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <!--//col--> 
							<div class="col-auto">
                                <select class="form-select select2" name="property" required>
									<option value="" selected disabled>Select Property</option>
									<?php

									if (isset($properties))
										foreach ($properties as $p) {

									?>
									<option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
									<?php } ?>
								</select>
                            </div>
                            <!--<div class="col-auto">
                                <input type="text" class="form-control" name="start_date" id="start_date" 
                                value="<?= empty($this->input->post($start_date)) || !date('d-m-Y',strtotime($this->input->post($start_date))) ?  date('d-m-Y', strtotime(date('Y-m')." -1 month")) : date('d-m-Y', strtotime($start_date)) ?>">
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" name="end_date" id="end_date" 
                                value="<?=empty($this->input->post($end_date)) || !date('d-m-Y',strtotime($this->input->post($end_date))) ? date('d-m-Y') : date('d-m-Y', strtotime($end_date)) ?>" >
                            </div>-->
                            <div class="col-auto date-input">
                                <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="dd-mm-yyyy"
                                    value="<?= !empty($start_date) ? date('d-m-Y', strtotime($start_date)) : "" ?>" >
                            </div>
                            <div class="col-auto date-input">
                                <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" placeholder="dd-mm-yyyy"
                                value="<?= !empty($end_date) ? date('d-m-Y', strtotime($end_date)) : "" ?>" >
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
                    margin-top: 18px;
                    margin-left: 15px; 
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

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="ledger_statement_tbl">
                        <thead>
                        <?php
                        if(!empty($ledger_statements)){
                            ?>
                        <tr><th colspan="7"></th></tr>
                        <tr>
                        <th class="cell" colspan="4">Account Name: <?=(!empty($ledger_statements[0]['bank_account_name']))? $ledger_statements[0]['bank_account_name']:'N/A' ?></th>
                        <th class="cell" colspan="3">Transaction Period: <?=date('d/m/Y',strtotime($start_date)) . ' - '.date('d/m/Y',strtotime($end_date)) ?></th>
                        </tr>
                        <tr>
                            <th class="cell" colspan="7">Account No.: <?=(!empty($ledger_statements[0]['bank_account_no']))? $ledger_statements[0]['bank_account_no']:'N/A' ?></th>
                        </tr>
                         <tr><th colspan="7"></th></tr>
                         <?php
                            }
                         ?>
                        <tr>                             
								<th class="cell">Property Name </th>
								<th class="cell">Transaction Date</th>
								<th class="cell">Particulars</th>
                                <!--<th class="cell">Transaction Type</th>-->
                                <th class="cell">Opening Balance</th>
								<th class="cell">Amount Receivable</th>
								<th class="cell">Amount Recieved</th>
								<th class="cell">Closing Balance</th>
								
								<!--<th class="cell">Bank Name</th>
								<th class="cell">Branch Name</th>
								<th class="cell">Bank Account No.</th>
								<th class="cell">Bank Account Name</th>
								<th class="cell">Bank IFSC code</th>
                                <th class="cell">Payment Code</th>-->						
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($ledger_statements)){
                                    foreach($ledger_statements as $index => $ledger_statement){                                       
                            ?>
                            <tr>
                            <?php
                                if($index >0){
                            ?>
                            <td class="cell"></td>   
                            <?php
                                    } else {
                            ?>
                              <td class="cell"><?= $ledger_statement['property_name'] ?></td>
                            <?php
                                 } 
                            ?>
                                <td class="cell"><?= ($ledger_statement['tran_date'])?date('d/m/Y', strtotime($ledger_statement['tran_date'])):"N/A" ?></td>
                                <td class="cell"><?= $ledger_statement['particulars'] ?> </td>
                                <!--<td class="cell"><?=($ledger_statement['tran_type']=='O')?"Opening Balance": (($ledger_statement['tran_type']=='T')?"Transactions":(($ledger_statement['tran_type']=='C')?"Closing Balance":"N/A"))  ?></td>-->
                                <td class="cell" style="text-align:right"><?= $ledger_statement['op_amt'] ?></td>
                                <td class="cell" style="text-align:right"><?= $ledger_statement['receivable_amt']  ?> </td>
                                <td class="cell" style="text-align:right"><?= $ledger_statement['received_amt'] ?> </td>
                                <td class="cell" style="text-align:right"><?= $ledger_statement['cl_amt'] ?> </td>                                
                                <!--<td class="cell"><?= $ledger_statement['bank_name'] ?> </td>
                                <td class="cell"><?=  $ledger_statement['bank_branch_name'] ?> </td>
                                <td class="cell"><?= $ledger_statement['bank_account_no'] ?></td>
                                <td class="cell"><?= $ledger_statement['bank_account_name'] ?> </td>
                                <td class="cell"><?= $ledger_statement['bank_ifsc_code'] ?> </td>
                                <td class="cell"><?= $ledger_statement['payment_code'] ?></td> -->                             
                                
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
    $('#ledger_statement_tbl').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       "showNEntries" : true,
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
            'filename': 'PTA_ledger_statement'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'PTA_ledger_statement'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
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
<!--<script>
 $(document).ready(function() {
    $('#sports_facilities').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
       "ordering": false

       // "searching": false
        
    } );
} );
</script>-->