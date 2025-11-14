<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
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

=======

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function tentang()
    {
        return view('pages.tentang');
    }

    public function layanan()
    {
        return view('pages.layanan');
    }

    public function kontak()
    {
        return view('pages.kontak');
    }
>>>>>>> cd0a0f617360b0c848b85d165f45fc1b579e9466
}
