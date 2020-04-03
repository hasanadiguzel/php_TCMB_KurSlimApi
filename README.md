# php_TCMB_KurSlimApi
 PHP Slim Framework ile geliştirilen bu API ile TCMB' dan güncel kur bilgileri çekilebilmektedir. Geliştirilen API' nin mobil geliştiriciler tarafından sorunsuz bir şekilde kullanılabilmesi için gerekli header tanımlamaları yapılmıştır.

slimapp klasörü sunucuya yüklendikten sonra aşağıdaki yönelendirme ile güncel kur bilgilerine erişim sağlanılabilir.

Örnek Yönlendirme;

https://localhost:8080/slimapp/api/kurgetir

----------------------------------------------------------------------------------------------------------
Güncel kur bilgilerinin çekildiği adres;

https://www.tcmb.gov.tr/kurlar/today.xml

----------------------------------------------------------------------------------------------------------
Kur arşivi -> tarihe göre kur bilgisi çekme;
https://www.tcmb.gov.tr/kurlar/yyyyMM/ddMMyyyy.xml
