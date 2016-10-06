/*
angular.module('module_app').directive('googleMap', function(Factory_unidades) {
    
    // directive link function
    var link = function(scope, element, attrs) {

        var MY_MAPTYPE_ID = 'custom_style';
        var map, infoWindow;
        var markers = [];

        // Style
        var featureOpts = [
            {
                stylers: [
                    {hue: '#c5c7c9'},
                    {visibility: 'simplified'},
                    {gamma: 1.5},
                    {saturation: -100},
                    {weight: 1}
                ]
            },
            {
                elementType: 'labels',
                stylers: [
                    {visibility: 'on'}
                ]
            },
            {
                featureType: 'water',
                stylers: [
                    {color: '#9ca1a6'}
                ]
            }
        ];
        

        // map config
        var mapOptions = {
            center: new google.maps.LatLng(-20.819997, -49.386962), // Manualmente
            zoom: 17,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
            },
            mapTypeId: MY_MAPTYPE_ID,
            scrollwheel: false
        };


        // init the map
        function initMap() {
            if (map === void 0) {
                map = new google.maps.Map(element[0], mapOptions);
            }

            var styledMapOptions = {
                name: 'Custom Style'
            };

            var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

            map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
        }    
        

        // place a marker
        function setMarker(map, position, title, content) {
            var marker;
            var markerOptions = {
                position: position,
                map: map,
                title: title,
                icon: '../assets/img/icone-map.svg'
            };

            marker = new google.maps.Marker(markerOptions);
            markers.push(marker); // add marker to array
            
            google.maps.event.addListener(marker, 'click', function () {
                // close window if not undefined
                if (infoWindow !== void 0) {
                    infoWindow.close();
                }
                // create new window
                var infoWindowOptions = {
                    content: content
                };
                infoWindow = new google.maps.InfoWindow(infoWindowOptions);
                infoWindow.open(map, marker);
            });
        }
        

        // show the map and place some markers
        initMap();


        // Adicionado os Itens
        for(i = 0; i < Factory_unidades.length; i++){
            // Montando o item
            var unidade = new Object();
            unidade.lat = Factory_unidades[i].lat;
            unidade.lon = Factory_unidades[i].lon;
            unidade.nome = Factory_unidades[i].nome;
            unidade.atendimento = Factory_unidades[i].atendimento;
            unidade.rua = Factory_unidades[i].rua;
            unidade.numero = Factory_unidades[i].numero;
            unidade.complemento = Factory_unidades[i].complemento;
            unidade.bairro = Factory_unidades[i].bairro;
            unidade.cidade = Factory_unidades[i].cidade;
            unidade.estado = Factory_unidades[i].estado;

            var end = unidade.rua + ", " + unidade.numero;
            if(unidade.complemento == ""){
                end += " - " + 
                    unidade.bairro + "<br>" + 
                    unidade.cidade + " - " + 
                    unidade.estado;
            }else{
                end += ", " +
                    unidade.complemento + " - " + 
                    unidade.bairro + "<br>" + 
                    unidade.cidade + " - " + 
                    unidade.estado;
            }
            unidade.endereco = end;

            unidade.content = 
                '<div class="box">' +
                    '<img src="../assets/img/icone-unidades-red.svg" alt="Icone Localização.">' +
                    '<p class="title ng-binding">' +
                        unidade.nome +
                    '</p>' +
                    '<p class="ng-binding">' +
                        unidade.endereco +
                    '</p>' +
                    '<span class="ng-binding">' +
                        'Horário de atendimento:<br>' +
                        unidade.atendimento +
                    '</span>' +
                    '<a target="_blank" class="button-style-1" title="Como chegar." href="https://www.google.com.br/maps/place/' + unidade.endereco + '">' +
                        'como chegar' +
                    '</a>' +
                '</div>';

            setMarker(map, new google.maps.LatLng(unidade.lat, unidade.lon), unidade.nome, unidade.content);
        }
    };
    
    return {
        restrict: 'E',
        template: '<div id="map"></div>',
        replace: true,
        link: link
    };
});
*/