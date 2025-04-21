<?php
require_once 'includes/header.php';
require_once 'includes/db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$city_stmt = $pdo->query("SELECT DISTINCT SUBSTRING_INDEX(address, ',', -1) AS city FROM stations");
$cities = $city_stmt->fetchAll(PDO::FETCH_COLUMN);

$keyword = $_GET['keyword'] ?? '';
$city = $_GET['city'] ?? '';

$sql = "SELECT * FROM stations WHERE 1";
$params = [];

if (!empty($keyword)) {
    $sql .= " AND (name LIKE ? OR address LIKE ?)";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
}

if (!empty($city) && $city != 'Tất cả') {
    $sql .= " AND address LIKE ?";
    $params[] = "%" . trim($city) . "%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$stations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trạm xe thông minh - Bootstrap 5</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .map-container {
            height: 100vh;
            width: 100%;
        }

        #map {
            height: 100%;
        }

        .sidebar {
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
            padding-top: 1rem;
        }

        .list-group-item {
            word-break: break-word;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col-md-3 col-lg-3 sidebar bg-white">
                <div class="px-3 pt-4 mt-5">
                    <h5 class="text-center text-primary fw-bold">📍 DANH SÁCH TRẠM</h5>
                    <form method="GET" class="mb-3">
                        <div class="mb-2">
                            <label class="form-label">Thành phố</label>
                            <select class="form-select" name="city">
                                <option>Tất cả</option>
                                <?php foreach ($cities as $c): ?>
                                    <option value="<?= $c ?>" <?= ($city == $c) ? 'selected' : '' ?>><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Từ khóa</label>
                            <input type="text" class="form-control" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="Tên quận, đường, trạm xe...">
                        </div>
                        <button class="btn btn-primary w-100">Tìm kiếm</button>
                    </form>

                    <hr>
                    <label class="form-label">📍 Địa chỉ của bạn</label>
                    <input type="text" id="yourAddress" class="form-control mb-2" placeholder="Ví dụ: 100 Nguyễn Thị Minh Khai...">
                    <button type="button" class="btn btn-outline-success w-100 mb-3" onclick="findNearestStation()">Tìm trạm gần nhất</button>

                    <p class="text-muted">Tìm thấy <strong><?= count($stations) ?></strong> trạm xe</p>
                    <ul class="list-group small mb-5">
                        <?php foreach ($stations as $s): ?>
                            <li class="list-group-item">
                                <a href="station_detail.php?id=<?= $s['id'] ?>" class="text-decoration-none text-dark">
                                    <strong><?= htmlspecialchars($s['name']) ?></strong><br>
                                    <?= htmlspecialchars($s['address']) ?><br>
                                    🚲 <strong><?= $s['bike_count'] ?></strong> xe
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 col-lg-9 p-0">
                <div id="map" class="map-container"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([10.7769, 106.7009], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        const icon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/2972/2972185.png',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -30]
        });

        const stations = <?= json_encode($stations) ?>;

        stations.forEach(s => {
            L.marker([s.latitude, s.longitude], {
                    icon
                })
                .addTo(map)
                .bindPopup(`<strong>${s.name}</strong><br>${s.address}<br>🚲 ${s.bike_count} xe`);
        });

        async function findNearestStation() {
            let rawAddress = document.getElementById("yourAddress").value.trim();
            if (!rawAddress) return alert("Vui lòng nhập địa chỉ hoặc tên đường.");

            let candidates = [];

            if (rawAddress.toLowerCase().includes("hồ chí minh") || rawAddress.toLowerCase().includes("hà nội")) {
                candidates.push(rawAddress);
            } else {
                candidates.push(`${rawAddress}, TP. Hồ Chí Minh`);
                candidates.push(`${rawAddress}, Hà Nội`);
            }

            let location = null;
            for (const addr of candidates) {
                const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(addr)}`;
                const res = await fetch(url);
                const data = await res.json();
                if (data && data[0]) {
                    location = {
                        lat: parseFloat(data[0].lat),
                        lon: parseFloat(data[0].lon),
                        raw: addr
                    };
                    break;
                }
            }

            if (!location) return alert("Không tìm thấy tọa độ từ địa chỉ bạn nhập.");

            const userLat = location.lat;
            const userLng = location.lon;

            let minDist = Infinity;
            let nearest = null;

            stations.forEach(s => {
                const dist = getDistance(userLat, userLng, parseFloat(s.latitude), parseFloat(s.longitude));
                if (dist < minDist) {
                    minDist = dist;
                    nearest = s;
                }
            });

            if (nearest) {
                map.setView([nearest.latitude, nearest.longitude], 16);
                L.popup()
                    .setLatLng([nearest.latitude, nearest.longitude])
                    .setContent(`<strong>${nearest.name}</strong><br>${nearest.address}<br>🚲 ${nearest.bike_count} xe<br>📍 Từ: ${location.raw}<br>📏 Khoảng cách: ~${Math.round(minDist)} m`)
                    .openOn(map);
            }
        }

        function getDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3;
            const φ1 = lat1 * Math.PI / 180,
                φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180,
                Δλ = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(Δφ / 2) ** 2 + Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) ** 2;
            return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        }
    </script>

    <?php require_once 'includes/footer.php'; ?>
</body>

</html>