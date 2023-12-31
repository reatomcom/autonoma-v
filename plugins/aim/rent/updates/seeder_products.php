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
            $product->product_type = $data['product_type'];
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
            $product->price_offseason_week_4 = $data['price_offseason_week_4'];
            
            $product->season_from_month = $data['season_from_month'];
            $product->season_from_day = $data['season_from_day'];  
            $product->season_to_month = $data['season_to_month'];
            $product->season_to_day = $data['season_to_day']; 
            $product->offseason_from_month = $data['offseason_from_month'];
            $product->offseason_from_day = $data['offseason_from_day'];
            $product->offseason_to_month = $data['offseason_to_month'];
            $product->offseason_to_day = $data['offseason_to_day'];    

            $product->save();

            //Seed images
            $photoFolderId = isset($data['folder_id']) ? $data['folder_id'] : null;
            if ($photoFolderId) {

                //Delete old images.
                $oldFiles = File::where(['attachment_type' => "Aim\Rent\Models\Product", 'attachment_id' => $product->id])->get(); 
                if ($oldFiles->count()) {
                    foreach ($oldFiles as $oldFile) {
                        $oldFile->delete();
                    }
                }
                
                //Pick random directory
                $directory = __DIR__.'/data/photos/'.$data['folder_id'];
                switch (rand(1, 3))
                {
                    case 1:
                        $directory = $directory."/1";
                        break;
                    case 2:
                        $directory = $directory."/2";
                        break;
                    case 3:
                        $directory = $directory."/3";
                        break;
                    default:
                        $directory = $directory."/1";
                        break;
                }

                //Read files from directory.
                $files = glob($directory."/*");

                //Save files to database.
                for ($i = 0; $i < count($files); $i++)
                {
                    $file = (new File)->fromFile($files[$i]);

                    //First image gets sort_order 0.
                    if ($i == 0)
                    {
                        $file->sort_order = 0;
                        $file->field = "images";
                        $file->attachment_type = "Aim\Rent\Models\Product";
                        $file->attachment_id = $product->id;
                        $file->save();
                    }

                    $product->images = (new File)->fromFile($files[$i]);
                }
                $product->save();
            }
        }
    }
}