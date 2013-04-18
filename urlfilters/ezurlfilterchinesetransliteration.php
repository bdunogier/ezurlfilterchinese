<?php

class eZURLFilterChineseTransliteration extends eZURLAliasFilter
{
	/**
	* Empty constructor
	*/
	public function __construct() {}

	/**
	* Transliterate the Chinese name of the object being published using pinyin
	*
	* @param string The text of the URL alias
	* @param object The eZContentObject object being published
	* @params object The eZContentObjectTreeNode in which the eZContentObject is published
	* @return string The transformed URL alias with the nodeID
	*/
	public function process( $text, &$languageObject, &$caller )
	{
		if( !$caller instanceof eZContentObjectTreeNode )
		{		
			eZDebug::writeError( 'The caller variable was not an eZContentObjectTreeNode', __METHOD__ );
			return $text;
		}

		if ( $languageObject->Locale == 'chi-CN' )
		{
			$transliterated = transliterate( $text, array( 'han_transliterate', 'diacritical_remove' ), 'utf-8', 'utf-8' );
				
			$upword = eZINI::instance('site.ini');
			$changewords = $upword->variable( 'ChineseURLAlias', 'Capitalize' );
			if( $changewords )
				return(str_replace(' ', '', ucwords($transliterated)));
			else
				return(str_replace(' ', '', $transliterated )); 
		}
		else
			return $text;
	}
}

?>
