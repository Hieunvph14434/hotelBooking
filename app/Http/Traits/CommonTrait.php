<?php
namespace App\Http\Traits;

use App\Models\Category;
use Illuminate\Http\Response;

trait CommonTrait {
    public $message = [];
    public function findOrFailAndReturn($model, $id) {
        $result = $model::findOrFail($id);
        if(!$result || $result->deleted_at !== null){
            abort(Response::HTTP_NOT_FOUND);
        }
        return $result;
    }

    public function getListRoomType() {
        return Category::query()->orderByDesc("created_at")
        ->pluck('name', 'id');
    }
}