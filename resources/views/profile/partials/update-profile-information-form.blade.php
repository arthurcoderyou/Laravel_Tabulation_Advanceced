<section class="container p-5">

    
    <header class=" ">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
    
        <form method="post" action="{{ route('profile.update') }}" class="form row" enctype="multipart/form-data">
            @csrf
            @method('patch')
    
            <div class="col-md-4 col-sm-12 px-auto">
                <div class="card container-fluid" >
                    <div class="card-img text-center">
                        <img src="{{ (!empty(auth()->user()->photo)) ? url('upload/'.auth()->user()->photo) : url('upload/no_image.jpg') }}" alt="user-img" style="width:20vw;" class="mx-auto">
                    </div>
                    
                </div>
            </div>

            <div class="col-md-8 col-sm-12">
                <x-input-label for="name" class="form-control-label" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />


                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                <x-input-label for="photo" :value="__('Profile Picture')" />
                <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" :value="old('photo', $user->photo)" required />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif

                <div class="flex items-center mt-3">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
        
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success">Profile Updated Successfully</div>
                    @endif
                </div>
            </div>
    
            
    
            
        </form>

    </header>

    
</section>
