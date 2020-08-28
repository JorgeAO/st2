<script type="text/javascript" src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script 
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3Xc_M4i3AIJuWOZlooi_hNuCg6E0y0BA&callback=initMap&libraries=&v=weekly" defer
></script>


<link rel="stylesheet" type="text/css" href="../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/propias/css/estilos.css">

<style type="text/css">
	/* Always set the map height explicitly to define the size of the div
	* element that contains the map. */
	#map {
		height: 95%;
		border: 1px solid silver;
	}

	/* Optional: Makes the sample page fill the window. */
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.alto {
		height: 90%;
	}
</style>
    <script>
    	var map;
		
    	$(document).ready(function(){
    		$('#btn_poligono').on('click',function(){
				pintarPoligono();
    		});

    		$('#btn_pnt_add').on('click',function(){
    			agregarPunto();
    		});
    	});

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
    			center: {lat: 3.4349712, lng: -76.5091626},
				zoom: 13
			});
		}

		function pintarPoligono()
		{
			var triangleCoords = [
				{lat: 25.774, lng: -80.190},
				{lat: 18.466, lng: -66.118},
				{lat: 32.321, lng: -64.757},
				{lat: 25.774, lng: -80.190}
			];

			var bermudaTriangle = new google.maps.Polygon({
				paths: triangleCoords,
				strokeColor: '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 2,
				fillColor: '#FF0000',
				fillOpacity: 0.35
			});
			
			bermudaTriangle.setMap(map);
		}

		function agregarPunto()
		{
			map.addListener('click', function(e) {
				placeMarkerAndPanTo(e.latLng, map);
	        });
		}

		function placeMarkerAndPanTo(latLng, map) 
		{
	        var marker = new google.maps.Marker({
	        	position: latLng,
	          	map: map
	        });
	        map.panTo(latLng);
	        google.maps.event.clearInstanceListeners(map);
		}
	</script>


<? require '../../seguridad/seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card alto">
		<div class="card-header bg-base7 text-white">Mapas</div>
		<div class="card-body">
			<div class="form-group">
				<button class="btn btn-primary btn-sm" id="btn_poligono">Poligono</button>
				<button class="btn btn-primary btn-sm" id="btn_pnt_add">Agregar Punto</button>
			</div>
			<div class="table-responsive" id="map"></div>
		</div>
	</div>
</div>