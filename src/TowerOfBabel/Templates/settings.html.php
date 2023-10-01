<?php

use TowerOfBabel\Hooks\Settings\SettingsForm;

/** @var SettingsForm $data */
$form = $data;
?>
<div class="wrap">
    <h1 class="tob-text-red-500"><?= $form->get_page_title() ?></h1>
    <pre>
        <?php var_dump(get_option($form->get_id())); ?>
    </pre>
    <form name="<?= $form->get_id() ?>" action="options.php" method="post">
        <?php foreach ($form->get_sections() as $section) { ?>
            <fieldset>
                <legend><?= $section->get_title() ?></legend>
                <?php foreach ($section->get_fields() as $field) { ?>
                    <label for="<?= $field->id ?>"><?= $field->label ?></label>
                    <input
                            type="<?= $field->type->value ?>"
                            value="<?= $field->value ?>"
                            id="<?= $field->id ?>"
                            name="<?= $field->id ?>"
                    />
                <?php } ?>
            </fieldset>
        <?php } ?>
        <?php
        // output save settings button
        submit_button(__('Save Settings', 'textdomain'));
        ?>
    </form>
</div>