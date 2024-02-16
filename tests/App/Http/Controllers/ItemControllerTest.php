<?php

namespace Tests\App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

# php artisan test --filter=ItemControllerTest
class ItemControllerTest extends TestCase
{
    # php artisan test --filter=ItemControllerTest::testItemsReturnsJsonResponse
    public function testItemsReturnsJsonResponse(): void
    {
        $data = [
            [
            'id' => "e906859036f847e68e58a577da9312a2",
            'absoluteIndex' => 0,
            'name' => "item-0"
            ],
            [
            'id' => "761ff52b8e6dd373fdf291a1a70df20c",
            'absoluteIndex' => 1,
            'name' => "item-1"
            ],
            [
            'id' => "38d3f385ea8d8bb2dcfc759ac85af6ef",
            'absoluteIndex' => 2,
            'name' => "item-2"
            ],
            [
            'id' => "65910a0fd76f69a08e6faa142384f327",
            'absoluteIndex' => 3,
            'name' => "item-3"
            ],
            [
            'id' => "05e4075a3f97ed7cb0bd40329caa2423",
            'absoluteIndex' => 4,
            'name' => "item-4"
            ]
        ];

        $meta =  [
            'current_page' => 1,
            'per_page' => 5,
            'total' => 1000000,
            'total_pages' => 200000
        ];

        $requestData = ['page' => 1, 'perPage' => 5];

        $response = $this->get(route('items', $requestData));
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertJson([
            'data' => $data,
            'meta' => $meta,
        ]);
    }

    # php artisan test --filter=ItemControllerTest::testIndexApiLegacyReturnsJsonResponse
    public function testIndexApiLegacyReturnsJsonResponse(): void
    {
        $data = [
            [
                'id' => "32de67278288437b48927274bd0735bd",
                'absoluteIndex' => 100,
                'name' => "item-100"
            ],
            [
                'id' => "fea10d6a371b42bc85a2ad77936d7ef3",
                'absoluteIndex' => 101,
                'name' => "item-101"
            ],
            [
                'id' => "ccc9bab0f0be2247c9c74e4ea2e6d213",
                'absoluteIndex' => 102,
                'name' => "item-102"
            ],
            [
                'id' => "c82a8df580994a85d10a186fec56536b",
                'absoluteIndex' => 103,
                'name' => "item-103"
            ],
            [
                'id' => "4e7dbbcf614ac9da1795b643a7198c9c",
                'absoluteIndex' => 104,
                'name' => "item-104"
            ]
        ];

        $meta =  [
            'current_page' => 2,
            'per_page' => 5,
            'total' => 1000000,
            'total_pages' => 200000
        ];

        $requestData = ['page' => 2, 'perPage' => 5];

        $response = $this->get(route('items-api-legacy', $requestData));
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertJson([
            'data' => $data,
            'meta' => $meta,
        ]);
    }
}
