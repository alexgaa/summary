<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Crud\CategoryCrud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /** @var CategoryCrud  */
    private $categoryCrud;

    public function __construct()
    {
        $this->categoryCrud = new CategoryCrud();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = $this->categoryCrud->read();

        return view('category.index', compact('categories'));
    }

    /**
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        return redirect()->route('category.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $category = $this->categoryCrud->create($request);

        $id = $category->id;
        $resultInHtml = view('category.store', compact('category'))->render();

        return  response()->json(compact('id', 'resultInHtml'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function show($id): RedirectResponse
    {
        return redirect()->route('category.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function edit($id): RedirectResponse
    {
        return redirect()->route('category.index');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $category = $this->categoryCrud->update($request, $id);
        $id = $category->id;
        $resultInHtml = view('category.update', compact('category'))->render();

        return  response()->json(compact('id', 'resultInHtml'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->categoryCrud->delete($id);
        return response()->json(['id' => $id]);
    }
}
