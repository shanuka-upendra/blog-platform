<x-app-layout>
    <x-slot name="title">{{ __('Dashboard') }} - MyBlog</x-slot>

    <div class="w-full py-section-gap px-gutter">
        <main class="max-w-container-max mx-auto">
            
            <div class="mb-10 text-center md:text-left">
                <h1 class="font-display-lg text-[32px] leading-[40px] md:text-[38px] md:leading-[46px] font-extrabold text-on-background tracking-tight mb-2">
                    Welcome back, {{ Auth::user()->name }}!
                </h1>
                <p class="font-interface-body text-base text-secondary">
                    Manage your reading preferences, post contributions, and premium subscription details.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 items-start">
                
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white border border-outline-variant/60 rounded-xl p-8 shadow-[0px_4px_20px_rgba(0,0,0,0.02)]">
                        <h2 class="font-headline-md text-xl font-bold text-on-surface mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">feed</span> Quick Actions
                        </h2>
                        
                        <div class="grid sm:grid-cols-2 gap-4">
                            <a href="/posts/create" class="flex flex-col p-4 rounded-lg border border-outline-variant hover:border-primary/40 bg-background group transition-all">
                                <span class="material-symbols-outlined text-primary mb-2 group-hover:scale-105 transition-transform">edit_document</span>
                                <span class="font-interface-body font-semibold text-on-surface mb-1">Create New Post</span>
                                <span class="text-xs text-secondary">Write and publish an intellectual story to the community.</span>
                            </a>

                            <a href="/my-posts" class="flex flex-col p-4 rounded-lg border border-outline-variant hover:border-primary/40 bg-background group transition-all">
                                <span class="material-symbols-outlined text-primary mb-2 group-hover:scale-105 transition-transform">article</span>
                                <span class="font-interface-body font-semibold text-on-surface mb-1">Manage My Posts</span>
                                <span class="text-xs text-secondary">Review drafts, view engagement metrics, or edit content.</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-surface-container-low border border-outline-variant/40 rounded-xl p-6">
                        <p class="font-meta-sm text-meta-sm text-secondary flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm filled text-primary">info</span>
                            You are securely logged into your personal dashboard system. Need updates? Explore our <a href="/blog" class="text-primary font-medium hover:underline">Reading Feed</a>.
                        </p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white border border-outline-variant/60 rounded-xl p-6 shadow-[0px_4px_20px_rgba(0,0,0,0.02)]">
                        <h3 class="font-label-caps text-label-caps text-secondary uppercase tracking-wider mb-4 font-bold">Membership Status</h3>
                        
                        @if(Auth::user()->is_premium)
                            <div class="bg-[#fefce8] border border-[#fef08a] rounded-xl p-5 text-center mb-4">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-[#fde047]">
                                    <span class="material-symbols-outlined text-[#854d0e] text-2xl filled">star</span>
                                </div>
                                <h4 class="font-interface-body font-bold text-[#854d0e] mb-1">Pro Reader Member</h4>
                                <p class="text-xs text-[#854d0e]/80">Unlimited access to all exclusive articles active.</p>
                            </div>

                            <a href="/billing" class="w-full border border-outline text-secondary font-label-caps text-label-caps py-3 px-4 rounded-lg hover:bg-surface-variant transition-colors flex justify-center items-center gap-2 text-center text-xs">
                                <span class="material-symbols-outlined text-[16px]">payments</span> Manage Billing Portal
                            </a>
                        @else
                            <div class="bg-background border border-outline-variant rounded-xl p-5 text-center mb-4">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-outline-variant">
                                    <span class="material-symbols-outlined text-secondary text-2xl">lock</span>
                                </div>
                                <h4 class="font-interface-body font-bold text-on-surface mb-1">Basic Free Tier</h4>
                                <p class="text-xs text-secondary">You are currently restricted from premium stories.</p>
                            </div>

                            <a href="/subscribe" class="w-full bg-primary text-on-primary font-label-caps text-label-caps py-3.5 px-4 rounded-lg hover:opacity-95 transition-all flex justify-center items-center gap-2 text-center text-xs shadow-sm font-semibold">
                                <span class="material-symbols-outlined text-[16px] filled">workspace_premium</span> Upgrade to Pro
                            </a>
                        @endif
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>