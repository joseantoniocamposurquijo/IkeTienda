<div class="card p-5 my-5">
	<h1><?= $data['title'] ?></h1>

	<form action="<?= APPURL.$data['table'] ?>/<?= $data['accion'] ?>" method="post" id="mainForm" name="mainForm" role="form" enctype="multipart/form-data">

    <?php foreach($data['content']['data'] as $indice => $usuario): ?>

	   <?php if($data['diccionario'][$indice]['tipo'] == 'texto'): ?>

	   	<input type="text" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">

	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'lista'): ?>

	   	<select class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>">

	   		<?php foreach($data['listas'][$data['diccionario'][$indice]['lista']['tabla']] as $sublista): ?>

	   			<option value="<?= $sublista[$data['diccionario'][$indice]['lista']['clave']] ?>"><?= $sublista[$data['diccionario'][$indice]['lista']['valor']] ?></option>

	   		<?php endforeach; ?>

	   	</select>

	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'fechahora'): ?>

	   	<input type="datetime-local" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">


	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'numerico'): ?>

	   	<input type="number" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">

	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'moneda'): ?>

	   	<input type="number" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">

	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'porcentaje'): ?>

	   	<input type="number" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">
	   	
	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'password'): ?>
	   	
	   	<input type="password" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">

	   	<?php elseif($data['diccionario'][$indice]['tipo'] == 'imagen'): ?>

	   		<?php if($data['accion'] == 'agregar'): ?>

	   			<input type="file" class="form-control my-2" name="File_<?= $indice ?>" id="File_<?= $indice ?>" accept=".png,image/jpeg" onChange="appJsAddFile(this, 'PrImagen')">
	   			<input type="hidden" name="<?= $indice ?>" id="<?= $indice ?>" value="<?= $usuario ?>">

	   		<?php endif; ?>

	   <?php elseif($data['diccionario'][$indice]['tipo'] == 'clave'): ?>

		   	<?php if($data['accion'] == 'editar'): ?>

		   		<input type="text" class="form-control my-2" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>" disabled>

		   		<input type="hidden" name="<?= $indice ?>" id="<?= $indice ?>" value="<?= $usuario ?>">

		   	<?php else: ?>

		   		<input type="text" class="form-control my-2" name="<?= $indice ?>" id="<?= $indice ?>" placeholder="<?= $data['diccionario'][$indice]['comentario'] ?>" value="<?= $usuario ?>" maxlength="<?= $data['diccionario'][$indice]['longitud'] ?>">

		   	<?php endif; ?>

		<?php elseif($data['diccionario'][$indice]['tipo'] == 'auto'): ?>

			<input type="hidden" name="<?= $indice ?>" id="<?= $indice ?>" value="<?= $usuario ?>">

    	<?php endif; ?>

    <?php endforeach; ?>

    <div class="row">
    	<div class="col-sm-4">
        	<button type="reset" class="btn btn-success btn-block">Limpiar</button>
        </div>
        <div class="col-sm-4">
        	<button type="button" class="btn btn-outline-secondary btn-block" onclick="history.back();">Cancelar</button>
        </div>
        <div class="col-sm-4">
        	<button type="submit" class="btn btn-primary btn-block" name="btnAccion" id="btnAccion" value="<?= $data['accion'] ?>"><?= ucwords($data['accion']) ?></button>
			</div>
    </div>
	</form>
</div>