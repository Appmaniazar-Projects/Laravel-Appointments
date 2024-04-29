@extends('layouts.admin')
@section('content')
<style type="text/css">
    h4{
        color:black;
    }
img.legend{
    
     width:100%;
        height:65vh;
        border-radius:5px;
    
    
}
    .popup{
        position:absolute;
        bottom:-500px;
        left:490px;
        margin:100px auto;
        width:500px;
        height:100px;
        font-family:verdana;
        font-size:13px;
        padding:10px;
        background-color:rgb(255, 247, 239);
        border:2px solid #FA8072;
        border-radius:5px;
        color:rgb(255,99,71);
        z-index:100000000000000000;
        }
        
    .cancel{
        display:relative;
        cursor:pointer;
        margin:0;
        float:right;
        height:20px;
        width:50px;
        padding:0 0 5px 0;
        background-color:red;
        text-align:center;
        font-weight:bold;
        font-size:11px;
        color:white;
        border-radius:3px;
        z-index:100000000000000000;
        }
    
    .cancel:hover{
        background:rgb(255,50,50);
        }
        div#map-main{
            height:600px;
            width:45vw;
        }
        .popupp{
        position:absolute;
        bottom:-500px;
        left:490px;
        margin:100px auto;
        width:500px;
        height:100px;
        font-family:verdana;
        font-size:13px;
        padding:10px;
        background-color:rgb(255, 247, 239);
        border:2px solid rgb(133, 48, 202);
        border-radius:5px;
        color:rgb(133, 48, 202);
        z-index:100000000000000000;
        }
        .popuppp{
        position:absolute;
        bottom:-500px;
        left:490px;
        margin:100px auto;
        width:500px;
        height:100px;
        font-family:verdana;
        font-size:13px;
        padding:10px;
        background-color:rgb(255, 247, 239);
        border:2px solid rgb(133, 48, 202);
        border-radius:5px;
        color:rgb(133, 48, 202);
        z-index:100000000000000000;
        }
        /*Trigger Button*/
.login-trigger {
  font-weight: bold;
  color: #fff;
  background: linear-gradient(to bottom right, #75b055, #c6f87b);
  padding: 15px 30px;
  border-radius: 30px;
  margin-right:30px;
  position: relative; 
  top: 50%;
}
.login-triggerr {
  font-weight: bold;
  color: #fff;
  background: linear-gradient(to bottom right, #B05574, #F87E7B);
  padding: 15px 30px;
  border-radius: 30px;
  position: relative; 
  top: 50%;
}

/*Modal*/
h4 {
  font-weight: bold;
  color: #fff;
}
.close {
  color: #fff;
  transform: scale(1.2)
}
.modal-content {
  font-weight: bold;
  background: linear-gradient(to bottom right,#F87E7B,#B05574);
}
.form-control {
  margin: 1em 0;
}
.form-control:hover, .form-control:focus {
  box-shadow: none;  
  border-color: #fff;
}
.username, .password {
  border: none;
  border-radius: 0;
  box-shadow: none;
  border-bottom: 2px solid #eee;
  padding-left: 0;
  font-weight: normal;
  background: transparent;  
}
.form-control::-webkit-input-placeholder {
  color: #eee;  
}
.form-control:focus::-webkit-input-placeholder {
  font-weight: bold;
  color: #fff;
}
.login {
  padding: 6px 20px;
  border-radius: 20px;
  background: none;
  border: 2px solid #FAB87F;
  color: #FAB87F;
  font-weight: bold;
  transition: all .5s;
  margin-top: 1em;
}
.login:hover {
  background: #FAB87F;
  color: #fff;
}
.row{
    margin-top: 10px;
}
div#hide{
    width: 100%;

}
     </style>
<div class="row">
<div class="col-sm-5">
<div class="card">
    <div class="card-header">
       <H3>Venue Booking</H3>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.appointments.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

        
          
            
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Event Name</label>
                <input id="name" name="name" class="form-control " {{ old('name', isset($appointment) ? $appointment->name : '') }} />
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
               
                </p>
            </div>


<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
    <label for="employee">EO Contact</label>
    <input type="text" name="employee_name" id="employee" class="form-control" value="{{ isset($appointment) ? $appointment->employee->name : '' }}">
    @if($errors->has('employee_id'))
        <em class="invalid-feedback">
            {{ $errors->first('employee_id') }}
        </em>
    @endif
</div>
            
            <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}"><br>
                <label for="client">Venue*</label>
                <select name="client_id" id="client" class="form-control select2" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (isset($appointment) && $appointment->client ? $appointment->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('client_id') }}
                    </em>
                @endif
            </div>
            
          
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.appointment.fields.start_time') }}*</label>
                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($appointment) ? $appointment->start_time : '') }}" required>
                @if($errors->has('start_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appointment.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('finish_time') ? 'has-error' : '' }}">
                <label for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}*</label>
                <input type="text" id="finish_time" name="finish_time" class="form-control datetime" value="{{ old('finish_time', isset($appointment) ? $appointment->finish_time : '') }}" required>
                @if($errors->has('finish_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('finish_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appointment.fields.finish_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="capacity">*Capacity (%)     25%-Small 50%-Medium 75%-Major 100%-Full</label>
              <select type="number" id="capacity" name="capacity" class="form-control">
                    <option value=''></option>
                    <option value='25'>25%</option>
                    <option value='50'>50%</option>
                    <option value='75'>75%</option>
                    <option value='100'>100%</option>
                </select>
                @if($errors->has('capacity'))
                    <em class="invalid-feedback">
                        {{ $errors->first('capacity') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appointment.fields.price_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                <label for="comments">{{ trans('cruds.appointment.fields.comments') }}</label>
                <textarea id="comments" name="comments" class="form-control ">{{ old('comments', isset($appointment) ? $appointment->comments : '') }}</textarea>
                @if($errors->has('comments'))
                    <em class="invalid-feedback">
                        {{ $errors->first('comments') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appointment.fields.comments_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                <label for="services">Road Closure
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="services[]" id="services" class="form-control select2" multiple="multiple">
                    @foreach($services as $id => $services)
                        <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || isset($appointment) && $appointment->services->contains($id)) ? 'selected' : '' }}>{{ $services }}</option>
                    @endforeach
                </select>
                @if($errors->has('services'))
                    <em class="invalid-feedback">
                        {{ $errors->first('services') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appointment.fields.services_helper') }}
                </p>
            </div>
        
                <div class="col-50">
                  Will there be alcohol sales?
                     <input type="radio" required  name="alcohol_sales" value="Yes"> Yes
                     <input type="radio" required  name="alcohol_sales" value="No"> No<br>
                    </div><BR>
                   
                       Do you have EMS approval?
                        <input type="radio" required  name="ems_approval" value="Yes"> Yes
                        <input type="radio" required  name="ems_approval" value="No" onClick="popUppp();"> No<br>
              <br>
             Have evacuation and assembly points been checked?
              <input type="radio" required  name="evac_points" value="Yes"> Yes
              <input type="radio" required  name="evac_points" value="No" onClick="popUppp();"> No<br>
    <br>
              
                
                  Will there be amplified noise?
                
                
                     <input type="radio" required  name="noise" value="Yes" onClick="popUp();"/>Yes
                     <input type="radio" required  name="noise" value="No"> No<br>
               <div class='row'>

<br><br>
<div id="hide"  class="card" >
<div class="card-header">
<h3>Parking:</h3><div class="row">

    
   
   </div>
<div id="parking">
    <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
        <label for="services">
        </label>
        <select name="parking[]" id="parking" class="form-control select2" multiple="multiple">
            <option value="p4">P4</option>
            <option value="p5">P5</option>
            <option value="p6">P6</option>
             <option value="p6">P9</option>
            <option value="p12">P12</option>
            <option value="p13">P13</option>
            <option value="p13">P14</option>
           
        </select>
        @if($errors->has('services'))
            <em class="invalid-feedback">
                {{ $errors->first('services') }}
            </em>
        @endif
        <p class="helper-block">
            {{ trans('cruds.appointment.fields.services_helper') }}
        </p>
        <label for="start_time">Start Time*</label>
        <input type="text" id="pstart_time" name="pstart_time" class="form-control datetime" value="{{ old('pstart_time', isset($appointment) ? $appointment->pstart_time : '') }}" required>
      <br>
      <label for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}*</label>
      <input type="text" id="pfinish_time" name="pfinish_time" class="form-control datetime" value="{{ old('pfinish_time', isset($appointment) ? $appointment->pfinish_time : '') }}" required>
        <p class="helper-block">
            {{ trans('cruds.appointment.fields.start_time_helper') }}
        </p>
    
    </div>
</div></div><br>
               

               </div>
               <br>
               
               <br>
            </div>
         
              
            <div>
                
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>




</div>
<div class="col-sm-6">
        <!-- Map -->
        <div class="map-container column-map right-pos-map">
            <div id="map-main"></div><BR>
          <img class="legend" src="{{asset('images/P6.png')}}" alt="" >
            <div class="scrollContorl mapnavbtn" title="Enable Scrolling"></div>   						
        </div>
        <!-- Map end -->   
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        function popUp(){
            var popup = document.createElement('div');
            popup.className = 'popup';
            popup.id = 'test';
            var cancel = document.createElement('div');
            cancel.className = 'cancel';
            cancel.innerHTML = 'X';
            cancel.onclick = function (e) { popup.parentNode.removeChild(popup) };
            var message = document.createElement('span');
            message.innerHTML = "WARNING: Only one event with amplified noise allowed per day.";
            popup.appendChild(message);                                    
            popup.appendChild(cancel);
            document.body.appendChild(popup);
            }
             
             function popUpp(){
            var popupp = document.createElement('div');
            popupp.className = 'popupp';
            popupp.id = 'test';
            var cancel = document.createElement('div');
            cancel.className = 'cancel';
            cancel.innerHTML = 'X';
            cancel.onclick = function (e) { popupp.parentNode.removeChild(popupp) };
            var message = document.createElement('span');
            message.innerHTML = "WARNING: Emergency evacuation plan must be in place";
            popupp.appendChild(message);                                    
            popupp.appendChild(cancel);
            document.body.appendChild(popupp);
            }
            function popUppp(){
            var popuppp = document.createElement('div');
            popuppp.className = 'popuppp';
            popuppp.id = 'test';
            var cancel = document.createElement('div');
            cancel.className = 'cancel';
            cancel.innerHTML = 'X';
            cancel.onclick = function (e) { popuppp.parentNode.removeChild(popuppp) };
            var message = document.createElement('span');
            message.innerHTML = "WARNING:  EMS approval is required";
            popuppp.appendChild(message);                                    
            popuppp.appendChild(cancel);
            document.body.appendChild(popuppp);
            }
        </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUbsE_nWI-iCzfO4q8j2EqVL42HSTMOEs&callback=initMap" ></script>
          
          
          <script>
              
              function singleMap() {
        var myLatLng = {
            lng: $('#singleMap').data('longitude'),
            lat: $('#singleMap').data('latitude'),
        };
        var single_map = new google.maps.Map(document.getElementById('singleMap'), {
            zoom: 14,
            center: myLatLng,
            scrollwheel: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{
                    "color": "#f2f2f2"
                }]
            }]
        });
        var markerIcon2 = {
            url: 'images/marker.png',
        }		
        var marker = new google.maps.Marker({
            position: myLatLng,
			draggable: true,
            map: single_map,
            icon: markerIcon2,
            title: 'Your location'
        });
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, single_map);

        function ZoomControl(controlDiv, single_map) {
            zoomControlDiv.index = 1;
            single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "mapzoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "mapzoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() - 1);
            });
        }
              google.maps.event.addListener(marker, 'dragend', function (event) {
                  document.getElementById("lat").value = event.latLng.lat();
                  document.getElementById("long").value = event.latLng.lng();
              });		
    }
    var single_map = document.getElementById('singleMap');
    if (typeof (single_map) != 'undefined' && single_map != null) {
        google.maps.event.addDomListener(window, 'load', singleMap);
    }
          </script>
        <script>
            
            "use strict";
/**
 * @name InfoBox
 * @version 1.1.13 [March 19, 2014]
 * @author Gary Little (inspired by proof-of-concept code from Pamela Fox of Google)
 * @copyright Copyright 2010 Gary Little [gary at luxcentral.com]
 * @fileoverview InfoBox extends the Google Maps JavaScript API V3 <tt>OverlayView</tt> class.
 *  <p>
 *  An InfoBox behaves like a <tt>google.maps.InfoWindow</tt>, but it supports several
 *  additional properties for advanced styling. An InfoBox can also be used as a map label.
 *  <p>
 *  An InfoBox also fires the same events as a <tt>google.maps.InfoWindow</tt>.
 */
/*!
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*jslint browser:true */
/*global google */

/**
 * @name InfoBoxOptions
 * @class This class represents the optional parameter passed to the {@link InfoBox} constructor.
 * @property {string|Node} content The content of the InfoBox (plain text or an HTML DOM node).
 * @property {boolean} [disableAutoPan=false] Disable auto-pan on <tt>open</tt>.
 * @property {number} maxWidth The maximum width (in pixels) of the InfoBox. Set to 0 if no maximum.
 * @property {Size} pixelOffset The offset (in pixels) from the top left corner of the InfoBox
 *  (or the bottom left corner if the <code>alignBottom</code> property is <code>true</code>)
 *  to the map pixel corresponding to <tt>position</tt>.
 * @property {LatLng} position The geographic location at which to display the InfoBox.
 * @property {number} zIndex The CSS z-index style value for the InfoBox.
 *  Note: This value overrides a zIndex setting specified in the <tt>boxStyle</tt> property.
 * @property {string} [boxClass="infoBox"] The name of the CSS class defining the styles for the InfoBox container.
 * @property {Object} [boxStyle] An object literal whose properties define specific CSS
 *  style values to be applied to the InfoBox. Style values defined here override those that may
 *  be defined in the <code>boxClass</code> style sheet. If this property is changed after the
 *  InfoBox has been created, all previously set styles (except those defined in the style sheet)
 *  are removed from the InfoBox before the new style values are applied.
 * @property {string} closeBoxMargin The CSS margin style value for the close box.
 *  The default is "2px" (a 2-pixel margin on all sides).
 * @property {string} closeBoxURL The URL of the image representing the close box.
 *  Note: The default is the URL for Google's standard close box.
 *  Set this property to "" if no close box is required.
 * @property {Size} infoBoxClearance Minimum offset (in pixels) from the InfoBox to the
 *  map edge after an auto-pan.
 * @property {boolean} [isHidden=false] Hide the InfoBox on <tt>open</tt>.
 *  [Deprecated in favor of the <tt>visible</tt> property.]
 * @property {boolean} [visible=true] Show the InfoBox on <tt>open</tt>.
 * @property {boolean} alignBottom Align the bottom left corner of the InfoBox to the <code>position</code>
 *  location (default is <tt>false</tt> which means that the top left corner of the InfoBox is aligned).
 * @property {string} pane The pane where the InfoBox is to appear (default is "floatPane").
 *  Set the pane to "mapPane" if the InfoBox is being used as a map label.
 *  Valid pane names are the property names for the <tt>google.maps.MapPanes</tt> object.
 * @property {boolean} enableEventPropagation Propagate mousedown, mousemove, mouseover, mouseout,
 *  mouseup, click, dblclick, touchstart, touchend, touchmove, and contextmenu events in the InfoBox
 *  (default is <tt>false</tt> to mimic the behavior of a <tt>google.maps.InfoWindow</tt>). Set
 *  this property to <tt>true</tt> if the InfoBox is being used as a map label.
 */

/**
 * Creates an InfoBox with the options specified in {@link InfoBoxOptions}.
 *  Call <tt>InfoBox.open</tt> to add the box to the map.
 * @constructor
 * @param {InfoBoxOptions} [opt_opts]
 */
"use strict";
function InfoBox(opt_opts) {

  opt_opts = opt_opts || {};

  google.maps.OverlayView.apply(this, arguments);

  // Standard options (in common with google.maps.InfoWindow):
  //
  this.content_ = opt_opts.content || "";
  this.disableAutoPan_ = opt_opts.disableAutoPan || false;
  this.maxWidth_ = opt_opts.maxWidth || 0;
  this.pixelOffset_ = opt_opts.pixelOffset || new google.maps.Size(0, 0);
  this.position_ = opt_opts.position || new google.maps.LatLng(0, 0);
  this.zIndex_ = opt_opts.zIndex || null;

  // Additional options (unique to InfoBox):
  //
  this.boxClass_ = opt_opts.boxClass || "infoBox";
  this.boxStyle_ = opt_opts.boxStyle || {};
  this.closeBoxMargin_ = opt_opts.closeBoxMargin || "2px";
  this.closeBoxURL_ = opt_opts.closeBoxURL || "http://www.google.com/intl/en_us/mapfiles/close.gif";
  if (opt_opts.closeBoxURL === "") {
    this.closeBoxURL_ = "";
  }
  this.infoBoxClearance_ = opt_opts.infoBoxClearance || new google.maps.Size(1, 1);

  if (typeof opt_opts.visible === "undefined") {
    if (typeof opt_opts.isHidden === "undefined") {
      opt_opts.visible = true;
    } else {
      opt_opts.visible = !opt_opts.isHidden;
    }
  }
  this.isHidden_ = !opt_opts.visible;

  this.alignBottom_ = opt_opts.alignBottom || false;
  this.pane_ = opt_opts.pane || "floatPane";
  this.enableEventPropagation_ = opt_opts.enableEventPropagation || false;

  this.div_ = null;
  this.closeListener_ = null;
  this.moveListener_ = null;
  this.contextListener_ = null;
  this.eventListeners_ = null;
  this.fixedWidthSet_ = null;
}

/* InfoBox extends OverlayView in the Google Maps API v3.
 */
InfoBox.prototype = new google.maps.OverlayView();

/**
 * Creates the DIV representing the InfoBox.
 * @private
 */
InfoBox.prototype.createInfoBoxDiv_ = function () {

  var i;
  var events;
  var bw;
  var me = this;

  // This handler prevents an event in the InfoBox from being passed on to the map.
  //
  var cancelHandler = function (e) {
    e.cancelBubble = true;
    if (e.stopPropagation) {
      e.stopPropagation();
    }
  };

  // This handler ignores the current event in the InfoBox and conditionally prevents
  // the event from being passed on to the map. It is used for the contextmenu event.
  //
  var ignoreHandler = function (e) {

    e.returnValue = false;

    if (e.preventDefault) {

      e.preventDefault();
    }

    if (!me.enableEventPropagation_) {

      cancelHandler(e);
    }
  };

  if (!this.div_) {

    this.div_ = document.createElement("div");

    this.setBoxStyle_();

    if (typeof this.content_.nodeType === "undefined") {
      this.div_.innerHTML = this.getCloseBoxImg_() + this.content_;
    } else {
      this.div_.innerHTML = this.getCloseBoxImg_();
      this.div_.appendChild(this.content_);
    }

    // Add the InfoBox DIV to the DOM
    this.getPanes()[this.pane_].appendChild(this.div_);

    this.addClickHandler_();

    if (this.div_.style.width) {

      this.fixedWidthSet_ = true;

    } else {

      if (this.maxWidth_ != 0 && this.div_.offsetWidth > this.maxWidth_) {

        this.div_.style.width = this.maxWidth_;
        this.div_.style.overflow = "auto";
        this.fixedWidthSet_ = true;

      } else { // The following code is needed to overcome problems with MSIE

        bw = this.getBoxWidths_();

        this.div_.style.width = (this.div_.offsetWidth - bw.left - bw.right) + "px";
        this.fixedWidthSet_ = false;
      }
    }

    this.panBox_(this.disableAutoPan_);

    if (!this.enableEventPropagation_) {

      this.eventListeners_ = [];

      // Cancel event propagation.
      //
      // Note: mousemove not included (to resolve Issue 152)
      events = ["mousedown", "mouseover", "mouseout", "mouseup",
      "click", "dblclick", "touchstart", "touchend", "touchmove"];

      for (i = 0; i < events.length; i++) {

        this.eventListeners_.push(google.maps.event.addDomListener(this.div_, events[i], cancelHandler));
      }
      
      // Workaround for Google bug that causes the cursor to change to a pointer
      // when the mouse moves over a marker underneath InfoBox.
      this.eventListeners_.push(google.maps.event.addDomListener(this.div_, "mouseover", function (e) {
        this.style.cursor = "default";
      }));
    }

    this.contextListener_ = google.maps.event.addDomListener(this.div_, "contextmenu", ignoreHandler);

    /**
     * This event is fired when the DIV containing the InfoBox's content is attached to the DOM.
     * @name InfoBox#domready
     * @event
     */
    google.maps.event.trigger(this, "domready");
  }
};

/**
 * Returns the HTML <IMG> tag for the close box.
 * @private
 */
InfoBox.prototype.getCloseBoxImg_ = function () {

  var img = "";

  if (this.closeBoxURL_ != "") {

    img  = "<img";
    img += " src='" + this.closeBoxURL_ + "'";
    img += " align=right"; // Do this because Opera chokes on style='float: right;'
    img += " style='";
    img += " position: relative;"; // Required by MSIE
    img += " cursor: pointer;";
    img += " margin: " + this.closeBoxMargin_ + ";";
    img += "'>";
  }

  return img;
};

/**
 * Adds the click handler to the InfoBox close box.
 * @private
 */
InfoBox.prototype.addClickHandler_ = function () {

  var closeBox;

  if (this.closeBoxURL_ != "") {

    closeBox = this.div_.firstChild;
    this.closeListener_ = google.maps.event.addDomListener(closeBox, "click", this.getCloseClickHandler_());

  } else {

    this.closeListener_ = null;
  }
};

/**
 * Returns the function to call when the user clicks the close box of an InfoBox.
 * @private
 */
InfoBox.prototype.getCloseClickHandler_ = function () {

  var me = this;

  return function (e) {

    // 1.0.3 fix: Always prevent propagation of a close box click to the map:
    e.cancelBubble = true;

    if (e.stopPropagation) {

      e.stopPropagation();
    }

    /**
     * This event is fired when the InfoBox's close box is clicked.
     * @name InfoBox#closeclick
     * @event
     */
    google.maps.event.trigger(me, "closeclick");

    me.close();
  };
};

/**
 * Pans the map so that the InfoBox appears entirely within the map's visible area.
 * @private
 */
InfoBox.prototype.panBox_ = function (disablePan) {

  var map;
  var bounds;
  var xOffset = 0, yOffset = 0;

  if (!disablePan) {

    map = this.getMap();

    if (map instanceof google.maps.Map) { // Only pan if attached to map, not panorama

      if (!map.getBounds().contains(this.position_)) {
      // Marker not in visible area of map, so set center
      // of map to the marker position first.
        map.setCenter(this.position_);
      }

      bounds = map.getBounds();

      var mapDiv = map.getDiv();
      var mapWidth = mapDiv.offsetWidth;
      var mapHeight = mapDiv.offsetHeight;
      var iwOffsetX = this.pixelOffset_.width;
      var iwOffsetY = this.pixelOffset_.height;
      var iwWidth = this.div_.offsetWidth;
      var iwHeight = this.div_.offsetHeight;
      var padX = this.infoBoxClearance_.width;
      var padY = this.infoBoxClearance_.height;
      var pixPosition = this.getProjection().fromLatLngToContainerPixel(this.position_);

      if (pixPosition.x < (-iwOffsetX + padX)) {
        xOffset = pixPosition.x + iwOffsetX - padX;
      } else if ((pixPosition.x + iwWidth + iwOffsetX + padX) > mapWidth) {
        xOffset = pixPosition.x + iwWidth + iwOffsetX + padX - mapWidth;
      }
      if (this.alignBottom_) {
        if (pixPosition.y < (-iwOffsetY + padY + iwHeight)) {
          yOffset = pixPosition.y + iwOffsetY - padY - iwHeight;
        } else if ((pixPosition.y + iwOffsetY + padY) > mapHeight) {
          yOffset = pixPosition.y + iwOffsetY + padY - mapHeight;
        }
      } else {
        if (pixPosition.y < (-iwOffsetY + padY)) {
          yOffset = pixPosition.y + iwOffsetY - padY;
        } else if ((pixPosition.y + iwHeight + iwOffsetY + padY) > mapHeight) {
          yOffset = pixPosition.y + iwHeight + iwOffsetY + padY - mapHeight;
        }
      }

      if (!(xOffset === 0 && yOffset === 0)) {

        // Move the map to the shifted center.
        //
        var c = map.getCenter();
        map.panBy(xOffset, yOffset);
      }
    }
  }
};

/**
 * Sets the style of the InfoBox by setting the style sheet and applying
 * other specific styles requested.
 * @private
 */
InfoBox.prototype.setBoxStyle_ = function () {

  var i, boxStyle;

  if (this.div_) {

    // Apply style values from the style sheet defined in the boxClass parameter:
    this.div_.className = this.boxClass_;

    // Clear existing inline style values:
    this.div_.style.cssText = "";

    // Apply style values defined in the boxStyle parameter:
    boxStyle = this.boxStyle_;
    for (i in boxStyle) {

      if (boxStyle.hasOwnProperty(i)) {

        this.div_.style[i] = boxStyle[i];
      }
    }

    // Fix for iOS disappearing InfoBox problem.
    // See http://stackoverflow.com/questions/9229535/google-maps-markers-disappear-at-certain-zoom-level-only-on-iphone-ipad
    this.div_.style.WebkitTransform = "translateZ(0)";

    // Fix up opacity style for benefit of MSIE:
    //
    if (typeof this.div_.style.opacity != "undefined" && this.div_.style.opacity != "") {
      // See http://www.quirksmode.org/css/opacity.html
      this.div_.style.MsFilter = "\"progid:DXImageTransform.Microsoft.Alpha(Opacity=" + (this.div_.style.opacity * 100) + ")\"";
      this.div_.style.filter = "alpha(opacity=" + (this.div_.style.opacity * 100) + ")";
    }

    // Apply required styles:
    //
    this.div_.style.position = "absolute";
    this.div_.style.visibility = 'hidden';
    if (this.zIndex_ != null) {

      this.div_.style.zIndex = this.zIndex_;
    }
  }
};

/**
 * Get the widths of the borders of the InfoBox.
 * @private
 * @return {Object} widths object (top, bottom left, right)
 */
InfoBox.prototype.getBoxWidths_ = function () {

  var computedStyle;
  var bw = {top: 0, bottom: 0, left: 0, right: 0};
  var box = this.div_;

  if (document.defaultView && document.defaultView.getComputedStyle) {

    computedStyle = box.ownerDocument.defaultView.getComputedStyle(box, "");

    if (computedStyle) {

      // The computed styles are always in pixel units (good!)
      bw.top = parseInt(computedStyle.borderTopWidth, 10) || 0;
      bw.bottom = parseInt(computedStyle.borderBottomWidth, 10) || 0;
      bw.left = parseInt(computedStyle.borderLeftWidth, 10) || 0;
      bw.right = parseInt(computedStyle.borderRightWidth, 10) || 0;
    }

  } else if (document.documentElement.currentStyle) { // MSIE

    if (box.currentStyle) {

      // The current styles may not be in pixel units, but assume they are (bad!)
      bw.top = parseInt(box.currentStyle.borderTopWidth, 10) || 0;
      bw.bottom = parseInt(box.currentStyle.borderBottomWidth, 10) || 0;
      bw.left = parseInt(box.currentStyle.borderLeftWidth, 10) || 0;
      bw.right = parseInt(box.currentStyle.borderRightWidth, 10) || 0;
    }
  }

  return bw;
};

/**
 * Invoked when <tt>close</tt> is called. Do not call it directly.
 */
InfoBox.prototype.onRemove = function () {

  if (this.div_) {

    this.div_.parentNode.removeChild(this.div_);
    this.div_ = null;
  }
};

/**
 * Draws the InfoBox based on the current map projection and zoom level.
 */
InfoBox.prototype.draw = function () {

  this.createInfoBoxDiv_();

  var pixPosition = this.getProjection().fromLatLngToDivPixel(this.position_);

  this.div_.style.left = (pixPosition.x + this.pixelOffset_.width) + "px";
  
  if (this.alignBottom_) {
    this.div_.style.bottom = -(pixPosition.y + this.pixelOffset_.height) + "px";
  } else {
    this.div_.style.top = (pixPosition.y + this.pixelOffset_.height) + "px";
  }

  if (this.isHidden_) {

    this.div_.style.visibility = "hidden";

  } else {

    this.div_.style.visibility = "visible";
  }
};

/**
 * Sets the options for the InfoBox. Note that changes to the <tt>maxWidth</tt>,
 *  <tt>closeBoxMargin</tt>, <tt>closeBoxURL</tt>, and <tt>enableEventPropagation</tt>
 *  properties have no affect until the current InfoBox is <tt>close</tt>d and a new one
 *  is <tt>open</tt>ed.
 * @param {InfoBoxOptions} opt_opts
 */
InfoBox.prototype.setOptions = function (opt_opts) {
  if (typeof opt_opts.boxClass != "undefined") { // Must be first

    this.boxClass_ = opt_opts.boxClass;
    this.setBoxStyle_();
  }
  if (typeof opt_opts.boxStyle != "undefined") { // Must be second

    this.boxStyle_ = opt_opts.boxStyle;
    this.setBoxStyle_();
  }
  if (typeof opt_opts.content != "undefined") {

    this.setContent(opt_opts.content);
  }
  if (typeof opt_opts.disableAutoPan != "undefined") {

    this.disableAutoPan_ = opt_opts.disableAutoPan;
  }
  if (typeof opt_opts.maxWidth != "undefined") {

    this.maxWidth_ = opt_opts.maxWidth;
  }
  if (typeof opt_opts.pixelOffset != "undefined") {

    this.pixelOffset_ = opt_opts.pixelOffset;
  }
  if (typeof opt_opts.alignBottom != "undefined") {

    this.alignBottom_ = opt_opts.alignBottom;
  }
  if (typeof opt_opts.position != "undefined") {

    this.setPosition(opt_opts.position);
  }
  if (typeof opt_opts.zIndex != "undefined") {

    this.setZIndex(opt_opts.zIndex);
  }
  if (typeof opt_opts.closeBoxMargin != "undefined") {

    this.closeBoxMargin_ = opt_opts.closeBoxMargin;
  }
  if (typeof opt_opts.closeBoxURL != "undefined") {

    this.closeBoxURL_ = opt_opts.closeBoxURL;
  }
  if (typeof opt_opts.infoBoxClearance != "undefined") {

    this.infoBoxClearance_ = opt_opts.infoBoxClearance;
  }
  if (typeof opt_opts.isHidden != "undefined") {

    this.isHidden_ = opt_opts.isHidden;
  }
  if (typeof opt_opts.visible != "undefined") {

    this.isHidden_ = !opt_opts.visible;
  }
  if (typeof opt_opts.enableEventPropagation != "undefined") {

    this.enableEventPropagation_ = opt_opts.enableEventPropagation;
  }

  if (this.div_) {

    this.draw();
  }
};

/**
 * Sets the content of the InfoBox.
 *  The content can be plain text or an HTML DOM node.
 * @param {string|Node} content
 */
InfoBox.prototype.setContent = function (content) {
  this.content_ = content;

  if (this.div_) {

    if (this.closeListener_) {

      google.maps.event.removeListener(this.closeListener_);
      this.closeListener_ = null;
    }

    // Odd code required to make things work with MSIE.
    //
    if (!this.fixedWidthSet_) {

      this.div_.style.width = "";
    }

    if (typeof content.nodeType === "undefined") {
      this.div_.innerHTML = this.getCloseBoxImg_() + content;
    } else {
      this.div_.innerHTML = this.getCloseBoxImg_();
      this.div_.appendChild(content);
    }

    // Perverse code required to make things work with MSIE.
    // (Ensures the close box does, in fact, float to the right.)
    //
    if (!this.fixedWidthSet_) {
      this.div_.style.width = this.div_.offsetWidth + "px";
      if (typeof content.nodeType === "undefined") {
        this.div_.innerHTML = this.getCloseBoxImg_() + content;
      } else {
        this.div_.innerHTML = this.getCloseBoxImg_();
        this.div_.appendChild(content);
      }
    }

    this.addClickHandler_();
  }

  /**
   * This event is fired when the content of the InfoBox changes.
   * @name InfoBox#content_changed
   * @event
   */
  google.maps.event.trigger(this, "content_changed");
};

/**
 * Sets the geographic location of the InfoBox.
 * @param {LatLng} latlng
 */
InfoBox.prototype.setPosition = function (latlng) {

  this.position_ = latlng;

  if (this.div_) {

    this.draw();
  }

  /**
   * This event is fired when the position of the InfoBox changes.
   * @name InfoBox#position_changed
   * @event
   */
  google.maps.event.trigger(this, "position_changed");
};

/**
 * Sets the zIndex style for the InfoBox.
 * @param {number} index
 */
InfoBox.prototype.setZIndex = function (index) {

  this.zIndex_ = index;

  if (this.div_) {

    this.div_.style.zIndex = index;
  }

  /**
   * This event is fired when the zIndex of the InfoBox changes.
   * @name InfoBox#zindex_changed
   * @event
   */
  google.maps.event.trigger(this, "zindex_changed");
};

/**
 * Sets the visibility of the InfoBox.
 * @param {boolean} isVisible
 */
InfoBox.prototype.setVisible = function (isVisible) {

  this.isHidden_ = !isVisible;
  if (this.div_) {
    this.div_.style.visibility = (this.isHidden_ ? "hidden" : "visible");
  }
};

/**
 * Returns the content of the InfoBox.
 * @returns {string}
 */
InfoBox.prototype.getContent = function () {

  return this.content_;
};

/**
 * Returns the geographic location of the InfoBox.
 * @returns {LatLng}
 */
InfoBox.prototype.getPosition = function () {

  return this.position_;
};

/**
 * Returns the zIndex for the InfoBox.
 * @returns {number}
 */
InfoBox.prototype.getZIndex = function () {

  return this.zIndex_;
};

/**
 * Returns a flag indicating whether the InfoBox is visible.
 * @returns {boolean}
 */
InfoBox.prototype.getVisible = function () {

  var isVisible;

  if ((typeof this.getMap() === "undefined") || (this.getMap() === null)) {
    isVisible = false;
  } else {
    isVisible = !this.isHidden_;
  }
  return isVisible;
};

/**
 * Shows the InfoBox. [Deprecated; use <tt>setVisible</tt> instead.]
 */
InfoBox.prototype.show = function () {

  this.isHidden_ = false;
  if (this.div_) {
    this.div_.style.visibility = "visible";
  }
};

/**
 * Hides the InfoBox. [Deprecated; use <tt>setVisible</tt> instead.]
 */
InfoBox.prototype.hide = function () {

  this.isHidden_ = true;
  if (this.div_) {
    this.div_.style.visibility = "hidden";
  }
};

/**
 * Adds the InfoBox to the specified map or Street View panorama. If <tt>anchor</tt>
 *  (usually a <tt>google.maps.Marker</tt>) is specified, the position
 *  of the InfoBox is set to the position of the <tt>anchor</tt>. If the
 *  anchor is dragged to a new location, the InfoBox moves as well.
 * @param {Map|StreetViewPanorama} map
 * @param {MVCObject} [anchor]
 */
InfoBox.prototype.open = function (map, anchor) {

  var me = this;

  if (anchor) {

    this.position_ = anchor.getPosition();
    this.moveListener_ = google.maps.event.addListener(anchor, "position_changed", function () {
      me.setPosition(this.getPosition());
    });
  }

  this.setMap(map);

  if (this.div_) {

    this.panBox_();
  }
};

/**
 * Removes the InfoBox from the map.
 */
InfoBox.prototype.close = function () {

  var i;

  if (this.closeListener_) {

    google.maps.event.removeListener(this.closeListener_);
    this.closeListener_ = null;
  }

  if (this.eventListeners_) {
    
    for (i = 0; i < this.eventListeners_.length; i++) {

      google.maps.event.removeListener(this.eventListeners_[i]);
    }
    this.eventListeners_ = null;
  }

  if (this.moveListener_) {

    google.maps.event.removeListener(this.moveListener_);
    this.moveListener_ = null;
  }

  if (this.contextListener_) {

    google.maps.event.removeListener(this.contextListener_);
    this.contextListener_ = null;
  }

  this.setMap(null);
};
        </script>
        
        <script>
            
            function ClusterIcon(a,b){a.getMarkerClusterer().extend(ClusterIcon,google.maps.OverlayView),this.cluster_=a,this.className_=a.getMarkerClusterer().getClusterClass(),this.styles_=b,this.center_=null,this.div_=null,this.sums_=null,this.visible_=!1,this.setMap(a.getMap())}function Cluster(a){this.markerClusterer_=a,this.map_=a.getMap(),this.gridSize_=a.getGridSize(),this.minClusterSize_=a.getMinimumClusterSize(),this.averageCenter_=a.getAverageCenter(),this.markers_=[],this.center_=null,this.bounds_=null,this.clusterIcon_=new ClusterIcon(this,a.getStyles())}function MarkerClusterer(a,b,c){this.extend(MarkerClusterer,google.maps.OverlayView),b=b||[],c=c||{},this.markers_=[],this.clusters_=[],this.listeners_=[],this.activeMap_=null,this.ready_=!1,this.gridSize_=c.gridSize||60,this.minClusterSize_=c.minimumClusterSize||2,this.maxZoom_=c.maxZoom||null,this.styles_=c.styles||[],this.title_=c.title||"",this.zoomOnClick_=!0,void 0!==c.zoomOnClick&&(this.zoomOnClick_=c.zoomOnClick),this.averageCenter_=!1,void 0!==c.averageCenter&&(this.averageCenter_=c.averageCenter),this.ignoreHidden_=!1,void 0!==c.ignoreHidden&&(this.ignoreHidden_=c.ignoreHidden),this.enableRetinaIcons_=!1,void 0!==c.enableRetinaIcons&&(this.enableRetinaIcons_=c.enableRetinaIcons),this.imagePath_=c.imagePath||MarkerClusterer.IMAGE_PATH,this.imageExtension_=c.imageExtension||MarkerClusterer.IMAGE_EXTENSION,this.imageSizes_=c.imageSizes||MarkerClusterer.IMAGE_SIZES,this.calculator_=c.calculator||MarkerClusterer.CALCULATOR,this.batchSize_=c.batchSize||MarkerClusterer.BATCH_SIZE,this.batchSizeIE_=c.batchSizeIE||MarkerClusterer.BATCH_SIZE_IE,this.clusterClass_=c.clusterClass||"cluster",navigator.userAgent.toLowerCase().indexOf("msie")!==-1&&(this.batchSize_=this.batchSizeIE_),this.setupStyles_(),this.addMarkers(b,!0),this.setMap(a)}ClusterIcon.prototype.onAdd=function(){var b,c,a=this;this.div_=document.createElement("div"),this.div_.className=this.className_,this.visible_&&this.show(),this.getPanes().overlayMouseTarget.appendChild(this.div_),this.boundsChangedListener_=google.maps.event.addListener(this.getMap(),"bounds_changed",function(){c=b}),google.maps.event.addDomListener(this.div_,"mousedown",function(){b=!0,c=!1}),google.maps.event.addDomListener(this.div_,"click",function(d){if(b=!1,!c){var e,f,g=a.cluster_.getMarkerClusterer();google.maps.event.trigger(g,"click",a.cluster_),google.maps.event.trigger(g,"clusterclick",a.cluster_),g.getZoomOnClick()&&(f=g.getMaxZoom(),e=a.cluster_.getBounds(),g.getMap().fitBounds(e),setTimeout(function(){g.getMap().fitBounds(e),null!==f&&g.getMap().getZoom()>f&&g.getMap().setZoom(f+1)},100)),d.cancelBubble=!0,d.stopPropagation&&d.stopPropagation()}}),google.maps.event.addDomListener(this.div_,"mouseover",function(){var b=a.cluster_.getMarkerClusterer();google.maps.event.trigger(b,"mouseover",a.cluster_)}),google.maps.event.addDomListener(this.div_,"mouseout",function(){var b=a.cluster_.getMarkerClusterer();google.maps.event.trigger(b,"mouseout",a.cluster_)})},ClusterIcon.prototype.onRemove=function(){this.div_&&this.div_.parentNode&&(this.hide(),google.maps.event.removeListener(this.boundsChangedListener_),google.maps.event.clearInstanceListeners(this.div_),this.div_.parentNode.removeChild(this.div_),this.div_=null)},ClusterIcon.prototype.draw=function(){if(this.visible_){var a=this.getPosFromLatLng_(this.center_);this.div_.style.top=a.y+"px",this.div_.style.left=a.x+"px"}},ClusterIcon.prototype.hide=function(){this.div_&&(this.div_.style.display="none"),this.visible_=!1},ClusterIcon.prototype.show=function(){if(this.div_){var a="",b=this.backgroundPosition_.split(" "),c=parseInt(b[0].replace(/^\s+|\s+$/g,""),10),d=parseInt(b[1].replace(/^\s+|\s+$/g,""),10),e=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(e),a="<img src='"+this.url_+"' style='position: absolute; top: "+d+"px; left: "+c+"px; ",this.cluster_.getMarkerClusterer().enableRetinaIcons_||(a+="clip: rect("+-1*d+"px, "+(-1*c+this.width_)+"px, "+(-1*d+this.height_)+"px, "+-1*c+"px);"),a+="'>",this.div_.innerHTML=a+"<div class='cluster' style='position: absolute;top: "+this.anchorText_[0]+"px;left: "+this.anchorText_[1]+"px;color: "+this.textColor_+";font-size: "+this.textSize_+"px;font-family: "+this.fontFamily_+";font-weight: "+this.fontWeight_+";font-style: "+this.fontStyle_+";text-decoration: "+this.textDecoration_+";text-align: center;width: "+this.width_+"px;line-height:"+this.height_+"px;'>"+this.sums_.text+"</div>","undefined"==typeof this.sums_.title||""===this.sums_.title?this.div_.title=this.cluster_.getMarkerClusterer().getTitle():this.div_.title=this.sums_.title,this.div_.style.display=""}this.visible_=!0},ClusterIcon.prototype.useStyle=function(a){this.sums_=a;var b=Math.max(0,a.index-1);b=Math.min(this.styles_.length-1,b);var c=this.styles_[b];this.url_=c.url,this.height_=c.height,this.width_=c.width,this.anchorText_=c.anchorText||[0,0],this.anchorIcon_=c.anchorIcon||[parseInt(this.height_/2,10),parseInt(this.width_/2,10)],this.textColor_=c.textColor||"black",this.textSize_=c.textSize||11,this.textDecoration_=c.textDecoration||"none",this.fontWeight_=c.fontWeight||"bold",this.fontStyle_=c.fontStyle||"normal",this.fontFamily_=c.fontFamily||"Arial,sans-serif",this.backgroundPosition_=c.backgroundPosition||"0 0"},ClusterIcon.prototype.setCenter=function(a){this.center_=a},ClusterIcon.prototype.createCss=function(a){var b=[];return b.push("cursor: pointer;"),b.push("position: absolute; top: "+a.y+"px; left: "+a.x+"px;"),b.push("width: "+this.width_+"px; height: "+this.height_+"px;"),b.join("")},ClusterIcon.prototype.getPosFromLatLng_=function(a){var b=this.getProjection().fromLatLngToDivPixel(a);return b.x-=this.anchorIcon_[1],b.y-=this.anchorIcon_[0],b.x=parseInt(b.x,10),b.y=parseInt(b.y,10),b},Cluster.prototype.getSize=function(){return this.markers_.length},Cluster.prototype.getMarkers=function(){return this.markers_},Cluster.prototype.getCenter=function(){return this.center_},Cluster.prototype.getMap=function(){return this.map_},Cluster.prototype.getMarkerClusterer=function(){return this.markerClusterer_},Cluster.prototype.getBounds=function(){var a,b=new google.maps.LatLngBounds(this.center_,this.center_),c=this.getMarkers();for(a=0;a<c.length;a++)b.extend(c[a].getPosition());return b},Cluster.prototype.remove=function(){this.clusterIcon_.setMap(null),this.markers_=[],delete this.markers_},Cluster.prototype.addMarker=function(a){var b,c,d;if(this.isMarkerAlreadyAdded_(a))return!1;if(this.center_){if(this.averageCenter_){var e=this.markers_.length+1,f=(this.center_.lat()*(e-1)+a.getPosition().lat())/e,g=(this.center_.lng()*(e-1)+a.getPosition().lng())/e;this.center_=new google.maps.LatLng(f,g),this.calculateBounds_()}}else this.center_=a.getPosition(),this.calculateBounds_();if(a.isAdded=!0,this.markers_.push(a),c=this.markers_.length,d=this.markerClusterer_.getMaxZoom(),null!==d&&this.map_.getZoom()>d)a.getMap()!==this.map_&&a.setMap(this.map_);else if(c<this.minClusterSize_)a.getMap()!==this.map_&&a.setMap(this.map_);else if(c===this.minClusterSize_)for(b=0;b<c;b++)this.markers_[b].setMap(null);else a.setMap(null);return this.updateIcon_(),!0},Cluster.prototype.isMarkerInClusterBounds=function(a){return this.bounds_.contains(a.getPosition())},Cluster.prototype.calculateBounds_=function(){var a=new google.maps.LatLngBounds(this.center_,this.center_);this.bounds_=this.markerClusterer_.getExtendedBounds(a)},Cluster.prototype.updateIcon_=function(){var a=this.markers_.length,b=this.markerClusterer_.getMaxZoom();if(null!==b&&this.map_.getZoom()>b)return void this.clusterIcon_.hide();if(a<this.minClusterSize_)return void this.clusterIcon_.hide();var c=this.markerClusterer_.getStyles().length,d=this.markerClusterer_.getCalculator()(this.markers_,c);this.clusterIcon_.setCenter(this.center_),this.clusterIcon_.useStyle(d),this.clusterIcon_.show()},Cluster.prototype.isMarkerAlreadyAdded_=function(a){var b;if(this.markers_.indexOf)return this.markers_.indexOf(a)!==-1;for(b=0;b<this.markers_.length;b++)if(a===this.markers_[b])return!0;return!1},MarkerClusterer.prototype.onAdd=function(){var a=this;this.activeMap_=this.getMap(),this.ready_=!0,this.repaint(),this.listeners_=[google.maps.event.addListener(this.getMap(),"zoom_changed",function(){a.resetViewport_(!1),this.getZoom()!==(this.get("minZoom")||0)&&this.getZoom()!==this.get("maxZoom")||google.maps.event.trigger(this,"idle")}),google.maps.event.addListener(this.getMap(),"idle",function(){a.redraw_()})]},MarkerClusterer.prototype.onRemove=function(){var a;for(a=0;a<this.markers_.length;a++)this.markers_[a].getMap()!==this.activeMap_&&this.markers_[a].setMap(this.activeMap_);for(a=0;a<this.clusters_.length;a++)this.clusters_[a].remove();for(this.clusters_=[],a=0;a<this.listeners_.length;a++)google.maps.event.removeListener(this.listeners_[a]);this.listeners_=[],this.activeMap_=null,this.ready_=!1},MarkerClusterer.prototype.draw=function(){},MarkerClusterer.prototype.setupStyles_=function(){var a,b;if(!(this.styles_.length>0))for(a=0;a<this.imageSizes_.length;a++)b=this.imageSizes_[a],this.styles_.push({url:this.imagePath_+(a+1)+"."+this.imageExtension_,height:b,width:b})},MarkerClusterer.prototype.fitMapToMarkers=function(){var a,b=this.getMarkers(),c=new google.maps.LatLngBounds;for(a=0;a<b.length;a++)c.extend(b[a].getPosition());this.getMap().fitBounds(c)},MarkerClusterer.prototype.getGridSize=function(){return this.gridSize_},MarkerClusterer.prototype.setGridSize=function(a){this.gridSize_=a},MarkerClusterer.prototype.getMinimumClusterSize=function(){return this.minClusterSize_},MarkerClusterer.prototype.setMinimumClusterSize=function(a){this.minClusterSize_=a},MarkerClusterer.prototype.getMaxZoom=function(){return this.maxZoom_},MarkerClusterer.prototype.setMaxZoom=function(a){this.maxZoom_=a},MarkerClusterer.prototype.getStyles=function(){return this.styles_},MarkerClusterer.prototype.setStyles=function(a){this.styles_=a},MarkerClusterer.prototype.getTitle=function(){return this.title_},MarkerClusterer.prototype.setTitle=function(a){this.title_=a},MarkerClusterer.prototype.getZoomOnClick=function(){return this.zoomOnClick_},MarkerClusterer.prototype.setZoomOnClick=function(a){this.zoomOnClick_=a},MarkerClusterer.prototype.getAverageCenter=function(){return this.averageCenter_},MarkerClusterer.prototype.setAverageCenter=function(a){this.averageCenter_=a},MarkerClusterer.prototype.getIgnoreHidden=function(){return this.ignoreHidden_},MarkerClusterer.prototype.setIgnoreHidden=function(a){this.ignoreHidden_=a},MarkerClusterer.prototype.getEnableRetinaIcons=function(){return this.enableRetinaIcons_},MarkerClusterer.prototype.setEnableRetinaIcons=function(a){this.enableRetinaIcons_=a},MarkerClusterer.prototype.getImageExtension=function(){return this.imageExtension_},MarkerClusterer.prototype.setImageExtension=function(a){this.imageExtension_=a},MarkerClusterer.prototype.getImagePath=function(){return this.imagePath_},MarkerClusterer.prototype.setImagePath=function(a){this.imagePath_=a},MarkerClusterer.prototype.getImageSizes=function(){return this.imageSizes_},MarkerClusterer.prototype.setImageSizes=function(a){this.imageSizes_=a},MarkerClusterer.prototype.getCalculator=function(){return this.calculator_},MarkerClusterer.prototype.setCalculator=function(a){this.calculator_=a},MarkerClusterer.prototype.getBatchSizeIE=function(){return this.batchSizeIE_},MarkerClusterer.prototype.setBatchSizeIE=function(a){this.batchSizeIE_=a},MarkerClusterer.prototype.getClusterClass=function(){return this.clusterClass_},MarkerClusterer.prototype.setClusterClass=function(a){this.clusterClass_=a},MarkerClusterer.prototype.getMarkers=function(){return this.markers_},MarkerClusterer.prototype.getTotalMarkers=function(){return this.markers_.length},MarkerClusterer.prototype.getClusters=function(){return this.clusters_},MarkerClusterer.prototype.getTotalClusters=function(){return this.clusters_.length},MarkerClusterer.prototype.addMarker=function(a,b){this.pushMarkerTo_(a),b||this.redraw_()},MarkerClusterer.prototype.addMarkers=function(a,b){var c;for(c in a)a.hasOwnProperty(c)&&this.pushMarkerTo_(a[c]);b||this.redraw_()},MarkerClusterer.prototype.pushMarkerTo_=function(a){if(a.getDraggable()){var b=this;google.maps.event.addListener(a,"dragend",function(){b.ready_&&(this.isAdded=!1,b.repaint())})}a.isAdded=!1,this.markers_.push(a)},MarkerClusterer.prototype.removeMarker=function(a,b){var c=this.removeMarker_(a);return!b&&c&&this.repaint(),c},MarkerClusterer.prototype.removeMarkers=function(a,b){var c,d,e=!1;for(c=0;c<a.length;c++)d=this.removeMarker_(a[c]),e=e||d;return!b&&e&&this.repaint(),e},MarkerClusterer.prototype.removeMarker_=function(a){var b,c=-1;if(this.markers_.indexOf)c=this.markers_.indexOf(a);else for(b=0;b<this.markers_.length;b++)if(a===this.markers_[b]){c=b;break}return c!==-1&&(a.setMap(null),this.markers_.splice(c,1),!0)},MarkerClusterer.prototype.clearMarkers=function(){this.resetViewport_(!0),this.markers_=[]},MarkerClusterer.prototype.repaint=function(){var a=this.clusters_.slice();this.clusters_=[],this.resetViewport_(!1),this.redraw_(),setTimeout(function(){var b;for(b=0;b<a.length;b++)a[b].remove()},0)},MarkerClusterer.prototype.getExtendedBounds=function(a){var b=this.getProjection(),c=new google.maps.LatLng(a.getNorthEast().lat(),a.getNorthEast().lng()),d=new google.maps.LatLng(a.getSouthWest().lat(),a.getSouthWest().lng()),e=b.fromLatLngToDivPixel(c);e.x+=this.gridSize_,e.y-=this.gridSize_;var f=b.fromLatLngToDivPixel(d);f.x-=this.gridSize_,f.y+=this.gridSize_;var g=b.fromDivPixelToLatLng(e),h=b.fromDivPixelToLatLng(f);return a.extend(g),a.extend(h),a},MarkerClusterer.prototype.redraw_=function(){this.createClusters_(0)},MarkerClusterer.prototype.resetViewport_=function(a){var b,c;for(b=0;b<this.clusters_.length;b++)this.clusters_[b].remove();for(this.clusters_=[],b=0;b<this.markers_.length;b++)c=this.markers_[b],c.isAdded=!1,a&&c.setMap(null)},MarkerClusterer.prototype.distanceBetweenPoints_=function(a,b){var c=6371,d=(b.lat()-a.lat())*Math.PI/180,e=(b.lng()-a.lng())*Math.PI/180,f=Math.sin(d/2)*Math.sin(d/2)+Math.cos(a.lat()*Math.PI/180)*Math.cos(b.lat()*Math.PI/180)*Math.sin(e/2)*Math.sin(e/2),g=2*Math.atan2(Math.sqrt(f),Math.sqrt(1-f)),h=c*g;return h},MarkerClusterer.prototype.isMarkerInBounds_=function(a,b){return b.contains(a.getPosition())},MarkerClusterer.prototype.addToClosestCluster_=function(a){var b,c,d,e,f=4e4,g=null;for(b=0;b<this.clusters_.length;b++)d=this.clusters_[b],e=d.getCenter(),e&&(c=this.distanceBetweenPoints_(e,a.getPosition()),c<f&&(f=c,g=d));g&&g.isMarkerInClusterBounds(a)?g.addMarker(a):(d=new Cluster(this),d.addMarker(a),this.clusters_.push(d))},MarkerClusterer.prototype.createClusters_=function(a){var b,c,d,e=this;if(this.ready_){0===a&&(google.maps.event.trigger(this,"clusteringbegin",this),"undefined"!=typeof this.timerRefStatic&&(clearTimeout(this.timerRefStatic),delete this.timerRefStatic)),d=this.getMap().getZoom()>3?new google.maps.LatLngBounds(this.getMap().getBounds().getSouthWest(),this.getMap().getBounds().getNorthEast()):new google.maps.LatLngBounds(new google.maps.LatLng(85.02070771743472,-178.48388434375),new google.maps.LatLng(-85.08136444384544,178.00048865625));var f=this.getExtendedBounds(d),g=Math.min(a+this.batchSize_,this.markers_.length);for(b=a;b<g;b++)c=this.markers_[b],!c.isAdded&&this.isMarkerInBounds_(c,f)&&(!this.ignoreHidden_||this.ignoreHidden_&&c.getVisible())&&this.addToClosestCluster_(c);g<this.markers_.length?this.timerRefStatic=setTimeout(function(){e.createClusters_(g)},0):(delete this.timerRefStatic,google.maps.event.trigger(this,"clusteringend",this))}},MarkerClusterer.prototype.extend=function(a,b){return function(a){var b;for(b in a.prototype)this.prototype[b]=a.prototype[b];return this}.apply(a,[b])},MarkerClusterer.CALCULATOR=function(a,b){for(var c=0,d="",e=a.length.toString(),f=e;0!==f;)f=parseInt(f/10,10),c++;return c=Math.min(c,b),{text:e,index:c,title:d}},MarkerClusterer.BATCH_SIZE=2e3,MarkerClusterer.BATCH_SIZE_IE=500,MarkerClusterer.IMAGE_PATH="../images/m",MarkerClusterer.IMAGE_EXTENSION="png",MarkerClusterer.IMAGE_SIZES=[53,56,66,78,90];
        </script>
    <script type="text/javascript" src="{{ asset('js/plugins.js')}}"></script>
   

     
    <script src="{{ asset('js/main.js') }}"></script>


    
    <script type="text/javascript" src="{{ asset('js/scripts.js')}}"></script>
    
    <script   type="text/javascript">
              
              
             (function ($) {
    "use strict";
    
   
   var myLatlng = new google.maps.LatLng(-33.9027531,18.4059689 );
 var markerIcon = new google.maps.Marker({
     position: myLatlng,
     map: map,
     title:"Hamilton Rugby Club",
    image:'{{asset('images/marker.png')}}'
  
   });
   google.maps.event.addListener(markerIcon, "click", () => {
    var infowindow = new google.maps.InfoWindow();
    infowindow.setContent(`<div class="map-popup-wrap"><div class="map-popup"><h2>Hamilton Rugby Club</h2><div style='float:left'><img src="{{asset('images/ham.png')}}"></div><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category`);
    infowindow.open(map, markerIcon);
 });


   markerIcon.setMap(map);
    
      
        var map = new google.maps.Map(document.getElementById('map-main'), {
            zoom: 15.7,
            scrollwheel: false,
            center: new google.maps.LatLng(-33.9047531,18.40646600 ),
            mapTypeId: google.maps.MapTypeId.SATELLITE,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            fullscreenControl: false,
            navigationControl: false,
            streetViewControl: false,
            animation: google.maps.Animation.BOUNCE,
            gestureHandling: 'cooperative',
            styles: [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{
                    visibility: "on" 
                    
                }]
            }]
        });


        map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true,
            styles: [{
              
                featureType: "poi",
        //elementType: "labels",
                "stylers": [{
                    visibility: "on" 
                    
                }]
            }]});
///make the icons not to show
//var myStyles =[
    //{
        //featureType: "poi",
        //elementType: "labels",
        //stylers: [
              //{ visibility: "off" }
        //]
    //}
//];
[
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
]

//read from the above variable
//var myOptions = {
    //zoom: 10,
    //center: homeLatlng,
    //mapTypeId: google.maps.MapTypeId.ROADMAP,
    //styles: myStyles 
//};








var marker = new google.maps.Marker({
    position: {lat: -33.9027531, lng: 18.4059689},
    map: map,
    title: 'Hamilton Rugby Club',
image:'',
	animation: google.maps.Animation.BOUNCE,
	draggable: true
  });

  google.maps.event.addListener(marker, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4  style="color: #000000;">Hamilton Rugby Club</h4></div>`);
   infowindow.open(map, marker);
});
setTimeout(function(){ marker.setAnimation(null); }, 750);
/////othermarker
var marker1 = new google.maps.Marker({
     position: {lat: -33.903551, lng:   18.407698},
    map: map,
    title: 'Green Point Cricket Club',
image:'',
	animation: google.maps.Animation.BOUNCE,
	draggable: true
  });

  google.maps.event.addListener(marker1, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4 style="color: #000000;">Green Point Cricket Club</h4></div>`);
   infowindow.open(map, marker1);
});
setTimeout(function(){ marker1.setAnimation(null); }, 750);

//othermarker
var marker2 = new google.maps.Marker({
    position: {lat: -33.906372, lng:   18.405923},
    map: map,
    title: 'Green Point Shared Fields',
image:'',
	animation: google.maps.Animation.BOUNCE,
	draggable: true
  });

  google.maps.event.addListener(marker2, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4 style="color: #000000;">Green Point Shared Fields</h4></div>`);
   infowindow.open(map, marker2);
});

setTimeout(function(){ marker2.setAnimation(null); }, 750);
///othermarker
var marker3 = new google.maps.Marker({
    position: {lat: -33.903857,  lng:   18.401107},
    map: map,
    title: 'Green Point Urban Park',
image:'',
	animation: google.maps.Animation.BOUNCE,
	draggable: true
  });

  google.maps.event.addListener(marker3, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4 style="color: #000000;">Green Point Urban Park</h4></div>`);
   infowindow.open(map, marker3);
});
setTimeout(function(){ marker3.setAnimation(null); }, 750);

//othermarker

var marker4 = new google.maps.Marker({
    position: {lat: -33.905834,  lng:    18.408971},
    map: map,
    title: 'Green Point Stadium',
image:'',
	animation: google.maps.Animation.BOUNCE,
	draggable: true
  });

  google.maps.event.addListener(marker4, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4 style="color: #000000;">Green Point Stadium</h4></div>`);
   infowindow.open(map, marker4);
});
setTimeout(function(){ marker4.setAnimation(null); }, 750);
//othermarker

var marker5 = new google.maps.Marker({
    position: {lat: -33.906451,    lng:    18.412911},
    map: map,
    title: 'Green Point A Track',
image:'',
	animation: google.maps.Animation.BOUNCE,
	draggable: true
  });

  google.maps.event.addListener(marker5, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4 style="color: #000000;">Green Point A Track</h4></div>`);
   infowindow.open(map, marker5);
});
setTimeout(function(){ marker5.setAnimation(null); }, 750);
        ///othermarkers
        var marker6 = new google.maps.Marker({
    position: {lat: -33.903270,  lng:     18.410856},
    map: map,
    title: 'Cape Town Stadium',
image:'',
	animation: google.maps.Animation.BOUNCE,
   
	draggable: true
  });

  google.maps.event.addListener(marker6, "click", () => {
   var infowindow = new google.maps.InfoWindow();
   infowindow.setContent(`<div class="ui header"><h4 style="color: #000000;">Cape Town Stadium</h4></div>`);
   infowindow.open(map, marker6);
});
setTimeout(function(){ marker6.setAnimation(null); }, 750);
          
           
           
           














 // Define the LatLng coordinates for the polygon's path.  
 var triangleCoords =   
 [{lat:-33.907344, lng:18.410456},       
 {lat:-33.907596, lng:18.410545},      
 {lat:-33.907918, lng:18.410370},  
 
 {lat:-33.907390, lng:18.408777},
 {lat:-33.907338, lng:18.408331},
 {lat:-33.907719, lng:18.402627},
 {lat:-33.907233, lng:18.402568},
 {lat:-33.907309, lng:18.404328},
 {lat:-33.907126, lng:18.408169}


]; 
 // Construct the polygon.  
 var drawTriangle = new google.maps.Polygon({  
    paths: triangleCoords,  
    strokeColor: '#008000',  
    strokeOpacity: 0.8,  
    strokeWeight: 2,  
    fillColor: '#008000',  
    fillOpacity: 0.35  
  });  
  drawTriangle.setMap(map);  



// Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.907496, lng:18.411049},       
{lat:-33.908008, lng:18.410652},      
{lat:-33.908493, lng:18.412052},  

{lat:-33.908275, lng:18.412208}

]; 
// Construct the polygon.changed to orange  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#FF5F1F',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#FF5F1F',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);  
 // Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.906565, lng:18.411559},       
{lat:-33.907015, lng:18.411205},      
{lat:-33.907158, lng:18.411285},  

{lat:-33.907981, lng:18.412530},
{lat:-33.907799, lng:18.412583}


]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#00FFFF',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#00FFFF',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);

 


// Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.903869, lng:18.409241},       
{lat:-33.904428, lng:18.408558},      
{lat:-33.904486, lng:18.408676}, 


{lat:-33.904380, lng:18.408912},
{lat:-33.904616, lng:18.409869}



]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#DC143C',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#DC143C',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);


 
  //Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.906416, lng:18.406782},       
{lat:-33.906549, lng:18.406909},      
{lat:-33.906460, lng:18.408204}, 


{lat:-33.905917, lng:18.407501}




]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#D6F430',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#D6F430',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);




 ///Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.906813, lng:18.404714},       
{lat:-33.906769, lng:18.406098},      
{lat:-33.904970, lng:18.403652}, 


{lat:-33.905397, lng:18.402869}




]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#662d91',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#662d91',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(null);



 // Define the LatLng coordinates for the polygon's path.p6-33.904975, lng:18.410131  
 var triangleCoords =   
 [{lat:-33.904745, lng:18.409965},   

   
 {lat:-33.904945, lng:18.409743 }, 

   
 {lat:-33.905810, lng:18.410491},  
 
 {lat:-33.905650, lng:18.410694}


 
]; 
 // Construct the polygon.  
 var drawTriangle = new google.maps.Polygon({  
    paths: triangleCoords,  
    strokeColor: '#0000FF',  
    strokeOpacity: 0.8,  
    strokeWeight: 2,  
    fillColor: '#0000FF',  
    fillOpacity: 0.35  
  });  
  drawTriangle.setMap(map);  



 
 

 
 





        var boxText = document.createElement("div");
        boxText.className = 'map-box'
        var currentInfobox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: true,
            alignBottom: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-145, -45),
            zIndex: null,
            boxStyle: {
                width: "260px"
            },
            closeBoxMargin: "0",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
        };
        var markerCluster, marker, i;
        var allMarkers = [];
        var clusterStyles = [{
            textColor: 'white',
            url: '',
            height: 50,
            width: 50
        }];


        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: locations[i][4],
                id: i
            });
            allMarkers.push(marker);
            var ib = new InfoBox();
            google.maps.event.addListener(ib, "domready", function () {
                cardRaining()
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    ib.setOptions(boxOptions);
                    boxText.innerHTML = locations[i][0];
                    ib.close();
                    ib.open(map, marker);
                    currentInfobox = marker.id;
                    var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.panTo(latLng);
                    map.panBy(0, -180);
                    google.maps.event.addListener(ib, 'domready', function () {
                        $('.infoBox-close').click(function (e) {
                            e.preventDefault();
                            ib.close();
                        });
                    });
                }
            })(marker, i));
        }
        var options = {
            imagePath: 'images/',
            styles: clusterStyles,
            minClusterSize: 2
        };
        markerCluster = new MarkerClusterer(map, allMarkers, options);
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        $('.nextmap-nav').click(function (e) {
            e.preventDefault();
            map.setZoom(15);
            var index = currentInfobox;
            if (index + 1 < allMarkers.length) {
                google.maps.event.trigger(allMarkers[index + 1], 'click');
            } else {
                google.maps.event.trigger(allMarkers[0], 'click');
            }
        });
        $('.prevmap-nav').click(function (e) {
            e.preventDefault();
            map.setZoom(15);
            if (typeof (currentInfobox) == "undefined") {
                google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
            } else {
                var index = currentInfobox;
                if (index - 1 < 0) {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                } else {
                    google.maps.event.trigger(allMarkers[index - 1], 'click');
                }
            }
        });
        $('.map-item').click(function (e) {
            e.preventDefault();
     		map.setZoom(15);
            var index = currentInfobox;
            var marker_index = parseInt($(this).attr('href').split('#')[1], 10);
            google.maps.event.trigger(allMarkers[marker_index], "click");
			if ($(this).hasClass("scroll-top-map")){
			  $('html, body').animate({
				scrollTop: $(".map-container").offset().top+ "-80px"
			  }, 500)
			}
			else if ($(window).width()<1064){
			  $('html, body').animate({
				scrollTop: $(".map-container").offset().top+ "-80px"
			  }, 500)
			}
        });
      // Scroll enabling button
    
       


    
    var map = document.getElementById('map-main');
    if (typeof (map) != 'undefined' && map != null) {
        google.maps.event.addDomListener(window, 'load', mainMap);
    }

    //DELETE MAP MARKERS

    function DeleteMarkers() {
        //Loop through all the markers and remove
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    };

    ///END OF DELETE MAKERS

    function singleMap() {
        var myLatLng = {
            lng: $('#singleMap').data('longitude'),
            lat: $('#singleMap').data('latitude'),
        };
        var single_map = new google.maps.Map(document.getElementById('singleMap'), {
            zoom: 14,
            center: myLatLng,
            scrollwheel: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{
                    "color": "#f2f2f2"
                }]
            }]
        });
        var markerIcon2 = {
            url: 'images/marker.png',
        }		
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: single_map,
            icon: markerIcon2,
            title: 'Our Location'
        });
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, single_map);

        function ZoomControl(controlDiv, single_map) {
            zoomControlDiv.index = 1;
            single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "mapzoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "mapzoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() - 1);
            });
        }
    }
    var single_map = document.getElementById('singleMap');
    if (typeof (single_map) != 'undefined' && single_map != null) {
        google.maps.event.addDomListener(window, 'load', singleMap);
    }
})(this.jQuery);

          </script>
   
   
 


@endsection