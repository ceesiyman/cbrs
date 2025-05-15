<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="CBRS API Documentation",
 *     version="1.0.0",
 *     description="API for Construction Bidding and Recruitment System",
 *     @OA\Contact(
 *         email="support@cbrs.com",
 *         name="CBRS Support"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="CBRS API Server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Tag(
 *     name="Constructors",
 *     description="API endpoints for constructor-related operations"
 * )
 * 
 * @OA\Tag(
 *     name="Works",
 *     description="API endpoints for work/project-related operations"
 * )
 * 
 * @OA\Tag(
 *     name="Skills",
 *     description="API endpoints for skill-related operations"
 * )
 * 
 * @OA\Tag(
 *     name="Construction",
 *     description="API endpoints for construction-related operations"
 * )
 */
class SwaggerController extends Controller
{
    // This controller is just for Swagger annotations
} 