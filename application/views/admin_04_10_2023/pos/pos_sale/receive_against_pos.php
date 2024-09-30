<link rel="stylesheet" href="<?php echo base_url('public/admin_assets/plugins/sweetalert2/sweetalert2.min.css');?>">
<style>
    #map {
  height: 400px;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}



</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">
	<?php if ($this->session->flashdata('success_msg')) : ?>
	   <div class="alert alert-success">
			 <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">�</a>
			<?php echo $this->session->flashdata('success_msg') ?>
		</div>
	<?php endif ?>
	<?php if ($this->session->flashdata('error_msg')) : ?>
		<div class="alert alert-danger">
			<a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">�</a>
			<?php echo $this->session->flashdata('error_msg') ?>
		</div>
	<?php endif ?>

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Receipt Detail </h1>
            </div>
            <div class="col-auto">
                
				<a class="btn app-btn-secondary" href="<?php echo base_url();?>admin/pos/pos_invoice_list/<?php echo encode_url($inv_det['property_id']);?>">Receivable List</a>
                
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->
		
		<div class="app-card app-card-settings shadow-sm p-3">
			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="cell">Invoice No.</th>
								<th class="cell">Table No.</th>
								<th class="cell">Receivable Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="cell"><?=$inv_det['invoice_no']?></td>
								<td class="cell"><?=$inv_det['table_no']?></td>
								<td class="cell text-end"><?=$inv_det['net_bill_amount']?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

        <div class="app-card app-card-settings shadow-sm p-3">

            <form class="settings-form" id="pos_invoice_form" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
			<input type="hidden" name="sale_order_id" value="<?php echo $sale_order_id;?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-4 mb-3">
                                <label for="" class="form-label">Receipt Date<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" id="payment_date" name="payment_date" value="<?php echo date('Y-m-d');?>" readonly="">
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4 mb-3">
                                <label for="" class="form-label">Payment Mode<span class="asterisk"> *</span></label>
                                <select class="form-select" id="payment_mode" name="payment_mode" required>
									<option value="Cash">Cash</option>
									<option value="EDC">EDC</option>
									<option value="UPI">UPI</option>
								</select>                              
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4 mb-3">
                                <label for="" class="form-label">Amount<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $inv_det['net_bill_amount'];?>" readonly="">
                            </div>
							<div class="col-lg-12 col-sm-12 col-md-12 mb-3">
                                <label for="" class="form-label">Remarks<span class="asterisk req"> </span></label>
                                <textarea class="form-control" id="remarks" name="remarks"></textarea>
                            </div>
							
                        </div>
                       
                </div>
                 <input type="hidden" name="submit" value="1"/>                               
                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script src="<?php echo base_url('public/admin_assets/plugins/sweetalert2/sweetalert2.all.min.js')?>"></script>
<script>
$(document).ready(function(){

	$(document).on('change', '#payment_mode', function() {
		var getMode = $(this).val();
		if(getMode == 'UPI'){
			$('.req').text('*');
            $('#remarks').prop('required',true);
		}
		else{
			$('.req').text('');
            $('#remarks').prop('required',false);
		}
	});
	
	
	$('#pos_invoice_form').validate({
		submitHandler:function(f){
			$.ajax({
				type:'POST',
				url: "<?php echo base_url('admin/pos/submit_pos_invoice'); ?>",
				data:$('#pos_invoice_form').serialize(),
				dataType: 'json',
				encode: true,
				async: false,
				beforeSend:function(){
					//$("#blurme").addClass("blur");
					//$("#spinner-div").show();
				 },
				success:function(d){
					if(d.success){
					
						if(d.payment_mode == 'Cash' || d.payment_mode == 'UPI'){
							$("#blurme").removeClass("blur");
							Swal.fire({
							  icon: 'success',
							  title: d.msg,
							  confirmButtonText:'Ok',
							  confirmButtonColor:'#69da68',
							  allowOutsideClick: false,
								}).then((result) => {
							  if(result.value){
									window.location.replace(d.redirect_link);
								}
							});
							
						}
						else{
							//console.log(d);
							var interval = setInterval(function()
							{ 
								$.ajax({
								  type:"POST",
								  data: {csrf_test_name: '<?php echo $this->csrf['hash']; ?>', amount: d.amount, merchantTransactionId: d.merchantTransactionId, device_id: d.device_id, transactionDateTime: d.transactionDateTime },
								  url: "<?php echo base_url('index/api_to_get_status_of_pos_bridge_notification_sent_on_paytm_device'); ?>",
								  datatype:"JSON",
								  success:function(data)
								  {
									  if(data.success){
										$("#blurme").removeClass("blur");
										//$("#spinner-div").hide();
										clearInterval(interval);
										Swal.fire({
										  icon: 'success',
										  title: data.success,
										  confirmButtonText:'Ok',
										  confirmButtonColor:'#69da68',
										  allowOutsideClick: false,
											}).then((result) => {
										  if(result.value){
												window.location.replace("<?php echo base_url('admin/ticket/add_ticket');?>");
											}
										});
										
									  }
									  else if(data.error){
										$("#blurme").removeClass("blur");
										clearInterval(interval);
										Swal.fire({
										  icon: 'error',
										  title: data.error,
										  confirmButtonText:'Ok',
										  confirmButtonColor:'#69da68',
										  allowOutsideClick: false,
											}).then((result) => {
										  if(result.value){
												window.location.replace("<?php echo base_url('admin/ticket/add_ticket');?>");
											}
										});
										
									  }
								  }
								});
							}, 10000);
						
						}
					}else if(d.error){
						$("#blurme").removeClass("blur");
						clearInterval(interval);
						Swal.fire({
						  icon: 'error',
						  title: d.msg,
						  confirmButtonText:'Ok',
						  confirmButtonColor:'#69da68',
						  allowOutsideClick: false,
							}).then((result) => {
						  if(result.value){
								window.location.replace(d.redirect_link);
							}
						});
					}else{
		
					}
				}
			});
		}
		});

});
</script>
