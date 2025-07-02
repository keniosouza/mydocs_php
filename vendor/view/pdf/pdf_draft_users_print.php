<!DOCTYPE html>
<html lang="pt-br">
<style>
    @page {
        size: <?php echo utf8_encode($resultConfiguration->preferences->page->width)?>cm <?php echo utf8_encode($resultConfiguration->preferences->page->height)?>cm;
        margin-left: <?php echo utf8_encode($resultConfiguration->preferences->page->body->margin_left)?>cm;
        margin-top: <?php echo utf8_encode($resultConfiguration->preferences->page->body->margin_top)?>cm;
        margin-right: <?php echo utf8_encode($resultConfiguration->preferences->page->body->margin_right)?>cm;
        margin-bottom: <?php echo utf8_encode($resultConfiguration->preferences->page->body->margin_bottom)?>cm;
    }


    table, td, th {
        margin: 0 !important;
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
</style>
<body>
<header style="margin-left: <?php echo utf8_encode($resultConfiguration->preferences->page->header->margin_left) ?>cm; margin-top: <?php echo utf8_encode($resultConfiguration->preferences->page->header->margin_top) ?>cm; margin-right: <?php echo utf8_encode($resultConfiguration->preferences->page->header->margin_right) ?>cm; margin-bottom: <?php echo utf8_encode($resultConfiguration->preferences->page->header->margin_bottom) ?>cm;">
    <?php echo utf8_encode(base64_decode($resultConfiguration->preferences->page->header->content)) ?>
</header>
<div>
    <?php echo @(string)base64_decode($resultDraftsUsers->text) ?>
</div>
<footer style="margin-left: <?php echo utf8_encode($resultConfiguration->preferences->page->footer->margin_left) ?>cm; margin-top: <?php echo utf8_encode($resultConfiguration->preferences->page->footer->margin_top) ?>cm; margin-right: <?php echo utf8_encode($resultConfiguration->preferences->page->footer->margin_right) ?>cm; margin-bottom: <?php echo utf8_encode($resultConfiguration->preferences->page->footer->margin_bottom) ?>cm;">
    <?php echo utf8_encode($resultConfiguration->preferences->page->footer->content) ?>
</footer>
</body>
</html>