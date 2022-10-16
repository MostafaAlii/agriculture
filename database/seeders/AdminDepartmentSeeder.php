<?php
namespace Database\Seeders;
use App\Models\AdminDepartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class AdminDepartmentSeeder extends Seeder {
    public function run() {
        $level_1_count =3;$level_1_2_count=4;$level_1_3_count=7;$level_1_3_1_count=2;$level_1_3_1_1_count=4;
        $dep_name_ar_level_1_3_1_1= [
            "التخطيط",
            "الثروة الحيوانية",
            "لبيوت البلاستيكية",
            "الخدمات",


        ];
        $dep_name_ku_level_1_3_1_1= [
            " كردي التخطيط",
            "كردي الثروة الحيوانية",
            "لبيوت البلاستيكية كردي",
            "الخدماتكردي",


        ];
        $dep_name_en_level_1_3_1_1 = [
            "Planning",
            "Animal wealth",
            "Protect house",
            "Services"

        ];
        $dep_name_ar_level_1_3_1= [
            "مركز .زاويتا",
            "مركز مانغيش",


        ];
        $dep_name_ku_level_1_3_1= [
            "كردي مركز .زاويتا",
            "كردي مركز مانغيش",


        ];
        $dep_name_en_level_1_3_1 = [
            "zawita",
            "mangesh",

        ];
        $dep_name_ar_level_1_3= [
            "مركز داهوك",
            "مركز زاخو",
            "مركز أكري",
            "علوة بارداراش",
            "مركز سوميل",
            "علوة شيخان",
            "علوة أميدي",

        ];
        $dep_name_ku_level_1_3= [
            "كردي مركز داهوك",
            "كردي مركز زاخو",
            "كردي مركز أكريك",
            "كردي علوة بارداراش",
            "كردي مركز سوميل",
            "كردي علوة شيخان",
            "كردي علوة أميدي",

        ];
        $dep_name_en_level_1_3 = [
            "Duhok",
            "Zakho",
            "Akre",
            "Bardarash",
            "sumel",
            "shikhan",
            "amedi",

        ];
        $dep_name_ar_level_1_2= [
            "علوة داهوك",
            "علوة زاخو",
            "علوة أكري",
            "علوة بارداراش"
        ];
        $dep_name_ku_level_1_2= [
            "كردي علوة داهوك",
            "كردي علوة زاخو",
            "كردي علوة أكري",
            "كردي علوة بارداراش"
        ];
        $dep_name_en_level_1_2 = [
            "Duhok",
            "Zakho",
            "Akre",
            "Bardarash"

        ];
        $dep_name_ar_level_1= [
            "قسم التسويق",
            "العلوات",
            "القسم الإداري",
        ];
        $dep_name_ku_level_1= [
            "كردي قسم التسويق",
            "كردي العلوات",
            "كردي القسم الإداري",
        ];
        $dep_name_en_level_1 = [
            "marketing",
            "WholeSale",
            " Administrative departments",

        ];


        DB::table('admin_departments')->delete();

        for ($i = 0; $i < $level_1_count ; $i++) {
            AdminDepartment::create([
                'dep_name_ar'          => $dep_name_ar_level_1[$i],
                'dep_name_en'          =>$dep_name_en_level_1[$i],
                'dep_name_ku'          =>  $dep_name_ku_level_1[$i],
                'parent' => null
            ]);
        }
        for ($i = 0; $i < $level_1_2_count ; $i++) {
            AdminDepartment::create([
                'dep_name_ar'          =>    $dep_name_ar_level_1_2[$i],
                'dep_name_en'          =>$dep_name_en_level_1_2[$i],
                'dep_name_ku'          =>$dep_name_ku_level_1_2[$i],
                'parent'=>'2',
            ]);
        }
        for ($i = 0; $i < $level_1_3_count ; $i++) {
            AdminDepartment::create([
                'dep_name_ar'                  => $dep_name_ar_level_1_3[$i],
                'dep_name_en'          =>$dep_name_en_level_1_3[$i],
                'dep_name_ku'          =>$dep_name_ku_level_1_3[$i],
                'parent'=>'3',
            ]);
        }
        for ($i = 0; $i < $level_1_3_1_count ; $i++) {
            AdminDepartment::create([
                'dep_name_ar'                   => $dep_name_ar_level_1_3_1[$i],
                'dep_name_en'          =>$dep_name_en_level_1_3_1[$i],
                'dep_name_ku'          =>$dep_name_ku_level_1_3_1[$i],
                'parent'=>'8',
            ]);
        }
        for ($i = 0; $i < $level_1_3_1_1_count ; $i++) {
            AdminDepartment::create([
                'dep_name_ar' =>$dep_name_ku_level_1_3_1_1[$i],
                    'dep_name_en' =>  $dep_name_ar_level_1_3_1_1[$i],
                    'dep_name_ku'   => $dep_name_en_level_1_3_1_1[$i],
                'parent'=>'15',
            ]);
        }

    }
}
