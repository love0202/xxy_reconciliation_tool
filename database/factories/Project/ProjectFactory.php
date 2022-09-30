<?php

namespace Database\Factories\Project;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $guid = time();
        $num = 1 . '对账方案';
        return [
            'guid' => $guid,
            'name' => $num,
            'adminName' => '姚小仙',
            'adminId' => 1,
            'year' => '2022',
        ];
    }
}
