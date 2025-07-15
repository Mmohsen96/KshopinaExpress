@component('mail::message')
    <h1 style="text-align: right;margin-top: 40px;">💕 أهلاً بك في كيشوبينا</h1>
    <br>
    <html><p style="font-size: 16px;color: #718096; text-align: right">
        شكراً لإنضمامك للطلب الجماعي الخاص ب كيشوبينا مصر.
    </p>
    <p style="font-size: 16px;color: #718096; text-align: right">
        برجاء إيجاد البيانات التالية لمتابعة الطلب رقم ({{ $data['order_id'] }}) 
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        ( {{ $data['group_id'] }} ) الرقم التعريفي للجروب الخاص ب محافظتك هو 
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        رقم ترتيبك ضمن الطلب الجماعي هو : {{ $data['customer_rank'] }}
    </p><hr>
    <p style="font-size: 16px;color: #718096;text-align: right">
        :👇 الرابط الخاص ل الطلب الجماعي وتتبع حالته عند إكتمال العدد
    </p>
    @component('mail::button', ['url' =>  $data['url'] ])
        GO
    @endcomponent
    <br>
    <h1 style="text-align: left;">💞 Welcome to Kshopina </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Thank you for joining Kshopina EG (Group-Order).
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Please find the following data to follow up on order number( {{ $data['order_id'] }})
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Your Group ID is ( {{ $data['group_id'] }} )
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Your Rank Number in this group order is : {{ $data['customer_rank'] }}
    </p><hr>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        The link of Tracking the status of your group order 👇:
    </p>
    @component('mail::button', ['url' => $data['url'] ])
        GO
    @endcomponent
    <h1 style="color: #718096;text-align: left;font-size: 16px;">
        Thanks,<br>
        {{ config('app.name') }} Customer Service
    </h1></html>


@endcomponent

