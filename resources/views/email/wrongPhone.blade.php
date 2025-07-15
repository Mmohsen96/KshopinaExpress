@component('mail::message')
# Dear {{$data['name']}} ,
<html><p style="text-align: right">
    تم التواصل معك من قبل شركة التوصيل لتوصيل طلبيتك و لم تستطيع الوصول إليك.
يرجى إرسال بيانات التواصل معك لإعادة تحديد موعد لتوصيل طلبيتك.
    </p> </html>


The courier company tried to deliver your order from Kshopina, but unfortunately they couldn’t reach you.
Kindly send us your contact information (alternative number).

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
Thank you.<br>
{{ config('app.name') }} Customer Service
<br>

@endcomponent
