@component('mail::message')

<h1 style="text-align: right;margin-top: 40px;"> {{ucfirst($data['customer_name'])}} مرحباً </h1>
<br>

<html>
<p style="font-size: 16px;color: #718096; text-align: right">
 .نتمنى أن تكون بأفضل حال
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    .هذا فريق خدمة عملاء كيشوبينا، ونتواصل معك للحصول على معلومات أساسية من قبلك
</p>
<p style="font-size: 16px;color: #718096; text-align: right">
    .برجاء مساعدتنا للعمل على إنهاء الإجراءات اللازمة
</p>
<p style="font-size: 16px;color: #718096;text-align: right">
    👇🏻 قم بالضغط على الرابط التالي لمعرفة المزيد
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
<p style="font-size: 16px;color: #718096;text-align: right">
    💖  خدمة عملائنا دائماً في مساعدتك لتقديم ما هو أفضل 
</p> 
<p style="font-size: 16px;color: #718096;text-align: right">
    ,مع تحيات
</p> 
<p style="font-size: 16px;color: #718096;text-align: right">
    فريق خدمة عملاء كيشوبينا
</p> 
<br>
<h1 style="text-align: left;">Dear  {{ucfirst($data['customer_name'])}}, </h1>
<p style="color: #718096;text-align: left;font-size: 16px;">
    We hope you're doing great. 
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    This is Kshopina Customer Service team, and we are contacting you to get essential information from your side. 
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Kindly help us to make things right. 
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Please click the link below to know more 👇🏻
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
<p style="color: #718096;text-align: left;font-size: 16px;">
    Our Customer service is always here to assist you to have the best experience 💖
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Best wishes,
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Kshopina Customer Service team 
</p>
<br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    Thanks,<br>
    {{ config('app.name') }} Customer Service
</h1>

@endcomponent
