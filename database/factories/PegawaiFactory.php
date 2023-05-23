<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' =>fake()->randomNumber(),
            'nama' => fake()->name(),
            'gelar_depan' =>fake()->title(),
            'gelar_belakang' =>fake()->jobTitle(),
            'tempat_lahir' =>fake()->city(),
            'tanggal_lahir' =>fake()->date(),
            'gender' => fake()->titleMale(),
            'agama' => fake()->word(),
            'gol_darah' =>fake()->randomLetter(),
            'status_pernikahan' =>fake()->word(),
            'nik' =>fake()->nik(),
            'telp' =>fake()->phoneNumber(),
            'email' =>fake()->unique()->safeEmail(),
            'alamat' =>fake()->address(),
            'npwp' =>fake()->randomNumber(),
            'bpjs' =>fake()->randomNumber(),
            'karpeg' =>fake()->randomNumber(),
            'status_kepegawaian' =>fake()->word(),
            'no_sk_cpns' =>fake()->randomNumber(),
            'tmt_sk_cpns' =>fake()->date(),
            'no_sk_pns' =>fake()->randomNumber(),
            'tmt_sk_pns' =>fake()->date(),
            'tpp' =>fake()->randomNumber(),

        ];
    }
}
