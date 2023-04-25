<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Document::latest()->get();
        return $this->success($data, "Sukses mengambil data dokumen");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $file = $request->file('file');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $path = $filename . "_" . Carbon::now()->format('Y-m-d_H-i-s') . "." . $extension;
            $file->storeAs('public/surat', $path);
            unset($data['file']);
            $data['filename'] = $path;
            $document = Document::create($data);
            DB::commit();
            return $this->success($document, "Sukses membuat surat !");
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e, $e->getMessage(), 401);
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
        try {
            $document = Document::find($id);
            $data = [
                "created_at" => $document->tanggal_dibuat,
                "updated_at" => $document->tanggal_diubah,
                "path" => $document->path,
                "filename" => $document->filename,
                "isFavorite" => $document->isFavorite
            ];
            return $this->success($data, "Sukses menampilkan surat !");
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e, $e->getMessage(), 401);
        }
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
        //
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
    public function download($id)
    {
        $document = Document::find($id);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        $file = public_path('storage') . "/surat/" . $document->filename;
        return response()->download($file);
    }
    public function getFavorites()
    {
        $data = Document::latest()->where('isFavorite', 1)->get();
        return $this->success($data, "Sukses mengambil data dokumen favorite");
    }
    public function toggleFavorite($id)
    {
        $document = Document::find($id);
        if ($document->isFavorite == 0) {
            $document->update(['isFavorite' => 1]);
        } else {
            $document->update(['isFavorite' => 0]);
        }
        return $this->success($document, "Sukses menambahkan ke favorite");
    }
}
