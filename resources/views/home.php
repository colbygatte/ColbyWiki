<?php /** @var \Wiki\Renderer $renderer */ ?>
<?php $renderer->extend('layouts.content'); ?>

<?php $renderer->start('body'); ?>
    <?php echo $name; ?>
<?php $renderer->end(); ?>
