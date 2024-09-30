<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">MY Profile</h1>
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-settings shadow-sm p-4"> 

                        <div class="app-card-body"> 
                        
                                <div class="row g-3">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Name : </label><span> <?=$user_details['full_name']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Email : </label><span> <?=$user_details['email']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Gender : </label><span> <?=$user_details['gender']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Contact No : </label><span> <?=$user_details['contact_no']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Alternate Contact No : </label><span> <?=$user_details['alternate_contact_no']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Address Line 1 : </label><span> <?=$user_details['address_line_1']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Address Line 2 : </label><span> <?=$user_details['address_line_2']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">State Name : </label><span> <?=$user_details['state_name']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">District Name : </label><span> <?=$user_details['district_name']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">City : </label><span> <?=$user_details['city']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Pincode : </label><span> <?=$user_details['pincode']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Aadhaar No : </label><span> <?=$user_details['aadhaar_no']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Pan No : </label><span> <?=$user_details['pan_no']?></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="" class="form-label">Profile Image : </label><span> <img src="https://panchayet.syscentricdev.com/public/admin_assets/images/user.png" alt="user profile" width="15%"></span>
                                    </div>
                                </div>
                           
                            </div>
                    </div>
                    <!--//app-card-body-->

                </div>
            </div>