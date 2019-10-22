<?php

class Conf {
   
    const HOST_URL ='http://localhost/guia/';

    const HOST_MAIL = 'obras.unsa.edu.ar';
    const SMTP_PORT = 25;
    
    const DB_USER ='root';
    const DB_NAME ='guia';
    const DB_PASS ='oysadmin';

    const DIR_HOME = '/var/www/html/guia';
    const HOSTNAME = 'localhost';
    
		
    // CUENTA ENVIO DE ERRORES
    const ERROR_USER ='errores';
    const FROM_ERROR = 'errores@obras.unsa.edu.ar';
    const ERROR_PASS = 'tape';

    // CUENTA ENVIO DE ALERTAS
    const ALERT_USER ='infotape';
    const FROM_ALERT = 'infotape@obras.unsa.edu.ar';
    const ALERT_PASS = 'info';
    const TO_ALERT = 'mlgarcia@unsa.edu.ar';
    const TO_ALERTEX = 'mglorena@gmail.com'; /*** para los vehiculos****/
    
}

?>
