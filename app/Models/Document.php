<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = array('tanggal_dibuat', 'tanggal_diubah', 'path');
    public function getTanggalDibuatAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }
    public function getTanggalDiubahAttribute()
    {
        return $this->updated_at->format('d M Y H:i');
    }
    public function getPathAttribute()
    {
        return asset('storage/surat/' . $this->filename);
    }
}
