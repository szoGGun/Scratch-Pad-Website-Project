<div class="admin">
            <section>
                <div class="error">
                    <?php
                    if (!empty($params['error'])) {
                        switch ($params['error']) {
                            case 'missingUserId':
                                echo 'Invalid user ID!';
                                break;
                            case 'userNotFound':
                                echo 'Note not found!';
                                break;
                        }
                    }
                    ?>
                </div>

                <div class="message">
                    <?php
                    if (!empty($params['before'])) {
                        switch ($params['before']) {
                            case 'deleted':
                                echo 'User was deleted';
                        }
                    }
                    ?>
                </div>

                <div class="tbl-header">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                    </table>
                </div>


                <div class="tbl-content">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <?php foreach ($params['users'] ?? [] as $users): ?>
                                <tr>
                                    <td><?php echo $users['usersID'] ?></td>
                                    <td><?php echo $users['login'] ?></td>
                                    <td><?php echo $users['email'] ?></td>
                                    <td><?php echo $users['password']?></td>
                                    <td>
                                        <form method="POST" action="/?action=deleteAdmin">
                                            <input name="id" type="hidden" value="<?php echo $users["usersID"] ?>" />
                                            <input type="submit" value="deleteAdmin">
                                        </form>
                                        <a href="/?action=edit&id=<?php echo $users['usersID']?>">
                                            <button>Edit</button>
                                        </a>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
    </div>
