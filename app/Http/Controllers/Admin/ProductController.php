<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Image;
use App\Property;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Services\CurrencyService;

class ProductController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        return view('admin.products.product')
            ->withPageHeader('Новый Товар')
            ->withProduct(new Product())
            ->withCategories(Category::all())
            ->withTags(Product::existingTags()->pluck('name'))
            ->withImages(Image::all())
            ->withBrands(Brand::all())
            ->withProperties(collect([]));
    }

    public function create(Request $request)
    {

        $product = new Product();
        $data = $request->except([
            'categories','images',
            'brands','tags','parent-category'
        ]);

        $data['amount'] = intval($request->get('amount'));
        $data['active'] = $request->get('active')=='on'?1:0;


        $this->validate($request, [
            'product_name' => 'required|unique:products,name|max:255',
            'title' => 'required|max:140',
            'body' =>  'max:500',
            'price_usd' => 'required|numeric',
        ]);


       /** @var  $categories array ids */
        $categories = getAttachedItems($request->get('categories'));

        /** @var $images array ids */
        $images = getAttachedItems($request->get('images'));

        /** @var  $brands array ids */
        $brands = getAttachedItems($request->get('brands'));


        $product->fill($data);
        $product->name = $request->get('product_name');
        $product->price_uah = $this->currencyService->getUSDRate();

        if(isset($brands[0]) && !empty($brands))
            $product->brands()->associate($brands[0]);
        else
            $product->brand_id = null;

        $product->save();

        if($request->has('tags'))
            $product->tag(explode(',', $request->get('tags')));


        $product->categories()->sync($categories);
        $product->images()->sync($images);

        flash()->overlay('Record was created successfully!', 'Success');
        return redirect()->back();
    }


    public function edit()
    {
        return view('admin.products.product-edit')
            ->withPageHeader('Редактировать Товары')
            ->withProducts(Product::paginate(20));
    }

    public function update($id)
    {
        $product = Product::findOrFail($id);
        $properties_all = Property::all();

        $properties_attached = [];
        $properties_not_attached = [];

        foreach($product->properties as $property) {
            $properties_attached[$property->id] = ['id'=>$property->id,'name'=>$property->name,'value'=>$property->value];
        }

        foreach($properties_all as $property) {
            $properties_not_attached[$property->id] = ['id'=>$property->id,'name'=>$property->name,'value'=>$property->value];
        }

        $properties_not_attached = collect($properties_not_attached)->diffKeys(collect($properties_attached));


        return view('admin.products.product')
            ->withPageHeader('Обновить товар')
            ->withProduct($product)
            ->withRelatedTags( $product->tagNames())
            ->withCategories(Category::all() )
            ->withTags( Product::existingTags()->pluck('name') )
            ->withBrands(Brand::all())
            ->withPropertiesAttached($properties_attached)
            ->withPropertiesNotAttached($properties_not_attached)
            ->withImages(Image::all());
    }

    public function postUpdate(Request $request,$id)
    {
        $product = Product::findOrFail($id);

        $data = $request->except([
            'categories','images',
            'brands','tags','parent-category'
        ]);

        $data['amount'] = intval($request->get('amount'));
        $data['active'] = $request->get('active')=='on'?1:0;

        /** @var  $categories array ids */
        $categories = getAttachedItems($request->get('categories'));

        /** @var  $images array ids */
        $images = getAttachedItems($request->get('images'));

        /** @var  $brands array ids */
        $brands = getAttachedItems($request->get('brands'));


        $product->fill($data);
        $product->name = $request->get('product_name');
        $product->price_uah = $this->currencyService->getUSDRate();

        if(isset($brands[0]) && !empty($brands))
            $product->brands()->associate($brands[0]);
        else
            $product->brand_id = null;

        $product->save();
        $product->categories()->sync($categories);
        $product->images()->sync($images);

        $tags = explode(',', $request->get('tags'));

        if( !(bool)$tags[0] ) {
            $product->untag();
        } else {
            $product->retag($tags);
        }

        flash()->overlay('Record was updated successfully!', 'Success');
        return redirect()->back();
    }

    public function delete($id)
    {
        Product::destroy($id);
        if(request()->ajax()){
            return "Deleted";
        }
        return redirect()->route('product.edit');
    }

    public function putCurrency()
    {
        $products = Product::all();
        $this->currencyService->createCurrencyXml();
        $usdRate = $this->currencyService->getUsdRate();

        foreach($products as $product) {
            $product->price_uah = $usdRate;
            $product->save();
        }

        return response()->json([
            'Сообщение'=>'Курс обновлен успешно!'
        ]);
    }

    public function propertyStore(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $attach = false;

        if($request->has('name') && $request->has('value')) {
            $property = new Property();
            $property->name = $request->input('name');
            $property->value = $request->input('value');
            $property->save();
            $attach = true;
        }

        $attached = explode(',',$request->input('attached') );
        if(empty($attached) || !$attached[0]) $attached = [];
        $product->properties()->sync($attached);
        if($attach)  $product->properties()->attach($property->id);
        flash()->overlay('Record was updated successfully!', 'Success');
        return redirect()->back();
    }


    public function export()
    {
        return view('admin.products.product-export')
            ->withPageHeader("Экспорт/Импорт товаров");
    }

    public function downloadExcel($type)
    {
        $data = Product::get()->toArray();
        return \Excel::create('products', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel(Request $request)
    {
        if ($request->hasFile('import_file')) {

            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path, function ($reader) {})->get();

            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'name' => $value->name,
                        'title' => $value->title,
                        'description' => $value->description,
                        'code' => $value->code,
                        'guarantee' => $value->guarantee,
                        'price_usd' => $value->price_usd,
                        'price_uah' => $value->price_uah,
                        'amount' => $value->amount,
                        'active' => $value->active || 1,
                        'brand_id' => $value->brand_id,
                    ];
                }
                if (!empty($insert)) {
                    Product::insert($insert);
                    flash()->overlay('Товары загружены успешно!', 'Загрузка завершена');
                    return redirect()->back();
                }
            }
        }

        flash()->overlay('Выберите файл для загрузки!', 'Загрузка не завершена');
        return redirect()->back();
    }
}
