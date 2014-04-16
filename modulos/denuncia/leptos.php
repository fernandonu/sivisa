<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();


if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
					
			$query="insert into epi.leptospirosis
			   	(id_leptosp, id_denuncia, ape_pac, nom_pac, f_nacimiento,sexo,domicilio,localidad,departamento,trurales,e_frogorifico,
				obrero,otro,f_psintoma,f_internacion,f_muestra,ictericia,cefalea,iconjuntivalbilat,fiebre,mialgias,ers1hs,leucositosis,neutrofilia,uremia,
				bili_direc,tgp,cpk,a_domestico,roedores,rio_arroyo,laguna,alcantarilla,inundacion,semana_epi,serologia,positividad,titulo,aislamiento,obs,desempleado)
			   	values
			    (nextval('epi.leptospirosis_id_leptosp_seq'), '$id_denuncia','$ape_pac', '$nom_pac', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', 
			    '$trurales', '$e_frogorifico', '$obrero', '$otro', '$f_psintoma', 
			    '$f_internacion', '$f_muestra', '$ictericia', '$cefalea', '$iconjuntivalbilat', '$fiebre', '$mialgias', '$ers1hs', '$leucositosis', '$neutrofilia', '$uremia', 
			    '$bili_direc', '$tgp', '$cpk', '$a_domestico', '$roedores', '$rio_arroyo', '$laguna', '$alcantarilla', '$inundacion', '$semana_epi', 
			    '$serologia', '$positividad', '$titulo', '$aislamiento', '$obs', '$desempleado')";
				 
			   sql($query, "Error al insertar t1") or fin_pagina();	 
			   $accion="Los datos se han guardado correctamente"; 
			   
   
   $db->CompleteTrans();   
         
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.leptospirosis 
			where id_leptosp=$id_leptosp";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

$sql_den="select id_leptosp from epi.leptospirosis where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_leptosp=$res_den->fields['id_leptosp'];

if ($id_leptosp) {
		
			$q_lep="select * from epi.leptospirosis where id_denuncia=$id_denuncia";
			$res_lep=sql($q_lep, "Error consulta t1") or fin_pagina();
			if($res_lep->RecordCount()!=0){
					$id_leptosp=$res_lep->fields['id_leptosp'];
					$ape_pac=$res_lep->fields['ape_pac'];
					$nom_pac=$res_lep->fields['nom_pac'];
					$f_nacimiento=$res_lep->fields['f_nacimiento'];
					$sexo=$res_lep->fields['sexo'];
					$domicilio=$res_lep->fields['domicilio'];
					$localidad=$res_lep->fields['localidad'];
					$departamento=$res_lep->fields['departamento'];
					$trurales=$res_lep->fields['trurales'];
					$e_frogorifico=$res_lep->fields['e_frogorifico'];
					$obrero=$res_lep->fields['obrero'];
					$otro=$res_lep->fields['otro'];
					$desempleado=$res_lep->fields['desempleado'];
					$f_psintoma=$res_lep->fields['f_psintoma'];
					$f_internacion=$res_lep->fields['f_internacion'];
					$f_muestra=$res_lep->fields['f_muestra'];
					$ictericia=$res_lep->fields['ictericia'];
					$cefalea=$res_lep->fields['cefalea'];
					$s_mengeo=$res_lep->fields['s_mengeo'];
					$iconjuntivalbilat=$res_lep->fields['iconjuntivalbilat'];
					$fiebre=$res_lep->fields['fiebre'];
					$mialgias=$res_lep->fields['mialgias'];
					$ers1hs=$res_lep->fields['ers1hs'];
					$leucositosis=$res_lep->fields['leucositosis'];
					$neutrofilia=$res_lep->fields['neutrofilia'];
					$uremia=$res_lep->fields['uremia'];
					$bili_direc=$res_lep->fields['bili_direc'];
					$tgp=$res_lep->fields['tgp'];
					$cpk=$res_lep->fields['cpk'];
					$a_domestico=$res_lep->fields['a_domestico'];
					$roedores=$res_lep->fields['roedores'];
					$rio_arroyo=$res_lep->fields['rio_arroyo'];
					$laguna=$res_lep->fields['laguna'];
					$alcantarilla=$res_lep->fields['alcantarilla'];
					$inundacion=$res_lep->fields['inundacion'];
					$semana_epi=$res_lep->fields['semana_epi'];
					$serologia=$res_lep->fields['serologia'];
					$positividad=$res_lep->fields['positividad'];
					$titulo=$res_lep->fields['titulo'];
					$aislamiento=$res_lep->fields['aislamiento'];
					$obs=$res_lep->fields['obs'];
	}
}
echo $html_header;
?>
<script>
//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){
		 if(document.all.nom_pac.value==""){
		  	alert('Debe ingresar el Nombre');
		  	document.all.nom_pac.focus();
		  	return false;
		 } 
		 if(document.all.ape_pac.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.ape_pac.focus();
			return false;
		 } 
 
 if (confirm('Confirma agregar datos de la denuncia?'))return true;
	 else return false;	
}//de function control_nuevos()

</script>

<form name='form1' action='leptos.php' method='POST'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_leptosp?>" name="id_leptosp">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="95%" cellspacing='0' border='1' bordercolor='#E0E0E0'  bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_leptosp) {
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
       <b> LEPTOSPIROSIS </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    </table></td></tr>	     
      <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> DATOS DEL PROFESIONAL ACTUANTE </b>
	           </td>
	         </tr>
    	</table></td></tr> 
   
   <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
              <input type="text" size="50" value="<?=$nom_pac;?>" name="nom_pac" >
            </td>
            <td align="left">
         	  <b>Apellido:</b>
              <input type="text" size="50" value="<?=$ape_pac;?>" name="ape_pac" >
            </td>
          </tr>  
	 </table></div></td></tr>

	<tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Matricula:</b>
              <input type="text" size="50" value="<?=$f_nacimiento;?>" name="f_nacimiento" >
            </td>
            <td align="left">
         	  <b>Localidad:</b>
              <input type="text" size="50" value="<?=$localidad;?>" name="localidad" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
  <tr><td colspan=9><div ><table width=95% align="left" >        
		 <tr>
		 	<td align="left">
			  <b>Departamento:</b>         	
              <input type="text" size="50" value="<?=$departamento;?>" name="departamento" >
            </td>
			<td align="left">
         	  <b>Provincia:</b>
              <input type="text" size="50" value="<?=$sexo;?>" name="sexo" >
            </td>
		 </tr>
	</table></div></td></tr>
	
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
              <input type="text" size="50" value="<?=$a_domestico;?>" name="a_domestico" >
            </td>
            <td align="left">
         	  <b>Apellido:</b>
              <input type="text" size="50" value="<?=$roedores;?>" name="roedores" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
              <input type="text" size="50" value="<?=$rio_arroyo;?>" name="rio_arroyo" >
            </td>
            <td align="left">
         	  <b>Telefono:</b>
              <input type="text" size="50" value="<?=$laguna;?>" name="laguna" >
            </td>
          </tr>  
	 </table></div></td></tr>
	
	<tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DATOS DEL ANIMAL </b>
	           </td>
	         </tr>
    </table></td></tr> 
	
	<tr><td colspan=9><div ><table width=95% align="left" >     
		<tr>
			<td align="right">
				<b>Raza:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$ers1hs;?>" name="ers1hs" >
            </td>
            <td align="right">
				<b>Sexo:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$leucositosis;?>" name="leucositosis" >
			</td> 
		</tr>
		<tr>
			 <td align="right">
				<b>Edad:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$neutrofilia;?>" name="neutrofilia" >
			</td>	
			<td align="right">
				<b>Color del Manto:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$uremia;?>" name="uremia" >
            </td>
		<tr>
		</tr>
            <td align="right">
				<b>Nombre:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$bili_direc;?>" name="bili_direc" >
			</td> 
			 <td align="right">
				<b>Procedencia:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$tgp;?>" name="tgp" >
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Fecha Inicio de Sintomas:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$cpk;?>" name="cpk" >
			</td>   
			<td align="right" >
				<b>Sintomas:</b>
				</td>  
				<td align="left"colspan="4">
				<textarea cols='50' rows='5' name='otro'><?=$otro;?></textarea>
			</td>  			
		</tr>
	</table></div></td></tr>
	
	
   	    
   <tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>Enfermedad </b>
	           </td>
	         </tr>
    </table></td></tr> 
	<tr><td colspan=9><div ><table width=95% align="left" >   
		<tr>
			<td align="right">
				<b>Datos Epidemiologico:</b>
				</td>  
				<td align="left">
				<textarea cols='60' rows='3' name='semana_epi'><?=$semana_epi;?></textarea>
			</td>
			<td align="right">
				<b>Examenes de Laboratorio:</b>
				</td>  
				<td align="left">
				<textarea cols='60' rows='3' name='titulo'><?=$titulo;?></textarea>
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Accion en Comunidad o Ambiente:</b>
				</td>  
				<td align="left">
				<textarea cols='60' rows='3' name='obrero'><?=$obrero;?></textarea>
			</td>
			<td align="right">
				<b>Observaciones:</b>
				</td>         	
				<td align='left'>
				<textarea cols='60' rows='4' name='obs'><?=$obs;?></textarea>
				</td>
			</tr>  		
	</table></div></td></tr>

</table>           
<br>

<?if ($id_leptosp){?>

<table class="bordes" align="center" width="100%">
		 <tr>
		    <td align="center">
		      <input type="submit" name="borrar" value="Borrar" style="width=130px" onclick="return confirm('Esta seguro que desea eliminar')" >
		    </td>
		 </tr> 
	 </table>	
	
	 <?}
	 else {?>
	 	 <table width=100% align="center" class="bordes">
		<tr>
		    <td align="center">
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="height:50px; width=250px" onclick="return control_nuevos()">&nbsp;&nbsp;
		    </td>
		</table>	

	 
	 <? } ?>
	 
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   <td>
     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=200px">     
     </td>
  </tr>
 </table></td></tr>
 
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   
  </tr>  
 </table></td></tr>
  </table>
 </table>
 </form>
 
 <?=fin_pagina();// aca termino ?>