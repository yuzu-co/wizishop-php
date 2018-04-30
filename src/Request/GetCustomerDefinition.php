<?php

namespace Yuzu\Wizishop\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GetCustomerDefinition
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
class GetCustomerDefinition extends AbstractRequestDefinition
{
    public function getMethod()
    {
        return 'GET';
    }

    public function getBaseUrl()
    {
        return sprintf(
            '/v3/shops/%s/customers/%s',
            $this->getUrlRoutingParameter('shopId'),
            $this->getUrlRoutingParameter('customerId')
        );
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'shopId',
            'customerId'
        ]);
        $resolver->setRequired('shopId');
        $resolver->setRequired('customerId');
    }
}
