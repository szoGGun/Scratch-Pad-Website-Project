<div>
    <h3> Editing note </h3>
    <div>
        <?php if (!empty($params['notes'])): ?>
            <?php $notes = $params['notes']; ?>
            <form class="note-form" action="/?action=edit" method="post">
                <input name="id" type="hidden" value="<?php echo $notes['id'] ?>">
                <ul>
                    <li>
                        <label>Title<span class="required">*</span></label>
                        <input type="text" name="title" class="field-long" value="<?php echo $notes['title'] ?>"/>
                    </li>
                    <li>
                        <label>Content</label>
                        <textarea name="content" id="field5"
                                  class="field-long field-textarea"><?php echo $notes['content'] ?></textarea>
                    </li>
                    <li>
                        <input type="submit" value="Submit"/>
                    </li>
                </ul>
            </form>
        <?php else: ?>
            <div>
                No data to show
                <a href="/"><button>Return to notes list</button></a>
            </div>
        <?php endif; ?>
    </div>
</div>