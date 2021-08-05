<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note): ?>
        <ul>
            <li>Id <?php echo $note['id'] ?></li>
            <li>Title: <?php echo $note['title'] ?></li>
            <li><?php echo $note['content'] ?></li>
            <li>Created: <?php echo $note['created'] ?></li>
        </ul>
        <form method="POST" action="/?action=delete">
            <input name="id" type="hidden" value="<?php echo $note["id"] ?>" />
            <input type="submit" value="delete">
        </form>
    <?php else: ?>
        <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Return to notes list</button>
    </a>
</div>