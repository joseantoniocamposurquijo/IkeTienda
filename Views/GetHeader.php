<h1>
   <em class="<?= $data['icon'] ?>"></em>&nbsp;<?= ucwords($data['table']) ?>
</h1>
<small class="text-muted px-5"><?= $data['description'] ?></small>

<div class="text-right my-3">
   <a href="<?= APPURL.strtolower($data['table']) ?>/formAgregar" class="btn btn-info">
      <em class="fas fa-plus"></em>&nbsp;Agregar registro
   </a>
</div>