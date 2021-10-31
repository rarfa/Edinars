<style>
#map { height: 600px;width: 100%}

.list_points_ventes{
  padding: 0;
  margin-bottom: 67px;
  position: relative;
  top: -1px;
}

.list_points_ventes li{
  list-style:none;
  border-top: 1px dotted rgb(200,200,200);
}

.list_points_ventes h2 {
  color:#73be28 ;
  font-size: 14px;
  font-weight: 600;

}


/*pager*/
.map-pager {
  position:absolute;
  width:100%;
  bottom:0;
}
.map-pager .inner-list {            padding:21px 20px 20px; #padding-top:14px; #padding-bottom:0px; border-top:1px solid;}
.map-pager a {                      text-shadow:0 1px 1px #fff; display:block;}
.map-pager .pager-list-prev {       float:left;font-size:24px}
.map-pager .pager-list-next {       float:right;font-size:24px}
.map-pager .disable {               opacity:.6;filter : alpha(opacity=60);}

</style>

<?php
$sql = mysqli_query(
    $data['cid'], "SELECT {$data['DbPrefix']}points_of_sales.*, {$data['DbPrefix']}wilayas.name as wilaya_name
                    FROM `{$data['DbPrefix']}points_of_sales`
                    INNER JOIN {$data['DbPrefix']}wilayas ON ({$data['DbPrefix']}wilayas.id = {$data['DbPrefix']}points_of_sales.wilaya_id)"
);

$num_points = mysqli_num_rows($sql);
$ii=0;
$nb_points=0;
$html = '';
$list_map_html = '';
while($res = mysqli_fetch_array($sql)){
    $ii++;
    if($ii==1) {
        $nb_points++;
        $html .='<ol id="list_points_ventes_'.$nb_points.'" class="list_points_ventes">';
    }
    $html .= "
  <li>
    <h2>".$res["establishment"]."</h2>
    <p>".$res["adresse"]."</p>
  </li>";

    if($ii==5) {
        $ii=0;
        $html .='</ol>';
    }

    //list map
    $list_map_html .= "['".$res['establishment']."', ".$res['latitude'].",".$res['longitude'].", 1, '<h4>".$res['establishment']."</h4> <p>".$res['adresse']."</p>'], \r";

}

$list_map_html = substr($list_map_html, 0, strlen($list_map_html)-1);

if($ii>0) {
    $html .='</ol>';
}


?>
  <section id="contact">
    <div class="container">
      <div class="col-sm-9" style="height:600px">
        <div id="map" ></div>
        <!-- <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMs8sEU2bIJdciaxhFrc6YHDSW9XMT2DI&callback=initMap">
        </script> -->
      </div>
      <div class="col-sm-3">
        <h4><?php echo $num_points; ?> Points de vente</h4>
        <?php echo $html ?>
        <div class="map-pager">
            <div class="inner-list">
                <div class="list-result-pager">
                  <a class="pager-list-prev" href="javascript:;" onclick="prev_adresses();">
                    <i class="fa fa-angle-left"></i>
                    Préc.
                  </a>
                  <a class="pager-list-next" href="javascript:;" onclick="next_adresses();">
                    Suivant
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
      </div>
    </div>
    <div class="container" style="padding-top:30px;padding-bottom:30px">
      <div class="col-sm-12">
          <h3>Contact</h3>
          Tél.: <b>0560 20 30 71</b><br>
          Email: <b>info@edinars.net</b><br>
          Adresse : <b>Coop les vergers 1 lot n°2 Birkhadem</b><br>
          <h4>Contact via formulaire</h4>

          <div id="div_contact" ></div>
          <div class="alert alert-success alert-dismissable" id="contact_success" style="display:none;">
            Votre message a été envoyé avec succès, nous vous répondons dés que possible.
          </div>
          <form id="contact_form" name="contact_form" method="get" action="#" onsubmit="contact();return false;">
            <div class="form-group" id="div_name">
              <input type="text" name="name" id="name" class="form-control" placeholder="Nom">
            </div>
            <div class="form-group" id="div_email">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group" id="div_subject">
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Sujet">
            </div>
            <div class="form-group" id="div_message">
              <textarea name="message" name="id" class="form-control" rows="8" placeholder="Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer Message</button>
            <div class="loader" id="loading_contact"  name="loading_contact" style="display:none;float:right"></div>
          </form>
      </div>
    </div><!-- container -->
  </section><!--/#bottom-->


  <script>
  function contact(){
    var str = $("#contact_form").serialize();
    // alert(str);
    $(".alert-danger").remove();
    $("#submit_contact").hide();
    $("#loading_contact").show();
    $.ajax({
        url: "api/v1/contact.php",
        cache: false,
        data: str,
        dataType: 'json',
        type:"get",
        success: function(html){
        // $("#div_contact").html(html);
        process_contact(html);
        $("#loading_contact").hide();
        }
      });
  }

  function process_contact(reponse){

      $r_h_s1 = '<div class="alert alert-danger alert-dismissable" for="';
      $r_h_s2 = '" id="';
      $r_h_s3 = '"><i class="icon fa fa-warning"></i>';
      $reponse_html_end = '</div>';

    console.log("process_contact.reponse = ".reponse);
      if(reponse.success == 'yes'){
          // animate("#modal-dialog-login", "fadeOutUp",0,false);
      $("#contact_success").show();
      $("#contact_form").hide();

          // setTimeout(function(){location.href="./index.php"}, 1500);
      // alert ("Ca marche");
      }else{
      // alert ("Ca marche pas !!!");
          // animate("#modal-dialog-login", "wobble");

          if(reponse.name != '') {
              $('#div_name').prepend($r_h_s1+'name'+$r_h_s2+'div_name'+$r_h_s3+reponse.name+$reponse_html_end);
        console.log("Error name: "+reponse.name);
          }
          if(reponse.email != '') {
              $('#div_email').prepend($r_h_s1+'email'+$r_h_s2+'div_email'+$r_h_s3+reponse.email+$reponse_html_end);
        console.log("Error email"+reponse.email);
          }
          if(reponse.subject != '') {
              $('#div_subject').prepend($r_h_s1+'subject'+$r_h_s2+'div_subject'+$r_h_s3+reponse.subject+$reponse_html_end);
        console.log("Error subject"+reponse.subject);
          }
          if(reponse.message != '') {
              $('#div_message').prepend($r_h_s1+'message'+$r_h_s2+'div_message'+$r_h_s3+reponse.message+$reponse_html_end);
        console.log("Error message"+reponse.message);
          }
      }



    $('#div-forms').css("height","");
}

    <?php
      echo "ii=1; \r\n";
      echo "nb_points=".$nb_points."; \r\n";
    ?>

    $( document ).ready(function() {
      $(".list_points_ventes").hide();
      $("#list_points_ventes_1").show();
    });

    function next_adresses(){
      if(ii==nb_points){
        ii=1;
      }else{
        ii++;
      }
      $(".list_points_ventes").hide();
      $("#list_points_ventes_"+ii).show();
    }

    function prev_adresses(){
      if(ii==1){
        ii=nb_points;
      }else{
        ii--;
      }
      $(".list_points_ventes").hide();
      $("#list_points_ventes_"+ii).show();
    }
  </script>

  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMs8sEU2bIJdciaxhFrc6YHDSW9XMT2DI&v=3">
  </script>
  <script type="text/javascript" src="js/infobox.js"></script>

  <script type="text/javascript">
  function initialize() {

  var styles =   [
    {
      stylers: [
      ]
    },{
      featureType: 'road',
      elementType: 'geometry',
      stylers: [
        { lightness: 100 },
        { visibility: 'simplified' }
      ]
    },{
      featureType: 'road',
      elementType: 'labels',
      stylers: [
        { visibility: 'off' }
      ]
    }
  ];

  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(36.710492, 3.047980),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    styles: styles,
    scrollwheel: false
  };
  var map = new google.maps.Map(document.getElementById('map'),mapOptions);

  setMarkers(map, sites);
      infowindow = new google.maps.InfoWindow({
      content: "loading..."
  });
  }

  // var sites = [
  //     ['Titre 1', 52.202977,0.138938, 1, '<h2>Titre 1--</h2> <p>The Frontroom. <br/>23-25 Gwydir Street, Cambridge, CB1 2LG <br/>01223 305 600</p>'],
  //     ['<h2>Titre 1</h2> <p>The Frontroom. <br/>23-25 Gwydir Street, Cambridge, CB1 2LG <br/>01223 305 600</p>', 52.203825,0.134808, 1, ' '],
  //   ['<h2>Titre 1</h2> <p>The Frontroom. <br/>23-25 Gwydir Street, Cambridge, CB1 2LG <br/>01223 305 600</p>',52.190756,0.136522, 1, ' ']
  // ];

  var sites = [
      <?php echo $list_map_html; ?>
  ];



  function setMarkers(map, markers) {

  for (var i = 0; i < markers.length; i++) {
      var sites = markers[i];
      var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
      var marker = new google.maps.Marker({
          position: siteLatLng,
          map: map,
          title: sites[0],
          zIndex: sites[3],
          html: sites[4],
          icon: "images/map-marker-icon.png"
      });
      // Begin example code to get custom infobox
      var boxText = document.createElement("div");
      boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background: yellow; padding: 5px;";
      boxText.innerHTML = marker.html;

      var myOptions = {
           content: boxText
          ,disableAutoPan: false
          ,maxWidth: 0
          ,pixelOffset: new google.maps.Size(-140, 0)
          ,zIndex: null
          ,boxStyle: {
             opacity: 0.9
            ,width: "280px"
           }
          ,closeBoxMargin: "10px 2px 2px 2px"
          ,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
          ,infoBoxClearance: new google.maps.Size(1, 1)
          ,isHidden: false
          ,pane: "floatPane"
          ,enableEventPropagation: false
      };
      // end example code for custom infobox
      var ib = new InfoBox(myOptions);

      google.maps.event.addListener(marker, "click", function (e) {
       // Added this extra line to call in content but now styles on infobox don't work????
       ib.setContent(this.html);
       ib.open(map, this);
      });

  }
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style>
.infoBox{
  background: #fff !important;
  border-radius: 4px;
  border: 1px solid rgba(0,0,0,0.5);
  padding: 5px;
}
.infoBox h4{
  color:#73be28 !important ;
  font-size: 14px;
  font-weight: 600;
}

.infoBox::after {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: -10px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent #fff transparent;
}
</style>
