<?php
/**
 * Render scoreboard
 * 
 */

$i = 0;
if ( isset( $scores ) && !empty( $scores ) ) : ?>

    <table width="100%" id="scoreboard">

        <tr>
            <td></td>
            <td><b>Namn</b></td>
            <td><b>Po&auml;ng</b></td>
            <td><b>L&auml;gg till vinst</b></td>
        </tr>

        <?php foreach ( $scores as $score ) : ?>
            <?php if ( 0 == $score[ 'points' ] ) continue; ?>
            <?php $i++; ?>
            <tr>
                <td>
                    <?php if ( 1 == $i ) : ?>
                        <img src="/assets/images/star.gif" height="30px">
                    <?php endif; ?>
                </td>
                <td><?php echo str_replace(array('å', 'ä', 'ö', 'Å', 'Ä', 'Ö'), array('&aring;', '&auml;', '&ouml;', '&Aring;', '&Auml;', '&Ouml;'), $score['name']); ?></td>
                <td>
                    <?php 
                        $this->getPointsGifs( 
                            $score[ 'points' ], 
                            '/assets/images/', 
                            '.gif', 
                            array( 'height' => '25px' )
                        );
                    ?>
                <td>
                    <?php include __DIR__ . '/components/score-form.php'; ?>
                </td>
            </tr>

        <?php endforeach; ?>
        
        
    </table>
    <br /><br />
    <a href="/players">Add player</a>
<?php else : ?>

    <h3>Du m&aring;ste spela n&aring;gra spel f&ouml;rst.</h3>

<?php endif;