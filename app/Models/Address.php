<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Address extends Model  {

	protected $table = 'member_address';

    protected  $fillable=[
        "maddress_member_id",
        "maddress_province_id",
        "maddress_city_id",
        "maddress_area_id",
        "maddress_cell_id",
        "maddress_pickup_id",
        "maddress_consignee_address",
        "maddress_consignee_name",
        "maddress_consignee_mobile",
        "maddress_default",
        "maddress_edit_time",
        "maddress_add_time"
    ];

    protected  $hidden=["maddress_id"];





}
