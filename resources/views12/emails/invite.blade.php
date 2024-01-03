
<p>{{ucwords(Auth::user()['name'])}} {{(Auth::user()['last_name']) ? ucwords(Auth::user()['last_name']) : ''}} invited you to join Meraki RCM Solutions, LLC II's DaisyBill account.

Click the 'Accept Invitation' button below to join Meraki RCM Solutions, LLC II's DaisyBill account.

You will be prompted to provide your first and last name and create a password for the account.</p>
 
<a class="" href="{{ route('userRegistration', $invite->token) }}">Accept Invitation</a> to activate!

