<?php

declare(strict_types=1);

namespace App\Crud;

use App\Models\PostType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostTypeCrud
{
    private const RULES_FOR_VALIDATION = [
        'name' => 'required|min:2|max:255',
        'category_id' => 'required'
    ];

    /**
     *
     * @param int $paginatePage
     * @param string $orderByColumn
     * @return LengthAwarePaginator
     */
    public function read(int $paginatePage = 0, string $orderByColumn = 'name'): LengthAwarePaginator
    {
        $postTypes = PostType::query()->orderBy($orderByColumn)->paginate($paginatePage);
        return $postTypes;
    }

    /**
     * @param Request $request
     * @return PostType
     */
    public function create(Request $request): PostType
    {
        $request->validate(self::RULES_FOR_VALIDATION);
        $postType = new PostType();
        $postType->name = $request->name;
        $postType->category_id = $request->category_id;
        $postType->save();

        return $postType;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function update(Request $request, int $id)
    {
        $postType = PostType::query()->find($id);
        if($postType){
            $request->validate(self::RULES_FOR_VALIDATION);
            $postType->name = $request->name;
            $postType->category_id = $request->category_id;
            $postType->save();
        }
        return $postType;
    }



    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $resultStatus = false;
        $postType = PostType::query()->where('id', '=', $id);
        if($postType !== null) {
            $postType->delete();
            $resultStatus = true;
        }
        return $resultStatus;
    }
}
