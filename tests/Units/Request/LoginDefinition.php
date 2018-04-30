<?php

namespace Yuzu\Wizishop\Tests\Units\Request;

use mageekguy\atoum;
use Yuzu\Effiliation\Enum\RegistrationStateTypeEnum;

class LoginDefinition extends atoum\test
{
    public function testConstruct()
    {
        $this->given(
                $options = array(
                    'username' => 'john@doe',
                    'password' => 'chuckN0331S'
                )
            )
            ->if($this->newTestedInstance($options))
            ->then
            ->object($this->testedInstance)->isTestedInstance()
        ;
    }

    public function testConstructWithMissingParams()
    {
        $this
            ->exception(
                function () {
                    $options = array(
                        'username' => 'john@doe'
                    );
                    $this->newTestedInstance($options);
                }
            )
        ;
    }
}