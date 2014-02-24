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
	            <b> DATOS DEL PACIENTE </b>
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
         <td align="right">
         	  <b> Fecha de Nacimiento:</b>
             <input type='text' name='f_nacimiento' value='<?=$f_nacimiento;?>' size='40' align='right' ></b>
           </td>
           
            <td align="left">
         	  <b>Sexo (M/F):</b>
      					<input type="text" size="4" value="<?=$sexo;?>" name="sexo" >
			</td>
           
		 </tr>
	</table></div></td></tr>	    
	  <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	
              <input type="text" size="75" value="<?=$domicilio;?>" name="domicilio" >
            </td>
            <td align="left">
         	  <b>Localidad:</b>
         	
              <input type="text" size="20" value="<?=$localidad;?>" name="localidad" >
            </td>
		 </tr>
		 <tr>
		 	<td align="left">
				<b>Departamento:</b>
         	
              <input type="text" size="20" value="<?=$departamento;?>" name="departamento" >
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
					<b>Tareas Rurales (SI/NO):</b>
					<input type="text" size="4" value="<?=$trurales;?>" name="trurales">
	            </td>
            	<td align="left">
					<b>Empleado en Frigorifico (SI/NO):</b>				
					<input type="text" size="4" value="<?=$e_frogorifico;?>" name="e_frogorifico">
				</td> 
				
				<td align='left'>
					<b>Desempleado (SI/NO):</b>
					<input type="text" size="4" value="<?=$desempleado;?>" name="desempleado">
	            </td>
		</tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=95% align="left" >     
		<tr>
			<td align="left">
				<b>Obrero:</b>
				<input type="text" size="70" value="<?=$obrero;?>" name="obrero" >
            </td>
            <td align="left">
				<b>Otros:</b>
				<input type="text" size="70" value="<?=$otro;?>" name="otro" >
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
				<input type='text' id='f_psintoma' name='f_psintoma'  value='<?=$f_psintoma; ?>' size=10 >				    	 
			</td>	
			<td> 
			<td align="right">
				<b>Fecha de Internacion:</b>
			</td> 
			<td align="left">
				<input type='text' id='f_internacion' name='f_internacion'  value='<?=$f_internacion; ?>' size=10 >				    	 
			</td>	
			<td align="right">
				<b>Fecha de toma de Muestra:</b>
			</td>    
			<td align="left">
				<input type='text' id='f_muestra' name='f_muestra' value='<?=$f_muestra;?>' size=10 >
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
							<input type="radio" name="ictericia" value="S" <?=($ictericia=='S')?'checked':'';?> >Si
							<input type="radio" name="ictericia" value="N" <?=($ictericia=='N')?'checked':'';?> >No
	            </td>
            	<td align="right">
					<b>Ataques repentinos de cefaleas:</b>
				</td>  
				<td align="left">
							<input type="radio" name="cefalea" value="S"  <?=($cefalea=='S')?'checked':'';?> >Si
							<input type="radio" name="cefalea" value="N"  <?=($cefalea=='N')?'checked':'';?> >No
				</td>
				<td align="right">
					<b>Sindrome Meningeo:</b>
					</td>  
				<td align="left">
							<input type="radio" name="s_mengeo" value="S" <?=($s_mengeo=='S')?'checked':'';?> >Si
							<input type="radio" name="s_mengeo" value="N" <?=($s_mengeo=='N')?'checked':'';?> >No
	            </td>
	    </tr> 
	    <tr>
            	<td align="right">
					<b>Inyeccion Conjuntival Bilateral:</b>
					</td>  
				<td align="left">
							<input type="radio" name="iconjuntivalbilat" value="S" <?=($iconjuntivalbilat=='S')?'checked':'';?> >Si
							<input type="radio" name="iconjuntivalbilat" value="N" <?=($iconjuntivalbilat=='N')?'checked':'';?> >No
				</td> 
				<td align="right">
					<b>Fiebre 39ºC o +:</b>
					</td>  
				<td align="left">
							<input type="radio" name="fiebre" value="S" <?=($fiebre=='S')?'checked':'';?> >Si
							<input type="radio" name="fiebre" value="N" <?=($fiebre=='N')?'checked':'';?> >No
				</td> 
				<td align="right">
					<b>Mialgias(En pantorrillas):</b>
					</td>  
				<td align="left">
							<input type="radio" name="mialgias" value="S" <?=($mialgias=='S')?'checked':'';?> >Si
							<input type="radio" name="mialgias" value="N" <?=($mialgias=='N')?'checked':'';?> >No
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
				<input type="text" size="25" value="<?=$ers1hs;?>" name="ers1hs" >
            </td>
            <td align="right">
				<b>Leucositosis:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$leucositosis;?>" name="leucositosis" >
			</td> 
			 <td align="right">
				<b>Neutrofilia:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$neutrofilia;?>" name="neutrofilia" >
			</td>         	
		</tr>
		<tr>
			<td align="right">
				<b>Uremia:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$uremia;?>" name="uremia" >
            </td>
            <td align="right">
				<b>Bilirubina Directa:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$bili_direc;?>" name="bili_direc" >
			</td> 
			 <td align="right">
				<b>T.G.P.:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$tgp;?>" name="tgp" >
			</td>
			<td align="right">
				<b>C.P.K.:</b>
				</td>  
				<td align="left">
				<input type="text" size="25" value="<?=$cpk;?>" name="cpk" >
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
							<input type="radio" name="a_domestico" value="S" <?=($a_domestico=='S')?'checked':'';?> >Si
							<input type="radio" name="a_domestico" value="N" <?=($a_domestico=='N')?'checked':'';?> >No
	            </td>
            	<td align="right">
					<b>Roedores u otros:</b>
				</td>  
				<td align="left">
							<input type="radio" name="roedores" value="S" <?=($roedores=='S')?'checked':'';?> >Si
							<input type="radio" name="roedores" value="N" <?=($roedores=='N')?'checked':'';?> >No
				</td>
				<td align="right">
					<b>Rio-Arroyo:</b>
					</td>  
				<td align="left">
							<input type="radio" name="rio_arroyo" value="S" <?=($rio_arroyo=='S')?'checked':'';?> >Si
							<input type="radio" name="rio_arroyo" value="N" <?=($rio_arroyo=='N')?'checked':'';?> >No
	            </td>
	    </tr> 
	    <tr>
            	<td align="right">
					<b>Laguna:</b>
					</td>  
				<td align="left">
							<input type="radio" name="laguna" value="S" <?=($laguna=='S')?'checked':'';?> >Si
							<input type="radio" name="laguna" value="N" <?=($laguna=='N')?'checked':'';?> >No
				</td> 
				<td align="right">
					<b>Alcantarilla:</b>
					</td>  
				<td align="left">
							<input type="radio" name="alcantarilla" value="S" <?=($alcantarilla=='S')?'checked':'';?> >Si
							<input type="radio" name="alcantarilla" value="N" <?=($alcantarilla=='N')?'checked':'';?> >No
				</td> 
				<td align="right">
					<b>Inundacion:</b>
					</td>  
				<td align="left">
							<input type="radio" name="inundacion" value="S" <?=($inundacion=='S')?'checked':'';?> >Si
							<input type="radio" name="inundacion" value="N" <?=($inundacion=='N')?'checked':'';?> >No
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
							<input type="radio" name="serologia" value="S" <?=($serologia=='S')?'checked':'';?> >Si
							<input type="radio" name="serologia" value="N" <?=($serologia=='N')?'checked':'';?> >No
	            </td>
            	<td align="right">
					<b>Positividad:</b>
				</td>  
				<td align="left">
							<input type="radio" name="positividad" value="S" <?=($positividad=='S')?'checked':'';?> >Si
							<input type="radio" name="positividad" value="N" <?=($positividad=='N')?'checked':'';?> >No
				</td>
		</tr> 
	</table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     	
		<tr>
			<td align="right">
				<b>Titulo:</b>
				</td>  
				<td align="left">
					<textarea cols='60' rows='2' name='titulo'><?=$titulo;?></textarea>
			</td>
				<td align="right">
					<b>aislamiento:</b>
					</td>  
				<td align="left">
							<input type="radio" name="rio_arroyo" value="S" <?=($rio_arroyo=='S')?'checked':'';?> >Si
							<input type="radio" name="rio_arroyo" value="N" <?=($rio_arroyo=='N')?'checked':'';?> >No
	            </td>
	    </tr> 
	   </table></td></tr>
    <tr><td colspan=9><div ><table width=95% align="left" >     
		
	    <td align="right">
				<b>Observaciones:</b>
		</td>         	
		<td align='left'>
				<textarea cols='75' rows='4' name='obs'><?=$obs;?></textarea>
		</td>	     	
	    
	    
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
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		    </td>
		</table>	

	 
	 <? } ?>
	 
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   <td>
     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=150px">     
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