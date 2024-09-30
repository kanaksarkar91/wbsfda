<style type="text/css">
.POS-head {
	background-color: #e9e9e9;
	border: 1px solid #ccc;
}

.POS-head-2 {
	height: 38px;
}

.category-list {
	background-color: rgb(245, 245, 245);
	padding: 10px;
}

.item-list {
	background-color: aliceblue;
	padding: 10px;
}

.category-list .cat-list-scrollable-div,
.item-list .product-list-scrollable-div{
	height: 475px;
	overflow-y: scroll;
}
.category-list .cat-list-scrollable-div .row,
.item-list .product-list-scrollable-div .row{
	width: calc(100% - 0rem);
}
.product-list-scrollable-div #product_list .col-md-4.col-6{
	align-items: stretch;
}
.product-list-scrollable-div #product_list .col-md-4.col-6 .product-name{
	height: 100%;
}
.grid-title {
	margin-bottom: 0;
	/* padding-bottom: 10px; */
}

.category-name,
.product-name {
	padding: 20px 5px;
	background-color: #FFF;
	text-align: center;
	cursor: pointer;
	border: 1px solid #ccc;
	width:100%;
}
.category-name span.title-head,
.product-name span.title-head{
	font-weight: bold;
	font-size: 1rem;
}
.product-name .title-head{
	margin-bottom: .5rem;
}
.product-name .qt-rs{
	font-size: .9rem;
	color: #666;
}
.category-name:hover,
.product-name:hover{
	color: #FFF;
	background-color: #3fb618;
}
.category-name:hover,
.product-name:hover .qt-rs{
	color: #FFF;
}

.ordered-item {
	background-color: #fffbf0;
	padding: 10px;
}

.tr-green {
	background: #3f6515;
	color: #fff;
	font-size: .9rem;
}

.td-pad {
	padding: 0px !important;
}

.pro-list-loop {
	border-bottom: 1px solid #ccc;
}

.edit_qty{
	border: 1px solid #ccc;
	border-radius: 0;
}

.pro-name {
	background: #ff8f00;
	color: #fff;
	width: 100%;
	text-align: center;
	line-height: 25px;
	font-size: 13px;
}

.remove-item {
	color: #000;
	font-size: 1rem;
}

</style>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">
		<div class="row g-3 mb-2 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">POS Sale</h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<!--//col-->
						<div class="col-auto">
						<button id="" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCreatedFolder" aria-expanded="false" aria-controls="collapseCreatedFolder">Show Tables</button>
							<a class="btn btn-success text-white" target="_blank" href="<?= base_url();?>admin/pos/pos_invoice_list/<?= encode_url($property_id);?>/<?= encode_url($cost_center_id);?>">Receivable</a>
							
							<a class="btn btn-warning text-white" target="_blank" href="<?= base_url();?>admin/pos/pos_received_invoice_list/<?= encode_url($property_id);?>/<?= encode_url($cost_center_id);?>">Received</a>
						</div>
					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->
		</div>
		<div class="app-card app-card-settings shadow-sm p-2">
			<div class="app-card-body">
				<!-- <div class="row mb-3"> -->
					<!--<div class="col-auto mt-3">
						<label class="col-form-label">Select Property<span class="asterisk"> *</span></label>
					</div>
					<div class="col-lg-3 col-sm-12 col-md-4 mt-3">
						<select name="property_id" class="form-select" id="" required="">
							<option value="" selected="" disabled="">Select Property</option>
							<option value="1">Property 1</option>
							<option value="2">Property 2</option>
						</select>
					</div>
					<div class="col-auto mt-3">
						<label for="" class="form-label">&nbsp;</label>
						<button type="submit" id="btn-form-submit" class="btn btn-primary">Take Order</button>
					</div>-->

					<!-- <div class="col-auto mt-3 ms-auto">
						<label for="" class="form-label">&nbsp;</label>
						<button id="" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCreatedFolder" aria-expanded="false" aria-controls="collapseCreatedFolder">Show Created Folder</button>
					</div>
				</div> -->

				<div class="collapse" id="collapseCreatedFolder">
					<table class="table table-sm table-borderless align-middle mb-0">
						<thead class="table-dark">
							<tr>
								<th width="30%">Folder no.</th>
								<th width="25%">Table No./ Room No.</th>
								<th width="25%" class="text-end">Total Amount</th>
								<th width="20%" class="text-center">Action</th>
							</tr>
						</thead>
					    <tbody>
							<tr>
								<td colspan="4">
									<div style="height:128px; overflow-y:scroll;">
										<table class="table table-sm table-bordered table-hover align-middle mb-0">
											<tbody id="folder_list">

											</tbody>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="row g-0">
					<div class="col-12 POS-head p-2">
						<div class="row align-items-center">
							<div class="col-md-4">
								<h6 class="mb-0">POS: <?= $costCenterData['cost_center_name'];?></h6>
							</div>
							<div class="col-md-4">
								<div class="input-group">
									<span class="input-group-text rounded-0 fw-bold" id="">Table No./ Room No.</span>
									<input type="text" class="form-control rounded-0" id="table_no">
								</div>
							</div>
							<div class="col-md-4">
								<h6 class="mb-0">Folder No. <span id="folder_no"></span><input type="hidden" class="form-tableno" id="sale_order_id" value=""></h6>
							</div>
						</div>
					</div>
					<div class="col-md-3 category-list">
						<div class="POS-head-2 d-flex align-items-center mb-2">
							<input type="text" class="form-control rounded-0" name="search_cat" id="search_cat" placeholder="Search Category">
						</div>
						<div class="cat-list-scrollable-div">
							<div class="row g-2" id="cat_list">
								<!-- <div class="col-md-4 col-6" >
									
								</div> -->
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-5 item-list">
						<div class="POS-head-2 d-flex align-items-center mb-2">
							<input type="text" class="form-control rounded-0" name="search_item" id="search_item" placeholder="Search Product Name">
						</div>
						<div class="product-list-scrollable-div">
							<div class="row g-2" id="product_list">
								<!-- <div class="col-md-4 col-6">
									
								</div>	 -->						
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-4 ordered-item">
						<div class="POS-head-2 d-flex align-items-center mb-2">
							<div style="min-width: 125px;">
								<h6 class="grid-title me-2">Ordered Item</h6>
							</div>
							<!-- <input type="text" class="form-control" placeholder="Search Product Name"> -->
						</div>

						<div>
							<form action="" method="post" id="frm_POS">
							<div>
							  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-sm mb-0">
								<tr class="tr-green">
								  <td width="5%" class="tr-green"><strong>#</strong></td>
								  <td width="55%" align="center" class="tr-green"><strong>Product</strong></td>
								  <td width="20%" align="center" class="tr-green"><strong>Qty</strong></td>
								  <td width="20%" align="center" class="tr-green"><strong>Price</strong></td>
								</tr>
								<tr>
								  <td colspan="4" class="td-pad" >
									<div style="height: 357px; overflow-y: scroll;">
									  <div class="pro-list" id="item_list">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-sm mb-0 pro-list-loop">
										  <tr>
											<td style="color: red;" align="center" width="100%" valign="middle">No Item Selected</td>
										  </tr>
										</table>
									  </div>
									</div>
								  </td>
								</tr>
							  </table>
							  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-sm mb-0">
								<tr class="tr-green">
								  <td align="left" valign="middle" class="pad-top-bot">Total Items</td>
								  <td align="left" valign="middle" class="pad-top-bot" id="item_count">0</td>
								  <td align="right" valign="middle" class="pad-top-bot">Total Payable</td>
								  <td align="right" valign="middle" class="pad-top-bot" id="grand_total">0.00</td>
								</tr>
								<!-- <tr>
								  <td align="left" valign="middle" class="pad-top-bot">Discount</td>
								  <td align="left" valign="middle" class="pad-top-bot">10.00</td>
								  <td align="right" valign="middle" class="pad-top-bot">Tax</td>
								  <td align="right" valign="middle" class="pad-top-bot">0.00</td>
								  </tr>
								<tr>
								  <td colspan="3" class="pad-top-bot border-top"><strong>Total Payable</strong></td>
								  <td align="right" class="pad-top-bot border-top"><strong>100.00</strong></td>
								</tr> -->
							  </table>
							</div>
							<div class="can-hol-pay mt-2">
								<button type="button" class="btn btn-sm btn-warning text-white mt-1" onClick="holdSale('holdSale')">Hold</button>
								
								<button type="button" class="btn btn-sm btn-secondary text-white mt-1" onClick="holdSale('holdAndPrint')">Hold & Print</button>
								
								<button type="button" class="btn btn-sm btn-success text-white mt-1" onClick="holdSale('generateInvoice')">Generate Invoice  </button>
								
								<button type="button" class="btn btn-sm btn-info text-white mt-1" data-bs-toggle="modal" data-bs-target="#transfer_folio" onClick="get_open_folio()">Transfer to Folio</button>
							  
							  <!-- <button type="submit" id="sale_btn" class="btn btn-success pull-right">Sattlement</button> -->
							  <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sattlement_popup">Settlement</button>-->
							  
							  <!-- <button type="button" class="btn btn-danger" onclick="cancelSale();">Cancel</button> -->
							</div>
						  </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade right" id="sattlement_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Settlement</h4>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
     <button type="button" class="btn btn-success text-white" onClick="holdSale('generateInvoice')">Generate Invoice  </button>
      
      <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#transfer_folio" onClick="get_open_folio()">Transfer to Folio</button>
      
      
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade bottom" id="transfer_folio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Transfer</h4>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      
      <table class="table table-bordered table-striped table-hover" id="folio_table">
      
      <thead>
          <tr>
              <th>Select</th>
              <th>#</th>
              <!--<th>Folio No</th>-->
              <th>Room No</th>
              <th>Customer Name</th>
              <th>Email</th>
              <th>Mobile No</th>
          </tr>
      </thead>
          
          <tbody id="open_folio">
          
          </tbody>
          
          <tfoot>
          <tr>
               <td colspan="7"> <button type="button" class="btn btn-info text-white" onClick="holdSale('transfer')">Transfer</button></td>
      
          </tr>
  </tfoot>
          </table>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
	//isSelectedPOS();
	//$("#unit_name").text(localStorage.getItem("unit_name"));
	getCategories();
	getOpenFolder();
	getProducts()
});

$('#search_cat').keyup(function (evt) {
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	console.log('charCode:'+charCode);
	if(charCode == 40){	//	'down'
		focusNext();
		return;
	}
	else if(charCode == 38){	//	'up'
		focusPrev();

		return;
	}
	getCategories();
});

$('#search_cat').focus(function () {
	$('#cat_list').show();
});

function getCategories(){
	var query = $('#search_cat').val().trim();
	//console.log("getProducts called");
	$.ajax({
		type 		: 'POST',
		url			: '<?= base_url("admin/pos/getCategoryList"); ?>',
		data 		: { csrf_test_name: '<?= $this->csrf['hash']; ?>', query:query, property_id: <?= $property_id;?>, cost_center_id: <?= $cost_center_id;?> },
		dataType 	: 'json',
		encode 		: true
	})
	.done(function(data) {
		var catHTML = "";
		if(data.status){
			$.each(data.cat_list, function(key, value){
				catHTML+= '<div class="col-12" ><button type="button" class="category-name" onclick="getProducts('+value.category_id+')"><span class="title-head">' + value.category_name + '</span></button></div>';
			});
	
			$("#cat_list").html(catHTML);
		}
		else{
			alert("No category available.");
			$("#cat_list").html(catHTML);
		}
		console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});
}

$('#search_item').keyup(function (evt) {
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	console.log('charCode:'+charCode);
	if(charCode == 40){	//	'down'
		focusNext();
		return;
	}
	else if(charCode == 38){	//	'up'
		focusPrev();

		return;
	}
	getProducts();
});

$('#search_item').focus(function () {
	$('#product_list').show();
});

function getProducts(category_id = ''){
	var query = $('#search_item').val().trim();
	//console.log("getProducts called");
	$.ajax({
		type 		: 'POST',
		url			: '<?= base_url("admin/pos/getProductServiceList"); ?>',
		data 		: { csrf_test_name: '<?= $this->csrf['hash']; ?>', query:query, cost_center_id: <?= $cost_center_id;?>, category_id: category_id },
		dataType 	: 'json',
		encode 		: true
	})
	.done(function(data) {
		var prodHTML = "";
		if(data.status){
			$.each(data.product_list, function(key, value){
				prodHTML+= '<div class="col-md-4 col-6"><button type="button" class="product-name pro_bor" id="prod_' + value.product_service_id + '" data-product_service_id="' + value.product_service_id + '" data-uom_id="' + value.uom_id + '" data-product_service_name="' + value.product_service_name + '" data-price="' + value.rate + '"><span class="title-head">' + value.product_service_name + ' / ' + value.uom_name + '</span><br><span class="qt-rs"> Rs ' + value.rate + '</span></button></div>';
			});
	
			$("#product_list").html(prodHTML);
			$(".pro_bor").click(function(){
				addItem(this.id);
			});
		}
		else{
			alert("No product available in this category");
			$("#product_list").html(prodHTML);
		}
		console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});
}

var selectedItems = [];		//	new Object();

function addItem(product_id_field){
	var itemDetails = $("#" + product_id_field).data();
	var pushed = false;
	for(var i = 0; i < selectedItems.length; i++){
		if(selectedItems[i].product_service_id == itemDetails.product_service_id){
			selectedItems[i].balance_qty = itemDetails.balance_qty;
			selectedItems[i].qty+= 1;
			/*if(selectedItems[i].balance_qty > selectedItems[i].qty){
				selectedItems[i].qty+= 1;
			}
			else{
				alert("Maximum quantity available for this item is: " + selectedItems[i].balance_qty + ".\nYou can't select more than this.");
			}*/
			pushed = true;
			break;
		}
	}
	if(!pushed){
		itemDetails.qty = 1;
		selectedItems.push(itemDetails);
	}
	//console.log(JSON.stringify(selectedItems));
	showItems();
}

function showItems(){
	var itemListHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-sm mb-0 pro-list-loop">';
	var grandTotal = 0;
	var totqty=0 *1;
	for(var i = 0; i < selectedItems.length; i++){
		var totPrice = 0;
	
  var itemName = selectedItems[i].product_service_name;
		if(itemName.length > 15){
			itemName = itemName.substr(0, 13);
			itemName+= '..';
		}
		itemName+= ' @ ' + selectedItems[i].price;
		totPrice = (selectedItems[i].price * selectedItems[i].qty);
		grandTotal+= totPrice;
	  totqty += selectedItems[i].qty *1;
	itemListHTML+= '<tr id="t_row_' + i + '">' +
					   '  <td width="5%" align="center" valign="middle"><a class="remove-item" href="javascript:;" onclick="removeItem(' + i + ');"><i class="fa fa-close"></i></a></td>' +
					   '  <td width="55%" align="center" valign="middle">' +
					   '    <div class="pro-name">' + itemName + '</div>' +
					   '  </td>' +
					   '  <td width="20%" align="center" valign="middle">' +
					   '	<input type="text" name="qty[]" id="qty_' + i + '" value="' + selectedItems[i].qty + '" class="edit_qty" data-position="' + i + '" style="width:35px; text-align:center;" tabindex="' + (i + 1) + '" maxlength="3" onkeypress="return isNumber(event)">' +
					   '  </td>' +
					   '  <td width="20%" align="right" valign="middle" id="price_' + i + '">' + parseFloat(totPrice).toFixed(2) + '</td>' +
					   '</tr>';
	}
	if(selectedItems.length == 0){
		itemListHTML+= '<tr><td style="color: red;" align="center" width="100%" valign="middle">No Item Selected</td></tr>';
	}
	itemListHTML+= '</table>';
	$("#item_list").html(itemListHTML);
	if(selectedItems.length > 0){
		$(".edit_qty").keyup(function(){
			editQuantity(this.id);
		});
		/*$(".edit_qty").blur(function(){
			isValidQuantity(this.id);
		});*/
	}
	$("#grand_total").text(parseFloat(grandTotal).toFixed(2));
	$("#item_count").text(totqty);
//console.log(selectedItems);
}

function removeItem(position){
	selectedItems.splice(position, 1);
	showItems();
}

function editQuantity(qty_field){
	var position = $("#" + qty_field).data("position");
	var qty = parseInt($("#" + qty_field).val());
	selectedItems[position].qty = qty;
	$("#price_" + position).text(parseFloat(selectedItems[position].price * selectedItems[position].qty).toFixed(2));
	
	var grandTotal = 0;
	var totqty=0 *1;
	for(var i = 0; i < selectedItems.length; i++){
		var totPrice = 0;
		totPrice = (selectedItems[i].price * selectedItems[i].qty);
		grandTotal+= totPrice;
  		totqty +=selectedItems[i].qty *1;
	}
	

	$("#grand_total").text(parseFloat(grandTotal).toFixed(2));
	$("#item_count").text(totqty);
	
}

function isNumber(event){
	if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
		alert("Only Number Accepted");
		event.preventDefault(); //stop character from entering input
	}
}

function holdSale(type){
	//console.log(selectedItems);
	//alert(selectedItems.length);
	
	if($('#table_no').val()!='' && selectedItems.length>0){
	  $.ajax({
		type: 'POST',
		url: '<?= base_url("admin/pos/holdPos"); ?>',
		data: {csrf_test_name: '<?= $this->csrf['hash']; ?>', selectedItems:selectedItems,table_no:$('#table_no').val(),sale_order_id:$('#sale_order_id').val(),cost_center_id:<?= $cost_center_id;?>,booking_id:$('input[name=folio]:checked').val(), property_id: <?= $property_id;?>},
		dataType: 'json',
		encode: true,
		async: false
	  })
	  .done(function(data) { 
		if(data.status){
		  if(type=="holdSale"){
			//alert($('input[name=folio]:checked').val());
			$('#table_no').val("");
			window.location.reload();
		  }
		  if(type=="transfer"){
			// alert($('input[name=folio]:checked').val());
			// alert(data.result);
			if($('input[name=folio]:checked').val()!=''){
			  transfer(data.sale_order_id);
			}
			else{
			  alert("Please Select A Folio");
			}
		  }
		  if(type=="generateInvoice"){
			generate_invoice(data.sale_order_id);
		  }
		  if(type=="holdAndPrint"){
			//alert($('input[name=folio]:checked').val());
			$('#table_no').val("");
			window.location.href = '<?= base_url();?>admin/pos/pos_invoice/'+data.sale_order_id;
		  }
		}
		 // console.log(data);
	  })
	  .fail(function(data) {
		console.log(data);
	  })
	}
	else{
	  if($('#table_no').val() ==''){
		alert("Please Give a Table No./ Room No. Number");
	  }
	  else if(selectedItems.length < 1){
		alert("Please Select An Product");
	  }
	}
}

function getOpenFolder(category_id){
    
	$.ajax({
		type 		: 'POST',
		url 		: '<?= base_url("admin/pos/holdPosListing"); ?>',
		data 		: { csrf_test_name: '<?= $this->csrf['hash']; ?>', cost_center_id:<?= $cost_center_id;?> },
		dataType 	: 'json',
		encode 		: true
	})
	.done(function(data) {
		var folderHTML = "";
		if(data.status){
			$.each(data.open_folder_list, function(key, value){
				folderHTML += '<tr>';
		folderHTML += '  <td width="30%">'+value.order_no+'</td>';
		folderHTML += '  <td width="25%">'+value.table_no+'</td>';
		folderHTML += '  <td width="25%" align="right">'+value.net_bill_amount+'</td>';
		folderHTML += '  <td width="20%" align="center"><button href="#" class="btn btn-sm btn-primary" onclick="get_details('+value.sale_order_id+',\''+value.order_no+'\',\''+value.table_no+'\')"><i class="fa fa-edit"></i></button></td>';
	  folderHTML += '</tr>';
			});
			$("#folder_list").html(folderHTML);
		}
		else{
			$("#folder_list").html(folderHTML);
		}
		//console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});
}

function get_details(sale_order_id,order_no,table_no){
	$('#folder_no').text(order_no);
	$('#sale_order_id').val(sale_order_id);
	$('#table_no').val(table_no);
	
	$.ajax({
		type 		: 'POST',
		url 		: '<?= base_url("admin/pos/getFolderDetails"); ?>',
		data 		: { csrf_test_name: '<?= $this->csrf['hash']; ?>', sale_order_id:sale_order_id },
		dataType 	: 'json',
		encode 		: true
	})
	.done(function(data) {
		if(data.status){
	selectedItems = [];
	
	var i = 0;
  
	//console.log(data);
	$.each(data.open_folder_detail, function(key, value){
	  var itemDetails = {};
	  itemDetails.price=value.rate;
	  itemDetails.product_service_name=value.product_service_name;
	  itemDetails.uom_id=value.uom_id;
	  itemDetails.product_service_id=value.product_service_id;
	  itemDetails.qty=parseInt(value.quantity);
	  
	selectedItems.push(itemDetails);  
			});
   
	//console.log(selectedItems);
	showItems();
		}
		//console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});

}

function get_open_folio(){
	$.ajax({
		type 		: 'POST',
		url 		: '<?= base_url("admin/pos/getOpenFolio"); ?>',
		data 		: { csrf_test_name: '<?= $this->csrf['hash']; ?>', property_id: <?= $property_id;?> },
		dataType 	: 'json',
		encode 		: true
	})
	.done(function(data) {
		var folioHTML = "";
  		var i = 0;
		if(data.status){
			$.each(data.open_folio, function(key, value){i++
				folioHTML += '<tr>';
				folioHTML += '<td><input type="radio" class="folio" name="folio" id="'+i+'" value="'+value.booking_id+'"><label for="'+i+'"></label></td>';
				folioHTML += '  <td>'+i+'</td>';
				//folioHTML += '  <td>'+value.folio_no+'</td>';
				folioHTML += '  <td>'+value.room_no+'</td>';
				folioHTML += '  <td>'+value.customer_name+'</td>';
				folioHTML += '  <td>'+value.email+'</td>';
				folioHTML += '  <td>'+value.mobile+'</td>';
				folioHTML += '</tr>';
			});
			//$('#folio_table').dataTable().fnDestroy();
			$("#open_folio").html(folioHTML);
			//$('#folio_table').DataTable();
		}
		else{
			$("#open_folio").html(folioHTML);
		}
		//console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});
}

function transfer(sale_order_id){

  $.ajax({
	type: 'POST',
	url: '<?= base_url("admin/pos/transferToFolio"); ?>',
	data: {action_type: 'transfer_to_folio', csrf_test_name: '<?= $this->csrf['hash']; ?>', sale_order_id:sale_order_id, booking_id:$('input[name=folio]:checked').val()},
	dataType: 'json',
	encode: true,
	async: false
  })
  .done(function(data) { 
	if(data.status){
	  window.location.href = '<?= base_url();?>admin/pos/pos_invoice/'+sale_order_id;
	}
	 // console.log(data);
  })
  .fail(function(data) {
	console.log(data);
  })

}

function generate_invoice(sale_order_id){

  $.ajax({
	type: 'POST',
	url: '<?= base_url("admin/pos/transferToFolio"); ?>',
	data: {action_type: 'generate_invoice', csrf_test_name: '<?= $this->csrf['hash']; ?>', sale_order_id:sale_order_id},
	dataType: 'json',
	encode: true,
	async: false
  })
  .done(function(data) { 
	if(data.status){
	  window.location.href = '<?= base_url();?>admin/pos/pos_invoice/'+sale_order_id;
	}
	 // console.log(data);
  })
  .fail(function(data) {
	console.log(data);
  })

}
</script>