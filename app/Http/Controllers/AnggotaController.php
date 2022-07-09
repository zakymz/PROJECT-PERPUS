<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class AnggotaController extends Controller
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
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $anggota = Anggota::orderBy('created_at', 'desc')->get();

        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        return view('anggota.create');
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
            $length = 6;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $no_anggota = Str::upper($random);

            $user = new User();
            $user->name     = $validated['name'];
            $user->email    = $validated['email'];
            $user->password = bcrypt($validated['password']);
            $user->role     = 'anggota';
            $user->save();

            $anggota                = new Anggota();
            $anggota->user_id       = $user->id;
            $anggota->no_anggota    = $no_anggota;
            $anggota->pegawai_id    = auth()->user()->relatedPegawai->id;
            $anggota->no_hp         = $validated['no_hp'];
            $anggota->jk            = $validated['jk'];
            $anggota->tgl_lahir     = $validated['tgl_lahir'];
            $anggota->alamat        = $validated['alamat'];
            $anggota->created_by    = auth()->user()->id;
            $anggota->save();

            $notif = [
                'message'   => 'Data berhasil ditambahkan.  Nama anggota '. $validated['name'],
                'title'     => 'Berhasil',
            ];

            return redirect()->route('anggota.index')->with($notif);
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
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $anggota = Anggota::find($id);

        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }

        $anggota = Anggota::findOrFail($id);

        return view('anggota.edit', compact('anggota'));
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
            $anggota                = Anggota::find($id);
            $anggota->no_hp         = $validated['no_hp'];
            $anggota->jk            = $validated['jk'];
            $anggota->tgl_lahir     = $validated['tgl_lahir'];
            $anggota->alamat        = $validated['alamat'];
            $anggota->updated_by    = auth()->user()->id;
            $anggota->save();

            if($request->password != '') {
                $password = bcrypt($request->password);
            }else{
                $password = $anggota->relatedUser->password;
            }

            $user = User::find($anggota->user_id);
            $user->name     = $validated['name'];
            $user->email    = $validated['email'];
            $user->password = $password;
            $user->role     = 'anggota';
            $user->save();

            $notif = [
                'message'   => 'Data berhasil diupdate.  Nama anggota '. $validated['name'],
                'title'     => 'Berhasil',
            ];

            return redirect()->route('anggota.index')->with($notif);
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
        if(auth()->user()->role == 'anggota'){
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        
        try {
            $anggota = Anggota::find($id);
            $anggota->delete();

            $notif = [
                'message'   => 'Data berhasil dihapus.  Nama anggota '. $anggota->relatedUser->name,
                'title'     => 'Berhasil',
            ];

            return redirect()->route('anggota.index')->with($notif);
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data '. $th->getMessage());
        }
    }
}
