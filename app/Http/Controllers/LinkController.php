<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\LinkInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function __construct(private LinkInterface $service)
    {
    }

    public function index(Request $request, string $link): View
    {
        $link = $this->service->get($link);

        if ($link === null) {
            return view('link.expired');
        }

        $request->session()->put('userId', $link->user_id);

        return view('link.index', [
            'link' => route('link.index', ['link' => $link->link])
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $userId = (int) $request->session()->get('userId');
        $link = $this->service->create($userId);

        return response()->json([
            'link' => route('link.index', ['link' => $link]),
        ]);
    }

    public function deactivate(Request $request, string $link): JsonResponse
    {
        $userId = (int) $request->session()->get('userId');
        $this->service->deactivate($link, $userId);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
