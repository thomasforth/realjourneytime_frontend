<!DOCTYPE html>
<html>

<head>
    <meta content="en-gb" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta id="viewportid" name="viewport" content="width=device-width">
    <link rel="stylesheet" href="js/leaflet.css" />
    <script src="js/leaflet.js"></script>
    <title>LineTracker</title>
    <link href="css/pikaday.css" rel="stylesheet">
    <link href="animate.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/stuquery.barchart.css">
    <link href="css/font-awesome.css" rel="stylesheet">
    <script type="text/javascript" src="js/stuquery.js"></script>
    <script type="text/javascript" src="js/stuquery.barchart.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/chart.js"></script>
    <script type="text/javascript" src="js/leaflet.polylineDecorator.js"></script>
    <script type="text/javascript" src="js/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="css/MarkerCluster.css" />
    <link rel="stylesheet" href="css/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="css/leaflet.awesome-markers.css">
    <script src="js/leaflet.awesome-markers.js"></script>
    <style>
        body {
            margin: 0px;
            font-family: "Tahoma", sans-serif;
            background-color: #F4F4F4
        }

        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        table {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        canvas {
            user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }

        h1 {
            text-align: center;
            font-weight: 600;
            font-size: 4.5em;
            margin: 0px;
            background: #00497C;
            color: white;
            padding-bottom: 10px;
        }

        .bottom {
            margin-top: 40px;
            background: #00497C;
            color: white;
        }

        .bottomHolder {
            max-width: 800px;
            margin: auto;
        }

        h3 {
            text-align: left;
            padding: 10px;
            background: #39BAEC;
            color: white;
            position: relative;
        }

        h4 {
            text-align: left;
            padding: 5px 0;
            color: black;
            font-weight: bold;
        }

        .fromStop {
            fill: blue;
            stroke-width: 0;
            fill-opacity: 1
        }

        .fromStopPLT {
            fill: green;
            stroke-width: 0;
            fill-opacity: 1
        }

        .toStop {
            fill: red;
            stroke-width: 0;
            fill-opacity: 1
        }

        .flex-grid {
            text-align: center;
            margin: auto;
            max-width: 1400px;
            display: flex;
        }

        .col {
            flex: 1;
            padding: 0px 20px;
            /*  width: 50%;*/
        }

        #map {
            width: auto;
            height: 500px;
            padding: 10px;
        }

        #subhead {
            text-align: center;
        }

        .code {
            font-family: monospace;
            text-align: left;
        }

        #resetMap {
            text-align: right;
            font-style: italic;
            font-size: small;
            display: block;
            margin: -14px 0px 6px 0px;
        }

        .leftp {
            margin: 25px auto 0px auto;
            text-align: left;
        }

        #binnedRealJourneyTimes .bar {
            background-color: red;
        }

        #binnedScheduledJourneyTimes .bar {
            background-color: green;
        }

        .chartTitle {
            font-weight: bold;
            font-size: 0.9em;
        }

        .journeyChart {
            height: 300px;
            margin-bottom: 3em;
        }

        .label {
            font-size: 0.8em;
            border-left: 1px solid #A5A5A5 !important;
        }

        .line {
            font-size: 0.8em;
            text-align: left !important;
            opacity: 1 !important;
            border-bottom: 1px solid #ededed !important;
        }

        .barbase {
            border-bottom: 1px solid #A5A5A5 !important;
        }

        #timeIncrementHolder {
            text-align: left;
            margin-top: -1.1em;
            margin-bottom: 1.2em;
            font-size: 0.9em;
        }

        .balloon {
            background-color: #424242 !important;
            color: white;
            font-size: 0.9em;
            padding: 0.6em 0.5em !important;
            border-radius: 0.3em;
        }

        .balloon::after {
            border-left-color: #424242 !important;
        }

        .dateSelectionElement {
            margin: 1em;
        }

        .dateSelectionElement input,
        .dateSelectionElement select {
            width: 40%;
            font-size: 1em;
            margin: 0.4em;
            box-sizing: border-box;
            border-width: 1px;
            border-style: solid;
            border-color: rgb(169, 169, 169);
        }

        .dateSelectionElement input {
            padding-left: 0.2em;
        }

        #pickStopHeading {
            margin-bottom: 0px;
        }

        .rightaligned {
            height: 30px;
            position: absolute;
            right: 5px;
            top: 5px;
            visibility: hidden;
        }

        .spinner {
            height: 30px;
        }

        .spinnertext {
            color: #00497C;
            font-size: small;
            margin-right: 15px;
            vertical-align: text-top;
        }

        #charts {
            visibility: hidden;
            /*   display: none;*/
        }

        .controls {}

        .timeSelectionWrapper {}

        .timeSelectionHolder {
            display: inline-block;
            margin: 0 1em;
            white-space: nowrap;
        }

        .timeSelectionLabel {
            text-align: left;
            margin-bottom: 0.2em;
        }

        .timeSelect {
            font-family: "Tahoma", sans-serif;
            font-size: 1em;
        }

        .dateRangeElement {
            display: inline-block;
            width: 220px;
            font-size: 1em;
            margin-bottom: 1em;
            margin: 0 0.6em;
            margin-bottom: 1em;
        }

        .dateRangeElement input,
        #specialDateSelection {
            width: 100%;
            background-color: white;
            color: black;
            font-size: 1em;
            padding: 1px;
        }

        .dateRangeElement label,
        #specialDateSelectionTitle {
            width: 100%;
            margin-bottom: 0.2em;
            display: inline-block;
            text-align: left;
        }

        #timeWarningMessage {
            font-weight: bold;
            font-size: 0.8em;
            margin-top: 0.3em;
            margin-bottom: -0.7em;
        }

        #timeWarningMessage .fa {
            margin-right: 0.2em;
        }

        .marker-cluster div {
            background-color: #267fca !important;
            color: white;
            font: 12px 'Fira Sans', sans-serif !important;
        }

        .marker-cluster-small {
            background-color: rgba(38, 127, 202, 0.6);
        }

        .marker-cluster-medium {
            background-color: rgba(38, 127, 202, 0.6);
        }

        .marker-cluster-large {
            background-color: rgba(38, 127, 202, 0.6);
        }

        #charts {}

        #journeyByTimeHolder {
            width: 100%;
        }

        #journeyByTime {
            width: 100%;
        }

        #serviceSelectHolder {
            font-size: 0.9em;
            text-align: left;
        }

        select,
        input {
            font-family: "Tahoma", sans-serif;
            font-size: 1em;
        }

        .stopExplanation {
            font-size: 0.8em;
        }

        .page-link {
            color: white;
        }

        @media screen and (max-width: 900px) {
            .flex-grid {
                flex-direction: column;
            }

            .col {
                /*width: 100%;*/
            }

            h1 {
                font-size: 2.5em !important;
            }
        }
    </style>

</head>

<body onload="init()">

    <div id="contentWrapper">
        <h1>Real Journey Time</h1>
        <p id="subhead">Using the Real Journey Time API to explore bus journey times in The West Midlands.</p>
        <div class="flex-grid">
            <div class="col">
                <h3 id="pickStopHeading">
                    <span id="pickABusStopText">1. Pick a bus stop.</span><span id="spinner1" class="rightaligned"><span id="spinner1text" class="spinnertext"></span><img class="spinner" src="Spinner-3s-200px.svg" /></span>
                </h3>
                <div id="map"></div>
                <h3>2. Pick a date and time</h3>

                <div id="dateRangeHolder" class="controls">
                    <div class="dateRangeElement">
                        <label for="start">Select date:</label>
                        <input type="text" id="startDateInput">
                    </div>
                    <div class="dateRangeElement" style="display: none;">
                        <label for="end">End date:</label>
                        <input type="text" id="endDateInput">
                    </div>
                    <br>
                    <div class="dateRangeElement">
                        <div id="specialDateSelectionTitle">Select special dates:</div>
                        <select id="specialDateSelection" onchange="specialDatesChanged()">
                            <option value="null">Pick special dates...</option>
                            <option value="weekdays">Weekdays</option>
                            <option value="saturdays">Saturdays</option>
                            <option value="sundays">Sundays</option>
                            <option value="bankholiday">Bank holidays</option>
                            <option value="schoolholidayweekday">School holidays weekday</option>
                            <option value="schoolholidayweekend">School holidays weekend</option>
                        </select>
                    </div>
                </div>
                <div id="timeSelectionWrapper" class="controls">
                    <div class="timeSelectionHolder">
                        <div class="timeSelectionLabel">Start time:</div>
                        <select onchange="validateMinutes(this.id, 'startMinutes'); timeChanged(this)" id="startHour" class="timeSelect">
                            <option value="00" selected>00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                        </select>
                        <span class="timeBreak">:</span>
                        <select onchange="timeChanged(this)" id="startMinutes" class="timeSelect">
                            <option value="00" selected>00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <!-- <select onchange="timeChanged(this)" id="startAmPm" class="timeSelect">
                            <option value="AM" selected>AM</option>
                            <option value="PM">PM</option>
                        </select>-->
                    </div>
                    <div class="timeSelectionHolder">
                        <div class="timeSelectionLabel">End time:</div>
                        <select onchange="validateMinutes(this.id, 'endMinutes'); timeChanged(this)" id="endHour" class="timeSelect">
                            <option value="00">00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24" selected>24</option>
                        </select>
                        <span class="timeBreak">:</span>
                        <select onchange="timeChanged(this)" id="endMinutes" class="timeSelect">
                            <option value="00" selected>00</option>
                            <option value="15" disabled>15</option>
                            <option value="30" disabled>30</option>
                            <option value="45" disabled>45</option>
                        </select>
                        <!--  <select onchange="timeChanged(this)" id="endAmPm" class="timeSelect">
                            <option value="AM">AM</option>
                            <option value="PM" selected>PM</option>
                        </select>-->
                    </div>
                    <div id="timeWarningMessage"></div>
                    <p>There's data from about the 26th of March.</p>
                </div>
                <h3 id="APIheader">3. API calls.</h3>
                <p class="leftp">There are currently three methods for the API. Click stops on the map above to see an example of them all.</p>
                <p class="leftp">1. Get all stops currently in the database.</p>
                <p class="code">https://realjourneytime.azurewebsites.net/index.php?method=AllStops</p>
                <p class="leftp">2. Get all stops reachable from a stop.</p>
                <p class="code" id="stopsFromStop">&nbsp;</p>
                <p class="leftp">3. Get all journeys between the two selected stops, and the worst journey time within 30 minute bins.</p>
                <p class="code" id="queryURL"></p>
            </div>
            <div class="col">
                <h3>4. Get charts <span id="spinner4" class="rightaligned"><span id="spinner4text" class="spinnertext">Loading may take up to a minute...</span><img id="spinner4spinner" class="spinner" src="Spinner-3s-200px.svg" /></span></h3>
                <div id="charts">
                    <div id="serviceSelectHolder">
                        <label for="serviceSelect">Select a specific route:</label>
                        <select id="serviceSelect" onchange="serviceChanged(this.value)"></select>
                    </div>
                    <div id="timelineHolder">
                        <h4 id="timelineTitle">Journey Chart</h4>
                        <div id="timeline-tooltip" style="height: 320px;"></div>

                    </div>
                    <h4>Journey Time Distributions.</h4>
                    <div id="timeIncrementHolder">
                        <label for="timeIncrement">Time increment to display:</label>
                        <select id="timeIncrement" onchange="timeIncrementChanged(this.value)">
                            <option value="1">1 minute</option>
                            <option value="5" selected>5 minutes</option>
                        </select>
                    </div>
                    <div id="realJourneyTimesTitle" class="chartTitle">Real journey times (mins)</div>
                    <div id="binnedRealJourneyTimes" class="journeyChart"></div>
                    <div id="timetabledJourneyTimesTitle" class="chartTitle">Timetabled journey times (mins)</div>
                    <div id="binnedScheduledJourneyTimes" class="journeyChart"></div>
                    <div id="worstOrRealJourneyTimeHolder">
                        <h4 id="worstOrRealJourneyTimeHeading">Worst journey time by time of day.</h4>
                        <div id="worstOrRealJourneyChartTitle" class="chartTitle">Worst journey times (mins)</div>
                        <div id="journeyByTimeHolder">
                            <canvas id="journeyByTime" class="journeyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="bottomHolder">
                <h3>Made possible by open data and open source software</h3>
                <ul>
                    <li>The TfWM API.</li>
                    <li>The NaPTAN dataset.</li>
                    <li>Open Street Map for mapping</li>
                    <li>Leaflet.js for mapping</li>
                    <li>Pikaday for the cool date picker</li>
                    <li>Chart.js and <a class="page-link" href="https://slowe.github.io/stuquery/barchart.html">stuQuery barchart</a> for the charts</li>
                    <li>.NET Core 2 (running on Ubuntu) for all the hosting.</li>
                </ul>
                <p>And also Google Charts.</p>
            </div>
        </div>
    </div>

    <script src="js/pikaday.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        "use strict";

        var picker;

        var fromCode;
        var toCode;

        var fromStopsFeatureGroup;
        var toStopsFeatureGroup;

        var fromStops = [];
        var toStops = [];

        var pickedDate = "2018-03-30";

        var queryURL;
        var journeyTimeData;
        var StopsOfInterest;
        var leafletMap;

        function init() {
            createDatePicker();

            createMap();
            checkUrlState();

            google.charts.load('current', {
                'packages': ['timeline', 'corechart', 'bar']
            });

            loadBusStops();
        }

        var startingOptions;

        function checkUrlState() {
            if (getQueryVariable("options") == "true") {
                startingOptions = {
                    "fromCode": getQueryVariable("fromCode"),
                    "toCode": getQueryVariable("toCode"),
                    "dateString": getQueryVariable("dateString"),
                    "startTime": getQueryVariable("startTime"),
                    "endTime": getQueryVariable("endTime")
                }
                startingOptionsUpdateTimesAndDate();
            }
        }

        function startingOptionsUpdateTimesAndDate() {
            startHour.value = startingOptions.startTime.split(":")[0];
            startMinutes.value = startingOptions.startTime.split(":")[1];
            endHour.value = startingOptions.endTime.split(":")[0];
            endMinutes.value = startingOptions.endTime.split(":")[1];

            startPicker.setDate(moment(startingOptions.dateString, "YYYY-MM-DD").toDate());
        }

        function startingOptionFromStopClick() {
            var startingFromStopMarker = fromStops.filter(function(fromStop) {
                return fromStop.NaPTANID == startingOptions.fromCode;
            });

            if (startingFromStopMarker[0] != undefined) {
                startingFromStopMarker[0].fire("click");
            }

        }

        function startingOptionToStopClick() {
            var startingToStopMarker = routeStops.filter(function(toStop) {
                return toStop.NaPTANID == startingOptions.toCode;
            });

            if (startingToStopMarker[0] != undefined) {
                startingToStopMarker[0].fire("click");
            }
        }

        function updateUrlState(queryString) {
            if (validateTimes() == true) {
                var startTimeThreshold = startHour.value + ":" + startMinutes.value;
                var endTimeThreshold = endHour.value + ":" + endMinutes.value;
                queryString += "&startTime=" + startTimeThreshold + "&endTime=" + endTimeThreshold;
            }
            window.history.replaceState('newjourney', 'journeyedit', '?options=true&' + queryString);
        }

        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) {
                    return pair[1];
                }
            }
            return (null);
        }

        function addTimesToUrl() {
            var urlOptions = window.location.search.substring(0);
            var startTime = startHour.value + ":" + startMinutes.value;
            var endTime = endHour.value + ":" + endMinutes.value;

            var urlOptions = urlOptions.replace(/startTime=[0-9][0-9]:[0-9][0-9]/, "startTime=" + startTime + "").replace(/endTime=[0-9][0-9]:[0-9][0-9]/, "endTime=" + endTime + "");

            window.history.replaceState('newjourney', 'journeyedit', urlOptions);
        }

        var startParameters = {};

        function resetMap() {
            document.getElementById("charts").style.visibility = "hidden";
            pickABusStopText.innerHTML = "1. Pick a bus stop.";

            fromStops = [];
            toStops = [];

            if (leafletMap.hasLayer(fromToLine)) {
                leafletMap.removeLayer(fromToLine);
            };
            leafletMap.removeLayer(fromStopsFeatureGroup);
            leafletMap.removeLayer(toStopsFeatureGroup);

            loadBusStops();
        }
        var allall;

        function loadBusStops() {
            spinner1.style.visibility = "visible";

            // do some AJAX stuff
            queryURL = "https://realjourneytime.azurewebsites.net/index.php?method=AllStops";
            console.log(queryURL);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', queryURL);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var AllStops = JSON.parse(xhr.responseText);
                    allall = AllStops;
                    addFromStopsToMap(AllStops);
                    spinner1.style.visibility = "hidden";
                    pickABusStopText.innerHTML = "1. Now pick a second stop.";
                    if (startingOptions != undefined) {
                        startingOptionFromStopClick();
                    }
                } else {
                    console.log('Journey time data request failed. Returned status of ' + xhr.status);
                }
            };
            xhr.send();
        }


        function addFromStopsToMap(stops) {
            for (var i = 0; i < stops.length; i++) {
                if (stops[i].stop_lat !== 'undefined' && stops[i].stop_lon !== 'undefined' && stops[i].corresponding_central_code !== '') {
                    var vehicleType = stops[i].vehicle_type;
                    var BusStopMarker = new L.marker([stops[i].stop_lat, stops[i].stop_lon], {
                        icon: (vehicleType == "PLT") ? mapMarkers.tram.default : mapMarkers.bus.default
                    }).bindTooltip("<strong>" + stops[i].stop_id + "</strong><br> " + stops[i].stop_name);
                    BusStopMarker.on("click", fromStopClick);
                    BusStopMarker.NaPTANID = stops[i].stop_id;
                    BusStopMarker.stopName = stops[i].stop_name;
                    BusStopMarker.vehicleType = vehicleType;
                    fromStops.push(BusStopMarker);
                }
            }

            var fromStopsGroup = L.featureGroup(fromStops);

            fromStopsFeatureGroup = L.markerClusterGroup({
                showCoverageOnHover: true,
                spiderfyOnMaxZoom: false,
                maxClusterRadius: 25,
                disableClusteringAtZoom: 13
            }).addLayer(fromStopsGroup);

            leafletMap.addLayer(fromStopsFeatureGroup)
            if (startingOptions == undefined) {
                leafletMap.fitBounds(fromStopsFeatureGroup.getBounds());
            }
        }

        var fromLatLng;
        var toLatLng;

        var routeStops;

        function fromStopClick(e) {
            leafletMap.removeLayer(fromStopsFeatureGroup);
            fromCode = e.sourceTarget.NaPTANID;
            var fromVehicleType = e.sourceTarget.vehicleType;
            fromLatLng = e.sourceTarget.getLatLng();

            var startingPoint = new L.marker(fromLatLng, {
                icon: (fromVehicleType == "PLT") ? mapMarkers.tram.start : mapMarkers.bus.start
            }).bindTooltip("<strong>" + fromCode + "</strong><br> " + e.sourceTarget.stopName);
            startingPoint.NaPTANID = fromCode;
            routeStops = [startingPoint];
            getReachableStops(fromCode);
        }

        var reach;

        function getReachableStops(fromStop) {
            spinner1.style.visibility = "visible";

            // do some AJAX stuff
            queryURL = "https://realjourneytime.azurewebsites.net/index.php?method=StopsFromStop&fromCode=" + fromStop;
            console.log("fromStop " + fromStop);
            document.getElementById('stopsFromStop').innerHTML = queryURL;
            console.log(queryURL);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', queryURL);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var ToStops = JSON.parse(xhr.responseText);
                    reach = ToStops;
                    console.log("Got the destination stops.");
                    addToStopsToMap(ToStops);
                    if (startingOptions != undefined) {
                        startingOptionToStopClick();
                    }
                    spinner1.style.visibility = "hidden";

                } else {
                    console.log('Journey time data request failed. Returned status of ' + xhr.status);
                }
            };
            xhr.send();
        }

        function addToStopsToMap(stops) {
            for (var i = 0; i < stops.length; i++) {
                if (stops[i].stop_lat !== 'undefined' && stops[i].stop_lon !== 'undefined' && stops[i].corresponding_central_code !== '' && stops[i].stop_id != fromCode) {
                    var BusStopMarker = L.circleMarker([stops[i].stop_lat, stops[i].stop_lon], {
                        radius: 6,
                        className: "toStop"
                    });

                    var BusStopMarker = new L.marker([stops[i].stop_lat, stops[i].stop_lon], {
                        icon: (stops[i].vehicle_type == "PLT") ? mapMarkers.tram.default : mapMarkers.bus.default
                    }).bindTooltip("<strong>" + stops[i].stop_id + "</strong><br> " + stops[i].stop_name);

                    BusStopMarker.on("click", toStopClick);
                    BusStopMarker.NaPTANID = stops[i].stop_id;
                    BusStopMarker.vehicleType = stops[i].vehicle_type;

                    routeStops.push(BusStopMarker);
                }
            }
            toStopsFeatureGroup = L.featureGroup(routeStops).addTo(leafletMap);
            leafletMap.fitBounds(toStopsFeatureGroup.getBounds());
        }

        function toStopClick(e) {
            toCode = e.sourceTarget.NaPTANID;
            toLatLng = e.sourceTarget.getLatLng();
            e.target.setIcon((e.sourceTarget.vehicleType == "PLT") ? mapMarkers.tram.destination : mapMarkers.bus.destination);

            getRealJourneyTimes(checkDateInput());
        }

        var mapMarkers;

        function createMap() {
            mapMarkers = {};

            mapMarkers.tram = {
                "default": L.AwesomeMarkers.icon({
                    icon: 'subway',
                    prefix: 'fa',
                    markerColor: 'cadetblue'
                }),
                "start": L.AwesomeMarkers.icon({
                    icon: 'subway',
                    prefix: 'fa',
                    markerColor: 'green'
                }),
                "destination": L.AwesomeMarkers.icon({
                    icon: 'subway',
                    prefix: 'fa',
                    markerColor: 'red'
                })
            }

            mapMarkers.bus = {
                "default": L.AwesomeMarkers.icon({
                    icon: 'bus',
                    prefix: 'fa',
                    markerColor: 'red'
                }),
                "start": L.AwesomeMarkers.icon({
                    icon: 'bus',
                    prefix: 'fa',
                    markerColor: 'green'
                }),
                "destination": L.AwesomeMarkers.icon({
                    icon: 'bus',
                    prefix: 'fa',
                    markerColor: 'darkred'
                })
            }

            leafletMap = L.map('map').setView([52.4862, -1.8904], 11);

            //CartoDB layer names: light_all / dark_all / light_nonames / dark_nonames
            var CartoLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
            });

            var OSMLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            CartoLayer.addTo(leafletMap);

            // Custom reload button
            var reloadControl = L.Control.extend({
                options: {
                    position: 'topright'
                },
                onAdd: function(map) {
                    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
                    var button = L.DomUtil.create('a');
                    button.style.padding = "4px",
                        button.style.width = "70px",
                        button.style.cursor = "pointer",
                        button.innerHTML = "Reset Map",
                        button.onclick = function() {
                            resetMap();
                        }
                    container.appendChild(button);
                    return container;

                }
            });

            leafletMap.addControl(new reloadControl());
        }

        var startPicker;
        var endPicker;

        var startDate;
        var endDate;

        function createDatePicker() {
            startPicker = new Pikaday({
                field: document.getElementById('startDateInput'),
                format: 'ddd MMMM Do YYYY [▼]',

                onSelect: function() {
                    startDate = this.getDate();
                    updateStartDate();
                }
            });
            endPicker = new Pikaday({
                field: document.getElementById('endDateInput'),
                format: 'ddd MMMM Do YYYY [▼]',

                onSelect: function() {
                    endDate = this.getDate();
                    updateEndDate();
                }
            });

            startPicker.setDate(moment().toDate());
            endPicker.setDate(moment().toDate());

            updateStartDate();
        }

        function resetTimeControls() {
            startHour.value = "12";
            startMinutes.value = "00";
            endHour.value = "12";
            endMinutes.value = "00";
        }

        function validateTimes() {
            var startTime = startHour.value + ":" + startMinutes.value;
            var startTimeMoment = moment(startTime, "HH:mm");

            var endTime = endHour.value + ":" + endMinutes.value;
            var endTimeMoment = moment(endTime, "HH:mm");

            var validityCheck = startTimeMoment.isSameOrBefore(endTimeMoment);

            return validityCheck;
        }

        // 12 m 20 o
        function timeChanged(element) {
            var validityCheck = validateTimes();

            if (validityCheck == false) {
                if (element.id.indexOf("start") > -1) {
                    var warning = "The start time cannot be after the end time.";

                } else {
                    var warning = "The end time cannot be before the start time.";
                }

                timeWarningMessage.innerHTML = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' + warning;
                timeWarningMessage.style.display = "block";
            } else {
                timeWarningMessage.style.display = "none";
                if (journeyTimeData != undefined) {
                    journeyDataLoaded();
                }
                addTimesToUrl();
            }

        }

        function validateMinutes(hoursID, minutesID) {
            var hoursElement = document.getElementById(hoursID);
            var minutesElement = document.getElementById(minutesID);
            var minutesOptions = minutesElement.getElementsByTagName("option");
            if (hoursElement.value == "24") {
                minutesElement.value = "00";
                for (var i = 0; i < minutesOptions.length; i++) {
                    if (minutesElement[i].value != "00") {
                        minutesElement[i].disabled = true;
                    }
                }
            } else {
                for (var i = 0; i < minutesOptions.length; i++) {
                    minutesElement[i].disabled = false;
                }
            }
        }

        function updateStartDate() {
            specialDateSelection.value = "null";
            startPicker.setStartRange(startDate);
            endPicker.setStartRange(startDate);
            endPicker.setMinDate(startDate);
            if (endDateInput.value.indexOf("Pick date") > -1) {
                endPicker.setDate(startDate);
            }
            if (journeyTimeData != undefined) {
                getRealJourneyTimes(startPicker.getMoment().format('YYYY-MM-DD'));
            }

        }

        function updateEndDate() {
            specialDateSelection.value = "null";
            startPicker.setEndRange(endDate);
            startPicker.setMaxDate(endDate);
            endPicker.setEndRange(endDate);
            if (startDateInput.value.indexOf("Pick date") > -1) {
                startPicker.setDate(endDate);
            }
        }


        function checkDateInput() {
            if (specialDateSelection.value == "null") {
                return startPicker.getMoment().format('YYYY-MM-DD');
            } else {
                return specialDateSelection.value;
            }
        }

        function datePickerChanged() {
            // Set the special date selection to null
            specialDateSelection.value = "null";
            getRealJourneyTimes(pickedDate);
        }

        function specialDatesChanged() {
            if (specialDateSelection.value != "null") {
                // Reset date picker element
                startDateInput.value = "Pick date... ▼";
                endDateInput.value = "Pick date... ▼";
                getRealJourneyTimes(specialDateSelection.value);
            }
        }

        function getRealJourneyTimes(selectedDate, selectedService) {
            spinner4text.innerHTML = "Loading may take up to a minute...";

            // do some AJAX stuff
            if (fromCode != null) {
                // clear previous charts and start a loading spinner
                document.getElementById("charts").style.visibility = "hidden";
                spinner4.style.visibility = "visible";
                spinner4spinner.style.visibility = "visible";

                var serviceQuery = "";
                if (selectedService != undefined && selectedService != "All services") {
                    serviceQuery = "&service=" + selectedService;
                }
                var queryString = "fromCode=" + fromCode + "&toCode=" + toCode + "&dateString=" + selectedDate + serviceQuery;
                updateUrlState(queryString)

                queryURL = "https://realjourneytime.azurewebsites.net/index.php?method=Journeys&" + queryString;
                console.log(queryURL);
                document.getElementById("queryURL").innerHTML = queryURL;

                var xhr = new XMLHttpRequest();
                xhr.open('GET', queryURL);
                xhr.onload = function() {
                    startingOptions = null;
                    if (xhr.status === 200) {
                        // drawFromToLine();
                        journeyTimeData = JSON.parse(xhr.responseText);
                        journeyDataLoaded();
                        getIntermediateStops();
                    } else {
                        console.log('Journey time data request failed. Returned status of ' + xhr.status);
                    }
                };
                xhr.send();
            }
        }

        function journeyDataLoaded() {
            if (journeyTimeData.JourneyTimes.length > 0) {
                processJourneyTimeData(journeyTimeData.JourneyTimes);
                getServices(journeyTimeData.JourneyTimes);
                if (journeyTimeData.WorstJourneyTimes == undefined) {
                    processWorstOrRealJourneyTimeData("Real", journeyTimeData.RealJourneyTimes);
                    clearGoogleTimelineChart();
                    spinner4.style.visibility = "hidden";
                    spinner4spinner.style.visibility = "hidden";
                    document.getElementById("charts").style.visibility = "visible";
                } else {
                    drawGoogleTimelineChart(journeyTimeData.JourneyTimes);
                    processWorstOrRealJourneyTimeData("Worst", journeyTimeData.WorstJourneyTimes);
                    spinner4.style.visibility = "hidden";
                    spinner4spinner.style.visibility = "hidden";
                    document.getElementById("charts").style.visibility = "visible";
                }
            } else {
                spinner4text.innerHTML = "No journeys founds for this date.";
                spinner4spinner.style.visibility = "hidden";
                console.log("No journeys found.");
            }
        }

        function getServices(journeyTimesData) {
            var serviceArray = [];
            if (journeyTimesData.length > 0) {
                if (serviceSelect.getAttribute("fromCode") != fromCode || serviceSelect.getAttribute("toCode") != toCode) {
                    for (var i = 0; i < journeyTimesData.length; i++) {
                        var service = journeyTimesData[i].Service;
                        if (serviceArray.indexOf(service) == -1) {
                            serviceArray.push(service);
                        }
                    }
                    createServiceSelect(serviceArray);
                }
                serviceSelectHolder.style.display = "block";
            } else {
                serviceSelect.setAttribute("fromCode", null);
                serviceSelect.setAttribute("toCode", null);
                serviceSelectHolder.style.display = "none";
            }
        }

        function createServiceSelect(serviceArray) {
            removeExistingElements("serviceSelect");
            if (serviceArray.length > 1) {
                serviceArray.unshift("All services");
            }
            for (var i = 0; i < serviceArray.length; i++) {
                var newService = document.createElement("option");
                newService.value = serviceArray[i];
                newService.innerHTML = serviceArray[i];
                serviceSelect.appendChild(newService);
            }
            serviceSelect.setAttribute("fromCode", fromCode);
            serviceSelect.setAttribute("toCode", toCode);

        }

        function serviceChanged(service) {
            getRealJourneyTimes(checkDateInput(), service);
        }

        function removeExistingElements(elementId) {
            var myNode = document.getElementById(elementId);
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
        }

        var fromToLine;

        // Adds a line between the two stops of interest
        function drawStraightLine() {
            if (leafletMap.hasLayer(fromToLine)) {
                leafletMap.removeLayer(fromToLine);
            };
            var lineElement = L.polyline([fromLatLng, toLatLng], {
                opacity: 1,
                color: "#003051"
            });
            var arrowElement = L.polylineDecorator(lineElement, {
                patterns: [{
                    offset: '50%',
                    repeat: 0,
                    symbol: L.Symbol.arrowHead({
                        pixelSize: 12,
                        polygon: true,
                        pathOptions: {
                            color: "#003051",
                            stroke: true,
                            opacity: 1,
                            fillOpacity: 1
                        },
                    }),
                }]
            });

            removeInactiveStops([fromCode, toCode]);
            fromToLine = L.featureGroup([lineElement, arrowElement]).addTo(leafletMap);
            fromToLine.bringToBack();
            leafletMap.fitBounds(fromToLine.getBounds());

        }

        function getIntermediateStops() {

            var url = "https://realjourneytime.azurewebsites.net/index.php?method=IntermediateStops&fromCode=" + fromCode + "&toCode=" + toCode;
            console.log(url);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        var intermediateStops = JSON.parse(xhr.responseText);
                        drawFromToLine(intermediateStops);
                    } catch (err) {
                        drawStraightLine()
                    }
                } else {
                    console.log('Intermediate stops request failed. Returned status of ' + xhr.status);
                }
            };
            xhr.send();
        }
        var lineCoordinates;

        function drawFromToLine(intermediateStops) {
            lineCoordinates = [];
            if (leafletMap.hasLayer(fromToLine)) {
                leafletMap.removeLayer(fromToLine);
            };

            for (var i = 0; i < intermediateStops.length; i++) {
                console.log(intermediateStops[i]);
                var stopMarker = routeStops.filter(function(routeStop) {
                    return routeStop.NaPTANID == intermediateStops[i];
                });
                console.log("Match " + stopMarker.NaPTANID);
                if (stopMarker != undefined) {
                    var stopCoords = stopMarker[0].getLatLng();
                }

                lineCoordinates.push(stopCoords);
            }

            var linesArray = [];
            for (var i = 1; i < lineCoordinates.length; i++) {
                var lineElement = L.polyline([lineCoordinates[i - 1], lineCoordinates[i]], {
                    opacity: 1,
                    color: "black",
                    width: 2
                });
                linesArray.push(lineElement);
            }
            removeInactiveStops(intermediateStops);
            fromToLine = L.featureGroup(linesArray).addTo(leafletMap);
            fromToLine.bringToBack();
            leafletMap.fitBounds(fromToLine.getBounds());

        }

        function removeInactiveStops(intermediateStops) {
            for (var i = 0; i < routeStops.length; i++) {
                if (intermediateStops.indexOf(routeStops[i].NaPTANID) == -1) {
                    leafletMap.removeLayer(routeStops[i]);
                }
            }
        }

        var worstOrRealJourneyTimesObject;

        function processWorstOrRealJourneyTimeData(type, worstOrRealJourneyTimes) {

            var startTimeThreshold = moment(startHour.value + ":" + startMinutes.value, "HH:mm");
            var endTimeThreshold = moment(endHour.value + ":" + endMinutes.value, "HH:mm");

            worstOrRealJourneyTimeHeading.innerHTML = type + " journey time by time of day.";
            worstOrRealJourneyTimesObject = {
                "time": [],
                "journeyTime": [],
                "scheduledTime": [],
            }

            for (var i = 0; i < worstOrRealJourneyTimes.length; i++) {
                var startTime = (type == "Worst") ? moment(worstOrRealJourneyTimes[i]["StartTime"]).format("HH:mm") : worstOrRealJourneyTimes[i]["StartTime"];
                var startTimeMoment = moment(startTime, "HH:mm");
                if (startTimeMoment.isSameOrAfter(startTimeThreshold) && startTimeMoment.isSameOrBefore(endTimeThreshold)) {
                    if (type == "Real") {
                        worstOrRealJourneyTimesObject["time"].push(moment(worstOrRealJourneyTimes[i]["StartTime"], "HH:mm:ss").format("HH:mm"));
                    } else {
                        worstOrRealJourneyTimesObject["time"].push(moment(worstOrRealJourneyTimes[i]["StartTime"]).format("HH:mm"));
                    }
                    worstOrRealJourneyTimesObject["journeyTime"].push(formatJourneyTime(worstOrRealJourneyTimes[i]["JourneyTime"]));
                    worstOrRealJourneyTimesObject["scheduledTime"].push(formatJourneyTime(worstOrRealJourneyTimes[i]["ScheduledTime"]));
                }
            }
            plotWorstOrRealJourneyTimesChart(type, worstOrRealJourneyTimesObject);

        }

        function formatJourneyTime(time) {
            if (time != null) {
                time = Number(moment.duration(time.replace("-", "")).asMinutes().toFixed(1));
            }
            if (time <= 120) {
                return time;
            } else {
                return null;
            }
        }

        function plotWorstOrRealJourneyTimesChart(type, worstOrRealJourneyTimesObject) {
            if (type == "Worst") {
                worstOrRealJourneyChartTitle.innerHTML = type + " journey times (mins)<br><span class='stopExplanation'>Stop " + fromCode + " to " + toCode + "</span>";
            } else {
                worstOrRealJourneyChartTitle.innerHTML = type + " (@ 95th pc) journey times (mins)<br><span class='stopExplanation'>Stop " + fromCode + " to " + toCode + "</span>";
            }
            var chartData = {
                labels: worstOrRealJourneyTimesObject["time"],
                datasets: [{
                    type: 'line',
                    label: 'Scheduled journey time',
                    backgroundColor: "blue",
                    borderColor: "blue",
                    borderWidth: 3,
                    fill: false,
                    pointRadius: 0,
                    data: worstOrRealJourneyTimesObject["scheduledTime"]
                }, {
                    type: 'bar',
                    label: 'Actual journey time',
                    backgroundColor: "orange",
                    data: worstOrRealJourneyTimesObject["journeyTime"],
                    borderColor: 'orange',
                    borderWidth: 2
                }]
            };

            // Reset the canvas content first
            journeyByTimeHolder.innerHTML = '<canvas id="journeyByTime" class="journeyChart"></canvas>';
            var ctx = document.getElementById('journeyByTime').getContext('2d');

            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Worst journey times'
                    },
                    tooltips: {
                        backgroundColor: 'rgba(66, 66, 66, 1)',
                        mode: 'index',
                        intersect: true,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                if (label) {
                                    label += ': ';
                                }
                                var tooltipItemSplit = tooltipItem.yLabel.toString().split(".");
                                label += tooltipItemSplit[0] + "m" + getSeconds(tooltipItemSplit) + "s";
                                return label;
                            }
                        }
                    },
                    legend: {
                        labels: {
                            fontSize: 12,
                        }
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                drawOnChartArea: true,
                                drawTicks: true,
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Minutes',
                                fontSize: 14,
                            },
                            ticks: {
                                suggestedMin: 0, // minimum will be 0, unless there is a lower value.
                                // OR //
                                beginAtZero: true, // minimum value will be 0.
                                stepSize: 10,
                                fontSize: 14,
                            }
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true,
                                drawBorder: true,
                                drawOnChartArea: false,
                                drawTicks: true,
                            },
                            ticks: {
                                autoSkip: false,
                                fontSize: 14,
                                // Only show every 8th time tick, should therefore show two hourly
                                callback: function(tick, index, ticks) {
                                    if (index % 8 == 0) {
                                        return tick.toString();
                                    } else {
                                        return null;
                                    }
                                }
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Time of day',
                                fontSize: 14,
                            },
                        }],
                    }
                }
            });
        }

        function DateTimetoTimeofday(date) {
            var parsedDate = new Date(date);
            var timeofday = [parsedDate.getHours(), parsedDate.getMinutes(), 0];
            return timeofday;
        }

        function getSeconds(input) {
            if (input[1] == undefined) {
                return "00";
            } else {
                return (Number(input[1]) / 10) * 60;
            }
        }

        var realJourneyTimesArray;
        var timetabledJourneyTimesArray;
        var maxTimeCombined;
        var maxBinTotal;
        var timeIncrement = 5;

        function timeIncrementChanged(value) {
            timeIncrement = Number(value);
            if (journeyTimeData != undefined) {
                createBinnedJourneyObjects();
            }
        }

        function processJourneyTimeData(journeyTimes) {
            realJourneyTimesTitle.innerHTML = "Real journey times (mins)<br><span class='stopExplanation'>Stop " + fromCode + " to " + toCode + "</span>";
            timetabledJourneyTimesTitle.innerHTML = "Timetabled journey times (mins)<br><span class='stopExplanation'>Stop " + fromCode + " to " + toCode + "</span>";

            var startTimeThreshold = moment(startHour.value + ":" + startMinutes.value, "HH:mm");
            var endTimeThreshold = moment(endHour.value + ":" + endMinutes.value, "HH:mm");

            realJourneyTimesArray = [];
            timetabledJourneyTimesArray = [];
            for (var i = 0; i < journeyTimes.length; i++) {
                var scheduledDeparture = moment(journeyTimes[i].ScheduledDepartureTime).format("HH:mm");
                var scheduledDepartureMoment = moment(scheduledDeparture, "HH:mm");
                if (scheduledDepartureMoment.isSameOrAfter(startTimeThreshold) && scheduledDepartureMoment.isSameOrBefore(endTimeThreshold)) {
                    var realJourneyTime = Number(moment.duration(journeyTimes[i]["RealJourneyTime"].replace("-", "")).asMinutes().toFixed(0));
                    if (realJourneyTime > 0 && realJourneyTime <= 120) {
                        realJourneyTimesArray.push(realJourneyTime);
                    }

                    var timetabledJourneyTime = Number(moment.duration(journeyTimes[i]["ScheduledJourneyTime"].replace("-", "")).asMinutes().toFixed(0));
                    if (timetabledJourneyTime > 0 && realJourneyTime <= 120) {
                        timetabledJourneyTimesArray.push(timetabledJourneyTime);
                    }
                }
            }

            maxTimeCombined = Math.max(...realJourneyTimesArray.concat(timetabledJourneyTimesArray));
            createBinnedJourneyObjects();
        }

        function binJourneyData(dataArray, maxTimeCombined) {
            var binnedObject = {};

            // Create empty bins at the selected increment
            var binValue = 0;
            while (binValue < maxTimeCombined + Number(timeIncrement)) {
                binnedObject[binValue] = 0;
                binValue = binValue + Number(timeIncrement);
            }

            for (var i = 0; i < dataArray.length; i++) {
                var roundedValue = roundMinutes(dataArray[i]);
                binnedObject[roundedValue]++;
            }

            return binnedObject;
        }

        function createBinnedJourneyObjects() {
            var realJourneyTimesBinned = binJourneyData(realJourneyTimesArray, maxTimeCombined);
            var timetabledJourneyTimesBinned = binJourneyData(timetabledJourneyTimesArray, maxTimeCombined);

            maxBinTotal = getMaxBinTotal(realJourneyTimesBinned, timetabledJourneyTimesBinned);

            drawChart(realJourneyTimesBinned, "binnedRealJourneyTimes", maxTimeCombined);
            drawChart(timetabledJourneyTimesBinned, "binnedScheduledJourneyTimes", maxTimeCombined);
        }

        function getMaxBinTotal(realJourneyTimesBinned, timetabledJourneyTimesBinned) {
            var currentMax = -Infinity;

            for (var increment in realJourneyTimesBinned) {
                if (realJourneyTimesBinned[increment] > currentMax) {
                    currentMax = realJourneyTimesBinned[increment];
                }
            }

            for (var increment in timetabledJourneyTimesBinned) {
                if (timetabledJourneyTimesBinned[increment] > currentMax) {
                    currentMax = timetabledJourneyTimesBinned[increment];
                }
            }

            return currentMax + 10;
        }

        function roundMinutes(x) {
            return Math.floor(x / Number(timeIncrement)) * Number(timeIncrement);
        }

        function drawChart(binnedObject, chartId, maxTimeCombined) {
            var data = formatChartData(binnedObject);
            var chart = new S.barchart('#' + chartId, {
                // Only display an x-axis label every 5 mins
                'formatKey': function(key) {
                    return (key % 5 == 0 ? key.substr(0, 4) : '');
                }
            });
            chart.on('barover', function(e) {
                // Remove any existing information balloon
                S('.balloon').remove();
                // Get the key for this bin
                var key = parseInt(this.bins[e.bin].key);
                // Add a new information balloon - if the bin size is >1 we show the bin range in the label
                S(e.event.currentTarget).find('.bar').append(
                    '<div class="balloon">' + (this.inc > 1 ? key + '-' + (key + this.inc) : key) + 'mins: ' + (this.bins[e.bin].value).toFixed(2).replace(/\.?0+$/, "") + '</div>');
            });

            // Remove the information balloon when we leave the chart
            S('#' + chartId).on('mouseleave', function(e) {
                S('.balloon').remove();
            });
            chart.setData(data).setBins({
                'inc': Number(timeIncrement),
            }).draw();

        }

        function formatChartData(binnedObject) {
            var formattedData = [];
            var bins = Object.keys(binnedObject);

            for (var i = 0; i < bins.length; i++) {
                formattedData.push([Number(bins[i]), binnedObject[bins[i]]])
            }

            return formattedData;
        }

        function clearGoogleTimelineChart() {
            timelineHolder.style.display = "none"
            var container = document.getElementById('timeline-tooltip');
            container.innerHTML = "";
        }

        function drawGoogleTimelineChart(busJourneys) {
            timelineHolder.style.display = "block";
            timelineTitle.innerHTML = "Journey Chart<br><span class='stopExplanation'>Stop " + fromCode + " to " + toCode + "</span>";
            var container = document.getElementById('timeline-tooltip');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();

            var startTimeThreshold = moment(startHour.value + ":" + startMinutes.value, "HH:mm");
            var endTimeThreshold = moment(endHour.value + ":" + endMinutes.value, "HH:mm");

            dataTable.addColumn({
                type: 'string',
                id: 'Bus'
            });
            dataTable.addColumn({
                type: 'date',
                id: 'Start'
            });
            dataTable.addColumn({
                type: 'date',
                id: 'End'
            });

            for (var i = 0; i < busJourneys.length; i++) {
                if (busJourneys[i].RealJourneyTime != null && moment.duration(busJourneys[i].RealJourneyTime.replace("-", "")) > 0) {
                    var scheduledDeparture = moment(busJourneys[i].ScheduledDepartureTime).format("HH:mm");
                    var scheduledDepartureMoment = moment(scheduledDeparture, "HH:mm");
                    if (scheduledDepartureMoment.isSameOrAfter(startTimeThreshold) && scheduledDepartureMoment.isSameOrBefore(endTimeThreshold)) {
                        var start = moment(busJourneys[i].RealDepartureTime);
                        var end = moment(busJourneys[i].RealDepartureTime).add(moment.duration(busJourneys[i].RealJourneyTime.replace("-", "")));
                        if (moment.duration(busJourneys[i].RealJourneyTime.replace("-", "")).asMinutes() <= 120) {
                            // Journey time spans two days
                            if (end.date() != start.date()) {
                                var day = 1;
                            } else {
                                var day = 0;
                            }

                            dataTable.addRows([
                                [busJourneys[i].UniqueID, new Date(0, 0, 0, start.hours(), start.minutes(), start.seconds()), new Date(0, 0, day, end.hours(), end.minutes(), end.seconds())],
                            ]);
                        }
                    }

                }
            }

            var options = {
                colors: ['red'],
                timeline: {
                    rowLabelStyle: {
                        fontName: 'Helvetica',
                        fontSize: 8,
                        color: '#603913'
                    },
                    barLabelStyle: {
                        fontName: 'Garamond',
                        fontSize: 8
                    }
                }
            }

            chart.draw(dataTable, options);

        }
    </script>



</body>