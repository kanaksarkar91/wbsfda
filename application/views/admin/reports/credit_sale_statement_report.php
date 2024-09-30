<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>	Statement</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
        
        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
            }
            .pagebreak {
                clear: both;
                page-break-after: always;
            }
        }
    </style>
</head>

<body role="document">
    <!--<div class="" id="printArea">-->
        <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 1240px; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;" class="pagebreak">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom: 10px;">
                        <tr>
                            <td width="20%" style="text-align: left;padding:10px;">
                                <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/Biswa_Bangla_logo.jpg" width="64" alt="..." />
                            </td>
                            <td width="60%" style="text-align: center;">
                                <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;">The State Fisheries Development Corporation Limited</h3>
                                <h3 style="margin-top:10px; font-size:14px;margin-bottom: 0px;line-height:1;font-weight:600;"><?php echo ucfirst($property_details['property_name']); ?></h3>
                                <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;"><?php echo ucfirst($property_details['address_line_1']); ?>, <?php echo ucfirst($property_details['city']); ?>, <?php echo ucfirst($property_details['district_name']); ?></p>
                                <!-- <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;">Bikash Bhawan, North Block, 1st Floor, Salt Lake, Kolkata - 700 091, West Bengal</p> -->
                                <!-- <h2 style="text-align:center;font-size:12px;font-weight: 600;">Tax Invoice</h2> -->
                            </td>
                            <td width="20%" style="text-align: right;padding-right:10px;">
                                <img src="https://wbsfdc.devserv.in/public/frontend_assets/assets/img/SFDC_logo.jpg" width="64" alt="..." style="margin-top:10px;" />
                            </td>
                            <input type="hidden" class="fDate" value="<?php echo $fDate; ?>">
                            <input type="hidden" class="tDate" value="<?php echo $tDate; ?>">
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    
                    <?php if(!empty($creditsale_statement)){ ?>

                        <?php $i = 1; ?>
                        <?php foreach($creditsale_statement as $statement){ ?>

                            <?php if($i == 1){ ?>

                                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                                    <tr>
                                        <td width="25%" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;">HEAD OF REVENUE</td>
                                        <td width="" colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($fDate)){ echo 'Statement from '.$fDate.' to '.$tDate; } ?></td>
                                    </tr> 
                                </table>

                            <?php } else { ?>

                                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                                    <tr>
                                        <td width="13%" style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"></td>
                                        <td width="" colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($fDate)){ echo 'Statement from '.$fDate.' to '.$tDate; } ?></td>
                                    </tr> 
                                </table>

                            <?php } ?>

                            <table class="statementTable" cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">

                                <tr>
                                    <td colspan="9" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;">
                                        <?php if($statement['harbour_product_id'] == 1){ echo 'FUEL SECTION--HSD'; } else if($statement['harbour_product_id'] == 2){ echo 'ICE SECTION (INCLUDING GST)'; } else { echo $statement['harbour_product_name']; } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php echo $statement['harbour_product_name']; ?></td>
                                    <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Sl No.</td>
                                    <td width="50%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">MODE OF SALES</td>
                                    <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">QTY</td>
                                    <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">AMOUNT RS.</td>
                                </tr>

                                <?php if($statement['harbour_product_id'] == 1 || $statement['harbour_product_id'] == 2){ ?>

                                    <tr>
                                        <td rowspan="3" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
                                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">1</td>
                                        <td style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Cash</td>
                                        <td class="qtyTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($statement['statement_list'][0]['total_cash_qty'])){ echo $statement['statement_list'][0]['total_cash_qty']; } else { echo '0'; } ?></td>
                                        <td class="amtTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($statement['statement_list'][0]['total_cash_amount'])){ echo $statement['statement_list'][0]['total_cash_amount']; } else { echo '0.00'; } ?></td>
                                    </tr>

                                    <tr>                                        
                                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">2</td>
                                        <td style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Credit</td>
                                        <td class="qtyTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($statement['statement_list'][1]['total_credit_qty'])){ echo $statement['statement_list'][1]['total_credit_qty']; } else { echo '0.00'; } ?></td>
                                        <td class="amtTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($statement['statement_list'][1]['total_credit_amount'])){ echo $statement['statement_list'][1]['total_credit_amount']; } else { echo '0.00'; } ?></td>
                                    </tr>

                                <?php } else { ?>

                                    <tr>
                                        <td rowspan="3" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
                                        <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">1</td>
                                        <td style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Cash</td>
                                        <td class="qtyTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($statement['statement_list'][0]['total_cash_amount'])){ echo '1'; } else { echo '0'; } ?></td>
                                        <td class="amtTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($statement['statement_list'][0]['total_cash_amount'])){ echo $statement['statement_list'][0]['total_cash_amount']; } else { echo '0.00'; } ?></td>
                                    </tr>

                                <?php } ?>

                                <tr>                                        
                                    <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
                                    <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><b> TOTAL</b></td>
                                    <td class="qtygrandTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">0</td>
                                    <td class="amtgrandTotal" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">0.00</td>
                                </tr>

                            </table>

                            <?php $i++; ?>
                        <?php } ?>

                    <?php } ?>

                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid; text-align:left;">
                        <tr>
                            <td width="13%" style="font-size:11px; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: left;"></td>
                            <td width="" colspan="5" style="font-size:11px; border-bottom: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($fDate)){ echo 'Statement from '.$fDate.' to '.$tDate; } ?></td>
                        </tr> 
                    </table>

                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #9e9e9e 1px solid;">
                        <tr>
                            <td colspan="9" style="font-size:11px; background-color:#d9d9d9; padding: 3px;border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;text-align: center;">
                                RECOVERY AMOUNT
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">RECOVERY AMOUNT</td>
                            <td width="5%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Sl No.</td>
                            <td width="50%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">NAME</td>
                            <td width="10%" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">AMOUNT RS.</td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
                            <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">1</td>
                            <td style="text-align: left; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">Cash</td>
                            <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($creditsale_recovary['total_recovary_sale_amount'])){ echo $creditsale_recovary['total_recovary_sale_amount']; } else { echo '0.00'; } ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;">&nbsp;</td>
                            <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><b> TOTAL</b></td>
                            <td style="text-align: center; border-bottom: #9e9e9e 1px solid;border-right: #9e9e9e 1px solid;padding: 3px;"><?php if(!empty($creditsale_recovary['total_recovary_sale_amount'])){ echo $creditsale_recovary['total_recovary_sale_amount']; } else { echo '0.00'; } ?></td>
                        </tr>
                    </table>

                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;" class="page-footer">
                        <tr>
                            <td width="30%" style="text-align: center; padding: 3px;">
                                <br><br><br><br>
                                <span>Prepared by</span>
                            </td>
                            <td width="30%" style="text-align: center; padding: 3px;">
                                <br><br><br><br>
                                <span>Head Assistant</span>
                            </td>
                            <td width="30%" style="text-align: center; padding: 3px;">
                                <br><br><br><br>
                                <span>Special officer</span>
                                <br>
                                <span>shankarpur Fishing Harbour</span>
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
        
    <!--</div>-->

    <script type="text/javascript">
        $( document ).ready(function() {

            $('table.statementTable').each(function() {

                //alert($(this).find('td.qtyTotal').text());

                var qtygrandTotal = 0;
                var amtgrandTotal = 0;

                $(this).find('td.qtyTotal').each(function() {
                    var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
                    if (!isNaN(value)) { // Check if it's a valid number
                        qtygrandTotal += value; // Add it to the sum
                    }
                });

                $(this).find('td.amtTotal').each(function() {
                    var value = parseInt($(this).text()); // Get the content of the <td> and parse it as an integer
                    if (!isNaN(value)) { // Check if it's a valid number
                        amtgrandTotal += value; // Add it to the sum
                    }
                });

                $(this).find('td.qtygrandTotal').each(function() {
                    $(this).text(qtygrandTotal.toFixed(2));
                });

                $(this).find('td.amtgrandTotal').each(function() {
                    $(this).text(amtgrandTotal.toFixed(2));
                });

            });

            $(document).on('click', '#downloadAcc', function() {

                var fDate = $('.fDate').val();
                var tDate = $('.tDate').val();

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
					doc.save('Credit_Sale_Statement_Report_'+fDate+'_'+tDate+'.pdf');
				});
				
			});

        });
    </script>
</body>

</html>