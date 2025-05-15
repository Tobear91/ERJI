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
        // Nettoyage des valeurs nulles récursivement
        $cleanData = $this->removeNullValues($data);
        $response->getBody()->write((string)json_encode($cleanData, JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR));
        $response = $response->withStatus($status);
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Supprime récursivement toutes les valeurs nulles d'un tableau ou d'un objet.
     * @param mixed $data
     * @return mixed
     */
    private function removeNullValues(mixed $data): mixed
    {
        if (is_array($data)) {
            $filtered = array_map([$this, 'removeNullValues'], $data);
            return array_filter($filtered, fn($value) => $value !== null);
        }

        if (is_object($data)) {
            $vars = get_object_vars($data);
            $filtered = [];
            foreach ($vars as $key => $value) {
                $cleaned = $this->removeNullValues($value);
                if ($cleaned !== null) {
                    $filtered[$key] = $cleaned;
                }
            }
            return $filtered;
        }

        return $data;
    }
}
