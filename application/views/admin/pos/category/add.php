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
                <h1 class="app-page-title mb-0">Add Category </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="<?= base_url('admin/pos/category') ?>">
                                View All Category
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

            <form class="settings-form" method="post" action="<?= base_url('admin/pos/insertposcategory'); ?>" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
			<input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="property_id" class="form-select select2" id="property_id" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <?php foreach ($property_details as $property) { ?>
                                        <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">POS<span class="asterisk"> *</span></label>
                                <select class="form-select select2" name="cost_center_id" id="cost_center_id" required>
                                    <option value="">Select POS</option>
                                </select>
                            </div>
							<div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Category Name<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="category_name" placeholder="Category Name" required>                              
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <label for="" class="form-label">Category<span class="asterisk"> *</span></label>
                                <select name="category_flag" class="form-select" id="category_flag" required>
                                    <option value="">Select Category</option>
                                    <option value="P" selected>Product</option>
                                    <option value="S" >Service</option>
                                </select>                              
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
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
                                <a class="btn app-btn-danger" href="<?=base_url('admin/pos/category')?>">CANCEL</a>
                            </div>
							
                        </div>
                       
                </div>
                
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script>
 $(document).ready(function() {
	
	$("#property_id").change(function(){ 
		var property_id = $(this).val();
		var result = '';
		$.ajax({
			type: 'POST',	
			url: '<?= base_url("admin/pos/getCostCenterByProperty"); ?>',
			data: {
				property_id: property_id,
				csrf_test_name: '<?= $this->csrf['hash']; ?>',
				action_type: 'pos_data',
				show_type: 'all'
			},
			dataType: 'json',
			encode: true,
			async: false
		})
		//ajax response
		.done(function(response){
			if(response.status){
				result +='<option value="" selected >Select POS</option>';
                //result +='<option value="all">All Accommodations</option>';
                $.each(response.list,function(key,value){
                    var selected_txt='';
                    result +='<option value="'+value.cost_center_id+'">'+value.cost_center_name+'</option>';
                });
			}
			else{
                result +='<option value="">No Data found</option>'
            }
			$("#cost_center_id").html(result);
		});
	});
	
} );
</script>

