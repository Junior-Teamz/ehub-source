<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\Mentor;
use App\Models\News;
use App\Models\Workshop;
use App\Models\JourneyLogo;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['entrepreneur_steps'] = collect([
            (object) [
                'slug' => 'business-plan',
                'image' => asset('images/journey/2.jpg'),
                'title' => 'Mau Mencari Ide Bisnis?',
                'view' => 'business-plan',
            ],
            (object) [
                'slug' => 'business-launch',
                'image' => asset('images/journey/3.jpg'),
                'title' => 'Yuk! Mulai Mengelola Bisnis',
                'view' => 'business-launch',
            ],
            (object) [
                'slug' => 'business-growth',
                'image' => asset('images/journey/1.jpg'),
                'title' => 'Saatnya Bisnismu Bertumbuh Pesat',
                'view' => 'business-growth',
            ],
        ]);
        $data['workshops'] = Workshop::with(['hasTags', 'hasTargets'])->where('status', 'publish')->latest()->limit(6)->get();
        $data['courses'] = collect([
            (object) [
                'title' => 'Pentingnya Hak Kekayaan Intelektual Merk Usaha',
                'image' => 'course-1.png',
                'instructor' => 'Juliana Ratu, M.Si',
                'field' => 'Expert Legal',
                'description' => 'Mengenal apa itu HAKI Merk dan apa benefitnya dan bagaimana cara mendaftarnya',
                'price' => 20000 !== 0 ? rupiah_format(20000) : 'Gratis!',
            ],
            (object) [
                'title' => 'FOMO Marketing Brand Viral',
                'image' => 'course-2.png',
                'instructor' => 'Handoko Hendro',
                'field' => 'Marketing Expert',
                'description' => 'Ingin bisnis melesat cepat? banyak dikenal sama semua orang? pakai FOMO marketing Viral. semua orang bisa melakukan itu, dan semua orang bisa meniru itu, yang gak bisa ditiru actionnya',
                'price' => 0 !== 0 ? 0 : 'Gratis!',
            ],
            (object) [
                'title' => 'Kelas Keuangan Bagi CEO',
                'image' => 'course-3.png',
                'instructor' => 'Amanda Manapa',
                'field' => 'Finance Expert',
                'description' => 'Keuangan sangat penting bagi CEO, untuk memahami itu membutuhkan ilmu dan pengalaman dari para expert di bidang keuangan. cara-cara jitu agar dapat memahami dan memantau perusahaan dengan mudah',
                'price' => 500000 !== 0 ? rupiah_format(500000) : 'Gratis!',
            ],
            (object) [
                'title' => 'Teamwork Stabil dan Maksimal Hasil',
                'image' => 'course-4.png',
                'instructor' => 'Rudi Antara',
                'field' => 'HC Expert',
                'description' => 'Membangun Tim menjadi hal yang sangat penting. Tim kuat perusahaan hebat.',
                'price' => 0 !== 0 ? 0 : 'Gratis!',
            ],
            (object) [
                'title' => 'Sales Canvasing Bagus, Perusahaan Melesat',
                'image' => 'course-5.png',
                'instructor' => 'Ratna Suraningsih',
                'field' => 'Sales Expert',
                'description' => 'Sales yang gesit dan punya banyak relasi menjadi kunci utama penjualan perusahaan meningkat.',
                'price' => 150000 !== 0 ? rupiah_format(150000) : 'Gratis!',
            ],
            (object) [
                'title' => 'Strategi Frinchise Mempercepat Jangkauan Usaha',
                'image' => 'course-6.png',
                'instructor' => 'Hadi Cahyadi',
                'field' => 'Frinchise Expert',
                'description' => 'Frinchise merupakan salah satu strategi yang banyak digunakan oleh para wirausaha',
                'price' => 0 !== 0 ? 0 : 'Gratis!',
            ],
        ]);
        $data['testimonials'] = collect([
            (object) [
                'image' => asset('images/testimoni/testimoni4.jpg'),
                'name' => 'Muchammad Edo',
                'position' => 'CEO Ezy Industries',
                'content' => '“EHub memudahkan kita untuk mengakses pengetahuan & mempercepat proses scaling up, juga menghubungkan dengan kesempatan pendanaan dari berbagai kemungkinan investment model. Semoga lebih banyak entrepeneur sukses bertaraf internasional yang lahir dari Ehub.”',
            ],
            (object) [
                'image' => asset('images/testimoni/testimoni3.jpg'),
                'name' => 'Eka Putra',
                'position' => 'Marketing Manager Deorex Body Odorizer',
                'content' => '“Manfaat yang sangat terasa ketika saya bergabung di EntrepreneurHub adalah koneksi-koneksi baru sehingga bisa sharing dan belajar dari pengalaman satu sama lain dan tidak menutup kemungkinan menjadi partner bisnis.”',
            ],
            (object) [
                'image' => asset('images/testimoni/testimoni2.jpg'),
                'name' => 'Widya Natalia',
                'position' => 'Owner @sweetiws dan @jineng.catering',
                'content' => '“Senang sekali menjadi 100 wirausaha yang terpilih. Pada acara EntrepreneurHub ini, saya banyak mendapatkan insight penting untuk bisnis saya. Dengan bimbingan Mentor Darwadi, mudah-mudahan bisnis catering dan dessert saya bisa bertumbuh pesat.”',
            ],
            (object) [
                'image' => asset('images/testimoni/testimoni1.jpg'),
                'name' => 'Desiyana C. N. Waruwu',
                'position' => 'Fasilitator Ibu Penggerak Sidina Community',
                'content' => '“Saya sangat senang bisa mengikuti webinar ini secara langsung karena dari webinar ini saya jadi mengerti bahwa untuk menjadi seorang pebisnis yang paling dibutuhkan itu adalah modal keberanian dan percaya diri, selebihnya bisa menyusul dan disesuaikan serta dipelajari.”',
            ],
        ]);
        $data['news'] = News::with(['hasTags'])->where('status', 'publish')->latest()->get();
        $data['faqs'] = collect([
            (object) [
                'question' => 'Siapa saja yang dapat mengikuti program Entrepeneur Hub ini?',
                'answer' => 'Seluruh masyarakat Indonesia dapat mendaftar dan mengikuti progam yang tersedia di platform EntrepeneurHub sesuai dengan ketentuan yang berlaku di setiap progam.',
            ],
            (object) [
                'question' => 'Bagaimana caranya saya bisa bergabung di program Entrepeneur Hub?',
                'answer' => 'Silahkan mendaftar dan memiliki akun di platform Entrepeneurhub sehingga Sobat Entrepeneur dapat mengakses seluruh progam yang tertera di EntrepeneurHub',
            ],
            // (object) [
            //     'question' => 'Mengapa harus memasukkan NIK ketika mendaftar dan apakah terjamin kerahasiaanya?',
            //     'answer' => 'Nomor Induk Kependudukan (NIK) merupakan identitas yang tervalidasi oleh pemerintah yang kedepannya akan menjadi progam satu data pemerintah, sesuai dengan Perpres no 2 Tahun 2022 pendataan pelaku usaha mencantumkan NIK dan platform EntrepeneurHub menjamin keamanan dan kerahasiaan NIK',
            // ],
            (object) [
                'question' => 'Apa saja manfaat bergabung di program EntrepreneurHub?',
                'answer' => 'Pelaku usaha akan mendapatkan akses informasi kegiatan kewirausahaan dari 27 Kementerian/Lembaga yang terpercaya dan dapat menjalin kolaborasi dengan usaha lain yang terdaftar di EntrepeneurHub',
            ],
            (object) [
                'question' => 'Fasilitas apa yang di dapat jika tergabung di program Entrepreneur Hub?',
                'answer' => 'Pelaku usaha akan mendapatkan ruang khusus untuk menampilkan usahanya di EntrepeneurHub, Pelaku usaha akan mendapatkan jejaring informasi mengenai pendanaan progam kewirausahaan, Pelaku usaha akan terjaring bersama bank-bank yang menjadi mitra EntrepeneurHub',
            ],
        ]);

        $data['partners'] = collect([
            (object) [
                'name' => 'Logo Warjali',
                'logo' => asset('images/communities/warjali.png'),
            ],
            (object) [
                'name' => 'Logo Uwala',
                'logo' => asset('images/communities/uwala.png'),
            ],
            (object) [
                'name' => 'Logo Sidina Community',
                'logo' => asset('images/communities/sidina-community.png'),
            ],
            (object) [
                'name' => 'Logo Surplus',
                'logo' => asset('images/communities/surplus.png'),
            ],
            (object) [
                'name' => 'Logo Nirmala',
                'logo' => asset('images/communities/nirmala_2.png'),
            ],
            (object) [
                'name' => 'Logo BRI',
                'logo' => asset('images/communities/bri.webp'),
            ],
            (object) [
                'name' => 'Logo Innovative Academy',
                'logo' => asset('images/communities/innovative-academy.jpg'),
            ],
            (object) [
                'name' => 'Logo Praktis',
                'logo' => asset('images/communities/praktis.png'),
            ],
            (object) [
                'name' => 'Logo Xendit',
                'logo' => asset('images/communities/xendit_2.png'),
            ],
            (object) [
                'name' => 'Logo Investree',
                'logo' => asset('images/communities/investree_2.png'),
            ],
            (object) [
                'name' => 'Logo East Ventures',
                'logo' => asset('images/communities/eastventures.jpg'),
            ],
            (object) [
                'name' => 'Logo Jakpreneur',
                'logo' => asset('images/communities/jakpreneur.png'),
            ],
            (object) [
                'name' => 'Logo Padi UMKM',
                'logo' => asset('images/communities/padiumkm.png'),
            ],
            (object) [
                'name' => 'Logo BSN',
                'logo' => asset('images/communities/bsn.png'),
            ],
            (object) [
                'name' => 'Logo BPOM',
                'logo' => asset('images/communities/bpom.png'),
            ],
            (object) [
                'name' => 'Logo Kemenkeu',
                'logo' => asset('images/partners/kemenkeu_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemendikbud',
                'logo' => asset('images/partners/kemendikbud_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemenperin',
                'logo' => asset('images/partners/kemenperin_3.png'),
            ],
            (object) [
                'name' => 'Logo BUMN',
                'logo' => asset('images/partners/bumn.png'),
            ],
            (object) [
                'name' => 'Logo OSS',
                'logo' => asset('images/partners/oss_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemenparekraf',
                'logo' => asset('images/partners/kemenparekraf_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemenperin',
                'logo' => asset('images/partners/kemenperin_2.png'),
            ],
        ]);
        $data['mentors'] = Mentor::with(['hasCollaborator'])->where('status', true)->latest()->limit(10)->get();
        $data['collaborators'] = Collaborator::with(['hasState', 'hasCity'])->where('status', true)->latest()->limit(6)->get();
        return view('landing.home', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about_us()
    {
        $data['testimonials'] = collect([
            (object) [
                'image' => asset('images/testimoni/testimoni4.jpg'),
                'name' => 'Muchammad Edo',
                'position' => 'CEO Ezy Industries',
                'content' => '“EHub memudahkan kita untuk mengakses pengetahuan & mempercepat proses scaling up, juga menghubungkan dengan kesempatan pendanaan dari berbagai kemungkinan investment model. Semoga lebih banyak entrepeneur sukses bertaraf internasional yang lahir dari Ehub.”',
            ],
            (object) [
                'image' => asset('images/testimoni/testimoni3.jpg'),
                'name' => 'Eka Putra',
                'position' => 'Marketing Manager Deorex Body Odorizer',
                'content' => '“Manfaat yang sangat terasa ketika saya bergabung di EntrepreneurHub adalah koneksi-koneksi baru sehingga bisa sharing dan belajar dari pengalaman satu sama lain dan tidak menutup kemungkinan menjadi partner bisnis.”',
            ],
            (object) [
                'image' => asset('images/testimoni/testimoni2.jpg'),
                'name' => 'Widya Natalia',
                'position' => 'Owner @sweetiws dan @jineng.catering',
                'content' => '“Senang sekali menjadi 100 wirausaha yang terpilih. Pada acara EntrepreneurHub ini, saya banyak mendapatkan insight penting untuk bisnis saya. Dengan bimbingan Mentor Darwadi, mudah-mudahan bisnis catering dan dessert saya bisa bertumbuh pesat.”',
            ],
            (object) [
                'image' => asset('images/testimoni/testimoni1.jpg'),
                'name' => 'Desiyana C. N. Waruwu',
                'position' => 'Fasilitator Ibu Penggerak Sidina Community',
                'content' => '“Saya sangat senang bisa mengikuti webinar ini secara langsung karena dari webinar ini saya jadi mengerti bahwa untuk menjadi seorang pebisnis yang paling dibutuhkan itu adalah modal keberanian dan percaya diri, selebihnya bisa menyusul dan disesuaikan serta dipelajari.”',
            ],
        ]);
        $data['partners'] = collect([
            (object) [
                'name' => 'Logo Warjali',
                'logo' => asset('images/communities/warjali.png'),
            ],
            (object) [
                'name' => 'Logo Uwala',
                'logo' => asset('images/communities/uwala.png'),
            ],
            (object) [
                'name' => 'Logo Sidina Community',
                'logo' => asset('images/communities/sidina-community.png'),
            ],
            (object) [
                'name' => 'Logo Surplus',
                'logo' => asset('images/communities/surplus.png'),
            ],
            (object) [
                'name' => 'Logo Nirmala',
                'logo' => asset('images/communities/nirmala_2.png'),
            ],
            (object) [
                'name' => 'Logo BRI',
                'logo' => asset('images/communities/bri.webp'),
            ],
            (object) [
                'name' => 'Logo Innovative Academy',
                'logo' => asset('images/communities/innovative-academy.jpg'),
            ],
            (object) [
                'name' => 'Logo Praktis',
                'logo' => asset('images/communities/praktis.png'),
            ],
            (object) [
                'name' => 'Logo Xendit',
                'logo' => asset('images/communities/xendit_2.png'),
            ],
            (object) [
                'name' => 'Logo Investree',
                'logo' => asset('images/communities/investree_2.png'),
            ],
            (object) [
                'name' => 'Logo East Ventures',
                'logo' => asset('images/communities/eastventures.jpg'),
            ],
            (object) [
                'name' => 'Logo Jakpreneur',
                'logo' => asset('images/communities/jakpreneur.png'),
            ],
            (object) [
                'name' => 'Logo Padi UMKM',
                'logo' => asset('images/communities/padiumkm.png'),
            ],
            (object) [
                'name' => 'Logo BSN',
                'logo' => asset('images/communities/bsn.png'),
            ],
            (object) [
                'name' => 'Logo BPOM',
                'logo' => asset('images/communities/bpom.png'),
            ],
            (object) [
                'name' => 'Logo Kemenkeu',
                'logo' => asset('images/partners/kemenkeu_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemendikbud',
                'logo' => asset('images/partners/kemendikbud_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemenperin',
                'logo' => asset('images/partners/kemenperin_3.png'),
            ],
            (object) [
                'name' => 'Logo BUMN',
                'logo' => asset('images/partners/bumn.png'),
            ],
            (object) [
                'name' => 'Logo OSS',
                'logo' => asset('images/partners/oss_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemenparekraf',
                'logo' => asset('images/partners/kemenparekraf_2.png'),
            ],
            (object) [
                'name' => 'Logo Kemenperin',
                'logo' => asset('images/partners/kemenperin_2.png'),
            ],
        ]);
        return view('landing.about-us', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact_us()
    {
        return view('landing.contact-us');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        return view('landing.faq');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy_policy()
    {
        return view('landing.privacy-policy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function term_condition()
    {
        return view('landing.term-condition');
    }

    public function entrepreneur_step($slug)
    {
        $data['news'] = News::where('status', 'publish')->latest()->limit(4)->get();
        $data['mentors'] = Mentor::where('status', true)->latest()->limit(5)->get();
        $data['workshops'] = Workshop::with(['hasTags', 'hasTargets', 'hasCollaborators'])->where('status', 'publish')->limit(3)->get();
        $data['business_ideas'] = JourneyLogo::where('section_id', 1)->where('status', 1)->latest()->get();
        $data['market_researchs'] = JourneyLogo::where('section_id', 2)->where('status', 1)->latest()->get();
        $data['business_incubators'] = JourneyLogo::where('section_id', 3)->where('status', 1)->latest()->get();
        $data['production'] = JourneyLogo::where('section_id', 5)->where('status', 1)->latest()->get();
        $data['legality'] = JourneyLogo::where('section_id', 4)->where('status', 1)->latest()->get();
        $data['distribution'] = JourneyLogo::where('section_id', 6)->where('status', 1)->latest()->get();
        $data['marketing'] = JourneyLogo::where('section_id', 7)->where('status', 1)->latest()->get();
        $data['finances'] = JourneyLogo::where('section_id', 8)->where('status', 1)->latest()->get();
        $data['enablers'] = JourneyLogo::where('section_id', 9)->where('status', 1)->latest()->get();
        $data['exports'] = JourneyLogo::where('section_id', 10)->where('status', 1)->latest()->get();
        $data['fundings'] = JourneyLogo::where('section_id', 11)->where('status', 1)->latest()->get();
       
        $data['entrepreneur_steps'] = collect([
            (object) [
                'slug' => 'business-plan',
                'image' => 'https://img.freepik.com/free-photo/analyzing-statistics_1098-17372.jpg?w=826&t=st=1685352426~exp=1685353026~hmac=51a23806d525e487bd9a83957004acb7346c66b509984ce3ed8e55005b468457',
                'title' => 'Mau Mencari Ide Bisnis?',
                'view' => 'business-plan',
            ],
            (object) [
                'slug' => 'business-launch',
                'image' => 'https://img.freepik.com/free-photo/women-holding-rocket-icon_53876-20725.jpg?w=900&t=st=1685352680~exp=1685353280~hmac=7bd65aeb77b908a305b3135b40c453b7f7a73f0589e61242c92d6d0ef97e5bec',
                'title' => 'Yuk! Mulai Mengelola Bisnis',
                'view' => 'business-launch',
            ],
            (object) [
                'slug' => 'business-growth',
                'image' => 'https://img.freepik.com/free-photo/man-giving-bar-graph-presentation-using-high-technology-digital-pen_53876-104049.jpg?w=1380&t=st=1685352826~exp=1685353426~hmac=f2865ab9c86eb94c2fc433e96071bcdf033930862c40b8b83d14177427f7f16e',
                'title' => 'Saatnya Bisnismu Bertumbuh Pesat',
                'view' => 'business-growth',
            ],
        ]);

        $stepSelected = $data['entrepreneur_steps']->where('slug', $slug)->first();
        return view('landing.entrepreneur-steps.' . $stepSelected->view, $data);
    }

    public function download($file_name)
    {
        $file_path = public_path('download/' . $file_name);
        return response()->download($file_path);
    }
}
