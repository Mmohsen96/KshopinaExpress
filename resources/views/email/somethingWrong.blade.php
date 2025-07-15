@component('mail::message')

<h1 style="text-align: right;direction: rtl;margin-top: 40px;"> مرحبا عزيزي العميل،💕</h1>
<br>

<html><p style="font-size: 16px;color: #718096; text-align: right;direction: rtl;">
    لقد تلقينا استفسارك عن الطلب رقم ( {{$data['order_number']}} )
</p>
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;margin-bottom: 35px;">
    وسنبذل قصارى جهدنا لحل مشكلتك في أقرب وقت ممكن.
</p>
<p style="font-size: 16px;color: #000000;text-align: right;direction: rtl;font-weight: 700;">
    يرجى التأكد من القيام بما يلي (إلزامي):
</p>
<ol type="1" style="direction: rtl;font-weight: 600;width: 100%;color: #718096;text-align: right;font-size: 16px;">
    <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;direction: rtl;">
        <p style="margin-bottom: 10px;text-align: right;direction: rtl;color: #718096;">إرفاق فيديو لفتح الطلبية (يجب أن يكون الفيديو واضحًا)</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;direction: rtl;">
        <p style="margin-bottom: 10px;text-align: right;color: #718096;direction: rtl;">إرفاق صورة واضحة عن الطلب بالكامل (تظهر فاتورة الطلب)</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;direction: rtl;">
        <p style="margin-bottom: 10px;text-align: right;color: #718096;direction: rtl;">اشرح ما هي المشكلة بشكل واضح وجيد.</p> 
    </li>
</ol>
<p style="font-size: 16px;color: #000000;text-align: right;direction: rtl;font-weight: 700;">
    أشياء يجب تجنبها:
</p>
<ol type="1" style="direction: rtl;font-weight: 600;width: 100%;color: #718096;text-align: right;font-size: 16px;margin-bottom: 35px;">
    <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;direction: rtl;">
        <p style="margin-bottom: 10px;text-align: right;direction: rtl;color: #718096;">إرسال صور أو فيديو غير واضح / معدّل </p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;direction: rtl;">
        <p style="margin-bottom: 10px;text-align: right;color: #718096;direction: rtl;"> شرح الموضوع بطريقة سيئة</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;direction: rtl;">
        <p style="margin-bottom: 10px;text-align: right;color: #718096;direction: rtl;"> عدم إتباع الخطوات بشكل صحيح</p> 
    </li>
</ol>
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;">
    برجاء الدخول الى هذا الرابط لإتباع الخطوات الموضحة
</p>
@component('mail::button', ['url' => $data['form_url'] ])
        Click here
@endcomponent
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;">
    سيتواصل معك أحد من فريق خدمة العملاء لدينا قريبًا لمتابعة حالة الشكوى، لذا برجاء تفقد البريد الإلكتروني بإنتظام لأي تحديثات 
</p>
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;">
    شكرا لك على تفهمك
</p>
<br>
<h1 style="text-align: left;margin-bottom: 25px;">💞 Hello dear customer,</h1>
<p style="color: #718096;text-align: left;font-size: 16px;">
    We received your inquiry about order no: ( {{$data['order_number']}} )
</p>
<p style="color: #718096;text-align: left;font-size: 16px;margin-bottom: 35px;">
    We will do our best to solve your issue as soon as possible.
</p>
<p style="color: #000000;text-align: left;font-size: 16px;font-weight: 700;">
    Please make sure to do the following (Mandatory):
</p>
<ol type="1" style="direction: ltr;font-weight: 600;width: 100%;color: #718096;text-align: right;font-size: 16px;">
    <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
        <p style="margin-bottom: 10px;text-align: left;color: #718096;">Attach an unboxing video of receiving the order (the video must be clear)</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
        <p style="margin-bottom: 10px;text-align: left;color: #718096;">Attach a clear picture of the whole order (showing the invoice of the package)</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
        <p style="margin-bottom: 10px;text-align: left;color: #718096;">Explain what the issue is in a clear and good manner.</p> 
    </li>
</ol>
<p style="color: #000000;text-align: left;font-size: 16px;font-weight: 700;">
    Things to avoid:
</p>
<ol type="1" style="direction: ltr;font-weight: 600;width: 100%;color: #718096;text-align: right;font-size: 16px;margin-bottom: 35px;">
    <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
        <p style="margin-bottom: 10px;text-align: left;color: #718096;">Sending an unclear/edited pictures or video</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
        <p style="margin-bottom: 10px;text-align: left;color: #718096;">Explaining the issue in a bad manner</p> 
    </li>
    <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
        <p style="margin-bottom: 10px;text-align: left;color: #718096;">Not following the steps correctly</p> 
    </li>
</ol>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Please click on this link to follow the mentioned steps:
</p>
@component('mail::button', ['url' => $data['form_url'] ])
        Click here
@endcomponent
<p style="color: #718096;text-align: left;font-size: 16px;">
    One of our CS agents will contact you soon to follow up with your case, so please check your inbox regularly to know the updates.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Thank you for understanding.
</p>
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    ,Thanks<br>
    {{ config('app.name') }} Customer Service
</h1>

@endcomponent
