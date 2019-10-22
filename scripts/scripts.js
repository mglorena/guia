var _WebSitePath = document.location.href;
_WebSitePath = _WebSitePath.substring(0, _WebSitePath.indexOf("guia/", 0) + 5);
   
var _iBrowserHeight;
var _iBrowserWidth;
if (document.all) {
    _iBrowserHeight = document.documentElement.offsetHeight;
    _iBrowserWidth = document.documentElement.offsetWidth;
}
else {
    try {
        if (document.documentElement) {
            _iBrowserHeight = document.documentElement.clientHeight;
            _iBrowserWidth = document.documentElement.clientWidth;
        }
        else {
            _iBrowserHeight = document.body.clientHeight;
            _iBrowserWidth = document.body.clientWidth;
        }
    }
    catch (e) {  //            var iBrowserHeight = $(window).height();  var iBrowserWidth = $(window).width();
       
    }
}
function getId(id)
{
    if(document.getElementById(id) != null)
    {
        return document.getElementById(id);
    }
    else return null;
}
function Imprimir()
{
    var html = $("#divResult").html();
    var date = new Date();
    var anio = date.getFullYear();
    var tpage ="<b>Universidad Nacional de Salta</b><br/><center><b>GUIA TELEFÓNICA INTERNA - "+ anio +"</b></center> <br/>";
    html ="<link rel=\"stylesheet\" href='http://obras.unsa.edu.ar/guia/css/print.css' type='text/css'  />" + tpage + html;
    
    var w = window.open('', '', 'width=960,height=800,resizeable,scrollbars');
    w.document.write(html);
    w.document.title="Guía de Internos";
    w.document.close(); // needed for chrome and safari
  
}
function SearchBy(ddl)
{
    var text = $("#"+ddl.id +" option:selected").text();
    if(text == "Todos") text ="";
    $("#inputText").val("departamento:"+text);
    $("#divTitFiltro").html(text);
    $("#hdnText").val(text);
    $("#btnBuscar").click();
   
}
/*
function ExportExcel()
{
    var html = $("#divResult").html();
    var date = new Date();
    var anio = date.getFullYear();
    var tpage ="GUIA TELEFÓNICA INTERNA - "+ anio ;
    html ="<link rel=\"stylesheet\" href='http://192.168.1.2/guia/css/print.css' type='text/css' />" + tpage + html;
    
    /*  var w = window.open('data:application/csv,');
    w.document.write(html);
    w.document.title="Guía de Internos";
    w.document.close(); // needed for chrome and safari*/
    
/*if (navigator.appName == 'Microsoft Internet Explorer') {
                
    var w = window.open('','xls','');
    w.document.body.innerHTML = '<pre>' + html + '</pre>';
 
     }else{
                
    //location.href='data:application/vnd.ms-excel; charset=utf8,' + encodeURIComponent(html);
    /* var w = window.open('data:application/vnd.ms-excel; charset=utf8,' + encodeURIComponent(html));*/
/* w.document.write(html);
        w.document.title="Guía de Internos";
    w.document.close();      
    }
 
            
    return true;

    
}*/
var windowObjectReference = null; // global variable
 
function openFFPromotionPopup()
{
    if(windowObjectReference == null || windowObjectReference.closed)
    /* if the pointer to the window object in memory does not exist
     or if such pointer exists but the window was closed */
 
    {
        windowObjectReference = window.open("http://www.spreadfirefox.com/",
            "PromoteFirefoxWindowName", "resizable=yes,scrollbars=yes,status=yes");
    /* then create it. The new window will be created and
       will be brought on top of any other window. */
    }
    else
    {
        windowObjectReference.focus();
    /* else the window reference must exist and the window
       is not closed; therefore, we can bring it back on top of any other
       window with the focus() method. There would be no need to re-create
       the window or to reload the referenced resource. */
    };
}
function ShowHideColumn()
{
    var v = $('#ddlColumns').val();
    $('#tblResult').toggleColumns([+v]);
 
 
}
function PopinOptions(ev)
{
    titlePopin ="Opciones"; 
    Popin(ev,"divOpciones",5);
        
}
function ShowAllColums()
{

    $('#tblResult').find('td').each(function(){
        $(this).show();
    });
}