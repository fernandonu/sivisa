<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();


if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];				
		$query="insert into epi.psitacosis
					(id_psita,id_denuncia,ape_pac,nom_pac,f_nacimiento,sexo,domicilio,localidad,departamento,rural,domestica,profesional,otros,mn_unoh,mn_unom,
					mna_qh,mna_qm,my_qh,my_qm,cant_perros,p_comen,ovino,bovino,pocino,equino,f_sintoma,descrip,tmedico,tquirurgico,
					dd5,contraief,inmunoef,ecografia,tac,f_notificacion,medidas,obs,dni_prof,edad)
					Values
					(nextval('epi.psitacosis_id_psita_seq'),'$id_denuncia',
					'$ape_pac','$nom_pac','$f_nacimiento','$sexo','$domicilio','$localidad','$departamento','$rural','$domestica','$profesional','$otros','$mn_unoh','$mn_unom',
					'$mna_qh','$mna_qm','$my_qh','$my_qm','$cant_perros','$p_comen','$ovino','$bovino','$pocino','$equino','$f_sintoma','$descrip','$tmedico','$tquirurgico',
					'$dd5','$contraief','$inmunoef','$ecografia','$tac','$f_notificacion','$medidas','$obs','$dni_prof','$edad')";
		 sql($query, "Error al insertar t3") or fin_pagina();
		 $accion="Los datos se han guardado correctamente"; 
	
	     $db->CompleteTrans();
}//fin guardart5

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.psitacosis
			where id_psita='$id_psita'";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

$sql_den="select id_psita from epi.psitacosis where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_psita=$res_den->fields['id_psita'];

if ($id_psita) {
			
		$q_hid="select * from epi.psitacosis where id_denuncia=$id_denuncia";
		$res_hid=sql($q_hid, "Error consulta t2") or fin_pagina();
					$ape_pac=$res_hid->fields['ape_pac'];
					$nom_pac=$res_hid->fields['nom_pac'];
					$f_nacimiento=$res_hid->fields['f_nacimiento'];
					$sexo=$res_hid->fields['sexo'];
					$edad=$res_hid->fields['edad'];
					$domicilio=$res_hid->fields['domicilio'];
					$localidad=$res_hid->fields['localidad'];
					$departamento=$res_hid->fields['departamento'];
					$rural=$res_hid->fields['rural'];
					$domestica=$res_hid->fields['domestica'];
					$profesional=$res_hid->fields['profesional'];
					$otros=$res_hid->fields['otros'];
					$mn_unoh=$res_hid->fields['mn_unoh'];
					$mn_unom=$res_hid->fields['mn_unom'];
					$mna_qh=$res_hid->fields['mna_qh'];
					$mna_qm=$res_hid->fields['mna_qm'];
					$my_qh=$res_hid->fields['my_qh'];
					$my_qm=$res_hid->fields['my_qm'];
					$cant_perros=$res_hid->fields['cant_perros'];
					$p_comen=$res_hid->fields['p_comen'];
					$ovino=$res_hid->fields['ovino'];
					$bovino=$res_hid->fields['bovino'];
					$pocino=$res_hid->fields['pocino'];
					$equino=$res_hid->fields['equino'];
					$f_sintoma=$res_hid->fields['f_sintoma'];
					$descrip=$res_hid->fields['descrip'];
					$tmedico=$res_hid->fields['tmedico'];
					$tquirurgico=$res_hid->fields['tquirurgico'];
					$dd5=$res_hid->fields['dd5'];
					$contraief=$res_hid->fields['contraief'];
					$inmunoef=$res_hid->fields['inmunoef'];
					$ecografia=$res_hid->fields['ecografia'];
					$tac=$res_hid->fields['tac'];
					$f_notificacion=$res_hid->fields['f_notificacion'];
					$medidas=$res_hid->fields['medidas'];
					$obs=$res_hid->fields['obs'];
}//fin id_denuncia

echo $html_header;
?>
<script>
//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){
		 if(document.all.f_nacimiento.value==""){
		  	alert('Debe ingresar el Nombre del Propietario');
		  	document.all.f_nacimiento.focus();
		  	return false;
		 } 
		 if(document.all.ape_pac.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.ape_pac.focus();
			return false;
		 } 		 
	
 if (confirm('Confirma agregar datos?'))return true;
	 else return false;	
}//de function control_nuevos()

</script>

<form name='form1' action='psita.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_psita?>" name="id_psita">
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="95%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_denuncia) {
    	?>  
    	<font size=+1><b>Nueva Denuncia</b></font>   
    	<? }
        else {
        ?>
        <font size=+1><b>Dato</b></font>   
        <? } ?>
       
    </td>
 </tr>

 <tr><td><table width=95% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> PSITACOSIS </b>
      </td>
     </tr>
     	<tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    	</table></td></tr>
		
   
    	
	<tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DATOS DEL PROPIETARIO </b>
	           </td>
	         </tr>
    </table></td></tr> 
	
	<tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
              <input type="text" size="50" value="<?=$f_nacimiento;?>" name="f_nacimiento" >
            </td>
            <td align="left">
         	  <b>Apellido:</b>
              <input type="text" size="50" value="<?=$domicilio;?>" name="domicilio" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
              <input type="text" size="50" value="<?=$localidad;?>" name="localidad" >
            </td>
            <td align="left">
         	  <b>Telefono:</b>
              <input type="text" size="50" value="<?=$departamento;?>" name="departamento" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Edad:</b>
              <input type="text" size="50" value="<?=$rural;?>" name="rural" >
            </td>
            <td align="left">
         	  <b>Ocupacion:</b>
              <input type="text" size="50" value="<?=$domestica;?>" name="domestica" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Localidad:</b>
              <input type="text" size="50" value="<?=$profesional;?>" name="profesional" >
            </td>
            <td align="left">
         	  <b>Departamento:</b>
              <input type="text" size="50" value="<?=$otros;?>" name="otros" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DATOS DE LA FUENTE DE INFECCION</b>
	           </td>
	         </tr>
     </table></td></tr>
	
	<tr><td colspan=9><div ><table width=95% align="left" >     
		<tr>
			<td align="right">
				<b>Tipo de Aves:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$mn_unoh;?>" name="mn_unoh" >
            </td>
            <td align="right">
				<b>Tiempo de Tenencia:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$mn_unom;?>" name="mn_unom" >
			</td> 
		</tr>
		<tr>
			 <td align="right">
				<b>Lugar de Compra (Ambulante/Forrajera/Pajareria):</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$mna_qh;?>" name="mna_qh" >
			</td>	
			<td align="right">
				<b>Otro (Especificar):</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$mna_qm;?>" name="mna_qm" >
            </td>
		<tr>
		</tr>
            <td align="right">
				<b>Domicilio:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$my_qh;?>" name="my_qh" >
			</td> 
			 <td align="right">
				<b>Localidad:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$my_qm;?>" name="my_qm" >
			</td>
		</tr>
		</tr>
            <td align="right">
				<b>Departamento:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$cant_perros;?>" name="cant_perros" >
			</td> 
			 <td align="right">
				<b>Telefono:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$p_comen;?>" name="p_comen" >
			</td>
		</tr>
		
		</tr>
            <td align="right">
				<b>Sintomas:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='ovino'><?=$ovino;?></textarea>
			</td> 
			 <td align="right">
				<b>Tratamiento:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='bovino'><?=$bovino;?></textarea>
			</td>
		</tr>	
		
		</tr>
            <td align="right">
				<b>Acciones de Control:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='pocino'><?=$pocino;?></textarea>
			</td> 
			 <td align="right">
				<b>Observaciones:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='equino'><?=$equino;?></textarea>
			</td>
		</tr>
	</table></div></td></tr>
       
<?if ($id_psita){?>
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
	<tr>
	   <td align="center">
		     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=150px">     
		     </td>
	</tr> 
</table>	

</table></td></tr><?//table principal?> 	

</table>
 </form>
 
 <?=fin_pagina();// aca termino ?>