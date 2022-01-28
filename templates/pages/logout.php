<form class="login-form" action="/?action=logout" method="post">
    <h1>User logged out</h1>
    <?php
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header('Location: http://notes.localhost/?action=login');
    die;
    ?>
</form>

