<?php

namespace Jakub\ProductFrontend\Http\Controllers;

use App\Http\Requests;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jakub\ProductFrontend\Repositories\ProductRest as ProductRestRepository;
use Jakub\ProductFrontend\Exceptions\RestClientException as RestClientException;

/**
 * Class ProductsController
 * @package Jakub\ProductFrontend\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * @var ProductRestRepository
     */
    protected $productRest;

    /**
     * ProductsController constructor.
     * @param ProductRestRepository $productRest
     */
    public function __construct(ProductRestRepository $productRest)
    {
        $this->productRest = $productRest;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function productsGet(Request $request)
    {
        $amount = $request->get('amount');
        $conditional = $request->get('conditional');
        try {
            $products = $this->productRest->getProducts(['amount' => $amount, 'conditional' => $conditional]);
        } catch (RestClientException $e) {
            if (!$amount && !$conditional) {
                return abort(500, "Something went wrong");
            }
            return redirect()->route('products')->with('error',
                $e->getMessage());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            if (!$amount && !$conditional) {
                return abort(500, "Something went wrong");
            }
            return redirect()->route('products')->with('error',
                'Something went wrong');
        }
        return view('product-frontend::products/list', ['products' => $products]);

    }


}