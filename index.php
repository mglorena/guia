<?php
/*
 * Created on 21/10/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
header('Content-Type: text/html; charset=UTF-8');
header('Content-Disposition", "attachment;filename=myfilename.xls');
header( 'X-Frame-Options: SAMEORIGIN' );



require ("classes/cguia.php");

function SearchPHP()
{
    $ix = strip_tags($_POST["inputText"]); 
    $ix2 = strip_tags($_POST["hdnText"]); 
    $btn = strip_tags($_POST["Search"]);

    $inputText = (!isset($ix)?"": $ix);
    $procesar = (!isset($btn)?"":$btn);
    $textFil = (!isset($ix2)?"":$ix2);

    if (isset($procesar)) {
       
	   $result = Search($inputText,$textFil);
        echo $result;
    }
}



?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Guia de Tel&eacutefonos - Direcci&oacuten General de Obras y Servicios</title>
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/popin.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1"/>
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <script type="text/javascript" src="scripts/jquery.js"></script>
        <script type="text/javascript" src="scripts/jquerycol.js"></script>
        <script type="text/javascript" src="scripts/popin.js"></script>
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-40909718-1', 'unsa.edu.ar');
            ga('send', 'pageview');


        </script>
    </head>
    <body>

        <div align="center">
            <div id="content" align="center">

                <form id="formSearch" action="index.php" method="post">

                    <div class="titlePag">Universidad Nacional de Salta</div>
                    <div class="titleSubPag">GUIA TELEFÓNICA INTERNA DEL COMPLEJO GRAL. JOSÉ de SAN MARTIN</div>
                    <br/>

                    <table cellpadding="0" cellspacing="0" style="width:440px">
                        <tr>

                            <td align="right" style="width:99%"><input type="text" id="inputText" name="inputText" style="width:99%;" /></td>
                            <td align="left"><input type="submit" id="btnBuscar"  value="Buscar" name="Search"/></td>

                        </tr>

                    </table>

                    <br/>
                    <div class="litle-msg">Búsqueda sobre número de interno, responsable, dependencia, departamento y personas usuarias de un interno.</div>
                    <div  class="textFooter" >

                        <!-- Filtrar por : -->
                        <?php
                        //$result = DropDownDepto();
                        //echo $result;
                        ?>
                        <!--<a href="#" onclick="PopinOptions(event);"><b>Opciones</b></a>
                        &nbsp;<a href="#" onclick="Imprimir();"><b>Imprimir Vista</b></a> &nbsp;--> 
                    </div>


                    <div id="divResult" style="border:solid 0px #CCC;padding:10px;width:97%">

                        <?php
                        
						SearchPHP();
                        
                        ?>
                    </div>
                    <input type="hidden" id="hdnText" name="hdnText" value="">
                </form>
                <div>


                </div>
            </div>
        </div>

        <div class="textFooter"Para corrección de la información en la GUIA, por favor comuníquese con la Secretaría de Obras, Servicios y Mantenimiento <br/> Universidad Nacional de Salta - 2023  </div>
        <br/>
        <div id="divOpciones" style="display:none;width:500px;height: 80px;">
            <div id="divBarraOpt"  style="padding:10px;">




                Ocultar/Mostrar columna:
                <select id="ddlColumns" >
                    <option value="1">Prefijo</option>
                    <option value="2">Interno</option>
                    <option value="3">Usuario</option>
                    <option value="5">Dependencia</option>
                    <option value="4">Departamento</option>
                    <option value="6">Personas</option>
                </select>

                <input type="button" id="buttonHide" onclick="ShowHideColumn();" value="Ocultar/Mostrar">
                <input type="button" id="buttonshowall" value="Mostrar todas" onclick="ShowAllColums();"/></div>
        </div>
    </body>
</html>
