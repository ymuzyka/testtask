<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\LinkInterface;
use App\Interfaces\RegisterInterface;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('register.index');
    }

    public function register(
        RegisterRequest $request,
        RegisterInterface $registerService,
        LinkInterface $linkService,
    ): JsonResponse {
        $inputs = $request->validated();
        $userId = $registerService->register($inputs['name'], $inputs['phone_number']);
        $request->session()->put('userId', $userId);

        return response()->json([
            'link' => route('link.index', ['link' => $linkService->create($userId)])
        ]);
    }
}
