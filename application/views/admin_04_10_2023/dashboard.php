<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">DASHBOARD</h1>

        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
            <div class="inner">

			<?php if ($this->session->flashdata('success_msg')) : ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					<?php echo $this->session->flashdata('success_msg') ?>
				</div>
			<?php endif ?>
			<?php if ($this->session->flashdata('error_msg')) : ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					<?php echo $this->session->flashdata('error_msg') ?>
				</div>
			<?php endif ?>

			
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Welcome, ADMIN</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-9">
                            <!--<div>Dashboard content will update soon</div>-->
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-body-->

            </div>
            <!--//inner-->
        </div>
        <!--//app-card-->

    </div>
    <!--//container-fluid-->



