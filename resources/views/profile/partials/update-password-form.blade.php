<section class="container p-5">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" 
                oninput="checkPasswordStrength(this.value)"
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2"/>
            <div class="text-sm space-y-1 p-1 " id="password-strength-feedback"><small>Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and be at least 8 characters long.</small></div>
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success">Password Updated Successfully</div>
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
</section>
