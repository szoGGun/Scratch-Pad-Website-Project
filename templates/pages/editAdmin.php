<div>
    <h3> Editing note </h3>
    <div>
        <?php if (!empty($params['users'])): ?>
            <?php $users = $params['users']; ?>
            <form class="note-form" action="/?action=edit" method="post">
                <input name="id" type="hidden" value="<?php echo $users['usersID'] ?>">
                <ul>
                    <li>
                        <label>Username: <span class="required">*</span></label>
                        <input type="text" name="username" class="field-long" value="<?php echo $users['username']?>" />
                    </li>
                    <li>
                        <label> Email: <span class="required">*</span></label>
                        <input type="text" name="email" class="field-long" value="<?php echo $users['email'] ?>" />
                    </li>
                    <li>
                        <label>Password: <span class="required">*</span> </label>
                        <input type="text" name="password" class="field-long" value="<?php echo $users['password'] ?>"/>
                    </li>
                    <li>
                        <input type="submit" value="Submit"/>
                    </li>
                </ul>
            </form>
        <?php else: ?>
            <div>
                No data to show
                <a href="/?action=admin"><button>Return to users list</button></a>
            </div>
        <?php endif; ?>
    </div>
</div>