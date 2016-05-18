<?php
class eZURLFilterChineseTransliteration
{
    function process( $text, $languageObject, $caller )
    {
        $ini = eZINI::instance();
        $translatorType = $ini->variable( 'URLChineseTransliteration', 'type' );
        if( $languageObject->attribute( 'locale' ) == 'chi-CN' )
        {
            if( $translatorType == 'date' )
            {
                $separator  = eZCharTransform::wordSeparator();
                $now = time();
                $dateTime = date( 'Y', $now ) . date( 'm', $now ) . date( 'd', $now );
                $text .= $dateTime . $separator . $caller->attribute( 'node_id' );
            }
            else if( $translatorType == 'pinyin' )
            {
                //todo: add pinyin translator
//                $pinyin = new Pinyin();
//                $text .= $pinyin->c( $text );
            }
            else if( $translatorType == 'encode' )
            {
                //todo: add default encoding
                //$text .= transliterate( $text, array( 'han_transliterate', 'diacritical_remove' ), 'utf-8', 'utf-8' );
            }
            else
            {
                $text .= $caller->attribute( 'node_id' );
            }

        }
        return $text;
    }
}
?>