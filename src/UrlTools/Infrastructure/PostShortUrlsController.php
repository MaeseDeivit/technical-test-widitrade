<?php

declare(strict_types=1);

namespace Src\UrlTools\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Src\Shared\Infrastructure\Controller\ApiController;

final class PostShortUrlsController extends ApiController
{

    public function __invoke(Request $request)
    {
        try {
            $this->validateRequest($request);

            $url = $request->get('url');

            $response = Http::get($this->createCallServiceShortenUrl($url));
            return $this->successResponse(Response::HTTP_ACCEPTED,  $response->body());
        } catch (ValidationException $ex) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, 9001, $ex->getMessage());
        }
    }

    private function createCallServiceShortenUrl(string $url): string
    {
        return config('app.service_shorten_url_tinyurl.url') . '?url=' . $url;
    }

    private function validateRequest(Request $request): ?array
    {
        return $request->validate([
            'url' => 'string|required'
        ]);
    }
}
