<?php

        $code=1;
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        /* Cerberus Email Styles */
        /* Feel free to customize the styles as per your requirements */
        @media only screen and (max-width: 600px) {

            /* Mobile-specific styles */
            .email-container {
                width: 100% !important;
            }

            .header,
            .body {
                padding: 20px !important;
            }

            .button {
                width: auto !important;
                display: inline-block !important;
            }
        }
    </style>
</head>

<body style="background-color: #f2f2f2;">
    <table class="email-container" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table class="header" align="center" width="100%" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff;">
                    <tr>
                        <td align="center">
                            <h1>Password Reset</h1>
                        </td>
                    </tr>
                </table>

                <table class="body" align="center" width="100%" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff;">
                    <tr>
                        <td align="center">
                            <p>Dear User,</p>
                            <p>We have received a request to reset your password. Please click the button below to reset
                                your password:</p>
                            <table class="button" cellpadding="0" cellspacing="0"
                                style="background-color: #007bff; border-radius: 4px;">
                                <tr>
                                    <td align="center" style="padding: 10px 20px;">
                                        <a href="http://localhost:82/Gestion_Biblio_PHP/login-form-v1/Login_v1/formPassChange.php?code=<?= $code ?>" target="_blank"
                                            style="color: #ffffff; text-decoration: none; display: inline-block; width: 100%;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                            </table>
                            <p>If you didn't request a password reset, please ignore this email. Your password will
                                remain unchanged.</p>
                            <p>Thank you,</p>
                            <p>EHEIO</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>