        <div class="app-content pt-3 p-md-3 p-lg-3">
           
            <div class="container-xl">
            <?php if ($this->session->flashdata('success_msg')) : ?>
               <div class="alert alert-success">
                     <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                    <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Enquiry List</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">                               
                                <!--//col-->
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
                            <table class="table app-table-hover mb-0 text-left" id="fieldunit">
                                <thead>
                                    <tr> 
                                        <th class="cell">Customer Name</th>
                                        <th class="cell">Customer Phone</th>
                                        <th class="cell">Customer Email</th>
                                        <th class="cell">Mail Subject</th>
                                        <th class="cell">Mail Message</th>
                                        <th class="cell">Created On</th>
										<th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($enquirys)){
                                    foreach($enquirys as $enquiry) { ?>
                                    <tr>
                                        <td class="cell"><?= $enquiry['customer_name'] ?></td>
                                        <td class="cell"><?= $enquiry['customer_phone'] ?></td>
                                        <td class="cell"><?= $enquiry['customer_email'] ?></td>
                                        <td class="cell"><?= $enquiry['mail_subject'] ?></td>
                                        <td class="cell"><?= $enquiry['mail_message'] ?></td>
                                        <td class="cell"><?= date('d-m-Y H:i:s',strtotime($enquiry['created_ts'])) ?></td>
										
										<td class="cell">
										<button type="button" class="btn btn-info" style="color:white;" id="reply_button" data-enquiry_id="<?php echo $enquiry['enquiry_id'];?>" data-customer_name="<?php echo $enquiry['customer_name'];?>" data-customer_email="<?php echo $enquiry['customer_email'];?>" data-mail_subject="<?php echo $enquiry['mail_subject'];?>">Reply</button>
										</td>
                                    </tr>
                                    <?php } 
                                    }else{ ?>
                                        <tr>
                                            <td class="cell">No data Found</td>
                                        </tr>
                                   <?php } ?>
                                    
                                   
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
		
		
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
		<form class="settings-form" method="post" action="<?= base_url('admin/enquiry/reply_email'); ?>" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reply</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 15px;">
                
                    <input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="">
					<input type="hidden" class="form-control" id="customer_name" name="customer_name" value="">
					<input type="hidden" class="form-control" id="customer_email" name="customer_email" value="">
						
						<div class="row">
                            <div class="col-md-12">
                                <label for="bank_cash_ref_num" class="form-label">Subject <span class="asterisk cash_form_ref">*</span></label>
								<input type="text" class="form-control" id="reply_subject" name="reply_subject" required="required">
                            </div>
							
							<div class="col-md-12" style="margin-top:8px;">
                                <label for="bank_cash_ref_num" class="form-label">Message <span class="asterisk cash_form_ref">*</span></label>
								<textarea name="reply_message" class="form-control" rows="5" required="required"></textarea>
                            </div>
                        </div>
                    
                
            </div>
            <div class="modal-footer">
            	<button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
        </div>
		</form>

    </div>
</div>

                
<script>
 $(document).ready(function() {
    $(document).on('click', '#reply_button', function() {
	   var enquiry_id = $(this).data("enquiry_id");
	   var customer_name= $(this).data("customer_name");
	   var customer_email= $(this).data("customer_email");
	   var mail_subject= $(this).data("mail_subject");
	   $('#myModal').modal('show');
	   $('#enquiry_id').val(enquiry_id);
	   $('#customer_name').val(customer_name);
	   $('#customer_email').val(customer_email);
	   $('#reply_subject').val(mail_subject);
    });
	
	$(document).on('click', '#close_modal', function() {
	   $('#myModal').modal('hide');
    });
	
	
	
	$('#fieldunit').DataTable( {
       // "order": [[ 3, "desc" ]],
       //"paging": false,
       //"showNEntries" : false,
       //"bPaginate": false,
        //"bFilter": false,
        "bInfo": false,
       // "searching": false
        
    } );
} );
</script>