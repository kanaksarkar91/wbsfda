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
                <h1 class="app-page-title mb-0">Add Product/Service </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/pos/product_service') ?>">
                                View All Product/Service
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

            <form class="settings-form" method="post" action="<?= base_url('admin/pos/insertproductservice'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
			<input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Product/Service<span class="asterisk"> *</span></label>
                                <select name="product_service_flag" class="form-select" id="product_service_flag" required>
                                    <option value="" selected>Select Product/Service</option>
                                    <option value="P">Product</option>
                                    <option value="S">Service</option>
                                </select>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Category <span class="asterisk"> *</span></label>
								<select id="category_id" name="category_id" class="form-select" required>
									<option value="" selected disabled>Select Category</option>
								</select>                              
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Product/Service Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="product_service_name" placeholder="Product/Service Name" required>                              
                            </div>
							<div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Unit of Measurement<span class="asterisk"> *</span></label>
                                <select name="uom_id" class="form-select select2" id="uom_id" required>
                                    <option value="" selected disabled>Select Unit of Measurement</option>
                                    <?php foreach ($uoms as $uom) { ?>
                                        <option value="<?= $uom['uom_id'] ?>"><?= $uom['uom_name'] ?></option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="" class="form-label">Status<span class="asterisk"> *</span></label>
                                <select name="is_active" class="form-select" id="is_active" required>
                                    <option value="">Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0" >Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="submit" value="1"/>                               
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
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

