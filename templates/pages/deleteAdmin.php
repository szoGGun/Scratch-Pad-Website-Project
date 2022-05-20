<div class="show">
    <?php $users = $params['users'] ?? null; ?>
    <?php if ($users): ?>
        <ul>
            <li>Id <?php echo $users['usersID'] ?></li>
            <li>Title: <?php echo $users['title'] ?></li>
            <li>Content: <?php echo $users['content'] ?></li>
            <li>Created: <?php echo $users['created'] ?></li>
        </ul>
        <form method="POST" action="/?action=deleteAdmin">
            <input name="id" type="hidden" value="<?php echo $users["usersID"] ?>" />
            <input type="submit" value="deleteAdmin">
        </form>
    <?php else: ?>
        <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Return to notes list</button>
    </a>
</div>