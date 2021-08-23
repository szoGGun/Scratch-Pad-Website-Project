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
                        echo 'Note was created';
                        break;
                    case 'edited':
                        echo 'Note was edited';
                    case 'deleted':
                        echo 'Note was deleted';
                }
            }
            ?>
        </div>

        <?php
        $sort = $params['sort'] ?? [];
        $by = $sort['by'] ?? 'title';
        $order = $sort['order'] ?? 'desc';

        $page = $params['page'] ?? [];
        $size = $page['size'] ?? 10;
        $currentPage = $page['number'] ?? 1;
        $pages = $page['pages'] ?? 1;

        $phrase = $params['phrase'] ?? null;
        ?>

        <div>
            <form class="settings-form" action="/" method="GET">
                <div>
                    <label>Search by title: <input type="text" name="phrase" value="<?php echo $phrase?>" /></label>
                </div>
                <div>
                    <div>Sort by:</div>
                    <label>Title<input name="sortby" type="radio"
                                       value="title" <?php echo $by === 'title' ? 'checked' : '' ?> /></label>
                    <label>Date<input name="sortby" type="radio"
                                      value="created"<?php echo $by === 'created' ? 'checked' : '' ?> /></label>
                </div>
                <div>
                    <div>Sort order:</div>
                    <label>Descending <input name="sortorder" type="radio"
                                             value="desc" <?php echo $order === 'desc' ? 'checked' : '' ?>/></label>
                    <label>Ascending <input name="sortorder" type="radio"
                                            value="asc" <?php echo $order === 'asc' ? 'checked' : '' ?>/></label>
                </div>
                <div>
                    <div>Number of notes on page</div>
                    <label>1<input name="pagesize" type="radio" value="1"
                            <?php echo $size === 1 ? 'checked' : '' ?>/></label>
                    <label>5<input name="pagesize" type="radio" value="5"
                            <?php echo $size === 5 ? 'checked' : '' ?>/></label>
                    <label>10<input name="pagesize" type="radio" value="10"
                            <?php echo $size === 10 ? 'checked' : '' ?>/></label>
                    <label>25<input name="pagesize" type="radio" value="25"
                            <?php echo $size === 25 ? 'checked' : '' ?>/></label>
                </div>
                <input type="submit" value="send">
            </form>
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
                        <td><?php echo $note['id'] ?></td>
                        <td><?php echo $note['title'] ?></td>
                        <td><?php echo $note['created'] ?></td>
                        <td>
                            <a href="/?action=show&id=<?php echo $note['id'] ?>">
                                <button>Show details</button>
                            </a>
                            <a href="/?action=delete&id=<?php echo $note['id'] ?>">
                                <button>Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
        $paginationUrl = "&phrase=$phrase&pagesize=$size&sortby=$by&sortorder=$order"; ?>
        <ul class="pagination">
            <?php if ($currentPage !== 1): ?>
            <li>
                <a href="/?page=<?php echo $currentPage - 1 . $paginationUrl ?>">
                    <button><<</button>
                </a>
            </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li>
                    <a href="/?page=<?php echo $i . $paginationUrl ?>">
                        <button><?php echo $i ?></button>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $pages): ?>
            <li>
                <a href="/?page=<?php echo $currentPage + 1 . $paginationUrl ?>">
                    <button>>></button>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </section>
</div>