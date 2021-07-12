<div>
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
    <h4> List of notes </h4>
    <b><?php echo $params['resultList'] ?? ""; ?></b>
</div>