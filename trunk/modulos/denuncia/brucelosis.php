<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
 $db->StartTrans();
 	$usuario=$_ses_user['name'];
		
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($primera_dosis!='')$primera_dosis=Fecha_db($primera_dosis);else $primera_dosis='1000-01-01';	
				if ($ultima_dosis!='')$ultima_dosis=Fecha_db($ultima_dosis);else $ultima_dosis='1000-01-01';	
				if ($primer_diag!='')$primer_diag=Fecha_db($primer_diag);else $primer_diag='1000-01-01';	
				if ($direc_fdiag!='')$direc_fdiag=Fecha_db($direc_fdiag);else $direc_fdiag='1000-01-01';	
				if ($f_huddlesson!='')$f_huddlesson=Fecha_db($f_huddlesson);else $f_huddlesson='1000-01-01';	
				if ($f_tsinme!='')$f_tsinme=Fecha_db($f_tsinme);else $f_tsinme='1000-01-01';	
				if ($f_tconme!='')$f_tconme=Fecha_db($f_tconme);else $f_tconme='1000-01-01';	
				if ($f_rbengala!='')$f_rbengala=Fecha_db($f_rbengala);else $f_rbengala='1000-01-01';	
				if ($f_fcomplem!='')$f_fcomplem=Fecha_db($f_fcomplem);else $f_fcomplem='1000-01-01';	
				if ($f_pcombs!='')$f_pcombs=Fecha_db($f_pcombs);else $f_pcombs='1000-01-01';	
				
			   $query="update epi.brucellosis set
							ape_pac='$ape_pac',
							nom_pac='$nom_pac',
							f_nacimiento='$f_nacimiento',
							sexo='$sexo',
							domicilio='$domicilio',
							localidad='$localidad',
							departamento='$departamento',
							dias_com='$dias_com',
							subito='$subito',
							insidioso='$insidioso',
							desc_clinica='$desc_clinica',
							terap_esp='$terap_esp',
							primera_dosis='$primera_dosis',
							ultima_dosis='$ultima_dosis',
							prev_diag='$prev_diag',
							primer_diag='$primer_diag', 
							direc_fdiag='$direc_fdiag',
						   	f_huddlesson='$f_huddlesson',
						   	res_huddlesson='$res_huddlesson', 
						   	lab_huddlesson='$lab_huddlesson', 
						   	f_tsinme='$f_tsinme',
						   	res_tsinme='$res_tsinme', 
						   	lab_tsinme='$lab_tsinme', 
						   	f_tconme='$f_tconme',
						   	res_tconme='$res_tconme',
						   	lab_tconme='$lab_tconme',
						   	f_rbengala='$f_rbengala',
						   	res_rbengala='$res_rbengala',
						   	lab_rbengala='$lab_rbengala',
						   	f_fcomplem='$f_fcomplem', 
						   	res_fcomplem='$res_fcomplem',
						   	lab_fcomplem='$lab_fcomplem',
						   	f_pcombs='$f_pcombs',
						   	res_pcombs='$res_pcombs',
						   	lab_pcombs='$lab_pcombs',
						   	dom_t='$dom_t', 
						   	oc_previa='$oc_previa',
						   	contacto_animal='$contacto_animal',
						   	esp_bovino='$esp_bovino',
						   	esp_cerdo='$esp_cerdo',
						   	esp_cabras='$esp_cabras',
						   	esp_otros='$esp_otros',
						   	vac_antibrucelosa='$vac_antibrucelosa',
						   	leche='$leche',
						   	leche_cruda='$leche_cruda',
							obs='$obs',
							lugart='$lugart'
					where id_bucelosis=$id_bucelosis";	
			
			   
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
		
  $db->CompleteTrans();    
}

if ($_POST['guardar']=='Guardar'){
	
				$f_nacimiento=Fecha_db($f_nacimiento);
	   			if ($primera_dosis!='')$primera_dosis=Fecha_db($primera_dosis);else $primera_dosis='1000-01-01';	
				if ($ultima_dosis!='')$ultima_dosis=Fecha_db($ultima_dosis);else $ultima_dosis='1000-01-01';	
				if ($primer_diag!='')$primer_diag=Fecha_db($primer_diag);else $primer_diag='1000-01-01';	
				if ($direc_fdiag!='')$direc_fdiag=Fecha_db($direc_fdiag);else $direc_fdiag='1000-01-01';	
				if ($f_huddlesson!='')$f_huddlesson=Fecha_db($f_huddlesson);else $f_huddlesson='1000-01-01';	
				if ($f_tsinme!='')$f_tsinme=Fecha_db($f_tsinme);else $f_tsinme='1000-01-01';	
				if ($f_tconme!='')$f_tconme=Fecha_db($f_tconme);else $f_tconme='1000-01-01';	
				if ($f_rbengala!='')$f_rbengala=Fecha_db($f_rbengala);else $f_rbengala='1000-01-01';	
				if ($f_fcomplem!='')$f_fcomplem=Fecha_db($f_fcomplem);else $f_fcomplem='1000-01-01';	
				if ($f_pcombs!='')$f_pcombs=Fecha_db($f_pcombs);else $f_pcombs='1000-01-01';	
				
		$query="insert into epi.brucellosis
			   	(id_bucelosis, id_denuncia, ape_pac, nom_pac, f_nacimiento,sexo,domicilio,localidad,departamento,dias_com,subito,insidioso,desc_clinica,terap_esp,primera_dosis,ultima_dosis,prev_diag, primer_diag, direc_fdiag,
			   	f_huddlesson,res_huddlesson, lab_huddlesson, f_tsinme,res_tsinme, lab_tsinme, f_tconme,res_tconme,lab_tconme,f_rbengala,res_rbengala,lab_rbengala,f_fcomplem, res_fcomplem,lab_fcomplem,f_pcombs,res_pcombs,lab_pcombs,
			   	dom_t, oc_previa,contacto_animal,esp_bovino,esp_cerdo,esp_cabras,esp_otros,vac_antibrucelosa,leche,leche_cruda,obs, lugart)
			   	values
			    (nextval('epi.brucellosis_id_bucelosis_seq'), '$id_denuncia','$ape_pac', '$a_prop', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', '$dias_com','$subito',
			    '$insidioso','$desc_clinica','$terap_esp','$primera_dosis','$ultima_dosis','$prev_diag','$primer_diag','$direc_fdiag','$f_huddlesson','$res_huddlesson','$lab_huddlesson',
			    '$f_tsinme','$res_tsinme','$lab_tsinme',
			    '$f_tconme','$res_tconme','$lab_tconme','$f_rbengala','$res_rbengala','$lab_rbengala','$f_fcomplem','$res_fcomplem','$lab_fcomplem','$f_pcombs','$res_pcombs','$lab_pcombs','$dom_t',
			    '$oc_previa','$contacto_animal','$esp_bovino','$esp_cerdo','$esp_cabras','$esp_otros','$vac_antibrucelosa','$leche','$leche_cruda','$obs','$lugart')";
				
			   sql($query, "Error al insertar t2") or fin_pagina();
			   $accion="Los datos se han guardado correctamente"; 
}	
if($$id_bucelosis){
			$q_bruc="SELECT DISTINCT *
					epi.brucellosis 
					where epi.brucellosis.id_denuncia = $id_denuncia
					ORDER BY
					epi.brucellosis.id_bucelosis DESC";
			$res_bruc=sql($q_bruc, "Error consulta t2") or fin_pagina();
			if($res_bruc->RecordCount()!=0){
				$id_bucelosis=$res_bruc->fields['id_bucelosis'];
					$ape_pac=$res_bruc->fields['ape_pac'];
					$nom_pac=$res_bruc->fields['nom_pac'];
					$f_nacimiento=fecha($res_bruc->fields['f_nacimiento']);
					$sexo=$res_bruc->fields['sexo'];
					$domicilio=$res_bruc->fields['domicilio'];
					$localidad=$res_bruc->fields['localidad'];
					$departamento=$res_bruc->fields['departamento'];
					$dias_com=$res_bruc->fields['dias_com'];
					$subito=$res_bruc->fields['subito'];
				    $insidioso=$res_bruc->fields['insidioso'];
				    $desc_clinica=$res_bruc->fields['desc_clinica'];
				    $terap_esp=$res_bruc->fields['terap_esp'];
				    $primera_dosis=fecha($res_bruc->fields['primera_dosis']);
				    $ultima_dosis=fecha($res_bruc->fields['ultima_dosis']);
				    $prev_diag=$res_bruc->fields['prev_diag'];
				    $primer_diag=fecha($res_bruc->fields['primer_diag']);
				    $direc_fdiag=fecha($res_bruc->fields['direc_fdiag']);
				    $f_huddlesson=fecha($res_bruc->fields['f_huddlesson']);
				    $res_huddlesson=$res_bruc->fields['res_huddlesson'];
				    $lab_huddlesson=$res_bruc->fields['lab_huddlesson'];
				    $f_tsinme=fecha($res_bruc->fields['f_tsinme']);
				    $res_tsinme=$res_bruc->fields['res_tsinme'];
				    $lab_tsinme=$res_bruc->fields['lab_tsinme'];
				    $f_tconme=fecha($res_bruc->fields['f_tconme']);
				    $res_tconme=$res_bruc->fields['res_tconme'];
				    $lab_tconme=$res_bruc->fields['lab_tconme'];
				    $f_rbengala=fecha($res_bruc->fields['f_rbengala']);
				    $res_rbengala=$res_bruc->fields['res_rbengala'];
				    $lab_rbengala=$res_bruc->fields['lab_rbengala'];
				    $f_fcomplem=fecha($res_bruc->fields['f_fcomplem']);
				    $res_fcomplem=$res_bruc->fields['res_fcomplem'];
				    $lab_fcomplem=$res_bruc->fields['lab_fcomplem'];
				    $f_pcombs=fecha($res_bruc->fields['f_pcombs']);
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
			}	
}//fin $id_bucelosis

echo $html_header;
?>
<script>

//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){ 
	 if(document.all.n_prof.value==""){
	  	alert('Debe ingresar el Nombre del Profesional');
	  	document.all.n_prof.focus();
	  	return false;
	 } 
	
 if (confirm('Esta Seguro que Desea Agregar Registro?'))return true;
	 else return false;	
}//de function control_nuevos()


/**********************************************************/
//funciones para busqueda abreviada utilizando teclas en la lista que muestra los clientes.
var digitos=10; //cantidad de digitos buscados
var puntero=0;
var buffer=new Array(digitos); //declaración del array Buffer
var cadena="";

function buscar_combo(obj)
{
   var letra = String.fromCharCode(event.keyCode)
   if(puntero >= digitos)
   {
       cadena="";
       puntero=0;
   }   
   //sino busco la cadena tipeada dentro del combo...
   else
   {
       buffer[puntero]=letra;
       //guardo en la posicion puntero la letra tipeada
       cadena=cadena+buffer[puntero]; //armo una cadena con los datos que van ingresando al array
       puntero++;

       //barro todas las opciones que contiene el combo y las comparo la cadena...
       //en el indice cero la opcion no es valida
       for (var opcombo=1;opcombo < obj.length;opcombo++){
          if(obj[opcombo].text.substr(0,puntero).toLowerCase()==cadena.toLowerCase()){
          obj.selectedIndex=opcombo;break;
          }
       }
    }//del else de if (event.keyCode == 13)
   event.returnValue = false; //invalida la acción de pulsado de tecla para evitar busqueda del primer caracter
}//de function buscar_op_submit(obj)

</script>

<form name='form1' action='den_ad.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_bucelosis?>" name="id_bucelosis">

<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_bucelosis) {
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
      <td id=mo colspan="2">
       <b> BRUCELOSIS </b>
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
   
	 <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>ENFERMEDAD ACTUAL </b>
	           </td>
	         </tr>
    	</table></td></tr>  
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Dias aproximados de comienzo:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$dias_com;?>" name="dias_com" <? if ($id_bucelosis) echo "disabled"?>>
            </td>
             <td align="left">
         	 <b>Subito:</b>
				<input type="checkbox" name="subito" value="S" >
			</td>
            <td align="left">
         	   <b>Insidioso:</b>
				<input type="checkbox" name="insidioso" value="S" >
            </td>
		 </tr>
	</table></div></td></tr> 
	 <tr><td colspan=9><div ><table width=95% align="left" >     
        	<tr>
               	<td align="right">	 
					<b>Breve descripcion Clinica:</b>
				</td> 
				<td align="left"> 
					<textarea cols='100' rows='4' name='desc_clinica'  <? if($id_bruc_can) echo "disabled"?>><?=$desc_clinica;?></textarea>
	            </td>
			</tr>
			 <tr><td colspan=9><div ><table width=95% align="left" >     
               	<td align="right">	 
					<b>Terapeutica especifica:</b>
				</td> 
				<td align="left"> 
					<textarea cols='50' rows='4' name='terap_esp'  <? if($id_bruc_can) echo "disabled"?>><?=$terap_esp;?></textarea>
	            </td>
	            <td align="right">
	         	  <b> Fecha 1º Dosis:</b>
	         	</td> 
				<td align="left">
	             <input type='text' name='primera_dosis' value='<?=$primera_dosis;?>' size=10 align='right' ></b>
	           </td>
	           <td align="right">
	         	  <b> Ultima Dosis:</b>
	         	</td> 
				<td align="left">
	             <input type='text' name='ultima_dosis' value='<?=$ultima_dosis;?>' size=10 align='right' ></b>
	           </td>
			</table></div></td></tr>		
	 </table></div></td></tr> 
	 <tr><td colspan=9><div ><table width=95% align="left" >        
	           <tr> 
            	<td align="right">
					<b>Ha sido este caso previamente diagnosticado:</b>
				</td>  
				<td align="left">
							<input type="radio" name="prev_diag" value="S" checked>Si
							<input type="radio" name="prev_diag" value="N">No
				</td>
				 <<td align="right">
	         	  <b> Fecha 1º diagnostico:</b>
	         	</td> 
				<td align="left">
	             <input type='text' name='primer_diag' value='<?=$primer_diag;?>' size=10 align='right' ></b>
	           </td>
	           
				</tr>
				<tr>
				<td align="right">	 
					<b>Direccion del paciente a la fecha del diagnostico:</b>
				</td> 
				<td align="left"> 
					<textarea cols='75' rows='2' name='terap_esp'  <? if($id_bruc_can) echo "disabled"?>><?=$terap_esp;?></textarea>
	            </td>
				</tr>
	</table></div></td></tr>		  
  
	
  <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DIAGNOSTICO DE LABORATORIO </b>
	           </td>
	         </tr>
  </table></td></tr>  
   <tr><td colspan=7><div ><table width="65%" align="center" border="1" > 		
   		<tr id=mo> 
		    <td align=right id=mo width="20%" >Tipo de Prueba</a></td>   
		    <td align=right id=mo><a id=mo >Fecha</a></td>      	
		    <td align=right id=mo><a id=mo >Resultado</a></td>  
		    <td align=right id=mo><a id=mo >Laboratorio</a></td>      	
	 	</tr>
   	
   		<tr>
   			<td id=me align="center" width="40%"><b>Huddlesson (con titulo)</b></td>
   			<td><input type="text" size="15" value="<?=$f_huddlesson;?>" name="f_huddlesson" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="40" value="<?=$res_huddlesson;?>" name="res_huddlesson" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="60" value="<?=$lab_huddlesson;?>" name="lab_huddlesson" <? if ($id_bucelosis) echo "disabled"?>></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="40%"><b>Prueba en Tubo- Sin 2 Me </b></td>
   			<td><input type="text" size="15" value="<?=$f_tsinme;?>" name="f_tsinme" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="40" value="<?=$res_tsinme;?>" name="res_tsinme" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="60" value="<?=$lab_tsinme;?>" name="lab_tsinme" <? if ($id_bucelosis) echo "disabled"?>></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="40%"><b>Prueba en Tubo- Con 2 Me </b></td>
   			<td><input type="text" size="15" value="<?=$f_tconme;?>" name="f_tconme" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="40" value="<?=$res_tconme;?>" name="res_tconme" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="60" value="<?=$lab_tconme;?>" name="lab_tconme" <? if ($id_bucelosis) echo "disabled"?>></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="40%"><b>Rosa Bengala </b></td>
   			<td><input type="text" size="15" value="<?=$f_rbengala;?>" name="f_rbengala" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="40" value="<?=$res_rbengala;?>" name="res_rbengala" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="60" value="<?=$lab_rbengala;?>" name="lab_rbengala" <? if ($id_bucelosis) echo "disabled"?>></td>
   		</tr>
		<tr>
   			<td id=me align="center" width="40%"><b>F. Complemento</b></td>
   			<td><input type="text" size="15" value="<?=$f_fcomplem;?>" name="f_fcomplem" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="40" value="<?=$res_fcomplem;?>" name="res_fcomplem" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="60" value="<?=$lab_fcomplem;?>" name="lab_fcomplem" <? if ($id_bucelosis) echo "disabled"?>></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="40%"><b>P. de Coombs</b></td>
   			<td><input type="text" size="15" value="<?=$f_pcombs;?>" name="f_pcombs" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="40" value="<?=$res_pcombs;?>" name="res_pcombs" <? if ($id_bucelosis) echo "disabled"?>></td>
   			<td><input type="text" size="60" value="<?=$lab_pcombs;?>" name="lab_pcombs" <? if ($id_bucelosis) echo "disabled"?>></td>
   		</tr>	 
	 </table></td></tr> 	
	
  <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            	<b>PROBABLE FUENTE DE INFECCION</b>
	           </td>
	      </tr>
  </table></td></tr>	 
<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>OCUPACION(Trabajo exacto, negocio o Industria al comienzo de la enfermedad):</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="65" value="<?=$lugart;?>" name="lugart" <? if ($id_bucelosis) echo "disabled"?>>
            </td>
            </tr>
   		<tr>
             <td align="left">
         	 	<b>Direccion del Trabajo:</b>
         	 </td>
             <td align="left">
				 <input type="text" size="65" value="<?=$dom_t;?>" name="dom_t" <? if ($id_bucelosis) echo "disabled"?>>
			</td>
		 </tr>
		 <tr>
             <td align="left">
         	 	<b>Cambio de ocupacion dentro de los 6 meses de comienzo, indicar ocupacion previa:</b>
         	 </td>
         	 <td align="left">
				 <input type="text" size="65" value="<?=$oc_previa;?>" name="oc_previa" <? if ($id_bucelosis) echo "disabled"?>>
			</td>
			 </tr>
		 <tr>
         	<td align="left">
         	 	<b>Contacto con animales dentro de los 6 meses anteriores a la fecha del comienzo:</b>
         	 </td>
             <td align="left">
					<input type="radio" name="contacto_animal" value="S" checked>Si 
					<input type="radio" name="contacto_animal" value="N">No
             		<input type="radio" name="contacto_animal" value="NS">No Sabe
              </td>
			</td>
		 </tr>
		 <tr>
		 <td align="left">
         	 	<b>Especificar tipo de animal y describir tipo de contacto, con fecha aproximada:</b>
         	 </td>
         	 <td align="left">
				<textarea cols='75' rows='4' name='obs'<? if($id_bucelosis) echo "disabled"?>><?=$obs;?></textarea>
			</td>
		 </tr>
</table></div></td></tr> 	 

	 

	 	
 </table>           
<br>
<?if ($id_bucelosis){?>
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
 </form>
 
 <?=fin_pagina();// aca termino ?>