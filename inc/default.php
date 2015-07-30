<!DOCTYPE HTML>
<html lang="en_EN">
<head>
<meta charset="UTF-8" />
<title>Mail preview</title>
<link rel="stylesheet" type="text/css" href="assets/style.css" />
</head>
<body>
<div class="side">
<h1>Mail preview</h1>

<?php echo $inteGentoEmailTester->displayMessages(); ?>

<form id="integento-form" action="" method="get">

<?php

/* Templates */
echo '<p><label for="template">Template :</label><br />';
echo '<select id="template" name="template">';
foreach ($templates as $tpl_id => $template) {
    $tplName = $tpl_id;
    if (isset($template['name'])) {
        $tplName = $template['name'];
    }
    echo '<option value="' . $tpl_id . '"">' . $tplName . '</a></li>';
}
echo '</select></p>';

/* Stores */
echo '<p><label for="store">Store :</label><br />';
echo '<select id="store" name="store">';
$i = 0;
$_lastGroup = '';
foreach ($_stores as $storeId => $store) {
    $_groupName = $store->getGroup()->getName();
    if ($_groupName != $_lastGroup) {
        if ($i > 0) {
            echo '</optgroup>';
        }
        echo '<optgroup label="' . $_groupName . '">';
        $_lastGroup = $_groupName;
    }
    $_isCurrent = isset($_SESSION['integento__emailtester__store']) && $_SESSION['integento__emailtester__store'] == $storeId;
    echo '<option ' . ($_isCurrent ? 'selected="selected"' : '') . ' value="' . $storeId . '"">' . $store->getName() . '</a></li>';
    $i++;
}
echo '</optgroup>';
echo '</select></p>';

/* Email */
echo '<p id="box-email"><label for="email">Email</label><br /><input type="email" id="email" name="email" value="'.(isset($_SESSION['integento__emailtester__email']) ? $_SESSION['integento__emailtester__email'] : '').'" /></p>';

?>
<button type="submit" onclick="document.getElementById('integento-form').target='preview';" name="submit">Preview</button>
<button type="submit" onclick="document.getElementById('integento-form').target='_self';return confirm('Do you really want to save this email into the admin templates list ?');" name="save_admin_tpl">Save as Template</button>
<button type="submit" onclick="document.getElementById('integento-form').target='_self';" name="send" autocomplete="email">Send by email</button>
</form>
</div>
<div class="preview"><iframe name="preview" frameborder="0"></iframe></div>
</body></html>