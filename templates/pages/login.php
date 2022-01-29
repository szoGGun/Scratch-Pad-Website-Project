<div>
    <div>
        <form class="login-form" action="/?action=login" method="post">
            <ul>
                <li>
                    <label>Username: <span class="required">*</span></label>
                    <input type="text" name="username" id="username" class="field-long" required/>
                </li>
                <li>
                    <label>Password: <span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="field-long" required/>
                </li>
                <li>
                    <input type="submit" value="Login"/>
                    <?php if (isset($_SESSION['e_log'])){ echo $_SESSION['e_log']; unset($_SESSION['e_log']);}?>
                </li>
            </ul>
        </form>
    </div>
</div>