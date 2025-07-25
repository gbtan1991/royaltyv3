<div class="">
    <div class="space-y-1">
        <h1 class="text-4xl font-bold text-gray-700">Register an Account</h1>
        <p class="text-sm text-gray-500">Fill out the necessary information</p>
    </div>

    <form method="POST" action="{{ route('admin.register') }}" class="mt-3">
        @csrf

        <div class="space-y-1">

            <!-- Username -->
            <div>
                <label for="username" class="mb-1.5 block text-sm font-medium text-gray-700">Username<span
                        class="text-red-500">*</span></label>
                <input type="username" name="usernam" id="username" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10">
            </div>

            <!-- Full Name -->

            <div class="flex flex-row space-x-3">
                <div>
                    <label for="first_name" class="mb-1.5 block text-sm font-medium text-gray-700">First Name<span
                            class="text-red-500">*</span></label>
                    <input type="first_name" name="first_name" id="first_name" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10">
                </div>
                <div>
                    <label for="last_name" class="mb-1.5 block text-sm font-medium text-gray-700">Last Name<span
                            class="text-red-500">*</span></label>
                    <input type="last_name" name="last_name" id="last_name" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10">
                </div>
            </div>


            <!-- Email -->
            <div>
                <label for="username" class="mb-1.5 block text-sm font-medium text-gray-700">Username<span
                        class="text-red-500">*</span></label>
                <input type="username" name="usernam" id="username" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">Password<span
                        class="text-red-500">*</span></label>
                <input type="password" name="password" id="password" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-[#8058f3] shadow-theme-xs hover:bg-[#6e47ec]">
                    Login
                </button>


            </div>
        </div>
    </form>
    <div class="mt-4 text-sm text-gray-500">
        Need an account? Request an account <a href="{{ route('admin.register') }}"
            class="text-[#8058f3] hover:underline">here</a>.
    </div>
</div>
