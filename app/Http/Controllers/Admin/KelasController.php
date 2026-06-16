<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Dosen;
use Illuminate\Http\Request;

class KelasController extends Controller {
    public function index() {
        $kelas = Kelas::with('dosen.user')->latest()->paginate(10);
        $dosens = Dosen::with('user')->get(); // Mengambil data dosen untuk opsi dropdown Dosen Wali
        return view('admin.kelas.index', compact('kelas', 'dosens'));
    }
    public function store(Request $request) {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas',
            'dosen_id' => 'nullable|exists:dosens,id'
        ]);
        Kelas::create($request->all());
        return redirect()->back()->with('success', 'Kelas baru berhasil ditambahkan.');
    }
    public function destroy($id) {
        Kelas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }
}