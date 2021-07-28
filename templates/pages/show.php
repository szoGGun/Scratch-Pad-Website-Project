<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note): ?>
    <ul>
        <li>Id <?php echo $note['id'] ?></li>
        <li>Title: <?php echo $note['title'] ?></li>
        <li><?php echo $note['content'] ?></li>
        <li>Created: <?php echo $note['created'] ?></li>
    </ul>

    <?php else: ?>
    <div>No notes to display</div>
    <?php endif; ?>
    <a href="/">
        <button>Notes list</button>
    </a>
</div>