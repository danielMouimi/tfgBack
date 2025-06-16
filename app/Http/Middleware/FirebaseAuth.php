<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        dd();
        $idToken = $request->bearerToken();

        if (!$idToken) {
            return response()->json(['error' => 'No token provided'], 401);
        }

        try {
            $auth = (new Factory)
                ->withServiceAccount(storage_path(storage_path(config('firebase.credentials'))))
                ->createAuth();

            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            // Puedes guardar el UID en la request para usarlo en el controlador
            $request->merge(['firebase_uid' => $uid]);

        } catch (InvalidTokenStructure $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Token verification error: ' . $e->getMessage()], 500);
        }

        return $next($request);
    }
}

