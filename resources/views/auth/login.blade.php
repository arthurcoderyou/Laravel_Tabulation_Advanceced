<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" >
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" style="color: #fff;"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->

        
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" style="color: #fff;"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            oninput="checkPasswordStrength(this.value)"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
            <div class="text-sm text-white space-y-1 p-1 "  id="password-strength-feedback"><small>Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and be at least 8 characters long.</small></div>
            <x-input-error  :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="text-start">
            @if (Route::has('password.request'))
                <a class=" text-sm text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:text-white" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

           
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-indigo-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="text-center">
            

            <x-primary-button  style="color: #fff; border:1px solid white; width:80px; border-radius: 10px; padding:5px 0; " >
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        
        <div class="text-center">
            @if (Route::has('register'))
                <a class=" text-sm text-blue-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    Dont have an account? {{ __('Register') }}
                </a>
            @endif
        </div>
        
    </form>

    
<script>
    function checkPasswordStrength(password) {
        var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        var strength = 0;

        // Check if password matches the required pattern
        /*
        if (!pattern.test(password)) {
            document.getElementById('password-strength-feedback').textContent = 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and be at least 8 characters long.';
            return;
        }*/

        // Check if password contains uppercase letters
        if (/[A-Z]/.test(password)) {
            strength++;
        }

        // Check if password contains lowercase letters
        if (/[a-z]/.test(password)) {
            strength++;
        }

        // Check if password contains numbers
        if (/[0-9]/.test(password)) {
            strength++;
        }

        // Check if password contains special characters
        if (/[^A-Za-z0-9]/.test(password)) {
            strength++;
        }

        // Update the feedback element based on the password strength
        var feedbackElement = document.getElementById('password-strength-feedback');

        if (strength === 0) {
            feedbackElement.innerHTML = `<small>Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and be at least 8 characters long.</small>`;
            feedbackElement.style.color = 'white';
        } else if (strength <= 2) {
            feedbackElement.textContent = 'Weak';
            feedbackElement.style.color = '#d44a56';
        } else if (strength === 3) {
            feedbackElement.textContent = 'Moderate';
            feedbackElement.style.color = 'orange';
        }else {
            feedbackElement.textContent = 'Strong';
            feedbackElement.style.color = 'green';
        }
    }
</script>

</x-guest-layout>



