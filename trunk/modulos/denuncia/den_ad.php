<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
 $db->StartTrans();
 	if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
 	$n_prof=strtoupper($n_prof);     
   	$a_prof=strtoupper($a_prof);
   	$matricula=strtoupper($matricula);
  	$fecha_notif=fecha_db($fecha_notif);
  $usuario=$_ses_user['name'];
   $query="update epi.denuncia set 
			n_prof='$n_prof',
			a_prof='$a_prof',
			matricula='$matricula',
			dni_prof='$dni_prof',
			fecha_notif='$fecha_notif',
			id_veterinaria='$id_denuncia',
			id_tabla=$id_tabla,
			f_carga=now(),
			usuario='$usuario'
		where id_denuncia=$id_denuncia";	

   
    sql($query, "Error actualizar la Denuncia") or fin_pagina();
    $accion="Los datos se actualizaron";  
  $db->CompleteTrans();    
}

if ($_POST['guardar']=='Guardar'){
	
	if ($id_denuncia) {
	   $accion="Los datos se han guardado correctamente IF "; 
	}else{
		if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
		$db->StartTrans();
	    $n_prof=strtoupper($n_prof);     
	    $a_prof=strtoupper($a_prof);
	    $matricula=strtoupper($matricula);
		$usuario=$_ses_user['name'];
	    
		$query="insert into epi.denuncia
			   	(id_denuncia, n_prof, a_prof, matricula, dni_prof, fecha_notif, id_veterinaria, id_tabla, f_carga, usuario)
			   	values
			    (nextval('epi.denuncia_id_denuncia_seq'), '$n_prof', '$a_prof', '$matricula', '$dni_prof', '$fecha_notif', '$id_veterinaria', '$id_tabla', now(), '$usuario')";
				
			   sql($query, "Error al insertar la Veterinaria") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
	    
	     $db->CompleteTrans();     
	}
}
/*------------------------- guardar o editar tabla nº 5 brucelosis canina-- t5------------------------*/
if ($_POST['guardar_editart5']=='Guardar'){
 $db->StartTrans();
 	$usuario=$_ses_user['name'];
		 if($id_tabla=5){
			 	if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
			 			   	
			   $query="update epi.brucel_can set 
						n_prop='$n_prop',
						a_prop='$a_prop',
						dom_prop='$dom_prop',
						telef='$telef',
						d_animal='$d_animal',
						d_epidemio='$d_epidemio',
						laboratorios=$laboratorios,
						f_carga=now(),
						usuario='$usuario'
					where id_bruc_can=$id_bruc_can";	
			
			   
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
		  
		}elseif ($id_tabla==1){
				$f_nacimiento=Fecha_db($f_nacimiento);	
				if ($f_psintoma!='')$f_psintoma=Fecha_db($f_psintomaotif);else $f_psintoma='1000-01-01';
				if ($f_internacion!='')$f_internacion=Fecha_db($f_internacion);else $f_internacion='1000-01-01';		
				if ($f_muestra!='')$f_muestra=Fecha_db($f_muestra);else $f_muestra='1000-01-01';	
				if ($f_notificacion!='')$f_notificacion=Fecha_db($f_notificacion);else $f_notificacion='1000-01-01';
				
		   		$query="update epi.leptospirosis set
						ape_pac='$ape_pac',
						nom_pac='$nom_pac',
						f_nacimiento='$f_nacimiento',
						sexo='$sexo',
						domicilio='$domicilio',
						localidad='$localidad',
						departamento='$departamento',
						trurales='$trurales',
						e_frogorifico='$e_frogorifico',
						obrero='$obrero',
						otro='$otro',
						f_psintoma='$f_psintoma',
						f_internacion='$f_internacion',
						f_muestra='$f_muestra',
						ictericia='$ictericia',
						cefalea='$cefalea',
						s_mengeo='$s_mengeo',
						iconjuntivalbilat='$iconjuntivalbilat',
						fiebre='$fiebre',
						mialgias='$mialgias',
						ers1hs='$ers1hs',
						leucositosis='$leucositosis',
						eutrofilia='$eutrofilia',
						uremia='$uremia',
						bili_direc='$bili_direc',
						tgp='$tgp',
						cpk='$cpk',
						a_domestico='$a_domestico',
						roedores='$roedores',
						rio_arroyo='$rio_arroyo',
						laguna='$laguna',
						alcantarilla='$alcantarilla',
						inundacion='$inundacion',
						f_notificacion='$f_notificacion',
						semana_epi='$semana_epi',
						esablecimiento='$esablecimiento',
						serologia='$serologia',
						positividad='$positividad',
						titulo='$titulo',
						aislamiento='$aislamiento',
						obs='$obs',
						desempleado='$desempleado'
				where id_leptosp=$id_leptosp";	
			
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
			    
		}elseif ($id_tabla==2){
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
							obs='$obs'
					where id_bucelosis=$id_bucelosis";	
			
			   
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
		}elseif ($id_tabla==3){//hidat
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
		
		
}elseif ($id_tabla==4){//lvcan
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($lab_fecha!='')$lab_fecha=Fecha_db($lab_fecha);else $lab_fecha='1000-01-01';	
	
			   $query="update epi.lvcan set
					raza='$raza',
					sexo='$sexo',
					color_m='$color_m',
					edad='$edad',
					nombre='$nombre',
					cri_flia='$cri_flia',
					calle='$calle',
					refugio='$refugio',
					importacion='$importacion',
					prov_nac='$prov_nac',
					callejero='$callejero',
					int_casa='$int_casa',
					gallinero='$gallinero',
					m_perros='$m_perros',
					cant='$cant',
					problema='$problema',
					lab_fecha='$lab_fecha',
					sangre='$sangre',
					suero='$suero',
					ganglio='$ganglio',
					piel='$piel',
					otro='$otro',
					parasitologico='$parasitologico',
					paras_res='$paras_res',
					serologico='$serologico',
					serol_res='$serol_res',
					molecular='$molecular',
					mol_res='$mol_res',
					nom_prop='$nom_prop',
					ape_prop='$ape_prop',
					dni_prop='$dni_prop',
					dom_prop='$dom_prop',
					nro_prop='$nro_prop',
					tel='$tel',
					loca_prop='$loca_prop',
					dep_prop='$dep_prop',
					prop_tenedor='$prop_tenedor
				where id_lvc=$id_lvc";
	}

  $db->CompleteTrans();    
}//fin guardar_editart5

if ($_POST['guardart5']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	if ($id_tabla==5 && !$id_bruc_can) {
		if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
	    	$n_prop=strtoupper($n_prop);     
		   	$a_prop=strtoupper($a_prop);
		   	$dom_prop=strtoupper($dom_prop);
		$query="insert into epi.brucel_can
			   	(id_bruc_can, id_denuncia, n_prop, a_prop, dom_prop, telef, d_animal, d_epidemio,laboratorios, f_carga, usuario)
			   	values
			    (nextval('epi.brucel_can_id_bruc_can_seq'), '$id_denuncia=$res_bruc->fields['ape_pac'];$n_prop', '$a_prop', '$dom_prop', '$telef', '$d_animal', '$d_epidemio', '$laboratorios', now(), '$usuario')";
				
			   sql($query, "Error al insertar t5") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
	         
	} elseif ($id_tabla==1 && !$id_leptosp){
		
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($f_psintoma!='')$f_psintoma=Fecha_db($f_psintomaotif);else $f_psintoma='1000-01-01';
				if ($f_internacion!='')$f_internacion=Fecha_db($f_internacion);else $f_internacion='1000-01-01';		
				if ($f_muestra!='')$f_muestra=Fecha_db($f_muestra);else $f_muestra='1000-01-01';	
				if ($f_notificacion!='')$f_notificacion=Fecha_db($f_notificacion);else $f_notificacion='1000-01-01';	
				
			$query="insert into epi.leptospirosis
			   	(id_leptosp, id_denuncia, ape_pac, nom_pac, f_nacimiento,sexo,domicilio,localidad,departamento,trurales,e_frogorifico,
				obrero,otro,f_psintoma,f_internacion,f_muestra,ictericia,cefalea,iconjuntivalbilat,fiebre,mialgias,ers1hs,leucositosis,eutrofilia,uremia',
				bili_direc,tgp,cpk,a_domestico,roedores,rio_arroyo,laguna,alcantarilla,inundacion,f_notificacion,semana_epi,esablecimiento,serologia,positividad,titulo,aislamiento,obs,desempleado)
			   	values
			    (nextval('epi.leptospirosis_id_leptosp_seq'), '$id_denuncia','$ape_pac', '$a_prop', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', 
			    '$trurales', '$e_frogorifico', '$obrero', '$otro', '$f_psintoma', 
			    '$f_internacion', '$f_muestra', '$ictericia', '$cefalea', '$iconjuntivalbilat', '$fiebre', '$mialgias', '$ers1hs', '$leucositosis', '$eutrofilia', '$uremia', 
			    '$bili_direc', '$tgp', '$cpk', '$a_domestico', '$roedores', '$rio_arroyo', '$laguna', '$alcantarilla', '$inundacion', '$f_notificacion', '$semana_epi', 
			    '$esablecimiento', '$serologia', '$positividad', '$titulo', '$aislamiento', '$obs', '$desempleado')";
				 
			   sql($query, "Error al insertar t1") or fin_pagina();	 
			   $accion="Los datos se han guardado correctamente"; 
			   
	} elseif ($id_tabla==2 && !$id_bucelosis){
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
			   	dom_t, oc_previa,contacto_animal,esp_bovino,esp_cerdo,esp_cabras,esp_otros,vac_antibrucelosa,leche,leche_cruda,obs)
			   	values
			    (nextval('epi.brucellosis_id_bucelosis_seq'), '$id_denuncia','$ape_pac', '$a_prop', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', '$dias_com','$subito',
			    '$insidioso','$desc_clinica','$terap_esp','$primera_dosis','$ultima_dosis','$prev_diag','$primer_diag','$direc_fdiag','$f_huddlesson','$res_huddlesson','$lab_huddlesson',
			    '$f_tsinme','$res_tsinme','$lab_tsinme',
			    '$f_tconme','$res_tconme','$lab_tconme','$f_rbengala','$res_rbengala','$lab_rbengala','$f_fcomplem','$res_fcomplem','$lab_fcomplem','$f_pcombs','$res_pcombs','$lab_pcombs','$dom_t',
			    '$oc_previa','$contacto_animal','$esp_bovino','$esp_cerdo','$esp_cabras','$esp_otros','$vac_antibrucelosa','$leche','$leche_cruda','$obs')";
				
			   sql($query, "Error al insertar t2") or fin_pagina();
			   $accion="Los datos se han guardado correctamente"; 
		
	} elseif ($id_tabla==3 && !$id_hidat){ 
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
		 
	} elseif ($id_tabla==4 && !$id_lvc){//lvcan
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($lab_fecha!='')$lab_fecha=Fecha_db($lab_fecha);else $lab_fecha='1000-01-01';	
		
		$query="insert into epi.lvcan
				(id_lvc,id_denuncia,usuario,fcarga,raza,sexo,color_m,edad,nombre,cri_flia,calle,refugio,importacion,prov_nac,callejero,int_casa,gallinero,
				m_perros,cant,problema,lab_fecha,sangre,suero,ganglio,piel,otro,parasitologico,paras_res,serologico,serol_res,molecular,mol_res,
				nom_prop,ape_prop,dni_prop,dom_prop,nro_prop,tel,loca_prop,dep_prop,prop_tenedor)
				values
				(nextval('epi.lvcan_id_lvc_seq'),'$id_denuncia','$usuario', now(),'$raza','$sexo','$color_m','$edad','$nombre','$cri_flia','$calle','$refugio','$importacion','$prov_nac',
				'$callejero','$int_casa','$gallinero',
				'$m_perros','$cant','$problema','$lab_fecha','$sangre','$suero','$ganglio','$piel','$otro','$parasitologico','$paras_res','$serologico','$serol_res','$molecular','$mol_res',
				'$nom_prop','$ape_prop','$dni_prop','$dom_prop','$nro_prop','$tel','$loca_prop','$dep_prop','$prop_tenedor')";
			sql($query, "Error al insertar t4") or fin_pagina();
		 	$accion="Los datos se han guardado correctamente"; 
		 
	}else $accion="Los datos se han guardado correctamente IF "; 
	
	     $db->CompleteTrans();
}//fin guardart5

if ($id_denuncia) {
			$query="SELECT DISTINCT *
						FROM
						epi.denuncia	
						INNER JOIN epi.ficha_epi ON epi.denuncia.id_tabla = epi.ficha_epi.id_tabla					
					  WHERE epi.denuncia.id_denuncia=$id_denuncia";

	$res_persona =sql($query, "Error consulta 01") or fin_pagina();
	if($res_persona->RecordCount()!=0){
		$n_prof=$res_persona->fields['n_prof'];
		$a_prof=$res_persona->fields['a_prof'];
		$matricula=$res_persona->fields['matricula'];
		$dni_prof=$res_persona->fields['dni_prof'];
		$fecha_notif=fecha($res_persona->fields['fecha_notif']);
		$id_veterinaria=$res_persona->fields['id_veterinaria'];
		$id_tabla=$res_persona->fields['id_tabla'];		
		$id_denuncia=$res_persona->fields['id_denuncia'];	
		$detalle=$res_persona->fields['descripcion'];	
		
		if($id_tabla==5){ // brucelosis canina
	
			$q_12="SELECT * FROM epi.denuncia
					INNER JOIN epi.brucel_can ON epi.denuncia.id_denuncia = epi.brucel_can.id_denuncia
				";
			$res_q12 =sql($q_12, "Error consulta t5") or fin_pagina();
			if($res_q12->RecordCount()!=0){
				$id_bruc_can==$res_q12->fields['id_bruc_can']; 
				$n_prop=$res_q12->fields['n_prop'];
				$a_prop=$res_q12->fields['a_prop'];
				$dom_prop=$res_q12->fields['dom_prop'];
				$telef=$res_q12->fields['telef'];
				$d_animal=$res_q12->fields['d_animal'];
				$d_epidemio=$res_q12->fields['d_epidemio'];
				$laboratorios=$res_q12->fields['laboratorios'];
			}
		}elseif ($id_tabla=1) {	//LEPTOSPIROSIS
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
					$eutrofilia=$res_lep->fields['eutrofilia'];
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
		}//fin if $res_lep
	}//elseif t1
	elseif ($id_tabla==2){//brucelosis
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
		
		}//recordconunt()
	}//elseif t2
	elseif ($id_tabla==3){//HIDATIDOSIS
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
		
		}//recordconunt()
		
	}//elseif t2
	elseif ($id_tabla==4){//Leismaisais lvc
		$q_lvc="SELECT DISTINCT *
					epi.brucellosis 
					where epi.brucellosis.id_denuncia = $id_denuncia
					ORDER BY
					epi.brucellosis.id_lvc DESC";
			$res_lvc=sql($q_lvc, "Error consulta t2") or fin_pagina();
			if($res_lvc->RecordCount()!=0){
					$id_lvc=$res_lvc->fields['id_lvc'];
					$raza=$res_lvc->fields['raza'];
					$sexo=$res_lvc->fields['sexo'];
					$color_m=$res_lvc->fields['color_m'];
					$edad=$res_lvc->fields['edad'];
					$nombre=$res_lvc->fields['nombre'];
					$cri_flia=$res_lvc->fields['cri_flia'];
					$calle=$res_lvc->fields['calle'];
					$refugio=$res_lvc->fields['refugio'];
					$importacion=$res_lvc->fields['importacion'];
					$prov_nac=$res_lvc->fields['prov_nac'];
					$callejero=$res_lvc->fields['callejero'];
					$int_casa=$res_lvc->fields['int_casa'];
					$gallinero=$res_lvc->fields['gallinero'];
					$m_perros=$res_lvc->fields['m_perros'];
					$cant=$res_lvc->fields['cant'];
					$problema=$res_lvc->fields['problema'];
					$lab_fecha=fecha($res_lvc->fields['lab_fecha']);
					$sangre=$res_lvc->fields['sangre'];
					$suero=$res_lvc->fields['suero'];
					$ganglio=$res_lvc->fields['ganglio'];
					$piel=$res_lvc->fields['piel'];
					$otro=$res_lvc->fields['otro'];
					$parasitologico=$res_lvc->fields['parasitologico'];
					$paras_res=$res_lvc->fields['paras_res'];
					$serologico=$res_lvc->fields['serologico'];
					$serol_res=$res_lvc->fields['serol_res'];
					$molecular=$res_lvc->fields['molecular'];
					$mol_res=$res_lvc->fields['mol_res'];
					$nom_prop=$res_lvc->fields['nom_prop'];
					$ape_prop=$res_lvc->fields['ape_prop'];
					$dni_prop=$res_lvc->fields['dni_prop'];
					$dom_prop=$res_lvc->fields['dom_prop'];
					$nro_prop=$res_lvc->fields['nro_prop'];
					$tel=$res_lvc->fields['tel'];
					$loca_prop=$res_lvc->fields['loca_prop'];
					$dep_prop=$res_lvc->fields['dep_prop'];
					$prop_tenedor=$res_lvc->fields['prop_tenedor'];
		
			}//recordconunt()
		}//elseif t2
  	}//fin $res_persona
}//fin id_denuncia

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
	 if(document.all.a_prof.value==""){
	  	alert('Debe ingresar Apellido');
	 	document.all.a_prof.focus();
		return false;
	 } 
	 if(document.all.matricula.value==""){
	  alert('Debe ingresar Matricula');
	  document.all.matricula.focus();
	  return false;
	 	} 
	 if(document.all.dni_prof.value==""){
	  alert('Debe ingresar Numero de documento');
	  document.all.dni_prof.focus();
	  return false; 
	 } 
	 if(document.all.fecha_notif.value==""){
	  alert('Debe ingresar Fecha');
	  document.all.fecha_notif.focus();
	  return false;
	 	} 
	 
	 if(document.all.id_veterinaria.value==-1 ){
		alert('Debe ingresar Veterinaria');
		document.all.id_veterinaria.focus();
		return false;
		}
	if(document.all.id_tabla.value==-1 ){
		alert('Debe ingresar Tipo de Ficha');
		document.all.id_tabla.focus();
		return false;
		}
 if (confirm('Esta Seguro que Desea Agregar Registro?'))return true;
	 else return false;	
}//de function control_nuevos()


function editar_campos(){	
	document.all.n_prof.disabled=false;
	document.all.a_prof.disabled=false;	
	document.all.matricula.disabled=false;
	document.all.dni_prof.disabled=false;
	document.all.id_veterinaria.disabled=false;
	document.all.id_tabla.disabled=false;

	document.all.guardar_editar.disabled=false;
	document.all.cancelar_editar.disabled=false;
	document.all.borrar.disabled=false;
	return true;
}
//de function control_nuevos()
//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevost5(){ 

	if(document.all.id_tabla.value==5 ){
		 if(document.all.n_prop.value==""){
		  	alert('Debe ingresar el Nombre');
		  	document.all.n_prop.focus();
		  	return false;
		 } 
		 if(document.all.a_prop.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.a_prop.focus();
			return false;
		 } 
		 if(document.all.dom_prop.value==""){
		  alert('Debe ingresar Matricula');
		  document.all.dom_prop.focus();
		  return false;
		 	} 
		 if(document.all.d_animal.value==""){
		  alert('Debe ingresar Numero de documento');
		  document.all.d_animal.focus();
		  return false; 
		 } 
		 if(document.all.d_epidemio.value==""){
		  alert('Debe ingresar Fecha');
		  document.all.d_epidemio.focus();
		  return false;
		 	} 
		 
		 if(document.all.laboratorios.value==-1 ){
			alert('Debe ingresar Veterinaria');
			document.all.laboratorios.focus();
			return false;
			}
	}


 if (confirm('Confirma agregar datos de la denuncia?'))return true;
	 else return false;	
}//de function control_nuevos()


function editar_campost5(){	
	document.all.n_prop.disabled=false;
	document.all.a_prop.disabled=false;	
	document.all.dom_prop.disabled=false;
	document.all.telef.disabled=false;
	document.all.d_animal.disabled=false;
	document.all.d_epidemio.disabled=false;
	document.all.laboratorios.disabled=false;

	document.all.guardar_editar.disabled=false;
	document.all.cancelar_editar.disabled=false;
	document.all.borrar.disabled=false;
	return true;
}
//de function control_nuevos()

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
         	  <b>DNI Nº:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$dni_prof;?>" name="dni_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
         	  <b>Matricula Nº:</b>
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
	<tr><td colspan=9><div ><table width=100% align="center" >     
		<tr>
	          	<td align="right">
					<b>Veterinaria:</b>
				</td>
				<td align='left'>
            		<select name=id_veterinaria Style="width=757px" <?if ($id_denuncia) echo 'disabled'?>>
							<option value=-1>Seleccione</option>
							<?$query10="SELECT DISTINCT *
										FROM epi.veterinarias
										ORDER BY
										epi.veterinarias.localidad ASC,
										epi.veterinarias.nom_veterinaria ASC";
								$res_10=sql($query10,"Error en consulta Nº 2");?>	
							 <? while (!$res_10->EOF){
									$id_veterinaria_temp=$res_10->fields['id_veterinaria'];
									$nom_veterinaria=$res_10->fields['localidad']." - ".$res_10->fields['nom_veterinaria'] ;?>
									<option value='<?=$id_veterinaria_temp?>' <? if(trim($id_veterinaria_temp)==trim($id_veterinaria))echo "selected"?>><?=$nom_veterinaria?></option>
									<?$res_10->movenext();
								}?>
					</select>
            	</td>
		 </tr>
		 <tr>
          <td align="right">
				<b>Tipo de Ficha:</b>
			</td>
			<td align='left'>
             <select name=id_tabla Style="width=757px" <?if ($id_denuncia) echo 'disabled'?>>
							<option value=-1>Seleccione</option>
							<?$query10="SELECT DISTINCT *
										FROM
										epi.ficha_epi
										ORDER BY
										epi.ficha_epi.descripcion ASC";
								$res_10=sql($query10,"Error en consulta Nº 2");?>	
							 <? while (!$res_10->EOF){
									$id_tabla_temp=$res_10->fields['id_tabla'];
									$descripcion=$res_10->fields['descripcion'];?>
									<option value='<?=$id_tabla_temp?>' <? if(trim($id_tabla_temp)==trim($id_tabla))echo "selected"?>><?=$descripcion?></option>
									<?$res_10->movenext();
								}?>
					</select>
            </td>
		 </tr>
	  <tr>
         
	</table></div></td></tr> 

       
<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
   		<? if($id_denuncia){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campos()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>	

<? if($id_tabla==5){//brucelosos canina
	?>
<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> FICHA DE <?=$detalle; ?> </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> DATOS DEL PROPIETARIO </b>
	           </td>
	         </tr>
    	</table></td></tr>	 
   <tr><td colspan=9><div ><table width=55% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$n_prop;?>" name="n_prop" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$a_prop;?>" name="a_prop" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
          </tr>  
	   </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="75" value="<?=$dom_prop;?>" name="dom_prop" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$telef;?>" name="telef" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >     
        <tr>
         	<td align="left">
				<b>Datos del Animal:</b>
			</td>         	
			<td align='left'>
			      <textarea cols='100' rows='4' name='d_animal'  <? if($id_bruc_can) echo "disabled"?>><?=$d_animal;?></textarea>
			</td>
		</tr>
		</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_bruc_can) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_bruc_can) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	


<table width=100% align="center" class="bordes">
 <? }//fin if $idtabla ?>  

 
<? if($id_tabla==1){//leptospirosis	?>
<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> FICHA DE LEPTOSPIROSIS <?=$id_leptosp;?> </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> DATOS DEL PACIENTE </b>
	           </td>
	         </tr>
    	</table></td></tr>	 
   <tr><td colspan=9><div ><table width=75% align="left" >
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
	 <tr><td colspan=9><div ><table width=75% align="left" >     
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
            </td>
		 </tr>
	</table></div></td></tr>	    
	  <tr><td colspan=9><div ><table width=75% align="left" >     
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
   
	<tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
               	<td align="left">
					<b>Ocupacion: Tareas Rurales:</b>
				
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
   
	<tr><td colspan=9><div ><table width=75% align="left" >     
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
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_leptosp) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_leptosp) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	


<table width=100% align="center" class="bordes">
 <? }//fin if $idtabla 
	if($id_tabla==1 || $id_tabla==2 ||$id_tabla==3 || $id_tabla==4 || $id_tabla==5){?>
 
 <table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
	   
   		<? 
   		 if($id_bruc_can || $id_lvc || $id_bucelosis || $id_hidat || $id_leptosp){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campost5()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editart5" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardart5" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>	
<? }//if por ninguna ?>
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