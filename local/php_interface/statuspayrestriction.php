<?php
use \Bitrix\Sale\Services\Base;
use \Bitrix\Sale\Internals\Entity;
use \Bitrix\Sale\Payment;
use \Bitrix\Sale\PaymentCollection;

class StatusPaySystemRestriction extends Base\Restriction
{
    public static function getClassTitle()
    {
        return 'ограничение по статусу заказа';
    }

    public static function getClassDescription()
    {
        return 'оплата будет доступна если товар не в статусе проверки';
    }

    public static function check($data, array $restrictionParams, $PaySystemId = 0)
    {
        if ($data["ORDER_STATUS"] === 'N' && $restrictionParams["ORDER_PARAM_CHECKBOX"] === 'Y')
        return false;

        return true;
    }

    public static function getParamsStructure($entityId = 0)
    {
        return array(
            "ORDER_PARAM_CHECKBOX" => array(
                'TYPE' => 'Y/N',
                'VALUE' => 'Y',
                'LABEL' => 'Запретить оплату в статусе проверки'
            )
        );
    }

    /**
     * @param Entity $entity
     *
     * @return array
     */
    protected static function extractParams(Entity $entity)
    {

        $orderStatus   = null;

        if ($entity instanceof Payment) {

            /** @var PaymentCollection $collection */
            $collection = $entity->getCollection();
            /** @var Order $order */
            $order = $collection->getOrder();
            $orderStatus = $order->getField('STATUS_ID');

        }

        return array(
            'ORDER_STATUS' => $orderStatus,

        );

    }


}