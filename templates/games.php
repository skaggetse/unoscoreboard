<?php
/**
 * List games
 */

 $i = 0;

if ( isset( $games ) && !empty( $games ) ) : ?>

    <table width=100%>
        <tr>            
            <td>
                <a href="<?php echo sprintf( '?month=%s', date( 'Y-m', strtotime( $month . ' -1 month') ) ); ?>">
                    <img src="/assets/images/previous.gif" alt="">
                </a>
            </td>
            <td colspan=4>
                <h1><?php echo sprintf( 'Spelade spel i %s: %s', date('F', strtotime( $month )), count( $games )  ); ?></h1>
            </td>
            <td>
                <a href="<?php echo sprintf( '?month=%s', date( 'Y-m', strtotime( $month . ' +1 month') ) ); ?>">
                    <img src="/assets/images/next.gif" alt="">
                </a>
            </td>
        </tr>
    </table>
    <?php
        include __DIR__ . '/components/game-stats.php'; 
    ?>

    <table width=100%>
        <tr>
            <td><b>Spelat</b></td>
            <td><b>Vinnare</b></td>
            <td><b>Radera spel</b></td>
        </tr>
        <?php foreach ( $games as $game ) : ?>
            <?php $i++; ?>
            <tr>
                <td><?php echo date( 'd M h:i', strtotime( $game->game->timestamp ) ); ?></td>
                <td><?php echo $game->player->name; ?>
                <?php echo $game->player->id; ?></td>
                <td>
                    <?php
                        if ( 1 === $i ) {
                            include __DIR__ . '/components/game-form.php'; 
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
 
<?php else : ?>
    
    <h3>Du har inte spelat n&aring;gra spel</h3>
 
<?php endif; ?>    