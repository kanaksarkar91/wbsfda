<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>POS TAX INVOICE</title>
    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document"> -->
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 1000px; background: #FFF; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                    <tr>
                        <td width="20%" style="text-align: left;padding:10px;">
                            <img src="<?php echo base_url();?>public/frontend_assets/assets/img/Biswa_Bangla_logo.jpg" width="64" alt="..." />
                        </td>
                        <td width="60%" style="text-align: center;">
                            <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">(A Government of West Bengal Undertaking)<br>An ISO: 9001:2015 Company</p>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">Bikash Bhawan, North Block, 1st Floor, Salt Lake, Kolkata - 700 091, West Bengal</p>
                            <h2 style="text-align:center;font-size:12px;font-weight: 600;">Tax Invoice</h2>
                        </td>
                        <td width="20%" style="text-align: right;padding-right:10px;">
                            <img src="<?php echo base_url();?>public/frontend_assets/assets/img/SFDC_logo.jpg" width="64" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
          <td>
            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left; margin-bottom: 6px;">
              <tr>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Place of Supply</td>
                  <td width="58%" colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="property_name"></td>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Tax Invoice No.</td>
                  <td width="16%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;" id="inv_no"></td>
              </tr>
              <tr>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Address</td>
                  <td width="58%" colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="property_addr"></td>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">Date</td>
                  <td width="16%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;" id="date"></td>
              </tr>
              <tr>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">City / Village</td>
                  <td width="18%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="property_city"></td>
                  <td width="8%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">District</td>
                  <td width="12%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="property_district"></td>
                  <td width="8%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">PIN Code</td>
                  <td width="12%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="property_pin"></td>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">GSTIN</td>
                  <td width="16%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;" id="property_gstin"></td>
              </tr>
              <tr>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Point of Sales</td>
                  <td width="38%" colspan="3" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="unit_name"></td>
                  <td width="8%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">fssai Lic No.</td>
                  <td width="12%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;" id="pos_fssai"></td>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">State & Code</td>
                  <td width="16%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;" id="property_state"></td>
              </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left; margin-bottom: 6px;">
              <tr>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Bill to</td>
                  <td width="58%" colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">XXXXXX</td>
                  <td width="13%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;">GSTIN</td>
                  <td width="16%" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;">XXXXXX</td>
              </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left; margin-bottom: 6px;">
              <tr>
                  <td width="2%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Sl.</td>
				  <td width="24%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Item</td>
                  <td width="8%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Rate</td>
                  <td width="5%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Qty</td>
                  <td width="8%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Base Value</td>
                  <td width="5%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Discount</td>
                  <td width="8%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Price before GST</td>
                  <td width="8%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">HSN/SAC</td>
                  <td width="12%" colspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">CGST</td>
                  <td width="12%" colspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">SGST</td>
                  <td width="10%" rowspan="2" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Price after GST</td>
              </tr>
              <tr>
                  <td width="4%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">%</td>
                  <td width="8%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Amount</td>
                  <td width="4%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">%</td>
                  <td width="8%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">Amount</td>
              </tr>
              
			  <tbody id="pos_detail">
                
              </tbody>
              
              <tr>
                <td colspan="2" style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"><b>TOTAL</b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="gt"></b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="ti"></b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="base_value"></b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b>&nbsp;</b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="price_before_gst"></b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b>&nbsp;</b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="cgst">&nbsp;</b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="cgst_amt">&nbsp;</b></td>
				<td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="sgst">&nbsp;</b></td>
				<td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="sgst_amt">&nbsp;</b></td>
                <td style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"><b id="with_tax_total">&nbsp;</b></td>
              </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                <tr>
                    <td width="20%" style="text-align: left; padding: 3px;"><b>Total Invoice Value : </b></td>
                    <td width="80%" style="text-align: left; padding: 3px;">Indian Rupees <span id="total_inv_value_word"></span> Only </td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="25%" style="text-align: center; padding: 3px;">
                        <span>Accepted</span><br><br><br><br><br>
                            <span>(Signature of the Guest)</span>
                        </td>
                        <td width="50%" style="text-align: center; padding: 3px;">
                         <br><br><br><br><br>This is a Computer Generated Invoice hence signature is not mandatory
                        </td>
                        <td width="25%" style="text-align: center; padding: 3px;">
                            <span>E & O.E</span><br><span>For SFDC Ltd</span><br><br><br><br>
                            <span>(Authorised Signatory)</span>
                        </td>
                    </tr>
                </table>

          </td>
        </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="width: 1000px;margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center; margin-top:20px;">
      <tr>
        <td width="40%" id="print_button" onClick="myFunction()"><a href="#" style="background:#ffa93c; padding:10px 15px; color:#fff; font-size:12px;  text-transform:uppercase;  font-weight:700; text-decoration:none;  float:left; text-align:center;  ">PRINT</a></td>
        <td width="20%">
		<a class="btn btn-success text-white" target="_blank" href="<?php echo base_url();?>admin/pos/pos_invoice_list/<?php echo encode_url($posHeader['property_id']);?>/<?php echo encode_url($posHeader['cost_center_id']);?>">Receivable</a>
		</td>
		<?php
		if($_GET['type'] == ''){
		?>
        <td width="40%" align="right" id="back_to"><a href="<?php echo base_url();?>admin/pos/product_sale/<?php echo encode_url($posHeader['cost_center_id'])?>/<?php echo encode_url($posHeader['property_id'])?>" style="background:#0080fd; padding:10px 15px; color:#fff; font-size:12px; font-weight:700; text-decoration:none;text-transform:uppercase; dispaly:block; text-align:right; ">Back to POS</a></td>
		<?php
		}
		?>
      </tr>
    </table>
<!-- </body>

</html> -->

<script>
    var sale_order_id = <?php echo $sale_order_id;?>;
    $(document).ready(function(){
        tax_invoice();
    });

 function tax_invoice(){

    $.ajax({
			type 		: 'POST',
			url 		: '<?php echo base_url("admin/pos/getPosDetail"); ?>',
			data 		: {csrf_test_name: '<?php echo $this->csrf['hash']; ?>', sale_order_id: sale_order_id },
			dataType 	: 'json',
			encode 		: true
		})
		.done(function(data) {
			if(data.status){
        	$('#unit_name').text(data.pos_header.cost_center_name);
			$('#property_name').text(data.pos_header.property_name);
			$('#property_addr').text(data.pos_header.address_line_1);
			$('#property_city').text(data.pos_header.city);
			$('#property_district').text(data.pos_header.district_name);
			$('#property_state').text(data.pos_header.state_name + ' & ' + data.pos_header.state_code);
			$('#property_state_code').text(data.pos_header.state_code);
			$('#property_pin').text(data.pos_header.pincode);
			$('#property_phone').text(data.pos_header.phone_no);
			$('#property_email').text(data.pos_header.email);
			$('#property_gstin').text(data.pos_header.gst_no);
			$('#pos_fssai').text(data.pos_header.fssai);
       		//$('#gst_no').html('19AAMFJ1635Q1ZO');
		
        $('#order_no').text('Order No. :'+data.pos_header.order_no);
        $('#hsn_sac').text(data.pos_header.hsn_sac_code);
        if(data.pos_header.payment_option==1){
          $('#invoice_type').text('Tax Invoice');
          $('#inv_no').text(data.pos_header.invoice_no);
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
		var base_value = 0;
		var price_before_gst = 0;
		var cgst_per =0;
		var sgst_per =0;
		var csgt_amount =0;
		var sgst_amount =0;
		
        $.each(data.pos_detail, function(key, value) {j++;
           // alert(value.rate);
          result += '<tr>';
          result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">'+j+'</td>';
          result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">'+value.product_service_name+'</td>';
          result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.rate).toFixed(2)+'</td>';
          result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseInt(value.quantity)+'</td>';
		  
          result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.price).toFixed(2)+'</td>';
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;"></td>';
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.price).toFixed(2)+'</td>';
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+value.sac_code+'</td>';
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.cgst_percent).toFixed(2)+'</td>';
		  
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.cgst).toFixed(2)+'</td>';
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.sgst_percent).toFixed(2)+'</td>';
		  
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.sgst).toFixed(2)+'</td>';
		  
		  result += '  <td  style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: right;">'+parseFloat(value.payable_amount).toFixed(2)+'</td>';
          result += '</tr>';
		  
          without_tax_total += value.rate * 1;
          total_item += parseInt(value.quantity) * 1;
		  with_tax_total += value.payable_amount * 1;
		  gst_amount += value.igst * 1;
		  base_value += value.price *1;
		  price_before_gst += value.price *1;
		  cgst_per += value.cgst_percent * 1;
		  sgst_per += value.sgst_percent * 1;
		  csgt_amount += value.cgst * 1;
		  sgst_amount += value.sgst * 1;
        });
        $('#pos_detail').html(result);
        $('#gt').text(parseFloat(without_tax_total).toFixed(2));
        $('#ti').text(total_item);
		$('#gst_amt').text(parseFloat(gst_amount).toFixed(2));
		$('#with_tax_total').text(parseFloat(with_tax_total).toFixed(2));
		$('#base_value').text(parseFloat(base_value).toFixed(2));
		$('#price_before_gst').text(parseFloat(price_before_gst).toFixed(2));
        $('#pbt').text(parseFloat(without_tax_total).toFixed(2));
        $('#cgst').text(parseFloat(cgst_per).toFixed(2));
        $('#sgst').text(parseFloat(sgst_per).toFixed(2));
        $('#cgst_amt').text(parseFloat(csgt_amount).toFixed(2));
        $('#sgst_amt').text(parseFloat(sgst_amount).toFixed(2));
		$('#total_inv_value_word').text(NumInWords(with_tax_total));
		
		
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

function NumInWords (number) {
  const first = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
  const tens = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];
  const mad = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];
  let word = '';

  for (let i = 0; i < mad.length; i++) {
    let tempNumber = number%(100*Math.pow(1000,i));
    if (Math.floor(tempNumber/Math.pow(1000,i)) !== 0) {
      if (Math.floor(tempNumber/Math.pow(1000,i)) < 20) {
        word = first[Math.floor(tempNumber/Math.pow(1000,i))] + mad[i] + ' ' + word;
      } else {
        word = tens[Math.floor(tempNumber/(10*Math.pow(1000,i)))] + ' ' + first[Math.floor(tempNumber/Math.pow(1000,i))%10] + mad[i] + ' ' + word;
      }
    }

    tempNumber = number%(Math.pow(1000,i+1));
    if (Math.floor(tempNumber/(100*Math.pow(1000,i))) !== 0) word = first[Math.floor(tempNumber/(100*Math.pow(1000,i)))] + 'hunderd ' + word;
  }
    return word;
}


</script> 