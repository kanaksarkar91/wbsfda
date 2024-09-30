<div class="app-content pt-3 p-md-3 p-lg-3">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Reservation Register</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <!--//col-->
                                <div class="col-auto">

                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->
                <?php if(check_user_permission($menu_id, 'delete_flag')):?>
                    <div class="app-card app-card-settings shadow-sm p-4"> 

                        <div class="app-card-body">
                            <form class="settings-form" method="post" action="<?= base_url('admin/reservation/register'); ?>" enctype="multipart/form-data" autocomplete="off">
                                <div class="row g-3">
                                <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Division / Workshop<span class="asterisk"> *</span></label>
                                        <select name="fieldunit_id" class="form-select" id="fieldunit_id" required>
                                        <option value="" selected disabled>Select Division / Workshop</option>
                                        <?php foreach($fieldunits as $fieldunit){ ?>
                                            <option value="<?=$fieldunit['fieldunit_id']?>" <?=($request_data['fieldunit_id'] == $fieldunit['fieldunit_id'])?'selected':''?>><?=$fieldunit['fieldunit_name']?></option>
                                        <?php } ?>
                                    </select>
                                        
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Location<span class="asterisk"> *</span></label>

                                        <select name="location_id" class="form-select" id="location_id">
                                        <option value="" selected disabled>Select Location</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label for="" class="form-label">Sports Facilities<span class="asterisk"> *</span></label>
                                        <select name="sports_facilities_id" class="form-select" id="sports_facilities_id">
                                        <option value="" selected disabled>Select Sports Facilities</option>
                                            
                                        </select>  
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            </form>
                                <hr>
                                <div class="row g-3">


                                    <div class="col-sm-12 col-md-3 mb-3">
                                        <div class="row">

                                            <!-- <div class="col-md-12">
                                                <div id="demo2"></div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <div class="filter">
                                                    <h5>Filter</h5>
                                                    <div class="event_filter_wrapper">
                                                        <input id="status_0" class="event_filter" name="event_filter_sel" type="checkbox" value="0" data-type="status" checked/>
                                                        <label for="status_0">Pending</label>
                                                    </div>
                                                    <div class="event_filter_wrapper">
                                                        <input id="status_1" class="event_filter" name="event_filter_sel" type="checkbox" value="1" data-type="status" checked/>
                                                        <label for="status_1">Approved</label>
                                                    </div>
                                                    <div class="event_filter_wrapper">
                                                        <input id="status_2" class="event_filter" name="event_filter_sel" type="checkbox" value="2" data-type="status"  checked/>
                                                        <label for="status_2">Rejected</label>
                                                    </div>
                                                    <div class="event_filter_wrapper">
                                                        <input id="status_3" class="event_filter" name="event_filter_sel" type="checkbox" value="3" data-type="status"  checked/>
                                                        <label for="status_3">Confirmed</label> 
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-md-9 mb-3">
                                        <div id="calendar"></div>
                                    </div>
                                </div>

                        </div>


                        
                    </div>
                <?php endif?>
                <!--//app-card-body-->

            </div>
        </div>
        <!--//container-fluid-->
         

        <script type="text/javascript">
        $(document).ready(function() {

            var fieldunit_id  = "<?=($request_data['fieldunit_id'])?$request_data['fieldunit_id']:''?>";
            var location_id  = "<?=($request_data['location_id'])?$request_data['location_id']:''?>";
            var sports_facilities_id  = "<?=($request_data['sports_facilities_id'])?$request_data['sports_facilities_id']:''?>";

            
            

    $('#fieldunit_id').change(function(){
        var fieldunit_id = $(this).val();
        

            $.ajax({
                url:'<?= base_url("admin/Sportsfacilitiesrate/getlocation"); ?>',
                method: 'post',
                data: {fieldunit_id: fieldunit_id},
                dataType: 'json',
                async:false,
                success: function(response){
                var resultHTML = '<option value="" selected disabled>Select Location</option>';
                $.each(response,function(index,data){
                    
                  resultHTML +='<option value="'+data.location_id+'" '+((location_id == data.location_id)?"selected":"")+'>'+data.location_name+'</option>';
                
                });
                $('#location_id').html(resultHTML);
                }
            });
        });


        $('#location_id').change(function(){
        var location_id = $(this).val();
        var slug = '';

            $.ajax({
                url:'<?= base_url("admin/Sportsfacilitiesrate/getsportsfacilities"); ?>',
                method: 'post',
                data: {location_id: location_id, slug: slug},
                dataType: 'json',
                async:false,
                success: function(response){
                var resultHTML = '<option value="" selected disabled>Select Sports Facilities</option>';
                $.each(response,function(index,data){
                    
                  resultHTML +='<option value="'+data.sports_facilities_id+'" '+((sports_facilities_id == data.sports_facilities_id)?"selected":"")+'>'+data.sports_facilities_name+'</option>';
                
                });
                $('#sports_facilities_id').html(resultHTML);
                }
            });
        });

        if(fieldunit_id){
                $("#fieldunit_id").trigger("change"); 
            }

            if(location_id){
                $("#location_id").trigger("change"); 
            }


            function logEvent(type, date) {
                $("<div class='log__entry'/>").hide().html("<strong>" + type + "</strong>: " + date).prependTo($('#eventlog')).show(200);
            }
            $('#clearlog').click(function() {
                $('#eventlog').html('');
            });


            $('#demo2').datetimepicker({
                date: new Date(),
                viewMode: 'YMD',
                onDateChange: function() {
                    $('#date-text2').text(this.getText());
                    $('#date-text-ymd2').text(this.getText('YYYY-MM-DD'));
                    $('#date-value2').text(this.getValue());
                }
            });



        });

        
        document.addEventListener('DOMContentLoaded', function() {
            var events_arr = <?= json_encode($reservations) ?>;
        //console.log(events_arr);
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: { 
      start: 'prev,today,next',
      center: 'title',
      end: 'dayGridMonth,dayGridWeek,listWeek'
    },
    timeZone: 'Europe/Berlin',
    //weekNumbers: true,
    initialView: 'dayGridMonth',
    eventTimeFormat: {
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    },
    views: {
      dayGridWeek: {
        titleFormat: 'DD.MM.YYYY'
      },
      listWeek: {
        titleFormat: 'DD.MM.YYYY' 
      }
    },
    
    events: events_arr,
    eventDidMount: function(info) {
        //console.log(info.el);
        
        //$(info.el).removeClass('fc-event-past');
        $(info.el).tooltip({
            title: info.event.extendedProps.description,
            placement: 'top',
            trigger: 'hover',
            container: 'body',
            html :true
        });
      
        
    }, 
    eventClassNames: function(info) {
      
      var result = true;
      var status = [];
      
      
      // Find all checkbox that are event filters and enabled and save the values.
      $("input[name='event_filter_sel']:checked").each(function () {
        // Saving each type separately
        if ($(this).data('type') == 'status') {
            status.push($(this).val());
        }
      });
      //console.log(status);
      //If there are locations to check
      if (status.length) { 
        result = result && status.indexOf(info.event.extendedProps.status) >= 0;
      } else {
        result = "hidden";
      }
      
      
      if (!result) {
        result = "hidden";
      }
      
      return result; 
    },

    windowResize: function(view) {
      var current_view = view.type;
      var expected_view = $(window).width() > 800 ? 'dayGridMonth' : 'listWeek';
      if (current_view !== expected_view) {
        calendar.changeView(expected_view);
      }
    },
    dateClick: function(info) {
            //console.log(info);
            if (info.view.type === "dayGridMonth") {
                calendar.gotoDate(info.date);
                calendar.changeView('timeGridDay');
            }
        }
    
  });

  calendar.render();

  if ($(window).width() < 800) {
    calendar.changeView('listWeek');
  }

  $('input[class=event_filter]').change(function() {
    calendar.render();
  });
    
});
    </script>
