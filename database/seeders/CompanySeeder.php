<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\City;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_1=User::create([
            'type'=>'COMPANY',
            'email'=>'saned@info.com',
            'email_verified_at'=>Carbon::now(),
            'country_id'=>1,
            'city_id'=>1,
            'major_id'=>2,
            'members_count'=>2,
            'password'=>'123456',
            'hear_by'=>'friend',
            'approved'=>true,
            'approved_at'=>Carbon::now()
        ]);
        Profile::create([
           'user_id'=>$company_1->id,
           'working_type'=>'full_time',
            'foundation_name'=>'saned inc',
            'address'=>'المنصورة',
            'description'=>'سنِّد أعمالك جهة سعودية رسمية متخصصة في تقنية المعلومات وتقدم خدمات التصميم والبرمجة وتطوير البرمجيات الخاصة وكل ماهو متعلق بها مما يجعلها كيان متكامل يُقدم جميع الخدمات التقنية والرقمية والتي سنذكرها بالتفصيل في هذا الملف لنوفر لعملائنا كل احتياجاتهم في مكان واحد، تضع سنِّد أعمالك نصب عينيها رؤية المملكة 2030 طامعة في أن تكون جزء من محركات هذا التقدم والتحول والذي يعتمد بشكل كبير على التقنية',
            'commercial_file'=>'IxrWG8Zsec.pdf'
        ]);
        $company_2=User::create([
            'type'=>'COMPANY',
            'email'=>'squre@info.com',
            'email_verified_at'=>Carbon::now(),
            'country_id'=>2,
            'city_id'=>2,
            'major_id'=>1,
            'members_count'=>20,
            'password'=>'123456',
            'hear_by'=>'friend',
            'approved'=>true,
            'approved_at'=>Carbon::now()
        ]);
        Profile::create([
           'user_id'=>$company_2->id,
           'working_type'=>'remotely',
            'foundation_name'=>'squre inc',
            'address'=>'الرياض',
            'description'=>'*Square Capital, LLC and Square Financial Services, Inc. are both wholly owned subsidiaries of Square, Inc. Square Capital, LLC d/b/a Square Capital of California, LLC in FL, GA, MT, and NY. All loans are issued by either Celtic Bank or Square Financial Services, Inc. Square Financial Services, Inc. and Celtic Bank are both Utah-Chartered Industrial Banks. Members FDIC, located in Salt Lake City, UT. The bank issuing your loan will be identified in your loan agreement. All loans are subject to credit approval.',
            'commercial_file'=>'IxrWG8Zsec.pdf'
        ]);
        $company_3=User::create([
            'type'=>'COMPANY',
            'email'=>'el_morshedy@info.com',
            'email_verified_at'=>Carbon::now(),
            'country_id'=>1,
            'city_id'=>1,
            'major_id'=>3,
            'members_count'=>99,
            'password'=>'123456',
            'hear_by'=>'friend',
            'approved'=>true,
            'approved_at'=>Carbon::now()
        ]);
        Profile::create([
           'user_id'=>$company_3->id,
           'working_type'=>'part_time',
            'foundation_name'=>'el-morshedy inc',
            'address'=>'القاهرة',
            'description'=>'في عام 1983 ، أسس محمد مرشدي شركة معمار المرشدي باستراتيجية عمل واضحة لاختراق صناعة التطوير العقاري. وقد قام السيد / المرشدي بتوظيف فريق قوي من المهندسين و المستوحين من نفس الفكر ، والذين أصبحوا معروفين فيما بعد باسم دجلة للتطوير العقاري ، وهو عماد ميثاق المرشدي.

في السنوات الأولى ، أطلقت Memaar Al Morshedy العديد من المباني السكنية المصممة للعائلات المتعددة في منطقة المعادي. كل من هذه المساكن عرضت نمط فريد من نوعه والتصميم الذي صمد أمام اختبار الزمن.

تقدم مشروعات "معمار المرشدي" مفهومًا جديدًا للمعيشة يوفر مشاريع تنموية متكاملة تجمع بين المباني السكنية والإدارية والتجارية في مكان واحد لمساعدة عملائنا على الاستمتاع بحياة أكثر راحة.

تتأهب شركة "معمار المرشدي" للنجاحات التي حققتها من خلال مجموعة واسعة من المشاريع العقارية التي تتراوح بين المساكن الإقتصادية والإسكان من الطبقة المتوسطة وحتى المساكن الفخمة في جميع أنحاء القاهرة والجيزة.

مهمتنا
تصميم وبناء وإدارة مشاريع سكنية وتجارية وإدارية ورياضية وترفيهية راقية وذات رؤية طويلة المدى لكل من عملائنا وشركائنا في العمل ومجتمعنا، مع إلتزامنا بالنزاهة والأمانة والحرفية والإبداع والج

رؤيتنا
تقديم معمار عصري ذو ملامح جمالية فريدة بتصميمات مبتكرة وراقية تترك أثرها الجمالي والإيجابي علي مجتمعنا، مع الإستثمار الدائم للفكر والإبداع للتوسع في السوق الإقليمية.

القيم
إن نجاح معمار المرشدى تحكمه مبادئنا الأساسية التالية :

النزاهة
الأمانة
الحرفية

جودة الأفكار والأفعال

',
            'commercial_file'=>'IxrWG8Zsec.pdf'
        ]);
        Blog::create([
            'type'=>'new',
            'writer_id'=>1,
            'title_ar'=>'كيفية التعلم عن بعد',
            'title_en'=>'كيفية التعلم عن بعد',
            'note_ar'=>'كيفية التعلم عن بعد',
            'note_en'=>'كيفية التعلم عن بعد',
            'media_type'=>'image',
        ]);
        Blog::create([
            'type'=>'new',
            'writer_id'=>1,
            'title_ar'=>'2كيفية التعلم عن بعد',
            'title_en'=>'2كيفية التعلم عن بعد',
            'note_ar'=>'كيفية التعلم عن بعد',
            'note_en'=>'كيفية التعلم عن بعد',
            'media_type'=>'image',
        ]);
        Blog::create([
            'type'=>'blog',
            'writer_id'=>1,
            'title_ar'=>'كيفية التعلم عن بعد',
            'title_en'=>'كيفية التعلم عن بعد',
            'note_ar'=>'كيفية التعلم عن بعد',
            'note_en'=>'كيفية التعلم عن بعد',
            'media_type'=>'image',
        ]);
        Blog::create([
            'type'=>'blog',
            'writer_id'=>1,
            'title_ar'=>'كيفية التعلم ',
            'title_en'=>'كيفية التعلم ',
            'note_ar'=>'كيفية التعلم ',
            'note_en'=>'كيفية التعلم ',
            'media_type'=>'image',
        ]);
        Blog::create([
            'type'=>'blog',
            'writer_id'=>1,
            'title_ar'=>'كيفية التعلم2 ',
            'title_en'=>'كيفية التعلم2 ',
            'note_ar'=>'كيفية التعلم ',
            'note_en'=>'كيفية التعلم ',
            'media_type'=>'image',
        ]);
    }
}
