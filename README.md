# World of Books

Telepítési információ:

A meglévő fájlszerkezetet a virtualhost gyökérkönyvtárába kell bemásolni (nálam ez így néz ki: "E://xampp/htdocs/World-of-Books").
Bemásolás után a következő fájlokat kel módosítani:

World-of-Books/application/config/config.php-ban a base_url-t átírni a helyesre
World-of-Books/application/config/database.php-ban a username, password és database értékeit módosítani a helyes csatlakozáshoz
(szükség esetén a .htaccess fájlban kell módosítani az elérési utat)

A model az első futásnál létrehozza a számára szükséges adattáblákat helyes beállítások esetén, majd a megkezdi a csv fájl adatainak a feltöltését a
"results" táblába. Ez nálam 6-7 percet vett igénybe. A belépő oldal utána frissülni fog, és a "test@mail.hu" e-mail címmel és az "1234" jelszóval lehet majd belépni.
