<?php
require_once 'db.php';
require_once 'check_auth.php';
include_once 'admin_header.php';

// Fetch real-time stats
$projCount = 0;
$inqCount = 0;
$adminCount = 0;

try {
    $projCount = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    $inqCount = $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
    $adminCount = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();

    // Trend Logic: Last 7 days inquiries
    $chartLabels = [];
    $chartDataValues = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $label = date('D', strtotime("-$i days"));
        
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM inquiries WHERE DATE(created_at) = ?");
        $stmt->execute([$date]);
        $count = $stmt->fetchColumn();
        
        $chartLabels[] = $label;
        $chartDataValues[] = (int)$count;
    }
    $chartData = json_encode(['labels' => $chartLabels, 'data' => $chartDataValues]);

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

    <!-- Inquiries Widget -->
    <div class="widget-card" data-aos="zoom-in" data-aos-delay="200" style="background: linear-gradient(135deg, var(--primary), #1e40af);">
        <div class="widget-label">Total Inquiries</div>
        <div class="widget-value"><?= $inqCount ?></div>
        <div class="widget-icon">✉️</div>
    </div>

    <!-- Team Widget -->
    <div class="widget-card" data-aos="zoom-in" data-aos-delay="300" style="background: linear-gradient(135deg, var(--primary), #065f46);">
        <div class="widget-label">Admin Users</div>
        <div class="widget-value"><?= $adminCount ?></div>
        <div class="widget-icon">👥</div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Left Column: Trend & Recent Inquiries -->
    <div>
        <h2 style="margin: 0 0 1.5rem 0; font-weight: 800; letter-spacing: -1px; display: flex; align-items: center; gap: 1rem;" data-aos="fade-right">
            <span>📈</span> Inquiry Trends (7 Days)
        </h2>
        <div class="table-card" style="padding: clamp(1.5rem, 6vw, 3rem); margin-bottom: 4rem; background: #fff;" data-aos="fade-right" data-aos-delay="100">
            <div style="height: clamp(250px, 40vh, 350px); width: 100%; position: relative;">
                <canvas id="inquiryChart"></canvas>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin: 3rem 0 1.5rem 0;" data-aos="fade-right" data-aos-delay="200">
            <h2 style="margin: 0; font-weight: 800; letter-spacing: -0.5px;">Recent Inquiries</h2>
            <a href="admin_inquiries.php" style="color: var(--secondary); font-weight: 700; text-decoration: none; font-size: 0.875rem;">CRM Portal →</a>
        </div>
        <div class="table-card" data-aos="fade-right" data-aos-delay="300">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT name, service, created_at FROM inquiries ORDER BY created_at DESC LIMIT 5");
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                                $date = date('M j, Y', strtotime($row['created_at']));
                                echo "<tr>";
                                echo "<td><strong>" . htmlspecialchars($row['name']) . "</strong></td>";
                                echo "<td><span style='background: #F1F5F9; padding: 0.4rem 0.8rem; border-radius: 0.75rem; font-size: 0.75rem; font-weight: 700; color: var(--primary);'>" . htmlspecialchars($row['service']) . "</span></td>";
                                echo "<td>" . htmlspecialchars($date) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' style='text-align: center; padding: 4rem;'>
                                <div style='font-size: 3rem; margin-bottom: 1rem;'>✨</div>
                                <div style='font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px;'>Clean Workspace</div>
                            </td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
    // 1. Chart.js Implementation
    const trendData = <?= $chartData ?>;
    const ctx = document.getElementById('inquiryChart').getContext('2d');
    
    // Create gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(255, 184, 0, 0.2)');
    gradient.addColorStop(1, 'rgba(255, 184, 0, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: trendData.labels,
            datasets: [{
                label: 'New Inquiries',
                data: trendData.data,
                borderColor: '#FFB800',
                backgroundColor: gradient,
                borderWidth: 5,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#FFB800',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0A2540',
                    titleFont: { family: 'Outfit', weight: '800' },
                    bodyFont: { family: 'Outfit' },
                    padding: 15,
                    cornerRadius: 10,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.03)' },
                    ticks: { 
                        stepSize: 1, 
                        font: { family: 'Outfit', weight: '600' },
                        color: '#64748B'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { 
                        font: { family: 'Outfit', weight: '800' },
                        color: '#0A2540'
                    }
                }
            }
        }
    });

    // 2. Live Weather (Open-Meteo)
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