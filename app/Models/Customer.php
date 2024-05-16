<?php

namespace App\Models;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = ['first_name','last_name','phone','status'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    private  function _getAddresses():HasOne
    {
        return $this->hasOne(CustomerAddress::class,'customer_id','user_id');
    }
    public function shippingAddress():HasOne
    {
        return $this->_getAddresses()->where('type','=',AddressType::Shipping->value);
    } public function billingAddress():HasOne
    {
        return $this->_getAddresses()->where('type','=',AddressType::Billing->value);
    }


    //works when referring to shippingAddress()

//    public function addresses()
//    {
//        return $this->hasMany(CustomerAddress::class, 'customer_id', 'user_id');
//    }
//
//    // Define specific address relationships
//    public function shippingAddress()
//    {
//        return $this->addresses()->where('type', AddressType::Shipping->value)->firstOrNew(['type' => AddressType::Shipping]);
//    }
//
//    public function billingAddress()
//    {
//        return $this->addresses()->where('type', AddressType::Billing->value)->firstOrNew(['type' => AddressType::Billing]);
//    }
}
