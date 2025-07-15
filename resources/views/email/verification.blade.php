@component('mail::message')
    <h1 style="font-family: 'Bebas Neue', cursive;text-align: right;margin-top: 40px;">💕 أهلاً بك في كيشوبينا</h1>
    <br>
    <html><p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096; text-align: right">
        .نود أعلامك بإننا إستلمنا طلبك بنجاح
    </p>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
        ( {{ $data['order_number'] }} ) رقم الطلب هو
    </p>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
        والمكون من
    </p><hr>
    @foreach ($data['items'] as $item)
    <div style="display: flex" >
        <p style="font-weight: 600;width: 90%;color: #c58f35;text-align: left;font-size: 16px;">
        {{$item->product_name}}
    </p>
    <p style="font-weight: 600;width: 10%;color: #c58f35;text-align: right;font-size: 15px;">
        {{$item->quantity}} QTY
    </p></div>
    @endforeach
    <hr>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
        قيمة الطلب هي <span style="font-weight: 600; margin-right:5px;">{{$data['price']}}&nbsp;{{$data['arabic_currency']}}</span>
    </p><br>
    <p style="direction: rtl;font-weight: 900;font-family: 'Bebas Neue', cursive;font-size: 18px;color: #718096;text-align: right">
        بيانات العميل :
    </p><br>
    <div style="margin-right: 5%;"><p style="direction: rtl;font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right;line-height: 1.2rem;">
        البلد : <span style="direction: rtl;font-weight: 600; margin-left:5px;">{{ $data['country']}}</span>
    </p>
    <p style="direction: rtl;font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right;line-height: 1.2rem;">
        المنطقة : <span style="direction: rtl;font-weight: 600; margin-left:5px;">{{ $data['city']}}</span>
    </p>
    <p style="direction: rtl;font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right;line-height: 1.2rem;">
        العنوان/العقار : <span style="direction: rtl;font-weight: 600; margin-left:5px;">{{ $data['address']}}</span>
    </p>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right;line-height: 1.2rem;">
        <span style="display: inline-block;font-weight: 600; margin-left:5px;">{{ $data['phone_number']}}</span> : رقم الهاتف
    </p></div><hr><br>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
        هذه هي الخطوة الأخيرة لتأكيد طلبك
    </p>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right;font-weight: 900;">
         في حال تأكيد الطلب من خلال فريقنا سيتم إرسال بريد إلكتروني آخر به رقم لتتبع حالة الطلب
    </p>
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
        :👇 من فضلك قم بالضغط على هذا الزر لإنهاء إجراءات تأكيد الطلب
    </p>
    @component('mail::button', ['url' =>  $data['confirm_url'] ])
        تأكيد الطلب
    @endcomponent
    <p style="font-family: 'Bebas Neue', cursive;font-size: 16px;color: #718096;text-align: right">
        :👇 وإذا كنت تريد إلغاء الطلب، برجاء قم بالضغط على هذا الزر
    </p>
    @component('mail::button', ['url' => $data['cancel_url'],'color' => 'error'])
        الغاء الطلب
    @endcomponent <br>
    <h1 style="text-align: left;">💞 Welcome to Kshopina </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        We would like to inform you that we have received your order successfully .
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        The Order number is ( {{ $data['order_number'] }} )
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        It consists of:
    </p><hr>
    @foreach ($data['items'] as $item)
    <div style="display: flex" >
        <p style="font-weight: 600;width: 90%;color: #c58f35;text-align: left;font-size: 16px;">
        {{$item->product_name}}
    </p>
    <p style="font-weight: 600;width: 10%;color: #c58f35;text-align: right;font-size: 15px;">
        {{$item->quantity}} QTY
    </p></div>
    @endforeach
    <hr>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        The order cost is <span style="font-weight: 600; margin-left:5px;">{{ $data['price']}}&nbsp;{{$data['currency']}}</span>
    </p><br>
    <p style="font-weight: 700;color: #718096;text-align: left;font-size: 18px;">
        Customer information:
    </p><br>
    <div style="margin-left: 5%;"><p style="color: #718096;text-align: left;font-size: 16px;line-height: 1.2rem;">
        Country : <span style="font-weight: 600; margin-left:5px;">{{ $data['country']}}</span>
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;line-height: 1.2rem;">
        City : <span style="font-weight: 600; margin-left:5px;">{{ $data['city']}}</span>
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;line-height: 1.2rem;">
        Address : <span style="font-weight: 600; margin-left:5px;">{{ $data['address']}}</span>
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;line-height: 1.2rem;">
        Phone number : <span style="font-weight: 600; margin-left:5px;">{{ $data['phone_number']}}</span>
    </p></div><hr><br>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        This is the last step to confirm your order.
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;font-weight: 900;">
        After the confirmation of the order from our team, we will send you another email to track your order.
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
    <p style="color: #718096;text-align: left;font-size: 16px;">
        We are looking forward to having you soon! 💞
    </p>
    <h1 style="color: #718096;text-align: left;font-size: 16px;">
        Thanks,<br>
        {{ config('app.name') }} Customer Service
    </h1></html>


@endcomponent
