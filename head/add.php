<?php if(is_front_page()): ?>

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "url": "https://lostmortal.info/",
        "name": "Lostmortal Web",
        "description": "<?php bloginfo('description'); ?>",
        "publisher": {
            "@type": "Organization",
            "name": "Lostmortal",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg",
                "width": 1500,
                "height": 1500
            }
        },
        "image": {
            "@type": "ImageObject",
            "url": "<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg",
            "width": 1500,
            "height": 1500
        }
    }
    </script>

<?php elseif(is_single()): ?>

    <?php $category = get_the_category(); ?>
    <script type="application/ld+json">
    [
        {
            "@context": "http://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo get_the_permalink(); ?>"
            },
            "headline": "<?php the_title(); ?>",
            "description": "<?php echo get_the_excerpt(); ?>",
            "datePublished": "<?php the_time('Y/m/d'); ?>",
            "dateModified": "<?php the_modified_date('Y/m/d'); ?>",
            "author": {
                "@type": "Person",
                "name": "Tomoki Tanaka"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Lostmortal",
                "logo": {
                    "@type": "ImageObject",
                    "url": "<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg",
                    "width": 1500,
                    "height": 1500
                }
            },
            "image": {
                "@type": "ImageObject",
                "url": "<?php echo get_the_post_thumbnail_url(); ?>",
                "width": 720,
                "height": 405
            }
        },
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://lostmortal.info/",
                        "name": "Lostmortal Web"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "<?php echo get_category_link( $category[0]->term_id ); ?>",
                        "name": "<?php echo $category[0]->cat_name; ?>"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "item": {
                        "@id": "<?php echo get_the_permalink(); ?>",
                        "name": "<?php the_title(); ?>"
                    }
                }
            ]
        }
    ]
    </script>

<?php endif; ?>