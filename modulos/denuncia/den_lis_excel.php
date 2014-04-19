<?php

require_once ("../../config.php");

$sql="SELECT DISTINCT
epi.veterinarias.nom_veterinaria,
epi.veterinarias.domicilio,
epi.veterinarias.numero,
epi.veterinarias.localidad,
epi.veterinarias.departamento,
epi.veterinarias.tel,
epi.veterinarias.email,
epi.denuncia.n_prof,
epi.denuncia.a_prof,
epi.denuncia.dni_prof,
epi.denuncia.matricula,
epi.denuncia.fecha_notif,
epi.denuncia.f_carga,
epi.denuncia.usuario
FROM
epi.veterinarias
INNER JOIN epi.denuncia ON epi.denuncia.id_veterinaria = epi.veterinarias.id_veterinaria";
$result=sql($sql) or fin_pagina();

excel_header("listado.xls");
//echo $html_header;?>

<form name=form1 method=post action="den_lis_excel.php">
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
  
 <tr bgcolor=#C0C0FF>
    <td align=right >Nombre Veterinaria</td>      	
    <td align=right >Domicilio</td>      	
    <td align=right >Numero</td>
    <td align=right >Localidad</td>
    <td align=right >Departamento</td>
    <td align=right >Telefono</td>    
    <td align=right >Mail</td>
    <td align=right >Nombre Profesional</td>
    <td align=right >Apellido Profesional</td>
    <td align=right >Documento</td>	
    <td align=right >Matricula Profesional</td>    
    <td align=right >Fecha de Notificacion</td>    
    <td align=right >Fecha de Carga</td>    
    <td align=right >Usuario</td>    
  </tr>   
  <?   
  while (!$result->EOF) {?>  
    <tr <?=atrib_tr()?>>     
     <td ><?=$result->fields['nom_veterinaria']?></td>     
     <td ><?=$result->fields['domicilio']?></td>
     <td ><?=$result->fields['numero']?></td>     
     <td ><?=$result->fields['localidad']?></td> 
     <td ><?=$result->fields['departamento']?></td>      
     <td ><?=$result->fields['tel']?></td>      
     <td ><?=$result->fields['email']?></td>      
     <td ><?=$result->fields['n_prof']?></td>      
     <td ><?=$result->fields['a_prof']?></td>      
     <td ><?=$result->fields['dni_prof']?></td>     
     <td ><?=$result->fields['matricula']?></td>    
	<td ><?=fecha($result->fields['fecha_notif'])?></td>	
	<td ><?=fecha($result->fields['f_carga'])?></td>	
     <td ><?=$result->fields['usuario']?></td>  
    </tr>
	<?$result->MoveNext();
    }?>
 </table>
 </form>