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
                        <h1 class="app-page-title mb-0">Feedback List</h1>
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
                                        <th class="cell">Feedback Message</th>
                                        <th class="cell">Booking No</th>
                                        <th class="cell">Mail Message</th>
                                        <th class="cell">Created On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($feedbacks)){
                                    foreach($feedbacks as $feedback) { ?>
                                    <tr>
                                        <td class="cell"><?= $feedback['customer_title'].' '.$feedback['first_name'].' '.$feedback['middle_name'].' '.$feedback['last_name'] ?></td>
                                        <td class="cell"><?= $feedback['mobile_country_code'].' '.$feedback['mobile'] ?></td>
                                        <td class="cell"><?= $feedback['provide_feedback'] ?></td>
                                        <td class="cell"><?= $feedback['booking_id'] ?></td>
                                        <td class="cell"><img src="<?= base_url() . 'public/feedback_images/' . $feedback['feedback_image'] ?>" width="20%" alt="Profile Picture" style="margin-top:10px"></td>
                                        <td class="cell"><?= date('d-m-Y H:i:s',strtotime($feedback['created_ts'])) ?></td>
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
                
<script>
 $(document).ready(function() {
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