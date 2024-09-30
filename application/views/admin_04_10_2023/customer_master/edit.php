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

    <div class="row g-3 mb-4 align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">Edit Customer </h1>
      </div>
      <div class="col-auto">
        <div class="page-utilities">
          <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
            <!--//col-->
            <div class="col-auto">
              <a class="btn app-btn-secondary" href="list.html">
                VIEW ALL Customer
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

      <form class="settings-form" method="post" action="<?= base_url('admin/customer/updatecustomer'); ?>" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="<?php echo $this->csrf['name']; ?>" value="<?php echo $this->csrf['hash']; ?>">
		  <input type="hidden" name="customer_id" value="<?= $customer['customer_id']; ?>">

          <div class="app-card-body">
            <div class="row g-3">
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Customer Title<span class="asterisk"> *</span></label>
                <input type="text" class="form-control" name="customer_title" value="<?= $customer['customer_title'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Customer First Name <span class="asterisk"> *</span></label>
                <input type="text" class="form-control" name="first_name" value="<?= $customer['first_name'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Customer Middle Name</label>
                <input type="text" class="form-control" name="middle_name" value="<?= $customer['middle_name'] ?>">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Customer Last Name <span class="asterisk"> *</span></label>
                <input type="text" class="form-control" name="last_name" value="<?= $customer['last_name'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Date of Birth <span class="asterisk"> *</span></label>
                <input type="date" class="form-control" name="dob" value="<?= $customer['dob'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="gender" class="form-label">Gender<span class="asterisk"> *</span></label>
                <select name="gender" class="form-select" id="gender" required="">
                  <option>Select Gender</option>
                  <option value="Male" <?= ($customer['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                  <option value="Female" <?= ($customer['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                  <option value="Other" <?= ($customer['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                </select>
              </div>
              <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Profile Picture <span class="asterisk"> *</span></label>
                <input type="file" class="form-control" name="profile_pic">
              </div>
              <div class="col-lg-2 col-sm-12 col-md-6 mb-3">
                <input type="hidden" class="form-control" name="profile_pic_old" value="<?= $customer['profile_pic'] ?>">
                <img src="<?= base_url() . 'public/customer_images/' . $customer['profile_pic'] ?>" width="50%" alt="Profile Picture" style="margin-top:21px">
              </div>
              <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Country Code <span class="asterisk">* </span></label>
                <input type="text" class="form-control" name="mobile_country_code" value="<?= $customer['mobile_country_code'] ?>" required="">
              </div>
              <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Mobile No <span class="asterisk">* </span></label>
                <input type="text" class="form-control" name="mobile" value="<?= $customer['mobile'] ?>" required="">
              </div>
              <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Email <span class="asterisk">* </span></label>
                <input type="text" class="form-control" name="email" value="<?= $customer['email'] ?>" required="">
              </div>
              <div class="col-lg-12 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Address <span class="asterisk">* </span></label>
                <textarea class="form-control" name="address"><?= $customer['address'] ?></textarea>
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">City <span class="asterisk">* </span></label>
                <input type="text" class="form-control" name="city" value="<?= $customer['city'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Pin Code <span class="asterisk">* </span></label>
                <input type="text" class="form-control" name="pincode" value="<?= $customer['pincode'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="" class="form-label">Signup Date <span class="asterisk">* </span></label>
                <input type="date" class="form-control" name="signup_date" value="<?= $customer['signup_date'] ?>" required="">
              </div>
              <div class="col-lg-3 col-sm-12 col-md-6 mb-3">
                <label for="tax_status" class="form-label">Status<span class="asterisk"> *</span></label>
                <select name="is_active" class="form-select" id="is_active" required="">
                  <option value="1" <?= ($customer['is_active'] == '1') ? 'selected' : '' ?>>Active</option>
                  <option value="0" <?= ($customer['is_active'] == '0') ? 'selected' : '' ?>>Inactive</option>
                </select>
              </div>
          </div>
        </div>
          <button type="submit" class="btn app-btn-primary">SUBMIT</button>
          <a class="btn app-btn-danger" href="https://panchayet.syscentricdev.com/admin/tax">CANCEL</a>
      </form>
    </div>
    <!--//app-card-body-->

  </div>
</div>