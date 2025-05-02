<?php

namespace App\Application\Responder;

use Psr\Http\Message\ResponseInterface;

final readonly class JsonResponder
{
    /**
     * Encode les données en JSON et formate la réponse HTTP.
     * @param ResponseInterface $response
     * @param mixed $data
     * @param int $status
     * @return ResponseInterface
     */
    public function encodeAndAddToResponse(
        ResponseInterface $response,
        mixed $data = null,
        int $status = 200,
    ): ResponseInterface {
        $response->getBody()->write((string)json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR));
        $response = $response->withStatus($status);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
