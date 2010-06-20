<?php
/* 
 * Handels the Auth functionality for the YB application
 */
abstract class YBAuthDriver extends MLCAuthDriver{
    public static function UpdateUserLocation($objLocationData){
        if(is_null($objLocationData)){
            return false;
        }
        $objUser = self::User();
        if(!is_null($objUser)){
            $objUser->LastLat = $objLocationData->Lat;
            $objUser->LastLong = $objLocationData->Long;
            $objUser->LastLocationUpdate = QDateTime::Now();
            $objUser->Save();
            return  true;
        }else{
            return false;
        }
    }
    public static function UserLocationData(){
        $objUser = self::User();
        if(!is_null($objUser)){
            $objData = new MJaxTouchLocationData($objUser->LastLat, $objUser->LastLong,$objUser->LastLocationUpdate);
            return $objData;
        }else{
            return null;
        }
    }
}
?>
