@component('mail::message')
<h1 style="text-align: right;margin-top: 40px;"> أهلاً بك في كيشوبينا 💕</h1>
<br>
<html>
<p style="font-size: 16px;color: #718096; text-align: right">
   . نود إعلامك أنه مر ٣ أيام على طلبك بدون أي تأكيد من قبلك
</p>
<p style="font-size: 16px;color: #718096;text-align: right">
    . هذه هي فرصتك الأخيرة لتأكيد الطلب رقم ( {{$data['order_number']}} ) وإلا سيتم الإلغاء التلقائي بعد مرور ٧ أيام على عمل الطلب
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    . برجاء تفقد البريد الإلكتروني الذي تم إرساله مسبقاً لتأكيده في أسرع وقت ممكن
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
   : للمزيد من الاستفسارات، برجاء التواصل معنا على كيشوبينا بوت من خلال الرابط التالي
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    <a href=" https://kshopinaexpress.com/need_help">Kshopina  Bot</a>
</p>
<br>
<h1 style="text-align: left;">💞 Hello our lovely customer </h1>
<p style="color: #718096;text-align: left;font-size: 16px;">
    We would like to inform you that it has been 3 days since you placed your order without any confirmation yet.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    This is your last chance to confirm the order ( {{$data['order_number']}} ), otherwise it will be automatically canceled after 7 days of placing the order.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Hurry up and check the previous email to confirm your order ASAP!
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    For more inquiries, please contact us on "kshopina Bot" through the following link:
</p>
<p style="font-size: 16px;color: #718096; text-align: left">
    <a href=" https://kshopinaexpress.com/need_help">Kshopina  Bot</a>
</p>
<br>
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    ,Thanks<br>
    {{ config('app.name') }} Customer Service
</h1></html>

@endcomponent
