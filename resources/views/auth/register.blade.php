<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" style="color: #fff;" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" style="color: #fff;"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" style="color: #fff;"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            oninput="checkPasswordStrength(this.value)"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                            />
            <div class="text-sm text-white space-y-1 p-1 "  id="password-strength-feedback"><small>Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and be at least 8 characters long.</small></div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" style="color: #fff;"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class=" text-sm text-blue-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button style="color: #fff; border:1px solid white; width:80px; border-radius: 10px; padding:5px 0; margin-left: 10px;">
                {{ __('Register') }}
            </x-primary-button>
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
