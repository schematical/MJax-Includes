<?php

    define("__MJAX__", __MLC__ . "/MJax");
    QApplicationBase::$ClassFile['MJaxApplication'] = __MJAX__ . '/MJaxApplication.class.php';
    QApplicationBase::$ClassFile['MJaxFormBase'] = __MJAX__ . '/MJaxFormBase.class.php';
    QApplicationBase::$ClassFile['MJaxForm'] = __MJAX__ . '/MJaxForm.class.php';
    QApplicationBase::$ClassFile['MJaxControl'] = __MJAX__ . '/MJaxControl.class.php';
    QApplicationBase::$ClassFile['MJaxControlBase'] = __MJAX__ . '/MJaxControlBase.class.php';
    QApplicationBase::$ClassFile['MJaxTextBox'] = __MJAX__ . '/MJaxTextBox.class.php';
    QApplicationBase::$ClassFile['MJaxButton'] = __MJAX__ . '/MJaxButton.class.php';
    QApplicationBase::$ClassFile['MJaxListBox'] = __MJAX__ . '/MJaxListBox.class.php';
    QApplicationBase::$ClassFile['MJaxListItem'] = __MJAX__ . '/MJaxListItem.class.php';
    QApplicationBase::$ClassFile['MJaxPanel'] = __MJAX__ . '/MJaxPanel.class.php';
    QApplicationBase::$ClassFile['MJaxNivoSlideShow'] = __MJAX__ . '/MJaxNivoSlideShow.class.php';
    QApplicationBase::$ClassFile['MJaxJqFancySlideShow'] = __MJAX__ . '/MJaxJqFancySlideShow.class.php';
    //header_asset
    QApplicationBase::$ClassFile['MJaxHeaderAsset'] = __MJAX__ . '/header_assets/MJaxHeaderAsset.class.php';
    QApplicationBase::$ClassFile['MJaxCssHeaderAsset'] = __MJAX__ . '/header_assets/MJaxCssHeaderAsset.class.php';
    QApplicationBase::$ClassFile['MJaxJSHeaderAsset'] = __MJAX__ . '/header_assets/MJaxJSHeaderAsset.class.php';
    QApplicationBase::$ClassFile['MJaxMetaHeaderAsset'] = __MJAX__ . '/header_assets/MJaxMetaHeaderAsset.class.php';
    //plugins
    QApplicationBase::$ClassFile['MJaxPluginBase'] = __MJAX__ . '/plugins/MJaxPluginBase.class.php';
    QApplicationBase::$ClassFile['MJaxSelectMenuPlugin'] = __MJAX__ . '/plugins/MJaxSelectMenuPlugin.class.php';
    QApplicationBase::$ClassFile['MJaxAnimatePlugin'] = __MJAX__ . '/plugins/MJaxAnimatePlugin.class.php';
    QApplicationBase::$ClassFile['MJaxQTipPlugin'] = __MJAX__ . '/plugins/MJaxQTipPlugin.class.php';
    QApplicationBase::$ClassFile['MJaxNivoSlideShowPlugin'] = __MJAX__ . '/plugins/MJaxNivoSlideShowPlugin.class.php';
    QApplicationBase::$ClassFile['MJaxJqFancySlideShowPlugin'] = __MJAX__ . '/plugins/MJaxJqFancySlideShowPlugin.class.php';

    require_once(__MJAX__ .  "/_enum.php");
    require_once(__MJAX__ .  "/_actions.php");
    require_once(__MJAX__ .  "/_events.php");
?>
