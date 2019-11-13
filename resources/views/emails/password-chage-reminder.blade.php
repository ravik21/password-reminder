<p>
  Hello {{ $user->first_name }} {{ $user->last_name }},
</p>

<p>
    Your password for account {{ $user->email }} is older than 30 days, please change your password as soon as possible to prevent login problems.
</p>


<p>
  Thank you. <br />
</p>

<p>
  Regards <br />
  {{ env('APP_NAME') }} Team
</p>
