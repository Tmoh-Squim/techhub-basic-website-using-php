<?php
include 'db_config.php';

// Drop the table if it exists and recreate it
$conn->query("DROP TABLE IF EXISTS blogs");
$conn->query("CREATE TABLE blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    video_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Predefined blogs data with relevant YouTube videos
$blogs = [
    ['The Future of AI', 'Artificial Intelligence is revolutionizing industries...', 'blog1.jpg', 'https://www.youtube.com/embed/2ePf9rue1Ao'],
    ['Cloud Computing Trends', 'Explore the latest trends in cloud computing...', 'blog2.jpg', 'https://www.youtube.com/embed/M988_fsOSWo'],
    ['Cybersecurity Best Practices', 'Stay safe online with these security tips...', 'blog3.jpg', 'https://www.youtube.com/embed/hS7IPHgDVGQ']
];

// Insert new blogs
$stmt = $conn->prepare("INSERT INTO blogs (title, content, image_url, video_url) VALUES (?, ?, ?, ?)");

foreach ($blogs as $blog) {
    $stmt->bind_param("ssss", $blog[0], $blog[1], $blog[2], $blog[3]);
    $stmt->execute();
}

$stmt->close();

function fetchBlogs() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<div class='blog-card'>
                <h3>{$row['title']}</h3>
                <div class='blog-content'>
                    <p>{$row['content']}</p>
                    <div class='video-container'>
                        <iframe src='{$row['video_url']}' frameborder='0' allowfullscreen></iframe>
                    </div>
                    <img src='assets/images/{$row['image_url']}' alt='{$row['title']}'>
                    <span class='date'>Published on: {$row['created_at']}</span>
                </div>
              </div>";
    }

    $stmt->close();
}
?>

<?php include 'includes/header.php'; ?>

<style>
    .blog-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px 20px;
        background: #f4f4f4;
    }
    .blog-card {
        background: white;
        display: flex;
        flex-direction: column;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        max-width: 700px;
        margin-bottom: 30px;
        text-align: center;
    }
    .blog-card h3 {
        color: #ff6b6b;
        font-size: 24px;
        margin-bottom: 15px;
        text-align: center;
    }
    .blog-card img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        margin-top: 15px;
    }
    .blog-card p {
        text-align: justify;
        font-size: 16px;
        color: #555;
        line-height: 1.6;
    }
    .video-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        margin-top: 15px;
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }
    .blog-card .date {
        display: block;
        margin-top: 15px;
        font-size: 14px;
        color: #777;
    }
    @media (min-width: 1024px) {
        .blog-container {
            flex-direction: row;
            flex-wrap: wrap;
            gap:20px;
            justify-content: center;
        }
        .blog-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: left;
            max-width: 900px;
            gap: 20px;
        }
    }
</style>
<h2>Latest Blogs</h2>

<section class="blog-container">
    <?php fetchBlogs(); ?>
</section>

<?php include 'includes/footer.php'; ?>