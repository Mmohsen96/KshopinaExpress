@component('mail::message')
# Dear {{ $data['name'] }} ,

<div style="text-align: right;">
    <p style="    color: #718096 !important;    text-align: right;">
        لقد تم ابلاغنا بأنك قمت بإلغاء طلبيتك من كيشوبينا
        من أجل التحسين من مستوى خدماتنا، نود أن نعلم سبب الإلغاء من فضلك
        يرجى الاختيار من أسباب الإلغاء التالية 
    </p>
    
  <ul style="text-align: right; color: #718096 !important;">
    . تأخر مندوب التوصيل في توصيل طلبيتك-
    <br><br>
    . عدم توفر المال الكافي لدفع مبلغ الطلبية-
    <br><br>
    . السفر خارج البلاد وقت وصول الطلب-
    <br><br>
    . الطلب ليس خاص بك ( الشحن الخاطئ )-
    <br><br>
    . فشل عملية الدفع عند استخدام البطاقة الائتمانية-
    <br><br>
    . ظرف طارئ-
    <br><br>
    . أخرى ( يرجى التوضيح ) -
    <br>
   
  </ul>
    
</div>


{{-- @component('mail::button', ['url' => "kshopina.com"])
Reason
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }} Customer Service
@endcomponent