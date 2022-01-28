<div class="show">
    <?php $notes = $params['notes'] ?? null; ?>
    <?php if ($notes): ?>
        <ul>
            <li>Id <?php echo $notes['id'] ?></li>
            <li>Title: <?php echo $notes['title'] ?></li>
            <li>Content: <?php echo $notes['content'] ?></li>
            <li>Created: <?php echo $notes['created'] ?></li>
        </ul>
        <form method="POST" action="/?action=delete">
            <input name="id" type="hidden" value="<?php echo $notes["id"] ?>" />
            <input type="submit" value="delete">
        </form>
    <?php else: ?>
        <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Return to notes list</button>
    </a>
</div>