<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $names = ["Portugal","Inglaterra","Alemanha","Belgica","Suica"];
        $description = ["Portugal","Inglaterra","Alemanha","Belgica","Suica"];
        for ($i = 0 ; $i < count($names); $i++){
            DB::table('countries')->insert(
                array(
                    'name' => $names[$i],
                    'description' => $description[$i],
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                )
            );
        }

        $names = ["Lisboa","Porto","Manchester","Liverpool","Dortmund","Bayern","Liege","Ostend","Zurich","Geneva"];
        $description = ["Lisboa","Porto","Manchester","Liverpool","Dortmund","Bayern","Liege","Ostend","Zurich","Geneva"];
        for($i = 0; $i < 5 ; $i++){
            for($j = 0; $j <2 ; $j++){
                DB::table('cities')->insert(
                    array(
                        'name' => $names[($i * 2) + $j ],
                        'description' => $description[($i * 2) + $j],
                        'created_at' => Carbon\Carbon::now(),
                        'updated_at' => Carbon\Carbon::now(),
                        'country_id' => ($i + 1)
                    )
                );
            }
        }

        $names = "Rua-";
        $w = 0;
        for($z = 0; $z < 8 ; $z ++){
            for($i = 0; $i < 10 ; $i++){
                for($j = 0; $j <2 ; $j++){
                    $w++;
                    DB::table('addresses')->insert(
                        array(
                            'name' => $names.($w),
                            'created_at' => Carbon\Carbon::now(),
                            'updated_at' => Carbon\Carbon::now(),
                            'city_id' => ($i + 1)
                        )
                    );
                }
            }
        }

        $names = ["Lisboa","Porto","Manchester","Liverpool","Dortmund","Bayern","Liege","Ostend","Zurich","Geneva"];
        $description = ["Lisboa","Porto","Manchester","Liverpool","Dortmund","Bayern","Liege","Ostend","Zurich","Geneva"];
        for($i = 0; $i < 40 ; $i++){
            $rand = rand(0,9);
            DB::table('universities')->insert(
                array(
                    'name' => $names[$rand].$i."-University",
                    'description' => $description[$rand].$i."-University",
                    'email' => $names[$rand].$i."@gmail.com",
                    'img' => "img/new/1f674b304e56c4b979f4b85331a1f396.jpeg",
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'address_id' => ceil(($i+1)/2)
                )
            );
        }

        $names = ["Pedro", "Carlos" , "Diogo", "Joao" , "John", "Maria", "Marta"];
        $apelidos = ["Mendes", "Silva" , "Freitas", "Camacho" , "Rodrigues", "Sampaio", "Abreu"];
        for($i = 0; $i < 80 ; $i++){
            $temp = rand(0,6);
            DB::table('users')->insert(
                array(
                    'name' => $names[$temp]." ".$apelidos[rand(0,6)],
                    'email' => $names[$temp].$i."@gmail.com",
                    'password' => bcrypt('1234'),
                    'phone' => "".$i."",
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'address_id' => ceil(rand(1,80)),
                    'university_id' => ceil(($i+1)/4)
                )
            );
        }

        $names = ["EI", "DMI" , "CCO", "EE" , "DD", "PP", "EB","AS","OP","XD"];
        for($i = 0; $i < 10 ; $i++){
            DB::table('programs')->insert(
                array(
                    'name' => $names[$i],
                    'description' => $names[$i],
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                )
            );
        }

        for ($i = 0;$i < 50 ; $i++){
            DB::table('students')->insert(
                array(
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'user_id' => $i+1,
                    'program_id' => rand(1,10)
                )
            );
        }


        for ($i = 0;$i < 80 ; $i++){
            DB::table('courses')->insert(
                array(
                    'name' => "course".($i+1),
                    'description' => "course".($i+1),
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                )
            );
        }

        for ($i = 0;$i < 10 ; $i++){
            DB::table('directors')->insert(
                array(
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'user_id' => 50+$i+1,
                    'program_id' => $i + 1
                )
            );
        }

        for ($i = 0;$i < 20 ; $i++){
            DB::table('managers')->insert(
                array(
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'user_id' => 60+$i+1
                )
            );
        }


        for ($i = 0;$i < 6 ; $i++){
            DB::table('information')->insert(
                array(
                    'title' => "ErasmusNews".$i,
                    'description' => "ErasmusNews".$i,
                    'content' => "ErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNewsErasmusNews",
                    'img' => "img/new/1f674b304e56c4b979f4b85331a1f396.jpeg",
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                )
            );
        }

        for ($i = 0;$i < 120 ; $i++){
            DB::table('messages')->insert(
                array(
                    'subject' => "Subject",
                    'content' => "Content",
                    'sender_id' => rand(1,80),
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'user_id' => rand(1,80)
                )
            );
        }

        for ($i = 0;$i < 25 ; $i++){
            DB::table('candidates')->insert(
                array(
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'student_id' => $i+1
                )
            );
        }

        for($i = 0; $i < 40; $i++){
            for($j = 0; $j < 10; $j++){
                DB::table('program_university')->insert(
                    array(
                        'program_id' => $j+1,
                        'university_id' => $i+1,
                        'created_at' => Carbon\Carbon::now(),
                        'updated_at' => Carbon\Carbon::now()
                    )
                );
            }
        }

        for($i = 0; $i < 10; $i++){
            for($j = 0; $j < 80; $j++){
                DB::table('course_program')->insert(
                    array(
                        'course_id' => $j+1,
                        'program_id' => $i+1,
                        'created_at' => Carbon\Carbon::now(),
                        'updated_at' => Carbon\Carbon::now()
                    )
                );
            }
        }

        for($i = 0; $i < 50;$i++){
            $variable = false;
            if($i%2 == 0){
                $variable = true;
            }
            DB::table('processes')->insert(
                array(
                    'description' => "description",
                    'active' => $variable,
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'candidate_id' => rand(1,25),
                    'manager_id' => rand(1,20),
                )
            );
        }

        for($i = 0; $i < 50;$i++){
            $variable = false;
            if($i%2 == 0){
                $variable = true;
            }
            DB::table('process_university')->insert(
                array(
                    'result' => $variable,
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                    'process_id' => $i + 1,
                    'university_id' => rand(1,40),
                )
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
