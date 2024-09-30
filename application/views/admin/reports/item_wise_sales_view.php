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
.dataTables_scrollFootInner{
    padding-right: 0!important;
}
</style>

    <div class="app-content pt-3 p-md-3 p-lg-3">
        <div class="container-xl">
            <div class="row g-3 mb-2 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Item Wise Sales Report</h1>
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
                            <div class="col-lg-3 col-sm-12 col-md-3">
                                <label for="" class="form-label">Select POS</label>
                                <select class="form-select select2" name="cost_center_id" id="cost_center_id">
                                    <option value="">Select POS</option>
									<?php
									if (isset($cost_centers))
										foreach ($cost_centers as $cc) {
									?>
									<option value="<?= $cc['cost_center_id']; ?>" <?= set_select('cost_center_id', $cc['cost_center_id'], isset($cost_center_id) && $cost_center_id == $cc['cost_center_id'] ? true : false); ?>><?= $cc['cost_center_name']; ?></option>
									<?php } ?>
                                </select>
                            </div>
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
                <div class="app-card-header p-3">
                    <div class="col-md-12 details_head">
                        <h6 class="mb-0">Item Wise Sales Report of <span><?= $propertyData['property_name'];?></span> - <span><?= $costCenterData['cost_center_name'];?></span> - <span><?= date('d/m/Y', strtotime($start_date));?> - <?= date('d/m/Y', strtotime($end_date));?></span></h6>
                    </div>
                </div>
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table align-middle app-table-hover mb-0 pt-1 small w-100" id="item_wise_sale_list">
                            <thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
                                <tr>
                                    <th>Item Name</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-end">GST</th>
                                    <th class="text-end">Net Amount</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							if(!empty($records)){
								$qty_array = $price_array = $gst_array = $receive_array = array();
								foreach($records as $key => $val){
									
									foreach($val as $vkey => $value){
										
										if(!isset($qty_array[$value['category_id']]) && !isset($price_array[$value['category_id']]) && !isset($gst_array[$value['category_id']]) && !isset($receive_array[$value['category_id']])) {
											
											$qty_array[$value['category_id']] = $price_array[$value['category_id']] = $gst_array[$value['category_id']] = $receive_array[$value['category_id']] = 0;
										
										}
										
										$qty_array[$value['category_id']] += $value['product_qty'];
										$price_array[$value['category_id']] += $value['product_price'];
										$gst_array[$value['category_id']] += $value['product_gst'];
										$receive_array[$value['category_id']] += $value['product_total'];
									}
							?>
                                <tr style="background-color: #424242;color: #fff;">
                                    <td class="cell"><?= $key;?></td>
									<td class="cell"></td>
									<td class="cell"></td>
									<td class="cell"></td>
									<td class="cell"></td>
                                </tr>
								<?php
									foreach($records[$key] as $rkey => $row){
								?>
									<tr>
										<td><?= $row['product_name'];?></td>
										<td class="text-center">
										<?php 
											echo number_format($row['product_qty']);
											$total_qty += $row['product_qty'];
										?>
										</td>
										<td class="text-end">
										<?php 
											echo $row['product_price'];
											$total_price += $row['product_price'];
										?>
										</td>
										<td class="text-end">
										<?php 
											echo $row['product_gst'];
											$total_gst += $row['product_gst'];
										?>
										</td>
										<td class="text-end">
										<?php 
											echo number_format($row['product_total'],2);
											$all_total += $row['product_total'];
										?>
										</td>
									</tr>
								<?php
									}
								?>
								<tr>
                                    <td class="fw-bold">Total</td>
                                    <td class="text-center fw-bold"><?= $qty_array[$value['category_id']];?></td>
                                    <td class="text-end fw-bold"><?= number_format($price_array[$value['category_id']],2);?></td>
                                    <td class="text-end fw-bold"><?= number_format($gst_array[$value['category_id']],2);?></td>
                                    <td class="text-end fw-bold"><?= number_format($receive_array[$value['category_id']],2);?></td>
                                </tr>
							<?php
								}
							}
							?>
                                
                            </tbody>
                            <tfoot class="w-100" style="background-color: #1a4919; font-size: 1.0rem;color: #fff;">
                                <tr> <!-- style="background-color: #00bdd6;color: #fff;" -->
                                    <td class="cell fw-bold">Grand Total</td>
                                    <td class="cell text-center fw-bold"><?= $total_qty;?></td>
                                    <td class="cell text-end fw-bold"><?= number_format($total_price,2);?></td>
                                    <td class="cell text-end fw-bold"><?= number_format($total_gst,2);?></td>
                                    <td class="cell text-end fw-bold"><?= number_format($all_total,2);?></td>
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
    $('#item_wise_sale_list').DataTable( {
       /* "order": [[ 3, "desc" ]],
       "paging": false,
       "showNEntries" : false,
       "bPaginate": false,
        "bFilter": false, */

        "scrollCollapse": true,
        "scrollY": '448px',
        "scrollX": 'true',
        "bInfo": false,
        "ordering": false,
		"bPaginate": false,
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
            'filename': 'Item_Wise_Sales_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            },
            {
            "extend": 'csv',
            "text": 'Download CSV',
            'className': 'btn app-btn-primary',
            'filename': 'Item_Wise_Sales_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
            }
        ],
        initComplete: function() {
            var btns = $('.dt-button');
            btns.removeClass('dt-button');
        },
        "searching": false
        
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
