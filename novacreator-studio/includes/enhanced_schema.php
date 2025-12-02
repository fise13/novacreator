<?php
/**
 * Расширенные структурированные данные (Schema.org)
 * Дополнительные типы разметки для улучшения видимости в поиске
 */

// Подключаем локализацию если еще не подключена
if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

/**
 * Генерация FAQ схемы для страницы FAQ
 * @param array $faqs Массив вопросов и ответов
 * @return array
 */
function generateFAQSchema($faqs) {
    $faqSchema = [
        '@type' => 'FAQPage',
        'mainEntity' => []
    ];
    
    foreach ($faqs as $faq) {
        $faqSchema['mainEntity'][] = [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['answer']
            ]
        ];
    }
    
    return $faqSchema;
}

/**
 * Генерация Article схемы для статьи блога
 * @param array $article Данные статьи
 * @param string $lang Язык
 * @return array
 */
function generateArticleSchema($article, $lang = 'ru') {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $title = $lang === 'en' && !empty($article['title_en']) ? $article['title_en'] : $article['title'];
    $excerpt = $lang === 'en' && !empty($article['excerpt_en']) ? $article['excerpt_en'] : $article['excerpt'];
    $slug = $lang === 'en' && !empty($article['slug_en']) ? $article['slug_en'] : $article['slug'];
    
    // Убираем HTML теги из контента для description
    $content = $lang === 'en' && !empty($article['content_en']) ? $article['content_en'] : $article['content'];
    $plainContent = strip_tags($content);
    $description = mb_substr($plainContent, 0, 200) . '...';
    
    $articleUrl = $siteUrl . getLocalizedUrl($lang, '/blog-post?slug=' . $slug);
    $imageUrl = $siteUrl . ($article['image'] ?? '/assets/img/og-default.webp');
    
    $articleSchema = [
        '@type' => 'Article',
        'headline' => $title,
        'description' => $excerpt,
        'articleBody' => $description,
        'image' => [
            '@type' => 'ImageObject',
            'url' => $imageUrl,
            'width' => 1200,
            'height' => 630
        ],
        'author' => [
            '@type' => 'Organization',
            'name' => $article['author'] ?? 'NovaCreator Studio',
            'url' => $siteUrl
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'NovaCreator Studio',
            'url' => $siteUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $siteUrl . '/assets/img/logo.svg',
                'width' => 250,
                'height' => 60
            ]
        ],
        'datePublished' => date('c', strtotime($article['date'] ?? 'now')),
        'dateModified' => date('c', strtotime($article['date'] ?? 'now')),
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $articleUrl
        ],
        'url' => $articleUrl,
        'inLanguage' => $lang === 'ru' ? 'ru-RU' : 'en-US',
        'articleSection' => $lang === 'en' && !empty($article['category_en']) ? $article['category_en'] : ($article['category'] ?? 'Marketing'),
        'keywords' => implode(', ', [
            $lang === 'ru' ? 'SEO' : 'SEO',
            $lang === 'ru' ? 'Интернет-маркетинг' : 'Internet Marketing',
            $lang === 'ru' ? 'Разработка сайтов' : 'Web Development',
            $lang === 'ru' ? 'Google Ads' : 'Google Ads'
        ])
    ];
    
    return $articleSchema;
}

/**
 * Генерация Service схемы для страницы услуг
 * @param string $serviceName Название услуги
 * @param string $description Описание услуги
 * @param string $lang Язык
 * @return array
 */
function generateServiceSchema($serviceName, $description, $lang = 'ru') {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $serviceSchema = [
        '@type' => 'Service',
        'name' => $serviceName,
        'description' => $description,
        'provider' => [
            '@type' => 'Organization',
            'name' => 'NovaCreator Studio',
            'url' => $siteUrl,
            'logo' => $siteUrl . '/assets/img/logo.svg',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+7-706-606-39-21',
                'email' => 'contact@novacreatorstudio.com',
                'contactType' => 'customer service',
                'availableLanguage' => ['ru', 'en']
            ]
        ],
        'areaServed' => [
            '@type' => 'Country',
            'name' => $lang === 'ru' ? 'Казахстан' : 'Kazakhstan'
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => $serviceName,
            'itemListElement' => [
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $serviceName,
                        'description' => $description
                    ]
                ]
            ]
        ]
    ];
    
    return $serviceSchema;
}

/**
 * Генерация Review схемы для отзывов
 * @param array $reviews Массив отзывов
 * @return array
 */
function generateReviewSchema($reviews) {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $totalRating = 0;
    $reviewCount = count($reviews);
    
    $reviewSchemas = [];
    foreach ($reviews as $review) {
        $rating = $review['rating'] ?? 5;
        $totalRating += $rating;
        
        $reviewSchemas[] = [
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $review['author']
            ],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $rating,
                'bestRating' => 5,
                'worstRating' => 1
            ],
            'reviewBody' => $review['text'],
            'datePublished' => $review['date'] ?? date('c')
        ];
    }
    
    $avgRating = $reviewCount > 0 ? round($totalRating / $reviewCount, 1) : 5;
    
    $aggregateSchema = [
        '@type' => 'Organization',
        'name' => 'NovaCreator Studio',
        'url' => $siteUrl,
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => $avgRating,
            'reviewCount' => $reviewCount,
            'bestRating' => 5,
            'worstRating' => 1
        ],
        'review' => $reviewSchemas
    ];
    
    return $aggregateSchema;
}

/**
 * Генерация LocalBusiness схемы для локального SEO
 * @param string $lang Язык
 * @return array
 */
function generateLocalBusinessSchema($lang = 'ru') {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $localBusinessSchema = [
        '@type' => 'ProfessionalService',
        'name' => 'NovaCreator Studio',
        'image' => $siteUrl . '/assets/img/logo.svg',
        'url' => $siteUrl,
        'telephone' => '+7-706-606-39-21',
        'email' => 'contact@novacreatorstudio.com',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $lang === 'ru' ? 'ул. Примерная, 123' : '123 Example Street',
            'addressLocality' => $lang === 'ru' ? 'Алматы' : 'Almaty',
            'addressRegion' => $lang === 'ru' ? 'Алматинская область' : 'Almaty Region',
            'postalCode' => '050000',
            'addressCountry' => 'KZ'
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '43.238949',
            'longitude' => '76.889709'
        ],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '09:00',
                'closes' => '18:00'
            ]
        ],
        'priceRange' => '$$',
        'currenciesAccepted' => 'KZT, USD, EUR',
        'paymentAccepted' => $lang === 'ru' ? 'Наличные, Банковский перевод, Онлайн оплата' : 'Cash, Bank Transfer, Online Payment',
        'areaServed' => [
            [
                '@type' => 'City',
                'name' => $lang === 'ru' ? 'Алматы' : 'Almaty'
            ],
            [
                '@type' => 'City',
                'name' => $lang === 'ru' ? 'Астана' : 'Astana'
            ],
            [
                '@type' => 'City',
                'name' => $lang === 'ru' ? 'Шымкент' : 'Shymkent'
            ],
            [
                '@type' => 'Country',
                'name' => $lang === 'ru' ? 'Казахстан' : 'Kazakhstan'
            ]
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => $lang === 'ru' ? 'Услуги' : 'Services',
            'itemListElement' => [
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $lang === 'ru' ? 'SEO Оптимизация' : 'SEO Optimization',
                        'description' => $lang === 'ru' ? 'Комплексное продвижение сайтов в поисковых системах' : 'Comprehensive website promotion in search engines'
                    ]
                ],
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $lang === 'ru' ? 'Разработка сайтов' : 'Web Development',
                        'description' => $lang === 'ru' ? 'Создание современных веб-сайтов и приложений' : 'Creation of modern websites and applications'
                    ]
                ],
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => 'Google Ads',
                        'description' => $lang === 'ru' ? 'Настройка и ведение контекстной рекламы' : 'Setup and management of contextual advertising'
                    ]
                ]
            ]
        ],
        'sameAs' => [
            'https://www.facebook.com/novacreatorstudio',
            'https://www.instagram.com/novacreatorstudio',
            'https://www.linkedin.com/company/novacreatorstudio',
            'https://t.me/novacreatorstudio'
        ]
    ];
    
    return $localBusinessSchema;
}

/**
 * Генерация Person схемы для страницы "О нас"
 * @param string $lang Язык
 * @return array
 */
function generatePersonSchema($lang = 'ru') {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $personSchema = [
        '@type' => 'Person',
        'name' => 'Victor - NovaCreator Studio',
        'jobTitle' => $lang === 'ru' ? 'Основатель и CEO' : 'Founder & CEO',
        'worksFor' => [
            '@type' => 'Organization',
            'name' => 'NovaCreator Studio',
            'url' => $siteUrl
        ],
        'url' => $siteUrl . getLocalizedUrl($lang, '/about'),
        'image' => $siteUrl . '/assets/img/team/ceo.jpg',
        'email' => 'contact@novacreatorstudio.com',
        'telephone' => '+7-706-606-39-21',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => $lang === 'ru' ? 'Алматы' : 'Almaty',
            'addressCountry' => 'KZ'
        ],
        'sameAs' => [
            'https://www.linkedin.com/in/victorncs',
            'https://t.me/victorncs'
        ],
        'knowsAbout' => [
            'SEO',
            'Web Development',
            'Digital Marketing',
            'Google Ads',
            'JavaScript',
            'PHP',
            'React'
        ]
    ];
    
    return $personSchema;
}

/**
 * Генерация VideoObject схемы для видео
 * @param array $video Данные видео
 * @param string $lang Язык
 * @return array
 */
function generateVideoSchema($video, $lang = 'ru') {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $videoSchema = [
        '@type' => 'VideoObject',
        'name' => $video['title'],
        'description' => $video['description'],
        'thumbnailUrl' => $siteUrl . $video['thumbnail'],
        'uploadDate' => $video['uploadDate'] ?? date('c'),
        'duration' => $video['duration'] ?? 'PT5M',
        'contentUrl' => $video['url'],
        'embedUrl' => $video['embedUrl'] ?? $video['url'],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'NovaCreator Studio',
            'url' => $siteUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $siteUrl . '/assets/img/logo.svg'
            ]
        ]
    ];
    
    return $videoSchema;
}

/**
 * Генерация HowTo схемы для инструкций
 * @param array $steps Шаги инструкции
 * @param string $title Название инструкции
 * @param string $description Описание
 * @param string $lang Язык
 * @return array
 */
function generateHowToSchema($steps, $title, $description, $lang = 'ru') {
    $host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    $scheme = $isSecure ? 'https' : 'http';
    $siteUrl = $scheme . '://' . $host;
    
    $howToSteps = [];
    foreach ($steps as $index => $step) {
        $howToSteps[] = [
            '@type' => 'HowToStep',
            'position' => $index + 1,
            'name' => $step['name'],
            'text' => $step['text'],
            'image' => isset($step['image']) ? $siteUrl . $step['image'] : null,
            'url' => isset($step['url']) ? $siteUrl . $step['url'] : null
        ];
    }
    
    $howToSchema = [
        '@type' => 'HowTo',
        'name' => $title,
        'description' => $description,
        'step' => $howToSteps,
        'totalTime' => 'PT30M',
        'estimatedCost' => [
            '@type' => 'MonetaryAmount',
            'currency' => 'KZT',
            'value' => '0'
        ]
    ];
    
    return $howToSchema;
}

