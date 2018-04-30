<?php

namespace Yuzu\Wizishop\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GetNewsletterSubscribersDefinition
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
class GetNewsletterSubscribersDefinition extends AbstractRequestDefinition
{
    public function getMethod()
    {
        return 'GET';
    }

    public function getBaseUrl()
    {
        return sprintf(
            '/v3/shops/%s/newsletter/subscribers',
            $this->getUrlRoutingParameter('shopId')
        );
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'email',
            'since_registration',
            'limit',
            'page'
        ]);
        $resolver->setRequired('shopId');
    }
}