<?php

namespace Database\Factories;

use App\Models\tbl_reservasi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReservasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'nama_tamu' => $this->faker->name(),
            'email' => $this->faker->email(),
            'no_tlp' => $this->faker->randomNumber(),
            'jumlah_k' => random_int(1,9),
            'jumlah_d' => random_int(1,9),
            'jumlah_a' => random_int(1,9),
            'qrcode' => Str::upper(Str::random(10)),
            'durasi' => random_int(1,9),
            'check_in' => Carbon::create(random_int(1,10) . ' day ago')->toDateTimeLocalString(),
            'check_out' => Carbon::create(random_int(1,10) . ' day')->toDateTimeLocalString(),
            'pesan_lain' => $this->faker->text(),
            'pembayaran' => $this->faker->randomNumber(),
        ];

        
    }

   

    

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = tbl_reservasi::class;
}
