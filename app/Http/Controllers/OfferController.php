<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Sponsor;
use App\Http\Controllers\View;
use App\Models\Country;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        $sponsors = Sponsor::all();
        $categories = Country::all();
        $countries = Country::all();

        return view('offer.index', compact('sponsors', 'categories', 'countries'));
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $offers = Offer::with('sponsor')
            ->with('categories')
            ->with('countries')
            ->paginate($per_page, ['id', 'name', 'link', 'sponsor_id', 'sponsor_offer_id', 'category_id', 'status', 'description', 'image_inter', 'image_banner', 'created_at',]);

        return $offers->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'sponsor_id' => 'required',
            'sponsor_offer_id' => 'required',
            'status' => 'required',
            'image_inter' => 'required',
            'image_banner' => 'required',
        ]);

        // countries object to array
        $countries = $request->countries;
        $country_ids = [];
        foreach ($countries as $item) {
            $country_ids[] = $item['id'];
        }

        print_r($country_ids);

        // saving to database
        $offer = new Offer;
        $offer->name = $request->name;
        $offer->link = $request->link;
        $offer->sponsor_id = $request->sponsor_id;
        $offer->sponsor_offer_id = $request->sponsor_offer_id;
        $offer->status = $request->status;
        $offer->description = $request->description;
        $offer->image_inter = $request->image_inter;
        $offer->image_banner = $request->image_banner;
        $offer->save();
        $offer->countries()->sync($country_ids);

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'sponsor_id' => 'required',
            'sponsor_offer_id' => 'required',
            'status' => 'required',
            'image_inter' => 'required',
            'image_banner' => 'required',
        ]);

        // countries object to array
        $countries = $request->countries;
        $country_ids = [];
        foreach ($countries as $item) {
            $country_ids[] = $item['id'];
        }

        print_r($country_ids);

        $offer = Offer::findOrFail($id);
        $offer->name = $request->name;
        $offer->link = $request->link;
        $offer->sponsor_id = $request->sponsor_id;
        $offer->sponsor_offer_id = $request->sponsor_offer_id;
        $offer->status = $request->status;
        $offer->description = $request->description;
        $offer->image_inter = $request->image_inter;
        $offer->image_banner = $request->image_banner;
        $offer->countries()->sync($country_ids);
        $offer->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return ['status' => 'deleted'];
    }
}
