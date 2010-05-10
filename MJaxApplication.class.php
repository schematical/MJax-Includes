<?php
/* 
 * This handles most of the misc and core MJaxFunctionality
 */
abstract class MJaxApplication{

    public static function ConvertArrayToJason($arrProperties){
        $strProperties = "{\n";
        if(count($arrProperties) > 0){
            foreach($arrProperties as $strKey=>$strValue){
                if(is_array($strValue)){
                    $strValue = MJaxApplication::ConvertArrayToJason($strValue);
                }else{
                    if(!is_numeric($strValue)){
                        //$strValue = "'" . $strValue . "'";
                    }
                }
                $strProperties .=  sprintf("'%s':%s,\n", $strKey, $strValue);
            }
            //Remove Trailing ','
            $strProperties = substr($strProperties, 0, strlen($strProperties) -2);
        }
        $strProperties .= "}\n";
        return $strProperties;
    }
}
?>