<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Credit Sale Report</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center; border:1px solid #000;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                    <tr>
                        <td width="20%" style="text-align: left;padding:10px;">
                            <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.jpg" width="64" alt="..." />
                        </td>
                        <td width="60%" style="text-align: center;">
                            <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                            <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">Unit - <?php echo ucfirst($property_details['property_name']); ?></h3>
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;"><?php echo ucfirst($property_details['address_line_1']); ?>, <?php echo ucfirst($property_details['city']); ?>, <?php echo ucfirst($property_details['district_name']); ?></p>
                            <!-- <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">Bikash Bhawan, North Block, 1st Floor, Salt Lake, Kolkata - 700 091, West Bengal</p> -->
                            <h2 style="text-align:center;font-size:12px;font-weight: 600;">Credit Sale Report Of <?php echo $product_details['harbour_product_name']; ?> For The Month Of <span class="sMonth"><?php echo $billing_month; ?></span> - <span class="sYear"><?php echo $financial_year; ?></span></h2>
                        </td>
                        <td width="20%" style="text-align: right;padding-right:10px;">
                            <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.jpg" width="64" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">

                    <tr>
                        <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; background-color:#d9d9d9;">SL NO.</td>
                        <td width="30%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; background-color:#d9d9d9;">NAME OF THE PARTY</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; background-color:#d9d9d9;">OPENING OUTSTANDING 01.11.2023</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; background-color:#d9d9d9;">CREDIT SALE</td>
                        <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; background-color:#d9d9d9;">COLLECTION DURING THE MONTH</td>
                        <td width="12%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; background-color:#d9d9d9;">OUTSTANDING DUES AT THE END OF THE MONTH 30.11.2023</td>
                    </tr>

                    <?php if(!empty($creditsale_list)){ ?>

                        <?php $i = 1; ?>
                        <?php foreach($creditsale_list as $sale){ ?>										

                            <tr class="saleItem">											

                                <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $i; ?></td>
                                <td width="30%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $sale['harbour_buyer_name']; ?></td>
                                <td width="10%" class="creditLast" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo number_format((float)($sale['total_credit_last'] - $sale['total_collection_last']), 2, '.', ''); ?></td>
                                <td width="12%" class="creditCurrent" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($sale['total_credit_current'])){ echo $sale['total_credit_current']; } else { echo '0.00'; } ?></td>
                                <td width="6%" class="collectionCurrent" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($sale['total_collection_current'])){ echo $sale['total_collection_current']; } else { echo '0.00'; } ?></td>
                                <td width="12%" class="outstandingCurrent" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo number_format((float)((($sale['total_credit_last'] - $sale['total_collection_last']) + $sale['total_credit_current']) - $sale['total_collection_current']), 2, '.', ''); ?></td>
                                                                        
                            </tr>

                            <?php $i++; ?>
                        <?php } ?>	

                        <tr>
                            <td colspan="2" style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px; text-align: center;"><b>Total</b></td>
                            <td class="openingoutstandingTotal" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">0.00</td>
                            <td class="creditsaleTotal" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">0.00</td>
                            <td class="collectionTotal" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">0.00</td>
                            <td class="closingoutstandingTotal" style="text-align: right; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">0.00</td>
                        </tr>

                    <?php } else { ?>
                        <tr><td colspan="6">No Data Found</td></tr>
                    <?php } ?>   
                    
                </table>
               
                
                
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                    <tr>
                        <td width="70%" style="text-align: left; padding: 3px;">
                            <ul style="padding: 0;margin: 0;">
                                <li style="list-style:none;padding-bottom:5px;"><span style="text-align: left;"><b>Outstanding credit sale recovered @<span class="recovPercentage">17</span>%</b></span></li>
                               
                            </ul>
                        </td>
                        <td width="30%" style="text-align: center; padding: 3px;">
                            <br><br><br><br>
                            <span>Special Offiter  </span><br><br><br><br>
                            <span>Deshapran Fishing Harbour</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 10px auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;">
		<tr class="btnTR">
            <td>
				<!--<button class="printAcc" onclick='printDiv();'>Print</button>
				<button style="background: #00bdd6; padding: 6px 10px; color: #FFF; border-radius: 6px;" id="printAcc">Print</button>-->
				<button style="background: #198754; padding: 6px 10px; color: #FFF; border-radius: 6px;" id="downloadAcc">Download PDF</button>
            </td>
        </tr>
	</table>


    <script type="text/javascript">

        $( document ).ready(function() {

            var openingoutstandingTotalSum = 0;
            var creditsaleTotalSum = 0;
            var collectionTotalSum = 0;
            var closingoutstandingTotalSum = 0;

            $('td.creditLast').each(function() {
                var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
                if (!isNaN(value)) { // Check if it's a valid number
                    openingoutstandingTotalSum += value; // Add it to the sum
                }
            });

            $('td.creditCurrent').each(function() {
                var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
                if (!isNaN(value)) { // Check if it's a valid number
                    creditsaleTotalSum += value; // Add it to the sum
                }
            });

            $('td.collectionCurrent').each(function() {
                var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
                if (!isNaN(value)) { // Check if it's a valid number
                    collectionTotalSum += value; // Add it to the sum
                }
            });

            $('td.outstandingCurrent').each(function() {
                var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
                if (!isNaN(value)) { // Check if it's a valid number
                    closingoutstandingTotalSum += value; // Add it to the sum
                }
            });

            $('.openingoutstandingTotal').text(openingoutstandingTotalSum.toFixed(2));
            $('.creditsaleTotal').text(creditsaleTotalSum.toFixed(2));
            $('.collectionTotal').text(collectionTotalSum.toFixed(2));
            $('.closingoutstandingTotal').text(closingoutstandingTotalSum.toFixed(2));


            var recoverPercentage = (collectionTotalSum / (openingoutstandingTotalSum + creditsaleTotalSum)) * 100;

            if(isNaN(recoverPercentage)){
                $('.recovPercentage').text('0.00');
            } else {
                $('.recovPercentage').text(recoverPercentage.toFixed(2));
            }          


            $(document).on('click', '#downloadAcc', function() {

                var sMonth = $('.sMonth').text();
                var sYear = $('.sYear').text();

				// Get the table element
				var table = document.getElementById('printArea');

				html2canvas(table).then((canvas) => {
					window.jsPDF = window.jspdf.jsPDF
					var imgWidth = 287;
					var pageHeight = 295;
					var imgHeight = (canvas.height * imgWidth) / canvas.width;
					var heightLeft = imgHeight;
					var position = 5;
					heightLeft -= pageHeight;
					var doc = new jsPDF('l', 'mm');
					doc.addImage(canvas, 'PNG', 5, position, imgWidth, imgHeight);
					while (heightLeft >= 0) {
						position = heightLeft - imgHeight;
						doc.addPage();
						doc.addImage(canvas, 'PNG', 5, position, imgWidth, imgHeight);
						heightLeft -= pageHeight;
					}
					doc.save('Credit_Sale_Report_'+sMonth+'_'+sYear+'.pdf');
				});
				
			});

        });

    </script>

</body>

</html>