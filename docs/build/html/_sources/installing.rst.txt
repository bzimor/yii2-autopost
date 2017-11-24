*************************************
Kengaytmani mavjud loyihaga o'rnatish
*************************************

#. Kengaytmani o'rnatish uchun loyihaning ``composer.json`` fayli ``'require'`` bo'limiga ``"bzimor/yii2-autopost": "dev-master"`` qatorini qo'shing yoki quyidagi buyruqni ishga tushiring::


    composer require bzimor/yii2-autopost:dev-master


#. MySQL ma'lumotlar bazasiga kengaytmaning sozlamalarini va xabarlar tarixini saqlash uchun bazalarni o'rnating:

    * Migratsiya orqali::

	yii migrate --migrationPath=@bzimor/autopost/migrations --interactive=0

    .. note:: Agar migratsiya davomida xatolik bo'lsa:
       Agar MySQL baza hosti ``localhost`` ga sozlangan bo'lsa, ``127.0.0.1`` ga o'zgartirib, qayta urinib ko'ring.

    * PhpMyAdmin da ``autopost.sql`` faylini PhpMyAdmin da import qilish orqali.

Kengaytma hech qanday xatolarsiz, muvaffaqiyatli o'rnatilgan bo'lsa, ``http://<<Saytingiz-nomi>>/autopost`` manzili orqali kengaytma bosh sahifasiga kirishingiz mumkin.
