<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Map of Nepal</title>
    <!--
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    -->
    <script src="js/OpenLayers.js"></script>
    <!--<script src="http://openlayers.org/dev/OpenLayers.js"></script>-->
    <script type='text/javascript'>
    var map;
    var google_layer;
    var vector_layer1;
    var vector_layer2;
    
    //var cluster_districts=["DAILEKH,DOLPA","JUMLA,KALIKOT,MUGU","HUMLA,BAJURA,BAJHANG,ACHHAM,DOTI,KAILALI,KANCHANPUR,DADELDHURA,BAITADI,DARCHULA"]
    //var popup_element = ["This is sample popup","This is an another popup"]
    // var cluster_districts=xmlRead1("js/cluster.xml");
    // var popup_element=xmlRead2("js/cluster.xml");
    var cluster_districts=[<?php echo $cluster_info ?>];
    var popup_element=[<?php echo $popup_info ?>];
    var num_cluster = cluster_districts.length;
    var cluster_color=gen_color(num_cluster);


        function xmlRead1(xml_name)
        {
            var districts=new Array();
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.open("GET",xml_name,false);
            xmlhttp.send();
            xmlDoc=xmlhttp.responseXML;
            var document=xmlDoc.getElementsByTagName("Document")[0];
            //document.write(document);
            var cluster=document.getElementsByTagName("Cluster");
            for(i=0;i<cluster.length;i++)
            {
                districts[i]=cluster[i].getElementsByTagName("Districts")[0].textContent;
            }
            return districts;
        }
        function xmlRead2(xml_name)
        {
            var popup_element=new Array();
            if (window.XMLHttpRequest)
              {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
              }
            else
              {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
            xmlhttp.open("GET",xml_name,false);
            xmlhttp.send();
            xmlDoc=xmlhttp.responseXML;
            var document=xmlDoc.getElementsByTagName("Document")[0];
            //document.write(document);
            var cluster=document.getElementsByTagName("Cluster");
            for(i=0;i<cluster.length;i++)
            {
                //popup_element[i]="Hello World";
                popup_element[i]="<strong>"+cluster[i].getElementsByTagName("Description")[0].textContent+"</strong><br/>"
                                +"<div id='popup'>"+cluster[i].getElementsByTagName("Info")[0].textContent+"</div>"
            }
            return popup_element;
        }

        function gen_color(num_cluster)
        {
            color=Array();
            for(i=0;i<num_cluster;i++)
            {
                color[i]="#"+("000"+(Math.random()*(1<<24)|0).toString(16)).substr(-6);
            }
            return color;
        }

        function cal_cluster_id(feature){
            for(i=0;i<cluster_districts.length;i++)
             {
                cluster_districts[i]=cluster_districts[i].toUpperCase();
                districts=cluster_districts[i].split(",");

                if(districts.indexOf(feature.data.name)>=0)
                return i;
             }
        }

            //Create a style object to be used by a StyleMap object
        var default_style1 = new OpenLayers.Style({
            'fillColor': "${color}",
            'fillOpacity': .5,
            'strokeColor': '#a4ee77',
            'strokeWidth': 2,
            'pointRadius': 8,
            'label':''
            // 'label':'${name}'
        },
        //Second parameter contains a context parameter
        {
        context: {
        color: function(feature){
                return cluster_color[cal_cluster_id(feature)];
        }
        }
        });
                //Create a style object to be used by a StyleMap object
        var select_style1 = new OpenLayers.Style({
            'fillColor':'${color}',
            'fillOpacity': .5,
            'strokeColor': '#a4ee77',
            //'strokeWidth': 5,
            'pointRadius': 8,
            //'label':"${name}"
        },
        //Second parameter contains a context parameter
        {
        context: {
        name: function(feature){ 
            //return "District_Name";
            return feature.attributes.name; 
        },
                color: function(feature){
                return cluster_color[cal_cluster_id(feature)];
        }
        }
        });
        
        //Create a style map object and set the 'default' and 'select' intent to the style object       
        var vector_style_map1 = new OpenLayers.StyleMap({
            'default': default_style1,
            'select':select_style1
        });

    function on_select_feature(event){
    //Store the features
    var feature=event.feature;
    //var lonlat=new OpenLayers.LonLat(9399747.128765613,3196848.4786671675);
    var lonlat=new OpenLayers.LonLat(feature.geometry.getCentroid().x,feature.geometry.getCentroid().y);
    var content = popup_element[cal_cluster_id(feature)];
    var popup=new OpenLayers.Popup.FramedCloud("title",lonlat, new OpenLayers.Size(200,100), content);
    popup.autoSize=false;
    feature.popup=popup;
    map.addPopup(popup);

    }

    function on_unselect_feature(event){
    var feature=event.feature;
    map.removePopup(feature.popup);
    //feature.popup.destroy();
    //feature.popup=null;
    }

    function init() {
        //Create a map with an empty array of controls
        var options = {
                    //projection: new OpenLayers.Projection("EPSG:900913"),
                    //displayProjection: new OpenLayers.Projection("EPSG:4326"),
                    projection: new OpenLayers.Projection("EPSG:4326"),
                    numZoomLevels: 19,
                    //maxResolution: 156543.0339,
                    //maxExtent:new OpenLayers.Bounds(8466776.7475746,2959641.7346721,10289035.501567,3693437.2060783)
                    maxExtent:new OpenLayers.Bounds(76.317901611329,24.989776611327,92.687530517579,31.581573486327)
                };
        //Create a map with an array of controls
        map = new OpenLayers.Map('map_element',options);
        map.addControl(new OpenLayers.Control.DragPan());


        //Create a Google Map layer as base layer
//        var google_map = new OpenLayers.Layer.Google(
//            'Google Layer',
//            {}
//        );

        
        vector_layer1 = new OpenLayers.Layer.Vector('District Map',
        {
            isBaseLayer:true,
            projection: new OpenLayers.Projection('EPSG:4326'),
            protocol: new OpenLayers.Protocol.HTTP({
                url: "js/District.kml",
                format: new OpenLayers.Format.KML({
                    extractAttributes: true
                    //extractStyles:true
                })
            }),
            strategies: [new OpenLayers.Strategy.Fixed()]
        });
      

        //Add the style map to the vector layer
        vector_layer1.styleMap = vector_style_map1;

        //disable Zoom on dblclick
        var Navigation = new OpenLayers.Control.Navigation({
        defaultDblClick: function(event) { return; }
        });

        map.addControl(Navigation);

        //Add a select feature control
        var select_feature_control1 = new OpenLayers.Control.SelectFeature(
        vector_layer1
        //{hover:true}
        )
        map.addControl(select_feature_control1);
        select_feature_control1.activate();



        //Add the layer to the map
        //map.addLayer(google_map);
        map.addLayer(vector_layer1);
        vector_layer1.events.register('featureselected', this, on_select_feature);
        vector_layer1.events.register('featureunselected', this, on_unselect_feature); 
        


        map.setCenter(new OpenLayers.LonLat(9393193.5302238,3303302.6137825),7);
        //map.setCenter(new OpenLayers.LonLat(28,84));

        if(!map.getCenter()){
            map.zoomToMaxExtent();
        }        
    }
    

    </script>
</head>

<body onload='init();'>
    <div id='map_element' style='width:100%; height:100%; border:2px'></div>

</body>
</html>