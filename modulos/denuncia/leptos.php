<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();


if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	$f_nacimiento=Fecha_db($f_nacimiento);
				if ($f_psintoma!='')$f_psintoma=Fecha_db($f_psintomaotif);else $f_psintoma='1000-01-01';
				if ($f_internacion!='')$f_internacion=Fecha_db($f_internacion);else $f_internacion='1000-01-01';		
				if ($f_muestra!='')$f_muestra=Fecha_db($f_muestra);else $f_muestra='1000-01-01';	
				if ($f_notificacion!='')$f_notificacion=Fecha_db($f_notificacion);else $f_notificacion='1000-01-01';	
				
			$query="insert into epi.leptospirosis
			   	(id_leptosp, id_denuncia, ape_pac, nom_pac, f_nacimiento,sexo,domicilio,localidad,departamento,trurales,e_frogorifico,
				obrero,otro,f_psintoma,f_internacion,f_muestra,ictericia,cefalea,iconjuntivalbilat,fiebre,mialgias,ers1hs,leucositosis,neutrofilia,uremia',
				bili_direc,tgp,cpk,a_domestico,roedores,rio_arroyo,laguna,alcantarilla,inundacion,f_notificacion,semana_epi,esablecimiento,serologia,positividad,titulo,aislamiento,obs,desempleado)
			   	values
			    (nextval('epi.leptospirosis_id_leptosp_seq'), '$id_denuncia','$ape_pac', '$a_prop', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', 
			    '$trurales', '$e_frogorifico', '$obrero', '$otro', '$f_psintoma', 
			    '$f_internacion', '$f_muestra', '$ictericia', '$cefalea', '$iconjuntivalbilat', '$fiebre', '$mialgias', '$ers1hs', '$leucositosis', '$neutrofilia', '$uremia', 
			    '$bili_direc', '$tgp', '$cpk', '$a_domestico', '$roedores', '$rio_arroyo', '$laguna', '$alcantarilla', '$inundacion', '$f_notificacion', '$semana_epi', 
			    '$esablecimiento', '$serologia', '$positividad', '$titulo', '$aislamiento', '$obs', '$desempleado')";
				 
			   sql($query, "Error al insertar t1") or fin_pagina();	 
			   $accion="Los datos se han guardado correctamente"; 
			   
   
   $db->CompleteTrans();   
         
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from leptospirosis 
			where id_leptosp=$id_leptosp";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

if ($id_leptosp) {
		
			$q_lep="SELECT DISTINCT *
					FROM
					epi.leptospirosis
					WHERE
					epi.leptospirosis.id_denuncia=$id_denuncia
					ORDER BY
					epi.leptospirosis.id_leptosp DESC";
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
					$f_psintoma=fecha($res_lep->fields['f_psintoma']);
					$f_internacion=fecha($res_lep->fields['f_internacion']);
					$f_muestra=fecha($res_lep->fields['f_muestra']);
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
					$f_notificacion=fecha($res_lep->fields['f_notificacion']);
					$semana_epi=$res_lep->fields['semana_epi'];
					$esablecimiento=$res_lep->fields['esablecimiento'];
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
		  	document.all.n_prop.focus();
		  	return false;
		 } 
		 if(document.all.ape_pac.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.a_prop.focus();
			return false;
		 } 
		 if(document.all.f_nacimiento.value==-1){
		  alert('Debe ingresar fecha de nacimiento');
		  document.all.f_nacimiento.focus();
		  return false;
		 	} 
 if (confirm('Confirma agregar datos de la denuncia?'))return true;
	 else return false;	
}//de function control_nuevos()

function editar_campos(){
	document.all.nom_pac.disabled=false;
	document.all.a_prop.disabled=false;	
	document.all.ape_pac.disabled=false;
	document.all.f_nacimiento.disabled=false;
	document.all.sexo.disabled=false;
	document.all.domicilio.disabled=false;
	document.all.localidad.disabled=false;
	document.all.departamento.disabled=false;	

	document.all.guardar_editar.disabled=false;
	document.all.cancelar_editar.disabled=false;
	document.all.borrar.disabled=false;
	return true;
}
//de function control_nuevos()


</script>

<form name='form1' action='leptos.php' method='POST'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_leptosp?>" name="$id_leptosp">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0  bgcolor='<?=$bgcolor_out?>' class="bordes">
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
	            <b> DATOS DEL PACIENTE </b>
	           </td>
	         </tr>
    	</table></td></tr> 
   <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
              <input type="text" size="50" value="<?=$ape_pac;?>" name="ape_pac" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Apellido:</b>
              <input type="text" size="50" value="<?=$nom_pac;?>" name="nom_pac" <? if ($id_leptosp) echo "disabled"?>>
            </td>
          </tr>  
	 </table></div></td></tr>
	 <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
         <td align="right">
         	  <b> Fecha de Nacimiento:</b>
             <input type='text' name='f_nacimiento' value='<?=fecha($f_nacimiento);?>' size=40 align='right' ></b>
           </td>
           
            <td align="left">
         	  <b>Sexo:</b>
      					<input type="radio" name="sexo" value="F" checked>Femenino
						<input type="radio" name="sexo" value="M">Masculino
			</td>
           
		 </tr>
	</table></div></td></tr>	    
	  <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	
              <input type="text" size="75" value="<?=$domicilio;?>" name="domicilio" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Localidad:</b>
         	
              <input type="text" size="20" value="<?=$localidad;?>" name="localidad" <? if ($id_leptosp) echo "disabled"?>>
            </td>
		 </tr>
		 <tr>
		 	<td align="left">
				<b>Departamento:</b>
         	
              <input type="text" size="20" value="<?=$departamento;?>" name="departamento" <? if ($id_leptosp) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr>	    
   <tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>OCUPACION </b>
	           </td>
	         </tr>
    	</table></td></tr> 
	<tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
               	<td align="left">
					<b>Tareas Rurales:</b>
				
							<input type="radio" name="trurales" value="S" checked>Si
							<input type="radio" name="trurales" value="N">No
	            </td>
            	<td align="left">
					<b>Empleado en Frigorifico:</b>
				
							<input type="radio" name="e_frogorifico" value="S" checked>Si
							<input type="radio" name="e_frogorifico" value="N">No
				</td> 
				<td align='left'>
				<b>Desempleado:</b>
						<input type="checkbox" name="desempleado" value="S" >
	            </td>
		</tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=95% align="left" >     
		<tr>
			<td align="left">
				<b>Obrero:</b>
				<input type="text" size="70" value="<?=$obrero;?>" name="obrero" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="left">
				<b>Otros:</b>
				<input type="text" size="70" value="<?=$otro;?>" name="otro" <? if ($id_leptosp) echo "disabled"?>>
			</td>         	
		</tr>
	</table></div></td></tr>	    
   <tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>Datos de la Enfermedad </b>
	           </td>
	         </tr>
    </table></td></tr> 
	<tr><td colspan=9><div ><table width=95% align="left" >   
		<tr>

			 <td align="right">
				<b>Fecha de primeros sintomas:</b>
			</td> 
			<td align="left">
				<input type=text id=f_psintoma name=f_psintoma  value='<?=$f_psintoma; ?>' size=10 >				    	 
				<?=link_calendario("f_psintoma");?>	
			</td>	
			<td> 
			<td align="right">
				<b>Fecha de Internacion:</b>
			</td> 
			<td align="left">
				<input type=text id=f_internacion name=f_internacion  value='<?=$f_internacion; ?>' size=10 >				    	 
				<?=link_calendario("f_internacion");?>	
			</td>	
			<td align="right">
				<b>Fecha de toma de Muestra:</b>
			</td>    
			<td align="left">
				<input type=text id=f_muestra name=fecha_vencimiento value='<?=$f_muestra;?>' size=10 >
				<?=link_calendario("f_muestra");?>					    	 
			</td>
		</tr>											        
	</table></div></td></tr>	    
      <tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>Sintomas </b>
	           </td>
	         </tr>
    </table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
               	<td align="right">	 
					<b>ICTERICIA:</b>
				</td>  
				<td align="left">
							<input type="radio" name="ictericia" value="S" checked>Si
							<input type="radio" name="ictericia" value="N">No
	            </td>
            	<td align="right">
					<b>Ataques repentinos de cefaleas:</b>
				</td>  
				<td align="left">
							<input type="radio" name="cefalea" value="S" checked>Si
							<input type="radio" name="cefalea" value="N">No
				</td>
				<td align="right">
					<b>Sindrome Meningeo:</b>
					</td>  
				<td align="left">
							<input type="radio" name="s_mengeo" value="S" checked>Si
							<input type="radio" name="s_mengeo" value="N">No
	            </td>
	    </tr> 
	    <tr>
            	<td align="right">
					<b>Inyeccion Conjuntival Bilateral:</b>
					</td>  
				<td align="left">
							<input type="radio" name="iconjuntivalbilat" value="S" checked>Si
							<input type="radio" name="iconjuntivalbilat" value="N">No
				</td> 
				<td align="right">
					<b>Fiebre 39ºC o +:</b>
					</td>  
				<td align="left">
							<input type="radio" name="fiebre" value="S" checked>Si
							<input type="radio" name="fiebre" value="N">No
				</td> 
				<td align="right">
					<b>Mialgias(En pantorrillas):</b>
					</td>  
				<td align="left">
							<input type="radio" name="mialgias" value="S" checked>Si
							<input type="radio" name="mialgias" value="N">No
				</td> 
		</tr>
		
	</table></div></td></tr>	 
	
	
	
	<tr><td colspan=9><div ><table width=100% align="left" >   
		<tr id="ma">         
	           <td align="center" colspan="2">
         	  <b>Datos de Laboratorio Clinico:</b>
         	</td>         	
           
		 </tr>
	</table></div></td></tr>	
<tr><td colspan=9><div ><table width=95% align="left" >     
		<tr>
			<td align="right">
				<b>ERS 1ºHora:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$ers1hs;?>" name="ers1hs" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="right">
				<b>Leucositosis:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$leucositosis;?>" name="leucositosis" <? if ($id_leptosp) echo "disabled"?>>
			</td> 
			 <td align="right">
				<b>Neutrofilia:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$neutrofilia;?>" name="neutrofilia" <? if ($id_leptosp) echo "disabled"?>>
			</td>         	
		</tr>
		<tr>
			<td align="right">
				<b>Uremia:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$uremia;?>" name="uremia" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="right">
				<b>Bilirubina Directa:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$bili_direc;?>" name="bili_direc" <? if ($id_leptosp) echo "disabled"?>>
			</td> 
			 <td align="right">
				<b>T.G.P.:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$tgp;?>" name="tgp" <? if ($id_leptosp) echo "disabled"?>>
			</td>
			<td align="right">
				<b>C.P.K.:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$cpk;?>" name="cpk" <? if ($id_leptosp) echo "disabled"?>>
			</td>         	
		</tr>
	</table></div></td></tr>	
	  <tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>FUENTE PROBABLE DE INFECCION </b>
	           </td>
	         </tr>
    </table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
               	<td align="right">	 
					<b>Contacto con animales domesticos:</b>
				</td>  
				<td align="left">
							<input type="radio" name="a_domestico" value="S" checked>Si
							<input type="radio" name="a_domestico" value="N">No
	            </td>
            	<td align="right">
					<b>Roedores u otros:</b>
				</td>  
				<td align="left">
							<input type="radio" name="roedores" value="S" checked>Si
							<input type="radio" name="roedores" value="N">No
				</td>
				<td align="right">
					<b>Rio-Arroyo:</b>
					</td>  
				<td align="left">
							<input type="radio" name="rio_arroyo" value="S" checked>Si
							<input type="radio" name="rio_arroyo" value="N">No
	            </td>
	    </tr> 
	    <tr>
            	<td align="right">
					<b>Laguna:</b>
					</td>  
				<td align="left">
							<input type="radio" name="laguna" value="S" checked>Si
							<input type="radio" name="laguna" value="N">No
				</td> 
				<td align="right">
					<b>Alcantarilla:</b>
					</td>  
				<td align="left">
							<input type="radio" name="alcantarilla" value="S" checked>Si
							<input type="radio" name="alcantarilla" value="N">No
				</td> 
				<td align="right">
					<b>Inundacion:</b>
					</td>  
				<td align="left">
							<input type="radio" name="inundacion" value="S" checked>Si
							<input type="radio" name="inundacion" value="N">No
				</td> 
		</tr>
		
	</table></div></td></tr>	
		  <tr><td colspan=9><div ><table width=100% align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>Laboratorio </b>
	           </td>
	         </tr>
    </table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
               	<td align="right">	 
					<b>Serologia</b>
				</td>  
				<td align="left">
							<input type="radio" name="serologia" value="S" checked>Si
							<input type="radio" name="serologia" value="N">No
	            </td>
            	<td align="right">
					<b>Positividad:</b>
				</td>  
				<td align="left">
							<input type="radio" name="positividad" value="S" checked>Si
							<input type="radio" name="positividad" value="N">No
				</td>
		</tr> 
	</table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     	
		<tr>
			<td align="right">
				<b>Titulo:</b>
				</td>  
				<td align="left">
					<textarea cols='60' rows='2' name='titulo'<? if($id_leptosp) echo "disabled"?>><?=$titulo;?></textarea>
			</td>
				<td align="right">
					<b>aislamiento:</b>
					</td>  
				<td align="left">
							<input type="radio" name="rio_arroyo" value="S" checked>Si
							<input type="radio" name="rio_arroyo" value="N">No
	            </td>
	    </tr> 
	   </table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     
		
	    <td align="right">
				<b>Observaciones:</b>
		</td>         	
		<td align='left'>
				<textarea cols='75' rows='4' name='obs'<? if($id_leptosp) echo "disabled"?>><?=$obs;?></textarea>
		</td>	     	
	    
	    
	</table></div></td></tr>	  
 </table>           
<br>

<?if ($id_leptosp){?>

<table class="bordes" align="center" width="100%">
		 <tr>
		    <td align="center">
		      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		      <input type="submit" name="borrar" value="Borrar" style="width=130px" onclick="return confirm('Esta seguro que desea eliminar')" >
		    </td>
		 </tr> 
	 </table>	
	
	 <?}
	 else {?>
	 	<tr>
		    <td align="center">
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		    </td>
	 
	 <? } ?>
	 
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   <td>
     <input type=button name="volver" value="Volver" onclick="document.location='den_ad.php'"title="Volver al Listado" style="width=150px">     
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