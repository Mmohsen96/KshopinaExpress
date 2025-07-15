@component('mail::message')

<h1 style="text-align: right;direction: rtl;margin-top: 40px;"> مرحباً عميلنا العزيز 💕</h1>
<br>
<html><p style="font-size: 16px;color: #718096; text-align: right;direction: rtl;">
    برجاء تقييم مدى رضاك ​​عن ردنا على استفسارك السابق.
</p>
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;margin-bottom: 35px;">
    لن يستغرق التقييم منك دقيقة 😉
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        اضغط هنا
@endcomponent
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;margin-bottom: 35px;">
    نود معرفة رأيك لمساعدتنا في تحسين خدماتنا بأسرع ما يمكن!
</p>
<p style="font-size: 16px;color: #718096;text-align: right;direction: rtl;margin-bottom: 35px;">
    نتمنى لك يوم سعيد😊
</p>
<br>
<h1 style="text-align: left;margin-bottom: 25px;">Hello our lovely customer 💗</h1>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Please rate how satisfied you are with our response to your previous inquiry.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;margin-bottom: 35px;">
    ( It won't take a minute 😉 )</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
<p style="color: #718096;text-align: left;font-size: 16px;margin-bottom: 35px;">
    We would love to know your opinion to improve our service as soon as we can!</p>
<p style="color: #718096;text-align: left;font-size: 16px;margin-bottom: 35px;">
    Have a nice day.😊</p>
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    ,Thanks<br>
    {{ config('app.name') }} Customer Service
</h1>

@endcomponent
