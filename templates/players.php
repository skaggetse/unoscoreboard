<?php
/**
 * Render scoreboard
 * 
 */

$i = 0;
if ( isset( $scores ) && !empty( $scores ) ) : ?>

    <table width="100%" id="players">
        <tr>
            <td><b>Lägg till</b></td>
            <td><b>Namn</b></td>
        </tr>
        
        <?php foreach ( $scores as $score ) : ?>
            <?php if ( 0 < $score[ 'points' ] ) continue; ?>
            <?php $i++; ?>
            <tr>
                <td>
                    <?php include __DIR__ . '/components/score-form.php'; ?>
                </td>
                <td><?php echo str_replace(array('å', 'ä', 'ö', 'Å', 'Ä', 'Ö'), array('&aring;', '&auml;', '&ouml;', '&Aring;', '&Auml;', '&Ouml;'), $score['name']); ?></td>
            </tr>

        <?php endforeach; ?>
        
        
    </table>
    
<?php else : ?>

    <h3>Du m&aring;ste spela n&aring;gra spel f&ouml;rst.</h3>

<?php endif;