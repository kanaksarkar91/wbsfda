<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Add New Cms</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="<?=base_url('admin/cms')?>">
                                        VIEW ALL CMS
                                    </a>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-settings shadow-sm p-4"> 
                
                    <form class="settings-form" method="post" action="<?php echo base_url('admin/cms/submitcms'); ?>" enctype="multipart/form-data" autocomplete="off">
                        
                        <div class="app-card-body"> 
                        
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Title<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="" required>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <div class="mb-3">
                                        <label for="" class="form-label">CMS Image<span class="asterisk"> *</span></label>
                                            <div class="wrap">
                                                <div class="file">
                                                    <div class="file__input" id="file__input">
                                                        <input class="file__input--file" type="file" multiple="multiple" name="cms_image" />
                                                        <label class="file__input--label" for="customFile" data-text-btn="Upload">Add file:</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <label for="" class="form-label">Description<span class="asterisk"> *</span></label>
                                        <textarea class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="description" name="description" placeholder="Place some text here"></textarea>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Meta Title<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="" required>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Meta Keyword<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="" required>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Cms Slug<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="" placeholder="Ex : Cms-Home" required>
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <label for="" class="form-label">Meta Description</label>
                                        <textarea class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="meta_description" name="meta_description" placeholder="Place some text here"></textarea>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <label for="" class="form-label me-3">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_0" value="0" checked>
                                            <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_1" value="1">
                                            <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>

                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/cms')?>">CANCEL</a>
                    </form>
                    </div>
                    <!--//app-card-body-->

                </div>
            </div>
<!-- Summernote -->
<script src="<?= base_url('public/summernote/summernote-bs4.min.js') ?>"></script>         

<script>
    $(function () {
        // Summernote
        $('.textarea').summernote({
        height: 200,
        minHeight: 200,              
        maxHeight: 600,
        })
    })
</script>
