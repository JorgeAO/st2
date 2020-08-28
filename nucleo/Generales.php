<?

class Generales
{
	public static function enviarMail($strDestinatario, $strAsunto, $strMensaje)
	{
		try 
		{
			$strCabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$strCabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$strCabeceras .= "From: jaguilar.8709@gmail.com \r\n" .
				'X-Mailer: PHP/' . phpversion();

			$strCuerpoHTML = '<!DOCTYPE html>'.
				'<html>'.
				'<head>'.
					'<title></title>'.
				'</head>'.
				'<body>'.$strMensaje.'</body>'.
				'</html>';

			mail($strDestinatario, $strAsunto, $strCuerpoHTML, $strCabeceras);
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}
}