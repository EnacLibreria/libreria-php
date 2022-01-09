<?php

include("BackOfficeDAO.php");
include("LibrosTO.php");

class BackOfficeBO
{

 	//	C	O	N	S	T	R	U	C	T	O	R	
	
	function BackOfficeBO(){}
	
 	//	C	O	N	S	T	R	U	C	T	O	R

	function autocompleteCodigos($term)
	{
			$oLibros = new LibrosTO();
			$BackOfficeDAO = new BackOfficeDAO();

			$oLibros->setCodigo($term);
			$var = $BackOfficeDAO->autocompleteCodigos($oLibros);

			return $var;
	}

		function buscarTemas($temas)
	{
			$oLibros = new LibrosTO();
			$BackOfficeDAO = new BackOfficeDAO();

			
			$var = $BackOfficeDAO->buscarTemas($temas);

			return $var;
	}


		function buscarGlobal($global)
	{
			$oLibros = new LibrosTO();
			$BackOfficeDAO = new BackOfficeDAO();

			
			$var = $BackOfficeDAO->buscarGlobal($global);

			return $var;
	}


			function subirImagen($archivo, $nombreArchivo)
	{
			$oLibros = new LibrosTO();
			$BackOfficeDAO = new BackOfficeDAO();

			
			$var = $BackOfficeDAO->subirImagen($archivo, $nombreArchivo);

			return $var;
	}


					
}
