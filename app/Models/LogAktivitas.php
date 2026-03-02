<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitases';
    
    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'model',
        'model_id',
        'description',
        'old_data',
        'new_data',
        'ip_address',
        'user_agent',
    ];
    
    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
        'created_at' => 'datetime',
    ];
    
    /**
     * Scope untuk aktivitas terbaru
     */
    public function scopeTerbaru($query, $limit = 10)
    {
        return $query->latest()->take($limit);
    }
    
    /**
     * Scope untuk aktivitas berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    /**
     * Scope untuk aktivitas berdasarkan model
     */
    public function scopeByModel($query, $model)
    {
        return $query->where('model', $model);
    }
    
    /**
     * Scope untuk aktivitas berdasarkan action
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }
    
    /**
     * Get icon berdasarkan action
     */
    public function getIconAttribute(): string
    {
        return match($this->action) {
            'create' => 'plus',
            'update' => 'pencil',
            'delete' => 'trash',
            'login' => 'arrow-right-on-rectangle',
            'logout' => 'arrow-left-on-rectangle',
            'view' => 'eye',
            'download' => 'arrow-down-tray',
            'upload' => 'arrow-up-tray',
            default => 'bell',
        };
    }
    
    /**
     * Get color berdasarkan action
     */
    public function getColorAttribute(): string
    {
        return match($this->action) {
            'create' => '#10B981', // Green
            'update' => '#F59E0B', // Yellow
            'delete' => '#EF4444', // Red
            'login' => '#3B82F6', // Blue
            'logout' => '#8B5CF6', // Purple
            default => '#6B7280', // Gray
        };
    }
    
    /**
     * Get title berdasarkan action
     */
    public function getTitleAttribute(): string
    {
        $modelName = $this->model ?: 'Data';
        
        return match($this->action) {
            'create' => "{$modelName} Baru Ditambahkan",
            'update' => "{$modelName} Diperbarui",
            'delete' => "{$modelName} Dihapus",
            'login' => "User Login",
            'logout' => "User Logout",
            default => "Aktivitas Sistem",
        };
    }
}