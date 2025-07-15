@component('mail::message')
    <h1 style="text-align: right;margin-top: 40px;">💕 مرحباً عزيزنا العميل</h1>
    <br>
    <html>
    <p style="font-size: 16px;color: #718096; text-align: right">
        .لقد قمنا باستلام طلبك رقم <span style="font-weight: 700;">( {{ $data['order_number'] }} )</span> ونظراً لعدم صحة بياناتك لم يتم تأكيد الطلب بعد
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        لذا برجاء قراءة التعليمات التالية بعناية لضمان إدخال معلومات مطابقة لسياسة المتجر لاتمام عملية الشراء وبدأ تحضيره
        للشحن السريع
    </p>
    <p style="font-size: 16px;color: #718096;text-align: right">
        :يرجى اعادة ادخال بياناتك بشكل صحيح لاكمال عملية تأكيد الطلب
    </p>
    <ol type="1" style="direction: rtl;font-weight: 600;width: 100%;color: #000000;text-align: right;font-size: 16px;">
    @foreach ($data['problems'] as $key => $problem)
        <li style="font-weight: 600;width: 100%;text-align: right;font-size: 15px;">
            <p style="margin-bottom: 10px;text-align: right;color: #de4d43;">{{$key}}</p> 
            <ul style="margin-bottom: 20px;">
                <li style="text-align: right;font-size: 14px;color: #de4d43;">{{$problem}}</li>
            </ul>
        </li>
    @endforeach
    </ol>
    <hr>
    <p style="margin-top: 20px;font-size: 16px;color: #718096;text-align: right">
        👇 يمكنك الضغط علي هذا الزر لتعديل بياناتك
    </p>
    @component('mail::button', ['url' => $data['url']])
        تعديل البيانات
    @endcomponent <br>
    <p style="font-size: 16px;color: #718096;text-align: right">
        .شكراً لاختيارك كيشوبينا
    </p><hr>
    <h1 style="text-align: left;">Hello dear customer 💞 </h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        We have received your order <span style="font-weight: 700;">( {{ $data['order_number'] }} )</span>, and due to the incorrectness of your data, the order has not been confirmed yet.
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        So please read the following instructions carefully to ensure that you enter information that matches kshopina's policy to complete your purchase in order to be delivered as soon as possible.
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Please re-enter your data correctly to complete the order confirmation process as below:
    </p><hr>
    <ol type="1" style="direction: ltr;font-weight: 600;width: 100%;color: #000000;text-align: right;font-size: 16px;">
        @foreach ($data['problems_eng'] as $key => $problem)
            <li style="font-weight: 600;width: 100%;text-align: left;font-size: 15px;">
                <p style="margin-bottom: 10px;text-align: left;color: #de4d43;">{{$key}}</p> 
                <ul style="margin-bottom: 20px;">
                    <li style="text-align: left;font-size: 14px;color: #de4d43;">{{$problem}}</li>
                </ul>
            </li>
        @endforeach
    </ol>
    <hr>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        You can click on the following link to modify your information now 👇:
    </p><br>
    @component('mail::button', ['url' =>  $data['url']])
        Edit info
    @endcomponent
    <p style="color: #718096;text-align: left;font-size: 16px;">
        Thank you for choosing kshopina. 💞
    </p>
    <h1 style="color: #718096;text-align: left;font-size: 16px;">
        Thanks,<br>
        {{ config('app.name') }} Customer Service
    </h1></html>
@endcomponent
