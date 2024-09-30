<section class="page">
    <div class="page-header" style="background-image:url(assets/images/banner1.png); position: relative;">
        <div class="overlay" style="top: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 0;
        background-color: rgba(181, 141, 62, 0.7);"></div>
        <div class="container">
            <h1 class="title"><?php echo $facilities['location_name']?></h1>
            <h2 class="title"><?php echo $facilities['sports_facilities_name']?></h2>
        </div>
    </div>
</section>
<section class="booking booking_inner m_top50">
    <div class="booking-wrapper">
        <div class="container">
            <form id="frm_check_availability" method="get" action="" autocomplete="off">
                <div class="row">
                    <div class="col-xs-4 col-sm-3 wow bounceInUp" style="padding-top:18px;">
                        <label class="h4" style="margin-top:15px;">Check Availability & Rate</label>
                    </div>
                    <div class="col-xs-3 col-sm-3 wow bounceInUp">
                        <div class="date" data-text="From">
                            <input name="start_date" id="checkin_date" class="datepicker checkIn" value="<?php echo $this->input->get('start_date')?>" readonly="readonly">
                            <div class="date-value"> <span id="in_day" class="day"></span> <span id="in_month" class="month"></span>, <span id="in_year" class="year"></span> </div>
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 wow bounceInLeft">
                        <div class="date" data-text="To">
                            <input name="end_date" id="checkout_date" class="datepicker checkOut" value="<?php echo $this->input->get('end_date')?>" readonly="readonly">
                            <div class="date-value"> <span class="day" id="out_day"></span> <span id="out_month" class="month"></span>, <span id="out_year" class="year"></span> </div>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-3 wow bounceInRight">
                        <input type="submit" class="btn btn-block btn-main" value="SUBMIT" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="section bg_w">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th rowspan="2" class="text-center">Date</th>
                        <th rowspan="2" class="text-center">Status</th>
                        <th colspan="5" class="text-center">Rent per Day for the</th>
                    </tr>
                    <tr>
                        <th class="text-center">Railway Department<br> Recreation Clubs & BNRRC</th>
                        <th class="text-center">Other Railway<br> Associations, Institutions,<br> Organisations</th>
                        <th class="text-center">Railway PSUs viz.<br> RVNL, IRCTC,<br> RailTel etc.</th>
                        <th class="text-center">Other Government<br> Organisations, Associated<br> Units viz. CISF,<br> CRIS, IRCON,<br> CISF, CONCOR etc.</th>
                        <th class="text-center">Other Open Registered<br> Clubs, Associations,<br> Corporate Bodies etc.</th>
                    </tr>
                    <?php if(isset($rates) && $rates): foreach($rates as $date => $value):?>
                        <tr>
                            <td class="text-center"><?php echo date('d-m-Y D',strtotime($date))?></td>
                            <td class="text-center">Available</td>
                            <?php foreach($value['rates'] as $rate):?>
                                <td class="text-center">Rs. <?php echo number_format($rate['rate'],2,",",".")?></td>
                            <?php endforeach?>
                        </tr>
                    <?php endforeach; endif?>
                </table>
            </div>
            <div class="col-sm-12 text-center m_top20">
                <?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'frontend'):?>
                    <?php 
                    $start_date = $this->input->get('start_date');
                    $end_date = $this->input->get('end_date');
                    if($start_date && $end_date):?>
                        <a class="btn btn-main btn_select" href="<?php echo base_url()?>reserve-facility/<?php echo $sports_facilities_id?>?start_date=<?php echo $start_date?>&&end_date=<?php echo $end_date?>">Proceed to Reserve</a>
                    <?php else:?>
                        <a class="btn btn-main btn_select" href="<?php echo base_url()?>reserve-facility/<?php echo $sports_facilities_id?>">Proceed to Reserve</a>
                    <?php endif?>
                <?php else:?>
                    <a class="btn btn-main btn_select" href="#" data-toggle="modal" data-target="#LoginModal">Login/Sign Up to Reserve</a>
                <?php endif?>
                
                <!-- Modal -->
                
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var focusCheckOut = true;
    var startDate;
    var launchDate = new Date(2018, 8, 22);
    var today = new Date();
    if (launchDate > today) {
        startDate = launchDate;
    }
    else {
        startDate = today;
    }
    $("#checkin_date").datepicker({
        format: "yyyy/mm/dd"
        , todayBtn: false
        , autoclose: true
        , startDate: startDate
        , endDate: '+89d'
    }).on("changeDate", function (e) {
        showInDate(e.date);
        var checkInDate = e.date
            , $checkOut = $("#checkout_date");
        checkInDate.setDate(checkInDate.getDate() + 1);
        $checkOut.datepicker("setStartDate", checkInDate);
        if (focusCheckOut) {
            $checkOut.datepicker("setDate", checkInDate).focus();
        }
    });
    $("#checkout_date").datepicker({
        format: "yyyy/mm/dd"
        , todayBtn: false
        , autoclose: true
        , endDate: '+90d'
    }).on("changeDate", function (e) {
        showOutDate(e.date);
    });
    var in_date = startDate;

    focusCheckOut = false;
    <?php if($this->input->get('start_date')):?>
        $("#checkin_date").datepicker("setDate", "<?php echo $this->input->get('start_date')?>");
    <?php else:?>
        $("#checkin_date").datepicker("setDate", in_date);
    <?php endif?>


    
    var out_date = new Date();
    out_date = out_date.setDate(out_date.getDate() + 2);
    <?php if($this->input->get('end_date')):?>
        $("#checkout_date").datepicker("setDate", "<?php echo $this->input->get('end_date')?>");
    <?php else:?>
        $("#checkout_date").datepicker("setDate", new Date(in_date.setDate(in_date.getDate() + 10)));
    <?php endif?>
    
    focusCheckOut = true;

    function showInDate(date) {
        var d = new Date(date);
        $("#in_day").text(d.getDate());
        $("#in_month").text(months[d.getMonth()]);
        $("#in_year").text(d.getFullYear());
        var formatted_date = getFormattedDate(date);
        $("#checkin_date").val(formatted_date);
        $("#check_in_date").val(formatted_date);
    }

    function showOutDate(date) {
        var d = new Date(date);
        $("#out_day").text(d.getDate());
        $("#out_month").text(months[d.getMonth()]);
        $("#out_year").text(d.getFullYear());
        var formatted_date = getFormattedDate(date);
        $("#checkout_date").val(formatted_date);
        $("#check_out_date").val(formatted_date);
    }

    function getFormattedDate(date) {
        var dt = new Date(date)
            , m = '' + (dt.getMonth() + 1)
            , d = '' + dt.getDate()
            , y = dt.getFullYear();
        if (m.length < 2) m = '0' + m;
        if (d.length < 2) d = '0' + d;
        return [d, m, y].join('/');
    }
</script>