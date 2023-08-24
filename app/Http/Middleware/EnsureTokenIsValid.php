<?php

namespace App\Http\Middleware;

use App\Models\AppUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('token');

        if ($token == null || $token == '') {
            return response()->json([
                'code' => JsonResponse::HTTP_UNAUTHORIZED,
                'status' => false,
                'message' => __('messages.please_provide_valid_api_token')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }
        try {
            $appUser = AppUser::where('api_token', $token)->firstOrFail();
            $request->merge(['authUserId' => $appUser->id]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => JsonResponse::HTTP_UNAUTHORIZED,
                'status' => false,
                'message' => __('messages.unauthorized_access')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        } catch (QueryException $exception) {
            return response()->json([
                'code' => JsonResponse::HTTP_UNAUTHORIZED,
                'status' => false,
                'message' => __('messages.unauthorized_access')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
