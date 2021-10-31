$(document).ready(
    function () {
        // Tables controls:
        $("td.controls a").hide();
        $("tr").hover(
            function () {
                $(this).find("td.controls a").show();
            }, 
            function () {
                $(this).find("td.controls a").hide();
            }
        );  
        // Content box tabs:
        $('.content_box div.content').hide(); 
        $('.header_tabs a.default_tab').addClass('current'); 
        $('.content_box div.default_tab').show(); 
        $('.header_tabs a').click( 
            function () { 
                $(this).parent().find("a").removeClass('current'); 
                $(this).addClass('current'); 
                var currentTab = $(this).attr('href'); 
                $(currentTab).siblings().hide(); 
                $(currentTab).show(); 
                return false;
            }
        );
        
        // When a tab with no content is clicked...
        $(".header_tabs a.no_submenu").click( 
            function () {
                window.location.href=(this.href);
                return false;
            }
        ); 
        // Alternating table rows:
        $('tbody tr:odd').addClass("alt_row"); // Add class "alt-row" to even table rows
        // Check all checkboxes when the one in a table head is checked:
        $('.check_all').click(
            function () {
                $(this).parent().parent().parent().parent().find("input[type='checkbox'].action").attr('checked', $(this).is(':checked'));   
            }
        );
        // Search form style control:
        $('input.textfield').focus(
            function () {  
                $(this).parent().css("background-position", "0 -21px");  
            }
        );  
        $('input.textfield').blur(
            function () {  
                $(this).parent().css("background-position", "0 0");  
            }
        );  
            
    

    }
);

function view(script, width, height)
{
    var scr=window.open(script,"wnd","channelmode=no,directories=no,fullscreen=no,width="+width+",height="+height+",location=no,menubar=no,resizable=no,scrollbars=yes,status=no,titlebar=yes,toolbar=0");
}

function cfmform()
{
    return confirm("Are you sure?");
}


var marked_row=new Array;
function setPointer(theRow,theRowNum,theAction,theDefaultColor,thePointerColor,theMarkColor)
{
    var theCells=null;
    if((thePointerColor==''&&theMarkColor=='')||typeof(theRow.style)=='undefined') {
        return false;
    }
    if(typeof(document.getElementsByTagName)!='undefined') {theCells=theRow.getElementsByTagName('td');}
    else if(typeof(theRow.cells)!='undefined') {theCells=theRow.cells;}
    else{return false;}
    var rowCellsCnt=theCells.length;var domDetect=null;var currentColor=null;var newColor=null;if(typeof(window.opera)=='undefined'&&typeof(theCells[0].getAttribute)!='undefined') {currentColor=theCells[0].getAttribute('bgcolor');domDetect=true;}else{currentColor=theCells[0].style.backgroundColor;domDetect=false;}if(currentColor==''||currentColor.toLowerCase()==theDefaultColor.toLowerCase()) {if(theAction=='over'&&thePointerColor!='') {newColor=thePointerColor;}else if(theAction=='click'&&theMarkColor!='') {newColor=theMarkColor;marked_row[theRowNum]=true;}}else if(currentColor.toLowerCase()==thePointerColor.toLowerCase()&&(typeof(marked_row[theRowNum])=='undefined'||!marked_row[theRowNum])) {if(theAction=='out') {newColor=theDefaultColor;}else if(theAction=='click'&&theMarkColor!='') {newColor=theMarkColor;marked_row[theRowNum]=true;}}else if(currentColor.toLowerCase()==theMarkColor.toLowerCase()) {if(theAction=='click') {newColor=(thePointerColor!='')?thePointerColor:theDefaultColor;marked_row[theRowNum]=(typeof(marked_row[theRowNum])=='undefined'||!marked_row[theRowNum])?true:null;}}if(newColor) {var c=null;if(domDetect) {for(c=0;c<rowCellsCnt;c++){theCells[c].setAttribute('bgcolor',newColor,0);}}else{for(c=0;c<rowCellsCnt;c++){theCells[c].style.backgroundColor=newColor;}}}return true;}
function change_ln(ln_name)
{
    SetCookie('ln',ln_name,100);
    window.location.reload()
}


function SetCookie(cookieName,cookieValue,nDays)
{
    var today = new Date();
    var expire = new Date();
    if (nDays==null || nDays==0) { nDays=1;
    }
    expire.setTime(today.getTime() + 3600000*24*nDays);
    document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires="+expire.toGMTString();
}

  
  
