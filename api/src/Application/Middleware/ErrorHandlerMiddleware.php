<?php

namespace App\Application\Middleware;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Module\Validation\ValidationException;
use App\Application\Responder\JsonResponder;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    public function __construct(private JsonResponder $jsonResponder) {}

    /**
     * Permet de catcher les exceptions et de renvoyer une réponse JSON
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (UniqueConstraintViolationException $e) {
            $payload = [
                'error' => 'Unique constraint violation',
                'message' => 'The resource already exists.',
            ];

            return $this->createJsonErrorResponse($payload, 409);
        } catch (ValidationException $e) {
            $payload = [
                'errors' => $e->getErrors()
            ];
            return $this->createJsonErrorResponse($payload, 400);
        }
    }

    /**
     * Appelle le JsonResponder pour encoder les données et ajouter la réponse
     * @param array $payload
     * @param int $status
     * @return ResponseInterface
     */
    private function createJsonErrorResponse(array $payload, int $status): ResponseInterface
    {
        $response = new Response();
        return $this->jsonResponder->encodeAndAddToResponse($response, $payload, $status);
    }
}
