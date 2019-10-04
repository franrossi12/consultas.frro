<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eceff4">
    <tbody>
    <tr>
        <td>
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"
                   style="border:1px solid #dedbdb;margin-top:20px;">
                <tbody>
                <tr>
                    <td>

                        <table width="220" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td height="10px"></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a href="http://riobus.com.ar/web/" target="_blank">
                                        <img src="{{ asset('img/logo_utn')  }}"
                                             height="45" alt="Logo UTN" style="display:block;border:none">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td height="10px"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="m_3016959160513433828backgroundTable"
                   bgcolor="#eceff4">
                <tbody>
                <tr>
                    <td>
                        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"
                               style="border-left:1px solid #dedbdb;border-right:1px solid #dedbdb;border-bottom:3px solid #dedbdb">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div style="font-family:Helvetica,arial,sans-serif;font-size:30px;color:#333333;text-align:center;line-height:30px;letter-spacing:2px;padding:50px 0 20px 0">

                                                    ¡Hola, {{$usuario->nombre}}!
                                                </div>
                                                <div style="font-family:Helvetica,arial,sans-serif;font-size:18px;color:#666666;text-align:center;line-height:24px;letter-spacing:2px;padding:5px 0 20px 0">

                                                    tu registro está casi completo...
                                                </div>
                                                <div style="font-family:Helvetica,arial,sans-serif;font-size:16px;color:#666666;line-height:22px;padding:15px 10px 30px 10px">

                                                    Para completar el registro debes validar tu dirección de email
                                                    ingresando un código de activación:
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="margin:0 auto;text-align:center;padding:25px 0 45px 0">
                                                    <a href={{ config('APP_URL') . '/confirmar-contraseña/' . $usuario->token_verificar }}
                                                        style="background-color:#39B4EB;border-top-width:0px;border-right-width:0px;border-bottom-width:4px;border-left-width:0px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:#39B4EB;border-right-color:#39B4EB;border-bottom-color:#39B4EA;border-left-color:#39B4EB;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-bottom-left-radius:5px;color:#ffffff;display:inline-block;font-family:Arial,Helvetica,sans-serif;font-size:16px;text-transform:uppercase;font-weight:normal;height:50px;line-height:55px;text-align:center;text-decoration:none;width:200px"
                                                       target="_blank">
                                                        <strong>
                                                            validar email
                                                        </strong>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
