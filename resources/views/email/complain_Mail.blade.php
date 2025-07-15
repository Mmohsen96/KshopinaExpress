@component('mail::message')

<h1 style="text-align: right;margin-top: 40px;"> أهلاً بك في كيشوبينا 💕</h1>
<br>

<html><p style="font-size: 16px;color: #718096; text-align: right">
    نود إعلامك بإننا إستقبلنا الاستفسار الخاص بك .
</p>
<p style="font-size: 16px;color: #718096;text-align: right">
هذا رقم الاستفسار ( {{$data['complain_number']}} ) برجاء المتابعة معنا عبر هذا الرابط لحين الرد عليك.
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
<p style="font-size: 16px;color: #718096;text-align: right">
سوف يتم التواصل معك في أقرب وقت..
    </p> 
    <br>
    <h1 style="text-align: left;">💞 Welcome to Kshopina  </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
    We would like to inform you that we have received your inquiry about your order
</p>
<p style="color: #718096;text-align: left;font-size: 16px;">
    This is your inquiry number ( {{$data['complain_number']}} ) Please follow up with us via this link so that we can get back in touch with you
</p>
@component('mail::button', ['url' => $data['complain_url'] ])
        Click here
@endcomponent
<p style="color: #718096;text-align: left;font-size: 16px;">
    We will contact you as soon as possible
</p>
<br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<h1 style="color: #718096;text-align: left;font-size: 16px;">
    ,Thanks<br>
    {{ config('app.name') }} Customer Service
</h1>

@endcomponent
