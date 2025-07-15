@component('mail::message')

<h1 style="text-align: right;margin-top: 40px;"> أهلاً بك في كيشوبينا 💕</h1>
<br>

<html><p style="font-size: 16px;color: #718096; text-align: right">
     نود إعلامك بإننا قمنا بالرد علي استفسارك رقم ( {{$data['complain_number']}} ).
</p>
<p style="font-size: 16px;color: #718096;text-align: right">
برجاء زيارة هذا الرابط للاطلاع علي الرد
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
    <br>
    <h1 style="text-align: left;">💞 Welcome to Kshopina  </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
    We would like to inform you that we have answered your inquiry No ( {{$data['complain_number']}} )
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    Please visit this link to see the response
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
<br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    ,Thanks<br>
    {{ config('app.name') }} Customer Service
</h1>

@endcomponent
