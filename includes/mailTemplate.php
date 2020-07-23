<?
$idTrackerEnvio = date("YmdHis").substr((string)microtime(), 2, 5);
$fromaddress = $FUNCIONES->getConfiguracion("emailRemitente");
$additional_parameters = "-f ".$fromaddress;
$titulo = $tituloMensaje;
$sIP = md5($titulo.date('dmY'));
$eol = PHP_EOL;
$fechaEnvio = date('Y-m-d H:i:s');
$yearInEmail = date('Y');

$headers = 'From: "QuickB" <'.$fromaddress.'>'.$eol;
$headers .= 'MIME-Version: 1.0'.$eol;
$headers .= 'Reply-To: '.$fromaddress.$eol;
$headers .= 'Return-Receipt-To: '.$fromaddress.$eol;
$headers .= 'Return-Path: '.$fromaddress.$eol;
$headers .= 'Errors-To: '.$fromaddress.$eol;
$headers .= 'Message-ID:<mailer_'.date('U').'@quickb.mx>'.$eol;
$headers .= 'X-Mailer: MAILER v1.15'.$eol;
$headers .= 'List-Unsubscribe: <mailto:unsubscribe@quickb.mx?subject=unsubscribe-'.$destinatario.'>, <https://www.quickb.mx/unsubscribe/'.$destinatario.'>'.$eol;
$headers .= 'Content-type: multipart/alternative; boundary="'.$sIP.'"'.$eol;

$msg  = '--'.$sIP.$eol;
$msg .= 'Content-Type: text/plain; charset=iso-8859-1'.$eol;
$msg .= 'Content-Transfer-Encoding: 7bit'.$eol.$eol;
$msg .= 'Si usted esta leyendo esto, por favor actualice su cliente de correo.'.$eol;
$msg .= 'Este correo se genera de forma automatica a traves QUICKB.MX'.$eol;
$msg .= 'Acentos y tildes omitidos con intencion.'.$eol;
$msg .= '--'.$sIP.$eol;
$msg .= 'Content-Type: text/html; charset=iso-8859-1'.$eol;
$msg .= 'Content-Transfer-Encoding: 7bit'.$eol.$eol;
$msg .= '
    <html>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td align="left" style="color:#000000;font-size:12px;font-family:Arial;">
                    '.$contenidoMsg.'
                </td>
            </tr>
            <tr>
                <td align="center" style="color:#000000;font-size:12px;font-family:Arial;">
                    <br><br><span>Este mensaje se genera de manera autom&aacute;tica, favor de no responder.</span><br>
                    <span>QUICKB.MX '.$yearInEmail.'</span>
                </td>
            </tr>
        </table>

        <br>
        <p style="font-size:10px;font-family:Arial;line-height:13px;color:#000000;">
            Este mensaje se genera de manera autom&aacute;tica, favor de no responder.
            Este email te fue enviado, para recibir noticias e informaci&oacute;n de QUICKB.MX,
            Si t&uacute; prefieres no recibir emails de nosotros, <a href="https://www.quickb.mx/unsubscribe/'.$destinatario.'" target="_blank" style="color:#3500ff;">unsubscribe / Salir de esta lista de distribuci&oacute;n</a><br>
        </p>
        <p style="color:#000000;font-size:10px;font-family:Arial;">
            De acuerdo a lo Previsto en la "Ley Federal de Protecci&oacute;n de Datos Personales", declara QUICKB.MX,
            ser un sistema digital para proveer un servicio de informaci&oacute;n;
            y como responsable del tratamiento de sus datos personales, hace de su conocimiento que la informaci&oacute;n de el usuario visitante.
            es tratada de forma estrictamente confidencial por lo que al proporcionar sus datos personales, tales como: Nombre y correo electr&oacute;nico y redes sociales.
            Estos datos proporcionados por el usuario visitnate, ser&aacute;n utilizados &uacute;nica y exclusivamente para los fines que QUICKB.MX crea pertinentes.<br>
            QUICKB.MX - M&eacute;xico '.$yearInEmail.'
        </p>
    </body>
    </html>
';
$msg .= $eol.$eol;
ini_set('sendmail_from',$fromaddress);
$subjectMensaje ='=?UTF-8?B?'.base64_encode(utf8_encode($titulo)).'?=';
if(mail($destinatario, $subjectMensaje, wordwrap($msg,70,$eol), $headers, $additional_parameters)) { ini_restore('sendmail_from'); } else { ini_restore('sendmail_from'); }