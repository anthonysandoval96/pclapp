@php

// session_unset();
if (!isset($_SESSION["user_register"])) exit("No ingresaste ninguno de los datos del formulario!");

$client = new Lyra\Client();


$config = datosConfiguracion();
$soles = $config["p_soles"] * 100;
$dolares = $config["p_dolares"] * 100;
/**
* I create a formToken
*/
$store = array("amount" => $soles,
"currency" => "PEN",
"orderId" => uniqid("MyOrderId"),
"customer" => array("email" => $_SESSION["user_register"]["in-usuario-email"])
);

$response = $client->post("V4/Charge/CreatePayment", $store);

/* I check if there are some errors */
if ($response['status'] != 'SUCCESS') {
    /* an error occurs, I throw an exception */
    display_error($response);
    $error = $response['answer'];
    throw new Exception("error " . $error['errorCode'] . ": " . $error['errorMessage'] );
}

/* everything is fine, I extract the formToken */
$formToken = $response["answer"]["formToken"];
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ APP_NAME }} - @yield('title')</title>
    @include('layouts.includes.env')
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}dist/css/adminlte.min.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}plugins/fontawesome-free/css/all.min.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ CUSTOM_ROUTE }}css/all-fonts.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ CUSTOM_ROUTE }}css/global.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ CUSTOM_ROUTE }}css/custom.css?{{CACHE_VERSION}}">
    @yield('csss')

    <style>
        .kr-popin-utils {
            text-align: center;
        }
    </style>

    <!-- Javascript library. Should be loaded in head section -->
    <!--En la etiqueta kr-post-url-success Colocar el archivo de redireccion o URL (RECORDAR)-->
    <script
        src="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js?{{CACHE_VERSION}}"
        kr-public-key="<?php echo $client->getPublicKey();?>" kr-post-url-success="payment_response"
        kr-hide-debug-toolbar="false">
    </script>

    <!-- theme and plugins. should be loaded after the javascript library -->
    <!-- not mandatory but helps to have a nice payment form out of the box -->
    <link rel="stylesheet"
        href="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/ext/classic.css?{{CACHE_VERSION}}">
    <script
        src="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/ext/classic.js?{{CACHE_VERSION}}">
    </script>

</head>

<body class="text-sm" style="background-color: #e9ecef;">
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <div class="card m-auto" style="width: 25rem;">
                    <div class="card-header text-center">
                        <h3 class="h5 mt-1 ">{{$title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="kr-embedded m-auto" kr-form-token="<?php echo $formToken;?>">
                            <!-- payment form fields -->
                            <div class="kr-pan"></div>
                            <div class="kr-expiry"></div>
                            <div class="kr-security-code"></div>

                            <!-- payment form submit button -->
                            <button class="kr-payment-button"></button>

                            <!-- error zone -->
                            <div class="kr-form-error"></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    <script src="{{ PUBLIC_ROUTE }}plugins/jquery/jquery.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{ CUSTOM_ROUTE }}js/global.js?{{CACHE_VERSION}}"></script>
    @yield('scripts')
</body>

</html>