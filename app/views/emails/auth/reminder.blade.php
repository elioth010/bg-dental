<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Cambio de contraseña</h2>

		<div>
			Para cambiar su contraseña pinche en este enlace y a continuación proceda a cambiar su contraseña: {{ URL::to('password/reset', array($token)) }}.<br/>
                        Este enlace tendrá una validez de {{ Config::get('auth.reminder.expire', 60) }} minutos.<br>
                        Atentamente,<br>
                        Qdental - Administrador.
		</div>
	</body>
</html>
