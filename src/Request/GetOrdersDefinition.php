<?php

namespace Yuzu\Wizishop\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GetOrdersDefinition
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
class GetOrdersDefinition extends AbstractRequestDefinition
{
    public function getMethod()
    {
        return 'GET';
    }

    public function getBaseUrl()
    {
        return sprintf(
            '/v3/shops/%s/orders',
            $this->getUrlRoutingParameter('shopId')
        );
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'shopId',
            'status_code',
            'customer_id',
            'id_greater_than',
            'start_date',
            'end_date',
            'query',
            'limit',
            'page',
            'sort',
            'tag',
        ]);
        $resolver->setRequired('shopId');
    }
}
