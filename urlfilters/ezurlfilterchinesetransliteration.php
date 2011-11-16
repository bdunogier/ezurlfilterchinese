<?php
class eZURLFilterChineseTransliteration
{
    function process( $text, $languageObject, $caller )
    {
        if ( $languageObject->Locale == 'chi-CN' )
        {
            return transliterate( $text, array( 'han_transliterate', 'diacritical_remove' ), 'utf-8', 'utf-8' );
        }
        else
        {
            return $text;
        }
    }
}
?>