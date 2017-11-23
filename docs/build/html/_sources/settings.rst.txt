*******************
Kengaytmani sozlash
*******************

Xabarlarni ijtimoiy tarmoqdagi kanal va sahifalarga yuborish uchun avval sozlash menyusi orqali kirib, so'ralayotgan API ma'lumotlarni to'ldirishingiz kerak.

Ijtimoiy tarmoq API ma'lumotlarini olish va sozlash
===================================================

Telegram
--------

Telegram tarmog'ida kanalingizga kengaytma orqali xabar yuborilishini ta'minlash uchun, avvalo telegramda bot yaratib, yaratilgan botni kanalingizga admin sifatida qo'shishingiz lozim

Telegramda bot yangi bot yaratish
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Telegram da bot yaratish uchun quyidagilarni bajaring:

#. Telegram qidiruv joyiga ``@botfather`` deb yozib(1), izlash tugmasini bosing va birinchi chiqqan natijaga kirib ``start`` tugmasini bosing(2):

.. image:: Telegram_bot_1.png

#. Buyruqlar ichidan ``/newbot`` buyrug'ini tanlang yoki  o'zingiz ``/newbot`` deb buyruq yuboring:

.. image:: Telegram_bot_2.png

#. So'ngra, so'rovga asosan yaratilayotgan yangi bot ismini (1), botning foydalanuv nomini (2) kiriting, shundan so'ng sizga Bot token (3) taqdim qilinadi. Botning foydalanuv nomi takrorlanmagan hamda oxiri "bot" yoki "_bot" so'zi bilan tugashi kerak:

.. image:: Telegram_bot_3.png


Kanal id sini aniqlash
^^^^^^^^^^^^^^^^^^^^^^

#. Kanal id si o'rniga ``@<<kanal_nomi>>`` ni ham ishlatish mumkin. Kanal nomi bu yerda kanal linkining oxirgi qismi: ``https:// t.me/ <<kanal_nomi>>``

.. image:: Telegram_bot_4.png

Agar kanal ochiq bo'lmasa (private), u holda @getidsbot botini izlab toping, botga kirib ``/start`` ni bosing va kanalingizdagi biror xabarni "forward" qilib botga yuborsangiz, sizning kanalingiz id sini chiqarib beradi.

.. image:: Telegram_bot_5.png


Yaratilgan botni kanalingizga admin sifatida qo'shing hamda olingan ma'lumotlarni kengaytma sozlamalariga kiriting.


Facebook
--------

Facebook ijtimoiy tarmog'idagi sahifangizga kengaytma orqali xabar yuborilishini ta'minlash uchun quyidagilarni bajaring.

Facebook da dastur yaratuvchi akkountini faollashtirish
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Facebook sahifasiga xabar chop etishda foydalaniladigan dastur yaratish uchun dastur yaratuvchi akkountini faollashtirishingiz kerak bo'ladi. Buning uchun quyidagi manzilga kiring va rasmda belgilangan tugmani bosing:

https://developers.facebook.com/docs/pages/getting-started#developer-account

.. image:: fb-1.png

.. image:: fb-2.png

Dastur nomini va pochta manzilingizni kiriting:

.. image:: fb-3.png

Dastur yaratilgandan so'ng quyidagi manzilga kirib, qizil bilan belgilangan joyni bosib, ro'yxatdan dasturingizni tanlang:

.. image:: fb-4.png

Rasmda ko'rsatilgan **Получит маркер** tugmasini bosib, eng quyidan **Получит маркер доступа к Странице** ni tanlang:

.. image:: fb-5.png

Kichik bir oyna ochilgandan so'ng, davom etish, so'ngra ok tugmasini bosing:

.. image:: fb-6.png

So'ng yana **Получит маркер** tugmasini bosib, eng quyidan dasturingizni tanlaysiz:

.. image:: fb-7.png

Yana o'sha menyudan rasmda belgilanga tugmani bosing hamda kichik oynadan ok ni tanlang:

.. image:: fb-8.png

Belgilangan joydan tokenni ko'chirib oling

.. image:: fb-9.png

Ko'chirib olingan tokenni hamda dastur ID sini quyidagi linkga qo'yib, o'sha linkni brauzerda oching::

    https://graph.facebook.com/oauth/access_token?client_id=**<<Dasturingiz ID si>>**&client_secret=<your FB App secret>&grant_type=fb_exchange_token&fb_exchange_token=**<<ko'chirib olingan access token>>**

Dasturingiz ID sini esa quyida keltirilgan joydan olishingiz mumkin:

.. image:: fb-10.png
