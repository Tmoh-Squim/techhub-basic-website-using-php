<?php
include 'db_config.php';

// Auto-create services table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL
)");

// Predefined services data
$services = [
    ['Web Development', 'Custom websites built with the latest technologies.', 'https://w3-lab.com/wp-content/uploads/2019/12/Get-the-Most-Fancied-Web-Development-Services-min-scaled.jpg'],
    ['App Development', 'Innovative mobile and web applications for all platforms.', 'https://static.vecteezy.com/system/resources/previews/000/523/046/original/vector-mobile-app-development-concept.jpg'],
    ['Cyber Security', 'Protect your business with top-tier security solutions.', 'https://static.vecteezy.com/system/resources/previews/002/275/401/large_2x/cyber-security-protection-technology-background-vector.jpg'],
    ['AI & Machine Learning', 'Leverage AI to automate and optimize your business.', 'https://www.lifewire.com/thmb/RdJWHg4p_htryCzlZT-SpX20HdE=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-1351969920-50bc56a6de284580ae75c31cd182bf9f.jpg']
];

// Insert default services if table is empty
$stmt = $conn->prepare("INSERT INTO services (title, description, image_url) 
                        SELECT ?, ?, ? FROM DUAL 
                        WHERE NOT EXISTS (SELECT 1 FROM services WHERE title = ?)");

foreach ($services as $service) {
    $stmt->bind_param("ssss", $service[0], $service[1], $service[2], $service[0]);
    $stmt->execute();
}
$stmt->close();

// Function to fetch and display services
function fetchServices() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM services ORDER BY id ASC");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='service-box'>
                    <img src='{$row['image_url']}' alt='{$row['title']}'>
                    <h3>{$row['title']}</h3>
                    <p>{$row['description']}</p>
                  </div>";
        }
    } else {
        echo "<p>No services available.</p>";
    }
    $stmt->close();
}
?>

<?php include 'includes/header.php'; ?>

<style>
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        color: #333;
        text-align: center;
    }

    /* Hero Section */
    .services-hero {
        background: url('https://hexaware.com/wp-content/uploads/2019/10/Hi-Tech-Platforms-Information-Services.jpg') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .services-hero h1 {
        font-size: 50px;
        margin-bottom: 10px;
    }

    .services-hero p {
        font-size: 20px;
        max-width: 700px;
    }

    /* Services Section */
    .services-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        padding: 50px 20px;
        max-width: 1000px;
        margin: auto;
    }

    .service-box {
        background: white;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
        transition: transform 0.3s ease-in-out;
    }

    .service-box:hover {
        transform: scale(1.05);
    }

    .service-box img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    .service-box h3 {
        color: #ff6b6b;
        margin-bottom: 10px;
    }
</style>

<!-- Hero Section -->
<section class="services-hero">
    <h1>Our Services</h1>
    <p>We offer cutting-edge technology solutions tailored to your needs.</p>
</section>

<!-- Services Section -->
<section class="services-container">
    <?php fetchServices(); ?>
</section>

<?php include 'includes/footer.php'; ?>
