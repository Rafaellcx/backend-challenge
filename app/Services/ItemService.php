<?php

namespace App\Services;

use App\Services\Contracts\ItemServiceContract;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ItemService implements ItemServiceContract {

    private string $legacyApiUrl = 'http://sf-legacy-api.now.sh';


    public function index(array $fields): JsonResponse
    {
        $page = $fields['page'] ?? 1;
        $perPage = $fields['perPage'] ?? 100;

        $response = Http::get("{$this->legacyApiUrl}/items");

        return $this->extracted(response: $response, calcStartIndex: true,perPage: $perPage, page: $page);
    }

    public function indexApiLegacy(array $fields): JsonResponse
    {
        $page = $fields['page'] ?? 1;
        $perPage = $fields['perPage'] ?? 100;

        $response = Http::get("{$this->legacyApiUrl}/items",[
            'page' => $page
        ]);

        return $this->extracted(response: $response,calcStartIndex: false,perPage: $perPage, page: $page);
    }

    /**
     * @param Response $response
     * @param bool $calcStartIndex
     * @param mixed $perPage
     * @param mixed $page
     * @return JsonResponse
     */
    private function extracted(Response $response, bool $calcStartIndex, mixed $perPage, mixed $page): JsonResponse
    {
        $legacyApiResponse = $response->json();

        # Gets the data and metadata
        $items = $legacyApiResponse['data'];
        $metadata = $legacyApiResponse['metadata'];

        // Calculates the total number of pages
        $totalPages = ceil($metadata['totalItems'] / $perPage);

        // Gets the current metadata page
        $currentPage = $page;

        // Calculates the starting and ending index for the current page

        if ($calcStartIndex) {
            $startIndex = (($currentPage - 1) * $perPage);
        } else {
            $startIndex = 0;
        }

        $endIndex = min($startIndex + $perPage, $metadata['totalItems']);

        // Gets the items for the current page
        $currentPageItems = array_slice($items, $startIndex, $endIndex - $startIndex);

        // Get the items for the current page
        return response()->json([
            'data' => $currentPageItems,
            'meta' => [
                'current_page' => (int)$currentPage,
                'per_page' => (int)$perPage,
                'total' => (int)$metadata['totalItems'],
                'total_pages' => $totalPages,
            ],
        ]);
    }
}
