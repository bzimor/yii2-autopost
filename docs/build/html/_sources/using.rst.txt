************************
Kengaytmadan foydalanish 
************************

Kod ichida modul sifatida foydalanish
=====================================

Yii2-autopost kengaytmasi o'rnatilib, ijtimoiy tarmoq sozlamalari kiritilgach, kengaytmani o'z kodingiz ichida quyidagicha ishlatiladi:

* Xabarlarni yuborish::
	
	use Yii;
	...
	
	...
	$content = array();
	$apimanager = Yii::$app->getModule('autopost')->apimanager;
	
	$content['title'] = 'Xabar sarlavhasi'; //Ixtiyoriy
	$content['message'] = 'Xabar matni'; //Ixtiyoriy
	$content['link'] = 'Xabar linki'; //Ixtiyoriy
	
	//Agar matn rasm sifatida yuboriladigan bo'lsa:
	$content['photo_url'] = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png' //Rasmning to'liq url manzili
	
	/*
	* $share qiymati quyidagicha belgilanadi:
	* Telegram - 1, Facebook - 2, Twitter -4.
	* Agar xabar faqat Telegram ga yuborilsa $share = 1 bo'ladi, faqat Telegram va Twitter bo'lsa 1+4 = 5, $share = 5 bo'ladi, vhkz.
	* Agar $share ga qiymat berilmasa, o'z holicha 7 bo'lib, barcha tarmoqlarga yuboriladi.
	*/
	$share = 1; //1-7 gacha raqamlardan biri
	
	/*
	* $type 'text' yoki 'photo' qiymatini qabul qiladi. Ya'ni matnli va rasmli xabarlar uchun
	* Agar $type o'zgaruvchisi berilmasa, har bir tarmoq uchun sozlamadagi xabar turi tanlanadi.
	*/
	echo $apimanager->share($content, $share, $type); //natijani sahifada chop etish
	
* Yuborilgan xabarlar tarixini ko'rish va ularni o'chirish ``http://<<Saytingiz-nomi>>/autopost`` sahifasi orqali amalga oshiriladi.