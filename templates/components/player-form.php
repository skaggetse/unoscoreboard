<form action="updatePlayer" method="post">
    <input type="hidden" name="player_id" value="<?php echo $player->id; ?>">
    <input type="hidden" name="player_active" value="<?php echo $player->active ? 0 : 1 ?>">
    <input type="hidden" name="player_name" value="<?php echo $player->name; ?>">
    <input type="submit" value="<?php echo $player->active ? 'Deaktivera' : 'Aktivera'; ?>">
</form>