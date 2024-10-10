
<?php
session_start();
if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: kayitol.php"); // Kayıt ol sayfasına yönlendir
    exit();
}

$username = $_SESSION['kullanici_adi'];

$books = [
    "Akademik" => [
        [
            "title" => "Mühendislik",
            "image" => "wep_resim/1_454.jpg",
            "books" => [
                [
                    "title" => "Calculus",
                    "image" => "wep_resim/calculus.jpg",
                    "description" => "“Kalkülüs” kelimesi Latince saymak veya hesap yapmak için kullanılan çakıl taşı anlamına gelir. Matematiğin temel disiplinlerinden biri olan Matematiksel Analiz alanına giriş olarak kabul edilir. Nasıl ki geometri; şekillerin analiz ve çalışması, cebir; aritmetik operasyonların analiz ve çalışması ise Kalkülüs de sürekli değişimlerin analiz ve çalışmasını hedefler. Dolayısıyla, değişimin ve dönüşümün olduğu her yerde Kalkülüs, en temel betimleme ve algılama aracı olarak kullanılır. Bu yönüyle matematik dışındaki birçok bilim dalı için ortak dil ve metodoloji imkânı sunar. Kalkülüs, değişimin nasıl ve neden olduğunu anlamayı sağlar ve bu açıdan değişim içeren fiziksel sistemleri modellemek için bir altyapı oluşturur."
                ],
                [
                    "title" => "Elektrik",
                    "image" => "wep_resim/elektrik.jpg",
                    "description" => "Elektrik: Bir akımın elektronlar sayesinde serbest bir ortam içerisinde çekim gücü ile belli bir noktaya doğru hareket etmesi ile oluşan enerjidir. Elektrik akımı ile voltaj oluşarak elektrikli aygıtların çalışması bu şekilde sağlanmaktadır. Cisimler atom ve moleküllerden oluşan birimlerdir. Bir cismin parçalara ayrılması sonucunda o cisme özelliğini veren en küçük biriminin atom ve moleküllerden oluşması ortaya çıkar. Atomlarda ise, merkezinde bulunan çekirdek ve etrafında birçok elektron ile oluşmuştur. Bu atomların dışında bulunan elektronlar; manyetik alan, ısı ve kimyasal bir takım reaksiyonlar ile yörüngelerinden kopma yaşarlar ve serbest bir şekle bürünürler. Bu serbest olan elektronlar sayesinde oluşan enerjinin hareket etmesi elektriği ortaya çıkarmaktadır. Bu bir anlamda elektrik akımının voltajı oluştururken serbest elektronlardan yararlandığı anlamını ifade etmektedir. Elektrik Akımı: Serbest elektronların bir iletken kesitinin içerisinden geçmesidir. Bu iletken maddelerin içerisinde elektrik akması anlamına da gelir. Amper; elektrik akım birimi olarak adlandırılır. Elektrik akımının bir devreden akması için o devrenin kapalı devre olması gerekmektedir. Devrede açıklık olması durumunda serbest elektronlar geçemezler ve elektrik akımının oluşması da sağlanamaz. Bu devreler ise; açık devreler olarak adlandırılır."
                ],
                [
                    "title" => "Fizik",
                    "image" => "wep_resim/fizik.jpg",
                    "description" => "Fizik, madde ile enerji arasındaki etkileşimi inceleyen ve doğada gerçekleşen olaylarla ilgili mantıklı açıklamalar yapan uygulamalı bir bilim dalıdır. Fizik bilimi insanların doğada gerçekleşen olayları açıklama isteğinden doğdu. Bu duruma uygun bir başka tanımla; Fizik; doğayı anlama, doğal olayların neden ve sonuçlarının öğrenme ve bunları matematiksel metotlarla ifade etme işidir. Fizik bilimiyle uğraşan bilim insanlarına fizikçi denir. Fizikçi bilimsel metotlar kullanarak maddenin temel özeliklerini inceler. Bu incelemelerini yaparken fizik biliminin sorgulanabilir, denenebilir, yanlışlanabilir ve elde edilen verilere dayandırılabilir olduğunu bilir."
                ],
                [
                    "title" => "Yazılım",
                    "image" => "wep_resim/yazilim.jpg",
                    "description" => "Yazılım, çeşitli amaçlara hizmet eden programlar ve kodlar aracılığıyla bu işlevselliği sağlar. İşlem süreci genel olarak şöyle işler: Bir kullanıcı, kullandığı uygulama veya program aracılığıyla işletim sistemine komutlar gönderir. İşletim sistemi, bu komutları donanıma ileterek istenen sonuçların elde edilmesini sağlar. İşlenen bu komutlar sonucunda elde edilen veriler, işletim sistemi tarafından uygulama yazılımına aktarılır. Sonrasında kullanıcı, program içinde gerçekleştirdiği işlemlerin sonucunu görür. Bu süreçte kullanılan işletim sistemi ve uygulama yazılımı gibi terimler, yazılımın farklı türlerini temsil eder."
                ]
            ]
        ],
        [
            "title" => "Sağlık",
            "image" => "wep_resim/saglik.jpg",
            "books" => [
                [
                    "title" => "Anatomi",
                    "image" => "wep_resim/anatomi.jpg",
                    "description" => "Canlıların yapıları ve düzeni ile genel olarak ilgilenen bilim dalı olmaktadır. Hayvanlar ile ilgilenen hayvan anatomisi ve bitkiler ile ilgilenen bitki anatomisi olarak toplamda iki alt daldan oluşmaktadır. Temel tıp bilimlerinden biri olan insan anatomisi genel anlamda insanların vücudundaki organların tanımlanması, büyüklükleri, biçim gibi bazı özelliklerinin ortaya koyulması, birbirleri ile olan ilişkilerinin belirlenmesi ve hekimliğe uygulanması ile ilgili bilimsel uğraş alanıdır."
                ],
                [
                    "title" => "Hastalıklar",
                    "image" => "wep_resim/hastalik.jpg",
                    "description" => "Çeşitli hastalıkların tanı ve tedavi yöntemleri."
                ]
            ]
        ],
        [
            "title" => "Tarih",
            "image" => "wep_resim/tarih2.jpg",
            "books" => [
                [
                    "title" => "Osmanlı Tarihi",
                    "image" => "wep_resim/osmanli.jpg",
                    "description" => "Oğuzların Kayı boyundan gelen Osmanlılar, Ertuğrul Gazi vefat edinceye kadar Bizanlılar ile savaşarak Selçuklulara hizmet etti. Ertuğrul Gazinin ölümünün ardından aşiretin idaresini üstlenen Osman Bey, bağımsızlığını ilan ederek Osmanlı Beyliğini kurdu. "
                ],
                [
                    "title" => "1.Dünya Savaşı",
                    "image" => "wep_resim/savas.jpg",
                    "description" => "I. Dünya Savaşı, yirminci yüzyılın uluslararası ilk büyük savaşı olarak bilinir. 28 Haziran 1914 te Saraybosna da Avusturya Macaristan veliahtı Arşidük Franz Ferdinand ve eşi Arşidüşes Sophie ye düzenlenen suikast, Ağustos 1914 te başlayan ve dört yıl boyunca birçok cephede devam eden savaşın fitilini ateşlemiştir."
                ],
                [
                    "title" => "Eski Çağ Tarihi",
                    "image" => "wep_resim/ilkcag.jpg",
                    "description" => "İlk Çağ ya da Antik Çağ; MÖ. 3200 ile MS. 375 yılları arasını kapsamaktadır. Peki, tarihin en uzun çağı olarak kaynaklarda yerini alan İlk Çağ nasıl başladı? İlk Çağ; önemli bir antik çağ uygarlığı olan Sümerlerin, MÖ. 3200 yılında yazıyı icat etmeleri ile başlamıştır. İlk Çağ’ın sona ermesiyle ilgili olarak ise iki temel görüş bulunmaktadır. Bunlardan ilki MS.375 yılında gerçekleşen Kavimler Göçü’nü İlk Çağ’ın sonu olarak kabul ederken; ikincisi ise bu tarihi MS.476 yılında Batı Roma İmparatorluğu’nun yıkılışı olarak ifade etmektedir."
                ]
            ]
        ]
    ],
    "Roman" => [
        [
            "title" => "Polisiye",
            "image" => "wep_resim/polisiye.jpg",
            "books" => [
                [
                    "title" => "Sherlock Holmes",
                    "image" => "wep_resim/sherlock.jpg",
                    "description" => "Sherlock Holmes karakterinin yaratıcısı Sir Arthur Conan Doyle un 1902 yılında yayımlanan romanı Baskervillelerin Köpeği  ünlü dedektif ile yardımcısı Dr. Watsonın Dartmoor bölgesinde yaşayan Baskerville ailesine sataştığı iddia edilen bir canavarla mücadelesini anlatıyor."
                ],
                [
                    "title" => "Cinayet",
                    "image" => "wep_resim/cinayet.jpg",
                    "description" => "Kayıp Mektuptaki cinayet, bir dedektifin kaybolmuş bir mektubu bulmaya çalışırken yaşadığı maceraları konu alıyor."
                ]
            ]
        ],
        [
            "title" => "Şiir",
            "image" => "wep_resim/siir2.jpg",
            "books" => [
                [
                    "title" => "Henüz Vakit Varken Gülüm",
                    "image" => "wep_resim/nazim.jpg",
                    "description" => "Aşk ve Ceza, sevgi ile yasak arasındaki çatışmayı ele alan bir şiir kitabı."
                ],
                [
                    "title" => "Hasretinden Prangalar Eskittim",
                    "image" => "wep_resim/ahmet.jpg",
                    "description" => "Sevgi,özlem ve aşk temasını Ahmet Arif in kaleminden ele alınmış şiirler"
                ]
            ]
        ]
    ]
];


?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitaplar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
.user-info {
    background-color: rgba(0, 123, 255, 0.8); /* Mavi arka plan */
    color: white; /* Beyaz yazı rengi */
    padding: 10px; /* İçerik boşluğu */
    border-radius: 5px; /* Kenar yuvarlama */
    text-align: center; /* Ortalanmış metin */
    margin-bottom: 20px; /* Alt boşluk */
    font-size: 18px; /* Yazı boyutu */
}

        body {
            background-image: url('wep_resim/kutuphane.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.8); 
            border-radius: 10px;
            padding: 20px;
        }
        .row {
            display: flex;
            justify-content: space-between;
        }
        .column {
            flex: 48%; 
            padding: 20px;
        }
        .category {
            margin-bottom: 40px;
        }
        .category h2 {
            color: #343a40;
        }
        .sub-category {
            margin-bottom: 30px;
        }
        .sub-category img {
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
            border-radius: 10px;
        }
        .books {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .book {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            width: 120px;
            text-align: center;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .book img {
            width: 100%;
            height: 150px; 
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .book:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545; /* Kırmızı */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #c82333; /* Daha koyu kırmızı */
        }
    </style>
</head>
<body>
    
    <div class="container">
         <h1 class="my-5">Kitaplar</h1>
    <div class="user-info">
    <span>Hoş geldin, <?php echo $_SESSION['kullanici_adi']; ?></span>
</div>
    <button class="logout-btn" onclick="logout()">Çıkış Yap</button>
    <div class="row">
            <!-- Akademik Kategori -->
            <div class="column">
                <h2>Akademik</h2>
                <?php foreach ($books['Akademik'] as $subcategory): ?>
                    <div class="sub-category">
                        <h3><?php echo $subcategory['title']; ?></h3>
                        <img src="<?php echo $subcategory['image']; ?>" alt="<?php echo $subcategory['title']; ?>"> 
                        <div class="books">
                            <?php foreach ($subcategory['books'] as $book): ?>
                                <div class="book" data-toggle="tooltip" data-placement="top" title="<?php echo $book['description']; ?>" onclick="showModal('<?php echo $book['title']; ?>', '<?php echo $book['description']; ?>')"> 
                                    <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>">
                                    <p><?php echo $book['title']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Roman Kategori -->
            <div class="column">
                <h2>Roman</h2>
                <?php foreach ($books['Roman'] as $subcategory): ?>
                    <div class="sub-category">
                        <h3><?php echo $subcategory['title']; ?></h3>
                        <img src="<?php echo $subcategory['image']; ?>" alt="<?php echo $subcategory['title']; ?>"> 
                        <div class="books">
                            <?php foreach ($subcategory['books'] as $book): ?>
                                <div class="book" data-toggle="tooltip" data-placement="top" title="<?php echo $book['description']; ?>" onclick="showModal('<?php echo $book['title']; ?>', '<?php echo $book['description']; ?>')"> 
                                    <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>"> 
                                    <p><?php echo $book['title']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Kitap Özeti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 id="bookTitle"></h6>
                <p id="bookDescription"></p>
                <form method="POST" action="kitaplar.php">
                    <input type="hidden" name="kitap_isim" id="kitap_isim" value="">
                    <input type="hidden" name="kullanici_adi" value="<?php echo $username; ?>">
                    <button type="submit" class="btn btn-primary">Kitabı Al</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function showModal(title, description) {
    $('#bookTitle').text(title);
    $('#bookDescription').text(description);
    $('#kitap_isim').val(title); // Burada kitap ismini ayarlıyoruz
    $('#bookModal').modal('show');
}


        function logout() {
            <?php
            session_destroy();
            ?>
            window.location.href = 'sayfaTasarımı.php'; // Çıkış yapıldıktan sonra yönlendirme
        }
        
    </script>
</body>
</html>