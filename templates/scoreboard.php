<?php
/**
 * Render scoreboard
 * 
 */

$i = 0;
if ( isset( $scores ) && !empty( $scores ) ) : ?>

    <a href="/games">Add game</a><br /><br />
    <table width="100%" id="scoreboard">

        <tr>
            <td></td>
            <td><b>Namn</b></td>
            <td><b>Vinster</b></td>
            <td><b>F&ouml;rluster</b></td>
            <td></td>
        </tr>

        <?php foreach ( $scores as $score ) : ?>
            <?php if ( 0 == $score['stats']->games ) continue; ?>
            <?php $i++; ?>
            <tr>
                <td>
                    <?php if ( 1 == $i ) : ?>
                        <img src="/assets/images/star.gif" height="30px">
                    <?php endif; ?>
                </td>
                <td><?php echo str_replace(array('å', 'ä', 'ö', 'Å', 'Ä', 'Ö'), array('&aring;', '&auml;', '&ouml;', '&Aring;', '&Auml;', '&Ouml;'), $score['name']); ?></td>
                <td>
                    <?php echo $score['stats']->wins; ?>
                </td>
                <td>
                    <?php echo $score['stats']->losses; ?>
                </td>
                <td>
                    <?php $percentage = $score['stats']->wins ? floor( ( $score['stats']->wins / $score['stats']->games ) * 100 ) : 0; ?>
                    <?php
                        $this->getPointsGifs(
                            $percentage,
                            '/assets/images/',
                            '.gif',
                            array( 'height' => '25px' )
                        );
                   ?>
                   <img src="/assets/images/percent_0<?php echo rand(1, 2) ?>.gif" height="25px">
                </td>
            </tr>

        <?php endforeach; ?>
        
        
    </table>
<?php else : ?>

    <h3>Du m&aring;ste spela n&aring;gra spel f&ouml;rst.</h3>

<?php endif;