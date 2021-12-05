<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function Search(Request $request)
    {
        $recordsTotal = User::whereNotIn('is_admin', [1])->count();
        $fields = ['id', 'name', 'username', 'email', 'created_at', 'is_blocked'];
        $query = User::select($fields)->whereNotIn('is_admin', [1]);
        if (isset($request->search['value']) && !empty($request->search['value'])) {
            $value = $request->search['value'];
            $query = $query->where(function ($q) use ($fields, $value) {
                foreach ($fields as $single_field) {
                    $q->orWhere($single_field, 'like', "%$value%");
                }
            });
        }
        $query = $query->orderBy($fields[$request->order[0]['column']], $request->order[0]['dir']);
        $recordsFiltered = $query->count();
        $data = $query->skip($request->start)->take($request->length)->get();
        foreach ($data as $single_date) {
            if (!empty($single_date->is_blocked)) {
                $single_date->is_blocked = "<div class='form-check'><input class='form-check-input user-block-checkbox' type='checkbox' data-id='{$single_date->id}' checked></div>";
            } else {
                $single_date->is_blocked = "<div class='form-check'><input class='form-check-input user-block-checkbox' type='checkbox' data-id='{$single_date->id}'></div>";
            }
        }
        return array(
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );
    }

    public function Block(Request $request)
    {
        $user = User::find($request->id);

        $user->is_blocked = $request->status == 'true' ? 1 : 0;

        $user->save();
    }
}
