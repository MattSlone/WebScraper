<?php require 'layout.php'; ?>
        <form action"/" method="POST">
            <section>
                <label for="url"><span>URL:</span><input type="text" name="url" placeholder="http://domain.com"></label>
            </section>
            <section>
                <label for="tagType">
                    <span>Tag(s):</span>
                    <select name="tagType">
                        <option value="a">Links</option>
                        <option value="title">Title(s)</option>
                        <option value="p">Paragraphs</option>
                    </select>
                </label>
            </section>
            <section class="checkboxes">
                <div>
                    <input type="checkbox" name="innerHTML" value="true">
                    <label for="innerHTML"><span>innerHTML</span></label>
                </div>
                <div>
                    <input type="checkbox" name="fullPage" value="true">
                    <label for="fullPage"><span>Full Page</span></label>
                </div>
            </section>
            <input type="submit" name="submit" value="Scrape">
        </form>
    </body>
</html>
