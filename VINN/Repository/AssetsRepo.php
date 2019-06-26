<?php
/**
 * Created by PhpStorm.
 * User: vinnyvinny
 * Date: 1/16/19
 * Time: 12:43 PM
 */

namespace Vinn\Repository;


use App\RequestAsset;

class AssetsRepo
{
static function init(){
    return new self();
}

    public function getAssetDetails($id)
    {
        $asset_info = RequestAsset::find($id);
        return [
          'make' =>$asset_info->asset->make,
          'model' => $asset_info->asset->model,
          'type'  => $asset_info->asset->asset_type->name,
            'serial_no' => $asset_info->asset->serial_no,
            'part_no' => $asset_info->asset->part_no,
            'color' => $asset_info->asset->color,
            'req_date' => $asset_info->req_date
        ];

}
}
