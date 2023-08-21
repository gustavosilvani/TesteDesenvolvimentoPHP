<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use src\Application\RegisterDependency;
use src\Domain\Interfaces\Services\UserServiceInterface;

class UserServiceTest extends TestCase
{
    public function testGetUsers()
    {
        $register = new RegisterDependency();
        $userService =  $register->registerDependency()->get(UserServiceInterface::class);
        $result = $userService->getUsers(10);
        $this->assertIsArray($result);
        $this->assertNotNull($result);
    }

}