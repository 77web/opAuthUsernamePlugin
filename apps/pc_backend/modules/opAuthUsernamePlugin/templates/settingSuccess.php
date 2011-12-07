<?php slot('title', __('opAuthUsernamePlugin setting')); ?>

<form action="<?php echo url_for('opAuthUsernamePlugin/setting') ?>" method="post">
<table>
<?php echo $form ?>
<tr>
<td colspan="2"><input type="submit" value="<?php echo __('Save') ?>" class="input_submit" /></td>
</tr>
</table>
</form>