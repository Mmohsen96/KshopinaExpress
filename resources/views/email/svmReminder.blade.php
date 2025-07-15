@component('mail::message')
<h1 style="text-align: right;margin-top: 40px;"> أهلاً بك في كيشوبينا 💕</h1>
<br>
<html>
<p style="font-size: 16px;color: #718096; text-align: right">
    نود إعلامك بأنه لم يتم تأكيد طلبك من فريقنا بسبب عدم إكتمال البيانات المطلوبة لشحن الطلب.
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    وقد يؤثر عدم ردك على حالة الطلب سواء بالتأخير أو الإلغاء.
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    لذا برجاء تفقد البريد الإلكتروني الذي تم إرساله مسبقاً لتعديل البيانات المطلوبة.
</p>
<p style="font-size: 16px;color: #718096;text-align: right">
    هذه هي فرصتك الأخيرة لتأكيد الطلب رقم ( {{$data['order_number']}} ) وإلا سيتم الإلغاء التلقائي بعد مرور ٧ أيام على عمل الطلب.
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    برجاء تعديل البيانات في أسرع وقت ممكن لشحن طلبك سريعاً.
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    للمزيد من الاستفسارات، برجاء التواصل معنا على كيشوبينا بوت من خلال الرابط التالي:
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    <a href=" https://kshopinaexpress.com/need_help">Kshopina  Bot</a>
</p>
<br>
<h1 style="text-align: left;">💞 Hello our lovely customer </h1>
<p style="color: #718096;text-align: left;font-size: 16px;">
    We would like to inform you that your order has not been confirmed by our team due to incomplete address information.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    So please check the previous email to edit the information that needs to be modified ASAP.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    This is your last chance to confirm the order ( {{$data['order_number']}} ), otherwise it will be automatically canceled after 7 days of placing the order.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Hurry up and correct your information, so you can receive the order ASAP!
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