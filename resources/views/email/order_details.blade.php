@component('mail::message')
    <html>
    <br>
    <br>
    <h1 style="text-align: cenetr;">Hello, {{$data['customer_name']}}! </h1>
    <p style="text-align: cenetr;font-size: 14px;">
        Here is the requested order summary
    </p>
    <br>
    <hr>
    <br>
    <h2 style="color:#3d4852;">Order Info</h2>
    <p style="text-align: left;font-size: 14px; font-weight:bold;color: #5388C0;">
        Order number  
    </p>
    <p style="text-align: left;font-size: 12px;">
        {{ $data['order_number'] }}
    </p>
    <br>
    <h3 style="color:#5388C0;">Order Details</h3>
    <div style="display: flex;margin-top: 1rem; width:100%;" >
        <p style="font-weight: 600;width: 80%;color: #5388C0;;text-align: left;font-size: 14px;">
            Item
        </p>
        <p style="font-weight: 600;width: 20%;color: #5388C0;;text-align: right;font-size: 14px;">
            QTY
        </p>
    </div>
    @foreach ($data['items'] as $item)
    <div style="display: flex;margin-top: 1rem; width:100%;" >
        <p style="font-weight: 600;width: 90%;color: #000;;text-align: left;font-size: 12px;">
            {{$item->product_name}}
        </p>
        <p style="font-weight: 600;width: 10%;color: #000;;text-align: right;font-size: 12px;">
            {{$item->quantity}} 
        </p>
    </div>
    @endforeach
    <br>
    <hr>
    <br>
    <h2 style="color:#3d4852;">Customer Data</h2>
    <p style="text-align: left;font-size: 14px; font-weight:bold;color: #5388C0;">
        Country  
    </p>
    <p style="text-align: left;font-size: 12px;">
        {{ $data['country'] }}
    </p>
    <br>
    <p style="text-align: left;font-size: 14px; font-weight:bold;color: #5388C0;">
        Area  
    </p>
    <p style="text-align: left;font-size: 12px;">
        {{ $data['city'] }}
    </p>
    <br>
    <p style="text-align: left;font-size: 14px; font-weight:bold;color: #5388C0;">
        Address/Property
    </p>
    <p style="text-align: left;font-size: 12px;">
        {{ $data['address'] }}
    </p>
    <br>
    <p style="text-align: left;font-size: 14px; font-weight:bold;color: #5388C0;">
        Phone Number
    </p>
    <p style="text-align: left;font-size: 12px;">
        {{ $data['phone_number'] }}
    </p>
    <br>
    <hr>
    <br>
    <h2 style="color:#3d4852;">Currency</h2>
    <p style="text-align: left;font-size: 14px; font-weight:bold;color: #5388C0;">
        Local Currency 
    </p>
    <p style="text-align: left;font-size: 12px;">
        {{ $data['currency'] }}
    </p>
    <br>
    <br>
    <h1 style="text-align: left;font-size: 16px;">
        Thanks for reaching,<br>Best Regards,<br>
        <img src="https://kshopinaexpress.com/public/uploads/Kshopina_CS_logo.png" class="logo" style="width: 14rem;height: auto;">
    </h1></html>
@endcomponent
