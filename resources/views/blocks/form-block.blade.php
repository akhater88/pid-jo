@php
// Form Block - Contact/inquiry form
$heading = $data['heading'] ?? __('Get In Touch');
$subheading = $data['subheading'] ?? '';
$description = $data['description'] ?? '';
$success_message = $data['success_message'] ?? __('Thank you! We will get back to you soon.');
@endphp

<section class="py-16 md:py-24 bg-dark">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            @if($heading)
                <x-section-heading :title="$heading" :subtitle="$subheading">
                    @if($description)
                        {{ $description }}
                    @endif
                </x-section-heading>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 text-green-100 rounded-lg flex items-start">
                    <svg class="w-5 h-5 me-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6 bg-secondary p-8 rounded-lg">
                @csrf

                <!-- Honeypot -->
                <input type="text" name="pesaro_field" class="hidden" tabindex="-1" autocomplete="off">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-white font-medium mb-2">
                        {{ __('Full Name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           class="w-full px-4 py-3 bg-dark border border-white/10 rounded-md text-white placeholder-white/40 focus:border-primary focus:ring-2 focus:ring-primary/50 transition-colors @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-white font-medium mb-2">
                        {{ __('Email Address') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full px-4 py-3 bg-dark border border-white/10 rounded-md text-white placeholder-white/40 focus:border-primary focus:ring-2 focus:ring-primary/50 transition-colors @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-white font-medium mb-2">
                        {{ __('Phone Number') }}
                    </label>
                    <input type="tel"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           class="w-full px-4 py-3 bg-dark border border-white/10 rounded-md text-white placeholder-white/40 focus:border-primary focus:ring-2 focus:ring-primary/50 transition-colors @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-white font-medium mb-2">
                        {{ __('Subject') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="subject"
                           name="subject"
                           value="{{ old('subject') }}"
                           required
                           class="w-full px-4 py-3 bg-dark border border-white/10 rounded-md text-white placeholder-white/40 focus:border-primary focus:ring-2 focus:ring-primary/50 transition-colors @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-white font-medium mb-2">
                        {{ __('Message') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea id="message"
                              name="message"
                              rows="6"
                              required
                              class="w-full px-4 py-3 bg-dark border border-white/10 rounded-md text-white placeholder-white/40 focus:border-primary focus:ring-2 focus:ring-primary/50 transition-colors resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <x-button type="submit" size="lg" class="w-full md:w-auto">
                        {{ __('Send Message') }}
                        <svg class="w-5 h-5 ms-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</section>
