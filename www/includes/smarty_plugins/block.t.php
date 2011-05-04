<?php
/*
 * @version $Id: block.t.php 133 2007-11-25 01:49:43Z mimait04 $
 */

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.t.php
 * Type:     block
 * Name:     t
 * Purpose:  translate a block of text
 * -------------------------------------------------------------
 */

/**
 * translate a block of text
 *
 * @param array $params
 * @param string $content
 * @param Smarty $smarty
 * @param array $repeat
 * @return string
 */
function smarty_block_t($params, $content, &$smarty, &$repeat){
    // only output on the closing tag
    if(!$repeat){
        if (isset($content)) {
            $lang = $params['lang'];
            // do some intelligent translation thing here with $content
            
            //debug_obj($params);
            
            #do replace 
            foreach((array)$params as $key => $value){
               
               #replace value with constant variable
               if($key == $value){
                  $value = constant($key); 
               }
               $content = str_replace('%'.$key.'%',$value,$content);
            }
            
            
            $translation = $content;
            return $translation;
        }
    }
}
?>