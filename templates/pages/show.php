<div class="show">
    <?php $notes = $params['notes'] ?? null; ?>
    <?php if ($notes): ?>
    <ul>
        <li>Id <?php echo $notes['id'] ?></li>
        <li>Title: <?php echo $notes['title'] ?></li>
        <li>Content: <?php echo $notes['content'] ?></li>
        <li>Created: <?php echo $notes['created'] ?></li>
    </ul>
    <a href="/?action=edit&id=<?php echo $notes['id']?>">
       <button>Edit</button>
    </a>
    <?php else: ?>
    <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Return to notes list</button>
    </a>
</div>