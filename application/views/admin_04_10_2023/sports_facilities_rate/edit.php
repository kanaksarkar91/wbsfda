<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Edit Rate Card</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="<?=base_url('admin/sportsfacilitiesrate')?>">
                                        VIEW ALL Rate Card
                                    </a>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="post" action="<?=base_url('admin/sportsfacilitiesrate/update_rate');?>" autocomplete="off">
                        <input type="hidden" class="form-control" name="rate_id" value="<?=$sports_facilities_rate['rate_id']?>">
                            <div class="row g-3">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="" class="form-label">Rate per Day (in INR)<span class="asterisk"> *</span></label>
                                    <input type="text" class="form-control" name="rate" placeholder="Rate per Day (in INR)" value="<?=$sports_facilities_rate['rate']?>" required>

                                </div>
                                <div class="col-sm-12 col-md-6 mb-3"> 
                                    <label for="" class="form-label">Effective Start Date<span class="asterisk"> *</span></label>
                                    <input type="text" class="form-control" id="effective_start_date" name="effective_start_date" value="<?=date('d-m-Y',strtotime($sports_facilities_rate['effective_start_date']))?>" placeholder="DD-MM-YYYY" required="">
                                </div>

                                
                            </div>





                    </div>

                    <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                    <a class="btn app-btn-danger" href="<?=base_url('admin/sportsfacilitiesrate')?>">CANCEL</a>
                    </form>
                </div>
                <!--//app-card-body-->

            </div>
        </div>

<script type='text/javascript'>
 
  $(document).ready(function(){
 
        $('#effective_start_date').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '+0d',
            autoclose:true
        });
    });

</script>
