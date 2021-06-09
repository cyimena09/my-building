<!--        Message d'information-->
<?php if (!empty($successMessage)): ?>
    <div class="container-info bg-success">
        <p><?php echo $successMessage ?></p>
    </div>
<?php endif ?>

<?php if (!empty($errorMessage)): ?>
    <div class="container-info bg-error">
        <p><?php echo $errorMessage ?></p>
    </div>
<?php endif ?>