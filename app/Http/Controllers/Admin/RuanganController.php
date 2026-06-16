<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller {
    public function index() {
        $ruangans = Ruangan::latest()->paginate(10);
        return view('admin.ruangan.index', compact('ruangans'));
    }
    public function store(Request $request) {
        $request->validate(['nama_ruangan' => 'required|string|max:255|unique:ruangans']);
        Ruangan::create($request->all());
        return redirect()->back()->with('success', 'Ruang kelas baru berhasil ditambahkan.');
    }
    public function destroy($id) {
        Ruangan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus.');
    }
}