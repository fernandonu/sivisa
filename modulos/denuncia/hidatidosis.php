<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
 $db->StartTrans();
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($f_sintoma!='')$f_sintoma=Fecha_db($f_sintoma);else $f_sintoma='1000-01-01';	
				if ($f_notificacion!='')$f_notificacion=Fecha_db($f_notificacion);else $f_notificacion='1000-01-01';			
		
			   $query="update epi.hidatidosis set
							ape_pac='$ape_pac',
							nom_pac='$nom_pac',
							f_nacimiento='$f_nacimiento',
							sexo='$sexo',
							domicilio='$domicilio',
							localidad='$localidad',
							departamento='$departamento',
							rural='$rural',
							domestica='$domestica',
							profesional='$profesional',
							otros='$otros',
							mn_unoh='$mn_unoh',
							mn_unom='$mn_unom',
							mna_qh='$mna_qh',
							mna_qm='$mna_qm',
							my_qh='$my_qh',
							my_qm='$my_qm',
							cant_perros='$cant_perros',
							p_comen='$p_comen',
							ovino='$ovino',
							bovino='$bovino',
							pocino='$pocino',
							equino='$equino',
							f_sintoma='$f_sintoma',
							descrip='$descrip',
							tmedico='$tmedico',
							tquirurgico='$tquirurgico',
							dd5='$dd5',
							contraief='$contraief',
							inmunoef='$inmunoef',
							ecografia='$ecografia',
							tac='$tac',
							f_notificacion='$f_notificacion',
							medidas='$medidas',
							obs='$obs
					where id_hidat=$id_hidat";
		
  $db->CompleteTrans();    
}//fin guardar_editart5

if ($_POST['guardart']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];	
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($f_sintoma!='')$f_sintoma=Fecha_db($f_sintoma);else $f_sintoma='1000-01-01';	
				if ($f_notificacion!='')$f_notificacion=Fecha_db($f_notificacion);else $f_notificacion='1000-01-01';
				
		$query="insert into epi.hidatidosis
					(id_hidat,id_denuncia,ape_pac,nom_pac,f_nacimiento,sexo,domicilio,localidad,departamento,rural,domestica,profesional,otros,mn_unoh,mn_unom,
					mna_qh,mna_qm,my_qh,my_qm,cant_perros,p_comen,ovino,bovino,pocino,equino,f_sintoma,descrip,tmedico,tquirurgico,
					dd5,contraief,inmunoef,ecografia,tac,f_notificacion,medidas,obs;
					)
					Values(nextval('epi.hidatidosis_id_hidat_seq'),'$id_denuncia',
					'$ape_pac','$nom_pac','$f_nacimiento','$sexo','$domicilio','$localidad','$departamento','$rural','$domestica','$profesional','$otros','$mn_unoh','$mn_unom',
					'$$mna_qh','$mna_qm','$my_qh','$my_qm','$cant_perros','$p_comen','$ovino','$bovino','$pocino','$equino','$f_sintoma','$descrip','$tmedico','$tquirurgico',
					'$$dd5','$contraief','$inmunoef','$ecografia','$tac','$f_notificacion','$medidas','$obs)";
		 sql($query, "Error al insertar t3") or fin_pagina();
		 $accion="Los datos se han guardado correctamente"; 
	
	     $db->CompleteTrans();
}//fin guardart5

if ($id_id_hidat) {
			
		$q_hid="SELECT DISTINCT *
					epi.hidatidosis 
					where epi.hidatidosis.id_denuncia = $id_denuncia
					ORDER BY
					epi.hidatidosis.id_hidat DESC";
			$res_hid=sql($q_hid, "Error consulta t2") or fin_pagina();
			if($res_hid->RecordCount()!=0){
					$id_hidat=$res_hid->fields['$id_hidat'];
					$ape_pac=$res_hid->fields['ape_pac'];
					$nom_pac=$res_hid->fields['nom_pac'];
					$f_nacimiento=fecha($res_hid->fields['f_nacimiento']);
					$sexo=$res_hid->fields['sexo'];
					$domicilio=$res_hid->fields['domicilio'];
					$localidad=$res_hid->fields['localidad'];
					$departamento=$res_hid->fields['departamento'];
					$rural=$res_hid->fields['departamento'];
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
					$f_sintoma=fecha($res_hid->fields['f_sintoma']);
					$descrip=$res_hid->fields['descrip'];
					$tmedico=$res_hid->fields['tmedico'];
					$tquirurgico=$res_hid->fields['tquirurgico'];
					$dd5=$res_hid->fields['dd5'];
					$contraief=$res_hid->fields['contraief'];
					$inmunoef=$res_hid->fields['inmunoef'];
					$ecografia=$res_hid->fields['ecografia'];
					$tac=$res_hid->fields['tac'];
					$f_notificacion=fecha($res_hid->fields['f_notificacion']);
					$medidas=$res_hid->fields['medidas'];
					$obs=$res_hid->fields['obs'];
			}	
}//fin id_denuncia

echo $html_header;
?>
<script>


//funciones para busqueda abreviada utilizando teclas en la lista que muestra los clientes.
var digitos=10; //cantidad de digitos buscados
var puntero=0;
var buffer=new Array(digitos); //declaraci�n del array Buffer
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
   event.returnValue = false; //invalida la acci�n de pulsado de tecla para evitar busqueda del primer caracter
}//de function buscar_op_submit(obj)

</script>

<form name='form1' action='den_ad.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
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

 <tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> Datos del Profesional Denunciante </b>
      </td>
     </tr>
     	<tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> N�mero del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    	</table></td></tr>	     
   
   <tr><td colspan=9><div ><table width=100% align="center" >
          <tr>
         	<td align="right">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$n_prof;?>" name="n_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$a_prof;?>" name="a_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
          </tr>  
	</table></div></td></tr> 
    <tr><td colspan=9><div><table width=75% align="center" >     
        <tr>
         	<td align="right">
         	  <b>DNI N�:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$dni_prof;?>" name="dni_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
         	  <b>Matricula N�:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$matricula;?>" name="matricula" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
				<b>Fecha de Notificacion:</b> 
			</td>         	
			<td align='left'>
				<input type=text id=fecha_notif name='fecha_notif' value='<?if($fecha_notif=="01/01/1000")echo""; else echo $fecha_notif;?>' size=15 title="Fecha de Notificacion">
				<?=link_calendario("fecha_notif");?>
			</td>
		 </tr>
	</table></div></td></tr>
	

       
<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
   		<? if($id_denuncia){ ?>
			      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		   <?}else {?>
			      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>
	


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