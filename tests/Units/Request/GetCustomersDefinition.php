<?php

namespace Yuzu\Wizishop\Tests\Units\Request;

use mageekguy\atoum;
use Yuzu\Effiliation\Enum\RegistrationStateTypeEnum;

class GetCustomersDefinition extends atoum\test
{
    public function testConstruct()
    {
        $this->given(
            $options = array(
                    'shopId' => 1
                )
        )
            ->if($this->newTestedInstance($options))
            ->then
            ->object($this->testedInstance)->isTestedInstance()
        ;
    }
}
