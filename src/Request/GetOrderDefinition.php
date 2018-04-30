<?php

namespace Yuzu\Wizishop\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GetOrderDefinition
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
class GetOrderDefinition extends AbstractRequestDefinition
{
    public function getMethod()
    {
        return 'GET';
    }

    public function getBaseUrl()
    {
        return sprintf(
            '/v3/shops/%s/orders/%s',
            $this->getUrlRoutingParameter('shopId'),
            $this->getUrlRoutingParameter('orderId')
        );
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'shopId',
            'orderId'
        ]);
        $resolver->setRequired('shopId');
        $resolver->setRequired('orderId');
    }
}