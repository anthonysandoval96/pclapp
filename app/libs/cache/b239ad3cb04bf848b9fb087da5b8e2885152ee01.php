<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(APP_NAME); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->make('layouts.includes.env', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>fontawesome-free/css/all.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PLUGINS_ROUTE); ?>bootstrap/css/bootstrap.min.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>custom/css/all-fonts.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>custom/css/global.css?<?php echo e(CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo e(PUBLIC_ROUTE); ?>custom/css/custom.css?<?php echo e(CACHE_VERSION); ?>">
</head>

<body>
    <div id="app">
        <?php echo $__env->make('layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="spanner transaction text-white">
        <div class="spanner-content text-teal">
            <h3 class="mb-4">
                <div>Cargando ...</div>
                <div>espere un momento</div>
            </h3>
            <div class="spinner-border" style="width: 3rem; height: 3rem;"></div>
        </div>
    </div>
    <div class="spanner ajaxdata text-white">
        <div class="spanner-content text-white">
            <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"></div>
        </div>
    </div>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>jquery/jquery.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>bootstrap/js/bootstrap.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PUBLIC_ROUTE); ?>custom/js/global.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <script src="<?php echo e(PLUGINS_ROUTE); ?>sweetalert2/sweetalert2.all.min.js?<?php echo e(CACHE_VERSION); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\applectura\app\views/layouts/app.blade.php ENDPATH**/ ?>