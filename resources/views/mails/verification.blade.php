@component('mail::message')
<h1>Your The Syringe Security Code</h1>
<p>Your Security Code is:</p>
<br>
<div style="padding:10px; background: grey;text-align: center;">
	<span style="color:black;text-align: center;font-size: 20px;">{{ $otp }}</span>
</div>
<br>
<p>To help us confirm your indetity on The Syringe, We need to verify your email address. Please Enter this code to complete your verification process.</p>
<br>
<p>If you did not request this code then please change your password</p>
<br>
<p>Thanks!!!</p>
<br>
<p>The Syringe Security Team</p>
@endcomponent
