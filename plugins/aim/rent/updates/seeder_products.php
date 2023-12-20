<?php namespace Aim\Rent\Updates;

use October\Rain\Database\Updates\Seeder;
use Aim\Rent\Models\Product;
use Illuminate\Support\Facades\Storage;
use System\Models\File;

class SeedProducts extends Seeder
{
    public static function run()
    {
        if (config('aim.db_safemode')) {
            echo "DB SAFEMODE enabled\n";
            return true;
        }

        $file = file_get_contents(__DIR__.'/data/products.json');
        $json = json_decode($file, true);

        $className = "SeedProducts"; $jsonTotal = count($json); $i = 0;
        foreach ($json as $data) {
            $i++;
            
            // Seed data
            $product = new Product;
            $product->title = $data['title'];
            $product->brand = $data['brand'];
            $product->model = $data['model'];
            $product->year = $data['year'];
            $product->beds = $data['beds'];
            $product->description = $data['description'];
            $product->engine_type = $data['engine_type'];
            $product->engine_power = $data['engine_power'];
            $product->engine_size = $data['engine_size'];
            $product->gearbox_type = $data['gearbox_type'];
            $product->gearbox_shifts = $data['gearbox_shifts'];
            $product->has_wc = $data['has_wc'];
            $product->has_shower = $data['has_shower'];
            $product->has_kitchen = $data['has_kitchen'];
            $product->has_tv = $data['has_tv'];
            $product->has_heating = $data['has_heating'];
            $product->has_ac = $data['has_ac'];
            $product->has_bike_rack = $data['has_bike_rack'];
            $product->has_pets_allowed = $data['has_pets_allowed'];
            $product->price_season_week_1 = $data['price_season_week_1'];
            $product->price_season_week_2 = $data['price_season_week_2'];
            $product->price_season_week_3 = $data['price_season_week_3'];
            $product->price_season_week_4 = $data['price_season_week_4'];
            $product->price_offseason_week_1 = $data['price_offseason_week_1'];
            $product->price_offseason_week_2 = $data['price_offseason_week_2'];
            $product->price_offseason_week_3 = $data['price_offseason_week_3'];
            $product->price_offseason_week_4 = $data['price_offseason_week_4'];
            $product->save();

            // Seedojam bildes
            $photoFolderId = isset($data['folder_id']) ? $data['folder_id'] : null;
            if ($photoFolderId) {

                // izdzesam ara vecas bildes
                $oldFiles = File::where(['attachment_type' => "Aim\Rent\Models\Product", 'attachment_id' => $product->id])->get(); 
                if ($oldFiles->count()) {
                    foreach ($oldFiles as $oldFile) {
                        $oldFile->delete();
                    }
                }

                //$directory = __DIR__.'/data/photos/'.$data['folder_id'];
                $directory = __DIR__."/data/photos/".$data['folder_id'];
                $files = glob($directory."/*");
                echo "Dir: ".$directory."\n";
                echo "Ammount of files found: ".count($files)."\n";
                foreach ($files as $file) {
                    echo 'File: '.$file."\n";
                    $product->images = (new File)->fromFile($file);
                }
                $product->save();
            }
        }
    }
}