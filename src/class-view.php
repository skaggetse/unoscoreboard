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

}