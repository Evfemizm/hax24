<?php
defined('_SEECRET') or die('Ай-яй-яй! Сюда нельзя!');
?>
<h1>Вы в космосе</h1>
<form action="" method="post">
   <select name="planet">
  
<?foreach($data['planets'] as $planets):?>
	<?if($planets["distance"] <= 10.0):?>
		<option value="<?=$planets['planet_id']?>"><?=$planets['planet_name']?></option>
	<?endif;?>
<?endforeach;?>
 </select>
  <input type="submit" value="Перелет" name="flight"><br>
  <input type="submit" value="Приземлиться" name="land">
  </form>