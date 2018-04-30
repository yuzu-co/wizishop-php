<?php

namespace Yuzu\Wizishop\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * LoginDefinition
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
class LoginDefinition extends AbstractRequestDefinition
{
    public function getMethod()
    {
        return 'POST';
    }

    public function getBaseUrl()
    {
        return '/v3/auth/login';
    }
    
    public function authenticationRequired()
    {
        return false;
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'username',
            'password'
        ]);
        $resolver->setRequired('username');
        $resolver->setRequired('password');
    }
    
    public function getBody()
    {
        $options = $this->getOptions();
        return [
            'username' => $options['username'],
            'password' => $options['password']
        ];
    }
}
