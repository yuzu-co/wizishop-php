<?php

namespace Yuzu\Wizishop\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * AbstractRequestDefinition
 *
 * @author Jonathan Martin <john@yuzu.co>
 */
abstract class AbstractRequestDefinition implements RequestDefinitionInterface
{
    /**
     * @var array
     */
    private $optional = array();

    /**
     * @var array
     */
    private $required = array();

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $options = $resolver->resolve($options);
        foreach ($options as $optionName => $optionValue) {
            if ($resolver->isRequired($optionName)) {
                $this->required[$optionName] = $optionValue;
            } else {
                $this->optional[$optionName] = $optionValue;
            }
        }
    }

    /**
     * @return string
     */
    abstract public function getMethod();

    /**
     * @return string
     */
    abstract public function getBaseUrl();

    /**
     * @param $key
     * @param $value
     */
    public function addRequiredOption($key, $value)
    {
        $this->required[$key] = $value;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $url = $this->getBaseUrl();
        $options = $this->transformOptions();
        if ('GET' === $this->getMethod() && !empty($options)) {
            $url = sprintf('%s?%s', $url, http_build_query($options));
        }
        return $url;
    }
    
    public function removeOption($optionName)
    {
        if (isset($this->required[$optionName])) {
            unset($this->required[$optionName]);    
        } elseif($this->optional[$optionName]) {
            unset($this->optional[$optionName]);
        } 
    }
    
    /**
     * @return array
     */
    public function getBody()
    {
        return array();
    }
    
    public function authenticationRequired()
    {
        return true;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return array_merge($this->required, $this->optional);
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * @return array
     */
    protected function transformOptions()
    {
        return $this->getOptions();
    }
    
    protected function getUrlRoutingParameter($optionName)
    {
        $value = $this->getOptions()[$optionName];
        $this->removeOption($optionName);
        return $value;
    }
}