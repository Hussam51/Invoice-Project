<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'invoices';
    protected $dates=['deleted_at'];
    protected $fillable = [
        ' invoice_number',
        'invoice_date',
        'due_date',
        'section_id',
        'product',
        'amount_commission',
        'amount_collection',
        'discount',
        'rate_vat',
        'value_vat',
        'total',
        'status',
        'status_value',
        'note',
        'user'
    ];

    public function section()
    {
        return $this->belongsTo(section::class, 'section_id', 'id');
    }
}
