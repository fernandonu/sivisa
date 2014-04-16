<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar']=='Guardar'){
	
		$query="insert into epi.triqui
			   	(id_triqui, id_denuncia, ape_pac, nom_pac, f_nacimiento,sexo,domicilio,localidad,departamento,dias_com,subito,insidioso,desc_clinica,terap_esp,primera_dosis,ultima_dosis,prev_diag, primer_diag, direc_fdiag,
			   	f_huddlesson,res_huddlesson, lab_huddlesson, f_tsinme,res_tsinme, lab_tsinme, f_tconme,res_tconme,lab_tconme,f_rbengala,res_rbengala,lab_rbengala,f_fcomplem, res_fcomplem,lab_fcomplem,f_pcombs,res_pcombs,lab_pcombs,
			   	dom_t, oc_previa,contacto_animal,esp_bovino,esp_cerdo,esp_cabras,esp_otros,vac_antibrucelosa,leche,leche_cruda,obs, lugart)
			   	values
			    (nextval('epi.triqui_id_triqui_seq'), '$id_denuncia','$ape_pac','$nom_pac', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', '$dias_com','$subito',
			    '$insidioso','$desc_clinica','$terap_esp','$primera_dosis','$ultima_dosis','$prev_diag','$primer_diag','$direc_fdiag','$f_huddlesson','$res_huddlesson','$lab_huddlesson',
			    '$f_tsinme','$res_tsinme','$lab_tsinme',
			    '$f_tconme','$res_tconme','$lab_tconme','$f_rbengala','$res_rbengala','$lab_rbengala','$f_fcomplem','$res_fcomplem','$lab_fcomplem','$f_pcombs','$res_pcombs','$lab_pcombs','$dom_t',
			    '$oc_previa','$contacto_animal','$esp_bovino','$esp_cerdo','$esp_cabras','$esp_otros','$vac_antibrucelosa','$leche','$leche_cruda','$obs','$lugart')";
				
			   sql($query, "Error al insertar t2") or fin_pagina();
			   $accion="Los datos se han guardado correctamente"; 
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.triqui
			where id_triqui='$id_triqui'";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

	
$sql_den="select id_triqui from epi.triqui where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_triqui=$res_den->fields['id_triqui'];

if($id_triqui){
			$q_bruc="select * from epi.triqui where id_denuncia=$id_denuncia";
			$res_bruc=sql($q_bruc, "Error consulta t2") or fin_pagina();
					$id_triqui=$res_bruc->fields['id_triqui'];
					$ape_pac=$res_bruc->fields['ape_pac'];
					$nom_pac=$res_bruc->fields['nom_pac'];
					$f_nacimiento=$res_bruc->fields['f_nacimiento'];
					$sexo=$res_bruc->fields['sexo'];
					$domicilio=$res_bruc->fields['domicilio'];
					$localidad=$res_bruc->fields['localidad'];
					$departamento=$res_bruc->fields['departamento'];
					$dias_com=$res_bruc->fields['dias_com'];
					$subito=$res_bruc->fields['subito'];
				    $insidioso=$res_bruc->fields['insidioso'];
				    $desc_clinica=$res_bruc->fields['desc_clinica'];
				    $terap_esp=$res_bruc->fields['terap_esp'];
				    $primera_dosis=$res_bruc->fields['primera_dosis'];
				    $ultima_dosis=$res_bruc->fields['ultima_dosis'];
				    $prev_diag=$res_bruc->fields['prev_diag'];
				    $primer_diag=$res_bruc->fields['primer_diag'];
				    $direc_fdiag=$res_bruc->fields['direc_fdiag'];
				    $f_huddlesson=$res_bruc->fields['f_huddlesson'];
				    $res_huddlesson=$res_bruc->fields['res_huddlesson'];
				    $lab_huddlesson=$res_bruc->fields['lab_huddlesson'];
				    $f_tsinme=$res_bruc->fields['f_tsinme'];
				    $res_tsinme=$res_bruc->fields['res_tsinme'];
				    $lab_tsinme=$res_bruc->fields['lab_tsinme'];
				    $f_tconme=$res_bruc->fields['f_tconme'];
				    $res_tconme=$res_bruc->fields['res_tconme'];
				    $lab_tconme=$res_bruc->fields['lab_tconme'];
				    $f_rbengala=$res_bruc->fields['f_rbengala'];
				    $res_rbengala=$res_bruc->fields['res_rbengala'];
				    $lab_rbengala=$res_bruc->fields['lab_rbengala'];
				    $f_fcomplem=$res_bruc->fields['f_fcomplem'];
				    $res_fcomplem=$res_bruc->fields['res_fcomplem'];
				    $lab_fcomplem=$res_bruc->fields['lab_fcomplem'];
				    $f_pcombs=$res_bruc->fields['f_pcombs'];
				    $res_pcombs=$res_bruc->fields['res_pcombs'];
				    $lab_pcombs=$res_bruc->fields['lab_pcombs'];
				    $dom_t=$res_bruc->fields['dom_t'];
				    $oc_previa=$res_bruc->fields['oc_previa'];
				    $contacto_animal=$res_bruc->fields['contacto_animal'];
				    $esp_bovino=$res_bruc->fields['esp_bovino'];
				    $esp_cerdo=$res_bruc->fields['esp_cerdo'];
				    $esp_cabras=$res_bruc->fields['esp_cabras'];
				    $esp_otros=$res_bruc->fields['esp_otros'];
				    $vac_antibrucelosa=$res_bruc->fields['vac_antibrucelosa'];
				    $leche=$res_bruc->fields['leche'];
				    $leche_cruda=$res_bruc->fields['leche_cruda'];	
					$obs=$res_bruc->fields['obs'];
					$lugart=$res_bruc->fields['lugart'];
}//fin $id_triqui

echo $html_header;
?>
<script>

//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){ 
	 if(document.all.ape_pac.value==""){
	  	alert('Debe ingresar el Apellido');
	  	document.all.ape_pac.focus();
	  	return false;
	 } 
	
 if (confirm('Esta Seguro que Desea Agregar Registro?'))return true;
	 else return false;	
}//de function control_nuevos()

</script>

<form name='form1' action='triqui.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_triqui?>" name="id_triqui">

<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_triqui) {
    	?>  
    	<font size=+1><b>Nueva Denuncia</b></font>   
    	<? }
        else {
        ?>
        <font size=+1><b>Dato</b></font>   
        <? } ?>
       
    </td>
 </tr>
<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="8">
       <b> TRIQUINOSIS </b>
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
	            <b> DATOS PERSONALES </b>
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
			<td align="right">
         	  <b> Telefono:</b>
             <input type="text" size="50" value="<?=$f_nacimiento;?>" name="f_nacimiento" >
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
              <input type="text" size="50" value="<?=$sexo;?>" name="sexo" >
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
              <input type="text" size="50" value="<?=$dias_com;?>" name="dias_com" >
            </td>
            <td align="left">
         	  <b>Ocupacion:</b>
              <input type="text" size="50" value="<?=$subito;?>" name="subito" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >
          <tr>
         	<td align="left">
         	  <b>Localidad:</b>
              <input type="text" size="50" value="<?=$insidioso;?>" name="insidioso" >
            </td>
            <td align="left">
         	  <b>Departamento:</b>
              <input type="text" size="50" value="<?=$desc_clinica;?>" name="desc_clinica" >
            </td>
          </tr>  
	 </table></div></td></tr>
	 
	 <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DATOS DEL ANIMAL</b>
	           </td>
	         </tr>
     </table></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >     
		<tr>
			<td align="right">
				<b>Tipo de Animal:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$terap_esp;?>" name="terap_esp" >
            </td>
            <td align="right">
				<b>Tipo de Crianza:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$primera_dosis;?>" name="primera_dosis" >
			</td> 
		</tr>
		<tr>
			 <td align="right">
				<b>Procedencia:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$ultima_dosis;?>" name="ultima_dosis" >
			</td>	
			<td align="right">
				<b>Domicilio:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$prev_diag;?>" name="prev_diag" >
            </td>
		<tr>
		</tr>
            <td align="right">
				<b>Localidad:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$primer_diag;?>" name="primer_diag" >
			</td> 
			 <td align="right">
				<b>Departamento:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$direc_fdiag;?>" name="direc_fdiag" >
			</td>
		</tr>
		</tr>
            <td align="right">
				<b>Telefono:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$f_huddlesson;?>" name="f_huddlesson" >
			</td> 
			 <td align="right">
				<b>Sintomas:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='res_huddlesson'><?=$res_huddlesson;?></textarea>
			</td>
		</tr>
		
		</tr>
            <td align="right">
				<b>Tratamiento:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='lab_huddlesson'><?=$lab_huddlesson;?></textarea>
			</td> 
			 <td align="right">
				<b>Observaciones:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='f_tsinme'><?=$f_tsinme;?></textarea>
			</td>
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>EXAMENES DE LABORATORIO</b>
	           </td>
	         </tr>
     </table></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >     
		</tr>
            <td align="right">
				<b>Fecha de Toma de Muestra:</b>
				</td>  
				<td align="left">
				<input type="text" size="40" value="<?=$res_tsinme;?>" name="res_tsinme" >
			</td> 
			 <td align="right">
				<b>Productos Analizados:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='lab_tsinme'><?=$lab_tsinme;?></textarea>
			</td>
		</tr>
		
		</tr>
            <td align="right">
				<b>Otros (especifique):</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='f_tconme'><?=$f_tconme;?></textarea>
			</td> 			 
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DATOS EXTRAS</b>
	           </td>
	         </tr>
     </table></td></tr>
	 
	 <tr><td colspan=9><div ><table width=95% align="left" >     
		</tr>
            <td align="right">
				<b>Otros Datos de Importacia:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='res_tconme'><?=$res_tconme;?></textarea>
			</td> 
			 <td align="right">
				<b>Acciones de Control:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='lab_tconme'><?=$lab_tconme;?></textarea>
			</td>
		</tr>
		
		</tr>
            <td align="right">
				<b>Observaciones:</b>
				</td>  
				<td align="left">
				<textarea cols='50' rows='5' name='f_rbengala'><?=$f_rbengala;?></textarea>
			</td> 			 
		</tr>		
	</table></div></td></tr>
	 
</table>           
<br>
<?if ($id_triqui){?>
<table class="bordes" align="center" width="100%">
		 <tr>
		    <td align="center">
		      <input type="submit" name="borrar" value="Borrar" style="width=130px" onclick="return confirm('Esta seguro que desea eliminar')" >
		    </td>
		 </tr> 
	 </table>	
	
	 <?}
	 else {?>
	  <tr><td><table width=100% align="center" class="bordes">
	 	<tr>
		    <td align="center">
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()" >&nbsp;&nbsp;
		    </td>
	  </table></td></tr>

	 
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
 </form>
 
 <?=fin_pagina();// aca termino ?>