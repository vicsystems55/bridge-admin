<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <title>Bridge Notification</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,600" rel="stylesheet" media="screen">
    <style>
        .hover-underline:hover {
            text-decoration: underline !important;
        }

        @media (max-width: 600px) {
            .sm-w-full {
                width: 100% !important;
            }

            .sm-px-24 {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }

            .sm-py-32 {
                padding-top: 32px !important;
                padding-bottom: 32px !important;
            }

            .sm-leading-32 {
                line-height: 32px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; width: 100%; padding: 0; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #eceff1;">
    <div style="display: none;"></div>
    <table style="width: 100%; font-family: 'Montserrat', Arial, sans-serif;" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="background-color: #eceff1;">
                <table class="sm-w-full" style="width: 600px;" cellpadding="0" cellspacing="0" role="presentation">
                    <!-- Logo Section -->
                    <tr>
                        <td style="padding: 48px; text-align: center;">
                            <a href="https://bridgeafricaapp.com">
                                <img src="{{ asset('/') }}images/logo.png" width="155" alt="Bridge Africa App Logo" style="max-width: 100%; vertical-align: middle; border: 0;">
                            </a>
                        </td>
                    </tr>
                    <!-- Content Section -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 48px; text-align: left; border-radius: 4px;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: 700; color: #151546;">Hello, {{ $datax['jobSeekerName'] }}!</h1>
                            <p style="margin-top: 16px; font-size: 16px; line-height: 24px; color: #626262;">
                              We would like to inform you about the status of your application for the position of <strong>{{ $datax['jobTitle'] }}</strong> at <strong>{{ $datax['companyName'] }}</strong>.
                              <p>Reviewer's Note:</p>
                              <blockquote>{{ $datax['reviewNote'] }}</blockquote>

                            </p>





                            <p style="margin-top: 16px; font-size: 16px; line-height: 24px; color: #626262;">
                            <p>If you have any questions or require further information, please feel free to contact us.</p>

                              Best regards,<br>The {{ $datax['companyName'] }} Team
                            </p>
                            <table cellpadding="0" cellspacing="0" role="presentation" style="margin-top: 24px;">
                                <tr>
                                    <td style="background-color: #151546; border-radius: 4px; text-align: center;">
                                        <a href="https://play.google.com/store/apps" style="display: block; padding: 16px 24px; font-size: 16px; font-weight: 600; color: #ffffff; text-decoration: none;">
                                            Proceed to Dashboard →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer Section -->
                    <tr>
                        <td style="padding: 32px; text-align: center; font-size: 14px; color: #626262;">
                            <p style="margin: 0;">Not sure why you received this email? Please <a href="mailto:support@example.com" class="hover-underline" style="color: #151546; text-decoration: none;">let us know</a>.</p>
                            <p style="margin-top: 16px;">Thanks,<br>The Bursconn Team</p>
                            <p style="margin-top: 32px;">
                                <a href="https://www.facebook.com/bridgeafricaapp" style="margin-right: 12px;"><img src="{{ asset('/') }}images/facebook.png" width="17" alt="Facebook"></a>
                                <a href="https://twitter.com/bridgeafricaapp" style="margin-right: 12px;"><img src="{{ asset('/') }}images/twitter.png" width="17" alt="Twitter"></a>
                                <a href="https://www.instagram.com/bridgeafricaapp"><img src="{{ asset('/') }}images/instagram.png" width="17" alt="Instagram"></a>
                            </p>
                            <p style="margin-top: 16px;">
                                Use of our service is subject to our <a href="https://bridge.erp-55.com.ng/" class="hover-underline" style="color: #151546;">Terms of Use</a> and <a href="https://bridge.erp-55.com.ng/" class="hover-underline" style="color: #151546;">Privacy Policy</a>.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
