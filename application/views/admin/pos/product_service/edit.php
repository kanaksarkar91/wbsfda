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
                <h1 class="app-page-title mb-0">Edit Product/Service </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/pos/product_service') ?>">
                                VIEW ALL PRODUCT/SERVICE
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

            <form class="settings-form" method="post" action="<?= base_url('admin/pos/updateproductservice'); ?>" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
				<input type="hidden" name="slug" value="<?= $slug; ?>">
                <input type="hidden" name="product_service_id" value="<?= encode_url($product_service['product_service_id']); ?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>" <?= ($product_service['property_id'] == $property['property_id']) ? 'selected' : '' ?>><?= $property['property_name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Product/Service<span class="asterisk"> *</span></label>
                                <select name="product_service_flag" class="form-select" id="product_service_flag" required>
                                    <option value="">Select Product/Service</option>
                                    <option value="P" <?= ($product_service['product_service_flag'] == 'P') ? 'selected' : '' ?>>Product</option>
                                    <option value="S" <?= ($product_service['product_service_flag'] == 'S') ? 'selected' : '' ?>>Service</option>
                                </select>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Category <span class="asterisk"> *</span></label>
								<select id="category_id" name="category_id" class="form-select" required>
									<option value="" disabled>Select Category</option>
                                    <?php foreach ($categories as $cat) { ?>
                                        <option value="<?= $cat['category_id'] ?>" <?= ($product_service['category_id'] == $cat['category_id']) ? 'selected' : '' ?>><?= $cat['category_name'] ?></option>
                                    <?php } ?>
								</select>                              
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Product/Service Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="product_service_name" value="<?= $product_service['product_service_name'];?>" placeholder="Product/Service Name" required>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Unit of Measurement<span class="asterisk"> *</span></label>
                                <select name="uom_id" class="form-select select2" id="uom_id" required>
                                    <option value="" selected disabled>Select Unit of Measurement</option>
                                    <?php foreach ($uoms as $uom) { ?>
                                        <option value="<?= $uom['uom_id'] ?>" <?= ($product_service['uom_id'] == $uom['uom_id']) ? 'selected' : '' ?>><?= $uom['uom_name'] ?></option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" <?= ($product_service['is_active'] == 1) ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= ($product_service['is_active'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="submit" value="1" />
                                <button type="submit" class="btn app-btn-primary">UPDATE</button>
                                <a class="btn app-btn-danger" href="<?=base_url('admin/pos/product_service')?>">CANCEL</a>
                            </div>
							
                        </div>

                </div>
                
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>


<script>
$("#product_service_flag").change(function(){ 
	populatecategory(this.value);
});

function populatecategory(pors_flag,selected){
	//alert(selected);
	var property_id = $('#property_id :selected').val();
	var result='';
	$.ajax({
		type: 'POST',	
		url: '<?= base_url("admin/pos/getCategoryFlagWise"); ?>',
		data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', property_id: property_id, category_flag: pors_flag},
		dataType: 'json',
		encode: true
	})
	//ajax response
	.done(function(data){
		if(data.status){
		//alert(value.category_id);
			result +='<option value="" selected disabled>Select category</option>';
			$.each(data.categorylist,function(key,value){
			
			var selected_txt='';
			if(selected == value.category_id){
				selected_txt='selected';
			}
			
			result +='<option value="'+value.category_id+'" '+selected_txt+'>'+value.category_name+'</option>';
			});
		}
		else{
			result +='<option value="">No Category selected</option>'
		}
		$("#category_id").html(result);
		$("#category_id").selectpicker("refresh");
	
	})
	
	.fail(function(data){
		// show the any errors
		console.log(data);
	});
}
</script>

