<script type="text/JavaScript">
  <!--
  window.onload = function curverycorners(object_event,set_tl,set_tr,set_bl,set_br,divs)
  {
     //alert('called')
     if(!set_tl) set_tl = 20;
     if(!set_tr) set_tr = 20;
     if(!set_bl) set_bl = 20;
     if(!set_br) set_br = 20;
     var ua = navigator.userAgent;
   var MSIEOffset = ua.indexOf("MSIE ");
   var result =parseFloat(ua.substring(MSIEOffset + 5, ua.indexOf(";", MSIEOffset)));
   if(result < 7) return; // notice that this excludes other browsers but seems to work

     settings = {
          tl: { radius: set_tl },
          tr: { radius: set_tr },
          bl: { radius: set_bl },
          br: { radius: set_br },
          antiAlias: true,
          autoPad: false,
          validTags: ["div"]
      }
      <?php/*
      foreach($items as $item)
      {
          print('var myBoxObject = new curvyCorners(settings, "'.$item.'");
          myBoxObject.applyCornersToAll();');
      }*/
      ?>
      if(!divs)
      {
          var divs = new Array(<? print($items) ?>)
          for(var i = 0; i < divs.length; i++)
          {
             var myBoxObject = new curvyCorners(settings, divs[i]);
             myBoxObject.applyCornersToAll();
          }
      }
      else
      {
          var myBoxObject = new curvyCorners(settings, divs);
             myBoxObject.applyCornersToAll();
      }
  }
  -->
</script>
