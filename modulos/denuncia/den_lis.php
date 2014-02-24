<?php
require_once("../../config.php");

variables_form_busqueda("den_lis");

$orden = array(
        "default" => "1",
        "1" => "id_denuncia",
        "2" => "n_prof",
        "3" => "fecha_notif",
        "4"	=> "nom_veterinaria",
        "5" => "descripcion"
       );
$filtro = array(
		"a_prof" => "Apellido del Denunciante",
		"nom_veterinaria" => "Veterinaria",
		"descripcion"=> "Tipo Enfermedad"
		);
        
$sql_tmp="SELECT *
			FROM
			epi.denuncia
			INNER JOIN epi.veterinarias ON epi.denuncia.id_veterinaria = epi.veterinarias.id_veterinaria
			INNER JOIN epi.ficha_epi ON epi.denuncia.id_tabla = epi.ficha_epi.id_tabla";

echo $html_header;

?>
<form name=form1 action="den_lis.php" method=POST>
<table cellspacing=2 cellpadding=2 border=0 width=100% align=center>
     <tr>
      <td align=center>
		<?list($sql,$total_vet,$link_pagina,$up) = form_busqueda($sql_tmp,$orden,$filtro,$link_tmp,$where_tmp,"buscar");?>
	    &nbsp;&nbsp;<input type=submit name="buscar" value='Buscar'>
	    &nbsp;&nbsp;<input type='button' name="nuevo_vet" value='Nuevo' onclick="document.location='den_ad.php'">
	  </td>
     </tr>
</table>
<?

$result = sql($sql,"No se ejecuto en la consulta principal") or die;?>

<table border=0 width=80% cellspacing=2 cellpadding=2 bgcolor='<?=$bgcolor3?>' align=center>
	  <tr>
		  	<td colspan=12 align=left id=ma>
			     <table width=100%>
				      <tr id=ma>
					       <td width=30% align=left><b>Total:</b> <?=$total_vet?></td>       
					       <td width=40% align=right><?=$link_pagina?></td>
				      </tr>
			    </table>
		   </td>
	  </tr>
	  <tr> 
	    <td align=right id=mo><a id=mo href='<?=encode_link("den_lis.php",array("sort"=>"1","up"=>$up))?>' >Denuncia Nº</a></td>      	
	    <td align=right id=mo><a id=mo href='<?=encode_link("den_lis.php",array("sort"=>"2","up"=>$up))?>' >Denunciante</a></td>      	
	    <td align=right id=mo><a id=mo href='<?=encode_link("den_lis.php",array("sort"=>"3","up"=>$up))?>' >Fecha</a></td>
	   	<td align=right id=mo><a id=mo href='<?=encode_link("den_lis.php",array("sort"=>"4","up"=>$up))?>' >Veterinaria</a></td>
	    <td align=right id=mo><a id=mo href='<?=encode_link("den_lis.php",array("sort"=>"5","up"=>$up))?>' >Tipo</a></td>
	  </tr>
  <?
   while (!$result->EOF) {
   		$ref = encode_link("den_ad.php",array("id_denuncia"=>$result->fields['id_denuncia'],"id_tabla"=>$result->fields['id_tabla'],"pagina"=>"den_lis"));		   		
    	$onclick_elegir="location.href='$ref'";
    	$id_veterinaria=$result->fields['id_veterinaria'];
   	?>
    <tr <?=atrib_tr()?>>
    
  
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['id_denuncia']?></td>
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['n_prof'].', '.$result->fields['a_prof']?></td>    
     <td onclick="<?=$onclick_elegir?>"><?=fecha($result->fields['fecha_notif'])?></td> 
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['nom_veterinaria']?></td> 
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['descripcion']?></td> 
    </tr>    
	<?$result->MoveNext();
    }?>
</table>
<table>
</table>
</form>
<?echo fin_pagina();// aca termino ?>