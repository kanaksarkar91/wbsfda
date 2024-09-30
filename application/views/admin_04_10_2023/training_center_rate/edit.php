<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit Training Center Rate Card</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="<?=base_url('admin/trainingcenterrate')?>">
                                        VIEW ALL Rate Card
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
                        <form class="settings-form" method="post" action="<?=base_url('admin/trainingcenterrate/update_rate');?>" autocomplete="off">
                        <input type="hidden" class="form-control" name="trainingcenter_rate_id" value="<?=$trainingcenter_rate['trainingcenter_rate_id']?>">
                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="" class="form-label me-3">User Type: For the</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="user_type1" value="Employees" <?=($trainingcenter_rate['user_type']=='Employees') ? 'checked' : ''?>>
                                        <label class="form-check-label" for="user_type1">Employees & Family Members</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="user_type2" value="Non-employees" <?=($trainingcenter_rate['user_type']=='Non-employees') ? 'checked' : ''?>>
                                        <label class="form-check-label" for="user_type2">Non - Employees</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Registration Fee (INR) :<span class="asterisk"> *</span></label>
                                    <input type="text" id="registration_fee" name="registration_fee" class="form-control" value="<?=$trainingcenter_rate['registration_fee']?>" required>

                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label for="" class="form-label">Monthly Subscription Fee (INR) :<span class="asterisk"> *</span></label>
                                    <input type="text" id="monthly_subscription_fee" name="monthly_subscription_fee" class="form-control" value="<?=$trainingcenter_rate['monthly_subscription_fee']?>" required>
                                </div>
                                <div class="col-sm-12 col-md-6 mb-3"> 
                                    <label for="" class="form-label">Effective for<span class="asterisk"> *</span></label>
                                    <select name="effective_year_id" class="form-select" id="effective_year_id" required>
                                        <option value="" selected disabled>Select Financial Year</option>
                                        <?php foreach($effective_years as $effective_year){ ?>
                                            <option value="<?=$effective_year['effective_year_id']?>"  <?=($effective_year['effective_year_id']==$trainingcenter_rate['effective_year_id']) ? 'selected': ''?>><?=$effective_year['effective_year']?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                
                            </div>

                    </div>

                    <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                    <a class="btn app-btn-danger" href="<?=base_url('admin/trainingcenterrate')?>">CANCEL</a>
                    </form>
                </div>
                <!--//app-card-body-->

            </div>
        </div>

