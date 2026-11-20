<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_code',
        'item_name',
        'item_photo',
        'location',
        'status',
        'step',
        'expired_at',
        'rejection_reason',
        'handed_over_at',
        'handed_over_by',
        'handover_photo',
        'timeline_logs',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'handed_over_at' => 'datetime',
        'timeline_logs' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeHistory($query)
    {
        return $query->whereIn('status', ['selesai', 'ditolak', 'kedaluwarsa']);
    }

    // Accessor teks tanggal dan keterangan status
    public function getDateTextAttribute(): string
    {
        if ($this->status === 'selesai') {
            $tgl = $this->handed_over_at ? $this->handed_over_at->translatedFormat('d M Y') : $this->updated_at->translatedFormat('d M Y');
            return 'Diserahkan ' . $tgl;
        }

        if ($this->status === 'ditolak') {
            $tgl = $this->updated_at->translatedFormat('d M Y');
            $alasan = $this->rejection_reason ? ' · Alasan petugas: ' . $this->rejection_reason : '';
            return 'Ditolak ' . $tgl . $alasan;
        }

        if ($this->status === 'kedaluwarsa') {
            $tgl = $this->updated_at->translatedFormat('d M Y');
            $alasan = $this->rejection_reason ? ' · ' . $this->rejection_reason : '';
            return 'Kedaluwarsa ' . $tgl . $alasan;
        }

        return $this->updated_at->translatedFormat('d M Y');
    }

    public function getHasTimelineAttribute(): bool
    {
        return $this->status === 'selesai' && !empty($this->timeline_logs);
    }

    public function getTimelineAttribute(): array
    {
        return $this->timeline_logs ?? [];
    }

    public function getCanAppealAttribute(): bool
    {
        return $this->status === 'ditolak';
    }

    public function getCanReclaimAttribute(): bool
    {
        return $this->status === 'kedaluwarsa';
    }
}
