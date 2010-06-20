<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxTouchLocationData{
    protected $fltLat = null;
    protected $fltLong = null;
    protected $dttUpdated = null;
    public function __construct($fltLat = null, $fltLong = null, $dttUpdated = null) {
        if(!is_null($fltLat)){
            $this->fltLat = $fltLat;
            $this->fltLong = $fltLong;
            $this->dttUpdated = $dttUpdated;
        }else{
            $this->ParsePostData();
        }
    }
    public function ParsePostData(){
        if(key_exists('form_location', $_POST)){
            $arrParts = explode('/', $_POST['form_location']);
            $this->fltLat = $arrParts[0];
            $this->fltLong = $arrParts[1];
            $this->dttUpdated = QDateTime::Now();
        }
    }
    public function FindDistanceFrom($mixObj, $fltLong = null, $intConvert = null){
        if($mixObj instanceof MJaxTouchLocationData){
            $fltLat = $mixObj->Lat;
            $fltLong = $mixObj->Long;
        }elseif(is_float($mixObj) && is_float($fltLong)){
            $fltLat = $mixObj;
        }else{
            throw new QCallerException("Parameters must be either a 'MJaxTouchLocationData' object or two floats representing latitude and longitutde");
        }
        $fltDistDeg = sqrt(pow($this->Lat - $fltLat, 2) * pow($this->Long - $fltLong,2));
        if(is_null($intConvert)){
            $intConvert = YBDistance::DEG_FOOT;
        }
        $fltDistFeet = $fltDistDeg*$intConvert;
        return $fltDistFeet;
    }
    public function __get($strName) {
        switch ($strName) {
            case "Lat": return $this->fltLat;
            case "Long": return $this->fltLong;

            default:
                try {
                    return parent::__get($strName);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }
      /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "Lat":
                try {
                    return ($this->fltLat = QType::Cast($mixValue, QType::Float));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Long":
                try {
                    return ($this->fltLong = QType::Cast($mixValue, QType::Float));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }

            default:
                try {
                    return parent::__set($strName, $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }
}
?>
