<header class="public-header">
    <a class="public-logo" href="/{{ $locale ?? 'en' }}" aria-label="WebLabStudios home">
        WebLab<span>Studios</span><i>.</i>
    </a>

    <nav class="public-nav" aria-label="Main navigation">
        <a href="/{{ $locale ?? 'en' }}#services">
            {{ $locale === 'ar' ? 'خدماتنا' : ($locale === 'tr' ? 'Hizmetler' : 'Services') }}
        </a>

        <a href="/{{ $locale ?? 'en' }}#work">
            {{ $locale === 'ar' ? 'أعمالنا' : ($locale === 'tr' ? 'Projeler' : 'Work') }}
        </a>

        <a href="/{{ $locale ?? 'en' }}/blog">
            {{ $locale === 'ar' ? 'المقالات' : ($locale === 'tr' ? 'Yazılar' : 'Insights') }}
        </a>

        <a href="/{{ $locale ?? 'en' }}#contact">
            {{ $locale === 'ar' ? 'اتصل بنا' : ($locale === 'tr' ? 'İletişim' : 'Contact') }}
        </a>
    </nav>

    <div class="public-languages" aria-label="Language">
        <a href="/en" lang="en">EN</a>
        <a href="/ar" lang="ar">AR</a>
        <a href="/tr" lang="tr">TR</a>
    </div>
</header>
