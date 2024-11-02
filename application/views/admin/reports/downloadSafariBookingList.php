<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Safari Booking List <?= date('d-m-Y', strtotime($safariReservations[0][0]['booking_date']));?></title>
    <style type="text/css">
        @page {
            size: A4;
            margin: .25cm;
        }
    </style>
</head>

<body role="document">
    <table id="printArea" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:1140px; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; padding: 0;text-align: center;color: #000;">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin-bottom: 5px;">
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/logo.jpg');?>" width="228" height="88" alt="..." />
                        </td>
                    </tr>
                    <tr>
                        <td width="15%" style="text-align: right;padding-right:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-2.jpg');?>" width="60" height="78" alt="..." style="margin-top:10px;" />
                        </td>
                        <td width="70%" style="text-align: center;">
                            <h3 style="margin-top:5px; font-size:16px;margin-bottom: 0px;line-height:1;font-weight:600;"><?= COM_NAME;?></h3>
                            <h3 style="margin-top:5px; font-size:14px;margin-bottom: 5px;line-height:1;font-weight:600;">Govt.Notification No. 1130-FR/11M-19/2003, On 10th June -2014</h3>
                            
                            <p style="font-size:12px; font-weight: 400;margin-bottom: 0;margin-top:0;font-weight:bold;">Contact No.: 9734190119</p>
                        </td>
                        <td width="15%" style="text-align: left; padding:10px;">
                            <img src="<?= base_url('public/frontend_assets/assets/img/forest-1.jpg');?>" width="60" height="78" alt="..." style="margin-top:10px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
		
		<tr>
			<td>
				<table id="" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; padding: 0;text-align: center;color: #000;">
					<tr>
						<td>
							<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #e7e9ed 1px solid; border-bottom:0; text-align:center;">
								<tr>
									<td colspan="4" style="text-align: left; background-color: #f5f5f5; font-size:13px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;">
										<b style="color: #009e60;">Service Definition:</b> <?= $safariReservations[0][0]['service_definition']; ?>
									</td>
								</tr>
								<tr>
									<td style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Date of Visit:</b></td>
									<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['booking_date'] != '' ? date('d-m-Y', strtotime($safariReservations[0][0]['booking_date'])) : ''; ?></td>
									<td style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Slot:</b></td>
									<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['slot_desc'] . ': ' . $safariReservations[0][0]['start_time'] . ' - ' . $safariReservations[0][0]['end_time']; ?></td>
								</tr>
								<tr>
									<td style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Start Point:</b></td>
									<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['start_point']; ?></td>
									<td style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>End Point:</b></td>
									<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['end_point']; ?></td>
								</tr>
								<tr>
									<td style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Reporting Place:</b></td>
									<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['start_point']; ?></td>
									<td style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><b>Reporting Time:</b></td>
									<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['reporting_time']; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table cellpadding="0" cellspacing="0" border="0" style="width:100%;border: #e7e9ed 1px solid; border-bottom:0; text-align:center;">
								<thead>
									<tr>
										<th style="text-align: left; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Booking No.</th>
										<th style="text-align: left; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Visitor's Name</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Nationality</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Age</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Gender</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">ID Card Type</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">ID Card No.</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;">Phone No.</th>
										<th style="text-align: center; background-color: #f5f5f5; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($safariReservations[0]['details'])) {
										foreach ($safariReservations[0]['details'] as $row) { 
											$isFirstRow = ($currentBookingNo != $row['booking_number']);
    										$currentBookingNo = $row['booking_number'];
									?>
											<tr>
												<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed#9e9e9e 1px solid;"><?= $row['booking_number']; ?></td>
												<td style="text-align: left; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_name']; ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $safariReservations[0][0]['cat_name']; ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_age']; ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_gender']; ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= $row['visitor_id_type']; ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= str_pad(substr($row['visitor_id_no'], -4), strlen($row['visitor_id_no']), 'x', STR_PAD_LEFT); ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid; border-right: #e7e9ed 1px solid;"><?= ($isFirstRow ? $row['customer_mobile'] : ''); ?></td>
												<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;"><?= $row['is_status'] == 1 ? '<span style="color: #009e60;">Confirmed</span>' : '<span style="color: red;">Cancelled</span>';?></td>
											</tr>
										<?php }
									} else { ?>
										<tr>
											<td style="text-align: center; font-size:11px; padding: 5px 3px; border-bottom: #e7e9ed 1px solid;" colspan="8">No data Found</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
				
				<table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin-top:30px;">
                    <tr>
                        <td width="100%" style="text-align: center; font-size: 12px; border-top: #9e9e9e 1px solid;padding: 5px 0;">
                            <p style="margin:3px 0;">For more information please contact</p>
                            <p style="margin:3px 0;"><?= COM_NAME;?></p>
                            <p style="margin:3px 0;"><?= COM_ADDRESS;?></p>
                            <p style="margin:3px 0;">PH:<?= COM_PHONE;?> | Email :<?= COM_EMAIL;?> | <?= COM_WEBSITE;?></p>
                        </td>
                    </tr>
                </table>
			</td>
		</tr>
		
    </table>

</body>

</html>