<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class PegawaiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role != 'superadmin'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $pegawai = Pegawai::orderBy('created_at', 'desc')->get();

        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role != 'superadmin'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'password'  => 'required',
            'no_hp' => 'required',
            'jk'    => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        try {

             // generate code
            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $no_pegawai = 'NMK-'.Str::upper($random);

            $user = new User();
            $user->name     = $validated['name'];
            $user->email    = $validated['email'];
            $user->password = bcrypt($validated['password']);
            $user->role     = 'pegawai';
            $user->save();

            $pegawai                = new Pegawai();
            $pegawai->user_id       = $user->id;
            $pegawai->no_pegawai    = $no_pegawai;
            $pegawai->no_hp         = $validated['no_hp'];
            $pegawai->jk            = $validated['jk'];
            $pegawai->tgl_lahir     = $validated['tgl_lahir'];
            $pegawai->alamat        = $validated['alamat'];
            $pegawai->created_by    = auth()->user()->id;
            $pegawai->save();

            $notif = [
                'message'   => 'Data berhasil ditambahkan.  Nama Pegawai '. $validated['name'],
                'title'     => 'Berhasil',
            ];

            return redirect()->route('pegawai.index')->with($notif);
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menyimpan data '. $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->role != 'superadmin'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $pegawai = Pegawai::findOrFail($id);

        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role != 'superadmin'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $pegawai = Pegawai::findOrFail($id);

        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'jk'    => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        try {

             // generate code
            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $no_pegawai = 'NMK-'.Str::upper($random);

            $pegawai                = Pegawai::find($id);
            $pegawai->no_pegawai    = $no_pegawai;
            $pegawai->no_hp         = $validated['no_hp'];
            $pegawai->jk            = $validated['jk'];
            $pegawai->tgl_lahir     = $validated['tgl_lahir'];
            $pegawai->alamat        = $validated['alamat'];
            $pegawai->updated_by    = auth()->user()->id;
            $pegawai->save();

            if($request->password != '') {
                $password = bcrypt($request->password);
            }else{
                $password = $pegawai->relatedUser->password;
            }

            $user = User::find($pegawai->user_id);
            $user->name     = $validated['name'];
            $user->email    = $validated['email'];
            $user->password = $password;
            $user->role     = 'pegawai';
            $user->save();

            $notif = [
                'message'   => 'Data berhasil diupdate.  Nama Pegawai '. $validated['name'],
                'title'     => 'Berhasil',
            ];

            return redirect()->route('pegawai.index')->with($notif);
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menyimpan data '. $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        if(auth()->user()->role != 'superadmin'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        
        try {
            $pegawai = Pegawai::find($id);
            $pegawai->delete();

            $notif = [
                'message'   => 'Data berhasil dihapus.  Nama Pegawai '. $pegawai->relatedUser->name,
                'title'     => 'Berhasil',
            ];

            return redirect()->route('pegawai.index')->with($notif);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data '. $e->getMessage());
        }
    }
}
