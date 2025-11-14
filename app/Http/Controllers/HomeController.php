<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen;


class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $data['dataJenisDokumen'] = JenisDokumen::all();
        return view('pages.guest.home', $data);
    }
      // Tambahkan method yang diperlukan untuk resource
    public function create()
    {
        // // atau return response yang sesuai
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
