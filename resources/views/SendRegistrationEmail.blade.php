@component('mail::message')
# Registraton

The Details Of Register User.

@component('mail::table')
| Name       | Customer Code         | Password  |
| ------------- |:-------------:| --------:|
| {{ $user['name'] }}      | {{ $user['customer_code'] }}      | {{ $user['pass'] }}      | 
@endcomponent

@component('mail::button', ['url' => 'https://crm.vprotectindia.com/'])
Click Here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
