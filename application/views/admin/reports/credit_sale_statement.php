<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Credit Sale Statement</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>

        <div class="row g-3 mb-3 align-items-center updateMsg">
            <?php echo $this->session->flashdata('msg'); ?>
        </div>

        <div class="app-card app-card-orders-table shadow-sm mb-3">
            <div class="app-card-body p-3">
                <form id="saleForm" action="" method="post">

                    <input type="hidden" class="csrfToken" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <input type="hidden" name="fDate" id="fDate">
                    <input type="hidden" name="tDate" id="tDate">

                    <div class="row g-3">
                        <div class="col-lg-3 col-sm-12 col-md-4">
                            <label for="" class="form-label">Select Harbour <span class="asterisk"></span></label>
                            <select name="property_id" class="form-select select2" id="property_id" required>
                            <option value="">Select Harbour</option>

                                <?php if(!empty($property_list)){ ?>

                                    <?php foreach($property_list as $property){ ?>
                                        <option value="<?php echo $property['property_id']; ?>" <?php if(!empty($property_id)){ if($property['property_id'] == $property_id){ echo 'selected'; } } ?>><?php echo $property['property_name']; ?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-12 col-md-4">
                            <label for="" class="form-label">Select From Date</label>
                            <div class="date-container">
                                <input type="text" name="bill_from_date" class="form-control bill_from_date" id="bill_from_date" value="<?php if(!empty($bill_from_date)){ echo $bill_from_date; } ?>" required>
                                <i class="date-icon fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 col-md-4">
                            <label for="" class="form-label">Select To Date</label>
                            <div class="date-container">
                                <input type="text" name="bill_to_date" class="form-control bill_to_date" id="bill_to_date" value="<?php if(!empty($bill_to_date)){ echo $bill_to_date; } ?>" required>
                                <i class="date-icon fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-4">
                            <label for="" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
                            <!--<input type="submit" class="form-select btn app-btn-primary saleformSubmit" name="search" value="Search">-->
                            <button type="submit" class="form-select btn app-btn-primary saleformSubmit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm mb-3 p-3">

            <?php if(!empty($property_id)){ ?>
                <div class="app-card-body" style="margin-bottom: 10px;">
                    <a href="<?php echo base_url(); ?>admin/reports/credit_sale_statement_report/<?php echo encode_url($property_id); ?>/<?php echo encode_url($bill_from_date); ?>/<?php echo encode_url($bill_to_date); ?>" class="buttons-html5 btn app-btn-primary" target="_blank"><span>Download PDF</span></a>
                </div>
            <?php } ?>

            <div class="app-card-body" style="max-height:488px; overflow-y:scroll;">

                <div class="table-responsive">

                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 11px; padding: 0;text-align: center;" class="pagebreak">

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

                                <?php } ?>                               


                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>


    </div>
</div>
<!--//app-content-->
	
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<script type="text/javascript">
	$( document ).ready(function() {

        $(function() {
            $('#bill_from_date').datepicker({ 
                maxDate: new Date,
                dateFormat: 'dd-mm-yy',
                onSelect: function(date) {
                        $("#bill_to_date").datepicker('option', 'minDate', date);
                    }
            });  
            $( "#bill_to_date" ).datepicker({  
                maxDate: new Date,
                dateFormat: 'dd-mm-yy',
                onSelect: function(date) {
                            $("#bill_from_date").datepicker('option', 'maxDate', date);
                        } 
            });
        });

        $(document).on('click', '.saleformSubmit', function(e) {

            e.preventDefault();

            $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');

            setTimeout(function () {
                $('#saleForm').submit();
            }, 2000);

        });


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

    });
</script>