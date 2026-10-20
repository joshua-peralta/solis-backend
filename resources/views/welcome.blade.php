<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The SOLIS specialty coffee storefront API.">

        <title>SOLIS | Specialty Coffee API</title>

        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="welcome-page">
        <header class="welcome-header">
            <a class="brand-link" href="/" aria-label="SOLIS home">
                <span class="brand-mark">SOLIS</span>
                <span class="brand-caption">Specialty Coffee</span>
            </a>

            <span class="service-status">
                <span class="service-status__indicator" aria-hidden="true"></span>
                API service
            </span>
        </header>

        <main class="welcome-main">
            <section class="welcome-hero" aria-labelledby="welcome-title">
                <p class="welcome-eyebrow">Thoughtfully sourced. Carefully roasted.</p>
                <h1 id="welcome-title">Good coffee begins with good connections.</h1>
                <p class="welcome-description">
                    The SOLIS storefront API is ready. Use the GraphQL endpoint to explore
                    coffees, origins, and seasonal roasts.
                </p>

                <nav class="service-links" aria-label="API resources">
                    <a class="service-link" href="/graphql">
                        <span>
                            <span class="service-link__title">GraphQL API</span>
                            <span class="service-link__path">/graphql</span>
                        </span>
                        <span class="service-link__arrow" aria-hidden="true">↗</span>
                    </a>
                    <a class="service-link" href="/graphiql">
                        <span>
                            <span class="service-link__title">GraphiQL explorer</span>
                            <span class="service-link__path">/graphiql</span>
                        </span>
                        <span class="service-link__arrow" aria-hidden="true">↗</span>
                    </a>
                </nav>

                <p class="welcome-note">
                    This service powers the SOLIS storefront and catalog.
                </p>
            </section>
        </main>

        <footer class="welcome-footer">
            <span>© {{ now()->year }} SOLIS Specialty Coffee Roasters</span>
            <span>Roasted with intention.</span>
        </footer>
    </body>
</html>
