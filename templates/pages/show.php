<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note): ?>
    <ul>
        <li>Id <?php echo (int) $note['id'] ?></li>
        <li>Title: <?php echo htmlentities($note['title']) ?></li>
        <li><?php echo htmlentities($note['content']) ?></li>
        <li>Created: <?php echo htmlentities($note['created']) ?></li>
    </ul>

    <?php else: ?>
    <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Notes list</button>
    </a>
</div>