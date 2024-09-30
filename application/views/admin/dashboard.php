<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Dashboard</h1>
			
        <div class="app-card shadow-sm mb-4" role="alert">
                <div class="app-card-body p-3">
                    <h3 class="mb-2">Welcome to SFDA Admin</h3>
				<?php
				if($this->admin_session_data['role_id'] == ROLE_SUPERADMIN){
				?>
                    <div class="row g-3">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-home"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">No. of Guest Houses</span>
                                    <span class="info-box-number text-left"><?=$dashBoardDetail['total_guest_house'];?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Booking Count</span>
                                    <span class="info-box-number text-left"><?=$dashBoardDetail['total_booking'];?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-rupee"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Revenue</span>
                                    <span class="info-box-number text-right"><?=number_format($total_revenue,2);?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-users"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">No. of Customers</span>
                                    <span class="info-box-number text-left"><?=$dashBoardDetail['total_customer'];?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
				<?php
				}
				else {
				?>
					
					<div class="row g-3">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Booking Count</span>
                                    <span class="info-box-number text-left"><?=$guestHouseBooking['total_booking'];?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-rupee"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Guest House Revenue</span>
                                    <span class="info-box-number text-right"><?=number_format($guestHouseRevenue['total_revenue'],2);?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <a href="#."> 
                                <div class="info-box bg-light shadow mb-0">
                                    <span class="info-box-icon"><i class="fa fa-rupee"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Restaurant Revenue</span>
                                    <span class="info-box-number text-left"><?=number_format($posRevenue['total_revenue'],2);?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
					
				<?php
				}
				?>
                    
                    <!--//row-->
                </div>
                <!--//app-card-body-->
        </div>
        <!--//app-card-->
		<form method="post" class="row g-2">
		<input type="hidden" name="<?=$this->csrf['name']; ?>" value="<?=$this->csrf['hash']; ?>">
        <div class="row">
            <div class="col-lg-6">
                <div class="app-card shadow-sm mb-4">
                    <div class="d-flex flex-column align-items-start p-3">
                        <h5>GUEST HOUSES REVENUE (IN RUPEES)</h5>
						
                        <div>
                            <div class="input-group">
                                <select class="form-select select2" name="property" onchange="this.form.submit();" style="width:300px;">
									<option value="">Select Property</option>
									<?php

									if (isset($properties))
										foreach ($properties as $p) {

									?>
									<option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($property) && $property == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
									<?php } ?>
								</select>
								
                                <select name="financial_year" class="form-select" onchange="this.form.submit();" style="width:150px;">
								<?php
								if(!empty($financial_years)){
									foreach($financial_years as $fy){
								?>
									<option value="<?= $fy['financial_year'];?>" <?= set_select('financial_year', $fy['financial_year'], isset($financialYear) && $financialYear == $fy['financial_year'] ? true : false); ?>><?= $fy['financial_year'];?></option>
								<?php
									}
								}
								?>
								</select>
                            </div>
                        </div>
						
                    </div>
                    <div class="app-card-body p-3">
                        <div id="revenuebarchart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="app-card shadow-sm mb-4">
                    <div class="d-flex flex-column align-items-start p-3">
                        <h5>MONTH WISE BOOKING</h5>
                        
                        <div>
                            <div class="input-group">
                                <select class="form-select select2" name="property_b"  onchange="this.form.submit();" style="width:300px;">
									<option value="">Select Property</option>
									<?php

									if (isset($properties))
										foreach ($properties as $pb) {

									?>
									<option value="<?= $pb['property_id']; ?>" <?= set_select('property_b', $pb['property_id'], isset($property_b) && $property_b == $pb['property_id'] ? true : false); ?>><?= $pb['property_name']; ?></option>
									<?php } ?>
								</select>
								
                                <select name="financial_year_b" class="form-select" onchange="this.form.submit();" style="width:150px;">
								<?php
								if(!empty($financial_years)){
									foreach($financial_years as $fy){
								?>
									<option value="<?= $fy['financial_year'];?>" <?= set_select('financial_year_b', $fy['financial_year'], isset($financialYearB) && $financialYearB == $fy['financial_year'] ? true : false); ?>><?= $fy['financial_year'];?></option>
								<?php
									}
								}
								?>
								</select>
                            </div>
                        </div>
						
                    </div>
                    <div class="app-card-body p-3">
                        <div id="bookingbarchart"></div>
                    </div>
                </div>
            </div>
           
        </div>
       </form> 

    </div>
    <!--//container-fluid-->

    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
    <script src="<?= base_url('public/admin_assets/js/apexcharts.js') ?>"></script>
    <script type="text/javascript">
        /* revenuebarchart */
var optionsRevenuebar = {
    series: [{
        name: 'Monthly Revenue',
        data: [<?=$revenues;?>]
    }],
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
        show: false,
        },
    },
    plotOptions: {
        bar: {
            /* borderRadius: 10, */
            dataLabels: {
                position: 'top',
            },
        }
    },
    dataLabels: {
        enabled: true,
        offsetY: -15,
        style: {
            fontSize: '10px',
            colors: ["#304758"]
        }
    },
    colors: '#00bdd6',
    xaxis: {
        categories: [<?=$months;?>],
        position: 'bottom',
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        crosshairs: {
            fill: {
                opacity: 1
            }
        },
        tooltip: {
            enabled: true,
        }
    },
    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
        },
        title: {
            text: 'TOTAL AMOUNT OF REVENUE (IN Rs.) EARNED'
        }
    },
    /* title: {
        text: 'Month Wise Collection',
        floating: true,
        offsetY: 335,
        align: 'center',
        style: {
            color: '#444'
        }
    } */
};

var chartRevenuebar = new ApexCharts(document.querySelector("#revenuebarchart"), optionsRevenuebar);
chartRevenuebar.render();


/* bookingbarchart */
var optionsBookingbar = {
    series: [{
        name: 'Monthly Booking',
        data: [<?=$booking;?>]
    }],
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
        show: false,
        },
    },
    plotOptions: {
        bar: {
            /* borderRadius: 10, */
            dataLabels: {
                position: 'top',
            },
        }
    },
    dataLabels: {
        enabled: true,
        offsetY: -15,
        style: {
            fontSize: '10px',
            colors: ["#304758"]
        }
    },
    colors: '#00bdd6',
    xaxis: {
        categories: [<?=$monthsB;?>],
        position: 'bottom',
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        crosshairs: {
            fill: {
                opacity: 1
            }
        },
        tooltip: {
            enabled: true,
        }
    },
    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
        },
        title: {
            text: 'MONTH WISE BOOKING COUNT'
        }
    },
    /* title: {
        text: 'Month Wise Collection',
        floating: true,
        offsetY: 335,
        align: 'center',
        style: {
            color: '#444'
        }
    } */
};

var chartBookingbar = new ApexCharts(document.querySelector("#bookingbarchart"), optionsBookingbar);
chartBookingbar.render();


var optionsAgreementpie = {
          series: [44, 55, 13],
          chart: {
          width: '100%',
          height: 397,
          type: 'donut',
        },
        colors: ['#fbb140', '#2dce89', '#11cdef'],
        labels: ['Lease Rent Agreement', 'Leave & License Agreement', 'Self Managed Collection'],
        legend: {
            position: 'bottom',
            show: true,
            /* offsetY: 15, */
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            /* legend: {
              show: true,
              position: 'bottom'
            } */
          }
        }]
        };

        var chartAgreementpie = new ApexCharts(document.querySelector("#agreementpie"), optionsAgreementpie);
        chartAgreementpie.render();
    </script>


