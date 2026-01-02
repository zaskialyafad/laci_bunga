<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
        ['product_name' => 'Meadow Whisper Floral Dress', 'category_id' => 1, 'description' => 'Dress katun dengan motif bunga padang rumput yang lembut.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Vintage Lace Picnic Dress', 'category_id' => 1, 'description' => 'Dress putih dengan detail renda bordir tangan yang klasik.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Daisy Dream Tiered Maxi', 'category_id' => 1, 'description' => 'Maxi dress bertingkat yang memberikan kesan jenjang dan anggun.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Prairie Sunsets Midi Dress', 'category_id' => 1, 'description' => 'Midi dress dengan warna hangat untuk tampilan senja yang manis.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Peony Puff Sleeve Dress', 'category_id' => 1, 'description' => 'Dress dengan lengan puff ikonik gaya cottagecore.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],

        ['product_name' => 'Muted Sage Linen Outer', 'category_id' => 2, 'description' => 'Outer linen panjang warna sage yang menenangkan.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Dusty Rose Knit Cardigan', 'category_id' => 2, 'description' => 'Cardigan rajut lembut dengan kancing mutiara.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Forest Fern Embroidered Vest', 'category_id' => 2, 'description' => 'Rompi dengan bordir manual motif pakis hutan.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],

        ['product_name' => 'Petal Soft Linen Blouse', 'category_id' => 3, 'description' => 'Atasan linen berkualitas tinggi yang nyaman dipakai seharian.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Morning Dew Eyelet Top', 'category_id' => 3, 'description' => 'Blouse dengan detail lubang eyelet yang manis dan sejuk.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Antique Rose Square Neck Blouse', 'category_id' => 3, 'description' => 'Atasan kerah kotak yang memberikan kesan vintage.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Wildflower Smocked Top', 'category_id' => 3, 'description' => 'Atasan fleksibel dengan karet smocking yang inklusif untuk semua ukuran.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],

        ['product_name' => 'Linen Field Culottes', 'category_id' => 4, 'description' => 'Kulot linen potongan lebar untuk ruang gerak yang bebas.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Secret Garden Pleated Skirt', 'category_id' => 4, 'description' => 'Rok plisket dengan warna-warna tanah yang netral.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Autumn Leaf Tiered Skirt', 'category_id' => 4, 'description' => 'Rok panjang bertingkat yang feminin.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],

        ['product_name' => 'Laci Bunga Signature Tote', 'category_id' => 5, 'description' => 'Tas kanvas dengan ilustrasi ikonik Laci Bunga.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Straw Garden Hat', 'category_id' => 5, 'description' => 'Topi jerami klasik untuk melindungi dari matahari.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Wild Rose Silk Scarf', 'category_id' => 5, 'description' => 'Syal sutra motif bunga untuk aksen manis di leher atau tas.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],

        ['product_name' => 'Cottage Comfort Loungewear Set', 'category_id' => 6, 'description' => 'Satu set atasan dan bawahan santai berbahan katun organik.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ['product_name' => 'Dreamy Dusk Pajamas Set', 'category_id' => 6, 'description' => 'Set piyama dengan kerah renda yang cantik.', 'status' => 'show', 'created_at' => now(), 'updated_at' => now()],
        ];
        Product::insert($data);
    }
}
