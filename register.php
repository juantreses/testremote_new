<?php
$form = true;
$register_form = true;
require_once "lib/autoload.php";

$css = array( "style.css");

$viewService->basicHead($css, "Registratie"); ?>

<div class="container">
    <div class="row">

        <?php
//        var_dump($_SESSION);
        print $viewService->loadTemplate("register");
        ?>

    </div>
</div>

</body>
</html>