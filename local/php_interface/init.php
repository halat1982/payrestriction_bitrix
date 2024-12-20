<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Dump.php';
Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'onSalePaySystemRestrictionsClassNamesBuildList',
    'statusPayFunction'
);

function statusPayFunction()
{
    return new \Bitrix\Main\EventResult(
        \Bitrix\Main\EventResult::SUCCESS,
        array(
            '\StatusPaySystemRestriction' => '/local/php_interface/statuspayrestriction.php',
        )
    );
}