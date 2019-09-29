<?php

namespace App\Controller;

use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Util\ExceptionValueMap;
use FOS\RestBundle\View\View;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Exception controller.
 */
class ExceptionController extends AbstractFOSRestController
{
    /**
     * @var ExceptionValueMap
     */
    private $exceptionCodes;

    public function __construct(ExceptionValueMap $exceptionCodes) {
        $this->exceptionCodes = $exceptionCodes;
    }

    /**
     * Converts an Exception to a Response.
     * @param Exception|\Throwable $exception
     * @throws \InvalidArgumentException
     * @return View
     */
    public function showAction($exception): View
    {
        $code = $this->getStatusCode($exception);

        $data = [
            "error" => [
                "message" => $exception->getMessage(),
//                "exception" => FlattenException::create($exception),
            ]
        ];
        return $this->view($data, $code, $exception instanceof HttpExceptionInterface ? $exception->getHeaders() : []);
    }

    /**
     * Determines the status code to use for the response.
     * @param Exception $exception
     * @return int
     */
    protected function getStatusCode(Exception $exception): int
    {
        // If matched
        if ($statusCode = $this->exceptionCodes->resolveException($exception)) {
            return $statusCode;
        }

        // Otherwise, default
        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return 500;
    }
}
