<?php

use Library\Models\Customer;
use Library\Resources\CustomerResource;
use PHPUnit\Framework\TestCase;

final class CustomerResourceTest extends TestCase
{
    public function testShouldReturnOneCustomerResource()
    {
         // Arrange
         $resource = new CustomerResource();
         $mockBook = $this->createMock(Customer::class);
 
         $mockId = 1;
         $mockName = "Jorge";
 
         $mockBook->method("id")->willReturn($mockId);
         $mockBook->method("name")->willReturn($mockName);
 
         // Act
         $result = $resource->format($mockBook);
 
         $expected = [
             "id" => 1,
             "name" => $mockName
         ];
 
         // Assert
         $this->assertEquals($expected, $result);
    }
}

?>