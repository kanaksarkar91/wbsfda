<div class="app-content pt-3 p-md-3 p-lg-3">
   
	<div class="container-xl">
				
		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Availability Status</h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<!--//col-->
						<div class="col-auto">
							<div class="text-right focused">
								<label class="w-100">Property</label>
								<select name="property" id="property" class="form-select select2">
									<option value="">Select Property</option>
									<?php
									if (isset($properties))
										foreach ($properties as $p) {
									?>
									<option value="<?= $p['property_id']; ?>" <?= set_select('property', $p['property_id'], isset($d_prop) && $d_prop == $p['property_id'] ? true : false); ?>><?= $p['property_name']; ?></option>
									<?php } ?>
								</select>
							</div>
							
						</div>
						<!--//col--> 
						<div class="col-auto">
							<div class="focused">
								<label class="w-100">Select Period:</label>
								<input type="text" name="daterange" id="daterange" class="form-control" value="<?= isset($d_date) && $d_date != '' ? date('d/m/Y', strtotime($d_date)) . ' - ' . date('d/m/Y', strtotime($d_date)) : '';?>">
								
							</div>
						</div>
					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->
		</div>
		<!--//row-->

		<style type="text/css">
				.btn-green {
					background: #33c543;
					color: #fff;
					-webkit-border-radius: 0;
					-moz-border-radius: 0;
					border-radius: 4px;
					font-family: 'Barlow', sans-serif;
					border: #33c543 1px solid;
					padding: 6px 16px;
					font-size: 13px;
					font-weight: 400;
					text-decoration: none;
					transition-duration: 0.5s;
					-webkit-transition-duration: 0.5s;
					display: inline-block;
				}

				.btn-green:focus,
				.btn-green:hover {
					background: #000;
					color: #33c543;
					border: #33c543 1px solid;
					transition-duration: 0.5s;
					-webkit-transition-duration: 0.5s;
					outline: 0;
				}
				.btn-yellow {
					background: #ff9600;
					color: #fff;
					-webkit-border-radius: 0;
					-moz-border-radius: 0;
					border-radius: 4px;
					font-family: 'Barlow', sans-serif;
					border: #ff9600 1px solid;
					padding: 6px 16px;
					font-size: 13px;
					font-weight: 400;
					text-decoration: none;
					transition-duration: 0.5s;
					-webkit-transition-duration: 0.5s;
					display: inline-block;
				}
				.btn-info {
					background: #6dafff;
					color: #fff;
					-webkit-border-radius: 0;
					-moz-border-radius: 0;
					border-radius: 4px;
					font-family: 'Barlow', sans-serif;
					border: #6dafff 1px solid;
					padding: 6px 16px;
					font-size: 13px;
					font-weight: 400;
					text-decoration: none;
					transition-duration: 0.5s;
					-webkit-transition-duration: 0.5s;
					display: inline-block;
				}
				.btn-info:focus,
				.btn-info:hover {
					background: #246fc9;
					color: #fff;
					border: #246fc9 1px solid;
					transition-duration: 0.5s;
					-webkit-transition-duration: 0.5s;
					outline: 0;
				}

				.btn-primary {
					color: #fff !important;
					background-color: #246fc9;
					border-color: #246fc9;
				}

				.btn-primary:hover {
					color: #fff;
					background-color: #6dafff;
					border-color: #6dafff
				}
				.btn{
					margin: 2.5px 0;
				}

				/************28/10/2022**************/
				.label-default {
background-color: #777;
}
.label-default[href]:hover,
.label-default[href]:focus {
background-color: #5e5e5e;
}
.label-primary {
background-color: #337ab7;
}
.label-primary[href]:hover,
.label-primary[href]:focus {
background-color: #286090;
}
.label-success {
background-color: #5cb85c;
}
.label-success[href]:hover,
.label-success[href]:focus {
background-color: #449d44;
}
.label-info {
background-color: #5bc0de;
}
.label-info[href]:hover,
.label-info[href]:focus {
background-color: #31b0d5;
}
.label-warning {
background-color: #f0ad4e;
}
.label-warning[href]:hover,
.label-warning[href]:focus {
background-color: #ec971f;
}
.label-danger {
background-color: #d9534f;
}
.label-danger[href]:hover,
.label-danger[href]:focus {
background-color: #c9302c;
}
.badge {
display: inline-block;
min-width: 10px;
padding: 3px 7px;
font-size: 12px;
font-weight: bold;
line-height: 1;
color: #fff;
text-align: center;
white-space: nowrap;
vertical-align: middle;
background-color: #777;
border-radius: 10px;
}
.badge:empty {
display: none;
}
.btn .badge {
position: relative;
top: -1px;
}
.btn-xs .badge,
.btn-group-xs > .btn .badge {
top: 0;
padding: 1px 5px;
}
a.badge:hover,
a.badge:focus {
color: #fff;
text-decoration: none;
cursor: pointer;
}
.list-group-item.active > .badge,
.nav-pills > .active > a > .badge {
color: #337ab7;
background-color: #fff;
}
.list-group-item > .badge {
float: right;
}
.list-group-item > .badge + .badge {
margin-right: 5px;
}
.nav-pills > li > a > .badge {
margin-left: 3px;
}
				.f12 {font-size: 12px;border-radius: 2px;}
.table_custom thead tr th:first-child, .table_custom2 thead tr th:first-child {border-radius: 6px 0 0 0;}
.table_custom thead tr th:last-child, .table_custom2 thead tr th:last-child {border-radius: 0 6px 0 0;}
.table_custom tbody tr {border-bottom: 10px solid #ccc;}
.table_custom tbody tr:hover {background: #e4f0f5;}
.table_custom tbody tr:last-child td:nth-child(1) {border-radius:0 0 0 6px;}
.roomtype {font-size: 17px;cursor: pointer;}    
.roomtype:hover a {text-decoration: none;}
.label {font-weight: normal;transition: all 0.5s ease;}
.label-normal {background-color: #eee;color: #000;}
a.label:hover, a.label:focus {color: #000;}
a.label {width: 85px; display: block; padding: 3px 0;color: #fff;}
table.table_custom thead th, table.table_custom2 thead th {text-align: center;}
table.table_custom thead th small, table.table_custom2 thead th small {text-transform: uppercase; display: block;text-align: center;font-weight: normal;letter-spacing: 1px;}
table#avs_table {position: relative;}
table#avs_table thead.stick {position: fixed;top:51px; z-index: 3;width: 100%; display: block;}
table#avs_table thead.stick tr {width: 92.5%; display: table;}

table#avs_table thead.stick tr th:nth-child(1) {width:23%;max-width: 330px;}
table#chi_table thead tr#calhead th:nth-child(1) {width:23%;max-width: 330px;}
table#chi_table thead tr#calhead th:nth-child(2) {width:15%;max-width: 330px;text-align: left;}
table#chi_table thead tr#calhead th:nth-child(2) small {text-align: left;}
tbody#list_tbl_body_id tr td.roomtype:nth-child(1) {width:23%;max-width: 330px;}

#header-fixed {position: fixed; width: 93.7%;top: 50px; display:none;background-color:white;}
#header-fixed thead tr th:nth-child(1) {width: 240px;}
.continue {margin: 0px;cursor: pointer;position: relative;}
.continue:before {background: #ff9600; width: 100%; height: 20px;content: '';position: absolute;left: 0;right: 0;top:-10px;}
/*.continue:after {background: #2b982b; width: 100%; height: 10px;content: '';position: absolute;right: 0;}*/
.s_checkin.continue {}
.s_checkin.continue:before {left: 30px;right: auto; border-radius: 10px 0 0 10px;}
.e_checkout.continue:before {right: 30px;left: auto; border-radius:0 10px 10px 0;}
.s_checkin.e_checkout.continue:before {right: 20px;left: 20px; border-radius:10px;width: auto;}
.r_chek_out {display: block;position: absolute;top: -20px;right: 0px;z-index:9;background: #fff;font-size: 15px;}

.reserved {margin-top: 5px;cursor: pointer;}
.reserved:before {background: #ff2d00; width: 100%; height: 20px;content: '';position: absolute;left: 0;right: 0;}

		</style>

		<div class="app-card app-card-orders-table shadow-sm mb-5">
			<div class="app-card-body">
				<div class="table-responsive">
					<?php
					if (isset($accomodation_availability)) {
					?>
					<table class="table table-striped table-hover table_custom" id="avs_table">
						<thead>
							<tr id="calhead2">
								<th align="center" valign="middle">Accommodation<br><small>Category</small></th>
								<?php
								if (isset($dates))
									foreach ($dates as $d) {
								?>
								<th align="center" valign="middle"><?= $d['date'];?><br><small><?= $d['day'];?></small></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody id="list_tbl_body_id">
							<?php 
							foreach ($accomodation_availability as $accomm) { 
								$r = $accomm['accommodation'];
								$r1 = $accomm['availability'][0];
							?>
							<tr>
								<td align="center" valign="middle" class="roomtype"><a href="#"><?= $r['accommodation_name']; ?></a><img
										src="<?= base_url('public/admin_images/' . $r['image1']);?>" alt="<?= $r['accomm_desc']; ?>" height="50px" style="display: block;">
									<p>Total: <?= $r1['total_room_cnt'];?></p>
								</td>
								<?php
								foreach ($accomm['availability'] as $rr) {
								?>
								<td align="center" valign="middle">
									<p><a href="#" class="f12 label label-success">Available: <?= $rr['available_room_cnt'];?> </a></p>
									<p><a href="#" class="f12 label label-info">Booked: <?= $rr['booked_room_cnt'];?> </a></p>
									<p><a href="#" class="f12 label label-warning">Occupied: <?= $rr['total_room_cnt'] - ($rr['available_room_cnt'] + $rr['booked_room_cnt'] + $rr['blocked_room_count']);?> </a></p>
									<p><a href="#" class="f12 label label-danger">Blocked: <?= $rr['blocked_room_count'];?> </a></p>
								</td>
								<?php } ?>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<table class="table table-striped table-hover table_custom" id="header-fixed" style="display: none;">
						<thead>
							<tr id="calhead2">
								<th align="center" valign="middle">Accommodation<br><small>Category</small></th>
								<th align="center" valign="middle">28th Oct 2022<br><small>Friday</small></th>
								<th align="center" valign="middle">29th Oct 2022<br><small>Saturday</small></th>
								<th align="center" valign="middle">30th Oct 2022<br><small>Sunday</small></th>
								<th align="center" valign="middle">31st Oct 2022<br><small>Monday</small></th>
								<th align="center" valign="middle">1st Nov 2022<br><small>Tuesday</small></th>
								<th align="center" valign="middle">2nd Nov 2022<br><small>Wednesday</small></th>
								<th align="center" valign="middle">3rd Nov 2022<br><small>Thursday</small></th>
								<th align="center" valign="middle">4th Nov 2022<br><small>Friday</small></th>
							</tr>
						</thead>
					</table>
					<?php } else { ?>
					<div class="text-center">Please select a property to view its availability status report.</div>
					<?php } ?>
				</div>
				
			</div>
			<!--//app-card-body-->
		</div>
	</div>
	<!--//container-fluid-->
</div>
<script>
$(document).ready(function() {
	$("#property").on('change', function() {
		var daterange = $("#daterange").val();
		var dates = daterange.split(' - ');
		var startDtFrmt = dates[0].split('/');
		var startDt = startDtFrmt[2] + startDtFrmt[1] + startDtFrmt[0];
		window.location.href = "<?= base_url('admin/reports/availability_status/');?>" + $(this).val() + '/' + startDt;
	});
});
</script>
<script>
$(document).ready(function() {
	var startDt = moment();
	var endDt = moment().add(6, 'days');
		
	$('input[name="daterange"]').daterangepicker({
		"startDate": <?= isset($d_date) && $d_date != '' ? '"' . date('d/m/Y', strtotime($d_date)) . '"' : 'startDt'; ?>,
		"endDate": <?= isset($d_date) && $d_date != '' ? '"' . date('d/m/Y', strtotime($d_date . '+6 days')) . '"' : 'endDt'; ?>,
		"locale": {
			"format": "DD/MM/YYYY",
			"separator": " - ",
		},
		"maxSpan": {
			"days": 6
		}
	});
	
	$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		
		var propertyId = $("#property").val();
		
		if (propertyId != '') {
			var daterange = $("#daterange").val();
			var dates = daterange.split(' - ');
			var startDtFrmt = dates[0].split('/');
			var startDt = startDtFrmt[2] + startDtFrmt[1] + startDtFrmt[0];
			window.location.href = "<?= base_url('admin/reports/availability_status/');?>" + propertyId + '/' + startDt;
		}
	});
});
</script>