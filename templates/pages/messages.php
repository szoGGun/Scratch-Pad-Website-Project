<div class="messages">
    <section>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Email</th>
                    <th>Topic</th>

                </tr>
                </thead>
            </table>
        </div>


        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="1">
                <tbody>
                <?php foreach ($params['questions'] ?? [] as $questions): ?>
                    <tr>
                        <td><?php echo $questions['id'] ?></td>
                        <td><?php echo $questions['question']?></td>
                        <td><?php echo $questions['email'] ?></td>
                        <td><?php echo $questions['topic'] ?></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>
