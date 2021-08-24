<?php if($data['content']['rowCount'] > 0): ?>

<div class="table-responsive">

<table class="table table-sm table-hover" id="mainTable">

   <thead class="bg-light">
      <tr>
         <th>-- Accion --</th>
         <?php foreach($data['content']['data'][0] as $columna => $valorColumna): ?>
            <th><?= $data['diccionario'][$columna]['comentario'] ?></th>
         <?php endforeach; ?>
      </tr>
   </thead>

   <tbody>

      <?php foreach($data['content']['data'] as $producto): ?>

         <tr>
            <td>
                <a href="<?= APPURL.strtolower($data['table']) ?>/formEditar/<?= $producto[$data['camposClave'][$data['table']]] ?>">
                  <button class="btn btn-info">
                     <em class="fas fa-edit"></em>
                  </button>
               </a>
               <button class="btn btn-danger" onclick="ConfirmarEliminar('<?= APPURL.strtolower($data['table']) ?>/eliminar/<?= $producto[$data['camposClave'][$data['table']]] ?>', 'Esta seguro de eliminar este registro');">
                  <em class="fas fa-trash-alt"></em>
               </button>
            </td>

            <?php foreach($data['content']['data'][0] as $columna => $valorColumna): ?>
               
               <?php if($data['diccionario'][$columna]['tipo'] == 'password') : ?>

                  <td align="center"><em class="fas fa-ellipsis-h"></em><em class="fas fa-ellipsis-h"><em class="fas fa-ellipsis-h"><em class="fas fa-ellipsis-h"></td>

               <?php elseif($data['diccionario'][$columna]['tipo'] == 'moneda') : ?>

                  <td><span class="badge badge-success"><?= formatMoney($producto[$columna]) ?></span></td>

               <?php elseif($data['diccionario'][$columna]['tipo'] == 'long') : ?>

                  <td><span class="badge badge-info" title="Descripcion campo" data-toggle="popover" data-trigger="hover" data-content="<?= $producto[$columna] ?>">Long text</span></td>

               <?php else: ?>

                  <td><?= $producto[$columna] ?></td>

               <?php endif; ?>

            <?php endforeach; ?>

         </tr>

      <?php endforeach; ?>

   </tbody>
</table>

</div>

<?php endif; ?>
