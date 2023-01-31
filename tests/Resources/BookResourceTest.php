<?php

use Library\Models\Book;
use Library\Resources\BookResource;
use PHPUnit\Framework\TestCase;

final class BookResourceTest extends TestCase
{

    public function testShouldReturnOneFormatedResource()
    {
        // Arrange
        $resource = new BookResource();
        $mockBook = $this->createMock(Book::class);

        $mockId = 1;
        $mockName = "Lord of the Rings";

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

    public function testShouldReturnMultipleFormatedResources()
    {
        // Arrange
        $resource = new BookResource();        
        $mockBook1 = $this->createMock(Book::class);

        $mockId1 = 1;
        $mockName1 = "Lord of the Rings";

        $mockBook1->method("id")->willReturn($mockId1);
        $mockBook1->method("name")->willReturn($mockName1);

        $mockBook2 = $this->createMock(Book::class);

        $mockId2 = 2;
        $mockName2 = "The Hobbit";

        $mockBook2->method("id")->willReturn($mockId2);
        $mockBook2->method("name")->willReturn($mockName2);

        // Act
        $result = $resource->format([$mockBook1, $mockBook2]);

        $expectedOutput = [
            [
                "id" => $mockId1,
                "name" => $mockName1
            ],
            [
                "id" => $mockId2,
                "name" => $mockName2
            ]
        ];

        // Assert
        $this->assertEquals($expectedOutput, $result);
        $this->assertEquals(2, count($result));
    }
}

?>