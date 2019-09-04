@component('mail::message')
#Hello Admin!

A new user registered to System. Please view and verify account.<br>
<table border="1">
    <tr>
        <td>Name</td>
        <td>{{ $providerData->name }}</td>      
    </tr>

    <tr>
        <td>Address</td>
        <td>{{ $providerData->address }}</td>
    </tr>

    <tr>
        <td>Phone</td>
        <td>{{ $providerData->phone }}</td>
    </tr>
    <tr>
        <td>Email Address</td>
        <td>{{ $providerData->email }}</td>
    </tr>
   
</table>
<br>
You can approve this service provider and update information from Admin dashboard's user management section.

Regards,<br>
Team {{ config('app.name') }}
@endcomponent