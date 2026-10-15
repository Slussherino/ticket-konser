<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    
    protected $table = 'order_details'; 
    protected $guarded = ['id'];
    
    public function events()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}