<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";
    protected $fillable = [
        'unique_order_id',
        'orderstatus_id',
        'store_id',
        'user_id',
        'if_sales',
        'sales_id',
        'customer_latitude',
        'customer_longitude',
        'shipping_address_id',
        'order_address',
        'reward_point',
        'sub_total',
        'taxrate',
        'tax_amt',
        'delivery_charge',
        'discount',
        'coupon_id',
        'coupon_amount',
        'handling_charge',
        'order_totalamt',
        'if_redeem',
        'redeem_point',
        'redeem_cash',
        'after_redeem_bill_amt',
        'payment_mode',
        'map_distance',
        'delivery_pin',
        'deliveryboy_id',
        'notifi_admin',
        'notifi_store',
        'notifi_deliveryboy',
        'delivery_timeslote_id'
    ];
}