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

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit Coupon </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/CouponMaster'); ?>">
                                VIEW ALL Coupon 
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
        <div class="app-card app-card-settings shadow-sm p-3">
            <form class="settings-form" method="post" action="" id="coupon-form" enctype="multipart/form-data" autocomplete="off">
			      <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
			
              <div class="app-card-body">
                <div class="row g-3">
                  <div class="col-lg-6 col-sm-12 col-md-6">
                      <label for="coupon_code" class="form-label">Define Coupon Code <span class="asterisk"> *</span></label>
                      <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Define Coupon Code" value="<?= $coupon['coupon_code'] ?>" required>
                  </div>
                  <div class="col-lg-6 col-sm-12 col-md-6">
                      <label for="coupon_desc" class="form-label">Coupon Description <span class="asterisk"> *</span></label>
                      <input type="text" class="form-control" name="coupon_desc" maxlength="255" placeholder="Coupon Description" value="<?= $coupon['coupon_desc'] ?>" required>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-md-6">
                    <label for="property" class="form-label">Property<span class="asterisk"> *</span></label>
                    <input type="checkbox" name="indv_property" id="indv_property" <?= !empty($coupon['property_id']) ? 'checked' : ''?> value="1">Select for Individual Property
                    <select name="property" class="form-select select2" id="property" <?= !empty($coupon['property_id']) ? '' : 'disabled'?> >
                      <option value="" selected disabled>Select Property</option>
                      <?php
                          if(!empty($properties)){
                              foreach($properties as $propertie){
                                  ?>
                                  <option value="<?= $propertie['property_id'] ?>" 
                                  <?= $propertie['property_id'] == $coupon['property_id'] ? 'selected' : '' ?>
                                  >
                                  <?= $propertie['property_name'] ?></option>
                                  <?php
                              }
                          }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-md-6">
                      <label for="valid_from_date" class="form-label">Valid From Date<span class="asterisk"> *</span></label>
                      <input type="date" class="form-control" name="valid_from_date" placeholder="" value="<?= $coupon['valid_from_date'] ?>" required>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-md-6">
                      <label for="valid_to_date" class="form-label">Valid To Date<span class="asterisk"> *</span></label>
                      <input type="date" class="form-control" name="valid_to_date" placeholder="" value="<?= $coupon['valid_to_date'] ?>" required>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-md-6">
                      <label for="discount_type" class="form-label">Discount Type<span class="asterisk"> *</span></label>
                      <select name="discount_type" class="form-select" id="discount_type" required>
                          <?php /*?><option value="1" <?= !empty($coupon['offer_amount']) ? 'selected' : ''?>>Flat</option><?php */?>
                          <option value="0" <?= !empty($coupon['offer_perc']) ? 'selected' : ''?>>Percentage</option>
                      </select>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-md-6">
                      <label for="amount" class="form-label"><span id="leb-amount">Discount Amount <?= !empty($coupon['offer_perc']) ? '(% Value)' : ''?></span><span class="asterisk"> *</span></label>
                      <input type="number" class="form-control" name="amount" id="amount" placeholder="Discount Amount" value="<?= !empty($coupon['offer_amount']) ? round($coupon['offer_amount']) : round($coupon['offer_perc'])?>" required>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-md-6">
                      <label for="is_active" class="form-label">Status<span class="asterisk"> *</span></label>
                      <select name="is_active" class="form-select" id="" required>
                          <option value="1" <?= $coupon['is_active'] == '1' ? 'selected' : ''?> >Active</option>
                          <option value="0" <?= $coupon['is_active'] == '0' ? 'selected' : ''?> >Inactive</option>
                      </select>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn app-btn-primary">UPDATE</button>
                    <a class="btn app-btn-danger" href="<?= base_url('admin/CouponMaster'); ?>">CANCEL</a>
                  </div>
                </div>
              </div>
              
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type='text/javascript'>
  function validateCode() {
    var TCode= $('#coupon_code').val().trim();
    var alpha = num = 0;
    var strLen = TCode.length;
    if(strLen != 10){
      swal('Alert', 'Please enter a valid 10 digit Alphanumeric code only.', 'warning');
      return false;
    }
    for (var i = 0; i < strLen; i++) {
        var char1 = TCode.charAt(i);
        var cc = char1.charCodeAt(0);

        if ((cc > 47 && cc < 58) || (cc > 64 && cc < 91) || (cc > 96 && cc < 123)) {
          if((cc > 47 && cc < 58)){
            num++;
          }
          if((cc > 64 && cc < 91) || (cc > 96 && cc < 123)){
            alpha++;
          }
        } else {
            swal('Alert', 'Alphanumeric code only.', 'warning');
            return false;
        }
    }
    // console.log(alpha, num);
    if(alpha >0 && num >0){
      return true;
    }else{
      swal('Alert', 'Alphanumeric code only.', 'warning');
      return false;
    }
  }
  $(document).ready(function(){
    $('#discount_type').on('change', function(){
      if($(this).val() == '1'){
        $('#leb-amount').html('Discount Amount');
        $('#amount').prop('placeholder', 'Discount Amount');
      }else{
        $('#leb-amount').html('Discount Amount (% Value)');
        $('#amount').prop('placeholder', 'Discount Amount (% Value)');
      }
    })
    $('#indv_property').on('click', function(){
      console.log($(this).prop('checked'));
      if($(this).prop('checked')){
        $('#property').prop('required', true);
        $('#property').prop('disabled', false);
      }else{
        $('#property').val('');
        $('#property').prop('required', false);
        $('#property').prop('disabled', true);
      }
    })

    $('#coupon-form').submit(function(e){
      e.preventDefault();
      var codeStatus = validateCode();
      // console.log(codeStatus);
      if(!codeStatus){
        return false;
      }
          var fd = $(this).serialize();
          $.ajax({
              type: 'POST',	
              url: "<?= base_url('admin/CouponMaster/update/'.$coupon['coupon_id']); ?>",
              data: fd,
              dataType: 'json',
              encode: true,
              async: false
          })
          .done(function(data){
              if(data.success){
                  swal('Success', data.message, 'success');
                  setTimeout(function(){
                      window.location.href = "<?= base_url('admin/CouponMaster') ?>";
                  }, 2000);
              }
              else{
                  swal('Alert', data.message, 'warning');
              }
          
          })
          .fail(function(data){
              // show the any errors
              console.log(data);
          });
      })
  });
</script>