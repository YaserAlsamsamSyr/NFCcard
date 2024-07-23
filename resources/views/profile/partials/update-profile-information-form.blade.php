<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('معلومات الحساب') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("تعديل معلومات الحساب و الحساب") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('الأسم في اللغة العربية')" />
            <x-text-input id="name" name="araName" type="text" class="mt-1 block w-full" :value="old('araName', $user->araName)" required autofocus autocomplete="araName" />
            <x-input-error class="mt-2" :messages="$errors->get('araName')" />
        </div>        
        <div>
            <x-input-label for="name" :value="__('الأسم في اللغة الأنكليزية')" />
            <x-text-input id="name" name="engName" type="text" class="mt-1 block w-full" :value="old('engName', $user->engName)" required autofocus autocomplete="engName" />
            <x-input-error class="mt-2" :messages="$errors->get('engName')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('الحساب')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('حسابك لم يتم تأكيده') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('أضغط هنا لأعادة أرسال رابط التفعيل') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('تم أرسال رابط تفعيل جديد ألى حسابك') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('حفظ.') }}</p>
            @endif
        </div>
    </form>
</section>