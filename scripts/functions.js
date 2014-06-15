var iever;
var imagecount = 0;

function browserhandle(){
    //var b_version=navigator.appVersion;
    //var version=parseFloat(b_version);
    //alert(navigator.userAgent)
    //alert(document.body.offsetWidth)
    if(navigator.appName == 'Microsoft Internet Explorer')
    { 
       var ua = navigator.userAgent;
       var MSIEOffset = ua.indexOf("MSIE ");
       iever = parseFloat(ua.substring(MSIEOffset + 5, ua.indexOf(";", MSIEOffset)));
       /*
       if(iever < 8)
        {
            document.getElementById('incompatable').innerHTML = "Your browser is not compatable";
            document.getElementById('incompatable').style.height = "80px";
            return
        }
        */
       //if(iever >= 8)
           //document.getElementById("mainarea").style.filter = "alpha(opacity=90)";
    }
    document.getElementById('incompatable').style.visibility = "hidden";
}

function emergencyexit()
{
    /*
    var elements = new Array("background","award","navigationarea","mainarea","customizebox","exitbox","incompatable")
    //alert(elements.length)
   
   for(var i = 0; i < elements.length; i++)
    {
        document.getElementById(elements[i]).style.visibility = 'hidden';
    } */
    document.body.style.visibility = 'hidden'
    document.body.style.background = '#FFFFFF';
    document.title = 'Loading...';
}

function emergencyexithover(state)
{
    if(state == '1')
        document.getElementById('eeimg').src = '/images/body/exit_hover.png'
    else if(state == '0')
        document.getElementById('eeimg').src = '/images/body/exit.png'
}

function submenulocation(parentid,id)
{
    //parentid = "nav_15"
    //alert(document.getElementById('navigationarea').offsetTop)
    //alert(document.getElementById(parentid).offsetTop)
    var top = (document.getElementById('navigationarea').offsetTop + document.getElementById(parentid).offsetTop);
    //alert(top)
    document.getElementById(id).style.top = top+"px";
}

function submenushow(id)
{
    //alert(id)
    document.getElementById(id).style.visibility = 'visible';
}

function submenuhide(id)
{
    document.getElementById(id).style.visibility = 'hidden';
}

function changeimage()
{
     if(imagecount < 30)
        setTimeout('changeimage()', 4000)
     //var noofpics = pictures.length
     var ran = Math.random() * pictures.length;
     ran = Math.ceil(ran);
     ran--;
     document.getElementById('randomimage').src = "/images/random/"+pictures[ran]
     imagecount++
}

function externalLinks()
{
    if (!document.getElementsByTagName) return;
    var anchors = document.getElementsByTagName("a");
    for (var i=0; i<anchors.length; i++) {
        var anchor = anchors[i];
        if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external")
            anchor.target = "_blank";
    }
}

/*
function changeimage()
{
    if(!changecount) var changecount = 0
    else changecount++;
    if(changecount < 3)
        setTimeout('changeimage()', 4000)
    var xmlhttp;
      xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if(xmlhttp.readyState==4)
      {
      document.getElementById('randomimage').src = lastimg = xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","/includes/randompic.php?send=src",true);
    xmlhttp.send(null);
}*/