@component('mail::message')
    <h1 style="text-align: right;margin-top: 40px;">💕 أهلاً بك في كيشوبينا</h1>
    <br>
    <html><p style="font-size: 16px;color: #718096; text-align: right">
        شكراً لإنضمامك للطلب الجماعي الخاص ب كيشوبينا مصر.
    </p>
    <p style="font-size: 16px;color: #718096; text-align: right">
        برجاء إيجاد الفاتورة الخاصة بالمنتجات التي قمت بطلبها.
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        ( {{ $data['order_number'] }} ) رقم الطلب هو
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        والمكون من
    </p><hr>
    @foreach ($data['items'] as $item)
    <div style="display: flex" >
        <p style="font-weight: 600;width: 50%;color: #c58f35;text-align: left;font-size: 16px;">
        {{$item->product_name}}
    </p>
    <p style="font-weight: 600;width: 40%;color: #c58f35;text-align: left;font-size: 16px;">
        {{$data['arabic_currency']}}&nbsp;{{$item->product_price}}
    </p>
    <p style="font-weight: 600;width: 10%;color: #c58f35;text-align: right;font-size: 15px;">
        {{$item->product_qty}} QTY
    </p></div>
    @endforeach
    <hr>
    <p style="font-size: 16px;color: #718096;text-align: right">
        قيمة الطلب هي <span style="font-weight: 600; margin-right:5px;">{{$data['final_price']}}&nbsp;{{$data['arabic_currency']}}</span>
    </p><br>
    <p style="font-size: 16px;color: #718096;text-align: right">
        السعر نهائي شامل سعر المنتج & التوصيل المحلي.
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        :👇 من فضلك قم بالضغط على هذا الزر لإنهاء إجراءات تأكيد الطلب
    </p>
    @component('mail::button', ['url' =>  $data['confirm_url'] ])
        تأكيد الطلب
    @endcomponent
    <p style="font-size: 16px;color: #718096;text-align: right">
        :👇 في حالة العدول عن رأيك، يمكنك الضغط علي ( إلغاء) 
    </p>
    @component('mail::button', ['url' => $data['cancel_url'],'color' => 'error'])
        الغاء الطلب
    @endcomponent
    <p style="font-size: 16px;color: #de4d43;text-align: right">
        *في حالة عدم تأكيد الفاتورة خلال ٣ أيام ستُعتبر الفاتورة غير موجودة*
    </p><br>
    <h1 style="text-align: left;">💞 Welcome to Kshopina </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Thank you for joining Kshopina EG (Group-Order).
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        This is an invoice for your selected products.
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        The Order number is ( {{ $data['order_number'] }} )
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        It consists of:
    </p><hr>
    @foreach ($data['items'] as $item)
    <div style="display: flex" >
        <p style="font-weight: 600;width: 50%;color: #c58f35;text-align: left;font-size: 16px;">
        {{$item->product_name}}
    </p>
    <p style="font-weight: 600;width: 40%;color: #c58f35;text-align: left;font-size: 16px;">
        {{$item->product_price}}&nbsp;{{$data['currency']}}
    </p>
    <p style="font-weight: 600;width: 10%;color: #c58f35;text-align: right;font-size: 15px;">
        {{$item->product_qty}} QTY
    </p></div>
    @endforeach
    <hr>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        The order cost is <span style="font-weight: 600; margin-left:5px;">{{ $data['final_price']}}&nbsp;{{$data['currency']}}</span>
    </p><br>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        This price is final, including product price & domestic shipping fee
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Please click on this button to complete the order confirmation procedure👇:
    </p>
    @component('mail::button', ['url' => $data['confirm_url'] ])
        Confirm Order
    @endcomponent
    <p style="color: #718096;text-align: left;font-size: 16px;">
        In case you want to cancel the order, please click on this button 👇:
    </p>
    @component('mail::button', ['url' => $data['cancel_url'],'color' => 'error'])
        Cancel Order
    @endcomponent
    <p style="color: #de4d43;text-align: left;font-size: 16px;">
        In case there is no response during 3 days, the invoice will be invalid.
    </p>
    <h1 style="color: #718096;text-align: left;font-size: 16px;">
        Thanks,<br>
        {{ config('app.name') }} Customer Service
    </h1></html>


@endcomponent

