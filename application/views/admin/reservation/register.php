<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-2 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Reservation Calendar </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <!-- <a class="btn app-btn-secondary" href="list.html">
                                VIEW ALL District Master 
                            </a> -->
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="app-card app-card-settings shadow-sm p-3">

            <form class="settings-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
            

            <form class="settings-form" method="post" action="<?= base_url('admin/reservation/register'); ?>" enctype="multipart/form-data" autocomplete="off">
                <div class="app-card-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="property_id" class="form-label">Select Property </label>
                                <select name="property_id" class="form-select select2" id="property_id">
                                    <option value="">Select Property</option>
                                    <?php foreach($properties as $property){ ?>
                                      <option value="<?=$property['property_id']?>" <?=(isset($request_data['property_id']) && $request_data['property_id'] == $property['property_id'])?'selected':''?>><?=$property['property_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            
                            <div class="col-lg-6 col-sm-12 col-md-6 mb-3">
                                <label for="booking_status" class="form-label">Select Status</label>
                                <select name="booking_status" class="form-select" id="booking_status" >
                                    <option value="">Select Status</option>
                                    <option value="I" <?=(isset($request_data['booking_status']) && $request_data['booking_status'] == 'I')?'selected':''?>>Initiated</option>
                                    <option value="A" <?=(isset($request_data['booking_status']) && $request_data['booking_status'] == 'A')?'selected':''?>>Approved</option>
                                    <option value="C" <?=(isset($request_data['booking_status']) && $request_data['booking_status'] == 'C')?'selected':''?>>Cancelled</option>
                                    <option value="O" <?=(isset($request_data['booking_status']) && $request_data['booking_status'] == 'O')?'selected':''?>>Checked Out</option>
                                </select>
                            </div>

                        </div>
                       
                </div>
                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
            </form>

                
                <hr>

                <div class="col-md-12">
                   



                  <div id="calendar"></div>
  

                </div>
            </form>

        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type="text/javascript">
    
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
    // eventClassNames: function(info) {
      
    //   var result = true;
    //   var status = [];
      
      
    //   // Find all checkbox that are event filters and enabled and save the values.
    //   $("input[name='event_filter_sel']:checked").each(function () {
    //     // Saving each type separately
    //     if ($(this).data('type') == 'status') {
    //         status.push($(this).val());
    //     }
    //   });
    //   //console.log(status);
    //   //If there are locations to check
    //   if (status.length) { 
    //     result = result && status.indexOf(info.event.extendedProps.status) >= 0;
    //   } else {
    //     result = "hidden";
    //   }
      
      
    //   if (!result) {
    //     result = "hidden";
    //   }
      
    //   return result; 
    // },

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
