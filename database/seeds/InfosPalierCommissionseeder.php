<?php

use Illuminate\Database\Seeder;
use App\Models\Infospaliercommissions;

class InfosPalierCommissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Infospaliercommissions::create([
            "nombre_palier"=>"6",
            "model_serialization"=>"fr1=1&to1=50000&forfait1=4000&percent1=0&fr2=50001&to2=100000&forfait2=8000&percent2=0&fr3=100001&to3=300000&forfait3=0&percent3=6&fr4=300001&to4=600000&forfait4=0&percent4=5.5&fr5=600001&to5=900000&forfait5=0&percent5=5.25&fr6=900001&percent6=5"
        ]);
    }
}
