<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note): ?>
    <ul>
        <li>Id <?php echo $note['id'] ?></li>
        <li>Title: <?php echo $note['title'] ?></li>
        <li>Content: <?php echo $note['content'] ?></li>
        <li>Created: <?php echo $note['created'] ?></li>
    </ul>
    <a href="/?action=edit&id=<?php echo $note['id']?>">
       <button>Edit</button>
    </a>
    <?php else: ?>
    <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Return to notes list</button>
    </a>
</div>