<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
        $data['password'] = Hash::make($request->password);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['nama']     = $request->nama;
        $data['email']    = $request->email;
        $data['password'] = $request->password;

        $data             = $request->all();
        $data['password'] = Hash::make($request->password);
        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataUser = User::findOrFail($id);
        $dataUser->delete();

        return redirect()->route('user.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
