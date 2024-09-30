<body style="background:#fff; "> 
  <table width="595" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Arial, 'Arial Black'; background:#fff;  ">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td style="border-top:1px dashed #000; border-bottom:1px dashed #000; text-align:center; padding:8px 0; "><h3 style="font-size:22px; margin:0; " id="invoice_type">Invoice</h3></td>
  </tr>
  <tr>
    <td style="  padding:8px 0; border-bottom:1px dashed #000;  ">

      <table width="100%">
<tr>  <td  width="30%" align="center" style="padding-left:5px;"><img src="<?= base_url();?>public/admin_assets/images/logo.jpg" width="100">
<br><h2 style="font-size:18px; margin:0; padding-bottom:5px; padding-top:8px; " id="unit_name"></h2>
</td>
<td><table width="100%">
  <tr>
   <td align="left" valign="top" style="font-size:12px;">
			
			<p style="padding:1px; margin:1px;"><strong  style="font-weight:bold;">Location :</strong>
			<span id="property_addr"></span> West Bengal <span id="property_pin"></span><br>
			<strong>Contact No. :</strong> +91 <span id="property_phone"></span></p>
			<strong>Email : </strong> <span id="property_email"></span>
			<!-- <br><strong>GSTIN :</strong> 19AAMFJ1635Q1ZO</p> -->
         
   </td>
  </tr>
</table></td>
</tr>
      </table>
      
      
   
    </td>
  </tr>
  <tr>
    <td style=" padding:8px 5px; "><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px; line-height:18px;">
	<!--<tr>
        <td align="left" valign="middle">GSTIN : 19AAMFJ1635Q1ZO </td>
		<td align="right" valign="middle"><span id="inv_no"></span></td>
		
      </tr>
	  
      <tr>
        <td align="left" valign="middle">HSN/SAC. <span id="hsn_sac"></span></td>
        
        <td align="right"><span id="order_no"></span></td>
      </tr>-->
      <tr>
        
        <td align="left">Date : <span id="date"></span></td>
		<td align="right">Time : <span id="time"></span></td>
      </tr>
      <!--code edit by partha on 03-01-2019 -->
      <tr>
        
        <td align="left">Table No./ Room No.: <span id="table"></span></td>
	 </tr>
	 <!--code end -->
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
      <thead>
      <tr>
        <th style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; text-align: center;  ">#</th>
       <th align="left" style="border-top:1px solid #000; border-bottom:1px solid #000;  padding:3px; ">Description</th>
       <th align="left" style="border-top:1px solid #000; border-bottom:1px solid #000;  padding:3px; ">Rate</th>
       <th style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; text-align: center; ">Quantity</th>
       <th align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;  padding:3px; ; text-align: right;  ">Amount</th>
	   <th align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;  padding:3px; ; text-align: right;  ">GST(%)</th>
	   <th align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;  padding:3px; ; text-align: right;  ">GST Amt</th>
	   <th align="right" style="border-top:1px solid #000; border-bottom:1px solid #000;  padding:3px; ; text-align: right;  ">Payable Amt</th>
      </tr>
      </thead>
      <tbody id="pos_detail">
      <!-- <tr>
        <td align="center"  style=" padding:3px;  text-align: center; ">1</td>
        <td  style=" padding:3px; ">Tandori Roti</td>
        <td align="center" valign="middle"  style=" padding:3px; ">4</td>
        <td align="right"  style=" padding:3px; ">20.00</td>
      </tr>
      <tr>
        <td align="center"  style=" padding:3px;  text-align: center; ">2</td>
        <td style=" padding:3px;">Egg Tardka</td>
        <td align="center" valign="middle">1 plate</td>
        <td align="right" style=" padding:3px;">35.00</td>
      </tr> -->
      </tbody>
      <tr>
	   <td colspan="3" align="left" style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px;   font-weight: 700; ">Grand Total</td>
        <!-- <td colspan="2" align="right" style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; ">Grand Total</td> -->
		 <td align="center"  style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; "><span id="ti"></span></td> 
        <td align="right"  style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; "><span id="gt"></span></td>
		<td align="right"  style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; "></td>
		<td align="right"  style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px; "><span id="gst_amt"></span></td>
		<td align="right"  style="border-top:1px solid #000; border-bottom:1px solid #000; padding:3px;   font-weight: 700;"><span id="with_tax_total"></span></td>
		
      </tr>
    </table></td>
  </tr>
  
  
  <?php /*?><tr>
    <td  style=" padding:8px 0 0 0;  border-bottom:1px solid #000;  "><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
      <!-- <tr>
        <td  style=" padding:3px; ">Total Item</td>
        <td  style=" padding:3px; "></td>
        <td align="right"  style=" padding:3px; " id="ti"></td>
      </tr>
     <tr>
        <td  style=" padding:3px; "></td>
        <td  style=" padding:3px; "></td>
        <td align="right"  style=" padding:3px; " id="pbt"></td>
      </tr>-->
      <tr>
        <td style=" padding:3px; ">CGST</td>
        <td style=" padding:3px; "><span id="cgst"></span> %</td>
        <td align="right"  style=" padding:3px; "><span id="cgst_amt"></span></td>
      </tr>
	  
	  <tr>
        <td style=" padding:3px; ">SGST</td>
        <td style=" padding:3px; "><span id="sgst"></span> %</td>
        <td align="right"  style=" padding:3px; "><span id="sgst_amt"></span></td>
      </tr>
	  
	  <tr>
        <td style=" padding:3px; ">Total Tax</td>
        <td style=" padding:3px; "><span id="tax"></span> %</td>
        <td align="right"  style=" padding:3px; "><span id="tax_amt"></span></td>
      </tr>
	  
      <tr>
        <td style="border-top:1px solid #000; padding:3px; font-weight: 700;">Grand Total</td>
        <td style="border-top:1px solid #000; padding:3px; font-weight: 700;"></td>
        <td  style="border-top:1px solid #000; padding:3px;  font-weight: 700;" align="right"><span id="net_amt"></span></td>
      </tr>
    </table></td>
  </tr><?php */?>
  
  
  <tr>
  <td align="center" style=" padding:3px; font-size:12px;">(This is a system generated document hence no signature required) </td>
  </tr>
  
   <tr id="cust_signature" style="display:none;">
    <td align="right"><p style="padding-bottom:20px; font-weight:bold;">Received</p>
    <p>Customer's / Guest's Signature</p>
    </td>
  </tr>

  
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="40%" id="print_button" onClick="myFunction()"><a href="#" style="background:#ffa93c; padding:10px 15px; color:#fff; font-size:12px;  text-transform:uppercase;  font-weight:700; text-decoration:none;  float:left; text-align:center;  ">PRINT</a></td>
        <td width="20%"></td>
		<?php
		if($_GET['type'] == ''){
		?>
        <td width="40%" align="right" id="back_to"><a href="<?= base_url();?>admin/pos/product_sale/<?= encode_url($posHeader['cost_center_id'])?>/<?= encode_url($posHeader['property_id'])?>" style="background:#0080fd; padding:10px 15px; color:#fff; font-size:12px; font-weight:700; text-decoration:none;text-transform:uppercase; dispaly:block; text-align:right; ">Back to POS</a></td>
		<?php
		}
		?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
	
<script>
    var sale_order_id = <?= $sale_order_id;?>;
    $(document).ready(function(){
        tax_invoice();
    });

 function tax_invoice(){

    $.ajax({
			type 		: 'POST',
			url 		: '<?= base_url("admin/pos/getPosDetail"); ?>',
			data 		: {csrf_test_name: '<?= $this->csrf['hash']; ?>', sale_order_id: sale_order_id },
			dataType 	: 'json',
			encode 		: true
		})
		.done(function(data) {
			if(data.status){
        	$('#unit_name').text(data.pos_header.cost_center_name);
			$('#property_addr').text(data.pos_header.address_line_1);
			$('#property_pin').text(data.pos_header.pincode);
			$('#property_phone').text(data.pos_header.phone_no);
			$('#property_email').text(data.pos_header.email);
       		//$('#gst_no').html('19AAMFJ1635Q1ZO');
		
        $('#order_no').text('Order No. :'+data.pos_header.order_no);
        $('#hsn_sac').text(data.pos_header.hsn_sac_code);
        if(data.pos_header.payment_option==1){
          $('#invoice_type').text('Tax Invoice');
          $('#inv_no').text('Invoice No. :'+data.pos_header.invoice_no);
		  //code edit by partha on 03-01-2019
          $('#table').text(data.pos_header.table_no);
		  // code end 
        }
        else if(data.pos_header.payment_option==2){
		  $('#cust_signature').show();
          $('#invoice_type').text('Statement');
        }
        var d = new Date(); 
        $('#date').text(d.getDate()+'/'+Number(d.getMonth() + 1)+'/'+d.getFullYear());
        $('#time').text(d.getHours()+':'+d.getMinutes());
        var result = '';
        var j = 0;
        var without_tax_total = 0;
        var total_item = 0;
		var with_tax_total =0;
		var gst_amount = 0;
		
        $.each(data.pos_detail, function(key, value) {j++;
           // alert(value.rate);
          result += '<tr>';
          result += '  <td align="center"  style=" padding:3px;  text-align: center; ">'+j+'</td>';
          result += '  <td style=" padding:3px;">'+value.product_service_name+'</td>';
          result += '  <td align="center" valign="middle">'+parseFloat(value.rate).toFixed(2)+'</td>';
          result += '  <td align="center" valign="middle">'+parseInt(value.quantity)+'</td>';
          result += '  <td align="right" style=" padding:3px;">'+parseFloat(value.price).toFixed(2)+'</td>';
		  result += '  <td align="right" style=" padding:3px;">'+parseFloat(value.tax_percentage).toFixed(2)+'</td>';
		  result += '  <td align="right" style=" padding:3px;">'+parseFloat(value.igst).toFixed(2)+'</td>';
		  result += '  <td align="right" style=" padding:3px;">'+parseFloat(value.payable_amount).toFixed(2)+'</td>';
          result += '</tr>';
          without_tax_total += value.price * 1;
          total_item += parseInt(value.quantity) * 1;
		  with_tax_total += value.payable_amount * 1;
		  gst_amount += value.igst * 1;
        });
        $('#pos_detail').html(result);
        $('#gt').text(parseFloat(without_tax_total).toFixed(2));
        $('#ti').text(total_item);
		$('#gst_amt').text(parseFloat(gst_amount).toFixed(2));
		$('#with_tax_total').text(parseFloat(with_tax_total).toFixed(2));
        $('#pbt').text(parseFloat(without_tax_total).toFixed(2));
        $('#cgst').text(parseFloat(data.pos_header.cgst_percent*1).toFixed(2));
        $('#sgst').text(parseFloat(data.pos_header.sgst_percent*1).toFixed(2));
        $('#cgst_amt').text(parseFloat(data.pos_header.total_cgst*1).toFixed(2));
        $('#sgst_amt').text(parseFloat(data.pos_header.total_sgst*1).toFixed(2));
		
		
        $('#tax').text(parseFloat((data.pos_header.cgst_percent*1)+(data.pos_header.sgst_percent*1)).toFixed(2));
        $('#tax_amt').text(parseFloat((data.pos_header.total_cgst*1)+(data.pos_header.total_sgst*1)).toFixed(2));
        $('#net_amt').text(parseFloat((without_tax_total*1)+(data.pos_header.total_cgst*1)+(data.pos_header.total_sgst*1)).toFixed(2));
			}
			//console.log(data);
		})
		.fail(function(data) {
			console.log(data);
		});
  

 }


function myFunction() {
    $('#print_button').hide();
    $('#back_to').hide();
    window.print();
}

</script> 

