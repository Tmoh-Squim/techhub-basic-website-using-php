<?php
include 'db_config.php';

// Create the cards table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100),
    image_url VARCHAR(255)
)");

// Predefined cards data
$cards = [
    ['AI-Powered Solutions', 'We leverage artificial intelligence for data-driven decision-making.', 'feature', 'ai.jpg'],
    ['Cloud Computing', 'Secure and scalable cloud solutions for modern businesses.', 'feature', 'cloud.jpg'],
    ['24/7 Security', 'Protect your data with advanced cybersecurity measures.', 'feature', 'security.jpg'],
    ['Blockchain', 'Decentralized security and transparency for digital transactions.', 'tech', 'blockchain.jpg'],
    ['Internet of Things (IoT)', 'Smart devices connected for automation and efficiency.', 'tech', 'iot.jpg'],
    ['Machine Learning', 'Data-driven algorithms that adapt and evolve with user behavior.', 'tech', 'ml.jpg']
];

// Insert default cards if they don't exist
$stmt = $conn->prepare("INSERT INTO cards (title, description, category, image_url) SELECT ?, ?, ?, ? FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM cards WHERE title = ?)");

foreach ($cards as $card) {
    $stmt->bind_param("sssss", $card[0], $card[1], $card[2], $card[3], $card[0]);
    $stmt->execute();
}

$stmt->close();

function fetchCards($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM cards WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<div class='feature'>
                <img src='assets/images/{$row['image_url']}' alt='{$row['title']}'>
                <h3>{$row['title']}</h3>
                <p>{$row['description']}</p>
              </div>";
    }

    $stmt->close();
}
?>

<?php include 'includes/header.php'; ?>
<style>
 .hero {
    position: relative;
    width: 100%;
    height: 70vh;
    overflow: hidden;
}

.video-container {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 100vh;
    transform: translate(-50%, -50%) scale(1.3);
    z-index: -1;
}

.video-container iframe {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: none;
    pointer-events: none;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    z-index: 1;
}

    .hero h1 {
        font-size: 40px;
        margin-bottom: 15px;
    }
    .hero p {
        font-size: 18px;
        max-width: 600px;
        line-height: 1.5;
    }
    .hero .btn {
        background: #ff6b6b;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s ease-in-out;
    }
    .hero .btn:hover {
        background: #ff4040;
    }
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        color: #333;
        text-align: center;
    }

    /* Hero Section */
    
    /* Features Section */
    .features {
        padding: 50px 20px;
        background: white;
    }

    .features h2 {
        font-size: 36px;
        margin-bottom: 30px;
    }

    .features-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 40px;
    }

    .feature {
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 300px;
        text-align: center;
    }

    .feature h3 {
        color: #ff6b6b;
        margin-bottom: 10px;
    }

    /* Technologies Section */
    .tech-section {
        padding: 50px 20px;
        background: #222;
        color: white;
    }

    .tech-section h2 {
        font-size: 36px;
        margin-bottom: 30px;
    }

    .tech-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        max-width: 1000px;
        margin: auto;
    }

    .tech-box {
        background: #333;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .tech-box h3 {
        color: #ff6b6b;
    }

    /* Footer */
    footer {
        background: #111;
        color: white;
        padding: 15px 0;
    }
</style>

<!-- Hero Section with Short Embedded Video (No Controls) -->
<section class="hero">
<div class="video-container">
        <iframe 
            src="https://www.youtube.com/embed/GX_XsdNv1PY?autoplay=1&mute=1&loop=1&playlist=GX_XsdNv1PY&controls=0&modestbranding=1"
            title="YouTube video player"
            frameborder="0"
            allow="autoplay; encrypted-media; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
        </iframe>
    </div>
    <div class="hero-overlay">
        <h1>Welcome to Our Tech Hub</h1>
        <p>Innovating the Future with AI, Cloud Computing, and Cybersecurity.</p>
        <a href="services.php" class="btn">Explore Services</a>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <h2>Why Choose Us?</h2>
    <div class="features-container">
        <?php fetchCards('feature'); ?>
    </div>
</section>

<!-- Technologies Section -->
<section class="tech-section">
    <h2>Cutting-Edge Technologies We Use</h2>
    <div class="tech-container">
        <?php fetchCards('tech'); ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
