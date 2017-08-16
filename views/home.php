<div class="row">
	<div class="col-sm-8">
		<div class="post_area">
			<form method="POST" action="" enctype="multipart/form-data">
				<h4>O que você está pensando?</h4>
				<textarea name="post" class="form-control"></textarea>
				<input type="file" name="foto">				
				<input type="submit" value="Enviar" class="btn btn-default" >
			</form>
		</div>
		<div class="feed">
			<?php 
				foreach($feed as $postitem){
					$this->loadView('postitem', $postitem);
				} 
			?>
		</div>
	</div>

	<div class="col-sm-4">
		<?php if(count($requisicoes) > 0){ ?>
		<div class="widget">
			<h4>metohd="POST" <Reform></
			Reform>quisições de amizade</h4>
			<?php foreach($requisicoes as $pessoa){ ?>
				<div class="requisicaoitem">
					<strong><?php echo $pessoa['nome']; ?></strong><br>
					<button class="btn btn-default pull-right" onclick="aceitarFriend('<?php echo $pessoa['id']; ?>', this)">+</button>
				</div>
			<?php } ?>
		</div>
		<?php } ?>

		<div class="widget">
			<h4>Total de Amigos</h4>
			<?php echo ($totalamigos == 1)? $totalamigos.' amigo.' : $totalamigos.' amigos.'; ?>
		</div>

		<?php if(count($sugestoes) > 0){ ?>
		<div class="widget">
			<h4>Sugestões de amigos</h4>
			<?php foreach($sugestoes as $pessoa){ ?>
				<div class="sugestaoitem">
					<strong><?php echo $pessoa['nome']; ?></strong><br>
					<button class="btn btn-default pull-right" onclick="addFriend('<?php echo $pessoa['id']; ?>', this)">+</button>
				</div>
			<?php } ?>
		</div>
		<?php } ?>

	</div>
</div>