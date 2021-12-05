<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CurrenciesController extends Controller
{

    public function Search(Request $request)
    {
        $recordsTotal = Currency::count();
        $fields = ['id', 'name', 'created_at'];
        $query = Currency::select($fields);
        if (isset($request->search['value']) && !empty($request->search['value'])) {
            $value = $request->search['value'];
            $query = $query->andWhere(function ($q) use ($fields, $value) {
                foreach ($fields as $single_field) {
                    $q->orWhere($single_field, 'like', "%$value%");
                }
            });
        }
        $query = $query->orderBy($fields[$request->order[0]['column']], $request->order[0]['dir']);
        $recordsFiltered = $query->count();
        $data = $query->skip($request->start)->take($request->length)->get();
        return array(
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );
    }

    public function Create(Request $request)
    {
        $fields = $request->only('name');
        Currency::create($fields);
        return response('Success', 200);
    }

}
