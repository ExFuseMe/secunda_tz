<?php

namespace App\Http\Controllers;


/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *     description="Документация REST API проекта",
 * ),
 *
 * @OA\SecurityScheme(
 *     securityScheme="Authorization",
 *     type="apiKey",
 *     in="header",
 *     name="Authorization",
 *     description="Передавать API ключ в заголовке: Authorization: {API_KEY}"
 * ),
 *
 * @OA\Tag(
 *     name="Companies",
 *     description="Операции с организациями"
 * )
 */
abstract class Controller
{
    //
}
