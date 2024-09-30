<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit Banner</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="<?=base_url('admin/banner')?>">
                                        VIEW ALL BANNERS
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

                    <div class="app-card-body">
                        <form class="settings-form" method="post" action="<?= base_url('admin/banner/updatebanner'); ?>" enctype="multipart/form-data" autocomplete="off">
                            <input class="form-check-input" type="hidden" name="banner_id" value="<?=$banner['banner_id'] ?>">
                                
                            <div class="app-card-body"> 
                            <div class="row g-3">
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Banner Title<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?=$banner['title'] ?>" required>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <div class="mb-3">
                                        <label for="" class="form-label">Banner Image<span class="asterisk"> *</span></label>
                                            <div class="wrap">
                                                <div class="file">
                                                    <div class="file__input" id="file__input">
                                                        <input class="file__input--file" type="file" multiple="multiple" name="banner_image" />
                                                        <label class="file__input--label" for="customFile" data-text-btn="Upload">Add file:</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 mb-3">
                                        <input type="hidden" class="form-control" id="old_banner_image" name="old_banner_image" value="<?=$banner['banner_image'] ?>">
                                        <img src="<?= base_url('public/admin_images/banner_images/'.$banner['banner_image']) ?>" width="100px" height="80px">
                                    </div>
                                    <div class="col-sm-12 col-md-8 mb-3">
                                        <label for="" class="form-label">Description<span class="asterisk"> *</span></label>
                                        <textarea type="text" class="form-control" id="description" name="description" required><?=$banner['description'] ?></textarea>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Banner Slug<span class="asterisk"> *</span></label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="<?=$banner['slug'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <label for="" class="form-label me-3">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_0" value="0" <?=($banner['status'] == '0') ? 'checked' : ''?>>
                                            <label class="form-check-label" for="FieldStatusRadio1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_1" value="1" <?=($banner['status'] == '1') ? 'checked' : ''?>>
                                            <label class="form-check-label" for="FieldStatusRadio2">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>

                            <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="<?=base_url('admin/banner')?>">CANCEL</a>
                        </form>
                    </div>
                    <!--//app-card-body-->

                </div>
            </div>
            <!--//container-fluid-->
        </div>