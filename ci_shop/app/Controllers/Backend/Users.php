<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use Config\Services;

class Users extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $data['page_name'] = 'Users';
        return view('backend/users/index', $data);
    }

    public function edit($id)
    {
        $validation = Services::validation();
        $db = \Config\Database::connect();

        $pageData['page_name'] = 'Users';
        $pageData['validation'] = $validation;
        

        // Display Form
        if (strtolower($this->request->getMethod()) !== 'patch') {

            $query = $db->table('users')->where(['id'=>$id])->get();
            $pageData['user'] = $query->getRow();

            return view('backend/users/edit', $pageData);
        }

        // Update 
        $validation->setRules([
            'username' => ['label' => 'User Name', 'rules' => 'required|max_length[30]'],
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            $pageData['validation'] = $validation;
            return view('backend/users/edit', $pageData);
        }

        $data = [
            'username'         => $this->request->getPost('username'),
            'status'     => $this->request->getPost('status'),
            'status_message'   => $this->request->getPost('status_message'),
            'active'     => $this->request->getPost('active'),
        ];
        
        $ret = $db->table('users')->update($data, ['id'=>$id]);
        if ($ret == false) {
            $err = $db->error();
            session()->setFlashdata('error', '['.$err['code'].'] '.$err['message']);
            return redirect()->back()->withInput();
        }

        $db->close();

        session()->setFlashdata('success', 'The user was updated.');
        return redirect()->to('/admin/users');
    }

    public function add()
    {

    }

    public function ajaxTbl() {

        $draw = $this->request->getVar('draw');
		$length = $this->request->getVar('length');
		$start = $this->request->getVar('start');
        $columns = $this->request->getVar('columns');
        $sortCol = $columns[$this->request->getVar('order')[0]["column"]]["data"];
        $sortDir = $this->request->getVar('order')[0]["dir"];
        $search = $this->request->getVar('search');
        $searchPhrase = $search['value'];
        
        $db = \Config\Database::connect();
        $totalBuilder = $db->table('users');

        if (!empty($searchPhrase)) {
            $totalBuilder->like('username', $searchPhrase);
        }

        $total = $totalBuilder->countAllResults();
        
        $queryBuilder = $db->table('users');

        if (!empty($searchPhrase)) {
            $queryBuilder->like('username', $searchPhrase);
        }

        $queryBuilder->limit($length, $start);
        $queryBuilder->orderBy($sortCol, $sortDir);
        $query = $queryBuilder->get();

		$rows = [];
        $rowCnt = 0;
        
		foreach ($query->getResult() as $q) {

            $actions = "<a href='/admin/user/edit/" . $q->id . "' class='mr-2' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit' style='color:orange;'></i></a>";
			$actions .= "<a href='/admin/user/delete/" . $q->id . "' class='mr-2' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-times' style='color:red;'></i></a>";

            $row = [
                'id'			=> $q->id,
				'username'		=> $q->username,
                'status'	    => $q->status,
                'status_message'=> $q->status_message,
                'active'        => $q->active,
                'last_active'   => $q->last_active,
                'profile'       => "<a href='/admin/user/profile/" . $q->id . "'>User Profile</a>",
                'pp_info'       => "<a href='/admin/user/pp-info/" . $q->id . "'>PayPal Info</a>",
                'roles'         => "<a href='/admin/user/roles/" . $q->id . "'>Roles</a>",
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
}
