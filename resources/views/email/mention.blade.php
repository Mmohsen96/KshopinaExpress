@component('mail::message')

<h1 style="text-align: left;margin-bottom: 25px;margin-top: 40px;"> Hello  {{ $data['mention']}}!</h1>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        You have been mentioned on a new announcement.
    </p>
    <p style="color: #718096;text-align: left;font-size: 16px;">
        <a href="http://www.kshopinaexpress.com/dashboard">Check</a> it soon before it's too late!
    </p>
    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td align="center">
                                        <img style="width: 50%;" src="www.kshopinaexpress.com/public/Mention.png" alt="you have been mentioned" >
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p style="color: #718096;text-align: left;font-size: 14px;">
        See you again with good news.
    </p>
    <p style="color: #718096;text-align: left;font-size: 14px;">
        Yours Truly,
    </p>
    <p style="color: #718096;text-align: left;font-size: 14px;">
        Kmex
    </p>

@endcomponent