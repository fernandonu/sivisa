<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();


if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];				
		$query="insert into epi.hidatidosis
					(id_hidat,id_denuncia,ape_pac,nom_pac,f_nacimiento,sexo,domicilio,localidad,departamento,rural,domestica,profesional,otros,mn_unoh,mn_unom,
					mna_qh,mna_qm,my_qh,my_qm,cant_perros,p_comen,ovino,bovino,pocino,equino,f_sintoma,descrip,tmedico,tquirurgico,
					dd5,contraief,inmunoef,ecografia,tac,f_notificacion,medidas,obs,dni_prof,edad)
					Values
					(nextval('epi.hidatidosis_id_hidat_seq'),'$id_denuncia',
					'$ape_pac','$nom_pac','$f_nacimiento','$sexo','$domicilio','$localidad','$departamento','$rural','$domestica','$profesional','$otros','$mn_unoh','$mn_unom',
					'$mna_qh','$mna_qm','$my_qh','$my_qm','$cant_perros','$p_comen','$ovino','$bovino','$pocino','$equino','$f_sintoma','$descrip','$tmedico','$tquirurgico',
					'$dd5','$contraief','$inmunoef','$ecografia','$tac','$f_notificacion','$medidas','$obs','$dni_prof','$edad')";
		 sql($query, "Error al insertar t3") or fin_pagina();
		 $accion="Los datos se han guardado correctamente"; 
	
	     $db->CompleteTrans();
}//fin guardart5

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.hidatidosis
			where id_hidat='$id_hidat'";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

$sql_den="select id_psita from epi.psitacosis where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_hidat=$res_den->fields['id_hidat'];

if ($id_hidat) {
			
		$q_hid="select * from epi.hidatidosis where id_denuncia=$id_denuncia";
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
	
 if (confirm('Confirma agregar datos?'))return true;
	 else return false;	
}//de function control_nuevos()

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

<form name='form1' action='hidatidosis.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_hidat?>" name="id_hidat">
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
       <b> Datos del Profesional Denunciante </b>
      </td>
     </tr>
     	<tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    	</table></td></tr>	     
   
   <tr><td colspan=9><div ><table width=100% align="center" >
          <tr>
         	<td align="right">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$nom_pac;?>" name="nom_pac" >
            </td>
            <td align="right">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$ape_pac;?>" name="ape_pac" >
            </td>
			<td align="right">
         	  <b>DNI Nº:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$dni_prof;?>" name="dni_prof" >
            </td>
          </tr>  
	</table></div></td></tr> 
    <tr><td colspan=9><div><table width=100% align="center" >     
        <tr>
         	<td align="right">
         	  <b>Edad:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$edad;?>" name="edad" >
            </td>
            <td align="right">
         	  <b>Sexo (M/F):</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="5" value="<?=$sexo;?>" name="sexo" >
            </td>
            <td align="right">
				<b>Fecha de Nacimiento:</b> 
			</td>         	
			<td align='left'>
				<input type=text id=fecha_notif name='f_nacimiento' value='<?=$f_nacimiento;?>' size=15 title="Fecha de Nacimiento">
			</td>
		 </tr>
	</table></div></td></tr>
	
    <tr><td colspan=9><div><table width=100% align="center" >     
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
    </table></div></td></tr>

	<tr><td colspan=9><div><table width=100% align="center" >  
       	<tr>
		 	<td align="left">
				<b>Departamento:</b>
         	
              <input type="text" size="20" value="<?=$departamento;?>" name="departamento" >
            </td>
		 <td align="left">
				<b>Ocupacion (Rural/Domestica/Profesional/Otros) detallar:</b>
         	
              <input type="text" size="40" value="<?=$rural;?>" name="rural" >
            </td>
		</tr>
	</table></div></td></tr>
	
	 <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>GRUPO FAMILIAR Y TENECIA DE PERROS</b>
	           </td>
	         </tr>
     </table></td></tr>
	
	<tr><td colspan=9><div><table width=100% align="center" >  
       	<tr>
		 	<td align="left">
				<b>Cant. Hombres Menores a 1 Año:</b>
				<input type="text" size="4" value="<?=$mn_unoh;?>" name="mn_unoh" >
            </td>
			<td align="left">
				<b>Cant. Mujeres Menores a 1 Año:</b>
				<input type="text" size="4" value="<?=$mn_unom;?>" name="mn_unom" >
            </td>
			<td align="left">
				<b>Cant. Hombres de 1 a 15 Años:</b>
				<input type="text" size="4" value="<?=$mna_qh;?>" name="mna_qh" >
            </td>
			<td align="left">
				<b>Cant. Mujeres de 1 a 15 Años:</b>
				<input type="text" size="4" value="<?=$mna_qm;?>" name="mna_qm" >
            </td>
		</tr>
	</table></div></td></tr>

	<tr><td colspan=9><div><table width=100% align="center" >  
       	<tr>
		 	<td align="left">
				<b>Cant. Hombres Mayores a 15 Años:</b>
				<input type="text" size="4" value="<?=$my_qh;?>" name="my_qh" >
            </td>
			<td align="left">
				<b>Cant. Mujeres Mayores a 15 Años:</b>
				<input type="text" size="4" value="<?=$my_qm;?>" name="my_qm" >
            </td>
			<td align="left">
				<b>Cant. Perros en el establecimiento:</b>
				<input type="text" size="4" value="<?=$cant_perros;?>" name="cant_perros" >
            </td>			
		</tr>
	</table></div></td></tr>

	<tr><td colspan=9><div><table width=100% align="center" >  
		<tr>
			<td align="left">
				<b>Estos Perros Comen? (detallar):</b>
				<input type="text" size="80" value="<?=$p_comen;?>" name="p_comen" >
            </td>
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>POBLACION ANIMAL</b>
	           </td>
	         </tr>
     </table></td></tr>
	 
	<tr><td colspan=9><div><table width=100% align="center" >  
	 	<tr>
			<td align="left">
				<b>Si es un establecimiento RURAL detallar tipos de animales:</b>
				<input type="text" size="130" value="<?=$ovino;?>" name="ovino" >
            </td>
		</tr>		
	</table></div></td></tr>
		
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DATOS DE LA ENFERMEDAD</b>
	           </td>
	         </tr>
     </table></td></tr>

	
	<tr><td colspan=9><div><table width=100% align="center" >  
       	<tr>
		 	<td align="left">
				<b>Fecha de primeros sintomas o Diagnostico:</b>
				<input type="text" size="10" value="<?=$f_sintoma;?>" name="f_sintoma" >
            </td>
			<td align="left">
				<b>Breve Descripción clínica:</b>
				<input type="text" size="100" value="<?=$descrip;?>" name="descrip" >
            </td>
		</tr>
		<tr>
			<td align="left">
				<b>Terapeutica Medica:</b>
				<input type="text" size="40" value="<?=$tmedico;?>" name="tmedico" >
            </td>
			<td align="left">
				<b>Terapeutica Quirurgica:</b>
				<input type="text" size="100" value="<?=$tquirurgico;?>" name="tquirurgico" >
            </td>
		</tr>
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>DIAGNOSTICO</b>
	           </td>
	         </tr>
     </table></td></tr>
	 
	 <tr><td colspan=9><div><table width=100% align="center" >  
       	<tr>
		 	<td align="left">
				<b>DD5:</b>
				<input type="text" size="25" value="<?=$dd5;?>" name="dd5" >
            </td>
			<td align="left">
				<b>Contrainmunoelectroforesis:</b>
				<input type="text" size="25" value="<?=$contraief;?>" name="contraief" >
            </td>
            <td align="left">
				<b>Inmunoectroforesis:</b>
				<input type="text" size="25" value="<?=$inmunoef;?>" name="inmunoef" >
            </td>
		</tr>
		<tr>
			<td align="left">
				<b>Imagenes ECO:</b>
				<input type="text" size="40" value="<?=$ecografia;?>" name="ecografia" >
            </td>
			<td align="left">
				<b>Imagenes TAC:</b>
				<input type="text" size="40" value="<?=$tac;?>" name="tac" >
            </td>
		</tr>
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b>NOTIFICACION</b>
	           </td>
	         </tr>
     </table></td></tr>
	
	<tr><td colspan=9><div><table width=100% align="center" >  
       	<tr>
		 	<td align="left">
				<b>Fecha Notificacion:</b>
				<input type="text" size="15" value="<?=$f_notificacion;?>" name="f_notificacion" >
            </td>
			<td align="left">
				<b>Medidas Adoptadas:</b>
				<input type="text" size="80" value="<?=$medidas;?>" name="medidas" >
            </td>
		</tr>
		<tr>
            <td align="left" colspan=4>
				<b>Observaciones:</b>
				<input type="text" size="140" value="<?=$obs;?>" name="obs" >
            </td>
		</tr>
	</table></div></td></tr>
       
<?if ($id_hidat){?>
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