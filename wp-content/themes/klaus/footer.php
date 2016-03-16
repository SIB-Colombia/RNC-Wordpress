<?php $options = get_option('klaus'); ?>
</div>
<!-- End Main -->

<?php if( !empty($options['enable-back-to-top']) && $options['enable-back-to-top'] == 1) { ?>
<!-- Back To Top -->
<a id="back-to-top" href="#">
    <i class="font-icon-arrow-up-simple-thin"></i>
</a>
<!-- End Back to Top -->
<?php } ?>

<footer>
<div class="row row-footer">
			<nav>
			<div id="menu" class="menu_footer">
                <ul id="menu-nav" class="superfish">
					<li><a href="#">Inicio</a></li>
					<li><a href="http://rncwp.lumon.com.co/?p=1206">Acerca del RNC</a></li>
					<li><a href="http://rncwp.lumon.com.co/?p=1124">Preguntas Frecuentes</a></li>
					<li><a href="http://test.rnc.humboldt.lumon.com.co/index.php/registros/colecciones">Colecciones Biológicas</a></li>
					<li><a href="http://test.rnc.humboldt.lumon.com.co/index.php/Curador/Especialista">Directorio de Especialistas</a></li>
				</ul>
			</div>				
			</nav>
            <!-- End Social Icons -->
            </div>
            <div class="row">
			<div class="img-footer">
				<ul>
				<p> Coordinan:</p>
					<li> <a href="http://www.minambiente.gov.co/" target="_blank" title="Ministerio de Medio Ambiente"><img alt="Logo MinAmbiente" src="http://rncwp.lumon.com.co/wp-content/uploads/2016/03/Minambiente1.png"></a></li>
					<li> <a href="http://www.humboldt.org.co" target="_blank" title="Instituto Alexander von Humboldt"><img alt="Logo Humboldt" src="http://rncwp.lumon.com.co/wp-content/uploads/2016/03/Humbolt1.png"></a></li>
					<li class="lineal"></li>
				</ul>	
				<ul>
					<p> Apoyan:</p>
					<li> <a href="http://www.sibcolombia.net" target="_blank" title="SIB Colombia"><img alt="Logo SIB Colombia" src="http://rncwp.lumon.com.co/wp-content/uploads/2016/03/SIB.png"></a></li>
				</ul>
				<p class="p-footer">2014 · Instituto de Investigación de Recursos Biológicos Alexander Von Humboldt · Ministerio de Medio Ambiente de Colombia · SIB Colombia</p>
				</div>
			<div style="font-size:0.8em;" class="img-footer img_cc">
				<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Registro Único Nacional de Colecciones Biológicas</span> por <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.humboldt.org.co" property="cc:attributionName" rel="cc:attributionURL">Instituto Alexander von Humboldt</a> se distribuye bajo una <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Licencia Creative Commons Atribución-CompartirIgual 4.0 Internacional</a>.<br />Basada en una obra en <a xmlns:dct="http://purl.org/dc/terms/" href="http://rnc.humboldt.org.co" rel="dct:source">http://rnc.humboldt.org.co</a>
			</div>
</div>
</footer>

</div>
<!-- End Wrap All -->

<?php if(!empty($options['tracking-code'])) echo $options['tracking-code']; ?> 

<?php 	
	wp_register_script('main', get_template_directory_uri() . '/_include/js/main.js', array('jquery'), NULL, true);
	wp_enqueue_script('main');
	
	wp_localize_script(
		'main', 
		'theme_objects',
		array(
			'base' => get_template_directory_uri()
		)
	);

	wp_footer();  
?>	

<script>
var mapcol;
var urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJson?jsoncallback=?';
var infowindow = new google.maps.InfoWindow();

jQuery('#vert').on('click', function() {
	jQuery("#vert").removeClass("btn-default").addClass("btn-primary");
	jQuery("#all").removeClass("btn-primary").addClass("btn-default");
	jQuery("#invert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#micro").removeClass("btn-primary").addClass("btn-default");
	jQuery("#plant").removeClass("btn-primary").addClass("btn-default");
	jQuery("#hongos").removeClass("btn-primary").addClass("btn-default");
	jQuery("#liq").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJsonFiltered?grupoTaxonomico=vertebrados&jsoncallback=?';
	start();
});

jQuery('#all').on('click', function() {
	jQuery("#all").removeClass("btn-default").addClass("btn-primary");
	jQuery("#vert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#invert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#micro").removeClass("btn-primary").addClass("btn-default");
	jQuery("#plant").removeClass("btn-primary").addClass("btn-default");
	jQuery("#hongos").removeClass("btn-primary").addClass("btn-default");
	jQuery("#liq").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJson?jsoncallback=?';
	start();
});

jQuery('#invert').on('click', function() {
	jQuery("#invert").removeClass("btn-default").addClass("btn-primary");
	jQuery("#all").removeClass("btn-primary").addClass("btn-default");
	jQuery("#vert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#micro").removeClass("btn-primary").addClass("btn-default");
	jQuery("#plant").removeClass("btn-primary").addClass("btn-default");
	jQuery("#hongos").removeClass("btn-primary").addClass("btn-default");
	jQuery("#liq").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJsonFiltered?grupoTaxonomico=invertebrados&jsoncallback=?';
	start();
});

jQuery('#micro').on('click', function() {
	jQuery("#micro").removeClass("btn-default").addClass("btn-primary");
	jQuery("#all").removeClass("btn-primary").addClass("btn-default");
	jQuery("#vert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#invert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#plant").removeClass("btn-primary").addClass("btn-default");
	jQuery("#hongos").removeClass("btn-primary").addClass("btn-default");
	jQuery("#liq").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJsonFiltered?grupoTaxonomico=microorganismos&jsoncallback=?';
	start();
});


jQuery('#plant').on('click', function() {
	jQuery("#plant").removeClass("btn-default").addClass("btn-primary");
	jQuery("#all").removeClass("btn-primary").addClass("btn-default");
	jQuery("#vert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#invert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#micro").removeClass("btn-primary").addClass("btn-default");
	jQuery("#hongos").removeClass("btn-primary").addClass("btn-default");
	jQuery("#liq").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJsonFiltered?grupoTaxonomico=plantas&jsoncallback=?';
	start();
});

jQuery('#hongos').on('click', function() {
	jQuery("#hongos").removeClass("btn-default").addClass("btn-primary");
	jQuery("#all").removeClass("btn-primary").addClass("btn-default");
	jQuery("#vert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#invert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#micro").removeClass("btn-primary").addClass("btn-default");
	jQuery("#plant").removeClass("btn-primary").addClass("btn-default");
	jQuery("#liq").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJsonFiltered?grupoTaxonomico=hongos&jsoncallback=?';
	start();
});

jQuery('#liq').on('click', function() {
	jQuery("#liq").removeClass("btn-default").addClass("btn-primary");
	jQuery("#all").removeClass("btn-primary").addClass("btn-default");
	jQuery("#vert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#invert").removeClass("btn-primary").addClass("btn-default");
	jQuery("#micro").removeClass("btn-primary").addClass("btn-default");
	jQuery("#plant").removeClass("btn-primary").addClass("btn-default");
	jQuery("#hongos").removeClass("btn-primary").addClass("btn-default");
	urlCol = 'http://rnc.humboldt.lumon.com.co/index.php/registros/coleccionesJsonFiltered?grupoTaxonomico=liquenes&jsoncallback=?';
	start();
});

function start() {

    var mapProp = {
        center: new google.maps.LatLng(5.707729, -76.666929),
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    mapcol = new google.maps.Map(document.getElementById("map"), mapProp);

    jQuery.ajax({
        type: 'GET',
        url: urlCol,
        dataType: "json",
        success: function (data) {	
			var registros = 0;
			jQuery("#listacolecciones").empty();
			jQuery.each(data, function(i,item){
				if (data[i].Latitud	&& data[i].Logitud)
				{
					registros = registros + 1;
					
					var latLng = new google.maps.LatLng(data[i].Latitud,data[i].Logitud);
					var image = 'http://rncwp.lumon.com.co/wp-content/uploads/2016/03/icono_Puntos-_Mapas.png';					
					var marker = new google.maps.Marker({
						position: latLng,
						map: mapcol,
                                                icon : image,
						title: data[i].nombre
					});
					
					jQuery("#listacolecciones").append('<li><a href="http://localhost:8080/rnc_web/index.php/registros/detail/'+data[i].id+'">'+data[i].nombre+'</a></li>');
					
					var details = '<div id="content">'+
								  '<div id="siteNotice">'+
								  '</div>'+
								  '<h3 id="firstHeading" class="firstHeading"><a href="http://localhost:8080/rnc_web/index.php/registros/detail/'+data[i].id+'">'+data[i].nombre+'</a></h1>'+
								  '<div id="bodyContent">'+
								  '<p>' + data[i].direccion + '<br/>'+
								  '</p>'+
								  '</div>'+
								  '</div>';
					
					bindInfoWindow(marker, mapcol, infowindow, details);				
				}						
			})
			var text = registros.toString();
			text = text + " Colecciones Biologicas";
			jQuery("#totalcolecciones").text(text);			
        }
    });

}

google.maps.event.addDomListener(window, 'load', start);
	
var map;
var url = 'http://maps.sibcolombia.net/rest/occurrences/mappoints?basisofrecord=espécimen+preservado';
var infowindow = new google.maps.InfoWindow();

jQuery('#search').on('click', function() {
	url = 'http://maps.sibcolombia.net/rest/occurrences/mappoints?basisofrecord=espécimen+preservado';
	var filtros = '';
	
	var value = jQuery.trim(jQuery("#sciName").val());
	
	if (value.length>0){
		filtros = '&scientificname='+jQuery("#sciName").val();
	}
	
	value = jQuery.trim(jQuery("#comName").val());
	
	if (value.length>0){
		filtros = filtros + '&commonname='+jQuery("#comName").val();
	}	

	if (jQuery('select[name=depto]').val() != 0){
		filtros = filtros + '&departmentname='+jQuery("#depto").val();
	}
	
	if (jQuery('select[name=munic]').val() != 0){
		filtros = filtros + '&locality='+jQuery('select[name=munic]').val();
	}
	
	if (filtros){
            url = url+filtros;
	}
	initialize();
});

function initialize() {

    var mapProp = {
        center: new google.maps.LatLng(5.707729, -76.666929),
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    map = new google.maps.Map(document.getElementById("mapreg"), mapProp);

    jQuery.ajax({
        type: 'GET',
        url: url,
        dataType: "jsonp",
        success: function (data) {	
			var registros = data["totalMatched"];
			var features = data["features"];
			var image = 'http://rncwp.lumon.com.co/wp-content/uploads/2016/03/icono_Puntos-_Mapas.png';			

			jQuery.each(features, function(i,item){			
				var geo = features[i]["geometry"];
				var prop = features[i]["properties"];
				var geometries = geo["geometries"];
				var nombre = prop["taxonName"];
			
				jQuery.each(geometries, function(j,item){	
					var coord = geometries[j]["coordinates"];
					var id = geometries[j]["properties"];
					var ocid = String(id["occurrenceID"]);
				
					var latLng = new google.maps.LatLng(coord[1],coord[0]);				
				
					var marker = new google.maps.Marker({
								position: latLng,
								map: map,
								icon: image,
								title: ocid
								});				
							
					var details = '<div id="content">'+
								  '<div id="siteNotice">'+
								  '</div>'+
								  '<h3 id="firstHeading" class="firstHeading"><a href="http://data.sibcolombia.net/occurrences/'+ocid+'">'+nombre+'</a></h1>'+
								  '<div id="bodyContent">'+
								  '<p>ID : '+ocid+'<br/>'+
								  '</p>'+
								  '</div>'+
								  '</div>';
					
					bindInfoWindow(marker, map, infowindow, details);	
				})			
			})					
        }
    });

}

function bindInfoWindow(marker, map, infowindow, strDescription) {
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(strDescription);
        infowindow.open(map, marker);
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>