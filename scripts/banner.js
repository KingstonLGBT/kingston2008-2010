var step = 15
var counter1 = -15
var scrolling = 1;
var timeout;
var width;
var enabled = 0;
//var counter2 = 710;

/* Two SPANS are placed within a mother DIV which contains the overflow. Thee SPANS sit side by side and scroll left
 * When the second SPAN reaches were SPAN 1 was they'll move back to their positions but slightly out to give a totally seamless affect*/

function scrollsetup()
{
    document.getElementById('nextevent').style.cursor = "pointer";
    document.getElementById('twitter').style.cursor = "pointer";
    if(!document.getElementById('bannerbox')) return;
    if(iever < 8) return;
    document.getElementById('nextevent').style.textAlign = "left";
    document.getElementById('twitter').style.textAlign = "left";
    document.getElementById('nextevent').style.display = "inline";
    document.getElementById('twitter').style.display = "inline";
    document.getElementById('twitter').style.marginLeft = "50px";
    document.getElementById("bannerbox").style.overflow = "hidden"
    document.getElementById('bannerbox').style.height = "18px";
    document.getElementById("banner1").style.whiteSpace = "nowrap"
    document.getElementById('banner1').style.height = "18px";
    document.getElementById('banner1').style.paddingLeft = step+"px";
    document.getElementById("banner2").innerHTML= '<span id="nextevent2" onclick="loadpage(\'t\')">'+bannermessage+'</span><span id="twitter2" onclick="loadpage(\'t\')"></span>';
    document.getElementById("twitter2").innerHTML = twitter;
    document.getElementById('nextevent2').style.cursor = "pointer";
    document.getElementById('twitter2').style.cursor = "pointer";
    document.getElementById('banner2').style.visibility = "visible";
    width = document.getElementById('banner1').offsetWidth
    if(width < 668)
    { document.getElementById('banner1').style.marginRight = (718 -width)+"px";width = width - 718;}
    else
    { document.getElementById('banner1').style.marginRight = "50px";width = width + 50;}
    scroll()
    enabled = 1;
}

function scroll(){
   timeout = setTimeout('scroll()', 500)
   //var width = document.getElementById('banner1').offsetWidth
    if(width <= 718) width = 718
    counter1 = counter1 + step
    document.getElementById('banner1').style.left = "-"+counter1+"px";
    document.getElementById('banner2').style.left = "-"+counter1+"px";
    if(counter1 >= (width-step)){ var calc = (counter1 - width) +step; counter1 = 0+calc; }
}

function scrollstop(){
    if(enabled == '1')
    clearTimeout(timeout)
}

function scrollstart(){
    if(enabled == '1')
    timeout = setTimeout('scroll()', 200)
}

function loadpage(page)
{
    if(page == 'e')
        window.location.href = "/events";
    else if(page == 't')
        window.location.href = "http://twitter.com/kingstonlgbt";
}
