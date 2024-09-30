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
                <h1 class="app-page-title mb-0">Add Tender</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/tender') ?>">
                                View All Tenders 
                            </a>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>        

        <div class="app-card app-card-settings shadow-sm p-3">
            <div class="app-card-body">
                
                <form class="settings-form" method="post" action="" enctype="multipart/form-data" id="tenderAdd">
                    <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                    <div class="row g-3">
                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">Title<span class="asterisk"> *</span></label>
                            <input type="text" class="form-control" name="tender_title" placeholder="Tender Title" required>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-md-6">
                            <label for="" class="form-label">File<span class="asterisk"> *</span></label>
                            <input type="file" class="form-control" name="tender_file" placeholder="Tender File" accept="pdf" required>
                        </div>

                        <div class="col-sm-12 col-md-12">                              
                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?= base_url('admin/tender') ?>">CANCEL</a>
                        </div>
                    </div>
                </form>
                
            </div>
            <!--//app-card-body-->
        </div>
    </div>
    <!--//container-fluid-->
</div>