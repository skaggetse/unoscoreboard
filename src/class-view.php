<?php
class View {

    private $_templateFolder =  __DIR__ . '/../templates';

    private function _getTemplate( $template, $data = false ) {

        if ( is_array( $data ) ) {
            extract( $data );
        }
        if ( file_exists( $this->_templateFolder . $template ) ) {
            include $this->_templateFolder . $template;
        } else {
            include $this->_templateFolder . '/404.php';
        }
        
    }

    private function _renderView( $template, $data = false ) {

        $this->_getTemplate( '/header.php' );
        $this->_getTemplate( $template, $data );
        $this->_getTemplate( '/footer.php' );

    }

    public function getView( $template, $data = false ) {
        if ( empty( $template ) ) return;
        $this->_renderView( $template, $data );
    }
    
    public function getPointsGifs( int $points, string $path, string $ext, array $args = array() ) {
        $points_arr = str_split( $points, 1);
        $args_str = array();
        if ( ! empty( $args ) ) {
            foreach ( $args as $key => $value ) {
                $args_str[] = sprintf( '%s="%s"', $key, $value );
            }
        }
        if ( is_array( $points_arr) ) {
            foreach ( $points_arr as $points_part ) {
                printf( '<img src="%1$s%2$s%3$s%4$s" %5$s>', $path, $points_part, '-' . random_int(1,4), $ext, implode( ' ', $args_str ) );
            }
        }
    }

}