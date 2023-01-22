<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;

use App\Models\Item\Item;
use App\Models\QuickPage;
use App\Models\Slider;
use App\Traits\CalculateCart;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public function pdfView()
    {
        return view('welcome');
        // $data = ['title' => 'Welcome to HDTuto.com'];

        //  $pdf= PDF::loadView('welcome',  compact('data'));
        //  return $pdf->stream();
        return $pdf->stream('welcome',array("Attachment" => false));
    }
    use CalculateCart;
    public function home( )
    {
        // $banners = Banner::active()->select('id', 'image','position')->take(3)->orderBy('position')->get();
        // $sliders = Slider::active()->select('id', 'image','position')->orderBy('position')->get();
        // // return view('frontend.template_2.pages.home', compact('banners', 'sliders'));
        // return view('frontend.template_1.pages.home', compact('banners', 'sliders'));
    }

    public function randomProduct()
    {
        $items = Item::take(50)->get();
        // return view('frontend.template_2._include.randomProduct', compact('items'));
        return view('frontend.template_1._include.randomProduct', compact('items'));
    }




    public function item(Request $request)
    {
        $item =  Item::with('brand:id,name', 'deliveryInfo', 'attributeInfos','metatag')->whereSlug($request->slug)->first();
        $relatedProduct = Item::inRandomOrder()->limit(10)->get();
        // return view('frontend.template_2.pages.item', compact('item', 'relatedProduct'));
        return view('frontend.template_1.pages.item', compact('item', 'relatedProduct'));
    }
    public function cart (Request $request)
    {
        $cart = $this->calculateCart(true);
        // return view('frontend.template_2.pages.cart', compact('cart'));
        return view('frontend.template_1.pages.cart', compact('cart'));
    }
    public function login( )
    {
        // return view('frontend.template_2.pages.login');
        return view('frontend.template_1.pages.login');
    }
    public function register( )
    {
        // return view('frontend.template_2.pages.register');
        return view('frontend.template_1.pages.register');
    }

    public function checkout(Request $request)
    {

        return view('frontend.template_1.pages.checkout');
    }
    public function shop( )
    {
        return view('frontend.template_1.pages.shop');
    }

    public function quickPage(Request $request)
    {
        return view('frontend.template_1.pages.about')->with(['quickPage' => QuickPage::whereSlug($request->slug)->first()]);
    }

    public function contact( )
    {
        return view('frontend.template_1.pages.contact');
    }
    public function aboutus( )
    {
        return view('frontend.template_1.pages.about');
    }

    public function privacyPolicy( )
    {
        return view('frontend.template_1.pages.privacyPolicy');
    }





}
