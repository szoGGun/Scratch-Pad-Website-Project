<div>
    <div>
        <form class="contact-form" action="/?action=contact" method="post">
            <ul>
                <li>
                    <label>Your email: <span class="required">*</span></label>
                    <input type="text" name="email" id="username" class="field-long" required/>
                </li>
                <li>
                    <label>Topic: <span class="required">*</span></label>
                    <input type="text" name="topic" id="username" class="field-long" required/>
                </li>
                <li>
                    <label>What's the problem?: </label>
                    <textarea name="question" id="field5" class="field-long field-textarea"></textarea>
                </li>
                <li>
                    <input type="submit" value="Submit"/>
                    <?php if (isset($_SESSION['c_git'])){ echo $_SESSION['c_git']; unset($_SESSION['c_git']);}?>

                </li>
            </ul>
        </form>
    </div>
</div>