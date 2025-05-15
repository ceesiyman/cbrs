<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConstructionInquiryController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/construction/inquiry",
     *     operationId="inquiryConstruction",
     *     tags={"Construction"},
     *     summary="Ask a question about construction",
     *     description="Send a question about construction issues and get an AI-powered response",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"question"},
     *             @OA\Property(property="question", type="string", example="What is the current price range for cement in Dar es Salaam?")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="answer", type="string", example="The current price range for cement in Dar es Salaam is between TSh 17,000 and TSh 20,000 per 50kg bag depending on the brand and quality.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Question is required")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An error occurred while processing your request")
     *         )
     *     )
     * )
     */
    public function inquiry(Request $request)
    {
        try {
            $question = $request->input('question');
            
            if (!$question) {
                return response()->json(['error' => 'Question is required'], 400);
            }
            
            // This is a mock implementation - in a real scenario you would call an AI service
            // For demonstration, we're just returning a static response
            $answer = "Thank you for your question about \"$question\". In Dar es Salaam, cement prices typically range from TSh 17,000 to TSh 20,000 per 50kg bag depending on the brand, quality, and location of purchase.";
            
            return response()->json(['answer' => $answer]);
            
        } catch (\Exception $e) {
            Log::error('Construction Inquiry Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'An error occurred while processing your request',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 