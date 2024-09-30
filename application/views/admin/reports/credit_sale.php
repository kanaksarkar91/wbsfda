<!--<div class="app-wrapper">-->
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container">
        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Credit Sale Report</h1>
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
                            <label for="" class="form-label">Select Product <span class="asterisk"></span></label>
                            <select name="product_id" class="form-select select2" id="product_id" required>
                            <option value="">Select Product</option>

                                <?php if(!empty($product_list)){ ?>

                                    <?php foreach($product_list as $product){ ?>
                                        <option value="<?php echo $product['harbour_product_id']; ?>" <?php if(!empty($product_id)){ if($product['harbour_product_id'] == $product_id){ echo 'selected'; } } ?>><?php echo $product['harbour_product_name']; ?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-4">
                            <label for="" class="form-label">Select Financial Year <span class="asterisk"></span></label>
                            <select name="financial_year" class="form-select select2" id="financial_year" required>
                                <option value="">Select Year</option>
                                <option value="2022" <?php if(!empty($financial_year)){ if($financial_year == '2022'){ echo 'selected'; } } ?>>2022-23</option>
                                <option value="2023" <?php if(!empty($financial_year)){ if($financial_year == '2023'){ echo 'selected'; } } ?>>2023-24</option>
                                <option value="2024" <?php if(!empty($financial_year)){ if($financial_year == '2024'){ echo 'selected'; } } ?>>2024-25</option>
                                <option value="2025" <?php if(!empty($financial_year)){ if($financial_year == '2025'){ echo 'selected'; } } ?>>2025-26</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-12 col-md-4">
                            <label for="" class="form-label">Select Month<span class="asterisk"></span></label>
                            <select name="billing_month" class="form-select select2" id="billing_month" required>
                                <option value="">Select Month</option>
                                <option value="01" <?php if(!empty($billing_month)){ if($billing_month == '01'){ echo 'selected'; } } ?>>Jan</option>
                                <option value="02" <?php if(!empty($billing_month)){ if($billing_month == '02'){ echo 'selected'; } } ?>>Feb</option>
                                <option value="03" <?php if(!empty($billing_month)){ if($billing_month == '03'){ echo 'selected'; } } ?>>Mar</option>
                                <option value="04" <?php if(!empty($billing_month)){ if($billing_month == '04'){ echo 'selected'; } } ?>>Apr</option>
                                <option value="05" <?php if(!empty($billing_month)){ if($billing_month == '05'){ echo 'selected'; } } ?>>May</option>
                                <option value="06" <?php if(!empty($billing_month)){ if($billing_month == '06'){ echo 'selected'; } } ?>>June</option>
                                <option value="07" <?php if(!empty($billing_month)){ if($billing_month == '07'){ echo 'selected'; } } ?>>July</option>
                                <option value="08" <?php if(!empty($billing_month)){ if($billing_month == '08'){ echo 'selected'; } } ?>>Aug</option>
                                <option value="09" <?php if(!empty($billing_month)){ if($billing_month == '09'){ echo 'selected'; } } ?>>Sep</option>
                                <option value="10" <?php if(!empty($billing_month)){ if($billing_month == '10'){ echo 'selected'; } } ?>>Oct</option>
                                <option value="11" <?php if(!empty($billing_month)){ if($billing_month == '11'){ echo 'selected'; } } ?>>Nov</option>
                                <option value="12" <?php if(!empty($billing_month)){ if($billing_month == '12'){ echo 'selected'; } } ?>>Dec</option>
                            </select>
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
                    <a href="<?php echo base_url(); ?>admin/reports/credit_sale_report/<?php echo encode_url($property_id); ?>/<?php echo encode_url($product_id); ?>/<?php echo encode_url($financial_year); ?>/<?php echo encode_url($billing_month); ?>" class="buttons-html5 btn app-btn-primary" target="_blank"><span>Download PDF</span></a>
                </div>
            <?php } ?>

            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle app-table-hover mb-0 small w-100" id="creditSale">
                        <thead style="font-size: .75rem; background-color: #608d5f; color: #fff;">
                            <tr>
                                <th>SL NO.</th>
                                <th>NAME OF THE PARTY</th>
                                <th class="text-end">OPENING OUTSTANDING <span class="monthStartdate"><?php if(!empty($fDate)){ echo $fDate; } else { echo '01.11.2023'; } ?></span></th>
                                <th class="text-end">CREDIT SALE</th>
                                <th class="text-end">COLLECTION DURING THE MONTH</th>
                                <th class="text-end">OUTSTANDING DUES AT THE END OF THE MONTH <span class="monthEnddate"><?php if(!empty($tDate)){ echo $tDate; } else { echo '30.11.2023'; } ?></span></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(!empty($creditsale_list)){ ?>

                                <?php $i = 1; ?>
                                <?php foreach($creditsale_list as $sale){ ?>										

                                    <tr class="saleItem">											

                                        <td><?php echo $i; ?></td>
                                        <td class=""><?php echo $sale['harbour_buyer_name']; ?></td>
                                        <td class="text-end creditLast"><?php echo number_format((float)($sale['total_credit_last'] - $sale['total_collection_last']), 2, '.', ''); ?></td>
                                        <td class="text-end creditCurrent"><?php if(!empty($sale['total_credit_current'])){ echo $sale['total_credit_current']; } else { echo '0.00'; } ?></td>
                                        <td class="text-end collectionCurrent"><?php if(!empty($sale['total_collection_current'])){ echo $sale['total_collection_current']; } else { echo '0.00'; } ?></td>
                                        <td class="text-end outstandingCurrent"><?php echo number_format((float)((($sale['total_credit_last'] - $sale['total_collection_last']) + $sale['total_credit_current']) - $sale['total_collection_current']), 2, '.', ''); ?></td>
                                                                                
                                    </tr>

                                    <?php $i++; ?>
                                <?php } ?>	

                            <?php } else { ?>
                                <tr><td colspan="6">No Data Found</td></tr>
                            <?php } ?>                        
                            
                        </tbody>
                        
                        <tfoot class="w-100" style="background-color: #1a4919; font-size: 1.0rem;color: #fff;">
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-end openingoutstandingTotal"></td>
                                <td class="text-end creditsaleTotal"></td>
                                <td class="text-end collectionTotal"></td>
                                <td class="text-end closingoutstandingTotal"></td>
                            </tr>
                        </tfoot>

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

        $(document).on('click', '.saleformSubmit', function(e) {

            e.preventDefault();

            $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');

            var financialYear = $('#financial_year').val();
            var billingMonth = $('#billing_month').val();

            var fYear = '';
            var fMonth = '';

            if(billingMonth >= '01' && billingMonth <= '03'){ //2023-2024		

                fYear = parseInt(financialYear) + parseInt('1');
                fMonth = billingMonth;

            } else if(billingMonth > '03' && billingMonth <= '12') {

                fYear = financialYear;
                fMonth = billingMonth;

            }

            $('#fDate').val('01.'+fMonth+'.'+fYear);
            $('#tDate').val('30.'+fMonth+'.'+fYear);

            $('.monthStartdate').text('01.'+fMonth+'.'+fYear);
            $('.monthEnddate').text('30.'+fMonth+'.'+fYear);

            setTimeout(function () {
                $('#saleForm').submit();
            }, 2000);

        });


        /*var openingoutstandingTotalSum = 0;
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
        $('.closingoutstandingTotal').text(closingoutstandingTotalSum.toFixed(2));*/


        var today = new Date();
		$('#creditSale').DataTable( {
		/*"order": [[ 3, "desc" ]],
		"paging": false,
		"showNEntries" : false,
		"bPaginate": false,
			"bFilter": false,*/
			"scrollCollapse": true,
			"scrollY": '448px',
			"scrollX": 'true',
			"bInfo": false,
			"ordering": false,
			"bPaginate": false,
			//"dom": 'Bfrtip',
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;

				// converting to interger to find total
				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};

				// computing column Total of the complete result 
				var openingSum = api
					.column( 2, {page:'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );	
                    
                var creditsaleSum = api
					.column( 3, {page:'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );

                var collectionSum = api
					.column( 4, {page:'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );

                var outstandingSum = api
					.column( 5, {page:'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				
					
				// Update footer by showing the total with the reference of the column index 
				$( api.column( 0 ).footer() ).html('Total');
				$( api.column( 2 ).footer() ).html(openingSum.toFixed(2));
                $( api.column( 3 ).footer() ).html(creditsaleSum.toFixed(2));
                $( api.column( 4 ).footer() ).html(collectionSum.toFixed(2));
                $( api.column( 5 ).footer() ).html(outstandingSum.toFixed(2));
				
			},
			/*buttons: [{
				"extend": 'excel',
				"footer": true,
				"text": 'Download Excel', 
				exportOptions: {
				columns: ':visible',
				orthogonal: null,
				format: {
					body: function (data, row, column, node) {
					var momentDate = moment(data, 'DD/MM/YYYY', true);
						if (momentDate.isValid()) {
							return momentDate.format('YYYY-MM-DD');
							}
						else {
							return data;
							}
						}
					}
				} ,     
				'className': 'btn app-btn-primary',
				'filename': 'Venue_Booking_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
				},
				{
				"extend": 'csv',
				"footer": true,
				"text": 'Download CSV',
				'className': 'btn app-btn-primary',
				'filename': 'Venue_Booking_Report'+ today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'_'+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
				}
			],
			initComplete: function() {
				var btns = $('.dt-button');
				btns.removeClass('dt-button');
			},*/
			"searching": false
			
		});

    });
</script>