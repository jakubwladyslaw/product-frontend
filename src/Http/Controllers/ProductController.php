<?php

namespace Jakub\ProductFrontend\Http\Controllers;

use App\Http\Requests;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jakub\ProductFrontend\Repositories\ProductRest as ProductRestRepository;
use Jakub\ProductFrontend\Exceptions\RestClientException as RestClientException;


/**
 * Class ProductController
 * @package Jakub\ProductFrontend\Http\Controllers
 */
class ProductController extends Controller
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function productForm(Request $request, $id)
    {
        try {
            if ($id == "add") {
                $productData = [
                    'id' => null,
                    'name' => $request->old('name'),
                    'amount' => $request->old('amount')
                ];
            } else {
                $product = $this->productRest->getProduct($id);
                $productData = [
                    'id' => array_get($product, 'name', null),
                    'name' => $request->old('name') ?: array_get($product, 'name'),
                    'amount' => $request->old('amount') ?: array_get($product, 'amount'),
                ];
            }
        } catch (RestClientException $e) {
            return redirect()->route('products')->with('error',
                $e->getMessage());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('products')->with('error',
                'Something went wrong');
        }
        return view('product-frontend::product/form', ['product' => $productData]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function product(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'amount' => 'required|integer|min:0|'
        ]);
        try {
            if ($id == 'add') {
                $product = $this->productRest->addProduct($validatedData);
            } else {
                $product = $this->productRest->editProduct($id, $validatedData);
            }
            return redirect()->route('product.form', ['id' => array_get($product, 'id')])->with('success', 'Success!');
        } catch (RestClientException $e) {
            return redirect()->back()->with('error',
                $e->getMessage());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput($request->input())->with('error',
                'Something went wrong');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productDelete(Request $request, $id)
    {
        try {
            $this->productRest->deleteProduct($id);

        } catch (RestClientException $e) {
            return redirect()->route('products')->with('error',
                $e->getMessage());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput($request->input())->with('error',
                'Something went wrong.');
        }
        return redirect()->route('products')->withInput($request->input())->with('success',
            'You deleted the product.');
    }

}