<style type="text/css">
.dt-buttons{margin: .25rem 0;}
</style>
<!--<div class="app-wrapper">-->
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-2 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Daily Income Report List</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<!--<a class="btn app-btn-primary" href="<?php //echo base_url(); ?>admin/revenue/add_daily_income">
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
					<form action="" method="post">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
						<div class="row g-3">
							<!--<div class="col-lg-2 col-sm-12 col-md-5 mb-3">
								<label for="" class="form-label">Select Location <span class="asterisk"></span></label>
								<select name="" class="form-select select2" id="">
									<option value="">Location A</option>
									<option value="">Location B</option>
									<option value="">Location C</option>
								</select>
							</div>-->
							<div class="col-lg-4 col-sm-12 col-md-7">
								<label for="" class="form-label">Select Harbour<span class="asterisk"></span></label>
								<select name="property_id" class="form-select select2" id="property_id">
									<option value="">Select Harbour</option>

									<?php if(!empty($property_list)){ ?>

										<?php foreach($property_list as $property){ ?>
											<option value="<?= $property['property_id']; ?>" <?php if(!empty($property_id)){ if($property['property_id'] == $property_id){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
										<?php } ?>

									<?php } ?>
								</select>
							</div>
							<div class="col-lg-4 col-sm-12 col-md-7">
								<label for="" class="form-label">Select Month<span class="asterisk"></span></label>
								<input type="month" name="bill_month" class="form-control" id="bill_month" value="<?php if(!empty($bill_month)){ echo $bill_month; } ?>">
							</div>
							<div class="col-lg-4 col-sm-12 col-md-4">
								<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
								<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="app-card app-card-settings shadow-sm mb-3">
				<div class="app-card-header p-3">
					<div class="col-md-12 details_head">
						<h5 class="text-info"><span class="propName"></span> FISHING HARBOUR</h5>
						<h6 class="mb-0">DAILY INCOME REPORT FOR THE MONTH OF: <span class="billDate"><?php if(!empty($bill_month)){ echo date("M Y", strtotime($bill_month)); } ?></span></h6>
					</div>
				</div>
				<div class="app-card-body">
					<div class="table-responsive">

						<table id="revenueTable" class="table table-bordered align-middle app-table-hover mb-0 small" style="display: none;">
							<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
								<tr>
									<th rowspan="2" style="min-width: 75px;">Date</th>

									<?php foreach($head_list as $heads){ ?>
										<?php if($heads['harbour_product_id'] == '1' || $heads['harbour_product_id'] == '2'){ ?>
											<th colspan="4"><?= 'Sales '.$heads['harbour_product_name']; ?></th>
										<?php } else { ?>
											<th colspan=""><?= 'Income from '.$heads['harbour_product_name']; ?></th>
										<?php } ?>
									<?php } ?>	
									<th></th>								
									<th colspan="3">Total</th>
								</tr>
								<tr>
									<?php foreach($head_list as $heads){ ?>

										<?php if($heads['harbour_product_id'] == '1'){ ?>

											<th><?= $heads['harbour_product_name']; ?> (Quantity in <?= $heads['uom_name']; ?>)</th>
											<th><?= $heads['harbour_product_name']; ?> (Received Cash Amount (In Rs.))</th>
											<th><?= $heads['harbour_product_name']; ?> (Quantity in <?= $heads['uom_name']; ?>)</th>
											<th><?= $heads['harbour_product_name']; ?> (Credit Amount (In Rs.))</th>

										<?php } else if($heads['harbour_product_id'] == '2') { ?>

											<th><?= $heads['harbour_product_name']; ?> (Quantity in <?= $heads['uom_name']; ?>)</th>
											<th><?= $heads['harbour_product_name']; ?> (Received Cash Amount (In Rs.))</th>
											<th><?= $heads['harbour_product_name']; ?> (Quantity in <?= $heads['uom_name']; ?>)</th>
											<th><?= $heads['harbour_product_name']; ?> (Credit Amount (In Rs.))</th>
										
										<?php } else { ?>

											<th><?= $heads['harbour_product_name']; ?> (Received Cash Amount (In Rs.))</th>

										<?php } ?>

									<?php } ?>	

									<th>Recovery of Credit Sale (In Rs.)</th>
									<th>Total Received Cash Amount (In Rs.)</th>
									<th>Total Credit Amount</th>
									<th>Grand Total</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($revenue_list)){ ?>

									<?php foreach($revenue_list as $revenueL){ ?>

										<tr class="transAmounth">
											<td><?= date("d-m-Y", strtotime($revenueL['transaction_date'])); ?></td>
											<td><?php if($revenueL['total_hsd_cash_qty']){ echo $revenueL['total_hsd_cash_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_cashh"><?php if($revenueL['total_hsd_cash_amount']){ echo $revenueL['total_hsd_cash_amount']; } else { echo '0.00'; } ?></td>
											<td><?php if($revenueL['total_hsd_credit_qty']){ echo $revenueL['total_hsd_credit_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_credith"><?php if($revenueL['total_hsd_credit_amount']){ echo $revenueL['total_hsd_credit_amount']; } else { echo '0.00'; } ?></td>
											<td><?php if($revenueL['total_ice_cash_qty']){ echo $revenueL['total_ice_cash_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_cashh"><?php if($revenueL['total_ice_cash_amount']){ echo $revenueL['total_ice_cash_amount']; } else { echo '0.00'; } ?></td>
											<td><?php if($revenueL['total_ice_credit_qty']){ echo $revenueL['total_ice_credit_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_credith"><?php if($revenueL['total_ice_credit_amount']){ echo $revenueL['total_ice_credit_amount']; } else { echo '0.00'; } ?></td>

											<?php foreach($revenueL['os_product'] as $osData){ ?>

												<?php foreach($osData as $osD){ ?>

													<?php if($revenueL['transaction_date'] == $osD['transaction_date']){ ?>
														<td class="trans_cashh"><?php if($osD['total_cash_amount']){ echo $osD['total_cash_amount']; } else { echo '0.00'; } ?></td>
													<?php } ?>
												
												<?php } ?>

											<?php } ?>

											<td class="recovaryTotalh"><?php if($revenueL['total_recovary_sale_amount']){ echo $revenueL['total_recovary_sale_amount']; } else { echo '0.00'; } ?></td>

											<td class="fw-bold cashTotalh"></td>
											<td class="fw-bold creditTotalh"></td>
											<td class="fw-bold grandTotalh"></td>
										</tr>

									<?php } ?>

								<?php } else { ?>

									<tr><td colspan="17">No Data Found</td></tr>

								<?php } ?>
								
							</tbody>
							<tfoot style="border-top: 2px solid #000;">
								<tr>
									<!--<th></th>	
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>-->
									<?php $totalCC = count($head_list)+6; ?>
									<?php for($cc=1;$cc<=$totalCC;$cc++){ ?>
										<th></th>
									<?php } ?>
									
									<th>Total Amount (In Rs.)</th>
									<th class="grandrecoveryTotalh"></th>
									<th class="grandcashTotalh"></th>
									<th class="grandcreditTotalh"></th>
									<th class="grandgrandTotalh"></th>
								</tr>
							</tfoot>
						</table>

						<table id="" class="table table-bordered align-middle app-table-hover mb-0 small">
							<thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
								<tr>
									<th rowspan="2" style="min-width: 75px;">Date</th>

									<?php foreach($head_list as $heads){ ?>
										<?php if($heads['harbour_product_id'] == '1' || $heads['harbour_product_id'] == '2'){ ?>
											<th colspan="4"><?= 'Sales '.$heads['harbour_product_name']; ?></th>
										<?php } else { ?>
											<th colspan=""><?= 'Income from '.$heads['harbour_product_name']; ?></th>
										<?php } ?>
									<?php } ?>	
									<th></th>								
									<th colspan="3">Total</th>
								</tr>
								<tr>
									<?php foreach($head_list as $heads){ ?>

										<?php if($heads['harbour_product_id'] == '1'){ ?>

											<th>Quantity in <?= $heads['uom_name']; ?></th>
											<th>Received Cash Amount (In Rs.)</th>
											<th>Quantity in <?= $heads['uom_name']; ?></th>
											<th>Credit Amount (In Rs.)</th>

										<?php } else if($heads['harbour_product_id'] == '2') { ?>

											<th>Quantity in <?= $heads['uom_name']; ?></th>
											<th>Received Cash Amount (In Rs.)</th>
											<th>Quantity in <?= $heads['uom_name']; ?></th>
											<th>Credit Amount (In Rs.)</th>
										
										<?php } else { ?>

											<th>Received Cash Amount (In Rs.)</th>

										<?php } ?>

									<?php } ?>	

									<th style="background: #673AB7;">Recovery of Credit Sale (In Rs.)</th>
									<th style="background: #3F51B5;">Received Cash Amount (In Rs.)</th>
									<th style="background: #2196F3;">Credit Amount</th>
									<th style="background: #03A9F4;">Grand Total</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($revenue_list)){ ?>

									<?php foreach($revenue_list as $revenueL){ ?>

										<tr class="transAmount">
											<td><?= date("d-m-Y", strtotime($revenueL['transaction_date'])); ?></td>
											<td><?php if($revenueL['total_hsd_cash_qty']){ echo $revenueL['total_hsd_cash_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_cash"><?php if($revenueL['total_hsd_cash_amount']){ echo $revenueL['total_hsd_cash_amount']; } else { echo '0.00'; } ?></td>
											<td><?php if($revenueL['total_hsd_credit_qty']){ echo $revenueL['total_hsd_credit_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_credit"><?php if($revenueL['total_hsd_credit_amount']){ echo $revenueL['total_hsd_credit_amount']; } else { echo '0.00'; } ?></td>
											<td><?php if($revenueL['total_ice_cash_qty']){ echo $revenueL['total_ice_cash_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_cash"><?php if($revenueL['total_ice_cash_amount']){ echo $revenueL['total_ice_cash_amount']; } else { echo '0.00'; } ?></td>
											<td><?php if($revenueL['total_ice_credit_qty']){ echo $revenueL['total_ice_credit_qty']; } else { echo '0.000'; } ?></td>
											<td class="trans_credit"><?php if($revenueL['total_ice_credit_amount']){ echo $revenueL['total_ice_credit_amount']; } else { echo '0.00'; } ?></td>

											<?php foreach($revenueL['os_product'] as $osData){ ?>

												<?php foreach($osData as $osD){ ?>

													<?php if($revenueL['transaction_date'] == $osD['transaction_date']){ ?>
														<td class="trans_cash"><?php if($osD['total_cash_amount']){ echo $osD['total_cash_amount']; } else { echo '0.00'; } ?></td>
													<?php } ?>
												
												<?php } ?>

											<?php } ?>

											<td class="recovaryTotal"><?php if($revenueL['total_recovary_sale_amount']){ echo $revenueL['total_recovary_sale_amount']; } else { echo '0.00'; } ?></td>

											<td class="fw-bold cashTotal"></td>
											<td class="fw-bold creditTotal"></td>
											<td class="fw-bold grandTotal"></td>
										</tr>

									<?php } ?>

								<?php } else { ?>

									<tr><td colspan="19">No Data Found</td></tr>

								<?php } ?>
								
							</tbody>
							<tfoot style="border-top: 2px solid #000;">
							
								<tr>
									<th colspan="<?= count($head_list)+7; ?>" rowspan="2">
										Total Amount (In Rs.) <span class="mainDate"><?php if(!empty($bill_month)){ echo 'for the Month '.date("M Y", strtotime($bill_month)); } ?></span><br> (Recovery of Credit Sale Amount + Received Cash Amount + Credit Amount + Grand Total)
									</th>
									<th class="grandrecoveryTotal"></th>
									<th class="grandcashTotal"></th>
									<th class="grandcreditTotal"></th>
									<th class="grandgrandTotal"></th>
								</tr>
							</tfoot>
						</table>						
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--//app-content-->


<!--</div>
//app-wrapper-->

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<script type="text/javascript">
	$( document ).ready(function() {

		var selectedpropertyName = $('#property_id :selected').text();
		$('.propName').text(selectedpropertyName);
		
		
		$(document).on('change', '#property_id', function() {

			var propertyName = $('#property_id :selected').text();

			$('.propName').text(propertyName);
		
		});


		$(document).on('change', '#bill_month', function() {

			var billingDate = moment($(this).val()).format('MMM YYYY');

			$('.billDate').text(billingDate);
			$('.mainDate').text('for the Month '+billingDate);
		
		});


		$(".transAmount").each(function () {
			var transcashSum = 0;
			var transcreditSum = 0;
			var transgrandsum = 0;

			$(this).find("td.trans_cash").each(function () {
				var cashcellValue = parseFloat($(this).text());
				if (!isNaN(cashcellValue)) {
					transcashSum += cashcellValue;
				}
			});

			$(this).find("td.trans_credit").each(function () {
				var creditcellValue = parseFloat($(this).text());
				if (!isNaN(creditcellValue)) {
					transcreditSum += creditcellValue;
				}
			});			

			$(this).find("td.cashTotal").text(transcashSum.toFixed(2));
			$(this).find("td.creditTotal").text(transcreditSum.toFixed(2));
			$(this).find("td.grandTotal").text((transcashSum + transcreditSum).toFixed(2));
			
		});


		//Total Sum Calculation
		var cashSum = 0;
		var creditSum = 0;
		var grandSum = 0;
		var recovarySum = 0;

		$('td.cashTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				cashSum += value; // Add it to the sum
			}
		});

		$('td.creditTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				creditSum += value; // Add it to the sum
			}
		});

		$('td.grandTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				grandSum += value; // Add it to the sum
			}
		});

		$('td.recovaryTotal').each(function() {
			var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				recovarySum += value; // Add it to the sum
			}
		});

		$('.grandcashTotal').text(cashSum.toFixed(2));
		$('.grandcreditTotal').text(creditSum.toFixed(2));
		$('.grandgrandTotal').text(grandSum.toFixed(2));

		$('.grandrecoveryTotal').text(recovarySum.toFixed(2));


		//For Hidden Table
		$(".transAmounth").each(function () {
			var transcashSumh = 0;
			var transcreditSumh = 0;
			var transgrandsumh = 0;

			$(this).find("td.trans_cashh").each(function () {
				var cashcellValueh = parseFloat($(this).text());
				if (!isNaN(cashcellValueh)) {
					transcashSumh += cashcellValueh;
				}
			});

			$(this).find("td.trans_credith").each(function () {
				var creditcellValueh = parseFloat($(this).text());
				if (!isNaN(creditcellValueh)) {
					transcreditSumh += creditcellValueh;
				}
			});			

			$(this).find("td.cashTotalh").text(transcashSumh.toFixed(2));
			$(this).find("td.creditTotalh").text(transcreditSumh.toFixed(2));
			$(this).find("td.grandTotalh").text((transcashSumh + transcreditSumh).toFixed(2));
			
		});


		//Total Sum Calculation
		var cashSumh = 0;
		var creditSumh = 0;
		var grandSumh = 0;
		var recovarySumh = 0;

		$('td.cashTotalh').each(function() {
			var valueh = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(valueh)) { // Check if it's a valid number
				cashSumh += valueh; // Add it to the sum
			}
		});

		$('td.creditTotalh').each(function() {
			var valueh = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(valueh)) { // Check if it's a valid number
				creditSumh += valueh; // Add it to the sum
			}
		});

		$('td.grandTotalh').each(function() {
			var valueh = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(valueh)) { // Check if it's a valid number
				grandSumh += valueh; // Add it to the sum
			}
		});

		$('td.recovaryTotalh').each(function() {
			var valueh = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(valueh)) { // Check if it's a valid number
				recovarySumh += valueh; // Add it to the sum
			}
		});

		$('.grandcashTotalh').text(cashSumh.toFixed(2));
		$('.grandcreditTotalh').text(creditSumh.toFixed(2));
		$('.grandgrandTotalh').text(grandSumh.toFixed(2));

		$('.grandrecoveryTotalh').text(recovarySumh.toFixed(2));


		var today = new Date();

		$('#revenueTable').DataTable( {		
			"bInfo": false,
			"ordering": false,
			"bPaginate": false,
			"dom": 'Bfrtip',
			buttons: [{
				"extend": 'excel',
				footer: true,
				"text": 'Download Excel', 
				/*exportOptions: {
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
				} , */    
				'className': 'btn app-btn-primary',
				'filename': 'Revenue_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
				},
			],
			initComplete: function() {
				var btns = $('.dt-button');
				btns.removeClass('dt-button');
			},
			"searching": false
			
		});

	});
</script>
