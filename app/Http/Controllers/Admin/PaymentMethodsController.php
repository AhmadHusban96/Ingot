<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentMethodsController extends Controller
{
    public function Search(Request $request)
    {
        $recordsTotal = PaymentMethod::count();
        $fields = ['id', 'name', 'image', 'created_at'];
        $query = PaymentMethod::select($fields);
        if (isset($request->search['value']) && !empty($request->search['value'])) {
            $value = $request->search['value'];
            $query = $query->andWhere(function ($q) use ($fields, $value) {
                foreach (Arr::except($fields, 2) as $single_field) {
                    $q->orWhere($single_field, 'like', "%$value%");
                }
            });
        }
        $query = $query->orderBy($fields[$request->order[0]['column']], $request->order[0]['dir']);
        $recordsFiltered = $query->count();
        $data = $query->skip($request->start)->take($request->length)->with('currencies')->get();
        foreach ($data as $single_date) {
            $single_date->image = '<a href="/storage/' . $single_date->image . '" target="_blank"><img src="/storage/' . $single_date->image . '" class="rounded float-left width100"></a>';
            $currencies = array();
            foreach ($single_date->currencies as $single_currency) {
                $currencies[] = $single_currency->name;
            }
            $single_date->currencies_names = implode(',', $currencies);
        }
        return array(
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );
    }

    public function Create(Request $request)
    {
        $extension = explode('/', mime_content_type($request->image))[1];
        $image = str_replace('data:image/' . $extension . ';base64,', '', $request->image);
        $imageName = time() . Str::random(7) . '.' . $extension;
        Storage::disk('local')->put('public/' . $imageName, base64_decode($image));
        $id = PaymentMethod::create(['name' => $request->name, 'image' => $imageName])->id;
        $payment_method = PaymentMethod::find($id);
        foreach ($request->currencies as $single_currency) {
            $payment_method->currencies()->attach([
                $single_currency['id'] => [
                    'min_deposit' => $single_currency['min_deposit'],
                    'max_deposit' => $single_currency['max_deposit'],
                    'min_withdrawal' => $single_currency['min_withdrawal'],
                    'max_withdrawal' => $single_currency['max_withdrawal']
                ]
            ]);
        }
        return response('Success', 200);
    }

    public function Currencies(Request $request)
    {
        return Currency::all();
    }
}
