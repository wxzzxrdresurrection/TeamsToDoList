<html>
<head>
    <style>
        body { width: 100% !important; margin: 0; padding: 0;
        -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table
        { border-spacing: 0; border-collapse: collapse; table-layout: fixed;
        Margin: 0 auto; } img { border: 0; -ms-interpolation-mode: bicubic;
        } a { text-decoration: none; } a[x-apple-data-detectors] { color:
        inherit !important; text-decoration: none !important; }
        .email-container { width: 100%; max-width: 600px; margin: auto;
        border: 1px solid #e0e0e0; } .column1 { background-color: #f2494e;
        text-align: center; padding: 40px 20px; } .column2 { padding: 20px;
        text-align: center; } h1 { color: white; font-size: 24px;
        font-family: Arial, sans-serif; } p { color: white; font-size: 16px;
        font-family: Arial, sans-serif; line-height: 1.4; } .button {
        display: inline-block; background-color: #bc0505; color: white;
        text-align: center; font-size: 18px; padding: 15px 30px;
        border-radius: 100px; border: none; } .button:hover {
        background-color: #f2494e; cursor: pointer; } footer { text-align:
        center; margin-top: 20px; } footer p { color: black; font-size:
        medium; margin: 5px 0; } @media screen and (max-width: 600px) { h1 {
        font-size: 20px; } p { font-size: 14px; } .button { font-size: 16px;
        padding: 10px 20px; } }
    </style>
</head>
<body>
    <center>
        <table role="presentation" class="email-container">
            <tr>
                <td class="column1">
                        <h1>¡Hola {{ $username }}!</h1>
                        <p>
                            Hemos recibido tu solicitud para recuperar tu contraseña,
                            por lo que te hemos enviado este correo. <br><br> Tu nueva contraseña es: <br><br> 
                            <strong style="font-size: 40px; color: #">{{ $data }}</strong><br><br> 
                            Por favor, conservala e introdúcela en la aplicación para iniciar sesión. 
                        </p>
                </td>
            </tr>
            <tr>
                <td class="column2">
                    <footer>
                        <p>@Taskly 2024. Todos los derechos reservados.</p>
                    </footer>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>