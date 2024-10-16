## Kurulum

Proje kendi GitHub hesabınıza fork edildikten sonra alttaki adımları takip ederek kurulum sağlayabilirsiniz. Ardından geliştirme isterleri başlığı altındakileri maddeler tamamlanıp commitlenmelidir. 

    - docker compose up

Oluşturulan container içerisinde;

    - /usr/bin/composer install
    - php artisan migrate
    - php artisan db:seed



## Geliştirme İsterleri

 
 - app/Http/Controllers/Api.php içerisinde /orders endpoint'i mevcut. Burada 2 işlem eklenecel;
   - order_no ile de liste çekilebilecek, order_no alanı gönderilmiyorsa tüm siparişler listelenmelidir.
   - OrderListResource classı içerisindeki dönüş değeri veritabanı tablo yapısı da dikkate alınarak sipariş, müşteri ve ürün listesi dönecek şekilde revize edilmelidir.
 - routes/api.php içerisinde bulunan ürün ile ilişkili 4 endpoint ProductController.php içerisinde, orders endpoint'i ile benzer yapıda olacak şekilde implement edilmelidir. Burada dikkat edilmesi gereken konular;
   - Ürün silinmişken güncellenmek istenilirse güncellemeye izin verilecek ancak response'da ürünün silinmiş olduğu bilgisi de dönülecek.
   - Ürün kayıt edilirken aynı isme sahip 2. ürün kayıt edilmeyecek. İsim kontrolünde büyük/küçük harf ve Türkçe karakterler de kontrol edilmelidir. Örnek: "Kaşık" ürünü kayıtlıysa "Kasık" / "kaşik" gibi ürün isimleri de kabul edilmeyecek.
   - Ürün bilgileri güncelleme ve kayıt esnasında karakter uzunlukları gibi kısıtlamalar kontrol edilmelidir.


## Veritabanı Sorgusu İsterleri

Altta belirtilen SQL'ler app/Libraries altında bir class içerisinde her biri ayrı fonksiyon olacak şekilde yazılmalıdır.

 - Her bir sipariş durumu için kaç adet ürün kullanıldığını getiren SQL. 
 - Şuanda stokta olmayan, en çok kullanılan (son 1 yıllık siparişler arasında) 5 ürünü (son 1 ay içerisinde de sipariş edilmiş olan) getiren SQL.  