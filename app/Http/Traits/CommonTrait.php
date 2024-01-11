<?php
namespace App\Http\Traits;

use Illuminate\Http\Response;

trait CommonTrait {
    public function findOrFailAndReturn($model, $id) {
        $result = $model::findOrFail($id);
        if(!$result || $result->deleted_at !== null){
            abort(Response::HTTP_NOT_FOUND);
        }
        return $result;
    }
}