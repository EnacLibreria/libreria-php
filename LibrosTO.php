<?php

class LibrosTO
{

private $codigoLibro;
private $imagen;
private $imagen2;
private $imagen3;
private $imagen4;
private $imagenFinal;
private $Titulo;
private $Autor;
private $arregloImagenes;
private $apaisado;
private $arregloNovedad;
private $imagen1;
private $localVenta;
private $precio;
private $temas;
private $ficha;
private $fichaFinal;
private $Categoria;
private $pagina;
private $formato;
private $descripcion;

 			//	C	O	N	S	T	R	U	C	T	O	R

	function LibrosTO()
	{
	
	$this->imagen = '';
	$this->imagen1  = '';
	$this->imagen2 = '';
	$this->imagen3 = '';
	$this->imagen4 = '';
	$this->imagenFinal = '';
	 
	$this->arregloImagenes = array();
	$this->arregloNovedad = array();
	$this->apaisado = array();
	}

 			//	C	O	N	S	T	R	U	C	T	O	R

 			//	G	E	T	T	E	R
		
		function getCodigoLibros(){
			return $this->codigoLibro;
		}

		function getCodigo(){
			return $this->codigoLibro;
		}


		function getImagen(){
			return $this->imagen;
		}

		function getImagen1(){
			return $this->imagen1;
		}

		function getImagen2(){
			return $this->imagen2;
		}

		function getImagen3(){
			return $this->imagen3;
		}
		
		function getImagen4(){
			return $this->imagen4;
		}
		
		function getimagenFinal(){
			return $this->imagenFinal;
		}

		function getTitulo(){
			return $this->Titulo;
		}

		function getAutor(){
			return $this->Autor;
		}

		function getArregloImagenes(){
			return $this->arregloImagenes;
		}
			
		
		function getApaisado(){
			return $this->apaisado;
		}
			
		function getArregloNovedad(){
			return $this->arregloNovedad;
		}

		function getLocalVenta(){
			return $this->localVenta;
		}

		function getPrecio(){
			return $this->precio;
		}

		function getPaginas(){
			return $this->pagina;
		}

		function getFormato(){
			return $this->formato;
		}

		function getDescripcion(){
			return $this->descripcion;
		}

		function getTemas(){
			return $this->temas;
		}

		function getFicha()
		{
			return $this->fichaFinal;
		}

		function getCategoria()
		{
			return $this->Categoria;
		}
 			//	E	N	D	 	G	E	T	T	E	R
 			
 			//	S	E	T	T	E	R	
 				
		function setCodigoLibros($lSetCodigoLibro)
		{
			$param = sizeof($lSetCodigoLibro);
			
				for($i=0;$i < $param; $i++)
				{
					$this->codigoLibro[$i] = $lSetCodigoLibro[$i];
				}
		}

		function setCodigo($lSetCodigo)
		{
			$this->codigoLibro = $lSetCodigo;
		}

		function setTitulo($lTitulo)
		{
			$param = sizeof($lTitulo); 

				for($i=0;$i < $param; $i++)
				{
					$this->Titulo[$i] = $lTitulo[$i]; 
				}
		}

		function setTitulo1($lTitulo)
		{
			$this->Titulo = $lTitulo; 
			
		}


		function setAutor($lAutor)
		{	
			$param = sizeof($lAutor);

				for($i=0;$i < $param; $i++)
				{
					$this->Autor[$i] = $lAutor[$i];
				}
		}

		function setCategoria($lCategoria)
		{	
			$param = sizeof($lCategoria);

				for($i=0;$i < $param; $i++)
				{
					$this->Categoria[] = $lCategoria[$i];
				}
		}

		function setAutor1($lAutor)
		{
			$this->Autor = $lAutor;
			
		}

		function setArregloImagenes($lArregloImagenes)
		{	
			$param = sizeof($lArregloImagenes);
			
				for($i=0;$i < $param; $i++)
				{
					$this->arregloImagenes[$i] = $lArregloImagenes[$i];
				}
		}

		function flushArregloImagenes()
		{	

			unset($this->arregloImagenes);

		}

		
		function setImagen2($lImagen2)
		{
			$this->imagen2 = $lImagen2;
		}

		
		function setImagen3($lImagen3)
		{
			$this->imagen3 = $lImagen3;
		}

		
		function setImagen4($lImagen4)
		{
			$this->imagen4 = $lImagen4;
		}

		
		function setimagenFinal($limagenFinal)
		{
			$this->imagenFinal = $limagenFinal;
		}


		function setFicha($lcodigoLibro)
		{ 
				$nombre_fichero = '../fichas/'.$lcodigoLibro.'.pdf';

				if (file_exists($nombre_fichero))
				{ 
				   $this->fichaFinal = $nombre_fichero;
				   
				}else
				{
					$this->fichaFinal = 0;
			 
				}
		}

		function setFichas($lcodigoLibro)
		{
			$param = sizeof($lcodigoLibro);
			
				for($i=0;$i < $param; $i++)
				{
					$nombre_fichero = '../fichas/'.$lcodigoLibro[$i].'.pdf';

					if (file_exists($nombre_fichero))
					{ 
					   $this->fichaFinal[] = $nombre_fichero;
					   
					}else
					{
						$this->fichaFinal[] = 0;
				 
					}
			}
			
		}


		function setApaisado($lArregloApaisado)
		{	
			$param = sizeof($lArregloApaisado);
			
				for($i=0;$i < $param; $i++)
				{
						$this->apaisado[$i]= ' width="105" height="144" ';
						$arreglo = array();
						$arreglo = explode("-", $lArregloApaisado[$i]);

							for($j=0; $j < sizeof($arreglo); $j++)
							{
								if($arreglo[$j] == 60 or $arreglo[$j] == 90)
								{
									$this->apaisado[$i]= ' width="150" height="103" ';
									break;
								}
							}
				}
				
		}

		function setApaisado1($Apaisado)
		{	 
						$this->apaisado[0] = '205';
						$this->apaisado[1] = '244';
						
						$arreglo = array();
						$arreglo = explode("-", $Apaisado);

							for($j=0; $j < sizeof($arreglo); $j++)
							{
								if($arreglo[$j] == 60 or $arreglo[$j] == 90)
								{
									$this->apaisado[0] = '250';
									$this->apaisado[1] = '203';
									break;
								}
							}
	 
				
		}


		function setLocalVenta($lMerced, $lHuerfanos)
		{	 
			$this->localVenta[0] = $lMerced;
			$this->localVenta[1] = $lHuerfanos;	
		}

		function setPrecio($lPrecio)
		{	 
			$this->precio = $lPrecio;
		}

		function setPrecios($lPrecio)
		{
			$param = sizeof($lPrecio);
			
				for($i=0;$i < $param; $i++)
				{
				$this->precio[] = $lPrecio[$i];
				}
		}

		function setPaginas($lPaginas)
		{
			$param = sizeof($lPaginas);
			
				for($i=0;$i < $param; $i++)
				{
					$this->pagina[] = $lPaginas[$i];
				}
		}

		function setDescripciones($lDescripcion)
		{
			$param = sizeof($lDescripcion);
			
				for($i=0;$i < $param; $i++)
				{
					$this->descripcion[] = $lDescripcion[$i];
				}
		}

		function setFormatos($lFormato)
		{
			$param = sizeof($lFormato);
			
				for($i=0;$i < $param; $i++)
				{
					$this->formato[] = $lFormato[$i];
				}
		}
		
		function SetAnioNovedad() 
		{
				$fecha = (int) $date, $format('Y');
				date($format, strtotime($fecha . ' -1 year'));
		return $fecha
		}
		
		function setArregloNovedad($lArregloNovedad, $lArregloApaisado)
		{
			$fecha = this->SetAnioNovedad();
			$param = sizeof($lArregloApaisado);
			
				for($i=0;$i < $param; $i++)
				{
					if($lArregloNovedad[$i] === $fecha and $lArregloApaisado[$i] === ' width="150" height="103" ')
					{
							$this->arregloNovedad[]= ' <img class="novedadApaisado" src="Clases/Index/novedadApaisado.png" /> ';
							
					}
					elseif($lArregloNovedad[$i] === $fecha and $lArregloApaisado[$i] === ' width="105" height="144" ')
					{
							$this->arregloNovedad[]= ' <img class="novedadRustico" src="Clases/Index/novedadRustico.png" /> ';
							
					}
						
				}

		 
}

	function setTemas($lArregloCodigos, $lArregloTemas)
		{	
		 
						$arreglo = array();
						$arreglo = explode("-", $lArregloTemas);

							for($j=0; $j < sizeof($arreglo); $j++)
							{
								if($arreglo[$j] != 0)
								{
									if($j === 0)
									{
										 $concat = $arreglo[$j];
									}
									else
									{
										 $concat = $concat.'+'.$arreglo[$j];
									}	
								}
							}

								$this->temas[$lArregloCodigos]['temas'] = $concat; 
 


}

}
