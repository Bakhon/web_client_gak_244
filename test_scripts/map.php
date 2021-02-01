<!DOCTYPE html>
<html>
	<head>
		<title>map created with amCharts | amCharts</title>
		<meta name="description" content="map created using amCharts pixel map generator" />

		<!--
			This map was created using Pixel Map Generator by amCharts and is licensed under the Creative Commons Attribution 4.0 International License.
			You may use this map the way you see fit as long as proper attribution to the name of amCharts is given in the form of link to https://pixelmap.amcharts.com/
			To view a copy of this license, visit http://creativecommons.org/licenses/by/4.0/

			If you would like to use this map without any attribution, you can acquire a commercial license for the JavaScript Maps - a tool that was used to produce this map.
			To do so, visit amCharts Online Store: https://www.amcharts.com/online-store/
		-->

		<!-- amCharts javascript sources -->
        <script type="text/javascript" src="styles/js/bi/pie.js"></script>
		<script type="text/javascript" src="styles/js/bi/map/ammap.js"></script>
		<script type="text/javascript" src="styles/js/bi/map/kazakhstanLow.js"></script>

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("map",{
					"type": "map",
                    "theme": "light",
					"pathToImages": "http://www.amcharts.com/lib/3/images/",
					"addClassNames": true,
					"fontSize": 15,
					"color": "#000000",
					"projection": "mercator",
					"backgroundAlpha": 1,
					"backgroundColor": "rgba(255,255,255,1)",
					"dataProvider": {
						"map": "kazakhstanLow",
						"getAreasFromMap": true,
                        "images": [							
							{
								"selectable": true,
								"title": "Филиал по городу Астаны",
								"longitude": 70.766,
								"latitude": 52.402,
								"svgPath": "M3.5,13.277C3.5,6.22,9.22,0.5,16.276,0.5C23.333,0.5,29.053,6.22,29.053,13.277C29.053,14.54,28.867,15.759,28.526,16.914C26.707,24.271,16.219,32.5,16.219,32.5C16.219,32.5,4.37,23.209,3.673,15.542C3.673,15.542,3.704,15.536,3.704,15.536C3.572,14.804,3.5,14.049,3.5,13.277C3.5,13.277,3.5,13.277,3.5,13.277M16.102,16.123C18.989,16.123,21.329,13.782,21.329,10.895C21.329,8.008,18.989,5.668,16.102,5.668C13.216,5.668,10.876,8.008,10.876,10.895C10.876,13.782,13.216,16.123,16.102,16.123C16.102,16.123,16.102,16.123,16.102,16.123",
								"color": "rgba(15,133,28,1)",
								"scale": 1,
                                "pie": {
                                    "type": "pie",
                                    "pullOutRadius": 0,
                                    "labelRadius": 0,
                                    "dataProvider": [{
                                      "category": "Category #1",
                                      "value": 1200
                                    }, {
                                      "category": "Category #2",
                                      "value": 500
                                    }, {
                                      "category": "Category #3",
                                      "value": 765
                                    }, {
                                      "category": "Category #4",
                                      "value": 260
                                    }],
                                    "labelText": "[[value]]%",
                                    "valueField": "value",
                                    "titleField": "category"
                                }
							},
							{
								"selectable": true,
								"title": "Головной офис",
								"longitude": 70.3621,
								"latitude": 52.402,
								"svgPath": "M3.5,13.277C3.5,6.22,9.22,0.5,16.276,0.5C23.333,0.5,29.053,6.22,29.053,13.277C29.053,14.54,28.867,15.759,28.526,16.914C26.707,24.271,16.219,32.5,16.219,32.5C16.219,32.5,4.37,23.209,3.673,15.542C3.673,15.542,3.704,15.536,3.704,15.536C3.572,14.804,3.5,14.049,3.5,13.277C3.5,13.277,3.5,13.277,3.5,13.277M16.102,16.123C18.989,16.123,21.329,13.782,21.329,10.895C21.329,8.008,18.989,5.668,16.102,5.668C13.216,5.668,10.876,8.008,10.876,10.895C10.876,13.782,13.216,16.123,16.102,16.123C16.102,16.123,16.102,16.123,16.102,16.123",
								"color": "rgba(15,133,28,1)",
								"scale": 1
							},
							{
								"selectable": true,
								"top": 1031.14208314821,
								"left": 1803.011181582047,
								"svgPath": "M3.5,13.277C3.5,6.22,9.22,0.5,16.276,0.5C23.333,0.5,29.053,6.22,29.053,13.277C29.053,14.54,28.867,15.759,28.526,16.914C26.707,24.271,16.219,32.5,16.219,32.5C16.219,32.5,4.37,23.209,3.673,15.542C3.673,15.542,3.704,15.536,3.704,15.536C3.572,14.804,3.5,14.049,3.5,13.277C3.5,13.277,3.5,13.277,3.5,13.277M16.102,16.123C18.989,16.123,21.329,13.782,21.329,10.895C21.329,8.008,18.989,5.668,16.102,5.668C13.216,5.668,10.876,8.008,10.876,10.895C10.876,13.782,13.216,16.123,16.102,16.123C16.102,16.123,16.102,16.123,16.102,16.123",
								"color": "rgba(61,180,248,1)",
								"scale": 1
							},
							{
								"selectable": true,
								"title": "Филиал по городу Алматы",
								"longitude": 77.4397,
								"latitude": 43.606,
								"svgPath": "M3.5,13.277C3.5,6.22,9.22,0.5,16.276,0.5C23.333,0.5,29.053,6.22,29.053,13.277C29.053,14.54,28.867,15.759,28.526,16.914C26.707,24.271,16.219,32.5,16.219,32.5C16.219,32.5,4.37,23.209,3.673,15.542C3.673,15.542,3.704,15.536,3.704,15.536C3.572,14.804,3.5,14.049,3.5,13.277C3.5,13.277,3.5,13.277,3.5,13.277M16.102,16.123C18.989,16.123,21.329,13.782,21.329,10.895C21.329,8.008,18.989,5.668,16.102,5.668C13.216,5.668,10.876,8.008,10.876,10.895C10.876,13.782,13.216,16.123,16.102,16.123C16.102,16.123,16.102,16.123,16.102,16.123",
								"color": "rgba(15,133,28,1)",
								"scale": 1
							}
						],
                        "areas": [
							{
								"id": "KZ-AS",								
								"color": "rgba(61,180,248,1)"                                             
							},
                            {
                                "id": "01",
                                "title":"123"                                
                            }
						]
					},
					"balloon": {
						"horizontalPadding": 15,
						"borderAlpha": 0,
						"borderThickness": 1,
						"verticalPadding": 15
					},
					"areasSettings": {
						"color": "rgba(156,156,156,1)",
						"outlineColor": "rgba(255,255,255,1)",
						"rollOverOutlineColor": "rgba(255,255,255,1)",
						"rollOverBrightness": 20,
						"selectedBrightness": 20,
						"selectable": true,
						"unlistedAreasAlpha": 0,
						"unlistedAreasOutlineAlpha": 0
					},
					"imagesSettings": {
						"alpha": 1,
						"color": "rgba(156,156,156,1)",
						"outlineAlpha": 0,
						"rollOverOutlineAlpha": 0,
						"outlineColor": "rgba(255,255,255,1)",
						"rollOverBrightness": 20,
						"selectedBrightness": 20,
						"selectable": true
					},
					"linesSettings": {
						"color": "rgba(156,156,156,1)",
						"selectable": true,
						"rollOverBrightness": 20,
						"selectedBrightness": 20
					},
					"zoomControl": {
						"zoomControlEnabled": true,
						"homeButtonEnabled": false,
						"panControlEnabled": false,
						"right": 38,
						"bottom": 30,
						"minZoomLevel": 0.25,
						"gridHeight": 100,
						"gridAlpha": 0.1,
						"gridBackgroundAlpha": 0,
						"gridColor": "#FFFFFF",
						"draggerAlpha": 1,
						"buttonCornerRadius": 2
					},
                    "listeners":[{
                        "event":"clickMapObject",
                        "method":function(e){
                            console.log(e);
                        }
                    }]
				});
		</script>
	</head>
	<body style="margin: 0;background-color: rgba(255,255,255,1);">
		<div id="map" style="width: 100%; height: 949px;"></div>
	</body>
</html>