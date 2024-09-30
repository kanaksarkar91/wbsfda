<style>
    #map {
  height: 400px;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.rate-table-sec .table > thead > tr > th {
    color: #fff;
    background: #800000;
}



</style>
<div class="app-content pt-3 p-md-3 p-lg-3">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Add New Rate </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <!--//col-->
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="">
                                VIEW ALL Rate
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

            <form class="settings-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="slug" value="<?=$slug;?>">

                <div class="app-card-body">
                    <form class="settings-form">
                        <div class="row g-3">
                            
                           
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Property<span class="asterisk"> *</span></label>
                                <select name="" class="form-select" id="" required>
                                    <option value="" selected disabled>Select Property</option>
                                    <option value="" >Panchayet Resort</option>
                                    
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Accommodation<span class="asterisk"> *</span></label>
                                <select name="" class="form-select" id="" required>
                                    <option value="" selected disabled>Select Accommodation </option>
                                    <option value="" >Double Bedded Deluxe</option>
                                    <option value="" >Double Bedded Economy</option>
                                    <option value="" >Double Bedded Premium</option>
                                    <option value="" >Double Bedded Swiss Tent</option>
                                    <option value="" >Four Bedded Deluxe</option>
                                    <option value="" >Four Bedded Premium</option>
                                    
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Rate Category <span class="asterisk"> *</span></label>
                                <select name="" class="form-select" id="" required>
                                    <option value="" selected disabled>Select Rate Category </option>
                                    <option value="" >AP</option>
                                    <option value="" >MAP</option>
                                    <option value="" >CP</option>
                                    
                                    
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive rate-table-sec">
                                    <table class="table table-striped table-hover mb-0 text-left" id="">
                                        <thead>
                                            <tr>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Base Rate</th>
                                                <th>Monday</th>
                                                <th>Tuesday</th>
                                                <th>Wednesday</th>
                                                <th>Thursday</th>
                                                <th>Friday</th>
                                                <th>Saturday</th>
                                                <th>Sunday</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>01/01/2019</td>
                                                <td>06/01/2019</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                            </tr>
                                       
                                            <tr>
                                                <td>05/07/2018</td>
                                                <td>30/12/2018</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                <td>2100.00</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>13/08/2022</td>
                                                <td>NA</td>
                                                <td>500.00</td>
                                                <td>500.00</td>
                                                <td>500.00</td>
                                                <td>500.00</td>
                                                <td>500.00</td>
                                                <td>500.00</td>
                                                <td>500.00</td>
                                                <td>600.00</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Basic Rack Rate  <span class="asterisk"> </span></label>
                                <input type="text" class="form-control" name="" placeholder="Basic Rack Rater" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Extra Bed<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="" placeholder="Extra Bed" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Plan Charge per person<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="" placeholder="Rate Charge per perso" required>
                            </div>


                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Plan Charge per Child<span class="asterisk"> *</span></label>
                                <input type="text" class="form-control" name="" placeholder="Plan Charge per Child" required>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Effective Start Date <span class="asterisk">*</span></label>
                                <input type="date" class="form-control" name="" placeholder="Address Line 2" >
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 mb-3">
                                <label for="" class="form-label">Effective End Date<span class="asterisk"> </span></label>
                                <input type="date" class="form-control" name="" placeholder="City" required>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive rate-table-sec">
                                    <table class="table table-striped table-hover mb-0 text-left" id="">
                                        <thead>
                                            <tr>
                                                <th>Days</th>
                                                <th>Add/Subtract </th>
                                                <th>Rate(%)</th>
                                                <th>Price</th>
                                                <th>Extra Bed</th>
                                                <th>Plan Charge per Person</th>
                                                <th>Plan Charge per Child</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>    
                                                <td align="center">Monday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>
                                       
                                            <tr>    
                                                <td align="center">Tuesday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>
                                            <tr>    
                                                <td align="center">Wednesday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>
                                            <tr>    
                                                <td align="center">Thursday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>
                                            <tr>    
                                                <td align="center">Friday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>
                                            <tr>    
                                                <td align="center">Saturday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>
                                            <tr>    
                                                <td align="center">Sunday</td>  
                                                <td align="center">   
                                                    <select name="" id="" class="form-control method">     
                                                        <option value="">Select Method</option>     
                                                        <option value="A">Add</option>      
                                                        <option value="S">Subtract</option>   
                                                    </select> 
                                                </td>   
                                                <td align="center">     
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" > 
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >   
                                                </td>   
                                                <td align="center">   
                                                    <input type="text" name="" id="" class="form-control" >    
                                                </td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>





                            
                            
                            
                           

                        </div>
                       
                </div>

                <button type="submit" class="btn app-btn-primary">SUBMIT</button>
                            <a class="btn app-btn-danger" href="">CANCEL</a>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
</div>

<script type='text/javascript'>
 
  $(document).ready(function(){
 
        $('#fieldunit_id').change(function(){
        var fieldunit_id = $(this).val();

            $.ajax({
                url:'<?php echo base_url("admin/Sports_facilities/getlocation"); ?>',
                method: 'post',
                data: {fieldunit_id: fieldunit_id},
                dataType: 'json',
                success: function(response){
             
                $.each(response,function(index,data){
                    $('#location_id').append('<option value="'+data.location_id+'">'+data.location_name+'</option>');
                  
                });
                }
            });
        });
    });

</script>

    
    <script type="text/javascript">
        /**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
window.initMap = initMap;

function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 40.749933, lng: -73.98633 },
    zoom: 13,
    mapTypeControl: false,
  });
  
  const input = document.getElementById("address_autocomplete");
  
  const options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: ["establishment"],
  };

  

  const autocomplete = new google.maps.places.Autocomplete(input, options);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo("bounds", map);

  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");

  infowindow.setContent(infowindowContent);

  const marker = new google.maps.Marker({
    map,
    anchorPoint: new google.maps.Point(0, -29),
  });

  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);

    const place = autocomplete.getPlace();

    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map, marker);
  });

}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-nrrt7qM9VkwOfkWQCG5161Y4W024yG8&callback=initMap&libraries=places"></script>
