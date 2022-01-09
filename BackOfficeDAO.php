<?php

include("../Clases/Conexion/ClaseConexion.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class BackOfficeDAO
{

 	//	C	O	N	S	T	R	U	C	T	O	R	
	
	function BackOfficeDAO(){}
	
 	//	C	O	N	S	T	R	U	C	T	O	R
					

	function BusquedaPorCodigo($oLibros)
	{
		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

		$codigoLibro = $oLibros->getCodigoLibros();

		$selectIndex = "select cod_obr, aut_obr, tit1_obr, tit2_obr, ano_obr, pag_obr, tem1_obr, tem2_obr, tem3_obr, tem4_obr, can1_obr, can4_obr from obra where cod_obr = ".$codigoLibro;

		 foreach ($dbh->query($selectIndex) as $row)
		{
					$arregloCodigos[] = $row['cod_obr'];
					$arregloTitulos[] = $row['tit1_obr'].$row['tit2_obr'];
					$arregloAutores[] = $row['aut_obr'];
					$arregloAnos[] = $row['ano_obr'];
					$arregloPaginas[] = $row['pag_obr'];
					$arregloHuerfanos[] = $row['can4_obr'];
					$arregloMerced[] = $row['can1_obr'];
					$arregloTemas[] = $row['tem1_obr'].'-'.$row['tem2_obr'].'-'.$row['tem3_obr'].'-'.$row['tem4_obr'];
		}
/*
		$oLibros->setCodigoLibros($arregloCodigos);
		$oLibros->setTitulo($arregloTitulos);
		$oLibros->setAutor($arregloAutores);
		$oLibros->setAnos($arregloAnos);
		$oLibros->setPaginas($arregloPaginas);
		$oLibros->setLocal($arregloLocal);
		$oLibros->setTemas($arregloTemas);*/
		
	}


	
	function ConsultaIndexDinamico($tema, $param) 
	{
	$Conexion = new ClaseConexion();
	$dbh = $Conexion->realizarConexion();

	$arregloTitulos = array();
	$arregloAutores = array();
	$arregloCodigos = array();
	$arregloApaisado = array();
	$arregloNovedad = array();
	
			
			
	$selectIndex = "SELECT obra.COD_OBR, obra.TIT1_OBR, obra.AUT_OBR, obra.TEM1_OBR,
									obra.TEM2_OBR, obra.TEM3_OBR, obra.TEM4_OBR, obra.TEM5_OBR,
									obra.TEM6_OBR, obra.TEM7_OBR, obra.TEM8_OBR, obra.TEM9_OBR,
									obra.TEM10_OBR, obra.TEM11_OBR, obra.TEM12_OBR, obra.TEM0_OBR,
									obra.TEM_OBR, obra.ANO_OBR
						FROM obra
						INNER JOIN codigo
								WHERE obra.TEM".$param."_OBR = codigo.COD_COD
									AND obra.AGO_OBR <> 'S'
									AND obra.AGO_OBR <> 'D'
									AND obra.TEM".$param."_OBR = ".$tema."
									ORDER BY COD_OBR";
			 
		 foreach ($dbh->query($selectIndex) as $row)
		{
					$arregloCodigos[] = $row['COD_OBR'];
					$arregloTitulos[] = $row['TIT1_OBR'];
					$arregloAutores[] = $row['AUT_OBR'];
					$arregloApaisado[] = 	$row['TEM1_OBR'].'-'.$row['TEM2_OBR'].
													'-'.$row['TEM3_OBR'].
													'-'.$row['TEM4_OBR'].'-'.$row['TEM5_OBR'].
													'-'.$row['TEM6_OBR'].'-'.$row['TEM7_OBR'].
													'-'.$row['TEM8_OBR'].'-'.$row['TEM9_OBR'].
													'-'.$row['TEM10_OBR'].'-'.$row['TEM11_OBR'].
													'-'.$row['TEM12_OBR'].'-'.$row['TEM_OBR']
													.'-'.$row['TEM0_OBR'];
		}
 
	$oLibros = new LibrosTO();

	$oLibros->setImagenes($arregloCodigos);
	
	$arregloImagenes = $oLibros->getArregloImagenes();

	$oLibros->setTitulo($arregloTitulos);
	$oLibros->setAutor($arregloAutores);
	$oLibros->setCodigoLibros($arregloCodigos);
	$oLibros->setImagenes($arregloCodigos);
	$oLibros->setApaisado($arregloApaisado);

	return $oLibros;
	}

	function ConsultaIndexGEN($tema) 
	{
	$Conexion = new ClaseConexion();
	$dbh = $Conexion->realizarConexion();

	$arregloTitulos = array();
	$arregloAutores = array();
	$arregloCodigos = array();
	$arregloApaisado = array();
	$arregloNovedad = array();
				
	for($i=0; $i < 5; $i++)
	{
			$selectIndex = "select obra.COD_OBR, codigo.DES_COD, obra.AUT_OBR ,obra.TIT1_OBR, obra.TIT2_OBR, obra.TEM1_OBR, obra.TEM1_OBR, obra.TEM2_OBR, obra.TEM3_OBR, obra.TEM4_OBR, obra.TEM5_OBR, obra.TEM6_OBR, obra.TEM7_OBR, obra.TEM8_OBR, obra.TEM9_OBR,  obra.TEM10_OBR, obra.TEM11_OBR, obra.TEM12_OBR, obra.TEM0_OBR, obra.TEM_OBR, obra.ANO_OBR, obra.VTA_OBR
								from codigo, blockes, obra
									where codigo.BLK_COD = blockes.COD_BLK
									and codigo.COD_COD = obra.TEM".$i."_OBR
									and blockes.COD_BLK = ".$tema."
									and VTA_OBR > 0
									order by ANO_OBR ASC  ";
									
 			 
					 foreach ($dbh->query($selectIndex) as $row)
					{
								$arregloCodigos[] = $row['COD_OBR'];
								$arregloTitulos[] = $row['TIT1_OBR'].$row['TIT2_OBR'];
								$arregloAutores[] = $row['AUT_OBR'];				
								$arregloApaisado[] = 	$row['TEM1_OBR'].'-'.$row['TEM2_OBR'].
																'-'.$row['TEM3_OBR'].
																'-'.$row['TEM4_OBR'].'-'.$row['TEM5_OBR'].
																'-'.$row['TEM6_OBR'].'-'.$row['TEM7_OBR'].
																'-'.$row['TEM8_OBR'].'-'.$row['TEM9_OBR'].
																'-'.$row['TEM10_OBR'].'-'.$row['TEM11_OBR'].
																'-'.$row['TEM12_OBR'].'-'.$row['TEM_OBR']
																.'-'.$row['TEM0_OBR'];
					}

	}
	
	$oLibros = new LibrosTO();

	$oLibros->setImagenes($arregloCodigos);
	
	$arregloImagenes = $oLibros->getArregloImagenes();



	$oLibros->setTitulo($arregloTitulos);
	$oLibros->setAutor($arregloAutores);
	$oLibros->setCodigoLibros($arregloCodigos);
	$oLibros->setImagenes($arregloCodigos);
	$oLibros->setApaisado($arregloApaisado);
	$oLibros->setImagenes($arregloImagenes);

	$oLibros->setTemas($arregloCodigos, $arregloApaisado);

	return $oLibros;
	}


function ConsultaCategorias($tema) 
	{
	$Conexion = new ClaseConexion();
	$dbh = $Conexion->realizarConexion();

	$arregloTitulos = array();
	$arregloAutores = array();
	$arregloCodigos = array();
	$arregloApaisado = array();
	$arregloNovedad = array();
				
	
			$selectIndex = "select obra.AGO_OBR, obra.COD_OBR, obra.TIT1_OBR, obra.TIT2_OBR, obra.AUT_OBR 
								from obra
									where obra.AGO_OBR = '".$tema."'
									order by COD_OBR ASC";
									
 			 
					 foreach ($dbh->query($selectIndex) as $row)
					{
								$arregloCodigos[] = $row['COD_OBR'];
								$arregloTitulos[] = $row['TIT1_OBR'].$row['TIT2_OBR'];
								$arregloAutores[] = $row['AUT_OBR'];				
								$arregloCategoria[] = $row['AGO_OBR'];
					}


	
	$oLibros = new LibrosTO();

	$oLibros->setImagenes($arregloCodigos);
	
	$arregloImagenes = $oLibros->getArregloImagenes();



	$oLibros->setTitulo($arregloTitulos);
	$oLibros->setAutor($arregloAutores);
	$oLibros->setCodigoLibros($arregloCodigos);
	$oLibros->setCategoria($arregloCategoria);

	return $oLibros;
	}


	function InsertIndexDinamico($oLibros, $indiceID)
	{
		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

		$arregloAux = $oLibros->getCodigoLibros();

		for($i = 0; $i < sizeof($oLibros->getCodigoLibros());$i++)
		{
			 
			$insertTablaIndice = 'INSERT INTO indice (
														INDICE_ID,
														COD_OBR)
														VALUES
														('.$indiceID.',
														'.$arregloAux[$i].')';
		echo $insertTablaIndice.';<br>';
 		}

	}

	function getTodasLosTemas(){

		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

		$consulta = "select * from codigo where des_cod like '%' ";


		
		
		 foreach ($dbh->query($consulta) as $row)
		{
			echo'<option value="'.$row['COD_COD'].'">'.$row['DES_COD'].'</option>';
		}

}

	function getTodasLosTemasGlobales(){

		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

		$consulta = "select * from blockes where des_blk like '%' ";

 	echo "<table class='menu'>";
	
		
		 foreach ($dbh->query($consulta) as $row)
		{
			echo "<tr>";
			echo '<td class = "miclase"><a href="getuser.php?q='.$row['COD_BLK'].'">'.$row['DES_BLK'].'</a></td>';
			echo "</tr>"; 
			  
		}
		
		echo "</table>";

}


		function getTemaGlobal($tema)
		{
			$Conexion = new ClaseConexion();
			$dbh = $Conexion->realizarConexion();

			$consulta = "select des_blk from blockes where cod_blk =  ".$tema;

			foreach ($dbh->query($consulta) as $row)
			{
			$var = $row['DES_BLK'];  
			}

			return $var;

		}

		function selectLibros ($id)
		{
			echo "soy id = ".$id;
			$Conexion = new ClaseConexion();
			$dbh = $Conexion->realizarConexion();

			$consulta = "select * from obra, codigo where obra.COD_OBR = codigo.COD_COD and codigo.COD_COD = ".$id."";

			$query = $dbh->query($consulta);

			$result = $query->fetchAll();
		return $result;

}


function updateDescripcion($nuevaDescripcion, $lCodigoLibro)
{
			$Conexion = new ClaseConexion();
			$dbh = $Conexion->realizarConexion();

			$select = "select cod_libro from libros_importada_de_txt where cod_libro = ".$lCodigoLibro;

			$fecha = date('Y-m-d');
			
			foreach ($dbh->query($select) as $row)
			{
				$cod = $row['cod_libro'];
			}

			if(isset($cod))
			{
					$updateDescripcion = "UPDATE `libros_importada_de_txt` SET `descripcion`= '".$nuevaDescripcion."' WHERE cod_libro = ".$lCodigoLibro;
					$result = $dbh->query($updateDescripcion);			
			}
			else
			{
					$insertDescripcion = "INSERT INTO `libros_importada_de_txt`(`fecha_ingreso`, `cod_libro`, `descripcion`) VALUES ('".$fecha."',".$lCodigoLibro.",'".$nuevaDescripcion."')";
 					$result = $dbh->query($insertDescripcion);

			}
					
			

			return $result;
	}

		
	function autocompleteCodigos($oLibros)
	{
		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();
		$dao = new BackOfficeDAO();

		$term = $oLibros->getCodigo();
  
		$qstring = "SELECT COD_OBR as value, AUT_OBR, VTA_OBR, CAN1_OBR, CAN4_OBR, TIT1_OBR, TIT2_OBR, TEM1_OBR, TEM2_OBR, TEM3_OBR, TEM4_OBR, TEM5_OBR, TEM6_OBR, TEM7_OBR, TEM8_OBR, TEM9_OBR, TEM10_OBR, TEM11_OBR, TEM12_OBR, TEM0_OBR, TEM_OBR,
		AGO_OBR,  ANO_OBR, PAG_OBR, ENC_OBR
		FROM obra WHERE COD_OBR LIKE '".$term."%'
		ORDER BY COD_OBR ASC";

		$otrastring = "SELECT descripcion FROM libros_importada_de_txt WHERE cod_libro= ".$term;
			
			foreach ($dbh->query($qstring) as $row)
			{
				$result['value']=(int)$row['value'];

				$titulo = $row['TIT1_OBR'].$row['TIT2_OBR'];
				$autor = $row['AUT_OBR'];
				$temas = $row['TEM1_OBR'].'-'.$row['TEM2_OBR'].'-'.$row['TEM3_OBR'].'-'.$row['TEM4_OBR'].'-'.$row['TEM5_OBR'].'-'.$row['TEM6_OBR'].'-'.$row['TEM7_OBR'].'-'.$row['TEM8_OBR'].'-'.$row['TEM9_OBR'].'-'.$row['TEM10_OBR'].'-'.$row['TEM11_OBR'].'-'.$row['TEM12_OBR'].'-'.$row['TEM0_OBR'].'-'.$row['TEM_OBR'];

				$oLibros->setCodigo($row['value']);
				$oLibros->setTitulo1($titulo);
				$oLibros->setAutor1($autor);
				$oLibros->setImagen($result['value']);
				$oLibros->setApaisado1($temas);
				$oLibros->setTemas1($row['value'], $temas);
				$oLibros->setLocalVenta($row['CAN1_OBR'], $row['CAN4_OBR']);
				$oLibros->setPrecio($row['VTA_OBR']);
				$oLibros->setFicha($result['value']);
				
 
				
				$result['value'] = $oLibros->getCodigo();
				$result['titulo'] = $oLibros->getTitulo();
				$result['autor'] = $oLibros->getAutor();
				$result['value'] = $oLibros->getCodigo();
				$result['temas'] = $dao->buscarTemas1($oLibros->getCodigo(), $oLibros->getTemas());
 				$result['imagen'] = $oLibros->getImagen1();
				$result['apaisado'] = $oLibros->getApaisado();
				$result['localVenta'] = $oLibros->getLocalVenta();
				$result['precio'] = $oLibros->getPrecio();
				$result['ficha'] = $oLibros->getFicha();

				$result['estado'] = $row['AGO_OBR'];
				$result['anio'] = $row['ANO_OBR'];
				$result['paginas'] = $row['PAG_OBR'];
				$result['encuadernacion'] = $row['ENC_OBR'];

			foreach ($dbh->query($otrastring) as $row)
			{
				if($row['descripcion'])
				{
					$result['descripcion'] = $row['descripcion'];
				}
			}


				$row_set[] = $result; 

			}


			if(isset($result['titulo']))
			{
				$var = $row_set; 

			}
			else
			{
				$result['value'] = $oLibros->getCodigo();
				$result['titulo'] = 'Producto no existe';
				$result['autor'] = '';
				$result['temas'] = '';
				$result['imagen'] = '';
				$result['apaisado'][0] = '0';
				$result['apaisado'][1] = '0';
				$result['localVenta'][0] = '';
				$result['localVenta'][1] = '';
				$result['precio'] = '0';
				$result['ficha'] = '';

				$result['estado'] = '';
				$result['anio'] = '';
				$result['paginas'] = '';
				$result['encuadernacion'] = '';

				$row_set[] = $result;
				$var = $row_set;
			}
		
		
		return $var;
	}

function limpiar_caracteres_especiales($var) {

	for($i=0; $i < sizeof($var['data']); $i++)
		{
			for($j=1; $j < 3; $j++)
			{
				$var['data'][$i][$j] = utf8_decode($var['data'][$i][$j]);
				if($j==1){$var['data'][$i][$j] = str_replace("?","N", $var['data'][$i][$j]);break;}
				if($j==2){$var['data'][$i][$j] = str_replace("?","n", $var['data'][$i][$j]);break;}
			}
		}

		return $var;
}

	function formatPrecio($var)
	{
		for($i=0; $i < sizeof($var['data']); $i++)
			{
				for($j=3; $j < 4; $j++)
				{
					if($j==3){$var['data'][$i][$j] = number_format($var['data'][$i][$j],0,",",".");}
				}
			}
		return $var;		
	}

	function unirTitulos($var)
	{
		for($i=0; $i < sizeof($var['data']); $i++)
			{
				for($j=1; $j < 10; $j++)
				{	
					if($j==1)
					{
						$titulo1 = substr($var['data'][$i][$j], -1);
						$titulo2 = substr($var['data'][$i][99], 0, 1);
			
							if($titulo1 === " ")
							{								
									if($titulo2 === " ")
									{
										 $var['data'][$i][$j] = $var['data'][$i][$j].$var['data'][$i][99];
										 break;
									}
									else
									{
										$var['data'][$i][$j] = $var['data'][$i][$j]." ".$var['data'][$i][99];
										break;
									}

							}
							else
							{
								$var['data'][$i][$j] = $var['data'][$i][$j].$var['data'][$i][99];
							}
					}
				}
			}
		return $var;		
	}

	function formatEnc($var)
	{
			for($i=0; $i < sizeof($var['data']); $i++)
			{
				for($j=6; $j < 7; $j++)
				{
					if($j==6)
					{
						if($var['data'][$i][$j] == 'R'){$var['data'][$i][$j] = 'Rustico';break;}
						if($var['data'][$i][$j] == 'E'){$var['data'][$i][$j] = 'Encuadernado';break;}
						if($var['data'][$i][$j] == 'P'){$var['data'][$i][$j] = 'Empastada';break;}
						if($var['data'][$i][$j] == 'D'){$var['data'][$i][$j] = 'Video DVD';break;}
						if($var['data'][$i][$j] == 'V'){$var['data'][$i][$j] = 'Video VHS';break;}
						if($var['data'][$i][$j] == 'C'){$var['data'][$i][$j] = 'Casette';break;}
						if($var['data'][$i][$j] == 'K'){$var['data'][$i][$j] = 'Equipo completo';break;}
					}
				}
			}
			return $var;
	}


			function setImagen($var)
		{
			for($i=0; $i < sizeof($var['data']); $i++)
			{
				for($j=0; $j < 1; $j++)
				{ 
					$imagen ='../images/libros/'.$var['data'][$i][0].'.jpg';
					$imagen2 ='../images/libros2/'.$var['data'][$i][0].'.jpg';
					$imagen3 ='../images/libros/'.$var['data'][$i][0].'.JPG';
					$imagen4 ='../images/libros2/'.$var['data'][$i][0].'.JPG';

						if (!is_array(@getimagesize($imagen)))
						{
							if (!is_array(@getimagesize($imagen2)))
							{
								if (!is_array(@getimagesize($imagen3)))
								{
									if (!is_array(@getimagesize($imagen4)))
									{
										$imagenFinal ="";
									}
									else
									{
										$imagenFinal = $imagen4;
									}
								}
								else
								{
									$imagenFinal = $imagen3;
								}
							}
							else
							{
								$imagenFinal = $imagen2;
							}
						}
						else									
						{
							$imagenFinal = $imagen;
						}
					$imagen1 = $imagenFinal;
				}
			
			$var['data'][$i][9] = $imagenFinal;

			if(isset($var['data'][$i][9]))
			{
				if(strlen($var['data'][$i][9]) > 3)
				{
					$var['data'][$i][9] = '<img src="http://www.lesbricolanges.com/images/alert-success-ico.png"  width="15px" height="15px"/>';
				}
				else
				{
					$var['data'][$i][9] = '<img src="http://releases.strategoxt.org/images/failure.gif" width="10px" height="10px"/>';
				}
			}
			
			}
			return $var;
		}

			function setFicha($var)
		{
			for($i=0; $i < sizeof($var['data']); $i++)
			{
				for($j=0; $j < 1; $j++)
				{

				$nombre_fichero = '../fichas/'.$var['data'][$i][0].'.pdf';

				if (file_exists($nombre_fichero))
				{ 				   
				   $var['data'][$i][10] = '<img src="http://www.lesbricolanges.com/images/alert-success-ico.png"  width="15px" height="15px"/>';
				}else
				{
					$var['data'][$i][10] = '<img src="http://releases.strategoxt.org/images/failure.gif" width="10px" height="10px"/>';
				}

				}
			}
			return $var;
		}

	function setDescripcion($var, $var2)
	{ 
			for($i=0; $i < sizeof($var2['data']); $i++)
			{
				for($j=0; $j < 1; $j++)
				{
					$select[] = "select cod_libro from libros_importada_de_txt where cod_libro = ".$var2['data'][$i][0];
				}
			}
			return $var;
	}
		
		function buscarTemas($temas){

		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

	 

		$temas1 = explode(" ", $temas);
 

		for($i=0; $i < sizeof($temas1); $i++)
		{
			$consulta[] = "select * from codigo where cod_cod = ".$temas1[$i];	
		}
 
		
		for($i=0; $i < sizeof($consulta); $i++)
		{
			$query = $consulta[$i];
		
				 foreach ($dbh->query($query) as $row)
				{
					$var[] = $row['DES_COD'];
				}
		}

	return $var;

}

		function buscarGlobal($global){

		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

	 	$consulta= "select * from blockes where COD_BLK = ".$global;

				 foreach ($dbh->query($consulta) as $row)
				{
					$var[] = $row['DES_BLK'];
				}

	return $var;

}

function subirImagen($archivo, $nombreArchivo)
{

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $archivo["file"]["name"]);
$extension = end($temp);

$archivo["file"]["name"] = $nombreArchivo.'.'.$extension;

	if ((($archivo["file"]["type"] == "image/gif")
	|| ($archivo["file"]["type"] == "image/jpeg")
	|| ($archivo["file"]["type"] == "image/jpg")
	|| ($archivo["file"]["type"] == "image/pjpeg")
	|| ($archivo["file"]["type"] == "image/x-png")
	|| ($archivo["file"]["type"] == "image/png"))
	&& ($archivo["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts)) {

			  if ($archivo["file"]["error"] > 0)
			  {
				$result["file"]['error'] = "Return Code: " . $archivo["file"]["error"] . "<br>";
			  }
			  else
			  {
				$result["file"]['upload'] = "Upload: " . $archivo["file"]["name"] . "<br>";
				$result["file"]['type'] = "Type: " . $archivo["file"]["type"] . "<br>";
				$result["file"]['size'] = "Size: " . ($archivo["file"]["size"] / 1024) . " kB<br>";
				$result["file"]['temp'] = "Temp file: " . $archivo["file"]["tmp_name"] . "<br>";
				$result["file"]['error'] = 'imagen actualizada.';
				 

						if (file_exists("img/" . $archivo["file"]["name"]))
						{
						  $result["file"]['error'] = $archivo["file"]["name"] . " ya existe. ";
						}
						else
						{
						  move_uploaded_file($archivo["file"]["tmp_name"],
						  "img/" . $archivo["file"]["name"]);
						  $result["file"]['path'] = "Stored in: " . "img/" . $archivo["file"]["name"];
						}
			  }
	}
	else
	{
	  $result["file"]['error'] = 'archivo invalido';
	}

	return $result;
}


		function buscarTemas1($codigo, $temas){

		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

	 

		$temas1 = explode("+", $temas[$codigo]['temas']);
 

		for($i=0; $i < sizeof($temas1); $i++)
		{
			$consulta[] = "select * from codigo where cod_cod = ".$temas1[$i];	
		}
 
		
		for($i=0; $i < sizeof($consulta); $i++)
		{
			$query = $consulta[$i];
		
				 foreach ($dbh->query($query) as $row)
				{
					$var[] = $row['DES_COD'];
				}
		}

	return $var;

}

		function buscarGlobal1($codigo, $global){

		$Conexion = new ClaseConexion();
		$dbh = $Conexion->realizarConexion();

	 	$consulta= "select * from blockes where COD_BLK = ".$global;

				 foreach ($dbh->query($consulta) as $row)
				{
					$var[] = $row['DES_BLK'];
				}

	return $var;

}


}
