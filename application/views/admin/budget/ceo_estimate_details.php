<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container">
			<div class="row g-3 mb-3 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Approved Estimate</h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<!--//col-->
							<div class="col-auto">
								<a class="btn app-btn-primary" href="<?= base_url(); ?>admin/budget/pending_estimate">
									Back
								</a>
							</div>
						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>

			<div class="row g-3 mb-4 align-items-center">
				<?= $this->session->flashdata('msg'); ?>
			</div>

			<!--<form action="<?= base_url(); ?>admin/budget/approval_submit" method="post" enctype="multipart/form-data">-->

				<input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">

				<input type="hidden" name="budget_header_id" class="budget_header_id" value="<?= $estimation_details['budget_header_id']; ?>">

				<div class="app-card app-card-orders-table shadow-sm mb-3">
					<div class="app-card-body px-2">
						

							<div class="row g-2">
								<div class="col-lg-4 col-sm-12 col-md-12 mb-3">
									<label for="" class="form-label">Unit <span class="asterisk"></span></label>
									<select name="" class="form-select select2" id="property_id" disabled>
									<option value="">Select Unit</option>

										<?php if(!empty($property_list)){ ?>

											<?php foreach($property_list as $property){ ?>
												<option value="<?= $property['property_id']; ?>" <?php if(!empty($estimation_details)){ if($property['property_id'] == $estimation_details['property_id']){ echo 'selected'; } } ?>><?= $property['property_name']; ?></option>
											<?php } ?>

										<?php } ?>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">Financial Year <span class="asterisk"></span></label>
									<select name="" class="form-select select2" id="financial_year" disabled>
										<option value="">Select Year</option>
										<option value="2022-2023" <?php if(!empty($estimation_details)){ if($estimation_details['financial_year'] == '2022-2023'){ echo 'selected'; } } ?>>2022-23</option>
										<option value="2023-2024" <?php if(!empty($estimation_details)){ if($estimation_details['financial_year'] == '2023-2024'){ echo 'selected'; } } ?>>2023-24</option>
										<option value="2024-2025" <?php if(!empty($estimation_details)){ if($estimation_details['financial_year'] == '2024-2025'){ echo 'selected'; } } ?>>2024-25</option>
									</select>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">Estimated Expenses for the Month of<span class="asterisk"></span></label>
									<select name="" class="form-select select2" id="billing_month" disabled>
										<option value="">Select Month</option>
										<option value="01" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '01'){ echo 'selected'; } } ?>>Jan</option>
										<option value="02" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '02'){ echo 'selected'; } } ?>>Feb</option>
										<option value="03" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '03'){ echo 'selected'; } } ?>>Mar</option>
										<option value="04" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '04'){ echo 'selected'; } } ?>>Apr</option>
										<option value="05" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '05'){ echo 'selected'; } } ?>>May</option>
										<option value="06" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '06'){ echo 'selected'; } } ?>>June</option>
										<option value="07" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '07'){ echo 'selected'; } } ?>>July</option>
										<option value="08" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '08'){ echo 'selected'; } } ?>>Aug</option>
										<option value="09" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '09'){ echo 'selected'; } } ?>>Sep</option>
										<option value="10" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '10'){ echo 'selected'; } } ?>>Oct</option>
										<option value="11" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '11'){ echo 'selected'; } } ?>>Nov</option>
										<option value="12" <?php if(!empty($estimation_details)){ if($estimation_details['expense_month'] == '12'){ echo 'selected'; } } ?>>Dec</option>
									</select>
								</div>
								<!-- <div class="col-lg-2 col-sm-12 col-md-4 mb-3">
									<label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
									<input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
								</div> -->

							</div>
						
					</div>
				</div>

				<div class="app-card app-card-settings shadow-sm mb-3 pt-2">
					<div class="app-card-body px-2 pb-4">
						<?php
							if($estimation_details['admin_approval_status'] == '1' && $estimation_details['ceo_approval_status'] == '0' && $estimation_details['md_approval_status'] == '0'){
								$appText = 'Processed By';
								$appdateText = 'Processed on';
								$appName = $estimation_details['approvar_name'];
								$appDate = date("d-m-Y", strtotime($estimation_details['approved_ts']));
							} else if($estimation_details['admin_approval_status'] == '1' && $estimation_details['ceo_approval_status'] == '1' && $estimation_details['md_approval_status'] == '0') {
								$appText = 'Approved By';
								$appdateText = 'Approved on';
								$appName = $estimation_details['cao_approvar_name'];
								$appDate = date("d-m-Y", strtotime($estimation_details['ceo_approved_ts']));
							} else if($estimation_details['admin_approval_status'] == '1' && $estimation_details['ceo_approval_status'] == '1' && $estimation_details['md_approval_status'] == '1') {
								$appText = 'Approved By';
								$appdateText = 'Approved on';
								$appName = $estimation_details['md_approvar_name'];
								$appDate = date("d-m-Y", strtotime($estimation_details['md_approved_ts']));
							} 
						?>
						<h6 class="mb-2"><span class="mainDate">Proposed Expenditure for the Month of: <?= $fYear; ?> submitted on <?= date("d-m-Y", strtotime($estimation_details['estimated_ts'])); ?></span> | <span class="mainDate"><?= $appText; ?> <?= $appName; ?></span> | <span class="mainDate"><?= $appdateText; ?> <?= $appDate; ?></span></h6>
						<div class="table-responsive">
							<table class="table align-middle table-hover" style="border:1px solid #e7e9ed;">
								<thead style="background-color: #608d5f;">
									<tr>
										<th width="" class="cell text-white">Particulars</th>
										<th width="" class="cell text-white text-end">Amount (Rs.)</th>
										<th width="" class="cell text-white">Remarks</th>
										<th width="" class="cell text-white">Download File</th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Approved Estimate</span> Amount (Rs.)</th>
										<th width="" class="cell text-white">Approve Remarks</th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Total estimate already submitted during this month</span> Amount
                                            (In Rs.)</th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Total amount already approved during this month</span> Amount
                                            (In Rs.) </th>
										<th width="" class="cell text-white text-end"><span style="display: block; font-size: 11px;">Actual Expenditure of the Previous Month</span> Amount
                                            (In Rs.)</th>										
									</tr>
								</thead>
								<tbody>

									<?php foreach($estimation_details['budget_details'] as $estimation){ ?>

										<tr>
											<td width="" class="cell fw-bold"><?= $estimation['particular_title']; ?></td>

											<td width="" class="cell text-end">
												<div class="input-group">
													<span class="input-group-text" id="basic-addon1">Rs.</span>
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount" name="" value="<?= $estimation['estimated_expence_amount']; ?>" placeholder="0.00" readonly>
													<!--<input type="hidden" name="budget_details_id[]" value="<?php //echo $estimation['budget_details_id']; ?>">-->
												</div>
											</td>											

											<td width="" class="cell">
												<div class="input-group">
													<textarea name="" id="" cols="" rows="2" class="form-control estimation_remarks" readonly><?= $estimation['estimated_remarks']; ?></textarea>
												</div>
											</td>

											<td width="" class="cell">
												<?php foreach($estimation['supportingfiles'] as $suppFile){ ?>
													<a href="<?= base_url(); ?>public/estimated_files/<?= $suppFile['file_title']; ?>" title="<?= $suppFile['file_title']; ?>" download><i class="fa fa-download"></i></a>
												<?php } ?>
											</td>

											<td width="" class="cell text-end">
												<div class="input-group">
													<span class="input-group-text" id="basic-addon1">Rs.</span>
													<input type="text" class="form-control text-end fw-bold approved_expence_amount" name="" value="<?= $estimation['approved_expence_amount']; ?>" placeholder="0.00" readonly>
												</div>
											</td>

											<td width="" class="cell">
												<div class="input-group">
													<textarea name="" id="" cols="" rows="2" class="form-control estimation_remarks" readonly><?= $estimation['approved_remarks']; ?></textarea>
												</div>
											</td>

											<td width="" class="cell">
												<div class="input-group">
													<span class="input-group-text" id="">Rs.</span>
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount_thismonth" name="" value="<?= $estimation['total_estimate_curmonth']; ?>" placeholder="0.00" readonly>
												</div>
											</td>

											<td width="" class="cell">
												<div class="input-group">
													<span class="input-group-text" id="">Rs.</span>
													<input type="text" class="form-control text-end fw-bold approved_expence_amount_thismonth" name="" value="<?= $estimation['total_approved_curmonth']; ?>" placeholder="0.00" readonly>
												</div>
											</td>

											<td width="" class="cell">
												<div class="input-group">
													<span class="input-group-text" id="">Rs.</span>
													<input type="text" class="form-control text-end fw-bold estimated_expence_amount_prevmonth" name="" value="<?= $estimation['total_actualexpendature_prevmonth']; ?>" placeholder="0.00" readonly>
												</div>
											</td>

										</tr>

									<?php } ?>
									
									<tr style="background-color: #1a4919; font-size: 1.1rem;">
										<td width="" class="cell text-white">Total</td>
										<td width="" class="cell text-white text-end total_estimated_amount_text"><?= $estimation_details['estimated_expence_total'] ?></td>
										<td colspan="2" class="cell text-white"></td>
										<td width="" class="cell text-white text-end total_approved_amount_text"><?= $estimation_details['approved_expence_total'] ?></td>
										<td class="cell text-white"></td>
										<td width="" class="cell text-white text-end total_estimated_amount_thismonth">0.00</td>
										<td width="" class="cell text-white text-end total_approved_amount_thismonth">0.00</td>
										<td width="" class="cell text-white text-end total_actual_amount_prevmonth">0.00</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<!--<div class="col-md-4">
								<label for="" class="form-label">Remarks</label>
								<textarea name="" id="" cols="" rows="4" class="form-control" readonly><?php if(!empty($estimation_details['estimation_remarks'])){ echo $estimation_details['estimation_remarks']; } ?></textarea>
							</div>
							<div class="col-md-4">
								<label for="" class="form-label">Uploaded File</label>
								
								<?php if(!empty($estimation_details['supporting_file'])){ ?>

									<?php
										$filename = $estimation_details['supporting_file'];

										$extension = pathinfo($filename, PATHINFO_EXTENSION);

										//echo "The file extension is: $extension";

										if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg'){
									?>

										<a href="<?= base_url(); ?>public/estimated_files/<?= $estimation_details['supporting_file']; ?>" download=""><img src="<?= base_url(); ?>public/estimated_files/<?= $estimation_details['supporting_file']; ?>" width="305"></a>
										

									<?php } else { ?>

										<embed src="<?= base_url(); ?>public/estimated_files/<?= $estimation_details['supporting_file']; ?>" type="application/pdf" width="305" height="305">
										
									<?php } ?>
									
								<?php } else { ?>
									<p>No Uploaded file found.</p>
								<?php } ?>
							</div>-->

                            <?php if($estimation_details['ceo_approval_status'] == '0'){ ?>

                                <div class="col-md-10">
                                    <!--<label for="" class="form-label">Remarks</label>
                                    <textarea name="" id="" cols="" rows="4" class="form-control" readonly><?php //if(!empty($estimation_details['approval_remarks'])){ echo $estimation_details['approval_remarks']; } ?></textarea>-->
                                </div>
                                <div class="col-md-1">
                                    <!--<label for="" class="form-label w-100">&nbsp;</label>
                                    <input type="submit" class="btn app-btn-primary" name="" value="Submit">-->
                                    <a href="javascript:void(0)" class="btn app-btn-primary budgetApprove" data-approvetype="1">Submit to MD</a>
                                </div>
                                <div class="col-md-1">
                                    <!--<label for="" class="form-label w-100">&nbsp;</label>
                                    <input type="submit" class="btn app-btn-danger" name="" value="Submit">-->
                                    <a href="javascript:void(0)" class="btn app-btn-danger budgetReject" data-approvetype="0">Reject</a>
                                </div>

                            <?php } ?>

						</div>
					</div>
				</div>

			<!--</form>-->

		</div>
	</div>
	<!--//app-content-->

    <input type="hidden" id="base_url" value="<?= base_url(); ?>">

<!--</div>
//app-wrapper-->

<script type="text/javascript">
	$( document ).ready(function() {


		var estimatedSum = 0;
		var approvedSum = 0;
		var actualSum = 0;

		$('td .estimated_expence_amount_thismonth').each(function() {
			
			var value = parseInt($(this).val()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				estimatedSum += value; // Add it to the sum
			}
		});

		$('td .approved_expence_amount_thismonth').each(function() {
			
			var value = parseInt($(this).val()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				approvedSum += value; // Add it to the sum
			}
		});

		$('td .estimated_expence_amount_prevmonth').each(function() {
			
			var value = parseInt($(this).val()); // Get the content of the <td> and parse it as an integer
			if (!isNaN(value)) { // Check if it's a valid number
				actualSum += value; // Add it to the sum
			}
		});

		$('.total_estimated_amount_thismonth').text(estimatedSum.toFixed(2));
		$('.total_approved_amount_thismonth').text(approvedSum.toFixed(2));
		$('.total_actual_amount_prevmonth').text(actualSum.toFixed(2));


        $(document).on('click', '.budgetApprove', function() {

            var baseUrl = $('#base_url').val();
            var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

            var budgetId = $('.budget_header_id').val();
            var approveType = $(this).data('approvetype');

            $.confirm({

                title: "Alert!!",
                content: "Are you sure to Approve details? Please check details before submit.",
                buttons: {
                    Ok: {
                        text: 'Yes',
                        btnClass: 'btn-green',
                        action: function(){  							
                            
                            $.ajax({
                                type: "POST",
                                url: baseUrl+'admin/budget/ceo_approve_reject',
                                data: {"budgetId":budgetId,"approveType":approveType,[csrfName]: csrfHash},
                                dataType: "json",
                                success: function(response) { 

                                    if(response == 1){

                                        $.confirm({

                                            title: "Alert!!",
                                            content: "Budget Successfully Approved.",
                                            buttons: {
                                                Ok: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-green',
                                                    action: function(){  							
                                                        
                                                        window.location.replace(baseUrl+"admin/budget/pending_estimate");

                                                    }
                                                }
                                            }

                                        });

                                    } else {

                                        $.confirm({

                                            title: "Alert!!",
                                            content: "Something is Wrong. Try Again!",
                                            buttons: {
                                                Ok: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-green',
                                                    action: function(){  							
                                                        
                                                        //window.location.replace(baseUrl+"pending_estimate");

                                                    }
                                                }
                                            }

                                        });

                                    }                                    
                                            
                                }
                            });

                        }
                    },
                    cancelAction: { //Close the confirmation Modal
                        text: 'No',
                        btnClass: 'btn-red',
                        action: function(){
                        
                        }
                    }
                }

            });

        });


        $(document).on('click', '.budgetReject', function() {

            var baseUrl = $('#base_url').val();
            var csrfName = $('.csrfToken').attr('name'); // Value specified in $config['csrf_token_name']
          	var csrfHash = $('.csrfToken').val(); // CSRF hash

            var budgetId = $('.budget_header_id').val();
            var approveType = $(this).data('approvetype');

            $.confirm({

                title: "Alert!!",
                content: "Are you sure to Reject details? Please check details before submit.",
                buttons: {
                    Ok: {
                        text: 'Yes',
                        btnClass: 'btn-green',
                        action: function(){  							
                            
                            $.ajax({
                                type: "POST",
                                url: baseUrl+'admin/budget/ceo_approve_reject',
                                data: {"budgetId":budgetId,"approveType":approveType,[csrfName]: csrfHash},
                                dataType: "json",
                                success: function(response) { 

                                    if(response == 1){

                                        $.confirm({

                                            title: "Alert!!",
                                            content: "Budget Successfully Rejected.",
                                            buttons: {
                                                Ok: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-green',
                                                    action: function(){  							
                                                        
                                                        window.location.replace(baseUrl+"admin/budget/pending_estimate");

                                                    }
                                                }
                                            }

                                        });

                                    } else {

                                        $.confirm({

                                            title: "Alert!!",
                                            content: "Something is Wrong. Try Again!",
                                            buttons: {
                                                Ok: {
                                                    text: 'Ok',
                                                    btnClass: 'btn-green',
                                                    action: function(){  							
                                                        
                                                        //window.location.replace(baseUrl+"pending_estimate");

                                                    }
                                                }
                                            }

                                        });

                                    }                                    
                                            
                                }
                            });

                        }
                    },
                    cancelAction: { //Close the confirmation Modal
                        text: 'No',
                        btnClass: 'btn-red',
                        action: function(){
                        
                        }
                    }
                }

            });

        });

	});
</script>


