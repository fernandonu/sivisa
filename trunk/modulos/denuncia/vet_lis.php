<?php
require_once("../../config.php");

variables_form_busqueda("vet_lis");

$orden = array(
        "default" => "1",
        "1" => "nom_veterinaria",
        "2" => "localidad",
        "3" => "departamento"
       );
$filtro = array(
		"localidad" => "Localidad",
		"nom_veterinaria" => "Nombre Veterinaria",
		);
        
$sql_tmp="SELECT DISTINCT *
			FROM
			epi.veterinarias";

echo $html_header;

?>
<form name=form1 action="vet_lis.php" method=POST>
<table cellspacing=2 cellpadding=2 border=0 width=100% align=center>
     <tr>
      <td align=center>
		<?list($sql,$total_vet,$link_pagina,$up) = form_busqueda($sql_tmp,$orden,$filtro,$link_tmp,$where_tmp,"buscar");?>
	    &nbsp;&nbsp;<input type=submit name="buscar" value='Buscar'>
	    &nbsp;&nbsp;<input type='button' name="nuevo_vet" value='Nuevo' onclick="document.location='vet_ad.php'">
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
	    <td align=right id=mo><a id=mo href='<?=encode_link("vet_lis.php",array("sort"=>"1","up"=>$up))?>' >Razon Social</a></td>      	
	    <td align=right id=mo><a id=mo href='<?=encode_link("vet_lis.php",array("sort"=>"2","up"=>$up))?>' >Localidad</a></td>      	
	    <td align=right id=mo><a id=mo href='<?=encode_link("vet_lis.php",array("sort"=>"3","up"=>$up))?>' >Departamento</a></td>
	   
	    </tr>
  <?
   while (!$result->EOF) {
   		$ref = encode_link("vet_ad.php",array("id_veterinaria"=>$result->fields['id_veterinaria'],"pagina"=>"vet_lis"));		   		
    	$onclick_elegir="location.href='$ref'";
    	$id_veterinaria=$result->fields['id_veterinaria'];
   	?>
    <tr <?=atrib_tr()?>>
    
  
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['nom_veterinaria']?></td>
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['localidad']?></td>    
     <td onclick="<?=$onclick_elegir?>"><?=$result->fields['departamento']?></td> 

    </tr>    
	<?$result->MoveNext();
    }?>
</table>
<table>
</table>
</form>
<?echo fin_pagina();// aca termino ?>