<?php

namespace Modules\Classes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subjects\Contracts\SubjectsRepositoryContract as SubjectsRepository;
use Modules\Instructors\Contracts\InstructorsRepositoryContract as InstructorsRepository;
use Modules\Classes\Contracts\ClassesRepositoryContract as ClassesRepository;
use Modules\Students\Contracts\StudentsRepositoryContract as StudentsRepository;
use Faker\Factory as Faker;

class ClassesDatabaseSeeder extends Seeder
{

    private $subjectRepository;
    private $instructorsRepository;
    private $classRepository;
    private $studentRepository;
    private $faker;


    public function __construct(SubjectsRepository $subjectRepository, 
        InstructorsRepository $instructorsRepository,
        ClassesRepository $classRepository,
        StudentsRepository $studentRepository)
    {
        $this->subjectRepository = $subjectRepository;
        $this->instructorsRepository = $instructorsRepository;
        $this->classRepository = $classRepository;
        $this->studentRepository = $studentRepository;
        $this->faker = Faker::create();    
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $this->makeSeed();
    }

    private function makeSeed()
    {
        for ($i = 1; $i <= 5; $i++) { 

            $this->subjectRepository->create([
                    'code' => 'S00' . $i,
                    'name' => 'Subject '. $i
                ]);

        }

        for ($i = 1; $i <= 5; $i++) { 

            $this->instructorsRepository->create([
                    'code' => 'I00'.$i,
                    'first_name' => $this->faker->firstName,
                    'last_name' => $this->faker->lastName,
                    'marital_status' => 'married',
                    'gender' => 'Male',
                    'address' => $this->faker->word,
                    'phone' => '0776548098',
                    'subjects' => [
                        1, 2, 3
                    ]
                ]);

        }

        for ($i = 1; $i <= 5; $i++) { 

            $this->classRepository->create([
                    'code' => 'C00' . $i,
                    'name' => 'Class '. $i,
                    'details' => [
                        [
                            'subject_id' => 1,
                            'instructor_id' => 1
                        ],
                        [
                            'subject_id' => 2,
                            'instructor_id' => 1
                        ]
                    ]
                ]);

        }

        for ($i = 1; $i <= 5; $i++) { 

            $this->studentRepository->create([
                    'registration_no' => 'S00'.$i,
                    'first_name' => $this->faker->firstName,
                    'last_name' => $this->faker->lastName,
                    'gender' => 'Male',
                    'address' => $this->faker->word,
                    'phone' => '0776657876',
                    'class_id' => rand(1,5)
                ]);

        }
    }
}
