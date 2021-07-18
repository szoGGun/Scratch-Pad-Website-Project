<div class="list">
    <section>
        <div class="error">
            <?php
            if (!empty($params['error'])) {
                switch ($params['error']) {
                    case 'missingNoteId':
                        echo 'Invalid note ID!';
                        break;
                    case 'noteNotFound':
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
                    case 'created':
                        echo 'Note created!';
                        break;
                }
            }
            ?>
        </div>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Options</th>
                </tr>
                </thead>
            </table>
        </div>

        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <?php foreach ($params['notes'] ?? [] as $note): ?>
                        <tr>
                            <td><?php echo htmlentities($note['id']) ?></td>
                            <td><?php echo htmlentities($note['title']) ?></td>
                            <td><?php echo htmlentities($note['created']) ?></td>
                            <td>
                                <a href="/?action=show&id=<?php echo (int) $note['id'] ?>">
                                    <button>Show Options</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;  ?>
                </tbody>
            </table>
        </div>
    </section>
</div>