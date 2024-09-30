<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style type="text/css">
.fc-icon-left-single-arrow:after,
.fc-icon-right-single-arrow:after{font-size: 1.5rem!important;top: -5px;}
.fc-event{border: none;}
.fc-event .fc-content{padding:0 3px;}
</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
           
    <div class="container-xl">
        <?php if ($this->session->flashdata('success_msg')) : ?>
            <div class="alert alert-success">
                    <a href="" class="close" data-bs-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('success_msg') ?>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('error_msg')) : ?>
            <div class="alert alert-danger">
                <a href="" class="close" data-bs-dismiss="alert" aria-label="close" title="close" style="position: absolute;right: 15px;font-size: 30px;color: red;top: 5px;">×</a>
                <?= $this->session->flashdata('error_msg') ?>
            </div>
        <?php endif ?>

        <div class="row g-3 mb-3 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Venue Booking Calendar</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        
                        <!--//col--> 
                        <!-- <div class="col-auto">
                            <a class="btn app-btn-primary" href="#">
                                ADD NEW 
                            </a>
                        </div> -->
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="app-card app-card-orders-table shadow-sm mb-3">
            <div class="app-card-body px-2">

                <div class="col-md-12 col-sm-12 col-xs-12" id="calendar_div">
                    <div style="padding: 7px 0px 7px 0px;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <button class="btn status_bttn" style="background-color:#ffbf00;" >Advance Paid</button> <button class="btn status_bttn" style="background-color:#008000;color:white;">Full Paid</button> <button class="btn status_bttn" style="background-color:#FF0000;;color:white;">Cancelled</button> <button class="btn status_bttn" style="background-color:#325a9b;;color:white;">NOC Issued</button>
                            </div>
                            <div class="col-md-6">
                                <form id="propertyForm" action="" method="post">
                                    <input type="hidden" class="csrfToken" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <select class="form-select select2" name="property_id" id="property_id">
                                                <option value="0">Select Location</option>
                                                <?php
                                                if (isset($landscape_properties))
                                                    foreach ($landscape_properties as $landscape_property) {
                                                ?>
                                                <option value="<?= $landscape_property['property_id']; ?>" <?php if($property_id == $landscape_property['property_id']){ echo 'selected'; } ?>><?= $landscape_property['property_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn app-btn-primary w-100 submitProp" type="submit">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="calendar"></div>
                </div>

            </div>
        </div>

    </div>    

<!--//container-fluid-->
</div>


<script type="text/javascript">

    $(document).ready(function() {

        $(document).on("click",".submitProp",function(e) {            

            e.preventDefault();

            var propId = $('#property_id').val();

            if(propId == 0){

                $.confirm({

                    title: "Alert!!",
                    content: "Please select Property",
                    buttons: {
                        Ok: {
                            text: 'OK',
                            btnClass: 'btn-green',
                            action: function(){  		

                            }
                        },
                        /*cancelAction: { //Close the confirmation Modal
                            text: 'No',
                            btnClass: 'btn-red',
                            action: function(){
                            
                            }
                        }*/
                    }

                });

            } else {

                $('#propertyForm').submit();
                
            }

        });
        

        $('#calendar').fullCalendar({
            // Add your options and callbacks here
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            weekNumbers: false,		
			height: 'auto',
            events: '<?= base_url() ?>admin/venuebookingcalendar/json_booking_event_feed/<?= $property_id; ?>',
            /*eventClick: function (event, jsEvent, view) {
                // Show popover with event details
                $(this).popover({
                    title: event.title,
                    content: event.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body',
					html:true
                }).popover('toggle');
            },*/
            eventRender: function(event, element) {
                if(event.url != ''){
                    element.popover({
                        title: event.title,
                        content: event.description,
                        trigger: 'hover',
                        placement: 'top',
                        container: 'body',
                        html:true
                    });
                }
            }
        });

    });

</script>