<footer class="public-footer">
    <div>
        <a class="public-logo" href="/{{ $locale ?? 'en' }}">
            WebLab<span>Studios</span><i>.</i>
        </a>

        <p>
            {{ $locale === 'ar'
                ? 'نصمم تجارب رقمية تساعد العلامات التجارية على النمو.'
                : ($locale === 'tr'
                    ? 'Markaların büyümesine yardımcı olan dijital deneyimler tasarlıyoruz.'
                    : 'We build digital experiences that help brands grow.') }}
        </p>
    </div>

    <div class="public-footer-bottom">
        <span>© {{ date('Y') }} WebLabStudios</span>
        <span>Digital experiences. Thoughtfully built.</span>
    </div>
</footer>
