@component('mail::message')
<h2>Hello Admin,</h2>

You received an email from : {{ $contactData->name }}
Here are the details:
<b>Name:</b> {{ $contactData->name }}
<b>Email:</b> {{ $contactData->email_address }}
<b>Phone Number:</b> {{ $contactData->phone_number }}
<b>Subject:</b> {{ $contactData->subject }}
<b>Message:</b> {{ $contactData->user_message }}
Thank You

Regards,<br>
Team {{ config('app.name') }}
@endcomponent