<?php
namespace Database\Seeders;

use App\Models\ContentItem;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@eduweb.test'], ['name' => 'Administrator', 'password' => Hash::make('admin12345')]);
        $settings = [
            'brand'=>'EduWeb Studio','hero_badge'=>'Spesialis Website Pendidikan',
            'hero_title'=>'Website sekolah yang modern, terpercaya, dan mudah dikelola.',
            'hero_text'=>'Kami membantu sekolah, pesantren, kampus, dan lembaga pendidikan memiliki website profesional untuk meningkatkan citra, menyampaikan informasi, dan mempermudah komunikasi dengan siswa serta orang tua.',
            'whatsapp'=>'62895321272932','whatsapp_secondary'=>'628131951083','email'=>'hello@eduwebstudio.id','address'=>'Jakarta, Indonesia',
            'cta_title'=>'Siap membuat website sekolah yang lebih profesional?',
            'cta_text'=>'Konsultasikan kebutuhan Anda dan dapatkan rekomendasi paket terbaik tanpa biaya.'
        ];
        foreach ($settings as $key=>$value) Setting::updateOrCreate(['key'=>$key], ['value'=>$value]);

        $data = [
          'services' => [
            ['🎨','Desain Website Custom','Tampilan eksklusif sesuai identitas, warna, visi, dan karakter sekolah.'],
            ['📱','Responsif Semua Perangkat','Nyaman diakses melalui komputer, tablet, maupun smartphone.'],
            ['📰','Berita & Pengumuman','Kelola informasi sekolah, agenda, prestasi, dan pengumuman dengan mudah.'],
            ['🎓','PPDB Online','Formulir pendaftaran siswa baru yang praktis, rapi, dan terintegrasi.'],
            ['🔎','SEO & Google Friendly','Struktur website dioptimalkan agar lebih mudah ditemukan di Google.'],
            ['🛠️','Maintenance & Support','Dukungan teknis, backup, keamanan, dan pembaruan website secara berkala.'],
          ],
          'portfolio' => [
            ['', 'SMAN Harapan Bangsa','Website profil sekolah, berita, agenda, dan galeri kegiatan.','Sekolah Menengah'],
            ['', 'Pesantren Al-Hikmah','Profil pesantren, program pendidikan, pendaftaran, dan donasi.','Pesantren'],
            ['', 'SD Kreativa Nusantara','Website ceria, informatif, dan ramah untuk orang tua siswa.','Sekolah Dasar'],
            ['', 'Universitas Cakrawala','Portal akademik dan informasi kampus yang rapi untuk calon mahasiswa.','Perguruan Tinggi'],
          ],
          'features' => [
            ['01','Administrasi mudah','Admin sekolah dapat mengubah berita, galeri, halaman, dan pengumuman tanpa coding.'],
            ['02','Desain kredibel dan profesional','Meningkatkan kepercayaan calon siswa, orang tua, alumni, dan masyarakat.'],
            ['03','Keamanan dan performa terjaga','Website dioptimalkan agar cepat, aman, dan stabil saat diakses banyak pengunjung.'],
          ],
          'process' => [
            ['01','Konsultasi','Kami pelajari kebutuhan, target, fitur, dan identitas sekolah.'],
            ['02','Desain','Kami buat rancangan tampilan modern dan mudah dipahami.'],
            ['03','Pengembangan','Desain diubah menjadi website responsif dan berfungsi penuh.'],
            ['04','Peluncuran','Website diuji, dipublikasikan, dan diserahkan bersama panduan.'],
          ],
          'pricing' => [
            ['', 'Paket Basic','Cocok untuk sekolah yang membutuhkan website profil sederhana.','Rp2,5jt',['5 halaman utama','Desain responsif','Form kontak','Domain & hosting 1 tahun','Support 30 hari']],
            ['', 'Paket Professional','Solusi lengkap untuk sekolah dengan kebutuhan informasi aktif.','Rp4,9jt',['Hingga 12 halaman','Berita & pengumuman','Galeri & agenda','Admin dashboard','SEO dasar','Support 90 hari']],
            ['', 'Paket Custom','Untuk sekolah yang membutuhkan fitur khusus dan integrasi lengkap.','Custom',['PPDB online','Integrasi pembayaran','Portal siswa/guru','Multi bahasa','Fitur khusus lainnya']],
          ],
          'testimonials' => [
            ['', 'Budi Santoso, M.Pd.','Tim EduWeb sangat memahami kebutuhan sekolah kami. Hasil websitenya modern, cepat, dan memudahkan staf dalam mengelola informasi.','Kepala Sekolah SMAN Harapan Bangsa'],
          ],
          'faqs' => [
            ['', 'Berapa lama proses pembuatan website?','Rata-rata 2–4 minggu, tergantung jumlah halaman, kelengkapan materi, dan fitur yang dibutuhkan.'],
            ['', 'Apakah sekolah bisa mengubah konten sendiri?','Bisa. Kami menyediakan dashboard admin dan panduan penggunaan agar staf sekolah dapat mengelola konten dengan mudah.'],
            ['', 'Apakah sudah termasuk domain dan hosting?','Paket Basic dan Professional sudah termasuk domain serta hosting selama satu tahun.'],
            ['', 'Apakah menerima desain dan fitur khusus?','Ya. Kami dapat menyesuaikan desain, fitur PPDB, portal siswa, pembayaran, dan integrasi lainnya.'],
          ],
        ];
        foreach ($data as $section=>$rows) foreach ($rows as $i=>$row) ContentItem::firstOrCreate(['section'=>$section,'title'=>$row[1]], [
            'icon'=>$row[0] ?: null, 'description'=>$row[2],
            'subtitle'=>(in_array($section,['portfolio','testimonials']) ? ($row[3] ?? null) : null),
            'price'=>$section === 'pricing' ? ($row[3] ?? null) : null,
            'meta'=>$section === 'pricing' ? ['features'=>$row[4] ?? []] : null,'sort_order'=>$i+1
        ]);

        $portfolioImages = [
            'SMAN Harapan Bangsa' => 'portfolio/sman-harapan-bangsa.png',
            'Pesantren Al-Hikmah' => 'portfolio/pesantren-al-hikmah.png',
            'SD Kreativa Nusantara' => 'portfolio/sd-kreativa-nusantara.png',
            'Universitas Cakrawala' => 'portfolio/universitas-cakrawala.png',
        ];
        foreach ($portfolioImages as $title => $imagePath) {
            ContentItem::where('section', 'portfolio')->where('title', $title)->update(['image_path' => $imagePath]);
        }
    }
}
