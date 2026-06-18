<x-app-layout>
    <x-slot name="title">MyBlog - Pricing</x-slot>

    <main class="w-full max-w-4xl mx-auto px-gutter py-section-gap flex flex-col items-center justify-center"> 
        <div class="text-center mb-12"> 
            <h1 class="font-display-lg text-display-lg mb-4">Choose Your Plan</h1> 
            <p class="font-article-body text-article-body text-secondary max-w-2xl mx-auto">Support independent writing and get access to exclusive content.</p> 
        </div> 
        
        <div class="grid md:grid-cols-2 gap-8 w-full items-stretch"> 
            <div class="bg-surface rounded-xl border border-[#f3f4f6] p-8 flex flex-col relative hover:shadow-[0px_4px_20px_rgba(0,0,0,0.04)] transition-shadow duration-300"> 
                <div class="mb-8"> 
                    <span class="inline-block px-3 py-1 bg-[#f0fdf4] text-[#166534] rounded-full font-meta-sm text-meta-sm font-semibold mb-4">Free</span> 
                    <h2 class="font-headline-md text-headline-md mb-2">Basic Reader</h2> 
                    <div class="flex items-baseline gap-2"> 
                        <span class="font-display-lg text-display-lg">$0</span> 
                        <span class="font-meta-sm text-meta-sm text-secondary">/month</span> 
                    </div> 
                </div> 
                <div class="flex-grow"> 
                    <ul class="space-y-4"> 
                        <li class="flex items-start gap-3"> 
                            <span class="material-symbols-outlined text-secondary text-[20px]">check</span> 
                            <span class="font-interface-body text-interface-body">Basic reading access</span> 
                        </li> 
                        <li class="flex items-start gap-3"> 
                            <span class="material-symbols-outlined text-secondary text-[20px]">check</span> 
                            <span class="font-interface-body text-interface-body">Read standard posts</span> 
                        </li> 
                    </ul> 
                </div> 
                <div class="mt-8"> 
                    <button disabled class="w-full py-3 px-4 rounded-lg border border-outline text-secondary font-label-caps text-label-caps bg-surface-variant/50 cursor-not-allowed">
                        @auth {{ !Auth::user()->is_premium ? 'Current Plan' : 'Basic Tier' }} @else Current Plan @endauth
                    </button> 
                </div> 
            </div> 

            <div class="bg-surface rounded-xl border-2 border-primary p-8 flex flex-col relative hover:shadow-[0px_4px_20px_rgba(0,0,0,0.04)] transition-shadow duration-300"> 
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2"> 
                    <span class="inline-flex items-center gap-1 bg-primary text-on-primary px-4 py-1 rounded-full font-meta-sm text-meta-sm font-bold shadow-sm"> 
                        <span class="material-symbols-outlined text-[16px] filled">star</span> Most Popular 
                    </span> 
                </div> 
                <div class="mb-8 mt-2"> 
                    <span class="inline-block px-3 py-1 bg-[#fefce8] text-[#854d0e] rounded-full font-meta-sm text-meta-sm font-semibold mb-4 flex items-center gap-1 w-max"> 
                        Premium 
                    </span> 
                    <h2 class="font-headline-md text-headline-md mb-2">Pro Reader</h2> 
                    <div class="flex items-baseline gap-2"> 
                        <span class="font-display-lg text-display-lg text-primary">$9.99</span> 
                        <span class="font-meta-sm text-meta-sm text-secondary">/month</span> 
                    </div> 
                </div> 
                <div class="flex-grow"> 
                    <ul class="space-y-4"> 
                        <li class="flex items-start gap-3"> 
                            <span class="material-symbols-outlined text-primary text-[20px] filled">check_circle</span> 
                            <span class="font-interface-body text-interface-body font-medium">Unlimited reading</span> 
                        </li> 
                        <li class="flex items-start gap-3"> 
                            <span class="material-symbols-outlined text-primary text-[20px] filled">check_circle</span> 
                            <span class="font-interface-body text-interface-body font-medium">Access all premium articles</span> 
                        </li> 
                        <li class="flex items-start gap-3"> 
                            <span class="material-symbols-outlined text-primary text-[20px] filled">check_circle</span> 
                            <span class="font-interface-body text-interface-body font-medium">Early access to new posts</span> 
                        </li> 
                        <li class="flex items-start gap-3"> 
                            <span class="material-symbols-outlined text-primary text-[20px] filled">check_circle</span> 
                            <span class="font-interface-body text-interface-body font-medium">Zero ads, pure content</span> 
                        </li> 
                    </ul> 
                </div> 
                <div class="mt-8"> 
                    @auth
                        @if(Auth::user()->is_premium)
                            <button disabled class="w-full py-4 px-4 rounded-lg bg-emerald-600 text-white font-label-caps text-label-caps opacity-90 cursor-not-allowed flex items-center justify-center gap-2 shadow-sm">
                                Subscribed <span class="material-symbols-outlined text-[18px]">check</span>
                            </button>
                        @else
                            <a href="/checkout" class="w-full py-4 px-4 rounded-lg bg-primary text-on-primary font-label-caps text-label-caps hover:bg-primary-container active:translate-y-[2px] transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2"> 
                                Upgrade Now <span class="material-symbols-outlined text-[18px]">arrow_forward</span> 
                            </a>
                        @endif
                    @else
                        <a href="/login" class="w-full py-4 px-4 rounded-lg bg-primary text-on-primary font-label-caps text-label-caps hover:bg-primary-container active:translate-y-[2px] transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2"> 
                            Login to Upgrade <span class="material-symbols-outlined text-[18px]">arrow_forward</span> 
                        </a>
                    @endauth
                    <p class="text-center font-meta-sm text-meta-sm text-secondary mt-3">Cancel anytime. Secure payment via Stripe.</p> 
                </div> 
            </div> 
        </div> 
    </main> 
</x-app-layout>