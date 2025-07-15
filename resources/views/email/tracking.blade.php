@component('mail::message')

<h1 style="font-family: 'Bebas Neue', cursive;text-align: right;margin-top: 40px;"> عميل كيشوبينا العزيز 💕</h1>
<br>

<html><p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096; text-align: right">
    بخصوص طلبك رقم ( {{$data['order_number']}} ).
</p>
<p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096; text-align: right">
    تم تأكيد طلبك بنجاح و سنبدأ في إجراءات تحضير و إرسال طلبك.
</p>
<p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
: يمكنك تتبع حالة الطلب من خلال خدمتنا الجديدة عن طريق هذا الرابط.
</p>
@component('mail::button', ['url' => $data['tracking_url'] ])
        Click here
@endcomponent
<p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #de4d43;text-align: right">
    يرجى العلم بأنه في حالة إلغاء طلبك بعد الآن، قد يتم فرض غرامة على طلبك القادم.
    </p> 
    <br>
    <h1 style="text-align: left;">💞 Dear Kshopina Customer  </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Regarding your order number ( {{$data['order_number']}} ).
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Your order has been successfully confirmed, and the process of preparing and dispatching your order will start.
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    You can track your order status by our new service from the below link:
</p>
@component('mail::button', ['url' => $data['tracking_url'] ])
        Click here
@endcomponent
<p style="color: #de4d43;text-align: left;font-size: 16px;">
    Please notice that starting from now in case you canceled your order, you may be charged with a penalty on your next order.</p>
<br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    ,Thanks<br>
    {{ config('app.name') }} Customer Service
</h1>

@endcomponent
