<!--NOTIFICATION EN CAS DE SUCCESS -->

<!-- Lorsque le message vient de l'URL -->
<?php if (isset($_GET['success-message'])): ?>
    <div class="container-info bg-success" style="color: white">
        <p><?php echo $_GET['success-message']; ?></p>
    </div>
<?php endif ?>
<!-- Lorsque le message viens du controller -->
<?php if (isset($successMessage)): ?>
    <div class="container-info bg-success">
        <p><?php echo $successMessage ?></p>
    </div>
<?php endif ?>

<!--NOTIFICATION EN CAS D'ECHEC -->

<!-- Lorsque le message vient de l'URL -->
<?php if (isset($_GET['error-message'])): ?>
    <div class="container-info bg-error">
        <p><?php echo $_GET['error-message']; ?></p>
    </div>
<?php endif ?>
<!-- Lorsque le message viens du controller -->
<?php if (isset($errorMessage)): ?>
    <div class="container-info bg-error">
        <p><?php echo $errorMessage; ?></p>
    </div>
<?php endif ?>

<!-- Lorsque le message vient du javascript -->
<div id="js-container-info" class="container-info"></div>

<div id="js-quick-info" class="container-info"></div>