<div class="app-content pt-3 p-md-3 p-lg-3">
           
    <div class="container-xl">

        <?php if ($this->session->flashdata('success_msg')) : ?>
            <div class="alert alert-success">
                <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('success_msg') ?>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('error_msg')) : ?>
            <div class="alert alert-danger">
                <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('error_msg') ?>
            </div>
        <?php endif ?>

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Tender List</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                        <?php
                            if(check_user_permission($menu_id, 'add_flag')){
                        ?>
                            <a class="btn app-btn-primary" href="<?= base_url('admin/tender/add_tender') ?>">
                                ADD Tender 
                            </a>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>        

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left" id="table_tender">
                        <thead>
                            <tr>
                                <th class="cell">SL No.</th>
                                <th class="cell">Title</th>
                                <th class="cell">Uploaded On</th>
                                <th class="cell" style="width:45px;">View</th>
                                <th class="cell" style="width:80px;">Download</th>
                                <th class="cell" style="width:60px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($tender_list)){ ?>

                                <?php $i = 1; ?>
                                <?php foreach($tender_list as $tender){ ?>
                                    <tr>
                                        <td class="cell"><?= $i; ?></td>
                                        <td class="cell"><?= $tender['tender_title']; ?></td>
                                        <td class="cell"><?= date("d/m/Y", strtotime($tender['created_ts'])); ?></td>
                                        <td class="cell"><a href="<?= base_url(); ?>public/tender_images/<?= $tender['tender_file']; ?>" target="_blank" class="bg-info p-1 rounded text-white"><i class="fa fa fa-eye"></i> View</a></td>
                                        <td class="cell"><a href="<?= base_url(); ?>public/tender_images/<?= $tender['tender_file']; ?>" target="_blank" class="bg-success p-1 rounded text-white" download><i class="fa fa-download"></i> Download</a></td>
                                        <td class="cell"><a href="<?= base_url(); ?>admin/tender/delete_tender/<?= $tender['tender_id']; ?>" class="bg-danger p-1 rounded text-white deleteTender"><i class="fa fa fa-eye"></i> Delete</a></td>
                                    </tr>

                                    <?php $i++; ?>

                                <?php } ?>

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

        $('#table_tender').DataTable( {
            // "order": [[ 3, "desc" ]],
            //"paging": false,
            //"showNEntries" : false,
            //"bPaginate": false,
                //"bFilter": false,
                "bInfo": false,
            // "searching": false
            
        });

        $(document).on('click', '.deleteTender', function(e) {

            e.preventDefault();

            var getUrl = $(this).attr('href');

            $.confirm({

                title: "Alert!!",
                content: "Are you sure to delete tender?",
                buttons: {
                    Ok: {
                        text: 'Yes',
                        btnClass: 'btn-green',
                        action: function(){  							
                            window.location.href = getUrl; 
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

        setTimeout(function() {
            $('.alert').slideUp();
        }, 2500);

    });
</script>