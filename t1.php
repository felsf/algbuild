<?php if(isset($_POST['name']) && isset($_POST['city'])): ?>
<?= "Nome: ".$_POST['name'].", Cidade: ".$_POST['city']; ?>
<?php endif; ?>