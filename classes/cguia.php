<?php

/*
 * Created on 21/10/2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once ('cconf.php');
require_once ('csqlprovider.php');
require_once ('cdump.php');

function ConsultaSql($inputText, $text, $b) {
    $internos = array();
    $query = "";
    try {
        $db = new sqlprovider();
        $db->getInstance();
        $query = "call guia_search('" . $inputText . "','" . $text . "'," . $b . ");";
        if ($db->setQuery($query))
            $internos = $db->ListArray();
        $db->CloseMysql();
        return $internos;
    } catch (Exception $ex) {
        echo "hubo error de base de datos " . $ex->getMessage();
    }
    return null;
}

function Search($inputText, $text) {

    $b = 0;
    if (strpos($inputText, "departamento:") !== false) {
        $inputText = str_replace("departamento:", "", $inputText);
        $b++;
    }

    $inputText2 = $inputText;

    if (strpos($inputText, 'á') !== false)
        $inputText2 = str_replace('á', 'a', $inputText);
    if (strpos($inputText, 'é') !== false)
        $inputText2 = str_replace('é', 'e', $inputText);
    if (strpos($inputText, 'í') !== false)
        $inputText2 = str_replace('í', 'i', $inputText);
    if (strpos($inputText, 'ó') !== false)
        $inputText2 = str_replace('ó', 'o', $inputText);
    if (strpos($inputText, 'ú') !== false)
        $inputText2 = str_replace('ú', 'u', $inputText);

    $result = ConsultaSql($inputText, $inputText2, $b);

    $html = "<div class='titleFil'>" . $text . "</div><table id='tblResult' cellpadding='0' cellspacing='0'  class='tableList'>";
    $html .= '<tr class="listtitle">';
    $html .= '<td >Prefijo</td>';
    $html .= '<td >Interno</td>';
    $html .= '<td >Usuario</td>';
    $html .= '<td >Departamento</td>';
    $html .= '<td >Dependencia</td>';
    $html .= '<td style="width:15%">Personas</td></tr>';
    $count = 0;
    $class = 'listitemeven';
    foreach ($result as $interno) {
        if ($count % 2 == 0)
            $class = 'listitemeven';
        else
            $class = 'listitemuneven';
        $html .= '<tr class="' . $class . '">';
        $html .= '<td style="text-align:center;" id="tdPrefijo">' . $interno['FIELD1'] . '&nbsp;</td>';
        $html .= '<td style="text-align:center;" id="tdInterno">' . $interno['interno'] . '&nbsp;</td>';
        $html .= '<td class="noWrap" >' . $interno['usuario'] . '&nbsp;</td>';
        $html .= '<td class="noWrap">' . $interno['dependencia'] . '&nbsp;</td>';
        $html .= '<td class="noWrap">' . $interno['NombreCompleto'] . '&nbsp;</td>';
        $html .= '<td>' . $interno['personas'] . '&nbsp;</td></tr>';
        $count++;
    }
    $html .="</table><script>   
        </script>";
    return $html;
}

function DropDownDepto() {


   
    $result = DptoGetAll();

    $select = "<select id=\"ddlDepto\" name=\"ddlDepto\" onchange=\"SearchBy(this)\">";
    $select.= "<option value='-1' ></option>";
    $select.= "<option value='0' >Todos</option>";
    
    foreach ($result as $d) {
        $select.= "<option value='" . $d['deptoId'] . "' >" . $d['NombreCompleto'] . "</option>";
    }
    $select.="</select>";
    return $select;

}

function DptoGetAll() {
    $dptos = array();
    $query = "";
    try {
        $db = new sqlprovider();
        $db->getInstance();
        $query = "call guia_dptoGetAll();";
        if ($db->setQuery($query))
        {
            $dptos = $db->ListArray();

        }
        $db->CloseMysql();
        return $dptos;
    } catch (Exception $ex) {
        echo "hubo error de base de datos " . $ex->getMessage();
    }
    return null;
}

?>
