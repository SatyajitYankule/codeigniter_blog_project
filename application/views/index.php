<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


     <title><?= htmlspecialchars($meta['title'] ?? 'Latest Blog Posts') ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta['description'] ?? 'Read the latest blog posts') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta['keywords'] ?? 'blog, articles, posts') ?>">


    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/mainpage_style.css') ?>">
</head>

<body>



    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold">Latest Blog Posts</h2>

        <div class="row g-4">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-4">
                    <div class="card blog-card h-100">
                        <img src="<?= base_url($blog->b_image) ?>" alt="Blog Image" class="blog-image">
                        <div class="card-body d-flex flex-column">
                            <p class="blog-meta d-flex justify-content-between">

                            <span class="">
                                     <?= date('F j, Y', strtotime($blog->b_cretated_at)) ?? 'Admin' ?>
                                </span>

                                <span class="badge rounded-pill author-badge">
                                    Author: <?= $blog->author_name ?? 'Admin' ?>
                                </span>

                            </p>
                            <h5 class="blog-title"><?= $blog->b_title ?></h5>
                            <p class="card-text">
                                <?= implode(' ', array_slice(explode(' ', strip_tags($blog->b_short_content)), 0, 15)) ?>...
                            </p>
                            <a href="<?= base_url('Home/show_blog_page/' . $blog->b_auto_id) ?>"
                                class="btn btn-outline-primary read-more">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>