<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?= htmlspecialchars($blog->b_meta_title ?? 'Blog Detail') ?></title>

    <meta name="description"
        content="<?= htmlspecialchars($blog->b_meta_description ?? 'Read this blog for more insights.') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($blog->b_meta_keywords ?? 'blog, article, post') ?>">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets/css/mainpagetwo_style.css') ?>">

</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-wrapper">
                    <img src="<?= base_url($blog->b_image) ?>" alt="Blog Image" class="blog-image" />
                    <div class="blog-content">
                        <h1><?= $blog->b_title ?></h1>
                        <div class="blog-meta">
                            By <strong><?= $blog->author_name ?></strong> |
                            Category: <em><?= $blog->category_name ?></em> |
                            <?= date('F j, Y', strtotime($blog->b_cretated_at)) ?>
                        </div>
                        <p><?= nl2br($blog->b_main_content) ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="sidebar">
                    <h5>Other Blog Posts</h5>
                    <div class="list-group">
                        <?php foreach ($recent_blogs as $recent): ?>
                            <a href="<?= base_url('Home/show_blog_page/' . $recent->b_auto_id) ?>" class="list-group-item">
                                <?= $recent->b_title ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="<?= base_url('Home') ?>" class="btn btn-outline-secondary w-100">
                        &larr; Back to Blog List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>