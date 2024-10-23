        <div class="app-content pt-3 p-md-3 p-lg-3">

            <div class="container-xl">
                <?php if ($this->session->flashdata('success_msg')) : ?>
                    <div class="alert alert-success">
                        <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                        <?= $this->session->flashdata('success_msg') ?>
                    </div>
                <?php endif ?>
                <?php if ($this->session->flashdata('error_msg')) : ?>
                    <div class="alert alert-danger">
                        <a href="" class="close" data-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                        <?= $this->session->flashdata('error_msg') ?>
                    </div>
                <?php endif ?>

                <div class="row g-3 mb-2 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Safari Booking List</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-orders-table shadow-sm mb-2 p-3">
                    <div class="app-card-body">
                        <form action="" method="post">
                            <input type="hidden" name="<?= $this->csrf['name']; ?>" value="<?= $this->csrf['hash']; ?>">
                            <div class="row g-3">

                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <label for="property_zp" class="form-label">Service Definition <span class="asterisk"></span></label>
                                    <select name="safari_service_header_id" id="safari_service_header_id" class="form-select select2" required>
                                        <option value="0">Select Service Definition </option>
                                        <?php
                                        if ($serviceDefinitions)
                                            foreach ($serviceDefinitions as $row) {
                                        ?>
                                            <option value="<?= $row['safari_service_header_id']; ?>" <?php echo ($row['safari_service_header_id'] == $safari_service_header_id) ? 'selected' : ''; ?>><?= $row['service_definition']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-sm-12 col-md-6">
                                    <label for="" class="form-label">Date</label>
                                    <input type="date" class="form-control" name="booking_date" id="booking_date"
                                        value="<?= !empty($booking_date) ? date('Y-m-d', strtotime($booking_date)) : "" ?>" required>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <label for="property_zp" class="form-label">Slot <span class="asterisk"></span></label>
                                    <select name="period_slot_dtl_id" id="period_slot_dtl_id" class="form-select select2" required>
                                        <option value="0">Select Slot</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-sm-12 col-md-6">
                                    <label for="property_gram_panchayat" class="form-label">&nbsp;&nbsp;<span class="asterisk"> </span></label>
                                    <input type="submit" class="form-select btn app-btn-primary" name="search" value="Search">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="app-card app-card-orders-table shadow-sm mb-5 p-3">
                    <div class="app-card-body">
                        <div class="row g-3">
                        <div class="text-end my-2"><button class="btn app-btn-primary" type="button"><span>Download PDF</span></button></div>
                        <table id="" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; padding: 0;text-align: center;color: #000;">
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #e7e9ed 1px solid; border-bottom:0; text-align:center;">
                                        <tr>
                                            <td colspan="4" style="text-align: left; background-color: #f5f5f5; font-size:16px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;">
                                                <b style="color: #009e60;">Service Definition:</b> <?= $safariReservations[0][0]['service_definition']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Date of Visit:</b></td>
                                            <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['booking_date'] != '' ? date('d-m-Y', strtotime($safariReservations[0][0]['booking_date'])) : ''; ?></td>
                                            <td style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Slot:</b></td>
                                            <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['slot_desc'] . ': ' . $safariReservations[0][0]['start_time'] . ' - ' . $safariReservations[0][0]['end_time']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Start Point:</b></td>
                                            <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['start_point']; ?></td>
                                            <td style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>End Point:</b></td>
                                            <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['end_point']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Reporting Place:</b></td>
                                            <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['start_point']; ?></td>
                                            <td style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Reporting Time:</b></td>
                                            <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['reporting_time']; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #e7e9ed 1px solid; border-bottom:0; text-align:center;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: left; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">PNR No.</th>
                                                <th style="text-align: left; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Visitor's Name</th>
                                                <th style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Nationality</th>
                                                <th style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Age</th>
                                                <th style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Gender</th>
                                                <th style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">ID Card Type</th>
                                                <th style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">ID Card No.</th>
                                                <th style="text-align: center; background-color: #f5f5f5; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($safariReservations[0]['details'])) {
                                                foreach ($safariReservations[0]['details'] as $row) { ?>
                                                    <tr>
                                                        <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed#9e9e9e 1px solid;"><?= $row['booking_number']; ?></td>
                                                        <td style="text-align: left; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_name']; ?></td>
                                                        <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['cat_name']; ?></td>
                                                        <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_age']; ?></td>
                                                        <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_gender']; ?></td>
                                                        <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_id_type']; ?></td>
                                                        <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= str_pad(substr($row['visitor_id_no'], -4), strlen($row['visitor_id_no']), 'x', STR_PAD_LEFT); ?></td>
                                                        <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;"></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td style="text-align: center; font-size:14px; padding: 6px 3px; border-bottom: #e7e9ed 1px solid;" colspan="8">No data Found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>


                           <!--  <table class="table table-bordered" border="1" style="text-align:center;">
                                <tr>
                                    <td colspan="4" style="text-align: left; background-color: #f5f5f5; font-size:16px;">
                                        <b style="color: #009e60;">Service Definition:</b> <?= $safariReservations[0][0]['service_definition']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; background-color: #f5f5f5;"><b>Date of Visit:</b></td>
                                    <td style="text-align: left;"><?= $safariReservations[0][0]['booking_date'] != '' ? date('d-m-Y', strtotime($safariReservations[0][0]['booking_date'])) : ''; ?></td>
                                    <td style="text-align: center; background-color: #f5f5f5;"><b>Slot:</b></td>
                                    <td style="text-align: left;"><?= $safariReservations[0][0]['slot_desc'] . ': ' . $safariReservations[0][0]['start_time'] . ' - ' . $safariReservations[0][0]['end_time']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; background-color: #f5f5f5;"><b>Start Point:</b></td>
                                    <td style="text-align: left;"><?= $safariReservations[0][0]['start_point']; ?></td>
                                    <td style="text-align: center; background-color: #f5f5f5;"><b>End Point:</b></td>
                                    <td style="text-align: left;"><?= $safariReservations[0][0]['end_point']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; background-color: #f5f5f5;"><b>Reporting Place:</b></td>
                                    <td style="text-align: left;"><?= $safariReservations[0][0]['start_point']; ?></td>
                                    <td style="text-align: center; background-color: #f5f5f5;"><b>Reporting Time:</b></td>
                                    <td style="text-align: left;"><?= $safariReservations[0][0]['reporting_time']; ?></td>
                                </tr>

                                <tr>
								<td>Date of Visit: <?= $safariReservations[0][0]['booking_date'] != '' ? date('d-m-Y', strtotime($safariReservations[0][0]['booking_date'])) : ''; ?></td>
								<td>Slot: <?= $safariReservations[0][0]['slot_desc'] . ': ' . $safariReservations[0][0]['start_time'] . ' - ' . $safariReservations[0][0]['end_time']; ?></td>
							  </tr>
							  <tr>
								<td colspan="2">Service Definition: <?= $safariReservations[0][0]['service_definition']; ?></td>
							  </tr>
							  <tr>
								<td>Start Point: <?= $safariReservations[0][0]['start_point']; ?></td>
								<td>End Point: <?= $safariReservations[0][0]['end_point']; ?></td>
							  </tr>
							  <tr>
								<td>Reporting Place: <?= $safariReservations[0][0]['start_point']; ?></td>
								<td>Reporting Time: <?= $safariReservations[0][0]['reporting_time']; ?></td>
							  </tr> 
                            </table> -->

                        </div>
                        <!-- <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left mt-3" id="accommodation_list_table">
                                <thead>
                                    <tr>
                                        <th class="cell">PNR No.</th>
                                        <th class="cell">Visitor's Name</th>
                                        <th class="cell">Nationality</th>
                                        <th class="cell">Age</th>
                                        <th class="cell">Gender</th>
                                        <th class="cell">ID Card Type</th>
                                        <th class="cell">ID Card No.</th>
                                        <th class="cell">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($safariReservations[0]['details'])) {
                                        foreach ($safariReservations[0]['details'] as $row) { ?>
                                            <tr>
                                                <td class="cell"><?= $row['booking_number']; ?></td>
                                                <td class="cell"><?= $row['visitor_name']; ?></td>
                                                <td class="cell"><?= $safariReservations[0][0]['cat_name']; ?></td>
                                                <td class="cell"><?= $row['visitor_age']; ?></td>
                                                <td class="cell"><?= $row['visitor_gender']; ?></td>
                                                <td class="cell"><?= $row['visitor_id_type']; ?></td>
                                                <td class="cell"><?= str_pad(substr($row['visitor_id_no'], -4), strlen($row['visitor_id_no']), 'x', STR_PAD_LEFT); ?></td>
                                                <td class="cell"></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td class="cell" colspan="8">No data Found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> -->
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>
            </div>
            <!--//container-fluid-->
        </div>

        <script>
            var period_slot_dtl_id = '<?= $period_slot_dtl_id; ?>';
            $(document).ready(function() {
                getSlots();
                $("#safari_service_header_id").change(function() {
                    getSlots();
                });

                $("#booking_date").change(function() {
                    getSlots();
                });

            });

            function getSlots() {
                var safari_service_header_id = $('#safari_service_header_id').val();
                var booking_date = $('#booking_date').val();
                console.log({
                    safari_service_header_id: safari_service_header_id,
                    booking_date: booking_date
                });
                var result = '';
                $.ajax({
                        type: 'POST',
                        url: '<?= base_url("admin/reports/getSlots"); ?>',
                        data: {
                            safari_service_header_id: safari_service_header_id,
                            booking_date: booking_date,
                            csrf_test_name: '<?= $this->csrf['hash']; ?>'
                        },
                        dataType: 'json',
                        encode: true,
                        //async: false
                    })
                    //ajax response
                    .done(function(response) {
                        if (response.status) {
                            result += '<option value="">Select Slot</option>';
                            $.each(response.list, function(key, value) {

                                if (period_slot_dtl_id == value.period_slot_dtl_id) {
                                    var slct = 'selected';
                                }

                                result += '<option value="' + value.period_slot_dtl_id + '" ' + slct + '>' + value.slot_desc + ': ' + value.start_time + ' to ' + value.end_time + '</option>';
                            });
                        } else {
                            result += '<option value="">No Data found</option>'
                        }
                        $("#period_slot_dtl_id").html(result);
                    });
            }
        </script>