<?php

declare(strict_types=1);

namespace App\Crud;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryCrud
{
    private const RULES_FOR_VALIDATION_OFFICIAL_SITE = [
        'official_site' => 'nullable|min:5'
    ];
    private const RULES_FOR_VALIDATION = [
        'name' => 'required|unique:categories|min:2|max:255',
        'official_site' => self::RULES_FOR_VALIDATION_OFFICIAL_SITE['official_site']
    ];

    /**
     *
     * @param int $paginatePage
     * @param string $orderByColumn
     * @return LengthAwarePaginator
     */
    public function read(int $paginatePage = 0, string $orderByColumn = 'name'): LengthAwarePaginator
    {
        $categories = Category::query()->orderBy($orderByColumn)->paginate($paginatePage);
        return $categories;
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function create(Request $request): Category
    {
        $request->validate(self::RULES_FOR_VALIDATION);
        $category = new Category();
        $category->name = $request->name;
        $category->official_site = $request->official_site;
        $category->save();

        return $category;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function update(Request $request, int $id)
    {
        $category = Category::query()->find($id);
        if($category){
            if($category->name != $request->name) {
                $request->validate(self::RULES_FOR_VALIDATION);
                $category->name = $request->name;
            } else {
                $request->validate(self::RULES_FOR_VALIDATION_OFFICIAL_SITE);
            }

            $category->official_site = $request->official_site;
            $category->save();
        }
        return $category;
    }



    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $resultStatus = false;
        $category = Category::query()->where('id', '=', $id);
        if($category !== null) {
            $category->delete();
            $resultStatus = true;
        }
        return $resultStatus;
    }
}
