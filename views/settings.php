<div class="wrap">
    <h1><?php esc_html_e(get_admin_page_title()); ?></h1>
    <p class="info">Rozšírenie je aktívne</p>
</div>

<?php



?>

<form method="post" action="<?php Puc_v4_Factory::buildUpdateChecker(
                                'https://jsdizajner.local/update/?action=get_metadata&slug=jsdizajner-framework', //Metadata URL.
                                __FILE__, //Full path to the main plugin file.
                                'jsdizajner-framework' //Plugin slug. Usually it's the same as the name of the directory.
                            ); ?>">
<input type="submit" value="Update">
</form>