<form class="login-form" action="/?action=logout" method="post">
    <?php
    session_start();
    session_destroy();
    ?>
</form>

