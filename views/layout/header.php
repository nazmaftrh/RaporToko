<!DOCTYPE html>
<html>
<head>
    <title><?= $setting['app_name'] ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleMenu() {
            document.getElementById("navMenu").classList.toggle("show");
        }

        function toggleProfile(e) {
            e.stopPropagation();
            const box = document.getElementById("profileBox");
            box.style.display = box.style.display === "block" ? "none" : "block";
        }

        document.addEventListener("click", function(e) {
            const menu    = document.getElementById("navMenu");
            const burger  = document.querySelector(".burger");
            const profile = document.getElementById("profileArea");
            const box     = document.getElementById("profileBox");

            if (profile && !profile.contains(e.target)) {
                box.style.display = "none";
            }

            if (
                menu.classList.contains("show") &&
                !menu.contains(e.target) &&
                !burger.contains(e.target)
            ) {
                menu.classList.remove("show");
            }
        });
    </script>
</head>

<body>

<div class="header">
    <div class="left-area">
        <img src="<?= BASE_URL ?>/logo.jpeg" alt="logo" class="logo">
        <div class="app-title">
            <div class="appname"><?= $setting['app_name'] ?></div>
            <div class="subtitle"><?= $setting['app_subtitle'] ?></div>
        </div>
    </div>

    <div class="right-area">

        <div class="burger" onclick="toggleMenu()">☰</div>

        <div class="nav-menu" id="navMenu">
            <a href="<?= BASE_URL ?>/dashboard">Dashboard</a>
            <a href="<?= BASE_URL ?>/kategori">Kategori</a>
            <a href="<?= BASE_URL ?>/produk">Produk</a>
            <a href="<?= BASE_URL ?>/surat">Surat Jalan</a>

            <div class="profile-area" id="profileArea">
                <span onclick="toggleProfile(event)">
                    <?= $_SESSION['user']['username'] ?> ▼
                </span>

                <div class="profile-dropdown" id="profileBox">
                    <div>
                        Role: <b><?= ucfirst($_SESSION['user']['role']) ?></b>
                    </div>
                    <a href="<?= BASE_URL ?>/auth/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
