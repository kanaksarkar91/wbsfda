<div class="breadcrumb-area section-bg-2 breadcrumb-padding">
	<div class="container custom-container-one">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-contents">
					<h4 class="breadcrumb-contents-title"> Tenders </h4>
					<ul class="breadcrumb-contents-list list-style-none">
						<li class="breadcrumb-contents-list-item"> <a href="<?= base_url();?>" class="breadcrumb-contents-list-item-link"> Home </a> </li>
						<li class="breadcrumb-contents-list-item"> Tenders </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="py-5">
	<div class="container">
		<div class="section-title center-text">
			<h2 class="title"> Tenders</h2>
			<div class="section-title-line"> </div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<table class="table table-borderless table-responsive table-hover">
					<thead>

						<tr>
							<th>Sln</th>
							<th>Title</th>
							<th>Uploaded On</th>
							<th>Download</th>
							<th>View</th>
						</tr>
					</thead>
					<tbody>

						<?php if(!empty($tender_list)){ ?>

							<?php $i = 1; ?>
							<?php foreach($tender_list as $tender){ ?>

								<tr>
									<td><?= $i; ?></td>
									<td><?= $tender['tender_title']; ?></td>
									<td><?= date("d/m/Y", strtotime($tender['created_ts'])); ?></td>
									<td><a href="<?= base_url(); ?>public/tender_images/<?= $tender['tender_file']; ?>" target="_blank" class="bg-success p-1 rounded text-white" download><i class="las la-download"></i> Download</a></td>
									<td><a href="<?= base_url(); ?>public/tender_images/<?= $tender['tender_file']; ?>" target="_blank" class="bg-info p-1 rounded text-white"><i class="las la-eye"></i> View</a></td>
								</tr>

								<?php $i++; ?>

							<?php } ?>

						<?php } else { ?>

							<tr><td colspan="5">No Data Found.</td></tr>

						<?php } ?>						

					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>