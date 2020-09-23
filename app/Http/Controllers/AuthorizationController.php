<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewData()
    {
        $this->authorize('view data');

        return view('view data');
    }

    public function createData()
    {
        $this->authorize('create data');

        return view('create');
    }

    public function editData()
    {
        $this->authorize('edit data');

        return view('edit');
    }

    public function updateData()
    {
        $this->authorize('update data');

        return view('update');
    }

    public function deleteData()
    {
        $this->authorize('delete data');

        return view('delete');
    }
}
