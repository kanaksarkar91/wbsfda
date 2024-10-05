<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="add_modal" class="modal fade show" tabindex="-1" aria-modal="true" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="font-size: 24px;color: #4caf50;"><i class="fa fa-folder"></i> <span id="modal_header_msg"></span></h3>
      </div>
      <div class="modal-body">
       <p></p><span id="modal_msg"></span><p></p>
      </div>
      <div class="modal-footer">
        <a id="redirect_link" href="" class="btn app-btn-primary" data-bs-dismiss="modal"> Ok</a>
      </div>
    </div>
  </div>
</div>

<footer class="app-footer">
    <div class="container text-center py-3">
      <small class="copyright">© Copyright <?= date('Y');?> All Rights Reserved by WBSFDA</small>
    </div>
</footer>
<!--//app-footer-->

</div>
<!--//app-wrapper-->


<!-- Javascript --> 

<script src="<?=base_url('public/admin_assets/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('public/admin_assets/js/dataTables.buttons.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/admin_assets/js/jszip.min.js')?>"></script>
<script src="<?=base_url('public/admin_assets/js/buttons.html5.min.js')?>"></script>

<script src="<?=base_url('public/admin_assets/select2/js/select2.full.min.js')?>"></script>
<script src="<?=base_url('public/admin_assets/js/moment.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/admin_assets/js/daterangepicker.min.js')?>"></script>

<script src="<?=base_url('public/admin_assets/js/main.min.js')?>"></script>
<script src="<?=base_url('public/admin_assets/js/main.global.min.js')?>"></script>

<script src="<?=base_url('public/admin_assets/js/script.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/admin_assets/js/jquery.datetimepicker.js')?>"></script>
<script src="<?= base_url('public/admin_assets/js/jquery.timepicker.min.js');?>"></script>
<script src="<?= base_url('public/admin_assets/js/sweetalert.min.js');?>"></script>

<script>
$(document).ready(function(){
	$('form').attr('autocomplete', 'off');
	$("input").attr("autocomplete", "off"); 
});
</script>

<script>
    $(function () { 
      /*
        ** Active sidebar menu
      */
     var url = window.location.href;
     $('.submenu-item a').each(function(v){
      let this_url = $(this).attr('href');
      if(url.indexOf(this_url) >=0 ){
        $(this).addClass('active');
        let d_parent = $(this).data('parent');
        $(this).closest('#'+d_parent).addClass('show');
      }
     })
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      var s2 = $("#selectEvents").select2({
					placeholder: "Choose Multiple Harbour",
					tags: true
			});

			$("#bill-date, #agreement_start_date, #agreement_end_date, #edit-bill-date").datepicker({
					dateFormat: 'dd-mm-yy'
			});

			var minDate = new Date();
    	minDate.setDate(minDate.getDate() - 3);

			$("#salebill-date").datepicker({
					dateFormat: 'dd-mm-yy',
					minDate: minDate,
					maxDate: 0,
			});


            $(document).on("keyup", "#contact", function() {
          var mobNum = $(this).val();
          var filter = /^\d*(?:\.\d{1,2})?$/;

          if (filter.test(mobNum)) {
                if (mobNum.length == 10) {
                  if(!$("#mob1-invalid").hasClass("hidden"))
                    $("#mob1-invalid").addClass("hidden");
                  $("#mob1-invalid_digits").addClass("hidden");
                } else {
                  //alert('Please put 10  digit mobile number');
                  if(!$("#mob1-invalid").hasClass("hidden"))
                    $("#mob1-invalid").addClass("hidden");
                $("#mob1-invalid_digits").removeClass("hidden");
                    return false;
                }
              } else {
                $("#mob1-invalid").removeClass("hidden");
                if(!$("#mob1-invalid_digits").hasClass("hidden"))
                    $("#mob1-invalid_digits").addClass("hidden");
                return false;
              }
        });
        $(document).on("keyup", "#alt_contact", function() {
              var mobNum = $(this).val();
              var filter = /^\d*(?:\.\d{1,2})?$/;

              if (filter.test(mobNum)) {
                if (mobNum.length == 10) {
                  if(!$("#alt_mob1-invalid").hasClass("hidden"))
                    $("#alt_mob1-invalid").addClass("hidden");
                  $("#alt_mob1-invalid_digits").addClass("hidden");
                } else if (altmobNum.length>0) {
                  //alert('Please put 10  digit mobile number');
                  if(!$("#alt_mob1-invalid").hasClass("hidden"))
                    $("#alt_mob1-invalid").addClass("hidden");
                $("#alt_mob1-invalid_digits").removeClass("hidden");
                    return false;
                }
              } else {
                $("#alt_mob1-invalid").removeClass("hidden");
                if(!$("#alt_mob1-invalid_digits").hasClass("hidden"))
                    $("#alt_mob1-invalid_digits").addClass("hidden");
                return false;
              }
            });

            $('#venueEntry,#editVenueEntry').submit(function () {
              var mobNum = $('#contact').val();
              var filter = /^\d*(?:\.\d{1,2})?$/;
              if (mobNum != null || typeof mobNum != 'undefined') {
                if (filter.test(mobNum)) {
                if (mobNum.length == 10) {
                  if(!$("#mob1-invalid").hasClass("hidden"))
                    $("#mob1-invalid").addClass("hidden");
                  $("#mob1-invalid_digits").addClass("hidden");
                } else {
                  //alert('Please put 10  digit mobile number');
                  if(!$("#mob1-invalid").hasClass("hidden"))
                    $("#mob1-invalid").addClass("hidden");
                $("#mob1-invalid_digits").removeClass("hidden");
                    return false;
                }
              } else {
                $("#mob1-invalid").removeClass("hidden");
                if(!$("#mob1-invalid_digits").hasClass("hidden"))
                    $("#mob1-invalid_digits").addClass("hidden");
                return false;
              }
              }
              var altmobNum = $('#alt_contact').val();
              var filter = /^\d*(?:\.\d{1,2})?$/;
              if (altmobNum != null || typeof altmobNum != 'undefined') {
                if (filter.test(altmobNum)) {
                if (altmobNum.length == 10) {
                  if(!$("#alt_mob1-invalid").hasClass("hidden"))
                    $("#alt_mob1-invalid").addClass("hidden");
                  $("#alt_mob1-invalid_digits").addClass("hidden");
                } else if (altmobNum.length>0) {
                  //alert('Please put 10  digit mobile number');
                  if(!$("#alt_mob1-invalid").hasClass("hidden"))
                    $("#alt_mob1-invalid").addClass("hidden");
                $("#alt_mob1-invalid_digits").removeClass("hidden");
                    return false;
                }
              } else {
                $("#alt_mob1-invalid").removeClass("hidden");
                if(!$("#alt_mob1-invalid_digits").hasClass("hidden"))
                    $("#alt_mob1-invalid_digits").addClass("hidden");
                return false;
              }
              }
            })           
   
          })

          $(document).ready(function() {
        $('input[name="hourly_booking_applicable"]').change(function() {
            if (this.value === 'yes') {
                $('#hourly_booking_panel').show();
                $('#number_of_hours').prop('required', true);
            } else {
                $('#hourly_booking_panel').hide();
                $('#number_of_hours').prop('required', false);
            }
            // Reset the selected option to the default state
            $('#number_of_hours').val('');
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    });      
    </script>
  </body>
</html>