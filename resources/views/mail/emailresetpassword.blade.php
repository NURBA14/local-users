<!DOCTYPE>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alerts e.g. approaching your limit</title>
    <link href="{{ asset('/email_templates/styles.css') }}" media="all" rel="stylesheet" type="text/css" />
</head>

<body>

    <table class="body-wrap">
        <tr>
            <td></td>
            <td class="container" width="600">
                <div class="content">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="alert alert-good">
                                {{ __('Email verification') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="content-wrap">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-block aligncenter">
                                            <strong>{{ $email }}</strong>
                                            <strong>Your email verification code</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block aligncenter">
                                            <h1>{{ $smscode }}</h1>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer">
                        <table width="100%">
                            <tr>
                                <td class="aligncenter content-block"><a href="#"></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
</body>

</html>
