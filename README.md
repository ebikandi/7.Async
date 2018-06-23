# 7.Async
JavaScripten asinkronismoa lantzen duen 7. gaiko ariketa

## Ariketa
JavaScript programatutako RSS irakurle bat egin nahi dugu, RSS hauek datu-base batetik hartu eta gordetzen dituena.

RSS irakurle hau PHP orri batetan oinarritzen da, fitxategi hau baita RSS datu-basera konektatzeaz eta eta datuak eskuratzeaz arduratzen baita, egindako eskaeraren arabera. Honi buruzko informazio guztia *rss.php* fitxategian daukazu.

Irakurlearen egitura duen HTML orria osatua emango da. Honako hau eskatzen da:

- RSS-ak itzulitako HTML edukia array batetan gordeko da, beti memoriatik eskuragarria izateko. Aplikazioa kargatzean, datu-basean daude RSS guztien edukiaren pre-karga prozesu bat egingo da memorian.
- "*Gehitu RSS*" botoia sakatzean, RSS berriaren titulua eskatuko zaigu eta ondoren URL-a. Onartuz gero, **metodo klasikoz** programatutako Ajax eskaera bat egingo da rss.php fitxategira (ikusi parametroak fitxategiko komentarioetan). Behin eskaera amaitzean, RSS berriaren pre-karga egingo du memorian.
- RSS zerrendan aukera aldatzen dugun bakoitzean, orain aukeratuta dagoena ezkutzateko efektu difuminatu bat sortuko da, memoria atzituko du eta hautatu berri den RSS-aren HTML edukia erakutsiko du, difuminazioa kenduz. *<ATZERA* edo *AURRERA>* sakatzen den bakoitzean, dagokion RSS-ra aldatuko da, aipatutako RSS efektuak erabiliz.
- "*RSS kendu*" sakatzean, hautatutako RSS-a datu-basetik kendu eta zerrendako lehen RSS-ra itzuliko gara.
- Ajax eragiketa bat egiten ari den bakoitzean, *ajax.gif* spinner-a erakutsi *#spinner* div-ean.

Kodea funtzioetan banatzea baloratuko da. "RSS gehitu" funtzioa implementatzeko beharrezkoa da Ajax metodo klasikoa erabiltzea. Beste deientzako, efektuentzako, etab. jQuery liburutegia erabiltzeko aukera dago (ariketarekin eskeinia).

Ariketarako beharrezkoak diren fitxategiak, MySQL taula sortzen duena barne, emango zaizue. JavaScript kode dena *index.js* fitxategiaren barruan idatzi.

## Ebaluaziorako irizpideak (10 puntu)
- RSS-ak memorian gordetzea (1 p.).
- Aplikazioa abiaratzean RSS-ak memorian pre-kargatzea (2 p.).
- RSS-a datu-basera gehitzen da eta, gehitu ostean, honen pre-karga egiten da memorian (1,5 p.).
- RSS-tatik nabigatu daiteke atzera eta aurera-ko botoiak erabiliz (1,5 p.).
- Zerrendan beste RSS bat hautatzean, hau erakusten zaigu (0,5 p.).
- RSS-a aldatzean efektu difuminatua erabiltzen da (0,5 p.).
- Ezabatzeko botoia sakatzean, hautatuta dagoen RSS-a datu-basetik ezabatzen da eta zerrendako lehena erakusten zaigu (1 p.).
- Ajax dei bat egiten den bakoitzean *spinner*-a erakutsi eta ezkutatzen zaigu (1 p.).
- Kodearen txukuntasuna (funtzioetan banatuta, komentarioak, ...) (1 p.).
