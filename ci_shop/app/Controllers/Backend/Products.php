<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Product;
class Products extends BaseController
{
    protected $helpers = ['form'];
    
    public function index()
    {
        $data['page_name'] = 'Products';
        return view('backend/products/index', $data);
        
    }

    public function ajaxTbl() 
    {

        $draw = $this->request->getVar('draw');
		$length = $this->request->getVar('length');
		$start = $this->request->getVar('start');
        $columns = $this->request->getVar('columns');
        $sortCol = $columns[$this->request->getVar('order')[0]["column"]]["data"];
        $sortDir = $this->request->getVar('order')[0]["dir"];
        $search = $this->request->getVar('search');
        $searchPhrase = $search['value'];
        
        $user_id = auth()->id();

        $db = \Config\Database::connect();
        $totalBuilder = $db->table('products')->where('user_id', $user_id)->where('deleted_at IS NULL');

        if (!empty($searchPhrase)) {
            $totalBuilder->like('name', $searchPhrase);
        }

        $total = $totalBuilder->countAllResults();
        
        $queryBuilder = $db->table('products')->where('user_id', $user_id)->where('deleted_at IS NULL');

        if (!empty($searchPhrase)) {
            $queryBuilder->like('name', $searchPhrase);
        }

        $queryBuilder->limit($length, $start);
        $queryBuilder->orderBy($sortCol, $sortDir);
        $query = $queryBuilder->get();

		$rows = [];
        $rowCnt = 0;
        
		foreach ($query->getResult() as $q) {

            $actions = "<a href='" . url_to('products.edit',$q->id) . "' class='mr-2' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit' style='color:orange;'></i></a>";
			$actions .= "<button id='warn-delete' type='button' data-id='".url_to('products.delete',$q->id)."' data-slug='".$q->name."' class='mr-2 warn-delete' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-times' style='color:red;'></i></button>";

            $numVariants = $db->table('variants')->where(['id'=>$q->id])->countAllResults();
            $numAttributes = $db->table('attributes')->where(['id'=>$q->id])->countAllResults();

            $row = [
                'id'			=> $q->id,
                'user_id'	    => $q->user_id,
				'name'		    => $q->name,
                'variants'      => $numVariants,
                'attributes'    => $numAttributes,
                'actions'       => $actions
            ];
			array_push($rows, $row);
            $rowCnt++;
		}

		return $this->response->setJSON([
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'draw' => $draw,
		    'data' => $rows
		]);
    }

    public function add()
    {
        $productModel = new Product();

        $data['page_name'] = 'Add New Product';
        $validation = Services::validation();

        $data['validation'] = $validation;

        // Display Form
        if (strtolower($this->request->getMethod()) !== 'put') {            
            return view('backend/products/add', $data);
        }
        
        // Update
        $validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[100]'],
            'image' => [
                'label' => 'Image File',
                'rules' => [
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[image,10000]',
                ],
            ],
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            $data['validation'] = $validation;
            session()->setFlashdata('error', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $img = $this->request->getFile('image');
        if ($img->hasMoved()) {
            session()->setFlashdata('error', 'The image file has already been moved.');
            return redirect()->back()->withInput();  
        }

        $image = "";
        if ($img->isValid()) {
            $image = $img->store();
        }
        
        $data = [
            'user_id'       => auth()->id(),
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'on_sale'       => $this->request->getPost('on_sale'),
        ];
        if (! empty($image)) {
            $data['image'] = $image;
        }
        
        try {
            $productModel->insert($data);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Database insert failed: '.$e->getMessage());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'The new product was created.');
        return redirect()->to(url_to('products'));
    }

    public function edit($id)
    {
        $productModel = new Product();

        $data['page_name'] = 'Edit Product';
        $validation = Services::validation();

        $data['validation'] = $validation;

        // Display Form
        if (strtolower($this->request->getMethod()) !== 'patch') {
            try {
                $product = $productModel->find($id);
            } catch (\Exception $e) {
                session()->setFlashdata('error', 'Database find failed: '.$e->getMessage());
                return redirect()->back()->withInput();
            }
            
            $data['product'] = $product;
            return view('backend/products/edit', $data);
        }
        
        // Update
        $validation->setRules([
            'name' => ['label' => 'Name', 'rules' => 'required|max_length[100]'],
            'image' => [
                'label' => 'Image File',
                'rules' => [
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[image,10000]',
                ],
            ],
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            $data['validation'] = $validation;
            session()->setFlashdata('error', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $img = $this->request->getFile('image');
        if ($img->hasMoved()) {
            session()->setFlashdata('error', 'The image file has already been moved.');
            return redirect()->back()->withInput();  
        }

        $image = "";
        if ($img->isValid()) {
            $image = $img->store();
        }
        
        $data = [
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'on_sale'       => $this->request->getPost('on_sale'),
        ];
        if (! empty($image)) {
            $data['image'] = $image;
        }
        
        try {
            $productModel->update($id, $data);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Database update failed: '.$e->getMessage());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'The product was updated.');
        return redirect()->to(url_to('products'));
    }

    public function delete($id)
    {
        try {
            $product = new Product();
            $product->deleteRelated($id);
            $product->delete($id);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Database delete failed: '.$e->getMessage());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'The product was deleted.');
        return redirect()->to(url_to('products'));
    }
}
