@extends('public.layouts.site')

@section('title', match($locale) {
    'ar' => 'WebLabStudios — تجارب رقمية تصنع الفرق',
    'tr' => 'WebLabStudios — Dijital Deneyimler',
    default => 'WebLabStudios — Digital Experiences',
})

@section('meta_description', match($locale) {
    'ar' => 'نصمم ونطور المواقع والهويات الرقمية والتجارب التي تساعد العلامات التجارية على النمو.',
    'tr' => 'Markaların büyümesine yardımcı olan web siteleri ve dijital deneyimler tasarlıyoruz.',
    default => 'We design and develop websites, brands, and digital experiences that help businesses grow.',
})

@section('content')

<section class="public-hero">
    <div class="public-hero-content">
        <p class="public-eyebrow">
            {{ ['en' => 'INDEPENDENT DIGITAL STUDIO', 'ar' => 'استوديو رقمي مستقل', 'tr' => 'BAĞIMSIZ DİJİTAL STÜDYO'][$locale] }}
        </p>

        <h1>
            @if($locale === 'ar')
                نصنع تجارب رقمية
                <span>تترك أثراً.</span>
            @elseif($locale === 'tr')
                Dijital deneyimler
                <span>tasarlıyoruz.</span>
            @else
                We build digital
                <span>experiences.</span>
            @endif
        </h1>

        <p class="public-hero-description">
            @if($locale === 'ar')
                نساعد العلامات التجارية على النمو من خلال التصميم والتقنية والاستراتيجيات الرقمية.
            @elseif($locale === 'tr')
                Markaların tasarım, teknoloji ve dijital stratejiyle büyümesine yardımcı oluyoruz.
            @else
                We help ambitious brands grow through thoughtful design, technology, and digital strategy.
            @endif
        </p>

        <div class="public-hero-actions">
            <a class="public-button public-button-primary" href="#work">
                {{ ['en' => 'Explore our work', 'ar' => 'اكتشف أعمالنا', 'tr' => 'Projelerimizi keşfet'][$locale] }}
                <span aria-hidden="true">↗</span>
            </a>

            <a class="public-button public-button-secondary" href="#contact">
                {{ ['en' => 'Start a project', 'ar' => 'ابدأ مشروعك', 'tr' => 'Proje başlat'][$locale] }}
            </a>
        </div>
    </div>

    <div class="public-hero-index">
        <span>01 / 03</span>
        <span>Design · Technology · Strategy</span>
    </div>
</section>

<section class="public-introduction">
    <p class="public-eyebrow">
        {{ ['en' => 'A DIFFERENT WAY FORWARD', 'ar' => 'طريقة مختلفة للتقدم', 'tr' => 'FARKLI BİR YAKLAŞIM'][$locale] }}
    </p>

    <h2>
        @if($locale === 'ar')
            من الفكرة إلى تجربة رقمية
            <span>تستحق أن تُرى.</span>
        @elseif($locale === 'tr')
            Fikirden etkileyici dijital deneyimlere.
        @else
            From ambitious ideas to
            <span>meaningful digital experiences.</span>
        @endif
    </h2>

    <p>
        @if($locale === 'ar')
            نجمع الإبداع والاستراتيجية والتطوير لبناء حضور رقمي واضح ومتماسك.
        @elseif($locale === 'tr')
            Strateji, tasarım ve geliştirmeyi bir araya getirerek güçlü dijital kimlikler oluşturuyoruz.
        @else
            We bring strategy, design, and development together to create distinctive digital experiences.
        @endif
    </p>
</section>

<section class="public-services-section" id="services">
    <div class="public-section-heading">
        <div>
            <p class="public-eyebrow">
                {{ ['en' => 'WHAT WE DO', 'ar' => 'ماذا نقدم', 'tr' => 'NE YAPIYORUZ'][$locale] }}
            </p>
            <h2>
                {{ ['en' => 'Capabilities', 'ar' => 'خدماتنا', 'tr' => 'Hizmetlerimiz'][$locale] }}
            </h2>
        </div>
        <span class="public-section-count">01 — 04</span>
    </div>

    <div class="public-service-list">
        @forelse($services as $service)
            @php
                $translation = $service->translations->first();
                $serviceName = $translation?->name ?: $service->name;
                $serviceDescription = $translation?->description ?: $service->description;
            @endphp

            <article class="public-service-row">
                <span class="public-service-number">
                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                </span>

                <div class="public-service-copy">
                    <h3>{{ $serviceName }}</h3>
                    @if($serviceDescription)
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($serviceDescription), 220) }}</p>
                    @endif
                </div>

                <span class="public-service-arrow" aria-hidden="true">↗</span>
            </article>
        @empty
            <p>
                {{ ['en' => 'Our services will be available here soon.', 'ar' => 'ستظهر خدماتنا هنا قريباً.', 'tr' => 'Hizmetlerimiz yakında burada olacak.'][$locale] }}
            </p>
        @endforelse
    </div>
</section>

<section class="public-work-section" id="work">
    <div class="public-section-heading">
        <div>
            <p class="public-eyebrow">
                {{ ['en' => 'SELECTED WORK', 'ar' => 'نماذج من أعمالنا', 'tr' => 'SEÇİLMİŞ PROJELER'][$locale] }}
            </p>
            <h2>
                {{ ['en' => 'Made with intention.', 'ar' => 'أعمال صُنعت بهدف.', 'tr' => 'Özenle tasarlandı.'][$locale] }}
            </h2>
        </div>
    </div>

    <div class="public-card-grid">
        @forelse($projects as $project)
            <article class="public-card">
                @if($project->image)
                    <div class="public-card-image">
                        <img
                            src="{{ \Illuminate\Support\Str::startsWith($project->image, ['http://', 'https://', '/']) ? $project->image : asset('storage/' . $project->image) }}"
                            alt="{{ $project->title }}"
                            loading="lazy"
                        >
                    </div>
                @endif

                <div class="public-card-content">
                    <p class="public-card-meta">
                        {{ $project->client_name ?: 'WebLabStudios' }}
                    </p>

                    <h3>{{ $project->title }}</h3>

                    @if($project->description)
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 150) }}</p>
                    @endif

                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer">
                            {{ ['en' => 'View project', 'ar' => 'عرض المشروع', 'tr' => 'Projeyi görüntüle'][$locale] }}
                            ↗
                        </a>
                    @endif
                </div>
            </article>
        @empty
            <p>
                {{ ['en' => 'Selected projects will appear here soon.', 'ar' => 'ستظهر المشاريع المختارة هنا قريباً.', 'tr' => 'Seçili projeler yakında burada olacak.'][$locale] }}
            </p>
        @endforelse
    </div>
</section>

<section class="public-insights-section" id="insights">
    <div class="public-section-heading">
        <div>
            <p class="public-eyebrow">
                {{ ['en' => 'THINKING & INSIGHTS', 'ar' => 'أفكار ورؤى', 'tr' => 'FİKİRLER VE İÇGÖRÜLER'][$locale] }}
            </p>
            <h2>
                {{ ['en' => 'Ideas worth sharing.', 'ar' => 'أفكار تستحق المشاركة.', 'tr' => 'Paylaşmaya değer fikirler.'][$locale] }}
            </h2>
        </div>

        <a href="/{{ $locale }}/blog">
            {{ ['en' => 'All articles', 'ar' => 'كل المقالات', 'tr' => 'Tüm yazılar'][$locale] }} ↗
        </a>
    </div>

    <div class="public-card-grid public-article-grid">
        @forelse($articles as $article)
            <article class="public-card public-article-card">
                @if($article->image)
                    <div class="public-card-image">
                        <img
                            src="{{ \Illuminate\Support\Str::startsWith($article->image, ['http://', 'https://', '/']) ? $article->image : asset('storage/' . $article->image) }}"
                            alt="{{ $article->title }}"
                            loading="lazy"
                        >
                    </div>
                @endif

                <div class="public-card-content">
                    <p class="public-card-meta">
                        {{ $article->published_at?->format('M d, Y') }}
                    </p>

                    <h3>{{ $article->title }}</h3>

                    @if($article->excerpt)
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt), 150) }}</p>
                    @endif

                    <a href="/{{ $locale }}/blog/{{ $article->slug }}">
                        {{ ['en' => 'Read article', 'ar' => 'اقرأ المقال', 'tr' => 'Yazıyı oku'][$locale] }} ↗
                    </a>
                </div>
            </article>
        @empty
            <p>
                {{ ['en' => 'New insights are coming soon.', 'ar' => 'مقالات جديدة قريباً.', 'tr' => 'Yeni yazılar yakında.'][$locale] }}
            </p>
        @endforelse
    </div>
</section>

<section class="public-final-cta" id="contact">
    <p class="public-eyebrow">
        {{ ['en' => 'HAVE A PROJECT IN MIND?', 'ar' => 'هل لديك مشروع في ذهنك؟', 'tr' => 'BİR PROJENİZ Mİ VAR?'][$locale] }}
    </p>

    <h2>
        {{ ['en' => 'Let’s make something meaningful.', 'ar' => 'لنصنع شيئاً له معنى.', 'tr' => 'Birlikte anlamlı bir şey üretelim.'][$locale] }}
    </h2>

    <a class="public-button public-button-primary" href="mailto:hello@weblabstudios.com">
        {{ ['en' => 'Tell us about your project', 'ar' => 'أخبرنا عن مشروعك', 'tr' => 'Projenizi anlatın'][$locale] }} ↗
    </a>
</section>

@endsection
