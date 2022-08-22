<?php

namespace App\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Settings;
use App\Product\Models\Product;
use App\Product\Models\Brand;
use App\Product\Models\Category;
use App\Product\Models\ProductProperty;
use App\Product\Models\SystemSetting;

class ProductController extends Controller
{
    public function index(){

        $products = Product::orderBy('created_at', 'DESC')->paginate(20);
        $priceType = SystemSetting::where('type', 'para_birimi')->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('product::index', [
            'products' => $products,
            'priceType' => $priceType,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function edit(Product $product){

        $categories = Category::all();
        $brands = Brand::all();
        $priceType = SystemSetting::where('type', 'para_birimi')->get();
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'priceType' => $priceType,
            'brands' => $brands,
        ]);
    }

    public function detail(Product $product){

        $categories = Category::all();
        $brands = Brand::all();

        return view('products.detail', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1000',
        ]);

        try {

            if(!empty($request->file("image"))){

                $name = $request->file('image')->getClientOriginalName();

                $path = $request->file('image')->store('public/images');
            }

            $product = new Product();
            $product->fill([
                'image' => $name ?? null,
                'path' => $path ?? null,
                'title' => $request->title,
                'price' => $request->price ?? null,
                'seri_no' => $request->seri_no ?? null,
                'barcode_no' => $request->barcode_no ?? null,
                'price_type' => $request->price_type ?? null,
                'unit' => $request->unit ?? null,
                'category_id' => $request->category_id ?? null,
                'brand_id' => $request->brand_id ?? null,
            ])->save();

            return redirect()->back()->with('success', 'Ekleme Başarılı!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Bir Hata Oluştu!');
        }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $product->update([
                'title' => $request->title ?? null,
                'price' => $request->price ?? null,
                'price_type' => $request->price_type ?? null,
                'seri_no' => $request->seri_no ?? null,
                'barcode_no' => $request->barcode_no ?? null,
                'unit' => $request->unit ?? null,
                'category_id' => $request->category_id ?? null,
                'brand_id' => $request->brand_id ?? null,
            ]);


            return redirect()->back()->with('success', 'Düzenleme Başarılı!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Bir Hata Oluştu!');
        }
    }

    public function search_by_seri_no(Request $request) {
        if ($request->ajax()) {
            $payload = "";
            $products = Product::where('seri_no', $request->search)
                            ->get();
            if ($products) {
                foreach ($products as $product) {
                    if ($product->brand) {
                        $brand_name=$product->brand->title;
                    } else {
                        $brand_name='';
                    }

                    $payload .=
                    '
                    <div class="table-responsive mv-3">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Ürün Bilgileri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2" style="background-image: url(assets/img/006m.jpg);--tblr-avatar-size: 8.5rem;"></span>
                                            <div class="flex-fill">
                                                <input type="text" class="form-control mb-2" value="'.$product->title.'" readonly>
                                                <input type="hidden" name="product_id" class="form-control mb-2" value="'.$product->id.'">
                                                <dl class="row">
                                                    <dt class="col-2">Seri No</dt>
                                                    <dd class="col-4">'.$product->seri_no.'</dd>

                                                    <dt class="col-2">Barkod No</dt>
                                                    <dd class="col-4">'.$product->barcode_no.'</dd>

                                                    <dt class="col-2">Kategori</dt>
                                                    <dd class="col-10">'.$product->category->title.'</dd>

                                                    <dt class="col-2">Marka</dt>
                                                    <dd class="col-4">'.$brand_name.'</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fiyat</th>
                                    <th>Miktar</th>
                                    <th>Birim</th>
                                    <th>Toplam</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="input-icon mb-2">
                                            <span class="input-icon-addon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-lira" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 5v15a7 7 0 0 0 7 -7"></path>
                                                    <path d="M6 15l8 -4"></path>
                                                    <path d="M14 7l-8 4"></path>
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control" name="offer_price" placeholder="Fiyat" required>
                                        </div>
                                        <div class="divide-y mb-3">
                                            <div>
                                                <label class="row">
                                                    <span class="col fw-bold">KDV Uygula <div class="form-check-description">Ürüne özel KDV ekleyecekseniz seçiniz.</div></span>
                                                    <span class="col-auto">
                                                        <label class="form-check form-check-single form-switch">
                                                            <input id="add_kdv_switch" class="form-check-input" type="checkbox" onclick="addKDV()">
                                                        </label>
                                                    </span>
                                                </label>
                                            </div>
                                            <div id="kdv_isleyisi" style="display: none;">
                                                <label class="row">
                                                    <span class="col-7">KDV İşleyişi</span>
                                                    <span class="col-5">
                                                        <select name="" id="" class="form-select form-select-sm">
                                                            <option value="1">Hariç</option>
                                                            <option value="2">Dahil</option>
                                                        </select>
                                                    </span>
                                                </label>
                                            </div>
                                            <div id="kdv_orani" style="display: none;">
                                                <label class="row">
                                                    <span class="col-7">KDV Oranı</span>
                                                    <span class="col-5">
                                                        <input type="text" name="kdvorani" class="form-control form-control-sm" value="18">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="divide-y">
                                            <div>
                                                <label class="row">
                                                    <span class="col fw-bold">İskonto Uygula <div class="form-check-description">Ürüne özel İSKONTO ekleyecekseniz seçiniz.</div></span>
                                                    <span class="col-auto">
                                                        <label class="form-check form-check-single form-switch">
                                                            <input id="add_discount_switch" class="form-check-input" type="checkbox" onclick="addDiscount()">
                                                        </label>
                                                    </span>
                                                </label>
                                            </div>
                                            <div id="discount_type" style="display: none;">
                                                <label class="row">
                                                    <span class="col-7">İskonto Türü</span>
                                                    <span class="col-5">
                                                        <select name="" id="" class="form-select form-select-sm">
                                                            <option value="1">Yüzde</option>
                                                            <option value="2">Sabit</option>
                                                        </select>
                                                    </span>
                                                </label>
                                            </div>
                                            <div id="discount_value" style="display: none;">
                                                <label class="row">
                                                    <span class="col-7">İskonto Değeri</span>
                                                    <span class="col-5">
                                                        <input type="text" name="iskontodegeri" class="form-control form-control-sm" value="10">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z"></path>
                                                    <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
                                                    <path d="M6 9h-.01"></path>
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control" name="offer_quantity" placeholder="Miktar" required>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="unit" id="quantity" class="form-select form-control-sm birim-select">
                                            <option value="adet">Adet</option>
                                            <option value="ay">Ay</option>
                                            <option value="cift">Çift</option>
                                            <option value="cuval">Çuval</option>
                                            <option value="dakika">Dakika</option>
                                            <option value="desilitre">Desilitre</option>
                                            <option value="desimetre">Desimetre</option>
                                            <option value="file">File</option>
                                            <option value="gram">Gram</option>
                                            <option value="gun">Gün</option>
                                            <option value="hafta">Hafta</option>
                                            <option value="kamyon">Kamyon</option>
                                            <option value="kilogram">Kilogram</option>
                                            <option value="kilometre">Kilometre</option>
                                            <option value="koli">Koli</option>
                                            <option value="litre">Litre</option>
                                            <option value="metre">Metre</option>
                                            <option value="metrekare">Metrekare</option>
                                            <option value="metrekup">Metreküp</option>
                                            <option value="miligram">Miligram</option>
                                            <option value="milimetre">Milimetre</option>
                                            <option value="paket">Paket</option>
                                            <option value="palet">Palet</option>
                                            <option value="poset" selected>Poşet</option>
                                            <option value="saat">Saat</option>
                                            <option value="saniye">Saniye</option>
                                            <option value="santimetre">Santimetre</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="offer_total" id="toplam" class="form-control" placeholder="0,00">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-white w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            Ekle
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    ';
                }
            }
            return response()->json($payload);
        }
    }


    public function search(Request $request){

        $categories = Category::all();
        $brands = Brand::all();

        $title = $request->title;
        $category_id = $request->category_id;
        $brand_id = $request->brand_id;

        $searchData = Product::query();


        if (isset($title) && !empty($title)) {
            $searchData->where('title', 'LIKE', "%{$title}%");
        }

        if (isset($category_id) && !empty($category_id)) {
            $searchData->orWhereIn('category_id', $category_id); //burada kategoride çoklu seçim yapılacağı için orWhereIn kullanılır.
        }

        if (isset($brand_id) && !empty($brand_id)) {
            $searchData->orWhere('brand_id', $brand_id);
        }

        $searchData = $searchData->paginate(20);

        return view('products.search', compact('title', 'category_id', 'brand_id', 'searchData', 'categories', 'brands'));
    }

    public function propertyStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        try {

            $property = new ProductProperty();
            $property->fill([
                'title' => $request->title,
                'content' => $request->content,
                'product_id' => $request->product_id,
            ])->save();

            return redirect()->back()->with('success', 'Hizmet Ekleme Başarılı!');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Bir Hata Oluştu!');
        }
    }

    public function propertyUpdate(Request $request)
    {
        try {
            $property = ProductProperty::find($request->id);
            $property->title = $request->title;
            $property->content = $request->content;
            $property->save();

            return redirect()->back()->with('success', 'Düzenleme Başarılı!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Bir Hata Oluştu!');
        }
    }

    public function propertyDestroy(ProductProperty $property)
    {
        try {

            $result = $property->delete();

            if ($result) {
                return redirect()->back()->with('deleteSuccess', 'Silme Başarılı!');
            }
            return redirect()->back()->with('deleteError', 'Bir Hata Oluştu!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('deleteError', 'Bir Hata Oluştu!');
        }
    }


    public function fileImport(Request $request)
    {
        Excel::import(new ProductImport, $request->file('file'));
        return back();
    }



}
