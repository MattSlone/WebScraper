<?php
require 'layout.php';
unset($data['title']);
?>
        <h2>Results</h2>
        <section class="results">
            <?php
            foreach($data as $key => $value)
            {
            ?>
            <section>
                <label class="results__label">Result  <?= $key + 1 ?>: </label>
                <?php
                    foreach($value as $key => $result)
                    {
                ?>
                <section>
                    <label class="results__result__key"><?= $key ?>:</label>
                    <?= $this->encode($result); ?>
                </section>
                <?php
                    }
                ?>
            </section>
            <hr>
            <?php
            }
            ?>
        <section>
    </body>
</html>
