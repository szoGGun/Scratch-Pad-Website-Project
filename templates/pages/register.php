<div>
    <div>
        <form class="registration-form" action="/?action=register" method="post">
            <ul>
                <li>
                    <label>Username: <span class="required">*</span></label>
                    <input type="text" name="username" id="username" class="field-long" required/>
                    <?php if (isset($_SESSION['e_usr'])){ echo $_SESSION['e_usr']; unset($_SESSION['e_usr']);}?>

                </li>
                <li>
                    <label>Email: <span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="field-long" required/>
                    <?php if (isset($_SESSION['e_ema'])){ echo $_SESSION['e_ema']; unset($_SESSION['e_ema']);}?>
                </li>
                <li>
                    <label>Password: <span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="field-long" required/>
                    <?php if (isset($_SESSION['e_pas'])){ echo $_SESSION['e_pas']; unset($_SESSION['e_pas']);}?>
                </li>
                <li>
                    <label>Repeat Password: <span class="required">*</span></label>
                    <input type="password" name="password2" id="password2" class="field-long" required">
                </li>
                <li>
                    <input type="submit" value="Register"/>
                    <?php if (isset($_SESSION['e_git'])){ echo $_SESSION['e_git']; unset($_SESSION['e_git']);}?>
                </li>
            </ul>
        </form>
    </div>
</div>