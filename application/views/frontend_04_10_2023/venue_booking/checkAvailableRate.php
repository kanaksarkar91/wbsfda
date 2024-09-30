
<section>
                <div class="container">
                    <div class="banner-location bg-white radius-5">
                        <div class="banner-location-flex">
                            <!-- <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-home"></i> Type </span>
                                <select class="form-select" name="state">
                                        <option value="2">Conference / Banquet Hall</option>
                                        <option value="3">Lawn / Picnic Spot</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="banner-location-single">
                        <div class="banner-location-single-flex">
                            <div class="banner-location-single-contents">
                                <span class="banner-location-single-contents-subtitle"><i class="las la-map-marker-alt"></i> Location </span>
                                <select class="form-select" name="state">
                                        <option value="1">Nalban Food Park</option>
                                        <option value="2">Oceana Guest House Complex</option>
                                        <option value="3">Amarabati Park</option>
                                    </select>
                            </div>
                        </div>
                    </div> -->
                            <div class="banner-location-single">
                                <div class="banner-location-single-flex">
                                    <div class="banner-location-single-contents">
                                        <span class="banner-location-single-contents-subtitle"><i class="las la-calendar"></i> CHECK AVAILABILITY & RATE </span>
                                        <input class="form-control" type="text" name="date_range" value="<?= date('d/m/Y', strtotime('+1 day'));?> - <?= date('d/m/Y', strtotime('+10 days'));?>" />
                                        <input type="hidden" name="start_date" id="checkindt_venue" value="<?= date('dmY', strtotime('+1 day'));?>" />
                                        <input type="hidden" name="end_date" id="checkoutdt_venue" value="<?= date('dmY', strtotime('+10 days'));?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="banner-location-single-search">
                                <button class="btn btn-primary w-100">
                            SUBMIT <i class="las la-chevron-circle-right"></i> 
                        </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="hotel-details-area pat-30 pab-30">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-xl-8 col-lg-7">
                            <div class="details-left-wrapper">
                                <div class="details-contents bg-white radius-10">
                                    <div class="details-contents-header">
                                        <h4 class="mb-3"> <?=$venues[0]->venue_names ?> </h4>
                                        <table class="table table-borderless table-responsive table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="small text-center">Date</th>
                                                    <th class="small text-center">Status</th>
                                                    <th class="small text-center">Price per Day</th>
                                                </tr>
                                                <?php if(isset($venues) && $venues): foreach($venues[0] as $date => $value):?>
                                                    <tr>
                                                        <td class="text-center"><?php echo date('d-m-Y D',strtotime($date))?></td>
                                                        <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                        <?php foreach($value['rates'] as $rate):?>
                                                            <td class="text-center">Rs. <?php echo number_format($rate['rate'],2,",",".")?></td>
                                                        <?php endforeach?>
                                                    </tr>
                                                <?php endforeach; endif?>
                                                <tr>
                                                    <td class="text-center">28-08-2023 Mon</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">29-08-2023 Tue</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">30-08-2023 Wed</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">31-08-2023 Thu</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">01-09-2023 Fri</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">02-09-2023 Sat</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">03-09-2023 Sun</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">04-09-2023 Mon</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">05-09-2023 Tue</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">06-09-2023 Wed</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">07-09-2023 Thu</td>
                                                    <td class="text-center"><span class="bg-success p-1 rounded text-white">Available</span></td>
                                                    <td class="text-center">Rs. 25.000,00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="btn-wrapper text-center">
                                            <!-- <a href="#." class="cmn-btn btn-bg-1 radius-10" data-bs-toggle="modal" data-bs-target="#myModal"> BOOK NOW </a> -->
                                            <a href="venue-reservation.html" class="cmn-btn btn-bg-1 btn-small mb-3"> Proceed To Reserve </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="details-contents bg-white radius-10 mb-3">
                                <img src="assets/img/nalban-food-park.png" alt="img" class="img-fluid d-block mx-auto">
                                <div class="hotel-view-contents">
                                    <div class="hotel-view-contents-header">
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-map-marker-alt"></i> </span>
                                            <span class="hotel-view-contents-location-para"> Location: Nalban Food park </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-map-marked-alt"></i> </span>
                                            <span class="hotel-view-contents-location-para"> Address: HC9J+5MX, Nalban Bheri, Dhapa, Kolkata, West Bengal 700098 </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-phone"></i> </span>
                                            <span class="hotel-view-contents-location-para"> Contact: 033 2358 3123 </span>
                                        </div>
                                        <div class="hotel-view-contents-location mt-2">
                                            <span class="hotel-view-contents-location-icon"> <i class="las la-envelope"></i> </span>
                                            <span class="hotel-view-contents-location-para"> Email: mailtest@mail.com </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="details-contents bg-white radius-10 p-3">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.283587971502!2d88.428603804392!3d22.568494442487808!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275413428b1a3%3A0xc80d8c104e72ec9b!2sNalban%20Food%20Park!5e0!3m2!1sen!2sin!4v1693206606509!5m2!1sen!2sin"
                                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                $(function() {
                    $('input[name="date_range"]').daterangepicker({
                        opens: 'left'
                    }, function(start, end, label) {
                        console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
                    });
                });
            </script>

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