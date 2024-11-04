<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // Mendapatkan semua todo
    public function index()
    {
        //get all posts
        $tasks = Task::latest()->paginate(5);

        //return collection of posts as a resource
        return new TaskResource(true, 'List Data Posts', $tasks);
    }

    // Tambah todo baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi_kegiatan' => 'required',
        ]);

        $tasks = Task::create([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tanggal' => $validated['tanggal'],
            'deskripsi_kegiatan' => $validated['deskripsi_kegiatan']
        ]);

        return new TaskResource(true, 'Data Task Berhasil Ditambahkan!', $tasks);
    }

    // Mendapatkan satu todo berdasarkan ID
    public function show($id)
    {
        $tasks = Task::find($id);

        if (!$tasks) {
            return response()->json(['message' => 'Data Tidak Ditemukan'], 404);
        }

        return response()->json($tasks, 200);
    }

    // Mengupdate todo
    public function update(Request $request, $id)
    {
        $tasks = Task::find($id);

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi_kegiatan' => 'required',
        ]);

        $tasks->update([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tanggal' => $validated['tanggal'],
            'deskripsi_kegiatan' => $validated['deskripsi_kegiatan']
        ]);

        if (!$tasks) {
            return response()->json(['message' => 'Data Tidak Ditemukan'], 404);
        }

        return new TaskResource(true, 'Data Task Berhasil Di Update!', $tasks);
    }

    public function complete($id)
    {
       $tasks = Task::find($id);

       if (!$tasks) {
        return response()->json(['message' => 'Data Tidak Ditemukan'], 404);
    }

        $tasks->update([
        'is_completed' => true,
    ]);

    return new TaskResource(true, 'Task Berhasil Diselesaikan!', $tasks);
    }


    // Menghapus todo
    public function destroy($id)
    {
        $tasks = Task::find($id);

        if (!$tasks) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tasks->delete();

        return new TaskResource(true, 'Data Berhasil Dihapus!', null);
    }
}
