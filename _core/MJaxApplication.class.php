<?php
/* 
 * This handles most of the misc and core MJaxFunctionality
 */
abstract class MJaxApplication{
    public static $arrCssClasses = array();
    /**
     * This function should only be called from inside of the MJaxCssClass __construct method
     * @param <type> $objCssClass
     */
    public static function RegisterCssClass($objCssClass){
        if(key_exists($objCssClass->ClassName, self::$arrCssClasses)){
            throw new QCallerException("Class '" . $objCssClass->ClassName . "' already exists. Please use the 'CssClass' method to get the MJaxCssClass");
        }

        self::$arrCssClasses[$objCssClass->ClassName] = $objCssClass;
        
    }
    /**
     *
     * Call this function to select a css class for editing
     * @param <type> $strCssClassName
     * @return <type>
     */
    public static function CssClass($strCssClassName){
       if(key_exists($strCssClassName, self::$arrCssClasses)){
           return self::$arrCssClasses[$strCssClassName];
       }else{
           return new MJaxCssClass($strCssClassName);
       }
    }
    
    public static function ConvertArrayToJason($arrProperties){
        $strProperties = "{";
        if(count($arrProperties) > 0){
            foreach($arrProperties as $strKey=>$strValue){
                if(is_array($strValue)){
                    $strValue = MJaxApplication::ConvertArrayToJason($strValue);
                }else{
                    if(!is_numeric($strValue) && (strpos($strValue, "'") === false)){
                        $strValue = "'" . $strValue . "'";
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
    public static function HasParent($mixClass, $mixParent){
        if(!is_string($mixParent)){
            $strParentName = get_class($mixParent);
        }else{
            $strParentName = $mixParent;
        }
        $arrParents = class_parents($mixClass, true);
        foreach($arrParents as $strParentNameTest){
            if($strParentName == $strParentNameTest){
                return true;
            }
        }
        return false;
    }
}
?>