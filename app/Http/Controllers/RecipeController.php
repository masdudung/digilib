<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class RecipeController extends Controller
{
    public function index()
    {
        $recipes = [
            [
                'id' => 1,
                'title' => 'Sate Ayam',
                'image' => asset('storage/images/sate_ayam.jpg'),
                'excerpt' => 'Sate ayam bakar disajikan dengan saus kacang.',
                'description' => 'Sate Ayam adalah hidangan Indonesia yang populer yang terbuat dari sate ayam bakar yang disajikan dengan saus kacang yang gurih.',
                'ingredients' => [
                    ['name' => 'Ayam', 'qty' => '500g'],
                    ['name' => 'Saus kacang', 'qty' => '200ml']
                ],
                'steps' => [
                    ['text' => 'Marinasi ayam.'],
                    ['text' => 'Bakar sate ayam.'],
                    ['text' => 'Sajikan dengan saus kacang.']
                ]
            ],
            [
                'id' => 2,
                'title' => 'Rendang',
                'image' => asset('storage/images/rendang.webp'),
                'excerpt' => 'Gulai daging sapi pedas dimasak dengan santan.',
                'description' => 'Rendang adalah gulai daging sapi pedas tradisional Indonesia yang dimasak dengan santan dan campuran serai, lengkuas, bawang putih, kunyit, jahe, dan cabai.',
                'ingredients' => [
                    ['name' => 'Daging sapi', 'qty' => '1kg'],
                    ['name' => 'Santan', 'qty' => '500ml'],
                    ['name' => 'Rempah-rempah', 'qty' => 'secukupnya']
                ],
                'steps' => [
                    ['text' => 'Siapkan rempah-rempah.'],
                    ['text' => 'Masak daging sapi dengan santan dan rempah-rempah hingga empuk.'],
                    ['text' => 'Sajikan dengan nasi.']
                ]
            ],
            [
                'id' => 3,
                'title' => 'Nasi Goreng',
                'image' => asset('storage/images/nasigoreng.jpg'),
                'excerpt' => 'Nasi goreng dengan sayuran dan daging.',
                'description' => 'Nasi Goreng adalah nasi goreng Indonesia yang biasanya dimasak dengan kecap manis, bawang putih, bawang merah, dan cabai, sering disajikan dengan telur goreng dan udang atau ayam.',
                'ingredients' => [
                    ['name' => 'Nasi', 'qty' => '500g'],
                    ['name' => 'Sayuran', 'qty' => '200g'],
                    ['name' => 'Kecap', 'qty' => '50ml']
                ],
                'steps' => [
                    ['text' => 'Tumis sayuran.'],
                    ['text' => 'Tambahkan nasi dan kecap.'],
                    ['text' => 'Sajikan dengan telur goreng di atasnya.']
                ]
            ],
            [
                'id' => 4,
                'title' => 'Gado-Gado',
                'image' => asset('storage/images/gadogado.jpg'),
                'excerpt' => 'Salad Indonesia dengan saus kacang.',
                'description' => 'Gado-Gado adalah salad Indonesia yang terdiri dari sayuran yang direbus atau dikukus, telur rebus, kentang rebus, tahu goreng, tempeh, dan lontong, disajikan dengan saus kacang.',
                'ingredients' => [
                    ['name' => 'Sayuran', 'qty' => '500g'],
                    ['name' => 'Saus kacang', 'qty' => '200ml'],
                    ['name' => 'Tahu', 'qty' => '200g']
                ],
                'steps' => [
                    ['text' => 'Rebus sayuran.'],
                    ['text' => 'Siapkan saus kacang.'],
                    ['text' => 'Sajikan sayuran dengan saus kacang.']
                ]
            ],
            [
                'id' => 5,
                'title' => 'Sop Buntut',
                'image' => asset('storage/images/sopbuntut.jpg'),
                'excerpt' => 'Sup buntut dengan sayuran.',
                'description' => 'Sop Buntut adalah sup buntut tradisional Indonesia yang disajikan dengan kuah yang kaya dan sayuran.',
                'ingredients' => [
                    ['name' => 'Buntut', 'qty' => '1kg'],
                    ['name' => 'Sayuran', 'qty' => '500g'],
                    ['name' => 'Kaldu', 'qty' => '1L']
                ],
                'steps' => [
                    ['text' => 'Rebus buntut.'],
                    ['text' => 'Tambahkan sayuran dan masak hingga empuk.'],
                    ['text' => 'Sajikan panas dengan nasi.']
                ]
            ],
            [
                'id' => 6,
                'title' => 'Bakmi Goreng',
                'image' => asset('storage/images/bakmigoreng.jpg'),
                'excerpt' => 'Mie goreng dengan sayuran dan daging.',
                'description' => 'Bakmi Goreng adalah mie goreng Indonesia dengan sayuran dan daging atau seafood pilihan Anda.',
                'ingredients' => [
                    ['name' => 'Mie', 'qty' => '500g'],
                    ['name' => 'Sayuran', 'qty' => '200g'],
                    ['name' => 'Kecap', 'qty' => '50ml']
                ],
                'steps' => [
                    ['text' => 'Rebus mie.'],
                    ['text' => 'Tumis sayuran dan daging.'],
                    ['text' => 'Campurkan dengan mie dan kecap.']
                ]
            ],
            [
                'id' => 7,
                'title' => 'Ayam Penyet',
                'image' => asset('storage/images/ayampenyet.webp'),
                'excerpt' => 'Ayam goreng yang dihancurkan dengan sambal.',
                'description' => 'Ayam Penyet adalah ayam goreng Indonesia yang dihancurkan dengan cobek dan disajikan dengan sambal pedas.',
                'ingredients' => [
                    ['name' => 'Ayam', 'qty' => '1kg'],
                    ['name' => 'Sambal', 'qty' => 'secukupnya'],
                    ['name' => 'Minyak', 'qty' => 'untuk menggoreng']
                ],
                'steps' => [
                    ['text' => 'Goreng ayam.'],
                    ['text' => 'Hancurkan dengan sambal.'],
                    ['text' => 'Sajikan dengan nasi.']
                ]
            ],
            [
                'id' => 8,
                'title' => 'Tempe Bacem',
                'image' => asset('storage/images/tempebacem.webp'),
                'excerpt' => 'Tempe marinated manis dan gurih.',
                'description' => 'Tempe Bacem adalah hidangan tradisional Jawa yang terbuat dari tempe yang dimarinasi dalam campuran manis dan gurih, lalu digoreng hingga kecokelatan.',
                'ingredients' => [
                    ['name' => 'Tempe', 'qty' => '500g'],
                    ['name' => 'Kecap manis', 'qty' => '100ml'],
                    ['name' => 'Rempah-rempah', 'qty' => 'secukupnya']
                ],
                'steps' => [
                    ['text' => 'Marinasi tempe.'],
                    ['text' => 'Goreng hingga kecokelatan.'],
                    ['text' => 'Sajikan sebagai lauk.']
                ]
            ],
            [
                'id' => 9,
                'title' => 'Kerak Telor',
                'image' => asset('storage/images/keraktelor.jpg'),
                'excerpt' => 'Omelette Betawi tradisional.',
                'description' => 'Kerak Telor adalah omelette Betawi tradisional yang terbuat dari beras ketan yang dimasak dengan telur dan disajikan dengan kelapa parut dan bawang goreng.',
                'ingredients' => [
                    ['name' => 'Beras ketan', 'qty' => '200g'],
                    ['name' => 'Telur', 'qty' => '2'],
                    ['name' => 'Kelapa', 'qty' => '100g']
                ],
                'steps' => [
                    ['text' => 'Masak beras ketan.'],
                    ['text' => 'Campur dengan telur dan goreng.'],
                    ['text' => 'Tambahkan kelapa parut dan bawang goreng.']
                ]
            ],
            [
                'id' => 10,
                'title' => 'pecellele.jpg',
                'image' => asset('storage/images/pecellele.jpg'),
                'excerpt' => 'Lele goreng disajikan dengan sambal.',
                'description' => 'Pecel Lele adalah hidangan tradisional Indonesia yang terdiri dari lele goreng yang disajikan dengan sambal dan nasi.',
                'ingredients' => [
                    ['name' => 'Lele', 'qty' => '1kg'],
                    ['name' => 'Sambal', 'qty' => 'secukupnya'],
                    ['name' => 'Minyak', 'qty' => 'untuk menggoreng']
                ],
                'steps' => [
                    ['text' => 'Goreng lele.'],
                    ['text' => 'Sajikan dengan sambal dan nasi.']
                ]
            ],
            [
                'id' => 11,
                'title' => 'Bakso',
                'image' => asset('storage/images/bakso.webp'),
                'excerpt' => 'Bola daging disajikan dengan mie dan sayuran.',
                'description' => 'Bakso adalah bola daging Indonesia yang disajikan dalam kuah kaldu yang gurih, disajikan dengan mie, sayuran, dan bawang goreng.',
                'ingredients' => [
                    ['name' => 'Bakso', 'qty' => '500g'],
                    ['name' => 'Kaldu', 'qty' => '1L'],
                    ['name' => 'Mie', 'qty' => '200g']
                ],
                'steps' => [
                    ['text' => 'Rebus bakso dalam kaldu.'],
                    ['text' => 'Tambahkan mie dan sayuran.'],
                    ['text' => 'Sajikan panas dengan bawang goreng.']
                ]
            ],
            [
                'id' => 12,
                'title' => 'Tahu Gejrot',
                'image' => asset('storage/images/tahugejrot.jpg'),
                'excerpt' => 'Tahu goreng dengan saus pedas manis.',
                'description' => 'Tahu Gejrot adalah jajanan tradisional Indonesia yang terbuat dari tahu goreng yang disajikan dengan saus pedas dan manis yang terbuat dari gula aren, cuka, dan cabai.',
                'ingredients' => [
                    ['name' => 'Tahu', 'qty' => '500g'],
                    ['name' => 'Gula aren', 'qty' => '100g'],
                    ['name' => 'Cuka', 'qty' => '50ml']
                ],
                'steps' => [
                    ['text' => 'Goreng tahu.'],
                    ['text' => 'Siapkan saus.'],
                    ['text' => 'Sajikan tahu dengan saus.']
                ]
            ],
            [
                'id' => 13,
                'title' => 'Bubur Ayam',
                'image' => asset('storage/images/buburayam.jpg'),
                'excerpt' => 'Bubur ayam dengan topping.',
                'description' => 'Bubur Ayam adalah bubur ayam Indonesia yang disajikan dengan berbagai topping seperti ayam suwir, bawang goreng, dan kecap.',
                'ingredients' => [
                    ['name' => 'Beras', 'qty' => '200g'],
                    ['name' => 'Ayam', 'qty' => '200g'],
                    ['name' => 'Topping', 'qty' => 'secukupnya']
                ],
                'steps' => [
                    ['text' => 'Masak beras hingga menjadi bubur.'],
                    ['text' => 'Tambahkan ayam suwir dan topping.'],
                    ['text' => 'Sajikan panas.']
                ]
            ],
            [
                'id' => 14,
                'title' => 'Opor Ayam',
                'image' => asset('storage/images/oporayam.jpg'),
                'excerpt' => 'Ayam dimasak dalam santan.',
                'description' => 'Opor Ayam adalah hidangan tradisional Indonesia yang terbuat dari ayam yang dimasak dalam santan dan berbagai rempah.',
                'ingredients' => [
                    ['name' => 'Ayam', 'qty' => '1kg'],
                    ['name' => 'Santan', 'qty' => '500ml'],
                    ['name' => 'Rempah-rempah', 'qty' => 'secukupnya']
                ],
                'steps' => [
                    ['text' => 'Masak ayam dengan santan dan rempah-rempah.'],
                    ['text' => 'Didihkan hingga ayam empuk.'],
                    ['text' => 'Sajikan panas dengan nasi.']
                ]
            ],
            [
                'id' => 15,
                'title' => 'Martabak Manis',
                'image' => asset('storage/images/martabakmanis.jpg'),
                'excerpt' => 'Pancake manis dengan isian.',
                'description' => 'Martabak Manis adalah pancake manis Indonesia yang populer dengan isian cokelat, keju, atau isian manis lainnya.',
                'ingredients' => [
                    ['name' => 'Tepung', 'qty' => '200g'],
                    ['name' => 'Gula', 'qty' => '100g'],
                    ['name' => 'Isian', 'qty' => 'secukupnya']
                ],
                'steps' => [
                    ['text' => 'Siapkan adonan.'],
                    ['text' => 'Masak pancake.'],
                    ['text' => 'Tambahkan isian dan lipat.']
                ]
            ],
            [
                'id' => 16,
                'title' => 'Es Cendol',
                'image' => asset('storage/images/escendol.webp'),
                'excerpt' => 'Minuman es dengan jeli pandan.',
                'description' => 'Es Cendol adalah minuman es Indonesia yang terbuat dari jeli pandan, santan, dan sirup gula aren.',
                'ingredients' => [
                    ['name' => 'Jeli pandan', 'qty' => '200g'],
                    ['name' => 'Santan', 'qty' => '500ml'],
                    ['name' => 'Sirup gula aren', 'qty' => '200ml']
                ],
                'steps' => [
                    ['text' => 'Siapkan jeli pandan.'],
                    ['text' => 'Campur dengan santan dan sirup gula aren.'],
                    ['text' => 'Sajikan dengan es.']
                ]
            ],
            [
                'id' => 17,
                'title' => 'Gudeg',
                'image' => asset('storage/images/gudeg.jpg'),
                'excerpt' => 'Sayur nangka muda manis khas Jawa.',
                'description' => 'Gudeg adalah hidangan tradisional Jawa yang terbuat dari nangka muda yang dimasak dengan gula aren dan santan.',
                'ingredients' => [
                    ['name' => 'Nangka muda', 'qty' => '1kg'],
                    ['name' => 'Santan', 'qty' => '500ml'],
                    ['name' => 'Gula aren', 'qty' => '200g']
                ],
                'steps' => [
                    ['text' => 'Masak nangka dengan santan dan gula aren.'],
                    ['text' => 'Didihkan hingga empuk.'],
                    ['text' => 'Sajikan panas dengan nasi.']
                ]
            ],
            [
                'id' => 18,
                'title' => 'Soto Ayam',
                'image' => asset('storage/images/sotoayam.jpg'),
                'excerpt' => 'Sup ayam dengan kuah kunyit.',
                'description' => 'Soto Ayam adalah sup ayam Indonesia dengan kuah kunyit kuning, disajikan dengan lontong dan telur rebus.',
                'ingredients' => [
                    ['name' => 'Ayam', 'qty' => '500g'],
                    ['name' => 'Kunyit', 'qty' => 'secukupnya'],
                    ['name' => 'Kaldu', 'qty' => '1L']
                ],
                'steps' => [
                    ['text' => 'Masak ayam dengan kunyit dan kaldu.'],
                    ['text' => 'Tambahkan lontong dan telur rebus.'],
                    ['text' => 'Sajikan panas.']
                ]
            ],
            [
                'id' => 19,
                'title' => 'Rawon',
                'image' => asset('storage/images/rawon.jpg'),
                'excerpt' => 'Sup daging dengan kuah hitam.',
                'description' => 'Rawon adalah sup daging tradisional Indonesia dengan kuah hitam yang terbuat dari kluwak.',
                'ingredients' => [
                    ['name' => 'Daging sapi', 'qty' => '500g'],
                    ['name' => 'Kluwak', 'qty' => 'secukupnya'],
                    ['name' => 'Kaldu', 'qty' => '1L']
                ],
                'steps' => [
                    ['text' => 'Masak daging sapi dengan kluwak dan kaldu.'],
                    ['text' => 'Didihkan hingga empuk.'],
                    ['text' => 'Sajikan panas dengan nasi.']
                ]
            ],
            [
                'id' => 20,
                'title' => 'Sayur Asem',
                'image' => asset('storage/images/sayurasem.jpg'),
                'excerpt' => 'Sup sayuran asam.',
                'description' => 'Sayur Asem adalah sup sayuran tradisional Indonesia dengan kuah asam dari asam jawa.',
                'ingredients' => [
                    ['name' => 'Sayuran', 'qty' => '500g'],
                    ['name' => 'Asam jawa', 'qty' => 'secukupnya'],
                    ['name' => 'Kaldu', 'qty' => '1L']
                ],
                'steps' => [
                    ['text' => 'Masak sayuran dengan asam jawa dan kaldu.'],
                    ['text' => 'Didihkan hingga sayuran matang.'],
                    ['text' => 'Sajikan panas.']
                ]
            ],
        ];

        return response()->json(['data' => $recipes]);
    }

    public function order(Request $request) {
        // Kirim email ke pengguna tentang detail order
        try {
            Mail::to($request->email)->send(new OrderCreated($request->all()));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email order: ' . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order berhasil dibuat, silakan cek email anda untuk melihat detail order',
            'request' => $request->all()
        ]);
    }
}