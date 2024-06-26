<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'id'            => 'integer',
            'batas'         => 'integer',
            'jumlah'        => 'integer',
            'nilai'         => 'integer',
            'category_id'   => 'integer',
            'jenis_id'      => 'integer',
            'location_id'   => 'integer',
            // 'tgl_terima'    => 'date',
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['code'])) {
            $query->where('code', 'like', '%' . $filters['code'] . '%');
        }
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function getImageAttribute($value)
    {
        if ($value && file_exists(public_path('assets/img/aset/' . $value))) {
            return asset('assets/img/aset/' . $value);
        } else {
            return asset('assets/img/default.jpg');
        }
    }

    public function batas_parse()
    {
        if ($this->batas < 1) {
            return '';
        }
        $terima = Carbon::parse($this->tgl_terima);
        $batas = $terima->addYears($this->batas);
        return $batas->format('Y-m-d');
    }

    public function masa_parse()
    {
        if ($this->batas < 1) {
            return '';
        }
        $now = Carbon::now();
        $awal = Carbon::parse($this->tgl_terima);
        $hasil = $awal->diff($now);
        return $this->parse_hasil($hasil->format('%y'), $hasil->format('%m'), $hasil->format('%d'));
    }

    public function sisa_parse()
    {
        if ($this->batas < 1) {
            return '';
        }
        $now = Carbon::now();
        $awal = Carbon::parse($this->tgl_terima)->addDays();
        $akhir = $awal->addYears($this->batas);
        $hasil = $now->diff($akhir);
        return $this->parse_hasil($hasil->format('%y'), $hasil->format('%m'), $hasil->format('%d'));
    }

    private function parse_hasil($year, $month, $day)
    {
        $text = '';
        if ($year > 0) {
            $text .= "$year Tahun, ";
        }
        if ($month > 0) {
            $text .= "$month Bulan, ";
        }
        if ($day > 0) {
            $text .= "$day Hari";
        }
        return $text;
    }

    public function nilai_parse()
    {
        return 'Rp. ' . hrg($this->nilai);
    }
}
