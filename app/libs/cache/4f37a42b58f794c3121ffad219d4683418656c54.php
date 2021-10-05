<?php
$client = new Lyra\Client();

/**
* I create a formToken
*/
$store = array("amount" => 1000,
"currency" => "PEN",
"orderId" => uniqid("MyOrderId"),
"customer" => array("email" => "anthonysandoval1596@gmail.com")
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(APP_NAME); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->make('layouts.includes.env', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>dist/css/adminlte.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>plugins/fontawesome-free/css/all.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(CUSTOM_ROUTE); ?>css/all-fonts.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(CUSTOM_ROUTE); ?>css/global.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(CUSTOM_ROUTE); ?>css/custom.css?<?php echo e(CACHE_VERSION); ?>">
    <?php echo $__env->yieldContent('csss'); ?>

    <style>
        .kr-popin-utils {
            text-align: center;
        }
    </style>

    <!-- Javascript library. Should be loaded in head section -->
    <!--En la etiqueta kr-post-url-success Colocar el archivo de redireccion o URL (RECORDAR)-->
    <script
        src="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js?<?php echo e(CACHE_VERSION); ?>"
        kr-public-key="<?php echo $client->getPublicKey();?>" kr-post-url-success="usuario/payment_response"
        kr-hide-debug-toolbar="false">
    </script>

    <!-- theme and plugins. should be loaded after the javascript library -->
    <!-- not mandatory but helps to have a nice payment form out of the box -->
    <link rel="stylesheet"
        href="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/ext/classic.css?<?php echo e(CACHE_VERSION); ?>">
    <script
        src="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/ext/classic.js?<?php echo e(CACHE_VERSION); ?>">
    </script>

</head>

<body class="hold-transition text-sm" style="background-color: #e9ecef;">
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
        <div class="spanner transaction text-white">
            <div class="spanner-content text-teal">
                <h3 class="mb-4">
                    <div>Cargando ...</div>
                    <div>espere un momento</div>
                </h3>
                <div class="spinner-border" style="width: 3rem; height: 3rem;"></div>
            </div>
        </div>
    </div>

    <div class="kr-embedded"
   kr-form-token="<?php echo $formToken;?>">

    <!-- payment form fields -->
    <div class="kr-pan"></div>
    <div class="kr-expiry"></div>
    <div class="kr-security-code"></div>  

    <!-- payment form submit button -->
    <button class="kr-payment-button"></button>

    <!-- error zone -->
    <div class="kr-form-error"></div>
  </div> 

    <script src="<?php echo e(PUBLIC_ROUTE); ?>plugins/jquery/jquery.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PUBLIC_ROUTE); ?>dist/js/adminlte.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(CUSTOM_ROUTE); ?>js/global.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>sweetalert2/sweetalert2.all.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\applectura\app\views/layouts/register.blade.php ENDPATH**/ ?>