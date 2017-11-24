Telegram sozlamalari
--------------------

Telegram tarmog'ida kanalingizga kengaytma orqali xabar yuborilishini ta'minlash uchun, avvalo telegramda bot yaratib, yaratilgan botni **kanalingizga admin** sifatida qo'shishingiz lozim

Telegramda bot yangi bot yaratish
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Telegram da bot yaratish uchun quyidagilarni bajaring:

1. Telegram qidiruv joyiga ``@botfather`` deb yozib(1), izlash tugmasini bosing va birinchi chiqqan natijaga kirib ``start`` tugmasini bosing(2):

.. image:: tg-1.png

2. Buyruqlar ichidan ``/newbot`` buyrug'ini tanlang yoki  o'zingiz ``/newbot`` deb buyruq yuboring:

.. image:: tg-2.png

3. So'ngra, so'rovga asosan yaratilayotgan yangi **bot ismini** (1), botning **foydalanuv nomi** ni (2) kiriting, shundan so'ng sizga **Bot token** (3) taqdim qilinadi. Botning foydalanuv nomi takrorlanmagan hamda oxiri *"bot"* yoki *"_bot"* so'zi bilan tugashi kerak:

.. image:: tg-3.png


Kanal id sini aniqlash
^^^^^^^^^^^^^^^^^^^^^^

1. Kanal id si o'rniga ``@<<kanal_nomi>>`` ni ham ishlatish mumkin. Kanal nomi bu yerda kanal linkining oxirgi qismi: ``https:// t.me/ <<kanal_nomi>>``

.. image:: tg-4.png

Agar kanal ochiq bo'lmasa (private), u holda ``@getidsbot`` botini izlab toping, botga kirib ``/start`` ni bosing va kanalingizdagi biror xabarni **"forward"** qilib botga yuborsangiz, sizning kanalingiz id sini chiqarib beradi.

.. image:: tg-5.png


2. Yaratilgan botni kanalingizga admin sifatida qo'shing hamda olingan ma'lumotlarni kengaytma sozlamalariga kiriting.
