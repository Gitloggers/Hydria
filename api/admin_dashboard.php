<?php
require_once 'db.php';
require_once 'check_auth.php';
include_once 'admin_header.php';

// Fetch real-time stats
$projCount = 0;
$adminCount = 0;

try {
    $projCount = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    $adminCount = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
} catch (PDOException $e) {
    // Silent catch
}
?>

<div class="page-header-wrapper" data-aos="fade-down">
    <div class="page-header">
        <h1>Command Center</h1>
        <p style="color: var(--text-muted); margin: 0.5rem 0 0 0;">Next-Gen Construction Intel Dashboard</p>
    </div>
    <div class="weather-widget" id="weather-widget">
        <span class="weather-icon">☀️</span>
        <div>
            <div id="weather-location" style="color: var(--primary);">Los Baños, Laguna</div>
            <div id="weather-temp" style="font-size: 0.75rem; color: var(--text-muted);">Syncing conditions...</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; margin-bottom: 4rem;">
    <!-- Projects Widget -->
    <div class="widget-card" data-aos="zoom-in" data-aos-delay="100">
        <div class="widget-label">Total Portfolio</div>
        <div class="widget-value"><?= $projCount ?></div>
        <div class="widget-icon">🏗️</div>
    </div>

    <!-- Team Widget -->
    <div class="widget-card" data-aos="zoom-in" data-aos-delay="300" style="background: linear-gradient(135deg, var(--primary), #065f46);">
        <div class="widget-label">Admin Users</div>
        <div class="widget-value"><?= $adminCount ?></div>
        <div class="widget-icon">👥</div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Right Column: Activity Pulse -->
    <div>
        <h2 style="margin: 0 0 1.5rem 0; font-weight: 800; letter-spacing: -0.5px;" data-aos="fade-left">Activity Pulse</h2>
        <div class="table-card" style="padding: 1rem; background: #fff;" data-aos="fade-left" data-aos-delay="100">
            <ul style="list-style: none; padding: 0; margin: 0;">
                <?php
                $stmt = $pdo->query("SELECT action, created_at FROM activity_logs ORDER BY created_at DESC LIMIT 6");
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                        $time = date('g:i A', strtotime($row['created_at']));
                        echo "<li style='padding: 1.5rem 1rem; border-bottom: 1px solid #F1F5F9; transition: background 0.3s;'>";
                        echo "<div style='font-weight: 800; font-size: 0.875rem; color: var(--primary); margin-bottom: 0.25rem;'>" . htmlspecialchars($row['action']) . "</div>";
                        echo "<div style='color: var(--text-muted); font-size: 0.75rem; font-weight: 600;'>$time</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li style='padding: 4rem 2rem; text-align: center;'>
                        <div style='font-size: 2.5rem; margin-bottom: 1rem;'>🌑</div>
                        <div style='font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem;'>No Activity Logs</div>
                    </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>


<script>
    // Live Weather (Open-Meteo)
    async function fetchWeather() {
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 5000);
        try {
            const response = await fetch('https://api.open-meteo.com/v1/forecast?latitude=14.1675&longitude=121.2433&current_weather=true', { signal: controller.signal });
            clearTimeout(timeout);
            if (!response.ok) throw new Error('Weather service unavailable');
            const data = await response.json();
            const weather = data.current_weather;
            
            document.getElementById('weather-location').textContent = 'Los Baños, Laguna';
            document.getElementById('weather-temp').innerHTML = `Site: ${getWeatherDesc(weather.weathercode)} • ${Math.round(weather.temperature)}°C`;
        } catch (e) {
            clearTimeout(timeout);
            document.getElementById('weather-location').textContent = 'Weather Unavailable';
            document.getElementById('weather-temp').textContent = '';
        }
    }

    function getWeatherDesc(code) {
        if (code === 0) return 'Clear';
        if (code < 4) return 'Partly Cloudy';
        if (code < 50) return 'Overcast';
        return 'Rainy';
    }

    fetchWeather();
</script>

<?php include_once 'admin_footer.php'; ?>