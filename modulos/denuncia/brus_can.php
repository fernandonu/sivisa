<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	$n_prop=strtoupper($n_prop);     
	$a_prop=strtoupper($a_prop);
	$dom_prop=strtoupper($dom_prop);
		$query="insert into epi.brucel_can
			   	(id_bruc_can, id_denuncia, n_prop, a_prop, dom_prop, telef, d_animal, d_epidemio,laboratorios, f_carga, usuario)
			   	values
			    (nextval('epi.brucel_can_id_bruc_can_seq'), '$id_denuncia','$n_prop', '$a_prop', '$dom_prop', '$telef', '$d_animal', '$d_epidemio', '$laboratorios', now(), '$usuario')";
				
			   sql($query, "Error al insertar t5") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
   
   $db->CompleteTrans();   
         
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.brucel_can
			where id_bruc_can='$id_bruc_can'";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}


$sql_den="select id_bruc_can from epi.brucel_can where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_bruc_can=$res_den->fields['id_bruc_can'];

if ($id_bruc_can){
			$query="SELECT * FROM epi.brucel_can where id_denuncia=$id_denuncia";
			
			$res_q12 =sql($query, "Error consulta t5") or fin_pagina();
			if($res_q12->RecordCount()!=0){
				$id_bruc_can==$res_q12->fields['id_bruc_can']; 
				$n_prop=$res_q12->fields['n_prop'];
				$a_prop=$res_q12->fields['a_prop'];
				$dom_prop=$res_q12->fields['dom_prop'];
				$telef=$res_q12->fields['telef'];
				$d_animal=$res_q12->fields['d_animal'];
				$d_epidemio=$res_q12->fields['d_epidemio'];
				$laboratorios=$res_q12->fields['laboratorios'];
}
}
echo $html_header;
?>
<script>
//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){
		 if(document.all.n_prop.value==""){
		  	alert('Debe ingresar el Nombre');
		  	document.all.n_prop.focus();
		  	return false;
		 } 
		 if(document.all.a_prop.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.a_prop.focus();
			return false;
		 } 
		 if(document.all.dom_prop.value==""){
		  alert('Debe ingresar Matricula');
		  document.all.dom_prop.focus();
		  return false;
		 	} 
		 if(document.all.d_animal.value==""){
		  alert('Debe ingresar Numero de documento');
		  document.all.d_animal.focus();
		  return false; 
		 } 
		 if(document.all.d_epidemio.value==""){
		  alert('Debe ingresar Fecha');
		  document.all.d_epidemio.focus();
		  return false;
		 	} 
		 
		 if(document.all.laboratorios.value==-1 ){
			alert('Debe ingresar Veterinaria');
			document.all.laboratorios.focus();
			return false;
			}
	
 if (confirm('Confirma agregar datos de la denuncia?'))return true;
	 else return false;	
}//de function control_nuevos()

</script>

<form name='form1' action='brus_can.php' method='POST'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_bruc_can?>" name="id_bruc_can">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_bruc_can) {
    	?>  
    	<font size=+1><b>Nuevo Dato</b></font>   
    	<? }
        else {
        ?>
        <font size=+1><b>Dato</b></font>   
        <? } ?>
       
    </td>
 </tr>
 
 <tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> BRUCELOSIS CANINA </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número de Denuncia: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    </table></td></tr>	     
      <tr><td colspan=9><div ><table width=55% align="left" >
          <tr>         
	           <td align="right" colspan="2">
	            <b> DATOS DEL PROPIETARIO </b>
	           </td>
	         </tr>
    	</table></td></tr>	 
   <tr><td colspan=9><div ><table width=55% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$n_prop;?>" name="n_prop" >
            </td>
            <td align="left">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$a_prop;?>" name="a_prop" >
            </td>
          </tr>  
	   </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="75" value="<?=$dom_prop;?>" name="dom_prop" >
            </td>
            <td align="left">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$telef;?>" name="telef" >
            </td>
		 </tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
				<b>Datos del Animal:</b>
			</td>         	
			<td align='left'>
			      <textarea cols='100' rows='4' name='d_animal'  ><?=$d_animal;?></textarea>
			</td>
		</tr>
		</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  ><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  ><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	
         
<br>
<?if ($id_bruc_can){?>
		 <table border="1" align="center" width="100%">   
		 <tr>
		    <td align="center">
		      <input type="submit" name="borrar" value="Borrar" style="width=130px" onclick="return confirm('Esta seguro que desea eliminar')" >
		    </td>
		 </tr> 
		 </table> 	
	 <?}
	 else {?>
			<table border="1" align="center" width="100%">   
	 	    <tr>
		    <td align="center">
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		    </td>
			</table> 
	 
	 <? } ?>
  <table border="1" align="center" width="100%">   
  <tr align="center">
   <td>
     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=150px">     
     </td>
  </tr>
  </table> 
 
 </table> 
 
 </table>
 </form>
 
 <?=fin_pagina();// aca termino ?>