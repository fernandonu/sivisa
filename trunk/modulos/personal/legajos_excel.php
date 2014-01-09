<?php

require_once ("../../config.php");

$cmd=$parametros["cmd"];

$sql="SELECT
personal.legajos.apellido,
personal.legajos.nombre,
personal.legajos.dni,
personal.legajos.fecha_nacimiento,
personal.legajos.lugar_nacimiento,
personal.legajos.domicilio,
personal.legajos.tel_celular,
personal.legajos.tel_particular,
personal.legajos.localidad,
personal.legajos.provincia,
personal.legajos.em_nombre,
personal.legajos.em_telefono,
personal.legajos.em_direccion,
personal.legajos.em_relacion,
personal.legajos.comentarios,
personal.legajos.fecha_ingreso,
personal.legajos.cuil,
personal.legajos.caja_ahorro_pesos_nro,
personal.tareas_desemp.nombre_tarea,
personal.calificacion.nombre_calificacion,
personal.calificacion.tipo,
personal.categorias.nombre,
personal.distrito.nombre,
personal.distrito.observaciones,
personal.programas.descripcion,
efectivo.descripcion,
personal.legajos_ext.in_sector,
personal.legajos_ext.in_ocupacion,
personal.legajos.fecha_baja,
personal.legajos.activo,
personal.legajos.hr_entra,
personal.legajos.hr_sale,
personal.legajos_ext.estado_civil,
personal.legajos_ext.fecha_estado_civil,
personal.legajos_ext.cedula_identidad,
personal.legajos_ext.nacionalidad,
personal.legajos_ext.tipo_nacionalidad,
personal.legajos_ext.baja_motivo,
personal.legajos_ext.baja_observaciones,
personal.legajos_ext.in_presentador,
personal.legajos_ext.in_sueldo_inicial,
personal.legajos_ext.in_examen_medico,
personal.legajos_ext.in_fecha,
personal.legajos_ext.in_observaciones,
personal.legajos_ext.in_calificacion,
personal.legajos_ext.in_seguro_vida_obligatorio,
personal.legajos_ext.in_seguro_vida,
personal.legajos_ext.in_art,
personal.legajos_ext.in_beneficiario,
personal.legajos_ext.profesion,
personal.legajos_ext.estudios,
personal.legajos_ext.codigo_postal,
personal.legajos_ext.otros_conocimientos,
personal.legajos_ext.exhibe_titulos,
personal.legajos_ext.sexo
FROM
personal.legajos
LEFT JOIN personal.legajos_ext ON personal.legajos.id_legajo = personal.legajos_ext.id_legajo
LEFT JOIN personal.tareas_desemp ON personal.legajos.id_tarea = personal.tareas_desemp.id_tarea
LEFT JOIN personal.calificacion ON personal.legajos.id_calificacion = personal.calificacion.id_calificacion
LEFT JOIN personal.distrito ON personal.legajos.ubicacion = personal.distrito.id_distrito
LEFT JOIN personal.programas ON personal.legajos_ext.id_asignado = personal.programas.id_programas
LEFT JOIN personal.categorias ON personal.legajos_ext.in_categoria = personal.categorias.id_categoria
LEFT JOIN personal.programas AS efectivo ON personal.legajos_ext.id_efectivo = efectivo.id_programas";


if ($cmd=="actuales")
    $sql.=" where (activo=1)";
    

if ($cmd=="historial")
    $sql.=" where (activo=0)";
    
$result=sql($sql) or fin_pagina();

excel_header("legajos.xls");

?>
<form name=form1 method=post action="ing_egre_saldos_excel.php">
<table width="100%">
  <tr>
   <td>
    <table width="100%">
     <tr>
      <td align=left>
       <b>Total: </b><?=$result->RecordCount();?> 
       </td>       
      </tr>      
    </table>  
   </td>
  </tr>  
 </table> 
 <br>
 <table width="100%" align=center border=1 bordercolor=#585858 cellspacing="0" cellpadding="5">   
 
 	<tr bgcolor=#86bbf1>
		
    	<td align="center">apellido</td>
    	<td align="center">nombre</td>
    	<td align="center">dni</td>
    	<td align="center">fecha_nacimiento</td>
    	<td align="center">lugar_nacimiento</td>
    	<td align="center">domicilio</td>
    	<td align="center">tel_celular</td>    
    	<td align="center">tel_particular</td>    
    	<td align="center">localidad</td>    
    	<td align="center">provincia</td>    
    	<td align="center">em_nombre</td>    
    	<td align="center">em_telefono</td>    
    	<td align="center">em_direccion</td>    
    	<td align="center">em_relacion</td>    
    	<td align="center">comentarios</td>    
    	<td align="center">fecha_ingreso</td>    
    	<td align="center">cuil</td>    
    	<td align="center">caja_ahorro_pesos_nro</td>    
    	<td align="center">nombre_tarea</td>    
    	<td align="center">nombre_calificacion</td>    
    	<td align="center">tipo</td>    
    	<td align="center">categorias.nombre</td>    
    	<td align="center">distrito.nombre</td>    
    	<td align="center">distrito.observaciones</td>    
    	<td align="center">programas.descripcion</td>    
    	<td align="center">efectivo.descripcion</td>    
    	<td align="center">in_sector</td>    
    	<td align="center">in_ocupacion</td>    
    	<td align="center">fecha_baja</td>    
    	<td align="center">hr_entra</td>    
    	<td align="center">hr_sale</td>    
    	<td align="center">estado_civil</td>    
    	<td align="center">fecha_estado_civil</td>    
    	<td align="center">cedula_identidad</td>    
    	<td align="center">nacionalidad</td>    
    	<td align="center">tipo_nacionalidad</td>    
    	<td align="center">baja_motivo</td>    
    	<td align="center">baja_observaciones</td>    
    	<td align="center">in_presentador</td>    
    	<td align="center">in_sueldo_inicial</td>    
    	<td align="center">in_examen_medico</td>    
    	<td align="center">in_fecha</td>    
    	<td align="center">in_observaciones</td>    
    	<td align="center">in_calificacion</td>    
    	<td align="center">in_seguro_vida_obligatorio</td>    
    	<td align="center">in_seguro_vida</td>    
    	<td align="center">in_art</td>    
    	<td align="center">in_beneficiario</td>    
    	<td align="center">profesion</td>    
    	<td align="center">estudios</td>    
    	<td align="center">codigo_postal</td>    
    	<td align="center">otros_conocimientos</td>    
    	<td align="center">exhibe_titulos</td>    
    	<td align="center">sexo</td>    
    </tr>
  <?   
  while (!$result->EOF) {?>  
    
    <tr>
	<td ><?=$result->fields['apellido']?></td>
     <td ><?=$result->fields['nombre']?></td>
     <td ><?=$result->fields['dni']?></td>     
     <td ><?=$result->fields['fecha_nacimiento']?></td>         
     <td ><?=$result->fields['lugar_nacimiento']?></td>         
     <td ><?=$result->fields['domicilio']?></td>         
     <td ><?=$result->fields['tel_celular']?></td>         
     <td ><?=$result->fields['tel_particular']?></td>         
     <td ><?=$result->fields['localidad']?></td>         
     <td ><?=$result->fields['provincia']?></td>         
     <td ><?=$result->fields['em_nombre']?></td>         
     <td ><?=$result->fields['em_telefono']?></td>         
     <td ><?=$result->fields['em_direccion']?></td>         
     <td ><?=$result->fields['em_relacion']?></td>         
     <td ><?=$result->fields['comentarios']?></td>         
     <td ><?=$result->fields['fecha_ingreso']?></td>         
     <td ><?=$result->fields['caja_ahorro_pesos_nro']?></td>         
     <td ><?=$result->fields['nombre_tarea']?></td>         
     <td ><?=$result->fields['nombre_calificacion']?></td>         
     <td ><?=$result->fields['tipo']?></td>         
     <td ><?=$result->fields['tareas_desemp']?></td>         
     <td ><?=$result->fields['categorias.nombre']?></td>         
     <td ><?=$result->fields['distrito.nombre']?></td>         
     <td ><?=$result->fields['observaciones']?></td>         
     <td ><?=$result->fields['programas.descripcion']?></td>         
     <td ><?=$result->fields['efectivo.descripcion']?></td>         
     <td ><?=$result->fields['in_sector']?></td>         
     <td ><?=$result->fields['in_ocupacion']?></td>         
     <td ><?=$result->fields['fecha_baja']?></td>         
     <td ><?=$result->fields['hr_entra']?></td>         
     <td ><?=$result->fields['hr_sale']?></td>         
     <td ><?=$result->fields['estado_civil']?></td>         
     <td ><?=$result->fields['fecha_estado_civil']?></td>         
     <td ><?=$result->fields['cedula_identidad']?></td>         
     <td ><?=$result->fields['nacionalidad']?></td>         
     <td ><?=$result->fields['cedula_identidad']?></td>         
     <td ><?=$result->fields['tipo_nacionalidad']?></td>         
     <td ><?=$result->fields['baja_motivo']?></td>         
     <td ><?=$result->fields['baja_observaciones']?></td>         
     <td ><?=$result->fields['in_presentador']?></td>         
     <td ><?=$result->fields['in_sueldo_inicial']?></td>         
     <td ><?=$result->fields['in_examen_medico']?></td>         
     <td ><?=$result->fields['in_fecha']?></td>         
     <td ><?=$result->fields['in_observaciones']?></td>         
     <td ><?=$result->fields['in_calificacion']?></td>         
     <td ><?=$result->fields['in_seguro_vida_obligatorio']?></td>         
     <td ><?=$result->fields['in_seguro_vida']?></td>         
     <td ><?=$result->fields['in_art']?></td>         
     <td ><?=$result->fields['in_beneficiario']?></td>         
     <td ><?=$result->fields['profesion']?></td>         
     <td ><?=$result->fields['estudios']?></td>         
     <td ><?=$result->fields['codigo_postal']?></td>         
     <td ><?=$result->fields['otros_conocimientos']?></td>         
     <td ><?=$result->fields['exhibe_titulos']?></td>         
     <td ><?=$result->fields['sexo']?></td>         
   </tr>
    
    <?$result->MoveNext();
    }?>
 </table>
 </form>
