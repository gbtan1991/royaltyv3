
<div class="flex flex-col flex-1 w-full lg:w-1/2">'

    <div class="flex flex-col justify-center items-center h-full">
        <div class="text-center">
            <h1 class="text-2xl font-bold">Registration Successful</h1>
            <p class="mt-4 text-gray-600">
                Your admin account with username <strong>{{ $username }}</strong> is created successfully. 
            </p>
            <p class="mt-4 text-gray-600">
                Please wait for the Super Admins to approve your account
            </p>
            <div class="flex flex-row justify-around">
            <a href="{{ route('admin.login') }}" class="text-brand-500 hover:underline mt-6 inline-block">
                Go to Login
            </a>
            <a href="{{ route('welcome') }}" class="text-brand-500 hover:underline mt-6 inline-block">
                Go to Introduction
            </a>
            
            </div>
        </div>
    </div>

</div>



