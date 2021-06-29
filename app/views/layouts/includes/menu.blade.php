<?php
// /* INSTANCIAR LA CLASE */
require_once '../app/models/menus.php';
$Menu = new Menus();
$menus = $Menu->menus_x_user();
?>
<aside class="main-sidebar elevation-4 sidebar-dark-primary">
    <a href="{{ BASE_URL }}principal" class="brand-link">
        <img src="{{ IMG_ROUTE }}default/your-logo2.png" alt="Logo" class="brand-image">
        <span class="brand-text font-weight-light text-white d-inline">
            <img src="{{ IMG_ROUTE }}default/your-text.png" alt="Logo" class="w-50">
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                foreach ($menus as $m) {
                    $modulo_id = $m['id'];
                    $modulo_nombre = $m['nombre'];
                    $modulo_icono = $m['icono'];
                    $arrow_down = "";
                    $modulos = $Menu->modulos_x_user($modulo_id);
                    if (count($modulos) > 0) $arrow_down = "<i class='fas fa-angle-left right'></i>";
                    ?>
                    <li class="nav-item parent has-treeview">
                        <a href="#" class="nav-link parent">
                            <i class="nav-icon {{$modulo_icono}}"></i>
                            <p>
                                {{$modulo_nombre}}
                                {!!$arrow_down!!}
                            </p>
                        </a>
                        <?php
                        if (count($modulos) > 0) {
                            echo "<ul class='nav nav-treeview'>";
                            $arrow_down = "<i class='fas fa-angle-left right'></i>";
                            foreach ($modulos as $v) {
                                $vista_nombre = $v['nombre'];
                                $vista_icono = $v['icono'];
                                $vista_url = BASE_URL . $v['url'];
                                ?>
                                <li class="nav-item child">
                                    <a href="{{$vista_url}}" class="nav-link child">
                                        <i class="nav-icon <?= $vista_icono; ?>"></i>
                                        <p><?= $vista_nombre; ?></p>
                                    </a>
                                </li>
                                <?php
                            }
                            echo "</ul>";
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</aside>